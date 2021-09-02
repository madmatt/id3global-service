# id3global-service
Allows a PHP-powered website to communicate with the [GBG ID3global API](http://www.gbgplc.com/uk/products/gbg-id3global/) to verify identities.

## Installation

## Usage
The WSDL file gives an overview of the values that can be provided, these will vary by country.
* [Online WSDL viewer](http://www.id3globalsupport.com/Website/content/Web-Service/WSDL%20Page/WSDL%20HTML/ID3%20Global%20WSDL-%20Live.xhtml)
* [Sample code per country](http://www.id3globalsupport.com/Website/Sample-Code.html)

*Note:* The code below is entirely subject to change. It is primarily focused at the moment around the `AuthenticateSP` method of the ID3global API, and specifically on New Zealand (Aotearoa), however it should be generic enough to easily support non-NZ systems easily.

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

$birthday = DateTime::createFromFormat('Y-m-d', '1922-08-20');
$personalDetails = new \ID3Global\Identity\PersonalDetails();
$personalDetails
    ->setTitle('Mr')
    ->setForeName('Dworkin')
    ->setMiddleName('John')
    ->setSurname('Barimen')
    ->setGender('male')
    ->setDateOfBirth($birthday);

$currentAddress = new \ID3Global\Identity\Address\FreeFormatAddress();
$currentAddress
    ->setCountry('New Zealand')
    ->setPostCode('90210')
    // You can set up to 8 address lines if required using ->setAddressLine3(), ->setAddressLine8() etc.
    ->setAddressLine1('Dungeon 1')
    ->setAddressLine2('Courts of Amber');

$addressContainer = new \ID3Global\Identity\Address\AddressContainer();
$addressContainer->setCurrentAddress($currentAddress);

$phone = new \ID3Global\Identity\ContactDetails\PhoneNumber();
$phone->setNumber(1234567890);

$contactDetails = new \ID3Global\Identity\ContactDetails();
$contactDetails
    ->setLandTelephone($phone)
    ->setMobileTelephone($phone)
    ->setWorkTelephone($phone)
    ->setEmail('dworkin@thepattern.net');

$internationalPassport = new \ID3Global\Identity\Documents\InternationalPassport();
$documentContainer = new \ID3Global\Identity\Documents\DocumentContainer();
$documentContainer->addIdentityDocument(new \ID3Global\Identity\Documents\NZ\DrivingLicence(), 'New Zealand');

/**
 * $result will be a string representing the 'BandText' as returned by the ID3global API. By default, this may be a word
 * like 'PASS', 'REFER' or 'ALERT' but could also be any string value e.g. 'Name, Address and DOB Match'. The exact
 * string returned is entirely dependent on how the profile is configured within ID3global, and can vary if you adjust
 * the profile id and profile version.
 *
 * It is up to your implementation how these are handled. Note that generally there is only a single value that
 * represents an identity that has passed the necessary verification, and multiple BandTexts that represent a failing
 * identity. You **must** handle this in your own code, as the ID3Global API does not provide any kind of boolean value
 * for whether a given identity passed identity verification or not.
 *
 * An exception is thrown if the web service fails or cannot be contacted.
 */
$validIdentityBandText = 'PASS'; // See note above about how this may differ for you

$identity = new \ID3Global\Identity\Identity();
$identity
    ->setPersonalDetails($personalDetails)
    ->setAddresses($addressContainer)
    ->setContactDetails($contactDetails)
    ->setIdentityDocuments($documentContainer);

$gateway = new \ID3Global\Gateway\GlobalAuthenticationGateway('username', 'password');
$id3Service = new \ID3Global\Service\GlobalAuthenticationService($gateway);
$result = $id3Service
    ->setProfileId('Profile ID as provided by ID3global interface')
    ->verifyIdentity($identity, 'Unique customer reference');

if($result === $validIdentityBandText) {
    // Identity is verified, continue processing
}
```
