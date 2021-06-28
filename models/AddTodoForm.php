<?php

namespace app\models;

use app\core\Aplication;
use app\core\Model;

class AddTodoForm extends Model
{
    public string $task = '';
    public string $status = '';
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
    // public function addNewTask()
}
