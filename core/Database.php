<?php

namespace app\core;

use function PHPSTORM_META\map;

class Database
{
    public \PDO $pdo;

    public function __construct(array $log)
    {
        $this->pdo = new \PDO($log['dsn'], $log['user'], $log['pass']);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations(): void
    {
        $this->createMigrationTable();
        $applied = $this->getAplliedMigrations();
        $files = scandir(Application::$ROOT_DIR . "/migrations");
        $toApplied = array_diff($files, $applied);
        $newMigrations = [];

        foreach ($toApplied as $migration) {
            print_r($migration);
            if ($migration === '.' || $migration === "..") {
                continue;
            }
            require_once Application::$ROOT_DIR . "/migrations/" . $migration;
            $class = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $class();
            $instance->up();
            $newMigrations[] = $migration;
        }
        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            echo "All migrations are up to date";
        }
    }

    public function createMigrationTable(): void
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS `migrations` ( `id` INT NOT NULL AUTO_INCREMENT , `migration` VARCHAR(255) NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = MyISAM; ");
    }

    public function getAplliedMigrations(): array|false
    {
        $statment = $this->pdo->prepare("SELECT migration FROM migrations");
        $statment->execute();

        return $statment->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $mgs): void
    {
        $str = implode(",", array_map(fn ($m) => "('$m')", $mgs));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $str");
        $statement->execute();
    }
}
