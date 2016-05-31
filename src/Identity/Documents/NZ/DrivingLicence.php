<?php
namespace ID3Global\Identity\Documents\NZ;

use ID3Global\Identity\ID3IdentityObject;

class DrivingLicence extends ID3IdentityObject
{
    /**
     * @var string The driver licence identifier
     */
    private $Number;

    /**
     * @var int
     */
    private $Version;

    /**
     * @var string Vehicle registration/licence plate linked to this drivers licence
     */
    private $VehicleRegistration;

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->Number;
    }

    /**
     * @param string $Number
     * @return DrivingLicence
     */
    public function setNumber($Number)
    {
        $this->Number = $Number;
        return $this;
    }

    /**
     * @return int
     */
    public function getVersion()
    {
        return $this->Version;
    }

    /**
     * @param int $Version
     * @return DrivingLicence
     */
    public function setVersion($Version)
    {
        $this->Version = $Version;
        return $this;
    }

    /**
     * @return string
     */
    public function getVehicleRegistration()
    {
        return $this->VehicleRegistration;
    }

    /**
     * @param string $VehicleRegistration
     * @return DrivingLicence
     */
    public function setVehicleRegistration($VehicleRegistration)
    {
        $this->VehicleRegistration = $VehicleRegistration;
        return $this;
    }
}
