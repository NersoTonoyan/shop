<?php 
session_start();
include('../model/model.php');

$action = isset($_POST['action']) ? $_POST['action'] : '';


if($action == 'readMore'){
	$prodId = $_POST['prodId'];

	$readDesc = $admin->readDesc($prodId);

	if(count($readDesc) > 0){
		$returnArr['Action'] = '1';
		$returnArr['title'] = $readDesc[0]['vProdName'];
		$returnArr['desc'] = $readDesc[0]['vProdDesc'];
	}else{
		$returnArr['Action'] = '0';
		$returnArr['message'] = "Can't find product";
	}

	echo json_encode($returnArr);
}

?>