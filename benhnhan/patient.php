<?php
	include '../sql/sql.php';
?>
<html>
<head>
	<title>Thông tin bệnh nhân</title>
	<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/background.css">
</head>
<body>
<nav class="navbar navbar-default navbarfix"> 
         <div class="navbar-header">
         <a class="navbar-brand" href="#">Bệnh viện</a>
        </div>
        <ul class="nav navbar-nav">
        <li><a href="http://localhost:8080/test/index.php">Home</a></li>
        <li class="active"><a href="http://localhost:8080/test/benhnhan/patient.php">Bệnh nhân</a></li>
    </ul>
    </nav>
<div class="container">
<form method="post">
	<div class="form-group">
        <label class="control-label col-sm-2" for="user">Nhập tên:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="patient" name="patient" placeholder="Tên đăng nhập"><br/>
            </div>
        </div>
	 <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
            	<input type="submit" class="btn btn-primary" value="Tìm"><br><br>
            	<a href="../index.php">< Quay lại</a>
            </div>
        </div>
</form>
</div>
 <table class="table table-bordered" style="background-color: #ffffff">
    <thead>
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Giới tính</th>
        <th>Địa chỉ</th>
        <th>Số điện thoại</th>
        <th>ID Bác sĩ</th>
        <th>Ngày nhập viện</th>
        <th>Ngày ra viện</th>
        <th>Khám/chữa</th>
        <th>Hóa đơn</th>
        <th>Phòng</th>
        <th>Tên người nhà</th>
        <th>Bảo hiểm</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if(isset($_POST['patient'])){
    $patient = $_POST['patient'];
    
    $result = pg_query($con,"select * from \"benhnhan\" where \"tenBn\" = '$patient'");
    
        while($row = pg_fetch_array($result)){
            echo '<tr style="background-color: #ffffff">';
            for($i = 0;$i<12;$i++){
                echo '<td>'.$row[$i].'</td> ';
            }
            if ($row[12] == 't') {echo '<td>Có</td>';}else echo '<td>Không</td>';
            echo '</tr>';
        }
}
?>

    </tbody>
</body>
</html>