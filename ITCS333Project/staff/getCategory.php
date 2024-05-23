<?php
require('../connection.php');

if (isset($_POST['category'])) {
    $category = $_POST['category'];

    try {
        $stmt = $db->prepare("SELECT * FROM product WHERE type = :type");
        $stmt->bindParam(':type', $category);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($products) {
            $baseImagePath = "../images/";

            foreach ($products as $product) {
                echo '<div class="item">
                        <table>
                            <tr>
                                <div class="itemimage">
                                    <td>
                                        <img src="' . $baseImagePath . htmlspecialchars($product['picture']) . '" alt="item" width="100" height="100" onerror="this.src=\'path/to/default/image.png\';">
                                    </td>
                                </div>
                                <div class="iteminfo">
                                    <td>' . htmlspecialchars($product['pname']) . '<br>' . htmlspecialchars($product['price']) . ' BD</td>
                                </div>
                                <div class="itemqty">
                                    <td>
                                        <form action="" method="POST">
                                            Qty:
                                            <input type="number" value="1" min="1" max="'. $product['stock']. '" style="width: 35px;"><br><br>
                                            <a href="staffeditItems.php?pid=' .htmlspecialchars($product['pid']). '"><div class="editbtn"><p>Edit</p></div></a>
                                        </form>
                                    </td>
                                </div>
                            </tr>
                        </table>
                    </div>';
            }
        } else {
            echo '<p>No products found.</p>';
        }
    } catch (PDOException $ex) {
        echo "Database Error";
        exit();
    }
} else {
    echo '<p>Invalid category.</p>';
}
?>
