<?php

namespace ID3Global\Identity\ContactDetails;

class PhoneNumber
{
    /**
     * @var string
     */
    private string $number;

    public function __construct(string $number)
    {
        $this->number = $number;
    }

    /**
     * @param string $number
     *
     * @return PhoneNumber
     */
    public function setNumber(string $number): PhoneNumber
    {
        $this->number = $number;

        return $this;
    }
}
