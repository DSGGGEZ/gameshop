<?php
    require('session.php');
    require('dbconnect.php');
    require('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>DSG's Gameshop | In Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">
<?php
$mid = $_SESSION['member'];
$idplatform = isset($_GET['idplatform']) ? $_GET['idplatform'] : "";
$idgametype = isset($_GET['idgametype']) ? $_GET['idgametype'] : "";
if ($idgametype != "" && $idplatform != "") {
    $sql = "SELECT * FROM member_has_game LEFT JOIN game ON game.idgame=member_has_game.idgame LEFT JOIN platform ON platform.idplatform=game.idplatform LEFT JOIN gametype ON game.idgametype = gametype.idgametype LEFT JOIN devcompany ON game.iddevcompany = devcompany.iddevcompany wheremid = '$mid' AND game.idplatform = '$idplatform' and game.idgametype = '$idgametype'";
}
else if ($idplatform != "") {
    $sql = "SELECT * FROM member_has_game LEFT JOIN game ON game.idgame=member_has_game.idgame LEFT JOIN platform ON platform.idplatform=game.idplatform LEFT JOIN gametype ON game.idgametype = gametype.idgametype LEFT JOIN devcompany ON game.iddevcompany = devcompany.iddevcompany where mid = '$mid' AND game.idplatform = '$idplatform'" ;
}
else if ($idgametype != "") {
    $sql = "SELECT * FROM member_has_game LEFT JOIN game ON game.idgame=member_has_game.idgame LEFT JOIN platform ON platform.idplatform=game.idplatform LEFT JOIN gametype ON game.idgametype = gametype.idgametype LEFT JOIN devcompany ON game.iddevcompany = devcompany.iddevcompany where mid = '$mid' AND game.idgametype = '$idgametype'";
}
else {
    $sql = "SELECT * FROM member_has_game LEFT JOIN game ON game.idgame=member_has_game.idgame LEFT JOIN platform ON platform.idplatform=game.idplatform LEFT JOIN gametype ON game.idgametype = gametype.idgametype LEFT JOIN devcompany ON game.iddevcompany = devcompany.iddevcompany WHERE mid = '$mid'";
}
$results = $conn->query($sql);
?>

    <h1>Item in Account</h1>
    <form method="get" class="form-inline">
        Type: &nbsp;
        <select name="idgametype" class="form-control">
            <option value="">All</option>
            <?php
            $type_2 = $conn->query('select idgametype,gametype from gametype');
            while($row = $type_2->fetch_assoc()) {
                ?>
                <option value="<?php echo $row['idgametype'] ?>"><?php echo $row['gametype'] ?></option>
                <?php
            }
            ?>
        </select> &nbsp;
        Platform:
        <select name="idplatform" class="form-control">
            <option value="">All</option>
            <?php
            $idplatform = $conn->query('select idplatform, platformname from platform');
            while($row = $idplatform->fetch_assoc()) {
                ?>
                <option value="<?php echo $row['idplatform'] ?>"><?php echo $row['platformname'] ?></option>
                <?php
            }
            ?>
        </select> &nbsp;
        <input class="btn btn-primary" type="submit" value="Filter">
    </form>

    <table class="table table-bordered" style="margin-top: 20px">
        <thead>
            <tr>
                <th>Product</th>
                <th>Devcompany</th>
                <th>Platform</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = $results->fetch_assoc()) {
            ?>
            <tr>
                <td>
                    <img src="images/<?php echo $row['picture'] ?>"  style="width: 30px; height: 30px; object-fit: cover;">
                    <?php echo $row['gamename'] ?>
                </td>
                <td><?php echo $row['devcompanyname'] ?></td>
                <td><?php echo $row['platformname'] ?></td>
                <td><?php echo $row['gametype'] ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
<?php
require('footer.php');
?>
</body>
</html>