<?php
    session_start();
    include 'connection.php';
    $id = $_GET['id'];
    date_default_timezone_set("Asia/Calcutta");   
    $statustime= date('d-m-Y h:i a');
    
    $result = mysqli_query($conn, "SELECT * FROM orderproduct WHERE id=$id");

    while ($res = mysqli_fetch_array($result)) {
        $name  = $res['customer'];
        $orderno  = $res['orderno'];
        $pname  = $res['pname'];
        $quantity  = $res['quantity'];
        
    }
    $message="Your Order no: $orderno [$quantity KG $pname] has been cancelled due to due to unavoidable circumstances.";
    $que = "insert into customernoti(user,message) values('$name','$message')";
    mysqli_query($conn, $que);

    $resultqq = mysqli_query($conn, "update orderproduct set status=2,ctime='$statustime' where id=$id");
    header("Location: customerorder.php");
?>