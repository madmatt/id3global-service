<?php

declare(strict_types=1);

namespace ID3Global\Gateway;

use ID3Global\Gateway\SoapClient\ID3GlobalSoapClient;

abstract class ID3GlobalBaseGateway
{
    /**
     * @var ID3GlobalSoapClient The custom SoapClient sub-class used to ensure the correct wsse:Security headers exist.
     */
    private ID3GlobalSoapClient $client;

    private string $pilotSiteWsdl = 'https://pilot.id3global.com/ID3gWS/ID3global.svc?wsdl';

    private string $liveSiteWsdl = 'https://id3global.com/ID3gWS/ID3global.svc?wsdl';

    /**
     * @param string $username The username for the ID3global API.
     * @param string $password The password for the ID3global API.
     * @param array $options See https://www.php.net/manual/en/soapclient.construct.php for options.
     * @param bool $usePilotSite true to use the ID3Global API pilot (test) environment, false to use production env.
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingTraversableTypeHintSpecification
     * @throws \SoapFault
     */
    public function __construct(string $username, string $password, array $options = [], bool $usePilotSite = false)
    {
        if ($usePilotSite) {
            $wsdl = $this->pilotSiteWsdl;
        } else {
            $wsdl = $this->liveSiteWsdl;
        }

        $defaultOptions = [
            'soap_version' => SOAP_1_1,
            'exceptions' => true,

            // We always enable trace so that requests and responses can be logged if required by calling applications
            'trace' => true,
        ];

        $soapClientOptions = array_merge($defaultOptions, $options);

        $this->setClient(new ID3GlobalSoapClient($wsdl, $username, $password, $soapClientOptions));
    }

    public function setClient(ID3GlobalSoapClient $client): ID3GlobalBaseGateway
    {
        $this->client = $client;

        return $this;
    }

    public function getClient(): ID3GlobalSoapClient
    {
        return $this->client;
    }
}
