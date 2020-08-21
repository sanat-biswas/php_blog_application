<?php

session_start();
include("config.php");

$userName = $_SESSION['userName'];
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$email = $_SESSION['email'];
$encryptPassword = $_SESSION['password'];
$otp = $_SESSION['otpVerify'];


    if (!$otp && empty($otp)) {
        header("location: otpCheck.php");
    } else {
        $query = mysqli_query($con, "INSERT INTO register(username, firstname, lastname, email, password)
                   VALUES('$userName', '$firstName', '$lastName', '$email', '$encryptPassword')");
        if ($query) {

            header("location: registrationForm.php");
            
        } else {
            echo mysqli_error($con);
        }
    }

?>




