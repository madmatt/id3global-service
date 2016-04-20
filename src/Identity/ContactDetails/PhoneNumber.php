<?php
namespace ID3Global\Identity\ContactDetails;

class PhoneNumber {
    /**
     * @var string
     */
    private $number;

    /**
     * @param string $number
     * @return PhoneNumber
     */
    public function setNumber($number) {
        $this->number = $number;
        return $this;
    }
}
