@define $arrID = array('');
@define $arrName = array('');
@foreach($reportTypeList as $row)
    @if (array_search($row['ReportGroupID'], $arrID) == "")
        @define array_push($arrID,$row['ReportGroupID']);
        @define array_push($arrName,$row['ReportGroupName']);
    @endif
@endforeach


@define $col = 0
@define $row = intval((sizeof($arrID) -1)/3)
@define $indxGRP = 1
<style>
    #divScrollReport>img {
        border: 1px solid #ccc;
        border-radius: 5px;
        margin: 10px;
        /*background-color: #f4d2d2;*/
    }

    #divScrollReport>img:hover {
        cursor: pointer;
    }
</style>


<div id="divScrollReport" class="row"
     style="margin: 0px 0px 0px 0px;padding: 0px;height:200px">
    @if ($mode == '0')
        @while($col < 3)
            @define $currRow = 0
            <div class="col-sm-4" style="padding:0px 0px 0px 5px">
                @while($currRow <= $row)
                    <div class="row sub-bg" style="margin: 0px 5px 0px 0px;padding: 0px">
                        <div class="col-sm-12" style="padding:0px">
                            @if ($indxGRP < sizeof($arrID))
                                <script>
                                    console.log('{{$arrName[$indxGRP]}}');
                                </script>
                                <div id="{{$arrID[$indxGRP]}}" class="tree well sub-bg"
                                     style="margin-bottom: 10px !important;border-radius: 0px;padding:0px 19px 0px 19px">
                                    <div class="row title">
                                        <div class="col-sm-12">
                                            <label class="report-header fa fa-minus-square-o lbl-title" style="font-size: 16px;margin-top:5px" onclick="DisplaySetting(this,'{{$arrID[$indxGRP]}}')"><span class="mgl10" >{{$arrName[$indxGRP]}}</span></label>
                                        </div>
                                    </div>
                                    <div class="list-item row">
                                        <div class="col-sm-12" style="padding-left: 0px; padding-right: 0px">
                                            <ul style="padding-left:10px;margin-bottom:5px; ">
                                                @foreach($reportTypeList as $row1)
                                                    @if ($arrID[$indxGRP] == $row1['ReportGroupID'])
                                                        @if ($row1["ReportType"] == "BIRT" || $row1["ReportType"] == "")
                                                        <li style="padding-top:5px">
                                                            <i class="icon-leaf"></i><a
                                                                    style="cursor:pointer;color:#000;:hover:blue"
                                                                    onclick='loadReport("{{$row1['ReportFileName']}}", "{{$row1['MReportName']}}","#divBoard", "")'><i
                                                                        class="fa fa-arrow-circle-right text-blue mgr5"></i>{{$row1['MReportName']}}
                                                            </a>
                                                        </li>
                                                        @endif
                                                        @if ($row1["ReportType"] == "EMBED")
                                                            <li style="padding-top:5px">
                                                                <i class="icon-leaf"></i><a
                                                                        style="cursor:pointer;color:#000;:hover:blue"
                                                                        onclick='loadPowerBI("{{$row1['EmbedCode']}}","#divBoard", "{{$row1['MReportName']}}")'><i
                                                                            class="fa fa-arrow-circle-right text-blue mgr5"></i>{{$row1['MReportName']}}
                                                                </a>
                                                            </li>
                                                        @endif
                                                            @if ($row1["ReportType"] == "FORM")
                                                                <li style="padding-top:5px">
                                                                    <i class="icon-leaf"></i><a
                                                                            style="cursor:pointer;color:#000;:hover:blue"
                                                                            onclick='showFormDialogPost("{{url('/'.$row1['ReportFileName'].'/'.$row1['ReportFileName'].'/0')}}","modal{{$row1['ReportFileName']}}", {title: "{{$row1['MReportName']}}"})'><i
                                                                                class="fa fa-arrow-circle-right text-blue mgr5"></i>{{$row1['MReportName']}}
                                                                    </a>
                                                                </li>
                                                            @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @define $indxGRP = $indxGRP + 1
                            @endif
                        </div>
                    </div>
                    @define $currRow = $currRow + 1
                @endwhile
            </div>
            @define $col = $col + 1
        @endwhile
    @else
        <div class="col-sm-12" style="padding:0px 0px 0px 5px">
            @foreach($arrayReportTypeList as $row)
                <div class="row sub-bg" style="margin: 0px 5px 0px 0px;padding: 0px">
                    <div class="col-sm-12" style="padding:0px">
                        <div id="{{$row->id}}" class="tree well sub-bg"
                             style="margin-bottom: 0px !important;border-radius: 0px;padding:0px 19px 0px 19px">
                            <div class="row title"
                                 >
                                <div class="col-sm-12">
                                    <label class="report-header fa fa-minus-square-o lbl-title" style="font-size: 16px;margin-top:5px" onclick="DisplaySetting(this,'{{$row->id}}')"><span class="mgl10">{{$row->name}}</span></label>
                                </div>
                            </div>

                            <div class="list-item row">
                                <div class="col-md-12" style="padding-left: 0px; padding-right: 0px">
                                    <div style="float:left;width:100%">
                                        <div id="list_album">
                                            <div class="listalbum">
                                                @foreach($reportTypeList as $row1)
                                                    @if ($row->id == $row1['ReportGroupID'])
                                                        @if ($row1["ReportType"] == "BIRT"  || $row1["ReportType"] == "")
                                                            <a  onclick='loadReport("{{$row1['ReportFileName']}}", "{{$row1['MReportName']}}","#divBoard", "")' class="thumb-album">
                                                                <figure>
                                                                    <figcaption class="more-caption" title="{{$row1['MReportName']}}">{{$row1['MReportName']}}</figcaption>
                                                                    <div>
                                                                        <img src="{{count($row1) > 0 && $row1['ThumbNail'] != "" ? $row1['ThumbNail'] : asset('packages/default/L3/images/default-image.png')}}"

                                                                             alt="{{$row1['MReportName']}}"
                                                                        >
                                                                    </div>

                                                                </figure>
                                                            </a>
                                                        @endif

                                                        @if ($row1["ReportType"] == "EMBED")
                                                            <a  onclick='loadPowerBI("{{$row1['EmbedCode']}}","#divBoard","{{$row1['MReportName']}}")' class="thumb-album">
                                                                <figure>
                                                                    <figcaption class="more-caption" title="{{$row1['MReportName']}}">{{$row1['MReportName']}}</figcaption>
                                                                    <div>
                                                                        <img src="{{count($row1) > 0 && $row1['ThumbNail'] != "" ? $row1['ThumbNail'] : asset('packages/default/L3/images/default-image.png')}}"

                                                                             alt="{{$row1['MReportName']}}"
                                                                        >
                                                                    </div>

                                                                </figure>
                                                            </a>
                                                        @endif
                                                            @if ($row1["ReportType"] == "FORM")
                                                                <a  onclick='showFormDialogPost("{{url('/'.$row1['ReportFileName'].'/'.$row1['ReportFileName'].'/0')}}","modal{{$row1['ReportFileName']}}", {title: "{{$row1['MReportName']}}"})' class="thumb-album">
                                                                    <figure>
                                                                        <figcaption class="more-caption" title="{{$row1['MReportName']}}">{{$row1['MReportName']}}</figcaption>
                                                                        <div>
                                                                            <img src="{{count($row1) > 0 && $row1['ThumbNail'] != "" ? $row1['ThumbNail'] : asset('packages/default/L3/images/default-image.png')}}"

                                                                                 alt="{{$row1['MReportName']}}"
                                                                            >
                                                                        </div>

                                                                    </figure>
                                                                </a>
                                                            @endif
                                                    @endif

                                                @endforeach
                                                <hr></hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    @endif
</div>

<script>
    $("#divScrollReport").height($(".modal-body").height() - 20);
    var mod = '{{Config::get("birt.BIRTCallingMode")}}';
    if (mod == "VP" || mod == "RP") {
        /*$("#divScrollReport").mCustomScrollbar({
            axis: "y",
            scrollButtons: {enable: true},
            theme: "minimal-dark",
            scrollbarPosition: "outside",
            scrollInertia: 50
        });*/
    }

    $(".main-content").scroll(function () {
        if ($("#idPrev").hasClass( "hide" )){
            currPosition = $(this).scrollTop();
            //console.log(currPosition);
            //$(".main-content").scrollTop(currPosition)

        }
    });

    function DisplaySetting(header, groupID){
        //console.log("test");
        if ($("#"+groupID+">div[class^='list-item']").hasClass( "hide")){
            $("#"+groupID+">div[class^='list-item']").removeClass("hide");
            $(header).removeClass("fa-plus-square-o");
            $(header).addClass("fa-minus-square-o");
        }else{
            $(header).addClass("fa-plus-square-o");
            $(header).removeClass("fa-minus-square-o");
            $("#"+groupID+">div[class^='list-item']").addClass("hide");
        }
    }

    var titleWidth = $("figure").width() -3;

    $(".lbl-title").attr("style", "min-width:" + titleWidth + "px" );
</script>
<style>
    .tree {
        min-height: 20px;
        padding: 19px;
        margin-bottom: 20px;
    }

    .tree li {
        list-style-type: none;
        margin: 0;
        position: relative
    }

    .tree li::before, .tree li::after {
        content: '';
        left: -20px;
        position: absolute;
        right: auto
    }

    .tree li::before {
        bottom: 50px;
        height: 100%;
        top: 0;
        width: 1px
    }

    .tree li::after {

        height: 20px;
        top: 25px;
        width: 25px
    }

    .tree li span {
        /*-moz-border-radius: 5px;*/
        /*-webkit-border-radius: 5px;*/
        border: 1px solid #999;
        border-radius: 5px;
        display: inline-block;
        padding: 3px 8px;
        text-decoration: none
    }

    .tree li.parent_li > span {
        cursor: pointer
    }

    .tree > ul > li::before, .tree > ul > li::after {
        border: 0
    }

    .tree li:last-child::before {
        height: 26px
    }

    .tree li.parent_li > span:hover, .tree li.parent_li > span:hover + ul li span {
        /*background: #eee;*/
        /*border: 1px solid #94a0b4;*/
        /*color: #000*/
    }

    #divScrollReport a:hover {
        color: darkorange !important;
    }
    figure{
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #ffffff;

    }
    figure:hover{
        box-shadow: rgba(50, 50, 50, 0.75) 0px 0px 5px 0px;

    }
    figcaption{
        margin-bottom: 0px;
        padding: 5px;
        border-bottom: 1px solid #ccc;
    }
    .listalbum a figure div {
        width: 100%;
        background-color: #ffffff !important;
    }

    .listalbum a img {
        max-width: 100%;
        width: 100%;
        height: 100%;
        background: #ccc;
        transition: none !important;
        border: 1px solid #ffffff;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }
    .listalbum a:hover img {
         transform: none;
    }

    .more-caption {
        display: block;
        width: 100px;
        white-space: nowrap;
        overflow: hidden !important;
        text-overflow: ellipsis;
        margin-left: 0px;
        pading-left: 0px;
    }
    .listalbum a, .listalbum a figcaption:hover{
        text-decoration: none !important;
        color: #0d6aad !important;
    }
    .listalbum a figcaption {
        margin-top: 5px;
        text-align: center;
        color: #333 !important;
        width: 100%;
        font-weight: 700;
    }
    .lbl-title {
        font-size: 16px;
        margin-top: 5px;
        background: #55a8fd;
        padding: 10px;
        border-radius: 5px;
        color: #ffffff;
        font-weight: bold !important;
        min-width: 150px;
    }
    .lbl-title>span{
        font-family: Source Sans Pro !important;
    }

</style>