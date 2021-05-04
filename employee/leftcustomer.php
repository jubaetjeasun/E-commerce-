<?php
    
    include '../admin/connection.php';
    $resultnoti = mysqli_query($conn,"SELECT COUNT(*) FROM notification WHERE type=1 AND status=0");
    
    $rownoti = mysqli_fetch_assoc($resultnoti);
    $sizenoti = $rownoti['COUNT(*)'];


    $resultnoti2 = mysqli_query($conn,"SELECT COUNT(*) FROM notification WHERE type=2 AND status=0");
    
    $rownoti2 = mysqli_fetch_assoc($resultnoti2);
    $sizenoti2 = $rownoti2['COUNT(*)'];
?>


<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="indexcustomer.php"><i class="menu-icon fa fa-laptop"></i>Dashboard</a>
                    </li>
                    

                    

                    <li class="menu-title">Customers Corner</li>
                    <li>
                        <a href="customerorder.php"> <i class="menu-icon fa fa-user"></i>Customers Order</a>
                    </li>

                    <li class="menu-title">Notification</li>
                    <!-- <li>
                        <a href="farmernoti.php"> <i class="menu-icon fa fa-user"></i>Farmer (<?php echo $sizenoti2?>)</a>
                    </li> -->
                    <li>
                        <a href="customernoti.php"> <i class="menu-icon fa fa-user"></i>Customer (<?php echo $sizenoti?>)</a>
                    </li>
                    

                    

                    
                    <li class="menu-title">Setting</li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Employee Setting</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-key"></i><a href="resetcustomer.php">Reset Password</a></li>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>