<?php
require('lock.php');
require('../dbconnect.php');
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
$idplatform = isset($_GET['idplatform']) ? $_GET['idplatform'] : "";
$idgametype = isset($_GET['idgametype']) ? $_GET['idgametype'] : "";
if ($idgametype != "" && $idplatform != "") {
    $sql = "SELECT * FROM game LEFT JOIN platform ON platform.idplatform=game.idplatform LEFT JOIN gametype ON game.idgametype = gametype.idgametype LEFT JOIN devcompany ON game.iddevcompany = devcompany.iddevcompany where game.idplatform = '$idplatform' and game.idgametype = '$idgametype'";
}
else if ($idplatform != "") {
    $sql = "SELECT * FROM game LEFT JOIN platform ON platform.idplatform=game.idplatform LEFT JOIN gametype ON game.idgametype = gametype.idgametype LEFT JOIN devcompany ON game.iddevcompany = devcompany.iddevcompany where game.idplatform = '$idplatform'";
}
else if ($idgametype != "") {
    $sql = "SELECT * FROM game LEFT JOIN platform ON platform.idplatform=game.idplatform LEFT JOIN gametype ON game.idgametype = gametype.idgametype LEFT JOIN devcompany ON game.iddevcompany = devcompany.iddevcompany where game.idgametype = '$idgametype'";
}
else {
    $sql = "SELECT * FROM game LEFT JOIN platform ON platform.idplatform=game.idplatform LEFT JOIN gametype ON game.idgametype = gametype.idgametype LEFT JOIN devcompany ON game.iddevcompany = devcompany.iddevcompany";
}
$results = $conn->query($sql);
?>

    <h1>DSG's Gameshop Admin <small>Products</small></h1>

    <a href="logout.php" class="btn btn-danger pull-right" style="margin-left: 10px">Logout</a>
    <a href="addproduct.php" class="btn btn-primary pull-right">Add product</a>
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
                <th>Price</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = $results->fetch_assoc()) {
            ?>
            <tr>
                <td>
                    <img src="../images/<?php echo $row['picture'] ?>"  style="width: 30px; height: 30px; object-fit: cover;">
                    <?php echo $row['gamename'] ?>
                </td>
                <td><?php echo $row['price'] ?></td>
                <td class="text-center">
                    <a href="editproduct.php?idgame=<?php echo $row['idgame'] ?>" class="btn btn-sm btn-info">
                        <span class="glyphicon glyphicon-edit"></span>
                    <a href="deleteproduct.php?idgame=<?php echo $row['idgame'] ?>" class="btn btn-sm btn-danger">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

<?php
$conn->close();

?>
</body>
</html>