<?php

namespace ID3Global\Identity;

class IdentityContainer {
    /**
     * @var \ID3Global\Identity\PersonalDetails
     */
    private $personalDetails;

    /**
     * @var \ID3Global\Identity\ContactDetails
     */
    private $contactDetails;

    /**
     * @var \ID3Global\Identity\Address\AddressContainer
     */
    private $addresses;

    /**
     * @param PersonalDetails $personalDetails
     * @return IdentityContainer
     */
    public function setPersonalDetails($personalDetails)
    {
        $this->personalDetails = $personalDetails;
        return $this;
    }

    /**
     * @param ContactDetails $contactDetails
     * @return IdentityContainer
     */
    public function setContactDetails($contactDetails)
    {
        $this->contactDetails = $contactDetails;
        return $this;
    }

    /**
     * @param Address\AddressContainer $addresses
     * @return IdentityContainer
     */
    public function setAddresses($addresses)
    {
        $this->addresses = $addresses;
        return $this;
    }
}
