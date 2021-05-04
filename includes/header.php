<?php
     
     include 'admin/connection.php';
     
     if (isset($_SESSION['user'])) {
      $user = $_SESSION['user'];


      $resultnoti = mysqli_query($conn,"SELECT COUNT(*) FROM orderproduct WHERE customer='$user' AND cart=0");
      $rownoti = mysqli_fetch_assoc($resultnoti);
      $sizecart = $rownoti['COUNT(*)'];

      // $query = "select * from cart where  user='$user' and status=0";
      // $result = mysqli_query($conn, $query);
  
      // if ($result->num_rows > 0) {
      //   while($row = $result->fetch_assoc()) {
      //           $total = $row['total'];

               
      //   }
      // }
      $resultsum= mysqli_query($conn,"SELECT SUM(total) AS totalsum FROM orderproduct WHERE customer='$user' AND cart=0");
      $rowsum = mysqli_fetch_assoc($resultsum); 
      $sum = $rowsum['totalsum'];


     }
    

    

?>

<header>
  <div class="header-top">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="top-left pull-left">
            <div class="language">
              <form action="#" method="post" enctype="multipart/form-data" id="language">
                <div class="btn-group">
                  <button class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-phone" aria-hidden="true"></i> Call Us: 9338688163  </button>
                   
                </div>
              </form>
            </div>
             
          </div>
          <div class="top-right pull-right">
            <div id="top-links" class="nav pull-right">
              <ul class="list-inline">
                <li class="dropdown"><a href="#" title="My Account" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-user"></i><span>My Account</span> <span class="caret"></span></a>
                  <ul class="dropdown-menu dropdown-menu-right">
                   
                    <?php if (isset($_SESSION['user'])) { ?>
                              <li><a href="customeracc.php">My Account</a></li>
                              <li><a href="logout.php">Logout</a></li>
                            <?php } ?>
                            <?php if (!isset($_SESSION['user'])) { ?>
                              <li><a href="register.php">Register</a></li>
                              <li><a href="login.php">Login</a></li>
                            
                            <?php } else { ?>
                                
                                
                    <?php } ?>
                  </ul>
                </li>
                 
              </ul>             
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="header-inner">
      <div class="col-sm-4 col-xs-6 header-left">
        <div class="shipping">
          <div id="logo"> <a href="index.php">Logo</a> </div>
        </div>
      </div>
      <div class="col-sm-4 col-xs-12 header-middle">
        <div class="header-middle-top">
         </div>
      </div>
      <?php if (isset($_SESSION['user'])) {?>
      <div class="col-sm-4 col-xs-12 header-right">
        <div id="cart" class="btn-group btn-block">
          <a class="btn btn-inverse btn-block btn-lg dropdown-toggle cart-dropdown-button" href="cart.php" role="button">
           <span id="cart-total"><span class="cart-title">Shopping Cart</span><br>
          <?php if (isset($_SESSION['user'])) { echo $sizecart; }?> item(s) - $<?php if (isset($_SESSION['user'])) { echo $sum; }?></span>
          </a>
        </div>
      </div>
     <?php }else{ ?>
        <div class="col-sm-4 col-xs-12 header-right">
        <div id="cart" class="btn-group btn-block">
          <a class="btn btn-inverse btn-block btn-lg dropdown-toggle cart-dropdown-button" href="#" role="button">
           <span id="cart-total"><span class="cart-title">Shopping Cart</span><br>
          <?php if (isset($_SESSION['user'])) { echo $sizecart; }?> item(s) - $<?php if (isset($_SESSION['user'])) { echo $sum; }?></span>
          </a>
        </div>
      </div>
      <?php }?>
    </div>
  </div>
</header>