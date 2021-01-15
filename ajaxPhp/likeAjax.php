<?php

session_start();
error_reporting(E_ALL & ~E_NOTICE);
include("../config.php");

if (isset($_POST['likes_data'])) {
    $liked = $_POST['likes_data'];
    $userId = $_SESSION['loginid'];
    $articleId = $_SESSION['articleid'];

    $select_likes = mysqli_query($con, "SELECT * FROM like_table 
            WHERE articleid = '" . $_SESSION['articleid'] . "' and loginid='$userId'");
    $row = mysqli_fetch_array($select_likes);


    $dislike_fetch_query = mysqli_query($con, "SELECT * FROM dislike_table");
    $dislike_count = mysqli_fetch_assoc($dislike_fetch_query);
    $dislike_id = $dislike_count['dislike_id'];

    if (mysqli_num_rows($select_likes) > 0) {
        $delete_query = mysqli_query($con, "delete from like_table where loginid =
        '$userId' AND articleid='$articleId'");

        $select_count_dislikes = mysqli_query($con, "SELECT count(dislikes) from dislike_table");
        $count = mysqli_fetch_array($select_count_dislikes);
        $dislike = $count[0];

        $row_likes = mysqli_query($con, "SELECT count(likes) from like_table");
        $counts = mysqli_fetch_array($row_likes);
        $likes_count_dis = $counts[0];

        if ($delete_query) {
            $response = [
                "success"=>true,
                "message"=>"disliked",
                "dislike_count"=>$dislike,
                "like_count" =>$likes_count_dis
            ];
        } else {
            $response = [
                "success"=>false,
                "message"=>"dislike unsuccessfull",
                "dislike_count"=>"null",
                "like_count" =>null
            ];
        }
        echo json_encode($response);
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

        if ($select_likes) {
            $response = [
                    "success"=>true,
                    "message"=>"liked",
                    "like_count"=>$likes,
                    "dislike_count"=> $dislike_
                ];
        } else {
            $response = [
                    "success"=>false,
                    "message"=>"like unsuccessfull",
                    "like_count"=>"0",
                    "dislike_count"=> null
                ];
        }
        echo json_encode($response);
        die;
    }
}
