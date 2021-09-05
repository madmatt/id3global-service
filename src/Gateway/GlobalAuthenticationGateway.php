<?php

namespace ID3Global\Gateway;

use ID3Global\Gateway\Request\AuthenticateSPRequest;
use ID3Global\Identity\Identity;
use stdClass;

class GlobalAuthenticationGateway extends ID3GlobalBaseGateway
{
    public function AuthenticateSP(string $profileID, int $profileVersion, ?string $customerReference, Identity $identity)
    {
        $request = new AuthenticateSPRequest();
        $request->setCustomerReference($customerReference);

        $profile = new stdClass();
        $profile->Version = $profileVersion;
        $profile->ID = $profileID;
        $request->setProfileIDVersion($profile);

        $request->addFieldsFromIdentity($identity);

        return $this->getClient()->AuthenticateSP($request);
    }
}
