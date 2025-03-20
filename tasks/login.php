<?php require_once 'head.php'; ?>
<body>
    <!-- Header Section -->
    <?php require_once 'header.php'; ?>

    <!-- Login Form Section -->
    <h1>Hello, this is the login page. You need to log in to access other pages.</h1>

    <?php
    // Check if there is an error passed through query parameters
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'emptyfields') {
            echo "<p style='color:red;'>Please fill in all fields.</p>";
        } elseif ($_GET['error'] == 'invalidcredentials') {
            echo "<p style='color:red;'>Invalid login credentials.</p>";
        }
    }
    ?>

    <!-- Login Form -->
    <form action="loginController.php" method="POST">
        <label for="username">Username: </label>
        <input type="text" id="username" name="username" required>
        <br>

        <label for="password">Password: </label>
        <input type="password" id="password" name="password" required>
        <br>

        <button type="submit">Log in</button>
    </form>
</body>
</html>

