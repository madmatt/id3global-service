<?php
namespace ID3Global\Gateway;

use ID3Global\Gateway\SoapClient\ID3GlobalSoapClient;

abstract class ID3GlobalBaseGateway {
    /**
     * @var \ID3Global\Gateway\SoapClient\ID3GlobalSoapClient
     */
    private $client;

    public function __construct($wsdl = null) {
        if(!is_null($wsdl)) {
            $this->setClient(new ID3GlobalSoapClient($wsdl));
        }
    }

    public function setClient(ID3GlobalSoapClient $client) {
        $this->client = $client;
        return $this;
    }
}
