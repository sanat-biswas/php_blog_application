<?php

session_start();
include("../config.php");

if (isset($_POST['dislike_data'])) {
    $dislikes = $_POST['dislike_data'];
    $userId = $_SESSION['loginid'];
    $articleId = $_SESSION['articleid'];

    $dislike_select_query = mysqli_query($con, "SELECT * from dislike_table where articleid = '$articleId' 
                  and loginid='$userId'");
    $dislike_row = mysqli_fetch_assoc($dislike_select_query);
    
    $likesQuery = mysqli_query($con, "SELECT * FROM like_table");
    $likeRow = mysqli_fetch_assoc($likesQuery);

    $likeDelete = $likeRow['likes'];
    // $likesCount = $likeRow['likes'] - 1;
    
    if (mysqli_num_rows($dislike_select_query) > 0) {
        $deleteLikes = mysqli_query($con, "DELETE from dislike_table where loginid = '$userId' and articleid='$articleId'");
        $delete_sql = mysqli_query($con, "SELECT count(dislikes) from dislike_table");
        $dis = mysqli_fetch_array($delete_sql);
        $dislike = $dis[0];

        $row_likes = mysqli_query($con, "SELECT count(likes) from like_table");
        $counts = mysqli_fetch_array($row_likes);
        $likes_count_dis = $counts[0];

        if ($delete_sql) {
            $response = [
                "success"=>true,
                "message"=>"disliked",
                "dislike_count"=>$dislike,
                "like_count"=>$likes_count_dis
            ];
        } else {
            $response = [
                "success"=>false,
                "message"=>"dislike unsuccessfull",
                "dislike_count"=>"null",
                 "like_count"=>null
            ];
        }
        
    } else {
        // $dislike_row['dislikes'] = 0;
        $dislike_count = $dislike_row['dislikes'] + 1;

        $dislike_query = mysqli_query($con, "INSERT into dislike_table(dislikes, loginid, articleid) 
          VALUES ('$dislike_count', '$userId', '$articleId')");

        $deleteLikes = mysqli_query($con, "DELETE from like_table where loginid = '$userId' and articleid='$articleId'");
        $fetch_dislikes = mysqli_query($con, "SELECT count(dislikes) from dislike_table");
        $row = mysqli_fetch_array($fetch_dislikes);
        $dislike_fetch = $row[0];

        $row_likes_dislike = mysqli_query($con, "SELECT count(likes) from like_table");
        $counts_dis = mysqli_fetch_array($row_likes_dislike);
        $likes_count_dislike = $counts_dis[0];

        if ($fetch_dislikes) {
                $response = [
                    "success"=>true,
                    "message"=>"success_dislike",
                    "dislike_count"=>$dislike_fetch,
                    "like_count"=>$likes_count_dislike
                ];
            } else {
                $response = [
                    "success"=>false,
                    "message"=>"success_dislike unsuccessfull",
                    "dislike_count"=>"0",
                    "like_count"=>null
                ];
            }
        }
        echo json_encode($response);
        die;
}
