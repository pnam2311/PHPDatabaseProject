<?php
	include '../sql/sql.php';
    ob_start();
    session_start();

    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
        header("Location: ../index.php");
    }

?>

<html>
<head>
	<title>Thông tin cá nhân</title>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/background.css">
    </head>
    
    <body>
    <nav class="navbar navbar-default"> 
    <div class="container-fluid">
         <div class="navbar-header">
         <a class="navbar-brand" href="#">Bệnh viện</a>
        </div>
        <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li class="active"><a href="myinfo.php">Thông tin cá nhân</a></li>
        <li><a href="patientlist.php">Danh sách bệnh nhân</a></li>
        <li><a href="changepass.php">Đổi mật khẩu</a></li>
    </ul>
     <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</a></li>
    </ul>
    </div>
    </nav>
<div class="container">
 <table class="table table-bordered" >
  <thead>
    <tr class="active">
    <th>ID</th>
    <th>Tên</th>
    <th>Giới tính</th>
    <th>Địa chỉ</th>
    <th>Số điện thoại</th>
    <th>Ca trực</th>
    <th>Lương ca</th>
    <th>Thưởng</th>
    <th>Tổng</th>
    </br>
  </tr>
  </thead>
  <tr>
  <?php
   $idbs = $_SESSION['user'];
   $q1 = pg_query($con,"select * from \"bacsi\" where \"idBs\" = '$idbs'");
   $row = pg_fetch_array($q1);
   for($i = 0;$i<9;$i++){
    echo '<td class="active">'.$row[$i].'</td> ';
   }
     ?>
  </tr>
</table>
<a href="index.php"><button class="btn btn-primary" >< Quay lại</button></a>
</div>
</body>
</html>

