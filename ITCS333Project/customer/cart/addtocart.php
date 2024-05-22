<?php
session_start();
$pid=$_POST['pid'];
$qty=$_POST['qty'];
$_SESSION['mycart'][$pid]=$qty;
//print_r($_SESSION['mycart']);
// echo $_SESSION['mycart'][$pid];
header('location: ../customerMain/customer.php');
?>
