<?php

class TasksController {

    private $conn;

    public function __construct() {
        // Include database configuration
        require_once '../backend/config.php';

        try {
            $this->conn = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Database connection failed: " . $e->getMessage();
        }
    }

    public function createTask($data) {
        // Input validation
        $titel = htmlspecialchars($data['titel']);
        $beschrijving = htmlspecialchars($data['beschrijving']);
        $afdeling = htmlspecialchars($data['afdeling']);

        if (empty($titel) || empty($beschrijving) || empty($afdeling)) {
            echo "<p>All fields are required!</p>";
            return;
        }

        try {
            // Insert task into database
            $stmt = $this->conn->prepare("INSERT INTO taken (titel, beschrijving, afdeling, status, created_at) 
                                         VALUES (:titel, :beschrijving, :afdeling, 'todo', NOW())");

            $stmt->bindParam(':titel', $titel);
            $stmt->bindParam(':beschrijving', $beschrijving);
            $stmt->bindParam(':afdeling', $afdeling);

            // Execute the statement
            $stmt->execute();

            echo "<p>Task added successfully!</p>";

        } catch (PDOException $e) {
            echo "Error creating task: " . $e->getMessage();
        }
    }
}

?>
