<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/reg.css">
	<title>Registration</title>
</head>
<body>
	<h1>Գրանցում</h1>
	<div class="container">
	<form action="../controller/userRegisterController.php" method="post">
		<div>
				<input type="text" name="name" id="name" placeholder="Enter Name">
		</div>
		
		<div>
			<input type="text" name="surName" id="surName" placeholder="Enter Surname">	
		</div>

		<div>
				<input type="mail" name="mail" id="mail" placeholder="Enter mail">
		</div>

		<div>
				<input type="text" name="phone" id="phone" placeholder="Enter phone">	
		</div>

		<div>
				<input type="password" name="password" id="password" placeholder="Enter password">
		</div>

		<div>
				<input type="password" name="confPass" id="confPass" placeholder="Confirm password">
		</div>
		
		<div>
			<button type="submit" name="action" value="submit" class="button">Register</button>
		</div>

	</form>

	</div>
    <?php
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
    ?>

    <div>
        <p>Եթե գրանցված եք կարող եք  <a href="userLogin.php"> Մուտք գործել</a> </p>
    </div>


</body>
</html>