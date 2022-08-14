<?php
namespace Ecommerce\Controller;
use Ecommerce\Config\Db;
use PDO;
class AuthController{
    public static function Adminlogin($username, $password){
        $db = Db::Instance()->getConnection();
        $query = "SELECT `username`,`password`,`ut_id` FROM users WHERE `username` = :username AND `password` = :password AND ut_id = 1";
        $stmt = $db->prepare($query);
        // echo $query;
        // die;
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        // $stmt->bindParam(':ut_id', 1, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            $_SESSION['username'] = $result['username'];
            $_SESSION['Adminlogin']=true;
            return true;
        }
        return false;
    }
    public static function Userlogin($username,$password){
        $db = Db::Instance()->getConnection();
        $query = "SELECT `username`,`password`,`ut_id`,`uid` FROM users WHERE `username` = :username AND `password` = :password AND ut_id = 2";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            $_SESSION['uid']=$result['uid'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['Userlogin']=true;
            return true;
        }
        return false;
    }
    public static function logout(){
        session_destroy();
    }
    public static function isAdminLoggedIn(){
        if(isset($_SESSION['Adminlogin'])){
            return true;
        }
        return false;
    }
    public static function isUserLoggedIn(){
        if(isset($_SESSION['Userlogin'])){
            return true;
        }
        return false;
    }
}