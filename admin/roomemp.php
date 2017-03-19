<?php
	include '../sql/sql.php';
    ob_start();
    session_start();
    $error = "";

    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
        header("Location: ../index.php");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      $idp = $_POST['idp'];
      $q1 = pg_query($con,"select \"idP\" from \"phong\" where \"idP\" = '$idp'");
      if(pg_num_rows($q1) == 1){
        $idnv1 = $_POST['idnv1'];
        $idnv2 = $_POST['idnv2'];
        $q2 = pg_query($con,"select \"idNv\" from \"nhanvien\" where \"idNv\" = '$idnv1' ");
        $q3 = pg_query($con,"select \"idNv\" from \"nhanvien\" where \"idNv\" = '$idnv2' ");
        if((pg_num_rows($q2) == 1) && (pg_num_rows($q3) == 1)){
          if($idnv1!=$idnv2){
            pg_query($con,"update \"phong\" set \"idNv\" = '$idnv1'  where \"idP\" = '$idp'");
            pg_query($con,"update \"phong\" set \"idNv2\" = '$idnv2'  where \"idP\" = '$idp'");
          }else{
            $error = '2 nhân viên phải khác nhau!';
          }
        }else{
          $error = 'Không tồn tại nhân viên';
        }
      } else {
        $error = 'Phòng không tồn tại!';
      }
    }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Chỉ định nhân viên</title>
  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/background.css">
</head>
<body>
</html>
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
        <label for="idp">Phòng:</label>
    <input type="text" id="idp" name="idp" class="form-control" required placeholder="Phòng">
    </div>
    <div class="form-group">
        <label for="idnv1">ID1:</label>
    <input type="text" id="idnv1" name="idnv1" class="form-control" required placeholder="Id nhân viên 1">
    </div>
    <div class="form-group">
        <label for="idnv2">ID2:</label>
    <input type="text" id="idnv2" name="idnv2" class="form-control" placeholder="Id nhân viên 2">
    </br>
    <input type="submit" class="btn btn-primary" value="Nhập"></br><br>
    <p class="text-danger"><?php echo $error?></p>
  </form>
</div>
</body>
