<?php

namespace ID3Global\Identity\Address;

use ID3Global\Identity\ID3IdentityObject;

class FixedFormatAddress extends ID3IdentityObject implements Address
{
    /**
     * @var string
     */
    private string $Country;

    /**
     * @var string
     */
    private string $Street;

    /**
     * @var string
     */
    private string $SubStreet;

    /**
     * @var string
     */
    private string $City;

    /**
     * @var string
     */
    private string $SubCity;

    /**
     * @var string
     */
    private string $StateDistrict;

    /**
     * @var string
     */
    private string $Region;

    /**
     * @var string
     */
    private string $Principality;

    /**
     * @var string
     */
    private string $ZipPostcode;

    /**
     * @var string
     */
    private string $Building;

    /**
     * @var string
     */
    private string $SubBuilding;

    /**
     * @var string
     */
    private string $Premise;

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->Country;
    }

    /**
     * @param string $country
     *
     * @return FixedFormatAddress
     */
    public function setCountry(string $country): FixedFormatAddress
    {
        $this->Country = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->Street;
    }

    /**
     * @param string $street
     *
     * @return FixedFormatAddress
     */
    public function setStreet(string $street): FixedFormatAddress
    {
        $this->Street = $street;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubStreet(): string
    {
        return $this->SubStreet;
    }

    /**
     * @param string $subStreet
     *
     * @return FixedFormatAddress
     */
    public function setSubStreet(string $subStreet): FixedFormatAddress
    {
        $this->SubStreet = $subStreet;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->City;
    }

    /**
     * @param string $city
     *
     * @return FixedFormatAddress
     */
    public function setCity(string $city): FixedFormatAddress
    {
        $this->City = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubCity(): string
    {
        return $this->SubCity;
    }

    /**
     * @param string $subCity
     *
     * @return FixedFormatAddress
     */
    public function setSubCity(string $subCity): FixedFormatAddress
    {
        $this->SubCity = $subCity;

        return $this;
    }

    /**
     * @return string
     */
    public function getStateDistrict(): string
    {
        return $this->StateDistrict;
    }

    /**
     * @param string $stateDistrict
     *
     * @return FixedFormatAddress
     */
    public function setStateDistrict(string $stateDistrict): FixedFormatAddress
    {
        $this->StateDistrict = $stateDistrict;

        return $this;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->Region;
    }

    /**
     * @param string $region
     *
     * @return FixedFormatAddress
     */
    public function setRegion(string $region): FixedFormatAddress
    {
        $this->Region = $region;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrincipality(): string
    {
        return $this->Principality;
    }

    /**
     * @param string $principality
     *
     * @return FixedFormatAddress
     */
    public function setPrincipality(string $principality): FixedFormatAddress
    {
        $this->Principality = $principality;

        return $this;
    }

    /**
     * @return string
     */
    public function getZipPostcode(): string
    {
        return $this->ZipPostcode;
    }

    /**
     * @param string $zipPostcode
     *
     * @return FixedFormatAddress
     */
    public function setZipPostcode(string $zipPostcode): FixedFormatAddress
    {
        $this->ZipPostcode = $zipPostcode;

        return $this;
    }

    /**
     * @return string
     */
    public function getBuilding(): string
    {
        return $this->Building;
    }

    /**
     * @param string $building
     *
     * @return FixedFormatAddress
     */
    public function setBuilding(string $building): FixedFormatAddress
    {
        $this->Building = $building;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubBuilding(): string
    {
        return $this->SubBuilding;
    }

    /**
     * @param string $subBuilding
     *
     * @return FixedFormatAddress
     */
    public function setSubBuilding(string $subBuilding): FixedFormatAddress
    {
        $this->SubBuilding = $subBuilding;

        return $this;
    }

    /**
     * @return string
     */
    public function getPremise(): string
    {
        return $this->Premise;
    }

    /**
     * @param string $premise
     *
     * @return FixedFormatAddress
     */
    public function setPremise(string $premise): FixedFormatAddress
    {
        $this->Premise = $premise;

        return $this;
    }
}
