<?php
namespace ID3Global\Service;

abstract class ID3BaseService
{
    /**
     * @var bool Set to true to use the ID3 'pilot' (aka. staging or test) site for all API calls. By default, with this
     * value set to false all API calls are made against the live API.
     */
    private $pilotSiteEnabled = false;

    /**
     * @var string
     */
    private $apiUsername;

    /**
     * @var string
     */
    private $apiPassword;

    public function getPilotSiteEnabled()
    {
        return (bool)$this->pilotSiteEnabled;
    }

    public function setPilotSiteEnabled($bool = true)
    {
        if (!is_bool($bool)) {
            $bool = false;
        }

        $this->pilotSiteEnabled = $bool;
        return $this;
    }

    public function getApiUsername()
    {
        return $this->apiUsername;
    }

    public function setApiUsername($username)
    {
        $this->apiUsername = $username;
        return $this;
    }

    public function getApiPassword()
    {
        return $this->apiPassword;
    }

    public function setApiPassword($password)
    {
        $this->apiPassword = $password;
        return $this;
    }
}
