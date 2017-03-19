<?php
    // Start the session
	include '../sql/sql.php';
    ob_start();
    session_start();

    // Check to see if actually logged in. If not, redirect to login page
    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
        header("Location: ../index.php");
    }
?>

<html>
<head>
    <title>Bác sĩ</title>
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
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="myinfo.php">Thông tin cá nhân</a></li>
        <li><a href="patientlist.php">Danh sách bệnh nhân</a></li>
        <li><a href="changepass.php">Đổi mật khẩu</a></li>
    </ul>
     <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</a></li>
    </ul>
    </div>
    </nav>

</body>
</html>

