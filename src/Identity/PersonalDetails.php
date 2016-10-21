<?php
namespace ID3Global\Identity;

use \DateTime;

class PersonalDetails extends ID3IdentityObject {
    /**
     * @var string
     */
    private $Title;

    /**
     * @var string
     */
    private $Forename;

    /**
     * @var string
     */
    private $MiddleName;

    /**
     * @var string
     */
    private $Surname;

    /**
     * @var string
     */
    private $Gender;

    /**
     * @var DateTime
     */
    private $dateOfBirth;

    /**
     * @var int
     */
    private $DOBDay;

    /**
     * @var int
     */
    private $DOBMonth;

    /**
     * @var int
     */
    private $DOBYear;

    /**
     * @var string
     */
    private $CountryOfBirth;

    /**
     * @param string $title
     * @return PersonalDetails
     */
    public function setTitle($title) {
        $this->Title = $title;
        return $this;
    }

    /**
     * @param string $forename
     * @return PersonalDetails
     */
    public function setForename($forename) {
        $this->Forename = $forename;
        return $this;
    }

    /**
     * @param string $middleName
     * @return PersonalDetails
     */
    public function setMiddleName($middleName) {
        $this->MiddleName = $middleName;
        return $this;
    }

    /**
     * @param string $surname
     * @return PersonalDetails
     */
    public function setSurname($surname) {
        $this->Surname = $surname;
        return $this;
    }

    /**
     * @param string $gender
     * @return PersonalDetails
     */
    public function setGender($gender) {
        $this->Gender = $gender;
        return $this;
    }

    /**
     * @param int $year
     * @param int $month
     * @param int $day
     * @return PersonalDetails
     */
    public function setDateOfBirth($year, $month, $day) {
        $date = new DateTime();
        $this->dateOfBirth = $date
            ->setDate($year, $month, $day)
            ->setTime(0, 0, 0);

        $this->DOBDay = $day;
        $this->DOBMonth = $month;
        $this->DOBYear = $year;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->Title;
    }

    /**
     * @return string
     */
    public function getForename()
    {
        return $this->Forename;
    }

    /**
     * @return string
     */
    public function getMiddleName()
    {
        return $this->MiddleName;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->Surname;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->Gender;
    }

    /**
     * @return DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @return int
     */
    public function getDOBDay()
    {
        return $this->DOBDay;
    }

    /**
     * @return int
     */
    public function getDOBMonth()
    {
        return $this->DOBMonth;
    }

    /**
     * @return int
     */
    public function getDOBYear()
    {
        return $this->DOBYear;
    }

    /**
     * @return string
     */
    public function getCountryOfBirth()
    {
        return $this->CountryOfBirth;
    }

    /**
     * @param string $CountryOfBirth
     */
    public function setCountryOfBirth($CountryOfBirth)
    {
        $this->CountryOfBirth = $CountryOfBirth;

        return $this;
    }


}
