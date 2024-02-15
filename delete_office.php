<?php
    require_once "connect.php";
    if(isset($_GET['O_id'])){
        $O_id=$_GET['O_id'];
        $sql="UPDATE tbl_offices SET O_status=0 WHERE O_id=$O_id;";
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
  window.location.href = "manage_office.php";
});
</script>
                </html>
            <?php
        }
    }else{
        header("location: manage_office.php");
      }
?>