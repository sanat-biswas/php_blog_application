<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/register.css"> -->

    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>

    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>
    
    <div class="container">
    <?php echo $_SESSION['otpVerify']; ?>
        <form action="confirmRegisterDetails.php" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="otp">OTP</label>
                        <input type="text" name="otp" id="otp" class="form-control" auto-complete="off">
                    </div>
                    <button type="submit" class="btn btn-outline-dark">Proceed</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>