<?php
session_start();
include("config.php");

include("session.php");

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>
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
    <!-- <div class="form-group">
      <button class="toggle" data-toggle="toggle" onchange="darkMode()"></button>
    </div> -->

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
                        <i class="fa fa-user-circle fa-lg user-icon" aria-hidden="true" style="cursor: pointer;"></i>
                    </a>
                    <?php

                    if (isset($_SESSION['userName'])) {
                    ?>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <span class="dropdown-item"><?php echo $_SESSION['userName']; ?></span>
                        <a class="text-danger dropdown-item" href="insertForm.php">Write Views</a>

                        <?php } ?>
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

        <div class='col-md-8'>

            <?php

            $query = mysqli_query($con, "SELECT * FROM article INNER JOIN register ON 
                article.userid = register.userid");

            while ($row = mysqli_fetch_array($query)) {
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];

                // $id = md5($row['id']);
                $fileName = $row['articlename'];
                $imagePath = $row['imagepath'];

                $articleContent = $row['articlecontent'];

                $readFile = fopen($articleContent, 'r');

                $read = fread($readFile, filesize($articleContent));

                echo "<table class='table table-responsive'>
                      <tr><td>
                      
                      <img src='$imagePath' alt=''
                                class='img-thumbnail img-fluid float-left'
                                    style='width: 150px; height: 100px; margin-top: 39px'></td>"; ?>

                <td>
                    <h3 class="text-danger"><?php echo "<br>" . $fileName; ?></h3>
                    <p class="text-justify"><?php echo mb_strimwidth($read, 0, 300, '...'); ?>

                        <a href="articleFetch.php?id=<?php echo $row['id']; ?>">Read More</a>

                    </p>

                    <div class="font-weight-bold">
                        By: <?php echo $firstname . ' ' . $lastname; ?>
                    </div>
                </td>


                <?php
                echo "</tr>
                </table>";
            }
            ?>

        </div>


    </div>
</div>

</body>
</html>