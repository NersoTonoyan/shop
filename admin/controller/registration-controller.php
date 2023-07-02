<?php
session_start();
include('../model/model.php');


$action = isset($_POST['action']) ? $_POST['action'] : '';

if($action !='' && $action == 'submit'){

	$name = $_POST['name'];
	$surName = $_POST['surName'];
	$mail = $_POST['mail'];
	$pass = $_POST['password'];
	$confPass= $_POST['confPass'];

	$regName = '/^[a-zA-Z]{2,20}$/';
	$regSurName = '/^[a-zA-Z0-9]{2,20}$/';
	$regMail = '/^[_a-z0-9-]+(\.[_a-z0-9]+)*@[a-z0-9]+(\.[a-z0-9-]+)*(\.[a-z]{2,5})$/';

	$regPass = '/^[a-zA-Z0-9]{6,12}/';


	if(empty($name) || empty($surName) || empty($pass) || empty($confPass)){
		$_SESSION['error'] = "Խնդրում ենք լրացնել բոլոր դաշտերը";
		header('location:../view/registration.php');
	}else{
		if(!preg_match($regName, $name)){
			$_SESSION['error'] = 'Ներմուծեք կորեկտ անուն';	
            header('location:../view/registration.php');
		}

		if(!preg_match($regSurName,$surName)){
			$_SESSION['error'] = 'ներմուծեք կորեկտ ազգանուն';
            header('location:../view/registration.php');
		}

		if(!preg_match($regMail,$mail)){
			$_SESSION['error'] = 'Ներմուծեք կորեկտ էլ․ հասցե';
            header('location:../view/registration.php');
		}

		if(!preg_match($regPass,$pass)){
			$_SESSION['error'] = 'ներմուծեք կորեկտ գաղտանբառ';
            header('location:../view/registration.php');
		}

		if($pass!=$confPass){
			$_SESSION['error'] = "Գաղտնաբառերը չեն համապատասխանում";
            header('location:../view/registration.php');
		}else{

			$check_admin = $admin->check_admin($mail);
			
			if($check_admin > 0){
				$_SESSION['error'] = 'Այս էլ․հասցեով գրանցում կա';
			}else{
				$add_admin = $admin->add_admin($name,$surName,$mail,$pass);
				if($add_admin){
					header('location:../view/login.php');die;
				}else{
					$_SESSION['error'] = "Գրանցումը չի հաջողվել";
				}
			}
		}
		header('location:../view/registration.php');
	}
}

?>