<?php

class User {
    
    private $db;

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
            $query='SELECT password FROM blog_members WHERE username = :username';
            $params=array('username' => $username);
            
            $row = $this->db->query($query,$params);
            return $row['password'];

        } catch(PDOException $e) {
            echo '<p class="error">'.$e->getMessage().'</p>';
        }
    }
    
    private function password_verify($pass,$hash) {
        return md5($pass)==$hash;
    }
    
    public function login($username,$password){ 
        $hashed = $this->get_user_hash($username);
        if($this->password_verify($password,$hashed) == 1){
            $_SESSION['loggedin'] = true;
            return true;
        }       
    }
}