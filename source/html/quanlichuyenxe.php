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
            $tbchuyenxe="";
            $tblichtrinh="";
            if(isset($_POST['themchuyenxe']))
            {
                if($_POST['noidi']=="")
                    $tbchuyenxe=$tbchuyenxe."Nơi đi không được để trống! ";
                if($_POST['noiden']=="")
                    $tbchuyenxe=$tbchuyenxe."Nơi đến không được để trống! ";
                if($_POST['khoangcach']=="")
                   $tbchuyenxe=$tbchuyenxe."Khoảng cách không được để trống! ";
                
                if($tbchuyenxe=="")
                {
                    $sql="select macx from chuyenxe ORDER BY macx DESC LIMIT 1";
                    $query=mysqli_query($con,$sql);
                    $mang = mysqli_fetch_assoc($query);     
                    $macx="";
                    if (mysqli_num_rows($query) > 0) {
                        $bientruyxuat = (int) substr($mang['macx'], 2);
                        if ($bientruyxuat < 9)
                            $macx = "CX0" . (string) ($bientruyxuat + 1);
                        else
                            $macx = "CX" . (string) ($bientruyxuat + 1);
                    } 
                    else {
                        $macx = 'CX01';
                    }
                    $tenchuyen=$_POST['noidi']." - ".$_POST['noiden'];
                    $sql = "insert into chuyenxe values('".$macx."','".$tenchuyen."','".$_POST['khoangcach']."')";
                    mysqli_query($con, $sql);
                }
            }


            $bienso="";
            $matx="";
            $macx2="";
            $gio=24;
            if(isset($_POST['themlichtrinh']))
            {
                if(isset($_POST['bienso']))
                    $bienso=$_POST['bienso'];
                if(isset($_POST['mataixe']))
                    $matx=$_POST['mataixe'];
                if(isset($_POST['machuyenxe']))
                    $macx2=$_POST['machuyenxe'];
                if(isset($_POST['gio']))
                    $gio=$_POST['gio'];


                $gio=(int) $_POST['gio'];
                $sql="select bienso from xe_chuyenxe where bienso='".$_POST['bienso']."' and gio>".($gio-3)." and gio<".($gio+3);
                $query=mysqli_query($con,$sql);
                if (mysqli_num_rows($query) > 0)
                    $tblichtrinh=$tblichtrinh."Chiếc xe có biển số ".$_POST['bienso']." đã có lịch chạy giờ này rồi, vui lòng chọn xe khác! ";
                    $gio=(int) $_POST['gio'];

                $sql="select matx from xe_chuyenxe where matx='".$_POST['mataixe']."' and gio>".($gio-3)." and gio<".($gio+3);
                $query=mysqli_query($con,$sql);
                if (mysqli_num_rows($query) > 0)
                    $tblichtrinh=$tblichtrinh."Tài xế có mã ".$_POST['mataixe']." đã có lịch chạy giờ này rồi, vui lòng chọn tài xế khác! ";

                if($tblichtrinh=="")
                {
                    $sql = "insert into xe_chuyenxe values('".$bienso."','".$macx2."','".$matx."',".$gio.")";
                    mysqli_query($con, $sql);
                }       
            }
        ?>
    </head>
    <body>
        <div class="container1">
            <a class="nut" href="trangquantri.php"><button class="btn btn-success" type="button">Về trang quản lí</button></a><br>

            <div class="loaixe">
                <div class="tieude">Chuyến xe</div>
                <div class="danhsach">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mã chuyến xe</th>
                                <th>Tên chuyến xe</th>
                                <th>Khoảng cách (km)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include 'connect.php';
                                $sql="select * from chuyenxe";
                                $query=mysqli_query($con,$sql);
                                while($mang=mysqli_fetch_assoc($query))
                                {
                                    echo "<tr>\n";
                                        echo "<td>\n".$mang['macx']."</td>\n";
                                        echo "<td>\n".$mang['tenchuyen']."</td>\n";
                                        echo "<td>\n".$mang['khoangcach']."</td>\n";
                                        echo"<td>";
                                            echo "<a href=\"chuyenxe-sua.php?machuyenxe=".$mang['macx']."\"><button type=\"button\" class=\"btn btn-warning\">Sửa</button></a>";
                                            echo "<a onclick=\"return window.confirm('Bạn muốn xóa không?');\" href=\"chuyenxe-xoa.php?machuyenxe=".$mang['macx']."\"><button type=\"button\" class=\"btn btn-warning\">Xóa</button></a>";
                                        echo"</td>";
                                    echo "</tr>\n";	
                                }
                            ?>
                        </tbody>
                    </table>    
                </div>

                <div class="them">
                    <?php         
                        $sql="select macx from chuyenxe ORDER BY macx DESC LIMIT 1";
                        $query=mysqli_query($con,$sql);
                        $mang = mysqli_fetch_assoc($query);     
                        $macx="";
                        if (mysqli_num_rows($query) > 0) {
                            $bientruyxuat = (int) substr($mang['macx'], 2);
                            if ($bientruyxuat < 9)
                                $macx = "CX0" . (string) ($bientruyxuat + 1);
                            else
                                $macx = "CX" . (string) ($bientruyxuat + 1);
                        } 
                        else {
                            $macx = 'CX01';
                        }
                    ?>
                    <form action="quanlichuyenxe.php" method="post">
                        <table class="table table-hover">
                            <tr>
                                <td>Mã chuyến xe</td>
                                <td><?php echo $macx ?></td>
                            </tr>
                            <tr>
                                <td>Nơi đi</td>
                                <td><input type="text" name="noidi" placeholder="Nơi đi" maxlength="45"></td>
                            </tr>
                            <tr>
                                <td>Nơi đến</td>
                                <td><input type="text" name="noiden" placeholder="Nơi đến" maxlength="45"></td>
                            </tr>
                            <tr>
                                <td>Khoảng cách (km)</td>
                                <td><input type="number" min="1" name="khoangcach"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" name="themchuyenxe" value="Thêm" class="btn btn-warning"></td>
                                <td></td>
                            </tr>
                        </table>
                        <span><?php echo $tbchuyenxe; ?></span>
                    </form>
                </div>
            </div>


            <div class="xe">
                <div class="tieude">Lịch trình</div>
                <div class="danhsach">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Chuyến</th>
                                <th>Biển số</th>
                                <th>Loại xe</th>
                                <th>Số lượng ghế</th>
                                <th>Tài xế</th>
                                <th>Giờ chạy</th>
                                <th>Giá (đ)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include 'connect.php';
                                //toàn bộ số chuyến xe
                                $sql="select macx,tenchuyen from chuyenxe ORDER BY tenchuyen DESC";
                                $query=mysqli_query($con,$sql);                          
                                while($mang=mysqli_fetch_assoc($query))
                                {
									$sql2="select xe_chuyenxe.macx,xe_chuyenxe.matx,tenchuyen,xe_chuyenxe.bienso,tenlx,soluongghe,tentx,gio,(giatrenkm*khoangcach) as gia
                                    from xe_chuyenxe inner join chuyenxe on xe_chuyenxe.macx=chuyenxe.macx inner join xe on xe_chuyenxe.bienso=xe.bienso 
                                    inner join loaixe on xe.malx=loaixe.malx inner join taixe on xe_chuyenxe.matx=taixe.matx where xe_chuyenxe.macx='".$mang['macx']."'";
                                    $query2=mysqli_query($con,$sql2);
    
                                    //nếu chuyến xe đó chưa có giờ chạy thì in rỗng
                                    if (mysqli_num_rows($query2)==0)
                                    {
                                        echo "<tr>\n";
                                            echo "<td>\n".$mang['tenchuyen']."</td>\n";
                                            echo "<td></td>";
                                            echo "<td></td>";
                                            echo "<td></td>";
                                            echo "<td></td>";
                                            echo "<td></td>";
                                            echo "<td></td>";                         
                                            echo "<td></td>";
                                        echo "</tr>\n";
                                    }
                                    //nếu chuyến xe đó đã có giờ chạy thì in ra
                                    else
                                    {
                                        $mang2=mysqli_fetch_assoc($query2);

                                        //tìm tổng số hàng mà chuyến xe có chạy
                                        $sql3="select macx from xe_chuyenxe where macx='".$mang2['macx']."'";
                                        $query3=mysqli_query($con,$sql3);
                                        $sl=mysqli_num_rows($query3);

                                        //nếu tổng bằng 1 thì in ra
                                        if($sl==1)
                                        {
                                            echo "<tr>\n";
                                                echo "<td>\n".$mang2['tenchuyen']."</td>\n";
                                                echo "<td>\n".$mang2['bienso']."</td>\n";
                                                echo "<td>\n".$mang2['tenlx']."</td>\n";
                                                echo "<td>\n".$mang2['soluongghe']."</td>\n";
                                                echo "<td>\n".$mang2['tentx']."</td>\n";
                                                echo "<td>\n".$mang2['gio']."</td>\n";

                                                $tam=(string) ($mang2['gia']);
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
                                                    echo "<a onclick=\"return window.confirm('Bạn muốn xóa không?');\" href=\"lichtrinh-xoa.php?bienso=".$mang2['bienso']."&&macx=".$mang2['macx']."&&matx=".$mang2['matx']."&&gio=".$mang2['gio']."\"><button type=\"button\" class=\"btn btn-warning\">Xóa</button></a>";
                                                echo"</td>";
                                            echo "</tr>\n";
                                        }
                                        //nếu lến hơn 1 thì gộp ô tên chuyến xe
                                        else
                                        {
                                            echo "<tr>\n";
                                                echo "<td rowspan=\"".$sl."\">\n".$mang2['tenchuyen']."</td>\n";
                                                echo "<td>\n".$mang2['bienso']."</td>\n";
                                                echo "<td>\n".$mang2['tenlx']."</td>\n";
                                                echo "<td>\n".$mang2['soluongghe']."</td>\n";
                                                echo "<td>\n".$mang2['tentx']."</td>\n";
                                                echo "<td>\n".$mang2['gio']."</td>\n";

                                                $tam=(string) ($mang2['gia']);
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
                                                    echo "<a onclick=\"return window.confirm('Bạn muốn xóa không?');\" href=\"lichtrinh-xoa.php?bienso=".$mang2['bienso']."&&macx=".$mang2['macx']."&&matx=".$mang2['matx']."&&gio=".$mang2['gio']."\"><button type=\"button\" class=\"btn btn-warning\">Xóa</button></a>";
                                                echo"</td>";
                                            echo "</tr>\n";

                                            //lấy hàng thứ 2 đến hết
                                            $sql4="select xe_chuyenxe.macx,xe_chuyenxe.matx,tenchuyen,xe_chuyenxe.bienso,tenlx,soluongghe,tentx,gio,(giatrenkm*khoangcach) as gia
                                            from xe_chuyenxe inner join chuyenxe on xe_chuyenxe.macx=chuyenxe.macx inner join xe on xe_chuyenxe.bienso=xe.bienso 
                                            inner join loaixe on xe.malx=loaixe.malx inner join taixe on xe_chuyenxe.matx=taixe.matx where xe_chuyenxe.macx='".$mang2['macx']."' LIMIT 1,".$sl;
                                            $query4=mysqli_query($con,$sql4);
                                            while($mang4=mysqli_fetch_assoc($query4))
                                            {
                                                echo "<tr>\n";
                                                    echo "<td>\n".$mang4['bienso']."</td>\n";
                                                    echo "<td>\n".$mang4['tenlx']."</td>\n";
                                                    echo "<td>\n".$mang2['soluongghe']."</td>\n";
                                                    echo "<td>\n".$mang4['tentx']."</td>\n";
                                                    echo "<td>\n".$mang4['gio']."</td>\n";

                                                    $tam=(string) ($mang4['gia']);
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
                                                        echo "<a onclick=\"return window.confirm('Bạn muốn xóa không?');\" href=\"lichtrinh-xoa.php?bienso=".$mang4['bienso']."&&macx=".$mang4['macx']."&&matx=".$mang4['matx']."&&gio=".$mang4['gio']."\"><button type=\"button\" class=\"btn btn-warning\">Xóa</button></a>";
                                                    echo"</td>";
                                                echo "</tr>\n";
                                            }
                                        }
                                    }                                       
                                }                             
                            ?>
                        </tbody>
                    </table>    
                </div>

                <div class="them">
                    <form action="quanlichuyenxe.php" method="post">
                        <table class="table table-hover">
                            <tr>
                                <td>Chuyến xe</td>
                                <?php         
                                    $sql="select * from chuyenxe";
                                    $query=mysqli_query($con,$sql);    
                                ?>
                                <td>
                                    <select name="machuyenxe">
                                        <?php 
                                            while ($mang = mysqli_fetch_array($query)) {
                                        ?>
                                        <option value= "<?php echo $mang['macx']; ?>" <?php if($macx2==$mang['macx']) echo "selected=\"selected\""; ?>> <?php echo $mang['tenchuyen']; ?></option>
                                        <?php 
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Giờ</td>
                                <td>
                                    <select name="gio">
                                        <?php
                                            for($i=0;$i<24;$i++)
                                            {
                                                if($gio==$i)
                                                    echo "<option value=\"".$i."\" selected=\"selected\">".$i."</option>";
                                                else
                                                    echo "<option value=\"".$i."\">".$i."</option>";
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Biển số</td>
                                <?php         
                                    $sql="select * from xe";
                                    $query=mysqli_query($con,$sql);    
                                ?>
                                <td>
                                    <select name="bienso">
                                        <?php 
                                            while ($mang = mysqli_fetch_array($query)) {
                                        ?>
                                        <option value= "<?php echo $mang['bienso']; ?>" <?php if($bienso==$mang['bienso']) echo "selected=\"selected\""; ?>> <?php echo $mang['bienso']; ?></option>
                                        <?php 
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Tài xế</td>
                                <?php         
                                    $sql="select * from taixe";
                                    $query=mysqli_query($con,$sql);    
                                ?>
                                <td>
                                    <select name="mataixe">
                                        <?php 
                                            while ($mang = mysqli_fetch_array($query)) {
                                        ?>
                                        <option value= "<?php echo $mang['matx']; ?>" <?php if($matx==$mang['matx']) echo "selected=\"selected\""; ?>> <?php echo $mang['tentx']; ?></option>
                                        <?php 
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" name="themlichtrinh" value="Thêm" class="btn btn-warning"></td>
                                <td></td>
                            </tr>
                        </table>
                        <span><?php echo $tblichtrinh; ?></span>
                    </form>
                </div>
            </div>

        </div>
    </body>
</html>