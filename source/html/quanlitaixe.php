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
            if(isset($_POST['them']))
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
                    $sql="select matx from taixe ORDER BY matx DESC LIMIT 1";
                    $query=mysqli_query($con,$sql);
                    $mang = mysqli_fetch_assoc($query);
                    $matx="";     
                    if (mysqli_num_rows($query) > 0) {
                        $bientruyxuat = (int) substr($mang['matx'], 2);
                        if ($bientruyxuat < 9)
                            $matx = "TX0" . (string) ($bientruyxuat + 1);
                        else
                            $matx = "TX" . (string) ($bientruyxuat + 1);
                    } 
                    else {
                        $matx = 'TX01';
                    }

                    $sql = "insert into taixe values('".$matx."','".$_POST['tentaixe']."','".$_POST['sodienthoai']."','".$_POST['cmnd']."')";
                    mysqli_query($con, $sql);
                }
            }
        ?>
    </head>
    <body>
        <div class="container1">
            <a class="nut" href="trangquantri.php"><button class="btn btn-success" type="button">Về trang quản lí</button></a><br>

            <div class="container2">
                <div class="tieude">Tài xế</div>
                <div class="danhsach">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mã tài xế</th>
                                <th>Tên tài xế</th>
                                <th>Số điện thoại</th>
                                <th>CMND</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include 'connect.php';
                                $sql="select * from taixe";
                                $query=mysqli_query($con,$sql);
                                while($mang=mysqli_fetch_assoc($query))
                                {
                                    echo "<tr>\n";
                                        echo "<td>\n".$mang['matx']."</td>\n";
                                        echo "<td>\n".$mang['tentx']."</td>\n";
                                        echo "<td>\n".$mang['sdt']."</td>\n";
                                        echo "<td>\n".$mang['cmnd']."</td>\n";
                                        echo"<td>";
                                            echo "<a href=\"taixe-sua.php?mataixe=".$mang['matx']."\"><button type=\"button\" class=\"btn btn-warning\">Sửa</button></a>";
                                            echo "<a onclick=\"return window.confirm('Bạn muốn xóa không?');\" href=\"taixe-xoa.php?mataixe=".$mang['matx']."\"><button type=\"button\" class=\"btn btn-warning\">Xóa</button></a>";
                                        echo"</td>";
                                    echo "</tr>\n";	
                                }
                            ?>
                        </tbody>
                    </table>    
                </div>

                <div class="them">
                    <?php         
                        $sql="select matx from taixe ORDER BY matx DESC LIMIT 1";
                        $query=mysqli_query($con,$sql);
                        $mang = mysqli_fetch_assoc($query);
                        $matx="";     
                        if (mysqli_num_rows($query) > 0) {
                            $bientruyxuat = (int) substr($mang['matx'], 2);
                            if ($bientruyxuat < 9)
                                $matx = "TX0" . (string) ($bientruyxuat + 1);
                            else
                                $matx = "TX" . (string) ($bientruyxuat + 1);
                        } 
                        else {
                            $matx = 'TX01';
                        }
                    ?>
                    <form action="quanlitaixe.php" method="post">
                        <table class="table table-hover">
                            <tr>
                                <td>Mã tài xế</td>
                                <td><?php echo $matx ?></td>
                            </tr>
                            <tr>
                                <td>Tên tài xế</td>
                                <td><input type="text" name="tentaixe" placeholder="Tên tài xế" maxlength="25"></td>
                            </tr>
                            <tr>
                                <td>Số điện thoại</td>
                                <td><input type="text" name="sodienthoai" placeholder="Số điện thoại" maxlength="10"></td>
                            </tr>
                            <tr>
                                <td>CMND</td>
                                <td><input type="text" name="cmnd" placeholder="CMND" maxlength="9"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" name="them" value="Thêm" class="btn btn-warning"></td>
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