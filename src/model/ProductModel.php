<?php
namespace Ecommerce\Model;
use Ecommerce\Config\Db;
use PDO;
use Ecommerce\Controller\AuthController;
use PDOException;
class ProductModel{
    private $db;
    public function __construct(){
        $this->db = Db::Instance()->getConnection();
    }

    //getAll
    public function getAll($table,$jointables=array(),$where=array(),$clause=array()){
        $sql='SELECT * FROM '.$table;
        //if there are any joins
        if(count($jointables)>0){
            foreach($jointables as $value){
                // print_r($value);
                if(isset($value['table']) && isset($value['on'])){
                    $sql.=' JOIN '.$value['table'].' ON '.$value['on'];
                }
            }
        }
        $bindValue=array();
        //if there are any where clauses
        if(count($where)>0){
            $sql.=' WHERE ';
            foreach($where as $value){
                if(isset($value['field']) && isset($value['operator']) && isset($value['value'])){
                    $sql.=$value['field'].' '.$value['operator'].'?';
                    array_push($bindValue,$value['value']);
                }
            }
        }
        //if there are any clauses
        if(count($clause)>0){
            foreach($clause as $value){
                if(isset($value['type']) && isset($value['value'])){
                    if(isset ($value['operator'])){
                        $sql.=' '.$value['type'].' '.$value['operator'].' '.$value['value'].' ';
                    }else{
                    $sql.=$value['type'].' '.$value['value'].' ';
                    // echo $sql;
                    }
                    }
            }
            }
            // print_r($where);
            // echo $sql;
        // die;
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

    //insert data
    public function Insert($table,$data){
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
        // echo 'INSERT INTO '.$table.'('.$columns.') VALUES ('.$values.')';
        // echo "<pre>";
        // print_r($data);
        // print_r(array_values($data));
        // echo "</pre>";
        $result=$this->db->prepare('INSERT INTO '.$table.'('.$columns.') VALUES ('.$values.')');
        $result->execute(array_values($data));
        return $this->db->lastInsertId();
    }
    //update data
    public function Update($table,$data,$where){
        // $columns = implode(',', array_keys($data));
        $values="";
        $increment = 1;
        $bindValue=array();
        // print_r($data);
        foreach ($data as $key=>$value) {
            $values .= $key.'=?';
            if ($increment < count($data)) {
                $values .= ",";
            }
            array_push($bindValue,$value);
            $increment++;
        }
        $sql='UPDATE '.$table.' SET '.$values.' WHERE ';

        foreach($where as $w){
            // print_r($w);
            // die;
            if(isset($w['field']) && isset($w['operator']) && isset($w['value'])){
                $sql.=$w['field'].' '.$w['operator'].'?';
                array_push($bindValue,$w['value']);
            }
        }
        // echo $sql;
        // echo "<pre>";
        // print_r($bindValue);
        // echo "</pre>";
        $result=$this->db->prepare($sql);
        $result->execute(array_values($bindValue));
        return $result->rowCount();
    }
    //delete data
    public function Delete($table,$where){
        $sql='DELETE FROM '.$table.' WHERE ';
        $bindValue=array();
        foreach($where as $w){
            if(isset($w['field']) && isset($w['operator']) && isset($w['value'])){
                $sql.=$w['field'].' '.$w['operator'].'?';
            }
            array_push($bindValue,$w['value']);
        }
        $result=$this->db->prepare($sql);
        $result->execute(array_values($bindValue));
        return $result->rowCount();
    }


}