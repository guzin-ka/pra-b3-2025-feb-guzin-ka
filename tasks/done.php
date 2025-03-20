<?php require_once 'head.php'; ?>
<body>
    <!-- Header Section -->
    <?php require_once 'header.php'; ?>

    <!-- Main Content Section -->
    <div class="container">
        <h1>Done Tasks</h1>

        <?php
        // Database configuration
        require_once '../backend/config.php';

        try {
            $conn = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Fetch only tasks with the status 'done'
            $stmt = $conn->prepare("SELECT * FROM taken WHERE status = 'done'");
            $stmt->execute();
            
            // Display tasks
            $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($tasks) {
                echo "<ul>";
                foreach ($tasks as $task) {
                    echo "<li><strong>" . htmlspecialchars($task['title']) . "</strong><br>
                          Department: " . htmlspecialchars($task['department']) . "<br>
                          Status: " . htmlspecialchars($task['status']) . "<br>
                          Deadline: " . htmlspecialchars($task['deadline']) . "</li><br>";
                }
                echo "</ul>";
            } else {
                echo "<p>No tasks are marked as done.</p>";
            }
        } catch (PDOException $e) {
            echo "Error fetching tasks: " . $e->getMessage();
        }
        ?>
    </div>

</body>
</html>

