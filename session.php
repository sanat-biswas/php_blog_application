<?php

if (!isset($_SESSION['userName']) || empty($_SESSION['userName'])) {
    header("Location:registrationForm.php");
}
