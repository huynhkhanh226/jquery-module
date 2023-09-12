<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>LemonWeb</title>
      <link rel="shortcut icon"  href="{{asset("favicon.ico")}}" />

      <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="{{asset("packages/default/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
     <link href="{{asset("packages/default/font-awesome-4.4.0/css/font-awesome.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{asset("packages/default/dist/css/AdminLTE.css")}}" rel="stylesheet" type="text/css" />

      <link href="{{asset("packages/default/L3/css/l3.css")}}" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body  class="login-page">

   @yield('lcontent')

    <!-- jQuery 2.1.4 -->
    <script src="{{asset("packages/default/plugins/jQuery/jQuery-2.1.4.min.js")}}" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{asset("packages/default/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="{{asset("packages/default/plugins/iCheck/icheck.min.js")}}" type="text/javascript"></script>

    @section('script')
    @show
  </body>
</html>
