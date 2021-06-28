<?php $this->title = "profile" ?>
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
            <tr>
                <th scope="row">1</th>
                <td class="td-task">Odbierz pranie</td>
                <td class="td-status">
                    <p class="btn btn-danger">To do</p>
                </td>
                <td class="td-edit"><button class="btn btn-outline-warning"><i class="bi bi-pencil-square"></i></button> </td>
                <td class="td-remove"><button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button></td>
            </tr>
            <tr>
                <th scope="row">1</th>
                <td class="td-task">Odbierz pranie</td>
                <td class="td-status">

                    <p class="btn btn-info">In progress</p>

                </td>
                <td class="td-edit"><button class="btn btn-outline-warning"><i class="bi bi-pencil-square"></i></button> </td>
                <td class="td-remove"><button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button></td>
            </tr>
            <tr>
                <th scope="row">1</th>
                <td class="td-task">Odbierz pranie</td>
                <td class="td-status">
                    <p class="btn btn-success">Complete</p>
                </td>
                <td class="td-edit"><button class="btn btn-outline-warning"><i class="bi bi-pencil-square"></i></button> </td>
                <td class="td-remove"><button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button></td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-secondary">Add new task</button>
        </div>
    </div>
</div>