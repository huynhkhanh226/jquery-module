<style>
    #modalW94F3000 .leftFormDuyet {
        MARGIN-TOP: 10PX;
        BORDER-RADIUS: 3PX;
    }

    #modalW94F3000 .panel-heading {
        padding: 4px 15px;
    }

    #modalW94F3000 .open > .dropdown-menu {
        display: block;
        min-width: 400px;
        max-width: 800px;
        border: 1px solid #ccc;
    }



    #modalW94F3000 .mCSB_outside + .mCSB_scrollTools{
        right:0px
    }
</style>

<script type="text/javascript">
    var isClick = 0;
    var index = 0;
    $("#modalW94F3000").find("#btnCollapse").click(function () {
        if (isClick == 0) {
            isClick = 1;
            $(".leftFormDuyet").hide();
        }
        else {
            $(".leftFormDuyet").show();
            isClick = 0;
        }

    });

    var rptWidth;
    var rptHeight;
    $(document).ready(function () {
        $(".dropdown-toggle").dropdown("toggle");
        isClick = 0;
        $("#modalW94F3000").find("#btnCollapse").trigger("click");
        var total = $("#mega_menu").find("li").length;
        $("#curr").text(1);
        $("#total").text(total);
        $("#modalW94F3000").width($(window).width());
        $("#modalW94F3000").height($(window).height());

        $("#modalW94F3000").find(".modal-content").width($(window).width() - 15);
        $("#modalW94F3000").find(".modal-content").height($(window).height() - 40);


        $("#modalW94F3000").find(".modal-body").width($("#modalW94F3000").find(".modal-content").width() - 12);
        $("#modalW94F3000").find(".modal-body").height($("#modalW94F3000").find(".modal-content").height() - 55);

        $("#modalW94F3000").find(".div_content").width($("#modalW94F3000").find(".modal-body").width());
        $("#modalW94F3000").find(".div_content").height($("#modalW94F3000").find(".modal-body").height());

        rptWidth = $("#modalW94F3000").find(".div_content").width() - 50;
        rptHeight = $("#modalW94F3000").find(".div_content").height() - 50;

        $("#modalW94F3000").find("#divBoard").width($("#modalW94F3000").find(".div_content").width());
        $("#modalW94F3000").find("#divBoard").height($("#modalW94F3000").find(".div_content").height() - 5);
        //Tam thoi khong load report
        //$("#mega_menu").find("li").eq(0).trigger("click");

        //Sub report
        $("#idSubReport").find(".modal-dialog").width($(window).width() - 160);
        $("#idSubReport").find(".modal-dialog").height($(window).height() - 90);

        $("#idSubReport").find(".modal-content").width($(window).width() - 160);
        $("#idSubReport").find(".modal-content").height($(window).height() - 90);

        $("#idSubReport").find(".modal-body").width($("#idSubReport").find(".modal-content").width() - 12);
        $("#idSubReport").find(".modal-body").height($("#idSubReport").find(".modal-content").height() - 55);

        $("#idSubReport").find(".div_content").width($("#idSubReport").find(".modal-body").width());
        $("#idSubReport").find(".div_content").height($("#idSubReport").find(".modal-body").height());
    });

    function loadReport(reportFileName, reportCaption,  id, param,  callBack, paramCallBack) {
        $(id).html("");
        var cb = typeof callBack !== 'undefined' ? callBack : null;
        var pr = typeof paramCallBack !== 'undefined' ? paramCallBack : null;

        if ('{{Config::get("birt.BIRTCallingMode")}}' == 'VP' || '{{Config::get("birt.BIRTCallingMode")}}' == 'VT'){
            $("#idFileName").val(reportFileName);
            var rwURL = '{{Config::get("birt.BIRTServerURL")}}';
            var uri = rwURL + 'preview?__report=' + reportFileName + '.rptdesign&__frameborder=no&rwURL=' + rwURL + '&rptWidth=' + rptWidth + '&rptHeight=' + rptHeight + '&serverName=' + '{{($servername)}}' + '&userName=' + '{{$username}}' + '&password=' + '{{$password}}' + '&database=' + '{{$database}}' + '&subDatabase=' + '{{$subdatabase}}' + "&" +param;
            var xmlhttp;
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                    var response = '';
                    response += '<base href="' + rwURL + '" target="_blank">';
                    response += xmlhttp.responseText;
                    if (response.indexOf("not&#32;exist&#32") > 0) {
                        $(id).html("Mẫu báo cáo <b style='color:red'>" + reportFileName + "</b> không tồn tại.");
                    } else {
                        $(id).html(response);
                        //cheatCodeCssBirt();
                    }
                    //console.log(response);
                    $(".l3loading").addClass('hide');
                    hideControls(false);
                    //callBack after load report
                    if (cb!=null)cb.call(null,pr);
                }
            }
            $(".l3loading").removeClass('hide');
            xmlhttp.open("GET", uri, true);
            xmlhttp.withCredentials = true;
            xmlhttp.send();
            if (reportCaption != ""){
                $("#reportcaption").text(reportCaption);
                $('#reportcaption').prop('title', reportCaption);
            }
            console.log(uri);
        }
        if ('{{Config::get("birt.BIRTCallingMode")}}' == 'RP' || '{{Config::get("birt.BIRTCallingMode")}}' == 'RT'){
            $(id).html("");
            $("#idUrlServer").val('{{Config::get("birt.BIRTServerURL")}}');
            $("#idFileName").val(reportFileName);
            $(".l3loading").removeClass('hide');
            //rptWidth = $("#" + id).width();
            //rptHeight = $("#" + id).height();
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
                    $(".l3loading").addClass('hide');
                    console.log(data);
                    if (data == "0") {
                        $(id).html("");
                        //alert_warning("Mẫu báo cáo <b style='color:red'>" + reportName + "</b> không tồn tại.");
                        $(id).html("Mẫu báo cáo <b style='color:red'>" + reportFileName + "</b> không tồn tại.");
                    } else {
                        $(id).html(data);
                    }
                    if (reportCaption != ""){
                        $("#reportcaption").html(reportCaption);
                    }
                    hideControls(false)
                    //callBack after load report
                    if (cb!=null)cb.call(null,pr);
                }
            });
        }


    }

    function cheatCodeCssBirt(){
        for (var i = 0; i < 50; i++){
            $('.style_'+i).makeCssInline();
        }
    }

    function exportReport(reportFileName, format, param) {
        var rwURL = '{{Config::get("birt.BIRTServerURL")}}';
        if ('{{Config::get("birt.BIRTCallingMode")}}' == 'VP' || '{{Config::get("birt.BIRTCallingMode")}}' == 'VT'){
            var uri = rwURL + 'preview?__report=' + reportFileName + '.rptdesign&__format='+ format+ '&__fittopage=true&__frameborder=no&rwURL=' + rwURL + '&rptWidth=842&rptHeight=800&serverName=' + '{{addslashes($servername)}}' + '&userName=' + '{{$username}}' + '&password=' + '{{$password}}' + '&database=' + '{{$database}}' + '&subDatabase=' + '{{$subdatabase}}' + "&" +param;
            /*var xmlhttp;
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //console.log("go here");
                    //$(".l3loading").addClass('hide');
                    var response = '';
                    response += '<base href="' + rwURL + '"/>';
                    response += xmlhttp.responseText;
                    if (response.indexOf("not&#32;exist&#32") > 0) {
                        $(id).html("Mẫu báo cáo <b style='color:red'>" + reportFileName + "</b> không tồn tại.");
                    } else {
                        var a = document.createElement("a");
                        var file = new Blob([xmlhttp.responseText], {type: 'text/plain'});
                        a.href = URL.createObjectURL(file);
                        a.download = reportFileName + "."+format;
                        a.click();

                    }

                }
            }
            //$(".l3loading").removeClass('hide');
            xmlhttp.open("GET", uri, true);
            xmlhttp.withCredentials = true;
            xmlhttp.send();
            console.log(uri);*/
            var request = new XMLHttpRequest();
            request.open("GET", uri, true);
            request.responseType = "blob";
            request.onload = function (e) {
                if (this.status === 200) {
                    // `blob` response
                    console.log(this.response);
                    //saveAs(this.response, "Report.xls");
                    // create `objectURL` of `this.response` : `.pdf` as `Blob`
                    var file = window.URL.createObjectURL(this.response);
                    var a = document.createElement("a");
                    a.href = file;
                    a.download = this.response.name || reportFileName +new Date().getTime()+ "."+format;
                    document.body.appendChild(a);
                    a.click();
                    a.onclick = destroyClickedElement;
                };
            };
            request.send();
        }
        if ('{{Config::get("birt.BIRTCallingMode")}}' == 'RP' || '{{Config::get("birt.BIRTCallingMode")}}' == 'RT'){
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
                    }
                }
            });
        }

    }

    $(".dropdown-menu").find("li").click(function () {
        isClick = 0;
        $("#modalW94F3000").find("#btnCollapse").trigger("click");
        // `this` is the DOM element that was clicked
        var index = $("#mega_menu").find("li").index(this);
        idx = index + 1;
        var total = $("#mega_menu").find("li").length;
        $("#curr").text(index + 1);
        $("#total").text(total);
        set_color(index + 1, total);
    });

    function set_color(index, total) {
        if (index == 1) {
            $("#idPrev").html('<span class="fa fa-arrow-circle-left text-blue"></span>');
            $("#idNext").html('<a class="fa fa-arrow-circle-right text-white"></a>');
        } else if (index == total) {
            $("#idPrev").html('<a class="fa fa-arrow-circle-left text-white"></a>');
            $("#idNext").html('<span class="fa fa-arrow-circle-right text-blue"></span>');
        } else {
            $("#idPrev").html('<a class="fa fa-arrow-circle-left text-white"></a>');
            $("#idNext").html('<a class="fa fa-arrow-circle-right text-white"></a>');
        }
    }

    function hideControls(bHide) {
        if (bHide) {
            $("#idPrev").addClass("hide");
            $("#idHeader").addClass("logodgReport");
            $("#idExportMenu").addClass("hide");
            $("#idReportMenu").addClass("hide");
            $("#divReportType").removeClass("hide");
            $("#divBoard").addClass("hide");
            $("#reportcaption").html($("#idReportTypeCaption").val());
        } else {
            $("#idPrev").removeClass("hide");
            $("#idHeader").removeClass("logodgReport");

            $("#idExportMenu").removeClass("hide");
            $("#idReportMenu").removeClass("hide");
            $("#divReportType").addClass("hide");
            $("#divBoard").removeClass("hide");
        }
    }


</script>
<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
?>

<div class="modal fade pd0" id="modalW94F3000" data-backdrop="static" role="dialog">
    <div class="modal-dialog  modal-lg formduyet">
        <div class="modal-content">
            <div class="modal-header pdl0" style="border: 1px solid; padding-right: 0px">

                <div id="idHeader" class="logodgReport">
                    <div class="row" style="background: transparent;height: 25px;margin: 8px">
                        <div class="col-md-2 pull-left" style="padding-left: 0px">
                            <b>
                                <i id="idPrev" style="font-size: 180%;margin-top: 5px;" onclick="hideControls(true);"><a
                                            class="fa fa-arrow-circle-left text-white"></a></i>
                            </b>

                            <div class="btn-group" id="idReportMenu" style="margin-top: -12px;">
                                <button class=" dropdown-toggle  fa fa-align-justify text-black mgr5 pull-right"
                                        style="font-size: 120%" id="menu1" type="button" data-toggle="dropdown">
                                </button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1"
                                    style="margin-top: 17px;margin-left: 5px;">
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
                                                <li role="presentation"
                                                    onclick='loadReport("{{$row['ReportFileName']}}", "{{$row['MReportName']}}","#divBoard", "")'>
                                                    <a role="menuitem" tabindex="-1"><span
                                                                style="color: #000;padding-left:20px">{{$row['MReportName']}}</span></a>
                                                </li>
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
                        <div class="col-md-8 pull-left" style="text-align: center">
                            <b><span class='three_dot_caption' title='dsfdsf' id="reportcaption"
                                     style="font-size: 160%;"></span></b>
                        </div>

                        <div class="col-md-2" style="text-align: right;padding-right: 0px;padding-left: 0px">
                           
                            <button type="button" class="close pull-right" style="margin-top:4px" data-dismiss="modal"
                                    aria-label="Close"><span aria-hidden="true"><i class="fa fa-close" onclick="close()"></i></span>
                            </button>
                            <button type="button" class="info-form" style="margin-top:7px;font-size: 16px" title="W94F3000" onclick="ShowFormInfo('W94F3000','{{Helpers::getRS($g,"Bao_cao_quan_tri")}}','D94F3000','W94F3000')"><i class="fa fa-info-circle"></i></button>

                        </div>
                    </div>
                    {{Helpers::generateHeadingCus(['panel-heading','text-center', 'clfontsize1'],'', ' <button id="btnCollapse" type="button" class="btn pull-left btn-default fa fa-align-justify" style="display:none"></button>')}}
                </div>

            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row" style="margin-top: 2px;">
                            <div class="col-md-12 div_content">
                                <div id="divReportType" style="overflow: auto;margin-top:5px">
                                </div>
                                <div id="divBoard" style="overflow: auto;text-align:center">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="divSubReport" style="overflow: auto;"></div>
<input type="hidden" id="idReportTypeCaption" value="{{Helpers::getRS($g,"Bao_cao_quan_tri")}}">
<script>

    $("#idReportMenu").find(".dropdown-menu").height($("#modalW94F3000").find(".modal-body").height() - 16);
    $("#idReportMenu").find(".dropdown-menu").mCustomScrollbar({
        axis:"y",
        scrollButtons:{enable:true},
        theme:"light-thick",
        scrollbarPosition:"outside",
        scrollInertia: 100
    });

    function close() {
        $("#divBoard").html("");
        $("#divSubReport").html("");
    }
    function close_sub(id) {
        $("#" + id).modal("hide");
        console.log("remove popup : " + "#" + id);
        $("#" + id).html('');
    }

    function loadReportTypeLst() {
        $("#divReportType").html("");
        $.ajax({
            method: "POST",
            url: '{{url("/W94F3000/$pFrom/$g/reporttype")}}',
            success: function (data) {
                //console.log(data);
                $("#divReportType").html(data);
                $("#reportcaption").html($("#idReportTypeCaption").val());
            }
        });
    }
    loadReportTypeLst();
    hideControls(true);
    function loadPopUpReport(reportFileName, reportCaption, format, marginLR, param) {
        if ('{{Config::get("birt.BIRTCallingMode")}}' == 'VP' || '{{Config::get("birt.BIRTCallingMode")}}' == 'VT'){
            var rwURL = '{{Config::get("birt.BIRTServerURL")}}';
            var uri = rwURL + 'preview?__report=' + reportFileName + '.rptdesign&__frameborder=no&rwURL=' + rwURL + '&rptWidth=' + rptWidth + '&rptHeight=' + rptHeight + '&serverName=' + '{{addslashes($servername)}}' + '&userName=' + '{{$username}}' + '&password=' + '{{$password}}' + '&database=' + '{{$database}}' + '&subDatabase=' + '{{$subdatabase}}' + "&" +param;
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
                    var id = "divPopUpReport" +  d.getTime();

                    var response = '';
                    response += '<div class="modal fade  draggable" id="' + id + '"  style="padding-left: 18px !important;">';
                    response += '<div class="modal-dialog">';
                    response += '<div class="modal-content" style="left: 1px;">';
                    response += '<div class="modal-header logodg" style="border: 1px solid; padding-right: 0px">';
                    response += '<button type="button" class="close" style="margin-top:10px; margin-right:10px" onclick="close_sub(\''+id+'\');" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>';
                    response += '<div class="panel-heading logodg clfontsize1">  <span class="lbl-normal" id="breadcrumb"><a style="color:#fff;font-weight: bold">' + reportCaption + '</a></span> </div>';
                    response += '</div>';
                    response += '<div class="modal-body">';
                    response += '<form class="form-horizontal" id="frm' + id + '" >';
                    response += '<div class="row">';
                    response += '<div class="col-md-12">';
                    response += '<div style="overflow: auto;">';
                    response += '<base href="' + rwURL + '" target="_blank">';
                    response += xmlhttp.responseText;
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
                            show:true
                        });
                        $('#' + id).find(".modal-dialog").width($(window).width() - (100 + Number(marginLR)));
                        console.log($(window).width() - (100 + Number(marginLR)));
                        $('#' + id).find(".modal-dialog").height($(window).height() - 60);
                        console.log($(window).height() - 200);

                        /*$('#' + id).find(".modal-content").draggable({
                            handle: ".modal-header",
                            //containment: "window"
                        });*/

                    }

                    $(".l3loading").addClass('hide');
                }
            }
            $(".l3loading").removeClass('hide');
            console.log("Load:" + uri);
            xmlhttp.open("GET", uri, true);
            xmlhttp.withCredentials = true;
            xmlhttp.send();
        }
        if ('{{Config::get("birt.BIRTCallingMode")}}' == 'RP' || '{{Config::get("birt.BIRTCallingMode")}}' == 'RT'){
            var tomcatServer = '{{Config::get("birt.BIRTServerURL")}}';
            $(".l3loading").removeClass('hide');
            var d = new Date();
            var id = "divPopUpReport" +  d.getTime();
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
                    //console.log(data);
                    if (data == "0") {
                        $("#" + id).html("");
                        alert_warning("Mẫu báo cáo <b style='color:red'>" + reportFileName + "</b> không tồn tại.");
                    } else {
                        var response = '';
                        response += '<div class="modal fade draggable" id="' + id + '"  style="padding-left: 18px !important;">';
                        response += '<div class="modal-dialog">';
                        response += '<div class="modal-content" style="left: 1px;">';
                        response += '<div class="modal-header logodg" style="border: 1px solid; padding-right: 0px">';
                        response += '<button type="button" class="close" style="margin-top:10px; margin-right:10px" onclick="close_sub(\''+id+'\');" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>';
                        response += '<div class="panel-heading logodg clfontsize1">  <span class="lbl-normal" id="breadcrumb"><a style="color:#fff;font-weight: bold">' + reportCaption + '</a></span> </div>';
                        response += '</div>';
                        response += '<div class="modal-body">';
                        response += '<form class="form-horizontal" id="frm' + id + '" >';
                        response += '<div class="row">';
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
                            show:true
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


</script>


