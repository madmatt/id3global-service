<?php
namespace ID3Global\Identity\Address;

use ID3Global\Identity\ID3IdentityObject;

class AddressContainer extends ID3IdentityObject {
    /**
     * @var Address|null Either a FixedFormatAddress or FreeFormatAddress object (default null)
     */
    private ?Address $CurrentAddress = null;

    public function setCurrentAddress(Address $address): AddressContainer
    {
        $this->CurrentAddress = $address;
        return $this;
    }

    public function getCurrentAddress(): ?Address
    {
        return $this->CurrentAddress;
    }
}
