<?php
namespace Core;

// App class for storing container
class App {
    protected static $container;

    public static function setContainer($container) {
        static::$container = $container;
    }

    public static function container() {
        return static::$container;
    }

    // new binding (repeats container syntax)

    public static function bind($key, $resolver) {
        static::container()->bind($key, $resolver);
    }

    // using binding
    public static function resolve($key) {
        return static::container()->resolve($key);
    }
}
