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
        try{

     
        $columns = implode(',', array_keys($data));
        $values="";
        $increment = 1;
        foreach ($data as $key=>$value) {
            if($value==''){
                $_SESSION['error'] = $key." cannot be empty";
                return false;
            }
            $values .= '?';
            if ($increment < count($data)) {
                $values .= ",";
            }
            $increment++;
        }
        echo 'INSERT INTO users('.$columns.') VALUES ('.$values.')';
        $result=$this->db->prepare('INSERT INTO users('.$columns.') VALUES ('.$values.')');
        $result->execute(array_values($data));
        if(AuthController::Userlogin($data['username'], $data['password']))
            return true;
        return false;
    }catch(PDOException $e){
        echo $_SESSION['error']=$e->getMessage();
    }
    }
    public function findUserById($id){
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