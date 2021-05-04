<?php
    session_start();
    include 'connection.php';
    $id = $_GET['id']; 

    $result = mysqli_query($conn, "update farmer set status=1 where id=$id");
    header("Location: farmerlist.php");
?>