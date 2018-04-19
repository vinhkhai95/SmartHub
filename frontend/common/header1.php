<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Lab System</title>
        <link href="common/css/bootstrap.min.css" rel="stylesheet">
        <link href="common/css/font-awesome.min.css" rel="stylesheet">
        <link href="common/css/prettyPhoto.css" rel="stylesheet">
        <link href="common/css/price-range.css" rel="stylesheet">
        <link href="common/css/animate.css" rel="stylesheet">
        <link href="common/css/main.css" rel="stylesheet">
        <link href="common/css/responsive.css" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="common/js/html5shiv.js"></script>
        <script src="common/js/respond.min.js"></script>
        <![endif]-->       
        <link rel="shortcut icon" href="common/images/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="common/images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="common/images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="common/images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="common/images/ico/apple-touch-icon-57-precomposed.png">
    </head><!--/head-->


    <body>
       <header id="header"><!--header-->
            <div class="header_top"><!--header_top-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="contactinfo">
                                <ul class="nav nav-pills">
                                    <li><a href="#"><i class="fa fa-phone"></i> +841287421885</a></li>
                                    <li><a href="#"><i class="fa fa-envelope"></i> vinhkhailecong95@gmail.com</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="social-icons pull-right">
                                <ul class="nav navbar-nav">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header_top-->

            <div class="header-middle"><!--header-middle-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="logo pull-left">
                                <a href="index.html"><img src="common/images/home/logo.png" width="200" /></a>
                            </div>
                        </div>
                        <?php include 'common/menu1.php'; ?>
                    </div>
                </div>
            </div><!--/header-middle-->

            <div class="header-bottom"><!--header-bottom-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="mainmenu pull-left">
                                <ul class="nav navbar-nav collapse navbar-collapse">
                                    <li><a href="#" class="active">Trang chủ</a></li>
                                    <li><a href="#">Tin tức</a>
                                    </li> 
                                    <li><a href="#">Download</a></li>
                                    <li><a href="#">Liên hệ</a>
                                    </li> 
                                    <li><a href="#">Diễn đàn</a></li>
                                    <li><a href="#">Bảo hành</a></li>
                                </ul>
                            </div>
                        </div>
<!--                        <div class="col-sm-3">
                            <div class="search_box pull-right">
                                <input type="text" placeholder="Search"/>
                            </div>
                        </div>-->
<div class="col-sm-4" id="search">
		    <div class="input-group">
                <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    	<span id="search_concept">Sản phẩm cần tìm</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                       
                      <li><a href="#all">Tất cả</a></li>
                       <li class="divider"></li>
                      <li><a href="#module">Module</a></li>
                      <li><a href="#kit">Kit</a></li>
                      <li><a href="#mnap">Mạch nạp</a></li>
                      <li><a href="#cambien">Cảm biến</a></li>
                      <li><a href="#ic">IC</a></li>
                      
                    </ul>
                </div>
                <input type="hidden" name="search_param" value="all" id="search_param">         
                <input type="text" class="form-control" name="x" placeholder="Search term...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </div>
                    </div>
                </div>
            </div><!--/header-bottom-->
        </header><!--/header-->
    </body>