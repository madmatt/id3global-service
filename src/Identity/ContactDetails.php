<?php
namespace ID3Global\Identity;

use ID3Global\Identity\ContactDetails\PhoneNumber;

class ContactDetails {
    /**
     * @var PhoneNumber
     */
    private $landPhone;

    /**
     * @var PhoneNumber
     */
    private $mobilePhone;

    /**
     * @var PhoneNumber
     */
    private $workPhone;

    /**
     * @var string
     */
    private $email;

    /**
     * @param PhoneNumber $landPhone
     * @return ContactDetails
     */
    public function setLandPhone(PhoneNumber $landPhone)
    {
        $this->landPhone = $landPhone;
        return $this;
    }

    /**
     * @param PhoneNumber $mobilePhone
     * @return ContactDetails
     */
    public function setMobilePhone(PhoneNumber $mobilePhone)
    {
        $this->mobilePhone = $mobilePhone;
        return $this;
    }

    /**
     * @param PhoneNumber $workPhone
     * @return ContactDetails
     */
    public function setWorkPhone(PhoneNumber $workPhone)
    {
        $this->workPhone = $workPhone;
        return $this;
    }

    /**
     * @param string $email
     * @return ContactDetails
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
}
