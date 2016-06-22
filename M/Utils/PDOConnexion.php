<?php
namespace M\Utils;
use PDO;
class PDOConnexion {
    
    private static $mpdo;
    private $dsn = "mysql:dbname=";
    private $pdo;
    
    private function __construct($db="calendar",$user="denis",$mdp="shewif",$host="localhost"){
       $dsn = $this->dsn.$db.";host=$host;unix_socket=/tmp/mysql.sock";
       $this->pdo=new PDO($dsn,$user,$mdp,
               array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
               );
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    /**
     * 
     * @return PDO
     */
    public static function getInstance(){
        if(!isset(self::$mpdo)){
                self::$mpdo=new self();
        }
        return self::$mpdo->pdo;
    }
}

?>
