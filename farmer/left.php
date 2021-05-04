<?php
     
     include '../admin/connection.php';
     
     $user = $_SESSION['farmer'];


    $resultnoti = mysqli_query($conn,"SELECT COUNT(*) FROM farmernoti WHERE user='$user' AND status=0");
    $rownoti = mysqli_fetch_assoc($resultnoti);
    $sizenoti = $rownoti['COUNT(*)'];

    

?>


<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php"><i class="menu-icon fa fa-laptop"></i>Dashboard</a>
                    </li>
                    

                    <li class="menu-title">Product</li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th-large"></i>Product Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-list-alt"></i><a href="productlist.php">Product History</a></li>
                            <li><i class="menu-icon fa fa-plus-square"></i><a href="requestproduct.php">Request Pickup</a></li>
                        </ul>
                    </li>

                    <li class="menu-title">Notification</li>
                    <li>
                        <a href="notification.php"> <i class="menu-icon fa fa-user"></i>Notification (<?php echo $sizenoti?>)</a>
                    </li>

                    
                    <li class="menu-title">Setting</li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Farmer Setting</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-key"></i><a href="reset.php">Reset Password</a></li>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>