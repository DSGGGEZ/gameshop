<?php
    require('session.php');
    require('dbconnect.php');
    require('header.php');

$sql = "SELECT * FROM game LEFT JOIN platform ON platform.idplatform=game.idplatform LEFT JOIN gametype ON game.idgametype = gametype.idgametype LEFT JOIN devcompany ON game.iddevcompany = devcompany.iddevcompany";
$results = $conn->query($sql);
?>

    <div class="row">
        <?php
        
        while ($row = $results->fetch_assoc()) {
            ?>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="images/<?php echo $row['picture'] ?>" alt="..." style="width: 250px; height: 250px; object-fit: cover;">
                    <div class="caption text-center">
                        <h5><?php echo $row['devcompanyname'] ?></h5>
                        <h3><?php echo $row['gamename'] ?></h3>
                        <h5>Platform : <?php echo $row['platformname'] ?></h5>
                        <h5>GameType : <?php echo $row['gametype'] ?></h5>
                        <h4><?php echo $row['price'] ?> baht</h4>
                        <p><a href="checkout.php?idgame=<?php echo $row['idgame'] ?>" class="btn btn-primary" role="button">Buy now</a></p>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

<?php
require('footer.php');
?>
