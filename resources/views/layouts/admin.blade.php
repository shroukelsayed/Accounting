<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@lang('validation.accountingSystem') - @lang('validation.ommar') </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet"> -->
   <link rel="stylesheet" href="/Admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <!-- Ionicons -->
   
    <!-- Theme style -->
    <link rel="stylesheet" href="/Admin/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/Admin/dist/css/skins/_all-skins.min.css">
<!-- jQuery 2.1.4 -->
    <script src="/Admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
     <script src="/Admin/bootstrap/js/bootstrap.min.js"></script>
  

     <link rel="stylesheet" href="/Admin/bootstrap/css/bootstrap.min.css">

     <link href="/Admin/jquery-ui.css" rel="stylesheet" type="text/css"/>

    <style>
      #profile{
          border:2px solid white;
          width:40px;
          height:40px;
          margin-top:-8px;
      }
      #profile1{
          border:2px solid white;
          width:45px;
          height:45px;
          
      }
    </style>

    
</head>
<body>
 <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="{{ route('users.show',Auth::user()->id )}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><i class="fa fa-tasks" aria-hidden="true"></i></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>{{ Auth::user()->name}}</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            
              <li>
                <a href="/accounting-tree"><i class="fa fa-gears">&nbsp&nbsp @lang('validation.accounting_tree') </i></a>
              </li>
              
            <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img id="profile" src="{{ asset("img/1.png") }}" class="user-image" alt="User Image">
                  <span class="hidden-xs">{{Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu" style="width: 350px;">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{ asset("img/1.png") }}" class="img-circle" alt="User Image">
                    <p>
                    @if(Auth::user()->role === 1)
                      {{ Auth::user()->name }} - @lang('validation.Administrator') 
                    @else
                      {{ Auth::user()->name }} - @lang('validation.admin')
                    @endif
                      <small>@lang('validation.Membersince') {{ date('F d, Y', strtotime(Auth::user()->created_at)) }}</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                 
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="{{ route('users.show',Auth::user()->id )}}" class="btn btn-default btn-flat">@lang('validation.profile')</a>  
                    </div>
                    <div class="pull-right">
                      <a href="{{URL::to('/logout')}}" class="btn btn-default btn-flat">@lang('validation.logout')</a>
                    </div>
                  </li>
                </ul>
              </li>            
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img id="profile1"  src="{{ asset("img/1.png") }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <!-- <p>{{ Auth::user()->name }}</p> -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <ul class="sidebar-menu">
          <li></li>
            <li class="active treeview">
              <a href="{{URL::to('/home')}}">
                <i class="glyphicon glyphicon-home"></i> <span>@lang('validation.home')</span> 
              </a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-language"></i><span>@lang('validation.'. Config::get('languages') [App::getLocale()]) </span>
                  <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      @foreach (Config::get('languages') as $lang => $language)
                      @if ($lang != App::getLocale())
                      <li>
                          <a href="{{ route('lang.switch', $lang) }}"><i class="fa fa-language"></i><span>@lang('validation.'.$language)</span></a>
                      </li>
                      @endif
                      @endforeach
                  </ul>
              </li>

            @if( Auth::user()->role === 1)
             <li>
                <a href="{{URL::to('/projects')}}">
                  <i class="fa fa-th-large"></i> <span>@lang('validation.projects')</span> 
                </a>
              </li>
               <li>
                <a href="{{URL::to('/projects/create')}}">
                  <i class="fa fa-plus"></i> <span>@lang('validation.addProject')</span> 
                </a>
              </li>
             <li>
                <a href="{{URL::to('/users')}}">
                  <i class="fa fa-users"></i> <span>@lang('validation.users')</span> 
                </a>
              </li>
              <li>
                <a href="{{URL::to('/users/create')}}">
                  <i class="fa fa-user-plus"></i> <span>@lang('validation.addUser')</span> 
                </a>
              </li>
              <li>
                <a href="{{URL::to('add-expenses-item')}}">
                  <i class="fa fa-plus"></i> <span>@lang('validation.add-expenses-item')</span> 
                </a>
              </li>
              <li>
                <a href="{{URL::to('add-fawry-item')}}">
                  <i class="fa fa-plus"></i> <span>@lang('validation.add-fawry-item')</span> 
                </a>
              </li>
              <li>
                <a href="{{URL::to('add-fawry-bank')}}">
                  <i class="fa fa-plus"></i> <span>@lang('validation.add-fawry-bank')</span> 
                </a>
              </li>
              <li>
                <a href="{{URL::to('add-bank-account-item')}}">
                  <i class="fa fa-plus"></i> <span>@lang('validation.add-bank-account-item')</span> 
                </a>
              </li>
              <li>
                <a href="{{URL::to('add-worker')}}">
                  <i class="fa fa-plus"></i> <span>@lang('validation.add-worker')</span> 
                </a>
              </li>
              <li>
                <a href="{{URL::to('add-accured-item')}}">
                  <i class="fa fa-plus"></i> <span>@lang('validation.add-worker')</span> 
                </a>
              </li>
              <!-- // Start of Links to create new case ... by shrouk -->


             <!--  <li class="treeview">
                <a href="#">
                  <i class="fa fa-edit"></i> <span>New Case</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{URL::to('/projects')}}"><i class="fa fa-edit"></i> Blood Case</a></li>
                  <li><a href="{{URL::to('/projects')}}"><i class="fa fa-edit"></i> Money Case</a></li>
                  <li><a href="{{URL::to('/projects')}}"><i class="fa fa-edit"></i> Medicine Case</a></li>
                  <li><a href="{{URL::to('/projects')}}"><i class="fa fa-edit"></i> Other Case</a></li>
                </ul>
              </li> -->
          <!-- // End of Links to create new case ... by shrouk -->  
                    
              <!-- <li>
               <a href="{{URL::to('/compaigns')}}">
                  <i class="fa fa-th"></i> <span>@lang('validation.AllCompaigns')</span> 
                </a>
              </li>
              <li>
              <a href="{{URL::to('/compaigns/create')}}">
                  <i class="fa fa-edit"></i> <span>@lang('validation.NewCompaign')</span> 
                </a>
              </li> -->
              <!-- /// cases according to donation type .. by shrouk -->
            @endif
            <!-- /// end of  -->
            <li>
            <a href="{{URL::to('/logout')}}">
                <i class="fa fa-btn fa-sign-out"></i> <span>@lang('validation.logout')</span> 
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- <section class="content-header">
          <div class="row pull-right">
               <div class="col-md-12">
               @if( Auth::user()->role === 1 or Auth::user()->role === 3 )
                  <label> Filter </label>
                  <select class="form-control" onChange="window.location.href=this.value" id="filter">
                    <option selected >Plz Choose</option>
                    <option value="{{URL::to('/bloods')}}">@lang('validation.BloodCases')</option>
                    <option value="{{URL::to('/money')}}">@lang('validation.MoneyCases')</option>
                    <option value="{{URL::to('/medicines')}}"> @lang('validation.MedicineCases')</option>
                    <option value="{{URL::to('/others')}}"> @lang('validation.OtherCases')</option>
                    <option value="{{URL::to('/periodicCases')}}"> Periodic Cases</option>
                  </select>
                @endif
               </div>
          </div>
          @yield('header')
        </section> -->

        <!-- Main content -->
               
        <div class="container" style="width: 900px;">
          
          @yield('content')
        </div>
      <!-- /.content-wrapper -->
      </div>
       <div class="control-sidebar-bg"></div>
    </div>

      <!-- /.container -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2017-2018 <a href="http://almsaeedstudio.com">Boraq Digital</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
  


  <script type="text/javascript" src="Admin/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>

  
  
    
  <!-- AdminLTE App -->
    <script src="/Admin/dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
   
    <!-- AdminLTE for demo purposes -->
    <script src="/Admin/dist/js/demo.js"></script>    
    
</body>
</html>