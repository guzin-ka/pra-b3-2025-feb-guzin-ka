<?php 
session_start(); 

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "takenlijst"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username']; 
    $pass = $_POST['password']; 

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $user); 
    $stmt->execute(); 
    $result = $stmt->get_result(); 

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); 

        if ($pass === $row['password']) {
            $_SESSION['user_id'] = $row['id']; 
            $_SESSION['username'] = $row['username']; 

            header("Location: index.php");
            exit(); 
        } else {
            echo "Invalid password."; 
        }
    } else {
        echo "No user found with that username."; 
    }

    $stmt->close(); 
}

$conn->close(); 
?>

