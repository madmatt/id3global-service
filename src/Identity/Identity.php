<?php

namespace ID3Global\Identity;

use ID3Global\Identity\Address\AddressContainer;
use ID3Global\Identity\Documents\DocumentContainer;

class Identity
{
    /**
     * @var string The const returned by the ID3Global API when this identity passed verification, according to the
     *             ruleset used.
     */
    const IDENTITY_BAND_PASS = 'PASS';

    /**
     * @var string The const returned by the ID3Global API when this identity needs additional referral, according to
     *             the ruleset used.
     */
    const IDENTITY_BAND_REFER = 'REFER';

    /**
     * The const returned by the ID3Global API when this identity needs additional referral, according to
     * the ruleset used.
     */
    const IDENTITY_BAND_ALERT = 'ALERT';

    /**
     * @var PersonalDetails|null
     */
    private ?PersonalDetails $personalDetails = null;

    /**
     * @var ContactDetails|null
     */
    private ?ContactDetails $contactDetails = null;

    /**
     * @var AddressContainer|null
     */
    private ?AddressContainer $addresses = null;

    /**
     * @var DocumentContainer|null
     */
    private ?DocumentContainer $identityDocuments = null;

    /**
     * @param PersonalDetails $personalDetails
     *
     * @return Identity
     */
    public function setPersonalDetails(PersonalDetails $personalDetails): Identity
    {
        $this->personalDetails = $personalDetails;

        return $this;
    }

    public function getPersonalDetails(): ?PersonalDetails
    {
        return $this->personalDetails;
    }

    /**
     * @param ContactDetails $contactDetails
     *
     * @return Identity
     */
    public function setContactDetails(ContactDetails $contactDetails): Identity
    {
        $this->contactDetails = $contactDetails;

        return $this;
    }

    /**
     * @return ContactDetails|null
     */
    public function getContactDetails(): ?ContactDetails
    {
        return $this->contactDetails;
    }

    /**
     * @param Address\AddressContainer $addresses
     *
     * @return Identity
     */
    public function setAddresses(AddressContainer $addresses): Identity
    {
        $this->addresses = $addresses;

        return $this;
    }

    public function getAddresses(): ?AddressContainer
    {
        return $this->addresses;
    }

    /**
     * @return DocumentContainer|null
     */
    public function getIdentityDocuments(): ?DocumentContainer
    {
        return $this->identityDocuments;
    }

    /**
     * @param Documents\DocumentContainer $identityDocuments
     *
     * @return Identity
     */
    public function setIdentityDocuments(DocumentContainer $identityDocuments): Identity
    {
        $this->identityDocuments = $identityDocuments;

        return $this;
    }
}
