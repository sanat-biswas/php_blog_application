<?php

session_start();

  include("config.php");

  //registration form
  if (isset($_POST['registerButton'])) {
      $userName = mysqli_real_escape_string($con, $_POST['userName']);
      $_SESSION['userName'] = $userName;
    
      $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
      $_SESSION['firstName'] = $firstName;

      $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
      $_SESSION['lastName'] = $lastName;

      $email = mysqli_real_escape_string($con, $_POST['email']);
      $_SESSION['email'] = $email;

      $password = mysqli_real_escape_string($con, $_POST['password']);
    
      $confirmPassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);

      $otp = rand(100000, 999999);

      $to = $email;
      $subject = "OTP for verification";

      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
      // Create email headers
      $headers .= 'From: webdeveloper264@gmail.com'."\r\n".
    'Reply-To: webdeveloper264@gmail.com'."\r\n" .
    'X-Mailer: PHP/' . phpversion();

      $message = '<html><body>';
      $message .= '<h1 style="color:#f40;">Otp for verification</h1>';
      $message .= '<p style="color:#080;font-size:16px;">Hi,'.$userName."<br>Your one time password is: "
                    .$otp.' and password is'.$password.'</p>';
      $message .= '<p style="color:#000;font-size:12px;">Please do not share it with anyone.</p>';

      $message .= '</body></html>';

      $_SESSION['otpVerify'] = $otp;

      $encryptPassword = md5($password);
      $_SESSION['password'] = $encryptPassword;

      $encryptConfirmPassword = md5($confirmPassword);
      $_SESSION['confirmPassword'] = $encryptConfirmPassword;


      if (empty($userName)) {
          echo "Username required";
      } elseif (!preg_match("/^[A-Za-z0-9]+$/", $userName)) {
          echo "Only characters and numbers allowed in username";
      } elseif (empty($firstName)) {
          echo "Firstname required";
      } elseif (empty($email)) {
          echo "Email required";
      } elseif (empty($password)) {
          echo "password required";
      } elseif (empty($confirmPassword)) {
          echo "Confirm Password required";
      } elseif (!preg_match("/(?=.\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]/", $password)) {
          echo "password should contain letter, number and special characters";
      } else {
          if ($encryptPassword == $encryptConfirmPassword) {
              mail($to, $subject, $message, $headers);

              header("location:otpCheck.php");
          } else {
              echo mysqli_error($con);
          }
      }
  }
