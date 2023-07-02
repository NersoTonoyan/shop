<?php 
session_start();
include('model/model.php');

?>


<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<link rel="stylesheet" href="assets/css/index.css">
</head>
<body>


<div class="nav_g">
<ul class="navbar-nav mx-auto navbar">
          <li class="nav-item active">
            <a class="nav-link nav_menu_a" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a  class="nav-link nav_menu_a" href="view/userCards.php">Cards</a>
          </li>
          <li class="nav-item">
            <a  class="nav-link nav_menu_a" href="view/userOrders.php">Orders</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle nav_menu_a" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Categories
            </a>
            <div class="dropdown-menu">
              <?php $show_all_categories = $admin->show_all_categories();

                   foreach($show_all_categories as $cat){ ?>

                 <a  style="font-size:30px; text-decoration:underline; background-color: orange; color:black; cursor:pointer;" class="dropdown-item"  href="view/userProducts.php?catId=<?=$cat['iCatId']?>&catName=<?=$cat['vCatName']?>"><?=$cat['vCatName']?></a>

            <?php   }
              ?>
            
          </div>
          </li>
        </ul>
</div>

<div class = "info">
	<p>
		Բարի գալուստ հայկական առաջին օնլայն գրադարան)</br>
		Այստեղ կարող եք գտնել գրքեր ցանկացած ժանրի </br>
		Մաղթում ենք բարի ընթերցում:)
	</p>
</div>

</body>
</html>
