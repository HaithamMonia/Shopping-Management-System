<?php 
function pPriceTest($price){
    $product_price_regex = '/^\d+(\.\d+)?$/';
    if(preg_match($product_price_regex,$price))
        return true;
    else 
        return false;
}
?>