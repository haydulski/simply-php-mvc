<?php

namespace app\core\form;

use app\core\Model;

class TodoSelectStatus extends BaseField
{
    public function __construct(Model $model, $attribute)
    {
        parent::__construct($model, $attribute);
    }

    public function renderInput(): string
    {
        return '
        <select class="form-select" aria-label="todo status select" name="status" required>
            <option value="">Chose status of task</option>
            <option value="-1">To do</option>
            <option value="0">In progress</option>
            <option value="1">Completed</option>
        </select>
        ';
    }
}
