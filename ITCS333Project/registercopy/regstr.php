<?php
    $pattern_name="/^[a-z][a-z\s\d]{1,}$/i";
    $pattern_email="/^([a-z.0-9_\-+]{1,})@[a-z]{1,}\.[a-z]{1,}$/i";
    $pattern_password="/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[A-Za-z0-9_#@%\*\-]{8,}$/";
    // tags to display the Error messages in the buttom of page
    $mname=true;$memail=true;$mpasword=true;$ppasword=true;
    // Reinserting process Begin from Here!
    if(!isset($_POST['btn'])){
    $name = NULL;
    $email = NULL;
    }
    else if(isset($_POST['btn'])){
        $name = $_POST["name"];
        $name.trim($name);
        $email = $_POST["email"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        if(!preg_match($pattern_name,$name))
            $mname=false;
        if(!preg_match($pattern_email,$email))
            $memail=false;
        if($password!= $cpassword)
            $mpassword=false;
        if(!preg_match($pattern_password,$cpassword))
            $ppasword=false;
        if($mname&&$memail&&$mpasword&&$ppasword){
            $hashpassword= password_hash($cpassword,PASSWORD_DEFAULT);
            require('../connection.php');
            try{
            $db->beginTransaction();
            $stmt = $db -> prepare("INSERT INTO users VALUES (NULL,?,?,?)");
            $stmt->execute(array($name,$email,$hashpassword));
            $db->commit();
            
            }
            catch(PDOException $ex){
                $db->rollback();
                $ex->getMessage();
                $message= explode(":",$ex);
                if($message[2]='Integrity constraint violation')
                    die("Database Error!!");
            }$db=null;
            header('Location:../login/login.php');
        }
        else{
            $name = $_POST["name"];
            $email = $_POST["email"];
        }
    }
    else {
    $name = $_POST["name"];
    $email = $_POST["email"];
    }
    // Reinserting process Ends Here!
    // Also it will validate the inputs and update the tags after validating if something wrong it will reinsert the data otherwise clear
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
    <title>register page</title>
    <style>
        .btn{
            width:100%;
            height:35px;
            margin-top:5px;
            margin-bottom:5px;
            text-align: left;
            border-radius:10px;
            border: 0;
            padding:10px;
            padding:0;
            color:white;
            background-color:#000;
            text-align:center;
            font-size:large;
        }
    </style>
</head>
<body>
        <main class='loginMain'>
            <form method='post' onSubmit="return readyForSubmit();">
                <div class='registerMainHead'>SignUp</div><br>
                <div class='inputs'>
                        UserName<br>
                        <input type='text' name='name' class='inputt' placeholder="Enter your userName" value="<?php echo $name; ?>" id = "name" required><br>
                        Email <span id="EmailMsg"></span><br>
                        <input type='text' name='email' class='inputt' placeholder="Enter your Email" value="<?php echo $email; ?>" onkeyup="CheckEmail();" id="email" required><br>
                        Password<br>
                        <input type='password' name='password' class='inputt' placeholder="Enter your Password" id = "pass" required><br>
                        Confirm Password<br>
                        <input type='password' name='cpassword' class='inputt' placeholder="Enter your Password" id = "cpass" required><br>
                        
                        <button name="btn" class="btn">Sign UP</button>
                </div>
            </form>
        </main>
        <?php
        // Print the error Messages, Begin From here
        if(isset($_POST['btn'])){
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $cpassword = $_POST["cpassword"];
            if(!$mname)
                echo "<input type='hidden' value='1' id='PHP'>";
            else if(!$memail)
                echo "<input type='hidden' value='2' id='PHP'>";
            else if(!$mpasword)
                echo "<input type='hidden' value='3' id='PHP'>";
            else if(!$ppasword)
                echo "<input type='hidden' value='4' id='PHP'>";
        // Print the error Messages, Ends here
        // Start inserting Data into Database using beginTransaction() method to control the inputs
            else
                {   
                    
                }
        }
    ?>
    <p id="ErrBox" style="position: absolute; top:36%;visibility: hidden;"></p>
    <script src="Check.js"></script>
</body>
</html>