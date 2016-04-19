<?php

if($GLOBALS['user']->is_logged_in()) {
    redirect('/');
}

$errors=[];
global $errors;
function login() {
    global $errors;
    $uname=$_POST['uname'];
    $pass=$_POST['pass'];
    if(empty($uname)) {
        
        $errors[]="Username not given";
        
        return;
    }
    if(empty($pass)) {
        $errors[]="Password not given";
        return;
    }
    
    if(!$GLOBALS['user']->login($uname,$pass))
        $errors[]="Login Unsuccessful. Username or Password wrong.";
    else
        redirect("/");
        //redirect("/author/$uname");
}

if(isset($_POST['login']))
    login();

?>  

    <?php echo $GLOBALS['template']->render('header',$params); ?>

    <link type="text/css" rel="stylesheet" href="css/login.css" />

    <header class="vertical-center">
        <div class="container login-form-div">
            <form class="form-inline" action="<?=$_SERVER['REQUEST_URI']?>" name="login" method="post">
                <div class="form-group">
                    <label for="uname">my username is </label>
                    <input type="text" class="form-control" id="uname" name="uname" placeholder="Jane Doe">
                </div>
                <div class="row form-and">
                    <label> and </label>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="********">
                    <label for="pass">is my password</label>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-block btn-lg btn-info" name="login">Login</button>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="row error">
                    <?php
    if(is_array($errors)) {
        foreach($errors as $error)
            echo "<p>$error</p>";
    }
                    ?>
                </div>
            </form>
            
        </div>
    </header>

    <?php echo $GLOBALS['template']->render('footer',$params); ?>