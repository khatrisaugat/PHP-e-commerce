<?php
namespace Ecommerce\Config;
use PDO;
class Db{
    private $_connection=null;
    private static $_instance=null;

    public function __construct()
    {
        $this->Connection();
    }
    public function getConnection(){
        return $this->_connection;
    }

    private function Connection()
    {
        $host=Config::$config['db']['host'];
        $user=Config::$config['db']['user'];
        $password=Config::$config['db']['password'];
        $dbname=Config::$config['db']['dbname'];
        $this->_connection = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $password);
        $this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function Instance()
    {
        if (!isset(self::$_instance)) {
            return self::$_instance = new Db();
        } else {
            return self::$_instance;
        }
    }
}
