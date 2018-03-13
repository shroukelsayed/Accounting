<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo app('translator')->get('validation.accountingSystem'); ?> - <?php echo app('translator')->get('validation.ommar'); ?> </title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <?php /* <link href="<?php echo e(elixir('css/app.css')); ?>" rel="stylesheet"> */ ?>

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header" style="float: right;">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="/home"><?php echo app('translator')->get('validation.accountingSystem'); ?></a>
               
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <!-- <ul class="nav navbar-nav">
                    <li><a href="<?php echo e(url('/home')); ?>">نظام الحسابات </a></li>
                </ul>
 -->
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar" >
                    <!-- Authentication Links -->
                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php echo app('translator')->get('validation.'. Config::get('languages')[App::getLocale()]); ?> 

                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?php foreach(Config::get('languages') as $lang => $language): ?>
                                <?php if($lang != App::getLocale()): ?>
                                <li>
                                    <a href="<?php echo e(route('lang.switch', $lang)); ?>"><?php echo app('translator')->get('validation.'.$language); ?></a>
                                </li>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                   
                    <?php if(Auth::guest()): ?>
                        <li  ><a href="<?php echo e(url('/login')); ?>"><?php echo app('translator')->get('validation.login'); ?></a></li>
                        <!-- <li><a href="<?php echo e(url('/register')); ?>">Register</a></li> -->
                    <?php else: ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
                               <i class="fa fa-user-circle-o"></i> <?php echo e(Auth::user()->name); ?><span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <?php if(Auth::user()->role ==1): ?>
                                    <li><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-btn fa-sign-out"></i>Control Panel</a></li>
                                <?php endif; ?>
                                <li><a href="<?php echo e(url('/logout')); ?>"><i class="fa fa-btn fa-sign-out"></i><?php echo app('translator')->get('validation.logout'); ?></a></li>
                            </ul>
                        </li>
                        <li><a href="/allocation"><?php echo app('translator')->get('validation.allocation'); ?></a></li>
                        <li><a href="/allocation"><?php echo app('translator')->get('validation.allocation'); ?></a></li>
                        <li><a href="/custody-advances"><?php echo app('translator')->get('validation.custody_and_advances'); ?></a></li>
                        <li><a href="/treasury"><?php echo app('translator')->get('validation.treasury'); ?></a></li>
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php echo app('translator')->get('validation.receipts'); ?>
                           <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo e(url('/all-receipts')); ?>"><?php echo app('translator')->get('validation.donation_receipt'); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(url('/receipts')); ?>"><?php echo app('translator')->get('validation.add_donation_receipt'); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(url('/cash-receipt')); ?>"><?php echo app('translator')->get('validation.cash_receipt'); ?></a>
                                </li>
                            </ul>
                        </li>


                        <li><a href="/accounting-tree"><?php echo app('translator')->get('validation.accounting_tree'); ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

  
    <?php echo $__env->yieldContent('content'); ?>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <?php /* <script src="<?php echo e(elixir('js/app.js')); ?>"></script> */ ?>
</body>
</html>
