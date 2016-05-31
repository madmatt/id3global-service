<?php
namespace ID3Global\Identity\Address;

use ID3Global\Identity\ID3IdentityObject;

class AddressContainer extends ID3IdentityObject {
    /**
     * @var Address Either a FixedFormatAddress or FreeFormatAddress object (default null)
     */
    private $currentAddress;

    public function setCurrentAddress(Address $address) {
        $this->currentAddress = $address;
        return $this;
    }

    public function getCurrentAddress()
    {
        return $this->currentAddress;
    }
}
