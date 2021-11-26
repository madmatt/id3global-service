<?php

declare(strict_types=1);

namespace ID3Global\Identity;

class ID3IdentityObject
{
    /**
     * Generic getter for all internal data types. A method needs to exist on the subclass to return the value. We need
     * to suppress the DisallowedMixedTypeHint phpcs sniff as we may return a number of different things from this
     * method (int, string, array or object).
     *
     * @param string $key The key to look for (e.g. 'FirstName' will need a method called 'getFirstName' to exist)
     * @return mixed
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.DisallowMixedTypeHint.DisallowedMixedTypeHint
     */
    public function __get(string $key)
    {
        $funcName = sprintf('get%s', ucfirst($key));

        if (method_exists($this, $funcName)) {
            return $this->$funcName();
        }

        // We ignore requests for keys that don't exist, as most keys are optional and don't need to be set
        return null;
    }
}
