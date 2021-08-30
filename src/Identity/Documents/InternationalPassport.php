<?php

namespace ID3Global\Identity\Documents;

use ID3Global\Identity\ID3IdentityObject;

class InternationalPassport extends ID3IdentityObject
{
    /**
     * @var string|null The full unique passport identifier (varies by country)
     */
    private ?string $Number = null;

    /**
     * @var string|null The short unique passport identifier (varies by country)
     */
    private ?string $ShortPassportNumber = null;

    /**
     * @var int|null
     */
    private ?int $ExpiryDay = null;

    /**
     * @var int|null
     */
    private ?int $ExpiryMonth = null;

    /**
     * @var int|null
     */
    private ?int $ExpiryYear = null;

    /**
     * @var int|null
     */
    private ?int $IssueDay = null;

    /**
     * @var int|null
     */
    private ?int $IssueMonth = null;

    /**
     * @var int|null
     */
    private ?int $IssueYear = null;

    /**
     * @var string|null The full country name (e.g. "New Zealand", not "NZ") that this passport was issued by
     */
    private ?string $CountryOfOrigin = null;

    /**
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->Number;
    }

    /**
     * @param string|null $Number
     *
     * @return InternationalPassport
     */
    public function setNumber(?string $Number): InternationalPassport
    {
        $this->Number = $Number;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShortPassportNumber(): ?string
    {
        return $this->ShortPassportNumber;
    }

    /**
     * @param string|null $ShortPassportNumber
     *
     * @return InternationalPassport
     */
    public function setShortPassportNumber(?string $ShortPassportNumber): InternationalPassport
    {
        $this->ShortPassportNumber = $ShortPassportNumber;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getExpiryDay(): ?int
    {
        return $this->ExpiryDay;
    }

    /**
     * @param int|null $ExpiryDay
     *
     * @return InternationalPassport
     */
    public function setExpiryDay(?int $ExpiryDay): InternationalPassport
    {
        $this->ExpiryDay = $ExpiryDay;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getExpiryMonth(): ?int
    {
        return $this->ExpiryMonth;
    }

    /**
     * @param int|null $ExpiryMonth
     *
     * @return InternationalPassport
     */
    public function setExpiryMonth(?int $ExpiryMonth): InternationalPassport
    {
        $this->ExpiryMonth = $ExpiryMonth;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getExpiryYear(): ?int
    {
        return $this->ExpiryYear;
    }

    /**
     * @param int|null $ExpiryYear
     *
     * @return InternationalPassport
     */
    public function setExpiryYear(?int $ExpiryYear): InternationalPassport
    {
        $this->ExpiryYear = $ExpiryYear;

        return $this;
    }

    /**
     * @param int $year
     * @param int $month
     * @param int $day
     *
     * @return InternationalPassport
     */
    public function setExpiryDate(int $year, int $month, int $day): InternationalPassport
    {
        $this->setExpiryDay($day);
        $this->setExpiryMonth($month);
        $this->setExpiryYear($year);

        return $this;
    }

    /**
     * @return int|null
     */
    public function getIssueDay(): ?int
    {
        return $this->IssueDay;
    }

    /**
     * @param int|null $IssueDay
     *
     * @return InternationalPassport
     */
    public function setIssueDay(?int $IssueDay): InternationalPassport
    {
        $this->IssueDay = $IssueDay;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getIssueMonth(): ?int
    {
        return $this->IssueMonth;
    }

    /**
     * @param int|null $IssueMonth
     *
     * @return InternationalPassport
     */
    public function setIssueMonth(?int $IssueMonth): InternationalPassport
    {
        $this->IssueMonth = $IssueMonth;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getIssueYear(): ?int
    {
        return $this->IssueYear;
    }

    /**
     * @param int|null $IssueYear
     *
     * @return InternationalPassport
     */
    public function setIssueYear(?int $IssueYear): InternationalPassport
    {
        $this->IssueYear = $IssueYear;

        return $this;
    }

    /**
     * @param int $year
     * @param int $month
     * @param int $day
     *
     * @return InternationalPassport
     */
    public function setIssueDate(int $year, int $month, int $day): InternationalPassport
    {
        $this->setIssueDay($day);
        $this->setIssueMonth($month);
        $this->setIssueYear($year);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountryOfOrigin(): ?string
    {
        return $this->CountryOfOrigin;
    }

    /**
     * @param string $CountryOfOrigin
     *
     * @return InternationalPassport
     */
    public function setCountryOfOrigin(string $CountryOfOrigin): InternationalPassport
    {
        $this->CountryOfOrigin = $CountryOfOrigin;

        return $this;
    }
}
