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
				$mkht=$_POST['mkht'];
				$mkm=$_POST['mkm'];
				$nlmk=$_POST['nlmk'];
                
                if(strlen($mkht)==0)
                    $thongbao=$thongbao."Chưa nhập mật khẩu hiện tại! ";
                if(strlen($mkm)==0)
					$thongbao=$thongbao."Chưa nhập mật khẩu mới! ";
				if($nlmk!=$mkm)
					$thongbao=$thongbao."Mật khẩu không khớp! ";
				if(strlen($mkm)>25)
					$thongbao=$thongbao."Mật khẩu tối đa 25 kí tự! ";
				$sql="select * from khachhang where sdt='".$sdt."' and matkhau='".$mkht."'";
				$query=mysqli_query($con,$sql);
				if(mysqli_num_rows($query)==0)
				{
					$thongbao=$thongbao."Mật khẩu hiện tại không trùng khớp! ";
				}
				if(strlen($thongbao)==0)
				{
					$sql="UPDATE khachhang SET matkhau='".$mkm."' WHERE sdt='".$sdt."'";
                    $query=mysqli_query($con,$sql);
                    mysqli_close($con);
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
				<form action="doimatkhau.php" method="post">
					<h1>Đổi mật khẩu</h1>
                    
                    <label for="mkht">MK hiện tại:</label>
					<input type="password" id="mkht" name="mkht" placeholder="Mật khẩu hiện tại" maxlength="16">

					<label for="mkm">MK mới:</label>
					<input type="password" id="mkm" name="mkm" placeholder="Mật khẩu mới" maxlength="16">
					
					<label for="nlmk">Nhập lại MK mới:</label>
					<input type="password" id="nlmk" name="nlmk" placeholder="Nhập lại mật khẩu mới" maxlength="16">
					
					<input type="submit" name="ok" value="Đổi" class="button">
				</form>
			</div>
			<div class="thongbao">
				<span><?php echo $thongbao; ?></span>
			</div>
		</div>
	</body>
</html>