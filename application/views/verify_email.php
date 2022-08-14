<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<?php  
	error_reporting(0);
	$user_email_address = $_GET['email_address']; 
	$is_verified = $_GET['is_verified'];

	if($is_verified != ''){
		if($is_verified == 1){ 
			header( "refresh:2;url=login" );
		?>
			<p class="alert alert-success">Email Verified</p>
		<?php }else{ ?>
			<p class="alert alert-danger">Invalid verification code</p>
		<?php } ?>

	<?php } ?>
	<form action="verify_email_code" method="POST">
		<input type="hidden" name="user_email_address" id="user_email_address" value="<?php echo $user_email_address; ?>">
		<div class="row">
			<div class="col-md-12 text-center">
				<h1>Verify Email address</h1>
			</div>
			<div class="col-md-4 col-md-offset-4">
				<label>Enter Verification Code</label>
				<input type="text" name="verify_code" id="verify_code" class="form-control">
			</div>
			<div class="col-md-12 text-center" style="padding-top: 20px;">
				<button type="submit" name="" class="btn btn-success">Verify Email</button>
			</div>		
		</div>
	</form>
</body>
</html>