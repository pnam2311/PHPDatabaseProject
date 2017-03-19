<?php
  include '../sql/sql.php';
    ob_start();
    session_start();
    $error = "";

    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
        header("Location: ../index.php");
    }

    if (isset($_POST['idbs'])) {
      $idbs = $_POST['idbs'];

      $check = pg_query($con,"select \"idBs\" from \"bacsi\" where \"idBs\" = '$idbs'");
      if (pg_num_rows($check) == 0) $error = 'Không tồn tại bác sĩ này!';
      else{
        $check2 = pg_query($con,"select \"idBs\" from \"benhnhan\" where \"idBs\" = '$idbs'");
        if (pg_num_rows($check2) == 0){
          pg_query($con,"delete from \"bacsi\" where \"idBs\" = '$idbs'");
          pg_query($con,"delete from \"access\" where \"id\" = '$idbs' ");
          $error = 'Đã xóa!';
        } else {
          $error = 'Không thể xóa bác sĩ do bác sĩ vẫn đang được chỉ định';
        }
      }
    }
?>

<html>
<head>
	<title>Xóa bác sĩ</title>
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
      <div class="form-group col-md-6">
      <label for="idbs">ID:</label>
      <input type="text" id="idbs" name="idbs" class="form-control" required placeholder="ID"><br>
      <input type="submit" class="btn btn-danger col-md-2" value="Xóa">
      </br><br>
    <p class="text-danger"><?php echo $error?></p>
      </div><br>
	</form>
      </div>
</div>

</body>
</html>
