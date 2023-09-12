@extends('layout.adminlogin')
@section('lcontent')
    <div class="container">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="panel panel-primary">
                                {{Helpers::generateHeading("System Administrator - Home Page <a href='".url('/W00F7111/logout')."' class='homeadmin fa fa-sign-out' title='Log out'></a>","",false,"",false)}}
                                <form class="form-horizontal" action="" method="POST" id="frmW00F7111"
                                      enctype="multipart/form-data">
                                    <div class="panel-body login-box-body">
                                        <div class="row">
                                            <div class="MyPageDesc">
                                                <a onclick="" href="{{url("W00F7130")}}">
                                                    <i class="fa fa-database text-yellow mgr10"></i>
                                                    Setup Database Connections</a>
                                            </div>

                                            <div class="MyPageDesc">
                                                <a onclick="" href="{{url("W00F7120")}}">
                                                    <i class="fa fa-key text-yellow mgr10"></i>
                                                    Change Administrator Password</a>
                                            </div>
                                            <div class="MyPageDesc">
                                                <a onclick="" href="{{url("W00F7140")}}">
                                                    <i class="fa fa-server text-yellow mgr10"></i>
                                                    General Information</a>
                                            </div>
                                            <div class="MyPageDesc">
                                                <a onclick="" href="{{url("W00F7160")}}">
                                                    <i class="fa fa-envelope-o text-yellow mgr10"></i>
                                                    Mail Server Setup</a>
                                            </div>


                                            <div class="MyPageDesc">
                                                <a onclick="" href="{{url("W00F7150")}}">
                                                    <i class="fa fa-sliders text-yellow mgr10"></i>
                                                    BIRT Server Setup</a>
                                            </div>

                                            <div class="MyPageDesc">
                                                <a onclick="" href="{{url("W00F7170")}}">
                                                    <i class="fa fa-paperclip text-yellow mgr10"></i>
                                                    Attachment Setup</a>
                                            </div>

                                            <div class="MyPageDesc">
                                                <div class="col-sm-9 form-group">
                                                    <lable class="fa fa-language text-yellow mgr10" style = "width: 15px"></lable>
                                                    <button type="button" onclick="updateResource()"
                                                            class="btn btn-primary smallbtn">Update Custom Resource
                                                    </button>
                                                </div>

                                                <div class="col-sm-3 form-group has-error {{$show}}">
                                                    <label class="control-label" id=""
                                                           for="inputError1">{{$err_text}}</label>
                                                </div>
                                            </div>
                                            <div class="MyPageDesc">
                                                <div class="col-sm-9 form-group">
                                                    <lable class="fa fa-connectdevelop text-yellow mgr10" style = "width: 15px"></lable>
                                                    <button type="button" onclick="updateConfig()"
                                                            class="btn btn-primary smallbtn">Update Configuration
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.login-box-body -->
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-2"></div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>

    </div>

@stop

@section('script')
    <script type="text/javascript">

        $(document).ready(function () {
            $(".container").css("marginTop", ($(document).height() - $(".container").height()) / 2 - 20);
        });
        $(window).resize(function () {
            $(".container").css("marginTop", ($(document).height() - $(".container").height()) / 2) - 20;
        });

        var updateResource = function () {
            $.ajax({
                method: "POST",
                url: '{{Request::url()}}',
                data: $("#frmW00F7111").serialize(),
                success: function (data) {
                    $(".has-error >label").html(data);
                    $(".has-error").removeClass('hide');
                }
            });
        };

        function updateConfig(){
            $.ajax({
                method: "POST",
                url: '{{url("/W00F7111/config")}}',
                //data: $("#frmW38F2040").serialize() + "&transID=" +transID + "&departmentIDW38F2040=" + $("#cboDepartmentIDW38F2040").val(),
                success: function (data) {
                }
            });
        }

    </script>
@stop




