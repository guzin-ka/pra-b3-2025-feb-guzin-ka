<?php
// Include the TasksController class
require_once 'TasksController.php';  // Adjust the path accordingly

// Create task logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
    $data = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'department' => $_POST['department'],
        'deadline' => $_POST['deadline'] ?? null,  // Default to null if no deadline is provided
    ];

    $taskController = new TasksController();
    $taskController->createTask($data);
}

// Update task logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $data = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'department' => $_POST['department'],
        'deadline' => $_POST['deadline'] ?? null,
    ];
    $taskId = $_POST['task_id']; // Assuming a hidden input field with task ID is provided

    $taskController = new TasksController();
    $taskController->updateTask($data, $taskId);
}

// Delete task logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $taskId = $_POST['task_id']; // Assuming a hidden input field with task ID is provided

    $taskController = new TasksController();
    $taskController->deleteTask($taskId);
}
?>

<?php require_once 'head.php'; ?>
<body>
    <?php require_once 'header.php'; ?>

    <!-- Create Task Form -->
    <div class="container">
        <h1>Create New Task</h1>
        <form action="edit.php" method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="department">Department:</label>
            <input type="text" id="department" name="department" required>

            <label for="deadline">Deadline:</label>
            <input type="date" id="deadline" name="deadline">

            <button type="submit" name="create">Create Task</button>
        </form>
    </div>

    <!-- Update Task Form -->
    <div class="container">
        <h1>Update Task</h1>
        <form action="edit.php" method="POST">
            <label for="task_id">Task ID:</label>
            <input type="number" id="task_id" name="task_id" required>

            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="department">Department:</label>
            <input type="text" id="department" name="department" required>

            <label for="deadline">Deadline:</label>
            <input type="date" id="deadline" name="deadline">

            <button type="submit" name="update">Update Task</button>
        </form>
    </div>

    <!-- Delete Task Form -->
    <div class="container">
        <h1>Delete Task</h1>
        <form action="edit.php" method="POST">
            <label for="task_id">Task ID:</label>
            <input type="number" id="task_id" name="task_id" required>

            <button type="submit" name="delete">Delete Task</button>
        </form>
    </div>

    <?php
        // Display success message if the task was created, updated, or deleted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<p>Action was successful!</p>";
        }
    ?>

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
</body>
</html>
