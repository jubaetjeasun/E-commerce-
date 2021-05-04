<?php
    
    session_start();
    include 'admin/connection.php';
    

    if (isset($_REQUEST["submit-form"])) {

      
        $uname = $_POST['email'];
        $password = $_POST['password'];

        $q = "select * from regcustomer where email='$uname' && password=MD5('$password')";

        $_result = mysqli_query($conn, $q);
        $num = mysqli_num_rows($_result);

        if ($num == 1) {
           

            $query = "select * from regcustomer where email='$uname' && password=MD5('$password')";
            $result = mysqli_query($conn, $query);
        
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                      $status = $row['activity'];
              }
            }
            if($status==1){
              $_SESSION['user'] = $uname;
              header('location:customeracc.php');
            }
            else{
                $statusError = "Sorry you are an inactive member";
            }
        } else {
            $login_error = "Sorry username/Password do not match";
            
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
<body class="account-login col-2">
<div class="preloader loader" style="display: block; background:#f2f2f2;"> <img src="image/loader.gif"  alt="#"/></div>
<?php include('includes/header.php')?>
<?php include('includes/menu.php')?>
<div class="container">
  <ul class="breadcrumb">
    <li><a href="index.html"><i class="fa fa-home"></i></a></li>
    <li><a href="#">Account</a></li>
    <li><a href="login.html">Login</a></li>
  </ul>
  <div class="row">
    <div class="col-sm-3 hidden-xs column-left" id="column-left">
      <div class="column-block">
        <div class="columnblock-title">Account</div>
        <div class="account-block">
          <div class="list-group"> <a class="list-group-item active" href="login.php">Login</a> <a class="list-group-item" href="register.php">Register</a>   </div>
        </div>
      </div>
    </div>
    <div class="col-sm-9" id="content">
      <div class="row">
        <div class="col-sm-6">
          <div class="well">
            <h2>New Customer</h2>
            <p><strong>Register Account</strong></p>
            <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
            <a class="btn btn-primary" href="register.php">Continue</a></div>
        </div>
        <div class="col-sm-6">
          <div class="well">
            <h2>Returning Customer</h2>
            <p><strong>I am a returning customer</strong></p>
            <?php if (isset($login_error)): ?>
                <strong class="text-danger"><?php echo $login_error; ?></strong>
            <?php endif ?>
            <?php if (isset($statusError)): ?>
                <strong class="text-danger"><?php echo $statusError; ?></strong>
            <?php endif ?>
            <form method="post" action="">
              <div class="form-group">
                <label for="input-email" class="control-label">E-Mail Address</label>
                <input type="email" class="form-control" id="input-email" placeholder="E-Mail Address" value="" name="email">
              </div>
              <div class="form-group">
                <label for="input-password" class="control-label">Password</label>
                <input type="password" class="form-control" id="input-password" placeholder="Password" value="" name="password"><br>
                
              <input type="submit" class="btn btn-primary" value="Login" name="submit-form"><br>
              <a href="fpassword.php">Forgotten Password</a></div>
              
            </form>

           
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('includes/footer.php')?>



 

 </body>
 
 </html>
 