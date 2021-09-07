<?php

declare(strict_types=1);

namespace ID3Global\Identity\Address;

use ID3Global\Identity\ID3IdentityObject;

class FixedFormatAddress extends ID3IdentityObject implements Address
{
    private ?string $Country = null;

    private ?string $Street = null;

    private ?string $SubStreet = null;

    private ?string $City = null;

    private ?string $SubCity = null;

    private ?string $StateDistrict = null;

    private ?string $Region = null;

    private ?string $Principality = null;

    private ?string $ZipPostcode = null;

    private ?string $Building = null;

    private ?string $SubBuilding = null;

    private ?string $Premise = null;

    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(?string $country): FixedFormatAddress
    {
        $this->Country = $country;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->Street;
    }

    public function setStreet(?string $street): FixedFormatAddress
    {
        $this->Street = $street;

        return $this;
    }

    public function getSubStreet(): ?string
    {
        return $this->SubStreet;
    }

    public function setSubStreet(?string $subStreet): FixedFormatAddress
    {
        $this->SubStreet = $subStreet;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(?string $city): FixedFormatAddress
    {
        $this->City = $city;

        return $this;
    }

    public function getSubCity(): ?string
    {
        return $this->SubCity;
    }

    public function setSubCity(?string $subCity): FixedFormatAddress
    {
        $this->SubCity = $subCity;

        return $this;
    }

    public function getStateDistrict(): ?string
    {
        return $this->StateDistrict;
    }

    public function setStateDistrict(?string $stateDistrict): FixedFormatAddress
    {
        $this->StateDistrict = $stateDistrict;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->Region;
    }

    public function setRegion(?string $region): FixedFormatAddress
    {
        $this->Region = $region;

        return $this;
    }

    public function getPrincipality(): ?string
    {
        return $this->Principality;
    }

    public function setPrincipality(?string $principality): FixedFormatAddress
    {
        $this->Principality = $principality;

        return $this;
    }

    public function getZipPostcode(): ?string
    {
        return $this->ZipPostcode;
    }

    public function setZipPostcode(?string $zipPostcode): FixedFormatAddress
    {
        $this->ZipPostcode = $zipPostcode;

        return $this;
    }

    public function getBuilding(): ?string
    {
        return $this->Building;
    }

    public function setBuilding(?string $building): FixedFormatAddress
    {
        $this->Building = $building;

        return $this;
    }

    public function getSubBuilding(): ?string
    {
        return $this->SubBuilding;
    }

    public function setSubBuilding(?string $subBuilding): FixedFormatAddress
    {
        $this->SubBuilding = $subBuilding;

        return $this;
    }

    public function getPremise(): ?string
    {
        return $this->Premise;
    }

    public function setPremise(?string $premise): FixedFormatAddress
    {
        $this->Premise = $premise;

        return $this;
    }
}
