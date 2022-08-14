<?php if($_SESSION['email_address'] != ""){ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Panel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container" style="padding-top: 30px;">
		<h1 class="text-center">UserPanel</h1>
		<div class="row" style="padding-top: 20px;">
			<div class="col-md-12">
				<table class="table table-bordered">
					<tr>
						<th>S.No</th>
						<th>Title</th>
						<th>Description</th>
						<th>Image</th>
						<th>Status</th>
						<th>Timestamps</th>
						<th>Action</th>
					</tr>
					
			<?php 
	            $sno = 1;
	            foreach ($products_data as $value) {  
	            	$id = $value['id'];
	            ?>
	            <tr>
	            	<td><?=$sno;?></td>
	            	<td><?=$value['title'];?></td>
	            	<td><?=$value['description'];?></td>
	            	<td><img src="../../<?=$value['image'];?>" style="width: 300px;"></td>
	            	<td><?php if($value['status'] == 'Active'){ echo "<p class='label label-success'>Active</p>"; }else{ 
	            		echo "<p class='label label-danger'>Inactive</p>";
	            	 } ?></td>
	            	<td><?=$value['date_time'];?></td>
	            </tr>
	          <?php $sno++; } ?>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
<?php }else{ 
	header("Location: login");
} ?>