<?php
session_start();
require('../model/model.php');

$action = isset($_POST['action']) ? $_POST['action'] : '';

if (!empty($action) && $action == 'submit') {
    
    $name     = $_POST['name'];
    $surName  = $_POST['surName'];
    $mail     = $_POST['mail'];
    $phone    = $_POST['phone'];
    $pass     = $_POST['password'];
    $confPass = $_POST['confPass'];

    $regName = '/^[a-zA-Z]{2,20}$/';
	$regSurName = '/^[a-zA-Z0-9]{2,20}$/';
	$regMail = '/^[_a-z0-9-]+(\.[_a-z0-9]+)*@[a-z0-9]+(\.[a-z0-9-]+)*(\.[a-z]{2,5})$/';
	$regPhone = '/^[0-9]{9,13}/';
	$regPass = '/^[a-zA-Z0-9]{6,12}/';

    if (empty($name) || empty($surName) || empty($confPass) || empty($phone)) {
        $_SESSION['error'] = "Please fill all fields";
        header('location:../view/registration.php');
    }else{
        if (!preg_match($regName,$name)) {
            $_SESSION['error'] = 'Please enter valid Name';
        }
        if (!preg_match($regSurName,$surName)) {
            $_SESSION['error'] = 'please enter valid surname';
        }
        if (!preg_match($regMail,$mail)) {
            $_SESSION['error'] = 'please enter valid Email';
        }
        if(!preg_match($regPass,$pass)){

			$_SESSION['error'] = 'Please enter valid Password';
		}

		if(!preg_match($regPhone, $phone)){
			$_SESSION['error'] = 'Please fill valid phone number';
		}

		if($pass!=$confPass){
			$_SESSION['error'] = "Passwords doesn't match";
		}else{
            $check_user = $admin->check_user($mail);

            if ($check_user > 0) {
                $_SESSION['error'] = 'User already exists';
            }else{
                $add_user = $admin -> add_user($name,$surName,$mail,$pass,$phone);
                if ($add_user) {
                    header('location:../view/userLogin.php');die;
                }else{
                    $_SESSION['error'] = "Can't create user";
                }
            }
        }
        header('location:../view/userRegister.php');
    }

}



?>