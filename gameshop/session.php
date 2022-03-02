<?php
    include 'dbconnect.php';
    session_start();

if (isset($_SESSION['member'])) {
    $sql = "SELECT * FROM member WHERE mid = '".$_SESSION['member']."'";
	$query = $conn->query($sql);
	$member = $query->fetch_assoc();
}
