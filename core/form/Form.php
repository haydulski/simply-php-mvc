<?php

namespace app\core\form;

use app\core\Model;

class Form
{
    public static function begin($method, $action)
    {
        echo "<form method ='$method' action='$action'>";
        return new Form();
    }
    public static function end()
    {
        echo "</form>";
    }
    public function field(Model $model, $attribute)
    {
        return new Field($model, $attribute);
    }
}
