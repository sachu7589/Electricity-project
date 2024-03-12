<?php
session_start();

if(isset($_SESSION['L_id'])) {
    require "connect.php";
    
    $sql = "SELECT O_area, O_district FROM tbl_offices WHERE O_status = 1;";
    $result = $conn->query($sql);
    $result1 = $conn->query($sql);
    
    $L_id = $_SESSION['L_id'];
    
    if(isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $ph = $_POST['ph'];
        $so = $_POST['so'];
        $po = $_POST['po'];
        $housename = $_POST['housename'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $houseno = $_POST['houseno'];
        $district = $_POST['district'];
        $area = $_POST['area'];
        $type = $_POST['type'];

        // File upload directory
        $uploadDir = 'documents/';
        
        // Process uploaded files
        $idproof = $uploadDir . basename($_FILES['idproof']['name']);
        $idproof_temp = $_FILES['idproof']['tmp_name'];
        $bulproof = $uploadDir . basename($_FILES['bulproof']['name']);
        $bulproof_temp = $_FILES['bulproof']['tmp_name'];
        
        // Upload files to the directory
        move_uploaded_file($idproof_temp, $idproof);
        move_uploaded_file($bulproof_temp, $bulproof);

        // Prepare SQL query
        $sql = "INSERT INTO tbl_consumers (C_fname, C_lname, C_phne, C_so, C_postal, C_house, C_street, C_city, C_houseno, C_district, C_area, C_con_type, C_proof_id, C_building, C_Lid)
                VALUES ('$fname', '$lname', '$ph', '$so', '$po', '$housename', '$street', '$city', '$houseno', '$district', '$area', '$type', '$idproof', '$bulproof', $L_id)";
        
        // Execute SQL query
        if($conn->query($sql) === TRUE) {
?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            </head>
            <body>
                
            </body>
            <script>
                Swal.fire({
                    icon: "success",
                    title: "Successfully...",
                    text: "Your application is now submitted!"
                }).then((result) => {
                    // Redirect to another page after the user clicks anywhere on the screen
                    if (result.isConfirmed) {
                        window.location.href = "logout.php";
                    }
                });
            </script>
            </html>
<?php
        } else {
            echo "Error: " . $conn->error;
        }
    
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
        <script>
            if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
            // Redirect the user to the login page if accessed through history
            window.location.href = "logout.php";
        }
        </script>

    <style>
        .error{
    color : red;
    font-size : small;
}
        body {
            background-color: #f6f7fc;
        }

        p {
            color: #b3b3b3;
            font-weight: 300;
        }

        label {
            padding: 5px;
        }

        a {
            -webkit-transition: .3s all ease;
            -o-transition: .3s all ease;
            transition: .3s all ease;
        }

        a:hover {
            text-decoration: none !important;
        }

        .content {
            padding: 7rem 0;
        }

        h2 {
            font-size: 20px;
        }

        .half,
        .half .container>.row {
            height: 100vh;
            min-height: 900px;
        }

        .half .contents {
            background: #f6f7fc;
        }

        .half .bg {
            width: 25%;
        }

        @media (max-width: 767.98px) {
            .half .bg {
                width: 100%;
                height: 200px;
            }
        }

        .half .contents {
            width: 75%;
        }

        @media (max-width: 767.98px) {
            .half .contents {
                width: 100%;
            }
        }

        .half .contents .form-control,
        .half .bg .form-control {
            border: none;
            border-radius: 4px;
            height: 54px;
            background: #efefef;
        }

        .half .contents .form-control:active,
        .half .contents .form-control:focus,
        .half .bg .form-control:active,
        .half .bg .form-control:focus {
            outline: none;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .half .bg {
            background-size: cover;
            background-position: center;
        }

        .half a {
            color: #888;
            text-decoration: underline;
        }

        .half .btn {
            height: 54px;
            padding-left: 30px;
            padding-right: 30px;
        }

        .half .forgot-pass {
            position: relative;
            top: 2px;
            font-size: 14px;
        }

        .form-block {
            background: #fff;
            padding: 40px;
            max-width: 400px;
            -webkit-box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.2);
            box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 767.98px) {
            .form-block {
                padding: 25px;
            }
        }

        .control {
            display: block;
            position: relative;
            padding-left: 30px;
            margin-bottom: 15px;
            cursor: pointer;
            font-size: 14px;
        }

        .control .caption {
            position: relative;
            top: .2rem;
            color: #888;
        }

        .control input {
            position: absolute;
            z-index: -1;
            opacity: 0;
        }

        .control__indicator {
            position: absolute;
            top: 2px;
            left: 0;
            height: 20px;
            width: 20px;
            background: #e6e6e6;
            border-radius: 4px;
        }

        .control--radio .control__indicator {
            border-radius: 50%;
        }

        .control:hover input~.control__indicator,
        .control input:focus~.control__indicator {
            background: #ccc;
        }

        .control input:checked~.control__indicator {
            background: #fb771a;
        }

        .control:hover input:not([disabled]):checked~.control__indicator,
        .control input:checked:focus~.control__indicator {
            background: #fb8633;
        }

        .control input:disabled~.control__indicator {
            background: #e6e6e6;
            opacity: 0.9;
            pointer-events: none;
        }

        .control__indicator:after {
            font-family: 'icomoon';
            content: '\e5ca';
            position: absolute;
            display: none;
            font-size: 16px;
            -webkit-transition: .3s all ease;
            -o-transition: .3s all ease;
            transition: .3s all ease;
        }

        .control input:checked~.control__indicator:after {
            display: block;
            color: #fff;
        }

        .control--checkbox .control__indicator:after {
            top: 50%;
            left: 50%;
            margin-top: -1px;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .control--checkbox input:disabled~.control__indicator:after {
            border-color: #7b7b7b;
        }

        .control--checkbox input:disabled:checked~.control__indicator {
            background-color: #7e0cf5;
            opacity: .2;
        }

        #erpassword {
            font-size: small;
            color: red;
        }
    </style>

    <title>Register</title>

</head>

<body>
    <section id="topbar" class="d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a
                        href="mailto:contact@example.com">contact@example.com</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
            </div>
        </div>
    </section>

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="index.html"><span>e4U</span></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt=""></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="index.html">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#services">Services</a></li>
                    <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li>
                    <li><a class="nav-link scrollto" href="#team">Team</a></li>
                    <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="#">Drop Down 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i
                                        class="bi bi-chevron-right"></i></a>
                                <ul>
                                    <li><a href="#">Deep Drop Down 1</a></li>
                                    <li><a href="#">Deep Drop Down 2</a></li>
                                    <li><a href="#">Deep Drop Down 3</a></li>
                                    <li><a href="#">Deep Drop Down 4</a></li>
                                    <li><a href="#">Deep Drop Down 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Drop Down 2</a></li>
                            <li><a href="#">Drop Down 3</a></li>
                            <li><a href="#">Drop Down 4</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->


    <div class="d-md-flex justify-content-center">
        <div class="contents">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-12 py-5">
                        <h3 style="padding-bottom: 50px;">
                            <center>New Connection</center>
                        </h3>

                        <form action="#" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group first">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" id="fname" name="fname"
                                            onblur="validateFirstName()" oninput="validateFirstName()">
                                        <label class="error" id="erfname"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group first">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" id="lname" name="lname"
                                            onblur="validateLastName()" oninput="validateLastName()">
                                        <label class="error" id="erlname"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group first">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" id="ph" name="ph"
                                            onblur="validatePhoneNumber()" oninput="validatePhoneNumber()">
                                        <label class="error" id="erph"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group first">
                                        <label>S/O</label>
                                        <input type="text" class="form-control" id="so" name="so"
                                            onblur="validateSonOf()" oninput="validateSonOf()">
                                        <label class="error" id="erso"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group first">
                                        <label>Postal code</label>
                                        <input type="number" class="form-control" id="po" name="po"
                                            onblur="validatePostalCode()" oninput="validatePostalCode()">
                                        <label class="error" id="erpo"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group first">
                                        <label>House Name</label>
                                        <input type="text" class="form-control" id="housename" name="housename"
                                            onblur="validateHouseName()" oninput="validateHouseName()">
                                        <label class="error" id="erhousename"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group last mb-3">
                                        <label>Street name</label>
                                        <input type="text" class="form-control" id="street" name="street"
                                            onblur="validateStreetName()" oninput="validateStreetName()">
                                        <label class="error" id="erstreet"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group last mb-3">
                                        <label>City</label>
                                        <input type="text" class="form-control" id="city" name="city"
                                            onblur="validateCity()" oninput="validateCity()">
                                        <label class="error" id="ercity"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group last mb-3">
                                        <label>House no</label>
                                        <input type="text" class="form-control" id="houseno" name="houseno"
                                            onblur="validateHouseNumber()" oninput="validateHouseNumber()">
                                        <label class="error" id="erhouseno"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group last mb-3">
                                        <label>District</label>
                                        <select class="form-select" aria-label="Default select example" id="district"
                                            name="district">
                                            <option value="null" selected>Choose</option>
                                            <?php
                                                while($row=$result->fetch_assoc()){
                                                    ?>
                                                    <option value="<?php echo $row['O_district']; ?>"><?php echo $row['O_district']; ?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                        <label class="error" id="erdistrict"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group last mb-3">
                                        <label>Choose Area </label>
                                        <select class="form-select" aria-label="Default select example" id="area"
                                            name="area" onblur="validateArea()" oninput="validateArea()">
                                            <option value="null" selected>Choose</option>
                                            <?php
                                            while($row1=$result1->fetch_assoc()){
                                                ?>
                                                <option value="<?php echo $row1['O_area']; ?>"><?php echo $row1['O_area']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <label class="error" id="erarea"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group last mb-3">
                                        <label for="re-password">Connection type</label>
                                        <select class="form-select" aria-label="Default select example" id="type"
                                            name="type" onblur="validateConnectionType()"
                                            oninput="validateConnectionType()">
                                            <option value="null" selected>Choose</option>
                                            <option value="Domestic Connection">Domestic Connection</option>
                                            <option value="Commercial Connection">Commercial Connection</option>
                                            <option value="Industrial Connection">Industrial Connection</option>
                                            <option value="Temporary Connection">Temporary Connection</option>
                                        </select>
                                        <label class="error" id="ertype"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group last mb-3">
                                        <label>Proof of identity</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" aria-label="Upload" id="idproof"
                                                name="idproof" onblur="validateProofOfIdentity()"
                                                oninput="validateProofOfIdentity()">
                                        </div>
                                        <label class="error" id="eridproof"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group last mb-3">
                                        <label>Proof Building approval </label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" aria-label="Upload" id="bulproof"
                                                name="bulproof" onblur="validateBuildingApprovalProof()"
                                                oninput="validateBuildingApprovalProof()">
                                        </div>
                                        <label class="error" id="erbulproof"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <input type="submit" value="Apply" class="btn px-5 btn-secondary" name="submit">
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

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
  function validateSonOf() {
    var soInput = document.getElementById('so');
    var erso = document.getElementById('erso');
    var so = soInput.value.trim(); // Trim to remove leading and trailing spaces

    // Your validation logic for S/O goes here

    if (so === '') {
      erso.innerText = 'S/O is required';
      return false;
    } else {
      erso.innerText = ''; // Clear error message if any
      return true;
    }
}

function validateHouseName() {
    var housenameInput = document.getElementById('housename');
    var erhousename = document.getElementById('erhousename');
    var housename = housenameInput.value.trim(); // Trim to remove leading and trailing spaces

    // Your validation logic for house name goes here

    if (housename === '') {
      erhousename.innerText = 'House name is required';
      return false;
    } else {
      erhousename.innerText = ''; // Clear error message if any
      return true;
    }
}

function validateStreetName() {
    var streetInput = document.getElementById('street');
    var erstreet = document.getElementById('erstreet');
    var street = streetInput.value.trim(); // Trim to remove leading and trailing spaces

    // Your validation logic for street name goes here

    if (street === '') {
      erstreet.innerText = 'Street name is required';
      return false;
    } else {
      erstreet.innerText = ''; // Clear error message if any
      return true;
    }
}

function validateCity() {
    var cityInput = document.getElementById('city');
    var ercity = document.getElementById('ercity');
    var city = cityInput.value.trim(); // Trim to remove leading and trailing spaces

    // Your validation logic for city goes here

    if (city === '') {
      ercity.innerText = 'City is required';
      return false;
    } else {
      ercity.innerText = ''; // Clear error message if any
      return true;
    }
}

function validateHouseNumber() {
    var housenoInput = document.getElementById('houseno');
    var erhouseno = document.getElementById('erhouseno');
    var houseno = housenoInput.value.trim(); // Trim to remove leading and trailing spaces

    // Your validation logic for house number goes here

    if (houseno === '') {
      erhouseno.innerText = 'House number is required';
      return false;
    } else {
      erhouseno.innerText = ''; // Clear error message if any
      return true;
    }
}

function validateDistrict() {
    var districtInput = document.getElementById('district');
    var erdistrict = document.getElementById('erdistrict');
    var district = districtInput.value.trim(); // Trim to remove leading and trailing spaces

    // Your validation logic for district goes here

    if (district === 'null') {
      erdistrict.innerText = 'Please choose a district';
      return false;
    } else {
      erdistrict.innerText = ''; // Clear error message if any
      return true;
    }
}

function validateArea() {
    var areaInput = document.getElementById('area');
    var erarea = document.getElementById('erarea');
    var area = areaInput.value.trim(); // Trim to remove leading and trailing spaces

    // Your validation logic for area goes here

    if (area === 'null') {
      erarea.innerText = 'Please choose an area';
      return false;
    } else {
      erarea.innerText = ''; // Clear error message if any
      return true;
    }
}

function validateConnectionType() {
    var typeInput = document.getElementById('type');
    var ertype = document.getElementById('ertype');
    var type = typeInput.value.trim(); // Trim to remove leading and trailing spaces

    // Your validation logic for connection type goes here

    if (type === 'null') {
      ertype.innerText = 'Please choose a connection type';
      return false;
    } else {
      ertype.innerText = ''; // Clear error message if any
      return true;
    }
}

function validateProofOfIdentity() {
    var idproofInput = document.getElementById('idproof');
    var eridproof = document.getElementById('eridproof');
    var idproof = idproofInput.value.trim(); // Trim to remove leading and trailing spaces

    // Your validation logic for proof of identity goes here

    if (idproof === '') {
      eridproof.innerText = 'Please upload proof of identity';
      return false;
    } else {
      eridproof.innerText = ''; // Clear error message if any
      return true;
    }
}

function validateBuildingApprovalProof() {
    var bulproofInput = document.getElementById('bulproof');
    var erbulproof = document.getElementById('erbulproof');
    var bulproof = bulproofInput.value.trim(); // Trim to remove leading and trailing spaces

    // Your validation logic for building approval proof goes here

    if (bulproof === '') {
      erbulproof.innerText = 'Please upload building approval proof';
      return false;
    } else {
      erbulproof.innerText = ''; // Clear error message if any
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

        document.getElementById('lname').addEventListener('blur', validateLastName);
         document.getElementById('lname').addEventListener('input', validateLastName);

        document.getElementById('ph').addEventListener('blur', validatePhoneNumber);
         document.getElementById('ph').addEventListener('input', validatePhoneNumber);
         document.getElementById('po').addEventListener('blur', validatePostalCode);
         document.getElementById('po').addEventListener('input', validatePostalCode);
         document.getElementById('fname').addEventListener('blur', validateFirstName);
         document.getElementById('fname').addEventListener('input', validateFirstName);
         document.getElementById('so').addEventListener('blur', validateSonOf);
document.getElementById('so').addEventListener('input', validateSonOf);
document.getElementById('housename').addEventListener('blur', validateHouseName);
document.getElementById('housename').addEventListener('input', validateHouseName);
document.getElementById('street').addEventListener('blur', validateStreetName);
document.getElementById('street').addEventListener('input', validateStreetName);
document.getElementById('city').addEventListener('blur', validateCity);
document.getElementById('city').addEventListener('input', validateCity);
document.getElementById('houseno').addEventListener('blur', validateHouseNumber);
document.getElementById('houseno').addEventListener('input', validateHouseNumber);
document.getElementById('district').addEventListener('blur', validateDistrict);
document.getElementById('district').addEventListener('input', validateDistrict);
document.getElementById('area').addEventListener('blur', validateArea);
document.getElementById('area').addEventListener('input', validateArea);
document.getElementById('type').addEventListener('blur', validateConnectionType);
document.getElementById('type').addEventListener('input', validateConnectionType);
document.getElementById('idproof').addEventListener('blur', validateProofOfIdentity);
document.getElementById('idproof').addEventListener('input', validateProofOfIdentity);
document.getElementById('bulproof').addEventListener('blur', validateBuildingApprovalProof);
document.getElementById('bulproof').addEventListener('input', validateBuildingApprovalProof);

      function validateForm() {
        // Call all individual validation functions
        validatePhoneNumber();
        validatePostalCode();
        validateFirstName();
        validatePhoneNumber();
validatePostalCode();
validateFirstName();
validateSonOf();
validateHouseName();
validateStreetName();
validateCity();
validateHouseNumber();
validateDistrict();
validateArea();
validateConnectionType();
validateProofOfIdentity();
validateBuildingApprovalProof();



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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>
        <?php
    }else{
        ?>
    <script>
        window.location.href="login.php";
    </script>
<?php
    }
?>