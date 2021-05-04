<?php
    session_start();
    include 'admin/connection.php';

    $user = $_SESSION['user'];

    $id = $_GET['id'];
    $quantity = $_GET['quantity'];
    $total = $_GET['total'];

    $result = mysqli_query($conn, "SELECT * FROM product WHERE id=$id");

    while ($res = mysqli_fetch_array($result)) {
        $name  = $res['name'];
        $code  = $res['code'];
        $description  = $res['description'];
        $price  = $res['price'];
        $image  = $res['image'];
        $oriquantity  = $res['quantity'];
    }

    $que2 = "select * from product where available=1 limit 3";


    $_result2 = mysqli_query($conn, $que2);
    $rowcount2 = mysqli_num_rows($_result2);

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
    $orderNo = $name . "" . $ordergen;

    if (isset($_POST['submit-next'])) {

        $address = $_POST['address'];
        $payment = $_POST['payment'];

        $newquantity = $oriquantity - $quantity;

        if($newquantity == 0){
            $result = mysqli_query($conn, "update product set quantity=$newquantity, available=0 where id=$id");
        }
        else{
            $result = mysqli_query($conn, "update product set quantity=$newquantity where id=$id");
        }
       
        $message="$user placed an order. Order no: $orderNo";
        $quenoti = "insert into notification(message,type) values('$message',1)";
        mysqli_query($conn, $quenoti);


        $que = "insert into orderproduct(orderno,customer,address,pname,pid,price,quantity,total,payment) values('$orderNo','$user','$address','$name','$id','$price','$quantity','$total','$payment')";
        mysqli_query($conn, $que);
        
        header("Location: customeracc.php");
        
    }

    
?>


<!DOCTYPE html>
<html dir="ltr" lang="en">

<!-- Mirrored from html.lionode.com/freshfood/product.php by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 18 Dec 2020 18:04:36 GMT -->
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
<body class="product col-2 left-col">
<div class="preloader loader" style="display: block; background:#f2f2f2;"> <img src="image/loader.gif"  alt="#"/></div>
<?php include('includes/header.php')?>
<?php include('includes/menu.php')?> 

<div class="container">
  <ul class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-home"></i></a></li>
    <li><a href="category.php">Vegetables</a></li>
    <li><a href="#"><?php echo $name?></a></li>
  </ul>
  <div class="row">
  <div id="column-left" class="col-sm-3 hidden-xs column-left">
      
      
      
      <h3 class="productblock-title">Specials</h3>
      <div class="row special-grid product-grid">
      <?php
                    for ($i = 1; $i <= $rowcount2; $i++) {

                        $row2 = mysqli_fetch_array($_result2);
                        
        ?>

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 product-grid-item">
          <div class="product-thumb transition">
            <div class="image product-imageblock"> <a href="product.php?id=<?php echo $row2["id"]?>"><img src="admin/assets/upload/<?php echo $row2["image"]?>" class="img-responsive" /></a>
              
            </div>
            <div class="caption product-detail">
              <h4 class="product-name"> <a href="product.php?id=<?php echo $row2["id"]?>" title="women's clothing"><?php echo $row2["name"];?></a> </h4>
              <p class="price product-price"> <span class="price-new">$<?php echo $row2["price"];?></span><span class="price-tax">Ex Tax: $210.00</span> </p>
            </div>
            <div class="button-group">
              
                <a class="addtocart-btn" href="product.php?id=<?php echo $row2["id"]?>" role="button">Buy Now</a>
              
            </div>
          </div>
        </div>
        <?php
          }
        ?>
       
      </div>
    </div>
    <div id="content" class="col-sm-9">
            <form method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Name: </label>
                    <input type="text" name="name" class="form-control" id="" value="<?php echo $name?>" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Code: </label>
                    <input type="text" name="code" class="form-control" id="" value="<?php echo $code?>" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Price: </label>
                    <input type="number" name="price" class="form-control" id="" value="<?php echo $price?>" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Quantity (KG): </label>
                    <input type="number" name="quantity" class="form-control" id="" value="<?php echo $quantity?>" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Total Price: </label>
                    <input type="number" name="total" class="form-control" id="" value="<?php echo $total?>" readonly>
                </div>
                <div class="form-group">
                    <input type="text" name="address" class="form-control" id="" placeholder="Enter Your Address" required>
                </div>
                <div class="form-group">
                    <input type="email" name="payment" class="form-control" id="" placeholder="Paypal Mail" required>
                </div>
                
                <button type="submit" name="submit-next" class="btn btn-primary">Confirm</button>
                
            </form>
      
      
    </div>
  </div>
</div>
 
<?php include('includes/footer.php');?>
</body>


</html>

