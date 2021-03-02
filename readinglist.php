<?php
session_start();
    include 'config.php';
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <h1 class="text-capitalize text-center" style="padding-top: 50px;">Reading List</h1>

    <?php

    $id = $_SESSION['loginid'];

    $select_saved_articles = mysqli_query($con, "SELECT * from saved_articles inner join register, article where  saved_articles.articleid = article.id  and saved_articles.userid = '$id'");

    if (mysqli_num_rows($select_saved_articles) > 0) {
        while ($row = mysqli_fetch_array($select_saved_articles)) {
            $article_name = $row['articlename'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname']; ?>

            <div class="container">
                <div class="row" id="row-id">
                    <div class="clo-md-2"></div>
                    <div class="col-md-8">
                        <table class="table">
                            <tr>
                                <td>
                                    <a href="articleFetch.php?id=<?php echo $row['id']; ?>">
                                        <?php echo $article_name."<br>"; ?>
                                    </a>
                                    <p class="text-danger"><?php echo $firstname. ' '.$lastname; ?></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <?php
        }
    } else {
        echo "Nothing to show";
    }
?>

</body>
    </html>