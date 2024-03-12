<?php
session_start();
if(isset($_SESSION['otp'])){
    if($_SESSION['otp']=="matched"){
        require "connect.php";
        $password=$_SESSION['password'];
        $email=$_SESSION['email'];
        $sql="INSERT INTO tbl_login (L_uname,L_pass,L_type_id) VALUES('$email','$password',2);";
        $conn->query($sql);
        session_unset();
        session_destroy();
        header("Location: login.php");
    }else{
         require "logout.php";     
    }
}else{
     require "logout.php";
   
}
?>