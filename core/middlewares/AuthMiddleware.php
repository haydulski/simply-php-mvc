<?php

namespace app\core\middlewares;

use app\core\Aplication;
use app\core\exception\ForbidenException;

class AuthMiddleware extends BaseMiddleware
{
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }
    public function execute()
    {

        if (Aplication::isGuest()) {
            if (empty($this->actions) || in_array(Aplication::$app->controller->action, $this->actions)) {
                Aplication::$app->response->setResponse(403);
                throw new ForbidenException();
            }
        }
    }
}
