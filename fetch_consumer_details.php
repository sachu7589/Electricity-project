<?php
require_once "connect.php";

$consumerId = $_GET['id'];

// Fetch consumer details from the database
$sql = "SELECT * FROM tbl_consumers WHERE C_id = $consumerId";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Consumer Details</title>
        <!-- Include jsPDF library -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>
    </head>
    <body>
    <div id="consumerDetails" class="row">
        <div class="col">
            <p><b>Name :</b> <span style="font-weight: bold;"><?php echo ucfirst($row['C_fname']) . ' ' . ucfirst($row['C_lname']); ?> </span> </p>
            <p><b>Phone : </b><?php echo $row['C_phne']; ?></p>
            <p><b>Connection Type :</b> <?php echo $row['C_con_type']; ?></p>
            <p><b>Address : </b><?php echo $row['C_house'] . ', ' . $row['C_street'] . ', ' . $row['C_city'] . ', ' . $row['C_postal'] . ', ' . $row['C_district']; ?></p>
            <p><b>Request Date :</b> <?php echo $row['C_req_date']; ?></p>
            <?php if (!empty($row['C_proof_id'])) { ?>
                <?php $fileExtension = pathinfo($row['C_proof_id'], PATHINFO_EXTENSION); ?>
                <?php if ($fileExtension == 'pdf') { ?>
                    <a href="<?php echo $row['C_proof_id']; ?>" target="_blank"><button class="btn btn-link">View ID Proof</button></a>
                <?php } else { ?>
                    <img src="<?php echo $row['C_proof_id']; ?>" alt="ID Proof" style="max-width: 100%;" />
                <?php } ?>
            <?php } else { ?>
                <p>ID Proof Not Available</p>
            <?php } ?>
            
            <?php if (!empty($row['C_building'])) { ?>
                <?php $fileExtension = pathinfo($row['C_building'], PATHINFO_EXTENSION); ?>
                <?php if ($fileExtension == 'pdf') { ?>
                    <a href="<?php echo $row['C_building']; ?>" target="_blank"><button class="btn btn-link">View Building Approval</button></a>
                <?php } else { ?>
                    <img src="<?php echo $row['C_building']; ?>" alt="Building proof" style="max-width: 100%;" />
                <?php } ?>
            <?php } else { ?>
                <p>Building proof Not Available</p>
            <?php } ?>
            <p>
            <?php
                if($row['C_status']=="pending"){
                    ?>
                        <a href="" class="btn btn-success">Approve</a>
                        <a href="" class="btn btn-warning" style="margin-left: 20px;">Resubmit</a>
                        <a href="" class="btn btn-danger" style="margin-left: 20px;">Reject</a>

                    <?php
                }
            ?>
            </p>
        </div>
    </div>
    </body>
    </html>
    <?php
} else {
    echo "Consumer not found.";
}
$conn->close();
?>
