<?php

namespace ID3Global\Gateway\SoapClient;

use ID3Global\Gateway\Request\AuthenticateSPRequest;
use SoapClient;

/**
 * @method AuthenticateSP(AuthenticateSPRequest $request)
 */
class ID3GlobalSoapClient extends SoapClient
{
    public function __construct($wsdl, $username, $password, $options = [])
    {
        parent::__construct($wsdl, $options);

        $this->__setSoapHeaders([
            new ID3WsseAuthHeader($username, $password),
        ]);
    }
}
