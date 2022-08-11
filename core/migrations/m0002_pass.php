<?php

use app\core\Application;

class m0002_pass
{
    public function up(): void
    {
        $db = Application::$app->db;
        $db->pdo->exec("ALTER TABLE `migrations` ADD COLUMN `password` VARCHAR(512 ) NULL DEFAULT NULL");
        echo "Password added" . PHP_EOL;
    }

    public function down(): string
    {
        return "Function down";
    }
}
