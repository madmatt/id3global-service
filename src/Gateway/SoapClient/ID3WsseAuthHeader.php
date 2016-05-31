<?php
namespace ID3Global\Gateway\SoapClient;

class ID3WsseAuthHeader extends \SoapHeader {
    private $wsseNamespace = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd';

    public function __construct($username, $password, $ns = null) {
        if($ns) {
            $this->wsseNamespace = $ns;
        }

        $auth = new \stdClass();
        $auth->Username = new \SoapVar($username, XSD_STRING, null, $this->wsseNamespace, null, $this->wsseNamespace);
        $auth->Password = new \SoapVar($password, XSD_STRING, null, $this->wsseNamespace, null, $this->wsseNamespace);

        $usernameToken = new \stdClass();
        $usernameToken->UsernameToken = new \SoapVar($auth, SOAP_ENC_OBJECT, null, $this->wsseNamespace, 'UsernameToken', $this->wsseNamespace);

        $token = new \SoapVar($usernameToken, SOAP_ENC_OBJECT, null, $this->wsseNamespace, 'UsernameToken', $this->wsseNamespace);

        $security = new \SoapVar($token, SOAP_ENC_OBJECT, null, $this->wsseNamespace, 'Security', $this->wsseNamespace);

        parent::__construct($this->wsseNamespace, 'Security', $security, true);
    }
}
