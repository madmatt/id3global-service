<?php

declare(strict_types=1);

namespace ID3Global\Gateway\SoapClient;

use SoapClient;

/**
 * This class is a thin wrapper around PHP's built in SoapClient and the ext-soap extension. This is only required to
 * forcefully configure SOAP headers to include the custom ID3WsseAuthHeader as the built-in WSSE configuration that
 * SoapClient includes doesn't work with the ID3global API.
 *
 * @method AuthenticateSP(\ID3Global\Gateway\Request\AuthenticateSPRequest $request)
 */
class ID3GlobalSoapClient extends SoapClient
{
    /**
     * @param string $wsdl The path to the WSDL file (we always use WSDL mode). This differs for the pilot vs. live env.
     * @param string $username The ID3global username to be used.
     * @param string $password The ID3global password to be used.
     * @param array $options See https://www.php.net/manual/en/soapclient.construct.php for options.
     * @throws \SoapFault
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingTraversableTypeHintSpecification
     */
    public function __construct(string $wsdl, string $username, string $password, array $options = [])
    {
        parent::__construct($wsdl, $options);

        $this->__setSoapHeaders([
            new ID3WsseAuthHeader($username, $password),
        ]);
    }
}
