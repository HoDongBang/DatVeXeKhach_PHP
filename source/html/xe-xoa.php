<?php
require_once("connect.php");
$sql = "delete from xe where bienso = '$_GET[bienso]'";
mysqli_query($con, $sql);
header('location: quanlixe.php');
?>