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
                    <a class="nav-link" href="manage_office.php">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Manage offices</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="manage_employee.php">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Manage employee</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="allocate_employee.php">
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
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Manage employee</li>
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
            <div class="d-grid gap-2 d-md-flex justify-content-md-end pt-3">
                <a href="add_employee.php">
                <button class="btn btn-light me-md-2" type="button">Add employees</button>      
            </a>
            </div>
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                        <div class="card-header pb-0 mx-auto">
                                <h6> Employees</h6>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                        <tr>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">
                                                    Name</th>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">
                                                    Phone</th>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">
                                                    Email</th>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">
                                                    Address</th>
                                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">
                                                    S/O</th>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">
                                                    DOB</th>
                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">
                                                    Edit/Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql="SELECT * FROM tbl_employees WHERE E_status=1;";
                                            $result=$conn->query($sql);
                                            if($result->num_rows>0){
                                                while($rows=$result->fetch_assoc()){
                                                    ?>
                                            <tr>
                                                <td>
                                                    <h6 class="mb-0 text-xs">
                                                    <?php echo $rows['E_fname'] . ' ' . $rows['E_lname']; ?>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0 text-xs">
                                                        <?php echo $rows['E_phne']; ?>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0 text-xs">
                                                        <?php echo $rows['E_email']; ?>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0 text-xs">
                                                    House :  <?php echo $rows['E_house']; ?> <br>
                                                       Street :  <?php echo $rows['E_street']; ?> <br>
                                                        City : <?php echo $rows['E_city']; ?> <br>
                                                        Postal : <?php echo $rows['E_postal']; ?>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0 text-xs">
                                                        <?php echo $rows['E_so']; ?>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0 text-xs">
                                                        <?php echo $rows['E_district']; ?>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0 text-xs">
                                                        <a href="edit_employee.php?E_id=<?=$rows['E_id']?>" class="btn-primary">
                                                            <button class="btn btn-primary btn-sm">Edit</button>
                                                        </a> <br>
                                                        <a href="delete_employee.php?E_id=<?=$rows['E_id']?>">
                                                            <button class="btn btn-danger btn-sm">Delete</button>
                                                        </a>
                                                    </h6>
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