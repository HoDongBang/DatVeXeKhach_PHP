<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Xe Khách Thánh Thiện</title>
        <link rel="shortcut icon" href="../img/icon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/quanlicon.css">
        <?php
            include 'connect.php';
            $tb="";
            $matx="";
            if(isset($_GET['mataixe']))
            {
                $matx=$_GET['mataixe'];
            }
                
            if(isset($_POST['sua']))
            {
                if($_POST['tentaixe']=="")
                    $tb=$tb."Tên loại xe không được để trống! ";
                if($_POST['sodienthoai']=="")
                   $tb=$tb."SĐT không được để trống! ";
                if($_POST['sodienthoai']!="")
                {
                    $partten = "/^[0-9]+$/";
					if(!preg_match($partten ,$_POST['sodienthoai']))
                       $tb=$tb."SĐT phải là số! ";
                }
                if(strlen($_POST['sodienthoai'])>0 && strlen($_POST['sodienthoai'])<10)
                {
                    $tb=$tb."SĐT phải 10 số! ";
                }
                if($_POST['cmnd']=="")
                   $tb=$tb."CMND không được để trống! ";
                if($_POST['cmnd']!="")
                {
                    $partten = "/^[0-9]+$/";
					if(!preg_match($partten ,$_POST['cmnd']))
                       $tb=$tb."CMND phải là số! ";
                }
                if(strlen($_POST['cmnd'])>0 && strlen($_POST['cmnd'])<9)
                {
                    $tb=$tb."CMND phải 9 số! ";
                }
                
                if($tb=="")
                {
                    $sql = "update taixe set tentx = '$_POST[tentaixe]', sdt = '$_POST[sodienthoai]', cmnd = '$_POST[cmnd]' where matx = '$matx'";
                    mysqli_query($con, $sql);
                    header('location: quanlitaixe.php');
                }
            }
        ?>

    </head>
    <body>
        <div class="container1">
            <a class="nut" href="trangquantri.php"><button class="btn btn-success" type="button">Về trang quản lí</button></a>
            <a class="nut" href="quanlitaixe.php"><button class="btn btn-success" type="button">Về trang quản lí tài xế</button></a><br>

            <div class="container2">
                <div class="tieude">Sửa tài xế</div>

                <div class="danhsach">
                    <form action="<?php echo "taixe-sua.php?mataixe=".$matx; ?>" method="post">
                        <?php 
                            $sql = "select * from taixe where matx='$matx'";
                            $query=mysqli_query($con, $sql);
                            $mang=mysqli_fetch_assoc($query);
                        ?>
                        <table class="table table-hover">
                            <tr>
                                <td>Mã tài xế</td>
                                <td><?php echo $matx; ?></td>
                            </tr>
                            <tr>
                                <td>Tên tài xế</td>
                                <td><input type="text" name="tentaixe" placeholder="Tên tài xế" value="<?php echo $mang['tentx']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Số điện thoại</td>
                                <td><input type="text" name="sodienthoai" placeholder="Số điện thoại" value="<?php echo $mang['sdt']; ?>"></td>
                            </tr>
                            <tr>
                                <td>CMND</td>
                                <td><input type="text" name="cmnd" placeholder="CMND" value="<?php echo $mang['cmnd']; ?>"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" name="sua" value="sửa" class="btn btn-warning"></td>
                                <td></td>
                            </tr>
                        </table>
                        <span><?php echo $tb; ?></span>
                    </form>
                </div>
            </div>

        </div>
    </body>
</html>