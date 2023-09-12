{{--Đây là form W00F0100  --}}

@extends('layout.login')
@section('lcontent')
    <div class="container" style="visibility: hidden">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8 L3-login">
                        <div class="row logolarge">
                            {{HTML::image(asset("packages/default/L3/images/companylogo-large.png"),null,['class' => 'center-block'])}}
                        </div>
                        <div class="row">
                            <div class="panel panel-primary">
                                {{Helpers::generateHeading(Helpers::getRS($g,'He_thong_phan_mem_quan_tri_doanh_nghiep'),"",false,"",false)}}
                                <div class="panel-body login-box-body">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            @if (Config::get('services.enableLanguage.showChinese') == true)
                                            <a class="pull-right" id="lnkChinese" onclick='SetLang("zh");'>
                                                <img src="{{asset("packages/default/L3/images/China.png")}}" title="简体中文" alt="Chinese"/>
                                            </a>
                                            <span class="pull-right"> &nbsp;&nbsp;</span>
                                            @endif
                                            @if (Config::get('services.enableLanguage.showJapanese') == true)
                                            <a class="pull-right" id="lnkJapanese" onclick='SetLang("ja");'>
                                                <img src="{{asset("packages/default/L3/images/Japan.png")}}" title="日本語" alt="Japanese"/>
                                            </a>
                                            <span class="pull-right"> &nbsp;&nbsp;</span>
                                            @endif
                                            <a class="pull-right" id="lnkVietnamese" onclick='SetLang("en");'>
                                                <img src="{{asset("packages/default/L3/images/United-Kingdom.png")}}" alt="English" title="English"/>
                                            </a> &nbsp;
                                            <span class="pull-right"> &nbsp;&nbsp;</span>
                                            <a class="pull-right" id="lnkEnglish" onclick='SetLang("vi");'>
                                                <img src="{{asset("packages/default/L3/images/Vietnam.png")}}" title="Việt Nam" alt="Việt Nam"/>
                                            </a>
                                        </div>
                                        <div class="form-group has-error {{$hide}}">
                                            <label class="control-label" for="inputError1">{{$err_text}}</label>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <input type="text" class="form-control" name="UserID"
                                                   placeholder="{{Helpers::getRS($g,'Ma_nguoi_dung')}}" required/>
                                            <span class="fa fa-user form-control-feedback"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <input type="password" class="form-control" name="password"
                                                   placeholder="{{Helpers::getRS($g,'Mat_khau')}}" required/>
                                            <span class="fa fa-lock form-control-feedback"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label class="pointer lbl-normal" onclick="ShowCompany(this)"><i><u>{{Helpers::getRS($g,'Chon_doanh_nghiepU')}}</u></i></label>
                                        </div>
                                        <div id="company" class="form-group has-feedback hide">
                                            <input type="text" class="form-control" name="company" value="{{$DBCOM}}"
                                                   placeholder="{{Helpers::getRS($g,'Ma_doanh_nghiep')}}" required/>
                                            <span class="fa fa-university form-control-feedback"></span>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-7 col-md-8">
                                                <div class="checkbox ">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="remember"> {{Helpers::getRS($g,"Ghi_nho_thong_tin_dang_nhap")}}
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-xs-5 col-md-4">
                                                <button type="submit"
                                                        class="btn btn-primary btn-block btn-flat smallbtn">{{Helpers::getRS($g,'Dang_nhap')}}</button>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        {{--<div class="row">--}}
                                        {{--<div class="col-xs-12 col-md-12 text-center">--}}

                                        {{--<label class="pointer lbl-normal"--}}
                                        {{--><i><u><a href="{{url('/esslogin')}}">{{Helpers::getRS($g,"Dang_nhap_cong_thong_tin_nhan_vien")}}</a></u></i></label>--}}
                                        {{--</div>--}}
                                        {{--<!-- /.col -->--}}
                                        {{--</div>--}}
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

@stop

@section('script')
    <script type="text/javascript">

        $(document).ready(function () {
            $(".container").css("marginTop", ($(document).height() - $(".container").height()) / 2 - 20);
            $(".container").css('visibility', 'visible');
        });
        $(window).resize(function () {
            $(".container").css("marginTop", ($(document).height() - $(".container").height()) / 2) - 20;
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
    </script>
@stop




