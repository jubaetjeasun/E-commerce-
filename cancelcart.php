<?php
    session_start();
    include 'admin/connection.php';
    $user = $_SESSION['user'];
    $id = $_GET['id'];
    $quantity = $_GET['quan'];
    $pid = $_GET['pid'];

    $query = "select * from product where id=$pid";
    $resultkk = mysqli_query($conn, $query);

    if ($resultkk->num_rows > 0) {
        while($row = $resultkk->fetch_assoc()) {
                $oldquantity = $row['quantity'];
        }
    }

    $newquantity=$oldquantity + $quantity;



    $resultnew = mysqli_query($conn, "update product set quantity='$newquantity' where id=$pid");

    $result = mysqli_query($conn, "delete from orderproduct where customer='$user'and id=$id");
    header("Location: cart.php");


?>