<?php

session_start();
include("../config.php");

if (isset($_POST['dislike_data'])) {
    $dislikes = $_POST['dislike_data'];
    $userId = $_SESSION['loginid'];
    $articleId = $_SESSION['articleid'];

    $dislike_select_query = mysqli_query($con, "select * from dislike_table where articleid = '$articleId' 
                  and loginid='$userId'");
    $dislike_row = mysqli_fetch_assoc($dislike_select_query);

    $likesQuery = mysqli_query($con, "SELECT * FROM like_table");
    $likeRow = mysqli_fetch_assoc($likesQuery);

    $likeDelete = $likeRow['like_id'];

    if (mysqli_num_rows($dislike_select_query) > 0) {
        $deleteLikes = mysqli_query($con, "delete from dislike_table where loginid = '$userId' AND articleid='$articleId'");

    } else {
        $dislike_row['dislikes'] = 0;
        $dislike_count = $dislike_row['dislikes'] + 1;

        $dislike_query = mysqli_query($con, "insert into dislike_table(dislikes, loginid, articleid) 
          VALUES ('$dislike_count', '$userId', '$articleId')");

        $deleteLikes = mysqli_query($con, "delete from like_table where loginid = '$userId' AND articleid='$articleId'");

        if($dislike_query){
            $response = [
                'success' => true,
                'message' => 'Likes Inserted'
            ];
        }else{
            $response = [
                'success' => false,
                'message' => 'Problem'
            ];
        }
        echo $dislike_count;
    }
} else {
    echo mysqli_error($con);
}