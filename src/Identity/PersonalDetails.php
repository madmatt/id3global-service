<?php

namespace ID3Global\Identity;

use DateTime;

class PersonalDetails extends ID3IdentityObject
{
    /**
     * @var string|null
     */
    private ?string $Title = null;

    /**
     * @var string|null
     */
    private ?string $Forename = null;

    /**
     * @var string|null
     */
    private ?string $MiddleName = null;

    /**
     * @var string|null
     */
    private ?string $Surname = null;

    /**
     * @var string|null
     */
    private ?string $Gender = null;

    /**
     * @var DateTime|null
     */
    private ?DateTime $dateOfBirth = null;

    /**
     * @var int|null
     */
    private ?int $DOBDay = null;

    /**
     * @var int|null
     */
    private ?int $DOBMonth = null;

    /**
     * @var int|null
     */
    private ?int $DOBYear = null;

    /**
     * @var string|null
     */
    private ?string $CountryOfBirth = null;

    /**
     * @param string|null $title
     *
     * @return PersonalDetails
     */
    public function setTitle(?string $title): PersonalDetails
    {
        $this->Title = $title;

        return $this;
    }

    /**
     * @param string|null $forename
     *
     * @return PersonalDetails
     */
    public function setForename(?string $forename): PersonalDetails
    {
        $this->Forename = $forename;

        return $this;
    }

    /**
     * @param string|null $middleName
     *
     * @return PersonalDetails
     */
    public function setMiddleName(?string $middleName): PersonalDetails
    {
        $this->MiddleName = $middleName;

        return $this;
    }

    /**
     * @param string|null $surname
     *
     * @return PersonalDetails
     */
    public function setSurname(?string $surname): PersonalDetails
    {
        $this->Surname = $surname;

        return $this;
    }

    /**
     * @param string|null $gender
     *
     * @return PersonalDetails
     */
    public function setGender(?string $gender): PersonalDetails
    {
        $this->Gender = $gender;

        return $this;
    }

    /**
     * @param DateTime|null $birthday
     *
     * @return PersonalDetails
     */
    public function setDateOfBirth(?DateTime $birthday): PersonalDetails
    {
        $this->dateOfBirth = $birthday;

        $this->DOBDay = $birthday->format('d') ?? null;
        $this->DOBMonth = $birthday->format('m') ?? null;
        $this->DOBYear = $birthday->format('Y') ?? null;

        return $this;
    }

    /**
     * @param string|null $CountryOfBirth
     *
     * @return PersonalDetails
     */
    public function setCountryOfBirth(?string $CountryOfBirth): PersonalDetails
    {
        $this->CountryOfBirth = $CountryOfBirth;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->Title;
    }

    /**
     * @return string|null
     */
    public function getForename(): ?string
    {
        return $this->Forename;
    }

    /**
     * @return string|null
     */
    public function getMiddleName(): ?string
    {
        return $this->MiddleName;
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->Surname;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->Gender;
    }

    /**
     * @return DateTime|null
     */
    public function getDateOfBirth(): ?DateTime
    {
        return $this->dateOfBirth;
    }

    /**
     * @return int|null
     */
    public function getDOBDay(): ?int
    {
        return $this->DOBDay;
    }

    /**
     * @return int|null
     */
    public function getDOBMonth(): ?int
    {
        return $this->DOBMonth;
    }

    /**
     * @return int|null
     */
    public function getDOBYear(): ?int
    {
        return $this->DOBYear;
    }

    /**
     * @return string|null
     */
    public function getCountryOfBirth(): ?string
    {
        return $this->CountryOfBirth;
    }
}
