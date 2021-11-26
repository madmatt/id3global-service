<?php

declare(strict_types=1);

namespace ID3Global\Exceptions;

use Exception;
use ID3Global\Service\GlobalAuthenticationService;
use stdClass;

/**
 * Exception generated when the identity verification response from the ID3global API fails to validate our simple
 * tests.
 *
 * CAUTION: It's important to note that the ID3global response that we return within the exception message *will*
 * contain PII (personally identifiable information) if verbose logging is enabled. For this reason, by default verbose
 * logging is disabled however you can still access the response object for your own processing during a `catch` block.
 *
 * @see GlobalAuthenticationService::verifyIdentity()
 */
class IdentityVerificationFailureException extends Exception
{
    private stdClass $response;

    /**
     * @param stdClass $response The full response object returned by ID3global. Very useful for later debugging.
     */
    public function __construct(stdClass $response, bool $verbose = false)
    {
        if ($verbose) {
            $message = sprintf(
                'Invalid Response returned by ID3global API. Serialized response: %s',
                serialize($response)
            );
        } else {
            $message = 'Invalid Response returned by ID3global API. Verbose logging of API response not enabled.';
        }

        $this->response = $response;

        parent::__construct($message);
    }

    public function getResponse(): stdClass
    {
        return $this->response;
    }
}
