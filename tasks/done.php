<!doctype html>
<html lang="en">

<head>
    <title>Task Overview</title>
    <?php require_once 'head.php'; ?>
</head>
<header>
    <nav>
        <div class="taskList">
            <a href="create.php" id="new-task" style="padding: 5px; width: 150px; text-decoration: none;">New Task</a>
            <a href="index.php" id="completed-tasks" style="padding: 5px; text-decoration: none;">HOME</a>
            <a href="notDone.php" id="not-done-tasks" style="padding: 5px; text-decoration: none;">Not Done Tasks</a>
        </div>
        <h1>Welkom bij DeveloperLand!</h1>
        <img src="logo-big-v3.png" width="200" height="200">
    </nav>
</header>

<body>
    
    <div class="container">
        <h1>Klaar lijst</h1>
        
        <a href="index.php">Terug naar lijst</a>

        <?php
        // Database configuration
        require_once '../backend/config.php';

        try {
            $conn = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Fetch tasks
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
