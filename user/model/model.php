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

}


$admin = new User();
?>