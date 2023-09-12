@extends('layout.adminlogin')
@section('lcontent')
    <div class="container">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10" id="modalW00F7140">
                        <div class="row">
                            <div class="panel panel-primary">
                                {{Helpers::generateHeading("System Administrator - General Information <a href='".url('W00F7111')."' class='homeadmin fa fa-home'></a>","",false,"",false)}}
                                <div class="panel-body login-box-body">
                                    <div class="form-group has-error {{$show}}" style="overflow: hidden">
                                        <label class="col-sm-6" id=""
                                               for="inputError1">{{$message}}</label>
                                    </div>
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs" id="tabHW90F1300">
                                            <li class="active"><a data-toggle="tab" href="#tabW00F7140_1">{{Helpers::getRS(4,"1_Thong_tin_chung")}}</a></li>
                                            <li><a data-toggle="tab" href="#tabW00F7140_2">{{Helpers::getRS(4,"2_Hien_thi")}}</a></li>
                                        </ul>
                                        <form class="form-horizontal" action="" method="post" id="frmW00F7140"
                                              enctype="multipart/form-data">
                                            <div class="tab-content">
                                                <div id="tabW00F7140_1" class="tab-pane active">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label for="nserver" class="col-sm-6 control-label text-left">Session
                                                                timeout (minutes)</label>

                                                            <div class="col-sm-6 input-group">
                                                                <input type="number" class="form-control text-right" name="session_timeout"
                                                                       value="{{number_format(floatval(Config::get('session.lifetime')))}}"
                                                                       required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nserver" class="col-sm-6 control-label text-left">Connection Checking Interval (second)</label>

                                                            <div class="col-sm-6 input-group">
                                                                <input type="number" class="form-control text-right" name="connect_interval" min="1" max="300"
                                                                       value="{{Config::get('services.diginet.connect_interval')}}"
                                                                       required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label text-left">Audio Storage</label>

                                                            <div class="col-sm-8 input-group">
                                                                <input type="text" class="form-control" name="txtPathAudio" id="txtPathAudio"
                                                                       value="{{str_replace("%5C","\\",Config::get('services.path_audio'))}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label text-left">Video Storage</label>

                                                            <div class="col-sm-8 input-group">
                                                                <input type="text" class="form-control" name="txtPathVideo" id="txtPathVideo"
                                                                       value="{{str_replace("%5C","\\", Config::get('services.path_video'))}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nserver" class="col-sm-4 control-label text-left">Webservice
                                                                Url</label>

                                                            <div class="col-sm-8 input-group">
                                                                <input type="text" class="form-control" name="wcf_url"
                                                                       value="{{Config::get('services.diginet.url')}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            {{--<label for="userver" class="col-sm-4 control-label text-left">{{Helpers::getRS(0,'Logo_cong_ty')}}</label>--}}
                                                            <label for="userver" class="col-sm-4 control-label text-left">{{"Company's Logo"}}</label>

                                                            <div class="col-sm-8 input-group">
                                                                <img id="imgLogoW00F7140" src="{{asset('/packages/default/L3/images/companylogo-large.png')}}"
                                                                     width="200" class="mgt10"> <br>
                                                                <input type="file" name="logo" id="files">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label text-left">Languages</label>
                                                            <div class="checkbox col-sm-1 pdl0">
                                                                <label>
                                                                    <input type="checkbox" name="chkJapanese" {{Config::get('services.enableLanguage.showJapanese') == true?"checked":""}}>
                                                                    <img src="{{asset('/packages/default/L3/images/Japan.png')}}" style="margin-top: -6px !important;" alt="Japanese" title="Japanese">
                                                                </label>
                                                            </div>
                                                            <div class="checkbox col-sm-1">
                                                                <label>
                                                                    <input type="checkbox" name="chkChinese" {{Config::get('services.enableLanguage.showChinese') == true?"checked":""}}>
                                                                    <img src="{{asset('/packages/default/L3/images/China.png')}}" style="margin-top: -6px !important;" alt="Chinese" title="Chinese">
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @if(intval(Config::get('database.LWProduct','0'))!=1)
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label text-left">Personal Function</label>
                                                                <div class="checkbox col-sm-3 pdl0">
                                                                    <label>
                                                                        <input type="checkbox" name="chkShowW75" {{Config::get('services.showModule.W75') == true?"checked":""}}>
                                                                        Self Service
                                                                    </label>
                                                                </div>
                                                                <div class="checkbox col-sm-2 pdl0">
                                                                    <label>
                                                                        <input type="checkbox" id="chkShowW76" name="chkShowW76" {{Config::get('services.showModule.W76') == true?"checked":""}}>
                                                                        E-Office
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                                <!-- /.tab-pane -->
                                                <div id="tabW00F7140_2" class="tab-pane pd10" style="overflow: hidden" ">
                                                <fieldset class="flw100pc">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <legend class="legend">{{Helpers::getRS(4,"Phan_tieu_de")}}</legend>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label text-left">{{ Helpers::getRS(4, 'Mau_chu') }}</label>

                                                        <div class="col-sm-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="txtHeaderColor" id="txtHeaderColor"
                                                                       value="{{Config::get('display.header_color')}}">
                                                                <span class="input-group-btn">
                                                                        <input type="color" class="select-color" value="{{Config::get('display.header_color')}}" />
                                                                    </span>
                                                            </div>
                                                        </div>
                                                        <label class="col-sm-3 control-label text-left">{{ Helpers::getRS(4, 'Khi_re_chuot') }}</label>

                                                        <div class="col-sm-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="txtHeaderColorFocus" id="txtHeaderColorFocus"
                                                                       value="{{Config::get('display.header_color_h')}}">
                                                                <span class="input-group-btn">
                                                                        <input type="color" class="select-color" value="{{Config::get('display.header_color_h')}}" />
                                                                    </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label text-left">{{ Helpers::getRS(4, 'Mau_nen') }}</label>

                                                        <div class="col-sm-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="txtHeaderBgColor" id="txtHeaderBgColor"
                                                                       value="{{Config::get('display.header_bgcolor')}}">
                                                                <span class="input-group-btn">
                                                                        <input type="color" class="select-color" value="{{Config::get('display.header_bgcolor')}}" />
                                                                    </span>
                                                            </div>
                                                        </div>
                                                        <label class="col-sm-3 control-label text-left">{{ Helpers::getRS(4, 'Khi_re_chuot') }}</label>

                                                        <div class="col-sm-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="txtHeaderBgColorFocus" id="txtHeaderBgColorFocus"
                                                                       value="{{Config::get('display.header_bgcolor_h')}}">
                                                                <span class="input-group-btn">
                                                                        <input type="color" class="select-color" value="{{Config::get('display.header_bgcolor_h')}}" />
                                                                    </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="flw100pc">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <legend class="legend">{{Helpers::getRS(4,"Phan_menu_trai")}}</legend>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label text-left">{{ Helpers::getRS(4, 'Mau_bieu_tuong_cha') }}</label>

                                                        <div class="col-sm-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="txtMenuLeftIconColor" id="txtMenuLeftIconColor"
                                                                       value="{{Config::get('display.sidebar_iconcolor')}}">
                                                                <span class="input-group-btn">
                                                                        <input type="color" class="select-color" value="{{Config::get('display.sidebar_iconcolor')}}" />
                                                                    </span>
                                                            </div>
                                                        </div>
                                                        <label class="col-sm-3 control-label text-left">{{ Helpers::getRS(4, 'Khi_re_chuot') }}</label>

                                                        <div class="col-sm-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="txtMenuLeftIconColorFocus" id="txtMenuLeftIconColorFocus"
                                                                       value="{{Config::get('display.sidebar_iconcolor_h')}}">
                                                                <span class="input-group-btn">
                                                                        <input type="color" class="select-color" value="{{Config::get('display.sidebar_iconcolor_h')}}" />
                                                                    </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label text-left">{{ Helpers::getRS(4, 'Mau_chu_cha') }}</label>

                                                        <div class="col-sm-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="txtMenuLeftColor" id="txtMenuLeftColor"
                                                                       value="{{Config::get('display.sidebar_fcolor')}}">
                                                                <span class="input-group-btn">
                                                                        <input type="color" class="select-color" value="{{Config::get('display.sidebar_fcolor')}}" />
                                                                    </span>
                                                            </div>
                                                        </div>
                                                        <label class="col-sm-3 control-label text-left">{{ Helpers::getRS(4, 'Khi_re_chuot') }}</label>

                                                        <div class="col-sm-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="txtMenuLeftColorFocus" id="txtMenuLeftColorFocus"
                                                                       value="{{Config::get('display.sidebar_fcolor_h')}}">
                                                                <span class="input-group-btn">
                                                                        <input type="color" class="select-color" value="{{Config::get('display.sidebar_fcolor_h')}}" />
                                                                    </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label text-left">{{ Helpers::getRS(4, 'Mau_nen_cha') }}</label>

                                                        <div class="col-sm-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="txtMenuLeftBgColor" id="txtMenuLeftBgColor"
                                                                       value="{{Config::get('display.sidebar_fbgcolor')}}">
                                                                <span class="input-group-btn">
                                                                        <input type="color" class="select-color" value="{{Config::get('display.sidebar_fbgcolor')}}" />
                                                                    </span>
                                                            </div>
                                                        </div>
                                                        <label class="col-sm-3 control-label text-left">{{ Helpers::getRS(4, 'Khi_re_chuot') }}</label>

                                                        <div class="col-sm-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="txtMenuLeftBgColorFocus" id="txtMenuLeftBgColorFocus"
                                                                       value="{{Config::get('display.sidebar_fbgcolor_h')}}">
                                                                <span class="input-group-btn">
                                                                        <input type="color" class="select-color" value="{{Config::get('display.sidebar_fbgcolor_h')}}" />
                                                                    </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label text-left">{{ Helpers::getRS(4, 'Mau_bieu_tuong_Con') }}</label>

                                                        <div class="col-sm-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="txtMenuLeftIconColorChild" id="txtMenuLeftIconColorChild"
                                                                       value="{{Config::get('display.sidebar_iconcolorchild')}}">
                                                                <span class="input-group-btn">
                                                                        <input type="color" class="select-color" value="{{Config::get('display.sidebar_iconcolorchild')}}" />
                                                                    </span>
                                                            </div>
                                                        </div>
                                                        <label class="col-sm-3 control-label text-left">{{ Helpers::getRS(4, 'Khi_re_chuot') }}</label>

                                                        <div class="col-sm-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="txtMenuLeftIconColorChildFocus" id="txtMenuLeftIconColorChildFocus"
                                                                       value="{{Config::get('display.sidebar_iconcolorchild_h')}}">
                                                                <span class="input-group-btn">
                                                                        <input type="color" class="select-color" value="{{Config::get('display.sidebar_iconcolorchild_h')}}" />
                                                                    </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label text-left">{{ Helpers::getRS(4, 'Mau_chu_con') }}</label>

                                                        <div class="col-sm-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="txtMenuLeftColorChild" id="txtMenuLeftColorChild"
                                                                       value="{{Config::get('display.sidebar_lcolor')}}">
                                                                <span class="input-group-btn">
                                                                        <input type="color" class="select-color" value="{{Config::get('display.sidebar_lcolor')}}" />
                                                                    </span>
                                                            </div>
                                                        </div>
                                                        <label class="col-sm-3 control-label text-left">{{ Helpers::getRS(4, 'Khi_re_chuot') }}</label>

                                                        <div class="col-sm-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="txtMenuLeftColorChildFocus" id="txtMenuLeftColorChildFocus"
                                                                       value="{{Config::get('display.sidebar_lcolor_h')}}">
                                                                <span class="input-group-btn">
                                                                        <input type="color" class="select-color" value="{{Config::get('display.sidebar_lcolor_h')}}" />
                                                                    </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label text-left">{{ Helpers::getRS(4, 'Mau_nen_con') }}</label>

                                                        <div class="col-sm-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="txtMenuLeftBgColorChild" id="txtMenuLeftBgColorChild"
                                                                       value="{{Config::get('display.sidebar_lbgcolor')}}">
                                                                <span class="input-group-btn">
                                                                        <input type="color" class="select-color" value="{{Config::get('display.sidebar_lbgcolor')}}" />
                                                                    </span>
                                                            </div>
                                                        </div>
                                                        <label class="col-sm-3 control-label text-left">{{ Helpers::getRS(4, 'Khi_re_chuot') }}</label>

                                                        <div class="col-sm-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="txtMenuLeftBgColorChildFocus" id="txtMenuLeftBgColorChildFocus"
                                                                       value="{{Config::get('display.sidebar_lbgcolor_h')}}">
                                                                <span class="input-group-btn">
                                                                        <input type="color" class="select-color" value="{{Config::get('display.sidebar_lbgcolor_h')}}" />
                                                                    </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <!-- /.tab-pane -->
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
                                    </div>
                                    </form>
                                    <!-- /.tab-content -->
                                </div>
                                {{-- <form id="#modalW00F7140" action="demo_form.asp" method="post">
                                     <input type="text" name="fname" required>
                                     <input type="submit" value="Submit">
                                 </form>--}}
                            </div>
                            <!-- /.login-box-body -->
                        </div>
                    </div>

                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>

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
        //        console.log('abc');

        $(document).ready(function() {
            $('#tabW00F7140_2').find('input[type="text"]').trigger('blur');
        });

        var elements = $(document).find("input");

        for (var i = 0; i < elements.length; i++) {
            elements[i].oninvalid = function (e) {
                e.target.setCustomValidity("");
                if (!e.target.validity.valid) {

                    var limit = "{{Config::get('services.diginet.connect_interval_limit')}}";
                    if (Number(e.target.value) > Number(limit) && e.target.name == "connect_interval") {
                        var limitCon = "{{Config::get('services.diginet.connect_interval_limit')}}";
                        {{--e.target.setCustomValidity("{{Helpers::getRS(0,"Khoang_thoi_gian_kiem_tra_ket_noi_phai_nho_hon").' '.Config::get('services.diginet.connect_interval_limit')}}");--}}
                        e.target.setCustomValidity("{{Helpers::getRS(0,"Khoang_thoi_gian_kiem_tra_ket_noi_phai_nho_hon").' '}}" + Number(limitCon) *60);
                    } else {
                        e.target.setCustomValidity("{{Helpers::getRS(0,"Ban_phai_nhap_du_lieu")}}");
                    }

                }
            };
            elements[i].oninput = function (e) {
                e.target.setCustomValidity("");
            };
        }
        $('.select-color').on('change', function() {
            var colorCode = $(this).val();
            $(this).parents('.input-group').find('input[type="text"]').val(colorCode);
        });

        $('#tabW00F7140_2').find('input[type="text"]').blur(function() {
            var colorCode = $(this).val().toLowerCase();
            if (colorCode.indexOf('rgb') > -1) {
                colorCode = rgb2hex(colorCode);
            }
            $(this).parents('.input-group').find('.select-color').val(colorCode);
        });

        //Function to convert hex format to a rgb color
        function rgb2hex(rgb) {
            rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
            return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
        }

        function hex(x) {
            var hexDigits = ["0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"];
            return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
        }

        $('#modalW00F7140').on("change", '#files', function (e) {
            if (!e.target.files) return;
            var logo = e.target.files[0];
            var reader = new FileReader();
            reader.readAsDataURL(logo);
            reader.onload = function (event) {
                $('#imgLogoW00F7140').attr('src', event.target.result);
            };
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

        //button save submit -> require input
        $("#frmW00F7140").submit(function (e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                method: "post",
                url: '{{Request::url()}}',
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                data: formData,
                success: function (data) {
                    $(".has-error > label").html(data);
                    $(".has-error").removeClass('hide');
                }
            });
        });

        //Khi check ch?n EOffice th� m?i b?t bu?c nh?p 2 tr??ng n�y
        $("#chkShowW76").change(function(){
            //alert('dsfsfsa');
            $("#txtPathAudio").prop('required',$("#chkShowW76").is(':checked'))
            $("#txtPathVideo").prop('required',$("#chkShowW76").is(':checked'))
        });
        $('.nav-tabs a[data-toggle="tab"]').click(function(){

            //alert("dsfsdfd");
        });
        $("#modalW00F7140 .panel-body").height($(document).height() - 200);
    </script>
    <style>
        #modalW00F7140 .panel-body{
            overflow: auto;
            min-height: 400px;
        }
        #modalW00F7140 .panel{
            margin-top: 35px;
        }

    </style>
@stop





