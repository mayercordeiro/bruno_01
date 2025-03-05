<?php

namespace Src;

class Router
{
    private $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => [],
    ];

    // Registra uma rota e a sua ação para o método HTTP especificado
    public function addRoute($method, $uri, $controller, $action)
    {
        $this->routes[$method][$uri] = ['controller' => $controller, 'action' => $action];
    }

    // Executa a rota correspondente à URI e ao método HTTP
    public function route($uri, $method)
    {
        $uri = parse_url($uri, PHP_URL_PATH); // Remove query strings

        // Verifica se a rota existe para o método e a URI
        if (isset($this->routes[$method][$uri])) {
            $route = $this->routes[$method][$uri];

            // Instancia o controlador e chama a ação
            $controller = new $route['controller']();
            call_user_func([$controller, $route['action']]);
        } else {
            echo "Página não encontrada!";
        }
    }
}
