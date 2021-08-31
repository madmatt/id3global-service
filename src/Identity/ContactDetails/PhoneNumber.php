<?php

namespace ID3Global\Identity\ContactDetails;

class PhoneNumber
{
    /**
     * @var ?string
     */
    private ?string $Number;

    /**
     * @param ?string $Number
     *
     * @return PhoneNumber
     */
    public function setNumber(?string $Number): PhoneNumber
    {
        $this->Number = $Number;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->Number;
    }
}
