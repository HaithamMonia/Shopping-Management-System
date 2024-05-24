<?php 
require("../../check_login.php");
$us= $_SESSION['activeUser'];
if(!$_SESSION['type']=='customer')
    header('../../logout.php');

try {
    require('../../connection.php');
    $category = $db->query("SELECT type FROM product");
    // Fetch all products from the database
    $products = $db->query("SELECT * FROM product")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    echo "Database Error";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Main</title>
    <link rel="stylesheet" href="../../reset.css">
    <link rel="stylesheet" href="customer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <div class="container">
            <div class="header-container">
                <div class="img"></div>
                <header>
                    <div class="menu">
                        <div class="spacing1">
                        <div class="status"><b>Welcome&nbspCustomer!</b></div></div>
                        <div class="spacing2">
                        <a href="../cart/cart.php"><div class="mbox"><i class="fa-solid fa-shopping-cart" title="View Cart"></i></div></a>
                        <a href="../profile/profile.php?cusID=<?php echo $us?>"><div class="mbox"><i class="fa-solid fa-user" title= "View profile"> </i></div></a>
                        <a href="../../login/Login.php"><div class="mbox"><b>Logout</b></div></a></div>
                    </div>
                    <div class="title"><h1>Souq<span>BH</span></h1></div>
                    <form id="searchForm" onsubmit="performSearch(event)">
                    <div class="search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="search" id="searchQuery" placeholder="Search for items">
                    </div>
                </form>
                </header>
            </div>
    
            <nav>
            <a href="" ondblclick="loadback(event)" onclick="loadcat(event, 'Vegetable')"><div class="categorybox"><i class="fa-solid fa-carrot"></i><div class="categorytext"><b>Vegetables</b></div></div></a>
            <a href="" ondblclick="loadback(event)" onclick="loadcat(event, 'Fruit')"><div class="categorybox"><i class="fa-solid fa-apple-whole"></i><div class="categorytext"><b>Fruits</b></div></div></a>
            <a href="" ondblclick="loadback(event)" onclick="loadcat(event, 'Meat')"><div class="categorybox"><i class="fa-solid fa-drumstick-bite"></i><div class="categorytext"><b>Meats</b></div></div></a>
            <a href="" ondblclick="loadback(event)" onclick="loadcat(event, 'Snack')"><div class="categorybox"><i class="fa-solid fa-ice-cream"></i><div class="categorytext"><b>Snacks</b></div></div></a>
            <a href="" ondblclick="loadback(event)" onclick="loadcat(event, 'Bakery')"><div class="categorybox"><i class="fa-solid fa-bread-slice"></i><div class="categorytext"><b>Bakery</b></div></div></a>
            <a href="" ondblclick="loadback(event)" onclick="loadcat(event, 'Drink')"><div class="categorybox"><i class="fa-solid fa-glass-water"></i><div class="categorytext"><b>Drinks</b></div></div></a>
        </nav>
        <main>
        <div class="itemcontainer" id="itemcontainer" style="overflow-y: auto; height: 250px; width: 98%;">
                <?php foreach ($products as $product): ?>
                    <div class="item">
                        <table>
                            <tr>
                                <div class="itemimage">
                                    <td><img src="<?php echo "../../images/" .($product['picture']); ?>" alt="item" width="100" height="100"></td>
                                </div>
                                <div class="iteminfo">
                                    <td><?php echo htmlspecialchars($product['pname']); ?><br><?php echo htmlspecialchars($product['price']); ?> BD</td>
                                </div>
                                <div class="itemqty">
                                    <td>
                                        <form action="../cart/addtocart.php" method="POST">
                                            Qty:
                                            <input type="number" name="qty" value="1" min="1" max="<?php echo $product['stock'];?>" style="width: 35px;"><br><br>
                                            <input type="hidden" name="pid" value="<?php echo $product['pid'];?>">
                                            <input type="submit" value="Add to Cart" name="submit">
                                        </form>
                                    </td>
                                </div>
                            </tr>
                        </table>
                    </div>
                    <?php endforeach; ?>
            </div>
        </main>


    </div>
    <script>
    function performSearch(event) {
        event.preventDefault();
        const query = document.getElementById("searchQuery").value;
        const xHttp = new XMLHttpRequest();
        xHttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("itemcontainer").innerHTML = this.responseText;
            }
        };
        xHttp.open("POST", "../../search.php", true);
        xHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xHttp.send("query=" + encodeURIComponent(query));
    }

    let currentCategory = '';
    function loadcat(event, category) {
        event.preventDefault();
        const xHttp = new XMLHttpRequest();
        xHttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("itemcontainer").innerHTML = this.responseText;
            }
        };

        xHttp.open("POST", "getCategory.php", true);
        xHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xHttp.send("category=" + encodeURIComponent(category));
    }

    function loadback(){
        event.preventDefault();
        document.location.href = "customer.php";
    }
</script>
</body>
</html>