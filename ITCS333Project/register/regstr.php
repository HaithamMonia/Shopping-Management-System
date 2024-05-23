<?php
    $pattern_name = "/^[a-z][a-z\s\d]{1,}$/i";
    $pattern_email = "/^([a-z.0-9_\-+]{1,})@[a-z]{1,}\.[a-z]{1,}$/i";
    $pattern_password = "/^(?=.*[a-z])(?=.*[0-9])[A-Za-z0-9_#@%\*\-]{4,}$/";

    $mname = true; $memail = true; $mpassword = true; $ppasword = true;
    $isUserIn = $isEmailIn = false;

    if (!isset($_POST['btn'])) {
        $name = NULL;
        $email = NULL;
    } else if (isset($_POST['btn'])) {
        $name = trim($_POST["name"]);
        $email = $_POST["email"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];

        if (!preg_match($pattern_name, $name)) {
            $mname = false;
        }
        if (!preg_match($pattern_email, $email)) {
            $memail = false;
        }
        if ($password != $cpassword) {
            $mpassword = false;
        }
        if (!preg_match($pattern_password, $cpassword)) {
            $ppasword = false;
        }

        if ($mname && $memail && $mpassword && $ppasword) {
            $hashpassword = password_hash($cpassword, PASSWORD_DEFAULT);

            try {
                require('../connection.php');

                $stmt = $db->prepare("SELECT username FROM users WHERE username = :un");
                $stmt->bindParam(":un", $name);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $isUserIn = true;
                }

                $stmt2 = $db->prepare("SELECT email FROM users WHERE email = :em");
                $stmt2->bindParam(":em", $email);
                $stmt2->execute();

                if ($stmt2->rowCount() > 0) {
                    $isEmailIn = true;
                }

                if (!$isUserIn && !$isEmailIn) {
                    $stmt = $db->prepare("INSERT INTO users(username, type, password, email) VALUES(:us, 'customer', :ps, :em)");
                    $stmt->bindParam(':us', $name);
                    $stmt->bindParam(':ps', $hashpassword);
                    $stmt->bindParam(':em', $email);
                    $stmt->execute();

                    if ($stmt) {
                        header("Location: ../login/login.php");
                        exit();
                    }
                }
            } catch (PDOException $ex) {
                die("Error: " . $ex->getMessage());
            }
            $db = null;
        } else {
            $name = $_POST["name"];
            $email = $_POST["email"];
        }
    } else {
        $name = $_POST["name"];
        $email = $_POST["email"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='register.css'>
    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Register</title>
</head>
<body>
<img src="../../Design/limebg.jpeg" alt="background">
    <div class="container">
        <header>
            <h1>Souq<span>BH</span></h1>
        </header>
        <main class='registerMain'>
            <form method='post' onSubmit="return readyForSubmit();">
                <div class='registerMainHead'>Register</div><br>
                <div class='inputs'>
                    <label for="text"> <i class="fa-solid fa-user"></i> </label> &nbsp;
                    <input type='text' name='name' class='inputt' placeholder="Enter your username" value="<?php echo $name; ?>" id="name" required><br>
                    <?php 
                        if ($isUserIn) {
                            echo "<p style='color:red;'>The Username is already taken.</p>";
                        }
                    ?><br>
                    <label for="email"> <i class="fa-solid fa-envelope"></i></label> &nbsp;
                    <input type='text' name='email' class='inputt' placeholder="Enter your e-mail" value="<?php echo $email; ?>" onkeyup="CheckEmail();" id="email" required><br>
                    <span id="EmailMsg"></span>
                    <?php 
                        if ($isEmailIn) {
                            echo "<p style='color:red;'>The Email is already taken.</p>";
                        }
                    ?><br>
                    <label for="password"><i class="fa-solid fa-lock"></i></label> &nbsp;
                    <input type='password' name='password' class='inputt' placeholder="Enter your password" id="pass" required><br><br>
                    <label for="password"><i class="fa-solid fa-key"></i></label> &nbsp;
                    <input type='password' name='cpassword' class='inputt' placeholder="Confirm your password" id="cpass" required><br><br>
                    
                    <button name="btn" class="btn">Sign up</button>
                </div>
            </form>
             <p>Already have an account? <a href="../login/Login.php">Sign in</a></p>
            <br>
        </main>
    </div>
    <?php
        if (isset($_POST['btn'])) {
            if (!$mname) {
                echo "<input type='hidden' value='1' id='PHP'>";
            } else if (!$memail) {
                echo "<input type='hidden' value='2' id='PHP'>";
            } else if (!$mpassword) {
                echo "<input type='hidden' value='3' id='PHP'>";
            } else if (!$ppasword) {
                echo "<input type='hidden' value='4' id='PHP'>";
            }
        }
    ?>
    <p id="ErrBox" style="position: absolute; top:36%; visibility: hidden;"></p>
    <script src="Check.js"></script>
</body>
</html>
