<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>LemonWeb 4.0 - Business Intelligence</title>
    <link rel="shortcut icon" href="{{asset("favicon.ico")}}"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="{{asset("packages/default/plugins/jQueryUI/jquery-ui.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/jQueryUI/jquery-ui.theme.min.css")}}" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{asset("packages/default/bootstrap/css/bootstrap.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/timepicker/bootstrap-timepicker.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/bootstrap-select/css/bootstrap-select.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css")}}" rel="stylesheet" type="text/css"/>
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
    <link href="{{asset("packages/default/plugins/treeview/css/bootstrap-treeview.css")}}" rel="stylesheet" type="text/css"/>
    <!-- bootstrap treeview -->
    <link href="{{asset("packages/default/plugins/folder-tree/css/filetree.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/jplayer/skin/blue.monday/css/jplayer.blue.monday.css")}}" rel="stylesheet"
          type="text/css"/>
    {{--Select--}}
    <link href="{{asset("packages/default/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>
    <!-- scroller -->
    <link href="{{asset("packages/default/plugins/custom-scroller/jquery.mCustomScrollbar.css")}}" rel="stylesheet"
          type="text/css"/>
    <!-- upload multi-file -->
    <link href="{{asset("packages/default/plugins/upload/jquery.fileupload.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/paramquery-3.3.4/pqgrid.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/paramquery-3.3.4/pqgrid.ui.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/paramquery-3.3.4/themes/steelblue/pqgrid.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/multiselect/bootstrap-multiselect.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/jquery.qtip.custom/jquery.qtip.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/jQuery-contextMenu/jquery.contextMenu.css")}}" rel="stylesheet" type="text/css"/>
    <!-- new combo -->
    <link href="{{asset("packages/default/plugins/bootstrap-combobox/css/bootstrap-combobox.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/plugins/bootstrap-toggle/css/bootstrap-toggle.css")}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset("packages/default/plugins/openlayers/ol.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/L3/css/cube-loading.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/L3/css/l3.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("packages/default/L3/css/birt.css")}}" rel="stylesheet" type="text/css"/>




    <!-- jQuery 2.1.4 -->
    <script src="{{asset("packages/default/plugins/jQuery/jQuery-2.1.4.min.js")}}"></script>
    <script src="{{asset("packages/default/plugins/jQuery-contextMenu/jquery.contextMenu.js")}}" type="text/javascript"></script>
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
    <script src="{{asset("packages/default/plugins/timepicker/bootstrap-timepicker.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("packages/default/plugins/bootstrap-switch/js/bootstrap-switch.js")}}" type="text/javascript"></script>

    <script src="{{asset("packages/default/plugins/datepicker/date.js")}}" type="text/javascript"></script>
    <script src="{{asset("packages/default/plugins/datepicker/locales/bootstrap-datepicker.vi.js")}}" type="text/javascript"></script>
    <script src="{{asset("packages/default/plugins/bootstrap-confirm/bootstrap-confirmation.js")}}" type="text/javascript"></script>
    <script src="{{asset("packages/default/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js")}}" type="text/javascript"></script>
    <script src="{{asset("packages/default/plugins/bootstrap-select/js/bootstrap-select.js")}}" type="text/javascript"></script>
    @if (Session::get("Lang")=="84")
        <script src="{{asset("packages/default/plugins/bootstrap-select/js/i18n/defaults-vi_VI.js")}}" type="text/javascript"></script>
    @elseif(Session::get("Lang")=="86")
        <script src="{{asset("packages/default/plugins/bootstrap-select/js/i18n/defaults-zh_CN.js")}}" type="text/javascript"></script>
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
    <script src="{{asset("packages/default/plugins/input-mask/jquery.inputmask.bundle.js")}}" type="text/javascript"></script>
    <script src="{{asset("packages/default/plugins/input-mask/jquery.inputmask.js")}}" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="{{asset("packages/default/plugins/fastclick/fastclick.min.js")}}" type="text/javascript"></script>
    <!-- treeview bootstrap -->
    <script src="{{asset("packages/default/plugins/treeview/js/bootstrap-treeview.js")}}" type="text/javascript"></script>
    <!-- Param query grid -->
    <script src="{{asset("packages/default/plugins/paramquery-3.3.4/pqgrid.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("packages/default/plugins/paramquery-3.3.4/jsZip-2.5.0/jszip.min.js")}}" type="text/javascript"></script>
    @if (Session::get("Lang")=="84")
        <script src="{{asset("packages/default/plugins/paramquery-3.3.4/localize/pq-localize-vi.js")}}" type="text/javascript"></script>
    @elseif(Session::get("Lang")=="86")
        <script src="{{asset("packages/default/plugins/paramquery-3.3.4/localize/pq-localize-zh.js")}}" type="text/javascript"></script>
    @elseif(Session::get("Lang")=="01")
        <script src="{{asset("packages/default/plugins/paramquery-3.3.4/localize/pq-localize-en.js")}}" type="text/javascript"></script>
    @elseif(Session::get("Lang")=="81")
        <script src="{{asset("packages/default/plugins/paramquery-3.3.4/localize/pq-localize-ja.js")}}" type="text/javascript"></script>
@endif
<!-- multiselect -->
    <script src="{{asset("packages/default/plugins/multiselect/bootstrap-multiselect.js")}}" type="text/javascript"></script>

    <!-- tableHeadFixer -->
    <script src="{{asset("packages/default/plugins/tableHeadFixer/tableHeadFixer.js")}}" type="text/javascript"></script>
    <script src="{{asset("packages/default/plugins/tableHeadFixer/tablefreeze.js")}}" type="text/javascript"></script>

    <script src="{{asset("packages/default/plugins/jquery-mousewheel/jquery.mousewheel.js")}}" type="text/javascript"></script>

    <!-- AdminLTE App -->
    <script src="{{asset("packages/default/L3/js/l3.js")}}" type="text/javascript"></script>

    <!--Bootbox -->
    <script src="{{asset("packages/default/plugins/bootstrap-bootbox/bootbox.js")}}" type="text/javascript"></script>
    <!--Notify -->
    <script src="{{asset("packages/default/plugins/bootstrap-notify/bootstrap-notify.js")}}" type="text/javascript"></script>
    <!--new combo -->
    <script src="{{asset("packages/default/plugins/bootstrap-combobox/js/bootstrap-combobox.js")}}" type="text/javascript"></script>
    <!--html5gallery -->
    <script src="{{asset("packages/default/plugins/html5gallery/html5gallery.js")}}" type="text/javascript"></script>
    <script src="{{asset("packages/default/plugins/jplayer/jquery.jplayer.js")}}" type="text/javascript"></script>
    <script src="{{asset("packages/default/plugins/jplayer/add-on/jplayer.playlist.js")}}" type="text/javascript"></script>
    <!-- jssor -->
    <script src="{{asset("packages/default/plugins/jssor-slider/jssor.slider.min.js")}}" type="text/javascript"></script>
    <!-- scroller Không được include file jquery.mCustomScrollbar.concat.min.js do bị conflict với scrollbar pqgrid-->
    <script src="{{asset("packages/default/plugins/custom-scroller/jquery.mCustomScrollbar.js")}}" type="text/javascript"></script>
    <script src="{{asset("packages/default/plugins/nicescroll/jquery.nicescroll.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("packages/default/plugins/jssor-slider/ImageTools.js")}}" type="text/javascript"></script>
    <script src="{{asset("packages/default/plugins/bootstrap-toggle/js/bootstrap-toggle.js")}}" type="text/javascript"></script>



    <script src="{{asset("packages/default/dist/js/app.js")}}" type="text/javascript"></script>
    <script src="{{asset("packages/default/plugins/file-saver/FileSaver.js")}}" type="text/javascript"></script>
    <script src="{{asset("packages/default/plugins/ckeditor/ckeditor.js")}}" type="text/javascript"></script>
    <script src="{{asset("packages/default/plugins/jquery.qtip.custom/jquery.qtip.js")}}" type="text/javascript"></script>
    <!--Paging -->
    <script src="{{asset("packages/default/plugins/paging/jquery.twbsPagination.js")}}" type="text/javascript"></script>

    <!--Tableau -->
    <script src="{{asset("packages/default/plugins/openlayers/ol.js")}}" type="text/javascript"></script>
    <script src="{{asset("packages/default/plugins/inline-css/jquery.inlineStyler.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("packages/default/plugins/s/s.js")}}" type="text/javascript"></script>
    <script src="{{asset("packages/default/plugins/s/j.js")}}" type="text/javascript"></script>

    <script src="{{asset("packages/default/plugins/tableExport.jquery/tableExport.js")}}"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>-->
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
<style>
    .open > .dropdown-menu {
        display: block;
        min-width: 400px;
        max-width: 800px;
        border: 1px solid #ccc;
        overflow: auto;
    }

    .three_dot_caption {
        display: inline-block;
        width: 700px;
        white-space: nowrap;
        overflow: hidden !important;
        text-overflow: ellipsis;
        margin-left: 0px;
        pading-left: 0px;
    }

    a:hover {
        cursor: pointer;
    }

    #idExportMenu .mCSB_outside + .mCSB_scrollTools {
        right: 0px
    }
</style>


<script type="text/javascript">

    var rptWidth;
    var rptHeight;
    $(document).ready(function () {
        $(".main-content").css("height", $(window).height() - $(".main-header").height());
        $(".dropdown-toggle").dropdown("toggle");
        rptWidth = $(".main-content").width();
        rptHeight = $(".main-content").height();
        $(".dropdown-menu").height(rptHeight - 20);
        $(".cls-display").height(190);

    });

    function loadReport(reportFileName, reportCaption, id, param, callBack, paramCallBack) {
        $("aside").removeClass("control-sidebar-open");
        $(id).html("");
        var cb = typeof callBack !== 'undefined' ? callBack : null;
        var pr = typeof paramCallBack !== 'undefined' ? paramCallBack : null;
        if ('{{Config::get("birt.BIRTCallingMode")}}' == 'VP' || '{{Config::get("birt.BIRTCallingMode")}}' == 'VT') {
            $("#idFileName").val(reportFileName);
            var rwURL = '{{Config::get("birt.BIRTServerURL")}}';
            var uri = rwURL + 'preview?__report=' + reportFileName + '.rptdesign&__frameborder=no&rwURL=' + rwURL + '&rptWidth=' + rptWidth + '&rptHeight=' + rptHeight + '&p1=' + '{{($servername)}}' + '&p2=' + '{{($username)}}' + '&p3=' + '{{($password)}}' + '&p4=' + '{{($database)}}' + '&p5=' + '{{($subdatabase)}}' + '&userID=' + '{{Auth::user()->user()->UserID}}' + "&" + param;
            var xmlhttp;
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            var d = new Date();
            var newStyle = d.getTime();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    $(".l3loading").addClass('hide');

                    var response = '';
                    //response += '<base href="' + '{{Config::get("birt.TomcatServer")}}' + '" target="_blank">';
                    response += xmlhttp.responseText;

                    //Chuyen tu duong dan tuong doi sang tuyet doi
                    response = response.replace(/src="\/birt-viewer/g, 'src="' + '{{Config::get("birt.TomcatServer")}}/birt-viewer');
                    //Start : tranh xung dot css
                    response = response.replace(/\.style_/g, '.style'+newStyle+'_');
                    response = response.replace(/class="style/g, 'class="style'+newStyle);
                    //End : tranh xung dot css
                    //response = response.replace(/style_/g, newStyle+'_');
                    //console.log(response);
                    //(response);
                    if (response.indexOf("not&#32;exist&#32") > 0) {
                        $(id).html("Mẫu báo cáo <b style='color:red'>" + reportFileName + "</b> không tồn tại.");
                    } else {
                        $(id).html(response);
                        //cheatCodeCssBirt();

                    }
                    //console.log("count div : " + $(id).size());
                    //callBack after load report
                    if (cb != null)cb.call(null, pr);

                }
            }
            hideControls(false);
            //addSpin("#divBoard");
            $(".l3loading").removeClass('hide');
            console.log(uri);
            xmlhttp.open("GET", uri, true);
            xmlhttp.withCredentials = true;
            xmlhttp.send();
            if (reportCaption != "") {
                $("#reportcaption").text(reportCaption);
                $('#reportcaption').prop('title', reportCaption);
            }


        }
        if ('{{Config::get("birt.BIRTCallingMode")}}' == 'RP' || '{{Config::get("birt.BIRTCallingMode")}}' == 'RT') {
            $(id).html("");
            $("#idFileName").val(reportFileName);
            hideControls(false)
            //addSpin(id);
            $(".l3loading").removeClass('hide');
            $.ajax({
                method: "POST",
                url: '{{url("/W94F3000/$pFrom/$g/birt/callservice")}}',
                data: {
                    reportname: reportFileName,
                    format: 'html',
                    tomcatserver: '{{Config::get("birt.BIRTServerURL")}}',
                    rptWidth: rptWidth,
                    rptHeight: rptHeight,
                    param: param
                },
                success: function (data) {
                    ////console.log(data);
                    $(".l3loading").addClass('hide');
                    if (data == "0") {
                        $(id).html("Mẫu báo cáo <b style='color:red'>" + reportFileName + "</b> không tồn tại.");
                    } else {
                        $(id).html(data);
                    }
                    if (reportCaption != "") {
                        $("#reportcaption").html(reportCaption);
                    }
                    //console.log("count div : " + $(id).length);
                    //callBack after load report
                    if (cb != null)cb.call(null, pr);
                }
            });
        }


    }
    function loadPowerBI(url, id, reportCaption) {
        $("aside").removeClass("control-sidebar-open");
        $(id).html("<iframe id='frameReport' width='100%' height='100%' src='" +url+ "'></iframe>");
        hideControls(false);
        $("#frameReport").height($(window).height() - 60);
        if (reportCaption != "") {
            $("#reportcaption").text(reportCaption);
            $('#reportcaption').prop('title', reportCaption);
        }
    }
    function cheatCodeCssBirt() {
        /*    for (var i = 1; i < 20 ; i++){
         if ($("#divBoard").find('.style_'+i).length > 0)
         {
         $("#divBoard").find('.style_'+i).makeCssInline();
         }else{

         }
         }*/
        //$("#divBoard").find('.style_2').makeCssInline();
    }
    var currPosition = 0;
    function hideControls(bHide) {
        if (bHide) {
            $("#idPrev").addClass("hide");
            $("#idHeader").addClass("logodgCompany");
            $("#idExportMenu").addClass("hide");
            $("#idReportMenu").addClass("hide");
            $("#divReportType").removeClass("hide");
            $("#divBoard").addClass("hide");
            $("#reportcaption").html($("#idReportTypeCaption").val());
            $(".view-mode").removeClass("hide");
            $(".main-content").scrollTop(currPosition);
            ////console.log(currPosition);

        } else {
            $("#idPrev").removeClass("hide");
            $("#idHeader").removeClass("logodgCompany");

            $("#idExportMenu").removeClass("hide");
            $("#idReportMenu").removeClass("hide");
            $("#divReportType").addClass("hide");
            $("#divBoard").removeClass("hide");
            $(".view-mode").addClass("hide");

        }
    }

</script>

<body class="skin-blue sidebar-mini">
<base href="{{Config::get("birt.BIRTServerURL")}}" target="_blank">
<div class="l3loading hide">
    <i class="fa fa-refresh fa-spin"></i>
</div>

<div class="wrapper1 birt">
    <header class="main-header ">
        <nav class="navbar navbar-static-top" role="navigation">
            <?php
                $logo = url("packages/default/L3/images/companylogo.gif")
            ?>
            <div id="idHeader" class="logodgCompany" style="height: 100%;width: 100%">
                <div class="">
                    <div class="row" style="background: transparent;height: 25px;margin: 9px">
                        <div class="col-md-2 pull-left" style="padding-left: 0px">
                            <b>
                                <i id="idPrev" style="font-size: 180%;margin-top: 5px;" onclick="hideControls(true);"><a
                                            class="fa fa-arrow-circle-left text-black" style="color: #333;text-decoration: none !important"></a></i>
                            </b>

                            <div class="btn-group" id="idReportMenu" style="margin-top: -12px;">
                                <button class=" dropdown-toggle  fa fa-align-justify text-black mgr5 pull-right"
                                        style="font-size: 120%" id="menu1" type="button" data-toggle="dropdown">
                                </button>
                                <ul class="dropdown-menu test" role="menu" aria-labelledby="menu1"
                                    style="margin-top: 17px;margin-left: 5px">
                                    @define $arrID = array('');
                                    @define $arrName = array('');
                                    @foreach($reportTypeList as $row)
                                        @if (array_search($row['ReportGroupID'], $arrID) == "")
                                            @define array_push($arrID,$row['ReportGroupID']);
                                            @define array_push($arrName,$row['ReportGroupName']);
                                        @endif
                                    @endforeach
                                    @define $j = 1;
                                    @while($j < sizeof($arrID))
                                        <li role="presentation" class="dropdown-header"><label
                                                    style="color:#000;font-size: 14px">{{$arrName[$j]}}</label></li>
                                        @foreach($reportTypeList as $row)
                                            @if ($arrID[$j] == $row['ReportGroupID'])
                                                @if ($row["ReportType"] == "BIRT" || $row["ReportType"] == "")
                                                    <li role="presentation"
                                                        onclick='loadReport("{{$row['ReportFileName']}}", "{{$row['MReportName']}}","#divBoard","")'>
                                                        <a style="cursor:pointer;padding-left:20px;" role="menuitem"
                                                           tabindex="-1"><span
                                                                    style="color: #000">{{$row['MReportName']}}</span></a>
                                                    </li>
                                                @endif
                                                @if ($row["ReportType"] == "EMBED")

                                                        <li role="presentation"
                                                            onclick='loadPowerBI("{{$row['EmbedCode']}}","#divBoard", "{{$row['MReportName']}}")'>
                                                            <a style="cursor:pointer;padding-left:20px;" role="menuitem"
                                                               tabindex="-1"><span
                                                                        style="color: #000">{{$row['MReportName']}}</span></a>
                                                        </li>
                                                @endif
                                            @endif
                                        @endforeach
                                        <li role="presentation" class="divider" style="margin:5px !important;"></li>
                                        @define $j = $j + 1;
                                    @endwhile
                                </ul>

                                <input type="hidden" id="idUrlServer" value=""/>
                                <input type="hidden" id="idFileName" value=""/>
                            </div>
                        </div>
                        <div class="col-md-7 pull-left" style="text-align: center">
                            <b><span class='three_dot_caption' title='dsfdsf' id="reportcaption"
                                     style="font-size: 160%;"></span></b>
                        </div>

                        <div class="col-md-3" style="text-align: left;padding-left: 0px">
                            <div class="btn-group pull-right" style="margin-top: 7px">
                                <span style="cursor: pointer" onclick="$('.cls-display').toggleClass('show')"><i class="fa fa-align-left mgr5 text-gray"></i>Hiển thị</span>
                                <ul class="dropdown-menu cls-display" role="menu">
                                    <li><a title="Danh sách" class="view-mode" data-toggle="control-sidebar1" onclick="loadReportTypeLst('0')"><i
                                                    class="fa fa-th-list text-gray mgt10"></i>Danh sách</a>
                                    <li class="divider"></li>
                                    <li><a title="Hình ảnh" class="view-mode"  data-toggle="control-sidebar1" onclick="loadReportTypeLst('1')"><i
                                                    class="fa fa-th-large text-gray mgt10"></i>Hình thu nhỏ</a>
                                    <li class="divider"></li>
                                    <li><a title="Thu gọn" class="view-mode"  data-toggle="control-sidebar1" onclick="thuGon();"><i
                                                    class="fa fa-compress text-gray mgt10"></i>Thu gọn</a>
                                    <li class="divider"></li>
                                    <li><a title="Mở rộng" class="view-mode"  data-toggle="control-sidebar1" onclick="detail()"><i
                                                    class="fa fa-expand text-gray mgt10"></i>Mở rộng</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </nav>
    </header>
    <div class="main-content bg">
        <div class="modal-body pdl0 pdr0">
            <div class="row" style="margin-left: 0px; margin-right: 0px;">
                <div class="col-md-12" style="padding-left: 0px; padding-right: 0px">
                    <div id="divReportType" style="overflow: hidden;">
                    </div>
                    <div id="divBoard" style="overflow: auto;text-align:center">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('W9X.W94.W94F3000_RightSideBar')
<div id="divSubReport" style="overflow: auto;"></div>
<input type="hidden" id="idReportTypeCaption" value="{{Helpers::getRS($g,"Bao_cao_quan_tri")}}">
<input type="hidden" id="idFileName" value=""/>

<script>


    $("#idReportMenu").find(".test").mCustomScrollbar({
        axis: "y",
        scrollButtons: {enable: true},
        theme: "light-thick",
        scrollbarPosition: "outside",
        scrollInertia: 100
    });

    function close() {
        $("#divBoard").html("");
        $("#divSubReport").html("");
    }
    function close_sub(id) {
        $("#" + id).modal("hide");
        //console.log("remove popup : " + "#" + id);
        $("#" + id).html('');
    }
    var firstLoad = true;
    function loadReportTypeLst(mode) {
        //console.log("debug");
        $("aside").removeClass("control-sidebar-open");
        $("#divReportType").html("");
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            url: '{{url("/W94F3000/$pFrom/$g/reporttype")}}',
            data: {mode: mode},
            success: function (data) {
                $(".l3loading").addClass('hide');
                $("#divReportType").html(data);
                $("#reportcaption").html($("#idReportTypeCaption").val());
                if (!firstLoad){
                    $('.cls-display').toggleClass('show')
                }

                firstLoad = false;
            }
        });
    }
    loadReportTypeLst('{{Config::get('birt.ViewMode')}}');
    hideControls(true);
    function loadPopUpReport(reportFileName, reportCaption, format, marginLR, param) {
        if ('{{Config::get("birt.BIRTCallingMode")}}' == 'VP' || '{{Config::get("birt.BIRTCallingMode")}}' == 'VT') {
            var rwURL = '{{Config::get("birt.BIRTServerURL")}}';
            var uri = rwURL + 'preview?__report=' + reportFileName + '.rptdesign&__frameborder=no&rwURL=' + rwURL + '&rptWidth=' + rptWidth + '&rptHeight=' + rptHeight + '&p1=' + '{{($servername)}}' + '&p2=' + '{{$username}}' + '&p3=' + '{{$password}}' + '&p4=' + '{{$database}}' + '&p5=' + '{{$subdatabase}}' + "&" + param;
            var xmlhttp;
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                    var d = new Date();
                    var newStyle = d.getTime();
                    var id = "divPopUpReport" + d.getTime();
                    var response = '';
                    response += '<div class="modal fade draggable" id="' + id + '">';
                    response += '<div class="modal-dialog">';
                    response += '<div class="modal-content" >';
                    response += '<div class="modal-header logodg" >';
                    response += '<button type="button" class="close" style="margin-top:10px; margin-right:10px" onclick="close_sub(\'' + id + '\');" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>';
                    response += '<div class="panel-heading logodg clfontsize1">  <span class="lbl-normal" id="breadcrumb"><a style="color:#fff;font-weight: bold">' + reportCaption + '</a></span> </div>';
                    response += '</div>';
                    response += '<div class="modal-body">';
                    response += '<form class="form-horizontal" id="frm' + id + '" >';
                    response += '<div class="row ">';
                    response += '<div class="col-md-12">';
                    response += '<div style="overflow: auto;">';
                    response += '<base href="' + rwURL + '" target="_blank">';
                    response += xmlhttp.responseText;
                    response = response.replace(/\.style_/g, '.style'+newStyle+'_');
                    response = response.replace(/class="style/g, 'class="style'+newStyle);
                    //response += '<object width="100%" height="600px" data="'+uri+'"></object>';

                    response += '</div>';
                    response += '</div>';
                    response += '</div>';
                    response += '</form>';
                    response += '</div>';
                    response += '</div>';
                    response += '</div>';
                    if (response.indexOf("not&#32;exist&#32") > 0) {
                        $("#" + id).html("");
                        //alert_warning("Mẫu báo cáo <b style='color:red'>" + rfName +"</b> không tồn tại.");
                    } else {
                        $("#divSubReport").append(response);
                        $("#" + id).modal({
                            keyboard: false,
                            backdrop: 'static',
                            show: true
                        });
                        $('#' + id).find(".modal-dialog").width($(window).width()-(marginLR*2));// - marginLR);// (100 + Number(marginLR)));
                        ////console.log($(window).width() - (100 + Number(marginLR)));
                        $('#' + id).find(".modal-dialog").height($(window).height() - 60);
                        ////console.log($(window).height() - 200);

                        /* $('#' + id).find(".modal-content").draggable({
                         handle: ".modal-header",
                         //containment: "window"
                         });*/

                    }

                    $(".l3loading").addClass('hide');
                    doDraggable();
                }
            }
            $(".l3loading").removeClass('hide');
            console.log("Load:" + uri);
            xmlhttp.open("GET", uri, true);
            xmlhttp.withCredentials = true;
            xmlhttp.send();
        }
        if ('{{Config::get("birt.BIRTCallingMode")}}' == 'RP' || '{{Config::get("birt.BIRTCallingMode")}}' == 'RT') {
            var tomcatServer = '{{Config::get("birt.BIRTServerURL")}}';
            $(".l3loading").removeClass('hide');
            var d = new Date();
            var id = "divPopUpReport" + d.getTime();
            $.ajax({
                method: "POST",
                url: '{{url("/W94F3000/$pFrom/$g/birt/callservice")}}',
                data: {
                    reportname: reportFileName,
                    format: format,
                    tomcatserver: '{{Config::get("birt.BIRTServerURL")}}',
                    rptWidth: rptWidth,
                    rptHeight: rptHeight,
                    param: param
                },
                success: function (data) {
                    $(".l3loading").addClass('hide');
                    ////console.log(data);
                    if (data == "0") {
                        $("#" + id).html("");
                        alert_warning("Mẫu báo cáo <b style='color:red'>" + reportFileName + "</b> không tồn tại.");
                    } else {
                        var response = '';
                        response += '<div class="modal fade draggable" id="' + id + '"  style="padding-left: 18px !important;">';
                        response += '<div class="modal-dialog">';
                        response += '<div class="modal-content" style="left: 1px;">';
                        response += '<div class="modal-header logodg" style="border: 1px solid; padding-right: 0px">';
                        response += '<button type="button" class="close" style="margin-top:10px; margin-right:10px" onclick="close_sub(\'' + id + '\');" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>';
                        response += '<div class="panel-heading logodg clfontsize1">  <span class="lbl-normal" id="breadcrumb"><a style="color:#fff;font-weight: bold">' + reportCaption + '</a></span> </div>';
                        response += '</div>';
                        response += '<div class="modal-body">';
                        response += '<form class="form-horizontal" id="frm' + id + '" >';
                        response += '<div class="row ">';
                        response += '<div class="col-md-12">';
                        response += '<div style="overflow: auto;">';
                        response += data;
                        response += '</div>';
                        response += '</div>';
                        response += '</div>';
                        response += '</form>';
                        response += '</div>';
                        response += '</div>';
                        response += '</div>';
                        $("#divSubReport").append(response);
                        $("#" + id).modal({
                            keyboard: false,
                            backdrop: 'static',
                            show: true
                        });
                        $('#' + id).find(".modal-dialog").width($(window).width() - (100 + Number(marginLR)));
                        $('#' + id).find(".modal-dialog").height($(window).height() - 60);

                        /*$('#' + id).find(".modal-content").draggable({
                         handle: ".modal-header",
                         });*/
                    }
                }
            });
        }

    }

    function exportReport(reportFileName, format, param) {
        var rwURL = '{{Config::get("birt.BIRTServerURL")}}';
        if ('{{Config::get("birt.BIRTCallingMode")}}' == 'VP' || '{{Config::get("birt.BIRTCallingMode")}}' == 'VT') {
            //window.open('http://10.0.0.24:8081/birt-viewer/preview?__report=Z_EC_D05_0001D_ShowroomSales.rptdesign&__format=pdf&__frameborder=no&rwURL=http://10.0.0.24:8081/birt-viewer/&rptWidth=2000&rptHeight=595&serverName=10.0.0.15\SQL2012&userName=sa&password=2008&database=DGNL3FN&subDatabase=DGNL3FN&dateFrom=20161001&dateTo=20161031');
            var uri = rwURL + 'preview?__report=' + reportFileName + '.rptdesign&__fittopage=true&__format=' + format + '&__frameborder=no&rwURL=' + rwURL + '&rptWidth=862&rptHeight=775' + '&p1=' + '{{($servername)}}' + '&p2=' + '{{$username}}' + '&p3=' + '{{$password}}' + '&p4=' + '{{$database}}' + '&p5=' + '{{$subdatabase}}' + "&" + param;
            /*var xmlhttp;
             if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
             xmlhttp = new XMLHttpRequest();
             }
             else {// code for IE6, IE5
             xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
             }
             xmlhttp.onreadystatechange = function () {
             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
             //$(".l3loading").addClass('hide');
             var response = '';
             response += '<base href="' + rwURL + '" target="_blank">';
             response += xmlhttp.responseText;
             if (response.indexOf("not&#32;exist&#32") > 0) {
             $(id).html("Mẫu báo cáo <b style='color:red'>" + reportFileName + "</b> không tồn tại.");
             } else {
             ////console.log(data);
             /!*var downloadLink = document.createElement("a");
             downloadLink.download = "birt_" + new Date().getTime()+"." + format;
             downloadLink.innerHTML = "Download File";
             downloadLink.href = unescape(response);
             downloadLink.onclick = destroyClickedElement;
             downloadLink.style.display = "none";
             document.body.appendChild(downloadLink);
             downloadLink.click();*!/

             //var blob = new Blob([xmlhttp.responseText], {type: "application/pdf;charset=utf-8"});
             //saveAs(blob, "test.pdf");

             //var file = new File([xmlhttp.responseText], "test.pdf", {type: "application/pdf"});
             //saveAs(file);


             //var blob = new Blob([xmlhttp.responseText], {type: 'application/pdf'});
             //var file = new File([blob], reportFileName + ".pdf");
             ////console.log(file);
             //a.href = URL.createObjectURL(file);
             //a.download = reportFileName + ".pdf";// + format;
             //a.click();

             //$("#previewPDF").modal("show");
             }

             }
             }
             //$(".l3loading").removeClass('hide');
             xmlhttp.open("GET", uri, true);
             xmlhttp.responseType = "blob";
             xmlhttp.withCredentials = true;
             xmlhttp.send();
             //console.log(uri);*/
            var request = new XMLHttpRequest();
            request.open("GET", uri, true);
            request.responseType = "blob";
            request.onload = function (e) {
                if (this.status === 200) {
                    // `blob` response
                    //console.log(this.response);
                    //saveAs(this.response, "Report.xls");
                    // create `objectURL` of `this.response` : `.pdf` as `Blob`
                    var file = window.URL.createObjectURL(this.response);
                    var a = document.createElement("a");
                    a.href = file;
                    a.download = this.response.name || reportFileName + new Date().getTime() + "." + format;
                    document.body.appendChild(a);
                    a.click();
                    a.onclick = destroyClickedElement;
                }
                ;
            };
            request.send();
        }
        if ('{{Config::get("birt.BIRTCallingMode")}}' == 'RP' || '{{Config::get("birt.BIRTCallingMode")}}' == 'RT') {
            $(".l3loading").removeClass('hide');
            $.ajax({
                method: "POST",
                url: '{{url("/W94F3000/$pFrom/$g/birt/exportservice")}}',
                data: {
                    reportname: reportFileName,
                    format: format,
                    tomcatserver: rwURL,
                    rptWidth: 595,
                    rptHeight: 842,
                    param: param
                },
                success: function (data) {
                    $(".l3loading").addClass('hide');
                    if (data == "0") { //File is not exist
                        //$("#"+id).html("");
                        //alert_warning("Mẫu báo cáo <b style='color:red'>" + reportName + "</b> không tồn tại.");
                        $("#divBoard").html("Mẫu báo cáo <b style='color:red'>" + reportFileName + "</b> không tồn tại.");
                        return;
                    }
                    if (data == "1") { //General failed
                        //$("#"+id).html(data);
                        return;
                    }
                    else {
                        var downloadLink = document.createElement("a");
                        //downloadLink.download = "birt_" + new Date().getTime()+"." + format;
                        //downloadLink.innerHTML = "Download File";
                        downloadLink.href = unescape(data);
                        downloadLink.onclick = destroyClickedElement;
                        downloadLink.style.display = "none";
                        document.body.appendChild(downloadLink);
                        downloadLink.click();
                        ////console.log(data);
                    }
                }
            });
        }

    }
    function destroyClickedElement(event) {
        document.body.removeChild(event.target);
    }

    function toggleToolbar(){
        $(cls-display)
    }
</script>
<style>
    .logodgCompany {
        background: url('{{$logo}}') 10px 0 no-repeat;
        background-size: 65px 32px;
    }
    .cls-display{
        margin-top: 15px;
        border-radius: 0px;
    }
    .show{
        display: block !important;
    }
</style>
</body>
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
</html>
