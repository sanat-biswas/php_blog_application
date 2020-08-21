<?php

	include 'config.php';
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>List of Articles</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<table class="table table-responsive table-hover text-center">
					<tr>
						<td>
							<h5 class="text-success">List of Articles</h5>
						</td>
					</tr>

				<?php
					$query = mysqli_query($con, "SELECT * FROM article");
					while($row = mysqli_fetch_array($query)){
						$name = $row['articlename'];

						echo "<tr>
								<td class='text-danger '>$name</td>
							</tr>";
					}
				?>

				</table>
			</div>
		</div>
	</div>
</body>
</html>