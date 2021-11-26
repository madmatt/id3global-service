<?php

declare(strict_types=1);

namespace ID3Global\Identity\ContactDetails;

class PhoneNumber
{
    private ?string $Number;

    public function setNumber(?string $Number): PhoneNumber
    {
        $this->Number = $Number;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->Number;
    }
}
