<?php

namespace Tests\Gateway\Request;

use DateTime;
use ID3Global\Gateway\Request\AuthenticateSPRequest;
use ID3Global\Identity\Address\AddressContainer;
use ID3Global\Identity\Address\FixedFormatAddress;
use ID3Global\Identity\Address\FreeFormatAddress;
use ID3Global\Identity\ContactDetails;
use ID3Global\Identity\Documents\DocumentContainer;
use ID3Global\Identity\Documents\InternationalPassport;
use ID3Global\Identity\Documents\NZ\DrivingLicence;
use ID3Global\Identity\Identity;
use ID3Global\Identity\PersonalDetails;
use PHPUnit\Framework\TestCase;
use stdClass;

class AuthenticateSPRequestTest extends TestCase
{
    /**
     * @var Identity
     */
    private Identity $identity;

    protected function setUp(): void
    {
        parent::setUp();

        $this->identity = new Identity();
    }

    public function testStandardParams()
    {
        $version = new stdClass();
        $version->Version = 1;
        $version->ID = 'abc123-x';
        $r = new AuthenticateSPRequest();

        $r->setCustomerReference('X')->setProfileIDVersion($version);

        $this->assertEquals(1, $r->getProfileIDVersion()->Version);
        $this->assertEquals('abc123-x', $r->getProfileIDVersion()->ID);
        $this->assertEquals('X', $r->getCustomerReference());
    }

    public function testPersonalDetails()
    {
        $birthday = DateTime::createFromFormat('Y-m-d', '1973-04-05');

        $personalDetails = new PersonalDetails();
        $personalDetails
            ->setTitle('Dr.')
            ->setForename('Gordon')
            ->setSurname('Freeman')
            ->setGender('Male')
            ->setDateOfBirth($birthday)
            ->setCountryOfBirth('US');
        $this->identity->setPersonalDetails($personalDetails);

        $r = new AuthenticateSPRequest();
        $r->addFieldsFromIdentity($this->identity);
        $test = $r->getInputData()->Personal->PersonalDetails;

        $this->assertSame('Dr.', $test->Title);
        $this->assertSame('Gordon', $test->Forename);
        $this->assertSame('Freeman', $test->Surname);
        $this->assertSame('Male', $test->Gender);
        $this->assertSame(1973, $test->DOBYear);
        $this->assertSame(4, $test->DOBMonth);
        $this->assertSame(5, $test->DOBDay);
        $this->assertSame('US', $test->CountryOfBirth);
    }

    public function testContactDetails()
    {
        $landTelephone = new ContactDetails\PhoneNumber();
        $landTelephone->setNumber('1(800) 786-1410');

        $contactDetails = new ContactDetails();
        $contactDetails
            ->setEmail('freeman@blackmesa.com')
            ->setLandTelephone($landTelephone);
        $this->identity->setContactDetails($contactDetails);

        $r = new AuthenticateSPRequest();
        $r->addFieldsFromIdentity($this->identity);
        $test = $r->getInputData()->ContactDetails;

        $this->assertSame('freeman@blackmesa.com', $test->Email);
        $this->assertSame('1(800) 786-1410', $test->LandTelephone->Number);
    }

    public function testInternationalPassport()
    {
        $issueDate = DateTime::createFromFormat('Y-m-d', '2020-01-02');
        $expiryDate = DateTime::createFromFormat('Y-m-d', '2030-01-02');
        $internationalPassport = new InternationalPassport();
        $internationalPassport
            ->setNumber('P1234567<0AZE7304058M12345675J8AO2Q<<<<<<<12')
            ->setShortPassportNumber('P1234567')
            ->setIssueDate($issueDate)
            ->setExpiryDate($expiryDate)
            ->setCountryOfOrigin('Azerbaijan');

        $documentContainer = new DocumentContainer();
        $documentContainer->setInternationalPassport($internationalPassport);

        $this->identity->setIdentityDocuments($documentContainer);

        $r = new AuthenticateSPRequest();
        $r->addFieldsFromIdentity($this->identity);
        $test = $r->getInputData()->IdentityDocuments->InternationalPassport;
        $this->assertSame('P1234567<0AZE7304058M12345675J8AO2Q<<<<<<<12', $test->Number);
        $this->assertSame('P1234567', $test->ShortPassportNumber);
        $this->assertSame(2020, $test->IssueYear);
        $this->assertSame(1, $test->IssueMonth);
        $this->assertSame(2, $test->IssueDay);
        $this->assertSame(2030, $test->ExpiryYear);
        $this->assertSame(1, $test->ExpiryMonth);
        $this->assertSame(2, $test->ExpiryDay);
        $this->assertSame('Azerbaijan', $test->CountryOfOrigin);
    }

    public function testFixedLengthAddress()
    {
        $address = new FixedFormatAddress();
        $address
            ->setPrincipality('US')
            ->setCountry('US')
            ->setStateDistrict('NY')
            ->setRegion('New York')
            ->setCity('New York')
            ->setSubCity('Manhattan')
            ->setStreet('5th Ave')
            ->setSubStreet('5th Ave')
            ->setBuilding('350')
            ->setSubBuilding('350')
            ->setPremise('Empire State Building')
            ->setZipPostcode('10118');

        $container = new AddressContainer();
        $container->setCurrentAddress($address);
        $this->identity->setAddresses($container);

        $r = new AuthenticateSPRequest();
        $r->addFieldsFromIdentity($this->identity);
        $test = $r->getInputData()->Addresses->CurrentAddress;

        $this->assertSame('US', $test->Principality);
        $this->assertSame('US', $test->Country);
        $this->assertSame('NY', $test->StateDistrict);
        $this->assertSame('New York', $test->Region);
        $this->assertSame('New York', $test->City);
        $this->assertSame('Manhattan', $test->SubCity);
        $this->assertSame('5th Ave', $test->Street);
        $this->assertSame('5th Ave', $test->SubStreet);
        $this->assertSame('350', $test->Building);
        $this->assertSame('350', $test->SubBuilding);
        $this->assertSame('Empire State Building', $test->Premise);
        $this->assertSame('10118', $test->ZipPostcode);
    }

    public function testFreeFormatAddress()
    {
        $address = new FreeFormatAddress();

        $address
            ->setCountry('New Zealand')
            ->setPostCode('6004')
            ->setAddressLine1('Room 6')
            ->setAddressLine2('Level 6')
            ->setAddressLine3('Area 6')
            ->setAddressLine4('666 Fake St')
            ->setAddressLine5('Te Aro')
            ->setAddressLine6('Wellington')
            ->setAddressLine7('6004')
            ->setAddressLine8('NZ');

        $container = new AddressContainer();
        $container->setCurrentAddress($address);
        $this->identity->setAddresses($container);

        $r = new AuthenticateSPRequest();
        $r->addFieldsFromIdentity($this->identity);
        $test = $r->getInputData()->Addresses->CurrentAddress;

        $this->assertSame('New Zealand', $test->Country);
        $this->assertSame('6004', $test->PostCode);
        $this->assertSame('Room 6', $test->AddressLine1);
        $this->assertSame('Level 6', $test->AddressLine2);
        $this->assertSame('Area 6', $test->AddressLine3);
        $this->assertSame('666 Fake St', $test->AddressLine4);
        $this->assertSame('Te Aro', $test->AddressLine5);
        $this->assertSame('Wellington', $test->AddressLine6);
        $this->assertSame('6004', $test->AddressLine7);
        $this->assertSame('NZ', $test->AddressLine8);
    }

    public function testNZDrivingLicence()
    {
        $licence = new DrivingLicence();

        $licence
            ->setNumber('DI123456')
            ->setVersion(123)
            ->setVehicleRegistration('ABC123');

        $container = new DocumentContainer();
        $container->addIdentityDocument($licence, 'New Zealand');
        $this->identity->setIdentityDocuments($container);

        $r = new AuthenticateSPRequest();
        $r->addFieldsFromIdentity($this->identity);
        $test = $r->getInputData()->IdentityDocuments;

        $this->assertSame('DI123456', $test->NewZealand->DrivingLicence->Number);
        $this->assertSame(123, $test->NewZealand->DrivingLicence->Version);
        $this->assertSame('ABC123', $test->NewZealand->DrivingLicence->VehicleRegistration);
    }
}
