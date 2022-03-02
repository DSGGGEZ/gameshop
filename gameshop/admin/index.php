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
    <style>
        /* Dropdown Button */
.dropbtn {
  background-color: #04AA6D;
  color: white;
  padding: 10px;
  font-size: 10px;
  border: none;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  font-size: 12px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {background-color: #3e8e41;}
    </style>
</head>
<body class="container">
<?php
$idplatform = isset($_GET['idplatform']) ? $_GET['idplatform'] : "";
$idgametype = isset($_GET['idgametype']) ? $_GET['idgametype'] : "";
$iddevcompany = isset($_GET['iddevcompany']) ? $_GET['iddevcompany'] : "";
if ($idgametype != "" && $idplatform != "" && $iddevcompany != "") {
    $sql = "SELECT * FROM game LEFT JOIN platform ON platform.idplatform=game.idplatform LEFT JOIN gametype ON game.idgametype = gametype.idgametype LEFT JOIN devcompany ON game.iddevcompany = devcompany.iddevcompany where game.idplatform = '$idplatform' and game.idgametype = '$idgametype' and game.iddevcompany = '$iddevcompany'";
}
else if ($idgametype != "" && $idplatform != "") {
    $sql = "SELECT * FROM game LEFT JOIN platform ON platform.idplatform=game.idplatform LEFT JOIN gametype ON game.idgametype = gametype.idgametype LEFT JOIN devcompany ON game.iddevcompany = devcompany.iddevcompany where game.idplatform = '$idplatform' and game.idgametype = '$idgametype'";
}
else if ($idgametype != "" && $iddevcompany != "") {
    $sql = "SELECT * FROM game LEFT JOIN platform ON platform.idplatform=game.idplatform LEFT JOIN gametype ON game.idgametype = gametype.idgametype LEFT JOIN devcompany ON game.iddevcompany = devcompany.iddevcompany where game.idgametype = '$idgametype' and game.iddevcompany = '$iddevcompany'";
}
else if ($idplatform != "" && $iddevcompany != "") {
    $sql = "SELECT * FROM game LEFT JOIN platform ON platform.idplatform=game.idplatform LEFT JOIN gametype ON game.idgametype = gametype.idgametype LEFT JOIN devcompany ON game.iddevcompany = devcompany.iddevcompany where game.idplatform = '$idplatform' and game.iddevcompany = '$iddevcompany'";
}
else if ($iddevcompany != "") {
    $sql = "SELECT * FROM game LEFT JOIN platform ON platform.idplatform=game.idplatform LEFT JOIN gametype ON game.idgametype = gametype.idgametype LEFT JOIN devcompany ON game.iddevcompany = devcompany.iddevcompany where game.iddevcompany = '$iddevcompany'";
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
    <nav class="navbar navbar-default">
    <div class="container-fluid">
    <h1>DSG's Gameshop Admin </h1>
    <h4><a href="member.php" >Member</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="index.php" >Product</a><h4>
    <a href="logout.php" class="btn btn-danger pull-right" style="margin-left: 10px">Logout</a>
    
    <div class="dropdown">
        <button class="dropbtn">Add Data</button>
        <div class="dropdown-content">
            <a href="addmember.php" >Add Member</a>
            <a href="addproduct.php" >Add Product</a>
            <a href="addcom.php" >Add Devcompany</a>
            <a href="addtype.php" >Add GameType</a>
            <a href="addplatform.php" >Add Platform</a>
        
        </div>
    </div>

    
    </div>
    <br>
</div>
<div class="container-fluid">
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
        DevCompany:
        <select name="iddevcompany" class="form-control">
            <option value="">All</option>
            <?php
            $iddevcompany = $conn->query('select iddevcompany, devcompanyname from devcompany');
            while($row = $iddevcompany->fetch_assoc()) {
                ?>
                <option value="<?php echo $row['iddevcompany'] ?>"><?php echo $row['devcompanyname'] ?></option>
                <?php
            }
            ?>
        </select> &nbsp;
        <input class="btn btn-primary" type="submit" value="Filter">
    </form>
        </div>

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
<script type="text/javascript" src="js/bootstrap/bootstrap-dropdown.js"></script>
<script>
$('.dropdown-toggle').dropdown()
</script>
</body>
</html>
