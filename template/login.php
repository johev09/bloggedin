<?php echo $GLOBALS['template']->render('header',$params); ?>

    <link type="text/css" rel="stylesheet" href="css/login.css" />

    <header class="vertical-center">
        <div class="container login-form-div">
            <form class="form-inline">
                <div class="form-group">
                    <label for="username">my username is </label>
                    <input type="text" class="form-control" id="username" placeholder="Jane Doe">
                </div>
                <div class="row form-and">
                    <label> and </label>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" placeholder="********">
                    <label for="password">is my password</label>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-block btn-lg btn-info">Login</button>
                    </div>
                    <div class="col-md-4"></div>
                </div>

            </form>
        </div>
    </header>

    <?php echo $GLOBALS['template']->render('footer',$params); ?>