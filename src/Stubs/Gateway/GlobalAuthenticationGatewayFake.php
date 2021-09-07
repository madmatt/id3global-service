<?php

namespace ID3Global\Stubs\Gateway;

use ID3Global\Gateway\GlobalAuthenticationGateway;
use ID3Global\Identity\Identity;

class GlobalAuthenticationGatewayFake extends GlobalAuthenticationGateway
{
    /**
     * @var string A BandText value returned by the ID3global API when this identity passed verification, according to
     *             the selected profile.
     */
    const IDENTITY_BAND_PASS = 'PASS';

    /**
     * @var string A BandText value returned by the ID3global API when this identity needs additional referral,
     *             according to the selected profile.
     */
    const IDENTITY_BAND_REFER = 'REFER';

    /**
     * @var string A BandText value returned by the ID3global API when this identity has a significant issue, according
     *             to the selected profile.
     */
    const IDENTITY_BAND_ALERT = 'ALERT';

    private string $bandText = self::IDENTITY_BAND_PASS;

    private int $score = 3000;

    public function __construct($username, $password, $soapClientOptions = [], $usePilotSite = false)
    {
        parent::__construct($username, $password, $soapClientOptions, $usePilotSite);
    }

    /**
     * @param string $bandText
     *
     * @return GlobalAuthenticationGatewayFake
     */
    public function setBandText(string $bandText): GlobalAuthenticationGatewayFake
    {
        $this->bandText = $bandText;

        return $this;
    }

    /**
     * @param int $score
     *
     * @return GlobalAuthenticationGatewayFake
     */
    public function setScore(int $score): GlobalAuthenticationGatewayFake
    {
        $this->score = $score;

        return $this;
    }

    public function AuthenticateSP(string $profileID, int $profileVersion, ?string $customerReference, Identity $identity)
    {
        return unserialize(sprintf(
            'O:8:"stdClass":1:{s:20:"AuthenticateSPResult";O:8:"stdClass":12:{s:16:"AuthenticationID";s:36:"xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";s:9:"Timestamp";s:33:"2016-01-01T00:00:00.0000000+01:00";s:11:"CustomerRef";s:%d:"%s";s:9:"ProfileID";s:%d:"%s";s:11:"ProfileName";s:15:"Default Profile";s:14:"ProfileVersion";i:%d;s:15:"ProfileRevision";i:1;s:12:"ProfileState";s:9:"Effective";s:11:"ResultCodes";O:8:"stdClass":1:{s:26:"GlobalItemCheckResultCodes";a:0:{}}s:5:"Score";i:%d;s:8:"BandText";s:%d:"%s";s:7:"Country";s:11:"New Zealand";}}',
            strlen($customerReference),
            $customerReference,
            strlen($profileID),
            $profileID,
            $profileVersion,
            $this->score,
            strlen($this->bandText),
            $this->bandText
        ));
    }
}
