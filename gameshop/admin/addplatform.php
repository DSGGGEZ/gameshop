<?php
require('lock.php');
require('../dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted data
    $platformname = $_POST['platformname'];

    // Prepare sql and bind parameters
    $sql = "INSERT INTO platform(platformname) VALUES(?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('s', $platformname);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: index.php');
    
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>DSG's Gameshop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">

    <h1>DSG's Gameshop: <small>Add Platform</small></h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="platformname">Platform</label>
            <input type="text" name="platformname" class="form-control">
        </div>
        <input class="btn btn-primary" type="submit" value="Add Platform"> 
        <a href="index.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?>
</body>
</html>