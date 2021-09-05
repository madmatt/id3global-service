<?php

namespace ID3Global\Tests\Service;

use DateTime;
use ID3Global\Exceptions\IdentityVerificationFailureException;
use ID3Global\Identity\Identity;
use ID3Global\Identity\PersonalDetails;
use ID3Global\Service\GlobalAuthenticationService;
use ID3Global\Stubs\Gateway\GlobalAuthenticationGatewayFake;
use LogicException;
use PHPUnit\Framework\TestCase;

class GlobalAuthenticationServiceTest extends TestCase
{
    /**
     * @var GlobalAuthenticationGatewayFake
     */
    private GlobalAuthenticationGatewayFake $fakeGateway;

    /**
     * @var GlobalAuthenticationService
     */
    private GlobalAuthenticationService $service;

    public function setUp(): void
    {
        $this->fakeGateway = new GlobalAuthenticationGatewayFake('username', 'password');
        $this->service = new GlobalAuthenticationService($this->fakeGateway);
    }

    /**
     * @dataProvider authenticateSp
     *
     * @param string|null   $customerReference
     * @param DateTime|null $birthday
     *
     * @throws IdentityVerificationFailureException
     */
    public function testSuccessfulResponse(?string $customerReference, ?DateTime $birthday)
    {
        // Arrange
        $personalDetails = new PersonalDetails();
        $personalDetails
            ->setForename('Snow')
            ->setMiddleName('White')
            ->setSurname('Huntsman')
            ->setGender('Female')
            ->setDateOfBirth($birthday);

        $identity = new Identity();
        $identity->setPersonalDetails($personalDetails);

        $profileId = 'profile-id';

        // Act
        $bandText = $this->service
            ->setProfileId($profileId)
            ->verifyIdentity($identity, $customerReference);

        // Assert
        $this->assertSame(GlobalAuthenticationGatewayFake::IDENTITY_BAND_PASS, $bandText);

        $response = $this->service->getLastVerifyIdentityResponse();
        $this->assertSame('stdClass', get_class($response));
        $this->assertSame(GlobalAuthenticationGatewayFake::IDENTITY_BAND_PASS, $response->AuthenticateSPResult->BandText);
        $this->assertSame('Default Profile', $response->AuthenticateSPResult->ProfileName);
    }

    /**
     * @dataProvider fakeResponses
     *
     * @param string $profileId
     * @param int    $profileVersion
     * @param string $customerReference
     * @param string $bandText
     * @param int    $score
     *
     * @throws IdentityVerificationFailureException
     */
    public function testFakeResponses(string $profileId, int $profileVersion, string $customerReference, string $bandText, int $score)
    {
        // Arrange
        $this->fakeGateway->setBandText($bandText)->setScore($score);

        $identity = new Identity();

        // Act
        $result = $this->service
            ->setProfileId($profileId)
            ->setProfileVersion($profileVersion)
            ->verifyIdentity($identity, $customerReference);

        // Assert
        $this->assertSame($bandText, $result);
        $this->assertSame($score, $this->service->getLastVerifyIdentityResponse()->AuthenticateSPResult->Score);
        $this->assertSame($profileId, $this->service->getLastVerifyIdentityResponse()->AuthenticateSPResult->ProfileID);
        $this->assertSame($profileVersion, $this->service->getLastVerifyIdentityResponse()->AuthenticateSPResult->ProfileVersion);
        $this->assertSame($customerReference, $this->service->getLastVerifyIdentityResponse()->AuthenticateSPResult->CustomerRef);
    }

    public function testNotSettingProfileIdThrows()
    {
        $identity = new Identity();

        $this->expectException(LogicException::class);
        $this->service->verifyIdentity($identity);
    }

    public function authenticateSp(): array
    {
        return [
            ['customer-reference', DateTime::createFromFormat('Y-m-d', '1976-03-06')],
            [null, DateTime::createFromFormat('Y-m-d', '1976-03-06')],
            ['customer-reference', null],
        ];
    }

    public function fakeResponses(): array
    {
        return [
            ['profile-id', 1, 'customer-1', GlobalAuthenticationGatewayFake::IDENTITY_BAND_ALERT, 20000],
            ['profile-id-2', 0, 'customer-2', GlobalAuthenticationGatewayFake::IDENTITY_BAND_REFER, 500],
        ];
    }
}
