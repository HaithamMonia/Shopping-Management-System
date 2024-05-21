<?php
session_start();

$productName = "";
$productType = "";
$ErrMessage = "";
$productPrice = "";
$productDescription = "";  // Corrected variable name
$productQty = "";  // Corrected variable name
$isValid = true;
$formSubmitted =  false;
require('../cleanInput.php');

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
            require('../connection.php');
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
                                    <td><input type="number" min="0" name="pprice"
                                            value="<?php echo $productPrice; ?>"></br></br></td>
                                </div>
                                <div class="info box1description">
                                    <td>Description:</td>
                                    <td><input type="text" name="pdes"
                                            value="<?php echo $productDescription  ?>"></br></br></td>
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
                                echo "<tr > <td style = 'color: red; text-align:left;word-wrap: break-word;'>$ErrMessage</td></tr>";
                            }
                            ?>

                            <td>
                                <div class="addbutton"><input type="submit" value="Add" name="add"></div>
                            </td>
                            </tr>
                        </table>

                    </form>
                </div>

            </div>
            <div class="mainbox box2">
                <div class="box2Title">
                    <p>Active Orders</p>
                </div>
                <div class="infobox2">
                    <div class="subbox2">
                        <div class="boxheader">
                            <p>Order ID:</p>
                        </div>
                        <div class="boxinfo">
                            <p>... ...</p>
                        </div>
                        <div class="boxfooter">
                            <p>Status:</p>
                            <input type="button" value="Ack">
                            <input type="button" value="Process">
                            <input type="button" value="Transit">
                            <input type="button" value="Complete">
                        </div>
                    </div>
                    <div class="subbox2">
                        <div class="boxheader">
                            <p>Order ID:</p>
                        </div>
                        <div class="boxinfo">
                            <p>... ...</p>
                        </div>
                        <div class="boxfooter">
                            <p>Status:</p>
                            <input type="button" value="Ack">
                            <input type="button" value="Process">
                            <input type="button" value="Transit">
                            <input type="button" value="Complete">
                        </div>
                    </div>
                    <div class="subbox2">
                        <div class="boxheader">
                            <p>Order ID:</p>
                        </div>
                        <div class="boxinfo">
                            <p>... ...</p>
                        </div>
                        <div class="boxfooter">
                            <p>Status:</p>
                            <input type="button" value="Ack">
                            <input type="button" value="Process">
                            <input type="button" value="Transit">
                            <input type="button" value="Complete">
                        </div>
                    </div>
                    <div class="subbox2">
                        <div class="boxheader">
                            <p>Order ID:</p>
                        </div>
                        <div class="boxinfo">
                            <p>... ...</p>
                        </div>
                        <div class="boxfooter">
                            <p>Status:</p>
                            <input type="button" value="Ack">
                            <input type="button" value="Process">
                            <input type="button" value="Transit">
                            <input type="button" value="Complete">
                        </div>
                    </div>
                    <div class="subbox2">
                        <div class="boxheader">
                            <p>Order ID:</p>
                        </div>
                        <div class="boxinfo">
                            <p>... ...</p>
                        </div>
                        <div class="boxfooter">
                            <p>Status:</p>
                            <input type="button" value="Ack">
                            <input type="button" value="Process">
                            <input type="button" value="Transit">
                            <input type="button" value="Complete">
                        </div>
                    </div>
                    <div class="subbox2">
                        <div class="boxheader">
                            <p>Order ID:</p>
                        </div>
                        <div class="boxinfo">
                            <p>... ...</p>
                        </div>
                        <div class="boxfooter">
                            <p>Status:</p>
                            <input type="button" value="Ack">
                            <input type="button" value="Process">
                            <input type="button" value="Transit">
                            <input type="button" value="Complete">
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var insertSuccess = <?php echo json_encode($insertSuccess); ?>;
            var formSubmitted = <?php echo json_encode($formSubmitted); ?>;
            if (formSubmitted&&insertSuccess) {
                alert('Item has been inserted successfully!');
                document.getElementById('productForm').reset(); // Reset the form fields
            } else if(formSubmitted&& !insertSuccess) {
                alert('Failed to insert an item');
            }
            
        });
    </script>
</body>

</html>