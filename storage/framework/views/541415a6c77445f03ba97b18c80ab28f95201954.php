<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo app('translator')->getFromJson('validation.accountingSystem'); ?> - <?php echo app('translator')->getFromJson('validation.ommar'); ?> </title>

  
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    

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
                <a class="navbar-brand" href="/home"><?php echo app('translator')->getFromJson('validation.accountingSystem'); ?></a>
               
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
                            <?php echo app('translator')->getFromJson('validation.'. Config::get('languages')[App::getLocale()]); ?> 

                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?php $__currentLoopData = Config::get('languages'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($lang != App::getLocale()): ?>
                                <li>
                                    <a href="<?php echo e(route('lang.switch', $lang)); ?>"><?php echo app('translator')->getFromJson('validation.'.$language); ?></a>
                                </li>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                   
                    <?php if(Auth::guest()): ?>
                        <li  ><a href="<?php echo e(url('/login')); ?>"><?php echo app('translator')->getFromJson('validation.login'); ?></a></li>
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
                                <li><a href="<?php echo e(url('/logout')); ?>"><i class="fa fa-btn fa-sign-out"></i><?php echo app('translator')->getFromJson('validation.logout'); ?></a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php echo app('translator')->getFromJson('validation.stores'); ?>
                           <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo e(url('/store')); ?>"><?php echo app('translator')->getFromJson('validation.add-store-item'); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(url('/stores-log')); ?>"><?php echo app('translator')->getFromJson('validation.stores-log'); ?></a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php echo app('translator')->getFromJson('validation.custody_and_advances'); ?>
                           <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/custody-advances"><?php echo app('translator')->getFromJson('validation.add-custody'); ?></a>
                                </li>
                                <li>
                                    <a href="/custody-index"><?php echo app('translator')->getFromJson('validation.custody-index'); ?></a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="/allocation"><?php echo app('translator')->getFromJson('validation.allocation'); ?></a></li>
                       <!--  <li><a href="/custody-advances"><?php echo app('translator')->getFromJson('validation.custody_and_advances'); ?></a></li>
                        <li><a href="/custody-index"><?php echo app('translator')->getFromJson('validation.custody-index'); ?></a></li> -->
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php echo app('translator')->getFromJson('validation.receipts'); ?>
                           <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo e(url('/all-receipts')); ?>"><?php echo app('translator')->getFromJson('validation.donation_receipt'); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(url('/receipts')); ?>"><?php echo app('translator')->getFromJson('validation.add_donation_receipt'); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(url('/license-receipts')); ?>"><?php echo app('translator')->getFromJson('validation.add_donation_receipt_license'); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(url('/all-cash')); ?>"><?php echo app('translator')->getFromJson('validation.all_cash'); ?></a>
                                </li>
                                 <li>
                                    <a href="<?php echo e(url('/cash-exchange-receipt')); ?>"><?php echo app('translator')->getFromJson('validation.cash-exchange-receipt'); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(url('/account-sheet')); ?>"><?php echo app('translator')->getFromJson('validation.account-sheet'); ?></a>
                                </li>
                            </ul>
                        </li>


                        <li><a href="/accounting-tree"><?php echo app('translator')->getFromJson('validation.accounting_tree'); ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

  
    <?php echo $__env->yieldContent('content'); ?>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    
</body>
</html>
