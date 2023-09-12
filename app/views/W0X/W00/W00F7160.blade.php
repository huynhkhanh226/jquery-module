@extends('layout.adminlogin')
@section('lcontent')
    <div class="container">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8 " id="modalW00F7160">
                        <div class="row">
                            <div class="panel panel-primary">
                                {{Helpers::generateHeading("System Administrator - Mail Server Setup <a href='".url('W00F7111')."' class='homeadmin fa fa-home'></a>","",false,"",false)}}
                                <div class="panel-body login-box-body">
                                    <form class="form-horizontal" action="" method="post" id="frmW00F7160"
                                          enctype="multipart/form-data">
                                        <div class="box-body">
                                            <div class="form-group has-error {{$show}}">
                                                <label class="control-label" id=""
                                                       for="inputError1">{{$message}}</label>
                                            </div>

                                            <div class="form-group">
                                                <label for="nserver" class="col-sm-4 control-label text-left">{{Helpers::getRS(0,'Dia_chi_may_chu')}}</label>

                                                <div class="col-sm-8 input-group">
                                                    <input type="text" class="form-control" name="txtAddress"
                                                           value="{{$mailServer}}" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="nserver" class="col-sm-4 control-label text-left">{{Helpers::getRS(0,'Email_nguoi_dung')}}</label>

                                                <div class="col-sm-8 input-group">

                                                    <input type="email" class="form-control" name="txtEmail"
                                                           value="{{Helpers::decrypt_userpass(Config::get('mail.username'))}}" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="userver" class="col-sm-4 control-label text-left">{{Helpers::getRS(0,'Mat_khau_email')}}</label>

                                                <div class="col-sm-8 input-group">
                                                    <input type="password" class="form-control" name="txtPasswordEmail"
                                                           value="{{Helpers::decrypt_userpass(config::get('mail.password'))}}" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <label for="nserver" class="control-label text-left">{{Helpers::getRS(0,'Dang_cau_hinh')}}</label>
                                                </div>
                                                <div class="col-sm-8" style="padding: 0px !important;">

                                                    <div class="col-sm-4 text-left" align="center" style="padding: 0px 10px 0px 0px !important;">
                                                        <input type="radio" name="rdW00F7160" value="ssl" @if(config::get('mail.encryption')=='ssl') {{'checked'}} @endif >
                                                        <label class="control-label">SSL</label><br><br>
                                                        <input id="txtSSL" name="txtSSL" type="number" class="form-control" required
                                                               value =
                                                        @if(config::get('mail.encryption')=="ssl" && config::get('mail.port')!='')
                                                            {{config::get('mail.port')}}
                                                                @else {{'465'}}
                                                                @endif        >
                                                    </div>

                                                    <div class="col-sm-4 text-left" align="center" style="padding: 0px 10px 0px 0px !important;">
                                                        <input type="radio" name="rdW00F7160" value="tls" @if(config::get('mail.encryption')=='tls') {{'checked'}} @endif >
                                                        <label class="control-label">TLS</label><br><br>
                                                        <input id="txtTLS" name="txtTLS" type="number"
                                                               class="form-control" required
                                                               value =
                                                        @if(config::get('mail.encryption')=="tls" && config::get('mail.port')!='')
                                                            {{config::get('mail.port')}}
                                                                @else {{'587'}}
                                                                @endif      >
                                                    </div>

                                                    <div class="col-sm-4 text-left" align="center" style="padding: 0px !important;">
                                                        <input type="radio" name="rdW00F7160" value="" @if(config::get('mail.encryption')=='') {{'checked'}} @endif>
                                                        <label class="control-label">None SSL</label><br><br>
                                                        <input id="txtNoneSSL" name="txtNoneSSL" type="number"
                                                               class="form-control"
                                                               required
                                                               value =
                                                        @if(config::get('mail.encryption')=="" && config::get('mail.port')!='')
                                                            {{config::get('mail.port')}}
                                                                @else {{'25'}}
                                                                @endif      >
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label for="userver" class="col-sm-4 control-label text-left">URL</label>

                                                <div class="col-sm-8 input-group">
                                                    <input class="form-control" name="txtURLEmail"
                                                           value="{{$mailURL}}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer">
                                            <div class="row">
                                                <button type="button" onclick="window.history.back()"
                                                        class="btn btn-primary smallbtn pull-left"><i class="fa fa-backward"></i>
                                                    Return
                                                </button>
                                                <button class="btn btn-primary smallbtn pull-right">Save</button>
                                            </div>
                                        </div>
                                        <!-- /.box-footer -->
                                    </form>
                                    {{-- <form id="#modalW00F7140" action="demo_form.asp" method="post">
                                         <input type="text" name="fname" required>
                                         <input type="submit" value="Submit">
                                     </form>--}}
                                </div>
                                <!-- /.login-box-body -->
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
<style>
    /*Hide arrow type number*/
    input[type='number'] {
        -moz-appearance:textfield;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
</style>
@section('script')
    <script type="text/javascript">

        var elements = $(document).find("input");
        for (var i = 0; i < elements.length; i++) {
            elements[i].oninvalid = function(e) {
                e.target.setCustomValidity("");
                if (!e.target.validity.valid) {
                    e.target.setCustomValidity("{{Helpers::getRS(0,"Ban_phai_nhap_du_lieu")}}");
                }
            };
            elements[i].oninput = function(event) {
                e.target.setCustomValidity("");
            };
        }

        $(function() {
            var invalidate_input = function() {
                if ($('input[name=rdW00F7160]:checked').val() == "ssl") {
                    $('#txtSSL').removeAttr('disabled');
                    $('#txtTLS').attr('disabled', 'disabled');
                    $('#txtNoneSSL').attr('disabled', 'disabled');
                }
                else if ($('input[name=rdW00F7160]:checked').val() == "tls") {
                    $('#txtSSL').attr('disabled','disable');
                    $('#txtTLS').removeAttr('disabled');
                    $('#txtNoneSSL').attr('disabled', 'disabled');
                }
                else {
                    $('#txtSSL').attr('disabled','disable');
                    $('#txtTLS').attr('disabled','disable');
                    $('#txtNoneSSL').removeAttr('disabled');
                }
            };

            $("input[name=rdW00F7160]").change(invalidate_input);

            invalidate_input();
        });


        $(".container").css("marginTop", ($(document).height() - $(".container").height()) / 2 - 20);

        $('#maindb').on('input', function (e) {
            $("#btnReMaindb").addClass("hide");
        });

        $('#subdb').on('input', function (e) {
            $("#btnReSubdb").addClass("hide");
        });

        $(window).resize(function () {
            $(".container").css("marginTop", ($(document).height() - $(".container").height()) / 2) - 20;
        });

        //ajax gui du lieu controller
        var updateSystemseptup = function () {
            $.ajax({
                method: "post",
                url: '{{Request::url()}}',
                data: $("#frmW00F7160").serialize() + "&do=systemsetup",
                success: function (data) {
                    //console.log(data);
                    $(".has-error > label").html(data);
                    $(".has-error").removeClass('hide');
                }
            });
        };

        //button save submit -> require input
        $( "#frmW00F7160" ).submit(function( e ) {
            e.preventDefault();
            updateSystemseptup();
        });

    </script>
@stop





