<?php 

session_start();
include('../model/model.php');

?>


<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
</head>
<body>


	<header>
		<div>
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="#">Cards</a></li>
				<li><a href="#">Orders</a></li>
				<li><a href="#">Categories</a>
					<div>
						<?php $show_all_categories = $admin->show_all_categories();

						foreach($show_all_categories as $cat){ ?>

							<a href="view/userProducts.php?catId=<?=$cat['iCatId']?>&catName=<?=$cat['vCatName']?>"><?=$cat['vCatName']?></a>

					<?php 	}
						 ?>
						
					</div>

				</li>
			</ul>
		</div>
	</header>
	

</body>
</html>