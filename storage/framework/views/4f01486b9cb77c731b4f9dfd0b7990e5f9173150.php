<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title> <?php echo app('translator')->get('validation.accountingSystem'); ?>- <?php echo app('translator')->get('validation.ommar'); ?> </title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">

    <?php echo $__env->yieldContent('css'); ?>
</head>

<body>

    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header" style="float: right;">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
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
                   
                    <?php if(Auth::guest()): ?>
                        <li  ><a href="<?php echo e(url('/login')); ?>"><?php echo app('translator')->get('validation.login'); ?></a></li>
                        <!-- <li><a href="<?php echo e(url('/register')); ?>">Register</a></li> -->
                    <?php else: ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
                                <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo e(url('/logout')); ?>"><i class="fa fa-btn fa-sign-out"></i>تسجيل الخروج</a></li>
                            </ul>
                        </li>
                        <li><a href="/allocation">ميزان المراجعة</a></li>
                        <li><a href="/allocation">جرد الخزينة</a></li>
                        <li><a href="/allocation">المخصصات</a></li>
                        <li><a href="/custody-advances">العهد والسلف</a></li>
                        <li><a href="/treasury">الخزينة</a></li>
                        <li><a href="/receipts">ايصالات التبرع</a></li>
                        <li><a href="/accounting-tree">شجرة الحسابات</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- <?php echo $__env->yieldContent('header'); ?> -->
        <?php echo $__env->yieldContent('content'); ?>
    </div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
