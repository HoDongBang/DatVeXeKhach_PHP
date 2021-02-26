<?php
require_once("connect.php");
$sql = "delete from xe_chuyenxe where macx = '$_GET[macx]' and bienso = '$_GET[bienso]' and matx= '$_GET[matx]' and gio = '$_GET[gio]'";
mysqli_query($con, $sql);
header('location: quanlichuyenxe.php');
?>