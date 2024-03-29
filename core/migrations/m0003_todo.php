 <?php

    use app\core\Application;

    class m0003_todo
    {
        public function up(): void
        {
            $db = Application::$app->db;
            $db->pdo->exec(
                "CREATE TABLE IF NOT EXISTS `todo`
                (`ID` INT NOT NULL AUTO_INCREMENT ,
                `userID` INT NOT NULL,
                `task` VARCHAR(512) NOT NULL ,
                `status` SMALLINT NOT NULL ,
                `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
                PRIMARY KEY (`ID`)) ENGINE = MyISAM;"
            );

            echo "Todo added" . PHP_EOL;
        }

        public function down(): string
        {
            return "Function down";
        }
    }
