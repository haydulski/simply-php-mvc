<?php

use app\core\form\Form;
use app\core\form\TodoSelectStatus;

$form = Form::begin("POST", "");
$this->title = "Edit task";
?>
<div class="row">
    <div class="col-12">

        <div class="row">

            <?php
            echo new TodoSelectStatus($model, 'status'); ?>
            <div>
                <button type="submit" class="btn btn-primary mt-4">Change status</button>
            </div>
        </div>
        <?php
        Form::end();
        ?>
    </div>
</div>