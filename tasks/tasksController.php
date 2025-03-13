<?php

class TasksController {

    private $conn;

    public function __construct() {
        // Database configuratie
        require_once '../backend/config.php';

        try {
            $this->conn = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Databaseverbinding mislukt: " . $e->getMessage();
        }
    }

    public function createTask($data) {
        // Invoer validatie
        $titel = htmlspecialchars($data['titel']);
        $beschrijving = htmlspecialchars($data['beschrijving']);
        $afdeling = htmlspecialchars($data['afdeling']);

        if (empty($titel) || empty($beschrijving) || empty($afdeling)) {
            echo "<p>Alle velden zijn vereist!</p>";
            return;
        }

        try {
            // Voeg taak toe aan de database
            $stmt = $this->conn->prepare("INSERT INTO taken (titel, beschrijving, afdeling, status, created_at) 
                                         VALUES (:titel, :beschrijving, :afdeling, 'todo', NOW())");

            $stmt->bindParam(':titel', $titel);
            $stmt->bindParam(':beschrijving', $beschrijving);
            $stmt->bindParam(':afdeling', $afdeling);

            // Voer de statement uit
            $stmt->execute();

            echo "<p>Taak succesvol toegevoegd!</p>";

        } catch (PDOException $e) {
            echo "Fout bij het maken van de taak: " . $e->getMessage();
        }
    }
}

?>

