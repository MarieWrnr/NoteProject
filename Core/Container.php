<?php

namespace Core;

// class for making new dependencies and comfortable initializing class objects
class Container {

    protected $bindings = [];

    // creates new dependence
    public function bind($key, $resolver) {
        $this->bindings[$key] = $resolver;
    }

    // calls function that is initializing class object
    public function resolve($key) {
        // if dependence does not exist
        if (!array_key_exists($key, $this->bindings)) {
            throw new \Exception("No matching binding for $key");
        }

        $resolver = $this->bindings[$key];
        return call_user_func($resolver);
    }
}

