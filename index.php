<?php
	include 'sql/sql.php';
    session_start();

    $error = "";

    if (isset($_POST['user']) && isset($_POST['pass'])) {
        $username = $_POST['user']; 
        $password = $_POST['pass'];

        $query = "select \"id\",\"password\" from \"access\" where \"id\"='$username' and \"password\"='$password'";
        $result = pg_query($con,$query);
        $row = pg_fetch_array($result);

        $count = pg_num_rows($result);
        if($count == 1 && $username == "admin"){
            isset($_SESSION['loggedIn']);
            $_SESSION['loggedIn'] = true;
            $_SESSION['user'] = $username;
            $_SESSION['pass'] = $password;
            header('Location: ./admin/admin.php');
        } elseif($count == 1 && $username != "admin"){
            isset($_SESSION['loggedIn']);
            $_SESSION['loggedIn'] = true;
            $_SESSION['user'] = $username;
            $_SESSION['pass'] = $password;
            header('Location: ./bacsi/index.php');
        }else {   
            $_SESSION['loggedIn'] = false;
            $error = "Sai thông tin đăng nhập!";
        }
    }
?>


<html>
    <head>
        <title>Trang chủ</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="./css/background.css">
	</head>
    
    <body>
    <nav class="navbar navbar-default"> 
         <div class="navbar-header">
         <a class="navbar-brand" href="#">Bệnh viện</a>
        </div>
        <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="http://localhost:8080/test/benhnhan/patient.php">Bệnh nhân</a></li>
    </ul>
    </nav>
    <div class="container">
        <form class="form-horizontal" method="post" action="index.php">
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="user">Tên đăng nhập:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="user" id="user" placeholder="Tên đăng nhập"><br/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pass">Password:</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="pass" id="pass" placeholder="Tên đăng nhập"><br/>
                </div>
            </div>
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-8">
            <input type="submit" class="btn btn-primary" value="Đăng nhập"><br><br>
            <?php echo $error ?>
            </div>
            </div>
            
        </form>
    </div>
    </body>
</html>