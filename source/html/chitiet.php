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
        <link rel="stylesheet" type="text/css" href="../css/chitiet.css">
        <?php
            include 'connect.php';
            $macx="";
            if(isset($_GET['machuyen']))
                $macx=$_GET['machuyen'];
            
            $hientai=getdate();
            
            if(isset($_POST['sub']))
                if(isset($_POST['datchongay']) && isset($_POST['gio']) && isset($_POST['bienso']))
                {
                    header("location:chonghe.php?machuyenxe=".$macx."&&datchongay=".$_POST['datchongay']."&&gio=".$_POST['gio']."&&bienso=".$_POST['bienso']);
	                exit();
                }
        ?>
            
    </head>
    <body>
        <div class="container1">
            <div class="banner">
                <img src="../img/logo.png" alt="logo xe khach"/>             
                
                <div class="menu">
                    <div>
                        <ul>
                            <li><a href="trangchu.php">TRANG CHỦ</a></li>
                            <li><a href="gioithieu.php">VỀ CHÚNG TÔI</a></li>
                            <li><a href="quidinh.php">NHỮNG QUY ĐỊNH</a></li>
                        </ul>
                    </div>
                </div>
            </div>            
            <br>
            <div class="than">
                <div class="container2">
                    <table class="table table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>Nơi đi - Nơi đến</th>
                                <th>Khoảng cách (km)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql="select macx,tenchuyen,khoangcach from chuyenxe where macx='".$macx."'";
                                $query=mysqli_query($con,$sql);
                                $mang=mysqli_fetch_assoc($query);
                                {
                                    echo "<tr>\n";
                                        echo "<td>\n".$mang['tenchuyen']."</td>\n";
                                        echo "<td>\n".$mang['khoangcach']."</td>\n";                                  
                                    echo "</tr>\n";	
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="container2">
                    <form action="<?php echo"chitiet.php?machuyen=".$macx; ?>" method="post">
                        <div class="container2">
                            <table class="table table-hover table-borderless">
                                <thead>
                                    <tr>
                                        <th>Ngày</th>
                                        <th>Giờ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php
                                                $thangtam=$hientai['mon'];
                                                if($thangtam<10)
                                                    $thangtam="0".$thangtam;
                                                $ngaytam=$hientai['mday'];
                                                if($ngaytam<10)
                                                    $ngaytam="0".$ngaytam;

                                                $thangmax=$hientai['mon'];
                                                $nammax=$hientai['year'];
                                                if($thangmax<10)
                                                    $thangmax=$thangmax+3;
                                                if($thangmax>9)
                                                {
                                                    $thangmax=$thangmax+3-12;
                                                    $nammax=$nammax+1;
                                                }                                           
                                                if($thangmax<10)
                                                    $thangmax="0".$thangmax;
                                                $ngaymax=$hientai['mday'];
                                                if($ngaymax>27)
                                                    $ngaymax=$ngaymax-3;
                                                if($ngaymax<10)
                                                    $ngaymax="0".$ngaymax;
                                                

                                            ?>
                                            <input type="date" name="datchongay" value="<?php 
                                                if(isset($_POST['datchongay'])) echo $_POST['datchongay']; else echo $hientai['year']."-".$thangtam."-".$ngaytam; ?>" 
                                            min="<?php echo $hientai['year']."-".$thangtam."-".$ngaytam; ?>" max="<?php echo $nammax."-".$thangmax."-".$ngaymax; ?>">
                                        </td>
                                        <td>
                                            <?php         
                                                $sql="select DISTINCT gio from xe_chuyenxe where macx='".$macx."'";
                                                $query=mysqli_query($con,$sql);    
                                            ?>
                                            <select name="gio" onChange="this.form.submit()">
                                                <?php 
                                                    while ($mang = mysqli_fetch_array($query)) {
                                                ?>
                                                <option value= "<?php echo $mang['gio']; ?>" 
                                                <?php if(isset($_POST['gio'])) if($_POST['gio']==$mang['gio']) echo "selected=\"selected\""?>> <?php echo $mang['gio']; ?></option>
                                                <?php 
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="container2">
                            <table class="table table-hover table-borderless">
                                <?php
                                    $sql="select * from loaixe";
                                    $query=mysqli_query($con,$sql);
                                    while($mang=mysqli_fetch_assoc($query))
                                    {
                                        echo "<tr>\n";
                                            echo "<td>\n".$mang['tenlx']."</td>\n";

                                            $sql2="select khoangcach from chuyenxe where macx='".$macx."'";
                                            $query2=mysqli_query($con,$sql2);
                                            $mang2=mysqli_fetch_assoc($query2);
                                            $tam=(string) ($mang['giatrenkm']*$mang2['khoangcach']);
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
                                        echo "</tr>\n";	
                                    }
                                ?>
                            </table>                                   
                        </div>
                        <div>
                            <?php
                                $sql="select DISTINCT gio from xe_chuyenxe where macx='".$macx."' LIMIT 1";
                                $query=mysqli_query($con,$sql);
                                $mang = mysqli_fetch_array($query);

                                $sql2="";
                                if(isset($_POST['gio']))
                                {
                                    $sql2="select tenlx,xe.bienso from xe_chuyenxe inner join xe on xe_chuyenxe.bienso=xe.bienso 
                                    inner join loaixe on xe.malx=loaixe.malx where macx='".$macx."' and gio='".$_POST['gio']."'";
                                    $query2=mysqli_query($con,$sql2);
                                    echo "<label>Loại xe</label>";
                                    echo "<select name=\"bienso\">";
                                        while ($mang2 = mysqli_fetch_array($query2))
                                        {
                                            echo "<option value=\"".$mang2['bienso']."\">".$mang2['tenlx']."</option>";
                                        }
                                    echo "</select>";
                                }
                                else
                                {
                                    $sql2="select tenlx,xe.bienso from xe_chuyenxe inner join xe on xe_chuyenxe.bienso=xe.bienso 
                                    inner join loaixe on xe.malx=loaixe.malx where macx='".$macx."' and gio='".$mang['gio']."'";
                                    $query2=mysqli_query($con,$sql2);
                                    echo "<label>Loại xe</label>";
                                    echo "<select name=\"bienso\">";
                                        while ($mang2 = mysqli_fetch_array($query2))
                                        {
                                            echo "<option value=\"".$mang2['bienso']."\">".$mang2['tenlx']."</option>";
                                        }
                                    echo "</select>";
                                }
                            ?>
                        </div>

                            <center><input type="submit" name="sub" value="Tiếp theo" class="btn btn-warning"></center>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>