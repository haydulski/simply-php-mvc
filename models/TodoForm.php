<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;

class TodoForm extends DbModel
{
    public string $task = '';
    public string $status = '';
    public string $userID = '';
    public User $user;

    public function rules(): array
    {
        return [
            'task' => [self::RULE_REQUIRED],
        ];
    }

    public function attributes(): array
    {
        return ["task", "status"];
    }

    public function labels(): array
    {
        return ["task" => "New task", "status" => "Status of task"];
    }

    public static function tableName(): string
    {
        return "todo";
    }

    public static function primaryKey(): string
    {
        return "ID";
    }

    public function addNewTask(): bool
    {
        $this->userID = Application::$app->session->get('user');
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $attributes[] = 'userID';
        $params = array_map(fn ($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES (" . implode(',', $params) . ")");

        foreach ($attributes as $atr) {
            $statement->bindValue(":$atr", $this->{$atr});
        }
        $statement->execute();
        return true;
    }

    public function getAllTasks(): array|bool
    {
        $this->userID = Application::$app->session->get('user');

        $tableName = $this->tableName();
        $statment = self::prepare("SELECT * FROM $tableName WHERE userID LIKE $this->userID ORDER BY Date DESC");
        $statment->execute();
        $result = $statment->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function deleteTask($id): void
    {
        $tableName = $this->tableName();
        $statment = self::prepare("DELETE FROM $tableName WHERE ID = :id");
        $statment->bindValue(':id', $id);
        $statment->execute();
    }

    public function editTask($id, $newValue): bool
    {
        $tableName = $this->tableName();
        $statment = self::prepare("UPDATE $tableName SET Status = :status WHERE ID = :id");
        $statment->bindValue(':id', $id);
        $statment->bindValue(':status', $newValue);
        $statment->execute();
        return true;
    }
}
