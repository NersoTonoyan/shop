<?php 
session_start();
include('model/model.php');

?>


<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>   
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

                 <a  style="font-size:30px; text-decoration:underline; background-color: orange; color:black; cursor:pointer;" class="dropdown-item" ><?=$cat['vCatName']?></a>

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
