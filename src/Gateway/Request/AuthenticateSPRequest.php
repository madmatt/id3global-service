<?php
namespace ID3Global\Gateway\Request;

use ID3Global\Identity\Address\Address,
    \ID3Global\Identity\Identity;

class AuthenticateSPRequest {
    public $CustomerReference;

    public $ProfileIDVersion;

    public $InputData;

    public function addFieldsFromIdentity(Identity $identity) {
        $this->InputData = new \stdClass();

        $this->addPersonalDetails($identity);
        $this->addAddresses($identity);

    }

    private function addPersonalDetails(Identity $identity) {
        $this->InputData->Personal = new \stdClass();
        $personalDetails = $identity->getPersonalDetails();

        if(is_a($personalDetails, '\ID3Global\Identity\PersonalDetails')) {
            $this->InputData->Personal->PersonalDetails = $personalDetails;
        }
    }

    private function addAddresses(Identity $identity) {
        $this->InputData->Addresses = new \stdClass();
        $addresses = $identity->getAddresses();

        if(is_a($addresses, '\ID3Global\Identity\Address\AddressContainer')) {
            $currentAddress = $addresses->getCurrentAddress();

            if($currentAddress instanceof Address) {
                $this->InputData->Addresses->CurrentAddress = $currentAddress;
            }
        }
    }
}
