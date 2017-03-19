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
    <nav class="navbar navbar-default navbarfix">
    <div class="container-fluid">
      <div class="navbar-header">
          <a class="navbar-brand" href="#">Bệnh viện</a>
      </div>
    <ul class="nav navbar-nav">
      <li class=""><a href="admin.php">Home</a></li>
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
    </br><br>
    <p class="text-danger"><?php echo $error?></p>
    </div>
		<div class="form-group col-md-6">
    <label for="newpass">Nhập mật khẩu mới:</label>
		<input type="password" id="newpass" class="form-control" name="newpass" required>
    </div>
	</form>
  </div>

</body>
</html>
