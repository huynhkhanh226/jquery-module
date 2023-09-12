<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>LemonWeb 4.0</title>
    <link rel="shortcut icon" href="{{asset("favicon.ico")}}"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="{{asset("packages/default/plugins/jQueryUI/jquery-ui.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/jQueryUI/jquery-ui.theme.min.css")}}" rel="stylesheet"
          type="text/css"/>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{asset("packages/default/bootstrap/css/bootstrap.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/timepicker/bootstrap-timepicker.min.css")}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("packages/default/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css")}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/bootstrap-select/css/bootstrap-select.css")}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("packages/default/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css")}}"
          rel="stylesheet" type="text/css"/>
    <!-- Glyphicons -->
    <link href="{{asset("packages/default/glyphicons/css/glyphicons.css")}}" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome Icons -->
    <link href="{{asset("packages/default/font-awesome-4.4.0/css/font-awesome.css")}}" rel="stylesheet"
          type="text/css"/>
    <!-- Theme style -->
    <link href="{{asset("packages/default/dist/css/AdminLTE.css")}}" rel="stylesheet" type="text/css"/>
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="{{asset("packages/default/dist/css/skins/_all-skins.css")}}" rel="stylesheet" type="text/css"/>
    <!-- Date Picker -->
    <link href="{{asset("packages/default/plugins/datepicker/datepicker3.css")}}" rel="stylesheet" type="text/css"/>
    <!-- Daterange picker -->
    <link href="{{asset("packages/default/plugins/daterangepicker/daterangepicker-bs3.css")}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("packages/default/plugins/scrolltabs/css/scrolltabs.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/fullcalendar/fullcalendar.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/fullcalendar/scheduler.min.css")}}" rel="stylesheet" type="text/css"/>
    <!-- bootstrap treeview -->
    <link href="{{asset("packages/default/plugins/treeview/css/bootstrap-treeview.css")}}" rel="stylesheet"
          type="text/css"/>
    <!-- bootstrap treeview -->
    <link href="{{asset("packages/default/plugins/folder-tree/css/filetree.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/jplayer/skin/blue.monday/css/jplayer.blue.monday.css")}}"
          rel="stylesheet"
          type="text/css"/>
    {{--Select--}}
    <link href="{{asset("packages/default/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>
    <!-- scroller -->
    <link href="{{asset("packages/default/plugins/custom-scroller/jquery.mCustomScrollbar.css")}}" rel="stylesheet"
          type="text/css"/>
    <!-- upload multi-file -->
    <link href="{{asset("packages/default/plugins/upload/jquery.fileupload.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/paramquery-3.3.4/pqgrid.min.css")}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("packages/default/plugins/paramquery-3.3.4/pqgrid.ui.min.css")}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("packages/default/plugins/paramquery-3.3.4/themes/steelblue/pqgrid.css")}}" rel="stylesheet"
          type="text/css"/>

    <!-- dropdown search paramquery -->
    <link href="{{asset("packages/default/plugins/paramquery-3.3.4/pqSelect/pqselect.min.css")}}" rel="stylesheet"
          type="text/css"/>

    <link href="{{asset("packages/default/plugins/multiselect/bootstrap-multiselect.css")}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("packages/default/plugins/jquery.qtip.custom/jquery.qtip.css")}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("packages/default/plugins/jQuery-contextMenu/jquery.contextMenu.css")}}" rel="stylesheet"
          type="text/css"/>
    <!-- new combo -->
    <link href="{{asset("packages/default/plugins/bootstrap-combobox/css/bootstrap-combobox.css")}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("packages/default/plugins/bootstrap-toggle/css/bootstrap-toggle.css")}}" rel="stylesheet"
          type="text/css"/>


    <link href="{{asset("packages/default/L3/css/cube-loading.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/L3/css/l3.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/L3/css/birt.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/digi-menu/digi-menu.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/digi-contextmenu/digi-contextmenu.css")}}" rel="stylesheet"
          type="text/css"/>
    <!-- orgchart -->
    <link href="{{asset("packages/default/plugins/OrgChart/jquery.orgchart.css")}}" rel="stylesheet" type="text/css"/>
    <!-- dropDownTreeView -->
    <link href="{{asset("packages/default/plugins/DevExtreme/dx.common.css")}}" rel="stylesheet" type="text/css"/>
    {{--<link href="https://cdn3.devexpress.com/jslib/18.1.4/css/dx.light.css"  rel="dx-theme" data-theme="generic.light" type="text/css"/>--}}
    <link href="{{asset("packages/default/plugins/DevExtreme/dx.light.css")}}" rel="dx-theme" data-theme="generic.light"
          type="text/css"/>
    <link href="{{asset("packages/default/plugins/DropDownTreeView/DropDownTreeView.css")}}" rel="stylesheet"
          type="text/css"/>
    <script>
        bPressOk = false;
        bPressNo = false;
        bCancel = false;
        var lang_text = '{' +
            '"languages":[' +
            '{"order":"0","msg":"{{Helpers::getRS(0,"MSG000028")}}"},' +
            '{"order":"1","msg":"{{Helpers::getRS(0,"Du_lieu_da_duoc_luu_thanh_cong")}}"},' +
            '{"order":"2","msg":"{{Helpers::getRS(0,"MSG000027")}}"},' +
            '{"order":"3","msg":"{{Helpers::getRS(0,"MSG000008")}}"},' +
            '{"order":"4","msg":"{{Helpers::getRS(0,"Ban_co_muon_khong_luu_du_lieu_nay_khong")}}"},' +
            '{"order":"5","msg":"{{Helpers::getRS(0,"Khong_luu_duoc_du_lieu")}}"},' +
            '{"order":"6","msg":"{{Helpers::getRS(0,"Ban_phai_nhap_du_lieu")}}"},' +
            '{"order":"7","msg":"{{Helpers::getRS(0,"Ban_chua_chon_du_lieu")}}"},' +
            '{"order":"8","msg":"{{Helpers::getRS(0,"Ma_co_ky_tu_khong_hop_le")}}"}' +
            ']}';

        var url_alert = "{{url("/alert")}}";
        var documentWidth = 0, documentHeight = 0, tabMainHeight = 0;
    </script>
</head>

<body class="skin-blue sidebar-mini">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<div class="wrapper">
    <input type="hidden" id="gLangLayout" value="{{Session::get("Lang")}}"/>
    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>
    <div class="control-sidebar-bg"></div>
</div>
<!-- jQuery 2.1.4 -->
<script src="{{asset("packages/default/plugins/jQuery/jQuery-2.1.4.min.js")}}"></script>
<script src="{{asset("packages/default/plugins/jQuery-contextMenu/jquery.contextMenu.js")}}"
        type="text/javascript"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{asset("packages/default/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
<script type="text/javascript">
    //  $.fn.bootstrapBtn = $.fn.button.noConflict();
    $.fn.bstooltip = $.fn.tooltip.noConflict();
</script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset("packages/default/plugins/jQueryUI/jquery-ui.js")}}" type="text/javascript"></script>
<!--upload multi-file -->
<script src="{{asset("packages/default/plugins/upload/jquery.fileupload.js")}}" type="text/javascript"></script>

<script src="{{asset("packages/default/plugins/upload/jquery.ui.widget.js")}}" type="text/javascript"></script>

<!-- daterangepicker -->
<script src="{{asset("packages/default/plugins/fullcalendar/lib/moment.min.js")}}" type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/daterangepicker/daterangepicker.js")}}" type="text/javascript"></script>
<!-- datepicker -->

<script src="{{asset("packages/default/plugins/datepicker/bootstrap-datepicker.js")}}" type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/timepicker/bootstrap-timepicker.min.js")}}"
        type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/bootstrap-switch/js/bootstrap-switch.js")}}"
        type="text/javascript"></script>

<script src="{{asset("packages/default/plugins/datepicker/date.js")}}" type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/datepicker/locales/bootstrap-datepicker.vi.js")}}"
        type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/bootstrap-confirm/bootstrap-confirmation.js")}}"
        type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js")}}"
        type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/bootstrap-select/js/bootstrap-select.js")}}"
        type="text/javascript"></script>
@if (Session::get("Lang")=="84")
    <script src="{{asset("packages/default/plugins/bootstrap-select/js/i18n/defaults-vi_VI.js")}}"
            type="text/javascript"></script>
@elseif(Session::get("Lang")=="86")
    <script src="{{asset("packages/default/plugins/bootstrap-select/js/i18n/defaults-zh_CN.js")}}"
            type="text/javascript"></script>
@endif
<!--Fullcalendar -->
<script src="{{asset("packages/default/plugins/fullcalendar/fullcalendar.js")}}" type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/fullcalendar/scheduler.min.js")}}" type="text/javascript"></script>
{{--Select--}}
<script src="{{asset("packages/default/plugins/select2/js/select2.full.min.js")}}" type="text/javascript"></script>
<!-- scrollTab App -->
<script src="{{asset("packages/default/plugins/scrolltabs/js/jquery.mousewheel.js")}}" type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/scrolltabs/js/jquery.scrolltabs.js")}}" type="text/javascript"></script>
<!-- Slimscroll -->
<script src="{{asset("packages/default/plugins/slimScroll/jquery.slimscroll.min.js")}}" type="text/javascript"></script>
<!-- InputMask -->
<script src="{{asset("packages/default/plugins/input-mask/jquery.inputmask.bundle.js")}}"
        type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/input-mask/jquery.inputmask.js")}}" type="text/javascript"></script>
<!-- FastClick -->
<script src="{{asset("packages/default/plugins/fastclick/fastclick.min.js")}}" type="text/javascript"></script>
<!-- treeview bootstrap -->
<script src="{{asset("packages/default/plugins/treeview/js/bootstrap-treeview.js")}}" type="text/javascript"></script>
<!-- Param query grid -->
<script src="{{asset("packages/default/plugins/paramquery-3.3.4/pqgrid.min.js")}}" type="text/javascript"></script>

<!-- dropdown search paramquery -->
<script src="{{asset("packages/default/plugins/paramquery-3.3.4/pqSelect/pqselect.min.js")}}"
        type="text/javascript"></script>

<script src="{{asset("packages/default/plugins/paramquery-3.3.4/jsZip-2.5.0/jszip.min.js")}}"
        type="text/javascript"></script>
@if (Session::get("Lang")=="84")
    <script src="{{asset("packages/default/plugins/paramquery-3.3.4/localize/pq-localize-vi.js")}}"
            type="text/javascript"></script>
@elseif(Session::get("Lang")=="86")
    <script src="{{asset("packages/default/plugins/paramquery-3.3.4/localize/pq-localize-zh.js")}}"
            type="text/javascript"></script>
@elseif(Session::get("Lang")=="01")
    <script src="{{asset("packages/default/plugins/paramquery-3.3.4/localize/pq-localize-en.js")}}"
            type="text/javascript"></script>
@elseif(Session::get("Lang")=="81")
    <script src="{{asset("packages/default/plugins/paramquery-3.3.4/localize/pq-localize-ja.js")}}"
            type="text/javascript"></script>
@endif
<!-- multiselect -->
<script src="{{asset("packages/default/plugins/multiselect/bootstrap-multiselect.js")}}"
        type="text/javascript"></script>

<!-- tableHeadFixer -->
<script src="{{asset("packages/default/plugins/tableHeadFixer/tableHeadFixer.js")}}" type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/tableHeadFixer/tablefreeze.js")}}" type="text/javascript"></script>

<script src="{{asset("packages/default/plugins/jquery-mousewheel/jquery.mousewheel.js")}}"
        type="text/javascript"></script>

<!-- AdminLTE App -->
<script src="{{asset("packages/default/L3/js/l3.js")}}" type="text/javascript"></script>

<!--Bootbox -->
<script src="{{asset("packages/default/plugins/bootstrap-bootbox/bootbox.js")}}" type="text/javascript"></script>
<!--Notify -->
<script src="{{asset("packages/default/plugins/bootstrap-notify/bootstrap-notify.js")}}"
        type="text/javascript"></script>
<!--new combo -->
<script src="{{asset("packages/default/plugins/bootstrap-combobox/js/bootstrap-combobox.js")}}"
        type="text/javascript"></script>
<!--html5gallery -->
<script src="{{asset("packages/default/plugins/html5gallery/html5gallery.js")}}" type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/jplayer/jquery.jplayer.js")}}" type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/jplayer/add-on/jplayer.playlist.js")}}" type="text/javascript"></script>
<!-- jssor -->
<script src="{{asset("packages/default/plugins/jssor-slider/jssor.slider.min.js")}}" type="text/javascript"></script>
<!-- scroller Không được include file jquery.mCustomScrollbar.concat.min.js do bị conflict với scrollbar pqgrid-->
<script src="{{asset("packages/default/plugins/custom-scroller/jquery.mCustomScrollbar.js")}}"
        type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/nicescroll/jquery.nicescroll.min.js")}}" type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/jssor-slider/ImageTools.js")}}" type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/bootstrap-toggle/js/bootstrap-toggle.js")}}"
        type="text/javascript"></script>


<script src="{{asset("packages/default/dist/js/app.js")}}" type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/file-saver/FileSaver.js")}}" type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/ckeditor/ckeditor.js")}}" type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/jquery.qtip.custom/jquery.qtip.js")}}" type="text/javascript"></script>
<!--Paging -->
<script src="{{asset("packages/default/plugins/paging/jquery.twbsPagination.js")}}" type="text/javascript"></script>

<!--Tableau -->
<script src="{{asset("packages/default/plugins/Tableau/tableau-2.js")}}" type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/inline-css/jquery.inlineStyler.min.js")}}"
        type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/s/s.js")}}" type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/s/j.js")}}" type="text/javascript"></script>

<script src="{{asset("packages/default/plugins/tableExport.jquery/tableExport.js")}}"></script>
<script src="{{asset("packages/default/plugins/digi-menu/digi-menu.js")}}"></script>
<script src="{{asset("packages/default/plugins/digi-contextmenu/digi-contextmenu.js")}}"></script>

<!-- orgchart -->
<script src="{{asset("packages/default/plugins/OrgChart/html2canvas.min.js")}}" type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/OrgChart/jquery.orgchart.js")}}" type="text/javascript"></script>

<!-- DropDownTreeView -->
<script src="{{asset("packages/default/plugins/DevExtreme/dx.all.js")}}" type="text/javascript"></script>
<script src="{{asset("packages/default/plugins/DropDownTreeView/DropDownTreeView.js")}}"
        type="text/javascript"></script>
<!-- language for datepicker bootstrap -->
<!-- popup cap 1 -->

<div id="divModalContainer">
    <!-- for email -->

    <div id="myModal">
    </div>
    <!-- popup cap 2 -->
    <div id="myModal02">
    </div>
    <!-- popup cap 3 -->
    <div id="myModal03">
    </div>
    <!-- popup cap 4 -->
    <div id="myModal04">
    </div>
    <!-- popup cap 5 -->
    <div id="myModal05">
    </div>
    <!-- popup cap 5 -->
    <div id="myModal06">
    </div>
    <!-- popup cap 5 -->
    <div id="myModal07">
    </div>
    <!-- popup cap 5 -->
    <div id="myModal08">
    </div>
    <!-- popup cap 5 -->
    <div id="myModal09">
    </div>

</div>
<div id="divEmail">
</div>

<div id="modalFormInfo">
</div>
@section('script')
@show
<div class="l3loading hide">
    <i class="fa fa-refresh fa-spin"></i>
</div>
</body>

</html>
