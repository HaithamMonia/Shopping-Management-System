<?php
session_start();

$productName = "";
$productType = "";
$ErrMessage = "";
$productPrice = "";
$productDescription = "";  // Corrected variable name
$productQty = "";  // Corrected variable name
$isValid = true;
$formSubmitted = false;
require ('../cleanInput.php');

$insertSuccess = false;  // Flag to check if insert was successful

if (isset($_POST['add'])) {
    $formSubmitted = true;
    $productName = test_input($_POST['pname']);
    $productType = test_input($_POST['ptype']);
    $productPrice = test_input($_POST['pprice']);
    $productDescription = test_input($_POST['pdes']);  // Corrected variable name
    $productQty = test_input($_POST['pqty']);  // Corrected variable name
    $file_name = $_FILES['image']['name']; // Get the file name
    $tempname = $_FILES['image']['tmp_name']; // Get the temporary file name
    $folder = '../images/' . $file_name;

    // Get the file extension
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Array of allowed image extensions
    $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');

    // Check if the uploaded file has a valid image extension
    if (empty($productName)) {
        $ErrMessage = "Name cannot be empty";
        $isValid = false;
    } else if (empty($productType)) {
        $ErrMessage = "Type cannot be empty";
        $isValid = false;
    } else if (empty($productPrice) || $productPrice <= 0) {
        $ErrMessage = "Price cannot be zero or negative!";
        $isValid = false;
    } else if (empty($productQty) || $productQty <= 0) {
        echo $productQty;
        $ErrMessage = "The quantity to be added must be greater or equal to 1";
        $isValid = false;
    } else if (!in_array($file_extension, $allowed_extensions)) {
        $ErrMessage = "Error in uploading the file: the file is not an image or the uploaded type is not accepted";
        $isValid = false;
    } else {
        // Move the uploaded file to the destination folder
        if ($isValid) {
            if (!move_uploaded_file($tempname, $folder)) {
                $ErrMessage = "Failed to upload image";
                $isValid = false;
            }
        }
    }

    if ($isValid) {
        try {
            require ('../connection.php');
            $sql = "INSERT INTO product (pid, pname, type, price, description, stock, picture) VALUES (NULL, ?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($sql);

            // Bind the variables to the statement in order
            $stmt->bindParam(1, $productName);
            $stmt->bindParam(2, $productType);
            $stmt->bindParam(3, $productPrice);
            $stmt->bindParam(4, $productDescription);
            $stmt->bindParam(5, $productQty);
            $stmt->bindParam(6, $file_name);

            if ($stmt->execute()) {
                $insertSuccess = true;

                // Reset form fields
                $productName = "";
                $productType = "";
                $productPrice = "";
                $productDescription = "";
                $productQty = "";
            } else {
                // Fetch error information
                $insertSuccess = false;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Main</title>
    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="staff.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="img"></div>
        <div class="header-container">

            <header>
                <div class="menuMain">
                    <div class="spacing1">
                        <div class="status"><b>Welcome&nbspStaffName!</b></div>
                    </div>
                    <div class="spacing2">
                        <a href="staffviewItems.html">
                            <div class="mbox"><i class="fa-solid fa-grip" title="View Items"></i></div>
                        </a>
                        <a href="">
                            <div class="mbox"><i class="fa-solid fa-user" title="View Profile"></i></div>
                        </a>
                        <a href="../login/login.php?logout=1">
                            <div class="mbox"><b>Logout</b></div>
                        </a>
                    </div>
                </div>
                <div class="title">
                    <h1>Souq<span>BH</span></h1>
                </div>
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="search" placeholder="Search for active order">
                </div>
            </header>
        </div>
        <div class="main2">
            <div class="mainbox box1">
                <div class="box1Title">
                    <p>Add Items</p>
                </div>
                <div class="box1Input">
                    <form id="productForm" method="POST" enctype="multipart/form-data">
                        <table class="box1table">
                            <tr class="tr2" style="font-weight: bold;">
                                <div class="info box1name">
                                    <td>Name:</td>
                                    <td><input type="text" name="pname" value="<?php echo $productName; ?>"></br></br>
                                    </td>
                                </div>
                                <div class="info box1name">
                                    <td>Type:</td>
                                    <td><input type="text" name="ptype" value="<?php echo $productType; ?>"></br></br>
                                    </td>
                                </div>
                                <div class="info box1price">
                                    <td>Price:</td>
                                    <td><input type="text" name="pprice" value="<?php echo $productPrice; ?>"></br></br>
                                    </td>
                                </div>
                                <div class="info box1description">
                                    <td>Description:</td>
                                    <td><input type="text" name="pdes"
                                            value="<?php echo $productDescription ?>"></br></br></td>
                                </div>
                                <td>Qty:<span class="space"></span>Image:</td>
                                <td>
                                    <div class="box1qty" style="display: flex; align-items: center;">
                                        <input type="number" name="pqty" min="0"
                                            style="width: 45px; margin-right: 43px; margin-top: 2px;">
                                        <input type="file" name="image">
                                    </div>
                                </td>
                                <ul type="square" style="text-align: left;">
                            </tr>
                            <?php
                            if (!$isValid) {
                                echo "<tr style='width: 70%' > <td style = 'color: red; text-align:left;word-wrap: break-word;'>$ErrMessage</td></tr>";
                            }
                            ?>

                            <td>
                                <div class="addbutton"><input type="submit" value="Add" name="add"></div>
                            </td>
                            </tr>
                        </table>

                    </form>
                </div>
                <!-- HEEEEEERRRRRRREEEEEEERREREHHVEAIVAEIVHAEVHOIAEVAEVAHNVAEOVOAEVOEVNENBVOVAESBNENBAEANOIBEAVOIAENAEJNVAEJNBAANVEANBPNED -->
            </div>
            <div class="mainbox box2">
                <div class="box2Title">
                    <p>Active Orders</p>
                </div>
                <div class="infobox2">


                    <?php
                    try {
                        require ('../connection.php');
                        $sql = "SELECT * FROM orders";
                        $stmt = $db->prepare($sql);
                        $status = $stmt->execute();


                        $numResponses = $stmt->rowCount();
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);




                        if ($status && $stmt->rowCount() == 0) {
                            echo "<h3 style = 'color:red; text-align: center; font-weight: 900;'>There are No Active Orders</h3>";
                        } else {
                            $stmt2 = $db->prepare("SELECT pname,price,stock FROM product WHERE pid=:id");
                            $stmt2->bindParam(':id', $productID);
                            $stmt3 = $db->prepare("SELECT pid,qty,price From orderitem WHERE oid=:orderID");
                            $stmt3->bindParam(':orderID', $ordID);

                            $counter =0;
                            foreach ($rows as $r) {
                                if ($r['status'] != 'Complete') {
                                    $counter++;
                                    $ordID = $r['oid'];
                                    $stmt3->execute();
                                    $ordItem = $stmt3->fetch(PDO::FETCH_ASSOC);


                                    $productID = $ordItem['pid'];
                                    $stmt2->execute();
                                    $prow = $stmt2->Fetch(PDO::FETCH_ASSOC);
                                    ?>

                                    <div class="subbox2">
                                        <div class="boxheader">
                                            <p>Order ID: <span class="detailsSpan"><?php echo $r['oid']; ?></span></p>
                                        </div>
                                        <div class="boxinfo">
                                            <p>Name: <span class="detailsSpan"><?php echo $prow['pname']; ?></span>
                                                <br>price: <span class="detailsSpan"><?php echo $ordItem['price']; ?></span>
                                                <br>Quantitiy: <span class="detailsSpan"><?php echo $ordItem['qty']; ?></span>
                                            </p>
                                        </div>
                                        <div class="boxfooter">
                                            <p>Status: <span class="detailsSpan"><?php echo $r['status']; ?></span></p>
                                            <form method="post">

                                                <input type="submit" name='sb' value="Ack">
                                                <input type="submit" name='sb' value="Process">
                                                <input type="submit" name='sb' value="Transit">
                                                <input type="submit" name='sb' value="Complete">
                                                <input type="hidden" name="order" value="<?php echo $r['oid']; ?>">
                                            </form>
                                        </div>
                                    </div>
                                    <?php


                                }
                           

                            }  
                            if($counter !=0) {
                             if (isset($_POST['sb']) && isset($_POST['order'])) {
                                    $state = $_POST['sb'];
                                    $ordID = $_POST['order'];
                                    $stmt4 = $db->prepare("UPDATE orders SET status=? WHERE oid=?");
                                    $stmt4->bindParam(1, $state);
                                    $stmt4->bindParam(2, $ordID);
                                    $stmt4->execute();
                                    unset($state);
                                    unset($_POST['sb']);
                                   

                                }
                            }else{
                                unset($_POST['sb']);
                                echo "<h3 style = 'color:red; text-align: center; font-weight: 900;'>There are No Active Orders</h3>";
                            }
                            $db = null;
                        }
                    } catch (PDOException $e) {
                        die("ERROR: " . $e->getMessage());
                    } ?>

                </div>
            </div>
        </div>


    </div>
    <script>
             document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const success = urlParams.get('success');
            if (success === '1') {
                alert('Item has been Add Successfully!');
                document.getElementById('productForm').reset();
            }else{
                alert('Item has NOT been Add successfully!');
                document.getElementById('productForm').reset();
            }
        });
    </script>
</body>

</html>