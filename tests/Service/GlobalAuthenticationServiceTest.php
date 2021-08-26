<?php
namespace Tests\Service;

use Exception;
use ID3Global\Identity\Address\AddressContainer;
use ID3Global\Identity\Address\FixedFormatAddress;
use ID3Global\Identity\ContactDetails;
use ID3Global\Identity\Documents\DocumentContainer;
use ID3Global\Identity\Documents\InternationalPassport;
use ID3Global\Stubs\Gateway\GlobalAuthenticationGatewayFake;
use ID3Global\Identity\Identity;
use ID3Global\Identity\PersonalDetails;
use \ID3Global\Service\GlobalAuthenticationService;
use PHPUnit\Framework\TestCase;

class GlobalAuthenticationServiceTest extends TestCase
{
    /**
     * @var GlobalAuthenticationService
     */
    private GlobalAuthenticationService $service;

    public function setUp(): void
    {
        $personalDetails = new PersonalDetails();
        $personalDetails
            ->setForename('Snow')
            ->setMiddleName('White')
            ->setSurname('Huntsman')
            ->setGender('Female')
            ->setDateOfBirth(1976, 3, 6);
        $contactDetails = new ContactDetails();
        $addresses = new AddressContainer(new FixedFormatAddress());
        $identityDocuments = new DocumentContainer(new InternationalPassport());
        $identity = new Identity($personalDetails, $contactDetails, $addresses, $identityDocuments);

        $profileId = 'profile-id';
        $fakeGateway = new GlobalAuthenticationGatewayFake('username', 'password');
        $this->service = new GlobalAuthenticationService($identity, $profileId, $fakeGateway);
    }

    /**
     * @throws Exception
     */
    public function testSuccessfulResponse() {
        $this->service->setCustomerReference('x');

        $this->assertSame(Identity::IDENTITY_BAND_PASS, $this->service->verifyIdentity());

        $response = $this->service->getLastVerifyIdentityResponse();
        $this->assertSame(Identity::IDENTITY_BAND_PASS, $response->AuthenticateSPResult->BandText);
        $this->assertSame('Default Profile', $response->AuthenticateSPResult->ProfileName);
    }
}
