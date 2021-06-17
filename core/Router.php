<?php

namespace app\core;

class Router
{
    protected array $routes = [];
    public Requests $requests;
    public Response $response;
    public function __construct(Requests $requests, Response $response)
    {
        $this->requests = $requests;
        $this->response = $response;
    }
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }
    public function resolve()
    {
        $path = $this->requests->getPath();
        $method = strtolower($this->requests->getMethod());
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            $this->response->setResponse(404);
            $layout = $this->renderLayout();
            $content = $this->renderView("_404", null);
            echo str_replace('{{content}}', $content, $layout);

            exit;
        }
        if (is_string($callback)) {
            $content = $this->renderView($callback, null);
            $layout = $this->renderLayout();
            echo str_replace('{{content}}', $content, $layout);
            exit;
        }
        if (is_array($callback)) {
            Aplication::$app->controller = new $callback[0]();
            $callback[0] = Aplication::$app->controller;
        }

        echo call_user_func($callback, $this->requests, $this->response);
    }
    public function renderViewOutside($path, $params = null)
    {
        $content = $this->renderView($path, $params);
        $layout = $this->renderLayout();
        echo str_replace('{{content}}', $content, $layout);
        exit;
    }
    public function renderView($path, $params)
    {
        if ($params) {

            foreach ($params as $key => $value) {
                $$key = $value;
            }
        }
        ob_start();
        include_once Aplication::$ROOT_PATH . "/../views/$path.php";
        return ob_get_clean();
    }
    protected function renderLayout()
    {
        $layoutPath = Aplication::$app->controller->layout;
        ob_start();
        include_once Aplication::$ROOT_PATH . "/../views/layout/$layoutPath.php";
        return ob_get_clean();
    }
}
