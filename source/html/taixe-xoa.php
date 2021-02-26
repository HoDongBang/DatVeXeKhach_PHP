<?php
require_once("connect.php");
$sql = "delete from taixe where matx = '$_GET[mataixe]'";
mysqli_query($con, $sql);
header('location: quanlitaixe.php');
?>