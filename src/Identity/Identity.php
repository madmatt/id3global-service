<?php

namespace ID3Global\Identity;

class Identity {
    /**
     * @var string The const returned by the ID3Global API when this identity passed verification, according to the
     * ruleset used.
     */
    const IDENTITY_BAND_PASS = 'Pass';

    /**
     * @var string The const returned by the ID3Global API when this identity needs additional referral, according to
     * the ruleset used.
     */
    const IDENTITY_BAND_REFER = 'Refer';

    /**
     * The const returned by the ID3Global API when this identity needs additional referral, according to
     * the ruleset used.
     */
    const IDENTITY_BAND_ALERT = 'Alert';

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
     * @return Identity
     */
    public function setPersonalDetails($personalDetails)
    {
        $this->personalDetails = $personalDetails;
        return $this;
    }

    public function getPersonalDetails() {
        return $this->personalDetails;
    }

    /**
     * @param ContactDetails $contactDetails
     * @return Identity
     */
    public function setContactDetails($contactDetails)
    {
        $this->contactDetails = $contactDetails;
        return $this;
    }

    /**
     * @param Address\AddressContainer $addresses
     * @return Identity
     */
    public function setAddresses($addresses)
    {
        $this->addresses = $addresses;
        return $this;
    }

    public function getAddresses() {
        return $this->addresses;
    }
}
