<?php
session_start();
?>
<?php
$wrongCredential = false;
$email = $loginBy = $ps = "";
require ("../cleanInput.php");

if (isset($_POST['submit'])) {
    $email = test_input($_POST['email']);
    $ps = test_input($_POST['ps']);
    $unReg = "/^[a-zA-Z][a-zA-Z0-9@#_]{2,19}$/";
    $emailReg = "/^[a-zA-Z0-9.-]+@[a-zA-z0-9-]+\.[a-zA-Z.]{2,5}$/";
    if(preg_match($unReg,$email)){
        $loginBy = "username";
    }else if(preg_match($emailReg,$email)){
        $loginBy =  "email";
    }else{
        $wrongCredential = true;
    }
   if(!$wrongCredential){
    try {
        require ("../connection.php");
        $stmt = $db->prepare("SELECT email, password FROM users WHERE $loginBy = :em");
        $stmt->bindParam(':em', $email);
        $stmt->execute();
        $row = $stmt->fetch(); // Fetch a row from the result set
        if ($row) { // Check if a row was fetched
            echo $row['password']; // Now it's safe to access $row
            echo "<br>$_POST[ps]";
            var_dump(password_verify("abc123", $row['password']));
            if (password_verify($_POST['ps'], $row['password'])) {
                // Password is correct
                $_SESSION['activeUser'] = $_POST['email'];
                header("location:../customer/customerMain/customer.html");
            } else {
                // Password is incorrect
                $wrongCredential = true;
            }
            
        }
        
        $db = null;
        

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
    <title>Document</title>
    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="Login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <img src="../../Design/limebg.jpeg" alt="background">
    <div class="container">

        <header>
            <h1>Souq<span>BH</span></h1>
        </header>
        <main>
            <h1>Login</h1>

            <div class="main-subcontainer">
                <form method="post">
                    <label for="email"> <i class="fa-regular fa-user"></i> </label> &nbsp;
                    <input type="text" name="email" placeholder="Enter Email or Username" value="<?php echo $email; ?>">
                    <br><br>
                    <label for="password"><i class="fa-solid fa-lock"></i></label> &nbsp;
                    <input type="password" name="ps" placeholder="Enter Password" value="<?php echo $ps; ?>">
                    <ul type="square" style="text-align: left;">
                        <?php
                        if ($wrongCredential)
                            echo "<li style='padding-left: 55px;text-align:center; color: red;'>* Wrong user name or password</li>";
                        ?>

                    </ul>
                    <button name="submit" id="submit">Login</button>
                </form>

            </div>

            <p>Don't have an account? <a href="../register/register.php">Register</a></p>


        </main>

    </div>
</body>

</html>