<?php
    require('session.php');
    require('dbconnect.php');

    $idgame = $_GET['idgame'];
    $mid = $_SESSION['member'];
    
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    $sql = "INSERT INTO member_has_game(mid , idgame) VALUES (? , ?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('si',$mid,$idgame);
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

    <h1>DSG's Gameshop: <small>Buy product</small></h1>

    <?php
    $sql = "select gamename from game where idgame = $idgame";
    $gamename = $conn->query($sql);
    $row = $gamename->fetch_assoc();
    ?>
    <p>Buy '<?php echo $row['gamename'] ?>'?</p>

    <form method="post" class="form">
            <input class="btn btn-danger" type="submit" value="BUY">
        <a href="index.php" class="btn btn-default">Cancel</a>
    </form>

<?php
$conn->close();
?>
</body>
</html>