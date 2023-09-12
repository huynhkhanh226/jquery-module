<div class="modal draggable" id="modalW75F3020" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 80%">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading($modalTitle,"W75F3020")}}
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <fieldset>
                        <legend class="legend">{{Helpers::getRS($g,"To_chuc")}}</legend>
                        <div class="row mgl0">
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Cong_viec")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <a data-placement="bottom" data-toggle="popover" data-container="#modalW75F3020" data-trigger="focus" tabindex="0"
                                           data-placement="left" type="button" data-html="true"><span
                                                    class="fa fa-search text-orange"></span></a>
                                        <label>{{$rData["WorkName"]}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_vao_lam")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <label>{{$rData["DateJoined"]}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Trang_thai")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <label>{{$rData["StatusName"]}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--<div class="row mgl0">--}}
                        {{--<div class="col-md-2 col-xs-2">--}}
                        {{--<label class="lbl-normal">{{Helpers::getRS($g,"Dien_giai")}}</label>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-10 col-xs-10">--}}
                        {{--<label>{{$rData["JobDescription"]}}</label>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </fieldset>
                    <br>
                    <fieldset>
                        <legend class="legend">{{Helpers::getRS($g,"Hop_dong_lao_dongU")}}</legend>
                        <div class="row mgl0">
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"So_HDLD")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <label>{{$rData["LaborContractNo"]}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Loai_HDLD")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <label>{{$rData["WorkFormName"]}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Nguoi_dai_dien")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <label>{{$rData["SignerName"]}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mgl0">
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_ky")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <label>{{$rData["ContractDateBegin"]}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_het_han")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <label>{{$rData["ContractDateEnd"]}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <br>
                    <fieldset style="padding-bottom:8px">
                        <legend class="legend">{{Helpers::getRS($g,"Lich_su_HDLD")}}</legend>
                        <div id="pqgrid_W75F3020" style="margin:auto;" class="mgb5"></div>
                    </fieldset>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var iWGrid = $("#modalW75F3020").width();
        var obj = {
            width: (iWGrid * 8 / 10) - 35,
            height: 200,
            showTitle: false,
            collapsible: false,
            editable: false,
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'auto'},
            refresh: function (evt, ui) {
                var data = $("#pqgrid_W75F3020").pqGrid('option', 'dataModel.data');
                $.each(data, function (i, rowData) {
                    if (rowData["IsType"] == "HD") {
                        $("#pqgrid_W75F3020").pqGrid("addClass", {rowIndx: i, cls: 'text-parent'});
                    }
                });
            }
        };
        obj.colModel = [
            {
                title: "{{Helpers::getRS($g,'So_HDLD')."/".Helpers::getRS($g,'So_PLHD')}}",
                minWidth: 130,
                dataType: "string",
                dataIndx: "LaborContractNo"
            },
            {
                title: "{{Helpers::getRS($g,'Lan_ky')}}",
                minWidth: 50,
                width: 50,
                dataType: "integer",
                dataIndx: "Times",
                align: "right"
            },
            {
                title: "{{Helpers::getRS($g,'Loai_HDLD')}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "WorkFormName"
            },
            {
                title: "{{Helpers::getRS($g,'Nguoi_dai_dien')}}",
                minWidth: 170,
                dataType: "string",
                dataIndx: "SignerName"
            },
            {
                title: "{{Helpers::getRS($g,'Ngay_bat_dau')}}",
                minWidth: 80,
                width: 80,
                dataType: "date",
                align: "center",
                dataIndx: "ContractDateBegin"
            },
            {
                title: "{{Helpers::getRS($g,'Ngay_ket_thuc')}}",
                minWidth: 80,
                width: 80,
                dataType: "date",
                align: "center",
                dataIndx: "ContractDateEnd"
            },
            {
                title: "{{Helpers::getRS($g,'Dien_giai')}}",
                minWidth: 150,
                dataType: "string",
                dataIndx: "Description"
            }
        ];
        obj.dataModel = {
            data: {{json_encode($connectionHR->select("Exec W75P5888 '".Session::get("W91P0000")['HRDivisionID']."', '".$rData["EmployeeID"]."', '".Session::get('Lang')."'"))}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        };

        var $grid = $("#pqgrid_W75F3020").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");

        $("[data-toggle=popover]").popover({
            html: true,
            content: '{{$rData["JobDescription"]}}'
        });
    });

    $("#modalW75F3020").on('shown.bs.modal', function () {
        $("#pqgrid_W75F3020").pqGrid("refresh");
    });
</script>