<?php

declare(strict_types=1);

namespace ID3Global\Identity\Documents;

use ID3Global\Identity\ID3IdentityObject;
use InvalidArgumentException;
use ReflectionClass;
use stdClass;

class DocumentContainer extends ID3IdentityObject
{
    /**
     * @var InternationalPassport|null A passport identity document that will be sent to the ID3Global API. Only one can
     * be sent.
     */
    private ?InternationalPassport $InternationalPassport = null;

    /**
     * @var stdClass|null Identity documents relevant specifically to New Zealand.
     */
    private ?stdClass $NewZealand = null;

    /**
     * @var array<string> Used by self::addIdentityDocument() to ensure the country name is valid. Each array item is
     * the country name, per ID3global documentation for the `GlobalIdentityDocuments` type, which can be viewed in
     * their documentation here: https://bit.ly/2WWVHfW+
     */
    private array $validCountries = [
        'NewZealand',
    ];

    public function getInternationalPassport(): ?InternationalPassport
    {
        return $this->InternationalPassport;
    }

    public function setInternationalPassport(InternationalPassport $InternationalPassport): self
    {
        $this->InternationalPassport = $InternationalPassport;

        return $this;
    }

    public function getNewZealandDocuments(): ?stdClass
    {
        return $this->NewZealand;
    }

    /**
     * @param ID3IdentityObject $document An identity document to be assigned to a country-specific container
     * @param string $country The country to assign this document to (e.g. 'New Zealand')
     * @return DocumentContainer
     */
    public function addIdentityDocument(ID3IdentityObject $document, string $country): self
    {
        // Remove any characters that aren't A-Z or a-z (e.g. "New Zealand" -> "NewZealand")
        $varName = preg_replace('/[^A-Za-z]*/', '', $country);
        $r = new ReflectionClass($document);
        $docType = $r->getShortName();

        if (in_array($varName, $this->validCountries, true)) {
            if (is_null($this->$varName)) {
                $this->$varName = new stdClass();
            }

            $this->$varName->$docType = $document;
        } else {
            throw new InvalidArgumentException(sprintf('An invalid country "%s" was passed.', $country));
        }

        return $this;
    }

    /**
     * @return array<string> The list of all valid countries
     */
    public function getValidCountries(): array
    {
        return $this->validCountries;
    }
}
