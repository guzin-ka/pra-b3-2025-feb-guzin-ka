<!doctype html>
<html lang="en">

<head>
    <title>Task Overview</title>
    <?php require_once '../head.php'; ?>
</head>

<body>
    
    <div class="container">
        <h1>Task Overview (Incomplete Tasks)</h1>
        
        <a href="index.php">Back to Task List</a>

        <?php
        // Include database configuration
        require_once '../backend/config.php';

        try {
            $conn = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Query to get tasks where status is not 'done'
            $stmt = $conn->prepare("SELECT * FROM taken WHERE status <> 'done'");
            $stmt->execute();
            
            // Check if there are tasks to display
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
                echo "No tasks found that are not completed.";
            }
        } catch (PDOException $e) {
            echo "Error fetching tasks: " . $e->getMessage();
        }
        ?>
    </div>

</body>
</html>

