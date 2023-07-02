
<!DOCTYPE html>
<html>
<head>
	<title>Products</title>
</head>
<body>

	<?php require('catHeader.php'); ?>

	<section>
		<?php $products = $admin->get_products($catId);

		if(count($products) > 0){

		?>

		<div class="alert alert-success alert_success" style="display: none;" role="alert"></div>
		<div class="alert alert-danger alert_error" style="display: none;" role="alert"></div>

		<div class="col-md-12" style="margin-top: 50px;">
			<table class="table table-bordered table-hover" style="margin: auto;">
				<thead>
					<tr>
						<th>Image</th>
						<th>Name</th>
						<th>Price</th>
						<th>Description</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($products as $prod){?>
						<tr>
							<td><img style="width: 100px;" src="../../admin/assets/img/<?=$prod['vProdImage']?>"></td>
							<td><?=$prod['vProdName']?></td>
							<td><?=$prod['iProdPrice']?></td>
							<td><?=substr($prod['vProdDesc'],0,50).' ...';?></td>
							<td>
								<button class="btn btn-primary readMore" value="<?=$prod['iProdId']?>">Read more</button>
								<button class="btn btn-success addToCard" data-value='<?=$userEmail?>' value='<?=$prod['iProdId']?>'>Add to Card</button>
							</td>
						</tr>
					<?php }?>
				</tbody>
			</table>
		</div> <?php }else{?>

			<p>This codegory doesn't have products</p>

		<?php }?>
	</section>





<!-- Read more Modal -->
<div class="modal fade" id="read_more_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="read_more_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body read_more_desc">
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Check user Login modal -->

<div class="modal fade" id="check_login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="check_login_title">Permision denied</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<p>In you want to add to card please <b>Login</b> or <b>Register</b></p>
      </div>
      <div class="modal-footer">
       	<a href="userRegister.php" class="btn btn-primary">Register</a>
       	<a href="userLogin.php" class="btn btn-primary">Login</a>
      </div>
    </div>
  </div>
</div>

</body>
</html>