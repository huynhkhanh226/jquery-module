<div class="modal draggable fade modal" id="modalW00F0253" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- form start -->
            <form class="form-horizontal" id="frmW00F0253" method="post" action="">
                <div class="modal-header">
                    {{Helpers::generateHeading(Helpers::getRS($g,"Doi_mat_khauU"),"W00F0253",true,'closeW00F0253')}}
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- column -->
                        <div class="col-md-12">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="oldpassword"
                                           class="col-sm-3 control-label text-left">{{Helpers::getRS($g,'Mat_khau_cu')}}</label>
                                    <div class="col-sm-9">
                                        <div class = "row">
                                            <div class="col-sm-11">
                                                <input type="password" class="form-control" id="oldpassword" name="oldpassword"
                                                       value="" placeholder="{{Helpers::getRS($g,"Mat_khau_cu")}}" required>
                                            </div>
                                            <div class="col-sm-1">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password"
                                           class="col-sm-3 control-label text-left">{{Helpers::getRS($g,'Mat_khau_moi')}}</label>

                                    <div class="col-sm-9">
                                        <div class = "row">
                                            <div class="col-sm-11">
                                                <input type="password" class="form-control" id="password" value=""
                                                       name="password"
                                                       placeholder="{{Helpers::getRS($g,"Mat_khau_moi")}}" required>
                                            </div>
                                            <div class="col-sm-1">
                                                <div id = "validPassWord">
                                                    <i id = "questionPW" class="glyphicon glyphicon-circle-question-mark pull-right text-blue" style="font-size: 160%; margin-top: 1px"></i>
                                                    <i id = "validPW" class="fa fa-check pull-right text-green hide" style="font-size: 160%; margin-top: 1px"></i>
                                                    <i id = "invalidPW" class="fa fa-remove pull-right text-red hide" style="font-size: 160%; margin-top: 1px"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="repassword"
                                           class="col-sm-3 control-label text-left">{{Helpers::getRS($g,'Nhap_lai_mat_khau')}}</label>

                                    <div class="col-sm-9">
                                        <div class = "row">
                                            <div class="col-sm-11">
                                                <input type="password" class="form-control" id="repassword" value=""
                                                       name="repassword"
                                                       placeholder="{{Helpers::getRS($g,"Nhap_lai_mat_khau")}}" required>
                                            </div>
                                            <div class="col-sm-1">
                                                <div id = "validRePassWord">
                                                    <i id = "questionRePW" class="glyphicon glyphicon-circle-question-mark pull-right text-blue" style="font-size: 160%; margin-top: 1px"></i>
                                                    <i id = "validRePW" class="fa fa-check pull-right text-green hide" style="font-size: 160%; margin-top: 1px"></i>
                                                    <i id = "invalidRePW" class="fa fa-remove pull-right text-red hide" style="font-size: 160%; margin-top: 1px"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="button" id="frm_btnCancel"
                                        class="btn btn-default smallbtn pull-right"><span
                                            class="glyphicon glyphicon-floppy-remove mgr5 text-red"></span> {{Helpers::getRS($g,"Khong_luu")}}
                                </button>
                                <button id="frm_btnSave"
                                        class="btn btn-default smallbtn pull-right mgr10" disabled><span
                                            class="glyphicon glyphicon-floppy-saved mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                                </button>
                            </div>

                        </div>
                        <!--/.col -->
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="alert alert-success alert-dismissable hide">
                        <i class="icon fa fa-check"></i> {{Helpers::getRS($g,"Du_lieu_da_luu_thanh_cong")}}
                    </div>
                    <div class="alert alert-danger alert-dismissable hide">
                        <i class="icon fa fa-ban"></i> <span id="err">{{Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu")}}
                            !</span>
                    </div>

                </div>
            </form>   <!-- /.end form  -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div id="pswd_info">
    <p style="font-size: 80%;">
        <strong>{{Helpers::getRS($g,"Mat_khau_phai_chua")}}:</strong>
    </p>
    <p style="font-size: 75%;" id="lowercasePW" class="text-red">
        <i style="margin-top: 3px; margin-right: 10px" id = "invalidPW1" class="fa fa-remove pull-left"></i>
        <i style="margin-top: 3px; margin-right: 10px" id = "validPW1" class="fa fa-check pull-left text-green hide"></i>
        {{Helpers::getRS($g,"It_nhat_mot_chu_cai_thuong")}}
    </p>
    <p style="font-size: 75%;" id="uppercasePW" class="text-red">
        <i style="margin-top: 3px; margin-right: 10px" id = "invalidPW2" class="fa fa-remove pull-left"></i>
        <i style="margin-top: 3px; margin-right: 10px" id = "validPW2" class="fa fa-check pull-left text-green hide"></i>
        {{Helpers::getRS($g,"It_nhat_mot_chu_cai_in_hoa")}}
    </p>
    <p style="font-size: 75%;" id="numberPW" class="text-red">
        <i style="margin-top: 3px; margin-right: 10px" id = "invalidPW3" class="fa fa-remove pull-left"></i>
        <i style="margin-top: 3px; margin-right: 10px" id = "validPW3" class="fa fa-check pull-left text-green hide"></i>
        {{Helpers::getRS($g,"It_nhat_mot_chu_so")}}
    </p>
    <p style="font-size: 75%;" id="specialPW" class="text-red">
        <i style="margin-top: 3px; margin-right: 10px" id = "invalidPW5" class="fa fa-remove pull-left"></i>
        <i style="margin-top: 3px; margin-right: 10px" id = "validPW5" class="fa fa-check pull-left text-green hide"></i>
        {{Helpers::getRS($g,"It_nhat_mot_ky_tu_dac_biet")}}
    </p>
    <p style="font-size: 75%;" id="lengthPW" class="text-red">
        <i style="margin-top: 3px; margin-right: 10px" id = "invalidPW4" class="fa fa-remove pull-left"></i>
        <i style="margin-top: 3px; margin-right: 10px" id = "validPW4" class="fa fa-check pull-left text-green hide"></i>
        {{Helpers::getRS($g,"Toi_thieu_8_ky_tu")}}
    </p>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        //$('.popover').css('width',parseInt(1200));
        $('#password').popover({
            placement: "right",
            trigger: "onclick",
            html: true,
            //width: 1500,
            content: function() {
                return $('#pswd_info').html();
            }
        });

        $("#modalW00F0253").on('submit', '#frmW00F0253', function (e) {
            e.preventDefault();
            $("#frmW00F0253").find(".alert-success").addClass('hide');
            $("#frmW00F0253").find(".alert-danger").addClass('hide');
            $.ajax({
                method: "POST",
                url: "{{url("checkoldpass")}}",
                data: {oldpassword: $("#oldpassword").val(), user: '{{$id}}'},
                success: function (data) {
                    if (data == 0) {
                        $("#frmW00F0253").find("#err").html('{{Helpers::getRS($g,"Mat_khau_cu_khong_dung")}}');
                        $("#frmW00F0253").find(".alert-danger").removeClass('hide');
                        return;
                    } else {
                        $.ajax({
                            method: "POST",
                            url: "{{Request::url()}}",
                            data: $("#frmW00F0253").serialize(),
                            success: function (data) {
                                $("#frmW00F0253").find(".alert-success").removeClass('hide');
                            }
                        });
                    }
                }
            });

        });
    });

    function closeW00F0253() {
        $('#modalW00F0253').modal('hide');
        //console.log("Hello");
    }

    $('#password').focusin(function () {
        checkValidPassW00F2053();
    });

    $('#password').focusout(function () {
        var regularExpression = /(?=.*[!@#$%^&*<>_+|.'";,{}*?()],{0,8})/; // có ký tự đặc biệt
        var numberExpression = /[0-9]/g; // có ký tự kiểu số
        var capExpression = /[A-Z]/g; // có ký tự in hoa
        var normalExpression = /[a-z]/g; // có ký tự chữ thường
        var passW = $("#frmW00F0253").find("#password");
        if(regularExpression.test(passW.val()) == true
            && numberExpression.test(passW.val()) == true
            && capExpression.test(passW.val()) == true
            && normalExpression.test(passW.val())  == true
            && passW.val().length > 7){
            $("#frmW00F0253").find("#validPW").removeClass('hide');
            $("#frmW00F0253").find("#invalidPW").addClass('hide');
            $("#frmW00F0253").find("#questionPW").addClass('hide');
        }else{
            $("#frmW00F0253").find("#validPW").addClass('hide');
            $("#frmW00F0253").find("#questionPW").addClass('hide');
            $("#frmW00F0253").find("#invalidPW").removeClass('hide');
        }
    });

    $('#password').keyup(function () {
        checkValidPassW00F2053();
        checkPassWordMatchW00F2053();
        formValidW00F2053();
        //console.log(regularExpression.test(passW.val()), numberExpression.test(passW.val()), capExpression.test(passW.val()), normalExpression.test(passW.val()), passW.val().length);
    });
    
    $('#repassword').keyup(function () {
        checkPassWordMatchW00F2053();
        formValidW00F2053();
    });

    //Hàm kiểm tra pass cũ có giống pass mới
    function checkPassWordMatchW00F2053(){
        var passW = $("#frmW00F0253").find("#password");
        var rePassW = $("#frmW00F0253").find("#repassword");
        //console.log(rePassW.val(),passW.val());
        if(rePassW.val() == passW.val()){
            $("#frmW00F0253").find("#validRePW").removeClass('hide');
            $("#frmW00F0253").find("#invalidRePW").addClass('hide');
            $("#frmW00F0253").find("#questionRePW").addClass('hide');
        }else{
            $("#frmW00F0253").find("#validRePW").addClass('hide');
            $("#frmW00F0253").find("#questionRePW").addClass('hide');
            $("#frmW00F0253").find("#invalidRePW").removeClass('hide');
        }
    }

    //Hàm kiểm tra cú pháp của password
    function checkValidPassW00F2053() {
        var regularExpression = /(?=.*[!@#$%^&*<>_+|.'";,{}*?()],{0,8})/; // có ký tự đặc biệt
        var numberExpression = /[0-9]/g; // có ký tự kiểu số
        var capExpression = /[A-Z]/g; // có ký tự in hoa
        var normalExpression = /[a-z]/g; // có ký tự chữ thường
        var passW = $("#frmW00F0253").find("#password");

        if (regularExpression.test(passW.val()) == true) {
            $('#specialPW').addClass('text-green');
            $('#invalidPW5').addClass('hide');
            $('#validPW5').removeClass('hide');
        } else {
            $('#specialPW').removeClass('text-green');
            $('#validPW5').addClass('hide');
            $('#invalidPW5').removeClass('hide');
        }

        if (numberExpression.test(passW.val()) == true) {
            $('#numberPW').addClass('text-green');
            $('#invalidPW3').addClass('hide');
            $('#validPW3').removeClass('hide');
        } else {
            $('#numberPW').removeClass('text-green');
            $('#validPW3').addClass('hide');
            $('#invalidPW3').removeClass('hide');
        }

        if (capExpression.test(passW.val()) == true) {
            $('#uppercasePW').addClass('text-green');
            $('#invalidPW2').addClass('hide');
            $('#validPW2').removeClass('hide');
        } else {
            $('#uppercasePW').removeClass('text-green');
            $('#validPW2').addClass('hide');
            $('#invalidPW2').removeClass('hide');
        }

        if (normalExpression.test(passW.val()) == true) {
            $('#lowercasePW').addClass('text-green');
            $('#invalidPW1').addClass('hide');
            $('#validPW1').removeClass('hide');
        } else {
            $('#lowercasePW').removeClass('text-green');
            $('#validPW1').addClass('hide');
            $('#invalidPW1').removeClass('hide');
        }


        if (passW.val().length > 7) {
            $('#lengthPW').addClass('text-green');
            $('#invalidPW4').addClass('hide');
            $('#validPW4').removeClass('hide');
        } else {
            $('#lengthPW').removeClass('text-green');
            $('#validPW4').addClass('hide');
            $('#invalidPW4').removeClass('hide');
        }
    }
    
    //Hàm kiểm tra valid của form
    function formValidW00F2053() {
        var invalidRePW = $('#invalidRePW').hasClass('hide');
        var invalidPW = $('#invalidPW').hasClass('hide');
        console.log(invalidRePW, invalidPW);
        if(invalidRePW == true && invalidPW == true){
            $("#frmW00F0253").find("#frm_btnSave").prop('disabled', false);
        }else{
            $("#frmW00F0253").find("#frm_btnSave").prop('disabled', true);
        }
    }
</script>