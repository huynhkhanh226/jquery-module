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
<div id="tblEmployeeIDW38F2000" style="margin:auto;"></div>
<script type="text/javascript">
    var $gridW38F2000;
    $(function () {
        //called by delete button.
        //state of the checkbox and row selection is being saved in state field.
        $("#hdEmployeesCount").val({{count($dataW38F2000)}});
        var data = {{json_encode($dataW38F2000)}};
        //var tempData = data;
        console.log(data);
        //called by delete button.
        function deleteRowW38F2000(rowIndx) {
            //update4ParamGrid($("#tblEmployeeIDW38F2000"), null, 'delete');
            var $grid = $("#tblEmployeeIDW38F2000");
            $grid.pqGrid("deleteRow", {rowIndx: rowIndx});
            $grid.pqGrid("refreshDataAndView");
            var employeeids = new Array();
            var dataGrid = $("#tblEmployeeIDW38F2000").pqGrid("option", "dataModel.data");//lấy lại DL lưới sau khi xóa
            for (var i = 0; i < dataGrid.length; i++) {
                var id = dataGrid[i]["EmployeeID"];
                employeeids[i] = id;
            }
            $("#hdEmployeesCount").val($("#hdEmployeesCount").val() - 1);
            updateGridW09F5605(employeeids);//cập nhật lại biến mảng tạm
            //console.log(data);
        }

        var obj = {
            width: '100%',
            height: 300,
            editable: false,
            freezeCols: 1,
            minWidth: 30,
            selectionModel: {type: 'cell', mode: 'single'},
            filterModel: {mode: 'OR'},
            scrollModel: {autoFit: true},
            postRenderInterval: -1,
            toolbar: {
                cls: "pq-toolbar-search",
                items: [
                    {type: "<span style='margin:5px;'>{{Helpers::getRS($g,"Tim_kiem")}}</span>"},
                    {
                        type: 'select', cls: "filterColumn",
                        listeners: [{'change': filterhandler}],
                        options: function (ui) {
                            var CM = ui.colModel;
                            var opts = [{'': '{{Helpers::getRS($g,"Tat_ca_Web")}}'}];
                            for (var i = 0; i < CM.length; i++) {
                                var column = CM[i];
                                var obj = {};
                                if (column.title != "") {
                                    obj[column.dataIndx] = column.title;
                                    opts.push(obj);
                                }

                            }
                            return opts;
                        }
                    },
                    {
                        type: 'select', style: "margin:0px 5px;", cls: "filterCondition",
                        listeners: [{'change': filterhandler}],
                        options: [
                            {"begin": "{{Helpers::getRS($g,"Bat_dau_voi")}}"},
                            {"contain": "{{Helpers::getRS($g,"Co_chua")}}"},
                            {"end": "{{Helpers::getRS($g,"AKet_thuc_voi")}}"},
                            {"notcontain": "{{Helpers::getRS($g,"Khong_co_chua")}}"},
                            {"equal": "{{Helpers::getRS($g,"ABang")}}"},
                            {"notequal": "{{Helpers::getRS($g,"Khong_bang")}}"},
                            {"empty": "{{Helpers::getRS($g,"Rong")}}"},
                            {"notempty": "{{Helpers::getRS($g,"Khong_rong")}}"},
                            {"less": "{{Helpers::getRS($g,"ANho_hon")}}"},
                            {"great": "{{Helpers::getRS($g,"ALon_hon")}}"},
                            {"regexp": "{{Helpers::getRS($g,"Bieu_thuc")}}"}
                        ]
                    }
                ]
            },
            showTitle: false,
            wrap: false,
            hwrap: false,
            collapsible: false,
            colModel: [
                {
                    title: "",
                    editable: false,
                    minWidth: 30,
                    maxWidth: 30,
                    dataIndx: "Action",
                    sortable: false,
                    align: "center",
                    render: function (ui) {
                        return "<a class='glyphicon glyphicon-remove mgr5' title='{{Helpers::getRS($g,"Xoa")}}' style='margin-top:2px;color:red'></a>";
                    },
                    postRender: function (ui) {
                        var grid = this,$cell = grid.getCell(ui);

                        //edit button
                        $cell.find("a.glyphicon-remove").bind("click", function (evt) {
                            deleteRowW38F2000(ui.rowIndx);
                        });
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Ma_NV")}}",
                    minWidth: 110,
                    dataType: "string",
                    dataIndx: "EmployeeID",
                    render: filterRender
                },
                {
                    title: "{{Helpers::getRS($g,"Ho_va_ten")}}",
                    minWidth: 230,
                    dataType: "string",
                    dataIndx: "EmployeeName",
                    render: filterRender
                },
                {
                    title: "{{Helpers::getRS($g,"Gioi_tinh")}}",
                    minWidth: 80,
                    dataType: "string",
                    align: "center",
                    dataIndx: "Sex",
                    render: filterRender
                },
                {
                    title: "{{Helpers::getRS($g,"Phong_ban")}}",
                    minWidth: 150,
                    dataType: "string",
                    dataIndx: "DepartmentName",
                    render: filterRender
                },
                {
                    title: "{{Helpers::getRS($g,"To_nhom")}}",
                    minWidth: 150,
                    dataType: "string",
                    dataIndx: "TeamName",
                    render: filterRender
                },
                {
                    title: "{{Helpers::getRS($g,"Tham_nien")}}",
                    minWidth: 150,
                    dataType: "string",
                    dataIndx: "Seniority",
                    render: filterRender
                },
                {
                    title: "{{Helpers::getRS($g,"Chuc_vu")}}",
                    minWidth: 150,
                    dataType: "string",
                    dataIndx: "DutyName",
                    render: filterRender
                }
            ],
            dataModel: {
                data: data
            }
        };
        $gridW38F2000 = $("#tblEmployeeIDW38F2000").pqGrid(obj);
        $gridW38F2000.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW38F2000.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridW38F2000.pqGrid("refreshDataAndView");

        function filterhandler(evt, ui) {
            var $toolbar = $gridW38F2000.find('.pq-toolbar-search'),
                    $value = $toolbar.find(".filterValue"),
                    value = $value.val(),
                    condition = $toolbar.find(".filterCondition").val(),
                    dataIndx = $toolbar.find(".filterColumn").val(),
                    filterObject;

            if (dataIndx == "") {//search through all fields when no field selected.
                filterObject = [];
                var CM = $gridW38F2000.pqGrid("getColModel");
                for (var i = 0, len = CM.length; i < len; i++) {
                    var dataIndx = CM[i].dataIndx;
                    filterObject.push({dataIndx: dataIndx, condition: condition, value: value});
                }
            }
            else {//search through selected field.
                filterObject = [{dataIndx: dataIndx, condition: condition, value: value}];
            }
            $gridW38F2000.pqGrid("filter", {
                oper: 'replace',
                data: filterObject
            });
        }

        //filterRender to highlight matching cell text.
        function filterRender(ui) {
            var val = ui.cellData,
                    filter = ui.column.filter;
            if (filter && filter.on && filter.value) {
                var condition = filter.condition,
                        valUpper = val.toUpperCase(),
                        txt = filter.value,
                        txt = (txt == null) ? "" : txt.toString(),
                        txtUpper = txt.toUpperCase(),
                        indx = -1;
                if (condition == "end") {
                    indx = valUpper.lastIndexOf(txtUpper);
                    //if not at the end
                    if (indx + txtUpper.length != valUpper.length) {
                        indx = -1;
                    }
                }
                else if (condition == "contain") {
                    indx = valUpper.indexOf(txtUpper);
                }
                else if (condition == "begin") {
                    indx = valUpper.indexOf(txtUpper);
                    //if not at the beginning.
                    if (indx > 0) {
                        indx = -1;
                    }
                }
                if (indx >= 0) {
                    var txt1 = val.substring(0, indx);
                    var txt2 = val.substring(indx, indx + txt.length);
                    var txt3 = val.substring(indx + txt.length);
                    return txt1 + "<span style='background:yellow;color:#333;'>" + txt2 + "</span>" + txt3;
                }
                else {
                    return val;
                }
            }
            else {
                return val;
            }
        }

        $("#tblEmployeeIDW38F2000").find(".pq-toolbar-search").append("<input type='text' id='idFilterW38F2000' name='idFilterW38F2000'  class='filterValue' value='' placeholder='{{Helpers::getRS($g,"Tim_kiem")}}' />")
        $("#idFilterW38F2000").keyup(function () {
            filterhandler();
        });


    });

</script>





