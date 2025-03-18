<!-- create.php -->
<?php require_once 'head.php'; ?>

<body>
    <?php require_once 'header.php'; ?>

    <div class="container">
        <h1>Create New Task</h1>
        <form action="create.php" method="POST">
            <label for="titel">Title:</label>
            <input type="text" id="titel" name="titel" required>

            <label for="beschrijving">Description:</label>
            <textarea id="beschrijving" name="beschrijving" required></textarea>

            <label for="afdeling">Department:</label>
            <input type="text" id="afdeling" name="afdeling" required>

            <label for="deadline">Deadline:</label>
            <input type="date" id="deadline" name="deadline">

            <button type="submit" name="submit">Create Task</button>
        </form>

        <?php
        require_once '../backend/tasksController.php';

        if (isset($_POST['submit'])) {
            // Sanitize input
            $titel = htmlspecialchars(trim($_POST['titel']));
            $beschrijving = htmlspecialchars(trim($_POST['beschrijving']));
            $afdeling = htmlspecialchars(trim($_POST['afdeling']));
            $deadline = isset($_POST['deadline']) ? $_POST['deadline'] : null;

            // Create the task controller object
            $taskController = new TasksController();

            // Validate form data
            if (!empty($titel) && !empty($beschrijving) && !empty($afdeling)) {
                // Call create method
                $taskController->createTask($titel, $beschrijving, $afdeling, $deadline);
                echo "<p>Task created successfully!</p>";
            } else {
                echo "<p>Please fill all required fields.</p>";
            }
        }
        ?>
    </div>
</body>
</html>


