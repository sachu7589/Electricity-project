<?php
require_once "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && isset($_GET['action'])) {
    $consumerId = $_GET['id'];
    $action = $_GET['action'];

    // Perform the action based on the request
    switch ($action) {
        case 'approve':
            // Perform the approve operation (update status to approved)
            $successMessage = "Operation performed successfully.";
            $sql = "UPDATE tbl_consumers SET C_status = 'approved' WHERE C_id = $consumerId";
            break;
        case 'reject':
            // Perform the reject operation (update status to rejected)
            $successMessage = "Operation performed successfully.";
            $sql = "UPDATE tbl_consumers SET C_status = 'rejected' WHERE C_id = $consumerId";
            break;
        case 'resubmit':
            // Perform the resubmit operation (update status to resubmitted)
            $successMessage = "Operation performed successfully.";
            $sql = "UPDATE tbl_consumers SET C_status = 'resubmitted' WHERE C_id = $consumerId";
            break;
        default:
            // Invalid action
            echo "Invalid action.";
            exit();
    }

    if ($conn->query($sql) === TRUE) {
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>

            </head>
            <body>
                
            </body>
            <script>
    swal({
        title: "Success!",
        text: "<?php echo $successMessage; ?>",
        icon: "success",
        timer: 2000, // 2 seconds
        buttons: false
    });
</script>
            </html>
        <?php
    } else {
        // Error message
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
    exit();
} else {
    // Invalid request
    echo "Invalid request.";
}
?>
