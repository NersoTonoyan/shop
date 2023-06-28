<?php
session_start();
require('../model/model.php');

$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action == 'addCategory') {
    $catName = $_POST['catName'];

    if (!empty($_POST['catName'])) {
        if (!empty($catName)) {
            $add_category = $admin -> add_category($catName);
            
            if ($add_category > 0) {
                $_SESSION['status']  = 'succes';
                $_SESSION['message'] = 'Կատեգորիան հաջողությամբ ստեղծվել է:)';
            }else {
                $_SESSION['status']  = 'error';
                $_SESSION['message'] = 'Կատեգորիան չի ստեղծվել:(';
             }
        }else{
            $_SESSION['status']  = 'error';
            $_SESSION['message'] = 'Խնդրում ենք մուտքագրել կատեգորիայի անվանումը';
        }
        header('location:../index.php');
    }
}

if ($action == 'updateCat') {
    $catName = $_REQUEST['catName'];
    $catId   = $_REQUEST['catId'];

    $update_cat = $admin -> update_cat($catId, $catName);

    if ($update_cat) {
        $returnArr['Action']  = "1";
        $returnArr['message'] = 'Կատեգորիան հաջողությամբ թարմացվել է:)';
    }else {
        $returnArr['Action']  = "0";
        $returnArr['message'] = 'Կատեգորիան չի թարմացվել:(';
    }
    echo json_encode($returnArr);exit;
}

if ($action == "deleteCat") {
    $catId = $_REQUEST['catId'];

    $delete_cat = $admin->delete_cat($catId);

    if ($delete_cat) {
        $returnArr['Action']  = "1";
        $returnArr['message'] = "Կատեգորիան հաջողությամբ ջնջվել է:)";
    }else{
        $returnArr['Action']  = "0";
        $returnArr['message'] = "Կատեգորիան չի ջնջվել:(";
    }

    echo json_encode($returnArr);exit;

}


?>