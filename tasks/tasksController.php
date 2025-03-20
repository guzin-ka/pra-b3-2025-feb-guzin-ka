<?php

class TasksController
{
    private $conn;

    public function __construct()
    {
        // Database configuration
        require_once '../backend/config.php';

        try {
            $this->conn = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new RuntimeException("Database connection failed: " . $e->getMessage(), 0, $e);
        }
    }

    // Add task
    public function createTask(array $data)
    {
        $title = $this->validateString($data['title']);
        $description = $this->validateString($data['description']);
        $department = $this->validateString($data['department']);
        $status = isset($data['status']) ? $this->validateString($data['status']) : 'todo';  // Default value 'todo'
        $deadline = $this->validateString($data['deadline']);

        if (empty($title) || empty($description) || empty($department)) {
            throw new InvalidArgumentException("All fields are required!");
        }

        try {
            $stmt = $this->conn->prepare("INSERT INTO taken (title, description, department, status, created_at, deadline)
                                          VALUES (:title, :description, :department, 'todo', NOW(), :deadline)");

            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':department', $department);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':deadline', $deadline);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new RuntimeException("Error creating task: " . $e->getMessage(), 0, $e);
        }
    }

    // Update task
    public function updateTask(array $data, int $id)
    {
        $title = $this->validateString($data['title']);
        $description = $this->validateString($data['description']);
        $department = $this->validateString($data['department']);
        $status = isset($data['status']) ? $this->validateString($data['status']) : 'todo';  // Default value 'todo'
        $deadline = $this->validateString($data['deadline']);

        if (empty($title) || empty($description) || empty($department)) {
            throw new InvalidArgumentException("All fields are required!");
        }

        try {
            $stmt = $this->conn->prepare("UPDATE taken SET title = :title, description = :description, department = :department, status = :status, deadline = :deadline WHERE id = :id");

            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':department', $department);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':deadline', $deadline);
            $stmt->bindParam(':id', $id);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new RuntimeException("Error updating task: " . $e->getMessage(), 0, $e);
        }
    }

    // Delete task
    public function deleteTask(int $id)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM taken WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new RuntimeException("Error deleting task: " . $e->getMessage(), 0, $e);
        }
    }

    // Fetch all tasks
    public function getTasks()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM taken");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new RuntimeException("Error fetching tasks: " . $e->getMessage(), 0, $e);
        }
    }

    private function validateString(string $input)
    {
        return htmlspecialchars($input, ENT_QUOTES);
    }
}
