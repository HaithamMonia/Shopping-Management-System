<?php 
require('../../check_login.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SouqBH</title>
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
                        <a href="../profile/profile.php?cusID=25"><div class="mbox"><i class="fa-solid fa-user" title= "View profile"> </i></div></a>
                        <a href="../../login/Login.php"><div class="mbox"><b>Logout</b></div></a></div>
                    </div>
                    <div class="title"><h1>Souq<span>BH</span></h1></div>
                    <div class="search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="search" placeholder="Search for items">
                    </div>
                </header>
            </div>
    
        <nav>
            <a href=""><div class="categorybox" onclick="test(this)">
                <i class="fa-solid fa-carrot"></i><div class="categorytext"><b>Vegetables</b></div></div></a>
            <a href=""><div class="categorybox">
                <i class="fa-solid fa-apple-whole"></i><div class="categorytext"><b>Fruits</b></div></div></a>
            <a href=""><div class="categorybox">
                <i class="fa-solid fa-drumstick-bite"></i><div class="categorytext"><b>Meats</b></div></div></a>
            <a href=""><div class="categorybox">
                <i class="fa-solid fa-ice-cream"></i><div class="categorytext"><b>Snacks</b></div></div></a>
            <a href=""><div class="categorybox">
                <i class="fa-solid fa-bread-slice"></i><div class="categorytext"><b>Bakery</b></div></div></a>
            <a href=""><div class="categorybox">
                <i class="fa-solid fa-glass-water"></i><div class="categorytext"><b>Drinks</b></div></div></a>
        </nav>
        
        <main>
            <div class="itemcontainer">

                <div class="item"><table>
                    <tr><div class="itemimage"><td><img src="../../../Design/apple.webp" alt="item" width="100" height="100"></td></div>
                        <div class="iteminfo"><td>Apples</br>XXXX BD</td></div>
                        <div class="itemqty"><td>
                        <form action="../cart/addtocart.php" method="POST">
                            Qty:
                            <input type="number" name="qty" value="1"  min="1" max="20" style="width: 35px;"></br></br>
                            <input type="hidden" name="pid" value="43">
                           <input type="submit" value="Add to Cart" name="submit">
                        </form>
                        </td></div>  
                    </tr>
                </table></div>
                
                <div class="item"><table>
                    <tr><div class="itemimage"><td><img src="../../../Design/apple.webp" alt="item" width="100" height="100"></td></div>
                        <div class="iteminfo"><td>Apples</br>XXXX BD</td></div>
                        <div class="itemqty"><td>
                        <form action="../cart/addtocart.php" method="POST">
                            Qty:
                            <input type="number" name="qty"  min="1" max="20" style="width: 35px;"></br></br>
                            <input type="hidden" name="pid" value="42">
                           <input type="submit" value="Add to Cart" name="submit">
                        </form>
                        </td></div>  
                    </tr>
                </table></div>
                <div class="item"><div class="itemimage"><img src="" alt=""></div>
                <div class="iteminfo"></div>
                </div>
                <div class="item"><div class="itemimage"><img src="" alt=""></div>
                <div class="iteminfo"></div>
                </div>   
            </div>
        </main>


    </div>
    <script>
        function test(cat){
            cat.innerHTML = "Hello World";
        }
    </script>
</body>
</html>