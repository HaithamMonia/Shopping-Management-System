<?php
if (isset($_GET['cusID'])) {
    $cusID = $_GET['cusID'];
    try {
        require("../../connection.php");
        $stmt = $db->prepare("SELECT username,email,phoneNum,address FROM users WHERE ID=:id");
        $stmt->bindParam(':id', $cusID);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
       
        $db = null;
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
    <title>Edit Info</title>
    <link rel="stylesheet" href="../../reset.css">
    <link rel="stylesheet" href="profile.css">
</head>

<body>
    <form action="" method="POST">
        <div class="cards">
            <div class="leftCard">
                <pre> Username: <input type= "text" name="username" value="<?php echo $row['username'] ?>" ></pre>
                <pre> Email: <input type= "text" name="email" value="<?php echo $row['email'] ?>" ></pre>
            </div>

            <div class="rightCard">
                <pre> Number:<input type= "text" name="number" value="<?php echo $row['phoneNum'] ?>" ></pre>
                <pre> Address:<input type= "text" name="address" value="<?php echo $row['address'] ?>" ></pre>

            </div>

        </div>
        <div class="update"><input type="submit" value="Update Info" name="update"></div>
    </form>
</body>

</html>