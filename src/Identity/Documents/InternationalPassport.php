<?php
namespace ID3Global\Identity\Documents;

use ID3Global\Identity\ID3IdentityObject;

class InternationalPassport extends ID3IdentityObject
{
    /**
     * @var string The full unique passport identifier (varies by country)
     */
    private $Number;

    /**
     * @var string The short unique passport identifier (varies by country)
     */
    private $ShortPassportNumber;

    /**
     * @var int
     */
    private $ExpiryDay;

    /**
     * @var int
     */
    private $ExpiryMonth;

    /**
     * @var int
     */
    private $ExpiryYear;

    /**
     * @var int
     */
    private $IssueDay;

    /**
     * @var int
     */
    private $IssueMonth;

    /**
     * @var int
     */
    private $IssueYear;

    /**
     * @var string The full country name (e.g. "New Zealand", not "NZ") that this passport was issued by
     */
    private $CountryOfOrigin;

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->Number;
    }

    /**
     * @param string $Number
     * @return InternationalPassport
     */
    public function setNumber($Number)
    {
        $this->Number = $Number;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortPassportNumber()
    {
        return $this->ShortPassportNumber;
    }

    /**
     * @param string $ShortPassportNumber
     * @return InternationalPassport
     */
    public function setShortPassportNumber($ShortPassportNumber)
    {
        $this->ShortPassportNumber = $ShortPassportNumber;
        return $this;
    }

    /**
     * @return int
     */
    public function getExpiryDay()
    {
        return $this->ExpiryDay;
    }

    /**
     * @param int $ExpiryDay
     * @return InternationalPassport
     */
    public function setExpiryDay($ExpiryDay)
    {
        $this->ExpiryDay = $ExpiryDay;
        return $this;
    }

    /**
     * @return int
     */
    public function getExpiryMonth()
    {
        return $this->ExpiryMonth;
    }

    /**
     * @param int $ExpiryMonth
     * @return InternationalPassport
     */
    public function setExpiryMonth($ExpiryMonth)
    {
        $this->ExpiryMonth = $ExpiryMonth;
        return $this;
    }

    /**
     * @return int
     */
    public function getExpiryYear()
    {
        return $this->ExpiryYear;
    }

    /**
     * @param int $ExpiryYear
     * @return InternationalPassport
     */
    public function setExpiryYear($ExpiryYear)
    {
        $this->ExpiryYear = $ExpiryYear;
        return $this;
    }

    /**
     * @return int
     */
    public function getIssueDay()
    {
        return $this->IssueDay;
    }

    /**
     * @param int $IssueDay
     * @return InternationalPassport
     */
    public function setIssueDay($IssueDay)
    {
        $this->IssueDay = $IssueDay;
        return $this;
    }

    /**
     * @return int
     */
    public function getIssueMonth()
    {
        return $this->IssueMonth;
    }

    /**
     * @param int $IssueMonth
     * @return InternationalPassport
     */
    public function setIssueMonth($IssueMonth)
    {
        $this->IssueMonth = $IssueMonth;
        return $this;
    }

    /**
     * @return int
     */
    public function getIssueYear()
    {
        return $this->IssueYear;
    }

    /**
     * @param int $IssueYear
     * @return InternationalPassport
     */
    public function setIssueYear($IssueYear)
    {
        $this->IssueYear = $IssueYear;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryOfOrigin()
    {
        return $this->CountryOfOrigin;
    }

    /**
     * @param string $CountryOfOrigin
     * @return InternationalPassport
     */
    public function setCountryOfOrigin($CountryOfOrigin)
    {
        $this->CountryOfOrigin = $CountryOfOrigin;
        return $this;
    }
}
