<?php 
 function test_input($data){
    $data = trim($data); 
    $data = stripslashes($data); // because it is used for special characters
    $data = htmlspecialchars($data);
    return $data;
 }
?>