<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
  <?php 
    error_reporting(0);
    $not_login = $_GET['not_login'];
    if($not_login != ""){
      if($not_login == 1 ){ ?>
        <p class="alert alert-danger">Invalid Username or Password</p>
      <?php }
    }
  ?>
  <form action="login_check" method="POST">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1>Login Page</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="col-md-4 col-md-offset-4">
          <label>Email Address</label>
          <input type="text" name="email_address" id="email_address" class="form-control" required>
        </div>
      </div>
    </div>

    <div class="row" style="padding-top: 20px;">
      <div class="col-md-12">
        <div class="col-md-4 col-md-offset-4">
          <label>Password</label>
          <input type="text" name="password" id="password" class="form-control" required>
        </div>
      </div>
    </div>

    <div class="row" style="padding-top: 20px;">
      <div class="col-md-12 text-center">
        <button type="submit" name="login" id="login" class="btn btn-success">Login</button> <br><br>
        <a href="registration" style="text-decoration: underline; color: blue;"> Register New User </a>
      </div>
    </div>

  </form>

</body>
</html>