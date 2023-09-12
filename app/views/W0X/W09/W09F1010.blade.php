<div class="modal fade" id="modalW09F1010" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content" style="height: 100%; background-color: #EEEEEE">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($titleW09F1010,"W09F1010",true,"")}}
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <div id="toolbarW09F1010"></div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <div id="gridW09F1010"></div>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <div class="checkbox pull-left">
                            <label>
                                <input type="checkbox" id="chkAllW09F1005"
                                       name="chkAllW09F1005">Hiển thị không sử dụng
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {
        loadGridW09F1010();

    });

    $("#toolbarW09F1010").digiMenu({
            showText: true,
            buttonList: [
                {
                    ID: "btnAddNewAllW09F1010",
                    icon: "fa fa-plus text-blue",
                    title: "{{Helpers::getRS($g, 'Them_moi1')}}",
                    enable: true,
                    hidden: false,
                    type: "button",
                    render: function (ui) {
                    },
                    postRender: function (ui) {
                        ui.$btn.click(function () {
                            showFormDialogPost('{{url("/W09F1005/$pForm/$g")}}', "modalW09F1005",
                                {
                                    action: 'add',
                                    mode: 0,
                                    rowData: []
                                },null);
                        });
                    }
                }
                , {
                    ID: "btnExportW09F1010",
                    icon: "fa fa-file-excel-o text-yellow text-bold",
                    title: "{{Helpers::getRS($g,'Xuat_Excel_U')}}",
                    enable: true,
                    hidden: false,
                    type: "button",
                    render: function (ui) {
                    },
                    postRender: function (ui) {
                        ui.$btn.click(function () {
                            exportW09F1010();
                        });
                    }
                }

            ]
        }
    );

    $('#chkAllW09F1005').click(function () {//lọc lưới theo Disabled// uncheck: hiển thị Disabled = 0 // check: hiển thị all
        var val = $("#chkAllW09F1005").is(":checked") ? "" : "0";
        $("#gridW09F1010").pqGrid("filter", {
            oper: 'replace',
            data: [
                {dataIndx: 'Disabled', condition: 'equal', value: val}
            ]
        }).pqGrid("refreshDataAndView");
    });

    function loadGridW09F1010() {
        var obj = {
            width: '100%',
            //height: $(document).height() - 350,
            height: $(document).height() - 200,
            //freezeCols: 5,
            selectionModel: {type: 'row', mode: 'single'},
            minWidth: 30,
            //pageModel: {type: "local", rPP: 20},
            //filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            showTitle: false,
            dataType: "JSON",
            wrap: false,
            hwrap: false,
            collapsible: false,
            postRenderInterval: -1,
            editable: false,
            numberCell: {show: false},
            rowClick: function (event, ui) {
                //console.log(ui.rowData);
            },
            complete: function (event, ui) {

            },
            cellSave: function (event, ui) {
            },
            cellBeforeSave: function( event, ui ) {

            },
            cellKeyDown: function( event, ui ) {

            }
        };
        obj.colModel = [
            {
                title: "",
                minWidth: 40,
                width: 40,
                maxWidth: 40,
                align: "left",
                dataIndx: "View",
                isExport: false,
                editor: false,
                editable: false,
                sortable: false,
                render: function (ui) {
                    var str = "";
                    var rowData = ui.rowData;

                    var str = digiContextMenu({
                            showText: true,
                            buttonList: [
                                {
                                    ID: "btnAddNewW09F1010",
                                    icon: "fa fa-plus text-blue",
                                    title: '{{Helpers::getRS($g,"Them_moi1")}}',
                                    enable: true,
                                    hidden: false,
                                    type: "button"

                                }
                                , {
                                    ID: "btnViewW09F1010",
                                    icon: "fa fa-eye text-green",
                                    title: '{{Helpers::getRS($g,"Xem")}}',
                                    enable: true,
                                    hidden: false,
                                    type: "button",

                                }
                                , {
                                    ID: "btnEditW09F1010",
                                    icon: "fa fa-edit text-orange",
                                    title: '{{Helpers::getRS($g,"Sua")}}',
                                    enable: true,
                                    hidden: false,
                                    type: "button"
                                }, {
                                    ID: "btnDeleteW09F1010",
                                    icon: "fa fa-trash text-red",
                                    title: '{{Helpers::getRS($g,"Xoa")}}',
                                    enable: true,
                                    hidden: false,
                                    type: "button"
                                }
                            ]
                        }
                    );
                    return {
                        text: str,
                        cls: "overflow-visible"
                    };
                },
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var row = ui.rowData;
                    $cell.find(".btnAddNewW09F1010").bind("click", function (evt) {
                        showFormDialogPost('{{url("/W09F1005/$pForm/$g")}}', "modalW09F1005",
                            {
                                action: 'add',
                                mode: 0,
                                rowData: row
                            },null);
                    });

                    $cell.find(".btnViewW09F1010").bind("click", function (evt) {
                        showFormDialogPost('{{url("/W09F1005/$pForm/$g")}}', "modalW09F1005",
                            {
                                action: 'view',
                                mode: 1,
                                rowData: row
                            },null);
                    });

                    $cell.find(".btnEditW09F1010").bind("click", function (evt) {
                        showFormDialogPost('{{url("/W09F1005/$pForm/$g")}}', "modalW09F1005",
                            {
                                action: 'edit',
                                mode: 1,
                                rowData: row
                            },null);
                    });

                    $cell.find(".btnDeleteW09F1010").bind("click", function (evt) {
                        deleteRowW09F1010(row);
                    });
                },
            },
            {

                title: "{{Helpers::getRS($g,'Ten_don_vi')}}",
                dataType: "string",
                dataIndx: "OrgChartName",
                minWidth: 45,
                width: 450,
                maxWidth: 450,
                align: "left",
                hidden: false,
                isExport: false,
            },
            {

                title: "{{Helpers::getRS($g,'Ten_don_vi')}}",
                dataType: "string",
                dataIndx: "OrgName",
                minWidth: 45,
                width: 450,
                maxWidth: 450,
                align: "left",
                hidden: true,
                isExport: true,
            },
            {
                title: "{{Helpers::getRS($g,'Ma_don_vi')}}",
                dataType: "string",
                dataIndx: "OrgChartID",
                minWidth: 45,
                width: 200,
                align: "left",
                hidden: false,
            },
            {
                title: "{{Helpers::getRS($g,'Dia_chi')}}",
                dataType: "string",
                dataIndx: "OrgAddress",
                minWidth: 45,
                width: 350,
                align: "left",
                hidden: false,
            },
            {
                title: "{{Helpers::getRS($g,'Khong_su_dung')}}",
                dataType: "string",
                dataIndx: "Disabled",
                minWidth: 120,
                width: 60,
                maxWidth: 120,
                align: "center",
                isExport: false,
                hidden: false,
                type: 'checkbox',
                cb: {
                    all: false,
                    header: true,
                    check: "1",
                    uncheck: "0"
                },
                editable: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    return '<input type="checkbox" class = "minimal"' + (rowData["Disabled"] == 1 ? "checked" : "") + '>';
                }
            },
            {
                title: "OrgLevelID",
                dataType: "string",
                dataIndx: "OrgLevelID",
                minWidth: 45,
                width: 200,
                align: "left",
                hidden: true,
                isExport: false,
            },
            {
                title: "OrgChartParentID",
                dataType: "string",
                dataIndx: "OrgChartParentID",
                minWidth: 45,
                width: 200,
                align: "left",
                hidden: true,
                isExport: false,
            }
        ];
        obj.dataModel = {
            data: {{$rsDataGrid}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        };

        obj.create = function (evt, ui) {
            //console.log('hello man');

        };

        $("#gridW09F1010").pqGrid(obj);
        setTimeout(function () {
            $("#gridW09F1010").pqGrid("refreshDataAndView");
        }, 300)

        var val = $("#chkAllW09F1005").is(":checked") ? "" : "0";
        $("#gridW09F1010").pqGrid("filter", {
            oper: 'replace',
            data: [
                {dataIndx: 'Disabled', condition: 'equal', value: val}
            ]
        }).pqGrid("refreshDataAndView");
    }
    
    function deleteRowW09F1010(rowData) {
        console.log(rowData);
        ask_delete(function () {
            $.ajax({
                method: "POST",
                url: '{{url("/W09F1010/$pForm/$g/delete")}}',
                data: {
                    OrgChartID: rowData['OrgChartID'],
                    OrgLevelID: rowData['OrgLevelID']
                },
                success: function (data) {
                    // var rs = JSON.parse(data);
                    console.log(data);
                    switch (data){
                        case "SUCCESS":
                            delete_ok(function () {
                                reloadGridW09F1010();
                            });
                            break;
                        case "FAILED":
                            delete_not_ok();
                            break;
                        default:
                            alert_warning(data);
                            break;
                    }
                }
            });
        });

    }

    function reloadGridW09F1010() {//ham reload lai luoi
        $("#gridW09F1010").pqGrid('showLoading');
        $.ajax({
            method: "POST",
            url: '{{url("/W09F1010/$pForm/$g/reloadGrid")}}',
            data: '',
            success: function (data) {
                // var rs = JSON.parse(data);
                //console.log(data);
                $("#gridW09F1010").pqGrid("option", "dataModel.data", data);
                $("#gridW09F1010").pqGrid("refreshDataAndView");
                $("#gridW09F1010").pqGrid('hideLoading');
            }
        });
    }
    
    var exportW09F1010 = function () {
        var _title = [];
        var _dataIndx = [];
        var _align = [];
        var _format = [];
        initExportExcell($("#gridW09F1010"), _title, _dataIndx, _align, _format);
        var _data = JSON.stringify($("#gridW09F1010").pqGrid("option", "dataModel.data"));

        $.ajax({
            method: "POST",
            data: {title: _title, data: _data, dataIndx: _dataIndx, align: _align, format: _format},
            url: "{{url('/Export')}}",
            success: function (data) {
                if (data == 0) {
                    alert_error('{{Helpers::getRS(5,'Loi_xuat_file')}}')
                }
                else {
                    var downloadLink = document.createElement("a");
                    var d =  new Date();
                    downloadLink.download = "Co_cau_to_chuc_" + d.getDate() + "" + (Number(d.getMonth()) + 1) + "" + d.getFullYear() + ".xls";
                    downloadLink.innerHTML = "Co_cau_to_chuc_";
                    downloadLink.href = data;
                    downloadLink.onclick = destroyClickedElement;
                    downloadLink.style.display = "none";
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                }
            }
        });
    };
</script>