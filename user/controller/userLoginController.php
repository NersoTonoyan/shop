<?php
session_start();
require('../model/model.php');

if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $password = $_POST['password'];
    $email    = $_POST['email'];

    if (!empty($password) && !empty($email)) {
        $check_user_login = $admin -> check_user_login($email,$password);
    
        if ($check_user_login > 0) {
            $_SESSION['userEmail'] = $email;
            $returnArr['Action']   = '1';
            $returnArr['message']  = 'You are logged in';
        }else{
            $returnArr['Action']  = '0';
            $returnArr['message'] = 'Nman user chi gtnvel';
        }
    }else{
        $returnArr['Action']  = '0';
        $returnArr['message'] = 'mutqagreq bolor tvyalnery';
    }

    echo json_encode($returnArr);exit;

}

?>