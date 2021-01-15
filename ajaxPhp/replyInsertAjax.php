<?php

session_start();
include("../config.php");

if (isset($_POST['commentReply']) && !empty($_SESSION['loginid'])) {

    $replyComment = $_POST['commentReply'];
    $loginId = $_SESSION['loginid'];
    $commentId = $_POST['commentInputId'];

    $articleId = $_SESSION['articleid'];

    $replyQuery = mysqli_query($con, "INSERT INTO
                    reply(replies, loginid, commentid, articleid, createdon)
                        VALUES('$replyComment', '$loginId', '$commentId', '$articleId', now())");

    if($replyQuery){
        $response = [
            "success" => true,
            "message" => "Reply inserted successfully",
            "reply_id" => $commentId,
            "reply" => $replyComment
        ];
    }else{
        $response = [
            "success" => false,
            "message" => "Please Try Again",
            "reply_id" => null,
            "reply" => null
        ];
    }
    echo json_encode($response);
    die;
}