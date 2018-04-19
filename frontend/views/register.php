<html>
    <head>
          <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="common/css/bootstrap.min.css" rel="stylesheet">
        <link href="common/css/font-awesome.min.css" rel="stylesheet">
        <link href="common/css/prettyPhoto.css" rel="stylesheet">
        <link href="common/css/price-range.css" rel="stylesheet">
        <link href="common/css/animate.css" rel="stylesheet">
        <link href="common/css/main.css" rel="stylesheet">
        <link href="common/css/responsive.css" rel="stylesheet">
        <script src="common/js/html5shiv.js"></script>
        <script src="common/js/respond.min.js"></script>
        <link rel="shortcut icon" href="common/images/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="common/images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="common/images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="common/images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="common/images/ico/apple-touch-icon-57-precomposed.png">
    </head><!--/head-->
    </head>
    <body>
<?php include 'common/header.php'; ?>
<!-- Dashboard Wrapper starts -->
<div class="dashboard-wrapper"> 

    <!-- Main Container starts -->
    <div class="main-container"> 

        <!-- Container fluid Starts -->
        <div class="container-fluid"> 

            <!-- Spacer starts -->
            <div class="spacer">
                <!-- Row Starts -->
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">        
                        <div class="blog">
                            <div class="blog-body">
                                <form  id="defaultForm" method="post" action="index.php" 
                                      class="form-horizontal">
                                    <input type="hidden" name="action" value="customer_add_save">
                                    <fieldset>
                                        <h1 style="text-align: center">Register Form</h1>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Full Name</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="name" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">User Name</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="username" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Password</label>
                                            <div class="col-lg-9">
                                                <input type="password" class="form-control" name="password" />
                                            </div>
                                        </div>
<!--                                        <div class="form-group">-->
<!--                                            <label class="col-lg-3 control-label">Email</label>-->
<!--                                            <div class="col-lg-9">-->
<!--                                                <input type="email" class="form-control" name="email" />-->
<!--                                            </div>-->
<!--                                        </div>-->
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Phone Number</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="phone" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Gender</label>
                                            <div class="col-lg-6">
                                                <label class="radio-inline">
                                                    <input type="radio" name="gender" value="1" checked="true"> Male
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="gender" value="0"> Female
                                                </label>
                                            </div>
                                        </div>
                                        

<!--                                    </fieldset>-->
                                    

                                    <div class="form-group">
                                        <div class="col-lg-6 col-lg-offset-6">
                                            <button type="submit" class="btn btn-success">Register</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row Ends --> 

        </div>
        <!-- Spacer ends --> 

    </div>
    <!-- Container fluid ends -->

</div>
<!-- Main Container ends --> 



    </body>
</html>
