<!DOCTYPE html>
<html lang="en">

    <!-- Mirrored from jesus.gallery/everest/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:45:00 GMT -->
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Online Shopping System" />
        <meta name="keywords" content="Admin, Dashboard" />
        <meta name="author" content="Nguyen Ngoc Anh" />
        <link rel="shortcut icon" href="common/img/favicon.ico">
        <title>Lab System</title>

        <!-- Bootstrap CSS -->
        <link href="common/css/bootstrap.min.css" rel="stylesheet" media="screen">

        <!-- Animate CSS -->
        <link href="common/css/animate.css" rel="stylesheet" media="screen">

        <!-- Main CSS -->
        <link href="common/css/main.css" rel="stylesheet" media="screen">

        <!-- Main CSS -->
        <link href="common/css/login.css" rel="stylesheet">

        <!-- Font Awesome -->
        <link href="common/css/font-awesome.min.css" rel="stylesheet">

        <!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="common/js/html5shiv.js"></script>
                <script src="common/js/respond.min.js"></script>
        <![endif]-->

    </head>  

    <body>
        <!-- Container Fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-push-4 col-md-4 col-sm-push-3 col-sm-6 col-sx-12">

                    <!-- Header end -->
                    <div class="login-container">
                        <div class="login-wrapper animated flipInY">
                            <div id="login" class="show">
                                <div class="login-header">
                                    <h4>SIGN IN TO THE WEBSITE</h4>
                                </div>
                                <form action="index.php" method="post">
                                    <input type="hidden" name="action" value="login_check"/>
                                    <div class="form-group has-feedback">
                                        <label class="control-label" for="userName">User Name</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="User Name" autofocus>
                                       
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="control-label" for="passWord>">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="*********" >
                                       
                                    </div>
                                    <input type="submit" value="Login" class="btn btn-warning btn-lg btn-block">
                                </form>
                                <div class="refor">                                    
                                    <a href="#forgot-pwd" class="underline text-info">Forgot Password?</a>
                                    <a id="register_link" href="index.php?action=customer_add" class="underline text-info">Register</a>
                                </div>
                                

                                <?php if (!empty($msg)): ?>
                                    <div class="panel">
                                        <div class="panel-body">
                                            <div class="alert alert-danger alert-transparent no-margin">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <?= $msg ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>

                            <div id="forgot-pwd" class="form-action hide">
                                <div class="login-header">
                                    <h4>Reset your Password</h4>
                                </div>
                                <form action="index.php?reset_password" method="post">
                                    <div class="form-group has-feedback">
                                        <label class="control-label" for="password3">Password</label>
                                        <input type="text" class="form-control" id="password3">
                                        <i class="fa fa-key form-control-feedback"></i>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="control-label" for="password4">Confirm password</label>
                                        <input type="text" class="form-control" id="password4">
                                        <i class="fa fa-key form-control-feedback"></i>
                                    </div>
                                    <input type="submit" value="Reset" class="btn btn-warning btn-lg btn-block">
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container Fluid ends -->

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="common/js/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="common/js/bootstrap.min.js"></script>

        <script type="text/javascript">
            (function ($) {
                // constants
                var SHOW_CLASS = 'show',
                        HIDE_CLASS = 'hide',
                        ACTIVE_CLASS = 'active';

                $('a').on('click', function (e) {
                    e.preventDefault();
                    var a = $(this),
                            href = a.attr('href');

                    $('.active').removeClass(ACTIVE_CLASS);
                    a.addClass(ACTIVE_CLASS);

                    $('.show')
                            .removeClass(SHOW_CLASS)
                            .addClass(HIDE_CLASS)
                            .hide();

                    $(href)
                            .removeClass(HIDE_CLASS)
                            .addClass(SHOW_CLASS)
                            .hide()
                            .fadeIn(550);
                });
                $('#register_link').unbind('click');
            })(jQuery);
        </script>
    </body>

    <!-- Mirrored from jesus.gallery/everest/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:45:01 GMT -->
</html>