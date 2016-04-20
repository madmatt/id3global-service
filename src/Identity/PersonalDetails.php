<?php
namespace ID3Global\Identity;

use \DateTime;

class PersonalDetails {
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $foreName;

    /**
     * @var string
     */
    private $middleName;

    /**
     * @var string
     */
    private $surname;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var DateTime
     */
    private $dateOfBirth;

    /**
     * @param string $title
     * @return PersonalDetails
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $foreName
     * @return PersonalDetails
     */
    public function setForeName($foreName) {
        $this->foreName = $foreName;
        return $this;
    }

    /**
     * @param string $middleName
     * @return PersonalDetails
     */
    public function setMiddleName($middleName) {
        $this->middleName = $middleName;
        return $this;
    }

    /**
     * @param string $surname
     * @return PersonalDetails
     */
    public function setSurname($surname) {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @param string $gender
     * @return PersonalDetails
     */
    public function setGender($gender) {
        $this->gender = $gender;
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

        return $this;
    }
}
