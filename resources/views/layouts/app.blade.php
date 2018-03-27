<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@lang('validation.accountingSystem') - @lang('validation.ommar') </title>

  
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

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
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            @lang('validation.'. Config::get('languages')[App::getLocale()]) 

                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @foreach (Config::get('languages') as $lang => $language)
                                @if ($lang != App::getLocale())
                                <li>
                                    <a href="{{ route('lang.switch', $lang) }}">@lang('validation.'.$language)</a>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </li>
                   
                    @if (Auth::guest())
                        <li  ><a href="{{ url('/login') }}">@lang('validation.login')</a></li>
                        <!-- <li><a href="{{ url('/register') }}">Register</a></li> -->
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
                               <i class="fa fa-user-circle-o"></i> {{ Auth::user()->name }}<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                @if (Auth::user()->role ==1)
                                    <li><a href="{{ url('/admin') }}"><i class="fa fa-btn fa-sign-out"></i>Control Panel</a></li>
                                @endif
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>@lang('validation.logout')</a></li>
                            </ul>
                        </li>
                        <li><a href="/allocation">@lang('validation.allocation')</a></li>
                        <li><a href="/allocation">@lang('validation.allocation')</a></li>
                        <li><a href="/custody-advances">@lang('validation.custody_and_advances')</a></li>
                        <li><a href="/treasury">@lang('validation.treasury')</a></li>
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            @lang('validation.receipts')
                           <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ url('/all-receipts') }}">@lang('validation.donation_receipt')</a>
                                </li>
                                <li>
                                    <a href="{{ url('/receipts') }}">@lang('validation.add_donation_receipt')</a>
                                </li>
                                <li>
                                    <a href="{{ url('/license-receipts') }}">@lang('validation.add_donation_receipt_license')</a>
                                </li>
                                <li>
                                    <a href="{{ url('/cash-receipt') }}">@lang('validation.cash_receipt')</a>
                                </li>
                            </ul>
                        </li>


                        <li><a href="/accounting-tree">@lang('validation.accounting_tree')</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

  
    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
