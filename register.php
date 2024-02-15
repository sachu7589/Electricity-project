<?php
  if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $ph=$_POST['ph'];
    $email=$_POST['email'];
    $so=$_POST['so'];
    $po=$_POST['po'];
    $housename=$_POST['housename'];
    $street=$_POST['street'];
    $city=$_POST['city'];
    $houseno=$_POST['houseno'];
    $district=$_POST['district'];
    $area=$_POST['area'];
    $type=$_POST['type'];
    $idproof=$_POST['idproof'];
    $bulproof=$_POST['bulproof'];
    $password=md5($_POST['password']);
    
    require_once "connect.php";
    $sql="SELECT type_id FROM tbl_User_Types WHERE type_name='Consumer';";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    $L_type_id=$row['type_id'];
    $sql="SELECT L_uname FROM tbl_login WHERE L_uname='$email' AND L_type_id='$L_type_id';";
    $result=$conn->query($sql);
    if ($result->num_rows > 0) {
      ?>
      <script>
        document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('errorMessage').innerHTML = "Email Already exists";
});
      </script>
      <?php
    }else{
    $sql="INSERT INTO tbl_login (L_uname,L_pass,L_type_id) VALUES ('$email','$password','$L_type_id');";
    $conn->query($sql);

    $sql="SELECT L_id FROM tbl_login WHERE  L_uname='$email';";
    $res=$conn->query($sql);
    $userdata=$res->fetch_assoc();
    $Con_L_id=$userdata['L_id'];

    $sql="INSERT INTO tbl_connection(Con_L_id,Con_name,Con_email)VALUES('$Con_L_id','$fname','$email');";
    if($conn->query($sql)===TRUE){
      include "success.php";
    }
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <style>
    body {
      font-family: "Roboto", sans-serif;
      background-color: #f8f4f4;
    }

    p {
      color: #33d2e4;
      font-weight: 300;
    }


    a {
      -webkit-transition: .3s all ease;
      -o-transition: .3s all ease;
      transition: .3s all ease;
    }

    a:hover {
      text-decoration: none !important;
    }

    label {
      padding: 2px;
    }

   

    h2 {
      font-size: 20px;
    }

    .half,
    .half .container>.row {
      height: 100vh;
      min-height: 900px;
    }

    @media (max-width: 991.98px) {
      .half .bg {
        height: 200px;
      }
    }

    .half .contents {
      background: #f8f4f4;
    }

    .half .contents {
      width: 80%;
    }

    .half .bg {
      width: 20%;
    }

    @media (max-width: 991.98px) {

      .half .contents,
      .half .bg {
        width: 100%;
      }
    }

    .half .contents .form-control,
    .half .bg .form-control {
      border: none;
      -webkit-box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
      box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
      border-radius: 4px;
      height: 54px;
      background: #ffffff;
    }

    .half .contents .form-control:active,
    .half .contents .form-control:focus,
    .half .bg .form-control:active,
    .half .bg .form-control:focus {
      outline: none;
      -webkit-box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
      box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
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
      background-color: #bd92eb;
      opacity: .2;
    }
#erfname,
#erpassword,
#ertype,
#erarea,
#erdistrict,
#erhouseno,
#erstreet,
#erhousename,
#erpo,
#eridproof,
#ercity,
#erbulproof,
#erso,
#erlname,
#erph,
#eremail
#errorMessage {
  font-size: small;
  color: red;
}
.err{
  font-size: small;
  color: red;
}

  </style>

  <title>New connection</title>
</head>

<body>


  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2"
      style="background-image: url('images/bg3.jpg'); height: 500px; width: 400px; padding-top: 30%; margin-top: 200px;">
    </div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7 py-5">
            <h3 style="padding-bottom: 50px;">
              <center>New Connection</center>
            </h3>

            <form action="#" method="POST" onsubmit="return validateForm()">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label>First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" onblur="validateFirstName()" oninput="validateFirstName()">
                    <label class="error" id="erfname"></label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label>Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname" onblur="validateLastName()" oninput="validateLastName()">
                    <label class="error" id="erlname"></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label>Phone Number</label>
                    <input type="text" class="form-control" id="ph" name="ph" onblur="validatePhoneNumber()" oninput="validatePhoneNumber()">
                    <label class="error" id="erph"></label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label>Email</label>
                    <input type="email" class="form-control" id="email" name="email" onblur="validateEmail1()" oninput="validateEmail()" onkeyup="" >
                    <label class="error" id="eremail"></label>
                    <label class="err" id="errorMessage" style="font-size: small; color: red;"></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label>S/O</label>
                    <input type="text" class="form-control" id="so" name="so" onblur="validateSonOf()" oninput="validateSonOf()">
                    <label class="error" id="erso"></label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label>Postal code</label>
                    <input type="number" class="form-control" id="po" name="po" onblur="validatePostalCode()" oninput="validatePostalCode()">
                    <label class="error" id="erpo"></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
                    <label>House Name</label>
                    <input type="text" class="form-control" id="housename" name="housename" onblur="validateHouseName()" oninput="validateHouseName()">
                    <label class="error" id="erhousename"></label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">

                  <div class="form-group last mb-3">
                    <label>Street name</label>
                    <input type="text" class="form-control" id="street" name="street" onblur="validateStreetName()" oninput="validateStreetName()">
                    <label class="error" id="erstreet"></label>
                  </div>
                </div>
                <div class="col-md-6">

                  <div class="form-group last mb-3">
                    <label>City</label>
                    <input type="text" class="form-control" id="city" name="city" onblur="validateCity()" oninput="validateCity()">
                    <label class="error" id="ercity"></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">

                  <div class="form-group last mb-3">
                    <label>House no</label>
                    <input type="text" class="form-control" id="houseno" name="houseno" onblur="validateHouseNumber()" oninput="validateHouseNumber()">
                    <label class="error" id="erhouseno"></label>
                  </div>
                </div>
                <div class="col-md-6">

                  <div class="form-group last mb-3">
                    <label>Distrct</label>
                    <select class="form-select" aria-label="Default select example" id="district" name="district">
                      <option value="null" selected>Choose</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                    <label class="error"  id="erdistrict"></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">

                  <div class="form-group last mb-3">
                    <label>Choose Area </label>
                    <select class="form-select" aria-label="Default select example" id="area" name="area" onblur="validateArea()" oninput="validateArea()">
                      <option value="null" selected>Choose</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                    <label class="error" id="erarea"></label>
                  </div>
                </div>
                <div class="col-md-6">

                  <div class="form-group last mb-3">
                    <label for="re-password">Connection type</label>
                    <select class="form-select" aria-label="Default select example" id="type" name="type" onblur="validateConnectionType()" oninput="validateConnectionType()">
                      <option value="null"  selected>Choose</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                    <label class="error" id="ertype"></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">

                  <div class="input-group last mb-3">
                    <label>Proof of identity</label>
                    <div class="input-group">
                      <input type="file" class="form-control" aria-label="Upload" id="idproof" name="idproof" onblur="validateProofOfIdentity()" oninput="validateProofOfIdentity()">
                    </div>
                    <label class="error" id="eridproof"></label>
                  </div>
                </div>
                <div class="col-md-6">

                  <div class="form-group last mb-3">
                    <label>Proof Building approal </label>
                    <div class="input-group">
                      <input type="file" class="form-control" aria-label="Upload" id="bulproof" name="bulproof" onblur="validateBuildingApprovalProof()" oninput="validateBuildingApprovalProof()">
                    </div>
                    <label class="error" id="erbulproof"></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">

                  <div class="form-group last mb-3">
                    <label>Password</label>
                    <input type="password" class="form-control" id="password" name="password" onblur="validatePassword()" oninput="validatePassword()">
                    <label class="error" id="erpassword"></label>
                  </div>
                </div>
                <div class="col-md-6">

                  <div class="form-group last mb-3">
                    <label for="re-password">Re-type Password</label>
                    <input type="password" class="form-control" id="re-password" onblur="validatePassword()" oninput="validatePassword()">
                  </div>
                </div>
              </div>

              <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <input type="submit" value="Apply" class="btn px-5 btn-secondary" name="submit" >
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>


  </div>
  <script>
    function validateEmail1() {
    var email = document.getElementById('email').value;
    var errorMessage = document.getElementById('eremail');
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            errorMessage.innerHTML = response;
        }
    };

    xhr.open('GET', 'check_email.php?email=' + email, true);
    xhr.send();
}

function clearEmailError() {
    document.getElementById('eremail').innerHTML = "";
}

  </script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>