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
        <link rel="stylesheet" type="text/css" href="../css/trangquantri.css">
        <?php
            include 'connect.php';
            $ttk="";
            //kiểm tra session có hay chưa, chưa thì start;
			if (session_id() === '')
            session_start();
            if( isset( $_SESSION['ttk'] ) )
                $ttk= $_SESSION['ttk'];
		?>
    </head>
    <body>
        <div class="container1">
            <a class="dx" href="dangxuatadmin.php"><button class="btn btn-success" type="button">Đăng xuất</button></a><br>
            <center><h2><?php echo $ttk; ?></h2></center>
            <div class="quanli">
                <div class="qlx"><a href="quanlixe.php"><button>Quản lí xe</button></a></div>
                <div class="qlcx"><a href="quanlichuyenxe.php"><button>Quản lí chuyến xe</button></a></div>
                <div class="qltx"><a href="quanlitaixe.php"><button>Quản lí tài xế</button></a></div>
                <div class="qlvx"><a href="quanlivexe.php"><button>Quản lí vé xe</button></a></div>
           </div>
        </div>
    </body>
</html>