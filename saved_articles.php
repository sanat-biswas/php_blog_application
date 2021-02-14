<?php 
session_start();
include 'config.php';
    
$articleid = $_GET['article_id'];
$userid = $_SESSION['loginid'];

$save_article_query = mysqli_query($con, "INSERT into saved_articles(userid, articleid)
    values('$userid', '$articleid')");

    if($save_article_query){
        echo "Done";
    }else{
        mysqli_connect_error();
    }
    