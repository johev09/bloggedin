<!DOCTYPE html>
<html>

<head>
    <title>
        <?=$title?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700' rel='stylesheet' type='text/css'>
    <link type="text/css" rel="stylesheet" href="<?=$GLOBALS['site.root']?>/bootstrap-3.3.6-dist/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="<?=$GLOBALS['site.root']?>/bootstrap-3.3.6-dist/css/bootstrap-theme.min.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

    <link type="text/css" rel="stylesheet" href="<?=$GLOBALS['site.root']?>/css/main.css" />
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header page-scroll">
                <?php
    if($GLOBALS['user']->is_logged_in()) {
    ?><a class="navbar-brand" href="<?=$GLOBALS['site.root']?>/logout">Logout</a>
                    <?php }?>
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
            </div>
            <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden active">
                        <a href="#page-top"></a>
                    </li>
                    <li class="">
                        <a class="page-scroll" href="<?=$GLOBALS['site.root']?>/">Home</a>
                    </li>
                    <?php if(!$GLOBALS['user']->is_logged_in()) {?>
                        <li class="">
                            <a class="page-scroll" href="<?=$GLOBALS['site.root']?>/login">Blog in</a>
                        </li>
                        <li class="">
                            <a class="page-scroll" href="<?=$GLOBALS['site.root']?>/register">Register</a>
                        </li>
                        <?php } 
                else {?>
                            <li class="">
                                <a class="page-scroll" href="<?=$GLOBALS['site.root']?>/author/<?=$GLOBALS['user']->get_uname()?>">Blog</a>
                            </li>
                            <?php }?>
                                <li class="">
                                    <a class="page-scroll" href="#about">About</a>
                                </li>
                                <li class="">
                                    <a class="page-scroll" href="#team">Team</a>
                                </li>
                                <li class="">
                                    <a class="page-scroll" href="#contact">Contact</a>
                                </li>
                </ul>
            </div>
        </div>
    </nav>