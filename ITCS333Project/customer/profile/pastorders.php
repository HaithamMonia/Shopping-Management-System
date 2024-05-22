<?php 
if(isset($_GET['cusID'])){
    $cusID = $_GET['cusID'];
    $productID= $orderID="";
    require("../../connection.php");

 
                    try {
                        require ('../../connection.php');
                        $sql = "SELECT oid,uid,status FROM orders WHERE uid=:cusID AND status='Complete'";

                        $stmt = $db->prepare($sql);
                        $stmt->bindParam(":cusID",$cusID);
                        $status= $stmt->execute();
                        //Oders table
                        $orderRows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        //orderItem table
                    

                          


                       
                    }catch(PDOException $e){
                        die("Error: ".$e->getMessage());
                    }
                 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Past Orders</title>
    <link rel="stylesheet" href="../../reset.css">
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <?php if(!$status||$stmt->rowCount()<=0){?>
        <div class="pastordermain">
            <div class="cardspacing">
                <div class="card">
                <h3 style = 'color:red; text-align: center; font-weight: 900;'>There are No Past Orders</h3>
                </div>
                <?php  }else{
                     $stmt2= $db->prepare("SELECT oid,pid,qty,price FROM orderitem WHERE oid= :orderID");
                    
                     $stmt3= $db->prepare("SELECT pid,pname FROM product WHERE pid= :productID");
                    echo  $stmt->rowCount();
                    foreach($orderRows as $order){
                        $stmt2->bindParam(':orderID',$order['oid']);
                        $stmt2->execute();
                        $orderedItem = $stmt2->fetch(PDO::FETCH_ASSOC);
                        $stmt3->bindParam(':productID',$orderedItem['pid']);
                       
                        $stmt3->execute();
                        $productOrdered = $stmt3->fetch(PDO::FETCH_ASSOC);
                       
                    
                    if($order['uid']==$cusID&&$order['oid']==$orderedItem['oid']){
                        $qty = $orderedItem['qty'];
                        $price = $orderedItem['price'];
                        $total = $qty*$price;
                    ?>
                
                <div class="pastordermain">
            <div class="cardspacing">
                <div class="card">
                    <form action="" method="POST">
                        <div class="orderid"><p>Order ID: <?php echo "<span class= 'detailsSpan'>$order[oid]</span>"; ?></p></div>
                        <div class="item">
                            <p>Item: <?php echo "<span class= 'detailsSpan'> $productOrdered[pname]</span>"; ?></p>
                            <p>Quantity: <?php echo "<span class= 'detailsSpan'> $orderedItem[qty]</span>"; ?></p>
                            <p>Price: <?php echo "<span class= 'detailsSpan'> $orderedItem[price]</span>"; ?></p>
                        </div>
                        <div class="total"><p>Total Amount: <?php echo "<span class= 'detailsSpan'> $total</span>"; ?> </p></div>
                    </form>
                </div>
              <?php }}}?>
                

        </div>

        
</body>
</html>