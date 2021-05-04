<?php
    session_start();
    include 'connection.php';
    $id = $_GET['id']; 

    $result = mysqli_query($conn, "update regcustomer set activity=1 where id=$id");
    header("Location: regiscustomer.php");
?>