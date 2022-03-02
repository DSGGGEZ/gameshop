<?php
    include 'session.php';
    include 'dbconnect.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $mid= $_POST['mid'];
        $mpassword= $_POST['mpassword'];

        $sql = "SELECT * FROM member where mid= '$mid' and mpassword = '$mpassword'";
		$query = $conn->query($sql);

        if($query->num_rows > 0){
            $row = $query->fetch_assoc();
			$_SESSION['member'] = $row['mid'];
			header('location: index.php');
        } 
        else{
            $_SESSION['error'] = 'Member not found';
			header('location: login.php');
        }
    }
	else{
		$_SESSION['error'] = 'Enter Member id first';
		header('location: login.php');
    }
?>
