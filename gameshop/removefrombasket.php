<?php
require('session.php');

if (isset($_GET['idgame'])) {
    $idgame = $_GET['idgame'];

    // Get the current basket
    $mid = $_SESSION['member'];

    // Modify the basket
    for ($i = 0; $i < count($mid); $i++) {
        if ($basket[$i]['idgame'] == $idgame) {
            array_splice($mid, $i, 1);
            break;
        }
    }

    // Save the basket
    $_SESSION['member'] = $mid;
}
else {
    $_SESSION['member'] = [];
}

header('Location: basket.php');
exit();
