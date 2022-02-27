<!doctype html>
<html lang="en">
    <head>
    <title>DSG's Gameshop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
 <body class="container">
 <h1>Member <small>Login</small></h1>
  <form method="post" class="form" action="checkpwd.php">
    <div class="form-group">
        <label for="gid">Member ID</label>
        <input type="text" name="mid" class="form-control" placeholder="member id"></div>
    <div class="form-group">
        <label for="gid">Password</label>
        <input type="password" name="mpassword" class="form-control" placeholder="password">
    </div>
    <input type="submit" class="btn btn-primary" value="Login">
    <input type="reset" class="btn btn-primary" value="Cancel">
  </form>
 </body>
</html>
