@extends('layout.adminlogin')
@section('lcontent')
<div class="container">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8 ">
                     <div class="row">
                        <div class="panel panel-primary">
                            {{Helpers::generateHeading("System Administrator - Change Password <a href='".url('W00F7111')."' class='homeadmin fa fa-home'></a>","",false,"",false)}}
                          <div class="panel-body login-box-body">
                            <form action="" method="post">
                                <div class="form-group has-error {{$hide}}">
                                  <label class="control-label" for="inputError1">{{$err_text}}</label>
                                </div>
                                <div class="form-group has-feedback">
                                    <input type="password" class="form-control" name="oldpassword" placeholder="Old Password" required />
                                    <span class="fa fa-lock form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <input type="password" class="form-control" name="newpassword" placeholder="New Password" required />
                                    <span class="fa fa-lock form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm" required />
                                    <span class="fa fa-lock form-control-feedback"></span>
                                </div>
                                <div class="row">
                                    <div class="col-xs-7 col-md-8"></div><!-- /.col -->
                                    <div class="col-xs-5 col-md-4">
                                      <button type="submit" class="btn btn-primary smallbtn pull-right">Save</button>
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

    </script>
@stop




