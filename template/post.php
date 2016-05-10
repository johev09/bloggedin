<?php
    if(!$GLOBALS['user']->is_logged_in()) {
        redirect('/');
    }
?>

    <?=$GLOBALS['template']->render('header',$params)?>

        <link type="text/css" rel="stylesheet" href="<?=$GLOBALS['site.root']?>/css/homepage.css" />
        <link type="text/css" rel="stylesheet" href="<?=$GLOBALS['site.root']?>/css/blog.css" />
        <!-- include summernote css/js-->
        <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
        <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>

        <script>
            $(document).ready(function () {
                $('.summernote').summernote({
                    height: 300, // set editor height
                    minHeight: null, // set minimum height of editor
                    maxHeight: null, // set maximum height of editor
                    focus: true // set focus to editable area after initializing summernote
                });
            });

            function validate() {
                $('.summernote').each(function () {
                    $(this).val($(this).code());
                });
                return true;
            }
        </script>

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
                            <form name="post-form" action="<?=$GLOBALS['site.root']?>/post/add?>" method="post" onsubmit="return validate();">
                                <div class="row form-group">
                                    <input type="text" required name="title" id="title" class="form-control" placeholder="Title goes here" />
                                </div>
                                <div class="row form-group">
                                    <textarea name="body" id="body" class="summernote">Content goes here</textarea>
                                </div>
                                <div class="row form-group">
                                    <input type="submit" value="POST IT" name="post-submit" class="btn btn-success" />
                                </div>
                            </form>
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