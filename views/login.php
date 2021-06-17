<?php
// @var $model app\models\LoginForm 

use app\core\form\Form;

$form = Form::begin("POST", ""); ?>
<div class="row">

    <?php
    echo $form->field($model, 'email')->email();
    echo $form->field($model, 'password')->password(); ?>
    <div>
        <button type="submit" class="btn btn-primary mt-4">Log in</button>
    </div>
</div>
<?php
Form::end();
?>