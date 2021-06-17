<?php

namespace app\core;

class Controller
{
    public string $layout = 'main';
    public function render($view, $params = null)
    {
        return Aplication::$app->router->renderViewOutside($view, $params);
    }
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
}
