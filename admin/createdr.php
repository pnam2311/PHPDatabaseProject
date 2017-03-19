<?php
	include '../sql/sql.php';
    ob_start();
    session_start();
    $error ="";

    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
        header("Location: ../index.php");
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    	$idbs = $_POST['idbs'];
    	$check = pg_query($con,"select \"idBs\" from \"bacsi\" where \"idBs\" = '$idbs'");
    	if(pg_num_rows($check) == 1){
    		$error = 'id đã tồn tại';
    	}else{
    	$tenbs = $_POST['tenbs'];
    	$gtbs = $_POST['gtbs'];
    	$dcbs = $_POST['dcbs'];
    	$sdtbs = $_POST['sdtbs'];
    	$ctbs = $_POST['ctbs'];
    	$lcbs = $_POST['lcbs'];
    	$tbs = 0;
    	$tong = $ctbs * $lcbs;
    	if ($ctbs > 25)
    	{
    		$tbs = ($ctbs - 25)*$lcbs*1.05;
    		$tong = $tong+$tbs;
    	}
    	$result = pg_query($con,"insert into \"bacsi\" values ('$idbs','$tenbs','$gtbs','$dcbs','$sdtbs','$ctbs','$lcbs','$tong','$tbs')");
    	if ($result){
    		$error = 'Thành công!';
    	}
    	pg_query($con,"insert into \"access\" values ('$idbs',1)");
    }
}

?>

<html>
<head>
	<title>Nhập bác sĩ</title>
          

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
      <li class=""><a href="changepass.php">Đổi mật khẩu</a></li>
    </ul>
     <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</a></li>
    </ul>
  </div>
</nav>

<div class="container">
	<form method="post">
		<div class="form-group">
        <label for="idbs">ID:</label>
		<input type="text" id="idbs" name="idbs" class="form-control" required placeholder="ID">
        </div>
		<div class="form-group">
        <label for="tenbs">Tên:</label>
		<input type="text" id="tenbs" name="tenbs" class="form-control" required placeholder="Tên">
        </div>
		<div class="form-group">
        <label for="gtbs">Giới tính:</label>
		<input type="text" id="gtbs" name="gtbs" class="form-control" required placeholder="Giới tính">
        </div>
		<div class="form-group">
        <label for="dcbs">Địa chỉ:</label>
		<input type="text" id="dcbs" name="dcbs" class="form-control" required placeholder="Địa chỉ">
        </div>
		<div class="form-group">
        <label for="sdtbs">Số điện thoại:</label>
		<input type="text" id="sdtbs" name="sdtbs" class="form-control" required placeholder="Số điện thoại">
        </div>
		<div class="form-group">
        <label for="ctbs">Số ca trực:</label>
		<input type="number" id="ctbs" name="ctbs" class="form-control" required placeholder="Số ca trực">
        </div>
		<div class="form-group">
        <label for="lcbs">Lương ca:</label>
		<input type="number" id="lcbs" name="lcbs" class="form-control" required placeholder="Lương ca">
        </div>
		<input type="submit" class="btn btn-primary" value="Nhập"></br><br>
    <p class="text-danger"><?php echo $error?></p>
	</form>
</body>
</html>