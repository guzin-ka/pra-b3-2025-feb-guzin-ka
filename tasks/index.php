<?php require_once 'head.php'; ?> <!-- Including the head section -->
<?php require_once 'header.php'; ?> <!-- Including the header section -->

<body>
    <!-- Display a message if there is one in the query string -->
    <?php 
    if (isset($_GET['message'])) {
        echo "<p style='color: green;'>" . htmlspecialchars($_GET['message']) . "</p>";
    }
    ?>

    <h1>Content of the page goes here</h1>
</body>

</html>

