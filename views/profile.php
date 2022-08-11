<?php

use app\models\TodoForm;

$this->title = "profile" ?>

<?php
$toDoForm1 =  new TodoForm();
$todoList = $toDoForm1->getAllTasks();
$listNumber = 0;
?>

<div class="row mb-5 mt-5">
    <div class="col-12">
        <h1>Profile page</h1>
    </div>
</div>
<div class="row mt-5">
    <div class="col-12 ">
        <h2>Hi <?php echo $name; ?> , your TODO list:</h2>
    </div>
</div>
<div class="row">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Task</th>
                <th scope="col">Status</th>
                <th scope="col">Edit</th>
                <th scope="col">Remove</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($todoList as $todo) : ?>
                <tr>
                    <?php $listNumber += 1; ?>
                    <th scope="row"><?php echo $listNumber; ?></th>
                    <td class="td-task"><?php echo $todo['task'] ?></td>
                    <td class="td-status">
                        <?php if ($todo['status'] === '-1') : ?>
                            <p class="btn btn-danger">To do</p>
                        <?php elseif ($todo['status'] === '1') : ?>
                            <p class="btn btn-success">Complete</p>
                        <?php else : ?>
                            <p class="btn btn-info">In progress</p>
                        <?php endif; ?>
                    </td>
                    <td class="td-edit"><a href="/edittodo?id=<?php echo $todo['ID'] ?>" class="btn btn-outline-warning"><i class="bi bi-pencil-square"></i></a> </td>
                    <td class="td-remove">
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?php echo $todo['ID'] ?>">
                            <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
    <div class="row">
        <div class="col-12">
            <a href="/addtodo" class="btn btn-secondary">Add new task</a>
        </div>
    </div>
</div>