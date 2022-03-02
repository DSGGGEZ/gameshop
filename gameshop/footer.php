<?php
    $conn->close();
?>
<hr>
<p class="text-center small">Have fun with your game&nbsp;</p>
<p class="text-center small"><?php print_r($_SESSION['member']);?></p>
<p class="text-center small"><a href='logout.php'>Log Out</a></p>
</body>
</html>