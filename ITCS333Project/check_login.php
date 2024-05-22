<?php
session_start();
if (!isset($_SESSION['activeUser'])) {
  die ("<h style= 'text-align:center; font-size:2.5rem;'>You need to login first -<a href='../../login/login.php'> Click here to login</a><h1>");
}
//print_r($_SESSION['activeUser']);
?>