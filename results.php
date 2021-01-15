<?php
    include("config.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Search</title>

	<link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>

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

            <!-- <div class="col-md-2"></div> -->
            <div class="col-md-8">
                <?php

        if (isset($_POST['searchButton'])) {
            $search = $_POST['search'];

            $searchQuery = mysqli_query($con, "SELECT * FROM article WHERE articlename LIKE 
								'%$search%' ORDER BY id LIMIT 10");
            if (mysqli_num_rows($searchQuery) > 0) {
                while ($row = mysqli_fetch_array($searchQuery)) {
                    $fileName = $row['articlename'];
                    $imagePath = $row['imagepath'];

                    echo "<table class='table table-borderless table-responsive'>
                      <tr><td><img src='$imagePath' alt=''
                                class='img-thumbnail img-fluid float-left'
									style='width: 150px; height: 100px;'></td>"; ?>

					<td>
	                    <a href="articleFetch.php?id=<?php echo $row['id']; ?>">
	                      <h3 class="text-danger"><?php echo "<br>".$fileName; ?></h3>
	                    </a>

					
                  </td>
                </tr>
          </table>

          <?php
                }
            } else {
                echo "NO search found";
            }
        }
        
        
          ?>
            </div>
        </div>
    </div>

	
      
</body>
</html>