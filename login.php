<?php
if(isset($_POST['submit'])){
  $username=$_POST['username'];
  $password=md5($_POST['password']);
  $sql="SELECT L_id,L_type_id,L_status FROM tbl_login WHERE  L_uname='$username' AND L_pass='$password'";
  require_once "connect.php";
  $result=$conn->query($sql);
  if($result->num_rows>0){
    $row = $result->fetch_assoc();
    $L_id=$row['L_id'];
    $L_type_id=$row['L_type_id'];
    $L_status=$row['L_status'];
    session_start();
    $_SESSION['L_id']=$L_id;
    if($L_status==1){
      if($L_type_id==1){
        header("Location: dashboard.php");
      }else if($L_type_id==2){
        header("Location: index.html");
      }
      else if($L_type_id==3){
        header("Location: index.html");
      }
    }
    else{
      echo "Your profile blocked by admin";
    }
  }
  else{
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
  title: "Invalid Credentials..!",
  text: "Something went wrong!",
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

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script>
    window.onbeforeunload = function() {
    // Reload the page
    window.location.reload(true); // Pass true to force a reload from the server and not from the cache
};
window.onload = function() {
    // Clear the form data
    document.getElementById("myForm").reset(); // Replace "loginForm" with the ID of your login form
};

     document.getElementById("login-form").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the form from submitting normally
    
    // Perform login validation, for example, using AJAX
    
    // Assuming login is successful, reset the form
    resetLoginForm();
});
  </script>
  
    <style>
      body {
  background-color: #f6f7fc; 

   overflow-y: hidden;}


p {
  color: #b3b3b3;
  font-weight: 300; }
  label {
      padding: 5px;
    }

a {
  -webkit-transition: .3s all ease;
  -o-transition: .3s all ease;
  transition: .3s all ease; }
  a:hover {
    text-decoration: none !important; }

.content {
  padding: 7rem 0; }

h2 {
  font-size: 20px; }

.half, .half .container > .row {
  height: 100vh;
  min-height: 900px; }

.half .contents {
  background: #f6f7fc; }

.half .bg {
  width: 25%; }
  @media (max-width: 767.98px) {
    .half .bg {
      width: 100%;
      height: 200px; } }

.half .contents {
  width: 75%; }
  @media (max-width: 767.98px) {
    .half .contents {
      width: 100%; } }

.half .contents .form-control, .half .bg .form-control {
  border: none;
  border-radius: 4px;
  height: 54px;
  background: #efefef; }
  .half .contents .form-control:active, .half .contents .form-control:focus, .half .bg .form-control:active, .half .bg .form-control:focus {
    outline: none;
    -webkit-box-shadow: none;
    box-shadow: none; }

.half .bg {
  background-size: cover;
  background-position: center; }

.half a {
  color: #888;
  text-decoration: underline; }

.half .btn {
  height: 54px;
  padding-left: 30px;
  padding-right: 30px; }

.half .forgot-pass {
  position: relative;
  top: 2px;
  font-size: 14px; }

.form-block {
  background: #fff;
  padding: 40px;
  max-width: 400px;
  -webkit-box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.2);
  box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.2); }
  @media (max-width: 767.98px) {
    .form-block {
      padding: 25px; } }

.control {
  display: block;
  position: relative;
  padding-left: 30px;
  margin-bottom: 15px;
  cursor: pointer;
  font-size: 14px; }
  .control .caption {
    position: relative;
    top: .2rem;
    color: #888; }

.control input {
  position: absolute;
  z-index: -1;
  opacity: 0; }

.control__indicator {
  position: absolute;
  top: 2px;
  left: 0;
  height: 20px;
  width: 20px;
  background: #e6e6e6;
  border-radius: 4px; }

.control--radio .control__indicator {
  border-radius: 50%; }

.control:hover input ~ .control__indicator,
.control input:focus ~ .control__indicator {
  background: #ccc; }

.control input:checked ~ .control__indicator {
  background: #fb771a; }

.control:hover input:not([disabled]):checked ~ .control__indicator,
.control input:checked:focus ~ .control__indicator {
  background: #fb8633; }

.control input:disabled ~ .control__indicator {
  background: #e6e6e6;
  opacity: 0.9;
  pointer-events: none; }

.control__indicator:after {
  font-family: 'icomoon';
  content: '\e5ca';
  position: absolute;
  display: none;
  font-size: 16px;
  -webkit-transition: .3s all ease;
  -o-transition: .3s all ease;
  transition: .3s all ease; }

.control input:checked ~ .control__indicator:after {
  display: block;
  color: #fff; }

.control--checkbox .control__indicator:after {
  top: 50%;
  left: 50%;
  margin-top: -1px;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%); }

.control--checkbox input:disabled ~ .control__indicator:after {
  border-color: #7b7b7b; }

.control--checkbox input:disabled:checked ~ .control__indicator {
  background-color: #7e0cf5;
  opacity: .2; }
  #erpassword{
  font-size: small;
  color: red;
}

    </style>

    <title>Login</title>
    <script>clearForm()</script>
  </head>
  <body>
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
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
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
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
  

  <div class="d-md-flex  half" >
    <div class="bg" style="background-image: url('images/post.png'); height: 800px; width: 600px;"></div>
    <div class="contents" >

      <div class="container " >
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12" style="padding-bottom: 15%;">
            <div class="form-block mx-auto" >
              <div class="text-center">
              <h3>Login</h3>
              </div>
              <form action="#" method="POST" onsubmit="return validateForm()" id="myForm">
                <div class="form-group first">
                  <label>Email</label>
                  <input type="text" class="form-control"  id="username" name="username">
                </div>
                <div class="form-group last mb-3">
                  <label>Password</label>
                  <input type="password" class="form-control"  id="password" name="password" onblur="validatePassword()" oninput="validatePassword()">
                  <label class="error" id="erpassword"></label>
                </div>
                
                <div class="d-sm-flex mb-5 align-items-center">
                  <label class="control control--checkbox mb-3 mb-sm-0"><span class="caption">Not a consumer <a href="register.html">New connection</a></span>
                  </label>
                </div>

                <input type="submit" name="submit" value="Login" class="btn btn-primary" >

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    
  </div>
 <script>
 
  function resetLoginForm() {
    // Clear the form fields
    document.getElementById("myForm").reset();
}

  function validatePassword() {
  var password = document.getElementById('password').value;
  var erpassword = document.getElementById('erpassword');
  
  // Define password strength criteria
  var minLength = 8;
  var hasUpperCase = /[A-Z]/.test(password);
  var hasLowerCase = /[a-z]/.test(password);
  var hasNumber = /\d/.test(password);
  var hasSpecialChar = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(password);

  // Check password strength
  if (password.length < minLength) {
    erpassword.textContent = 'Password should be at least ' + minLength + ' characters long';
  } else if (!(hasUpperCase && hasLowerCase && hasNumber && hasSpecialChar)) {
    erpassword.textContent = 'Password Incorrect';
  } else {
    erpassword.textContent = '';
  }
}
function validateForm() {
  validatePassword();
  var errors = document.querySelectorAll('.error');
    for (var i = 0; i < errors.length; i++) {
      if (errors[i].textContent !== '') {
        return false;
      }
    }
    return true;
  }

 </script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
 crossorigin="anonymous"></script>
 <script>
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