<?php
require('lock.php');
require('../dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted data
    $mid = $_POST['mid'];
    $mpassword = $_POST['mpassword'];
    $mname = $_POST['mname'];
    $address = $_POST['address'];
    $balance = $_POST['balance'];

    // Prepare sql and bind parameters
    $sql = "INSERT INTO member(mid,mpassword,mname,address,balance) VALUES(?,?,?,?,?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('ssssi', $mid,$mpassword,$mname,$address,$balance);
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

    <h1>DSG's Gameshop: <small>Add Member</small></h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="mid">mid</label>
            <input type="text" name="mid" class="form-control">
        </div>
        <div class="form-group">
            <label for="mpassword">password</label>
            <input type="text" name="mpassword" class="form-control">
        </div>
        <div class="form-group">
            <label for="mname">Member Name</label>
            <input type="text" name="mname" class="form-control">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control">
        </div>
            <input type="hidden" name="balance" class="form-control" value=0>
        <input class="btn btn-primary" type="submit" value="Add Member"> 
        <a href="index.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?>
</body>
</html>