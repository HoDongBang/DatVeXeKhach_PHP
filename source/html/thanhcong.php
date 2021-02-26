<?php
    include 'connect.php';
    $macx="";
    $datchongay="";
    $gio="";
    $bienso="";
    $vitrighee="";
    $ngaydat="";
    if(isset($_GET['machuyenxe']) && isset($_GET['datchongay']) && isset($_GET['gio']) && isset($_GET['bienso']) && isset($_GET['vitrighe']) && isset($_GET['ngaydat']))
    {
        $macx=$_GET['machuyenxe'];
        $datchongay=$_GET['datchongay'];
        $gio=$_GET['gio'];
        $bienso=$_GET['bienso'];
        $vitrighee=$_GET['vitrighe'];
        $ngaydat=$_GET['ngaydat'];
    }
    $ngaydatt=explode(" ",$ngaydat);
    $ngaydatt2=explode("h",$ngaydatt[0]);
    $ngaydatt3=explode("-",$ngaydatt[1]);
    $ngaydattt=$ngaydatt3[2]."-".$ngaydatt3[1]."-".$ngaydatt3[0]." ".$ngaydatt2[1].":".$ngaydatt2[0].":00";

    //kiểm tra session có hay chưa, chưa thì start;
    if (session_id() === '')
        session_start();

    $vitrighe=array();
    $vitrighe=explode("-",$vitrighee);
    $slghe=count($vitrighe);

    for($i=0;$i<$slghe;$i++)
    {
        $sql="select mavx from vexe ORDER BY mavx DESC LIMIT 1";
        $query=mysqli_query($con,$sql);
        $mang = mysqli_fetch_assoc($query);
        $mavx="";     
        if (mysqli_num_rows($query) > 0) {
            $bientruyxuat = (int) substr($mang['mavx'], 2);
            if ($bientruyxuat < 9)
                $mavx = "VX00" . (string) ($bientruyxuat + 1);
            else if($bientruyxuat > 9 && $bientruyxuat < 99)
                $mavx = "VX0" . (string) ($bientruyxuat + 1);
            else
                $mavx = "VX" . (string) ($bientruyxuat + 1);
        } 
        else {
            $mavx = 'VX001';
        }

        $sql2="select DISTINCT matx from xe_chuyenxe where macx='".$macx."' and bienso='".$bienso."' and gio=".$gio;
        $query2=mysqli_query($con,$sql2);
        $mang2 = mysqli_fetch_assoc($query2);

        $sql = "insert into vexe values('".$mavx."','".$vitrighe[$i]."','".$_SESSION['sdt']."','".$ngaydattt."','".$datchongay."','".$bienso."','".$macx."','".$mang2['matx']."','".$gio."','')";
        mysqli_query($con, $sql); 
    }
    header("location:trangchu.php");
    exit();
?>