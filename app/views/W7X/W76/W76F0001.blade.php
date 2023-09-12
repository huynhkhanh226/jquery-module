<div class="modal fade draggable" id="modalW76F0001" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width:50%;">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($caption,"W76F0001",true,"",true,"D76F0001","W76F0001")}}
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="frmW76F0001">
                    <div class="box-body">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs" id="tabHW76F0001">
                                <li class="active"><a data-toggle="tab" href="#tabW76F0001_1">{{Helpers::getRS($g,"Booking_phong_hop")}}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tabW76F0001_1" class="tab-pane active">
                                    <div class="form-group">
                                        <label class="col-sm-5 lbl-normal liketext">{{Helpers::getRS($g,"Thoi_gian_cho_phep_book_phong")}}</label>
                                        <div class="col-sm-3">
                                            <div class="input-group bootstrap-timepicker liketext">
                                                <input type="text" id="txtTimeFrom" name="txtTimeFrom" class="form-control timepickerW76F0001" value="{{isset($rsData[0]["BookingTimeFrom"])?substr($rsData[0]["BookingTimeFrom"],0,5):"08:00"}}"
                                                       required/>
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="input-group bootstrap-timepicker liketext">
                                                <input type="text" id="txtTimeTo" name="txtTimeTo" class="form-control timepickerW76F0001" value="{{isset($rsData[0]["BookingTimeTo"])?substr($rsData[0]["BookingTimeTo"],0,5):"17:00"}}"
                                                       required/>
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-5 lbl-normal liketext">{{Helpers::getRS($g,"Ngay_bat_dau_mot_tuan")}}</label>
                                        <div class="col-sm-3">
                                            <div class="radio">
                                                <label>
                                                    <input name="optStartOfWeek" id="optStartOfWeek1" value="1" type="radio" {{(isset($rsData[0]["StartOfWeek"]) && $rsData[0]['StartOfWeek']==0?'':'checked')}}>
                                                    {{Helpers::getRS($g,"Thu_2")}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="radio">
                                                <label>
                                                    <input name="optStartOfWeek" id="optStartOfWeek0" value="0" type="radio" {{(isset($rsData[0]["StartOfWeek"]) && $rsData[0]['StartOfWeek']==0?'checked':'')}}>
                                                    {{Helpers::getRS($g,"Chu_nhat")}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="button" id="frm_btnCancel"
                                class="btn btn-default smallbtn pull-right">
                            <span class="glyphicon glyphicon-floppy-remove mgr5"></span> {{Helpers::getRS($g,"Khong_luu")}}
                        </button>
                        <button type="button" id="frm_btnSave"
                                class="btn btn-default smallbtn pull-right mgr10"><span
                                    class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                        </button>
                        <button type="submit" id="hfrm_btnSave" class="hide"></button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
            <div class="modal-footer">
                <div class="alert alert-success alert-dismissable hide">
                    <i class="icon fa fa-check"></i> {{Helpers::getRS($g,"Du_lieu_da_duoc_luu_thanh_cong")}}
                </div>
                <div class="alert alert-danger alert-dismissable hide">
                    <i class="icon fa fa-ban"></i> <span id="err">{{Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu")}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".timepickerW76F0001").timepicker({
        upArrowStyle: 'fa fa-chevron-up',
        downArrowStyle: 'fa fa-chevron-down',
        showMeridian: false,
        minuteStep: 30
    });

    $("#frmW76F0001").on('click', '#frm_btnSave', function () {
        frmW76F0001Save();
    });

    function frmW76F0001Save() {
        if (!$('#frmW76F0001')[0].checkValidity()) {
            $("#frmW76F0001").find("#hfrm_btnSave").click();
            return false;
        }
        var timefrom = timeStringToFloat($("#frmW76F0001").find("#txtTimeFrom").val());
        var timeto = timeStringToFloat($("#frmW76F0001").find("#txtTimeTo").val());
        if (timefrom >= timeto) {
            $("#modalW76F0001").find(".alert-danger").html('{{Helpers::getRS($g,'Thoi_gian_bat_dau_khong_duoc_lon_hon_Thoi_gian_ket_thuc')}}');
            $("#modalW76F0001").find(".alert-danger").removeClass('hide');
            $("#modalW76F0001").find(".alert-success").addClass('hide');
            $("#frmW76F0001").find("#txtTimeFrom").focus();
            return false;
        }
        $("#frmW76F0001").find("#hfrm_btnSave").click();
    }

    $("#modalW76F0001").on('submit', '#frmW76F0001', function (e) {
        e.preventDefault();
        $("#frm_btnSave").attr("disabled", "disabled");
        $("#frm_btnCancel").attr("disabled", "disabled");
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: $("#frmW76F0001").serialize(),
            success: function (data) {
                if (data == 1) {
                    $("#modalW76F0001").find(".alert-danger").addClass('hide');
                    $("#modalW76F0001").find(".alert-success").removeClass('hide');
                }
                else {
                    $("#modalW76F0001").find(".alert-danger").html('{{Helpers::getRS($g,'Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu')}}');
                    $("#modalW76F0001").find(".alert-danger").removeClass('hide');
                    $("#modalW76F0001").find(".alert-success").addClass('hide');
                    $("#frm_btnSave").removeAttr("disabled");
                    $("#frm_btnCancel").removeAttr("disabled");
                }
            }
        });
    });

    $("#frmW76F0001").on('click', '#frm_btnCancel', function () {
        $('#frmW76F0001')[0].reset();
        $("#modalW76F0001").find(".alert-success").addClass('hide');
        $("#modalW76F0001").find(".alert-danger").addClass('hide');
    });
</script>