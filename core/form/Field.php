<?php

namespace app\core\form;

use app\core\Model;

class Field extends BaseField
{

    public string $attribute;
    public const TYPE_PASS = "password";
    public const TYPE_TXT = "text";
    public const TYPE_EMAIL = "email";
    public string $type = 'text';

    public function __construct(Model $model, $attribute)
    {
        parent::__construct($model, $attribute);
    }


    public function renderInput(): string
    {
        return sprintf(
            '<input type="%s"  name="%s" value="%s" class="form-control %s">',
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',

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
