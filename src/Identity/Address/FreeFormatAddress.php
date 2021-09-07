<?php

declare(strict_types=1);

namespace ID3Global\Identity\Address;

use ID3Global\Identity\ID3IdentityObject;

class FreeFormatAddress extends ID3IdentityObject implements Address
{
    private ?string $Country = null;

    private ?string $ZipPostcode = null;

    private ?string $AddressLine1 = null;

    private ?string $AddressLine2 = null;

    private ?string $AddressLine3 = null;

    private ?string $AddressLine4 = null;

    private ?string $AddressLine5 = null;

    private ?string $AddressLine6 = null;

    private ?string $AddressLine7 = null;

    private ?string $AddressLine8 = null;

    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(?string $Country): FreeFormatAddress
    {
        $this->Country = $Country;

        return $this;
    }

    public function getPostCode(): ?string
    {
        return $this->ZipPostcode;
    }

    public function setPostCode(?string $PostCode): FreeFormatAddress
    {
        $this->ZipPostcode = $PostCode;

        return $this;
    }

    public function getAddressLine1(): ?string
    {
        return $this->AddressLine1;
    }

    /**
     * @param string|null $AddressLine1
     *?
     */
    public function setAddressLine1(?string $AddressLine1): FreeFormatAddress
    {
        $this->AddressLine1 = $AddressLine1;

        return $this;
    }

    public function getAddressLine2(): ?string
    {
        return $this->AddressLine2;
    }

    public function setAddressLine2(?string $AddressLine2): FreeFormatAddress
    {
        $this->AddressLine2 = $AddressLine2;

        return $this;
    }

    public function getAddressLine3(): ?string
    {
        return $this->AddressLine3;
    }

    public function setAddressLine3(?string $AddressLine3): FreeFormatAddress
    {
        $this->AddressLine3 = $AddressLine3;

        return $this;
    }

    public function getAddressLine4(): ?string
    {
        return $this->AddressLine4;
    }

    public function setAddressLine4(?string $AddressLine4): FreeFormatAddress
    {
        $this->AddressLine4 = $AddressLine4;

        return $this;
    }

    public function getAddressLine5(): ?string
    {
        return $this->AddressLine5;
    }

    public function setAddressLine5(?string $AddressLine5): FreeFormatAddress
    {
        $this->AddressLine5 = $AddressLine5;

        return $this;
    }

    public function getAddressLine6(): ?string
    {
        return $this->AddressLine6;
    }

    public function setAddressLine6(?string $AddressLine6): FreeFormatAddress
    {
        $this->AddressLine6 = $AddressLine6;

        return $this;
    }

    public function getAddressLine7(): ?string
    {
        return $this->AddressLine7;
    }

    public function setAddressLine7(?string $AddressLine7): FreeFormatAddress
    {
        $this->AddressLine7 = $AddressLine7;

        return $this;
    }

    public function getAddressLine8(): ?string
    {
        return $this->AddressLine8;
    }

    public function setAddressLine8(?string $AddressLine8): FreeFormatAddress
    {
        $this->AddressLine8 = $AddressLine8;

        return $this;
    }
}
