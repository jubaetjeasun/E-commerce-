<?php
    session_start();
    include 'admin/connection.php';




if (isset($_REQUEST["submit-form"])) {
    
    
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['telephone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $conpass = $_POST['confirm'];

    if($conpass != $password){
        $pass_error = "Sorry Password & Confirm Password do not match";
    }
    else{
        $Enpassword = MD5($password);
        $q = "select * from regcustomer where email='$email'";
        $_result = mysqli_query($conn, $q);
        $num = mysqli_num_rows($_result);

        if ($num == 1) {
            
            $email_error = "Sorry Email already in used";
        } else {
            $phonecount = strlen($phone);

            if($phonecount !=10){
                $digitError = "Phone Number must be 10 digit"; 
            }
            else{
            $que = "insert into regcustomer(fname,lname,email,phone,address,password,status) values('$fname','$lname','$email','$phone','$address','$Enpassword',1)";
            mysqli_query($conn, $que);
            $success ="Thank you for registering. Please login to continue.";

            }
            
        }


        
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
<body class="account-register col-2">
<div class="preloader loader" style="display: block; background:#f2f2f2;"> <img src="image/loader.gif"  alt="#"/></div>
<?php include('includes/header.php')?>
<?php include('includes/menu.php')?> 
 
<div class="container">
    <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Account</a></li>
        <li><a href="register.php">Register</a></li>
    </ul>
    <div class="row">
        <div class="col-sm-3 hidden-xs column-left" id="column-left">
            <div class="column-block">
                <div class="columnblock-title">Account</div>
                <div class="account-block">
                    <div class="list-group"> 
                        <a class="list-group-item" href="login.php">Login</a> 
                        <a class="list-group-item active" href="register.php">Register</a> 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9" id="content">
            <h1><?php if (isset($success)): ?>
                <strong class="text-success font-weight-bold"><?php echo $success; ?></strong>
            <?php endif ?></h1>
            <h1><?php if (isset($pass_error)): ?>
      	    <strong class="text-danger font-weight-bold"><?php echo $pass_error; ?></strong>
            <?php endif ?> </h1>
            <h1><?php if (isset($email_error)): ?>
                <strong class="text-danger font-weight-bold"><?php echo $email_error; ?></strong>
            <?php endif ?> </h1>
            <h1><?php if (isset($digitError)): ?>
                <strong class="text-danger font-weight-bold"><?php echo $digitError; ?></strong>
            <?php endif ?> </h1>
            <h1>Register Account</h1>
            <p>If you already have an account with us, please login at the <a href="login.php">login page</a>.</p>
            
            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="">
                <fieldset id="account">
                    <legend>Your Personal Details</legend>
                    <div style="display: none;" class="form-group required">
                        <label class="col-sm-2 control-label">Customer Group</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label>
                                    <input type="radio" checked="checked" value="1" name="customer_group_id">
                                    Default</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="input-firstname" class="col-sm-2 control-label">First Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-firstname"  value="<?php if (isset($pass_error)): ?><?php echo $fname; ?> <?php endif ?><?php if (isset($email_error)): ?><?php echo $fname; ?><?php endif ?><?php if (isset($digitError)): ?><?php echo $fname; ?> <?php endif ?>" name="firstname" required>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="input-lastname" class="col-sm-2 control-label">Last Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-lastname"  value="<?php if (isset($pass_error)): ?><?php echo $lname; ?> <?php endif ?><?php if (isset($email_error)): ?><?php echo $lname; ?> <?php endif ?><?php if (isset($digitError)): ?><?php echo $lname; ?> <?php endif ?>" name="lastname" required>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="input-email" class="col-sm-2 control-label">E-Mail</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="input-email"  value="<?php if (isset($pass_error)): ?><?php echo $email; ?><?php endif ?><?php if (isset($digitError)): ?><?php echo $email; ?> <?php endif ?>" name="email" required>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="input-telephone" class="col-sm-2 control-label">Telephone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-telephone"  value="<?php if (isset($pass_error)): ?><?php echo $phone; ?> <?php endif ?><?php if (isset($email_error)): ?><?php echo $phone; ?> <?php endif ?>" name="telephone" onkeypress="return /[0-9,/]/i.test(event.key)" required>
                        </div>
                    </div>
                   
                </fieldset>
                <fieldset id="address">
                    <legend>Your Address</legend>
                   
                    <div class="form-group required">
                        <label for="input-address-1" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-address-1"  value="<?php if (isset($pass_error)): ?><?php echo $address; ?> <?php endif ?><?php if (isset($email_error)): ?><?php echo $address; ?> <?php endif ?><?php if (isset($digitError)): ?><?php echo $address; ?> <?php endif ?>" name="address" required>
                        </div>
                    </div>
                    
                   
                </fieldset>
                <fieldset>
                    <legend>Your Password</legend>
                    <div class="form-group required">
                        <label for="input-password" class="col-sm-2 control-label">Password</label required>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="input-password"  value="" name="password">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="input-confirm" class="col-sm-2 control-label">Password Confirm</label required>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="input-confirm"  value="" name="confirm">
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Newsletter</legend>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Subscribe</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" value="1" name="newsletter">
                                Yes</label>
                            <label class="radio-inline">
                                <input type="radio" checked="checked" value="0" name="newsletter">
                                No</label>
                        </div>
                    </div>
                </fieldset>
                <div class="buttons">
                    <div class="pull-right">I have read and agree to the <a class="agree" href="#"><b>Privacy Policy</b></a>
                        <input type="checkbox" value="1" name="agree" required>
                        &nbsp;
                        <input type="submit" class="btn btn-primary" name="submit-form" value="Register">
                    </div>
                </div>
            </form>
          
        </div>
    </div>
</div>
 
<?php include('includes/footer.php')?>
</body>

 </html>
