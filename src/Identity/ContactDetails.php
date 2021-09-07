<?php

declare(strict_types=1);

namespace ID3Global\Identity;

use ID3Global\Identity\ContactDetails\PhoneNumber;

class ContactDetails
{
    private ?PhoneNumber $LandTelephone = null;

    private ?PhoneNumber $MobileTelephone = null;

    private ?PhoneNumber $WorkTelephone = null;

    private ?string $Email = null;

    public function getLandTelephone(): ?PhoneNumber
    {
        return $this->LandTelephone;
    }

    public function setLandTelephone(?PhoneNumber $LandTelephone): ContactDetails
    {
        $this->LandTelephone = $LandTelephone;

        return $this;
    }

    public function getMobileTelephone(): ?PhoneNumber
    {
        return $this->MobileTelephone;
    }

    public function setMobileTelephone(?PhoneNumber $MobileTelephone): ContactDetails
    {
        $this->MobileTelephone = $MobileTelephone;

        return $this;
    }

    public function getWorkTelephone(): ?PhoneNumber
    {
        return $this->WorkTelephone;
    }

    public function setWorkTelephone(?PhoneNumber $WorkTelephone): ContactDetails
    {
        $this->WorkTelephone = $WorkTelephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(?string $Email): ContactDetails
    {
        $this->Email = $Email;

        return $this;
    }
}
