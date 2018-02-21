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

    <title> @lang('validation.accountingSystem')- @lang('validation.ommar') </title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">

    @yield('css')
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
                <a class="navbar-brand" href="/home">@lang('validation.accountingSystem')</a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <!-- <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">نظام الحسابات </a></li>
                </ul>
 -->
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar" >
                    <!-- Authentication Links -->
                    <li class="dropdown">
                   
                    @if (Auth::guest())
                        <li  ><a href="{{ url('/login') }}">@lang('validation.login')</a></li>
                        <!-- <li><a href="{{ url('/register') }}">Register</a></li> -->
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>تسجيل الخروج</a></li>
                            </ul>
                        </li>
                        <li><a href="/allocation">ميزان المراجعة</a></li>
                        <li><a href="/allocation">جرد الخزينة</a></li>
                        <li><a href="/allocation">المخصصات</a></li>
                        <li><a href="/custody-advances">العهد والسلف</a></li>
                        <li><a href="/treasury">الخزينة</a></li>
                        <li><a href="/receipts">ايصالات التبرع</a></li>
                        <li><a href="/accounting-tree">شجرة الحسابات</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- @yield('header') -->
        @yield('content')
    </div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
    @yield('scripts')
</body>
</html>
