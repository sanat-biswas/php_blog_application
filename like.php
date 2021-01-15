<?php

session_start();
error_reporting(E_ALL & ~E_NOTICE);
include("config.php");

if (isset($_POST['like_button'])) {
    $liked = $_POST['like_input'] = 0;

    $userId = $_SESSION['loginid'];
    $articleId = $_SESSION['articleid'];

    $select_likes = mysqli_query($con, "SELECT * FROM like_table 
            WHERE articleid = '" . $_SESSION['articleid'] . "' and loginid='$userId'");
    $row = mysqli_fetch_array($select_likes);

    $dislike_query = mysqli_query($con, "SELECT * FROM dislike_table");
    $dislike_count = mysqli_fetch_assoc($dislike_query);
    $dislike_id = $dislike_count['dislike_id'];

    if (mysqli_num_rows($select_likes) > 0) {
        $delete_query = mysqli_query($con, "delete from like_table where loginid =
        '$userId' AND articleid='$articleId'");

        $select_count_likes = mysqli_query($con, "SELECT count(dislikes) from dislike_table");
        $count = mysqli_fetch_array($select_count_likes);
        $dislike = $count[0];

        $row_likes = mysqli_query($con, "SELECT count(likes) from like_table");
        $counts = mysqli_fetch_array($row_likes);
        $likes_count_dis = $counts[0];

        echo $dislike;
        echo $likes_count_dis;
    } else {
        $likes_count = $liked + 1;

        $likeQuery = mysqli_query($con, "insert into like_table(likes, loginid, articleid) 
            values('$likes_count', '$userId', '$articleId')");

        $delete_dislike_query = mysqli_query($con, "delete from dislike_table 
                    where  loginid = '$userId' AND articleid='$articleId'");
        
        $select_likes = mysqli_query($con, "SELECT count(likes) from like_table");
        $count_likes = mysqli_fetch_array($select_likes);
        $likes = $count_likes[0];

        $select_count_dislikes = mysqli_query($con, "SELECT count(dislikes) from dislike_table");
        $count_dislikes = mysqli_fetch_array($select_count_dislikes);
        $dislike_ = $count_dislikes[0];

        echo $dislike_;
        echo $likes;
    }
} else {
    echo "ERROR";
}
