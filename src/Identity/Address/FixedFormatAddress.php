<?php

namespace ID3Global\Identity\Address;

use ID3Global\Identity\ID3IdentityObject;

class FixedFormatAddress extends ID3IdentityObject implements Address
{
    /**
     * @var string|null
     */
    private ?string $Country = null;

    /**
     * @var string|null
     */
    private ?string $Street = null;

    /**
     * @var string|null
     */
    private ?string $SubStreet = null;

    /**
     * @var string|null
     */
    private ?string $City = null;

    /**
     * @var string|null
     */
    private ?string $SubCity = null;

    /**
     * @var string|null
     */
    private ?string $StateDistrict = null;

    /**
     * @var string|null
     */
    private ?string $Region = null;

    /**
     * @var string|null
     */
    private ?string $Principality = null;

    /**
     * @var string|null
     */
    private ?string $ZipPostcode = null;

    /**
     * @var string|null
     */
    private ?string $Building = null;

    /**
     * @var string|null
     */
    private ?string $SubBuilding = null;

    /**
     * @var string|null
     */
    private ?string $Premise = null;

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->Country;
    }

    /**
     * @param string|null $country
     *
     * @return FixedFormatAddress
     */
    public function setCountry(?string $country): FixedFormatAddress
    {
        $this->Country = $country;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->Street;
    }

    /**
     * @param string|null $street
     *
     * @return FixedFormatAddress
     */
    public function setStreet(?string $street): FixedFormatAddress
    {
        $this->Street = $street;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubStreet(): ?string
    {
        return $this->SubStreet;
    }

    /**
     * @param string|null $subStreet
     *
     * @return FixedFormatAddress
     */
    public function setSubStreet(?string $subStreet): FixedFormatAddress
    {
        $this->SubStreet = $subStreet;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->City;
    }

    /**
     * @param string|null $city
     *
     * @return FixedFormatAddress
     */
    public function setCity(?string $city): FixedFormatAddress
    {
        $this->City = $city;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubCity(): ?string
    {
        return $this->SubCity;
    }

    /**
     * @param string|null $subCity
     *
     * @return FixedFormatAddress
     */
    public function setSubCity(?string $subCity): FixedFormatAddress
    {
        $this->SubCity = $subCity;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStateDistrict(): ?string
    {
        return $this->StateDistrict;
    }

    /**
     * @param string|null $stateDistrict
     *
     * @return FixedFormatAddress
     */
    public function setStateDistrict(?string $stateDistrict): FixedFormatAddress
    {
        $this->StateDistrict = $stateDistrict;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->Region;
    }

    /**
     * @param string|null $region
     *
     * @return FixedFormatAddress
     */
    public function setRegion(?string $region): FixedFormatAddress
    {
        $this->Region = $region;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrincipality(): ?string
    {
        return $this->Principality;
    }

    /**
     * @param string|null $principality
     *
     * @return FixedFormatAddress
     */
    public function setPrincipality(?string $principality): FixedFormatAddress
    {
        $this->Principality = $principality;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getZipPostcode(): ?string
    {
        return $this->ZipPostcode;
    }

    /**
     * @param string|null $zipPostcode
     *
     * @return FixedFormatAddress
     */
    public function setZipPostcode(?string $zipPostcode): FixedFormatAddress
    {
        $this->ZipPostcode = $zipPostcode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBuilding(): ?string
    {
        return $this->Building;
    }

    /**
     * @param string|null $building
     *
     * @return FixedFormatAddress
     */
    public function setBuilding(?string $building): FixedFormatAddress
    {
        $this->Building = $building;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubBuilding(): ?string
    {
        return $this->SubBuilding;
    }

    /**
     * @param string|null $subBuilding
     *
     * @return FixedFormatAddress
     */
    public function setSubBuilding(?string $subBuilding): FixedFormatAddress
    {
        $this->SubBuilding = $subBuilding;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPremise(): ?string
    {
        return $this->Premise;
    }

    /**
     * @param string|null $premise
     *
     * @return FixedFormatAddress
     */
    public function setPremise(?string $premise): FixedFormatAddress
    {
        $this->Premise = $premise;

        return $this;
    }
}
