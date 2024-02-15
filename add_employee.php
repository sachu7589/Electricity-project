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
              $fname=$_POST['fname']; 
              $lname=$_POST['lname'];
              $email=$_POST['email'];
              $ph=$_POST['ph'];
              $so=$_POST['so'];
              $po=$_POST['po'];
              $housename=$_POST['housename'];
              $city=$_POST['city'];
              $street=$_POST['street'];
              $dob=$_POST['dob'];
              $district=$_POST['district'];
              $dobYearLastTwo = substr($dob, -2);
              $dobMonth = date('m', strtotime($dob)); // Extract month from date of birth
              $partialPassword = ucfirst(substr($fname, 0, 2)) . substr($lname, 0, 2);
              $monthSpecialChar = '@';
              $password = md5($partialPassword . $monthSpecialChar . $dobYearLastTwo);

              require_once "connect.php";
              $sql="SELECT type_id FROM tbl_User_Types WHERE type_name='Employee';";
              $result=$conn->query($sql);
              $row=$result->fetch_assoc();
              $L_type_id=$row['type_id'];

              $sql="INSERT INTO tbl_login (L_uname,L_pass,L_type_id) VALUES ('$email','$password','$L_type_id');";
              $conn->query($sql);

              $sql="SELECT L_id FROM tbl_login WHERE L_uname='$email' AND L_type_id='$L_type_id';";
              $res=$conn->query($sql);
              $userdata=$res->fetch_assoc();
              $E_L_id=$userdata['L_id'];

              $sql="INSERT INTO tbl_employees(E_fname,E_lname,E_phne,E_email,E_so,E_postal,E_house,E_street,E_city,E_dob,E_district,E_L_id)VALUES('$fname','$lname','$ph','$email','$so','$po','$housename','$city','$street','$dob','$district',$E_L_id);";
              if($conn->query($sql)===TRUE){
                
                require 'vendor/autoload.php';
               
                $mail = new PHPMailer\PHPMailer\PHPMailer();
                
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'sachu7589@gmail.com';
                $mail->Password = 'uaxa eqon giok bxzm';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                
                $mail->setFrom('sachu7589@gmail.com', 'Electricity');
                $mail->addAddress($email, $fname);
                $mail->Subject = 'Employee of Electricity';
                $mail->Body = 'You are now employee of electricity';
                $mail->AltBody = 'You are now employee of electricity';
                
                if (!$mail->send()) {
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
  title: "Invalid Email...!",
  text: "Something went wrong!",
});
                      </script>
                      </html>
                    <?php
                } else {
                   
                }

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
icon: "success",
title: "Employee added successfully..",
showConfirmButton: false,
timer: 2000
});

</script>

</html>
                <?php
             }
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
  <style>
    .error {
      color: red;
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
        <li class="nav-item ">
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
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Add employee</li>
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
              <div class="card-header pb-0 mx-auto">
                <h6>Add Employee</h6>
              </div>
              <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">

                  <form action="#" method="POST" class="p-5" onsubmit="return validateForm()">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group first">
                          <label>First Name</label>
                          <input type="text" class="form-control" id="fname" name="fname" onblur="validateFirstName()"
                            oninput="validateFirstName()">
                          <label class="error" id="erfname"></label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group first">
                          <label>Last Name</label>
                          <input type="text" class="form-control" id="lname" name="lname" onblur="validateLastName()"
                            oninput="validateLastName()">
                          <label class="error" id="erlname"></label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group first">
                          <label>Phone Number</label>
                          <input type="text" class="form-control" id="ph" name="ph" onblur="validatePhoneNumber1()"
                            oninput="validatePhoneNumber()" onkeyup="validatePhoneNumber1()">
                          <label class="error" id="erph"></label>
                          <label class="error" id="errorMessageph" style="font-size: small; color: red;"></label>                          
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group first">
                          <label>Email</label>
                          <input type="email" class="form-control" id="email" name="email" onblur="validateEmail1()" oninput="validateEmail()" onkeyup="validateEmail1()">
                          <label class="error" id="eremail"></label>
                          <label class="error" id="errorMessage" style="font-size: small; color: red;"></label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group first">
                          <label>S/O</label>
                          <input type="text" class="form-control" id="so" name="so" onblur="validateSonOf()"
                            oninput="validateSonOf()">
                          <label class="error" id="erso"></label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group first">
                          <label>Postal code</label>
                          <input type="number" class="form-control" id="po" name="po" onblur="validatePostalCode()"
                            oninput="validatePostalCode()">
                          <label class="error" id="erpo"></label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group first">
                          <label>House Name</label>
                          <input type="text" class="form-control" id="housename" name="housename"
                            onblur="validateHouseName()" oninput="validateHouseName()">
                          <label class="error" id="erhousename"></label>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">

                        <div class="form-group last mb-3">
                          <label>Street name</label>
                          <input type="text" class="form-control" id="street" name="street"
                            onblur="validateStreetName()" oninput="validateStreetName()">
                          <label class="error" id="erstreet"></label>
                        </div>
                      </div>
                      <div class="col-md-6">

                        <div class="form-group last mb-3">
                          <label>City</label>
                          <input type="text" class="form-control" id="city" name="city" onblur="validateCity()"
                            oninput="validateCity()">
                          <label class="error" id="ercity"></label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">

                        <div class="form-group last mb-3">
                          <label>DOB</label>
                          <?php
                            $eighteenYearsAgo = date('Y-m-d', strtotime('-18 years'));
                            $fiftyYearsAgo = date('Y-m-d', strtotime('-50 years'));
                          ?>

                          <input type="date" class="form-control" id="dob" name="dob"
                            min="<?php echo $fiftyYearsAgo; ?>" max="<?php echo $eighteenYearsAgo; ?>" onkeydown="return false" onpaste="return false">

                          <label class="error" id="erdob"></label>
                        </div>
                      </div>
                      <div class="col-md-6">

                        <div class="form-group last mb-3">
                          <label>Distrct</label>
                          <select class="form-select" aria-label="Default select example" id="district" name="district">
                            <option value="null" selected>Choose</option>
                            <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                            <option value="Kollam">Kollam</option>
                            <option value="Pathanamthitta">Pathanamthitta</option>
                            <option value="Alappuzha">Alappuzha</option>
                            <option value="Kottayam">Kottayam</option>
                            <option value="Idukki">Idukki</option>
                            <option value="Ernakulam">Ernakulam</option>
                            <option value="Thrissur">Thrissur</option>
                            <option value="Palakkad">Palakkad</option>
                            <option value="Malappuram">Malappuram</option>
                            <option value="Kozhikode">Kozhikode</option>
                            <option value="Wayanad">Wayanad</option>
                            <option value="Kannur">Kannur</option>
                            <option value="Kasaragod">Kasaragod</option>
                          </select>
                          <label class="error" id="erdistrict"></label>
                        </div>
                      </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <input type="submit" value="ADD" class="btn px-5 btn-primary" name="submit">
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

      function validateFirstName() {
        var fnameInput = document.getElementById('fname');
        var erfname = document.getElementById('erfname');
        var fname = fnameInput.value.trim(); // Trim to remove leading and trailing spaces

        // Regular expression to check if the first name contains any symbol or digit
        var symbolRegex = /[^\sA-Za-z]/;

        // Regular expression to check if the first name has consecutive repeating letters
        var consecutiveRegex = /(.)\1{2}/;

        if (fname === '') {
          erfname.innerText = 'First name is required';
          return false;
        } else if (symbolRegex.test(fname)) {
          erfname.innerText = 'First name cannot contain symbols or numbers';
          return false;
        } else if (consecutiveRegex.test(fname)) {
          erfname.innerText = 'First name cannot have consecutively repeating letters';
          return false;
        } else {
          erfname.innerText = ''; // Clear error message if any
          return true;
        }
      }

      function validateLastName() {
        var lnameInput = document.getElementById('lname');
        var erlname = document.getElementById('erlname');
        var lname = lnameInput.value.trim(); // Trim to remove leading and trailing spaces

        // Regular expression to check if the last name contains any symbol or digit
        var symbolRegex = /[^\sA-Za-z]/;

        // Regular expression to check if the last name has consecutive repeating letters
        var consecutiveRegex = /(.)\1{2}/;

        if (lname === '') {
          erlname.innerText = 'Last name is required';
          return false;
        } else if (symbolRegex.test(lname)) {
          erlname.innerText = 'Last name cannot contain symbols or numbers';
          return false;
        } else if (consecutiveRegex.test(lname)) {
          erlname.innerText = 'Last name cannot have consecutively repeating letters';
          return false;
        } else {
          erlname.innerText = ''; // Clear error message if any
          return true;
        }
      }
      function validatePhoneNumber() {
        var phoneNumber = document.getElementById('ph').value;
        var erPhoneNumber = document.getElementById('erph');

        // Regular expression to match a 10-digit phone number starting with 6, 7, 8, or 9
        var regex = /^[6-9]\d{9}$/;

        // Regular expression to check if the input contains any letters, special characters, or negative sign
        var invalidCharsRegex = /[^\d]/;

        // Check if the phone number matches the pattern and doesn't contain invalid characters
        if (regex.test(phoneNumber) && !invalidCharsRegex.test(phoneNumber)) {
          // Check if the number doesn't contain repeating 5s
          if (!/(.)\1{4}/.test(phoneNumber)) {
            erPhoneNumber.innerText = ''; // Clear error message
            return true; // Valid phone number
          } else {
            erPhoneNumber.innerText = 'Phone number cannot contain 5 repeated digits consecutively.';
          }
        } else {
          erPhoneNumber.innerText = 'Please enter a valid 10-digit phone number without letters or special characters.';
        }
        return false; // Invalid phone number
      }

      function validateEmail() {
        var email = document.getElementById('email').value;
        var erEmail = document.getElementById('eremail');

        // Regular expression to validate email format
        var regex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

        // Check if the email matches the pattern
        if (regex.test(email)) {
          erEmail.innerText = ''; // Clear error message
          return true; // Valid email address
        } else {
          erEmail.innerText = 'Please enter a valid email address.';
          return false; // Invalid email address
        }
      }

      function validatePostalCode() {
        var postalCode = document.getElementById('po').value;
        var erPostalCode = document.getElementById('erpo');

        // Regular expression to validate Kerala postal codes (PIN codes)
        var regex = /^(?!(\d)\1{5})[6-9]\d{5}$/;

        // Check if the postal code matches the pattern for Kerala PIN codes
        if (regex.test(postalCode)) {
          erPostalCode.innerText = ''; // Clear error message
          return true; // Valid postal code
        } else {
          erPostalCode.innerText = 'Postal code should be a 6-digit number starting with 6, 7, 8, or 9, with no repeating digits.';
          return false; // Invalid postal code
        }
      }
      function validateStreetName() {
        var streetName = document.getElementById('street').value;
        var erStreetName = document.getElementById('erstreet');

        // Regular expression to validate street name format (at least two consecutive letters)
        var regex = /[a-zA-Z]{5}/;

        // Check if the street name matches the pattern
        if (regex.test(streetName)) {
          erStreetName.innerText = ''; // Clear error message
          return true; // Valid street name
        } else {
          erStreetName.innerText = 'Street name should start with a letter and have at least two consecutive letters.';
          return false; // Invalid street name
        }
      }

      function validateCity() {
  var city = document.getElementById('city').value;
  var erCity = document.getElementById('ercity');

  // Regular expression to validate city name format
  var regex = /^[a-zA-Z]{3,}(?:(\w)(?!\1))+$/;

  // Check if the city name matches the pattern
  if (regex.test(city)  && !isAllLettersSame(city)) {
    erCity.innerText = ''; // Clear error message
    return true; // Valid city name
  } else {
    erCity.innerText = 'City name should start with a letter and have at least three letters, and not contain consecutive identical letters.';
    return false; // Invalid city name
  }
}
function isAllLettersSame(str) {
  return /^([a-zA-Z])\1+$/.test(str);
}


      function validateDistrict() {
        var district = document.getElementById('district').value;
        var erDistrict = document.getElementById('erdistrict');

        // Check if the selected district is not "Choose"
        if (district !== 'null') {
          erDistrict.innerText = ''; // Clear error message
          return true; // Valid district selected
        } else {
          erDistrict.innerText = 'Please select a district.';
          return false; // No district selected
        }
      }
      function validateHouseName() {
        var housenameInput = document.getElementById('housename');
        var erhousename = document.getElementById('erhousename');
        var housename = housenameInput.value.trim(); // Trim to remove leading and trailing spaces

        // Regular expression to check if the house name has at least 5 letters
        var minLengthRegex = /^[a-zA-Z\s]{5,}$/;

        // Regular expression to check if all letters are not repeating consecutively
        var consecutiveRegex = /(.)\1{4}/;

        if (housename === '') {
          erhousename.innerText = 'House name is required';
          return false;
        } else if (!minLengthRegex.test(housename)) {
          erhousename.innerText = 'House name should have at least 5 letters';
          return false;
        } else if (consecutiveRegex.test(housename)) {
          erhousename.innerText = 'House name cannot have consecutively repeating letters';
          return false;
        } else {
          erhousename.innerText = ''; // Clear error message if any
          return true;
        }
      }
      function validateSonOf() {
        var soInput = document.getElementById('so');
        var erso = document.getElementById('erso');
        var sonOf = soInput.value.trim(); // Trim to remove leading and trailing spaces

        // Regular expression to check if the son of field has at least 5 letters
        var minLengthRegex = /^[a-zA-Z\s]{5,}$/;

        // Regular expression to check if all letters are not repeating consecutively
        var consecutiveRegex = /(.)\1{4}/;

        if (sonOf === '') {
          erso.innerText = 'S/O name is required';
          return false;
        } else if (!minLengthRegex.test(sonOf)) {
          erso.innerText = 'S/O name should have at least 5 letters';
          return false;
        } else if (consecutiveRegex.test(sonOf)) {
          erso.innerText = 'S/O name cannot have consecutively repeating letters';
          return false;
        } else {
          erso.innerText = ''; // Clear error message if any
          return true;
        }
      }
      function validateHouseName() {
        var houseNameInput = document.getElementById('housename').value.trim();
        var errorMessageElement = document.getElementById('erhousename');

        // Check if house name is empty
        if (houseNameInput === "") {
            errorMessageElement.textContent = "Please enter a house name.";
            return false;
        }

        // Check if house name contains only letters, numbers, and spaces
        var alphanumericRegex = /^[a-zA-Z0-9\s]+$/;
        if (!alphanumericRegex.test(houseNameInput)) {
            errorMessageElement.textContent = "House name can only contain letters, numbers, and spaces.";
            return false;
        }

        // Clear error message if validation passes
        errorMessageElement.textContent = "";
        return true;
    }


      document.getElementById('ph').addEventListener('blur', validatePhoneNumber);
      document.getElementById('ph').addEventListener('input', validatePhoneNumber);
      document.getElementById('email').addEventListener('blur', validateEmail);
      document.getElementById('email').addEventListener('input', validateEmail);
      document.getElementById('po').addEventListener('blur', validatePostalCode);
      document.getElementById('po').addEventListener('input', validatePostalCode);
      document.getElementById('street').addEventListener('blur', validateStreetName);
      document.getElementById('street').addEventListener('input', validateStreetName);
      document.getElementById('city').addEventListener('blur', validateCity);
      document.getElementById('city').addEventListener('input', validateCity);
      document.getElementById('district').addEventListener('blur', validateDistrict);
      document.getElementById('district').addEventListener('input', validateDistrict);
      document.getElementById('lname').addEventListener('blur', validateLastName);
      document.getElementById('lname').addEventListener('input', validateLastName);
      document.getElementById('fname').addEventListener('blur', validateFirstName);
      document.getElementById('fname').addEventListener('input', validateFirstName);
      document.getElementById('so').addEventListener('blur', validateSonOf);
      document.getElementById('fname').addEventListener('input', validateSonOf);
      document.getElementById('housename').addEventListener('blur', validateHouseName);
      document.getElementById('housename').addEventListener('input', validateHouseName);
      document.getElementById('email').addEventListener('blur', validateEmail1);
      document.getElementById('email').addEventListener('onkeyup', validateEmail1);

      function validateForm() {
        // Call all individual validation functions
        validatePhoneNumber();
        validateEmail();
        validateEmail1();
        validatePostalCode();
        validateStreetName();
        validateCity();
        validateDistrict();
        validateLastName();
        validateFirstName();
        validateSonOf();
        validateHouseName();


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

    function validateEmail1() {
    var email = document.getElementById('email').value;
    var errorMessage = document.getElementById('errorMessage');
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            errorMessage.innerHTML = response;
        }
    };

    xhr.open('GET', 'employee_email.php?email=' + email, true);
    xhr.send();
}

function validatePhoneNumber1() {
    var ph = document.getElementById('ph').value;
    var errorMessageph = document.getElementById('errorMessageph');
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            errorMessageph.innerHTML = response;
        }
    };

    xhr.open('GET', 'employee_phne.php?ph=' + ph, true);
    xhr.send();
}

function clearEmailError() {
    document.getElementById('errorMessage').innerHTML = "";
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