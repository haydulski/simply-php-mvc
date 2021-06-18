<?php

namespace app\core;

use app\core\middlewares\BaseMiddleware;

class Controller
{
    public string $layout = 'main';
    public array $middlewares = [];
    public string $action = '';
    public function render($view, $params = null)
    {
        return Aplication::$app->router->renderViewOutside($view, $params);
    }
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
    public function registerMiddleware(BaseMiddleware $middles)
    {
        $this->middlewares[] = $middles;
    }
}
