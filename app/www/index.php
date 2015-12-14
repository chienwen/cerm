<?php

    require('system.inc.php');

    if(isset($_POST['action']) && $_POST['action'] === 'login') {
        if(checkLogin($_POST)){
            header('Location: ?v='.$_POST['done']);
        }
        else{
            requireLogin($pageModel['view'], true);
        }
        exit(0);
    }

    $pageModel = array('view' => 'dashboard');
    if(isset($_GET['v']) && preg_match('/^[a-z]+$/', $_GET['v'])){        
        $pageModel = array('view' => $_GET['v']);
    }

    if($pageModel['view'] === 'mycards' || $pageModel['view'] === 'payment') {
        requireLogin($pageModel['view']);
    }

?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo PRODUCT_NAME;?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/landing-page.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="index.php?v=dashboard"><?php echo PRODUCT_NAME;?></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <?php if(!empty($_SESSION['login'])){ ?>
                    <li>
                        <div style="margin-left:15px">
                            Hello
                            <?php
                            print_r($_SESSION['login']['displayName']);
                            ?>
                            <div>
                                <a href="logout.php">logout</a>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="?v=dashboard">Dashboard</a>
                    </li>
                    <li>
                        <a href="?v=mycards">My Cards</a>
                    </li>
                    <li>
                        <a href="?v=payment">Payment</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Header -->

    <?php
    
        $viewFile = 'view.'.$pageModel['view'].'.inc.php';
        if(file_exists($viewFile)){
            include($viewFile);
        }
        else{
            include('view.error.inc.php');
        }
    
    ?>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline">
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#about">About</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#services">Services</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#contact">Contact</a>
                        </li>
                    </ul>
                    <p class="copyright text-muted small">Copyright &copy; <?php echo PRODUCT_NAME;?> <?php echo date('Y');?>. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="js/custom.js"></script>

</body>

</html>
