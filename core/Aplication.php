<?php

declare(strict_types=1);

namespace app\core;

class Aplication
{
    public Router $router;
    public Requests $requests;
    public Response $response;
    public Session $session;
    public static string $ROOT_PATH;
    public static $app;
    public Controller $controller;
    public Database $db;
    public array $log;
    public static string $ROOT_DIR;
    public ?DbModel $user;
    public string $userClass;

    public function __construct($path, array $config)
    {
        self::$ROOT_PATH = $path;
        self::$ROOT_DIR = __DIR__;
        $this->requests = new Requests();
        $this->response = new Response();
        $this->router = new Router($this->requests, $this->response);
        $this->session = new Session();
        $this->userClass = $config['userClass'];
        self::$app = $this;
        $this->controller = new Controller();
        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');

        if ($primaryValue) {
            $key = $this->userClass::primaryKey();
            $this->user = $this->userClass::findUser(["$key" => "$primaryValue"]);
        } else {
            $this->user = null;
        }
    }

    public function run(): void
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            echo $this->controller->render('_error', [
                'exception' => $e
            ]);
        }
    }

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController($controller): void
    {
        $this->controller = $controller;
    }

    public function login(DbModel $user): bool
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout(): void
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest(): bool
    {
        return !self::$app->user;
    }
}
