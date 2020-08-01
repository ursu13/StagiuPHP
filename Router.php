<?php


class Router
{

    protected $routes = [];

    public function __construct(array $routes = [])
    {
        $this->routes = $routes;
    }

    public function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @param $uri
     * @throws Exception
     */
    public function direct($uri)
    {
        if(array_key_exists($uri, $this->routes)) {
            list($class, $method) = explode('@', $this->routes[$uri]);
            $controller = new $class();
            $controller->{$method}();
        } else {
            throw new Exception("Nu am gasit pagina");
        }
    }

}