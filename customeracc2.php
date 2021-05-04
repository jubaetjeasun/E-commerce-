<?php
     session_start();
     include 'admin/connection.php';
     if (!isset($_SESSION['user'])) {
         header('location:login.php');
     }
    $user = $_SESSION['user'];

    $que = "select * from orderproduct where customer='$user' and cart=1 order by date desc";


    $_result = mysqli_query($conn, $que);
    $rowcount = mysqli_num_rows($_result);


    $resultnoti = mysqli_query($conn,"SELECT COUNT(*) FROM customernoti WHERE user='$user' AND status=0");
    $rownoti = mysqli_fetch_assoc($resultnoti);
    $sizenoti = $rownoti['COUNT(*)'];


    $resultuser = mysqli_query($conn, "SELECT * FROM regcustomer WHERE email='$user'");

    while ($res = mysqli_fetch_array($resultuser)) {
        $fname  = $res['fname'];
        $lname  = $res['lname'];
        $phone  = $res['phone'];
        $address  = $res['address'];
        $email  = $res['email'];
        $oripassword  = $res['password'];
    }

    if (isset($_POST['update-form'])) {

        

        $fName2 = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lName2 = mysqli_real_escape_string($conn, $_POST['lastname']);
        $fPhone2 = mysqli_real_escape_string($conn, $_POST['telephone']);
        $fAddress2 = mysqli_real_escape_string($conn, $_POST['address']);

        $password = MD5($_POST['password']);
        $postPhone= ($_POST['telephone']);
        $postname= ($_POST['firstname']);
        $postlastname= ($_POST['lastname']);
        $postaddress= ($_POST['address']);

        

        if($password != $oripassword){
            $passError='Sorry your password was incorrect';
        }
        else{
           
            
            if(strlen($fPhone2) != 10){
                $digitError = "Phone Number must be 10 digit"; 
            }
            else{
                $resultNewQue2 = mysqli_query($conn, "update regcustomer set fname='$fName2',lname='$lName2',phone='$fPhone2',address='$fAddress2' where email='$user'");
                $success="Your information was updated successfully";
                // header("Location: customeracc2.php?messg='Your Information was updated'");
                $resultuser = mysqli_query($conn, "SELECT * FROM regcustomer WHERE email='$user'");

                while ($res = mysqli_fetch_array($resultuser)) {
                    $fname  = $res['fname'];
                    $lname  = $res['lname'];
                    $phone  = $res['phone'];
                    $address  = $res['address'];
                    $email  = $res['email'];
                    $oripassword  = $res['password'];
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
<style>
/* table style */
table { 
            width: 950px; 
            border-collapse: collapse; 
            margin:50px auto;
            margin-bottom:300px; 
            }


        tr:nth-of-type(odd) { 
            background: #eee; 
            }

        th { 
            background: #7DB432; 
            color: white; 
            font-weight: bold; 
            }

        td, th { 
            padding: 10px; 
            border: 1px solid #ccc; 
            text-align: left; 
            font-size: 18px;
            }
        

        @media 
        only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px)  {

            table { 
                width: 100%;
                
            }

            
            table, thead, tbody, th, td, tr { 
                display: block; 
            }
            
            
            thead tr { 
                position: absolute;
                top: -9999px;
                left: -9999px;
            }
            
            tr { border: 1px solid #ccc; }
            
            td { 
                
                border: none;
                border-bottom: 1px solid #eee; 
                position: relative;
                padding-left: 50%;
                font-size:60%; 
            }

            td:before { 
                
                position: absolute;
                
                top: 6px;
                left: 6px;
                width: 45%; 
                padding-right: 10px; 
                white-space: nowrap;
                
                content: attr(data-column);

                color: #000;
                font-weight: bold;
            }
            .action-button{
                font-size:60%;
            }

        }

        .fa-stack[data-count]:after{
            position:absolute;
            right:0%;
            top:1%;
            content: attr(data-count);
            font-size:30%;
            padding:.6em;
            border-radius:999px;
            line-height:.75em;
            color: white;
            background:rgba(255,0,0,.85);
            text-align:center;
            min-width:2em;
            font-weight:bold;
        }

</style>
</head>
<body class="account-register col-2">
<div class="preloader loader" style="display: block; background:#f2f2f2;"> <img src="image/loader.gif"  alt="#"/></div>
<?php include('includes/header.php')?>
<?php include('includes/menu.php')?> 
 
<div class="container">
    <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Account</a></li>
        <li><a href="register.php"><?php echo $user?></a></li>
        <li><input type="button" class="button_active" value="Notification (<?php echo $sizenoti?>)" onclick="location.href='customernoti.php';" /></li>
        
    </ul>
    
    <div class="row">
        <div class="col-sm-3 hidden-xs column-left" id="column-left">
            <div class="column-block">
                <div class="columnblock-title">Account</div>
                <div class="account-block">
                    <div class="list-group">
                        <a class="list-group-item" href="customeracc.php">Order History</a>
                        <a class="list-group-item active" href="customeracc2.php">Personal Details</a>
                        <a class="list-group-item" href="customeracc3.php">Change Password</a>
                        <a class="list-group-item" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9" id="content">
            <h1><?php if (isset($success)): ?>
                <strong class="text-success font-weight-bold"><?php echo $success; ?></strong>
            <?php endif ?></h1>
            <h1><?php if (isset($passError)): ?>
                <strong class="text-danger font-weight-bold"><?php echo $passError; ?></strong>
            <?php endif ?></h1>
            
            <h1><?php if (isset($email_error)): ?>
                <strong class="text-danger font-weight-bold"><?php echo $email_error; ?></strong>
            <?php endif ?> </h1>
            <h1><?php if (isset($digitError)): ?>
                <strong class="text-danger font-weight-bold"><?php echo $digitError; ?></strong>
            <?php endif ?> </h1>
            
            
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
                    <div class="form-group">
                        <label for="input-firstname" class="col-sm-2 control-label">First Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-firstname"  value="<?php if (isset($digitError)): ?><?php echo $postname; ?><?php elseif (isset($passError)): ?><?php echo $postname; ?><?php else: ?><?php echo $fname; ?><?php endif; ?>" name="firstname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-lastname" class="col-sm-2 control-label">Last Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-lastname"  value="<?php if (isset($digitError)): ?><?php echo $postlastname; ?><?php elseif (isset($passError)): ?><?php echo $postlastname; ?><?php else: ?><?php echo $lname; ?><?php endif; ?>" name="lastname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-email" class="col-sm-2 control-label">E-Mail</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="input-email"  value="<?php echo $email?>" name="email" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-telephone" class="col-sm-2 control-label">Telephone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-telephone"  value="<?php if (isset($digitError)): ?><?php echo $postPhone; ?><?php elseif (isset($passError)): ?><?php echo $postPhone; ?><?php else: ?><?php echo $phone; ?><?php endif; ?>" name="telephone" onkeypress="return /[0-9,/]/i.test(event.key)">
                        </div>
                    </div>
                   
                </fieldset>
                <fieldset id="address">
                    <legend>Your Address</legend>
                   
                    <div class="form-group">
                        <label for="input-address-1" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-address-1"  value="<?php if (isset($digitError)): ?><?php echo $postaddress; ?><?php elseif (isset($passError)): ?><?php echo $postaddress; ?><?php else: ?><?php echo $address; ?><?php endif; ?>" name="address">
                        </div>
                    </div>
                    
                   
                </fieldset>
                <fieldset>
                    <legend>Type Your Password to save information</legend>
                    <div class="form-group required">
                        <label for="input-password" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="input-password"  value="" name="password" required>
                        </div>
                    </div>
                </fieldset>
                
                <div class="buttons">
                    <div class="pull-right">
                        
                        <input type="submit" class="btn btn-primary" name="update-form" value="Save Information">
                        
                    </div>
                </div>
            </form>
            
          
        </div>
    </div>
</div>
 
<?php include('includes/footer.php')?>
</body>

 </html>
