<?php

declare(strict_types=1);

namespace ID3Global\Gateway\SoapClient;

use SoapHeader;
use SoapVar;
use stdClass;

class ID3WsseAuthHeader extends SoapHeader
{
    /**
     * @var string The WSSE XML namespace to be added to each SoapVar.
     */
    private string $wsseNamespace = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd';

    /**
     * @param string $username The username for the ID3global API.
     * @param string $password The password for the ID3global API.
     * @param ?string $ns The XSSE namespace (if not the default)
     */
    public function __construct(string $username, string $password, ?string $ns = '')
    {
        if ($ns) {
            $this->wsseNamespace = $ns;
        }

        $auth = new stdClass();
        $auth->Username = new SoapVar($username, XSD_STRING, '', $this->wsseNamespace, '', $this->wsseNamespace);
        $auth->Password = new SoapVar($password, XSD_STRING, '', $this->wsseNamespace, '', $this->wsseNamespace);

        $usernameToken = new stdClass();
        $usernameToken->UsernameToken = new SoapVar(
            $auth,
            SOAP_ENC_OBJECT,
            '',
            $this->wsseNamespace,
            'UsernameToken',
            $this->wsseNamespace
        );

        $token = new SoapVar(
            $usernameToken,
            SOAP_ENC_OBJECT,
            '',
            $this->wsseNamespace,
            'UsernameToken',
            $this->wsseNamespace
        );

        $security = new SoapVar($token, SOAP_ENC_OBJECT, '', $this->wsseNamespace, 'Security', $this->wsseNamespace);

        parent::__construct($this->wsseNamespace, 'Security', $security, true);
    }
}
