
<?php
include "../config.php";

//$commentNewCount = $_POST['commentNewCount'];
$id = $_POST['articleId'];


$commentFetchQuery = mysqli_query($con, "select * from comments inner join register
                        where articleid = '$id' and comments.loginid = register.userid ");

if (mysqli_num_rows($commentFetchQuery) > 0) {
    while ($comments = mysqli_fetch_assoc($commentFetchQuery)) {
        $c_id = $comments['id'];
        $comment = $comments['comment'];
        $firstname = $comments['firstname'];
        $lastname = $comments['lastname'];
        $date = $comments['createdon'];


        echo '<div class="showComments">';
        echo "<p class='text-capitalize font-weight-bold bg-light'>" . $comment . "</p>";
        echo "<p class='text-primary bg-light'>By: " .
            $firstname . ' ' . $lastname .
            "</p>";
        echo "On: " . $date;

        echo '</div>';
        ?>

        <div class="replyArea text-dark" id="replyArea" style="margin: 30px; ">

    <span class="replies"> Reply
        <img src="../images/arrow.ico" id="reply_arrow_img" style="width: 20px; height: 20px; cursor: pointer"/>
    </span>


            <form action="../replycomment.php" method="post" id='replyForm' class="replyForm">

                <div class="form-group">
                    <input type="hidden" name="c_id" class="form-control"
                           value="<?php echo $c_id; ?>"/>
                    <textarea name="replyComment" id="replyComment"
                              class="form-control" style="resize: none;"></textarea>
                </div>
                <button type="submit" class="btn btn-primary"
                        name="replyButton" id="replyButton"> Reply
                </button>
            </form>

            <?php

//            $replyNewCount = $_POST['replyNewCount'];

            $replyQuery = mysqli_query($con, "SELECT DISTINCT reply.*,
                                          register.* FROM reply inner join comments, register
                                WHERE reply.commentid = $c_id and reply.articleid = '$id'
                                 and reply.loginid = register.userid");

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
            }
            ?>
        </div>

        <?php
    }

} else {
    echo "There are no comments";
}

?>





