<?php

namespace Core;
class Router {
    // array of routes
    protected $routes = [];

    // adding to array some route using method, url and route to controller
    public function add($method, $uri, $controller) {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method
        ];
  }

  // simplifying method to add 'GET' route
  public function get($uri, $controller) {
        $this->add('GET', $uri, $controller);
  }

  // 'POST' route
  public function post($uri, $controller) {
         $this->add('POST', $uri, $controller);
  }

  // 'DELETE' route
  public function delete($uri, $controller) {
         $this->add('DELETE', $uri, $controller);
  }

  // 'PATCH' route
  public function patch($uri, $controller) {
         $this->add('PATCH', $uri, $controller);
  }

  // 'PUT' route
  public function put($uri, $controller) {
         $this->add('PUT', $uri, $controller);
  }

  // routing to some page
  public function route($uri, $method) {
        // searching for route
      foreach ($this->routes as $route) {
          // if methods and uri are equal
          if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
              return require base_path($route['controller']);
          }
      }

      //abort (we haven't found matched uri)
      $this->abort();
  }

  // comfortable way to call an unknown page
  protected function abort ($code = 404) {
    http_response_code($code);
    require base_path("views/{$code}.php");
    die();
}
}

