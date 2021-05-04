<?php
    session_start();
    include 'admin/connection.php';
    $user = $_SESSION['user'];

    $resultnoti = mysqli_query($conn,"SELECT COUNT(*) FROM orderproduct WHERE customer='$user' AND cart=0");
    $rownoti = mysqli_fetch_assoc($resultnoti);
    $sizecart = $rownoti['COUNT(*)'];

    

    $que2 = "select * from product where available=1 limit 3";
    $_result2 = mysqli_query($conn, $que2);
    $rowcount2 = mysqli_num_rows($_result2);

    

    $que3 = "select * from orderproduct where customer='$user' and cart=0";
    $_result3 = mysqli_query($conn, $que3);
    $rowcount3 = mysqli_num_rows($_result3);

    $queC = "select * from cart where user='$user' and status=0";
    $_resultC = mysqli_query($conn, $queC);
    $rowcountC = mysqli_num_rows($_resultC);

    $resultsum2= mysqli_query($conn,"SELECT SUM(quantity) AS totalsum FROM orderproduct WHERE customer='$user' AND cart=0");
    $rowsum2 = mysqli_fetch_assoc($resultsum2); 
    $sum2 = $rowsum2['totalsum'];

    $quenew = "select * from orderproduct where customer='$user' and cart=0";
    $_resultnew = mysqli_query($conn, $quenew);
    $rowcountnew = mysqli_num_rows($_resultnew);


    $resultsum3= mysqli_query($conn,"SELECT SUM(total) AS totalsum FROM orderproduct WHERE customer='$user' AND cart=0");
    $rowsum3 = mysqli_fetch_assoc($resultsum3); 
    $sum3 = $rowsum3['totalsum'];

    

    
    if (isset($_POST['submit'])) {

        

        $payment = $_POST['payment'];
        $address = $_POST['address'];

        
        

        function generateRandomString($length = 9) {
            $characters = '012ABCPQR';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        $ordergen= generateRandomString();
        $orderNo = $ordergen;

        $result = mysqli_query($conn, "update orderproduct set address='$address',payment='$payment', orderno='$orderNo',cart=1 where customer='$user' and cart=0");
        
        $message="$user placed order. Order no: $orderNo";
        $quenoti = "insert into notification(message,type) values('$message',1)";
        mysqli_query($conn, $quenoti);

        header("Location: customeracc.php"); 
    
    
    }
    if (isset($_POST['quan-update'])) {
      $nid = mysqli_real_escape_string($conn, $_POST['idhide']);
      $newquantity = $_POST['quantity'];

      $punit = mysqli_real_escape_string($conn, $_POST['unitprice1']);
      $ptotal = mysqli_real_escape_string($conn, $_POST['totalprice1']);

      // ---------------------

      $queryCart = "select * from orderproduct where customer='$user' and cart=0 and id=$nid";
      $resultCart = mysqli_query($conn, $queryCart);
        
      
        while($row = $resultCart->fetch_assoc()) {
                $oldquantity = $row['quantity'];
                $proID = $row['pid'];
        }
      
      // $remainquantity = $oldquantity - $newquantity;

      $queryCart2 = "select * from product where id=$proID";
      $resultCart2 = mysqli_query($conn, $queryCart2);
        
      
        while($row = $resultCart2->fetch_assoc()) {
                $oriquantity = $row["quantity"];

        }
        if($newquantity > $oriquantity){
          $quanerror = "Sorry Add to cart can't be more than $oriquantity KG";
      
        }
        else{


        

      if($oldquantity>$newquantity){
        $editquantity = $oldquantity - $newquantity;
        $finalQuantity = $oriquantity + $editquantity;

        
      }
      else{
        $editquantity = $newquantity -$oldquantity;
        $finalQuantity = $oriquantity - $editquantity;

      
      }


      if($finalQuantity == 0){
        $resultQuan1 = mysqli_query($conn, "update product set quantity=$finalQuantity, available=0 where id=$proID");
      }
      else{
        $resultQuan2 = mysqli_query($conn, "update product set quantity=$finalQuantity where id=$proID");
      }


      // ----------------
      $punitnew = $punit * $newquantity;



      $result = mysqli_query($conn, "update orderproduct set quantity=$newquantity,total=$punitnew where customer='$user' and cart=0 and id=$nid");

      
      header("Location: cart.php");
    }


    }


    if (isset($_POST['quan-remove'])) {
      $nid = mysqli_real_escape_string($conn, $_POST['idhide']);
      $pid = mysqli_real_escape_string($conn, $_POST['pidhide']);
      
      $queryCart2 = "select * from orderproduct where customer='$user' and cart=0 and id=$nid";
      $resultCart2 = mysqli_query($conn, $queryCart2);
        
      
        while($row = $resultCart2->fetch_assoc()) {
                $oldquantity = $row['quantity'];
                
        }


      header("Location: cancelcart.php?id=$nid&quan=$oldquantity&pid=$pid");
      
    }

    if (isset($_POST['submit-payment'])) {

        

      $payment = $_POST['payment'];
      $address = $_POST['address'];

      
      

      function generateRandomString($length = 9) {
          $characters = '012ABCPQR';
          $charactersLength = strlen($characters);
          $randomString = '';
          for ($i = 0; $i < $length; $i++) {
              $randomString .= $characters[rand(0, $charactersLength - 1)];
          }
          return $randomString;
      }
      $ordergen= generateRandomString();
      $orderNo = $ordergen;

      $result = mysqli_query($conn, "update orderproduct set address='$address',payment='$payment', orderno='$orderNo',cart=1 where customer='$user' and cart=0");
      
      $message="$user placed order. Order no: $orderNo";
      $quenoti = "insert into notification(message,type) values('$message',1)";
      mysqli_query($conn, $quenoti);

      header("Location: customeracc.php"); 
  
  
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
<body class="cart col-2">
<div class="preloader loader" style="display: block; background:#f2f2f2;"> <img src="image/loader.gif"  alt="#"/></div>
 
<?php include('includes/header.php')?>
<?php include('includes/menu.php')?> 
<div class="container">
  <ul class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-home"></i></a></li>
    <li><a href="cart.php">Shopping Cart</a></li>
  </ul>
  <div class="row">
    <div id="column-left" class="col-sm-3 hidden-xs column-left">
      <div class="column-block">
        
        <h3 class="productblock-title">Bestsellers</h3>
        <div class="row bestseller-grid product-grid">
          
        
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
      </div>
    </div>
    <?php if (isset($quanerror)): ?>
            <strong class="text-danger"><?php echo $quanerror; ?></strong>
          <?php endif ?>
    <?php if ($sizecart ==0) { ?>
                                <h1>Your cart is empty</h1>
                            <?php } ?>
                            <?php if ($sizecart >= 1) { ?>
    <div class="col-sm-9" id="content">
      <h1>Shopping Cart                &nbsp;(<?php echo $sum2?> KG) </h1>
      <?php
                    for ($i = 1; $i <= $rowcountnew; $i++) {

                        $row2 = mysqli_fetch_array($_resultnew);
                        $pname = $row2['pname'];
                        $uprice = $row2['price'];
                        $pquantity = $row2['quantity'];
                        $ptotal = $row2['total'];
                        $image = $row2['photo'];
                        
                        
        ?>
      <form enctype="multipart/form-data" method="post" action="">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <td class="text-center">Image</td>
                <td class="text-left">Product Name</td>
                <td class="text-left">Quantity</td>
                <td class="text-right">Unit Price</td>
                <td class="text-right">Total</td>
              </tr>
            </thead>
           
            <tbody>
              <tr>
                <td class="text-center"><a href="product.php"><img class="img-thumbnail" title="women's clothing" alt="women's clothing" src="admin/assets/upload/<?php echo $image?>"></a></td>
                <td class="text-left"><a href="product.php"><?php echo $pname?></a></td>
                
                <td class="text-left"><div style="max-width: 200px;" class="input-group btn-block">
                    <input type="text" class="form-control quantity" id="input-quantity2" size="2" placeholder="<?php echo $pquantity?>" name="quantity" onkeypress="return /[0-9,/]/i.test(event.key)" onfocus="this.placeholder=''">
                    <input type="text" class="form-control quantity" id="input-quantity2" size="1" value="<?php echo $row2['id'];?>" name="idhide" style="display:none">
                    <input type="text" class="form-control quantity" id="input-quantity2" size="1" value="<?php echo $row2['pid'];?>" name="pidhide" style="display:none">
                    <input type="text" class="form-control quantity" id="input-quantity2" size="1" value="<?php echo $uprice;?>" name="unitprice1" style="display:none">
                    <input type="text" class="form-control quantity" id="input-quantity2" size="1" value="<?php echo $ptotal;?>" name="totalprice1" style="display:none">
                    <span class="input-group-btn">
                    <button class="btn btn-primary" title="" data-toggle="tooltip" name="quan-update" type="submit" data-original-title="Update"><i class="fa fa-refresh"></i></button>
                    <button  class="btn btn-danger" title="" data-toggle="tooltip" name="quan-remove" type="submit" data-original-title="Remove"><i class="fa fa-times-circle"></i></button>
                    </span></div></td>
                <td class="text-right">$<?php echo $uprice?></td>
                <td class="text-right">$<?php echo $ptotal?></td>
              </tr>
            </tbody>
          </table>
        </div>
        
      </form>
      <?php 
          }
      ?>
      
     
      <div id="accordion" class="panel-group">
        
        
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" class="accordion-toggle" href="#collapse-shipping">Estimate Shipping &amp; Payment <i class="fa fa-caret-down"></i></a></h4>
          </div>
          <div class="panel-collapse collapse" id="collapse-shipping">
            <div class="panel-body">
              <p>Enter your destination to get a shipping estimate.</p>
              <form class="form-horizontal" method="post">
                <div class="form-group required">
                  
                
            
                <div class="form-group required">
                  <label for="input-postcode" class="col-sm-2 control-label">Delivery Address</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="input-postcode" placeholder="" value="" name="address" required>
                  </div>
                </div>
                <div class="form-group required">
                  <label for="input-postcode" class="col-sm-2 control-label">Paypal Mail</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="input-postcode" placeholder="" value="" name="payment" required>
                  </div>
                </div>
                
                <input type="submit" class="btn btn-primary" data-loading-text="Loading..." id="button-quote" name="submit-payment" value="Confirm Order">
              </form>
            </div>
          </div>
        </div>
      </div>
      <br>
     
    </div>
    <?php 
    }
    ?>
  </div>
</div>

<?php include('includes/footer.php')?>
</body>
<script>
$("#input-quantity2").on("input", function() {
  if (/^0/.test(this.value)) {
    this.value = this.value.replace(/^0/, "")
  }
})


</script>
</html>
