<?php
require_once "connect.php";
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $sql = "SELECT O_email FROM  tbl_offices WHERE O_email = '$email' AND O_status=1 ;";
    $result = $conn->query($sql);   

    if ($result->num_rows > 0) {
        echo "<span style='color: red; font-size: small;'>Email Already exists</span>";
    } else {
        echo "";
    }
}
?>
