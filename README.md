# id3global-service
Allows a PHP-powered website to communicate with the [GBG ID3global API](http://www.gbgplc.com/uk/products/gbg-id3global/) to verify identities.

## Installation

```bash
composer require madmatt/id3global-service
```

If you're not already using [Composer](https://getcomposer.org/) for dependency management, please consider doing so. If you'd prefer not to, you can download the latest release from the [Releases section](https://github.com/madmatt/id3global-service/releases).

## Usage
The WSDL file gives an overview of the values that can be provided, these will vary by country.
* [Online WSDL viewer](http://www.id3globalsupport.com/Website/content/Web-Service/WSDL%20Page/WSDL%20HTML/ID3%20Global%20WSDL-%20Live.xhtml)
* [Sample code per country](http://www.id3globalsupport.com/Website/Sample-Code.html)

Please see the [Full Code Example](docs/full-code-example.md) that provides a complete overview of usage of this module.

### Accessing the underlying ID3global request and response
Depending on your use case, you may need to access the underlying request sent to ID3global, or the response returned by the ID3global API. Typical use cases of this are for auditing purposes - to confirm that identity information hasn't changed since the last time an identity verification was performed for example.

In order to facilitate this, the `GlobalAuthenticationService` class has a number of helper methods to give you access to the underlying data. All of the below code assumes that you have already called the `->verifyIdentity()` method and that either you have a valid BandText, or you have caught the `IdentityVerificationFailureException` that may be thrown.

```php
// Assumes $service is an instance of ID3Global\Service\GlobalAuthenticationService

// Return the last SOAP request made to the ID3global API as a string
$lastRawRequest = $service->getLastRawRequest();

// Returns the SoapClient interpreted response from the API (this will be an object of type \stdClass, or null if the SOAP request failed entirely
// For example you can access the BandText of a valid response with $lastResponse->AuthenticateSPResult->BandText
$lastResponse = $service->getLastVerifyIdentityResponse();

// Access the underlying SoapClient object to perform more detailed debugging
$gateway = $service->getGateway(); // Returns a ID3Global\Gateway\GlobalAuthenticationGateway object
$soapClient = $gateway->getSoapClient(); // Returns a ID3Global\Gateway\SoapClient\ID3GlobalSoapClient object

// You can then do anything you'd normally do on SoapClient, such as:
$lastRawRequestHeaders = $soapClient->__getLastRequestHeaders(); // Returns an array of the headers sent to the API
$lastRawResponse = $soapClient->__getLastResponse(); // Returns the last response returned by the API
```

### Debugging identity verification failures
In certain circumstances, generally when the ID3Global API produces unexpected results, you may get an `IdentityVerificationFailureException` returned to you. This can happen in a number of scenarios, such as required fields being missing from the request, or data being in an invalid format.

You should also wrap your `->verifyIdentity()` calls within a try/catch to prevent users from seeing these exceptions.

By default, this library does not expose information in the exception message that would leak personally identifiable information, however this can be enabled if you are confident that the exception is properly handled (e.g. is being forwarded to a GDPR-compliant logging service). Sometimes this level of detail is necessary to determine why the API request failed.

You can enable logging of this information via the exception message with the following configuration:

```php
$service = new ID3Global\Service\GlobalAuthenticationService;

// Must be set before calling ->verifyIdentity()
$service->setVerboseExceptionHandling(true);

// Either way, regardless of whether or not you enable verbose exception handling, IdentityVerificationFailureException will still contain the response
try {
    $service->verifyIdentity($identity, 'customer reference');
} catch (IdentityVerificationFailureException $e) {
    /** @var stdClass $response */
    $response = $e->getResponse();
}
```
