<style>
    input.filterValue {
        border: 1px solid #aaa;
        padding: 1px 5px;
        margin: 0px 5px;
    }

    div.pq-toolbar select {
        height: 24px;
    }
</style>
<div id="pqgrid_W38F3000"></div>
<script type="text/javascript">
    $(function () {
        //called by delete button.
        //state of the checkbox and row selection is being saved in state field.
        var data = {{$rs}};
        //called by delete button.
        function showPopW38F2000(rowIndx, $grid) {
            var rowData = $grid.getRowData({rowIndx: rowIndx});
            var ProBatchID = rowData['ProBatchID'];
            var ProposalID = rowData['ProposalID'];
            var status = 0; //0: la chua duyet, <> 0: l� ?ang duyet
            $.ajax({
                method: "POST",
                url: '{{url("/W38F3000/view/$pForm/$g/checkstatus/")}}',
                data: {ProposalID: ProposalID, Mode: 1},
                success: function (data) {
                    var result = $.parseJSON(data);
                    status = result.CODE;
                    switch (result.CODE) {
                        case 1:
                            var params = [ProBatchID, ProposalID, status];
                            alert_warning(result.message, yes_callback, params);
                            break;
                        case 0:
                            showFormDialog("W38F2000/" + "{{$pForm}}" + "/" + {{$g}} +"/master/" + ProBatchID + "/" + ProposalID + "/" + status, 'modalW38F2000');
                            break;
                    }
                }
            });

        }

        function yes_callback(params) {
            showFormDialog("W38F2000/" + "{{$pForm}}" + "/" + {{$g}} +"/master/" + params[0] + "/" + params[1] + "/" + params[2], 'modalW38F2000')
        }

        var obj = {
            width: '100%',
            height: $("#maintabs").height() - 180,
            editable: false,
            freezeCols: 1,
            selectionModel:{type: 'row'},
            minWidth: 30,
            pageModel: {type: "local", rPP: 20},
            filterModel: {on: true, mode: "AND", header: true},
            showTitle: false,
            wrap: false,
            hwrap: false,
            collapsible: false,
            postRenderInterval: -1,
            colModel: [
                {
                    title: "", editable: false, minWidth: 30, sortable: false, align: "center",
                    render: function (ui) {
                        var rowData = ui.rowData;

                        var str = "";
                        if (rowData["AppStatusID"] <= 1) {
                            str += " <a title='{{Helpers::getRS($g,"Sua")."/".Helpers::getRS($g,"Xoa")}}' class='btnEditW38F3000'><i class='glyphicon glyphicon-edit' style='color:orange'></i></a>";
                        } else {
                            str += " <a title='{{Helpers::getRS($g,"Sua")."/".Helpers::getRS($g,"Xoa")}}' class='btnEditW38F3000Disable'><i class='glyphicon glyphicon-edit text-grey no-border' style='color:#ccc'></i></a>";
                            //str += " <a title='{{Helpers::getRS($g,"Sua")}}' id='btnEditW09F2020Disable'><i class='glyphicon glyphicon-edit text-grey no-border' style='color:#ccc;cursor:text;padding-right:5px'></i></a> ";
                        }
                        return str;
                    },
                    postRender: function (ui) {
                        var rowIndx = ui.rowIndx,
                                grid = this,
                                $cell = grid.getCell(ui);

                        //edit button
                        $cell.find(".btnEditW38F3000").bind("click", function (evt) {
                            //console.log(ui.rowData);
                            showPopW38F2000(rowIndx, grid);
                        });
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Ngay_de_xuat")}}",
                    minWidth: 110,
                    sortable: false,
                    dataType: "string",
                    dataIndx: "ProposalDate",
                    align: "center",
                    filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                },
                {
                    title: "{{Helpers::getRS($g,"Nguoi_de_xuat")}}",
                    minWidth: 170,
                    dataType: "string",
                    dataIndx: "ProposerName",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Trang_thai")}}",
                    minWidth: 110,
                    dataType: "string",
                    dataIndx: "StatusName",
                    align: "center",
                    editor: false,
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                    filter: {
                        type: "select",
                        condition: 'equal',
                        prepend: {'': '---'},
                        valueIndx: "StatusName",
                        labelIndx: "StatusName",
                        listeners: ['change']
                    },


                    render: function (ui) {
                        var rowData = ui.rowData;
                        var str = "";
                        str += "<a title='{{Helpers::getRS($g,"Lich_su_duyet")}}' class='btnViewHistoryW38F2040 mgr10 text-blue'>" + rowData["StatusName"] + "</a>";
                        return str;
                    },
                    postRender: function (ui) {
                        var rowIndx = ui.rowIndx,
                            grid = this,
                            $cell = grid.getCell(ui);
                        var row = ui.rowData;
                        console.log(row);
                        //edit button
                        $cell.find(".btnViewHistoryW38F2040").bind("click", function (evt) {
                            showFormDialogPost('{{url("/W09F3030/$pForm/$g")}}', "modalW09F3030", {transID: row["ProposalID"]},2);
                        });

                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Ten_de_xuat")}}",
                    minWidth: 270,
                    dataType: "string",
                    dataIndx: "ProposalName",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ke_hoach_tong_the")}}",
                    minWidth: 200,
                    dataType: "string",
                    dataIndx: "ProTrainName",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Dia_diem_dao_tao")}}",
                    minWidth: 270,
                    dataType: "string",
                    dataIndx: "Address",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Noi_bo")}}",
                    minWidth: 90,
                    dataType: "string",
                    dataIndx: "IsAddress",
                    align: "center",
                    type: 'checkbox',
                    cb: {
                        all: false,
                        header: true,
                        check: "1",
                        uncheck: "0"
                    },
                    editable: false,
                    render: function (ui) {
                        var row = ui.rowData,
                            checked = row["IsAddress"] == 1 ? 'checked' : ''
                        return {
                            text: "<label><input type='checkbox' " + checked + " /></label>",
                        };
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Phong_ban")}}",
                    minWidth: 270,
                    dataType: "string",
                    dataIndx: "DepartmentName",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Linh_vuc_dao_tao")}}",
                    minWidth: 270,
                    dataType: "string",
                    dataIndx: "TrainingFieldName",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Khoa_dao_tao_U")}}",
                    minWidth: 270,
                    dataType: "string",
                    dataIndx: "TrainingCourseName",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"SL_de_xuat")}}",
                    minWidth: 110,
                    align: "right",
                    dataIndx: "ProNumber",
                    dataType: 'float',
                    format: "##,###.00",
                    filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"TG_bat_dau")}}",
                    minWidth: 90,
                    sortable: false,
                    dataType: "string",
                    dataIndx: "FromDate",
                    align: "center",
                    filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                },
                {
                    title: "{{Helpers::getRS($g,"TG_ket_thuc")}}",
                    minWidth: 90,
                    sortable: false,
                    dataType: "string",
                    dataIndx: "ToDate",
                    align: "center",
                    filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                },
                {
                    title: "ProposalID",
                    minWidth: 90,
                    sortable: false,
                    dataType: "string",
                    hidden: true,
                    dataIndx: "ProposalID",
                    align: "center"
                }
            ],
            dataModel: {
                data: data
            }
        };
        var $gridW38F3000 = $("#pqgrid_W38F3000").pqGrid(obj);
        $gridW38F3000.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW38F3000.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridW38F3000.pqGrid("refreshDataAndView");
    });
</script>
