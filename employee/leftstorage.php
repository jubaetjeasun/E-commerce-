<?php
    
    include '../admin/connection.php';
    $resultnoti = mysqli_query($conn,"SELECT COUNT(*) FROM storagenoti WHERE status=0");
    
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
                        <a href="indexstorage.php"><i class="menu-icon fa fa-laptop"></i>Dashboard</a>
                    </li>
                    

                    <li class="menu-title">Storage</li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th-large"></i>Storage Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-list-alt"></i><a href="warehousestorage.php">Warehouse</a></li>
                            <li><i class="menu-icon fa fa-list-alt"></i><a href="coldstorage.php">Cold Storage</a></li>
                            <li><i class="menu-icon fa fa-list-alt"></i><a href="normalstorage.php">Normal Storage</a></li>
                        </ul>
                    </li>
                    <li class="menu-title">Notification</li>
                    <li>
                        <a href="storagenoti.php"> <i class="menu-icon fa fa-user"></i>Storage (<?php echo $sizenoti?>)</a>
                    </li>
                    
                    
                    

                    

                    
                    <li class="menu-title">Setting</li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Employee Setting</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-key"></i><a href="resetstorage.php">Reset Password</a></li>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>