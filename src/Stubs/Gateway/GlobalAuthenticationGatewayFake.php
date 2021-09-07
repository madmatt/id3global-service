<?php

declare(strict_types=1);

namespace ID3Global\Stubs\Gateway;

use ID3Global\Gateway\GlobalAuthenticationGateway;
use ID3Global\Identity\Identity;
use stdClass;

class GlobalAuthenticationGatewayFake extends GlobalAuthenticationGateway
{
    public const IDENTITY_BAND_PASS = 'PASS';

    public const IDENTITY_BAND_REFER = 'REFER';

    public const IDENTITY_BAND_ALERT = 'ALERT';

    /**
     * @var string Allows overriding of the BandText returned from the fake AuthenticateSP call to ensure tests can
     * influence the code paths that the GlobalAuthenticationService class under test would take (e.g. returning an
     * exception or similar).
     */
    private string $bandText = self::IDENTITY_BAND_PASS;

    private int $score = 3000;

    /**
     * @inheritDoc
     */
    public function __construct($username, $password, $soapClientOptions = [], $usePilotSite = false)
    {
        parent::__construct($username, $password, $soapClientOptions, $usePilotSite);
    }

    /**
     * Sets a custom BandText to be returned whenever AuthenticateSP is called.
     */
    public function setBandText(string $bandText): self
    {
        $this->bandText = $bandText;

        return $this;
    }

    /**
     * Sets a custom Score to be returned whenever AuthenticateSP is called.
     */
    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    /**
     * @inheritDoc
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
     */
    public function AuthenticateSP(string $pId, int $pVer, ?string $customerReference, Identity $identity): stdClass
    {
        $result = 'O:8:"stdClass":1:{s:20:"AuthenticateSPResult";O:8:"stdClass":12:{s:16:"AuthenticationID";s:36:"'
            . 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";s:9:"Timestamp";s:33:"2016-01-01T00:00:00.0000000+01:00";s:11:"'
            . 'CustomerRef";s:%d:"%s";s:9:"ProfileID";s:%d:"%s";s:11:"ProfileName";s:15:"Default Profile";s:14:"'
            . 'ProfileVersion";i:%d;s:15:"ProfileRevision";i:1;s:12:"ProfileState";s:9:"Effective";s:11:"ResultCodes";'
            . 'O:8:"stdClass":1:{s:26:"GlobalItemCheckResultCodes";a:0:{}}s:5:"Score";i:%d;s:8:"BandText";s:%d:"%s";s:7'
            . ':"Country";s:11:"New Zealand";}}';

        return unserialize(sprintf(
            $result,
            $customerReference ? strlen($customerReference) : 0,
            $customerReference,
            strlen($pId),
            $pId,
            $pVer,
            $this->score,
            strlen($this->bandText),
            $this->bandText
        ));
    }
}
