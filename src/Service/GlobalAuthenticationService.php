<?php
namespace ID3Global\Service;

use ID3Global\Exceptions\IdentityVerificationFailureException;
use ID3Global\Gateway\GlobalAuthenticationGateway;
use ID3Global\Identity\Identity;

class GlobalAuthenticationService extends ID3BaseService
{
    /**
     * @var \ID3Global\Identity\Identity
     */
    private $identity;

    /**
     * @var string The Profile ID to be used when verifying a @link \ID3Global\Identity\Identity object
     */
    private $profileID;

    /**
     * @var int The Profile Version to be used when verifying a @link \ID3Global\Identity\Identity object. The version
     * 0 represents the 'most recent version of the profile', which is generally what is required.
     */
    private $profileVersion;

    /**
     * @var string A reference stored against this identity request. This is optional, but is recommended to set a
     * customer reference and store it against the returned identity verification so it can be later tracked if
     * necessary for compliance purposes.
     */
    private $customerReference;

    /**
     * @var GlobalAuthenticationGateway
     */
    private $gateway;

    /**
     * @var \stdClass The last response, directly from the API gateway. Can be retrieved using
     * {@link getLastVerifyIdentityResponse()}.
     */
    private $lastVerifyIdentityResponse = null;

    /**
     * @var array Optional extras for the SOAP client
     */
    private $soapOptions = array();

    /**
     * @return string One of Identity::IDENTITY_BAND_PASS, Identity::IDENTITY_BAND_REFER, or Identity::IDENTITY_BAND_ALERT
     * @throws \Exception
     */
    public function verifyIdentity()
    {
        if (!$this->identity || !$this->identity instanceof Identity) {
            throw new \LogicException('An Identity must be provided by setIdentity() before calling verifyIdentity()');
        }

        $gateway = $this->getGateway();

        try {
            $response = $gateway->AuthenticateSP($this->profileID, $this->profileVersion, $this->customerReference,
                $this->identity);

            $validResult = false;

            if(
                isset($response) && 
                isset($response->AuthenticateSPResult) && 
                isset($response->AuthenticateSPResult->BandText) && isset($response->AuthenticateSPResult->Score)
            ) {
                $validResult = true;
            }

            if($validResult) {
                $this->lastVerifyIdentityResponse = $response;
                return $response->AuthenticateSPResult->BandText;
            } else {
                throw new IdentityVerificationFailureException($response);
            }
        } catch (\Exception $e) {
            throw $e;
        }

    }

    /**
     * @return \stdClass|null Either the full response as returned by ID3Global, or null if no call has been made (or
     * if the previous call failed for any reason)
     */
    public function getLastVerifyIdentityResponse() {
        return $this->lastVerifyIdentityResponse;
    }

    /**
     * @return GlobalAuthenticationGateway
     */
    public function getGateway()
    {
        if(!$this->gateway) {
            $this->gateway = new GlobalAuthenticationGateway(
                $this->getApiUsername(),
                $this->getApiPassword(),
                $this->getSoapOptions(),
                $this->getPilotSiteEnabled()
            );
        }

        return $this->gateway;
    }

    public function setGateway(GlobalAuthenticationGateway $gateway) {
        $this->gateway = $gateway;
        return $this;
    }

    /**
     * @param string $reference
     * @return GlobalAuthenticationService
     */
    public function setCustomerReference($reference)
    {
        $this->customerReference = $reference;
        return $this;
    }

    public function getCustomerReference() {
        return $this->customerReference;
    }

    /**
     * @return array
     */
    public function getSoapOptions()
    {
        return $this->soapOptions;
    }

    /**
     * @param array $soapOptions
     */
    public function setSoapOptions($soapOptions)
    {
        $this->soapOptions = $soapOptions;
    }

    /**
     * @param \ID3Global\Identity\Identity $identity
     * @return GlobalAuthenticationService
     */
    public function setIdentity(Identity $identity)
    {
        $this->identity = $identity;
        return $this;
    }

    /**
     * @param string $profileID
     * @return GlobalAuthenticationService
     */
    public function setProfileID($profileID)
    {
        $this->profileID = $profileID;
        return $this;
    }

    /**
     * @param int $profileVersion
     * @return GlobalAuthenticationService
     */
    public function setProfileVersion($profileVersion)
    {
        $this->profileVersion = $profileVersion;
        return $this;
    }


}
