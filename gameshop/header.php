<!DOCTYPE html>
<html lang="en">
<head>
    <title>DSG's Gameshop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">
<?php
$pageName = basename($_SERVER['PHP_SELF'], '.php');
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">DSG's Gameshop</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li <?php echo $pageName == 'index' ? 'class="active"' : '' ?> ><a href="index.php">Products <span class="sr-only">(current)</span></a></li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
            <?php
            if(isset($_SESSION['member'])){
              echo "
                <li class='user user-menu'>
                  <a href='inaccount.php'>In account</a>
                </li>
                <li><a href='logout.php'>| Logout</a></li>
              ";
            }
            else{
              echo "
                <li><a href='login.php'>LOGIN</a></li>
              ";
            }
          ?>
            </ul>
        </div>
    </div>
</nav>