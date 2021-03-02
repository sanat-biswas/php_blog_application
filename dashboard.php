<?php
session_start();
include("config.php");

include("session.php");
error_reporting(E_ALL & ~E_NOTICE)

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>
    <link rel = "icon" href ="images/favicon.jpg" type = "image/x-icon" style="background: transparent;"> 
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/bootstrap-toggle.min.css">
    <link rel="stylesheet" href="css/darkmode.css"> -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/all.min.css"/>
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script src="js/all.min.js"></script>

    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- <script type="text/javascript" src="js/bootstrap-toggle.min.js"></script>
    <script type="text/javascript" src="js/darkmode.js"></script> -->

</head>
<body id="body">

<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light" id="bgcolor">
        <a class="navbar-brand" href="dashboard.php">Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                        <i class="fa fa-user-circle fa-lg user-icon"  aria-hidden="true" style="cursor: pointer;"></i>
                    </a>
                    <?php

                    if (isset($_SESSION['userName'])) {
                        ?>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <span class="dropdown-item" id="get_initials"><?php echo $_SESSION['userName']; ?></span>
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


    <div class="row" id="row-id">
        <aside>
            <ul class="" id="list-style">
                <li class=""><a href="">Home</a></li>
                <li class=" "><a href="readinglist.php">Reading List</a></li>
                <li class=""><a href="">Listings</a></li>
                <li class=""><a href="">Tags</a></li>
                <li class=""><a href="">FAQ</a></li>
                <li class=""><a href="">About</a></li>
                <li class=""><a href="">Privacy Policy</a></li>
                <li class=""><a href="">Terms of use</a></li>
                <li class=""><a href="">Contact</a></li>
            </ul>
        </aside>

        <div class='col-md-8'>

            <?php
            $results_per_page = 3;
            $query = mysqli_query($con, "SELECT * FROM article");
            $number_of_results = mysqli_num_rows($query);

            //number of pages
            $number_of_pages = ceil($number_of_results / $results_per_page);

            //determine which page number the user is on
            if (!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }
            // determine the sql LIMIT starting number for the results on the displaying page
            $this_page_first_result = ($page-1)*$results_per_page;

            $sql = 'SELECT * FROM article INNER JOIN register ON
                article.userid = register.userid limit '. $this_page_first_result.','.$results_per_page;
            $page_query = mysqli_query($con, $sql);
            
            while ($row = mysqli_fetch_array($page_query)) {
                $article_id = $row['id'];

                $firstname = $row['firstname'];
                $_SESSION['fname'] = $firstname;
                
                $lastname = $row['lastname'];
                $_SESSION['lname'] = $lastname;

                $fileName = $row['articlename'];
                $imagePath = $row['imagepath'];
                
                $articleContent = $row['articlecontent'];
                $readFile = fopen($articleContent, 'r');
                $file_size = filesize($articleContent);
                if ($file_size > 0) {
                    $read = fread($readFile, $file_size);
                    echo "<table class='table table-responsive' id='table_border'>
                      <tr><td>
                      <img src='$imagePath' alt=''
                                class='img-thumbnail img-fluid float-left'
                                    style='width: 150px; height: 100px; margin-top: 39px'></td>"; ?>

             <td>
                 <!-- <h3 class="text-danger"><?php echo "<br>" . $fileName; ?></h3> -->
                 <!-- <p class="text-justify"><?php echo mb_strimwidth($read, 0, 300, '...'); ?> -->

                     <!-- <h3 class="text-danger"><a href="articleFetch.php?id=<?php echo $row['id']; ?>">Read More</a></h3> -->
                     <div class='font-weight-bold'>
                        <?php echo $firstname.' '.  $lastname ; ?>
                    </div>
                    <h4 class="text-danger"><a href="articleFetch.php?id=<?php echo $row['id']; ?>" class="link_rem"><?php echo "<br>" . $fileName; ?></a></h4>

                 </p>

                <?php
                    $comm_query = mysqli_query($con, "SELECT count(comment) from comments where articleid = '$article_id'");
                    $comment_count = mysqli_fetch_array($comm_query);
                    echo '<br><span>'.$comment_count[0].' Comments</span>'; ?>

                    <button type="submit" class="btn" style="float: right;"><a href="saved_articles.php?article_id=<?php echo $article_id;?>" name="save-article">Save</a></button>
                    
                </td>

                 <?php
                echo "</tr>
                </table>";
                }
            }
            ?>

            <div aria-label="..." class="col-sm-6">
                <ul class="pagination">
                    <?php
                    // display the links to the pages
                     for ($page = 1; $page <= $number_of_pages; $page++) {
                         echo '<li class="page-item"><a class="page-link" href="dashboard.php?page=' . $page . '">' . $page . '</a></li> ';
                     }

                    ?>
                </ul>
            </div>

        </div>
    </div>
</div>

</body>
</html>