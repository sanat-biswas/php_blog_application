<?php
    include("config.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Search</title>

	<link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery-3.2.1.slim.min.js"></script>

    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>

    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-md-2"></div>
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