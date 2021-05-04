<?php
    session_start();
    include 'admin/connection.php';
    
    $id = $_GET['id'];
    if (isset($_SESSION['user'])) {
      $user = $_SESSION['user'];

    
    }

    $result = mysqli_query($conn, "SELECT * FROM product WHERE id=$id");

    while ($res = mysqli_fetch_array($result)) {
        $name  = $res['name'];
        $code  = $res['code'];
        $description  = $res['description'];
        $price  = $res['price'];
        $image  = $res['image'];
        $quantity  = $res['quantity'];
        $image  = $res['image'];
    }

    $que2 = "select * from product where available=1 limit 3";


    $_result2 = mysqli_query($conn, $que2);
    $rowcount2 = mysqli_num_rows($_result2);

    function generateRandomString($length = 8) {
      $characters = '987KLMNQ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }
    $ordergen= generateRandomString();
    $orderNo = $ordergen;

    
    if (isset($_REQUEST["submit-cart"])) {
        $pquantity = $_POST['quantity'];
        $total = $pquantity * $price;
        

        if($pquantity > $quantity){
            $quanerror = "Sorry Add to cart can't be more than $quantity KG";
        
        }
        else{
          $query = "select * from orderproduct where  customer='$user' && cart=0";
          $result = mysqli_query($conn, $query);
          
         
          

          $que = "insert into orderproduct(orderno,customer,address,pname,pid,price,quantity,total,payment,photo) values('$orderNo','$user','nill','$name','$id','$price','$pquantity','$total','nill','$image')";
          mysqli_query($conn, $que);

          $newquantity = $quantity - $pquantity;

          if($newquantity == 0){
              $resultQuan1 = mysqli_query($conn, "update product set quantity=$newquantity, available=0 where id=$id");
          }
          else{
            $resultQuan2 = mysqli_query($conn, "update product set quantity=$newquantity where id=$id");
          }

          $cartSuccess="$pquantity KG $name added to your cart";
  
  
          

        
        
        
        }
    
        


        

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
      <div class="row">
        <div class="col-sm-6">
          <div class="thumbnails">
            <div><img src="admin/assets/upload/<?php echo $image?>" title="" alt=""/></div>
           
          </div>
        </div>
        <div class="col-sm-6">
          <h1 class="productpage-title"><?php echo $name?></h1>
          
          <ul class="list-unstyled productinfo-details-top">
            <li>
              <h2 class="productpage-price">$<?php echo $price?> (Per KG)</h2>
            </li>
            
          </ul>
          <hr>
          <ul class="list-unstyled product_info">
            
              <label>Product Code:</label>
              <span><?php echo $code?></span></li>
            <li>
              <label>Availability:</label>
              <span> In Stock</span></li>
          </ul>
          <hr>
          <?php if (isset($quanerror)): ?>
            <strong class="text-danger"><?php echo $quanerror; ?></strong>
          <?php endif ?>
          <?php if (isset($cartSuccess)): ?>
            <strong class="text-success"><?php echo $cartSuccess; ?></strong>
          <?php endif ?>
          <div id="product">
            <div class="form-group">
              <form method="post">
                  <label class="control-label qty-label" for="input-quantity">Qty</label>
                  <input type="text" name="quantity" size="2" id="input-quantity" class="form-control productpage-qty" onkeypress="return /[0-9,/]/i.test(event.key)" required/>
                  <?php if (isset($_SESSION['user'])) { ?>
                            <input type="submit"  class="btn btn-primary btn-lg btn-block addtocart" name="submit-cart" value="Add to cart">
                            <?php } ?>
                            <?php if (!isset($_SESSION['user'])) { ?>
                              <a class="btn btn-primary btn-lg btn-block addtocart" href="login.php" role="button">Add to cart</a>
                            
                            <?php } else { ?>
                                
                                
                <?php } ?>
              </form>
              
              
            </div>
          </div>
        </div>
      </div>
      <div class="productinfo-tab">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>
          
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab-description">
            <div class="cpt_product_description ">
              <div>
                <p> <strong><?php echo $description?></strong></p>
               
              </div>
            </div>
            <!-- cpt_container_end --></div>
          
        </div>
      </div>
      
      
    </div>
  </div>
</div>
 
<?php include('includes/footer.php');?>
<script>
$("#input-quantity").on("input", function() {
  if (/^0/.test(this.value)) {
    this.value = this.value.replace(/^0/, "")
  }
})
</script>
</body>


</html>

