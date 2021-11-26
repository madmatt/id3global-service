<?php

declare(strict_types=1);

namespace ID3Global\Service;

abstract class ID3BaseService
{
    /**
     * @var bool Set to true to use the ID3 'pilot' (aka. staging or test) site for all API calls. By default, with this
     * value set to false all API calls are made against the live API.
     */
    private bool $pilotSiteEnabled = false;

    /**
     * @var string The API username used to authenticate with the ID3global API.
     */
    private string $apiUsername;

    /**
     * @var string The API username used to authenticate with the ID3global API.
     */
    private string $apiPassword;

    public function getPilotSiteEnabled(): bool
    {
        return (bool) $this->pilotSiteEnabled;
    }

    public function setPilotSiteEnabled(bool $bool = true): ID3BaseService
    {
        $this->pilotSiteEnabled = $bool;

        return $this;
    }

    public function getApiUsername(): string
    {
        return $this->apiUsername;
    }

    public function setApiUsername(string $username): ID3BaseService
    {
        $this->apiUsername = $username;

        return $this;
    }

    public function getApiPassword(): string
    {
        return $this->apiPassword;
    }

    public function setApiPassword(string $password): ID3BaseService
    {
        $this->apiPassword = $password;

        return $this;
    }
}
