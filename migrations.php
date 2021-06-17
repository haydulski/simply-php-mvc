<?php
require_once __DIR__ . "/vendor/autoload.php";

use app\core\Aplication;
use app\controllers\SiteController;
use app\controllers\AuthController;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    "db" => [
        "dsn" => $_ENV['DB_DSN'],
        "user" => $_ENV['DB_USER'],
        "pass" => $_ENV['DB_PASS']
    ]
];

$path = __DIR__;
$app = new Aplication($path, $config);


$app->db->applyMigrations();
