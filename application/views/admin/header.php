<?php
$userAdmin=$this->session->userdata(APP_NAME.'_admin');

//print_r($this->session->userdata());
//print_r($userAdmin);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="no-js" lang="">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin::&nbsp;<?php echo APP_NAME; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="<?php echo base_url();?>apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
    <script src="<?php echo base_url();?>assets/js/vendor/modernizr-2.8.3.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
         <script src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>
        <script src="<?php echo base_url();?>assets/js/main.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
    <header class="text-center">
        <div class="container">
            <div class="row">
                <div class="logo-Wrapper center-block">
                    <a class="navbar-brand" href="#">
                     <img alt="Dukkani" src="<?php echo base_url();?>assets/img/logo.png">
                    </a>
                </div>
            </div>
        </div>
    </header>
    <?php
    if(isset($userAdmin))
   //echo('Session'.$userAdmin);
        if($this->session->userdata(APP_NAME.'_admin')!=false){
    ?>
    <div id="navigation">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-default">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                        aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        
                        <ul class="nav navbar-nav">
                           
                            <?php if($userAdmin == '1'){ ?>
                            <li <?php if($pageName == 'sub-admins') echo 'class="active"';?> ><a href="<?php echo base_url();?>admin/Users/index">Sub-Admin</a></li>
                             <?php } ?>
                            <li <?php if($pageName == 'profile') echo 'class="active"';?> ><a href="<?php echo base_url();?>admin/Users/profile/<?php echo $userAdmin;?>" >Profile</a></li>
                            <li <?php if($pageName == 'users') echo 'class="active"';?> ><a href="<?php echo base_url();?>admin/Users/viewUsers/">Users</a></li>
                            <li <?php if($pageName == 'orders') echo 'class="active"';?> ><a href="<?php echo base_url();?>admin/Orders/index/">Orders</a></li>
                            <li <?php if($pageName == 'stores') echo 'class="active"';?> ><a href="<?php echo base_url();?>admin/Stores/index">Grocery &amp; Stores</a></li>
                            <li <?php if($pageName == 'settings') echo 'class="active"';?> ><a href="<?php echo base_url();?>admin/Users/settings/<?php echo $userAdmin;?>">Settings</a></li>
                            <!-- <li class="active"><a href="#">Grocery &amp; Stores</a></li> -->
                            <?php
                            if($this->session->userdata(APP_NAME.'_admin')!=false){ ?>
                                 <li><a href="<?php echo base_url();?>admin/index/logout/">Logout</a></li>
                            <?php } ?>
                       
        
                            
                        </ul>
                        <?php } ?>


                    </div>
                    <!-- /.navbar-collapse -->
                </nav>


            </div>
        </div>
    </div>
