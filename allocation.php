<?php
    session_start();
    if(isset($_SESSION['L_id']) ){
        $L_id= $_SESSION['L_id'];
        $sql="SELECT L_type_id FROM tbl_login WHERE L_id = '$L_id'";
        require_once "connect.php";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
        $L_type_id=$row["L_type_id"];  
        if($L_type_id==1){
            ?>
            <?php
            if(isset($_POST['submit'])){  
                $manager=$_POST['manager'];
                $meter=$_POST['meter'];
                $O_id=$_GET['O_id'];
                $sql="UPDATE tbl_allocate SET Alloc_manager=$manager, Alloc_meter=$meter WHERE  Alloc_officeid=$O_id;"; 
                $conn->query($sql);
            }
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
    <script>
        window.history.pushState(null, null, window.location.href);
        window.onpopstate = function () {
            window.history.pushState(null, null, window.location.href);
        };
    </script>
    <style>
        .error{
            color:red;
        }
    </style>
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="dashboard.php">
                <img src="images/bg1.jpg" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">ADMIN</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link " href="manage_office.php">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Manage offices</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="manage_employee.php">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Manage Employee</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active" href="allocate_employee.php">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Allocate Employee</span>
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
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">Admin</h6>
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
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">

                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <div class="container">
                                        <div class="card-header pb-0 mx-auto text-center">
                                            <h6>Office Details</h6>
                                        </div>
                                        <?php 

                                            $O_id=$_GET['O_id'];
                                            $sql="SELECT * FROM tbl_offices WHERE O_id = $O_id; ";
                                            $result=$conn->query($sql);
                                            $row=$result->fetch_assoc();
                                         ?>
                                        <div class="card mb-3">
                                            <form action="#" method="post" onsubmit="return validateForm()">
                                                <div class="card-body">
                                                    <ul class="list-unstyled">
                                                        <li class="p-2"><strong>Phone:</strong>
                                                            <?php echo $row['O_phone']; ?>
                                                        </li>
                                                        <li class="p-2"><strong>Email:</strong>
                                                            <?php echo $row['O_email']; ?>
                                                        </li>
                                                        <li class="p-2"><strong>Area:</strong>
                                                            <?php echo $row['O_area']; ?>
                                                        </li>
                                                        <li class="p-2"><strong>Postal Code:</strong>
                                                            <?php echo $row['O_postal']; ?>
                                                        </li>
                                                        <li class="p-2"><strong>Street:</strong>
                                                            <?php echo $row['O_street']; ?>
                                                        </li>
                                                        <li class="p-2"><strong>City:</strong>
                                                            <?php echo $row['O_city']; ?>
                                                        </li>
                                                        <li class="p-2"><strong>Landmark:</strong>
                                                            <?php echo $row['O_landmark']; ?>
                                                        </li>
                                                        <li class="p-2"><strong>District:</strong>
                                                            <?php echo $row['O_district']; ?>
                                                        </li>
                                                    </ul>
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <!-- Select box for Alloc_manager -->
                                                            <div class="form-group mb-3">
                                                                <label><strong>Manager:</strong></label>
                                                                <select class="form-control" id="manager" name="manager" oninput="validateEmp()">
                                                                            <option value="0" selected>Choose</option>
                                                                    <?php
                                                                    $sql1="SELECT E_id,E_fname,E_lname FROM tbl_employees WHERE E_status = 1 AND E_id NOT IN ( SELECT Alloc_manager FROM tbl_allocate UNION SELECT Alloc_meter FROM tbl_allocate );";
                                                                    $result1=$conn->query($sql1);
                                                                    if($result1->num_rows>0){
                                                                        while( $row1 = $result1->fetch_assoc() ) {
                                                                           ?>
                                                                    <option value="<?php echo $row1['E_id']; ?>">
                                                                        <?php echo $row1['E_id'] . ' - ' . $row1['E_fname'] . ' ' . $row1['E_lname']; ?>
                                                                    </option>
                                                                    <?php
                                                                    }
                                                                }
                                                                ?>
                                                                </select>
                                                                <label id="er-manager" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <!-- Select box for Alloc_meter -->
                                                            <div class="form-group mb-3">
                                                                <label><strong>Meter Reader:</strong></label>
                                                                <select class="form-control" id="meter" name="meter" oninput="validateEmp()">
                                                                    <option value="0" selected>Choose</option>
                                                                    <?php
                                                                    $sql1="SELECT E_id,E_fname,E_lname FROM tbl_employees WHERE E_status = 1 AND E_id NOT IN ( SELECT Alloc_manager FROM tbl_allocate UNION SELECT Alloc_meter FROM tbl_allocate );";
                                                                    $result1=$conn->query($sql1);
                                                                    if($result1->num_rows>0){
                                                                        while( $row1 = $result1->fetch_assoc() ) {
                                                                           ?>
                                                                    <option value="<?php echo $row1['E_id']; ?>">
                                                                        <?php  echo $row1['E_id'] . ' - ' . $row1['E_fname'] . ' ' . $row1['E_lname']; ?>
                                                                    </option>
                                                                    <?php
                                                                    }
                                                                }
                                                                ?>
                                                                </select>
                                                                <label id="er-meter" class="error"></label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="text-center">
                                                        <input type="submit" name="submit"
                                                            class="btn btn-primary btn-lg" value="Alllocate">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
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
            new Chart(ctx1, {
                type: "line",
                data: {
                    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "Mobile apps",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#5e72e4",
                        backgroundColor: gradientStroke1,
                        borderWidth: 3,
                        fill: true,
                        data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                        maxBarThickness: 6

                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#fbfbfb',
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#ccc',
                                padding: 20,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });
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
            <script>
    </script>

    <script>
        function validateEmp() {
    var manager = document.getElementById('manager');
    var meter = document.getElementById('meter');
    var erManager = document.getElementById('er-manager');
    var erMeter = document.getElementById('er-meter');

    // Check if both selects are not set to "Choose"
 if (manager.value === meter.value) {
        erManager.innerText = 'Manager and meter reader cannot be the same';
        erMeter.innerText = 'Manager and meter reader cannot be the same';
        return false;
    } else {
        erManager.innerText = '';
        erMeter.innerText = '';
        return true;
    }
}

document.getElementById('manager').addEventListener('blur', validateEmp);
      document.getElementById('manager').addEventListener('input', validateEmp);
      document.getElementById('meter').addEventListener('blur', validateEmp);
      document.getElementById('meter').addEventListener('input', validateEmp);

      function validateForm() {
        validateEmp();

        // Check if any error message is displayed
        var errorElements = document.querySelectorAll('.error');
        for (var i = 0; i < errorElements.length; i++) {
          if (errorElements[i].innerText !== '') {
            // If any error message exists, prevent form submission
            return false;
          }
        }
        return true; // All fields are valid, allow form submission
      }

    </script>
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