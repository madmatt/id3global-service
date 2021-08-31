<?php

namespace ID3Global\Identity;

use ID3Global\Identity\ContactDetails\PhoneNumber;

class ContactDetails
{
    /**
     * @var PhoneNumber|null
     */
    private ?PhoneNumber $LandTelephone = null;

    /**
     * @var PhoneNumber|null
     */
    private ?PhoneNumber $MobileTelephone = null;

    /**
     * @var PhoneNumber|null
     */
    private ?PhoneNumber $WorkTelephone = null;

    /**
     * @var string|null
     */
    private ?string $Email = null;

    /**
     * @return PhoneNumber|null
     */
    public function getLandTelephone(): ?PhoneNumber
    {
        return $this->LandTelephone;
    }

    /**
     * @param PhoneNumber|null $LandTelephone
     *
     * @return ContactDetails
     */
    public function setLandTelephone(?PhoneNumber $LandTelephone): ContactDetails
    {
        $this->LandTelephone = $LandTelephone;

        return $this;
    }

    /**
     * @return PhoneNumber|null
     */
    public function getMobileTelephone(): ?PhoneNumber
    {
        return $this->MobileTelephone;
    }

    /**
     * @param PhoneNumber|null $MobileTelephone
     *
     * @return ContactDetails
     */
    public function setMobileTelephone(?PhoneNumber $MobileTelephone): ContactDetails
    {
        $this->MobileTelephone = $MobileTelephone;

        return $this;
    }

    /**
     * @return PhoneNumber|null
     */
    public function getWorkTelephone(): ?PhoneNumber
    {
        return $this->WorkTelephone;
    }

    /**
     * @param PhoneNumber|null $WorkTelephone
     *
     * @return ContactDetails
     */
    public function setWorkTelephone(?PhoneNumber $WorkTelephone): ContactDetails
    {
        $this->WorkTelephone = $WorkTelephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    /**
     * @param string|null $Email
     *
     * @return ContactDetails
     */
    public function setEmail(?string $Email): ContactDetails
    {
        $this->Email = $Email;

        return $this;
    }
}
