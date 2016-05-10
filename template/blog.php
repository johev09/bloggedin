<?php
    $posts=array();
    if($GLOBALS['user']->user_exists($author)) {
        $posts=$GLOBALS['user']->get_all_posts($author);
        //var_dump($posts);
        //die;
    }
    else {
        //all posts
        //$posts=
    }
?>

    <?=$GLOBALS['template']->render('header',$params)?>

        <link type="text/css" rel="stylesheet" href="<?=$GLOBALS['site.root']?>/css/homepage.css" />
        <link type="text/css" rel="stylesheet" href="<?=$GLOBALS['site.root']?>/css/blog.css" />

        <div id="wrapper">
            <div id="sidebar-wrapper">
                <?=$GLOBALS['template']->render('sidebar',$params)?>
            </div>
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12" id="posts-col">
                            <div class="row">
                                <div class="visible-xs">
                                    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><span class="glyphicon glyphicon-chevron-left"></span></a>
                                </div>
                            </div>
                            <?php foreach($posts as $post) {?>
                                <div class="row">
                                    <article class="post">
                                        <h2 class="post-title"><?=$post['title']?></h2>
                                        <?php if($GLOBALS['user']->is_logged_in($author)) {?>
                                            <a class="post-delete" href="<?=$GLOBALS['site.root']?>/post/delete/<?=$author?>/<?=$post['pid']?>">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            <?php } ?>
                                                <div class="post-date">
                                                    <i class="material-icons">event</i>
                                                    <?php echo date("jS F Y | h:i A",$post['date_created']);?>
                                                </div>
                                                <div class="post-body">
                                                    <?=$post['body']?>
                                                </div>
                                    </article>
                                    <hr size="">
                                </div>
                                <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if($GLOBALS['user']->is_logged_in()) {?>
            <script>
                $("#menu-toggle").click(function (e) {
                    e.preventDefault();
                    $("#wrapper").toggleClass("toggled");
                });
            </script>

            <?php } ?>

                <?=$GLOBALS['template']->render('footer',$params)?>