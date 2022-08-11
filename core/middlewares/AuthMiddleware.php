<?php

namespace app\core\middlewares;

use app\core\Application;
use app\core\exception\ForbidenException;

class AuthMiddleware extends BaseMiddleware
{
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute(): void
    {

        if (Application::isGuest()) {
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                Application::$app->response->setResponse(403);
                throw new ForbidenException();
            }
        }
    }
}
