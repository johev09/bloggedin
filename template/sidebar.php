<link type="text/css" rel="stylesheet" href="<?=$GLOBALS['site.root']?>/css/sidebar.css" />
<ul class="sidebar-nav">
    <li class="sidebar-brand text-center">
        <img class="profile-pic img-circle" src="<?=$GLOBALS['site.root']?>/img/dp.jpg" />
    </li>
    <li class="profile-name text-center">
        <?=$GLOBALS['user']->get_name()?>
    </li>
    <li class="text-center">
        <?=$GLOBALS['user']->get_location()?>
    </li>
    <li class="text-center">
        <a href="<?=$GLOBALS['site.root']?>/post" class="btn btn-success btn-default">POST</a>
    </li>
</ul>