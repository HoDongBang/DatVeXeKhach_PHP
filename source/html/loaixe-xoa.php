<?php
require_once("connect.php");
$sql = "delete from loaixe where malx = '$_GET[maloaixe]'";
mysqli_query($con, $sql);
header('location: quanlixe.php');
?>