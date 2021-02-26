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
            $malx="";
            if(isset($_GET['maloaixe']))
            {
                $malx=$_GET['maloaixe'];
            }
                
            if(isset($_POST['sua']))
            {
                if($_POST['tenloaixe']=="")
                    $tb=$tb."Tên loại xe không được để trống! ";
                if($_POST['giatrenkm']=="")
                   $tb=$tb."Giá không được để trống! ";
                /*if($_POST['giatrenkm']!="")
                {
                    $partten = "/^[0-9]+$/";
					if(!preg_match($partten ,$_POST['giatrenkm']))
                       $tb=$tb."Giá phải là số! ";
                }*/
                
                if($tb=="")
                {
                    $sql = "update loaixe set tenlx = '$_POST[tenloaixe]', giatrenkm = '$_POST[giatrenkm]' where malx = '$malx'";
                    mysqli_query($con, $sql);
                    header('location: quanlixe.php');
                }
            }
        ?>

    </head>
    <body>
        <div class="container1">
            <a class="nut" href="trangquantri.php"><button class="btn btn-success" type="button">Về trang quản lí</button></a>
            <a class="nut" href="quanlixe.php"><button class="btn btn-success" type="button">Về trang quản lí xe</button></a><br>

            <div class="container2">
                <div class="tieude">Sửa loại xe</div>

                <div class="danhsach">
                    <form action="<?php echo "loaixe-sua.php?maloaixe=".$malx; ?>" method="post">
                        <?php 
                            $sql = "select * from loaixe where malx='$malx'";
                            $query=mysqli_query($con, $sql);
                            $mang=mysqli_fetch_assoc($query);
                        ?>
                        <table class="table table-hover">
                            <tr>
                                <td>Mã loại xe</td>
                                <td><?php echo $malx; ?></td>
                            </tr>
                            <tr>
                                <td>Tên loại xe</td>
                                <td><input type="text" name="tenloaixe" placeholder="Tên loại xe" value="<?php echo $mang['tenlx']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Giá trên km</td>
                                <td><input type="number" min="1" name="giatrenkm" value="<?php echo $mang['giatrenkm']; ?>"></td>
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