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
            $bienso="";
            if(isset($_GET['bienso']))
            {
                $bienso=$_GET['bienso'];
            }
                
            if(isset($_POST['sua']))
            {
                if($_POST['soluongghe']=="")
                   $tb=$tb."Số lượng ghế không được để trống! ";
                if($_POST['soluongghe']!="")
                {
                    $partten = "/^[0-9]+$/";
					if(!preg_match($partten ,$_POST['soluongghe']))
                       $tb=$tb."Số lượng ghế phải là số! ";
                }
                
                if($tb=="")
                {
                    $sql = "update xe set soluongghe = '$_POST[soluongghe]', malx = '$_POST[maloaixe]' where bienso = '$bienso'";
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
                <div class="tieude">Sửa xe</div>

                <div class="danhsach">
                    <form action="<?php echo "xe-sua.php?bienso=".$bienso; ?>" method="post">                   

                        <?php 
                            $sql = "select * from xe where bienso='$bienso'";
                            $query=mysqli_query($con, $sql);
                            $mang=mysqli_fetch_assoc($query);
                        ?>
                        <table class="table table-hover">
                            <tr>
                                <td>Biển số</td>
                                <td><?php echo $bienso; ?></td>
                            </tr>
                            <tr>
                                <td>Số lượng ghế</td>
                                <td><input type="text" name="soluongghe" placeholder="Số lượng ghế" value="<?php echo $mang['soluongghe']; ?>"></td>
                            </tr>
                            <tr>
                                <td>Loại xe</td>
                                <?php         
                                    $sql2="select * from loaixe";
                                    $query2=mysqli_query($con,$sql2);
                                ?>
                                <td>
                                    <select name="maloaixe">
                                        <?php 
                                            while ($mang2 = mysqli_fetch_array($query2)) {
                                        ?>
                                        <option value= <?php echo $mang2['malx']; ?> <?php if($mang['malx']==$mang2['malx']) echo "selected=\"selected\""; ?>> <?php echo $mang2['tenlx']; ?></option>
                                        <?php 
                                            }
                                        ?>
                                    </select>
                                </td>
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