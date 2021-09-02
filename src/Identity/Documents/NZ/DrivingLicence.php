<?php

namespace ID3Global\Identity\Documents\NZ;

use ID3Global\Identity\ID3IdentityObject;

class DrivingLicence extends ID3IdentityObject
{
    /**
     * @var string|null The driver licence identifier
     */
    private ?string $Number = null;

    /**
     * @var int|null
     */
    private ?int $Version = null;

    /**
     * @var string|null Vehicle registration/licence plate linked to this drivers licence
     */
    private ?string $VehicleRegistration = null;

    /**
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->Number;
    }

    /**
     * @param string|null $Number
     *
     * @return DrivingLicence
     */
    public function setNumber(?string $Number): DrivingLicence
    {
        $this->Number = $Number;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getVersion(): ?int
    {
        return $this->Version;
    }

    /**
     * @param int|null $Version
     *
     * @return DrivingLicence
     */
    public function setVersion(?int $Version): DrivingLicence
    {
        $this->Version = $Version;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getVehicleRegistration(): ?string
    {
        return $this->VehicleRegistration;
    }

    /**
     * @param string|null $VehicleRegistration
     *
     * @return DrivingLicence
     */
    public function setVehicleRegistration(?string $VehicleRegistration): DrivingLicence
    {
        $this->VehicleRegistration = $VehicleRegistration;

        return $this;
    }
}
