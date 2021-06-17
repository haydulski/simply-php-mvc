<?php

namespace app\core\form;

use app\core\Model;

class Field
{
    public Model $model;
    public string $attribute;
    public const TYPE_PASS = "password";
    public const TYPE_TXT = "text";
    public const TYPE_EMAIL = "email";
    public string $type = 'text';


    public function __construct(Model $model, $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }
    public function __toString()
    {

        return sprintf(
            '
        <div class="form-group">
            <label class="form-label">%s</label>
            <input type="%s"  name="%s" value="%s" class="form-control %s">
            <div class="invalid-feedback">%s</div>    
        </div>
        ',
            $this->model->labels()[$this->attribute] ?? $this->attribute,
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->model->getFirstError($this->attribute)
        );
    }
    public function password()
    {
        $this->type = self::TYPE_PASS;
        return $this;
    }
    public function email()
    {
        $this->type = self::TYPE_EMAIL;
        return $this;
    }
}
