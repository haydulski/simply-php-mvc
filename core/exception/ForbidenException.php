<?php

namespace app\core\exception;

class ForbidenException extends \Exception
{

    protected $code = 403;
    protected $message = 'This page is forbbiden for unlogged users';
}
