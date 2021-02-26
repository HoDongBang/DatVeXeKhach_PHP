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
        <link rel="stylesheet" type="text/css" href="../css/quanlivexe.css">
        <?php
            //kiểm tra session có hay chưa, chưa thì start;
			if (session_id() === '')
                session_start();
            include 'connect.php';
            if(isset($_POST['subtbve']))
            {
                $sql="";
                if($_POST['gio']!="khong")
                {
                    $sql="update vexe set ghichu = '".$_POST['tbve']."' where datchongay = '".$_POST['datchongay']."' and gio = '".$_POST['gio']."'";
                    if(isset($_POST['machuyenxe']))
                        if($_POST['machuyenxe']!="khong")
                        {
                            $sql="update vexe set ghichu = '".$_POST['tbve']."' where datchongay = '".$_POST['datchongay']."' and gio = '".$_POST['gio']."' 
                            and macx = '".$_POST['machuyenxe']."'";
                            if(isset($_POST['bienso']))
                                if($_POST['bienso']!="khong")
                                {
                                    $sql="update vexe set ghichu = '".$_POST['tbve']."' where datchongay = '".$_POST['datchongay']."' and gio = '".$_POST['gio']."' 
                                    and macx = '".$_POST['machuyenxe']."' and bienso = '".$_POST['bienso']."'";
                                }
                        }
                }
                else $sql="update vexe set ghichu = '".$_POST['tbve']."' where datchongay = '".$_POST['datchongay']."'";              
                mysqli_query($con, $sql);
            }

            if(isset($_POST['subtbvecuthe']))
            {
                $sql="update vexe set ghichu = '".$_POST['tbve']."' where mavx = '".$_POST['mavexe']."'";              
                mysqli_query($con, $sql);
            }

            if(isset($_POST['subtbtrang']))
            {
                if($_POST['tbtrang']!="")
                {
                    $sql="delete from thongbaotrang";          
                    mysqli_query($con, $sql);
                    $sql="insert into thongbaotrang values('".$_POST['tbtrang']."')";              
                    mysqli_query($con, $sql);
                }
                else{
                    $sql="delete from thongbaotrang";          
                    mysqli_query($con, $sql);
                }
            }
        ?>
        <script>
            function gioo()
			{
				var gio=document.getElementById("gio").value;
                if(gio!="khong")
				{
                    document.getElementById("machuyenxe").style.display = "block";
                }
                else
				{
                    document.getElementById("machuyenxe").style.display = "none";
                    document.getElementById("bienso").style.display = "none";
                }
			}
            function machuyenxee()
			{
				var machuyenxe=document.getElementById("machuyenxe").value;
                if(machuyenxe!="khong")
				{
					document.getElementById("bienso").style.display = "block";
                }
                else
				{
					document.getElementById("bienso").style.display = "none";
                }
			}
        </script>
    </head>
    <body>
        <div class="container1">
            <a class="nut" href="trangquantri.php"><button class="btn btn-success" type="button">Về trang quản lí</button></a><br>
            <div class="tieude1">Vé xe</div>
            <div class="container2">
                <div class="danhsach">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Đặt cho ngày</th>
                                <th>Chuyến xe</th>
                                <th>Giờ</th>
                                <th>Mã vé</th>
                                <th>SĐT khách hàng</th>
                                <th>Biển số</th>
                                <th>Tên tài xế</th>
                                <th>Ngày đặt</th>
                                <th>Giá</th>
                                <th>Ghi chú</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            include 'connect.php';
                            //sắp xếp theo đặt cho ngày, lấy 90 ngày gần nhất
                            $sql="select DISTINCT datchongay from vexe ORDER BY datchongay DESC LIMIT 90";
                            $query=mysqli_query($con,$sql);            
                            while($mang=mysqli_fetch_assoc($query))
                            {  
                                //truy xuất tổng đặt cho ngyaf cụ thể
                                $sql2="select datchongay from vexe where datchongay='".$mang['datchongay']."'";
                                $query2=mysqli_query($con,$sql2);
                                $sl2=mysqli_num_rows($query2);
                                    //nếu =1 thì in
                                if($sl2==1)
                                {
                                    $sql3="select datchongay,tenchuyen,gio,vexe.mavx,vexe.sdt,vexe.bienso,tentx,ngaydat,(giatrenkm*khoangcach) as gia,ghichu 
                                    from vexe inner join chuyenxe on vexe.macx=chuyenxe.macx inner join taixe on vexe.matx=taixe.matx inner join xe on 
                                    vexe.bienso=xe.bienso inner join loaixe on xe.malx=loaixe.malx where datchongay='".$mang['datchongay']."'";
                                    $query3=mysqli_query($con,$sql3);
                                    $mang3=mysqli_fetch_assoc($query3);

                                    echo "<tr>\n";
                                        $datchongayy=explode('-',$mang3['datchongay']);
                                        echo "<td>\n".$datchongayy[2]."-".$datchongayy[1]."-".$datchongayy[0]."</td>\n";

                                        echo "<td>\n".$mang3['tenchuyen']."</td>\n";
                                        echo "<td>\n".$mang3['gio']."</td>\n";
                                        echo "<td>\n".$mang3['mavx']."</td>\n";
                                        echo "<td>\n".$mang3['sdt']."</td>\n";
                                        echo "<td>\n".$mang3['bienso']."</td>\n";
                                        echo "<td>\n".$mang3['tentx']."</td>\n";

                                        $ngaydatt=explode(' ',$mang3['ngaydat']);
                                        $ngaydatt2=explode('-',$ngaydatt[0]);
                                        $ngaydatt3=explode(':',$ngaydatt[1]);
                                        echo "<td>\n".$ngaydatt3[1]."h".$ngaydatt3[0]." ".$ngaydatt2[2]."-".$ngaydatt2[1]."-".$ngaydatt2[0]."</td>\n";

                                        $tam=(string) ($mang3['gia']);
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

                                        echo "<td>\n".$mang3['ghichu']."</td>\n";
                                    echo "</tr>\n";
                                }
                                    //nếu > 1
                                if($sl2>1)
                                {
                                    //in rowspan=sl
                                    

                                    echo "<tr>\n";
                                        echo "<td rowspan=\"".$sl2."\">\n".$mang['datchongay']."</td>\n";

                                    //truy xuất mã chuyến xe, sắp xếp tên where ngày này
                                    $sql4="select vexe.macx,tenchuyen from vexe inner join chuyenxe on vexe.macx=chuyenxe.macx 
                                    where datchongay='".$mang['datchongay']."' order by tenchuyen";
                                    $query4=mysqli_query($con,$sql4);
                                    $mang4=mysqli_fetch_assoc($query4);
                                    $sl4=mysqli_num_rows($query4);
                                    //nếu =1 thì in ra
                                    if($sl4==1)
                                    {
                                        $sql5="select tenchuyen,gio,vexe.mavx,vexe.sdt,vexe.bienso,tentx,ngaydat,(giatrenkm*khoangcach) as gia,ghichu 
                                        from vexe inner join chuyenxe on vexe.macx=chuyenxe.macx inner join taixe on vexe.matx=taixe.matx inner join xe on 
                                        vexe.bienso=xe.bienso inner join loaixe on xe.malx=loaixe.malx where datchongay='".$mang['datchongay']."' vexe.macx='".$mang4['macx']."'";
                                        $query5=mysqli_query($con,$sql5);
                                        $mang5=mysqli_fetch_assoc($query5);

                                            echo "<td>\n".$mang5['tenchuyen']."</td>\n";
                                            echo "<td>\n".$mang5['gio']."</td>\n";
                                            echo "<td>\n".$mang5['mavx']."</td>\n";
                                            echo "<td>\n".$mang5['sdt']."</td>\n";
                                            echo "<td>\n".$mang5['bienso']."</td>\n";
                                            echo "<td>\n".$mang5['tentx']."</td>\n";

                                            $ngaydatt=explode(' ',$mang5['ngaydat']);
                                            $ngaydatt2=explode('-',$ngaydatt[0]);
                                            $ngaydatt3=explode(':',$ngaydatt[1]);
                                            echo "<td>\n".$ngaydatt3[1]."h".$ngaydatt3[0]." ".$ngaydatt2[2]."-".$ngaydatt2[1]."-".$ngaydatt2[0]."</td>\n";

                                            $tam=(string) ($mang5['gia']);
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

                                            echo "<td>\n".$mang5['ghichu']."</td>\n";
                                        echo "</tr>\n";
                                    }
                                    //nếu > 1
                                    if($sl4>1)
                                    {
                                        $sql5="select tenchuyen,gio,vexe.mavx,vexe.sdt,vexe.bienso,tentx,ngaydat,(giatrenkm*khoangcach) as gia,ghichu 
                                        from vexe inner join chuyenxe on vexe.macx=chuyenxe.macx inner join taixe on vexe.matx=taixe.matx inner join xe on 
                                        vexe.bienso=xe.bienso inner join loaixe on xe.malx=loaixe.malx where datchongay='".$mang['datchongay']."' and vexe.macx='".$mang4['macx']."' LIMIT 1";
                                        $query5=mysqli_query($con,$sql5);
                                        $mang5=mysqli_fetch_assoc($query5);

                                            echo "<td rowspan=\"".$sl4."\">\n".$mang5['tenchuyen']."</td>\n";
                                            echo "<td>\n".$mang5['gio']."</td>\n";
                                            echo "<td>\n".$mang5['mavx']."</td>\n";
                                            echo "<td>\n".$mang5['sdt']."</td>\n";
                                            echo "<td>\n".$mang5['bienso']."</td>\n";
                                            echo "<td>\n".$mang5['tentx']."</td>\n";

                                            $ngaydatt=explode(' ',$mang5['ngaydat']);
                                            $ngaydatt2=explode('-',$ngaydatt[0]);
                                            $ngaydatt3=explode(':',$ngaydatt[1]);
                                            echo "<td>\n".$ngaydatt3[1]."h".$ngaydatt3[0]." ".$ngaydatt2[2]."-".$ngaydatt2[1]."-".$ngaydatt2[0]."</td>\n";

                                            $tam=(string) ($mang5['gia']);
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

                                            echo "<td>\n".$mang5['ghichu']."</td>\n";
                                        echo "</tr>\n";
                                        
                                        $sql6="select gio,vexe.mavx,vexe.sdt,vexe.bienso,tentx,ngaydat,(giatrenkm*khoangcach) as gia,ghichu 
                                        from vexe inner join chuyenxe on vexe.macx=chuyenxe.macx inner join taixe on vexe.matx=taixe.matx inner join xe on 
                                        vexe.bienso=xe.bienso inner join loaixe on xe.malx=loaixe.malx where datchongay='".$mang['datchongay']."' and vexe.macx='".$mang4['macx']."' LIMIT 1,".$sl4;
                                        $query6=mysqli_query($con,$sql6);
                                        while($mang6=mysqli_fetch_assoc($query6))
                                        {
                                            echo "<tr>\n";
                                                echo "<td>\n".$mang6['gio']."</td>\n";
                                                echo "<td>\n".$mang6['mavx']."</td>\n";
                                                echo "<td>\n".$mang6['sdt']."</td>\n";
                                                echo "<td>\n".$mang6['bienso']."</td>\n";
                                                echo "<td>\n".$mang6['tentx']."</td>\n";

                                                $ngaydatt=explode(' ',$mang6['ngaydat']);
                                                $ngaydatt2=explode('-',$ngaydatt[0]);
                                                $ngaydatt3=explode(':',$ngaydatt[1]);
                                                echo "<td>\n".$ngaydatt3[1]."h".$ngaydatt3[0]." ".$ngaydatt2[2]."-".$ngaydatt2[1]."-".$ngaydatt2[0]."</td>\n";

                                                $tam=(string) ($mang6['gia']);
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

                                                echo "<td>\n".$mang6['ghichu']."</td>\n";
                                            echo "</tr>\n";	
                                        }
                                    }
                                }          
                            }                             
                        ?>
                        </tbody>
                    </table>    
                </div>
            </div>
            
            

            <div class="tbtrang">
                <div class="tieude">Thông báo lên vé theo nhóm</div>
                <form action="quanlivexe.php" method="post">
                    <table class="table table-hover">
                        <tr>
                            <td>Đặt cho ngày</td>
                            <?php         
                                $sql="select DISTINCT datchongay from vexe";
                                $query=mysqli_query($con,$sql);    
                            ?>
                            <td>
                                <select name="datchongay">
                                    <?php 
                                        while ($mang = mysqli_fetch_array($query)) {
                                    ?>
                                    <option value= "<?php echo $mang['datchongay']; ?>"> <?php echo $mang['datchongay']; ?></option>
                                    <?php 
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Giờ</td>
                            <?php         
                                $sql="select DISTINCT gio from vexe";
                                $query=mysqli_query($con,$sql);    
                            ?>
                            <td>
                                <select name="gio" id="gio" onchange="gioo()">
                                    <option value="khong"></option>
                                    <?php 
                                        while ($mang = mysqli_fetch_array($query)) {
                                    ?>
                                    <option value= "<?php echo $mang['gio']; ?>"> <?php echo $mang['gio']; ?></option>
                                    <?php 
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Chuyến xe</td>
                            <?php         
                                $sql="select DISTINCT vexe.macx,tenchuyen from vexe inner join chuyenxe on vexe.macx=chuyenxe.macx";
                                $query=mysqli_query($con,$sql);    
                            ?>
                            <td>
                                <select name="machuyenxe" id="machuyenxe" onchange="machuyenxee()">
                                    <option value="khong"></option>
                                    <?php 
                                        while ($mang = mysqli_fetch_array($query)) {
                                    ?>
                                    <option value= "<?php echo $mang['macx']; ?>"> <?php echo $mang['tenchuyen']; ?></option>
                                    <?php 
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Biển số</td>
                            <?php         
                                $sql="select DISTINCT bienso from vexe";
                                $query=mysqli_query($con,$sql);    
                            ?>
                            <td>
                                <select name="bienso" id="bienso" >
                                    <option value="khong"></option>
                                    <?php 
                                        while ($mang = mysqli_fetch_array($query)) {
                                    ?>
                                    <option value= "<?php echo $mang['bienso']; ?>"> <?php echo $mang['bienso']; ?></option>
                                    <?php 
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text" name="tbve"></td>
                            <td><input type="submit" name="subtbve" value="Cập nhật" class="btn btn-warning"></td>
                        </tr>
                    </table>
                </form>
            </div>

            <div class="tbtrang">
                <div class="tieude">Thông báo lên vé cụ thể</div>
                <form action="quanlivexe.php" method="post">
                    <table class="table table-hover">
                        <tr>
                            <td>Mã vé</td>
                            <?php         
                                $sql="select mavx from vexe";
                                $query=mysqli_query($con,$sql);    
                            ?>
                            <td>
                                <select name="mavexe">
                                    <?php 
                                        while ($mang = mysqli_fetch_array($query)) {
                                    ?>
                                    <option value= "<?php echo $mang['mavx']; ?>"> <?php echo $mang['mavx']; ?></option>
                                    <?php 
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text" name="tbve"></td>
                            <td><input type="submit" name="subtbvecuthe" value="Cập nhật" class="btn btn-warning"></td>
                        </tr>
                    </table>
                </form>
            </div>
            
            <div class="tbtrang">
                <div class="tieude">Thông báo trên trang</div>
                <?php
                    $sql="select * from thongbaotrang";
                    $query=mysqli_query($con,$sql);
                    $mang=mysqli_fetch_assoc($query);
                    if(mysqli_num_rows($query)>0)
                    {
                        echo "<span>".$mang['ghichu']."</span><br>";
                    }
                ?>
                <form action="quanlivexe.php" method="post">
                    <table class="table table-hover">
                        <tr>
                            <td>
                            <input type="text" name="tbtrang"></td>
                            <td><input type="submit" name="subtbtrang" value="Cập nhật" class="btn btn-warning">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        
    </body>
</html>