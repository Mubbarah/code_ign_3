<?php if($_SESSION['email_address'] != ""){ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Product Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container" style="padding-top: 30px;">
		<button class="btn btn-success" data-toggle="modal" data-target="#AddModal">Add new Product</button>

		<?php 
			error_reporting(0);
			$is_record_delete = $_GET['is_record_delete'];
			$is_addedd 			 	= $_GET['is_addedd'];
			$is_edit 			 	  = $_GET['is_edit'];

			if($is_record_delete == 1){ ?>
				<p class="alert alert-danger" style="text-align: center;">Record Deleted</p>
			<?php header( "refresh:2;url=adminpanel" ); } ?>

			<?php if($is_addedd == 1){ ?>
				<p class="alert alert-success" style="text-align: center;">Record Added</p>
			<?php header( "refresh:2;url=adminpanel" ); } ?>

			<?php if($is_edit == 1){ ?>
				<p class="alert alert-success" style="text-align: center;">Record Editted</p>
			<?php header( "refresh:2;url=adminpanel" ); } ?>

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
	            	<td>
	                <a id="<?=$id; ?>" data-toggle="modal" data-target="#ModalEdit" class="td_user_click btn btn-success" style="width: 100px;" >
	                  Edit
	                </a>
	                <a onclick="return confirm('are you sure you want to delete this record permanently')" 
	                href="<?php echo "delete_product/$id"; ?>"> 
                    <button type="button" class="btn btn-danger">Delete</button>
                  </a>
	            	</td>
	            </tr>
	          <?php $sno++; } ?>

					
				</table>
			</div>
		</div>
	</div>
	 <!-- Modal -->
  <div class="modal fade" id="AddModal" role="dialog">
    <div class="modal-dialog">
    	<form action="add_new_product" method="POST" enctype="multipart/form-data">
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Add New Products</h4>
	        </div>
	        <div class="modal-body">
	          <div class="row">
	          	<div class="col-md-12">
	          		<label>Title</label>
	          		<input type="text" name="title" id="title" class="form-control">
	          	</div>
	          </div>
	          <div class="row" style="padding-top: 20px;">
	          	<div class="col-md-12">
	          		<label>Description</label>
	          		<input type="text" name="description" id="description" class="form-control">
	          	</div>
	          </div>

	          <div class="row" style="padding-top: 20px;">
	          	<div class="col-md-12">
	          		<label>Image</label>
	          		<input type="file" name="image" id="image" class="form-control">
	          	</div>
	          </div>

	          <div class="row" style="padding-top: 20px;">
	          	<div class="col-md-12">
	          		<label>Status</label>
	          		<select class="form-control" name="status" id="status">
	          			<option>--SELECT--</option>
	          			<option value="Active">Active</option>
	          			<option value="Inactive">Inactive</option>
	          		</select>
	          	</div>
	          </div>

	        </div>
	        <div class="modal-footer">
	          <button type="submit" class="btn btn-primary">Submit</button>
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
      </form>
    </div>
  </div>

  	 <!-- Modal -->
  <div class="modal fade" id="ModalEdit" role="dialog">
    <div class="modal-dialog">
    	<form action="edit_new_product" method="POST" enctype="multipart/form-data">
    		<input type="hidden" name="image_hidden" id="image_hidden">
    		<input type="hidden" name="record_id_edit" id="record_id_edit">
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Add New Products</h4>
	        </div>
	        <div class="modal-body">
	          <div class="row">
	          	<div class="col-md-12">
	          		<label>Title</label>
	          		<input type="text" name="title" id="title_edit" class="form-control">
	          	</div>
	          </div>
	          <div class="row" style="padding-top: 20px;">
	          	<div class="col-md-12">
	          		<label>Description</label>
	          		<input type="text" name="description" id="description_edit" class="form-control">
	          	</div>
	          </div>

	          <div class="row" style="padding-top: 20px;">
	          	<div class="col-md-12">
	          		<label>Image</label>
	          		<input type="file" name="image" id="image" class="form-control">
	          	</div>
	          </div>

	          <div class="row" style="padding-top: 20px;">
	          	<div class="col-md-12">
	          		<label>Status</label>
	          		<select class="form-control" name="status" id="status_edit">
	          			<option>--SELECT--</option>
	          			<option value="Active">Active</option>
	          			<option value="Inactive">Inactive</option>
	          		</select>
	          	</div>
	          </div>

	        </div>
	        <div class="modal-footer">
	          <button type="submit" class="btn btn-primary">Submit</button>
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
      </form>
    </div>
  </div>

<script>
	$('.td_user_click').click(function() {

			var record_id = this.id;

			url = "get_product_data";

	    $.ajax({
        type:"POST",
        url: url,
        data: { record_id:record_id },
        dataType: 'json',
        success: function(data)
        {  
          $("#record_id_edit").val(data[0]["id"]);
          $("#title_edit").val(data[0]["title"]);
          $("#description_edit").val(data[0]["description"]);
          $("#image_hidden").val(data[0]["image"]);
          $("#status_edit").val(data[0]["status"]);
        }
      });

	});
</script>

</body>
</html>
<?php }else{ 
	header("Location: login");
} ?>