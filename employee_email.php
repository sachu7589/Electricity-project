<?php
require_once "connect.php";
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    $sql = "SELECT L_uname FROM tbl_login WHERE L_uname = '$email' AND L_status=1 AND L_type_id=3 ;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<span style='color: red; font-size: small;'>Email Already exists</span>";
    } else {
        echo "";
    }
}
?>
