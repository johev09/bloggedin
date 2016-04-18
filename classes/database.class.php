<?php

//database credentials
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','blog');

class Database {
    
    private $db;

    public function __construct(){
        $this->db = new PDO("mysql:host=".DBHOST.";port=3306;dbname=".DBNAME, DBUSER, DBPASS);
        //$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }
    
    public function query($str,$params) {
        $stmt = $this->db->prepare($str);
        $stmt->execute($params);

        $rows = $stmt->fetch();
        return $rows;
    }
}