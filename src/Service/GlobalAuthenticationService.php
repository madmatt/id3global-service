<?php

declare(strict_types=1);

namespace ID3Global\Service;

use Exception;
use ID3Global\Exceptions\IdentityVerificationFailureException;
use ID3Global\Gateway\GlobalAuthenticationGateway;
use ID3Global\Identity\Identity;
use LogicException;
use SoapClient;
use stdClass;

class GlobalAuthenticationService extends ID3BaseService
{
    /**
     * @var GlobalAuthenticationGateway|null The gateway object that is used to actually connect to ID3global's service.
     */
    private ?GlobalAuthenticationGateway $gateway;

    /**
     * @var ?string The Profile ID to be used when verifying identities via->verifyIdentity().
     * @see self::setProfileId()
     */
    private ?string $profileId = null;

    /**
     * @var int The version of the Profile ID to be used when verifying identities via->verifyIdentity(). The special
     * value of 0 is special for ID3global and represents the 'most recent version of the profile'.
     * @see self::setProfileVersion()
     */
    private int $profileVersion = 0;

    /**
     * @var bool Whether or not to include the full ID3global API response in exception messages. Enable only if you're
     * logging exception messages to a GDPR-compliant store as this may include PII.
     * @see self::setVerboseExceptionHandling()
     */
    private bool $verboseExceptionHandling = false;

    /**
     * @var Identity The most recent Identity object to be verified by the ID3global API (regardless of the outcome of
     * the API request).
     * @see self::getLastVerifiedIdentity()
     */
    private Identity $lastIdentity;

    /**
     * @var string|null The most recent customer reference to be verified by the ID3global API (regardless of the
     * outcome of the API request).
     */
    private ?string $lastCustomerReference;

    /**
     * @var \stdClass|null The last response, directly from the API gateway. Can be retrieved using
     * {@link getLastVerifyIdentityResponse()}.
     */
    private ?stdClass $lastVerifyIdentityResponse = null;

    /**
     * @var string|null The last request passed into SoapClient
     */
    private ?string $lastRawRequest = null;

    /**
     * @var array Optional extras for the SOAP client
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingTraversableTypeHintSpecification
     */
    private array $soapOptions = [];

    /**
     * When constructing this class, you can either first construct a GlobalAuthenticationGateway and pass it in, or you
     * can leave this blank to use the default GlobalAuthenticationGateway. In the former case, you should set the API
     * username/password and SOAP options directly on the gateway when you create it. Otherwise, you should set that on
     * this service class before calling ->verifyIdentity().
     *
     * @param GlobalAuthenticationGateway|null $gateway Either the gateway class to use, or null to have the service
     * instantiate this gateway for you.
     * @param array $soapOptions If you don't pass in a gateway and you want to configure options for the SoapClient,
     * you can pass these in here, or call ->setSoapOptions() after constructing the object.
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingTraversableTypeHintSpecification
     */
    public function __construct(?GlobalAuthenticationGateway $gateway, array $soapOptions = [])
    {
        $this->gateway = $gateway;
        $this->soapOptions = $soapOptions;
    }

    /**
     * Given an Identity and a profile of checks to perform, query ID3Global and verify the given $identity object. The
     * raw response is the output of the 'BandText' as returned directly by the ID3Global API. Per the
     * [ID3Global 'Integrate now' documentation](https://www.id3globalsupport.com/integrate-now/), you should use this
     * value to determine whether or not to consider the identity to be sufficiently verified for your needs.
     *
     * If you want to dive deeper (e.g. to look at individual checks that were performed such as whether the identity
     * matched on a driver's license or passport record), you can do this by calling
     * $service->getLastVerifyIdentityResponse() after calling this method - this will return the full response from the
     * API.
     *
     * Ensure you call at least ->setProfileId() prior to calling this method.
     * Optionally call ->setProfileVersion() if you wish to set a specific profile version to query against.
     *
     * @param Identity $identity The full Identity object that should be verified with the ID3global API
     * @param string|null $customerReference A reference stored against this identity request within the ID3global
     * interface. This is optional, but it's highly recommended that you set a customer reference and store it against
     * the identity long-term in your own data store so that it can be later tracked if necessary for compliance
     * purposes.
     * @throws Exception May throw a generic Exception or SoapFault if any part of the SOAP callstack fails.
     * @throws IdentityVerificationFailureException Thrown specifically if the SOAP response was 'valid' according to
     * SOAP but does not conform to the expected response (missing BandText or Score elements of the response).
     * @return string The raw BandText as provided by the API.
     */
    public function verifyIdentity(Identity $identity, ?string $customerReference = null): string
    {
        $this->lastIdentity = $identity;
        $this->lastCustomerReference = $customerReference;

        $gateway = $this->getGateway();

        if ($this->profileId === null) {
            $error = 'An ID3global Profile ID must be set by calling setProfileId() before calling verifyIdentity().';

            throw new LogicException($error);
        }

        $profileId = $this->profileId;
        $profileVersion = $this->profileVersion;

        $response = $gateway->AuthenticateSP($profileId, $profileVersion, $customerReference, $identity);

        if ($gateway->getClient() instanceof SoapClient) {
            $this->lastRawRequest = $gateway->getClient()->__getLastRequest();
        }

        $validResult = false;
        $this->lastVerifyIdentityResponse = $response;

        if (
            isset($response) &&
            isset($response->AuthenticateSPResult) &&
            isset($response->AuthenticateSPResult->BandText) && isset($response->AuthenticateSPResult->Score)
        ) {
            $validResult = true;
        }

        if (!$validResult) {
            throw new IdentityVerificationFailureException($response, $this->getVerboseExceptionHandling());
        }

        return $response->AuthenticateSPResult->BandText;
    }

    public function setProfileId(string $profileId): self
    {
        $this->profileId = $profileId;

        return $this;
    }

    public function getProfileId(): string
    {
        return $this->profileId;
    }

    public function setProfileVersion(int $profileVersion): self
    {
        $this->profileVersion = $profileVersion;

        return $this;
    }

    public function getProfileVersion(): int
    {
        return $this->profileVersion;
    }

    /**
     * @return Identity|null The last Identity object to be verified by the API (regardless of whether it was
     * successfully accepted by the ID3global API or not). Returns null if ->verifyIdentity() has not yet been called.
     */
    public function getLastVerifiedIdentity(): ?Identity
    {
        return $this->lastIdentity;
    }

    /**
     * @return string|null The last customer reference value to be verified by the API (regardless of whether it was
     * successfully accepted by the ID3global API or not). Returns null if ->verifyIdentity() has not yet been called.
     */
    public function getLastCustomerReference(): ?string
    {
        return $this->lastCustomerReference;
    }

    /**
     * @return stdClass|null Either the full response as returned by ID3global, or null if no call has been made yet. If
     * the request was made but failed to validate (e.g. the ID3global API returned an invalid SOAP object, this will
     * still be populated.
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

    public function setGateway(GlobalAuthenticationGateway $gateway): void
    {
        $this->gateway = $gateway;
    }

    /**
     * @return array The currently configured SoapClient options. After ->getGateway() is called above, or if you
     * define your own gateway when constructing this class, these may not be the actual SoapClient options specified
     * (as you can access the underlying SoapClient and configure options directly on it).
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ReturnTypeHint.MissingTraversableTypeHintSpecification
     */
    public function getSoapOptions(): array
    {
        return $this->soapOptions;
    }

    /**
     * @param array $soapOptions
     * @return $this
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingTraversableTypeHintSpecification
     */
    public function setSoapOptions(array $soapOptions): GlobalAuthenticationService
    {
        $this->soapOptions = $soapOptions;

        return $this;
    }

    public function getVerboseExceptionHandling(): bool
    {
        return $this->verboseExceptionHandling;
    }

    public function setVerboseExceptionHandling(bool $val): self
    {
        $this->verboseExceptionHandling = $val;

        return $this;
    }
}
