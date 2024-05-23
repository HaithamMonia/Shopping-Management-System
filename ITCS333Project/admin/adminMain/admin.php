<?php
$isValid =  false;
try {
    require('../../connection.php');
    $stmt = $db->prepare("SELECT ID,username FROM users where type='staff'");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($stmt->rowCount()!=0){
        $isValid = true;
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SouqBH</title>
    <link rel="stylesheet" href="../../reset.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="header-container">
            <div class="img"></div>
            <header>
                <div class="menu">
                    <div class="spacing1">
                        <div class="status"><b>Welcome&nbspAdmin!</b></div>
                    </div>
                    <div class="spacing2">
                        <a href="../../login/login.php">
                            <div class="mbox"><b>Logout</b></div>
                        </a>
                    </div>
                </div>
                <div class="title">
                    <h1>Souq<span>BH</span></h1>
                </div>
            </header>
        </div>

        <div class="bottom-box">
            <div class="boxheader">
                <p>View all staff.</p>
            </div>

            <div class="submitbox"><a href="../createStaff/newstaff.php">Create Staff
                </a></div>

                <div class="staffcontainer">
                <?php 
                if($isValid){
                foreach($rows as $r){
                    
                ?>
            <div class="staffbox">
                <div class='st1' style="padding: 10px;">
                    <div class="staffid">Staff ID: <?php echo "<span class= 'detailsSpan'>$r[ID]</span>"; ?> </div>
                    <br>
                    <div class="staffname">Username:  <?php echo "<span class= 'detailsSpan'>$r[username]</span>"; ?> </div>

                </div>
            </div>
            <?php }
            }else{?>
                <div class="staffbox">
                <div class='st1' style="padding: 10px;">
                    <div class="errorP" style ="color:red;">Sorry no staff found!</div>
                    
                </div>
            </div>
                <!-- echo "HERE";
             <p class='errorP'>Sorry no Staff found!</p>"; -->
           <?php }?> </div>
        </div>

</body>

</html>