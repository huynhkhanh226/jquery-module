{{--Đây là form W00F0100--}}

@extends('layout.login')
@section('lcontent')
<div class="container">
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
                            {{Helpers::generateHeading(Helpers::getRS($g,'Cong_thong_tin_nhan_vien'),"",false,"",false)}}
                          <div class="panel-body login-box-body">
                            <form id="frmlogoness" action="" method="post">
                                <div class="form-group has-error {{$hide}}">
                                  <label class="control-label" for="inputError1">{{$err_text}}</label>
                                </div>
                                  <div class="form-group has-feedback">
                                    <input type="text" class="form-control" name="UserID" placeholder="{{Helpers::getRS($g,'Ma_nguoi_dung')}}" required  />
                                    <span class="fa fa-user form-control-feedback"></span>
                                  </div>
                                  <div class="form-group has-feedback">
                                    <input type="password" class="form-control" name="password" placeholder="{{Helpers::getRS($g,'Mat_khau')}}" required />
                                    <span class="fa fa-lock form-control-feedback"></span>
                                  </div>
                                  <div class="row">
                                    <div class="col-xs-7 col-md-8 ">
                                      <div class="checkbox">
                                        <label>
                                          <input type="checkbox" name="remember"> {{Helpers::getRS($g,"Ghi_nho_thong_tin_dang_nhap")}}
                                        </label>
                                      </div>
                                    </div><!-- /.col -->
                                    <div class="col-xs-5 col-md-4">
                                      <button type="submit" class="btn btn-primary btn-block btn-flat smallbtn">{{Helpers::getRS($g,'Dang_nhap')}}</button>
                                    </div><!-- /.col -->
                                  </div>
                            </form>
                          </div><!-- /.login-box-body -->
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
        $(document).ready(function() {
            $(".container").css("marginTop", ($(document).height() -  $(".container").height())/2 -20);
        });
        $(window).resize(function() {
            $(".container").css("marginTop", ($(document).height() -  $(".container").height())/2) - 20;
        });
        function ShowCompany(e) {
            if($("#company").hasClass('hide')) {
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




