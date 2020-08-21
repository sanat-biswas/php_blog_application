<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Insert blog</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>

</head>
<body>

<form method="post" action="showContent.php" enctype="multipart/form-data">

    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <h1 class="text-success">Insert your content here</h1>

                <div class="form-group">
                    <label for="articleId"></label>
                    <input type="hidden" name="articleId" id="articleId" class="form-control">
                </div>

                <div class="form-group">
                    <label for="articleName">Article Name</label>
                    <input type="text" name="articleName" id="articleName" class="form-control">
                </div>

                <div class="form-group">
                    <label for="articleContent">Article Content</label>
                    <textarea name="articleContent" id="mytextarea"></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Choose image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>


            </div>
        </div>
    </div>


</form>

</body>
</html>

<script type="text/javascript" src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/popper.min.js" charset="utf-8"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
