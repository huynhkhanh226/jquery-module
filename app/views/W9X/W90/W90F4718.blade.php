<div class="modal fade" id="modalW90F4718" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($titleW90F4718,"W90F4718",true,"")}}
            </div>
            <div class="modal-body" style="padding:10px">
                <div class="row form-group">
                    <div class="col-md-4 col-xs-4 ">
                        <form class="form-horizontal" id="frmW90F4718">
                            <fieldset>
                                <legend class="legend mgb5">{{"1. ".Helpers::getRS($g,"Thong_tin_chung")}}</legend>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Don_vi")}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select id="cboDivisionIDW90F4718" name="cboDivisionIDW90F4718"
                                                class="form-control select2">
                                            @foreach($divisionList as $rowDivision)
                                                <option title="{{$rowDivision["DivisionID"]}}"
                                                        value="{{$rowDivision["DivisionID"]}}">{{$rowDivision["DivisionID"]."--".$rowDivision["DivisionName"]}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{--<div class="col-md-4">
                                        <input type="text" class="form-control" id="txtDivisionNameW90F4718"
                                               name="txtDivisionNameW90F4718" value="">
                                    </div>--}}
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Nam")}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="cboYearW90F4718" name="cboYearW90F4718" class="form-control select2">
                                            @foreach($yearList as $rowYear)
                                                <option title="{{$rowYear["TranYear"]}}"
                                                        value="{{$rowYear["TranYear"]}}">{{$rowYear["TranYear"]}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Ma_bao_cao")}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select id="cboReportIDW90F4718" name="cboReportIDW90F4718"
                                                class="form-control select2">
                                            @foreach($reportList as $rowReport)
                                                <option title="{{$rowReport["ReportName"]}}"
                                                        value="{{$rowReport["ReportCode"]}}">{{$rowReport["ReportCode"]."--".$rowReport["ReportName"]}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button class="btn btn-default smallbtn pull-right"><span
                                                    class="digi digi-filter"></span>
                                            &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                                        <button type="submit" id="hdBtnFilterW90F4718" class="hidden"></button>
                                    </div>

                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-md-8 col-xs-8 ">
                        <fieldset>
                            <legend class="legend mgb5">{{"2. ".Helpers::getRS($g,"Danh_sach_ma_bao_cao")}}</legend>
                            <div id="gridMasterW90F4718"></div>
                        </fieldset>
                    </div>

                </div>

                <fieldset>
                    <legend class="legend mgb5">{{"3. ".Helpers::getRS($g,"Noi_dung_bao_cao")}}</legend>
                    <div id="divGridDetailW90F4718"></div>
                </fieldset>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $gridMaster = $("#gridMasterW90F4718");
    $gridDetail = $("#gridDetailW90F4718");
    $(document).ready(function (e) {
        $(".select2").select2();
        loadGridMasterW90F4718();

        $("#frmW90F4718").on('submit', function (e) {
            e.preventDefault();
            reLoadGridMasterW90F4718();
        });

        $('#cboDivisionIDW90F4718').on('change', function (e) {
            // Do something
            $.ajax({
                method: "POST",
                url: '{{url("/W90F4718/$pForm/$g/reloadyear")}}',
                data: $("#frmW90F4718").serialize(),
                success: function (data) {
                    //console.log(data);
                    $("#cboYearW90F4718").html("");
                    $("#cboYearW90F4718").html(data);
                    $(".select2").select2();
                }
            });
        });
    });



    function loadGridMasterW90F4718() {
        var obj = {
            width: '100%',
            height: 137,
            editable: false,
            freezeCols: 1,
            minWidth: 30,
            selectionModel: {type: 'row', mode: 'single'},
            //filterModel: {mode: 'OR'},
            filterModel: {on: false, mode: "AND", header: false},
            scrollModel: {horizontal: false, pace: 'fast', autoFit: true, lastColumn: 'none'},
            postRenderInterval: -1,
            showTitle: false,
            wrap: false,
            hwrap: false,
            collapsible: false,
            colModel: [
                {
                    title: "", editable: false, width: 30, maxWidth: 30, sortable: false, align: "center", isExport: false,
                    render: function (ui) {
                        var rowData = ui.rowData;
                        var str = "";
                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class='btnDeleteW90F4718'><i class='fa fa-trash text-red' style='color:#333'></i></a>";
                        return str;
                    },
                    hidden: true,
                    postRender: function (ui) {
                        var rowIndx = ui.rowIndx,
                            grid = this,
                            $cell = grid.getCell(ui);
                        var rowData = ui.rowData;
                        $cell.find(".btnDeleteW90F4718").bind("click", function (evt) {
                            ask_delete(function () {
                                postMethod('{{url("/W90F4718/$pForm/$g/deletereport")}}', function (data) {
                                    if (data == 1){
                                        delete_ok(function(){
                                            update4ParamGrid($(document).find("#gridMasterW90F4718"), null, 'delete');
                                        });
                                    }else{
                                        alert_error("{{Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")}}");
                                    }
                                }, {reportCode : rowData["ReportCode"], reportSaveID:rowData["ReportSaveID"] });
                            });

                        });
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Ma_bao_cao")}}",
                    minWidth: 80,
                    dataType: "string",
                    dataIndx: "ReportCode",
                    hidden: true
                },
                {
                    title: "{{Helpers::getRS($g,"Ma_luu_bao_cao")}}",
                    minWidth: 50,
                    dataType: "string",
                    dataIndx: "ReportSaveID"
                },
                {
                    title: "{{Helpers::getRS($g,"Ten_luu_bao_cao")}}",
                    minWidth: 340,
                    dataType: "string",
                    align: "left",
                    dataIndx: "ReportSaveName",
                }

            ],
            dataModel: {
                data: {{json_encode([])}}
            },
            complete: function (event, ui) {
                var data = $gridMaster.pqGrid("option", "dataModel.data");
                var rowData = getRowSelection($gridMaster);
                if (data.length > 0 && rowData == null) {
                    $gridMaster.pqGrid("setSelection", {rowIndx: 0});
                } else {
                    reLoadGridDetailW90F4718(null);
                }
            },
            selectChange: function (event, ui) {
                //alert("change");
                var rowData = getRowSelection($gridMaster);
                reLoadGridDetailW90F4718(rowData);
            }
        };
        $gridMasterW90F4718 = $("#gridMasterW90F4718").pqGrid(obj);
        //$gridMasterW90F4718.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        //$gridMasterW90F4718.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridMasterW90F4718.pqGrid("refreshDataAndView");
        setTimeout(function () {
            resizePqGrid();
        }, 300);
    }

    function reLoadGridMasterW90F4718() {
        $("#gridMasterW90F4718").pqGrid("showLoading");
        $.ajax({
            method: "POST",
            url: '{{url("/W90F4718/$pForm/$g/filter")}}',
            data: $("#frmW90F4718").serialize(),
            success: function (data) {
                //console.log(data);
                $("#gridMasterW90F4718").pqGrid("hideLoading");
                $("#gridMasterW90F4718").pqGrid("option", "dataModel.data", data);
                $("#gridMasterW90F4718").pqGrid("refreshDataAndView");
            }
        });
    }

    function reLoadGridDetailW90F4718(rowData) {
        if (rowData == null){
            $("#gridDetailW90F4718").pqGrid("option", "dataModel.data", []);
            $("#gridDetailW90F4718").pqGrid("refreshDataAndView");
        }else{
            $("#gridDetailW90F4718").pqGrid("showLoading");
            $.ajax({
                method: "POST",
                url: '{{url("/W90F4718/$pForm/$g/loaddetail")}}',
                data: $("#frmW90F4718").serialize() + "&" + $.param(rowData),
                success: function (data) {
                    $("#gridDetailW90F4718").pqGrid("hideLoading");
                    $("#divGridDetailW90F4718").html(data);
                }
            });
        }

    }



</script>