{{--Login page sercure (Don't allow browser save password)--}}
@extends('layout.login')
@section('lcontent')
    <div class="container" style="visibility: hidden">
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
                                <form method="post" autocomplete="false" >
                                    <div class="form-group">
                                        @if (Config::get('services.enableLanguage.showChinese') == true)
                                            <a class="pull-right" id="lnkChinese" onclick='SetLang("zh");'>
                                                <img src="{{asset("packages/default/L3/images/China.png")}}"
                                                     title="简体中文" alt="Chinese"/>
                                            </a>
                                            <span class="pull-right"> &nbsp;&nbsp;</span>
                                        @endif
                                        @if (Config::get('services.enableLanguage.showJapanese') == true)
                                            <a class="pull-right" id="lnkJapanese" onclick='SetLang("ja");'>
                                                <img src="{{asset("packages/default/L3/images/Japan.png")}}"
                                                     title="日本語" alt="Japanese"/>
                                            </a>
                                            <span class="pull-right"> &nbsp;&nbsp;</span>
                                        @endif
                                        <a class="pull-right" id="lnkVietnamese" onclick='SetLang("en");'>
                                            <img src="{{asset("packages/default/L3/images/United-Kingdom.png")}}"
                                                 alt="English" title="English"/>
                                        </a> &nbsp;
                                        <span class="pull-right"> &nbsp;&nbsp;</span>
                                        <a class="pull-right" id="lnkEnglish" onclick='SetLang("vi");'>
                                            <img src="{{asset("packages/default/L3/images/Vietnam.png")}}"
                                                 title="Việt Nam" alt="Việt Nam"/>
                                        </a>
                                    </div>
                                    <div class="form-group has-error {{$hide}}">
                                        <label class="control-label" for="inputError1">{{$err_text}}</label>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control" name="txtUsernameFake"
                                               id="txtUsernameFake"
                                               autocomplete="off"
                                               readonly onfocus="this.removeAttribute('readonly');"
                                               placeholder="{{Helpers::getRS($g,'Ma_nguoi_dung')}}" required/>
                                        <span class="fa fa-user form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="password" class="form-control" name="txtPasswordFake"
                                               id="txtPasswordFake"
                                               autocomplete="off"
                                               readonly onfocus="this.removeAttribute('readonly');"
                                               placeholder="{{Helpers::getRS($g,'Mat_khau')}}" required/>
                                        <span class="fa fa-lock form-control-feedback"></span>
                                    </div>

                                    <input type="submit" class="hide" id="hdSubmitLoginFake"/>
                                </form>
                                <form id="frmLogin" method="post" autocomplete="false">
                                    <input type="text" id="p1" name="p1" autofocus style="display: none;"
                                           autocomplete="off"/>
                                    <input type="text" id="p2" name="p2" style="display: none;"
                                           autocomplete="off"/>
                                    <input type="text" id="p3" name="p3" style="display: none;"
                                           autocomplete="off"/>
                                    <div class="row form-group">
                                        <div class="col-xs-7 col-md-8">
                                            <label class="pointer lbl-normal"
                                                   onclick="ShowCompany(this)"><i><u>{{Helpers::getRS($g,'Chon_doanh_nghiepU')}}</u></i></label>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-xs-5 col-md-4">
                                            <button type="button" id="btnLogin"
                                                    class="btn btn-primary  btn-flat pull-right">{{Helpers::getRS($g,'Dang_nhap')}}<i class="fa fa-sign-in mgl10" aria-hidden="true"></i></button>
                                            <input type="submit" class="hide" id="hdSubmitLogin"/>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>
                                <div id="company" class="has-feedback hide mgb5">
                                    <input type="text" class="form-control"  id="companyid" name="company" value="{{$DBCOM}}"
                                           placeholder="{{Helpers::getRS($g,'Ma_doanh_nghiep')}}" required/>
                                    <span class="fa fa-university form-control-feedback"></span>
                                </div>
                                <div class="row hide">
                                    <div class="panel panel-primary">
                                        {{Helpers::generateHeading(Helpers::getRS($g,'He_thong_phan_mem_quan_tri_doanh_nghiep'),"",false,"",false)}}
                                        <div class="panel-body login-box-body">

                                        </div>
                                        <!-- /.login-box-body -->
                                    </div>
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
        /*      function createstars(n) {
                  var stars = "";
                  for (var i = 0; i < n; i++) {
                      stars += "\u25CF";
                  }
                  return stars;
              }
      */

        $(document).ready(function () {
            //$(".login-page").height($(document).height());
            $(".login-page").width("100%");
            var height = Math.ceil(((($(document).height() - $(".L3-login").height())/2)/$(document).height()) * 100) - 0.001;
            $(".L3-login").css("marginTop", height + "%");
            setTimeout(function(){
                $("#txtUsernameFake").prop("readonly", false);
                $("#txtPasswordFake").prop("readonly", false);
                $("#txtUsernameFake").focus();
            },300);

            $(window).resize(function(){
                setTimeout(function(){
                    var height = Math.ceil(((($(document).height() - $(".L3-login").height())/2)/$(document).height()) * 100);
                    $(".L3-login").css("marginTop", height + "%");
                }, 300);

            });

            //$(".container").css("marginTop", ($(document).height() - $(".container").height()) / 2 - 20);
            //$(".container").css("marginTop", "10%");
            $(".container").css('visibility', 'visible');

            /*var timer = "";
            $("body").on("keypress", "#txtPassword1", function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                //alert("keypress: " +code);
                if (code >= 32 && code <= 127) {
                    var character = String.fromCharCode(code);
                    $("#hdpassword").val($("#hdpassword").val() + character);
                }
            });

            $("body").on("keyup", "#txtPassword1", function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                //alert("keyup: " +code);
                if (code == 8) {
                    var length = $("#txtPassword1").val().length;
                    $("#hdpassword").val($("#hdpassword").val().substring(0, length));
                } else if (code == 37) {

                } else {
                    var current_val = $('#txtPassword1').val().length;
                    $("#txtPassword1").val(createstars(current_val - 1) + $("#txtPassword1").val().substring(current_val - 1));
                }

                clearTimeout(timer);
                timer = setTimeout(function() {
                    $("#txtPassword1").val(createstars($("#txtPassword1").val().length));
                }, 1);
            });*/

        });

        $(window).resize(function () {
            //$(".container").css("marginTop", ($(document).height() - $(".container").height()) / 2) - 20;
        });

        function ShowCompany(e) {
            if ($("#company").hasClass('hide')) {
                $("#company").removeClass('hide');
            }
            else {
                $("#company").addClass('hide');

            }
        }

        function SetLang(lang) {
            $.ajax({
                method: 'GET',
                url: '{{url("/setLang")}}/' + lang,
                success: function () {
                    location.reload();
                }
            });
        }

        function message_warning(msg) {
            return '<div class="row"> ' +
                '<div class="col-sm-12"> ' +
                '<i class="fa fa-exclamation-triangle text-orange pdr15" style="font-size:2.5em;float:left"></i>' + '<span style="display:inline-flex">' + msg + '</span>' +
                '</div>' +
                '</div>';
        }

        //Kiem tra single login
        $("#btnLogin").click(function (event) {
            console.log("dfs");
            var allowSubmit = true;
            var txtUsernameFake = $("#txtUsernameFake");
            var txtPasswordFake = $("#txtPasswordFake");

            txtUsernameFake.get(0).setCustomValidity("");
            txtPasswordFake.get(0).setCustomValidity("");


            if (txtUsernameFake.val() == "") {
                txtUsernameFake.prop("readonly", false);
                txtUsernameFake.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap_du_lieu')}}");
                $('#hdSubmitLoginFake').click();
                allowSubmit = false;
                return false;
            }

            if (txtPasswordFake.val() == "") {
                txtPasswordFake.prop("readonly", false);
                txtPasswordFake.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap_du_lieu')}}");
                $('#hdSubmitLoginFake').click();
                allowSubmit = false;
                return false;
            }

            if (allowSubmit) {
                ///Thuc hien kiem

                var user_encrypt = encryptData($("#txtUsernameFake").val());// CryptoJS.AES.encrypt(JSON.stringify($("#txtUsernameFake").val()), $("#secretKey").val(), {format: CryptoJSAesJson}).toString();
                var pass_encrypt = encryptData($("#txtPasswordFake").val());//CryptoJS.AES.encrypt(JSON.stringify($("#txtPasswordFake").val()), $("#secretKey").val(), {format: CryptoJSAesJson}).toString();
                var company_encrypt = encryptData($("#companyid").val());
                $("#p1").val(user_encrypt);
                $("#p2").val(pass_encrypt);
                $("#p3").val(company_encrypt);
                sessionStorage.setItem('key1', encryptData('10.0.0.15\SQL2012'));

                var username = $("#p1").val();
                var password = $("#p2").val();

                var isCheck = '{{Config::get('app.checkLicense')}}';
                if (isCheck == true) {
                    $.ajax({
                        method: "POST",
                        url: '{{url('checklogin/invalid')}}',
                        data: {username: username, password: password},
                        success: function (data) {
                            console.log(data);
                            console.log(data);
                            var rs = $.parseJSON(data);
                            switch (rs.CODE) {
                                case 'LOGIN':
                                    bootbox.dialog({
                                        //message: rs.message,
                                        message: message_warning(rs.message),
                                        title: '{{Session::get('Lang') == '84' ? "Thông báo":"Warning"}}',
                                        buttons: {
                                            confirm: {
                                                label: 'Yes',
                                                className: 'btn-success',
                                                callback: function () {
                                                    $.ajax({
                                                        method: "POST",
                                                        url: '{{url('checklogin/removeuser')}}',
                                                        data: {username: username, password: password},
                                                        success: function (data) {
                                                            console.log(data);
                                                            $("#hdSubmitLogin").trigger('click');
                                                        }
                                                    });
                                                }
                                            },

                                            cancel: {
                                                label: 'No',
                                                className: 'btn-danger'
                                            }

                                        }

                                    });
                                    break;
                                case 'LOGOUT':
                                    $("#hdSubmitLogin").trigger('click');
                                    break;
                                case 'ERROR':
                                    bootbox.alert({
                                        message: message_warning(rs.message),
                                        title: '{{Session::get('Lang') == '84' ? "Thông báo":"Warning"}}'
                                    });
                                    break;
                                case 'NOT-EXIST':
                                    bootbox.alert({
                                        message: message_warning(rs.message),
                                        title: '{{Session::get('Lang') == '84' ? "Thông báo":"Warning"}}'
                                    });
                                    break;
                            }
                        }
                    });
                } else {
                    $("#hdSubmitLogin").trigger('click');
                }
            }

        });

        $('input').keydown(function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                e.stopPropagation();
                $("#btnLogin").trigger('click');
            }
        })
    </script>
@stop




