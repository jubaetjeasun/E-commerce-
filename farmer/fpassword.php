<?php
    
    session_start();
    include '../admin/connection.php';
    

    if (isset($_REQUEST["submit-form"])) {

      
        $uname = $_POST['username'];


        $q = "select * from farmer where phone='$uname'";

        $_result = mysqli_query($conn, $q);
        $num = mysqli_num_rows($_result);
        if ($num == 1) {
            function generateRandomString($length = 6) {
                $characters = '012ABC';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }
            $ordergen= generateRandomString();
            $otppass = $ordergen;
    
    
            $result = mysqli_query($conn, "update farmer set password='$otppass' where phone='$uname'");
            header("Location: fpassword2.php?id=$uname");

        }
        else{
            $error="No account exist with this phone";
        }
        

    }

?>






<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Farmer Panel</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <style>

body {
        color: #999;
		background: #f5f5f5;
		font-family: 'Varela Round', sans-serif;
	}
	.form-control {
		box-shadow: none;
		border-color: #ddd;
	}
	.form-control:focus {
		border-color: #4aba70; 
	}
	.login-form {
        width: 350px;
		margin: 0 auto;
		padding: 30px 0;
	}
    .login-form form {
        color: #434343;
		border-radius: 1px;
    	margin-bottom: 15px;
        background: #fff;
		border: 1px solid #f3f3f3;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
	}
	.login-form h4 {
		text-align: center;
		font-size: 22px;
        margin-bottom: 20px;
	}
    .login-form .avatar {
        color: #fff;
		margin: 0 auto 30px;
        text-align: center;
		width: 100px;
		height: 100px;
		border-radius: 50%;
		z-index: 9;
		background: #4aba70;
		padding: 15px;
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
	}
    .login-form .avatar i {
        font-size: 62px;
    }
    .login-form .form-group {
        margin-bottom: 20px;
    }
	.login-form .form-control, .login-form .btn {
		min-height: 40px;
		border-radius: 2px; 
        transition: all 0.5s;
	}
	.login-form .close {
        position: absolute;
		top: 15px;
		right: 15px;
	}
	.login-form .btn {
		background: #4aba70;
		border: none;
		line-height: normal;
	}
	.login-form .btn:hover, .login-form .btn:focus {
		background: #42ae68;
	}
    .login-form .checkbox-inline {
        float: left;
    }
    .login-form input[type="checkbox"] {
        margin-top: 2px;
    }
    .login-form .forgot-link {
        float: right;
    }
    .login-form .small {
        font-size: 13px;
    }
    .login-form a {
        color: #4aba70;
    }

 </style>
<body>
<!--  Request me for a signup form or any type of help  -->
<div class="login-form">    
    <form action="" method="post">
		<div class="avatar"><i class="material-icons">&#xE7FF;</i></div>
    	<h4 class="modal-title">Login to Your Account</h4>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Phone Number" name="username" onkeypress="return /[0-9,/]/i.test(event.key)" required="required">
        </div>
        
        
        <input type="submit" name="submit-form" class="btn btn-primary btn-block btn-lg" value="Forget Password">

        <?php if (isset($login_error)): ?>
      	    <span class="text-danger"><?php echo $login_error; ?></span>
        <?php endif ?> 
        <?php if (isset($statusError)): ?>
      	    <span class="text-danger"><?php echo $statusError; ?></span>
        <?php endif ?>
        <?php if (isset($error)): ?>
      	    <span class="text-danger"><?php echo $error; ?></span>
        <?php endif ?><br>
        <a href="login.php" class="stretched-link">Login</a>	             
    </form>
    
</div>
</body>
</html>       
  
  
  
  
  