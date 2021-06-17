<?php

namespace app\core;

class Session
{
    private const MESSAGE_FLASH = "flash_message";
    public function __construct()
    {
        session_start();
        $flashMess = $_SESSION[self::MESSAGE_FLASH] ?? [];
        foreach ($flashMess as $key => &$message) {
            $message['remove'] = true;
        }
        $_SESSION[self::MESSAGE_FLASH] = $flashMess;
    }
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    public function get($key)
    {
        return $_SESSION[$key] ?? false;
    }
    public function remove($key)
    {
        unset($_SESSION[$key]);
    }
    public function setFlash($key, $value)
    {
        $_SESSION[self::MESSAGE_FLASH][$key] = [
            'remove' => false,
            'value' => $value
        ];
    }
    public function getFlash($key)
    {
        return $_SESSION[self::MESSAGE_FLASH][$key]['value'] ?? null;
    }
    public function __destruct()
    {
        $flashMess = $_SESSION[self::MESSAGE_FLASH] ?? [];
        foreach ($flashMess as $key => &$message) {
            if ($message['remove']) {
                unset($flashMess[$key]);
            }
        }
        $_SESSION[self::MESSAGE_FLASH] = $flashMess;
    }
}
