﻿<?php
	include '../sql/sql.php';
    ob_start();
    session_start();

    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
        header("Location: ../index.php");
    }
?>

<html>
<head>
	<title>Admin</title>
	<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/background.css">
</head>

	<body>
	<nav class="navbar navbar-default navbarfix">
    <div class="container-fluid">
      <div class="navbar-header">
          <a class="navbar-brand" href="#">Bệnh viện</a>
      </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="admin.php">Home</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Bác sĩ
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="createdr.php">Tạo tài khoản bác sĩ</a></li>
          <li><a href="deletedr.php">Xóa tài khoản bác sĩ</a></li>
          
        </ul>
      </li>
        <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Bệnh nhân
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="creatept.php">Nhập bệnh nhân</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Nhân viên
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="createemp.php">Nhập nhân viên</a></li>
          <li><a href="deleteemp.php">Xóa nhân viên</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Phòng
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="roomemp.php">Nhân viên phụ trách phòng</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">In danh sách
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="printdr.php">Bác Sĩ</a></li>
          <li><a href="printpt.php">Bệnh Nhân</a></li>
           <li><a href="printemp.php">Nhân Viên</a></li>
        </ul>
      </li>
      <li class=""><a href="changepass.php">Đổi mật khẩu</a></li>
    </ul>
     <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</a></li>
    </ul>
  </div>
</nav>

</body>
</html>