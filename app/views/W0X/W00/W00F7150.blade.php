@extends('layout.adminlogin')
@section('lcontent')
    <div class="container">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8 " id="modalW00F7140">
                        <div class="row">
                            <div class="panel panel-primary">
                                {{Helpers::generateHeading("System Administrator - BIRT Server Setup <a href='".url('W00F7111')."' class='homeadmin fa fa-home'></a>","",false,"",false)}}
                                <div class="panel-body login-box-body">
                                    <form class="form-horizontal " style="margin-bottom: 0px" action="" method="post" id="frmW00F7150"
                                          enctype="multipart/form-data">
                                        <div class="box-body">
                                            <div class="row has-error hide" style="margin-bottom: 10px;padding-left: 15px">
                                                <label class="control-label" id="" for="inputError1">{{$message}}</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5 col-xs-5">
                                                    <label class="lbl-normal">BIRT Report Calling Mode</label>
                                                </div>
                                                <div class="col-md-7 col-xs-7">
                                                    <div class="radio" style="padding-top:1px">
                                                        <label>
                                                            <input type="radio" name="optBIRTCallingMode"
                                                                   id="optBIRTCallingMode"
                                                                   value="VP" {{Config::get('birt.BIRTCallingMode') == 'VP' ? 'checked':''}}>
                                                            BIRT viewer - Popup
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5 col-xs-5">
                                                </div>
                                                <div class="col-md-7 col-xs-7">
                                                    <div class="radio" style="padding-top:1px">
                                                        <label>
                                                            <input type="radio" name="optBIRTCallingMode"
                                                                   id="optBIRTCallingMode"
                                                                   value="VT" {{Config::get('birt.BIRTCallingMode') == 'VT' ? 'checked':''}}>
                                                            BIRT viewer - New Tab
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5 col-xs-5">
                                                </div>
                                                <div class="col-md-7 col-xs-7">
                                                    <div class="radio" style="padding-top:1px">
                                                        <label>
                                                            <input type="radio" name="optBIRTCallingMode"
                                                                   id="optBIRTCallingMode"
                                                                   value="RP" {{Config::get('birt.BIRTCallingMode') == 'RP' ? 'checked':''}}>
                                                            RESTful service - Popup
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5 col-xs-5">
                                                </div>
                                                <div class="col-md-7 col-xs-7">
                                                    <div class="radio" style="padding-top:1px">
                                                        <label>
                                                            <input type="radio" name="optBIRTCallingMode"
                                                                   id="optBIRTCallingMode"
                                                                   value="RT" {{Config::get('birt.BIRTCallingMode') == 'RT' ? 'checked':''}}>
                                                            RESTful service - New Tab
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5 col-xs-5">
                                                    <div class="liketext">
                                                        <label>BIRT Server URL</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-xs-7">
                                                    <input type="text" class="form-control" placeholder=""
                                                           name="idTomcatServer" id="idTomcatServer"
                                                           value="{{Config::get('birt.TomcatServer')}}" required>
                                                </div>
                                            </div>
                                            <!-- Vew mode -->
                                            <div class="row">
                                                <div class="col-md-5 col-xs-5">
                                                    <div class="liketext">
                                                        <label>View mode</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-xs-7">
                                                    <div class="radio pdt0 mgt5">
                                                        <label>
                                                            <input type="radio" value="0" id="optViewMode0" name="optViewMode" {{Config::get('birt.ViewMode') == '0' ? 'checked':''}}>List
                                                        </label>
                                                        <label class="mgl15">
                                                            <input type="radio" value="1" id="optViewMode1" name="optViewMode" {{Config::get('birt.ViewMode') == '1' ? 'checked':''}}>Small icons
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="border-bottom: 2px solid #337ab7;margin-top: 20px">
                                            </div>
                                            <div class="row" style="margin-top: 10px">
                                                <div class="col-md-5 col-xs-5 pdl0">
                                                    <button type="button" onclick="window.history.back()"
                                                            class="btn btn-primary smallbtn pull-left"><i
                                                                class="fa fa-backward"></i>
                                                        Return
                                                    </button>
                                                </div>
                                                <div class="col-md-7 col-xs-7 pdr0">
                                                    <button class="btn btn-primary smallbtn pull-right">Save</button>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
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
    <div class="l3loading hide">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
@stop
<style>
    /*Hide arrow type number*/
    input[type='number'] {
        -moz-appearance: textfield;
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
            elements[i].oninvalid = function (e) {
                e.target.setCustomValidity("");
                if (!e.target.validity.valid) {
                    e.target.setCustomValidity("{{Helpers::getRS(0,"Ban_phai_nhap_du_lieu")}}");
                }
            };
            elements[i].oninput = function (event) {
                e.target.setCustomValidity("");
            };
        }
        $(".container").css("marginTop", ($(document).height() - $(".container").height()) / 2 - 20);
        $(window).resize(function () {
            $(".container").css("marginTop", ($(document).height() - $(".container").height()) / 2) - 20;
        });

        //ajax gui du lieu controller
        var updateSystemseptup = function () {
            $(".l3loading").removeClass('hide');
            $.ajax({
                method: "post",
                url: '{{Request::url()}}',
                data: $("#frmW00F7150").serialize(),
                success: function (data) {
                    $(".l3loading").addClass('hide');
                    $(".has-error > label").html(data);
                    $(".has-error").removeClass('hide');
                }
            });
        };

        //button save submit -> require input
        $("#frmW00F7150").submit(function (e) {
            e.preventDefault();
            updateSystemseptup();
        });

    </script>
@stop





