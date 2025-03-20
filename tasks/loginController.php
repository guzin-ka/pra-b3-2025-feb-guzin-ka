<?php
session_start(); // Start the session to store user data

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "takenlijst";  // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];   // Get the username from the form
    $pass = $_POST['password'];   // Get the password from the form

    // Query to check if the user exists in the database
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);   // Bind the username parameter
    $stmt->execute();
    $result = $stmt->get_result();   // Execute the query

    // Check if the user is found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();   // Fetch user data

        // Check if the password matches the one in the database
        if ($pass === $row['password']) {
            // If the login is successful, store user data in the session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];

            // Redirect to the homepage with a success message
            header("Location: index.php?message=Login+succesvol");
            exit();
        } else {
            echo "Ongeldig wachtwoord.";  // Invalid password
        }
    } else {
        echo "Geen gebruiker gevonden met die naam.";  // No user found
    }

    $stmt->close();
}

$conn->close();  // Close the database connection
?>
