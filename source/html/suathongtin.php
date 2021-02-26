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
             $sdt="";
             $thongbao="";
             //kiểm tra session có hay chưa, chưa thì start;
             if (session_id() === '')
                 session_start();
            if( isset( $_SESSION['sdt'] ) )
                $sdt= $_SESSION['sdt'];    
			if(isset($_POST['ok'])==true)
			{
				$ht=$_POST['ht'];
				$ns=$_POST['ns'];
				
				if(strlen($sdt)==0)
					$thongbao=$thongbao."Số điện thoại không được để trống! ";
				if(strlen($ht)==0)
					$thongbao=$thongbao."Họ tên không được để trống! ";				
				if(strlen($mk)>25)
					$thongbao=$thongbao."Mật khẩu tối đa 25 kí tự! ";
				if(strlen($thongbao)==0)
				{

					$sql="UPDATE khachhang SET tenkh='".$ht."',ngaysinh='".$ns."' WHERE sdt='".$sdt."'";
					$query=mysqli_query($con,$sql);
					header("location:thongtin.php");
					exit();				
				}
				
			}
		?>
	</head>
	<body>
    <div class="container1">
            <a href="thongtin.php"><input class="btn btn-success" type="button" value="Về trang thông tin"></a>
			<a href="trangchu.php"><input class="btn btn-success" type="button" value="Về trang chủ"></a><br>
			<div class="frm">
            <?php
                $sql="select * from khachhang where sdt='".$sdt."'";
                $query=mysqli_query($con,$sql);
                $mang=mysqli_fetch_array($query);
                mysqli_close($con);
            ?>
				<form action="suathongtin.php" method="post">
					<h1>Sửa thông tin</h1>
					
					<label for="ht">Họ và tên:</label>
					<input type="text" id="ht" name="ht" placeholder="Họ và tên" value="<?php echo $mang['tenkh']; ?>">

					<label for="ns">Ngày sinh:</label>
					<input type="date" id="ns" name="ns" value="<?php echo $mang['ngaysinh']; ?>">
					
					<input type="submit" name="ok" value="Sửa" class="button">
				</form>
			</div>
			<div class="thongbao">
				<span><?php echo $thongbao; ?></span>
			</div>
		</div>
	</body>
</html>