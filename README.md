# id3global-service
Allows a PHP-powered website to communicate with the [GBG ID3global API](http://www.gbgplc.com/uk/products/gbg-id3global/) to verify identities.

## Installation

## Usage
The WSDL file gives an overview of the values that can be provided, these will vary by country.
* [Online WSDL viewer](http://www.id3globalsupport.com/Website/content/Web-Service/WSDL%20Page/WSDL%20HTML/ID3%20Global%20WSDL-%20Live.xhtml)
* [Sample code per country](http://www.id3globalsupport.com/Website/Sample-Code.html)

*Note:* The code below is entirely subject to change. It is primarily focused at the moment around the `AuthenticateSP` method of the ID3Global API, and specifically on NZ, however it should be generic enough to easily support non-NZ systems easily.

```php
/**
 * Namespaces:
 *
 * \ID3Global\Constants\Identity
 * \ID3Global\Gateways\GlobalAuthenticationGateway
 * \ID3Global\Services\GlobalAuthenticationService
 * \ID3Global\Model\Identity\Address\FreeFormatAddress
 * \ID3Global\Model\Identity\Address\FixedFormatAddress
 * \ID3Global\Model\Identity\ContactDetails
 * \ID3Global\Model\Identity\ContactDetails\LandTelephone
 * \ID3Global\Model\Identity\ContactDetails\MobileTelephone
 * \ID3Global\Model\Identity\ContactDetails\WorkTelephone
 * \ID3Global\Model\Identity\Documents\NZ\DrivingLicence
 * \ID3Global\Model\Identity\PersonalDetails
 *
 * \ID3Global\Containers\Model\Identity\Addresses<\ID3Global\Model\Identity\Address\FreeFormatAddress, \ID3Global\Model\Identity\Address\FixedFormatAddress>
 *     - CurrentAddress
 *     - PreviousAddress[1-3]
 *     - HistoricAddresses<\ID3Global\Model\Identity\Address\FreeFormatAddress, \ID3Global\Model\Identity\Address\FixedFormatAddress>
 *
 * \ID3Global\Containers\Model\Identity\Documents
 *
 * Not core for implementation
 * \ID3Global\Containers\Model\Identity\Aliases
 * \ID3Global\Model\Identity\AlternateName
 * \ID3Global\Model\Identity\BankingDetails\BankAccount
 * \ID3Global\Model\Identity\BankingDetails\CreditDebitCard
 * \ID3Global\Model\Identity\Documents\Address\UK\ElectricitySupplier
 * \ID3Global\Model\Identity\Documents\Identity\Global\InternationalPassport
 * \ID3Global\Model\Identity\Documents\Identity\Europe\EuropeanIdentityCard
 * \ID3Global\Model\Identity\Documents\Identity\AU\ShortPassport
 * \ID3Global\Model\Identity\Documents\Identity\AU\Medicare
 * \ID3Global\Model\Identity\Documents\Identity\BR\CPFNumber
 * \ID3Global\Model\Identity\Documents\Identity\CA\SocialInsuranceNumber
 * \ID3Global\Model\Identity\Documents\Identity\CN\ResidentIdentityCard
 * \ID3Global\Model\Identity\Documents\Identity\ES\TaxIDNumber
 * \ID3Global\Model\Identity\Documents\Identity\MX\TaxIdentificationNumber
 * \ID3Global\Model\Identity\Documents\Identity\UK\Passport
 * \ID3Global\Model\Identity\Documents\Identity\UK\DrivingLicence
 * \ID3Global\Model\Identity\Documents\Identity\UK\NationalInsuranceNumber
 * \ID3Global\Model\Identity\Documents\Identity\UK\DrivingLicence
 * \ID3Global\Model\Identity\Documents\Identity\US\DrivingLicence
 * \ID3Global\Model\Identity\Documents\Identity\US\SocialSecurity
 * \ID3Global\Model\Identity\Documents\Identity\US\IdentityCard
 * \ID3Global\Model\Identity\Employment
 * \ID3Global\Model\Identity\GlobalGeneric
 * \ID3Global\Model\Identity\Images
 * \ID3Global\Model\Identity\Location
 * \ID3Global\Model\Identity\PersonalDetails\BirthInfo
 */

$personalDetails = new \ID3Global\Model\Identity\PersonalDetails();
$personalDetails
    ->setTitle('Mr')
    ->setForeName('Dworkin')
    ->setMiddleName('John')
    ->setSurname('Barimen')
    ->setGender(ID3GlobalService::GENDER_MALE)
    ->setDateOfBirth(1922, 08, 20);

$currentAddress = new \ID3Global\Model\Identity\Address\FreeFormatAddress();
$currentAddress
    ->setCountry(ID3GlobalService::COUNTRY_NZ)
    ->setZipPostcode(90210)
    // You can set up to 8 address lines if required using ->setAddressLine3(), ->setAddressLine8() etc.
    ->setAddressLine1('Dungeon 1')
    ->setAddressLine2('Courts of Amber');

$addressContainer = new \ID3Global\Containers\Model\Identity\Addresses();
$addressContainer
    ->setCurrentAddress($currentAddress);

$contactDetails = new \ID3Global\Model\Identity\ContactDetails();
$contactDetails
    ->setLandPhone(new \ID3Global\Model\Identity\ContactDetails\LandTelephone(1234567890, false))
    ->setMobilePhone(new \ID3Global\Model\Identity\ContactDetails\MobileTelephone(1234567890))
    ->setWorkPhone(new \ID3Global\Model\Identity\ContactDetails\WorkTelephone(1234567890))
    ->setEmail('dworkin@thepattern.net');

/**
 * $result will be one of the following:
 * - \ID3Global\Constants\Identity::IDENTITY_BAND_PASS
 * - \ID3Global\Constants\Identity::IDENTITY_BAND_REFER
 * - \ID3Global\Constants\Identity::IDENTITY_BAND_ALERT
 *
 * It is up to the implemenetation how these are handled.
 * An exception is thrown if the web service fails or cannot be contacted.
 */
$id3Service = new \ID3Global\Services\GlobalAuthenticationService();
$result = $id3Service
    ->setPersonalDetails($personalDetails)
    ->setAddresses($addressContainer)
    ->setContactDetails($contactDetails)
    ->verifyIdentity();

if($result === \ID3Global\Constants\Identity::IDENTITY_BAND_PASS) {
    // Identity is verified, continue processing
}
```
