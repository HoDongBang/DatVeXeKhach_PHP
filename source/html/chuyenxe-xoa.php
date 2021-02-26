<?php
require_once("connect.php");
$sql = "delete from chuyenxe where macx = '$_GET[machuyenxe]'";
mysqli_query($con, $sql);
header('location: quanlichuyenxe.php');
?>