
@extends('layout.layoutM')
@section('content')
    <div class="row secReport">
        <div class="col-xs-12" style="padding: 5px;">
            <div class="">
                <form role="form">
                    <div class="box-body" id="rptDetail"></div><!-- /.box-body -->
                </form>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row secMenu hide" style="padding-left: 10px; padding-right: 10px;">
        <div class="row">
            <div class="col-xs-12" style="padding: 0px;">
                @define $arrID = array('');
                @define $arrName = array('');
                @foreach($reportTypeList as $row)
                    @if (array_search($row['ReportGroupID'], $arrID) == "")
                        @define array_push($arrID,$row['ReportGroupID']);
                        @define array_push($arrName,$row['ReportGroupName']);

                    @endif
                @endforeach
                @define $i = 1;
                @while ($i < sizeof($arrID))
                    @foreach($reportTypeList as $row)
                        @if ($arrID[$i] == $row['ReportGroupID'])
                            <a onclick="$('.secMenu').addClass('hide');$('.secReport').removeClass('hide');" target="_self"  href="{{url('/W94F3000').'/'.$pFrom.'/'.$g.'/'.$row['MReportID']}}"
                               style="padding-left: 35px !important;" class="list-group-item"><i
                                        class="fa fa-area-chart text-yellow"></i> &nbsp; {{$row['MReportName']}}</a>
                        @endif
                    @endforeach
                    @define $i = $i + 1;
                @endwhile
            </div>
        </div>
    </div>
@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        loadReport("{{$report['ReportFileName']}}","{{$report['ReportName']}}","#rptDetail","");
        $(".name-company").html('{{$reportName}}');
    });

    /*function loadReport(rwURL,rfName,reportName,id) {
        var rptWidth = $(document).width();
        var rptHeight= documentHeight;
        var uri = rwURL + 'preview?__report=' + rfName + '.rptdesign&__frameborder=no&rwURL=' + rwURL + '&rptWidth=' + rptWidth + '&rptHeight=' + rptHeight +'&servername='+'{{addslashes($servername)}}'+'&username='+'{{$username}}'+'&password='+'{{$password}}'+'&database='+'{{$database}}'+'&subdatabase='+'{{$subdatabase}}' ;
        var xmlhttp;
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                var response = '';
                response += '<base href="'+rwURL+'" target="_blank">';
                response += xmlhttp.responseText;
                if (response.indexOf("not&#32;exist&#32")>0){
                    $(id).html("");
                    alert_warning("Mẫu báo cáo <b style='color:red'>" + rfName +"</b> không tồn tại.");
                }else{
                    $(id).html(response);
                }

            }
        };

        xmlhttp.open("GET",uri,true);
        xmlhttp.withCredentials = true;
        xmlhttp.send();

    }*/

    function loadReport(reportFileName, reportCaption,  id, param) {
        //alert("test");
        var rptWidth = $(document).width();
        var rptHeight= $(document).height();
        $(id).html("");
        if ('{{Config::get("birt.BIRTCallingMode")}}' == 'VP' || '{{Config::get("birt.BIRTCallingMode")}}' == 'VT'){
            var rwURL = '{{Config::get("birt.BIRTServerURL")}}';
            var uri = rwURL + 'preview?__report=' + reportFileName + '.rptdesign&__frameborder=no&rwURL=' + rwURL + '&rptWidth=' + rptWidth + '&rptHeight=' + rptHeight + '&p1=' + '{{($servername)}}' + '&p2=' + '{{$username}}' + '&p3=' + '{{$password}}' + '&p4=' + '{{$database}}' + '&p5=' + '{{$subdatabase}}' + param;
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
                    //response += '<base href="' + rwURL + '" target="_blank">';
                    response += xmlhttp.responseText;
                    response = response.replace(/src="\/birt-viewer/g, 'src="' + '{{Config::get("birt.TomcatServer")}}/birt-viewer' );
                    if (response.indexOf("not&#32;exist&#32") > 0) {
                        $(id).html("Mẫu báo cáo <b style='color:red'>" + reportFileName + "</b> không tồn tại.");
                    } else {
                        $(id).html(response);
                    }
                    $(".l3loading").addClass('hide');
                }
            }
            $(".l3loading").removeClass('hide');
            xmlhttp.open("GET", uri, true);
            xmlhttp.withCredentials = true;
            xmlhttp.send();
            //$("#reportcaption").text(reportCaption);
            //$('#reportcaption').prop('title', reportCaption);
            console.log(uri);
        }
        if ('{{Config::get("birt.BIRTCallingMode")}}' == 'RP' || '{{Config::get("birt.BIRTCallingMode")}}' == 'RT'){
            $(id).html("");
            $("#idUrlServer").val('{{Config::get("birt.BIRTServerURL")}}');
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
                    //$("#reportcaption").html(reportCaption);
                }
            });
        }


    }
</script>


@stop


