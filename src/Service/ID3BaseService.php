<?php

namespace ID3Global\Service;

abstract class ID3BaseService
{
    /**
     * @var bool Set to true to use the ID3 'pilot' (aka. staging or test) site for all API calls. By default, with this
     *           value set to false all API calls are made against the live API.
     */
    private bool $pilotSiteEnabled = false;

    /**
     * @var string
     */
    private string $apiUsername;

    /**
     * @var string
     */
    private string $apiPassword;

    public function getPilotSiteEnabled(): bool
    {
        return (bool) $this->pilotSiteEnabled;
    }

    public function setPilotSiteEnabled($bool = true): ID3BaseService
    {
        if (!is_bool($bool)) {
            $bool = false;
        }

        $this->pilotSiteEnabled = $bool;

        return $this;
    }

    public function getApiUsername(): string
    {
        return $this->apiUsername;
    }

    public function setApiUsername($username): ID3BaseService
    {
        $this->apiUsername = $username;

        return $this;
    }

    public function getApiPassword(): string
    {
        return $this->apiPassword;
    }

    public function setApiPassword($password): ID3BaseService
    {
        $this->apiPassword = $password;

        return $this;
    }
}
