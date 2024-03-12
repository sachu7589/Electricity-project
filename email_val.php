<?php
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
$secret = "ES_be088cee1d7a41c896a4ebd5ced8caf7";
$response = $_POST['h-captcha-response'];
$remoteip = $_SERVER['REMOTE_ADDR'];

$postData = http_build_query(
    array(
        'secret' => $secret,
        'response' => $response,
        'remoteip' => $remoteip
    )
);

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postData
    )
);

$context  = stream_context_create($opts);
$result = file_get_contents('https://hcaptcha.com/siteverify', false, $context);
$resultData = json_decode($result);

if ($resultData->success) {
    function generateOTP($length = 6) {
        $min = pow(10, $length - 1); // Minimum value
        $max = pow(10, $length) - 1; // Maximum value
        return random_int($min, $max); // Generate random number within range
    }
    
    $otp = generateOTP(); // Generate OTP with default length (6 digits)

    require 'vendor/autoload.php';
               
                $mail = new PHPMailer\PHPMailer\PHPMailer();
                
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'sachu7589@gmail.com';
                $mail->Password = 'uaxa eqon giok bxzm';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->isHTML(true);
                $mail->setFrom('sachu7589@gmail.com', 'Electricity');
                $mail->addAddress($email);
                $mail->Subject = 'Verify your account';
                $mail->Body = '
                <html>
                <body>
                    <h1>Account verification OTP</h1>
            
                    <p>Dear sir,</p>
            
                    <p>We have received a request to verify your account associated with the email address <strong>' . $email . '</strong>. To proceed with this mail, please use the following One-Time Password (OTP):</p>
            
                    <h2>Your OTP: <span style="color: #007bff;">' . $otp . '</span></h2>
            
                    <p>Please enter this OTP to verify this account. If you did not initiate this request, please ignore this email. Ensure the security of your account by not sharing this OTP with anyone.</p>
            
                    <p>If you have any questions or concerns, please contact our support team.</p>
            
                    <p>Thank you, <br>E4U Team</p>
                </body>
                </html>';
                
                if (!$mail->send()) {
                    echo "error";
                }else{
                    // Set the session cookie parameters
                    $session_lifetime = 120; // 2 minutes in seconds
                    session_set_cookie_params($session_lifetime);

                    // Start or resume the session
                    session_start();
                    $_SESSION['otp'] = $otp;
                    session_regenerate_id(true);
                    $_SESSION['password'] = $password;
                    $_SESSION['email'] = $email;
                    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

    <script>
        $(document).ready(function () {
    Swal.fire({
        title: 'Enter OTP',
        input: 'text',
        inputPlaceholder: 'Enter OTP',
        showCancelButton: true,
        confirmButtonText: 'Submit',
        cancelButtonText: 'Cancel',
        timer: 120000, 
        timerProgressBar: true,
    }).then((result) => {
        if (result.isConfirmed) {
            var enteredOTP = result.value;
            $.ajax({
                url: 'compare.php',
                type: 'POST',
                data: { enteredValue: enteredOTP },
                success: function (response) {
                    if (response == "matched") {
                        Swal.fire({
                            title: 'Success',
                            text: 'OTP matched',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = 'login_det.php';
                        });
                    } else {
                        Swal.fire('Error', 'OTP does not match', 'error');
                    }
                }
            });
        }
    });
});

    </script>

</body>

</html>
<?php
                }
} else {
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
title: "Failed",
text: "CAPTCHA verification FAILED",
icon: "error",
timer: 1500, 
showConfirmButton: false 
});


    </script>
    </html>
<?php
}
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
     /* Style the placeholder text to appear muted */
.form-control::placeholder {
    color: #7f8487; /* Adjust the color to your preference */
    opacity: 0.5; /* Adjust the opacity to make it appear more muted */
}
.error{
    color : red;
    font-size : small;
}

        body {
            background-color: #c6c7ca;

            overflow-y: hidden;
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

        body {
            background-color: #f6f7fc;
            /* Updated background color */
            overflow-y: hidden;
        }

        /* Add this CSS for the form */
        .card {
            background-color: #fff;
            /* Card background color */
        }

        .card-header {
            background-color: #f8f9fa;
            /* Card header background color */
        }

        .card-body {
            padding: 30px;
            /* Increased padding for better spacing */
        }

        .form-control {
            background-color: #efefef;
            /* Form input background color */
            border: none;
            border-radius: 4px;
            height: 54px;
        }

        .btn-primary {
            background-color: #007bff;
            /* Button background color */
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            /* Button background color on hover */
        }

        .control .caption a {
            color: #888;
        }

        .control .caption a:hover {
            text-decoration: none;
            color: #0056b3;
            /* Link color on hover */
        }
    </style>

    <title>Login</title>
    <script>clearForm()</script>
    <script src="https://hcaptcha.com/1/api.js" async defer></script>
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
            </nav> <!-- .navbar -->

        </div>
    </header> <!-- End Header -->


    <div class="d-md-flex  half">
        <div class="bg" style="background-image: url('images/create.jpg'); height: 750px; width: 700px;"></div>
        <div class="contents">

            <div class="container ">
                <div class="row align-items-center justify-content-center" style="background-color: white;">
                    <div class="col-md-12" style="padding-bottom: 15%;">

                        <div class="container mt-5">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            Create an account
                                        </div>

                                        <div class="card-body">
                                            <form id="loginForm" method="POST" action="#" onsubmit=" return validate()">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="text" class="form-control" id="email" name="email"
                                                        placeholder="Enter your email" onblur="validateEmail()" oninput="validateEmail()" onkeyup="validateEmail1()">
                                                    <label class="error" id="email-error"></label>
                                                    <label class="error" id="errorMessage"></label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" id="password"
                                                            name="password" placeholder="Enter your password" onblur="validatePassword()" oninput="validatePassword()" >
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="togglePassword" style="height: 53px; background-color: #efefef; border-radius: 0;" >
                                                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <label class="error" id="password-error"></label>
                                                </div>
                                                <div class="form-group pb-4">
                                                    <label for="confirm-password">Confirm Password</label>
                                                    <input type="password" class="form-control" id="confirm-password"
                                                        placeholder="Confirm your password" onblur="validateConfirmPassword()" oninput="validateConfirmPassword()">
                                                </div>
                                                <label class="error" id="confirm-password-error"></label>
                                                <div class="h-captcha" data-sitekey="08f1bd0a-06f3-4456-9be2-7cd3a53cf5ea"></div>
                                                <div class="d-flex justify-content-center mb-3">
                                                    <input type="submit" name="submit" value="Register"
                                                        class="btn btn-primary btn-sm">
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <label class="control control--checkbox  mb-sm-0">
                                                        <span class="caption">Already have an account <a
                                                                href="login.php">Login</a></span>
                                                    </label>
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
</body>
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        var passwordInput = document.getElementById('password');
        var toggleIcon = document.getElementById('togglePassword').querySelector('i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        }
    });

    // Function to validate email
function validateEmail() {
    var email = document.getElementById('email').value;
    var emailError = document.getElementById('email-error');

    // Regular expression for email validation
    var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (regex.test(email)) {
        emailError.innerText = '';
        return true;
    } else {
        emailError.innerText = 'Please enter a valid email';
        return false;
    }
}

// Function to validate password
function validatePassword() {
    var password = document.getElementById('password').value;
    var passwordError = document.getElementById('password-error');

    if (password.length >= 8 && !/\s/.test(password) && /[a-z]/.test(password) && /[A-Z]/.test(password) && /[0-9]/.test(password) && /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)) {
        passwordError.innerText = '';
        return true;
    } else {
        passwordError.innerText = 'Password must be at least 8 characters long, contain no blank spaces, and include at least one lowercase letter, one uppercase letter, one number, and one special character.';
        return false;
    }
}


// Function to validate confirm password
function validateConfirmPassword() {
    var confirmPassword = document.getElementById('confirm-password').value;
    var password = document.getElementById('password').value;
    var confirmPasswordError = document.getElementById('confirm-password-error');

    if (confirmPassword === password) {
        confirmPasswordError.innerText = '';
        return true;
    } else {
        confirmPasswordError.innerText = 'Passwords do not match';
        return false;
    }
}


// Function to validate all fields on submit
function validate() {
    var isEmailValid = validateEmail();
    var isPasswordValid = validatePassword();
    var isConfirmPasswordValid = validateConfirmPassword();

    return isEmailValid && isPasswordValid && isConfirmPasswordValid;
}

function validateEmail1() {
        var email = document.getElementById('email').value;
        var userType=2;
        var errorMessage = document.getElementById('errorMessage');
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            errorMessage.innerHTML = response;
          }
        };

        xhr.open('GET', 'validate_email.php?email=' + email + '&userType=' + userType, true);
        xhr.send();
      }


</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
<!-- Vendor JS Files -->

<script src="assets/vendor/purecounter/purecounter_vanilla.js"> </script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</html>