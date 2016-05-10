<?php

//database credentials
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME',config('dbname'));

class Database {
    
    private $pdo;

    public function __construct(){
        $this->pdo = new PDO("mysql:host=".DBHOST.";port=3306;dbname=".DBNAME, DBUSER, DBPASS);
        //$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }
    
    public function query($sql, $params = array()) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    
    public function insert($table,$params) {
        $query="INSERT INTO $table";
        
        $returnid=isset($params["returnid"])?$params["returnid"]:false;
        unset($params["returnid"]);
            
        $cols=array_keys($params);
        $query.="(".implode(",",$cols).")";
        
        //if($returnid!=null) 
            //$query.="OUTPUT INSERTED.$returnid";
        
        array_walk($cols, function(&$value, $key) { $value = ':'.$value; });
        $query.=" VALUES (".implode(",",$cols).")";        
        
        //$values=array_values($array);
        $stmt = $this->pdo->prepare($query);
        
        /*
        foreach($params as $col=>$value) {
            $stmt->bindParam(":$col", $value); 
        }*/
        
        $result = $stmt->execute($params);
        
        if($returnid)
            return $this->pdo->lastInsertId();
        else
            return $result;
            
    }
    
    public function delete($table,$params) {
        $query="DELETE FROM $table WHERE ";
        
        $cols=array_keys($params);
        
        array_walk($cols, function(&$value, $key) { $value = "$value = :$value"; });
        $query.=implode(" AND ",$cols);
        
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($params);
    }
}