<?php
    include '../sql/sql.php';
    ob_start();
    session_start();
    $error = "";

    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
        header("Location: ../index.php");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $idbn = $_POST['idbn'];
        $tenbn = $_POST['tenbn'];
        $gtbn = $_POST['gtbn'];
        $dcbn = $_POST['dcbn'];
        $sdtbn = $_POST['sdtbn'];
        $bsbn = $_POST['bsbn'];
        $nvbn = $_POST['nvbn'];
        $rvbn = $_POST['rvbn'];
        $kcbn = $_POST['kcbn'];
        $hdbn = $_POST['hdbn'];
        $pbn = $_POST['pbn'];
        $nnbn = $_POST['nnbn'];
        $ttbn = $_POST['ttbn'];
        $ppbn = $_POST['ppbn'];
        $tong = 0;

    
        $checkp = pg_query("select \"idBn\" from \"benhnhan\" where \"idBn\" = '$idbn'");
        if(pg_num_rows($checkp) == 0){  
    
            $checkp2 = pg_query("select \"idBs\" from \"bacsi\" where \"idBs\" = '$bsbn'");
                if(pg_num_rows($checkp2) == 1) {

                    $checkp3 = pg_query("select \"idP\" from \"phong\" where \"idP\" = '$pbn'");
                        if (pg_num_rows($checkp3) == 1) {

                            $checkp4 = pg_query("select \"idHd\" from \"hoadon\" where \"idHd\" = '$hdbn'");
                                if (pg_num_rows($checkp4) == 0){
                                    if(!empty($_POST['bhbn'])) {
                                        $bhbn=$_POST['bhbn'];
                                        
                                        $date1 = date_create($_POST['nvbn']);
                                        $date2 = date_create($_POST['rvbn']);
                                        $diff=date_diff($date1,$date2);
                                            if ((int)$diff->format("%r%a") >= 0) {
                                                if ($bhbn = "TRUE" && $diff->days >= 61) {
                                                $tong = $ttbn - ($tong/$diff->days * 30) + $ppbn;
                                            }else {$tong = $ttbn + $ppbn;};
                                            $bhbn=$_POST['bhbn'];
                                            $q1 = pg_query($con,"insert into \"hoadon\" values ('$hdbn','$diff->days','$ttbn','$ppbn','$tong')");
                                            $bhbn=$_POST['bhbn'];
                                            $q2 = pg_query($con,"insert into \"benhnhan\" values ('$idbn','$tenbn','$gtbn','$dcbn','$sdtbn','$bsbn','$nvbn','$rvbn','$kcbn','$hdbn','$pbn','$nnbn','$bhbn')");
                                           $error = "Thành công!";
                                        }else {
                                            $error = 'Ngày ra viện không được trước ngày nhập viện!';
                                        }
                                    } else {
                                        $error = 'Chưa chọn bảo hiểm!';
                                    }
                                } else {
                                    $error = 'Trùng hóa đơn!';
                                } 
                        } else {
                            $error = 'Không tồn tại phòng này!';
                        }           
                } else {
                    $error = 'Không tồn tại bác sĩ';
                }
        
        } else {
            $error = 'Đã tồn tại mã bệnh nhân này';
        }
    }
 ?>


<html>
<head>
    <title>Nhập bệnh nhân</title>
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
        <label for="idbn">ID:</label>
        <input type="text" id="idbn" name="idbn" class="form-control" required placeholder="ID">
    </div>
	<div class="form-group col-md-6">
        <label for="tenbn">Tên bệnh nhân:</label>
        <input type="text" id="tenbn" name="tenbn" class="form-control" required placeholder="Tên">
    </div>
	<div class="form-group col-md-6">
        <label for="gtbn">Giới tính:</label>
        <input type="text" id="gtbn" name="gtbn" class="form-control" required placeholder="Giới tính">
    </div>
	<div class="form-group col-md-6">
        <label for="dcbn">Địa chỉ:</label>
        <input type="text" id="dcbn" name="dcbn" class="form-control" required placeholder="Địa chỉ">
    </div>
	<div class="form-group col-md-6">
        <label for="sdtbn">Số điện thoại:</label>
        <input type="text" id="sdtbn" name="sdtbn" class="form-control" required placeholder="Số điện thoại">
    </div>
	<div class="form-group col-md-6">
        <label for="bsbn">ID bác sĩ:</label>
        <input type="text" id="bsbn" name="bsbn" class="form-control" required placeholder="ID bác sĩ">
    </div>
	<div class="form-group col-md-6">
        <label for="nvbn">Ngày nhập viện:</label>
        <input type="date" id="nvbn" name="nvbn" class="form-control" required placeholder="">
    </div>
	<div class="form-group col-md-6">
        <label for="rvbn">Ngày ra viện:</label>
        <input type="date" id="rvbn" name="rvbn" class="form-control" required placeholder="">
    </div>
	<div class="form-group col-md-6">
        <label for="kcbn">Nội dung:</label>
        <input type="text" id="kcbn" name="kcbn" class="form-control" required placeholder="Nội dung khám chữa bệnh">
    </div>
	<div class="form-group col-md-6">
        <label for="hdbn">Hóa đơn:</label>
        <input type="text" id="hdbn" name="hdbn" class="form-control" required placeholder="Hóa đơn">
    </div>
	<div class="form-group col-md-6">
        <label for="pbn">Phòng:</label>
        <input type="text" id="pbn" name="pbn" class="form-control" required placeholder="Phòng">
    </div>
	<div class="form-group col-md-6">
        <label for="nnbn">Người nhà:</label>
        <input type="text" id="nnbn" name="nnbn" class="form-control" required placeholder="Người nhà">
    </div>
	<div class="form-group col-md-6">
        <label for="ttbn">Tiền chữa trị:</label>
        <input type="text" id="ttbn" name="ttbn" class="form-control" required placeholder="Tiền chữa trị">
    </div>
	<div class="form-group col-md-6">
        <label for="ppbn">Phụ phí:</label>
        <input type="text" id="ppbn" name="ppbn" class="form-control" required placeholder="Phụ phí">
    </div>
	<div class="col-md-4">
        <label>Bảo hiểm</label><br>
		<input type="radio" name="bhbn" value="TRUE"> Có</br>
		<input type="radio" name="bhbn" value="FALSE"> Không</br></br>
		<input type="submit" class="btn btn-primary" value="Tạo">
        </br><br>
        <p class="text-danger"><?php echo $error?></p>
    </div>
		</form>
 </body>
 </html>