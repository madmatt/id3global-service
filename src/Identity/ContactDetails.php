<?php
namespace ID3Global\Identity;

use ID3Global\Identity\ContactDetails\PhoneNumber;

class ContactDetails {
    /**
     * @var PhoneNumber
     */
    private PhoneNumber $landPhone;

    /**
     * @var PhoneNumber
     */
    private PhoneNumber $mobilePhone;

    /**
     * @var PhoneNumber
     */
    private PhoneNumber $workPhone;

    /**
     * @var string
     */
    private string $email;

    /**
     * @param PhoneNumber $landPhone
     * @return ContactDetails
     */
    public function setLandPhone(PhoneNumber $landPhone): ContactDetails
    {
        $this->landPhone = $landPhone;
        return $this;
    }

    /**
     * @param PhoneNumber $mobilePhone
     * @return ContactDetails
     */
    public function setMobilePhone(PhoneNumber $mobilePhone): ContactDetails
    {
        $this->mobilePhone = $mobilePhone;
        return $this;
    }

    /**
     * @param PhoneNumber $workPhone
     * @return ContactDetails
     */
    public function setWorkPhone(PhoneNumber $workPhone): ContactDetails
    {
        $this->workPhone = $workPhone;
        return $this;
    }

    /**
     * @param string $email
     * @return ContactDetails
     */
    public function setEmail(string $email): ContactDetails
    {
        $this->email = $email;
        return $this;
    }
}
