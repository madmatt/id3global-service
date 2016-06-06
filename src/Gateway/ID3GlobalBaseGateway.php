<?php
namespace ID3Global\Gateway;

use ID3Global\Gateway\SoapClient\ID3GlobalSoapClient;

abstract class ID3GlobalBaseGateway {
    /**
     * @var \ID3Global\Gateway\SoapClient\ID3GlobalSoapClient
     */
    private $client;

    private $pilotSiteWsdl = 'https://pilot.id3global.com/ID3gWS/ID3global.svc?wsdl';

    private $liveSiteWsdl = '';

    public function __construct($username, $password, $soapClientOptions = array(), $usePilotSite = false) {
        if((bool)$usePilotSite) {
            $wsdl = $this->pilotSiteWsdl;
        } else {
            $wsdl = $this->liveSiteWsdl;
        }

        $defaultOptions = array(
            'soap_version' => SOAP_1_1,
            'exceptions' => true,
            // We always enable trace so that requests and responses can be logged if required by calling applications
            'trace' => true
        );

        $soapClientOptions = array_merge($defaultOptions, $soapClientOptions);

        $this->setClient(new ID3GlobalSoapClient($wsdl, $username, $password, $soapClientOptions));
    }

    public function setClient(ID3GlobalSoapClient $client) {
        $this->client = $client;
        return $this;
    }

    public function getClient() {
        return $this->client;
    }
}
