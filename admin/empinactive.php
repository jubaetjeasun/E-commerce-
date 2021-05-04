<?php
    session_start();
    include 'connection.php';
    $id = $_GET['id']; 

    $result = mysqli_query($conn, "update employee set status=0 where id=$id");
    header("Location: employeelist.php");
?>