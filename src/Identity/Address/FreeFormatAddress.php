<?php
namespace ID3Global\Identity\Address;

use \ID3Global\Identity\ID3IdentityObject;

class FreeFormatAddress extends ID3IdentityObject implements Address {
    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $postCode;

    /**
     * @var string
     */
    private $addressLine1;

    /**
     * @var string
     */
    private $addressLine2;

    /**
     * @var string
     */
    private $addressLine3;

    /**
     * @var string
     */
    private $addressLine4;

    /**
     * @var string
     */
    private $addressLine5;

    /**
     * @var string
     */
    private $addressLine6;

    /**
     * @var string
     */
    private $addressLine7;

    /**
     * @var string
     */
    private $addressLine8;

    /**
     * @param string $country
     * @return FreeFormatAddress
     */
    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    /**
     * @param string $postCode
     * @return FreeFormatAddress
     */
    public function setPostCode($postCode) {
        $this->postCode = $postCode;
        return $this;
    }

    /**
     * @param string $addressLine1
     * @return FreeFormatAddress
     */
    public function setAddressLine1($addressLine1) {
        $this->addressLine1 = $addressLine1;
        return $this;
    }

    /**
     * @param string $addressLine2
     * @return FreeFormatAddress
     */
    public function setAddressLine2($addressLine2) {
        $this->addressLine2 = $addressLine2;
        return $this;
    }

    /**
     * @param string $addressLine3
     * @return FreeFormatAddress
     */
    public function setAddressLine3($addressLine3) {
        $this->addressLine3 = $addressLine3;
        return $this;
    }

    /**
     * @param string $addressLine4
     * @return FreeFormatAddress
     */
    public function setAddressLine4($addressLine4) {
        $this->addressLine4 = $addressLine4;
        return $this;
    }

    /**
     * @param string $addressLine5
     * @return FreeFormatAddress
     */
    public function setAddressLine5($addressLine5) {
        $this->addressLine5 = $addressLine5;
        return $this;
    }

    /**
     * @param string $addressLine6
     * @return FreeFormatAddress
     */
    public function setAddressLine6($addressLine6) {
        $this->addressLine6 = $addressLine6;
        return $this;
    }

    /**
     * @param string $addressLine7
     * @return FreeFormatAddress
     */
    public function setAddressLine7($addressLine7) {
        $this->addressLine7 = $addressLine7;
        return $this;
    }

    /**
     * @param string $addressLine8
     * @return FreeFormatAddress
     */
    public function setAddressLine8($addressLine8) {
        $this->addressLine8 = $addressLine8;
        return $this;
    }
}
