<?php
session_start();
require('../model/model.php');

$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action != '' && $action = 'submit') {
    
    $name     = $_POST['name'];
    $surName  = $_POST['surName'];
    $mail     = $_POST['mail'];
    $pass     = $_POST['password'];
    $confPass = $_POST['confPass'];

    //nayel regexp - y
    $regName = '/^[a-zA-Z]{2,20}$/';
	$regSurName = '/^[a-zA-Z0-9]{2,20}$/';
	$regMail = '/^[_a-z0-9-]+(\.[_a-z0-9]+)*@[a-z0-9]+(\.[a-z0-9-]+)*(\.[a-z]{2,5})$/';

	$regPass = '/^[a-zA-Z0-9]{6,12}/';

    if (empty($name) || empty($surName) || empty($mail) || empty($pass) || empty($confPass)) {
        $_SESSION['error'] = "Խնդրում ենք լրացնել բոլոր դաշտերը";
        header('location:../view/registration.php');
    }else{
        if (!preg_match($regName, $name)) {
            $_SESSION['error'] = 'Խնդրում ենք ներմուծել կորեկտ անուն';
        }
        if (!preg_match($regSurName, $surName)) {
            $_SESSION['error'] = 'Խնդրում ենք ներմուծել կորեկտ ազգանուն';
        }
        if (!preg_match($regMail,$mail)) {
            $_SESSION['error'] = 'Խնդրում ենք ներմուծել կորեկտ էլէկտրոնային հասցե';
        }
        if (!preg_match($regPass,$pass)) {
            $_SESSION['errpr'] = 'Խնդրում ենք ներմուծել կորեկտ գաղտնաբառ';
        }

        if ($pass != $confPass) {
            $_SESSION['error'] = 'Գաղտնաբառերը չեն համապատասխանում';
        }else{

            $checkAdmin = $admin->check_admin($mail);

            if ($checkAdmin > 0) {
                $_SESSION['error'] = 'Տվայալ էլեկտրոնային փոստով գրանցում կա';
            }else{
                $add_Admin = $admin-> add_admin($name,$surName,$mail,$pass);
                if ($add_Admin) {
                    header('location:../view/login.php');
                    die;
                }else {
                    $_SESSION['error'] = 'Գրանցվումը չի հաջողվել';
                }
            }
        }
        header('location:../view/registration.php');
    }





}

?>