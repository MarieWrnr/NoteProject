<?php

namespace Core;

use Core\Middleware\Guest;
use Core\Middleware\Auth;
use Core\Middleware\Middleware;

class Router
{
    // array of routes
    protected $routes = [];

    // adding to array some route using method, url and route to controller
    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];

        return $this;
    }

    // simplifying method to add 'GET' route
    public function get($uri, $controller)
    {
        return $this->add('GET', $uri, $controller);
    }

    // 'POST' route
    public function post($uri, $controller)
    {
        return $this->add('POST', $uri, $controller);
    }

    // 'DELETE' route
    public function delete($uri, $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }

    // 'PATCH' route
    public function patch($uri, $controller)
    {
        return $this->add('PATCH', $uri, $controller);
    }

    // 'PUT' route
    public function put($uri, $controller)
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
    }

    // routing to some page
    public function route($uri, $method)
    {
        // searching for route
        foreach ($this->routes as $route) {
            // if methods and uri are equal
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                // applying middleware

                Middleware::resolve($route['middleware']);

                return require base_path('Http/controllers/' . $route['controller']);
            }
        }

        //abort (we haven't found matched uri)
        $this->abort();
    }

    public function previousUrl() {
        return $_SERVER['HTTP_REFERER'];
    }

    // comfortable way to call an unknown page
    protected function abort($code = 404)
    {
        http_response_code($code);
        require base_path("views/{$code}.php");
        die();
    }
}

