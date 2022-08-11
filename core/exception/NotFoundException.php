<?php

namespace app\core\exception;

class NotFoundException extends \Exception
{

    protected int $code = 404;
    protected string $message = 'This page dont exist';
}
