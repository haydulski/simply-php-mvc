<?php

namespace app\core\form;

use app\core\Model;

class Form
{
    public static function begin($method, $action): Form
    {
        echo "<form method ='$method' action='$action'>";
        return new Form();
    }

    public static function end(): void
    {
        echo "</form>";
    }

    public function field(Model $model, $attribute): Field
    {
        return new Field($model, $attribute);
    }
}
