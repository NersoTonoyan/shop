<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="../assets/css/registration.css">
</head>
<body>
    <form action="../controller/registrationController.php" method="post">
        <h2>Գրանցում</h2>
        <div class = "registration_form">
            <input type="text" name="name" id="name" placeholder="Մուտքագրեք անունը">
           
            <input type="text" name="surName" id="surName" placeholder="Մուտքագեք ազգանունը">
            
            <input type="mail" name="mail" id="mail" placeholder="Էլեկտրոնային հասցե">
        
            <input type="password" name="password" id="password" placeholder="Մուտքագեք գաղտնաբառը">
        
            <input type="password" name="confPass" id="confPass" placeholder="Կրկնեք գաղտնաբառը">
            
            <button type="submit" name="action" value="submit" class="button">Գրանցվել</button>
        </div>
    </form>

    <?php
        if (isset($_SESSION['error'])) {?>
            <p class="error_msg"><?=$_SESSION['error'];?></p>
            <?php
            unset($_SESSION['error']);
        }
    ?>

    <div class="sign_info">
        <p>Եթե արդեն գրանցված եք կարող եք <a href="login.php" class="sign_in">մուտք գործել</a></p>
    </div>

</body>
</html>


