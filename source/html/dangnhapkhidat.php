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
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<?php

            include 'connect.php';
            $macx="";
            $datchongay="";
            $gio="";
            $bienso="";
            $vitrighee="";
            $ngaydat="";
            if(isset($_GET['machuyenxe']) && isset($_GET['datchongay']) && isset($_GET['gio']) && isset($_GET['bienso']) && isset($_GET['vitrighe']) && isset($_GET['ngaydat']))
            {
                $macx=$_GET['machuyenxe'];
                $datchongay=$_GET['datchongay'];
                $gio=$_GET['gio'];
                $bienso=$_GET['bienso'];
                $vitrighee=$_GET['vitrighe'];
                $ngaydat=$_GET['ngaydat'];
            }

            $thongbao="";
			if(isset($_POST['ok'])==true)
            {              
                $sdtt=$_POST['sdt_ttk'];
                $mk=$_POST['matkhau'];

                $sql="select * from khachhang where sdt='".$sdtt."' and matkhau='".$mk."'";
                $query=mysqli_query($con,$sql);
                if(mysqli_num_rows($query)==0)
                {
                    $thongbao="Số điện thoại hoặc mật khẩu sai!";
                }
                else
                {		
                    if (session_id() === '')
						session_start();
                    $_SESSION['sdt']=$sdtt;
                    header("location:datve.php?machuyenxe=".$macx."&&datchongay=".$datchongay."&&gio=".$gio."&&bienso=".$bienso."&&vitrighe=".$vitrighee."&&ngaydat=".$ngaydat);
                    exit();
                }
            }
		?>
	</head>
	<body>
		<div class="container1">
			<div class="frm">
                <form method="post" action="<?php echo "dangnhapkhidat.php?machuyenxe=".$macx."&&datchongay=".$datchongay."&&gio=".$gio."&&bienso=".$bienso."&&vitrighe=".$vitrighee."&&ngaydat=".$ngaydat; ?>" id="loaddn" class="load">
                    <label for="sdt">Số điện thoại:</label>
                    <input type="text" name="sdt_ttk" id="sdt" placeholder="Số điện thoại"/>
                    <label for="mk">Mật khẩu:</label>
                    <input type="password" name="matkhau" id="mk" placeholder="Mật khẩu"/>
                    
                    <input type="submit" value="Đăng nhập" name="ok" class="button"/>
                </form>
			</div>
			<div class="thongbao">
				<span><?php echo $thongbao; ?></span>
			</div>
		</div>
	</body>
</html>
