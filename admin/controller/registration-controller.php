<?php
// session_start();
// require ("../model/model.php");



// if (isset($_POST['send'])) {
//     $name = $_POST['name'];
//     $surname = $_POST['surname'];
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $rpassword = $_POST['confPassword'];
// // $_SESSION["error"] = "fefewr".$name.$surname.$email.$password.$rpassword;
//         // header("location:../view/registration.php");


//     if ($name == "" || $surname == "" || $email == "" || $password == "" || $rpassword = "") {
//         $_SESSION['error'] = "Խնդրում ենք լրացրեք բոլոր դաշտերը";
//         header("location:../view/registration.php");
//     }else if($password != $rpassword){
// $_SESSION["error"] = "fefewr".$name.$surname.$email.$password.$rpassword;
        
//         // $_SESSION['error'] = "գաղտնաբառերը չեն համապատասխանում".$password." ".$rpassword;
//         header("location:../view/registration.php");
//     }else{
//             $chekAdmin = $admin -> checkAdmin($email);
//             if ($chekAdmin) {
//                 $_SESSION['error'] = "tvyal mailov ka grancum";
//             }else{
//                 $addAdmin = $admin -> addAdmin($name,$surname,$email,$password);
//                 if ($addAdmin) {
//                     header("location:../view/login.php");
//                 }else{
//                     $_SESSION['error'] = "grancumy chhajovec";
//                 }
//             }
//         } 

    
// }


session_start();
require("../model/model.php");

if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rpassword = $_POST['confPassword'];

    if ($name == "" || $surname == "" || $email == "" || $password == "" || $rpassword == "") {
        $_SESSION['error'] = "Խնդրում եմ Լրացրեք բոլոր դաշտերը";
        header("location:../view/registration.php");
    } else if ($password != $rpassword) {
        $_SESSION['error'] = "Գաղտնաբառերը չեն համընկնում";
        header("location:../view/registration.php");
    } else {
        $chekAdmin = $admin->checkAdmin($email);
        if ($chekAdmin) {
            $_SESSION['error'] = "Տվյալ մեյլով կա գրանցում։";
            header("location:../view/registration.php");
        } else {
            $addAdmin = $admin->addAdmin($name, $surname, $email, $password);
            if ($addAdmin) {
                header("location:../view/login.php");
            } else {
                $_SESSION['error'] = "Գրնացումը չի հաջողվել։";
                header("location:../view/registration.php");
            }
        }
    }
}



?>