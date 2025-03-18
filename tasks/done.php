<?php require_once 'head.php'; ?>

<body>
    <header>
        <nav>
            <div class="taskList">
                <a href="create.php" id="new-task" class="task-link">Create New Task</a>
                <a href="done.php" id="completed-tasks" class="task-link">Completed Tasks</a>
                <a href="index.php" id="not-done-tasks" class="task-link">Home</a>
                <a href="edit.php" id="edit-task" class="task-link">Edit Task</a>
                <a href="delete.php" id="delete-task" class="task-link">Delete Task</a>
                <a href="filter.php" id="filter-tasks" class="task-link">Filter Tasks</a>
            </div>
            <h1>Welkom bij DeveloperLand!</h1>
            <img src="logo-big-v3.png" width="200" height="200">
        </nav>
    </header>

    <div class="container">
        <h1>Klaar lijst</h1>
        
        <a href="index.php">Terug naar lijst</a>

        <?php
        // Database configuration
        require_once '../backend/config.php';

        try {
            $conn = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Fetch done tasks
            $stmt = $conn->prepare("SELECT * FROM taken WHERE status = 'done'");
            $stmt->execute();
            
            // Display tasks
            $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($tasks) {
                echo "<ul>";
                foreach ($tasks as $task) {
                    echo "<li><strong>" . htmlspecialchars($task['titel']) . "</strong><br>
                          Department: " . htmlspecialchars($task['afdeling']) . "<br>
                          Status: " . htmlspecialchars($task['status']) . "</li><br>";
                }
                echo "</ul>";
            } else {
                echo "No done tasks.";
            }
        } catch (PDOException $e) {
            echo "Error fetching: " . $e->getMessage();
        }
        ?>
    </div>
</body>
</html>
