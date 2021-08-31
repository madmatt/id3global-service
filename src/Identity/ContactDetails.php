<?php

namespace ID3Global\Identity;

use ID3Global\Identity\ContactDetails\PhoneNumber;

class ContactDetails
{
    /**
     * @var PhoneNumber|null
     */
    private ?PhoneNumber $landPhone = null;

    /**
     * @var PhoneNumber|null
     */
    private ?PhoneNumber $mobilePhone = null;

    /**
     * @var PhoneNumber|null
     */
    private ?PhoneNumber $workPhone = null;

    /**
     * @var string|null
     */
    private ?string $email = null;

    /**
     * @param PhoneNumber|null $landPhone
     *
     * @return ContactDetails
     */
    public function setLandPhone(?PhoneNumber $landPhone): ContactDetails
    {
        $this->landPhone = $landPhone;

        return $this;
    }

    /**
     * @param PhoneNumber|null $mobilePhone
     *
     * @return ContactDetails
     */
    public function setMobilePhone(?PhoneNumber $mobilePhone): ContactDetails
    {
        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    /**
     * @param PhoneNumber|null $workPhone
     *
     * @return ContactDetails
     */
    public function setWorkPhone(?PhoneNumber $workPhone): ContactDetails
    {
        $this->workPhone = $workPhone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     *
     * @return ContactDetails
     */
    public function setEmail(?string $email): ContactDetails
    {
        $this->email = $email;

        return $this;
    }
}
