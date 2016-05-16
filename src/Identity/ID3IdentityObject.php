<?php
namespace ID3Global\Identity;

class ID3IdentityObject {
    public function __get($key) {
        if(property_exists($this, $key)) {
            return $this->$key;
        }

        // We ignore requests for keys that don't exist, as most keys are optional and don't need to be set
        return null;
    }
}
