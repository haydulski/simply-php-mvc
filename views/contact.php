<?php
// @var $model app\models\LoginForm 

use app\core\form\Form;
use app\core\form\TextField;

$this->title = 'Contact';

$form = Form::begin("POST", "");
?>
<div class="row">
    <h1>Contact</h1>
    <?php
    echo $form->field($model, 'email')->email();
    echo new TextField($model, 'message'); ?>
    <div class="form-group mt-2">
        <label class="form-label">Proove you are human and solve addition:</label>
        <input class="form-control" type="text" name="passtext" id="passtext" placeholder="2 + 8 =">
    </div>

    <div>
        <button type="submit" class="btn btn-primary mt-4">Submit</button>
    </div>
</div>
<?php
Form::end();
?>