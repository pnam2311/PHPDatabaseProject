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
	<title>Danh sách bệnh nhân</title>
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
        <li class="active"><a href="patientlist.php">Danh sách bệnh nhân</a></li>
        <li><a href="changepass.php">Đổi mật khẩu</a></li>
    </ul>
     <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</a></li>
    </ul>
    </div>
    </nav>
<div class="container">
 <table class="table table-bordered ">
 	<thead>
    <tr class="active">
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
	</tr>
	</thead>
	<tbody>
		<?php
		$idbs = $_SESSION['user'];
   		$q1 = pg_query($con,"select * from \"benhnhan\" where \"idBs\" = '$idbs'");
   		
   		while($row = pg_fetch_array($q1)){
			echo '<tr class="active">';
   			for($i = 0;$i<12;$i++){
		    	echo '<td>'.$row[$i].'</td> ';
   			}
   			echo '</tr>';
   		}
		?>
	</tbody>
	</table>
<a href="index.php"><button class="btn btn-primary" >< Quay lại</button></a>
</body>
</html>