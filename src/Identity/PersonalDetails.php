<?php

declare(strict_types=1);

namespace ID3Global\Identity;

use DateTime;

class PersonalDetails extends ID3IdentityObject
{
    /**
     * @var string|null The 'title' for this person e.g. Mr, Mrs, Dr. Can only be null when verifying a UK identity.
     * @see https://bit.ly/3zPzUp6+
     */
    private ?string $Title = null;

    /**
     * @var string|null The first name for the specified identity. Can only be null when verifying a UK identity.
     * @see https://bit.ly/3zPzUp6+
     */
    private ?string $Forename = null;

    /**
     * @var string|null The middle name for the specified identity. Can be null if the person has no middle name(s).
     */
    private ?string $MiddleName = null;

    /**
     * @var string|null The surname/last name for the specified identity. Can only be null when verifying a UK identity.
     */
    private ?string $Surname = null;

    /**
     * @var string|null The gender for the specified identity. Can be 'Female', 'Male', 'Unknown' or 'Unspecified'. Can
     * only be null when verifying a UK identity.
     */
    private ?string $Gender = null;

    /**
     * @var DateTime|null The full date of birth for the specified identity.
     */
    private ?DateTime $dateOfBirth = null;

    /**
     * @var int|null The day (e.g. 1, 15, 31) the person was born on (similar to $this->dateOfBirth, but just the value
     * as the ID3global API expects it in a singluar field).
     */
    private ?int $DOBDay = null;

    /**
     * @var int|null The month (e.g. 1, 5, 12) the person was born in (similar to $this->dateOfBirth, but just the value
     * as the ID3global API expects it in a singluar field).
     */
    private ?int $DOBMonth = null;

    /**
     * @var int|null The year (e.g. 1995) the person was born in (similar to $this->dateOfBirth, but just the value as
     * the ID3global API expects it in a singluar field).
     */
    private ?int $DOBYear = null;

    /**
     * @var string|null The country of birth for the specified identity (e.g. 'New Zealand', 'Austria' etc)
     */
    private ?string $CountryOfBirth = null;

    public function setTitle(?string $title): PersonalDetails
    {
        $this->Title = $title;

        return $this;
    }

    public function setForename(?string $forename): PersonalDetails
    {
        $this->Forename = $forename;

        return $this;
    }

    public function setMiddleName(?string $middleName): PersonalDetails
    {
        $this->MiddleName = $middleName;

        return $this;
    }

    public function setSurname(?string $surname): PersonalDetails
    {
        $this->Surname = $surname;

        return $this;
    }

    public function setGender(?string $gender): PersonalDetails
    {
        $this->Gender = $gender;

        return $this;
    }

    /**
     * Sets the date of birth for the specified identity. Populates both the 'dateOfBirth' (DateTime) field, as well as
     * the individual DOBDay, DOBMonth and DOBYear fields that are actually submitted to the ID3global API.
     *
     * @param DateTime|null $birthday The date of birth for the specified identity.
     * @return self
     */
    public function setDateOfBirth(?DateTime $birthday): PersonalDetails
    {
        if ($birthday === null) {
            return $this;
        }

        $this->dateOfBirth = $birthday;

        $this->DOBDay = (int)$birthday->format('d') ?? null;
        $this->DOBMonth = (int)$birthday->format('m') ?? null;
        $this->DOBYear = (int)$birthday->format('Y') ?? null;

        return $this;
    }

    public function setCountryOfBirth(?string $CountryOfBirth): PersonalDetails
    {
        $this->CountryOfBirth = $CountryOfBirth;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function getForename(): ?string
    {
        return $this->Forename;
    }

    public function getMiddleName(): ?string
    {
        return $this->MiddleName;
    }

    public function getSurname(): ?string
    {
        return $this->Surname;
    }

    public function getGender(): ?string
    {
        return $this->Gender;
    }

    public function getDateOfBirth(): ?DateTime
    {
        return $this->dateOfBirth;
    }

    public function getDOBDay(): ?int
    {
        return $this->DOBDay;
    }

    public function getDOBMonth(): ?int
    {
        return $this->DOBMonth;
    }

    public function getDOBYear(): ?int
    {
        return $this->DOBYear;
    }

    public function getCountryOfBirth(): ?string
    {
        return $this->CountryOfBirth;
    }
}
