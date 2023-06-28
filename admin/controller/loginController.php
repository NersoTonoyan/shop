<?php
session_start();
require('../model/model.php');

if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];

if (!empty($password) && !empty($email)) {

    $check_admin_login = $admin -> check_admin_login($email,$password);

    if ($check_admin_login > 0) {
        $_SESSION['adminEmail'] = $email;
        $returnArr['Action']    = '1';
        $returnArr['message']   = 'Դուք մուտք գործեցիք;)'; 
    }else{
        $returnArr['Action']  = '0';
        $returnArr['message'] = 'Նման ադմին չի գտնվել:(';
    }
}else {
    $returnArr['Action']  = '0';
    $returnArr['message'] = 'Մուտքագրեք բոլոր տվյալները';
}
    echo json_encode($returnArr);exit;
}


?>