<?php

    session_start();
    include('config.php');
    print_r($_SESSION);
    
    if (isset($_POST['follow_user']) && !empty($_SESSION['loginid'])) {
        $userid = $_SESSION['loginid'];
        
        $status = $_POST['status'];
        
        echo $userid;
        $query = mysqli_query(
            $con,
            "INSERT into followers(follow_status, login_id) values('$status', '$userid')"
        );

        if ($query) {
            echo "Successfully followed";
        } else {
            echo "Error";
        }
    } else {
        echo "Error";
    }
