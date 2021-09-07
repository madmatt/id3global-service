<?php

declare(strict_types=1);

namespace ID3Global\Identity\Documents\NZ;

use ID3Global\Identity\ID3IdentityObject;

class DrivingLicence extends ID3IdentityObject
{
    /**
     * @var string|null The driver licence identifier/number (as indicated on the physical document)
     */
    private ?string $Number = null;

    /**
     * @var int|null The driver license version (as indicated on the physical document)
     */
    private ?int $Version = null;

    /**
     * @var string|null Vehicle registration/licence plate linked to this drivers licence
     */
    private ?string $VehicleRegistration = null;

    public function getNumber(): ?string
    {
        return $this->Number;
    }

    public function setNumber(?string $Number): DrivingLicence
    {
        $this->Number = $Number;

        return $this;
    }

    public function getVersion(): ?int
    {
        return $this->Version;
    }

    public function setVersion(?int $Version): DrivingLicence
    {
        $this->Version = $Version;

        return $this;
    }

    public function getVehicleRegistration(): ?string
    {
        return $this->VehicleRegistration;
    }

    public function setVehicleRegistration(?string $VehicleRegistration): DrivingLicence
    {
        $this->VehicleRegistration = $VehicleRegistration;

        return $this;
    }
}
