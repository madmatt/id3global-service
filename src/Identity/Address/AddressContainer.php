<?php
namespace ID3Global\Identity\Address;

use ID3Global\Identity\ID3IdentityObject;

class AddressContainer extends ID3IdentityObject {
    private $currentAddress;

    public function setCurrentAddress(Address $address) {
        $this->currentAddress = $address;
        return $this;
    }
}
