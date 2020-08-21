<?php 

    include("config.php");

    if(isset($_POST['submit'])){

        $newPassword = $_POST['newPassword'];
        $confirmNewPassword = $_POST['confirmNewPassword'];

        $encryptedPassword = md5($newPassword);
        $encryptedConfirmPassword = md5($confirmNewPassword);

        if($encryptedPassword == $encryptedConfirmPassword){
            $query = mysqli_query($con, "UPDATE register SET password = '$encryptedPassword' 
                            where userid = '".$_SESSION['loginid']."'");
        }else{
            echo mysqli_error($con);
        }

        
    }

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" id="password">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                    </div>

                    <button class="btn btn-primary" id="forget_button" name="forget_button">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
