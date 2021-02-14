<?php
session_start();

include("config.php");
$id = $_GET['id'];         //article id

$query = mysqli_query($con, "SELECT * FROM article WHERE id = '$id'");
while ($row = mysqli_fetch_array($query)) {
    $_SESSION['articleid'] = $id;

    print_r($_SESSION);
    
    $fileName = $row['articlename'];
    $articleContent = $row['articlecontent'];
    $imagePath = $row['imagepath'];

    $readFile = fopen($articleContent, 'r');

    $read = fread($readFile, filesize($articleContent)); ?>


<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $fileName; ?></title>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/commentForm.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/all.min.css"/> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--    <link rel="stylesheet" href="css/all.min.css"/>-->
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>

    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/formhide.js"></script>
</head>
<body id='body'>
<div class="container-fluid">

<nav class="navbar navbar-expand-lg navbar-light" id="bgcolor">
        <a class="navbar-brand" href="dashboard.php">Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
        data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link text-muted" href="dashboard.php">Home</a>
                </li>

            </ul>

            <div class="nav nav-link">

                <div class="dropdown">
                    <a type="text" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <i class="fa fa-user-circle fa-lg user-icon" aria-hidden="true" style="cursor: pointer;"></i>
                    </a>
                    <?php

                    if (isset($_SESSION['userName'])) {
                        ?>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <span class="dropdown-item"><?php echo $_SESSION['userName']; ?></span>
                        <a class="text-danger dropdown-item" href="insertForm.php">Write Views</a>

                        <?php
                    } ?>
                        <a class="dropdown-item" href="logout.php">Logout</a>

                    </div>
                </div>

            </div>

            <form class="form-inline my-2 my-lg-0" action="results.php" method="POST">
                <input class="form-control mr-sm-2" name="search" type="search"
                       id="search" placeholder="Search" aria-label="Search">

                <button class="btn btn-success my-2 my-sm-0" name="searchButton"
                        id="searchbutton" type="submit">Search
                </button>
            </form>
        </div>
    </nav>

    <div class="row">
        <div class=" col-md-10 mx-auto">
            <div id="hide_article">

            <?php
                $article_author_query = mysqli_query($con, "SELECT article.*, register.* from article inner join register on article.userid = register.userid and article.id = '$id'");

                if(mysqli_num_rows($article_author_query) > 0){
                    $article_author = mysqli_fetch_array($article_author_query);
                    $first_name = $article_author['firstname'];
                    $last_name = $article_author['lastname'];
                    echo '<p class="text-danger font-weight-bold">Author: '.$first_name.' '.$last_name.'</p>';
                }
            ?>
                <h3 class="text-danger"><?php echo $fileName; ?></h3>
                <img src='<?php echo $imagePath; ?>' alt=''
                                class='img-thumbnail img-fluid float-left'>
                <div class="text-dark font_name"><?php echo $read; ?></div>

                <?php fclose($readFile);
}?>
            </div>
            <div style="cursor: pointer;" id="article_likes">
               
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="submit_likes">

                    <div id='likes_dislikes'>
                        <?php
                        $var = 0;
                        $select_likes = mysqli_query($con, "SELECT count(likes) from like_table
                                where articleid = '$id'");
                        if (mysqli_num_rows($select_likes)) {
                            while ($like_row = mysqli_fetch_array($select_likes)) {
                                $likes_count = $like_row[0];
                                echo $likes_count;
                            }
                        }
                        ?>
                        
                        <input type="hidden" name="like_input" id="like_input" class="like_input" value="<?php echo $var;?>"/>
                        <button type="submit" name="like_button" id="like_button"
                                class="fa fa-thumbs-o-up" formaction="like.php"></button>

                        <?php
                        $select_dislikes = mysqli_query($con, "SELECT count(dislikes) from dislike_table
                                where articleid = '$id'");
                        if (mysqli_num_rows($select_dislikes)) {
                            while ($dislike_row = mysqli_fetch_array($select_dislikes)) {
                                $dislikes_count = $dislike_row[0];
                                echo $dislikes_count;
                            }
                        }
                        ?>
                        <input type="hidden" name="dislike_input" id="dislike_input"/>
                        <button type="submit" name="dislike_button" id="dislike_button"
                            class="fa fa-thumbs-o-down" formaction="dislikes.php"></button>
                    </div>

                </form>


                <?php

                    $follower_query = mysqli_query($con, "SELECT article.*, register.* from article join register on article.userid = register.userid and article.id = '$id'");
                    
                    if (mysqli_num_rows($follower_query) > 0) {
                        while ($follow_user = mysqli_fetch_array($follower_query)) {

                            if ($_SESSION['userName'] == $follow_user['username']) {
                                echo '
                            <!-- follow -->
                            <div class="form-group">
                                    <button type="submit" name="follow_user" id=""
                                            class="btn btn-warning" disabled>Followers</button>
                            </div>
                            ';
                            } else {
                                echo '<div class="form-group">
                                <form action="follow.php" method="post">
                                    <input type="hidden" name="status" value="0">
                                    <a href="follow.php" class="btn btn-outline-success follow_user" id="follow_user" name="follow_user">Follow</a>
                                </form>
                            </div>';
                            }
                        }
                    }
                    
                ?>

                
            </div>
        </div>
    </div>

    <div class="row" id="row_hide">
        <div class="col-md-10 mx-auto commentFontSize">
            <span class="btn text-primary" id="hide">Comment Area
                    <img src="images/arrow.ico" id="arrow_img"> </span>

            <div class="hideform col-md-8">

                <div id="toggleComments" class="font-weight-bold text-success">Post Your comment
                    <img src="images/arrow.ico" id="arrow_img">
                </div>

                <form action="insertComments.php" method="post" id="commentForm">
                    <div class="form-group" id="hideComment">
                        <textarea class="form-control" name="commentArea" id="commentArea"
                                  style="resize: none;"></textarea>
                    </div>
                    <button type="submit" name="commentButton" id="commentButton"
                        class="btn btn-outline-danger">
                        Post
                    </button>
                </form>


                <span class="font-weight-bold text-danger" id="showcomments">Comments</span>

                <!-- comment Area -->
                <div id='showComments'>

                    <?php
                        $commentFetchQuery = mysqli_query($con, "SELECT * from comments inner join register
                    where articleid = '$id' and comments.loginid = register.userid order by createdon");

                    if (mysqli_num_rows($commentFetchQuery) > 0) {
                        while ($comments = mysqli_fetch_assoc($commentFetchQuery)) {
                            $c_id = $comments['id'];
                            $comment = $comments['comment'];
                            $firstname = $comments['firstname'];
                            $lastname = $comments['lastname'];
                            $date = $comments['createdon']; ?>

                            <div class="commentAjax">

                            <?php

                            echo "<p class='text-capitalize font-weight-bold' id='commentDom' class='commentDom'>" . $comment . ' ' . $date . "</p>";
                            echo "<p class='text-primary bg-light'>By: " .
                                $firstname . ' ' . $lastname .
                                "</p>";
                            echo "On: " . $date; ?>

                            <div class="replyArea text-dark" id="replyArea" style="margin: 30px; ">

                    <span class="replies"> Reply
                        <img src="images/arrow.ico" id="reply_arrow_img"
                             style="width: 20px; height: 20px; cursor: pointer"/>
                    </span>

                                <form action="replycomment.php" method="post" id='replyForm' class="replyForm">
                                    <div class="form-group">
                                        <input type="hidden" name="c_id" class="form-control c_id" id="c_id"
                                          value="<?php echo $c_id; ?>"/>
                                        <textarea name="replyComment" id="replyComment"
                                                  class="form-control replyComment" style="resize: none;"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary replyButton"
                                            name="replyButton" id="replyButton"> Reply
                                    </button>
                                </form>

                                <?php
                                $replyQuery = mysqli_query($con, "SELECT DISTINCT reply.*,
                                          register.* FROM reply inner join comments, register
                                WHERE reply.commentid = $c_id and reply.articleid = '$id'
                                 and reply.loginid = register.userid order by createdon  ");

                            if (mysqli_num_rows($replyQuery)) {
                                while ($reply = mysqli_fetch_assoc($replyQuery)) {
                                    $replyComment = $reply['replies'];
                                    $firstName = $reply['firstname'];
                                    $lastName = $reply['lastname'];
                                    $replyDate = $reply['createdon'];

                                    echo "<div id='show_reply_$c_id'>";
                                    echo "<div class='font-weight-bold'>" . $firstName . ' ' .
                                            $lastName .' '. $replyDate . "</div>";
                                    echo "<div class='text-capitalize' id='_r'>" .
                                            $replyComment . "</div>";
                                    echo "</div>";
                                }
                            } ?>
                            </div>
                          </div>
                            <?php
                        }
                    } else {
                        echo "There are no comments";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</body>
</html>


<script type="text/javascript">
    $(document).ready(function () {

        //inserting comments
        $('#commentButton').click(function (e) {
            var comment = $('#commentArea').val();

            e.preventDefault();
            var today = new Date();

            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();

            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

            var dateTime = date+' '+time;

            if (comment != '') {
                $.ajax({
                    url: 'ajaxPhp/commentInsertAjax.php',
                    type: 'post',
                    data: {
                        commentInsert: comment
                    },
                    success: function (response) {
                        var data = JSON.parse(response);
                        if (data.success) {
                        var existingHTML = `<p class='text-capitalize font-weight-bold' id='commentDom' class='commentDom'>"`+data.comment_fetch+` ' ' `+dateTime+`"</p>"`;
                            
                        $('#showComments').append(existingHTML)
                        } else {
                            alert(data.message);
                        }
                    }

                });
            } else {
                alert("Please fill the required field");
            }
            $('#commentForm').trigger('reset');
        });


        //inserting replies
        $('form#replyForm').submit('#c_id, #replyComment', function (e) {
            e.preventDefault();

            var comment_id = $(this).find('input').val();
            var reply_comments = $(this).find('textarea').val();
            var today = new Date();

            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();

            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

            var dateTime = date+' '+time;

            if(reply_comments != ''){

            $.ajax({
                url: 'ajaxPhp/replyInsertAjax.php',
                type: 'post',
                data: {
                    commentInputId: comment_id,
                    commentReply: reply_comments
                },
                success: function (response) {
                    console.log(response);
                    console.log(comment_id);
                    console.log(reply_comments);

                    var reply_field = JSON.parse(response);
                    if (reply_field.success) {

                        var replyExistingHTML = `<div class='font-weight-bold'>` +dateTime+ `</div><div class=text-capitalize id='_r'>`+reply_field.reply+`</div>`;

                        $(`#show_reply_`+reply_field.reply_id).after(replyExistingHTML).css('background', 'yellow')

                    } else {
                        alert(reply_field.message);
                    }
                }

            });

            $('.replyForm').trigger('reset');
        }else{
            alert('Please fill the required field');
        }
        });


        $('#like_button').click(function (e) {
            e.preventDefault();

            var liked = $('#like_input').val();

            $.ajax({
                url: 'ajaxPhp/likeAjax.php',
                type: 'post',
                data: {
                    likes_data: liked
                },
                success: function (response) {
                    // console.log(response);

                    var like_field = JSON.parse(response);
                    if((like_field.message === "disliked")){
                        var html = `<div id='likes_dislikes'>`+like_field.like_count+`<input type="hidden" name="like_input" id="like_input" class="like_input" value="<?php echo $var;?>"/>
                        <button type="submit" name="like_button" id="like_button"
                                class="fa fa-thumbs-o-up" formaction="like.php"></button>` +like_field.dislike_count+
                                `<input type="hidden" name="dislike_input" id="dislike_input"/>
                        <button type="submit" name="dislike_button" id="dislike_button"
                            class="fa fa-thumbs-o-down" formaction="dislikes.php"></button></div>`;
                            // $('#article_likes').html(html)
                        // console.log('dislike_count=> '+like_field.dislike_count)
                    }
                    
                    else if((like_field.message === "liked")){
                        
                        var existing_HTML = `<div id='likes_dislikes'>`+like_field.like_count+`<input type="hidden" name="like_input" id="like_input" class="like_input" value="<?php echo $var;?>"/>
                        <button type="submit" name="like_button" id="like_button"
                                class="fa fa-thumbs-o-up" formaction="like.php"></button>` +like_field.dislike_count+
                                `<input type="hidden" name="dislike_input" id="dislike_input"/>
                        <button type="submit" name="dislike_button" id="dislike_button"
                            class="fa fa-thumbs-o-down" formaction="dislikes.php"></button></div>`;

                        // $('#article_likes').html(existing_HTML)
                        // console.log(' likes_count=> ' +like_field.like_count)
                    }else{
                        alert(like_field.message);
                    }
                }
            });
        });

        $('#dislike_button').click(function (e) {
            e.preventDefault();

            var disliked = $('#dislike_input').val();

            $.ajax({
                url: 'ajaxPhp/dislikeAjax.php',
                type: 'post',
                data: {
                    dislike_data: disliked
                },
                success: function (response) {
                    // console.log(response);

                    var dislike_field = JSON.parse(response);
                    if(dislike_field.message == "disliked"){
                        var html = `<div id='likes_dislikes'>`+dislike_field.like_count+
                        `<input type="hidden" name="like_input" id="like_input" class="like_input" value="<?php echo $var;?>"/>
                        <button type="submit" name="like_button" id="like_button"
                                class="fa fa-thumbs-o-up" formaction="like.php"></button>`+dislike_field.dislike_count+
                                `<input type="hidden" name="dislike_input" id="dislike_input"/>
                        <button type="submit" name="dislike_button" id="dislike_button"
                            class="fa fa-thumbs-o-down" formaction="dislikes.php"></button></div>`;
                            // $('#article_likes').html(html)
                        // console.log("Dislike_Count=> " +dislike_field.dislike_count);
                    }
                    
                    else if(dislike_field.message == "success_dislike"){
                        var html = `<div id='likes_dislikes'>`+dislike_field.like_count+
                        `<input type="hidden" name="like_input" id="like_input" class="like_input" value="<?php echo $var;?>"/>
                        <button type="submit" name="like_button" id="like_button"
                                class="fa fa-thumbs-o-up" formaction="like.php"></button>`+dislike_field.dislike_count+
                                `<input type="hidden" name="dislike_input" id="dislike_input"/>
                        <button type="submit" name="dislike_button" id="dislike_button"
                            class="fa fa-thumbs-o-down" formaction="dislikes.php"></button></div>`;
                            // $('#article_likes').html(html)
                        // console.log("Dislike_count=>" + dislike_field.dislike_count);
                    }
                    
                    else{
                        alert(dislike_field.message);
                    }
                }
            });
        });
    });

</script>
