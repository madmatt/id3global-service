<?php
namespace ID3Global\Exceptions;

class IdentityVerificationFailureException extends \Exception {
    private $response;

    public function __construct($response) {
        $this->response = $response;
        $message = sprintf("Invalid Response returned by ID3Global API. Serialized response: %s", serialize($response));
        parent::__construct($message);
    }

    public function getResponse() {
        return $this->response;
    }
}
