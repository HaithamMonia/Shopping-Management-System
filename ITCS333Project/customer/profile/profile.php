<?php

if(isset($_GET['cusID'])){
    $cusID = $_GET['cusID'];
try{
require("../../connection.php");
$stmt = $db->prepare("SELECT username,email,phoneNum,address FROM users WHERE ID=:id");
$stmt->bindParam(':id',$cusID);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$isValid= true;
            $un = $email = $phoneNum= "";
if(isset($_POST['update'])){
    $un = $_POST['username'];
    $email = $_POST['email'];
    $phoneNum = $_POST['number'];
    $address = $_POST['address'];
    $unReg = "/^[a-zA-Z][a-zA-Z0-9@#_]{2,19}$/";
    $emailReg = "/^[a-zA-Z0-9.-]+@[a-zA-z0-9-]+\.[a-zA-Z.]{2,5}$/";
    $phoneReg = "/^((\+|00)973)?\s?[367][0-9]{7}$/";
    if (!preg_match($unReg, $un)) {
        $isValid = false;
    } else if (!preg_match($emailReg, $email)) {
        $isValid = false;
    } else if (!preg_match($phoneReg, $phoneNum)) {
        $isValid = false;
    }else if(empty(trim($address))){
        $isValid = false;
    }
    if($isValid){
       $stmt2 = $db->prepare("UPDATE users SET username=:un, email= :em,phoneNum= :num,address= :add where ID =:cusID");
       $stmt2->bindParam(":un",$un);
       $stmt2->bindParam(":em",$email);
       $stmt2->bindParam(":num",$phoneNum);
       $stmt2->bindParam(":add",$address);
       $stmt2->bindParam(":cusID",$cusID);
       $stmt2 ->execute();

    }

}
$db = null;

}catch(PDOException $e){
    die("Error: ".$e->getMessage());
}
}else{
    header("location:../customerMain/customer.html");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../../reset.css">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <img src="../../../Design/limebg.jpeg" alt="background">
    <div class="container">

        <div class="header-container">
            <header class="editheader">
                <div class="menu">
                    <div class="spacing2">
                        <a href="../customerMain/customer.html">
                            <div class="mbox"> <i class="fa-solid fa-house" title="Home"></i></div>
                        </a>
                        <a href="../cart/cart.html">
                            <div class="mbox"><i class="fa-solid fa-shopping-cart" title="View Cart"></i></div>
                        </a>
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


        <main>
            <div class="head">
                <p class="mainp"> Profile</p>
                <div class="butto">
                    <a href="" class="b2">
                        <div class="butto1"> Information</div>
                    </a>
                    <a href="" class="b2">
                        <div class="butto1" onclick="loadDoc2(event)"> Order Status</div>
                    </a>
                    <a href="" class="b2">
                        <div class="butto1" onclick="loadDoc(event)">Past Orders</div>
                    </a>
                </div>

            </div>

            <div class="cards" id="cards">

                <div class="leftCard">
                    <pre> Username: <input type= "text" name="username" value="<?php echo $row['username']?>" disabled></pre>
                    <pre> Email: <input type= "text" name="username" value="<?php echo $row['email']?>" disabled></pre>
                </div>

                <div class="rightCard">
                    <pre> Number:<input type= "text" name="number" value="<?php echo $row['phoneNum']?>" disabled></pre>
                    <pre> Address:<input type= "text" name="address" value="<?php echo $row['address']?>" disabled></pre>
                </div>


            </div>
            <div class="edit" onclick="loadDoc3(event)"> <input type="submit" value="Edit Info" name="submit"></div>
        </main>
    </div>

    <script>
        function loadDoc(){
            event.preventDefault();
            const xHttp = new XMLHttpRequest();
            xHttp.onreadystatechange = function(){
                if(this.readyState==4 && this.status==200){
                    document.getElementById("cards").innerHTML = this.responseText;
                }
                document.querySelector(".edit").style = "display: none;"
            }
            xHttp.open("GET", "pastorders.html");
            xHttp.send(null);
        }

        function loadDoc2(){
            event.preventDefault();
            const xHttp = new XMLHttpRequest();
            const cusID = "<?php echo $_GET['cusID']; ?>";
            xHttp.onreadystatechange = function(){
                if(this.readyState==4 && this.status==200){
                    document.getElementById("cards").innerHTML = this.responseText;
                }
                document.querySelector(".edit").style = "display: none;"
            } 
            xHttp.open("GET", "orderstatus.php?cusID="+cusID);
            xHttp.send(null);
        }

        function loadDoc3(){
            event.preventDefault();
            const cusID = "<?php echo $_GET['cusID']; ?>";
            const xHttp = new XMLHttpRequest();
            xHttp.onreadystatechange = function(){
                if(this.readyState===4 && this.status==200){
                    document.getElementById("cards").innerHTML = this.responseText;
                }
                document.querySelector(".edit").style = "display:none;"

            }
            xHttp.open("GET", "editinfo.php?cusID=" + cusID);
            xHttp.send(null);
        }

    </script>
</body>
</html>