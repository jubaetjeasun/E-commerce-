<?php
    session_start();
    include 'admin/connection.php';

    $que = "select * from product where available=1";


    $_result = mysqli_query($conn, $que);
    $rowcount = mysqli_num_rows($_result);

    $que2 = "select * from product where available=1 limit 3";


    $_result2 = mysqli_query($conn, $que2);
    $rowcount2 = mysqli_num_rows($_result2);
    $queryss = "select * from service";
    $resultkk = mysqli_query($conn, $queryss);

    if ($resultkk->num_rows > 0) {
        while($row = $resultkk->fetch_assoc()) {
                $detailtext = $row['name'];
        }
    }

    if (isset($_REQUEST["submit"])) {
      
      $name = $_POST['name'];
      $email = $_POST['email'];
      $message = $_POST['message'];
  
      $que = "insert into contact(name,email,message) values('$name','$email','$message')";
      mysqli_query($conn, $que);
      header('location:contact.php');
  
      
  
  
  
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
#gmap_canvas img{max-width:none!important;background:none!important}
</style>

</head>
<body class="contact col-2 left-col">
<div class="preloader loader" style="display: block; background:#f2f2f2;"> <img src="image/loader.gif"  alt="#"/></div>
<?php include('includes/header.php')?>
<?php include('includes/menu.php')?> 
<div class="container">
  <ul class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-home"></i></a></li>
    <li><a href="contact.php">Services</a></li>
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
              
                <a class="addtocart-btn" href="product.php?id=<?php echo $row2["id"]?>" role="button">Add to cart</a>
              
            </div>
          </div>
        </div>
        <?php
          }
        ?>
       
      </div>
    </div>
    <div class="col-sm-9" id="content">
        <?php echo $detailtext?>
    </div>
  </div>
</div>
 
<?php include('includes/footer.php')?>
</body>

 </html>
