<?php
namespace ID3Global\Gateway\SoapClient;

class ID3GlobalSoapClient extends \SoapClient {
    public function __construct($wsdl, $username, $password, $options = array()) {
        parent::__construct($wsdl, $options);

        $this->__setSoapHeaders(array(
            new ID3WsseAuthHeader($username, $password)
        ));
    }
}
