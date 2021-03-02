<?php

include("config.php");

if (isset($_COOKIE['usercookie']) && !empty($_COOKIE['usercookie'])) {
    $cookie = $_COOKIE['usercookie'];
    $cookiequery = mysqli_query($con, "SELECT * FROM cookies WHERE cookie = '$cookie'");

    $row = mysqli_fetch_assoc($cookiequery);
    session_start();
    $_SESSION['userName'] = $row['username'];
    header("location: dashboard.php");
}


?>


<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Form</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/formhide.js"></script>
    <script type="text/javascript" src="js/register.js"></script>
</head>
<body>
<div class="container">

    <div id="buttons">
        <button class="btn btn-light" id="show_login">Login</button>
        <button class="btn btn-light" id="show_registrationform">Register</button>
    </div>

    <!-- //login Form -->

    <form id="loginForm" name="formLogin" action="login.php"
          method="post" onsubmit="return login()">
        <div class="row" id="form">
            <div class="col-md-6">
                <div class="alert" id="msg"></div>
                <h3 class="text-warning">Login</h3>
                <div class="form-group">
                    <label for="loginuserName" class="control-label">Username</label>
                    <div class="input-group">

                        <input type="text" name="userName" id="loginuserName" class="form-control"
                        autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="loginpassword">Password</label>
                    <div class="input-group">

                       
                        <input type="password" name="password" class="form-control" id="loginpassword"
                           autocomplete="off">
                    </div>
                </div>
                <div class="">
                    <button type="submit" name="loginButton" class="btn btn-primary btn-sm" id="loginButton">Login</button>
                </div>
                <br>

                <div class="form-check">
                    <input type="checkbox" name="rememberme" id="rememberme" class="form-check-input">
                    <label for="rememberme" style="cursor: pointer;">Remember Me</label>
                </div>

                <!-- <div class="text-success hasAccountText">
                    <span id="hideLogin">Dont have an account yet ? Sign Up here.</span>
                </div> -->
                <a href="forgetPasswordForm.php">
                    <span class="text-success forgetPassword">Forget Password</span></a>
            </div>
        </div>
    </form>


    <!-- //register Form -->
    <form method="post" name="formRegister" action="register.php" id="registerForm"
          onsubmit="return validation()">
        <div class="row">
            <div class="col-md-6">

                <h3 class="text-warning">Register Yourself</h3>

                <div class="form-group">
                    <label for="userName">Username</label>
                    <input type="text" name="userName" id="userName" class="form-control">
                    <span id="userNameError" class="text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" name="firstName" id="firstName" class="form-control">
                    <span id="firstNameError" class="text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="lastName" id="lastName" class="form-control">
                </div>

                <div class="email">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control">
                    <span class="text-muted" id="emailinfo">
              We'll never share your personal details</span><br>
                    <span id="emailError" class="text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control"
                           autocomplete="off">
                    <span id="passwordError" class="text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" name="confirmPassword" id="confirmPassword" class="form-control"
                           autocomplete="off">
                    <span id="confirmPasswordError" class="text-danger"></span>
                </div>

                <button type="submit" name="registerButton" class="btn btn-primary btn-sm">Confirm</button>

                <!-- <div class="text-danger hasAccountText">
                    <span id="hideRegister">Already have an account ? Log In here.</span>
                </div> -->
            </div>

        </div>
    </form>
</div>
</body>
</html>


<?php

if (isset($_POST['registerButton'])) {
    echo '<script>
  $(document).ready(function(){
    $("#loginForm").hide();
    $("#registerForm").show();
});
</script>';
} else {
    echo '<script>
  $(document).ready(function(){
    $("#loginForm").show();
    $("#registerForm").hide();
});
</script>';
}

?>
