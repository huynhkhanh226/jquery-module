<div class="modal draggable" id="modalW75F3030" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 80%">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading($modalTitle,"W75F3030")}}
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="row mgt5 detailW75F3030">
                        <div class="col-md-4 col-xs-4">
                            <fieldset>
                                <legend class="legend">{{Helpers::getRS($g,"Bao_hiem_xa_hoi")}}</legend>
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"So_so_BHXH")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <label>{{$rData["SocInsBookNo"]}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_cap")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <label>{{$rData["SocInsIssueDate"]}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Noi_cap")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <label>{{$rData["SocInsIssuePlace"]}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_bat_dau")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <label>{{$rData["SIBeginDate"]}}</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4 col-xs-4">
                            <fieldset>
                                <legend class="legend">{{Helpers::getRS($g,"Bao_hiem_y_te")}}</legend>
                                <div class="row">
                                    <div class="col-md-4 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"The_BHYT")}}</label>
                                    </div>
                                    <div class="col-md-8 col-xs-7">
                                        <label>{{$rData["HealthInsBookNo"]}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Hieu_luc_tu")}}</label>
                                    </div>
                                    <div class="col-md-8 col-xs-7">
                                        <label>{{$rData["HealthInsStart"]}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Hieu_luc_den")}}</label>
                                    </div>
                                    <div class="col-md-8 col-xs-7">
                                        <label>{{$rData["HealthInsEnd"]}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Benh_vien")}}</label>
                                    </div>
                                    <div class="col-md-8 col-xs-7">
                                        <label>{{$rData["HospitalName"]}}</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4 col-xs-4">
                            <fieldset>
                                <legend class="legend">{{Helpers::getRS($g,"Bao_hiem_that_nghiep")}}</legend>
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"
                                                       {{$rData['IsJoinedUIns']==1 ? 'checked="checked"' : ''}} disabled> {{Helpers::getRS($g,"Co_tham_gia")}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <label class="lbl-normal mgr10">{{Helpers::getRS($g,"Ngay_bat_dau")}}</label>
                                        <label>{{$rData["DateJoinedUIns"]}}</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row mgt5" style="padding-bottom:8px">
                        <fieldset class="col-md-12 col-xs-12">
                            <legend class="legend">{{Helpers::getRS($g,"Lich_su_tham_gia_bao_hiem")}}</legend>
                            <div id="pqgrid_W75F3030" style="margin:auto;" class="mgb5"></div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    $("#modalW75F3030").on('shown.bs.modal', function () {
        var obj = {
            width: ($("#modalW75F3030").width() * 8 / 10) - 35,
            height: (documentHeight - $(".detailW75F3030").height() - 175),
            showTitle: false,
            collapsible: false,
            editable: false,
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'auto'}
        };
        obj.colModel = [
            {
                title: "{{Helpers::getRS($g,'Tu_thang_nam')}}",
                minWidth: 80,
                width: 80,
                dataType: "date",
                align: "center",
                dataIndx: "FromMonthYear"
            },
            {
                title: "{{Helpers::getRS($g,'Den_thang_nam')}}",
                minWidth: 80,
                width: 80,
                dataType: "date",
                align: "center",
                dataIndx: "ToMonthYear"
            },
            {
                title: "{{Helpers::getRS($g,'Luong_dong_BHXH')}}",
                minWidth: 110,
                width: 110,
                dataIndx: "SIAmount",
                align: "right",
                render: function (ui) {
                    var rowData = ui.rowData;
                    return format2(rowData["SIAmount"],"",2);
                }
            },
            {
                title: "{{Helpers::getRS($g,'Luong_dong_BHYT')}}",
                minWidth: 110,
                width: 110,
                dataIndx: "HIAmount",
                align: "right",
                render: function (ui) {
                    var rowData = ui.rowData;
                    return format2(rowData["HIAmount"],"",2);
                }
            },
            {
                title: "{{Helpers::getRS($g,'Luong_dong_BHTN')}}",
                minWidth: 110,
                width: 110,
                dataIndx: "UIAmount",
                align: "right",
                render: function (ui) {
                    var rowData = ui.rowData;
                    return format2(rowData["UIAmount"],"",2);
                }
            },
            {
                title: "{{Helpers::getRS($g,'Chuc_vu_tham_gia_bao_hiem')}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "OldDutyName"
            },
            {
                title: "{{Helpers::getRS($g,'Don_vi_tham_gia_bao_hiem')}}",
                minWidth: 170,
                dataType: "string",
                dataIndx: "OldDivision"
            }
        ];
        obj.dataModel = {
            data: {{json_encode($rsHistory)}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        };

        var $grid = $("#pqgrid_W75F3030").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
    });
</script>