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

    // Taak toevoegen
    public function createTask($data) {
        // Invoer validatie
        $titel = htmlspecialchars($data['titel']);
        $beschrijving = htmlspecialchars($data['beschrijving']);
        $afdeling = htmlspecialchars($data['afdeling']);
        $deadline = htmlspecialchars($data['deadline']); // Haal deadline op

        if (empty($titel) || empty($beschrijving) || empty($afdeling)) {
            echo "<p>Alle velden zijn vereist!</p>";
            return;
        }

        try {
            // Voeg taak toe aan de database
            $stmt = $this->conn->prepare("INSERT INTO taken (titel, beschrijving, afdeling, status, created_at, deadline) 
                                         VALUES (:titel, :beschrijving, :afdeling, 'todo', NOW(), :deadline)");

            $stmt->bindParam(':titel', $titel);
            $stmt->bindParam(':beschrijving', $beschrijving);
            $stmt->bindParam(':afdeling', $afdeling);
            $stmt->bindParam(':deadline', $deadline);  // Bind de deadline

            // Voer de statement uit
            $stmt->execute();

            echo "<p>Taak succesvol toegevoegd!</p>";

        } catch (PDOException $e) {
            echo "Fout bij het maken van de taak: " . $e->getMessage();
        }
    }

    // Taak bijwerken
    public function updateTask($data, $id) {
        // Invoer validatie
        $titel = htmlspecialchars($data['titel']);
        $beschrijving = htmlspecialchars($data['beschrijving']);
        $afdeling = htmlspecialchars($data['afdeling']);
        $deadline = htmlspecialchars($data['deadline']); // Haal de deadline op

        if (empty($titel) || empty($beschrijving) || empty($afdeling)) {
            echo "<p>Alle velden zijn vereist!</p>";
            return;
        }

        try {
            // Update de taak in de database
            $stmt = $this->conn->prepare("UPDATE taken SET titel = :titel, beschrijving = :beschrijving, afdeling = :afdeling, deadline = :deadline WHERE id = :id");

            $stmt->bindParam(':titel', $titel);
            $stmt->bindParam(':beschrijving', $beschrijving);
            $stmt->bindParam(':afdeling', $afdeling);
            $stmt->bindParam(':deadline', $deadline);
            $stmt->bindParam(':id', $id);

            // Voer de statement uit
            $stmt->execute();

            echo "<p>Taak succesvol bijgewerkt!</p>";
        } catch (PDOException $e) {
            echo "Fout bij het bijwerken van de taak: " . $e->getMessage();
        }
    }

    // Taak verwijderen
    public function deleteTask($id) {
        try {
            // Verwijder taak uit de database
            $stmt = $this->conn->prepare("DELETE FROM taken WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            echo "<p>Taak succesvol verwijderd!</p>";
        } catch (PDOException $e) {
            echo "Fout bij het verwijderen van de taak: " . $e->getMessage();
        }
    }
}
?>
