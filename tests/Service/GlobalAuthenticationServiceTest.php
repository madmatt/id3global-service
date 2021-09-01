<?php

namespace Tests\Service;

use DateTime;
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
        $fakeGateway = new GlobalAuthenticationGatewayFake('username', 'password');
        $this->service = new GlobalAuthenticationService($fakeGateway);
    }

    /**
     * @throws Exception
     */
    public function testSuccessfulResponse()
    {
        // Arrange
        $personalDetails = new PersonalDetails();
        $personalDetails
            ->setForename('Snow')
            ->setMiddleName('White')
            ->setSurname('Huntsman')
            ->setGender('Female')
            ->setDateOfBirth(DateTime::createFromFormat('Y-m-d', '1976-03-06'));
        $identity = new Identity();
        $identity->setPersonalDetails($personalDetails);

        $profileId = 'profile-id';

        // Act
        $bandText = $this->service->verifyIdentity($identity, $profileId, 0, 'x');

        // Assert
        $this->assertSame(Identity::IDENTITY_BAND_PASS, $bandText);
        $response = $this->service->getLastVerifyIdentityResponse();
        $this->assertSame(Identity::IDENTITY_BAND_PASS, $response->AuthenticateSPResult->BandText);
        $this->assertSame('Default Profile', $response->AuthenticateSPResult->ProfileName);
    }
}
