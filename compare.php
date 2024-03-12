<?php
// Retrieve the entered OTP value from AJAX POST request
$enteredOTP = $_POST['enteredValue'];

// Retrieve the generated OTP from session variable
session_start();
$generatedOTP = $_SESSION['otp'];
$_SESSION['otp']="matched";
// Compare the entered OTP with the generated one
if ($enteredOTP == $generatedOTP) {
    echo "matched";
} else {
    echo "not_matched";
}
?>
