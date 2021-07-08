<?php
// @var $model app\models\LoginForm 

use app\core\form\Form;

$form = Form::begin("POST", "");
$this->title = "Login";
?>
<div class="row">

    <?php
    echo $form->field($model, 'email')->email();
    echo $form->field($model, 'password')->password(); ?>
    <div class="form-group mt-2">
        <label class="form-label">Proove you are human and solve addition:</label>
        <input class="form-control" type="text" name="passtext" id="passtext" placeholder="2 + 8 =">
    </div>
    <div>
        <button type="submit" class="btn btn-primary mt-4">Log in</button>
    </div>
</div>
<?php
Form::end();
?>