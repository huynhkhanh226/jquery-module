<div class="modal fade pd0" id="modalW76F4050" data-backdrop="static" role="dialog" style="position: absolute">
    <div id="test" class="modal-dialog modal-lg" style="width: 99%;margin: 1vh 0.5%">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($caption,"W76F4050")}}
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="frmW76F4050" name="frmW76F4050" method="post">
                    <div class="row pdt10" style="margin-left: 2px !important;">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="col-md-4 pdl0 mgl0">
                                    <label class="lbl-normal liketext">{{Helpers::getRS($g,"Ngay_to_chuc")}}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group date">
                                        <input type="text" class="form-control" id="txtRequestedDate" name="txtRequestedDate" value="{{date("d/m/Y")}}" required>
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="lbl-normal liketext">{{Helpers::getRS($g,"So_cho_ngoi")}}</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="txtCapacity" name="txtCapacity" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label class="lbl-normal liketext">{{Helpers::getRS($g,"Dia_diem")}}</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" id="txtLocation" name="txtLocation" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" onclick="showmodalW76F4050_Device();" class="btn btn-default smallbtn"><span
                                        class="fa fa-check-circle-o"></span> {{Helpers::getRS($g,"Thiet_bi_yeu_cau")}}</button>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-default smallbtn pull-right" id="btnFilterW76F4050"><span class="fa fa-search"></span>
                                &nbsp;{{Helpers::getRS($g,"Tim_kiem")}}</button>
                        </div>
                    </div>
                    <div class="modal draggable fade" id="modalW76F4050_Device" data-backdrop="static" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    {{Helpers::generateHeading(Helpers::getRS($g,"Thiet_bi_yeu_cau"), "",false,"closemodalW76F4050_Device")}}
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="checkbox service-facility">
                                                        <input type="checkbox" name="chkIsBlackboard" class="hide">
                                                        <label><span class="digi digi-blackboard mgr5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span
                                                                        class="path4"></span><span class="path5"></span></span> {{Helpers::getRS($g,"Bang_ghi")}}</label>
                                                        <span class="fa fa-check mgl5 hide"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="checkbox service-facility">
                                                        <input type="checkbox" name="chkIsProjector" class="hide">
                                                        <label><span class="digi digi-projector mgr5"></span> {{Helpers::getRS($g,"May_chieu")}}</label>
                                                        <span class="fa fa-check mgl5 hide"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="checkbox service-facility">
                                                        <input type="checkbox" class="hide" name="chkIsEthernet">
                                                        <label><span class="digi digi-ethernet mgr5"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
                                                            Ethernet</label>
                                                        <span class="fa fa-check mgl5 hide"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="checkbox service-facility">
                                                        <input type="checkbox" class="hide" name="chkIsMicrophone">
                                                        <label><span class="fa fa-microphone mgr5"></span> Microphone</label>
                                                        <span class="fa fa-check mgl5 hide"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="checkbox service-facility">
                                                        <input type="checkbox" class="hide" name="chkIsPC">
                                                        <label><span class="digi digi-PC mgr5"></span> PC</label>
                                                        <span class="fa fa-check mgl5 hide"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="checkbox service-facility">
                                                        <input type="checkbox" class="hide" name="chkIsTeleCon">
                                                        <label><span class="digi digi-Tele-Conference mgr5"></span> Tele-Conference</label>
                                                        <span class="fa fa-check mgl5 hide"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="checkbox service-facility">
                                                        <input type="checkbox" class="hide" name="chkIsVideoCon">
                                                        <label><span class="digi digi-video_conference mgr5"></span> Video-Conference</label>
                                                        <span class="fa fa-check mgl5 hide"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="checkbox service-facility">
                                                        <input type="checkbox" class="hide" name="chkIsWifi">
                                                        <label><span class="fa fa-wifi mgr5"></span> Wifi</label>
                                                        <span class="fa fa-check mgl5 hide"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="button" class="btn btn-default smallbtn pull-right" onclick="closemodalW76F4050_Device();">
                                            <span class="fa fa-check mgr5"></span> {{Helpers::getRS($g,"Chon")}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </form>
                <div class="row mgt10">
                    <div class="col-md-12" id="divW76F4050">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<section id="secAddBookingW76F4050">
    @include('W7X.W76.W76F4050_Booking')
</section>
<script type="text/javascript">
    $('#divW76F4050').height(documentHeight - 130);
    var calEventObjW76F4050;
    $(document).ready(function () {
        $('.input-group.date').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: 'vi'
        });
    });


    $("#frmW76F4050").on('submit', function (e) {
        e.preventDefault();
        $('.l3loading').removeClass('hide');
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: $("#frmW76F4050").serialize(),
            success: function (data) {
                $('#divW76F4050').html(data);
            }
        });
    });


    $("#frmW76F4050").on('click', '.service-facility', function () {
        var check = $(this).find("input[type=checkbox]").prop("checked");
        $(this).find("input[type=checkbox]").prop('checked', !check);
        if (check == true)
            $(this).find(".fa-check").addClass("hide");
        else
            $(this).find(".fa-check").removeClass("hide");
    });


    function editBookingW76F4050(id, room, timefrom, timeto, mode, date) {
        $.ajax({
            method: "POST",
            url: "{{"W76F4050/add"}}",
            data: {bookid: id, room: room, timefrom: timefrom, timeto: timeto, mode: mode, date:date},
            success: function (data) {
                var result = $.parseJSON(data);
                if (result.Status == 0) {
                    if (mode == 2){
                        calEventObjW76F4050.Tooltip = result.Tooltip;
                        $('#calendarW76F4050').fullCalendar('updateEvent', calEventObjW76F4050);
                    }
                }
            }
        });
    }


    function showmodalW76F4050_Device() {
        $("#modalW76F4050_Device").modal("show");
    }

    function closemodalW76F4050_Device() {
        $("#modalW76F4050_Device").modal("hide");
    }
</script>


