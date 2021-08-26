<?php
namespace ID3Global\Identity\Documents;

use ID3Global\Identity\ID3IdentityObject;
use InvalidArgumentException;
use ReflectionClass;
use stdClass;

class DocumentContainer extends ID3IdentityObject
{
    /**
     * @var InternationalPassport
     */
    private InternationalPassport $InternationalPassport;

    /**
     * @var stdClass|null Identity documents relevant to New Zealand
     */
    private ?stdClass $NewZealand = null;

    /**
     * @var array Used by self::addIdentityDocument() to ensure the country name is valid
     */
    private array $validCountries = array(
        'NewZealand'
    );

    public function __construct(InternationalPassport $InternationalPassport)
    {
        $this->InternationalPassport = $InternationalPassport;
    }


    /**
     * @return InternationalPassport
     */
    public function getInternationalPassport(): InternationalPassport
    {
        return $this->InternationalPassport;
    }

    /**
     * @param InternationalPassport $InternationalPassport
     * @return DocumentContainer
     */
    public function setInternationalPassport(InternationalPassport $InternationalPassport): DocumentContainer
    {
        $this->InternationalPassport = $InternationalPassport;
        return $this;
    }

    /**
     * @return array|stdClass|null
     */
    public function getNewZealandDocuments(): array|stdClass|null
    {
        return $this->NewZealand;
    }

    /**
     * @param ID3IdentityObject $document
     * @param string $country The country to assign this document to (e.g. 'New Zealand')
     * @return DocumentContainer
     */
    public function addIdentityDocument(ID3IdentityObject $document, string $country): DocumentContainer
    {
        //
        $varName = preg_replace('/[^A-Za-z]*/', '', $country);
        $r = new ReflectionClass($document);
        $docType = $r->getShortName();

        if(in_array($varName, $this->validCountries)) {
            if(is_null($this->$varName)) {
                $this->$varName = new stdClass();
            }

            $this->$varName->$docType = $document;
        } else {
            throw new InvalidArgumentException(sprintf('An invalid country "%s" was passed.', $country));
        }

        return $this;
    }

    public function getValidCountries(): array
    {
        return $this->validCountries;
    }
}
