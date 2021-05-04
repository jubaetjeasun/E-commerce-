<?php
    session_start();
    include 'connection.php';
    $id = $_GET['id'];
    
    $result = mysqli_query($conn, "SELECT * FROM farmerreq WHERE id=$id");

    while ($res = mysqli_fetch_array($result)) {
        $name  = $res['phone'];
        
    }
    $message="Your pick up request has been cancelled due to unavoidable circumstances.";
    $que = "insert into farmernoti(user,message) values('$name','$message')";
    mysqli_query($conn, $que);

    date_default_timezone_set("Asia/Calcutta");   
    $statustime= date('d-m-Y h:i a');
    $result = mysqli_query($conn, "update farmerreq set status=2,ctime='$statustime' where id=$id");
    header("Location: farmerrequest.php");
?>