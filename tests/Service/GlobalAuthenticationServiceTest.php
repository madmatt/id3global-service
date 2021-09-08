<?php

declare(strict_types=1);

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
     * @var GlobalAuthenticationGatewayFake The fake gateway that we can update the band text and score on.
     */
    private GlobalAuthenticationGatewayFake $fakeGateway;

    /**
     * @var GlobalAuthenticationService The shared service that we use for each test.
     */
    private GlobalAuthenticationService $service;

    public function setUp(): void
    {
        $this->fakeGateway = new GlobalAuthenticationGatewayFake('username', 'password');
        $this->service = new GlobalAuthenticationService($this->fakeGateway);
    }

    /**
     * @dataProvider authenticateSpDataProvider
     * @throws IdentityVerificationFailureException
     */
    public function testSuccessfulResponse(?string $customerReference, ?DateTime $birthday): void
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
        $this->assertSame(
            GlobalAuthenticationGatewayFake::IDENTITY_BAND_PASS,
            $response->AuthenticateSPResult->BandText
        );
        $this->assertSame('Default Profile', $response->AuthenticateSPResult->ProfileName);
    }

    /**
     * @dataProvider fakeResponses
     * @param string $profileId Profile ID value
     * @param int $profileVersion Profile Version value
     * @param string $customerReference Customer reference submitted
     * @param string $bandText The BandText to return from the fake gateway
     * @param int $score The score to return from the fake gateway
     * @throws IdentityVerificationFailureException
     */
    public function testFakeResponses(
        string $profileId,
        int $profileVersion,
        string $customerReference,
        string $bandText,
        int $score
    ): void {
        // Arrange
        $this->fakeGateway->setBandText($bandText)->setScore($score);

        $identity = new Identity();

        // Act
        $result = $this->service
            ->setProfileId($profileId)
            ->setProfileVersion($profileVersion)
            ->verifyIdentity($identity, $customerReference);

        $response = $this->service->getLastVerifyIdentityResponse();

        // Assert
        $this->assertSame($bandText, $result);
        $this->assertSame($score, $response->AuthenticateSPResult->Score);
        $this->assertSame($profileId, $response->AuthenticateSPResult->ProfileID);
        $this->assertSame($profileVersion, $response->AuthenticateSPResult->ProfileVersion);
        $this->assertSame($customerReference, $response->AuthenticateSPResult->CustomerRef);
    }

    public function testNotSettingProfileIdThrows(): void
    {
        $identity = new Identity();

        $this->expectException(LogicException::class);
        $this->service->verifyIdentity($identity);
    }

    /**
     * @return array<array<?string, ?DateTime>> Various options of customer reference and birthdays for testing purposes
     */
    public function authenticateSpDataProvider(): array
    {
        return [
            ['customer-reference', DateTime::createFromFormat('Y-m-d', '1976-03-06')],
            [null, DateTime::createFromFormat('Y-m-d', '1976-03-06')],
            ['customer-reference', null],
        ];
    }

    /**
     * @return array<array<string, int, string, string, int>> Options for profile id, profile version, customer
     * reference, BandText to return and score to return from the fake gateway
     */
    public function fakeResponses(): array
    {
        return [
            ['profile-id', 1, 'customer-1', GlobalAuthenticationGatewayFake::IDENTITY_BAND_ALERT, 20000],
            ['', 0, '', GlobalAuthenticationGatewayFake::IDENTITY_BAND_REFER, 500],
        ];
    }
}
