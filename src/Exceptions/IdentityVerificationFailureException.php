<?php

namespace ID3Global\Exceptions;

use Exception;
use stdClass;

class IdentityVerificationFailureException extends Exception
{
    private stdClass $response;

    public function __construct($response)
    {
        $this->response = $response;
        $message = sprintf('Invalid Response returned by ID3global API. Serialized response: %s', serialize($response));
        parent::__construct($message);
    }

    public function getResponse(): stdClass
    {
        return $this->response;
    }
}
