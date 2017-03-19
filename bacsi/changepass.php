<?php
	include '../sql/sql.php';
    ob_start();
    session_start();
    $error = "";

    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
        header("Location: ../index.php");
    }

	if(isset($_POST['oldpass']) && isset($_POST['newpass'])){
		if($_POST['oldpass'] == $_SESSION['pass']){
			if($_POST['oldpass'] == $_POST['newpass']){
				$error = 'Mật khẩu mới trùng mật khẩu cũ!';
			}else{
				$newpass = $_POST['newpass'];
				$ssuser = $_SESSION['user'];
				$result = pg_query($con,"update \"access\" set \"password\"='$newpass' where \"id\"='$ssuser'");
				$error = 'Đổi mật khẩu thành công';
				session_unset();
			}
		}else{
			$error = 'Mật khẩu cũ sai!';
		}
	}
?>


<html>
<head>
	<title>Đổi mật khẩu</title>
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
        <li><a href="myinfo.php">Thông tin cá nhân</a></li>
        <li><a href="patientlist.php">Danh sách bệnh nhân</a></li>
        <li class="active"><a href="changepass.php">Đổi mật khẩu</a></li>
    </ul>
     <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</a></li>
    </ul>
    </div>
    </nav>
<div class="container">
	<form method="post">
		<div class="form-group col-md-6">
        <label for="oldpass">Nhập mật khẩu cũ:</label>
		<input type="password" class="form-control" id="oldpass" name="oldpass" required></br>
		<input type="submit" class="btn btn-primary" value="Đổi mật khẩu">
		</div>
		<div class="form-group col-md-6">
        <label for="newpass">Nhập mật khẩu mới:</label>
		<input type="password" class="form-control col-md-" id="newpass" name="newpass" required></br>
		</div>
	</form>
</div>
</body>
</html>
