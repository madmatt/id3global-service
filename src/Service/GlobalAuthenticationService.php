<?php
namespace ID3Global\Service;

class GlobalAuthenticationService extends ID3BaseService {
    /**
     * @var \ID3Global\Identity\IdentityContainer
     */
    private $identity;

    /**
     * @param \ID3Global\Identity\IdentityContainer $identity
     * @return GlobalAuthenticationService
     */
    public function setIdentity($identity) {
        $this->identity = $identity;
        return $this;
    }
}
