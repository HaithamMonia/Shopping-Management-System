<?php
require("../../check_login.php");
$total = 0.0;
$delivery = 0.0;
$totalAmount = 0.0;
$isEmpty = false;

if (isset($_SESSION['mycart']) && !empty($_SESSION['mycart'])) {
    try {
        require("../../connection.php");
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../../reset.css">
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <img src="../../../Design/limebg.jpeg" alt="background">
    <div class="container">
        <div class="header-container">
            <header class="editheader">
                <div class="menu">
                    <div class="spacing2">
                        <a href="../customerMain/customer.php">
                            <div class="mbox"> <i class="fa-solid fa-house" title="Home"></i></div>
                        </a>
                        <a href="../profile/profile.html">
                            <div class="mbox"><i class="fa-solid fa-user" title="View Profile"></i></div>
                        </a>
                        <a href="">
                            <div class="mbox"><b>Logout</b></div>
                        </a>
                    </div>
                </div>
                <div class="title">
                    <h1>Souq<span>BH</span></h1>
                </div>
            </header>
        </div>
        <main>
            <p class="mainp"> Cart</p>
            <div class="cards">
                <div class="leftCard">
                    <div class="itemTitle">
                        <p>Items</p>
                    </div>
                    <div class="itemcontainer">

                        <?php foreach ($_SESSION['mycart'] as $pid => $qty) {
                            try {
                                $stmt = $db->prepare("SELECT pname,price,stock From product Where pid= :productID");
                                $stmt->bindParam(":productID", $pid);
                                $stmt->execute();
                                $numR = $stmt->rowCount();
                                //   echo "CCCCCCCCCCCCCCCCCCOUUUUUNT ".$numR;

                                $productsRows = $stmt->fetch(PDO::FETCH_ASSOC);
                            } catch (PDOException $e) {
                                die("Error: " . $e->getMessage());
                            }
                            $total += ($productsRows['price'] * $qty);

                        ?>

                            <div class="item">
                                <table>
                                    <tr>
                                        <div class="iteminfo">
                                            <td><?php echo $productsRows['pname'] ?> </br> <?php echo $productsRows['price'] ?> BD</td>
                                        </div>
                                        <div class="itemqty">
                                            <td>
                                                <form action="processcart.php" method="POST">
                                                    Qty:
                                                    <input type="hidden" name="pid[]" value="<?php echo $pid;?>">
                                                    <input type="number" name="qty[]" value="<?php echo $qty ?>" min="1" max="<?php echo $productsRows['stock']; ?>" style="width: 35px;"></br></br>
                                                    <div class="trash">
                                                        <a href="../cart/removeitem.php?pid=<?php echo $pid; ?>">
                                                            <i style="color: gray;" class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </div>
                                            </td>
                                        </div>
                                    </tr>
                                </table>
                            </div>
                        <?php  }
                        $totalAmount = $total + $delivery;
                        if (!empty($_SESSION['mycart'])) {
                            $totalAmount = $total + $delivery;
                            $delivery = 0.3;
                        } else {
                            $isEmpty = true;
                        }

                        ?>

                        <?php
                        if ($isEmpty) { ?>
                            <div style = "padding-top:60px; color:red;">
                               The Cart is Empty
                               
                            </div>

                        <?php header("location:../customerMain/customer.php");} ?>


                    </div>

                </div>

                <!-- Displaying -->
                <div class="rightCard">
                    <h3>Payment Details </h3>
                    <p> Cart total: <span style="color:red;"><?php echo $total ?>BD</span></p>
                    <p> Delivery fee:<span style="color:red;"><?php echo $delivery ?>BD</span></p>
                    <p>Total amount:<span style="color:red;"><?php echo $totalAmount ?>BD</span></p>
                    <div class="placeOrder"> <input type="submit" value="Place Order" name="placeOrder"></div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>