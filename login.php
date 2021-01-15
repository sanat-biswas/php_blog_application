<?php
session_start();

    include("config.php");

//login form

  if (isset($_POST['loginButton'])) {
      $userName = mysqli_real_escape_string($con, $_POST['userName']);
      $password = mysqli_real_escape_string($con, $_POST['password']);

      $encryptPassword = md5($password);
      
      $query = mysqli_query($con, "SELECT * FROM register WHERE username = '$userName' AND
                password = '$encryptPassword'");
      
      if (mysqli_num_rows($query) > 0) {
          while ($row = mysqli_fetch_assoc($query)) {
              $_SESSION['userName'] = $userName;
              $_SESSION['loginid'] = $row['userid'];
              if (isset($_POST['rememberme'])) {
                  $cookie = mt_rand(1, 1000).time();
                  setcookie("usercookie", $cookie, time() + 3600 * 60);
                  $deletecookie = mysqli_query($con, "DELETE FROM cookies WHERE username = '$userName'");
                  $insertcookie = mysqli_query($con, "INSERT into cookies(cookie, username) 
                    VALUES('$cookie', '$userName')");
              }
              header("location: dashboard.php");
          }
      } else {
          echo "Invalid details";
      }
  }
