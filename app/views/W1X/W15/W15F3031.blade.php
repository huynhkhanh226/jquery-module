<div class="modal fade" id="modalW15F3031" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading(Helpers::getRS($g,"Chi_tiet_phep"),"W15F3031",true,"modalW15F3031")}}
            </div>
            @if (count($dsMaster) > 0)
                @define $EmployeeName = $dsMaster[0]['EmployeeName'];
                @define $DepartmentName = $dsMaster[0]['DepartmentName'];
                @define $DutyName = $dsMaster[0]['DutyName'];
                @define $EmployeePicture = $dsMaster[0]['EmployeePicture'];
                @define $LeaveObjectID = $dsMaster[0]['LeaveObjectID'];
                @define $LeaveApplyDate = $dsMaster[0]['LeaveApplyDate'];
                @define $EffectiveDate = $dsMaster[0]['EffectiveDate'];
                @define $LeaveQuan = $dsMaster[0]['LeaveQuan'];
                @define $UsedQuan = $dsMaster[0]['UsedQuan'];
                @define $RemainQuan = $dsMaster[0]['RemainQuan'];
            @else
                @define $EmployeeName = "";
                @define $DepartmentName = "";
                @define $DutyName = "";
                @define $EmployeePicture = "";
                @define $LeaveObjectID = "";
                @define $LeaveApplyDate = "";
                @define $EffectiveDate = "";
                @define $LeaveQuan = "";
                @define $UsedQuan = "";
                @define $RemainQuan = "";
            @endif
            <div class="modal-body" style="padding:10px 10px 10px 10px">
                <form class="form-horizontal" id="frmW15F3031">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <fieldset>
                                <legend class="legend">{{Helpers::getRS($g,"Thong_tin_chung")}}</legend>
                                <div class="row">
                                    <div class="col-md-1 col-xs-1">
                                        @if ($EmployeePicture !="")
                                            <img src="{{"data:image/jpeg;base64,". base64_encode(pack('H'.strlen($EmployeePicture), $EmployeePicture))}}"
                                                 class="user-image" alt="Employee Picture"  style="height: 90px;width: 80px"/>
                                        @else
                                            <img src="{{asset('packages/default/L3/images/icon-user-default.png')}}" class="user-image imgborder"  style="height: 90px;width: 80px"/>
                                        @endif

                                    </div>
                                    <div class="col-md-11 col-xs-11">
                                        <div class="row">
                                            <div class="col-md-3 col-xs-3">
                                                <label>{{$EmployeeName}}</label>
                                            </div>
                                            <div class="col-md-2 col-xs-2">
                                                <label class="lbl-normal">{{Helpers::getRS($g,"Doi_tuong_tinh_cong_phep")}}</label>
                                            </div>
                                            <div class="col-md-1 col-xs-1">
                                                <label>{{$LeaveObjectID}}</label>
                                            </div>
                                            <div class="col-md-2 col-xs-2">
                                                <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_bat_dau_tinh_phep")}}</label>
                                            </div>
                                            <div class="col-md-1 col-xs-1">
                                                <label>{{$LeaveApplyDate}}</label>
                                            </div>
                                            <div class="col-md-2 col-xs-2">
                                                <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_hieu_luc_phep")}}</label>
                                            </div>
                                            <div class="col-md-1 col-xs-1">
                                                <label>{{$EffectiveDate}}</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-xs-3">
                                                <label>{{$DepartmentName}}</label>
                                            </div>
                                            <div class="col-md-2 col-xs-2">
                                                <label class="lbl-normal">{{Helpers::getRS($g,"So_luong_phep_co")}}</label>
                                            </div>
                                            <div class="col-md-1 col-xs-1">
                                                <label>{{number_format($LeaveQuan,$dsFormat[0]['LeaveQtyDecimals'])}}</label>
                                            </div>
                                            <div class="col-md-2 col-xs-2">
                                                <label class="lbl-normal">{{Helpers::getRS($g,"So_luong_phep_da_nghi")}}</label>
                                            </div>
                                            <div class="col-md-1 col-xs-1">
                                                <label>{{number_format($UsedQuan,$dsFormat[0]['LeaveQtyDecimals'])}}</label>
                                            </div>
                                            <div class="col-md-2 col-xs-2">
                                                <label class="lbl-normal">{{Helpers::getRS($g,"So_luong_phep_con_lai")}}</label>
                                            </div>
                                            <div class="col-md-1 col-xs-1">
                                                <label>{{number_format($RemainQuan,$dsFormat[0]['LeaveQtyDecimals'])}}</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5 col-xs-5">
                                                <label>{{$DutyName}}</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-12 col-xs-12" id = "divGrid" style="width: 100%">
                            <fieldset>
                                <legend class="legend">{{Helpers::getRS($g,"Chi_tiet_cham_phep")}}</legend>
                                <div id = "gridW15F3031" style="width: 100%;">
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    var modalW15F3031 = function () {
        $("#modalW15F3031").modal('hide');
    };

/*    function reload_table() {
        //$(".l3loading").removeClass('hide');
        var id = $("#AlbumID").val();
        if (id != '') {
            $.ajax({
                method: 'POST',
                url: "W15F3031/W15F3031/4/imagelist/" + id,
                success: function (data) {
                    //$(".l3loading").addClass('hide');
                    $(".mCSB_container").html(data);
                }
            });
        }

    }*/

    $(document).ready(function () {
        $('#modalW15F3031').find(".modal-content").draggable({
            handle: ".modal-header",
            //containment: "window"
        });
        LoadDataW15F3031();
    });
    function LoadDataW15F3031(){
        $.ajax({
            method: "POST",
            url: '{{url("/W15F3031/view/$pForm/$g/loadtdbg/$employeeid")}}',
            success: function (data) {
                $("#gridW15F3031").html(data);
            }
        });
    }
</script>


