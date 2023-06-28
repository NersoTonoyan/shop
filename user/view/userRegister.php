<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
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
			<label for="phone"> 
				<input type="text" name="phone" id="phone" placeholder="Enter phone">
			</label>	
		</div>

		<div>
			<label for="password"> 
				<input type="password" name="password" id="password" placeholder="Enter password">
			</label>	
		</div>

		<div>
				<input type="confPass" name="confPass" id="confPass" placeholder="Confirm password">
		</div>
		
		<button type="submit" name="action" value="submit">Register</button>
	</form>

    <?php
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
    ?>

    <div>
        <p>If already has account please <a href="userLogin.php">LogIn</a> </p>
    </div>


</body>
</html>