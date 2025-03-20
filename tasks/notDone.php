<?php require_once 'head.php'; ?>
<body>
    <!-- Header Section -->
    <?php require_once 'header.php'; ?>

    <!-- Main Content Section -->
    <div class="container">
        <h1>Not Done Tasks</h1>

        <?php
        // Database configuration
        require_once '../backend/config.php';

        try {
            $conn = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Fetch tasks where the status is 'todo'
            $stmt = $conn->prepare("SELECT * FROM taken WHERE STATUS = 'todo'");
            $stmt->execute();
            
            // Display tasks
            $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($tasks) {
                echo "<ul>";
                foreach ($tasks as $task) {
                    // Ensure we don't pass null to htmlspecialchars
                    $title = htmlspecialchars($task['title'] ?? 'N/A');
                    $department = htmlspecialchars($task['department'] ?? 'N/A');
                    $status = htmlspecialchars($task['status'] ?? 'N/A');
                    $deadline = htmlspecialchars($task['deadline'] ?? 'N/A');

                    echo "<li><strong>$title</strong><br>
                          Department: $department<br>
                          Status: $status<br>
                          Deadline: $deadline</li><br>";
                }
                echo "</ul>";
            } else {
                echo "<p>No tasks are pending or in progress.</p>";
            }
        } catch (PDOException $e) {
            echo "Error fetching tasks: " . $e->getMessage();
        }
        ?>
    </div>

</body>
</html>
