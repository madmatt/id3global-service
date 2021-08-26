<?php

namespace ID3Global\Identity;

use DateTime;

class PersonalDetails extends ID3IdentityObject
{
    /**
     * @var string
     */
    private string $Title;

    /**
     * @var string
     */
    private string $Forename;

    /**
     * @var string
     */
    private string $MiddleName;

    /**
     * @var string
     */
    private string $Surname;

    /**
     * @var string
     */
    private string $Gender;

    /**
     * @var DateTime
     */
    private DateTime $dateOfBirth;

    /**
     * @var int
     */
    private int $DOBDay;

    /**
     * @var int
     */
    private int $DOBMonth;

    /**
     * @var int
     */
    private int $DOBYear;

    /**
     * @var string
     */
    private string $CountryOfBirth;

    /**
     * @param string $title
     *
     * @return PersonalDetails
     */
    public function setTitle(string $title): PersonalDetails
    {
        $this->Title = $title;

        return $this;
    }

    /**
     * @param string $forename
     *
     * @return PersonalDetails
     */
    public function setForename(string $forename): PersonalDetails
    {
        $this->Forename = $forename;

        return $this;
    }

    /**
     * @param string $middleName
     *
     * @return PersonalDetails
     */
    public function setMiddleName(string $middleName): PersonalDetails
    {
        $this->MiddleName = $middleName;

        return $this;
    }

    /**
     * @param string $surname
     *
     * @return PersonalDetails
     */
    public function setSurname(string $surname): PersonalDetails
    {
        $this->Surname = $surname;

        return $this;
    }

    /**
     * @param string $gender
     *
     * @return PersonalDetails
     */
    public function setGender(string $gender): PersonalDetails
    {
        $this->Gender = $gender;

        return $this;
    }

    /**
     * @param int $year
     * @param int $month
     * @param int $day
     *
     * @return PersonalDetails
     */
    public function setDateOfBirth(int $year, int $month, int $day): PersonalDetails
    {
        $date = new DateTime();
        $this->dateOfBirth = $date
            ->setDate($year, $month, $day)
            ->setTime(0, 0);

        $this->DOBDay = $day;
        $this->DOBMonth = $month;
        $this->DOBYear = $year;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->Title;
    }

    /**
     * @return string
     */
    public function getForename(): string
    {
        return $this->Forename;
    }

    /**
     * @return string
     */
    public function getMiddleName(): string
    {
        return $this->MiddleName;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->Surname;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->Gender;
    }

    /**
     * @return DateTime
     */
    public function getDateOfBirth(): DateTime
    {
        return $this->dateOfBirth;
    }

    /**
     * @return int
     */
    public function getDOBDay(): int
    {
        return $this->DOBDay;
    }

    /**
     * @return int
     */
    public function getDOBMonth(): int
    {
        return $this->DOBMonth;
    }

    /**
     * @return int
     */
    public function getDOBYear(): int
    {
        return $this->DOBYear;
    }

    /**
     * @return string
     */
    public function getCountryOfBirth(): string
    {
        return $this->CountryOfBirth;
    }

    /**
     * @param string $CountryOfBirth
     *
     * @return PersonalDetails
     */
    public function setCountryOfBirth(string $CountryOfBirth): PersonalDetails
    {
        $this->CountryOfBirth = $CountryOfBirth;

        return $this;
    }
}
