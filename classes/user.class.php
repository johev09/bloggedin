<?php

class User {
    
    private $db;
    public $uname;
    public $name;
    public $location;

    public function __construct($db){
        $this->db = $db; 
    }
    
    public function get_all_posts($username) {
        $query="SELECT pid,title,body,UNIX_TIMESTAMP(date_created) as date_created FROM posts WHERE pid in
        (SELECT pid FROM posts_ref WHERE aid=:aid) ORDER BY date_created DESC";
        
        return $this->db->query($query,["aid"=>$this->get_uid($username)]);
    }
    
    public function get_name() {
        if(!isset($_SESSION['name'])) {
            $query="SELECT name FROM authors WHERE aid=:aid";
            $rows=$this->db->query($query,["aid"=>$this->get_uid()]);
            $_SESSION['name']=$rows[0]['name'];
        }
        return $_SESSION['name'];
    }
    
    public function get_location() {
        if(!isset($_SESSION['location'])) {
            $query="SELECT location FROM authors WHERE aid=:aid";
            $rows=$this->db->query($query,["aid"=>$this->get_uid()]);
            $_SESSION['location']=$rows[0]['location'];
        }
        return $_SESSION['location'];
    }
    
    public function is_logged_in() {
        
        if(func_num_args()==0) {
            return isset($_SESSION['loggedin'])?$_SESSION['loggedin']:false;
        }
        else {
            $author=func_get_arg(0);
            return $author==$this->get_uname();
        }
    }
    
    private function get_user_hash($username) {  
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
    
    public function user_exists($username) {
        $query="SELECT uname FROM users WHERE uname=:uname";
        $rows=$this->db->query($query,array("uname"=>$username));
        
        return count($rows)>0? true: false;
    }
    
    private function password_verify($pass,$hash) {
        return md5($pass)==$hash;
    }
    
    /*
    public static function get_uid($username) {
        
    }*/
    
    public function get_uid() {
        if(func_num_args()==0) {
            return $_SESSION['uid'];
        }
        else {
            $username=func_get_arg(0);
            $query="SELECT uid FROM users WHERE uname=:uname";
            $rows=$this->db->query($query, ["uname"=>$username]);
            return $rows[0]['uid'];
        }        
    }
    
    public function login($username,$password){ 
        $hashed = $this->get_user_hash($username);
        if($hashed === false) {
            return false;
        }
        
        if($this->password_verify($password,$hashed)){
            $_SESSION['uname']=$username;
            $_SESSION['uid']=$this->get_uid($username);
            $_SESSION['loggedin'] = true;
            return true;
        }
        return false;
    }
    
    public function hash_pass($password) {
        return md5($password);
    }
    
    public function register($username,$password) {
        $table='users';
        $params=array("uname"=>$username,
                      "pass"=>$this->hash_pass($password));
        return $this->db->insert($table,$params);
    }
    
    public function get_uname() {
        return $_SESSION['uname'];
    }
    
    public function logout() {
        session_destroy();
    }
    
    public function add_post($title,$body,$date_created) {
        $pid = $this->db->insert('posts',
                          array('title'=>$title,
                                'body'=>$body,
                                'date_created'=>$date_created,
                                'returnid'=>true));
        //echo $pid;
        $this->db->insert('posts_ref',
                          array('aid'=>$this->get_uid(),
                                'pid'=>$pid));
    }
    
    public function delete_post($pid) {
        $this->db->delete('posts_ref',
                          array('pid'=>$pid));
        
        $this->db->delete('posts',
                          array('pid'=>$pid));
    }
                             
}