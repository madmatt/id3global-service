<?php

declare(strict_types=1);

namespace ID3Global\Gateway\Request;

use ID3Global\Identity\Address\Address;
use ID3Global\Identity\Address\AddressContainer;
use ID3Global\Identity\ContactDetails;
use ID3Global\Identity\Documents\DocumentContainer;
use ID3Global\Identity\Documents\InternationalPassport;
use ID3Global\Identity\Identity;
use ID3Global\Identity\PersonalDetails;
use stdClass;

class AuthenticateSPRequest
{
    /**
     * @var ?string The customer reference as provided during the call to GlobalAuthenticationService->verifyIdentity().
     */
    private ?string $CustomerReference;

    /**
     * @var stdClass The Profile ID and Version in a single stdClass object as required by the ID3global API.
     */
    private stdClass $ProfileIDVersion;

    /**
     * @var stdClass All other input data for an Identity to be provided to the ID3global API.
     */
    private stdClass $InputData;

    public function addFieldsFromIdentity(Identity $identity): void
    {
        $this->InputData = new stdClass();

        $this->addPersonalDetails($identity);
        $this->addAddresses($identity);
        $this->addIdentityDocuments($identity);
        $this->addContactDetails($identity);
    }

    /**
     * @return string The customer reference as provided to GlobalAuthenticationService->verifyIdentity().
     */
    public function getCustomerReference(): string
    {
        return $this->CustomerReference;
    }

    /**
     * @param ?string $CustomerReference Customer reference as provided to GlobalAuthenticationService->verifyIdentity()
     * @return AuthenticateSPRequest
     */
    public function setCustomerReference(?string $CustomerReference): self
    {
        $this->CustomerReference = $CustomerReference;

        return $this;
    }

    /**
     * @return stdClass A stdClass that includes ->Version and ->ID values, correlating to Profile Version and ID.
     */
    public function getProfileIDVersion(): stdClass
    {
        return $this->ProfileIDVersion;
    }

    /**
     * @param stdClass $ProfileIDVersion A complete stdClass including both ->Version and ->ID values.
     * @return AuthenticateSPRequest
     */
    public function setProfileIDVersion(stdClass $ProfileIDVersion): self
    {
        $this->ProfileIDVersion = $ProfileIDVersion;

        return $this;
    }

    public function getInputData(): stdClass
    {
        return $this->InputData;
    }

    private function addPersonalDetails(Identity $identity): void
    {
        $this->InputData->Personal = new stdClass();
        $personalDetails = $identity->getPersonalDetails();

        if ($personalDetails instanceof PersonalDetails) {
            $this->InputData->Personal->PersonalDetails = $personalDetails;
        }
    }

    private function addAddresses(Identity $identity): void
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

    private function addIdentityDocuments(Identity $identity): void
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

    private function addContactDetails(Identity $identity): void
    {
        $this->InputData->ContactDetails = new stdClass();
        $contactDetails = $identity->getContactDetails();

        if ($contactDetails instanceof ContactDetails) {
            $this->InputData->ContactDetails->Email = $contactDetails->getEmail();

            if ($contactDetails->getLandTelephone() instanceof ContactDetails\PhoneNumber) {
                $number = $contactDetails->getLandTelephone()->getNumber();
                $this->InputData->ContactDetails->LandTelephone = new stdClass();
                $this->InputData->ContactDetails->LandTelephone->Number = $number;
            }

            if ($contactDetails->getMobileTelephone() instanceof ContactDetails\PhoneNumber) {
                $number = $contactDetails->getMobileTelephone()->getNumber();
                $this->InputData->ContactDetails->MobileTelephone = new stdClass();
                $this->InputData->ContactDetails->MobileTelephone->Number = $number;
            }

            if ($contactDetails->getWorkTelephone() instanceof ContactDetails\PhoneNumber) {
                $number = $contactDetails->getWorkTelephone()->getNumber();
                $this->InputData->ContactDetails->WorkTelephone = new stdClass();
                $this->InputData->ContactDetails->WorkTelephone->Number = $number;
            }
        }
    }
}
