@extends('layout.adminlogin')
@section('lcontent')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2"></div>
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                <div class="row  L3-login" style="margin-left: 0px; margin-right: 0px">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-5"></div>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 ">
                        <div class="row logolarge text-center">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                {{HTML::image(asset("packages/default/L3/images/companylogo-large.png"),null,['class' => 'center-block'])}}
                            </div>
                        </div>
                        <div class="row logolarge text-center">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group has-error hide">
                                    <label class="control-label"
                                           for="inputError1">{{Lang::get('message.Mat_khau_khong_hop_le')}}</label>
                                </div>
                                <div class="form-group has-feedback">
                                    <input type="password" class="form-control" id="password" placeholder="password"
                                           required/>
                                    <span class="fa fa-lock form-control-feedback"></span>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <button type="button" class="btn btn-primary pull-right smallbtn"
                                                onclick="SendData();">Login
                                        </button>
                                    </div><!-- /.col -->
                                </div>
                                <div class="panel panel-primary hide">
                                    {{Helpers::generateHeading("LemonWeb System Administrator - Login","",false,"",false)}}
                                    <div class="panel-body login-box-body">

                                    </div><!-- /.login-box-body -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2"></div>
        </div>

    </div>

@stop

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".container").css("marginTop", ($(document).height() - $(".container").height()) / 2 - 20);

            $("#password").on('keydown', function (e) {
                if (e.which == '13') {
                    SendData();
                }
            });
        });
        $(window).resize(function () {
            $(".container").css("marginTop", ($(document).height() - $(".container").height()) / 2) - 20;
        });

        function SendData() {
            $.ajax({
                method: "POST",
                url: '{{url("/adminlogin")}}',
                data: {p1: encryptData($("#password").val())},
                success: function (data) {
                    if (data == "0" || data == "") {
                        $(".has-error").removeClass('hide');
                    }
                    else {
                        window.location = '{{url("/W00F7111")}}';
                    }
                }
            });
        }
    </script>
@stop




