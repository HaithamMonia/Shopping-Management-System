<?php
// session_start();
$unError = false;
$emailError = false;
$phoneError = false;
$psError = false;
$psConfirmError = false;
$insertionError = false;
$un = $email = $phoneNum = $ps = $cps = "";
require ("../../cleanInput.php");
$confirmPassError = false;
if (isset($_POST['submit'])) {
    $un = test_input($_POST['username']);
    $email = test_input($_POST['email']);
    $phoneNum = test_input($_POST['phoneNum']);
    $ps = test_input($_POST['password']);
    $unReg = "/^(?=[a-zA-Z])([a-zA-Z](\s[a-zA-Z])?){3,20}$/";
    $psReg = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%_#*?&])[A-Za-z\d@$!_#%*?&]{8,20}$/";
    $emailReg = "/^[a-zA-Z0-9.-]+@[a-zA-z0-9-]+\.[a-zA-Z.]{2,5}$/";
    $phoneReg = "/^((\+|00)973)?\s?[367][0-9]{7}$/";
    $cp = test_input($_POST['cPassword']);
    if (!preg_match($unReg, $un)) {
        $unError = true;
    } else if (!preg_match($emailReg, $email)) {
        $emailError = true;
    } else if (!preg_match($phoneReg, $phoneNum)) {
        $phoneError = true;
    } else if (!preg_match($psReg, $ps)) {
        $psError = true;
    } else if ($ps != $cp) {
        $confirmPassError = true;
    } else {
        try {
            require ("../../connection.php");
            $hps = password_hash($ps, PASSWORD_DEFAULT);
            $stmt = $db->prepare("INSERT INTO users(username, type, password, email, phoneNum) VALUES(:us, 'staff', :ps, :em, :phone)");
            $stmt->bindParam(':us', $un);
            $stmt->bindParam(':ps', $hps); // Use $hps for password hash
            $stmt->bindParam(':em', $email);
            $stmt->bindParam(':phone', $phoneNum);
            $stmt->execute();
            if ($stmt) {
                header("location:../adminMain/admin.php");
            } else {
                $insertionError = true;
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
    <title>CreateSTAFF</title>
    <link rel="stylesheet" href="../../reset.css">
    <link rel="stylesheet" href="newstaff.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <img src="../../../Design/limebg.jpeg" alt="background">
    <div class="container">

        <div class="header-container">
            <header class="editheader">
                <div class="menu">
                    <div class="spacing2">
                    <a href="../adminMain/"><div class="mbox"> <i class="fa-solid fa-house" title="Home"></i></div></a> 
                    <a href=""><div class="mbox"><b>Logout</b></div></a></div>
                </div>
                <div class="title"><h1>Souq<span>BH</span></h1></div>
            </header>
        </div>
        <main>
            <h1>Create Staff</h1>
            <div class="main-subcontainer">
                
            <form method="post">
                    <label for="text"> <i class="fa-solid fa-user"></i> </label> &nbsp;
                    <input type="text" name="username" placeholder="Enter your name" value="<?php echo $un; ?>">
                    <br><br>
                    <label for="email"> <i class="fa-solid fa-envelope"></i></label> &nbsp;
                    <input type="text" name="email" placeholder="Enter your E-mail" value="<?php echo $email; ?>">
                    <br><br>
                    <label for="phoneNum"> <i class="fa-solid fa-phone"></i></label> &nbsp;
                    <input type="text" name="phoneNum" placeholder="Enter you phone number"
                        value="<?php echo $phoneNum; ?>">
                    <br><br>
                    <label for="password"><i class="fa-solid fa-lock"></i></label> &nbsp;
                    <input type="password" name="password" placeholder="Enter your password" >
                    <br><br>
                    <label for="password"><i class="fa-solid fa-key"></i></label> &nbsp;
                    <input type="password" name="cPassword" placeholder="Confirm your password">
                    <button type="submit" name="submit">Sign up</button>
                    <ul type="square" style="text-align: left;">
                        <?php
                        if ($unError) {
                            echo "<li style='padding-left: 25px;'><b>- Username:</b></li>";
                            echo "<li type: 'square' style='padding-left: 55px; color: red;'>* Username must be 8-20 characters.</li>";
                            echo "<li style='padding-left: 55px; color: red;'>* User name consist only of letters.</li>";
                        }
                        if ($emailError) {
                            echo "<li style='padding-left: 25px;'><b>- Email:</b></li>";
                            echo "<li type: 'square' style='padding-left: 55px; color: red;'>* Incorrect Email format..</li>";
                            echo "<li style='padding-left: 55px; color: red;'>* E.G, example@gmail.com</li>";
                        }
                        if ($phoneError) {
                            echo "<li style='padding-left: 25px;'><b>- Phone No.:</b></li>";
                            echo "<li type: 'square' style='padding-left: 55px; color: red;'>* Incorrect Phone No. Format..</li>";
                            echo "<li style='padding-left: 55px; color: red;'>* E.G, 38881212</li>";
                        }
                        if ($psError) {
                            echo "<li style='padding-left: 25px;'><b>- Password:</b></li>";
                            echo "<li type: 'square' style='padding-left: 55px; color: red;'>* Contain at least one uppercase letter.</li>";
                            echo "<li style='padding-left: 55px; color: red;'>* Contain at least one lowercase letter.</li>";
                            echo "<li style='padding-left: 55px; color: red;'>* Contain at least one digit..</li>";
                            echo "<li style='padding-left: 55px; color: red;'>* Contain at least one special character from the set @$!%_#*?&.</li>";
                            echo "<li style='padding-left: 55px; color: red;'>* Be between 8 and 20 characters in length.</li>";

                        }
                        if ($confirmPassError) {
                            echo "<li style='padding-left: 55px; color: red;'>* The Password Not matched</li>";
                        }
                        if ($insertionError)
                            echo "<li style='padding-left: 55px;text-align:center; color: red;'>* ERROR THE ACCOUNT WAS NOT CREATED PLEASE TRY AGAIN</li>";
                        ?>
                    </ul>





                </form>

            </div>



        </main>

    </div>
</body>

</html>