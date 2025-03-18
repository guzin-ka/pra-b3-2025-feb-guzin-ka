<?php require_once 'head.php'; ?>
<body>
    <!-- Header Section -->
    <?php require_once 'header.php'; ?>

    <!-- Main Content Section -->
    <div class="container">
        <h1>Afmaken lijst</h1>
        
        <a href="index.php">Terug naar lijst</a>

        <?php
        // Database configuration
        require_once '../backend/config.php';

        try {
            $conn = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Fetch tasks
            $stmt = $conn->prepare("SELECT * FROM taken WHERE status <> 'done'");
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
                echo "No not done tasks.";
            }
        } catch (PDOException $e) {
            echo "Error fetching: " . $e->getMessage();
        }
        ?>
    </div>

</body>
</html>
