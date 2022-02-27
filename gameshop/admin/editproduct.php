<?php
require('lock.php');
require('../dbconnect.php');
$idgame = $_GET['idgame'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted data
    
    $gid = $_POST['gid'];
    $idplatform = $_POST['idplatform'];
    $idgametype = $_POST['idgametype'];
    $iddevcompany = $_POST['iddevcompany'];
    $gamename = $_POST['gamename'];
    $picture = $_POST['picture'];
    $price = $_POST['price'];

    // Prepare sql and bind parameters
    $sql = "UPDATE game SET gid = ? , idplatform =? , idgametype = ? , iddevcompany = ? , gamename = ? , picture = ? , price = ? WHERE idgame = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('siiissii', $gid, $idplatform, $idgametype, $iddevcompany, $gamename, $picture, $price, $idgame);
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
    <?php
        $sql = "select * from game where idgame = '$idgame'";
        $res = $conn->query($sql);
        $line = $res->fetch_assoc();
    ?>
    <h1>DSG's Gameshop: <small>Edit product</small></h1>

    <form method="post" class="form">
        <input type="hidden" class="idgame" name="idgame">
        <div class="form-group">
            <label for="gid">Game ID</label>
            <input type="text" name="gid" class="form-control" value="<?php echo $line['gid'] ?>">
        </div>
        <div class="form-group">
            <label for="gamename">Game name</label>
            <input type="text" name="gamename" class="form-control" value="<?php echo $line['gamename'] ?>">
        </div>
        <div class="form-group">
            <label for="idplatform">Platform</label>
            <select name="idplatform" class="form-control" value="<?php echo $line['idplatform'] ?>">
                <?php
                $idplatform = $conn->query('select idplatform, platformname from platform');
                while($row = $idplatform->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row['idplatform'] ?>"><?php echo $row['platformname'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="idgametype">Type</label>
            <select name="idgametype" class="form-control" value="<?php echo $line['idgametype'] ?>"> 
                <?php
                $idtypes = $conn->query('select idgametype, gametype from gametype');
                while($row = $idtypes->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row['idgametype'] ?>"><?php echo $row['gametype'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="iddevcompany">Developer Company</label>
            <select name="iddevcompany" class="form-control" value="<?php echo $line['iddevcompany'] ?>">
                <?php
                $iddevcompany = $conn->query('select iddevcompany, devcompanyname from devcompany');
                while($row = $iddevcompany->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row['iddevcompany'] ?>"><?php echo $row['devcompanyname'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="picture">Picture</label>
            <input type="text" name="picture" class="form-control" value="<?php echo $line['picture'] ?>">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" value="<?php echo $line['price'] ?>">
        </div>
        <input class="btn btn-primary" type="submit" value="Edit product"> 
        <a href="index.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?>
</body>
</html>