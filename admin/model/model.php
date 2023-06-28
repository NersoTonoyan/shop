<?php
class admin{
    public $conn;

    public function __construct(){
        $this -> conn = mysqli_connect('localhost', 'root','','shop'); 
        
        if (!$this -> conn) {
            die(mysqli_connect_error($this->conn));
        }
    }

    public function check_admin($mail){
        $query = "SELECT * FROM `admin` WHERE 'vEmail' = '$mail'";
        $res = mysqli_query($this -> conn, $query);

        if (mysqli_num_rows($res) > 0) {
            return $result = '1';
        }else{
            return $result = '0';
        } 
    }

    public function add_admin($name,$surName,$mail,$pass){
        $query = "INSERT INTO `admin` VALUES (null,'$name','$surName','$mail','$pass')";
        $res = mysqli_query($this->conn, $query);
        return $res;
    }

    public function check_admin_login($email,$password){
        $query = "SELECT * FROM `admin` WHERE `vEmail` = '$email' AND `vPassword` = '$password'";
        $res   = mysqli_query($this->conn, $query);
        
        if (mysqli_num_rows($res)>0) {
            return $result = '1';
        }else{
            return $result = '0';
        }
    }

    public function add_category($catName){
        $query = "INSERT INTO `categories` (vCatName) VALUES ('$catName')";
        $res = mysqli_query($this->conn,$query);
        return $res;
    }


    public function show_all_categories(){
        $query = "SELECT * FROM `categories` WHERE `eStatus`  = 'Active'";
        $res = mysqli_query($this->conn,$query);

        $result = mysqli_fetch_all($res, MYSQLI_ASSOC);
        return $result;
    }

    public function update_cat($catId, $catName){
        $query = "UPDATE `categories` SET `vCatName` = '$catName' WHERE iCatId = $catId";
        $res   = mysqli_query($this->conn, $query);
        return $res;
    }

    public function delete_cat($catId){
        $query = "UPDATE `categories` SET `eStatus` = 'Inactive' WHERE `iCatId` = '$catId'";
        $res   = mysqli_query($this->conn,$query);
        return $res;
    }

    public function add_product($catId,$prodName,$prodPrice,$prodDesc,$image_name){
		$query = "INSERT INTO `products` VALUES(null, '$catId', '$prodName','$prodPrice','$prodDesc', '$image_name','Active')";

		$res = mysqli_query($this->conn, $query);
		return $res;
	}

	public function display_products($catId){

		$query = "SELECT * FROM `products` WHERE `iCatId` = '$catId' AND `eStatus` = 'Active'";

		$res = mysqli_query($this->conn, $query);
		$result = mysqli_fetch_all($res,MYSQLI_ASSOC);

		return $result;
	}

	public function get_product_by_id($prodId){
		$query = "SELECT * FROM `products` WHERE `iProdId` = '$prodId'";
		$res = mysqli_query($this->conn, $query);
		$result = mysqli_fetch_all($res, MYSQLI_ASSOC);

		return $result;
	}

	public function save_edit_prod($iProdId,$vProdName,$iProdPrice,$vProdDesc,$image_name, $vProdStatus){

		if($image_name!=''){
			$image = "'vProdImage' = '$image_name'";
		}else{
			$image = '';
		}

		$query = "UPDATE `products` SET `vProdName` = '$vProdName', `iProdPrice` = '$iProdPrice',  `vProdDesc` = '$vProdDesc', '$image',  `eStatus` = '$vProdStatus' WHERE `iProdId` =  '$iProdId'";
		$res = mysqli_query($this->conn, $query);
		return $res;
	}


	public function delete_prod($iProdId){
		$query = "UPDATE `products` SET `eStatus` = 'Inactive' WHERE `iProdId` = '$iProdId'";
		$res = mysqli_query($this->conn, $query);
		return $res;
	}

}   


$admin = new admin();
?>