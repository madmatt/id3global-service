<?php

namespace ID3Global\Identity\Address;

use ID3Global\Identity\ID3IdentityObject;

class FreeFormatAddress extends ID3IdentityObject implements Address
{
    /**
     * @var string|null
     */
    private ?string $Country = null;

    /**
     * @var string|null
     */
    private ?string $ZipPostcode = null;

    /**
     * @var string|null
     */
    private ?string $AddressLine1 = null;

    /**
     * @var string|null
     */
    private ?string $AddressLine2 = null;

    /**
     * @var string|null
     */
    private ?string $AddressLine3 = null;

    /**
     * @var string|null
     */
    private ?string $AddressLine4 = null;

    /**
     * @var string|null
     */
    private ?string $AddressLine5 = null;

    /**
     * @var string|null
     */
    private ?string $AddressLine6 = null;

    /**
     * @var string|null
     */
    private ?string $AddressLine7 = null;

    /**
     * @var string|null
     */
    private ?string $AddressLine8 = null;

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->Country;
    }

    /**
     * @param string|null $Country
     *
     * @return FreeFormatAddress
     */
    public function setCountry(?string $Country): FreeFormatAddress
    {
        $this->Country = $Country;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPostCode(): ?string
    {
        return $this->ZipPostcode;
    }

    /**
     * @param string|null $PostCode
     *
     * @return FreeFormatAddress
     */
    public function setPostCode(?string $PostCode): FreeFormatAddress
    {
        $this->ZipPostcode = $PostCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressLine1(): ?string
    {
        return $this->AddressLine1;
    }

    /**
     * @param string|null $AddressLine1
     *?
     *
     * @return FreeFormatAddress
     */
    public function setAddressLine1(?string $AddressLine1): FreeFormatAddress
    {
        $this->AddressLine1 = $AddressLine1;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressLine2(): ?string
    {
        return $this->AddressLine2;
    }

    /**
     * @param string|null $AddressLine2
     *
     * @return FreeFormatAddress
     */
    public function setAddressLine2(?string $AddressLine2): FreeFormatAddress
    {
        $this->AddressLine2 = $AddressLine2;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressLine3(): ?string
    {
        return $this->AddressLine3;
    }

    /**
     * @param string|null $AddressLine3
     *
     * @return FreeFormatAddress
     */
    public function setAddressLine3(?string $AddressLine3): FreeFormatAddress
    {
        $this->AddressLine3 = $AddressLine3;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressLine4(): ?string
    {
        return $this->AddressLine4;
    }

    /**
     * @param string|null $AddressLine4
     *
     * @return FreeFormatAddress
     */
    public function setAddressLine4(?string $AddressLine4): FreeFormatAddress
    {
        $this->AddressLine4 = $AddressLine4;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressLine5(): ?string
    {
        return $this->AddressLine5;
    }

    /**
     * @param string|null $AddressLine5
     *
     * @return FreeFormatAddress
     */
    public function setAddressLine5(?string $AddressLine5): FreeFormatAddress
    {
        $this->AddressLine5 = $AddressLine5;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressLine6(): ?string
    {
        return $this->AddressLine6;
    }

    /**
     * @param string|null $AddressLine6
     *
     * @return FreeFormatAddress
     */
    public function setAddressLine6(?string $AddressLine6): FreeFormatAddress
    {
        $this->AddressLine6 = $AddressLine6;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressLine7(): ?string
    {
        return $this->AddressLine7;
    }

    /**
     * @param string|null $AddressLine7
     *
     * @return FreeFormatAddress
     */
    public function setAddressLine7(?string $AddressLine7): FreeFormatAddress
    {
        $this->AddressLine7 = $AddressLine7;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressLine8(): ?string
    {
        return $this->AddressLine8;
    }

    /**
     * @param string|null $AddressLine8
     *
     * @return FreeFormatAddress
     */
    public function setAddressLine8(?string $AddressLine8): FreeFormatAddress
    {
        $this->AddressLine8 = $AddressLine8;

        return $this;
    }
}
