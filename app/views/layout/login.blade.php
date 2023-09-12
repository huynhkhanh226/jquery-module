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
  </head>
  <body  class="login-page">
   @yield('lcontent')
   <footer class="main-footer hide">
       <div class="row logo-footer">
           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
               {{HTML::image(asset("packages/default/L3/images/logo_footer.png"),null,['class' => 'center-block'])}}
           </div>

       </div>
   </footer>
    <!-- jQuery 2.1.4 -->
    <script src="{{asset("packages/default/plugins/jQuery/jQuery-2.1.4.min.js")}}" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{asset("packages/default/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
    <!--Bootbox -->
    <script src="{{asset("packages/default/plugins/bootstrap-bootbox/bootbox.js")}}" type="text/javascript"></script>
    <script src="{{asset("packages/default/plugins/s/s.js")}}" type="text/javascript"></script>
    <script src="{{asset("packages/default/plugins/s/j.js")}}" type="text/javascript"></script>
    @section('script')
    @show
  </body>
<input type="hidden" id="secretKey" value="{{\Config::get("app.secretKey","")}}">
</html>
