<!doctype html>
<html lang="en">

<head>
    <title>Task List</title>
    <?php require_once '../head.php'; ?>
</head>

<body>
    
    <div class="container">
        <h1>Task List</h1>
        
        <a href="create.php">New Task</a><br>
        <a href="done.php">Completed Tasks</a>
        <a href="notDone.php">Not Done Tasks</a> 

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
