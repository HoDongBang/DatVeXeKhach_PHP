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
        <link rel="stylesheet" type="text/css" href="../css/chonghe.css">

        <?php
            include 'connect.php';
            $macx="";
            $datchongay="";
            $gio="";
            $bienso="";
            if(isset($_GET['machuyenxe']) && isset($_GET['datchongay']) && isset($_GET['gio']) && isset($_GET['bienso']))
            {
                $macx=$_GET['machuyenxe'];
                $datchongay=$_GET['datchongay'];
                $gio=$_GET['gio'];
                $bienso=$_GET['bienso'];
            }

            $vitrighee="";   
            if(isset($_POST['datghe'])==true)
            { 
                if(isset($_POST['vitrighe'])==true  )
                {  
                    foreach($_POST['vitrighe'] as $val)
                    {
                        $vitrighee=$vitrighee."-".$val;
                    }
                }
                $vitrighee=substr($vitrighee,1);
                header("location:datve.php?machuyenxe=".$macx."&&datchongay=".$datchongay."&&gio=".$gio."&&bienso=".$bienso."&&vitrighe=".$vitrighee);
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
                <div class="ghe">
                    <div class="ghe1">
                        <div></div>
                        <label class="coo">Đã có người chọn</label>
                    </div>
                    <div class="ghe2">
                        <div></div>
                        <label class="khong">Trống</label>
                    </div>
                    <div class="ghe3">
                        <div></div>
                        <label class="dangchon">Đang chọn</label>
                    </div>
                </div><br>
                <div class="chonghe">
                    <center><label class="taixe">Tài xế<label></center>
                    <form name="frm" action="<?php echo "chonghe.php?machuyenxe=".$macx."&&datchongay=".$datchongay."&&gio=".$gio."&&bienso=".$bienso; ?>" method="post">
                    <?php
                        $sql="select tenlx from xe inner join loaixe on xe.malx=loaixe.malx where bienso='".$bienso."'";
                        $query=mysqli_query($con,$sql);
                        $mang=mysqli_fetch_assoc($query);
                        if($mang['tenlx']=="Xe giường nằm")
                        {
                            echo "<div class=\"baogiuong\">";
                            echo "<div class=\"giuong\">";
                            $sql="select soluongghe from xe where bienso='".$bienso."'";
                            $query=mysqli_query($con,$sql);
                            $mang=mysqli_fetch_assoc($query);
                            $sl=$mang['soluongghe'];
                            echo "<div class=\"giuong1\">";
                                echo "<div class=\"tang\">Tầng 1</div>";
                                echo "<div class=\"hang1\">";
                                for($i=1;$i<=($sl/4);$i++)
                                {
                                    $tang="a";
                                    $so=(string) $i;
                                    if($i<10)
                                        $so="0".$so;
                                    $hienghe=$tang.$so;
                                    $sql="select vitrighe from vexe where vitrighe='".$hienghe."' and macx='".$macx."' and datchongay='".$datchongay."' and gio='".$gio."' and bienso='".$bienso."'";
                                    $query=mysqli_query($con,$sql);
                                    if(mysqli_num_rows($query)>0)
                                        echo "<label class=\"co\">".$hienghe."</label>";
                                    else echo "<input type=\"checkbox\" id=\"".$hienghe."\" name=\"vitrighe[]\" value=\"".$hienghe."\" onchange=\"an(frm)\"><label for=\"".$hienghe."\" class=\"khong\">".$hienghe."</label>"; 
                                }
                                echo "</div>";
                                echo "<div class=\"hang2\">";
                                for($i=($sl/2);$i>($sl/4);$i--)
                                {
                                    $tang="a";
                                    $so=(string) $i;
                                    if($i<10)
                                        $so="0".$so;
                                    $hienghe=$tang.$so;
                                    $sql="select vitrighe from vexe where vitrighe='".$hienghe."' and macx='".$macx."' and datchongay='".$datchongay."' and gio='".$gio."' and bienso='".$bienso."'";
                                    $query=mysqli_query($con,$sql);
                                    if(mysqli_num_rows($query)>0)
                                        echo "<label class=\"co\">".$hienghe."</label>";
                                    else echo "<input type=\"checkbox\" id=\"".$hienghe."\" name=\"vitrighe[]\" value=\"".$hienghe."\" onchange=\"an(frm)\"><label for=\"".$hienghe."\" class=\"khong\">".$hienghe."</label>"; 
                                }
                                echo "</div>";
                            echo "</div>";
                            echo "<div class=\"giuong2\">";
                                echo "<div class=\"tang\">Tầng 2</div>";
                                echo "<div class=\"hang3\">";
                                for($i=($sl/2+1);$i<=($sl/4+$sl/2);$i++)
                                {
                                    $tang="b";
                                    $so=(string) $i;
                                    if($i<10)
                                        $so="0".$so;
                                    $hienghe=$tang.$so;
                                    $sql="select vitrighe from vexe where vitrighe='".$hienghe."' and macx='".$macx."' and datchongay='".$datchongay."' and gio='".$gio."' and bienso='".$bienso."'";
                                    $query=mysqli_query($con,$sql);
                                    if(mysqli_num_rows($query)>0)
                                        echo "<label class=\"co\">".$hienghe."</label>";
                                    else echo "<input type=\"checkbox\" id=\"".$hienghe."\" name=\"vitrighe[]\" value=\"".$hienghe."\" onchange=\"an(frm)\"><label for=\"".$hienghe."\" class=\"khong\">".$hienghe."</label>"; 
                                }
                                echo "</div>";
                                echo "<div class=\"hang4\">";
                                for($i=($sl);$i>($sl/4+$sl/2);$i--)
                                {
                                    $tang="b";
                                    $so=(string) $i;
                                    if($i<10)
                                        $so="0".$so;
                                    $hienghe=$tang.$so;
                                    $sql="select vitrighe from vexe where vitrighe='".$hienghe."' and macx='".$macx."' and datchongay='".$datchongay."' and gio='".$gio."' and bienso='".$bienso."'";
                                    $query=mysqli_query($con,$sql);
                                    if(mysqli_num_rows($query)>0)
                                        echo "<label class=\"co\">".$hienghe."</label>";
                                    else echo "<input type=\"checkbox\" id=\"".$hienghe."\" name=\"vitrighe[]\" value=\"".$hienghe."\" onchange=\"an(frm)\"><label for=\"".$hienghe."\" class=\"khong\">".$hienghe."</label>"; 
                                }
                                echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                        else
                        {
                            echo "<div class=\"baongoi\">";
                            echo "<div class=\"ngoi\">";
                            $sql="select soluongghe from xe where bienso='".$bienso."'";
                            $query=mysqli_query($con,$sql);
                            $mang=mysqli_fetch_assoc($query);
                            $sl=$mang['soluongghe'];
                            $sodu=0;
                            if($sl%4>0)
                                $sodu=1;

                                echo "<div class=\"ngoi1\">";
                                    echo "<div class=\"hang1\">";
                                    for($i=1;$i<=($sl/4+$sodu);$i++)
                                    {
                                        $tang="a";
                                        $so=(string) $i;
                                        if($i<10)
                                            $so="0".$so;
                                        $hienghe=$tang.$so;
                                        $sql="select vitrighe from vexe where vitrighe='".$hienghe."' and macx='".$macx."' and datchongay='".$datchongay."' and gio='".$gio."' and bienso='".$bienso."'";
                                        $query=mysqli_query($con,$sql);
                                        if(mysqli_num_rows($query)>0)
                                            echo "<label class=\"co\">".$hienghe."</label>";
                                        else echo "<input type=\"checkbox\" id=\"".$hienghe."\" name=\"vitrighe[]\" value=\"".$hienghe."\" onchange=\"an(frm)\"><label for=\"".$hienghe."\" class=\"khong\">".$hienghe."</label>"; 
                                    }
                                    echo "</div>";
                                    echo "<div class=\"hang2\">";
                                    for($i=($sl/2+$sodu);$i>($sl/4+$sodu);$i--)
                                    {
                                        $tang="a";
                                        $so=(string) $i;
                                        if($i<10)
                                            $so="0".$so;
                                        $hienghe=$tang.$so;
                                        $sql="select vitrighe from vexe where vitrighe='".$hienghe."' and macx='".$macx."' and datchongay='".$datchongay."' and gio='".$gio."' and bienso='".$bienso."'";
                                        $query=mysqli_query($con,$sql);
                                        if(mysqli_num_rows($query)>0)
                                            echo "<label class=\"co\">".$hienghe."</label>";
                                        else echo "<input type=\"checkbox\" id=\"".$hienghe."\" name=\"vitrighe[]\" value=\"".$hienghe."\" onchange=\"an(frm)\"><label for=\"".$hienghe."\" class=\"khong\">".$hienghe."</label>"; 
                                    }
                                    echo "</div>";
                                echo "</div>";
                                echo "<div class=\"ngoi2\">";
                                    echo "<div class=\"hang3\">";

                                    if($sodu>0)
                                        echo "<label class=\"db\"></label>";

                                    for($i=($sl/2+1+$sodu);$i<=($sl/4+$sl/2+$sodu);$i++)
                                    {
                                        $tang="a";
                                        $so=(string) $i;
                                        if($i<10)
                                            $so="0".$so;
                                        $hienghe=$tang.$so;
                                        $sql="select vitrighe from vexe where vitrighe='".$hienghe."' and macx='".$macx."' and datchongay='".$datchongay."' and gio='".$gio."' and bienso='".$bienso."'";
                                        $query=mysqli_query($con,$sql);
                                        if(mysqli_num_rows($query)>0)
                                            echo "<label class=\"co\">".$hienghe."</label>";
                                        else echo "<input type=\"checkbox\" id=\"".$hienghe."\" name=\"vitrighe[]\" value=\"".$hienghe."\" onchange=\"an(frm)\"><label for=\"".$hienghe."\" class=\"khong\">".$hienghe."</label>"; 
                                    }
                                    echo "</div>";
                                    echo "<div class=\"hang4\">";

                                    if($sodu>0)
                                        echo "<label class=\"db\"></label>";
                                    for($i=($sl);$i>($sl/4+$sl/2+$sodu);$i--)
                                    {
                                        $tang="a";
                                        $so=(string) $i;
                                        if($i<10)
                                            $so="0".$so;
                                        $hienghe=$tang.$so;
                                        $sql="select vitrighe from vexe where vitrighe='".$hienghe."' and macx='".$macx."' and datchongay='".$datchongay."' and gio='".$gio."' and bienso='".$bienso."'";
                                        $query=mysqli_query($con,$sql);
                                        if(mysqli_num_rows($query)>0)
                                            echo "<label class=\"co\">".$hienghe."</label>";
                                        else echo "<input type=\"checkbox\" id=\"".$hienghe."\" name=\"vitrighe[]\" value=\"".$hienghe."\" onchange=\"an(frm)\"><label for=\"".$hienghe."\" class=\"khong\">".$hienghe."</label>"; 
                                    }
                                    echo "</div>";
                                echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        }
                        
                    ?>
                        <div class="sub"><center><input type="submit" name="datghe" value="Tiếp theo" class="btn btn-danger"></center></div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>