<?php

session_start();
error_reporting(E_ALL & ~E_NOTICE);
include("config.php");

if (isset($_POST['like_button'])) {

    $liked = $_POST['like_input'];
    $userId = $_SESSION['loginid'];
    $articleId = $_SESSION['articleid'];

    $select_likes = mysqli_query($con, "SELECT * FROM like_table 
            WHERE articleid = '" . $_SESSION['articleid'] . "' and loginid='$userId'");
    $row = mysqli_fetch_array($select_likes);

    $dislike_query = mysqli_query($con, "SELECT * FROM dislike_table");
    $dislike_count = mysqli_fetch_assoc($dislike_query);
    $dislike_id = $dislike_count['dislike_id'];

    if (mysqli_num_rows($select_likes) > 0) {
        $delete_dislike_query = mysqli_query($con, "delete from like_table where loginid = '$userId' AND articleid='$articleId'");

    } else {
        $row['likes'] = 0;
        $likes_count = $row['likes'] + 1;

        $likeQuery = mysqli_query($con, "insert into like_table(likes, loginid, articleid) 
            values('$likes_count', '$userId', '$articleId')");

        $delete_dislike_query = mysqli_query($con, "delete from dislike_table 
                    where  loginid = '$userId'AND articleid='$articleId'");

    }


} else {
    echo "ERROR";
}
