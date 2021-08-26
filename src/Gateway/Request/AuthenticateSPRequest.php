<?php

namespace ID3Global\Gateway\Request;

use ID3Global\Identity\Address\Address;
use ID3Global\Identity\Address\AddressContainer;
use ID3Global\Identity\Documents\DocumentContainer;
use ID3Global\Identity\Documents\InternationalPassport;
use ID3Global\Identity\Identity;
use ID3Global\Identity\PersonalDetails;
use stdClass;

class AuthenticateSPRequest
{
    /**
     * @var string
     */
    private string $CustomerReference;

    /**
     * @var stdClass
     */
    private stdClass $ProfileIDVersion;

    /**
     * @var stdClass
     */
    private stdClass $InputData;

    public function addFieldsFromIdentity(Identity $identity)
    {
        $this->InputData = new stdClass();

        $this->addPersonalDetails($identity);
        $this->addAddresses($identity);
        $this->addIdentityDocuments($identity);
    }

    private function addPersonalDetails(Identity $identity)
    {
        $this->InputData->Personal = new stdClass();
        $personalDetails = $identity->getPersonalDetails();

        if ($personalDetails instanceof PersonalDetails) {
            $this->InputData->Personal->PersonalDetails = $personalDetails;
        }
    }

    private function addAddresses(Identity $identity)
    {
        $this->InputData->Addresses = new stdClass();
        $addresses = $identity->getAddresses();

        if ($addresses instanceof AddressContainer) {
            $currentAddress = $addresses->getCurrentAddress();

            if ($currentAddress instanceof Address) {
                $this->InputData->Addresses->CurrentAddress = $currentAddress;
            }
        }
    }

    private function addIdentityDocuments(Identity $identity)
    {
        $this->InputData->IdentityDocuments = new stdClass();
        $documents = $identity->getIdentityDocuments();

        if ($documents instanceof DocumentContainer) {
            $passport = $documents->getInternationalPassport();

            if ($passport instanceof InternationalPassport) {
                $this->InputData->IdentityDocuments->InternationalPassport = $passport;
            }

            foreach ($documents->getValidCountries() as $country) {
                $varName = sprintf('get%sDocuments', $country);
                $countryDocuments = $documents->$varName();

                if (is_object($countryDocuments)) {
                    $this->InputData->IdentityDocuments->$country = $countryDocuments;
                }
            }
        }
    }

    /**
     * @return string
     */
    public function getCustomerReference(): string
    {
        return $this->CustomerReference;
    }

    /**
     * @param string $CustomerReference
     *
     * @return AuthenticateSPRequest
     */
    public function setCustomerReference(string $CustomerReference): AuthenticateSPRequest
    {
        $this->CustomerReference = $CustomerReference;

        return $this;
    }

    /**
     * @return stdClass
     */
    public function getProfileIDVersion(): stdClass
    {
        return $this->ProfileIDVersion;
    }

    /**
     * @param stdClass $ProfileIDVersion
     *
     * @return AuthenticateSPRequest
     */
    public function setProfileIDVersion(stdClass $ProfileIDVersion): AuthenticateSPRequest
    {
        $this->ProfileIDVersion = $ProfileIDVersion;

        return $this;
    }

    public function getInputData(): stdClass
    {
        return $this->InputData;
    }
}
