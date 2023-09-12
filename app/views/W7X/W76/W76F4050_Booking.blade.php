<div class="modal fade draggable" id="modalW76F4050Booking" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading("Booking Request","W76F4050Booking",false,"closemodalW76F4050Booking")}}
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="frmW76F4050Booking">
                    <input type="hidden" id="hdMode" name="mode">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 lbl-normal">{{Helpers::getRS($g,"Ngay_yeu_cau")}}</label>
                            <div class="col-sm-3">
                                <div class="input-group date data_custom-picker">
                                    <input type="text" class="form-control" id="txtRequestedDate" name="txtRequestedDate" value=""
                                           required>
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 lbl-normal">{{Helpers::getRS($g,"Thoi_gian")}}</label>
                            <div class="col-sm-3">
                                <input type="text" id="txtTimeFrom" name="txtTimeFrom" class="form-control timepickerW76F4050" required/>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" id="txtTimeTo" name="txtTimeTo" class="form-control timepickerW76F4050" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 lbl-normal">{{Helpers::getRS(4,"Phong_hopU")}}</label>
                            <div class="col-sm-6">
                                <select id="slFacilityNo" name="slFacilityNo" class="form-control" required>
                                    @foreach($rsRoom as $row)
                                        <option value="{{$row["FacilityID"]}}">{{$row["FacilityNo"]." - ".$row["FacilityName"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 lbl-normal">{{Helpers::getRS($g,"Nguoi_yeu_cau")}}</label>
                            <div class="col-sm-6">
                                <input type="text" id="txtUserID" name="txtUserID" class="form-control" value="{{$userid}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 lbl-normal">{{Helpers::getRS(4,"Trang_thai")}}</label>

                            <div class="col-sm-6">
                                <select id="slStatusID" name="slStatusID" class="form-control" required disabled>
                                    @foreach($rsStatus as $row)
                                        <option value="{{$row["StatusID"]}}">{{$row["StatusName"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 lbl-normal">{{Helpers::getRS($g,"Ghi_chu")}}</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="txtDescription" name="txtDescription" required
                                          style="height: 75px"></textarea>
                            </div>
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

                        <button type="button" id="frm_btnDelete"
                                class="btn btn-default smallbtn pull-right">
                            <span class="glyphicon glyphicon-remove mgr5"></span> {{Helpers::getRS($g,"Huy")}}
                        </button>
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
    $(document).ready(function () {
        $('.data_custom-picker').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: 'vi'
        });
        //Remove all event of timepicker
        $(".timepickerW76F4050").off();

        $('input.timepickerW76F4050').inputmask({
            alias: "datetime",
            mask: "h:s",
            placeholder: "__:__"
        });
        //Kiểm tra giá trị hợp lệ theo thiết lập hệ thống
        $(".timepickerW76F4050").change(function () {
                var valTime = $(this).val().replace(/_/g, "0");
                if (valTime != '') {
                    var time = parseInt(valTime.substr(0, 2)) + (parseInt(valTime.substr(3, 2)) / 60);
                    var startTime = '{{$BookingTimeFrom}}';
                    var endTime = '{{$BookingTimeTo}}';
                    if (time < startTime){
                        $(this).val(parseInt(startTime) + ':' + ((startTime - parseInt(startTime)) * 60));
                    }
                    else if (time > endTime){
                        $(this).val(parseInt(endTime) + ':' + ((endTime - parseInt(endTime)) * 60));
                    }
                }
            }
        );
    });

    function closemodalW76F4050Booking() {
        $("#modalW76F4050Booking").modal("hide");
    }

    $("#frmW76F4050Booking").on('click', '#frm_btnCancel', function () {
        $('#frmW76F4050Booking')[0].reset();
        $("#modalW76F4050Booking").find(".alert-success").addClass('hide');
        $("#modalW76F4050Booking").find(".alert-danger").addClass('hide');
    });

    $("#frmW76F4050Booking").on('click', '#frm_btnSave', function () {
        frmW76F4050BookingSave();
    });

    function frmW76F4050BookingSave() {
        if (!$('#frmW76F4050Booking')[0].checkValidity()) {
            $("#frmW76F4050Booking").find("#hfrm_btnSave").click();
            return false;
        }
        var timefrom = timeStringToFloat($("#frmW76F4050Booking").find("#txtTimeFrom").val());
        var timeto = timeStringToFloat($("#frmW76F4050Booking").find("#txtTimeTo").val());
        if (timefrom >= timeto) {
            $("#modalW76F4050Booking").find(".alert-danger").html('{{Helpers::getRS($g,'Thoi_gian_bat_dau_khong_duoc_lon_hon_Thoi_gian_ket_thuc')}}');
            $("#modalW76F4050Booking").find(".alert-danger").removeClass('hide');
            $("#modalW76F4050Booking").find(".alert-success").addClass('hide');
            $("#frmW76F4050Booking").find("#txtTimeFrom").focus();
            return false;
        }
        $("#frmW76F4050Booking").find("#hfrm_btnSave").click();
    }

    $("#modalW76F4050Booking").on('submit', '#frmW76F4050Booking', function (e) {
        e.preventDefault();
        $("#frm_btnSave").attr("disabled", "disabled");
        $("#frm_btnCancel").attr("disabled", "disabled");
        $.ajax({
            method: "POST",
            url: "{{url('W76F4050/add')}}",
            data: $("#frmW76F4050Booking").serialize(),
            success: function (data) {
                var result = $.parseJSON(data);
                if (result.code == 0) {
                    if (viewmodeW76F4050 == "agendaDay" || result.resourceId == $('#slFacilityIDW76F4050').val())
                        $('#calendarW76F4050').fullCalendar('renderEvent', result, true);
                    $("#modalW76F4050Booking").find(".alert-danger").addClass('hide');
                    $("#modalW76F4050Booking").find(".alert-success").removeClass('hide');
                    $('#modalW76F4050Booking').modal('hide');

                } else if (result.code == 1) {
                    $("#modalW76F4050Booking").find(".alert-danger").html('{{Helpers::getRS($g,'Du_lieu_da_bi_trung_ban_khong_the_luu')}}');
                    $("#modalW76F4050Booking").find(".alert-danger").removeClass('hide');
                    $("#modalW76F4050Booking").find(".alert-success").addClass('hide');
                    $("#frm_btnSave").removeAttr("disabled");
                    $("#frm_btnCancel").removeAttr("disabled");
                }
                else {
                    W
                    $("#modalW76F4050Booking").find(".alert-danger").html('{{Helpers::getRS($g,'Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu')}}');
                    $("#modalW76F4050Booking").find(".alert-danger").removeClass('hide');
                    $("#modalW76F4050Booking").find(".alert-success").addClass('hide');
                    $("#frm_btnSave").removeAttr("disabled");
                    $("#frm_btnCancel").removeAttr("disabled");
                }
            }
        });
    });

    $("#frmW76F4050Booking").on('click', '#frm_btnDelete', function () {
        ask_delete(function () {
            $.ajax({
                method: "POST",
                url: "{{Request::url()}}",
                data: {mode: 1, id: ""},
                success: function (data) {
                    if (data == 1) {
                        closemodalW76F4050Booking();
                    } else {
                        $("#modalW76F4050Booking").find(".alert-danger").html('{{Helpers::getRS($g,'Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu')}}');
                        $("#modalW76F4050Booking").find(".alert-danger").removeClass('hide');
                        $("#modalW76F4050Booking").find(".alert-success").addClass('hide');
                    }
                }
            });
        }, "", "{{Helpers::getRS($g,"Ban_co_muon_huy_khong")}}");
    });


</script>

