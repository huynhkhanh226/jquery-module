<header class="main-header">
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation" style="height: 47px !important;">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="">
                    <a class="backButton" href="{{url('/')}}" target="_self"><i class="fa fa-home fa-2x"></i></a>
                </div>
                <div class="">
                    <a class="backButton" href="
                    @if(isset($back_url) && $level == 3)
                    {{$back_url}}
                    @else {{url()}}
                    @endif
                            " target="_self"><i class="fa fa-arrow-left" style="font-size: 160%;padding-top: 3px !important;"></i></a>
                </div>
                <div class="">
                    <p class="name-company short-caption" title="test">{{isset($reportName) ? $reportName: "Công ty cổ phần tập đoàn vinaco"}}</p>
                </div>
                <div class="" style="float: right">
                    <a class="glyphicon glyphicon-log-out fa-2x text-white" style="padding: 9px 5px!important;font-size: 210%" href="{{url("logout")}}"></a>
                </div>
                <div class=""  style="float: right">
                    @if (isset($level) && $level == 3)
                        <div style="float: right">
                            <a onclick="show(true);" data-toggle="collapse" href="#test" class="sidebar-toggle fa-2x" id="idMenuShow" style="padding: 8px !important;"></a>
                            <a onclick="show(false);" data-toggle="collapse" href="#test" class="glyphicon glyphicon-remove text-white hide" id="idMenuClose" style="padding: 13px 23px!important;font-size: 180%"></a>
                        </div>
                    @endif
                </div>
            </div>
        </nav>

    </nav>
</header>
<script>
    var dblLeft = $(window).width() * 0.8;
    var dblWidth = $(window).width() * 0.88;
    $("#idExportMenu").find(".dropdown-menu").offset({left: - dblLeft})
    $("#idExportMenu").find(".dropdown-menu").width(dblLeft);
    $(".short-caption").width($(document).width()-250);
    function show(bShow){
        if (bShow){
            $("#idMenuShow").addClass("hide");
            $(".secMenu").removeClass("hide");
            $(".secReport").addClass("hide");
            $("#idMenuClose").removeClass("hide");
        }else{
            $("#idMenuShow").removeClass("hide");
            $(".secMenu").addClass("hide");
            $(".secReport").removeClass("hide");
            $("#idMenuClose").addClass("hide");
        }

    }
</script>
<style type="text/css" media="screen">
    .col-xs-12, .col-sm-12, .col-md-12, .container {
        padding-left: 0px !important;
        padding-right: 0px !important;
    }

    @media screen and (max-width: 767px) {
        p, .btn, input, div, span, h4 {
            font-size: 95%;
        }
    }


    .dropdown-menu{
        right:0px !important;
        font-size: 12px !important;
    }
    .dropdown-menu li a:hover {
        background: #ffffff !important;
        border-radius: 3px;
    }
/*
    .navbar-nav .open .dropdown-menu > li > a {
        line-height: 20px !important;
    }
    .wrap {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        width: 270px;
    }

    #wrapperaaa {
        width: 11em;
        word-wrap: break-word;
    }

    .list-group{
        margin-bottom: 0px !important;
    }*/
</style>


