<?php
namespace ID3Global\Identity\Documents\NZ;

use ID3Global\Identity\ID3IdentityObject;

class DrivingLicence extends ID3IdentityObject
{
    /**
     * @var string The driver licence identifier
     */
    private string $Number;

    /**
     * @var int
     */
    private int $Version;

    /**
     * @var string Vehicle registration/licence plate linked to this drivers licence
     */
    private string $VehicleRegistration;

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->Number;
    }

    /**
     * @param string $Number
     * @return DrivingLicence
     */
    public function setNumber(string $Number): DrivingLicence
    {
        $this->Number = $Number;
        return $this;
    }

    /**
     * @return int
     */
    public function getVersion(): int
    {
        return $this->Version;
    }

    /**
     * @param int $Version
     * @return DrivingLicence
     */
    public function setVersion(int $Version): DrivingLicence
    {
        $this->Version = $Version;
        return $this;
    }

    /**
     * @return string
     */
    public function getVehicleRegistration(): string
    {
        return $this->VehicleRegistration;
    }

    /**
     * @param string $VehicleRegistration
     * @return DrivingLicence
     */
    public function setVehicleRegistration(string $VehicleRegistration): DrivingLicence
    {
        $this->VehicleRegistration = $VehicleRegistration;
        return $this;
    }
}
