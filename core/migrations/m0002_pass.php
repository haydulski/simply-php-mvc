<?php

use app\core\Aplication;

class m0002_pass
{
    public function up()
    {
        $db = Aplication::$app->db;
        $db->pdo->exec("ALTER TABLE `migrations` ADD COLUMN `password` VARCHAR(512 ) NULL DEFAULT NULL");
        echo "Password added" . PHP_EOL;
    }
    public function down()
    {
        return "Function down";
    }
}
