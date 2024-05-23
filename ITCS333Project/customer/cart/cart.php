<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../../reset.css">
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <img src="../../../Design/limebg.jpeg" alt="background">
<div class="container">
        <div class="header-container">
            <header class="editheader">
                <div class="menu">
                    <div class="spacing2">
                    <a href="../customerMain/customer.php"><div class="mbox"> <i class="fa-solid fa-house" title="Home"></i></div></a> 
                    <a href="../profile/profile.php"><div class="mbox"><i class="fa-solid fa-user" title="View Profile"></i></div></a>
                    <a href="../../login/login.php"><div class="mbox"><b>Logout</b></div></a></div>
                </div>
                <div class="title"><h1>Souq<span>BH</span></h1></div>
            </header>
        </div>
<main>
    <p class="mainp"> Cart</p>
    <div class="cards">
        <div class="leftCard">
            <div class="itemTitle"><p>Items</p></div>
            <div class="itemcontainer">
                <div class="item">
                    <table><tr><div class="iteminfo"><td>Apples</br>XXXX BD</td></div>
                    <div class="itemqty"><td>
                    <form action="" method="POST">
                        Qty:
                        <input type="number" value="1" min="1" max="20" style="width: 35px;"></br></br>
                        <div class="trash"><i class="fa-solid fa-trash"></i></div>
                    </form>
                    </td></div>  
                </tr>
            </table></div>

                <div class="item">
                    <table><tr><div class="iteminfo"><td>Apples</br>XXXX BD</td></div>
                    <div class="itemqty"><td>
                    <form action="" method="POST">
                        Qty:
                        <input type="number" value="1" min="1" max="20" style="width: 35px;"></br></br>
                        <div class="trash"><i class="fa-solid fa-trash"></i></div>
                    </form>
                    </td></div>  
                </tr>
            </table></div>

            <div class="item">
                <table><tr><div class="iteminfo"><td>Apples</br>XXXX BD</td></div>
                <div class="itemqty"><td>
                <form action="" method="POST">
                    Qty:
                    <input type="number" value="1" min="1" max="20" style="width: 35px;"></br></br>
                    <div class="trash"><i class="fa-solid fa-trash"></i></div>
                </form>
                </td></div>  
            </tr>
        </table></div>

                
            
               
            </div>  
        </div> 
    
    

        <div class="rightCard">
            <h3>Payment Details</h3>
            <p> Cart total:</p>
            <p> Delivery fee:</p>
            <p>Total amount:</p>
            <div class="placeOrder">  <input type="submit" value="Place Order" name="submit"></div>
        </div>
    </div>
</main>
</div>
</body>
</html>