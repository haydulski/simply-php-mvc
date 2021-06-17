<?php

namespace app\core;

class Response
{
    public int $damian = 8;
    public function setResponse(int $code)
    {
        http_response_code($code);
    }
    public function redirect(string $url)
    {
        header('Location:' . $url);
    }
}
