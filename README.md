# silverstripe-id3global
Allows a SilverStripe-powered website to communicate with the [GBG ID3global API](http://www.gbgplc.com/uk/products/gbg-id3global/) to verify identities.

## Installation

## Usage
The WSDL file gives an overview of the values that can be provided, these will vary by country.
* [Online WSDL viewer](http://www.id3globalsupport.com/Website/content/Web-Service/WSDL%20Page/WSDL%20HTML/ID3%20Global%20WSDL-%20Live.xhtml)
* [Sample code per country](http://www.id3globalsupport.com/Website/Sample-Code.html)

*Note:* The code below is entirely subject to change - it is likely for example that the ID3GlobalService is more likely to become the `ID3Global\IdentityValidationService` or similar. It is primarily focused at the moment around the `AuthenticateSP` method of ID3Global, and specifically on NZ, however it should be generic enough to easily support non-NZ systems easily.

```php
$id3Service = Injector::inst()->get('ID3GlobalService');

$personalDetails = ID3GlobalPersonalDetails::create()
    ->setTitle('Mr')
    ->setForeName('Dworkin')
    ->setMiddleName('John')
    ->setSurname('Barimen')
    ->setGender(ID3GlobalService::GENDER_MALE)
    ->setDateOfBirth(1922, 08, 20);

$currentAddress = ID3GlobalFreeFormAddress::create()
    ->setCountry(ID3GlobalService::COUNTRY_NZ)
    ->setZipPostcode(90210)
    // You can set up to 8 address lines if required using ->setAddressLine3(), ->setAddressLine8() etc.
    ->setAddressLine1('Dungeon 1')
    ->setAddressLine2('Courts of Amber');

$contactDetails = ID3GlobalContactDetails::create()
    ->setLandlinePhone(1234567890)
    ->setMobilePhone(1234567890)
    ->setWorkPhone(1234567890)
    ->setEmail('dworkin@thepattern.net');

/**
 * $result will be one of the following:
 * - ID3GlobalService::IDENTITY_BAND_PASS
 * - ID3GlobalService::IDENTITY_BAND_REFER
 * - ID3GlobalService::IDENTITY_BAND_ALERT
 *
 * It is up to the implemenetation how these are handled.
 * An exception is thrown if the web service fails or cannot be contacted.
 */
$result = $id3Service
    ->setPersonalDetails($personalDetails)
    ->setCurrentAddress($currentAddress)
    ->setContactDetails($contactDetails)
    ->verifyIdentity();

if($result === ID3GlobalService::IDENTITY_BAND_PASS) {
    // Identity is verified, continue processing
}
```
