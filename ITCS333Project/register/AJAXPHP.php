<?php
    if(isset($_GET["testemail"])){
        $email = $_GET["testemail"];
        require("../connection.php");
        try{
            $stmt = $db -> query("SELECT email FROM users WHERE email='$email'");
            if($stmt->rowCount()){
                echo "<span style='margin-left:10px;font-size:15px;color:red;'>*already exist. <a href='../login/login.php' style='color:blue;'>Login?</a></span>";
            }
            else
                echo "Valid";
        }catch(PDOException $ex){
            $ex->getMessage();
            die("Database Error!!");
        }
        $db=null;
    }

?>