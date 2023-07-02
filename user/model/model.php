<?php
class User{
    public $conn;

    public function __construct(){
        $this->conn = mysqli_connect('localhost','root','','shop');

        if (!$this->conn) {
            die(mysqli_connect_error($this->conn));
        }
    }

    public function check_user($mail){
        $query = "SELECT * FROM `users` WHERE `email` = '$mail'";
        $res = mysqli_query($this->conn,$query);

        if (mysqli_num_rows($res)>0) {
            return $result = '1';
        }else{
            return $result = '0';
        }
    }

    public function add_user($name, $surName,$mail,$pass,$phone){
        $query = "INSERT INTO `users` VALUES (null,'$name','$surName','$mail','$pass','$phone')";
        $res = mysqli_query($this->conn,$query);
        return $res;
    }

    public function check_user_login($email,$password){
        $query = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'";
        $res = mysqli_query($this->conn,$query);
        if (mysqli_num_rows($res)>0) {
            return $result = '1';
        }else{
            return $result = '0';
        }
    }

    public function show_all_categories(){
        $query = "SELECT * FROM `categories` WHERE `eStatus` = 'Active'";
        $res = mysqli_query($this->conn,$query);
        $result = mysqli_fetch_all($res,MYSQLI_ASSOC);

        return $result;
    }

    public function get_products($catId){
		$query = "SELECT * FROM `products` WHERE `iCatId` = '$catId' and `eStatus` = 'Active'";
		$res = mysqli_query($this->conn, $query);
		$result = mysqli_fetch_all($res, MYSQLI_ASSOC);

		return $result;
	}
    public function readDesc($prodId){
		$query = "SELECT `vProdDesc`, `vProdName` FROM `products` WHERE `iProdId` = '$prodId''";
		$res = mysqli_query($this->conn, $query);
		$result = mysqli_fetch_all($res, MYSQLI_ASSOC);

		return $result;
	}
    public function check_card($userEmail, $prodId){
		$query = "SELECT * from `cards` WHERE `iProdId` = '$prodId' AND `email` = '$userEmail'";
		$res = mysqli_query($this->conn, $query);

		if(mysqli_num_rows($res)>0){
			return $result = '1';
		}else{
			return $result = '0';
		}
	}
    public function add_to_card($userEmail, $prodId){
		$query = "INSERT INTO `cards` VALUES(null, $prodId, 1, '$userEmail')";
		$res = mysqli_query($this->conn, $query);

		return $res;
	}
    public function getCards($userEmail){
		$query = "SELECT cd.*, pr.* FROM `cards` AS cd LEFT JOIN `products` AS  pr ON `cd.iProdId` = `pr.iProdId` WHERE `vEmail` = '$userEmail'";
		
		$res = mysqli_query($this->conn, $query);
		$result = mysqli_fetch_all($res,MYSQLI_ASSOC);

		return $result;
	}

    public function removeCard($cardId){
		$query = "DELETE from `cards` WHERE `iCardId` = '$cardId'";
		$res = mysqli_query($this->conn, $query);
		return $res;
	}


	public function createOrder($prodId,$userEmail,$quant){

		$query = "SELECT * FROM `orders` WHERE `iProdId` = '$prodId' AND `vEmail` = '$userEmail'";
		$res = mysqli_query($this->conn, $query);
		$result = mysqli_fetch_all($res,MYSQLI_ASSOC);
		
		if(mysqli_num_rows($res)>0){
			$query  = "UPDATE `orders` SET `quantity` = `quantity` + '$quant' where `iOrderId` =". $result[0]['iOrderId'];

		}else{
			$query = "INSERT INTO orders VALUES(null, $prodId,$quant,'$userEmail','false','Active')";
		}

		$res = mysqli_query($this->conn, $query);
		return $res;
	}


	public function getSentOrders($userEmail){
		$query = "SELECT ord.*, pr.*, `ord.eStatus` AS `orderStatus`  from orders as ord left join products as  pr on ord.iProdId = pr.iProdId WHERE `ord.vEmail` = '$userEmail' nd ord.eConfirmed = 'true' AND `ord.eStatus` = 'Active' ";
		
		$res = mysqli_query($this->conn, $query);
		$result = mysqli_fetch_all($res,MYSQLI_ASSOC);

		return $result;
	}

	public function removeOrder($orderId){
		$query = "DELETE FROM `orders` WHERE `iOrderId` = '$orderId'";
		$res = mysqli_query($this->conn, $query);
		return $res;
	}

	public function sendOrder($userEmail){
		$query = "UPDATE `orders` SET `eConfirmed` = 'true' WHERE `vEmail` = '$userEmail' AND `eConfirmed` = 'false' AND `eStatus` = 'Active'";
		$res = mysqli_query($this->conn, $query);
		return $res;
	}


	public function getNewOrders($userEmail){
		$query = "SELECT ord.*, pr.*, `ord.eStatus` AS `orderStatus`  FROM  `orders` AS `ord` LEFT JOIN `products` AS  pr ON `ord.iProdId`= 'pr.iProdId' WHERE `ord.vEmail` = '$userEmail' AND `ord.eConfirmed` = 'false' AND  `ord.eStatus` = 'Active' ";
		
		$res = mysqli_query($this->conn, $query);
		$result = mysqli_fetch_all($res,MYSQLI_ASSOC);
		return $result;
	}


	public function confirmedByAdminOrders($userEmail){
		$query = "SELECT ord.*, pr.*, ord.eStatus AS orderStatus FROM orders AS ord LEFT JOIN products AS  pr ON ord.iProdId = pr.iProdId WHERE ord.vEmail = '$userEmail' AND ord.eConfirmed = 'true' AND `ord.eStatus` = 'Inactive' ";
		
		$res = mysqli_query($this->conn, $query);
		$result = mysqli_fetch_all($res,MYSQLI_ASSOC);
		return $result;
	}

}


$admin = new User();
?>