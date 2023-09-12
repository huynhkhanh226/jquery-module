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
                                {{Helpers::generateHeading("System Administrator - Setup Database Connections <a href='".url('W00F7111')."' class='homeadmin fa fa-home'></a>","",false,"",false)}}
                                <div class="panel-body login-box-body">
                                    <form class="form-horizontal" action="" method="post" id="frmW00F7130">
                                        <div class="box-body">
                                            <div class="form-group has-error {{$show}}">
                                                <label class="control-label" for="inputError1">{{$message}}</label>
                                            </div>
                                            <div class="form-group">
                                                <label for="nserver" class="col-sm-4 control-label text-left">Database
                                                    Server</label>
                                                <div class="col-sm-8 input-group">
                                                    <input type="text" class="form-control" id="nserver"
                                                           value="" placeholder="Database Server" required>
                                                    <input type="text" class="form-control hide" id="p1" name="p1" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="userver" class="col-sm-4 control-label text-left">User
                                                    Name</label>
                                                <div class="col-sm-8 input-group">
                                                    <input type="text" class="form-control" value=""
                                                           id="userver" placeholder="User Name" required>
                                                    <input type="text" class="form-control hide" id="p2" name="p2" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="passserver" class="col-sm-4 control-label text-left">Password</label>
                                                <div class="col-sm-8 input-group">
                                                    <input type="password" class="form-control" id="passserver"
                                                           autocomplete="off"
                                                           readonly onfocus="this.removeAttribute('readonly');"
                                                           placeholder="Password">
                                                    <input type="text" class="form-control hide" id="p3" name="p3" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="passserver" class="col-sm-4 control-label text-left">Product</label>
                                                <div class="col-sm-8  input-group">
                                                    <select id="slProduct" name="slProduct" class="form-control">
                                                        <option value="0" {{$product=='0'?'selected':''}}>Finance & HR</option>
                                                        <option value="1" {{$product=='1'?'selected':''}}>Finance Only</option>
                                                        <option value="2" {{$product=='2'?'selected':''}}>HR Only</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group maindb">
                                                <label for="maindb" class="col-sm-4 control-label text-left">FN Database</label>
                                                <div class="col-sm-8 input-group" id="maindb">
                                                    <input type="text" class="form-control" value=""
                                                           id="txtMaindb" placeholder="FN Database" required>
                                                    <input type="text" class="form-control hide" id="p4" name="p4" value="">
                                                    <span class="input-group-btn">
                                            <button type="button" class="btn btn-info" onclick="VerifyConn(0);"
                                                    title="Verify">
                                              <span class="fa fa-refresh" aria-hidden="true"></span>
                                            </button>
                                            <button type="button" class="btn btn-info smallbtn hide" id="btnReMaindb">
                                                <span class="fa fa-check" aria-hidden="true"></span>
                                            </button>
                                        </span>
                                                </div>
                                            </div>
                                            <div class="form-group subdb">
                                                <label for="subdb" class="col-sm-4 control-label text-left">HR Database</label>
                                                <div class="col-sm-8 input-group" id="subdb">
                                                    <input type="text" class="form-control" value="" id="txtSubDB" placeholder="HR Database">
                                                    <input type="text" class="form-control hide" id="p5" name="p5" value="">
                                                    <span class="input-group-btn">
                                            <button type="button" class="btn btn-info" onclick="VerifyConn(1);"
                                                    title="Verify">
                                              <span class="fa fa-refresh" aria-hidden="true"></span>
                                            </button>
                                            <button type="button" class="btn btn-info smallbtn hide" id="btnReSubdb">
                                                <span class="fa fa-check" aria-hidden="true"></span>
                                            </button>
                                        </span>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                        <div class="box-footer">
                                            <div class="row">
                                                <button type="button" id="btnSave" class="btn btn-primary smallbtn pull-right">
                                                    Submit
                                                </button>
                                                <button type="submit" id="btnSubmit" class="btn btn-primary smallbtn pull-right hide">
                                                    Submit
                                                </button>

                                            </div>
                                        </div><!-- /.box-footer -->
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
        $(document).ready(function () {
            /*$("#frmW00F7130").submit(function(e){
                e.preventDefault(e);
            });*/
            setTimeout(function(){
                $("#passserver").prop("readonly", false);

            },300);

            $(".container").css("marginTop", ($(document).height() - $(".container").height()) / 2 - 20);

            $("#nserver").val(decryptData('{{$server}}'));
            $("#userver").val(decryptData('{{$userver}}'));
            $("#txtMaindb").val(decryptData('{{$db}}'));
            $("#txtSubDB").val(decryptData('{{$subdb}}'));


            $('#maindb').on('input', function (e) {
                $("#btnReMaindb").addClass("hide");
            });

            $('#subdb').on('input', function (e) {
                $("#btnReSubdb").addClass("hide");
            });

            $("#btnSave").click(function(){
                $("#p1").val(encryptData($("#nserver").val()));
                $("#p2").val(encryptData($("#userver").val()));
                $("#p3").val(encryptData($("#passserver").val()));
                $("#p4").val(encryptData($("#txtMaindb").val()));
                $("#p5").val(encryptData($("#txtSubDB").val()));
                $("#btnSubmit").click();
            });

            $('#slProduct').on('change',function () {
                var pro = $(this).val();
                if(pro==0){
                    $('.maindb').removeClass('hide');
                    $('.subdb').removeClass('hide');
                    $('#txtMaindb').attr('required', true);
                    $('#txtSubDB').removeAttr('required');
                }else if(pro==1){
                    $('.maindb').removeClass('hide');
                    $('.subdb').addClass('hide');
                    $('#txtSubDB').val("");
                    $('#txtMaindb').attr('required', true);
                    $('#txtSubDB').removeAttr('required');
                }else{
                    $('.maindb').addClass('hide');
                    $('.subdb').removeClass('hide');
                    $('#txtMaindb').removeAttr('required');
                    $('#txtSubDB').attr('required', true);
                    $('#txtMaindb').val("");
                }
            });
            $('#slProduct').trigger('change');
        });
        $(window).resize(function () {
            $(".container").css("marginTop", ($(document).height() - $(".container").height()) / 2) - 20;
        });

        $('input').keydown(function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                e.stopPropagation();
                $("#btnSave").trigger('click');
            }
        })

        function VerifyConn(mode) {
            $("#p1").val(encryptData($("#nserver").val()));
            $("#p2").val(encryptData($("#userver").val()));
            $("#p3").val(encryptData($("#passserver").val()));
            $("#p4").val(encryptData($("#txtMaindb").val()));
            $("#p5").val(encryptData($("#txtSubDB").val()));
            $.ajax({
                method: "POST",
                url: "{{Request::url()}}",
                data: $("#frmW00F7130").serialize() + '&mode=' + mode,
                success: function (data) {
                    if (data == 0) {
                        if (mode == 0) {
                            $("#maindb").addClass("has-error");
                            $("#maindb").removeClass("has-success");
                            $("#btnReMaindb").removeClass("hide");
                            $("#btnReMaindb").removeClass("btn-info");
                            $("#btnReMaindb").addClass("btn-danger");
                            $("#btnReMaindb>span").removeClass("fa-check");
                            $("#btnReMaindb>span").addClass("fa-times");
                        }
                        else {
                            $("#subdb").addClass("has-error");
                            $("#subdb").removeClass("has-success");
                            $("#btnReSubdb").removeClass("hide");
                            $("#btnReSubdb").removeClass("btn-info");
                            $("#btnReSubdb").addClass("btn-danger");
                            $("#btnReSubdb>span").removeClass("fa-check");
                            $("#btnReSubdb>span").addClass("fa-times");
                        }
                    }
                    else {
                        if (mode == 0) {
                            $("#btnReMaindb").removeClass("hide");
                            $("#maindb").removeClass("has-error");
                            $("#maindb").addClass("has-success");
                            $("#btnReMaindb").addClass("btn-info");
                            $("#btnReMaindb").removeClass("btn-danger");
                            $("#btnReMaindb>span").addClass("fa-check");
                            $("#btnReMaindb>span").removeClass("fa-times");
                        }
                        else {
                            $("#btnReSubdb").removeClass("hide");
                            $("#subdb").removeClass("has-error");
                            $("#subdb").addClass("has-success");
                            $("#btnReSubdb").addClass("btn-info");
                            $("#btnReSubdb").removeClass("btn-danger");
                            $("#btnReSubdb>span").addClass("fa-check");
                            $("#btnReSubdb>span").removeClass("fa-times");
                        }
                    }

                }
            });
        }
    </script>
@stop




