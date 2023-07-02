<?php 
session_start();
include('../model/model.php');


if(isset($_GET['catId'])){
	$catId = $_GET['catId'];
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Products</title>
	<link rel="stylesheet" href="../assets/css/products.css">
</head>
<body>

<a href="../index.php" class="btn btn-primary">Go Back</a>

	<div class="add_prod">
	<form action="../controller/productController.php" method="post" enctype="multipart/form-data">
		<div class = 'add_product_container'>
		<div>
			<input type="text" name="prodName" class="prodName" placeholder="Name">
		</div>
		<div>
			<input type="text" name="prodPrice" class="prodPrice" placeholder="Price">
		</div>
		<div>
			<textarea name="prodDesc" class="prodDesc" placeholder="Description"></textarea>
		</div>
		<div>
			<input type="file" name="prodImage" class="prodImage" placeholder="Image">
		</div>

		<input type="hidden" name="catId" value="<?=$catId?>">
		
	</div>
	<button type="submit" class="btn btn-primary" name="action" value="addProduct">Add</button>

	</div>
	<?php 
		if(isset($_SESSION['status'])){
			if($_SESSION['status'] == 'success'){ ?>
				<div class="alert alert-success" role="alert"><?= $_SESSION['message']?></div>

			<?php }elseif($_SESSION['status'] == 'error'){ ?>
				<div class="alert alert-danger" role="alert"><?= $_SESSION['message']?></div>
			<?php	}
			unset($_SESSION['status']);
			unset($_SESSION['message']);
		}
		?>
	</form>

<div class="alert alert-success delete_success" role="alert" style="display: none;"></div>
<div class="alert alert-danger delete_danger" role="alert" style="display: none;"></div>

	<div class="show_products_container">
		<?php 
		$display_products = $admin->display_products($catId);
		if(count($display_products)>0){ ?>
			<table class="table table-hover" >
				<thead>
					<tr>
						<th>Image</th>
						<th>Name</th>
						<th>Price</th>
						<th>Description</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($display_products as $product){ ?>
						<tr>
							<td><img style="width: 100px;" src="../assets/img/<?= $product['vProdImage']?>"></td>
							<td><?=$product['vProdName']?></td>
							<td><?=$product['iProdPrice']?></td>
							<td><?=$product['vProdDesc']?></td>
							<td><?=$product['eStatus']?></td>
							<td>
								<button class="btn btn-primary updateProd" data-id="<?=$product['iProdId']?>">Update</button>
								<button class="btn btn-danger deleteProd" data-id="<?=$product['iProdId']?>" >Delete</button>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		<?php }else{ ?>
			<p>No products for this catedory</p>
	<?php	}
		?>
	</div>








	<div class="modal fade" id="open_esit_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="save_form" enctype="multipart/form-data">
          <div class="form-group">
            <label for="vProdName" class="col-form-label">Name</label>
            <input type="text" class="form-control" name="vProdName"  id="vProdName">
          </div>

          <div class="form-group">
            <label for="iProdPrice" class="col-form-label">Price</label>
            <input type="text" class="form-control" name="iProdPrice"  id="iProdPrice">
          </div>
          <div class="form-group">
            <label for="vProdDesc" class="col-form-label">Description</label>
            <textarea class="form-control" name="vProdDesc" id="vProdDesc"></textarea>
          </div>

          <div class="form-group">
            <label for="vProdStatus" class="col-form-label">Description</label>
            <select id="vProdStatus" name="vProdStatus" class="form-control">
            	<option></option>
            	<option value="Active">Active</option>
            	<option value="Inactive">Inactive</option>
            </select>
          </div>

          <div class="form-group">
            <label for="vProdImage" class="col-form-label">Image</label>
            <img style="width:150px;" class="image"  src="">
            <input type="file" class="form-control" name="vProdImage"  id="vProdImage">
          </div>
           <input type="hidden" name="action" value="save_form_details">
           <input type="hidden" name="iProdId" value="">

           <div class="alert alert-success update_success" role="alert" style="display: none;"></div>
           <div class="alert alert-danger update_danger" role="alert" style="display: none;"></div>

           <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save_btn">Save</button>
       
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
	

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript">

  $(function(){

	$('.updateProd').on('click',function(){
		var prodId = $(this).data('id');
		$('input[name="iProdId"]').val(prodId);

		$.ajax({
			url:'../controller/productController.php',
			method:'post',
			dataType:'json',
			data:{
				prodId,
				action:'open_update_modal'
			},
			success: function(data){
				if(data['Action'] == '1'){
					$('#open_esit_modal').modal('show');
					$('#vProdName').val(data['message']['vProdName']);
					$('#iProdPrice').val(data['message']['iProdPrice']);
					$('#vProdDesc').val(data['message']['vProdDesc']);
					$('.image').attr("src","../assets/img/"+data['message']['vProdImage']);;

					$('#vProdStatus>option').each(function(){
						if($(this).val() == data['message']['eStatus']){
							$(this).attr("selected","selected");
						}
					})


				}
			}
		})
	});



$(document).ready(function(){

 $('.save_btn').on('click', function(){
		var form_data = new FormData(this.form);
		
		$.ajax({
			url:'../controller/productController.php',
			method:'post',
			dataType:'json',
			data:form_data,
			contentType: false,
            processData: false,

            success: function(data){
            	if(data['Action'] == '1'){
            		$('.update_success').html(data['message']);
            		$('.update_success').fadeIn();
            		$('.update_success').fadeOut(2500);
            		setTimeout(function(){
            			$('#open_esit_modal').modal('hide');
            			location.reload();
            		},3000);
            	}else{
            		$('.update_danger').html(data['message']);
            		$('.update_danger').fadeIn();
            		$('.update_danger').fadeOut(2500);
            		setTimeout(function(){
            			$('#open_esit_modal').modal('hide');
            			location.reload();
            		},3000);
            	}
            }		
		})
	})
});


$('.deleteProd').click(function(){
	let iProdid = $(this).data('id');


	$.ajax({
			url:'../controller/productController.php',
			method:'post',
			dataType:'json',
			data:{
				iProdid,
				action:'delet_prod'
			},
			success: function(data){
				if(data['Action'] == '1'){
					$('.delete_success').html(data['message']);
            		$('.delete_success').fadeIn();
            		$('.delete_success').fadeOut(2500);
            		setTimeout(function(){
            			location.reload();
            		},3000);
				}else{
					$('.delete_danger').html(data['message']);
            		$('.delete_danger').fadeIn();
            		$('.delete_danger').fadeOut(2500);
            		setTimeout(function(){
            			location.reload();
            		},3000);
				}
			}
		})

})


	

})
  </script>
</body>
</html>