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
			$thongbao="";
			if(isset($_POST['ok'])==true)
			{
				$sdt=$_POST['sdt'];
				$tdn=$_POST['tdn'];
				$mk=$_POST['mk'];
				$nlmk=$_POST['nlmk'];
				$ht=$_POST['ht'];
				$ns=$_POST['ns'];
				
				if(strlen($sdt)==0)
					$thongbao=$thongbao."Số điện thoại không được để trống! ";
				if(strlen($mk)==0)
					$thongbao=$thongbao."Mật khẩu không được để trống! ";
				if(strlen($nlmk)==0)
					$thongbao=$thongbao."Nhập lại mật khẩu không được để trống! ";
				if(strlen($ht)==0)
					$thongbao=$thongbao."Họ tên không được để trống! ";
				if($nlmk!=$mk)
					$thongbao=$thongbao."Mật khẩu không khớp! ";				
				if(strlen($sdt)>0)
				{
					$pa='/^[0-9]+$/';
					if(!preg_match($pa,$sdt))
						$thongbao=$thongbao."Số điện thoại phải là số! ";
				}
				if(strlen($sdt)>0&&strlen($sdt)<10)
					$thongbao=$thongbao."Số điện thoại phải 10 số! ";
				if(strlen($mk)>25)
					$thongbao=$thongbao."Mật khẩu tối đa 25 kí tự! ";
				include 'connect.php';
				$sql="select * from khachhang where sdt='".$sdt."'";
				$query=mysqli_query($con,$sql);
				if(mysqli_num_rows($query)>0)
				{
					$thongbao=$thongbao."Số điện thoại này đã được đăng ký tài khoản rồi, vui đăng ký bằng số điện thoại khác! ";
				}
				if(strlen($thongbao)==0)
				{

					$sql="INSERT INTO khachhang VALUES ('".$sdt."','".$ht."','".$ns."','".$mk."')";
					$query=mysqli_query($con,$sql);
					if (session_id() === '')
						session_start();
					$_SESSION['sdt']=$sdt;
					header("location:trangchu.php");
					exit();				
				}
				mysqli_close($con);
			}
		?>
	</head>
	<body>
		<div class="container1">
			<a href="trangchu.php"><input class="btn btn-success" type="button" value="Về trang chủ"></a><br>
			<div class="frm">
				<form action="dangky.php" method="post">
					<h1>ĐĂNG KÝ</h1>
					
					<label for="sdt">Số điện thoại:</label>
					<input type="text" id="sdt" name="sdt" placeholder="Số điện thoại" maxlength="10">
					
					<label for="mk">Mật khẩu:</label>
					<input type="password" id="mk" name="mk" placeholder="Mật khẩu" maxlength="16">
					
					<label for="nlmk">Nhập lại mật khẩu:</label>
					<input type="password" id="nlnmk" name="nlmk" placeholder="Nhập lại mật khẩu" maxlength="16">
					
					<label for="ht">Họ và tên:</label>
					<input type="text" id="ht" name="ht" placeholder="Họ và tên">

					<label for="ns">Ngày sinh:</label>
					<input type="date" id="ns" name="ns" value="2000-01-01">
					
					<input type="submit" name="ok" value="Đăng ký" class="button">
				</form>
			</div>
			<div class="thongbao">
				<span><?php echo $thongbao; ?></span>
			</div>
		</div>
	</body>
</html>
