<?php

include("config.php");

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    $forgetQuery = mysqli_query($con, "select email from register");
    if (mysqli_num_rows($forgetQuery) > 0) {
        $otp = rand(10000, 99999);
        $to = $email;
        $subject = "OTP for password change";
        $header = 'MIME-Version: 1.0' . "\r\n";
        $header .= 'Content-type: text/html; charset = iso-8859-1' . "\r\n";

        $header .= 'From: webdeveloper264@gmail.com' . "\r\n" .
            'Reply-To: webdeveloper264@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $message = '<html><body>';
        $message .= '<h1 style="color:#f40;">Otp for verification</h1>';
        $message .= '<p style="color:#080;font-size:16px;">Hi,' . $email . "<br>Your one time password is: "
            . $otp . '</p>';
        $message .= '<p style="color:#000;font-size:12px;">Please do not share it with anyone.</p>';

        $message .= '</body></html>';

        header("location: forgetPassword.php");
    } else {
        header("location: forgetAccountForm.php");
    }
}