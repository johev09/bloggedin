<?php

class User {
    
    private $db;
    public $uname;

    public function __construct($db){
        $this->db = $db; 
    }
    
    public function is_logged_in(){
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            return true;
        }
        else
            return false;
    }
    
    private function get_user_hash($username){  
        try {
            $query='SELECT pass FROM users WHERE uname = :username';
            $params=array('username' => $username);
            
            $row = $this->db->query($query,$params);
            if(count($row)==0) {
                return false;
            }
            
            //var_dump($row);
            
            return $row[0]['pass'];

        } catch(PDOException $e) {
            echo '<p class="error">'.$e->getMessage().'</p>';
        }
    }
    
    private function password_verify($pass,$hash) {
        return md5($pass)==$hash;
    }
    
    public function login($username,$password){ 
        $hashed = $this->get_user_hash($username);
        if($hashed === false) {
            return false;
        }
        
        if($this->password_verify($password,$hashed)){
            $_SESSION['uname']=$username;
            $_SESSION['loggedin'] = true;
            return true;
        }
        return false;
    }
    
    public function getUname() {
        return $_SESSION['uname'];
    }
    
    public function logout() {
        session_destroy();
    }
}