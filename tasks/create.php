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
        require_once '../backend/tasksController.php';

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


