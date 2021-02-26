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
		<link rel="stylesheet" type="text/css" href="../css/thongtin.css">
	</head>
	<body>
		<?php
			$sdt="";
			include 'connect.php';
			//kiểm tra session có hay chưa, chưa thì start;
			if (session_id() === '')
				session_start();
			if( isset( $_SESSION['sdt'] ) )
				$sdt= $_SESSION['sdt'];
			$sql="select * from khachhang where sdt='".$sdt."'";
			$query=mysqli_query($con,$sql);
			$mang=mysqli_fetch_array($query);
		?>
		<div class="container1" id="container1">
			<div class="container2">
				<a href="trangchu.php"><input class="btn btn-success" type="button" value="Về trang chủ"></a><br>			
				<center><h2><?php echo $mang['tenkh'] ?></h2></center><br>
				<div class="table1">
					<table>
						<thead>
							<tr>
								<th>Số điện thoại</th>
								<th>Ngày sinh</th>	
							</tr>
						</thead>						
						<tbody>
							<tr>
								<td>
									<?php echo $mang['sdt']; ?>
								</td>
								<td>
									<?php echo $mang['ngaysinh']; ?>
								</td>
							</tr>
						</tbody>
					</table>
				
				<a  href="suathongtin.php"><input class="btn btn-warning nutstt" type="button" value="Sửa thông tin"></a>
				<a  href="doimatkhau.php"><input class="btn btn-warning nutdmk" type="button" value="Đổi mật khẩu"></a>
				</div>
				<h2>Đã đặt</h2><br>			
				<div class="table2 table-hover table-striped">
					<table>
						<thead>
							<tr>
								<th>Mã vé xe</th>
								<th>Tên chuyến xe</th>
								<th>Tên tài xế</th>
								<th>SĐT tài xế</th>
								<th>Biến số xe</th>
								<th>Loại xe</th>
								<th>Ngày đặt vé</th>
								<th>Vé đặt cho ngày</th>
								<th>Giờ</th>
								<th>Vị trí ghế</th>
								<th>Giá</th>
								<th>Ghi chú</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql="select mavx,tenchuyen,tentx,taixe.sdt,vexe.bienso,tenlx,ngaydat,datchongay,gio,vitrighe,(giatrenkm*khoangcach) as gia,ghichu 
								from vexe inner join chuyenxe on vexe.macx=chuyenxe.macx inner join taixe on vexe.matx=taixe.matx inner join xe on vexe.bienso=xe.bienso 
								inner join loaixe on xe.malx=loaixe.malx where vexe.sdt='".$sdt."' ORDER BY mavx DESC";
								$query=mysqli_query($con,$sql);
								while($mang=mysqli_fetch_assoc($query))
								{
									echo "<tr>\n";
									
										echo "<td>\n".$mang['mavx']."</td>\n";
										echo "<td>\n".$mang['tenchuyen']."</td>\n";
										echo "<td>\n".$mang['tentx']."</td>\n";
										echo "<td>\n".$mang['sdt']."</td>\n";
										echo "<td>\n".$mang['bienso']."</td>\n";
										echo "<td>\n".$mang['tenlx']."</td>\n";

										$ngaydatt=explode(' ',$mang['ngaydat']);
										$ngaydatt2=explode('-',$ngaydatt[0]);
										$ngaydatt3=explode(':',$ngaydatt[1]);
										echo "<td>\n".$ngaydatt3[1]."h".$ngaydatt3[0]." ".$ngaydatt2[2]."-".$ngaydatt2[1]."-".$ngaydatt2[0]."</td>\n";

										$datchongayy=explode('-',$mang['datchongay']);
										echo "<td>\n".$datchongayy[2]."-".$datchongayy[1]."-".$datchongayy[0]."</td>\n";

										echo "<td>\n".$mang['gio']."</td>\n";
										echo "<td>\n".$mang['vitrighe']."</td>\n";

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

										echo "<td>\n".$mang['ghichu']."</td>\n";
										echo"<td><a onclick=\"return window.confirm('Bạn hủy vé không?');\" href=\"huyve.php?huyve=".$mang['mavx']."\"><button type=\"button\" class=\"btn btn-warning\">Hủy</button></a></td>";
									echo "</tr>\n";	
								}
								mysqli_close($con);
							?>
						</tbody>
					</table>
				</div>				
			</div>
		</div>
	</body>
</html>