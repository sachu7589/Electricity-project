<?php
require_once "connect.php";
if (isset($_GET['email'])) {
    $area = $_GET['email'];
    $sql = "SELECT O_area FROM  tbl_offices WHERE O_area = '$area' AND O_status=1 ;";
    $result = $conn->query($sql);   

    if ($result->num_rows > 0) {
        echo "<span style='color: red; font-size: small;'>Area Already exists</span>";
    } else {
        echo "";
    }
}
?>
