<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>LemonWeb 4.0</title>
    <link rel="shortcut icon" href="{{asset("favicon.ico")}}"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="{{asset("packages/default/plugins/jQueryUI/jquery-ui.css")}}" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{asset("packages/default/bootstrap/css/bootstrap.css")}}" rel="stylesheet" type="text/css"/>
    <!-- Glyphicons -->
    <link href="{{asset("packages/default/glyphicons/css/glyphicons.css")}}" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome Icons -->
    <link href="{{asset("packages/default/font-awesome-4.4.0/css/font-awesome.css")}}" rel="stylesheet"
          type="text/css"/>
    <!-- Theme style -->
    <link href="{{asset("packages/default/dist/css/AdminLTE.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/dist/css/skins/_all-skins.css")}}" rel="stylesheet" type="text/css"/>
    <!-- bootstrap treeview -->
    <link href="{{asset("packages/default/plugins/treeview/css/bootstrap-treeview.css")}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("packages/default/L3/css/l3M.css")}}" rel="stylesheet" type="text/css"/>

    <!-- Javascript -->

    <!-- jQuery 2.1.4 -->
    <script src="{{asset("packages/default/plugins/jQuery/jQuery-2.1.4.min.js")}}"></script>

    <script src="{{asset("packages/default/plugins/upload/jquery.ui.widget.js")}}" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{asset("packages/default/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset("packages/default/plugins/jQueryUI/jquery-ui.min.js")}}" type="text/javascript"></script>


    <!-- FastClick -->
    <script src="{{asset("packages/default/plugins/fastclick/fastclick.min.js")}}" type="text/javascript"></script>

    <!-- treeview bootstrap -->
    <script src="{{asset("packages/default/plugins/treeview/js/bootstrap-treeview.js")}}" type="text/javascript"></script>

    <!-- AdminLTE App -->
    <script src="{{asset("packages/default/L3/js/l3.js")}}" type="text/javascript"></script>

    <!--Bootbox -->
    <script src="{{asset("packages/default/plugins/bootstrap-bootbox/bootbox.js")}}" type="text/javascript"></script>

    <script src="{{asset("packages/default/dist/js/app.js")}}" type="text/javascript"></script>

    <!--Paging -->
    <script src="{{asset("packages/default/plugins/paging/jquery.twbsPagination.js")}}" type="text/javascript"></script>
</head>

<body class="skin-blue sidebar-mini">
<div class="wrapper">
    <input type="hidden" id="gLangLayout" value="{{Session::get("Lang")}}"/>
    @if(Auth::user()->check())
        @include('layout.component.headeraside_defaultM')
        <input type="hidden" id="modelogin" value="0"/>
    @endif
    @if(Auth::ess()->check())
        @include('layout.component.headeraside_ess')
        <input type="hidden" id="modelogin" value="1" onclick="addTab('W75F0000_W75F0000_W75F0000','Self Service',4)"/>
    @endif

                <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</div>
</div>

@section('script')

@show


</body>
</html>
