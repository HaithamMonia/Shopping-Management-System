<?php  
function pnameTest($name){
    $product_name_regex = '/^[A-Za-z][A-Za-z0-9\s\-]{2,49}$/';
    if(preg_match($product_name_regex,$name))
        return true;
    return false;
}
?>