<?php
include 'connect.php';
$sql="DELETE FROM vexe WHERE mavx='".$_GET['huyve']."'";
$query=mysqli_query($con,$sql);
header("location:thongtin.php");
exit();	
?>