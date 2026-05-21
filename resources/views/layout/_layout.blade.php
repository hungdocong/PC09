<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>@yield('title') | PC09</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/favicon.jpg')}}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap 3.3.4 -->
    <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    {{-- <link href="{{asset('assets/bootstrap/css/jquery-ui.css')}}" rel="stylesheet" type="text/css" /> --}}
    <!-- FontAwesome 4.3.0 -->
    {{-- <link href="{{asset('assets/bootstrap/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" /> --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    {{-- <link href="{{asset('assets/bootstrap/css/ionicons.min.css')}}" rel="stylesheet" type="text/css" /> --}}
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/iCheck/all.css')}}" rel="stylesheet" type="text/css" />

     <link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- iCheck -->
    <link href="{{asset('assets/plugins/iCheck/flat/blue.css')}}" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="{{asset('assets/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="{{asset('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="{{asset('assets/plugins/datepicker/datepicker3.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{asset('assets/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
     <link href="{{asset('assets/dist/css/skins/_all-skins.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->

    <link href="{{asset('assets/c3/c3.css')}}" rel="stylesheet" type="text/css" />

    {{-- <link href="{{asset('assets/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="{{asset('assets/plugins/fullcalendar/fullcalendar.print.css')}}" rel="stylesheet" type="text/css" media="print" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.5/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.5/dist/fullcalendar.print.css" rel="stylesheet" media="print">

    {{-- <link href="{{asset('assets/fullcalendar3.10.5/dist/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="{{asset('assets/fullcalendar3.10.5/dist/fullcalendar.print.css')}}" rel="stylesheet" type="text/css" /> --}}
    <!-- Daterange picker -->
    <link href="{{asset('assets/plugins/daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="{{asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/dist/css/style.css')}}" rel="stylesheet" type="text/css" />
     <link href="{{asset('assets/plugins/daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/notify/css/BrightTheme.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/notify/css/PNotify.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/notify/css/PNotifyBootstrap3.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/notify/css/PNotifyConfirm.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('assets/notify/js/PNotify.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/notify/js/PNotifyBootstrap3.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/notify/js/PNotifyConfirm.js')}}" type="text/javascript"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')}}"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>
    <![endif]-->
  </head>

  <body class="skin-blue sidebar-mini">
   {{-- @if(Session::get('author') === null)
      <script>window.location = "/admin/login.html";</script>
   @endif --}}
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>PC09</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Kỹ thuật hình sự</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{asset('assets/img/user/default-avatar.png' )}}" class="user-image" alt="User Image" />
                  <span class="hidden-xs">Administrator</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{asset('assets/img/user/default-avatar.png' )}}" class="img-circle" alt="User Image" />
                    <p>
                      Administrator
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="/admin/change-password.html" class="btn btn-default btn-flat">Đổi mật khẩu</a>
                    </div>
                    <div class="pull-right">
                      <a href="/admin/logout" class="btn btn-default btn-flat">Đăng xuất</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
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
              <img src="{{asset('assets/img/user/default-avatar.png' )}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>Administrator</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..." />
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>-->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu menuleft">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="/">
                <i class="fa fa-dashboard"></i> <span>Trang chủ</span></i>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i> <span>Quản lý giám định</span><i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu menuleft">
                <li><a href="/giam-dinh/danh-sach.html"><i class="fa fa-tasks"></i>Danh sách vụ việc</a></li>
                <li><a href="/giam-dinh/cham-cong.html"><i class="fa fa-check-square-o"></i>Chấm công</a></li>
                {{-- <li><a href="/giam-dinh/van-toc.html"><i class="fa fa-cab"></i>Tính vận tốc</a></li> --}}
                <li><a href="/don-vi/danh-sach.html"><i class="fa fa-building"></i>Đơn vị trưng cầu</a></li>
                <li><a href="/giam-dinh/linh-vuc.html"><i class="fa fa-check-square-o"></i>Lĩnh vực giám định</a></li>
                {{-- <li><a href="/don-vi/nhap-vu-viec.html"><i class="fa fa-plus"></i>Nhập vụ việc</a></li> --}}
              </ul>
            </li>
            {{--  <li class="treeview">
              <a href="/thong-ke/index.html">
                <i class="fa fa-search"></i> <span>Thống kê vụ việc</span></i>
              </a>
            </li>--}}
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Quản lý cán bộ</span><i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu menuleft">
                <li><a href="/can-bo/danh-sach.html"><i class="fa fa-check-square-o"></i> Danh sách cán bộ</a></li>
                <li><a href="/doi/danh-sach.html"><i class="fa fa-check-square"></i> Danh sách đội</a></li>
                <li><a href="/can-bo/them-moi.html"><i class="fa fa-circle-o"></i>Thêm mới cán bộ</a></li>
              </ul>
            </li>
          {{--  <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Quản lý lịch trực</span><i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu menuleft">
                <li><a href="/lich-truc/danh-sach.html"><i class="fa fa-pencil"></i>Lịch trực ban - Khám nghiệm</a></li>
                <li><a href="/lich-truc/lich-truc-khac.html"><i class="fa fa-user"></i> Lịch trực khác</a></li>
              </ul>
            </li> --}}

             <li class="treeview">
              <a href="#">
                <i class="fa fa-bars"></i> <span>Quản lý công văn</span><i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu menuleft">
                <li><a href="/cong-van/danh-sach/{{ Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('Y') }}">
                  <i class="fa fa-tasks"></i>Danh sách - tra cứu công văn</a>
                </li>
                <li><a href="/cong-van/them-moi.html"><i class="fa fa-check-square-o"></i>Nhập công văn</a></li>
                <li><a href="/cong-van/loai-cong-van.html"><i class="fa fa-plus-square"></i>Loại công văn</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-newspaper-o"></i> <span>Khám nghiệm hiện trường</span><i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu menuleft">
                <li><a href="/knht/danh-sach.html"><i class="fa fa-tasks"></i>Danh sách vụ việc</a></li>
                <li><a href="/knht/thong-ke.html"><i class="fa fa-search"></i>Thống kê vụ việc</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="/thong-ke/index.html">
                <i class="fa fa-search"></i> <span>Thống kê - tra cứu</span></i>
              </a>
            </li>
             {{-- <li class="treeview">
              <a href="#">
                <i class="fa fa-inbox"></i> <span>Quản lý truy cập</span><i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu menuleft">
                <li><a href="/admin/about.html"><i class="fa fa-tasks"></i>Danh sách truy cập</a></li>
                <li><a href="/admin/contact.html"><i class="fa fa-check-square-o"></i>Lịch sử truy cập</a></li>
              </ul>

            </li> --}}
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      @yield('content')

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy;  <script>document.write(new Date().getFullYear());</script> <a href="http://almsaeedstudio.com">Phòng Kỹ thuật hình sự </a> - Công an tỉnh Quảng Ngãi</strong>
      </footer>
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    {{-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script> --}}
    <script src="{{asset('assets/plugins/jQueryUI/jquery-ui.min.js')}}" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script type="text/javascript">
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    {{-- <script src="{{asset('assets/plugins/jQueryUI/jquery-ui.js')}}" type="text/javascript"></script> --}}
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!-- Morris.js charts -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> --}}
    <script src="{{asset('assets/plugins/raphael-min.js')}}" type="text/javascript"></script>
    {{-- <script src="{{asset('assets/plugins/morris/morris.min.js')}}" type="text/javascript"></script> --}}
    <!-- Sparkline -->
    <script src="{{asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="{{asset('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}" type="text/javascript"></script>

    <!-- jQuery Knob Chart -->
    <script src="{{asset('assets/plugins/knob/jquery.knob.js')}}" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/moment.min.js')}}" type="text/javascript"></script>
     <script src="{{asset('assets/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
     <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.5/dist/fullcalendar.min.js"></script>
     {{-- <script src="{{asset('assets/fullcalendar3.10.5/dist/fullcalendar.min.js')}}"></script>--}}
    <script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}" type="text/javascript"></script> 
    <!-- datepicker -->
    <script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="{{asset('assets/plugins/slimScroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="{{asset('assets/plugins/fastclick/fastclick.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/select2/select2.full.min.js')}}" type="text/javascript"></script>
    
    <!-- AdminLTE App -->
    <script src="{{asset('assets/dist/js/app.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/c3/c3.js')}}" type="text/javascript"></script>
    {{-- <script src="http://d3js.org/d3.v5.min.js"></script> --}}
    {{-- <script src="https://c3js.org/js/d3-5.8.2.min-c5268e33.js"></script> --}}
    <script src="{{asset('assets/c3/d3-5.8.2.min-c5268e33.js')}}" type="text/javascript"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('assets/dist/js/pages/dashboard.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/dist/js/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/dist/js/bootstrap-datepicker.vi.min.js')}}" type="text/javascript"></script>
    {{-- <script src="{{asset('assets/plugins/ckeditor/ckeditor.js')}}" type="text/javascript"></script> --}}
    {{-- <script src="https://cdn.ckeditor.com/4.17.1/full-all/ckeditor.js"></script> --}}

    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('assets/dist/js/demo.js')}}" type="text/javascript"></script>
    <script>
        var url = window.location;
        var element = $('ul.menuleft a').filter(function() {
          return this.href == url || url.href.indexOf(this.href) == 0;
        }).parent().addClass('active').parent().addClass('in').parent();
        if (element.is('li')) {
          element.addClass('active');
        }

        var element = $('ul.nav-pills a').filter(function() {
          return this.href == url || url.href.indexOf(this.href) == 0;
        }).parent().addClass('active');
        if (element.is('li')) {
          element.addClass('active');
        }
    </script>

    @yield('jsAdmin')
  </body>
</html>
