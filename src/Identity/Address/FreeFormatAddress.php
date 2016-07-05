<?php
namespace ID3Global\Identity\Address;

use ID3Global\Identity\ID3IdentityObject;

class FreeFormatAddress extends ID3IdentityObject implements Address
{
    /**
     * @var string
     */
    private $Country;

    /**
     * @var string
     */
    private $ZipPostcode;

    /**
     * @var string
     */
    private $AddressLine1;

    /**
     * @var string
     */
    private $AddressLine2;

    /**
     * @var string
     */
    private $AddressLine3;

    /**
     * @var string
     */
    private $AddressLine4;

    /**
     * @var string
     */
    private $AddressLine5;

    /**
     * @var string
     */
    private $AddressLine6;

    /**
     * @var string
     */
    private $AddressLine7;

    /**
     * @var string
     */
    private $AddressLine8;

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->Country;
    }

    /**
     * @param string $Country
     * @return FreeFormatAddress
     */
    public function setCountry($Country)
    {
        $this->Country = $Country;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostCode()
    {
        return $this->ZipPostcode;
    }

    /**
     * @param string $PostCode
     * @return FreeFormatAddress
     */
    public function setPostCode($PostCode)
    {
        $this->ZipPostcode = $PostCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressLine1()
    {
        return $this->AddressLine1;
    }

    /**
     * @param string $AddressLine1
     * @return FreeFormatAddress
     */
    public function setAddressLine1($AddressLine1)
    {
        $this->AddressLine1 = $AddressLine1;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressLine2()
    {
        return $this->AddressLine2;
    }

    /**
     * @param string $AddressLine2
     * @return FreeFormatAddress
     */
    public function setAddressLine2($AddressLine2)
    {
        $this->AddressLine2 = $AddressLine2;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressLine3()
    {
        return $this->AddressLine3;
    }

    /**
     * @param string $AddressLine3
     * @return FreeFormatAddress
     */
    public function setAddressLine3($AddressLine3)
    {
        $this->AddressLine3 = $AddressLine3;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressLine4()
    {
        return $this->AddressLine4;
    }

    /**
     * @param string $AddressLine4
     * @return FreeFormatAddress
     */
    public function setAddressLine4($AddressLine4)
    {
        $this->AddressLine4 = $AddressLine4;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressLine5()
    {
        return $this->AddressLine5;
    }

    /**
     * @param string $AddressLine5
     * @return FreeFormatAddress
     */
    public function setAddressLine5($AddressLine5)
    {
        $this->AddressLine5 = $AddressLine5;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressLine6()
    {
        return $this->AddressLine6;
    }

    /**
     * @param string $AddressLine6
     * @return FreeFormatAddress
     */
    public function setAddressLine6($AddressLine6)
    {
        $this->AddressLine6 = $AddressLine6;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressLine7()
    {
        return $this->AddressLine7;
    }

    /**
     * @param string $AddressLine7
     * @return FreeFormatAddress
     */
    public function setAddressLine7($AddressLine7)
    {
        $this->AddressLine7 = $AddressLine7;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressLine8()
    {
        return $this->AddressLine8;
    }

    /**
     * @param string $AddressLine8
     * @return FreeFormatAddress
     */
    public function setAddressLine8($AddressLine8)
    {
        $this->AddressLine8 = $AddressLine8;
        return $this;
    }


}
