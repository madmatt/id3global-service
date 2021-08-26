<?php

namespace ID3Global\Service;

use Exception;
use ID3Global\Exceptions\IdentityVerificationFailureException;
use ID3Global\Gateway\GlobalAuthenticationGateway;
use ID3Global\Identity\Identity;
use SoapClient;
use stdClass;

class GlobalAuthenticationService extends ID3BaseService
{
    /**
     * @var Identity
     */
    private Identity $identity;

    /**
     * @var string The Profile ID to be used when verifying a @link \ID3Global\Identity\Identity object
     */
    private string $profileID;

    /**
     * @var int The Profile Version to be used when verifying a @link \ID3Global\Identity\Identity object. The version
     *          0 represents the 'most recent version of the profile', which is generally what is required.
     */
    private int $profileVersion = 0;

    /**
     * @var string|null A reference stored against this identity request. This is optional, but is recommended to set a
     *                  customer reference and store it against the returned identity verification so it can be later tracked if
     *                  necessary for compliance purposes.
     */
    private ?string $customerReference = null;

    /**
     * @var GlobalAuthenticationGateway
     */
    private GlobalAuthenticationGateway $gateway;

    /**
     * @var stdClass|null The last response, directly from the API gateway. Can be retrieved using
     *                    {@link getLastVerifyIdentityResponse()}.
     */
    private ?stdClass $lastVerifyIdentityResponse = null;

    /**
     * @var string|null The last request passed into SoapClient
     */
    private ?string $lastRawRequest = null;

    /**
     * @var array Optional extras for the SOAP client
     */
    private array $soapOptions = [];

    public function __construct(
        Identity $identity,
        string $profileID,
        GlobalAuthenticationGateway $gateway
    )
    {
        $this->identity = $identity;
        $this->profileID = $profileID;
        $this->gateway = $gateway;
    }

    /**
     * @throws Exception
     *
     * @return string One of Identity::IDENTITY_BAND_PASS, Identity::IDENTITY_BAND_REFER, or Identity::IDENTITY_BAND_ALERT
     */
    public function verifyIdentity(): string
    {
        $gateway = $this->getGateway();

        try {
            $response = $gateway->AuthenticateSP(
                $this->profileID,
                $this->profileVersion,
                $this->customerReference,
                $this->identity
            );

            if ($gateway->getClient() instanceof SoapClient) {
                $this->lastRawRequest = $gateway->getClient()->__getLastRequest();
            }

            $validResult = false;

            if (
                isset($response) &&
                isset($response->AuthenticateSPResult) &&
                isset($response->AuthenticateSPResult->BandText) && isset($response->AuthenticateSPResult->Score)
            ) {
                $validResult = true;
            }

            if ($validResult) {
                $this->lastVerifyIdentityResponse = $response;

                return $response->AuthenticateSPResult->BandText;
            } else {
                throw new IdentityVerificationFailureException($response);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @return stdClass|null Either the full response as returned by ID3Global, or null if no call has been made (or
     *                       if the previous call failed for any reason)
     */
    public function getLastVerifyIdentityResponse(): ?stdClass
    {
        return $this->lastVerifyIdentityResponse;
    }

    /**
     * @return string|null The XML string being sent into the SoapClient
     */
    public function getLastRawRequest(): ?string
    {
        return $this->lastRawRequest;
    }

    /**
     * @return GlobalAuthenticationGateway
     */
    public function getGateway(): GlobalAuthenticationGateway
    {
        if (!$this->gateway) {
            $this->gateway = new GlobalAuthenticationGateway(
                $this->getApiUsername(),
                $this->getApiPassword(),
                $this->getSoapOptions(),
                $this->getPilotSiteEnabled()
            );
        }

        return $this->gateway;
    }

    public function setGateway(GlobalAuthenticationGateway $gateway): GlobalAuthenticationService
    {
        $this->gateway = $gateway;

        return $this;
    }

    /**
     * @param string $reference
     *
     * @return GlobalAuthenticationService
     */
    public function setCustomerReference(string $reference): GlobalAuthenticationService
    {
        $this->customerReference = $reference;

        return $this;
    }

    public function getCustomerReference(): string
    {
        return $this->customerReference;
    }

    /**
     * @return array
     */
    public function getSoapOptions(): array
    {
        return $this->soapOptions;
    }

    /**
     * @param array $soapOptions
     *
     * @return $this
     */
    public function setSoapOptions(array $soapOptions): GlobalAuthenticationService
    {
        $this->soapOptions = $soapOptions;

        return $this;
    }

    /**
     * @param Identity $identity
     *
     * @return GlobalAuthenticationService
     */
    public function setIdentity(Identity $identity): GlobalAuthenticationService
    {
        $this->identity = $identity;

        return $this;
    }

    /**
     * @param string $profileID
     *
     * @return GlobalAuthenticationService
     */
    public function setProfileID(string $profileID): GlobalAuthenticationService
    {
        $this->profileID = $profileID;

        return $this;
    }

    /**
     * @param int $profileVersion
     *
     * @return GlobalAuthenticationService
     */
    public function setProfileVersion(int $profileVersion): GlobalAuthenticationService
    {
        $this->profileVersion = $profileVersion;

        return $this;
    }
}
