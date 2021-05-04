<?php
    session_start();
    include 'connection.php';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM farmerreq WHERE id=$id");

    while ($res = mysqli_fetch_array($result)) {
        $name  = $res['phone'];
        
    }
    $message="Your product has been picked up successfully. Thanks for being with us";
    $que = "insert into farmernoti(user,message) values('$name','$message')";
    mysqli_query($conn, $que);

    // storage req

    $message2="$name farmer product has been picked up in warehouse successfully";
    $que2 = "insert into storagenoti(message) values('$message2')";
    mysqli_query($conn, $que2);
    
    
    date_default_timezone_set("Asia/Calcutta");   
    $statustime= date('d-m-Y h:i a');
    $result = mysqli_query($conn, "update farmerreq set status=3,dtime='$statustime' where id=$id");
    header("Location: farmerrequest.php");
?>