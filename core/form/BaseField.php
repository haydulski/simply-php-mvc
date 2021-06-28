<?php

namespace app\core\form;

use app\core\Model;

abstract class BaseField
{
    public Model $model;

    public function __construct(Model $model, $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    abstract function renderInput(): string;

    public function __toString()
    {

        return sprintf(
            '
        <div class="form-group">
            <label class="form-label">%s</label>
            %s
            <div class="invalid-feedback">%s</div>    
        </div>
        ',
            $this->model->labels()[$this->attribute] ?? $this->attribute,
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)
        );
    }
}
