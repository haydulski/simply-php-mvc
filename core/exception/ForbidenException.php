<?php

namespace app\core\exception;

class ForbidenException extends \Exception
{

    protected int $code = 403;
    protected string $message = 'This page is forbbiden for unlogged users';
}
