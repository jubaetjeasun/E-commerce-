<?php
    session_start();
    include 'admin/connection.php';

    $que = "select * from product where available=1";


    $_result = mysqli_query($conn, $que);
    $rowcount = mysqli_num_rows($_result);

    $que2 = "select * from product where available=1 limit 3";


    $_result2 = mysqli_query($conn, $que2);
    $rowcount2 = mysqli_num_rows($_result2);

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
<body class="category col-2 left-col">
<div class="preloader loader" style="display: block; background:#f2f2f2;"> <img src="image/loader.gif"  alt="#"/></div>
<?php include('includes/header.php')?>
<?php include('includes/menu.php')?> 
<div class="container">
  <ul class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-home"></i></a></li>
    <li><a href="category.php">Vegetables</a></li>
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
    <div id="content" class="col-sm-9">
      <h2 class="category-title">Vegetables</h2>
      
      <div class="category-page-wrapper">
        <div class="col-md-6 list-grid-wrapper">
          <div class="btn-group btn-list-grid">
            <button type="button" id="list-view" class="btn btn-default list" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
            <button type="button" id="grid-view" class="btn btn-default grid" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
          </div>
           </div>
        
       
      </div>
      <br />
      <div class="grid-list-wrapper">




        <!-- Product Adding section -->
        <?php
                    for ($i = 1; $i <= $rowcount; $i++) {

                        $row = mysqli_fetch_array($_result);
                        
        ?>
        <div class="product-layout product-list col-xs-12">
          <div class="product-thumb">
            <div class="image product-imageblock"> <a href="product.php?id=<?php echo $row["id"]?>"> <img src="admin/assets/upload/<?php echo $row["image"]?>" class="img-responsive" /> </a>
              <div class="button-group">
                <a class="addtocart-btn" href="product.php?id=<?php echo $row["id"]?>" role="button">Add to cart</a>
                
              </div>
            </div>
            <div class="caption product-detail">
              <h4 class="product-name"> <a href="product.php?id=<?php echo $row["id"]?>"> <?php echo $row["name"];?> </a> </h4>
              <p class="product-desc"> <?php echo $row["description"];?> </p>
              <p class="price product-price">$<?php echo $row["price"];?> (Per KG)</p>
              
            </div>
            <div class="button-group">
              
              <a class="addtocart-btn" href="product.php?id=<?php echo $row["id"]?>" role="button">Add to cart</a>
              
            </div>
          </div>
        </div>
      <?php
          }
      ?>
      <!-- End Product Adding section -->
       
        
      
    
  

      </div>
      
    </div>
  </div>
</div>
 
<?php include('includes/footer.php')?>
</body>


</html>
