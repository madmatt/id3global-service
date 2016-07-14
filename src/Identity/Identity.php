<?php

namespace ID3Global\Identity;

class Identity {
    /**
     * @var string The const returned by the ID3Global API when this identity passed verification, according to the
     * ruleset used.
     */
    const IDENTITY_BAND_PASS = 'Name, Address &amp; DOB Match';

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
     * Minimum score to pass verification
     */
    const IDENTITY_SCORE_PASS = 2022;

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
     * @var \ID3Global\Identity\Documents\DocumentContainer
     */
    private $identityDocuments;

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

    /**
     * @return Documents\DocumentContainer
     */
    public function getIdentityDocuments()
    {
        return $this->identityDocuments;
    }

    /**
     * @param Documents\DocumentContainer $identityDocuments
     * @return Identity
     */
    public function setIdentityDocuments($identityDocuments)
    {
        $this->identityDocuments = $identityDocuments;
        return $this;
    }
}
