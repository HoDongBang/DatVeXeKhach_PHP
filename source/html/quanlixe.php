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
            $tbloaixe="";
            $tbxe="";
            if(isset($_POST['themloaixe']))
            {
                if($_POST['tenloaixe']=="")
                    $tbloaixe=$tbloaixe."Tên loại xe không được để trống! ";
                if($_POST['giatrenkm']=="")
                   $tbloaixe=$tbloaixe."Giá không được để trống! ";
                if($_POST['giatrenkm']!="")
                {
                    $partten = "/^[0-9]+$/";
					if(!preg_match($partten ,$_POST['giatrenkm']))
                       $tbloaixe=$tbloaixe."Giá phải là số! ";
                }
                
                if($tbloaixe=="")
                {
                    $sql="select malx from loaixe ORDER BY malx DESC LIMIT 1";
                    $query=mysqli_query($con,$sql);
                    $mang = mysqli_fetch_assoc($query);     
                    $malx=(int) $mang['malx']+1;

                    $sql = "insert into loaixe values('".$malx."','".$_POST['tenloaixe']."','".$_POST['giatrenkm']."')";
                    mysqli_query($con, $sql);
                }
            }


            if(isset($_POST['themxe']))
            {
                if($_POST['bienso']=="")
                    $tbxe=$tbxe."Biển số không được để trống! ";
                if($_POST['soluongghe']=="")
                   $tbxe=$tbxe."Số lượng ghế không được để trống! ";
                
                if($tbxe=="")
                {
                    $sql = "insert into xe values('".$_POST['bienso']."','".$_POST['soluongghe']."','".$_POST['maloaixe']."')";
                    mysqli_query($con, $sql);
                }
            }
        ?>
    </head>
    <body>
        <div class="container1">
            <a class="nut" href="trangquantri.php"><button class="btn btn-success" type="button">Về trang quản lí</button></a><br>

            <div class="loaixe">
                <div class="tieude">Loại xe</div>
                <div class="danhsach">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mã loại xe</th>
                                <th>Tên loại</th>
                                <th>Giá trên km</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include 'connect.php';
                                $sql="select * from loaixe";
                                $query=mysqli_query($con,$sql);
                                while($mang=mysqli_fetch_assoc($query))
                                {
                                    echo "<tr>\n";
                                        echo "<td>\n".$mang['malx']."</td>\n";
                                        echo "<td>\n".$mang['tenlx']."</td>\n";

                                        $tam=(string) ($mang['giatrenkm']);
                                        $giaa="";
                                        $s=0;
                                        for($i=(strlen($tam)%3);$i<strlen($tam);$i=$i+3)
                                        {
                                            if($i==0)
                                                $i=3;
                                            $giaa=$giaa.(substr($tam,$s,$i)).".";
                                            $s=$i;
                                        }
                                        $giaa=$giaa.(substr($tam,$s,3));
                                        echo "<td>\n".$giaa." đ</td>\n";
                                        echo"<td>";
                                            echo "<a href=\"loaixe-sua.php?maloaixe=".$mang['malx']."\"><button type=\"button\" class=\"btn btn-warning\">Sửa</button></a>";
                                            echo "<a onclick=\"return window.confirm('Bạn muốn xóa không?');\" href=\"loaixe-xoa.php?maloaixe=".$mang['malx']."\"><button type=\"button\" class=\"btn btn-warning\">Xóa</button></a>";
                                        echo"</td>";
                                    echo "</tr>\n";	
                                }
                            ?>
                        </tbody>
                    </table>    
                </div>

                <div class="them">
                    <?php         
                        $sql="select malx from loaixe ORDER BY malx DESC LIMIT 1";
                        $query=mysqli_query($con,$sql);
                        $mang = mysqli_fetch_assoc($query);     
                        $malx=(int) $mang['malx']+1;
                    ?>
                    <form action="quanlixe.php" method="post">
                        <table class="table table-hover">
                            <tr>
                                <td>Mã loại xe</td>
                                <td><?php echo $malx ?></td>
                            </tr>
                            <tr>
                                <td>Tên loại xe</td>
                                <td><input type="text" name="tenloaixe" placeholder="Tên loại xe"></td>
                            </tr>
                            <tr>
                                <td>Giá trên km</td>
                                <td><input type="number" min="1" name="giatrenkm" placeholder="Giá trên km"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" name="themloaixe" value="Thêm" class="btn btn-warning"></td>
                                <td></td>
                            </tr>
                        </table>
                        <span><?php echo $tbloaixe; ?></span>
                    </form>
                </div>
            </div>


            <div class="xe">
                <div class="tieude">Xe</div>
                <div class="danhsach">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Biển số</th>
                                <th>Số lượng ghế</th>
                                <th>Loại xe</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include 'connect.php';
                                $sql="select bienso,soluongghe,tenlx from xe inner join loaixe on xe.malx=loaixe.malx order by bienso";
                                $query=mysqli_query($con,$sql);
                                while($mang=mysqli_fetch_assoc($query))
                                {
                                    echo "<tr>\n";
                                        echo "<td>\n".$mang['bienso']."</td>\n";
                                        echo "<td>\n".$mang['soluongghe']."</td>\n";
                                        echo "<td>\n".$mang['tenlx']."</td>\n";
                                        echo"<td>";
                                            echo "<a href=\"xe-sua.php?bienso=".$mang['bienso']."\"><button type=\"button\" class=\"btn btn-warning\">Sửa</button></a>";
                                            echo "<a onclick=\"return window.confirm('Bạn muốn xóa không?');\" href=\"xe-xoa.php?bienso=".$mang['bienso']."\"><button type=\"button\" class=\"btn btn-warning\">Xóa</button></a>";
                                        echo"</td>";
                                    echo "</tr>\n";	
                                }
                            ?>
                        </tbody>
                    </table>    
                </div>

                <div class="them">
                    <form action="quanlixe.php" method="post">
                        <table class="table table-hover">
                            <tr>
                                <td>Biển số</td>
                                <td><input type="text" name="bienso" placeholder="Biển số" maxlength="10"></td>
                            </tr>
                            <tr>
                                <td>Số lượng ghế</td>
                                <td><input type="text" name="soluongghe" placeholder="Số lượng ghế"></td>
                            </tr>
                            <tr>
                                <td>Loại xe</td>
                                <?php         
                                    $sql="select * from loaixe";
                                    $query=mysqli_query($con,$sql);    
                                ?>
                                <td>
                                    <select name="maloaixe">
                                        <?php 
                                            while ($mang = mysqli_fetch_array($query)) {
                                        ?>
                                        <option value= <?php echo $mang['malx']; ?>> <?php echo $mang['tenlx']; ?></option>
                                        <?php 
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" name="themxe" value="Thêm" class="btn btn-warning"></td>
                                <td></td>
                            </tr>
                        </table>
                        <span><?php echo $tbxe; ?></span>
                    </form>
                </div>
            </div>

        </div>
    </body>
</html>