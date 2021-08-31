<?php

namespace App\mvc;

use App\mvc\exceptions\NotFoundException;

/**
 * Class Router
 */
class Router
{
    private Request $request;
    private Response $response;
    private array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $url, $callback)
    {
        $this->routes['get'][$url] = $callback;
    }

    public function post(string $url, $callback)
    {
        $this->routes['post'][$url] = $callback;
    }

    public function resolveRoute()
    {
        $method = $this->request->method();
        $url = $this->request->url();

        $callback = $this->routes[$method][$url] ?? false;

        if (!$callback) {
            throw new NotFoundException();
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $controller = new $callback[0];
            $controller->action = $callback[1];
            App::$app->controller = $controller;
            $callback[0] = $controller;
        }
        return call_user_func($callback, $this->request, $this->response);
    }

    public function renderView($view, $params = [])
    {
        return App::$app->view->renderView($view, $params);
    }

    public function renderViewOnly($view, $params = [])
    {
        return App::$app->view->renderOnlyView($view, $params);
    }
}