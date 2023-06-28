<?php
session_start();
require('model/model.php');

if (!isset($_SESSION['adminEmail'])) {
    header('locaiton:view/registration.php');
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>

  <div class="buttons_nav">
    <a class="btn btn-primary" href="view/orders.php">Orders</a>
    <a href="controller/logOutController">Log Out</a>
  </div>
	<div class="add_category_container">
		<form action="controller/categoryController.php" method="post">
			<label for="catName">Add Name</label>
			<input type="text" name="catName" id="catName">

			<button type="submit" name="action" value="addCategory">Add</button>
		</form>
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
	</div>


	<div class="display_categories_container">
		<div class="alert alert-success" role="alert" style="display: none;"></div>
		<div class="alert alert-danger" role="alert" style="display: none;"></div>
		<?php $show_all_categories = $admin->show_all_categories();
		if(count($show_all_categories)>0){ ?>
			<table class="table table-hover" style="width: 40%;">
				<thead>
					<tr>
						<th>Category Name</th>
						<th style="width: 42%;">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($show_all_categories as $category){?>
						<tr>
							<td contenteditable="" class="catName"><?= $category['vCatName']?></td>
							<td>
								<a class="btn btn-info" target="_blank" href="view/products.php?catId=<?=$category['iCatId']?>&catName=<?=$category['vCatName']?>">Open</a>
								<button class="btn btn-warning updateCat" data-value="<?=$category['iCatId']?>">Update</button>
								<button class="btn btn-danger deleteCat" data-value="<?=$category['iCatId']?>">Delete</button>

							</td>
						</tr>
					<?php } ?> 
				</tbody>
			</table>
		<?php }else{ ?>
			<p>No results to display</p>
		<?php } ?>
	</div>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript">
  	$(function(){
  		$('.updateCat').on('click', function(){
  			let catName = $('.catName').html();
  			let catId = $(this).data('value');

  			$.ajax({
  				url:'controller/categoryController.php',
  				method:'post',
  				dataType:'json',
  				data:{
  					catName,
  					catId,
  					action:'updateCat'
  				},
  				success: function(data){
  					if(data['Action'] == '1'){
  						$('.alert-success').html(data['message']);
  						$('.alert-success').fadeIn();
  						$('.alert-success').fadeOut(2500);
  						setTimeout(function(){
  							location.reload();
  						},3000);
  					}else{
  						$('.alert-danger').html(data['message']);
  						$('.alert-danger').fadeIn();
  						$('.alert-danger').fadeOut(2500);
  						setTimeout(function(){
  							location.reload();
  						},3000);
  					}
  				}
  			})
  			
  		})



  		$('.deleteCat').on('click', function(){
  			let catId = $(this).data('value');

  			$.ajax({
  				url:'controller/categoryController.php',
  				method:'post',
  				dataType:'json',
  				data:{
  					catId,
  					action:'deleteCat'
  				},
  				success: function(data){
  					if(data['Action'] == '1'){
  						$('.alert-success').html(data['message']);
  						$('.alert-success').fadeIn();
  						$('.alert-success').fadeOut(2500);
  						setTimeout(function(){
  							location.reload();
  						},3000);
  					}else{
  						$('.alert-danger').html(data['message']);
  						$('.alert-danger').fadeIn();
  						$('.alert-danger').fadeOut(2500);
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