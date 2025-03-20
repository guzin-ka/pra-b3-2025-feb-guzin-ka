<?php require_once 'head.php'; ?> <!-- Including the head section -->
<?php require_once 'header.php'; ?> <!-- Including the header section -->

<body>
    <!-- Display a message if there is one in the query string -->
    <?php 
    // Check if a 'message' query string is set and display it
    if (isset($_GET['message'])) {
        echo "<p style='color: green;'>" . htmlspecialchars($_GET['message']) . "</p>";
    }

    // Check if user is logged in (you can set this after login success in your login logic)
    session_start();
    if (isset($_SESSION['username'])) {
        echo "<p style='color: green;'>Login succesvol, welkom " . htmlspecialchars($_SESSION['username']) . "!</p>";
    }
    ?>

    <h1>Content of the page goes here</h1>

</body>

</html>

