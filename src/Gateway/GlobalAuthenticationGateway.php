<?php
namespace ID3Global\Gateway;

use ID3Global\Identity\Identity,
    ID3Global\Gateway\Request\AuthenticateSPRequest;
use InvalidArgumentException;
use LogicException;
use stdClass;

class GlobalAuthenticationGateway extends ID3GlobalBaseGateway {
    public function AuthenticateSP($profileID, $profileVersion, $customerReference, Identity $identity) {
        if(!$profileID) {
            throw new InvalidArgumentException('No Profile ID has been defined when calling AuthenticateSP()');
        }

        if($profileVersion === null) {
            throw new LogicException('No Profile Version has been defined when calling AuthenticateSP()');
        }

        if(!$customerReference) {
            throw new LogicException('No Customer Reference has been defined when calling AuthenticateSP()');
        }

        if(!$identity || ! $identity instanceof Identity) {
            throw new LogicException('No or invalid Identity defined when calling AuthenticateSP()');
        }

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
