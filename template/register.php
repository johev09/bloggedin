<?php

if($GLOBALS['user']->is_logged_in()) {
    redirect('/');
}

$errors=[];
global $errors;
function register() {
    global $errors;
    $uname=trim($_POST['uname']);
    $pass=trim($_POST['pass']);
    $cpass=trim($_POST['cpass']);
    if(empty($uname)) {
        $errors[]="Username not given";
        return;
    }
    if(empty($pass)) {
        $errors[]="Password not given";
        return;
    }
    if(empty($cpass)) {
        $errors[]="Confirm Password not given";
        return;
    }
    
    if($pass != $cpass) {
        $errors[]="Passwords do not match";
        return;
    }
    
    if($GLOBALS['user']->user_exists($uname)) {
        $errors[]="Username already exists";
        return;
    }
    
    if(!$GLOBALS['user']->register($uname,$pass))
        $errors[]="Regstration Unsuccessful";
    else
        redirect("/");
        //redirect("/author/$uname");
}

if(isset($_POST['register']))
    register();

?>

    <?php echo $GLOBALS['template']->render('header',$params); ?>

        <link type="text/css" rel="stylesheet" href="<?=$GLOBALS['site.root']?>/css/homepage.css" />
        <link type="text/css" rel="stylesheet" href="css/login.css" />

        <header class="vertical-center">
            <div class="container login-form-div">
                <form class="form-inline" action="<?=$_SERVER['REQUEST_URI']?>" name="login" method="post">
                    <div class="row">
                        <div class="form-group">
                            <label for="uname">my username should be </label>
                            <input type="text" class="form-control" id="uname" name="uname" placeholder="Jane Doe">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="********">
                            <label for="pass"> should be my my password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <input type="password" class="form-control" id="cpass" name="cpass" placeholder="********">
                            <label for="cpass"> is my password again</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-block btn-lg btn-info" name="register">Register</button>
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