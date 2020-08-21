<?php

include("../config.php");

$id = $_GET['id'];

?>

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
                                        <input type="text" name="c_id" class="form-control c_id" id="c_id"
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