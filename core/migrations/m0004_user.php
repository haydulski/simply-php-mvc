<?php

use app\core\Aplication;

class m0004_user
{
    public function up(): void
    {
        $db = Aplication::$app->db;
        $db->pdo->exec("CREATE TABLE IF NOT EXISTS `User` 
        ( `ID` INT NOT NULL AUTO_INCREMENT ,
        `Name` VARCHAR(255) NOT NULL,
        `Surname` VARCHAR(255) NOT NULL ,
        `Email` VARCHAR(191) NOT NULL UNIQUE,
        `Password` VARCHAR(512),
        `Status` SMALLINT NOT NULL,
        `Date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
        PRIMARY KEY (`ID`)) ENGINE = MyISAM;");

        echo "User table added" . PHP_EOL;
    }

    public function down(): string
    {
        return "Function down";
    }
}
