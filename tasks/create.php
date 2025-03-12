<!doctype html>
<html lang="en">

<head>
    <title>Add New Task</title>
    <?php require_once '../head.php'; ?>
</head>

<body>
    
    <div class="container">
        <h1>Add New Task</h1>
        
        <form action="create.php" method="POST">
            <div class="form-group">
                <label for="titel">Title</label>
                <input type="text" id="titel" name="titel" required class="form-control">
            </div>
            <div class="form-group">
                <label for="beschrijving">Description</label>
                <textarea id="beschrijving" name="beschrijving" required class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="afdeling">Department</label>
                <select id="afdeling" name="afdeling" required class="form-control">
                    <option value="personnel">Personnel</option>
                    <option value="hospitality">Hospitality</option>
                    <option value="technology">Technology</option>
                    <option value="procurement">Procurement</option>
                    <option value="customer_service">Customer Service</option>
                    <option value="green">Green</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Add Task</button>
        </form>

        <?php
        // Include tasksController
        require_once 'tasksController.php';

        if (isset($_POST['submit'])) {
            $taskController = new TasksController();
            $taskController->createTask($_POST);
        }
        ?>
    </div>

</body>
</html>

