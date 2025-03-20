<?php
class TasksController {
    private $conn;

    public function __construct() {
        // Database configuration
        require_once '../backend/config.php';

        try {
            $this->conn = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Database connection failed: " . $e->getMessage();
        }
    }

    // Add task
    public function createTask($data) {
        // Input validation
        $title = htmlspecialchars($data['title']);
        $description = htmlspecialchars($data['description']);
        $department = htmlspecialchars($data['department']);
        $deadline = htmlspecialchars($data['deadline']); // Get deadline

        if (empty($title) || empty($description) || empty($department)) {
            echo "<p>All fields are required!</p>";
            return;
        }

        try {
            // Add task to database
            $stmt = $this->conn->prepare("INSERT INTO taken (title, description, department, status, created_at, deadline)
                                          VALUES (:title, :description, :department, 'todo', NOW(), :deadline)");

            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':department', $department);
            $stmt->bindParam(':deadline', $deadline); // Bind the deadline

            // Execute the statement
            $stmt->execute();

            echo "<p>Task added successfully!</p>";
        } catch (PDOException $e) {
            echo "Error creating task: " . $e->getMessage();
        }
    }

    // Update task
    public function updateTask($data, $id) {
        // Input validation
        $title = htmlspecialchars($data['title']);
        $description = htmlspecialchars($data['description']);
        $department = htmlspecialchars($data['department']);
        $deadline = htmlspecialchars($data['deadline']); // Get the deadline

        if (empty($title) || empty($description) || empty($department)) {
            echo "<p>All fields are required!</p>";
            return;
        }

        try {
            // Update the task in the database
            $stmt = $this->conn->prepare("UPDATE taken SET title = :title, description = :description, department = :department, deadline = :deadline WHERE id = :id");

            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':department', $department);
            $stmt->bindParam(':deadline', $deadline);
            $stmt->bindParam(':id', $id);

            // Execute the statement
            $stmt->execute();

            echo "<p>Task updated successfully!</p>";
        } catch (PDOException $e) {
            echo "Error updating task: " . $e->getMessage();
        }
    }

    // Delete task
    public function deleteTask($id) {
        try {
            // Delete task from the database
            $stmt = $this->conn->prepare("DELETE FROM taken WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            echo "<p>Task successfully deleted!</p>";
        } catch (PDOException $e) {
            echo "Error deleting task: " . $e->getMessage();
        }
    }

    // Fetch all tasks
    public function getTasks() {
        try {
            // Fetch all tasks from the database
            $stmt = $this->conn->prepare("SELECT * FROM taken");
            $stmt->execute();

            // Fetch the results as an associative array
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching tasks: " . $e->getMessage();
            return [];
        }
    }
}
?>
