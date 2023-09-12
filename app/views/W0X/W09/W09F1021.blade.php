<div class="modal fade" id="modalW09F1021" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 60%">
        <div class="modal-content" style="height: 100%">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($titleW09F1021,"W09F1021",true, "closePopupW09F1021")}}
            </div>
            <div class="modal-body" style="padding:10px">
                <div class="row form-group">
                    <div class="col-md-12">
                        <div id="gridW09F1021"></div>
                    </div>
                </div>

                <div class = "row form-group">
                    <div class="col-md-12 col-xs-12">
                        <div class="pull-right">
                            <button type="button" id="btnSaveW09F1005" name="btnSaveW09F1021"
                                    onclick="ask_save(function(){saveData('viewAfterSave')})"
                                    class="btn btn-default smallbtn"><span
                                        class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                            </button>
                            <button type="button" id="btnSaveCloseW09F1005" name="btnSaveCloseW09F1021"
                                    onclick="ask_save(function(){saveData('close')})"
                                    class="btn btn-default smallbtn"><span
                                        class="fa fa-ban text-red"></span> {{Helpers::getRS($g,"Luu&dong")}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        loadGridW09F1021();
    });

    function loadGridW09F1021() {
        var obj = {
            width: '100%',
            //height: $(document).height() - 350,
            height: $(document).height() - 650,
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
            editable: true,
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
                title: "{{Helpers::getRS($g,'Chon')}}",
                dataType: "string",
                dataIndx: "IsCheck",
                minWidth: 120,
                width: 60,
                maxWidth: 120,
                align: "center",
                hidden: false,
                type: 'checkbox',
                editor: false,
                cb: {
                    all: false,
                    header: true,
                    check: "1",
                    uncheck: "0"
                },
                editable: function (ui) {
                    var rowData = ui.rowData
                    return true;
                },
                render: function (ui) {
                    //////console.log(cellData = ui.cellData); //get value checkbox
                    var row = ui.rowData,
                        checked = row["IsCheck"] == '1' ? 'checked' : '',
                        disabled = this.isEditableCell(ui) ? "" : "disabled";
                    return {
                        text: "<label><input type='checkbox' " + checked + " /></label>",
                        cls: (disabled ? "readonly-status" : "")
                    };
                },
                postRender: function (ui) {
                    if (this.isEditableCell(ui) == true) {
                        var rowIndx = ui.rowIndx,
                            grid = this,
                            $cell = grid.getCell(ui);
                        var row = ui.rowData;
                        var tempCheck = row['IsCheck'];//bien tam chua gia tri ischeck luc chua dc check

                        $cell.find("label>input[type='checkbox']")
                            .unbind("click")
                            .bind("click", function (evt) {
                                $gridW09F1021 = $("#gridW09F1021")
                                var obj = $gridW09F1021.pqGrid("getEditCell");
                                var $editor = obj.$editor;

                                if ($editor === undefined) {
                                    var $tr = $(this).closest("tr"),
                                        rowIndx = $gridW09F1021.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                    var rowData = $gridW09F1021.pqGrid("getRowData", {rowIndx: rowIndx});
                                    var rowDataAfter = $gridW09F1021.pqGrid("getRowData", {rowIndx: rowIndx + 1});//dòng kề sau
                                    var rowDataBefore = $gridW09F1021.pqGrid("getRowData", {rowIndx: rowIndx - 1});//dòng kề trước
                                    //alert(rowDataAfter['IsCheck']);
                                    console.log(Number(rowData['IsCheck']), Number(rowDataAfter['IsCheck']), Number(rowDataBefore['IsCheck']));
                                    if(Number(rowData['IsCheck']) == 1){//trường hợp bỏ chọn
                                        if(Number(rowDataAfter['IsCheck']) == 1 && Number(rowDataBefore['IsCheck']) == 1//trường hợp 2 dòng kế bên đều đã đc check
                                            || Number(rowDataAfter['IsCheck']) == 0 && rowDataBefore['IsCheck'] == undefined//trường hợp là dòng dầu tiên
                                            || rowDataAfter['IsCheck'] == undefined && Number(rowDataBefore['IsCheck']) == 0//trường hợp dòng cuối cùng
                                            || Number(rowDataAfter['IsCheck']) == 0 && Number(rowDataBefore['IsCheck']) == 0){//trường hợp 2 dòng kế bên đều ko đc check

                                            if(Number(rowDataAfter['IsCheck']) == 0 && Number(rowDataBefore['IsCheck']) == 0
                                            ||Number(rowDataAfter['IsCheck']) == 0 && rowDataBefore['IsCheck'] == undefined
                                            ||rowDataAfter['IsCheck'] == undefined && Number(rowDataBefore['IsCheck']) == 0){
                                                alert_warning('Phải chọn ít nhất một dòng');
                                            }else{
                                                alert_warning('Vui lòng bỏ chọn theo thứ tự');
                                            }
                                            evt.stopPropagation();
                                            evt.preventDefault();
                                        }
                                    }
                                    if(Number(rowData['IsCheck']) == 0){//trường hợp chọn
                                        if(Number(rowDataAfter['IsCheck']) == 0 && Number(rowDataBefore['IsCheck']) == 0//trường hợp 2 dòng kế bên đều ko đc check
                                            || Number(rowDataAfter['IsCheck']) == 0 && rowDataBefore['IsCheck'] == undefined//trường hợp là dòng dầu tiên
                                            || rowDataAfter['IsCheck'] == undefined && Number(rowDataBefore['IsCheck']) == 0){//trường hợp dòng cuối cùng

                                            alert_warning('Vui lòng chọn theo thứ tự');
                                            evt.stopPropagation();
                                            evt.preventDefault();
                                        }
                                    }
                                } else {
                                    evt.stopPropagation();
                                    evt.preventDefault();
                                }
                            });
                    }
                }
            },
            {
                title: "{{Helpers::getRS($g,'Co_cau_to_chuc')}}",
                dataType: "string",
                dataIndx: "OrgLevelName",
                minWidth: 45,
                width: 450,
                maxWidth: 450,
                align: "left",
                hidden: false,
                editable: false
            },
            {
                title: "{{Helpers::getRS($g,'Mau_C')}}",
                dataType: "string",
                dataIndx: "ColorCode",
                minWidth: 45,
                width: 200,
                align: "center",
                hidden: false,
                editable: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    return '<input class = "ColorCodeRow" type="color" value = '+ (rowData['ColorCode'] != ""? rowData['ColorCode']: '#e17574') +'>';
                },
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var row = ui.rowData;
                    $cell.find(".ColorCodeRow").bind("change", function (evt) {
                        var colorCode = $cell.find(".ColorCodeRow").val();//lay gia tri cua mau colorpicker
                        row['ColorCode'] = colorCode;//gan gia tri vao colorCode cua row
                    });
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
            },
            {
                title: "OrderNo",
                dataType: "string",
                dataIndx: "OrderNo",
                minWidth: 45,
                width: 200,
                align: "left",
                hidden: true,
            }
        ];
        obj.dataModel = {
            data: {{json_encode($rsDataGrid)}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        };

        obj.create = function (evt, ui) {
            //console.log('hello man');

        };

        $("#gridW09F1021").pqGrid(obj);
        setTimeout(function () {
            $("#gridW09F1021").pqGrid("refreshDataAndView");
        }, 300)

    }

    function saveData(actionAfterSave) {
        var dataGrid = $("#gridW09F1021").pqGrid("option", "dataModel.data");
        //console.log(JSON.stringify(dataGrid));
        $.ajax({
            method: "POST",
            url: '{{url("/W09F1021/$pForm/$g/save")}}',
            data: {dataGrid: JSON.stringify(dataGrid)},
            success: function (data) {
                var rs = JSON.parse(data);
                console.log(rs);
                switch (rs.STATUS){
                    case "SUCCESS":
                        save_ok(function () {
                            if(actionAfterSave == "close"){
                                $("#modalW09F1021").modal('hide');
                            }
                            //console.log($("#slOrgChartIDW09F1020"));
                            reloadOrgChartW09F1020($('#slOrgChartIDW09F1020').find('input[type="hidden"]:first').val());
                        });
                        break;
                    case "ERROR":
                        save_not_ok();
                        break;
                }
            }
        });
    }
    
    function closePopupW09F1021() {
        $("#modalW09F1021").modal('hide');
        //('#slOrgChartIDW09F1020').trigger('change');//trickger để đổi màu
    }
</script>