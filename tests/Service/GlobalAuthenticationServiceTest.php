<?php

namespace Tests\Service;

use Exception;
use ID3Global\Identity\Identity;
use ID3Global\Identity\PersonalDetails;
use ID3Global\Service\GlobalAuthenticationService;
use ID3Global\Stubs\Gateway\GlobalAuthenticationGatewayFake;
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
        $identity = new Identity();
        $identity->setPersonalDetails($personalDetails);

        $profileId = 'profile-id';
        $fakeGateway = new GlobalAuthenticationGatewayFake('username', 'password');
        $this->service = new GlobalAuthenticationService($identity, $profileId, $fakeGateway);
    }

    /**
     * @throws Exception
     */
    public function testSuccessfulResponse()
    {
        $this->service->setCustomerReference('x');

        $this->assertSame(Identity::IDENTITY_BAND_PASS, $this->service->verifyIdentity());

        $response = $this->service->getLastVerifyIdentityResponse();
        $this->assertSame(Identity::IDENTITY_BAND_PASS, $response->AuthenticateSPResult->BandText);
        $this->assertSame('Default Profile', $response->AuthenticateSPResult->ProfileName);
    }
}
