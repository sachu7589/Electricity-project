<?php
    $server='localhost';
    $user='root';
    $pass='';
    $dbname = 'electricity';
    $conn=mysqli_connect($server,$user,$pass,$dbname);
    if(!$conn) {
        die('Could not connect:'.mysql_error());
    }
?>