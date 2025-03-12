<!doctype html>
<html lang="en">

<head>
    <title>Task List</title>
    <?php require_once '../head.php'; ?>
</head>

<body>
    
    <div class="container">
        <h1>Task List</h1>
        
        <a href="create.php">Add New Task</a>
        
        <?php
        // Include the configuration file
        require_once '../backend/config.php';

        try {
            $conn = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Fetch all tasks from the database
            $stmt = $conn->prepare("SELECT * FROM taken");
            $stmt->execute();
            
            // Display tasks
            echo "<ul>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<li><strong>" . htmlspecialchars($row['titel']) . "</strong>: " . htmlspecialchars($row['beschrijving']) . " (Status: " . htmlspecialchars($row['status']) . ")</li>";
            }
            echo "</ul>";
        } catch (PDOException $e) {
            echo "Error retrieving tasks: " . $e->getMessage();
        }
        ?>
    </div>

</body>
</html>
