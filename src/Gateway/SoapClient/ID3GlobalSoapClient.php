<?php
namespace ID3Global\Gateway\SoapClient;

use ID3Global\Gateway\Request\AuthenticateSPRequest;
use SoapClient;

/**
 * @method AuthenticateSP(AuthenticateSPRequest $request)
 */
class ID3GlobalSoapClient extends SoapClient {
    public function __construct($wsdl, $username, $password, $options = array()) {
        parent::__construct($wsdl, $options);

        $this->__setSoapHeaders(array(
            new ID3WsseAuthHeader($username, $password)
        ));
    }
}
