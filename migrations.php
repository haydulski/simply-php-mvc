<?php
require_once __DIR__ . "/vendor/autoload.php";

use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
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


$app->db->applyMigrations();
