<?php
namespace ID3Global\Identity;

class ID3IdentityObject {
    public function __get($key) {
        $funcName = sprintf("get%s", ucfirst($key));

        if(method_exists($this, $funcName)) {
            return $this->$funcName();
        }

        // We ignore requests for keys that don't exist, as most keys are optional and don't need to be set
        return null;
    }
}
