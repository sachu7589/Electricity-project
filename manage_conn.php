<?php
    session_start();
    if(isset($_SESSION['L_id']) ){
        $L_id= $_SESSION['L_id'];
        $sql="SELECT L_type_id FROM tbl_login WHERE L_id = '$L_id'";
        require_once "connect.php";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
        $L_type_id=$row["L_type_id"];
        $E_level=$_SESSION['E_level']; 
        if($L_type_id==3 &&  $E_level=="manager"){
            $sql="SELECT * FROM tbl_employees WHERE E_L_id=$L_id;";
            $result=$conn->query($sql);
            $rows=$result->fetch_assoc();
            $E_id=$rows['E_id'];  
            $sql1="SELECT Alloc_officeid FROM tbl_allocate WHERE Alloc_manager=$E_id;";
            $result1=$conn->query($sql1);
            $row1=$result1->fetch_assoc();
            $O_id=$row1['Alloc_officeid'] ;
            $sql2="SELECT O_area FROM tbl_offices WHERE O_id=$O_id;";
            $result2=$conn->query($sql2);
            $row2=$result2->fetch_assoc();
            ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="./assets/img/favicon.png">
    <title>
        Electricity
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="./assets/cssd/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="./assets/cssd/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
        id="sidenav-main" style="z-index: 5;">
        <div class="sidenav-header position-relative d-flex justify-content-center align-items-center">
            <img src="./images/bg.jpg" class="rounded-circle me-2" width="45" height="45" alt="Profile Photo">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="brand m-0 text-center" href="manager.php">
                <span>
                    <?php echo ucfirst($rows['E_fname']) . " " . ucfirst($rows['E_lname']); ?>
                </span> <br>
                <span>
                    <?php echo ucfirst($row2['O_area']); ?>
                </span> <br>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="manage_conn.php">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Manage connections</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
            data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">manager</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">Connections</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            <span class="input-group"></span>
                        </div>
                    </div>
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            <a href="logout.php" class="nav-link text-white font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
        <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                        <div class="card-header pb-0 mx-auto">
                                <h4> Connections </h4>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                        <tr>
                                        <th class="text-uppercase text-secondary font-weight-bolder">
                                                    Sl No </th>
                                                <th class="text-uppercase text-secondary font-weight-bolder">
                                                    Name</th>
                                                <th class="text-uppercase text-secondary font-weight-bolder">
                                                    Phone</th>
                                                <th class="text-uppercase text-secondary font-weight-bolder">
                                                    Connection type</th>
                                                <th class="text-uppercase text-secondary font-weight-bolder">
                                                    Request date</th>
                                                <th class="text-uppercase text-secondary font-weight-bolder">
                                                    More details</th>
                                                    <th class="text-uppercase text-secondary font-weight-bolder">
                                                    Status</th>
                                                    <th class="text-uppercase text-secondary font-weight-bolder">
                                                    </th>
                                            </tr>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $O_area=$row2['O_area'];
                                            $sql="SELECT * FROM tbl_consumers WHERE C_area='$O_area';";
                                            $result=$conn->query($sql);
                                            $sl=1;
                                            if($result->num_rows>0){
                                                while($rows=$result->fetch_assoc()){
                                                    ?>
                                            
                                            <tr>
                                            <td>
                                                    <h6 class="mb-0 text-">
                                                    <?php echo $sl; $sl++; ?>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0 text-">
                                                    <?php echo ucfirst($rows['C_fname']) . ' ' . ucfirst($rows['C_lname']); ?>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0 text-">
                                                        <?php echo $rows['C_phne']; ?>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0 text-">
                                                        <?php echo $rows['C_con_type']; ?>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0 text-">
                                                        <?php echo $rows['C_req_date']; ?>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0 text-">
                                                    <a href="#" class="btn btn-link btn-sm view-more-btn" data-bs-toggle="modal" data-bs-target="#detailsModal" data-id="<?php echo $rows['C_id']; ?>">View more</a>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0 text-">
                                                        <?php  $C_status=$rows['C_status']; 
                                                        if ($C_status=="pending"){
                                                            ?>
                                                            <a href="#" class="btn btn-warning btn-sm view-more-btn" data-bs-toggle="modal" data-bs-target="#detailsModal" data-id="<?php echo $rows['C_id']; ?>">Pending</a>                                                            
                                                            <?php
                                                        }
                                                        ?>
                                                    </h6>
                                                </td>
                                                <td>
                                                <a href="print.php?C_id=<?=$rows['C_id']?>" target="_blank"><i class="fas fa-download"></i></a>
                                                </td>
                                            </tr>

                                            <?php
                                                }
                                            }
                                            else{
                                                ?>
                                                <div class="card-header pb-0 mx-auto">
                                                    <h6> No result found!</h6>
                                                </div>
                                            <?php 
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </div>

      <!-- Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Consumer Details</h5>
                <button type="button" class="btn-close btn-lg btn-block" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="consumerDetails">
                <!-- Consumer details will be loaded here dynamically -->
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Fetch and populate modal on "View more" button click
        const viewMoreButtons = document.querySelectorAll('.view-more-btn');
        viewMoreButtons.forEach(button => {
            button.addEventListener('click', function () {
                const consumerId = this.getAttribute('data-id');
                fetchDetailsAndPopulateModal(consumerId);
            });
        });

        function fetchDetailsAndPopulateModal(consumerId) {
            // Make an AJAX request to fetch consumer details using consumerId
            // Replace the static content inside the modal body with the fetched details
            const modalBody = document.querySelector('.modal-body');
            // Example AJAX request using Fetch API
            fetch(`fetch_consumer_details.php?id=${consumerId}`)
                .then(response => response.text())
                .then(data => {
                    modalBody.innerHTML = data;
                })
                .catch(error => {
                    console.error('Error fetching consumer details:', error);
                });
        }
    });
</script>

        <!--   Core JS Files   -->
        <script src="./assets/js/core/popper.min.js"></script>
        <script src="./assets/js/core/bootstrap.min.js"></script>
        <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
        <script src="./assets/js/plugins/chartjs.min.js"></script>
        <script>
            var ctx1 = document.getElementById("chart-line").getContext("2d");

            var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

            gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
            gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
        </script>
        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>

</body>

</html>
<?php
        }
        else{
           header("location: login.php");
        }
    }
    else{
        header("location: login.php");
    }

?>