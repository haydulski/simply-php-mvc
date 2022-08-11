<?php
require_once __DIR__ . "/../vendor/autoload.php";

use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;
use app\models\User;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    "userClass" => User::class,
    "db" => [
        "dsn" => $_ENV['DB_DSN'],
        "user" => $_ENV['DB_USER'],
        "pass" => $_ENV['DB_PASS']
    ]
];

$path = __DIR__;
$app = new Application($path, $config);

$app->router->get('/', [SiteController::class, 'handleHome']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'contact']);
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/profile', [AuthController::class, 'profile']);
$app->router->post('/profile', [AuthController::class, 'profile']);
$app->router->get('/addtodo', [AuthController::class, 'addNewTodo']);
$app->router->post('/addtodo', [AuthController::class, 'addNewTodo']);
$app->router->get('/edittodo', [AuthController::class, 'editTodo']);
$app->router->post('/edittodo', [AuthController::class, 'editTodo']);

$app->run();
