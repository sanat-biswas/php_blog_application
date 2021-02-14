<?php 

    include 'config.php';

    $select_saved_articles = mysqli_query($con, "SELECT * from saved_articles inner join register, article where saved_articles.userid = register.userid and saved_articles.articleid = article.id");

    if(mysqli_num_rows($select_saved_articles) > 0){
        while($row = mysqli_fetch_array($select_saved_articles)){
            $name = $row['articlename'];
            echo $name."<br>";
        }
    }else{
        echo "Nothing to show";
    }