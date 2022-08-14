<?php
namespace Ecommerce\Model;
use Ecommerce\Config\Db;
use Ecommerce\Controller\AuthController;
use PDO;
use PDOException;
class UserModel{
    private $db;
    public function __construct(){
        $this->db = Db::Instance()->getConnection();
    }
    public function register($data){
        $this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function Adminlogin($username, $password){
        if(AuthController::Adminlogin($username, $password)){
            return true;
        }else{
            return false;
        }
    }
    public function Userlogin($username,$password){
        if(AuthController::Userlogin($username, $password)){
            return true;
        }else{
            return false;
        }
    }
    public function registerUser($data){
        $columns = implode(',', array_keys($data));
        $values="";
        $increment = 1;
        foreach ($data as $value) {
            $values .= '?';
            if ($increment < count($data)) {
                $values .= ",";
            }
            $increment++;
        }
        echo 'INSERT INTO users('.$columns.') VALUES ('.$values.')';
        // echo "<pre>";
        // print_r($data);
        // print_r(array_values($data));
        // echo "</pre>";
        $result=$this->db->prepare('INSERT INTO users('.$columns.') VALUES ('.$values.')');
        $result->execute(array_values($data));
        if(AuthController::Userlogin($data['username'], $data['password']))
            return true;
        return false;
    }
    public function findUserById($id){
        // $this->db->query('SELECT * FROM users WHERE uid = :uid && ut_id = 2');
        // $this->db->bind(':uid', $id);
        // $row = $this->db->single();
        // if($this->db->rowCount() > 0){
        //     return true;
        // }else{
        //     return false;
        // }
                $sql='SELECT * FROM users WHERE uid = ? && ut_id = 2';
                $bindValue=array($id);
                //prepare the query
                $preStatement = $this->db->prepare($sql);
                //execute the query
                try {
                    $preStatement->execute($bindValue);
                    //return the result
                    return $preStatement->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $exception) {
                    die($exception->getMessage());
                }
    }
}