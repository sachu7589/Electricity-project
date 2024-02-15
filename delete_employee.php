<?php
    require_once "connect.php";
    if(isset($_GET['E_id'])){
        $E_id=$_GET['E_id'];
        $sql="SELECT E_L_id FROM tbl_employees WHERE E_id=$E_id;";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
        $E_L_id=$row["E_L_id"];
        $sql="UPDATE tbl_login SET L_status=0 WHERE L_id=$E_L_id;";
        $conn->query($sql);
        $sql="UPDATE tbl_employees SET E_status=0 WHERE E_id=$E_id;";
        if($conn->query($sql)){
            ?>
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                </head>
                <body>
                    
                </body>
                <script>
Swal.fire({
  icon: "error",
  title: "Deleted",
  text: "Deleted Successfully..!",
}).then(() => {
  window.location.href = "manage_employee.php";
});
</script>
                </html>
            <?php
        }
    }else{
        header("location: manage_employee.php");
      }
?>