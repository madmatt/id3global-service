<?php

declare(strict_types=1);

namespace ID3Global\Identity\Documents;

use DateTime;
use ID3Global\Identity\ID3IdentityObject;

class InternationalPassport extends ID3IdentityObject
{
    /**
     * @var string|null The full unique passport identifier (varies by country).
     */
    private ?string $Number = null;

    /**
     * @var string|null The short unique passport identifier (varies by country).
     */
    private ?string $ShortPassportNumber = null;

    /**
     * @var int|null The day (e.g. 1, 15, 31) that the passport expires.
     */
    private ?int $ExpiryDay = null;

    /**
     * @var int|null The month (e.g. 1, 5, 12) that the passport expires.
     */
    private ?int $ExpiryMonth = null;

    /**
     * @var int|null The year (e.g. 1997) that the passport expires.
     */
    private ?int $ExpiryYear = null;

    /**
     * @var int|null The day (e.g. 1, 15, 31) that the passport was issued.
     */
    private ?int $IssueDay = null;

    /**
     * @var int|null The month (e.g. 1, 5, 12) that the passport was issued.
     */
    private ?int $IssueMonth = null;

    /**
     * @var int|null The year (e.g. 1997) that the passport was issued.
     */
    private ?int $IssueYear = null;

    /**
     * @var string|null The full country name (e.g. "New Zealand", not "NZ") that this passport was issued by.
     */
    private ?string $CountryOfOrigin = null;

    public function getNumber(): ?string
    {
        return $this->Number;
    }

    public function setNumber(?string $Number): InternationalPassport
    {
        $this->Number = $Number;

        return $this;
    }

    public function getShortPassportNumber(): ?string
    {
        return $this->ShortPassportNumber;
    }

    public function setShortPassportNumber(?string $ShortPassportNumber): InternationalPassport
    {
        $this->ShortPassportNumber = $ShortPassportNumber;

        return $this;
    }

    public function getExpiryDay(): ?int
    {
        return $this->ExpiryDay;
    }

    public function setExpiryDay(?int $ExpiryDay): InternationalPassport
    {
        $this->ExpiryDay = $ExpiryDay;

        return $this;
    }

    public function getExpiryMonth(): ?int
    {
        return $this->ExpiryMonth;
    }

    public function setExpiryMonth(?int $ExpiryMonth): InternationalPassport
    {
        $this->ExpiryMonth = $ExpiryMonth;

        return $this;
    }

    public function getExpiryYear(): ?int
    {
        return $this->ExpiryYear;
    }

    public function setExpiryYear(?int $ExpiryYear): InternationalPassport
    {
        $this->ExpiryYear = $ExpiryYear;

        return $this;
    }

    public function setExpiryDate(?DateTime $expiryDate): InternationalPassport
    {
        // Set all expiry date fields to null if we're not given a valid date
        if (!$expiryDate) {
            $this->setExpiryDay(null)->setExpiryMonth(null)->setExpiryYear(null);

            return $this;
        }

        $this->setExpiryDay((int)$expiryDate->format('d'));
        $this->setExpiryMonth((int)$expiryDate->format('m'));
        $this->setExpiryYear((int)$expiryDate->format('Y'));

        return $this;
    }

    public function getIssueDay(): ?int
    {
        return $this->IssueDay;
    }

    public function setIssueDay(?int $IssueDay): InternationalPassport
    {
        $this->IssueDay = $IssueDay;

        return $this;
    }

    public function getIssueMonth(): ?int
    {
        return $this->IssueMonth;
    }

    public function setIssueMonth(?int $IssueMonth): InternationalPassport
    {
        $this->IssueMonth = $IssueMonth;

        return $this;
    }

    public function getIssueYear(): ?int
    {
        return $this->IssueYear;
    }

    public function setIssueYear(?int $IssueYear): InternationalPassport
    {
        $this->IssueYear = $IssueYear;

        return $this;
    }

    public function setIssueDate(?DateTime $issueDate): InternationalPassport
    {
        // Set all issue date fields to null if we're not given a valid date
        if (!$issueDate) {
            $this->setIssueDay(null)->setIssueMonth(null)->setIssueYear(null);

            return $this;
        }

        $this->setIssueDay((int)$issueDate->format('d'));
        $this->setIssueMonth((int)$issueDate->format('m'));
        $this->setIssueYear((int)$issueDate->format('Y'));

        return $this;
    }

    public function getCountryOfOrigin(): ?string
    {
        return $this->CountryOfOrigin;
    }

    public function setCountryOfOrigin(string $CountryOfOrigin): InternationalPassport
    {
        $this->CountryOfOrigin = $CountryOfOrigin;

        return $this;
    }
}
