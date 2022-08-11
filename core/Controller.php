<?php

namespace app\core;

use app\core\middlewares\BaseMiddleware;

class Controller
{
    public string $layout = 'main';
    public array $middlewares = [];
    public string $action = '';

    public function render($view, $params = null): Aplication
    {
        return Aplication::$app->router->renderViewOutside($view, $params);
    }

    public function setLayout($layout): void
    {
        $this->layout = $layout;
    }

    public function registerMiddleware(BaseMiddleware $middles): void
    {
        $this->middlewares[] = $middles;
    }
}
