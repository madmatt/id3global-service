<?php

namespace ID3Global\Identity\ContactDetails;

class PhoneNumber
{
    /**
     * @var string
     */
    private string $Number;

    public function __construct(string $number)
    {
        $this->Number = $number;
    }

    /**
     * @param string $Number
     *
     * @return PhoneNumber
     */
    public function setNumber(string $Number): PhoneNumber
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
