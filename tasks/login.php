<?php require_once 'head.php'; ?> <!-- Including the head section -->
<?php require_once 'header.php'; ?> <!-- Including the header section -->

<body>
    <h2>Login</h2>
    <form method="post" action="loginController.php">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br><br>
        
        <input type="submit" value="Login">
    </form>
</body>
</html>
