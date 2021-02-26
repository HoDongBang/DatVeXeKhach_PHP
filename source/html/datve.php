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
        <link rel="stylesheet" type="text/css" href="../css/datve.css">
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
            
                <?php
                    include 'connect.php';
                    $macx="";
                    $datchongay="";
                    $gio="";
                    $bienso="";
                    $vitrighee="";
                    if(isset($_GET['machuyenxe']) && isset($_GET['datchongay']) && isset($_GET['gio']) && isset($_GET['bienso']) && isset($_GET['vitrighe']))
                    {
                        $macx=$_GET['machuyenxe'];
                        $datchongay=$_GET['datchongay'];
                        $gio=$_GET['gio'];
                        $bienso=$_GET['bienso'];
                        $vitrighee=$_GET['vitrighe'];
                    }
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $ngaydat=getdate();
                    $ngaydatt=$ngaydat['minutes']."h".$ngaydat['hours']." ".$ngaydat['mday']."-".$ngaydat['mon']."-".$ngaydat['year'];             
                    //kiểm tra session có hay chưa, chưa thì start;
                    if (session_id() === '')
                        session_start();
                    if( isset( $_SESSION['sdt'] ) )
                    {
                        $vitrighe=array();
                        $vitrighe=explode("-",$vitrighee);
                        $slghe=count($vitrighe);
                        echo "<table class=\"table table-hover\">";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Mã vé xe</th>";
                                    echo "<th>SĐT của bạn</th>";
                                    echo "<th>Tên chuyến xe</th>";
                                    echo "<th>Tên tài xế</th>";
                                    echo "<th>SĐT tài xế</th>";
                                    echo "<th>Biến số xe</th>";
                                    echo "<th>Loại xe</th>";
                                    echo "<th>Ngày đặt vé</th>";
                                    echo "<th>Vé đặt cho ngày</th>";
                                    echo "<th>Giờ</th>";
                                    echo "<th>Vị trí ghế</th>";
                                    echo "<th>Giá</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            $sql="select mavx from vexe ORDER BY mavx DESC LIMIT 1";
                            $query=mysqli_query($con,$sql);
                            $mang = mysqli_fetch_assoc($query);
                            $mavx="";     
                            if (mysqli_num_rows($query) > 0) {
                                $bientruyxuat = (int) substr($mang['mavx'], 2);
                                if ($bientruyxuat < 9)
                                    $mavx = "VX00" . (string) ($bientruyxuat + 1);
                                else if($bientruyxuat > 9 && $bientruyxuat < 99)
                                    $mavx = "VX0" . (string) ($bientruyxuat + 1);
                                else
                                    $mavx = "VX" . (string) ($bientruyxuat + 1);
                            } 
                            else {
                                $mavx = 'VX001';
                            }

                            $sql="select DISTINCT tenchuyen,tentx,taixe.sdt,tenlx,(giatrenkm*khoangcach) as gia from xe_chuyenxe inner join chuyenxe on xe_chuyenxe.macx=chuyenxe.macx 
                            inner join taixe on xe_chuyenxe.matx=taixe.matx inner join xe on xe_chuyenxe.bienso=xe.bienso inner join loaixe on xe.malx=loaixe.malx 
                            where xe_chuyenxe.macx='".$macx."' and xe_chuyenxe.bienso='".$bienso."' and xe_chuyenxe.gio=".$gio;
                            $query=mysqli_query($con,$sql);
                            $mang = mysqli_fetch_assoc($query);

                                echo "<tr>\n";
                                    echo "<td>\n".$mavx."</td>\n";
                                    echo "<td>\n".$_SESSION['sdt']."</td>\n";
                                    echo "<td>\n".$mang['tenchuyen']."</td>\n";
                                    echo "<td>\n".$mang['tentx']."</td>\n";
                                    echo "<td>\n".$mang['sdt']."</td>\n";
                                    echo "<td>\n".$bienso."</td>\n";
                                    echo "<td>\n".$mang['tenlx']."</td>\n";

                                    
                                    echo "<td>\n".$ngaydatt."</td>\n";
                                            
                                    echo "<td>\n".$datchongay."</td>\n";
                                    echo "<td>\n".$gio."</td>\n";
                                    echo "<td>\n".$vitrighe[0]."</td>\n";
                                    
                                    $tam=(string) ($mang['gia']);
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

                            for($i=1;$i<$slghe;$i++)
                            {
                                    
                                $bientruyxuat = (int) substr($mavx, 2);
                                if ($bientruyxuat < 9)
                                    $mavx = "VX00" . (string) ($bientruyxuat + 1);
                                else if($bientruyxuat > 9 && $bientruyxuat < 99)
                                    $mavx = "VX0" . (string) ($bientruyxuat + 1);
                                else
                                    $mavx = "VX" . (string) ($bientruyxuat + 1);
                            

                                    echo "<tr>\n";
                                        echo "<td>\n".$mavx."</td>\n";
                                        echo "<td>\n".$_SESSION['sdt']."</td>\n";
                                        echo "<td>\n".$mang['tenchuyen']."</td>\n";
                                        echo "<td>\n".$mang['tentx']."</td>\n";
                                        echo "<td>\n".$mang['sdt']."</td>\n";
                                        echo "<td>\n".$bienso."</td>\n";
                                        echo "<td>\n".$mang['tenlx']."</td>\n";

                                        
                                        echo "<td>\n".$ngaydatt."</td>\n";
                                                
                                        echo "<td>\n".$datchongay."</td>\n";
                                        echo "<td>\n".$gio."</td>\n";
                                        echo "<td>\n".$vitrighe[$i]."</td>\n";
                                        
                                        $tam=(string) ($mang['gia']);
                                        $giaa="";
                                        $s=0;
                                        for($c=(strlen($tam)%3);$c<strlen($tam);$c=$c+3)
                                        {
                                            if($c==0)
                                                $c=3;
                                            $giaa=$giaa.(substr($tam,$s,$c)).".";
                                            $s=$c;
                                        }
                                        $giaa=$giaa.(substr($tam,$s,3));
                                        echo "<td>\n".$giaa." đ</td>\n";
                                    echo "</tr>\n";            
                            }
                            echo "</tbody>";
                        echo "</table>";
                        echo "<div class=\"tong\">";
                            $tong="";
                            $tam=(string) (((int) $mang['gia'])*$slghe);
                                $s=0;
                                for($c=(strlen($tam)%3);$c<strlen($tam);$c=$c+3)
                                {
                                    if($c==0)
                                        $c=3;
                                    $tong=$tong.(substr($tam,$s,$c)).".";
                                    $s=$c;
                                }
                                $tong=$tong.(substr($tam,$s,3));
                            echo "<span>Tổng: ".$tong." đ"."</span>";
                            echo "<a href=\"thanhcong.php?machuyenxe=".$macx."&&datchongay=".$datchongay."&&gio=".$gio."&&bienso=".$bienso."&&vitrighe=".$vitrighee."&&ngaydat=".$ngaydatt."\"><button type=\"button\" class=\"btn btn-danger\">Đặt</button></a>";
                        echo "</div>";
                    }
                    else
                    {
                        echo "<div class=\"dangnhapdangki\">";
                            echo "<a href=\"dangnhapkhidat.php?machuyenxe=".$macx."&&datchongay=".$datchongay."&&gio=".$gio."&&bienso=".$bienso."&&vitrighe=".$vitrighee."&&ngaydat=".$ngaydatt."\"><button type=\"button\" class=\"btn btn-danger\">Đăng nhập</button></a>";
                            echo "<a href=\"dangkikhidat.php?machuyenxe=".$macx."&&datchongay=".$datchongay."&&gio=".$gio."&&bienso=".$bienso."&&vitrighe=".$vitrighee."&&ngaydat=".$ngaydatt."\"><button type=\"button\" class=\"btn btn-danger\">Đăng kí</button></a>";
                            echo "<div>Để tiếp tục đặt vé!</div>";
                        echo "</div>";
                    }
                ?>
            </div>
        </div>
    </body>
</html>