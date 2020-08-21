<?php
/**
 * Created by PhpStorm.
 * User: raj
 * Date: 7/26/2020
 * Time: 12:39 PM
 */
session_start();

include("../config.php");

if(isset($_POST['commentInsert']) && !empty($_SESSION['loginid'])){
    $commentInsert = $_POST['commentInsert'];
    $loginId = $_SESSION['loginid'];
    $articleId = $_SESSION['articleid'];


    $commentQuery = mysqli_query($con, "INSERT INTO comments(comment, loginid, articleid, createdon) 
                VALUES('$commentInsert', $loginId, $articleId, now())") ;

    if($commentQuery){
        $response = [
            "success" => true,
            "message" => "Comment inserted successfully"
        ];
    }else{
        $response = [
            "success" => false,
            "message" => "Please Try Again"
        ];
    }

    echo json_encode($response);
    die;

}