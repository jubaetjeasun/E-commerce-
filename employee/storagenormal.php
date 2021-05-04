<?php
session_start();
include '../admin/connection.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "update farmerreq set storage=2 where id=$id");
header("Location: normalstorage.php");

?>