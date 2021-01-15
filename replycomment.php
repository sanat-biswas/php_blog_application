<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include("config.php");

if (isset($_POST['replyButton']) && !empty($_SESSION['loginid'])) {

    $replyComment = $_POST['replyComment'];
    $loginId = $_SESSION['loginid'];
    $commentId = $_POST['c_id'];

    $articleId = $_SESSION['articleid'];

    $replyQuery = mysqli_query($con, " INSERT INTO
                    reply(replies, loginid, commentid, articleid, createdon)
                        VALUES('$replyComment', '$loginId', '$commentId', '$articleId', now())");


    if ($replyQuery) {
        echo "Success";
    } else {
        echo mysqli_error($con);
    }

} else {
    echo "Error";
}




