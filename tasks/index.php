<!doctype html>
<html lang="en">
<link rel="stylesheet" href="../css/main.css">
<head>
    <title>Task List</title>
    <?php require_once 'head.php'; ?>
</head>
<header>
    <nav>
        <div class="taskList">
            <a href="create.php" id="new-task" style="padding: 5px; width: 150px; text-decoration: none;">New Task</a>
            <a href="done.php" id="completed-tasks" style="padding: 5px; text-decoration: none;">Completed Tasks</a>
            <a href="notDone.php" id="not-done-tasks" style="padding: 5px; text-decoration: none;">Not Done Tasks</a>
        </div>
        <h1>Welkom bij DeveloperLand!</h1>
        <img src="logo-big-v3.png" width="200" height="200">
    </nav>
</header>
<body>
    
    <div class="container">


        <?php
        // Configuratie inladen
        require_once '../backend/config.php';

        try {
            $conn = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Haal taken op
            $stmt = $conn->prepare("SELECT * FROM taken");
            $stmt->execute();
            
            // Print taken
            echo "<ul>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<li><strong>" . htmlspecialchars($row['titel']) . "</strong>: " . htmlspecialchars($row['beschrijving']) . " (Status: " . htmlspecialchars($row['status']) . ")</li>";
            }
            echo "</ul>";
        } catch (PDOException $e) {
            echo "Error fetching: " . $e->getMessage();
        }
        ?>
    </div>
</body>
</html>
