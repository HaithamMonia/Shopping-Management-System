<?php
if (isset($_GET['cusID'])) {
    $cusID = $_GET['cusID'];
    try {
        require("../../connection.php");
        $stmt3 = $db->prepare("SELECT oid, status FROM orders WHERE uid = :cusID AND status != 'complete'");
        $stmt3->bindParam(':cusID', $cusID);
        $stmt3->execute();
        $rows = $stmt3->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    $ack = $process = $transit = false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    <link rel="stylesheet" href="../../reset.css">
    <link rel="stylesheet" href="profile.css">
</head>

<body>
    <?php foreach ($rows as $row) {
        if ($row['status'] == 'Ack')
            $ack = true;
        if ($row['status'] == 'transit')
            $transit = true;
        if ($row['status'] == 'process')
            $process = true;
    ?>
        <div class="statusmain">
            <form action="" method="POST">
                <div class="orderidstatus">
                    <p>Order ID: <span><?php echo $row['oid']; ?>
                        </span></p>
                </div>
                <div class="status">
    <p class="ack" style="<?php if($ack) echo 'color: green;'; else echo 'color: red;'; ?>">ACKNOWLEDGED</p>
    <p class="process" style="<?php if($process) echo 'color: green;'; else echo 'color: red;'; ?>">IN PROCESS</p>
    <p class="transit" style="<?php if($transit) echo 'color: green;'; else echo 'color: red;'; ?>">IN TRANSIT</p>
    <?php
        $ack = $process = $transit = false;
    ?>
</div>


            </form>
        </div>
    <?php } ?>
</body>

</html>