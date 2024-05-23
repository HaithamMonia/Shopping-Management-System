<?php 
require("../cleanInput.php");

$productName = "";
$productPrice = "";
$productDescription = "";
$productQty = "";
$ErrMessage1 = "";
$ErrMessage2 = "";
$isValid = false;

if(isset($_POST['Update'])){
    require('../pname.php');
    require('../pPrice.php');
    // basic validation
    $productName = test_input($_POST['editName']);
    $productPrice = test_input($_POST['editPrice']);
    $productDescription = test_input($_POST['editDesc']);
    $productQty = test_input($_POST['editQty']);

    $file_name = "";
    $tempname = "";
    if(isset($_FILES['image']) && isset($_FILES['image']['name'])) {
        $file_name = $_FILES['image']['name']; // Get the file name
        $tempname = $_FILES['image']['tmp_name']; // Get the temporary file name
    }
    $folder = '../images/' . $file_name;

    // Get the file extension
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Array of allowed image extensions
    $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif','webp');

    if(!pnameTest($productName)){
        $isValid = false;
        $ErrMessage1 = "Name consist only of letters and digits!";
    } else if(!pPriceTest($productPrice) || $productPrice <= 0) {
        $isValid = false;
        $ErrMessage1 = "Price can only be a positive number!";
    } else if (empty($productQty)){
        $isValid = false;
        $ErrMessage2 = "Quantity must be specified!";
    } else {
        $isValid = true;
    }

    if ($isValid) {
        try {
            require('../connection.php');
            // Retrieve the current image filename
            $sql = "SELECT picture FROM product WHERE pid = ?";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $productId);
            $productId = $_GET['pid'];
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $currentImage = $row['picture'];

            // Delete the current image file
            if (file_exists('../images/' . $currentImage)) {
                unlink('../images/' . $currentImage);
            }

            // Move the new uploaded file to the destination folder
            if (!move_uploaded_file($tempname, $folder)) {
                $ErrMessage2 = "Failed to upload image";
                $isValid = false;
            }

            if ($isValid) {
                // Update the product info in the database
                $sql = "UPDATE product SET pname = ?, type = ?, price = ?, description = ?, stock = ?, picture = ? WHERE pid = ?";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(1, $productName);
                $stmt->bindParam(2, $productType);
                $stmt->bindParam(3, $productPrice);
                $stmt->bindParam(4, $productDescription);
                $stmt->bindParam(5, $productQty);
                $stmt->bindParam(6, $file_name);
                $stmt->bindParam(7, $productId);

                if ($stmt->execute()) {
                    $updateSuccess = true;
                    // Reset form fields if needed
                } else {
                    $updateSuccess = false;
                }
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
    <title>Staff Edit</title>
    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="staff.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <img class="editbg" src="../../Design/limebg.jpeg" alt="background">
    <div class="editcontainer">
        <div class="header-container">
            <header class="editheader">
                <div class="menu">
                    <div class="spacing2">
                        <a href="staffMain.php"><div class="mbox"> <i class="fa-solid fa-house" title="Home"></i></div></a> 
                        <a href="staffviewItems.php"><div class="mbox"><i class="fa-solid fa-grip" title="View Items"></i></div></a>
                        <a href="../login/Login.php"><div class="mbox"><b>Logout</b></div></a>
                    </div>
                </div>
                <div class="title"><h1>Souq<span>BH</span></h1></div>
            </header>
        </div>
        <div class="editMain">
            <p>Edit Item</p>
            <div class="eboxcontainer">
                <div class="editbox ebox1"> 
                    <form action="" method="POST" enctype="multipart/form-data">
                        <table style="margin:auto;">
                            <tr class="tr3">
                                <div class="info editname"><td>Name:</td><td><input type="text" name="editName" ></br></br></td></div>
                                <div class="info editprice"><td>Price:</td><td><input type="txt" name="editPrice"></br></br></td></div>
                                <div class="info editdescription"><td>Description:</td><td><input type="text" name="editDesc"></br></br></td></div>
                            </tr>
                            <?php
                            if (!$isValid) {
                                echo "<tr style='width: 70%' > <td style = 'color: red; text-align:left;word-wrap: break-word;'>$ErrMessage1</td></tr>";
                            }else if ($isValid) {
                                echo "<tr style='width: 70%' > <td style = 'color: green; text-align:left;word-wrap: break-word;'>$ErrMessage1</td></tr>";
                            }
                            ?>
                        </table>
                </div>
                <div class="editbox ebox2">
                    <table style="margin:auto; padding-left: 150px;">
                        <tr class="tr4">
                            <div class="info editqty"><td>Qty:</td><td><input type="number" name="editQty" min="0" style="width: 45px; margin-right: 43px; margin-top: 2px;"></br></br></td></div>
                            <div class="info editimg"><td>Image:</td><td><input type="file" name="image" style="padding-top: 2px;"></td></div>
                        </tr>
                        <?php
                            if (!$isValid) {
                                echo "<tr style='width: 70%' > <td style = 'color: red; text-align:left;word-wrap: break-word;'>$ErrMessage2</td></tr>";
                            }else{
                                if ($isValid) {
                                    echo "<tr style='width: 70%' > <td style = 'color: green; text-align:left;word-wrap: break-word;'>$ErrMessage1</td></tr>";
                                }
                            }
                            ?>
                    </table>
                </div>
            </div>
            <div class="updatebutton"><input type="submit" value="Update" name="Update"></div>
            </form>
        </div>
    
    </div>
   
                          
    <script>
             document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const success = urlParams.get('success');
            if (success === '1') {
                alert('Item has been Add Successfully!');
                document.getElementById('productForm').reset();
            }
        });
    </script>
</body>
</html>
