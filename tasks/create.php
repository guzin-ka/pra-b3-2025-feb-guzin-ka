<!doctype html>
<html lang="en">

<head>
    <title>New Task</title>
    <?php require_once 'head.php'; ?>
</head>
<header>
    <nav>
        <div class="taskList">
            <a href="index.php" id="new-task" style="padding: 5px; width: 150px; text-decoration: none;">HOME</a>
            <a href="done.php" id="completed-tasks" style="padding: 5px; text-decoration: none;">Completed Tasks</a>
            <a href="notDone.php" id="not-done-tasks" style="padding: 5px; text-decoration: none;">Not Done Tasks</a>
        </div>
        <h1>Welkom bij DeveloperLand!</h1>
        <img src="logo-big-v3.png" width="200" height="200">
    </nav>
</header>

<body>
    
    <div class="container">
        <h1>Maak een nieuwe taak:</h1>
        
        <form action="create.php" method="POST">
            <div class="form-group">
                <label for="titel">Taak:</label>
                <input type="text" id="titel" name="titel" required class="form-control">
            </div>
            <div class="form-group">
                <label for="beschrijving">Beschrijving</label>
                <textarea id="beschrijving" name="beschrijving" required class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="afdeling">Afdeling</label>
                <select id="afdeling" name="afdeling" required class="form-control">
                    <option value="ongeselecteerd">ongeselecteerd</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Verzend</button>
        </form>

        <?php
        require_once 'tasksController.php'; // Controller loading

        if (isset($_POST['submit'])) {
            $taskController = new TasksController(); // Create object
            $taskController->createTask($_POST); // Create task
        }
        ?>
    </div>

</body>
</html>


