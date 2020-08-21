<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no,
            initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <form action="forgetAccountForm.php" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <button class="btn btn-primary" type="submit" name="submit" id="submit">Submit</button>

            </form>
        </div>

    </div>
</div>
</body>
</html>