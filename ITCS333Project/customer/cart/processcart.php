<?php
session_start();


if (isset($_POST['placeOrder']))  {
  try {
    $usId= $_SESSION['activeUser'];
      require('../../connection.php');
      $db->beginTransaction();
      $sql = "insert into orders values ( null,$usId,'Manama',NOW(),'Ack'
        )";
    
       
      $result = $db->exec($sql);
     
      
      print_r($_SESSION['activeUser']);
      if ($result === 1){

        $orderId = $db->lastInsertId();
        $stmt = $db->prepare("SELECT price FROM product Where pid = :pid");
        $stmt1 = $db->prepare("INSERT INTO orderitem VALUES(null, ?, ?, ?, ?)");

        $stmt2 = $db->prepare("UPDATE product SET qty = qty - ?
              WHERE id = ?");
        $pid=$_POST['pid']; //array
        $qty=$_POST['qty']; //array
        $c=0;
        for($i=0;$i<count($pid);++$i){
          
            $stmt->execute([$pid[$i]]);
            $price = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt1->execute(array($pid[$i], $qty[$i], $price['price']))) {

            ++$c;
            //update the record
            $stmt2->execute(array($qty[$i], $pid[$i]));
          }
        }

        $db->commit();
        unset($_SESSION['mycart']);
        echo "<h3 style='color:green;text-align:center'>Order Placed ($c items)</h3>";
        echo "<h3 style='color:black;text-align:center'><a href='products.php'>View Products</a></h3>";
      }
      
    }
    catch(PDOException $e){
      $db->rollBack();
      die($e->getMessage());
    }
    $db=null;

}
?>
