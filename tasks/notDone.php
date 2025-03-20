<?php
// Beveiligde pagina
session_start();

// Controleer of de gebruiker ingelogd is
if (!isset($_SESSION['user_id'])) {
    // Gebruiker is niet ingelogd, doorsturen naar de inlogpagina
    header("Location: login.php");
    exit();
}

// De rest van je pagina-code voor ingelogde gebruikers
?>


<?php require_once 'head.php'; ?>
<body>
    <!-- Header Section -->
    <?php require_once 'header.php'; ?>

    <!-- Main Content Section -->
    <div class="container">
        <h1>not done tasks</h1>

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
                    echo "<li><strong>" . htmlspecialchars($task['title']) . "</strong><br>
                          Department: " . htmlspecialchars($task['department']) . "<br>
                          Status: " . htmlspecialchars($task['status']) . "</li><br>";
                }
                echo "</ul>";
            } 
        } catch (PDOException $e) {
            echo "Error fetching: " . $e->getMessage();
        }
        ?>
    </div>

</body>
</html>
