<?php
    
    session_start();
    include 'admin/connection.php';
    $uname = $_GET['id'];

    $query = "select * from regcustomer where  email='$uname'";
    $result = mysqli_query($conn, $query);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
                $otppass = $row['password'];
        }
    }

    if (isset($_REQUEST["submit-form"])) {

        $otp = $_POST['otp'];
        $newpass = MD5($_POST['npass']);

        $q = "select * from regcustomer where email='$uname' && password='$otp'";

        $_result = mysqli_query($conn, $q);
        $num = mysqli_num_rows($_result);
        if($num==1){
            $result = mysqli_query($conn, "update regcustomer set password='$newpass' where email='$uname'");
            header("Location: login.php");
        }
        else{
            $login_error="Please enter correct OTP";
        }


        
        

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Fresh Food</title><meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="e-commerce site well design with responsive view." />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href='https://fonts.googleapis.com/css?family=Work+Sans:100,300,400,500,700,900' rel='stylesheet' type='text/css'>
<link href="css/stylesheet.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<link href="owl-carousel/owl.carousel.css" type="text/css" rel="stylesheet" media="screen" />
<link href="owl-carousel/owl.transitions.css" type="text/css" rel="stylesheet" media="screen" />
<script src="javascript/jquery-2.1.1.min.js" ></script>
<script src="bootstrap/js/bootstrap.min.js" ></script>
<script src="javascript/jstree.min.js"></script>
<script src="javascript/template.js"></script>
<script src="javascript/common.js" ></script>
<script src="javascript/global.js" ></script>
<script src="owl-carousel/owl.carousel.min.js" ></script>
</head>
<body>
<div class="preloader loader" style="display: block; background:#f2f2f2;"> <img src="image/loader.gif"  alt="#"/></div>
<?php include('includes/header.php')?>
<?php include('includes/menu.php')?> 
<div class="container">
  <ul class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-home"></i></a></li>
    <li><a href="forgetpassword.php">Forgotten Password</a></li>
  </ul>
  <div class="row">
    <div id="column-left" class="col-sm-3 hidden-xs column-left">
      <div class="column-block">
        <div class="columnblock-title">Affiliate</div>
        <div class="affiliate-block">
          <div class="list-group"> <a href="login.php" class="list-group-item">Login</a> <a href="register.php" class="list-group-item">Register</a> <a href="fpassword.php" class="list-group-item">Forgotten Password</a> </div>
        </div>
      </div>
    </div>
    <div id="content" class="col-sm-9">
      <h1>Forgot Your Password?</h1>
      <p>Enter the e-mail address associated with your account. Click submit to have your password e-mailed to you</p>
      <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
          
          <div class="form-group required">
            
          <h3>Please enter this OTP to continue <br><?php echo $otppass?></h3>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-email">OTP</label>
            <div class="col-sm-10">
              <input type="text" name="otp" value="" placeholder="" id="input-email" class="form-control" required/>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-email">New Password</label>
            <div class="col-sm-10">
              <input type="password" name="npass" value="" placeholder="" id="input-email" class="form-control" required/>
            </div>
          </div>
        </fieldset>
        <div class="buttons clearfix">
          <div class="pull-left"><a href="login.php" class="btn btn-default">Back</a></div>
          <div class="pull-right">
            <input type="submit" value="Continue" name="submit-form" class="btn btn-primary" />
          </div>
        </div>
        <?php if (isset($login_error)): ?>
      	    <span><?php echo $login_error; ?></span>
        <?php endif ?> 
      </form>
    </div>
  </div>
</div>
<br><br><br><br><br><br>
 
<?php include('includes/footer.php')?>
</body>

 </html>
