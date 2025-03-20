<!--create.php -->
<?php require_once 'head.php'; ?>

    <body>
    <?php require_once 'header.php'; ?>

    <div class="container">
    <h1>Create New Task</h1>
    <form action="create.php" method="POST">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea>

    <label for="department">Department:</label>
    <input type="text" id="department" name="department" required>

    <label for="deadline">Deadline:</label>
    <input type="date" id="deadline" name="deadline">

    <button type="submit" name="submit">Create Task</button>
    </form>

    <?php
        require_once 'tasksController.php';

        if (isset($_POST['submit'])) {
            // Sanitize input
            $title = htmlspecialchars(trim($_POST['title']));
            $description = htmlspecialchars(trim($_POST['description']));
            $department = htmlspecialchars(trim($_POST['department']));
            $deadline = isset($_POST['deadline']) ? $_POST['deadline'] : null;

            // Create the task controller object
            $taskController = new TasksController();

            // Validate form data
            if (!empty($title) && !empty($description) && !empty($department)) {
            // Call create method
                $taskController->createTask($title, $description, $department, $deadline);
                echo "<p>Task created successfully!</p>";
            } else {
                echo "<p>Please fill all required fields.</p>";
            }
        }
    ?>
    </div>
    </body>
</html>
<style>
     .container {
        max-width: 600px;
        margin: 50px auto;
        background: white;
        padding: 30px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h1 {
        text-align: center;
        color: #333;
    }

    label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }

    input, textarea {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button {
        display: block;
        width: 100%;
        padding: 10px;
        margin-top: 20px;
        background-color: #4486D1;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #235083;
    }
</style>
