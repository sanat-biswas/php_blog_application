<?php

session_start();

include("../config.php");

if(isset($_POST['commentInsert']) && !empty($_SESSION['loginid'])){
    $comment = $_POST['commentInsert'];
    $loginId = $_SESSION['loginid'];
    $articleId = $_SESSION['articleid'];

    $commentQuery = mysqli_query($con, "INSERT INTO comments(comment, loginid, articleid, createdon)
                VALUES('$comment', $loginId, $articleId, now())") ;

    if($commentQuery){
        $response = [
            "success" => true,
            "message" => "Comment inserted successfully",
            "comment_fetch" => $comment
        ];
    }else{
        $response = [
            "success" => false,
            "message" => "Please Try Again",
            "comment_fetch" => "Please enter again"
        ];
    }

    echo json_encode($response);
    die;

}
