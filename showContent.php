<?php
session_start();

include "config.php";

if (isset($_POST['submit']) && !empty($_SESSION['loginid'])) {

    $articleName = $_POST['articleName'];

    $image = $_FILES['image']['name'];
    $imagetmpName = $_FILES['image']['tmp_name'];
    $articleContent = $_POST['articleContent'];

    if (empty($articleName)) {
        echo "name required";
    } if (empty($articleContent)) {
        echo "content Required";
    }if(empty($image)){
        echo "Image Required";
    }
    
    else {

        $path = "articleContent/";

        $fileName = $path . $articleName . '.txt';
        $file = fopen($fileName, 'w');

        $imagePath = "articleContent/image/" . $image;
        move_uploaded_file($imagetmpName, $imagePath);
        $writeFile = fwrite($file, $articleContent);

        $query = mysqli_query($con, "INSERT INTO article(articlename, articlecontent, imagepath, userid) VALUES('$articleName', '$fileName', '$imagePath', '" . $_SESSION['loginid'] . "')");

        if ($query) {
            header("location: dashboard.php");
        } else {
            echo "Error";
        }
        fclose($file);
    }
}
