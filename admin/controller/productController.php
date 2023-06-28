<?php
session_start();
require('../model/model.php');

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

if ($action == 'addProduct') {
    $prodName = $_POST['prodName'];
    $prodPrice  = $_POST['prodPrice'];
	$prodDesc   = $_POST['prodDesc'];
	$catId      = $_POST['catId'];

	$image_name = $_FILES['prodImage']['name'];
	$image_tmp  = $_FILES['prodImage']['tmp_name'];
    
    copy($image_tmp,'../assets/img/'.$image_name);

    $add_product = $admin->add_product($catId,$prodName,$prodPrice,$prodDesc,$image_name);

    if($add_product){
		$_SESSION['status'] = 'success';
		$_SESSION['message'] = 'Product added successfully';
	}else{
		$_SESSION['status'] = 'error';
		$_SESSION['message'] = 'Failed to add product';
	}

	header('location:../view/products.php?catId='.$catId);

}

if($action == 'open_update_modal'){
	$prodId = $_POST['prodId'];
	$get_product_by_id = $admin->get_product_by_id($prodId);

	if(count($get_product_by_id)>0){
		$returnArr['Action'] = '1';
		$returnArr['message'] = $get_product_by_id[0];
	}else{
		$returnArr['Action'] = '0';
		$returnArr['message'] = 'can not get product';
	}

	echo json_encode($returnArr); exit;
}


if($action == 'save_form_details'){

	$iProdId = $_POST['iProdId'];
	$vProdName = $_POST['vProdName'];
	$iProdPrice = $_POST['iProdPrice'];
	$vProdDesc = $_POST['vProdDesc'];
	$vProdStatus = $_POST['vProdStatus'];

	$image_name = $_FILES['vProdImage']['name'];
	$image_tmp  = $_FILES['vProdImage']['tmp_name'];

	

	if($image_name!=''){	
		$image_name = time().'_'.$image_name;
		move_uploaded_file($image_tmp, '../assets/img/' . $image_name);
	}

	$save_edit_prod = $admin->save_edit_prod($iProdId,$vProdName,$iProdPrice,$vProdDesc,$image_name, $vProdStatus);

	if($save_edit_prod){
		$returnArr['Action'] = '1';
		$returnArr['message'] = 'Product updated Successfully!';
	}else{
		$returnArr['Action'] = '0';
		$returnArr['message'] = 'Failed to update product';
	}

	echo json_encode($returnArr); exit;

}


if($action == 'delet_prod'){
	$iProdId = $_POST['iProdid'];


	$delete_prod = $admin->delete_prod($iProdId);

	if($delete_prod){
		$returnArr['Action'] = '1';
		$returnArr['message'] = 'Product deleted Successfully!';
	}else{
		$returnArr['Action'] = '0';
		$returnArr['message'] = 'Failed to delete product';
	}

	echo json_encode($returnArr);
}

?>