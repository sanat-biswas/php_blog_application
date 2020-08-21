<?php
session_start();

    include("config.php");


    if(isset($_POST['commentButton']) && !empty($_SESSION['loginid'])){
        $comment = $_POST['commentArea'];

        $commentQuery = mysqli_query($con, "INSERT INTO comments(comment, loginid, articleid, createdon) 
                VALUES('$comment', '".$_SESSION['loginid']."', '".$_SESSION['articleid']."', now())");

        if($commentQuery){
            header("location: dashboard.php");
        }else{
            echo "Commenting Error";
        }

    }
