<?php
namespace ID3Global\Stubs\Gateway;

use ID3Global\Gateway\GlobalAuthenticationGateway,
    ID3Global\Identity\Identity;

class GlobalAuthenticationGatewayFake extends GlobalAuthenticationGateway {
    public function __construct($username, $password, $soapClientOptions = array(), $usePilotSite = false) {
        parent::__construct($username, $password, $soapClientOptions, $usePilotSite);
    }

    public function AuthenticateSP($profileID, $profileVersion, $customerReference, Identity $identity) {
        return unserialize('O:8:"stdClass":1:{s:20:"AuthenticateSPResult";O:8:"stdClass":12:{s:16:"AuthenticationID";s:36:"xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";s:9:"Timestamp";s:33:"2016-01-01T00:00:00.0000000+01:00";s:11:"CustomerRef";s:1:"x";s:9:"ProfileID";s:36:"xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";s:11:"ProfileName";s:15:"Default Profile";s:14:"ProfileVersion";i:1;s:15:"ProfileRevision";i:1;s:12:"ProfileState";s:9:"Effective";s:11:"ResultCodes";O:8:"stdClass":1:{s:26:"GlobalItemCheckResultCodes";a:0:{}}s:5:"Score";i:3000;s:8:"BandText";s:4:"Pass";s:7:"Country";s:11:"New Zealand";}}');
    }
}
