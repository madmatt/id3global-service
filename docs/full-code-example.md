# id3global-service

## Key classes

**Core services:**
* `ID3Global\Service\GlobalAuthenticationService`: The core service class used to request identity verification
* `ID3Global\Gateway\GlobalAuthenticationGateway`: The internal gateway class that communicates (via SOAP) with ID3global

**Identity information:**
* `ID3Global\Identity\Identity`: The base class for a single person's identity
* `ID3Global\Identity\PersonalDetails`: A class to capture core identity information (name, date of birth etc)
* `ID3Global\Identity\ContactDetails\PhoneNumber`: Include a single phone number (can be used for landline, mobile etc)

**Address specification:**
* `ID3Global\Identity\Address\FreeFormatAddress`: A 'free-form' address where individual address fields aren't specified
* `ID3Global\Identity\Address\FixedFormatAddress`: A fixed address format (e.g. fields for street, city, subcity etc)

**Additional identity documents:**
* `ID3Global\Identity\Documents\DocumentContainer`: Class that contains all below documents
* `ID3Global\Identity\Documents\InternationalPassport`: Contains details about a passport
* `ID3Global\Identity\Documents\NZ\DrivingLicence`: Contains details about a New Zealand drivers licence

## Full code example

Below is a complete example of how to utilise this module, configuring personal details, a single address, multiple phone numbers and a passport.

Once the identity is created, we create and submit it to the `GlobalAuthenticationService`.

In the below example, we enable the 'pilot' site, which is the ID3global test environment. Leave this line out to query production (this will incur costs).

Finally, please review the comment below regarding the value of `$validIdentityBandText` - it's critically important that this is correct.

```php
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
    ->setProfileVersion(0)
    ->setPilotSiteEnabled(true)
    ->verifyIdentity($identity, 'Unique customer reference');

if($result === $validIdentityBandText) {
    // Identity is verified, continue processing
}
```
