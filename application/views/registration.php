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
		$is_success = $_GET['success'];
	?>

  <form action="save_registration" method="POST">
    <div class="row">
	  	<div class="col-md-12 text-center">
	  		<h1>User Registration Form</h1>
	  	</div>
	</div>

	<!--  -->

	<div class="row">
		<div class="col-md-12">
			<div class="col-md-6 col-md-offset-3">
				<?php if($is_success == 1){ ?>
					<p class="alert alert-success">User Registered Succefully</p>
				<?php }else if($is_success == 3){ ?>
					<p class="alert alert-danger">This Email address already exists</p>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="row">
	  	<div class="col-md-12">
	  		<div class="col-md-3 col-md-offset-3">
	  			<label>First Name</label>
	  			<input type="text" name="name" class="form-control" required>
	  		</div>
	  		<div class="col-md-3">
	  			<label>Father Name</label>
	  			<input type="text" name="fname" class="form-control" required>
	  		</div>
	  	</div>
	</div>

	<div class="row">
	  	<div class="col-md-12" style="padding-top: 20px;">
	  		<div class="col-md-3 col-md-offset-3">
	  			<label>Email Address</label>
	  			<input type="email" name="email_address" class="form-control" autocomplete="off" required>
	  		</div>
	  		<div class="col-md-3">
	  			<label>Password</label>
	  			<input type="password" name="password" id="password" class="form-control" autocomplete="off" required>
	  		</div>
	  	</div>
	</div>

	<div class="row">
	  	<div class="col-md-12" style="padding-top: 20px;">
	  		<div class="col-md-3 col-md-offset-3">
	  			<label>Confirm Password</label>
	  			<input type="password" name="confirm_password" id="confirm_password" class="form-control" autocomplete="off" required>
	  		</div>
	  	</div>
	</div>

	<div class="row" style="padding-top: 20px;">
		<div class="col-md-12 text-center">
			<button type="submit" name="register_user" id="register_user" class="btn btn-success">Register User</button><br><br>
			<a href="login" style="text-decoration: underline; color: blue;"> Login User </a>
		</div>
	</div>

  </form>

</body>
</html>