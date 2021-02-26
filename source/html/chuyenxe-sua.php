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
            $macx="";
            if(isset($_GET['machuyenxe']))
            {
                $macx=$_GET['machuyenxe'];
            }
                
            if(isset($_POST['sua']))
            {
                if($_POST['tenchuyenxe']=="")
                    $tb=$tb."Tên chuyến không được để trống! ";
                if($_POST['khoangcach']=="")
                   $tb=$tb."Khoảng cách không được để trống! ";

                
                if($tb=="")
                {
                    $sql = "update chuyenxe set tenchuyen = '".$_POST['tenchuyenxe']."', khoangcach = ".$_POST['khoangcach']." where macx = '$macx'";
                    mysqli_query($con, $sql);
                    header('location: quanlichuyenxe.php');
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
                    <form action="<?php echo "chuyenxe-sua.php?machuyenxe=".$macx; ?>" method="post">
                        <?php 
                            $sql = "select * from chuyenxe where macx='$macx'";
                            $query=mysqli_query($con, $sql);
                            $mang=mysqli_fetch_assoc($query);
                        ?>
                        <table class="table table-hover">
                            <tr>
                                <td>Mã tài xế</td>
                                <td><?php echo $macx; ?></td>
                            </tr>
                            <tr>
                                <td>Tên chuyến xe</td>
                                <td><input type="text" name="tenchuyenxe" placeholder="Tên chuyến xe" value="<?php echo $mang['tenchuyen']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Khoản cách</td>
                                <td><input type="number" min="1" name="khoangcach"   value="<?php echo $mang['khoangcach']; ?>"></td>
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