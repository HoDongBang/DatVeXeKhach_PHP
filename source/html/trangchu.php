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
        <link rel="stylesheet" type="text/css" href="../css/trangchu.css">

        <?php
            include 'connect.php';
            $sdt="";
            $thongbao="";
		    //kiểm tra session có hay chưa, chưa thì start;
			if (session_id() === '')
				session_start();	
                
            if(isset($_POST['ok'])==true)
            {               
                $sdtt=$_POST['sdt_ttk'];
                $mk=$_POST['matkhau'];
                if( strlen($sdtt)!=0 && strlen($mk)!=0)
                {
                    if(isset($_POST['check']))
                    {
                        $sql="select * from admin where tendangnhap='".$sdtt."' and matkhau='".$mk."'";
                        $query=mysqli_query($con,$sql);
                        if(mysqli_num_rows($query)==0)
                        {
                            $thongbao="Tên đăng nhập hoặc mật khẩu sai!";
                        }
                        else
                        {			
                            $_SESSION['ttk']=$sdtt;
                            header("location:trangquantri.php");
                            exit();
                        }
                    }
                    else
                    {
                        $sql="select * from khachhang where sdt='".$sdtt."' and matkhau='".$mk."'";
                        $query=mysqli_query($con,$sql);
                        if(mysqli_num_rows($query)==0)
                        {
                            $thongbao="Số điện thoại hoặc mật khẩu sai!";
                        }
                        else
                        {			
                            $_SESSION['sdt']=$sdtt;
                            header("location:trangchu.php");
                            exit();
                        }
                    }
                }
            }
            if( isset( $_SESSION['sdt'] ) )
                $sdt= $_SESSION['sdt'];
		?>
		<script>
            var thongbao = <?php echo json_encode($thongbao); ?>;
            if(thongbao!="")
            {				
                alert(thongbao);
            }
			function an()
			{
				var sdt = <?php echo json_encode($sdt); ?>;
				if(sdt!="")
				{				
					document.getElementById("tk").style.display = "block";
					document.getElementById("dx").style.display = "block";
					document.getElementById("dk").style.display = "none";
					document.getElementById("dn").style.display = "none";
				}	
			};
			window.onload = function()
			{
				an();
			};					
		</script>

    </head>
    <body>
        <div class="container1">
            <div class="banner">
                <img src="../img/logo.png" alt="logo xe khach"/>             
                <button class="btn btn-success" type="button" id="dn">Đăng nhập</button>
                <form method="post" action="trangchu.php" id="loaddn" class="load">
                    <input type="text" name="sdt_ttk" placeholder="SĐT/Tên đăng nhập"/>
                    <input type="password" name="matkhau" placeholder="Mật khẩu"/>
                    <input type="checkbox" name="check" value="admin" id="check"><label for="check"><span></span>Admin</label>
                    <input type="submit" value="Đăng nhập" name="ok" class="btn btn-danger"/>
                </form>
                <a href="dangky.php" id="dk"><button class="btn btn-success" type="button">Đăng ký</button></a>
                <a href="dangxuat.php" id="dx"><button class="btn btn-success" type="button">Đăng xuất</button></a>
                <a href="thongtin.php" id="tk"><button class="btn btn-success" type="button">
                    <?php                      
                        $sql="select tenkh from khachhang where sdt='".$sdt."'";
                        $query=mysqli_query($con,$sql);
                        $bien=mysqli_fetch_array($query);
                        $mangten= explode(" ",$bien[0]);
                        if(strlen($mangten[count($mangten)-1])>10)
                            $mangten[count($mangten)-1]=substr($mangten[count($mangten)-1], 10);
                        echo $mangten[count($mangten)-1];
                    ?>
                </button></a>
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

            <div class="than">
                <img src="../img/banner.jpg">
                <div class="hinh"></div>
                <div class="tb">
                    <?php
                        $sql="select * from thongbaotrang";
                        $query=mysqli_query($con,$sql);
                        $mang=mysqli_fetch_assoc($query);
                        if(mysqli_num_rows($query)>0)
                            echo $mang['ghichu'];
                    ?>
                </div>
                <form method="post" action="trangchu.php">
                    <input type="search" placeholder="Tìm kiếm" name="search">
                </form>
                <table class="table table-hover table2">
                    <thead>
                        <tr>
                            <th>Nơi đi - Nơi đến</th>
                            <th>Khoảng cách (km)</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
                <div class="chuyenxe">       
                <table class="table table-hover">
                    
                    <tbody>
                        <?php
                            $search="";
                            if(isset($_POST['search']))
                                $search=$_POST['search'];
                            if($search=="")
                                $sql="select macx,tenchuyen,khoangcach from chuyenxe order by tenchuyen";
                            if($search!="")
                                $sql="select macx,tenchuyen,khoangcach from chuyenxe where tenchuyen like '%".$search."%'";
                            $query=mysqli_query($con,$sql);
                            while($mang=mysqli_fetch_assoc($query))
                            {
                                echo "<tr>\n";
                                    echo "<td>\n".$mang['tenchuyen']."</td>\n";
                                    echo "<td>\n".$mang['khoangcach']."</td>\n";
                                    echo"<td><a href=\"chitiet.php?machuyen=".$mang['macx']."\"><button type=\"button\" class=\"btn btn-danger\">Chi tiết</button></a></td>";
                                echo "</tr>\n";	
                            }

                            mysqli_close($con);
                        ?>
                    </tbody>
                </table>
                </div>
            </div>

            <div class="footer">
                <img src="../img/logo.png" alt="logo xe khach"/> 
                <h3> CÔNG TY CỔ PHẦN XE KHÁCH THÁNH THIỆN</h3><br/>
                <span>Điện thoại:</span><span class="dt"> 039 632 0503</span><br/>
                <span>Địa chỉ: <a href="https://www.google.com/maps/place/25+Qu%E1%BA%A3n+Tr%E1%BB%8Dng+Ho%C3%A0ng,+Xu%C3%A2n+Kh%C3%A1nh,
                +Ninh+Ki%E1%BB%81u,+C%E1%BA%A7n+Th%C6%A1,+Vi%E1%BB%87t+Nam/@10.0232823,105.7670787,17z/data=!4m5!3m4!1s0x31a0883
                a90f778c5:0x908daaecc0634c85!8m2!3d10.0232453!4d105.7683232"> số 25, Quản Trọng Hoàng, Hưng Lợi, Ninh 
                Kiều, Cần Thơ</a></span><br/>
                <span>Facebook: <a href="https://www.facebook.com/thien.hominh.94/">Hồ Đóng Băng<a></span><br/>
            </div>
        </div>
        <script>
            $(document).ready(function()
            {
                $("#dn").click(function()
                {
                    $("#loaddn").show();
                });
            });
            $(document).ready(function()
            {
                $(".than, .footer").click(function()
                {
                    $("#loaddn").hide();
                });
            });
        </script>
    </body>
</html>