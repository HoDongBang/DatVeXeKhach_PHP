<?php
	session_start();
	unset($_SESSION['sdt']);
	header("location:trangchu.php");
	exit();
?>