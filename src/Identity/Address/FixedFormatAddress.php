<?php
namespace ID3Global\Identity\Address;

use \ID3Global\Identity\ID3IdentityObject;

class FixedFormatAddress extends ID3IdentityObject implements Address {
    /**
     * @var string
     */
    private $Country;

    /**
     * @var string
     */
    private $Street;

    /**
     * @var string
     */
    private $SubStreet;

    /**
     * @var string
     */
    private $City;

    /**
     * @var string
     */
    private $SubCity;

    /**
     * @var string
     */
    private $StateDistrict;

    /**
     * @var string
     */
    private $Region;

    /**
     * @var string
     */
    private $Principality;

    /**
     * @var string
     */
    private $ZipPostcode;

    /**
     * @var string
     */
    private $Building;

    /**
     * @var string
     */
    private $SubBuilding;

    /**
     * @var string
     */
    private $Premise;

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->Country;
    }

    /**
     * @param string $country
     * @return FixedFormatAddress
     */
    public function setCountry($country)
    {
        $this->Country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->Street;
    }

    /**
     * @param string $street
     * @return FixedFormatAddress
     */
    public function setStreet($street)
    {
        $this->Street = $street;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubStreet()
    {
        return $this->SubStreet;
    }

    /**
     * @param string $subStreet
     * @return FixedFormatAddress
     */
    public function setSubStreet($subStreet)
    {
        $this->SubStreet = $subStreet;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->City;
    }

    /**
     * @param string $city
     * @return FixedFormatAddress
     */
    public function setCity($city)
    {
        $this->City = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubCity()
    {
        return $this->SubCity;
    }

    /**
     * @param string $subCity
     * @return FixedFormatAddress
     */
    public function setSubCity($subCity)
    {
        $this->SubCity = $subCity;
        return $this;
    }

    /**
     * @return string
     */
    public function getStateDistrict()
    {
        return $this->StateDistrict;
    }

    /**
     * @param string $stateDistrict
     * @return FixedFormatAddress
     */
    public function setStateDistrict($stateDistrict)
    {
        $this->StateDistrict = $stateDistrict;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->Region;
    }

    /**
     * @param string $region
     * @return FixedFormatAddress
     */
    public function setRegion($region)
    {
        $this->Region = $region;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrincipality()
    {
        return $this->Principality;
    }

    /**
     * @param string $principality
     * @return FixedFormatAddress
     */
    public function setPrincipality($principality)
    {
        $this->Principality = $principality;
        return $this;
    }

    /**
     * @return string
     */
    public function getZipPostcode()
    {
        return $this->ZipPostcode;
    }

    /**
     * @param string $zipPostcode
     * @return FixedFormatAddress
     */
    public function setZipPostcode($zipPostcode)
    {
        $this->ZipPostcode = $zipPostcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getBuilding()
    {
        return $this->Building;
    }

    /**
     * @param string $building
     * @return FixedFormatAddress
     */
    public function setBuilding($building)
    {
        $this->Building = $building;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubBuilding()
    {
        return $this->SubBuilding;
    }

    /**
     * @param string $subBuilding
     * @return FixedFormatAddress
     */
    public function setSubBuilding($subBuilding)
    {
        $this->SubBuilding = $subBuilding;
        return $this;
    }

    /**
     * @return string
     */
    public function getPremise()
    {
        return $this->Premise;
    }

    /**
     * @param string $premise
     * @return FixedFormatAddress
     */
    public function setPremise($premise)
    {
        $this->Premise = $premise;
        return $this;
    }
}
