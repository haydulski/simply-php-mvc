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
<!-- 
<form action="" method="POST">
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
        </div>
        <div class="col-6">
            <label class="form-label">Surname</label>
            <input type="text" class="form-control" name="surname">
        </div>
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" name="email">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword2" class="form-label">Confirm password</label>
        <input type="password" name="passwordConfirm" class="form-control" id="exampleInputPassword2">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="checkbox">
        <label class="form-check-label" for="exampleCheck1">I'm am human beign</label>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form> -->