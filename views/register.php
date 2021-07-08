<?php

use app\core\form\Form;

$form = Form::begin("POST", "");
$this->title = "Register";
?>
<div class="row">
    <!-- <div class="row"> -->
    <div class="col"><?php echo $form->field($model, 'name'); ?></div>
    <div class="col"><?php echo $form->field($model, 'surname'); ?></div>
    <!-- </div> -->
    <?php
    echo $form->field($model, 'email')->email();
    echo $form->field($model, 'password')->password();
    echo $form->field($model, 'passwordConfirm')->password(); ?>
    <div class="form-group mt-2">
        <label class="form-label">Proove you are human and solve addition:</label>
        <input class="form-control" type="text" name="passtext" id="passtext" placeholder=" 2 + 8 =">
    </div>
    <button type="submit" class="btn btn-primary mt-4">Register</button>
</div>
<?php
Form::end();
?>