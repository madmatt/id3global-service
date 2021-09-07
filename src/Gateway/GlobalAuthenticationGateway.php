<?php

declare(strict_types=1);

namespace ID3Global\Gateway;

use ID3Global\Gateway\Request\AuthenticateSPRequest;
use ID3Global\Identity\Identity;
use stdClass;

class GlobalAuthenticationGateway extends ID3GlobalBaseGateway
{
    public function AuthenticateSP(string $pId, int $pVer, ?string $customerReference, Identity $identity): stdClass
    {
        $request = new AuthenticateSPRequest();
        $request->setCustomerReference($customerReference);

        $profile = new stdClass();
        $profile->Version = $pVer;
        $profile->ID = $pId;
        $request->setProfileIDVersion($profile);

        $request->addFieldsFromIdentity($identity);

        return $this->getClient()->AuthenticateSP($request);
    }
}
