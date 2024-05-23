<?php
require('connection.php');

if (isset($_POST['query'])) {
    $searchQuery = '%' . $_POST['query'] . '%';

    try {
        $stmt = $db->prepare("SELECT * FROM product WHERE pname LIKE :query");
        $stmt->bindParam(':query', $searchQuery);
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
                                            <input type="number" value="1" min="1" max="20" style="width: 35px;"><br><br>
                                            <input type="submit" value="Add to Cart" name="submit">
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
        echo "Database Error, Contact Administrator!";
        exit();
    }
} else {
    echo '<p>Invalid search query.</p>';
}
?>
