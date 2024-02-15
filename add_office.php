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
                  $ph=$_POST['ph'];
                  $email=$_POST['email'];
                  $area=$_POST['area'];
                  $po=$_POST['po'];
                  $street=$_POST['street'];
                  $city=$_POST['city'];
                  $landmark=$_POST['landmark'];
                  $district=$_POST['district'];
                  require_once "connect.php";
                  $sql="INSERT INTO tbl_offices (O_phone,O_email,O_area,O_postal,O_street,O_city,O_landmark,O_district)VALUES ('$ph','$email','$area','$po','$street','$city','$landmark','$district'); ";
                  if($conn->query($sql)===TRUE){
                    $sql="SELECT O_id FROM tbl_offices WHERE O_email='$email';";
                    $res=$conn->query($sql);
                    $row=$res->fetch_assoc();
                    $O_id=$row["O_id"];
                    $sql="INSERT INTO tbl_allocate (Alloc_officeid) VALUES($O_id);";
                    $conn->query($sql);
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
  title: "Office added successfully..",
  showConfirmButton: false,
  timer: 2000
});
setTimeout(function(){ window.location = 'manage_office.php'; }, 2000);
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
    .error{
      color:red;
      font-size: x-small;
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
          <a class="nav-link active" href="manage_office.php">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Manage offices</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="manage_employee.php">
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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Add offices</li>
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
                <h6>Add Offices</h6>
              </div>
              <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">

                  <form action="#" method="POST" class="p-5" onsubmit="return validateForm()">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group first">
                          <label>Phone Number</label>
                          <input type="text" class="form-control" id="ph" name="ph" onblur="validatePhoneNumber()"
                            oninput="validatePhoneNumber()">
                          <label class="error" id="erph"></label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group first">
                          <label>Email</label>
                          <input type="email" class="form-control" id="email" name="email" onblur="validateEmail()"
                            oninput="validateEmail()">
                          <label class="error" id="eremail"></label>
                          <label class="err" id="errorMessage" style="font-size: small; color: red;"></label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group first">
                          <label>Area </label>
                          <input type="text" class="form-control" id="area" name="area" onblur="validateArea()" oninput="validateArea()">
                          <label class="error" id="erarea"></label>
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
                          <label>Landmark</label>
                          <input type="text" class="form-control" id="landmark" name="landmark" onblur="validateLandmark()" oninput="validateLandmark()">
                          <label class="error" id="erlandmark"></label>
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


function validateArea() {
  var area = document.getElementById('area').value;
  var erArea = document.getElementById('erarea');

  // Regular expression to validate area name format
  var regex = /^[a-zA-Z]{3,}(?:(\w)(?!\1))+$/;

  // Check if the area name matches the pattern and does not contain special symbols
  if (regex.test(area) && /^[a-zA-Z\s]*$/.test(area) && !isAllLettersSame(area)) {
    erArea.innerText = ''; // Clear error message
    return true; // Valid area name
  } else {
    erArea.innerText = 'Area name should start with a letter, have at least three letters, not contain consecutive identical letters or special symbols, and not have all letters the same.';
    return false; // Invalid area name
  }
}

// Function to check if all letters in a string are the same
function isAllLettersSame(str) {
  return str.split('').every((char, index, arr) => char === arr[0]);
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

function validateLandmark() {
  var landmark = document.getElementById('landmark').value;
  var erLandmark = document.getElementById('erlandmark');

  // Regular expression to validate landmark name format
  var regex = /[a-zA-Z]{5}/;

  // Check if the landmark name matches the pattern
  if (regex.test(landmark)) {
    erLandmark.innerText = ''; // Clear error message
    return true; // Valid landmark name
  } else {
    erLandmark.innerText = 'Landmark name should start with a letter and have at least five letters, and not contain consecutive identical letters.';
    return false; // Invalid landmark name
  }
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



      // Attach onblur and oninput events to trigger the validation functions
      document.getElementById('ph').addEventListener('blur', validatePhoneNumber);
      document.getElementById('ph').addEventListener('input', validatePhoneNumber);
      document.getElementById('email').addEventListener('blur', validateEmail);
      document.getElementById('email').addEventListener('input', validateEmail);
      document.getElementById('area').addEventListener('blur', validateArea);
      document.getElementById('area').addEventListener('input', validateArea);
      document.getElementById('po').addEventListener('blur', validatePostalCode);
      document.getElementById('po').addEventListener('input', validatePostalCode);
      document.getElementById('street').addEventListener('blur', validateStreetName);
      document.getElementById('street').addEventListener('input', validateStreetName);
      document.getElementById('city').addEventListener('blur', validateCity);
      document.getElementById('city').addEventListener('input', validateCity);
      document.getElementById('landmark').addEventListener('blur', validateLandmark);
      document.getElementById('landmark').addEventListener('input', validateLandmark);
      document.getElementById('district').addEventListener('blur', validateDistrict);
      document.getElementById('district').addEventListener('input', validateDistrict);

      function validateForm() {
        // Call all individual validation functions
        validatePhoneNumber();
        validateEmail();
        validateArea();
        validatePostalCode();
        validateStreetName();
        validateCity();
        validateLandmark();
        validateDistrict();

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