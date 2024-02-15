<?php
require_once "connect.php";
if (isset($_GET['ph'])) {
    $ph = $_GET['ph'];

    $sql = "SELECT E_phne FROM tbl_employees WHERE E_phne = '$ph';";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<span style='color: red; font-size: small;'>Phone number Already exists</span>";
    } else {
        echo "";
    }
}
?>
