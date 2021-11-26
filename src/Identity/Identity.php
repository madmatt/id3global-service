<?php

declare(strict_types=1);

namespace ID3Global\Identity;

use ID3Global\Identity\Address\AddressContainer;
use ID3Global\Identity\Documents\DocumentContainer;

class Identity
{
    private ?PersonalDetails $personalDetails = null;

    private ?ContactDetails $contactDetails = null;

    private ?AddressContainer $addresses = null;

    private ?DocumentContainer $identityDocuments = null;

    public function setPersonalDetails(PersonalDetails $personalDetails): Identity
    {
        $this->personalDetails = $personalDetails;

        return $this;
    }

    public function getPersonalDetails(): ?PersonalDetails
    {
        return $this->personalDetails;
    }

    public function setContactDetails(ContactDetails $contactDetails): Identity
    {
        $this->contactDetails = $contactDetails;

        return $this;
    }

    public function getContactDetails(): ?ContactDetails
    {
        return $this->contactDetails;
    }

    public function setAddresses(AddressContainer $addresses): Identity
    {
        $this->addresses = $addresses;

        return $this;
    }

    public function getAddresses(): ?AddressContainer
    {
        return $this->addresses;
    }

    public function getIdentityDocuments(): ?DocumentContainer
    {
        return $this->identityDocuments;
    }

    public function setIdentityDocuments(DocumentContainer $identityDocuments): Identity
    {
        $this->identityDocuments = $identityDocuments;

        return $this;
    }
}
