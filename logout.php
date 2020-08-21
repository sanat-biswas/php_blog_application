<?php
session_start();
session_destroy();

setcookie("usercookie", "", time() - 3600);
header("location: registrationForm.php");

?>