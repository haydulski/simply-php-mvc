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
    <button type="submit" class="btn btn-primary mt-4">Register</button>
</div>
<?php
Form::end();
?>