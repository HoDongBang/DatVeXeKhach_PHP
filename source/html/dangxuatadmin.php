<?php
	session_start();
	unset($_SESSION['ttk']);
	header("location:trangchu.php");
	exit();
?>