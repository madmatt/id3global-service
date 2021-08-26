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
 * \ID3Global\Identity\Address\FreeFormatAddress
 * \ID3Global\Identity\Address\FixedFormatAddress
 * \ID3Global\Identity\ContactDetails
 * \ID3Global\Identity\ContactDetails\LandTelephone
 * \ID3Global\Identity\ContactDetails\MobileTelephone
 * \ID3Global\Identity\ContactDetails\WorkTelephone
 * \ID3Global\Identity\Documents\NZ\DrivingLicence
 * \ID3Global\Identity\PersonalDetails
 *
 * \ID3Global\Identity\Addresses<\ID3Global\Identity\Address\FreeFormatAddress, \ID3Global\Identity\Address\FixedFormatAddress>
 *     - CurrentAddress
 *     - PreviousAddress[1-3]
 *     - HistoricAddresses<\ID3Global\Identity\Address\FreeFormatAddress, \ID3Global\Identity\Address\FixedFormatAddress>
 *
 * \ID3Global\Identity\Documents
 *
 * Not core for implementation
 * \ID3Global\Identity\Aliases
 * \ID3Global\Identity\AlternateName
 * \ID3Global\Identity\BankingDetails\BankAccount
 * \ID3Global\Identity\BankingDetails\CreditDebitCard
 * \ID3Global\Identity\Documents\Address\UK\ElectricitySupplier
 * \ID3Global\Identity\Documents\Identity\Global\InternationalPassport
 * \ID3Global\Identity\Documents\Identity\Europe\EuropeanIdentityCard
 * \ID3Global\Identity\Documents\Identity\AU\ShortPassport
 * \ID3Global\Identity\Documents\Identity\AU\Medicare
 * \ID3Global\Identity\Documents\Identity\BR\CPFNumber
 * \ID3Global\Identity\Documents\Identity\CA\SocialInsuranceNumber
 * \ID3Global\Identity\Documents\Identity\CN\ResidentIdentityCard
 * \ID3Global\Identity\Documents\Identity\ES\TaxIDNumber
 * \ID3Global\Identity\Documents\Identity\MX\TaxIdentificationNumber
 * \ID3Global\Identity\Documents\Identity\UK\Passport
 * \ID3Global\Identity\Documents\Identity\UK\DrivingLicence
 * \ID3Global\Identity\Documents\Identity\UK\NationalInsuranceNumber
 * \ID3Global\Identity\Documents\Identity\UK\DrivingLicence
 * \ID3Global\Identity\Documents\Identity\US\DrivingLicence
 * \ID3Global\Identity\Documents\Identity\US\SocialSecurity
 * \ID3Global\Identity\Documents\Identity\US\IdentityCard
 * \ID3Global\Identity\Employment
 * \ID3Global\Identity\GlobalGeneric
 * \ID3Global\Identity\Images
 * \ID3Global\Identity\Location
 * \ID3Global\Identity\PersonalDetails\BirthInfo
 */

$personalDetails = new \ID3Global\Identity\PersonalDetails();
$personalDetails
    ->setTitle('Mr')
    ->setForeName('Dworkin')
    ->setMiddleName('John')
    ->setSurname('Barimen')
    ->setGender('male')
    ->setDateOfBirth(1922, 8, 20);

$currentAddress = new \ID3Global\Identity\Address\FreeFormatAddress();
$currentAddress
    ->setCountry('New Zealand')
    ->setPostCode('90210')
    // You can set up to 8 address lines if required using ->setAddressLine3(), ->setAddressLine8() etc.
    ->setAddressLine1('Dungeon 1')
    ->setAddressLine2('Courts of Amber');

$addressContainer = new \ID3Global\Identity\Address\AddressContainer($currentAddress);

$contactDetails = new \ID3Global\Identity\ContactDetails();
$contactDetails
    ->setLandPhone(new \ID3Global\Identity\ContactDetails\PhoneNumber(1234567890))
    ->setMobilePhone(new \ID3Global\Identity\ContactDetails\PhoneNumber(1234567890))
    ->setWorkPhone(new \ID3Global\Identity\ContactDetails\PhoneNumber(1234567890))
    ->setEmail('dworkin@thepattern.net');

$internationalPassport = new \ID3Global\Identity\Documents\InternationalPassport();
$documentContainer = new \ID3Global\Identity\Documents\DocumentContainer($internationalPassport);

/**
 * $result will be one of the following:
 * - \ID3Global\Constants\Identity::IDENTITY_BAND_PASS
 * - \ID3Global\Constants\Identity::IDENTITY_BAND_REFER
 * - \ID3Global\Constants\Identity::IDENTITY_BAND_ALERT
 *
 * It is up to the implementation how these are handled.
 * An exception is thrown if the web service fails or cannot be contacted.
 */
$identity = new \ID3Global\Identity\Identity($personalDetails, $contactDetails, $addressContainer, $documentContainer);

$gateway = new \ID3Global\Gateway\GlobalAuthenticationGateway('username', 'password');
$id3Service = new \ID3Global\Service\GlobalAuthenticationService($identity, 'profile-id', $gateway);
$result = $id3Service
    ->setIdentity($identity)
    ->verifyIdentity();

if($result === \ID3Global\Identity\Identity::IDENTITY_BAND_PASS) {
    // Identity is verified, continue processing
}
```
