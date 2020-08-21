<?php
session_start();

include("config.php");

$id = $_GET['id'];         //article id

$query = mysqli_query($con, "SELECT * FROM article WHERE id = '$id'");
while ($row = mysqli_fetch_array($query)) {
    $_SESSION['articleid'] = $id;
    $fileName = $row['articlename'];
    $articleContent = $row['articlecontent'];

    $readFile = fopen($articleContent, 'r');

    $read = fread($readFile, filesize($articleContent)); ?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $fileName; ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/commentForm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--    <link rel="stylesheet" href="css/all.min.css"/>-->
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>

    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/formhide.js"></script>
</head>
<body>

<div class="container hide_main_container">
    <div class="row">
        <div class=" col-md-10 mx-auto">
            <div id="hide_article">
                <h3 class="text-danger"><?php echo $fileName; ?></h3>
                <div class="text-dark font-weight-bold font_name"><?php echo $read; ?></div>

                <?php

                fclose($readFile);
}
                ?>
            </div>
            <div style="cursor: pointer;" id="article_likes">
                <!--            <div id="dislikes"></div>-->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" id="submit_likes">

                    <?php
                    $select_likes = mysqli_query($con, "select count(likes) from like_table 
                            where articleid = '$id'");
                    if (mysqli_num_rows($select_likes)) {
                        while ($like_row = mysqli_fetch_array($select_likes)) {
                            $likes_count = $like_row[0];
                            echo $likes_count;
                        }
                    }
                    ?>
                    <!--                <i class="fa fa-thumbs-o-up" aria-hidden="true" style="cursor: pointer;"></i>-->
                    <input type="hidden" name="like_input" id="like_input"/>
                    <button type="submit" name="like_button" id="like_button"
                            class="fa fa-thumbs-o-up" formaction="like.php"></button>
                    <!--                    <button type="submit" name="like_button" id="like_button"-->
                    <!--                            class="fa fa-thumbs-up"></button>-->

                    <?php
                    $select_dislikes = mysqli_query($con, "select count(dislikes) from dislike_table 
                            where articleid = '$id'");
                    if (mysqli_num_rows($select_dislikes)) {
                        while ($dislike_row = mysqli_fetch_array($select_dislikes)) {
                            $dislikes_count = $dislike_row[0];
                            echo $dislikes_count;
                        }
                    }
                    ?>
                    <!--                <i class="fa fa-thumbs-o-down" aria-hidden="true" style="cursor: pointer;"></i>-->
                    <input type="hidden" name="dislike_input" id="dislike_input"/>
                    <button type="submit" name="dislike_button" id="dislike_button"
                            class="fa fa-thumbs-o-down" formaction="dislikes.php"></button>
                </form>
            </div>
        </div>
    </div>

    <div class="row" id="row_hide">
        <!--        <div class="col-md-1"></div>-->
        <div class="col-md-10 mx-auto commentFontSize">
            <!--            <div></div>-->
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
                    <button type="submit" name="commentButton" id="commentButton" class="btn btn-outline-danger">
                        Post
                    </button>
                </form>

                <span class="font-weight-bold text-danger" id="showcomments">Comments</span>


                <!-- comment Area -->
                <div id='showComments'>

                    <?php

                    $commentFetchQuery = mysqli_query($con, "select * from comments inner join register 
                        where articleid = '$id' and comments.loginid = register.userid order by createdon  ");

                    if (mysqli_num_rows($commentFetchQuery) > 0) {
                        while ($comments = mysqli_fetch_assoc($commentFetchQuery)) {
                            $c_id = $comments['id'];
                            $comment = $comments['comment'];
                            $firstname = $comments['firstname'];
                            $lastname = $comments['lastname'];
                            $date = $comments['createdon'];

                            echo "<p class='text-capitalize font-weight-bold bg-light'>" . $comment . ' ' . $date . "</p>";
                            echo "<p class='text-primary bg-light'>By: " .
                                $firstname . ' ' . $lastname .
                                "</p>";
//                            echo "On: " . $date; ?>


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

                                    echo "<div id='show_reply'>";
                                    echo "<div class='text-capitalize'>" .
                                            $replyComment . "</div>";
                                    echo "<div class='font-weight-bold text-primary'>By: " . $firstName . ' ' .
                                            $lastName . "</div>";
                                    echo "<div class='font-weight-bold text-primary'>ON:" . $replyDate . "</div>";
                                    echo "</div>";
                                }
                            } ?>
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


</body>


</html>


<script type="text/javascript">
    $(document).ready(function () {

        //inserting comments
        $('#commentButton').click(function (e) {
            e.preventDefault();

            var comment = $('#commentArea').val();
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
                            alert(data.message);
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
//                        alert(data.message);
                        alert(reply_comments);
                    } else {
                        alert(reply_field.message);
                    }
                }
            
            });

            $('.replyForm').trigger('reset');
        });

        $('#like_button').click(function (e) {
            e.preventDefault();

            var liked = $('#like_input').val();

            $.ajax({
                url: 'ajaxPhp/likeAjax.php',
                type: 'post',
                data: {
                    likes: liked
                },
                success: function (response) {
                    console.log(response);
//                    location.reload();
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
                    console.log(response);
//                    location.reload();
                }
            });
        });


        $('#like_button, #dislike_button').on('click', function (e) {
            e.preventDefault();
            var id = <?php echo $id; ?>;
            var likes = <?php echo json_encode($likes_count); ?>;
            var dislikes = <?php echo json_encode($dislikes_count); ?>;

//            var text = $(this).html();
            $.ajax({
                url: 'ajaxPhp/fetch_likes_dislikes.php',
                method: 'get',
                data: {
                    article_id: id,
                    liked: likes,
                    disliked: dislikes
                },
                success: function (response) {
                    console.log(likes);
                    console.log(dislikes);
                    console.log(response);
//                        $('#like_button, #dislike_button').load('#article_likes');


                    setInterval(function () {
//                        $(document).load('#article_likes');

                        location.reload();
                    //    $(this).find(div).toggleClass('fa fa-thumbs-up');


                    }, 3000);
                }
            });
        });

        $('#replyForm').submit(function(e){
            e.preventDefault();

            var form = $(this);
            var post_url = form.attr('action');
            var post_data = form.serialize();
            $.$.ajax({
                type: "post",
                url: post_url,
                data: post_data,
                // dataType: "dataType",
                success: function (response) {
                    $(form).fadeOut(800, function(){
                        form.html(msg).fadeIn().delay(2000);
                    });
                }
            });

        });

    });
</script>