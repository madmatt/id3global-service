<?php
namespace ID3Global\Gateway;

use ID3Global\Identity\Identity,
    ID3Global\Gateway\Request\AuthenticateSPRequest;

class GlobalAuthenticationGateway extends ID3GlobalBaseGateway {
    public function AuthenticateSP($profileID, $profileVersion, $customerReference, Identity $identity) {
        if(!$profileID) {
            throw new \InvalidArgumentException('No Profile ID has been defined when calling AuthenticateSP()');
        }

        if($profileVersion === null) {
            throw new \LogicException('No Profile Version has been defined when calling AuthenticateSP()');
        }

        if(!$customerReference) {
            throw new \LogicException('No Customer Reference has been defined when calling AuthenticateSP()');
        }

        if(!$identity || !is_a($identity, 'ID3Global\Identity\Identity')) {
            throw new \LogicException('No or invalid Identity defined when calling AuthenticateSP()');
        }

        $request = new AuthenticateSPRequest();
        $request->CustomerReference = $customerReference;

        $request->ProfileIDVersion = new \stdClass();
        $request->ProfileIDVersion->Version = $profileVersion;
        $request->ProfileIDVersion->ID = $profileID;

        $request->addFieldsFromIdentity($identity);

        return $this->getClient()->AuthenticateSP($request);
    }
}
