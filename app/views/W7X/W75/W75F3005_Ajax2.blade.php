<div id="pqgrid_W75F3005_2"></div>
<script type="text/javascript">
    var iW75F2130_Height = 200;
//alert(iW75F2130_Height);
    var obj1 = {
        width: '100%',
        height: iW75F2130_Height,
        showTitle: false,
        collapsible: false,
        selectionModel: {type: 'cell', mode: 'single'},
        scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
        rowBorders: true,
        columnBorders: true,
        postRenderInterval: -1,
        freezeCols: 3,
        hwrap: false,
        wrap: false,
        sortable: false,
        filterModel: {on: true, mode: "AND", header: true},
        editable: true,
        numberCell: {show: false},
        editModel: {
            saveKey: $.ui.keyCode.ENTER,
            select: true,
            keyUpDown: false,
            cellBorderWidth: 0,
            //onBlur: "save",
            clicksToEdit: 1
        },
        colModel: [
            {
                title: 'IsUpdate',
                minWidth: 90,
                align: "left",
                dataIndx: "IsUpdate",
                isExport: false,
                editor: false,
                hidden: true
            },
            {
                title: '{{Helpers::getRS($g,"Chon")}}',
                minWidth: 90,
                align: "center",
                dataIndx: "Check",
                isExport: false,
                editor: false,
                type: 'checkbox',
                cb: {
                    all: false,
                    header: true,
                    check: "1",
                    uncheck: "0"
                },
                editable: function (ui) {
                    console.log(ui.rowData);
                    var rowData = ui.rowData;
                    return (rowData['IsProcessedHours'] == 0 && rowData['IsProcessedAmount'] == 0)? true: false;
                },
                render: function (ui) {
                    var row = ui.rowData,
                        disabled = this.isEditableCell(ui) ? "" : "disabled";
                    return {
                        text: '<input type="checkbox"' + (row["Check"] == 1 ? "checked" : "") + '>',
                        cls: (disabled ? "readonly-status" : "")
                    };
                    //return '<input type="checkbox"' + (rowData["Check"] == 1 ? "checked" : "") + '>';
                },
                postRender: function (ui) {
                    if (this.isEditableCell(ui) == true) {
                        var rowIndx = ui.rowIndx,
                            grid = this,
                            $cell = grid.getCell(ui);

                        $cell.find("input[type='checkbox']")
                            .unbind("click")
                            .bind("click", function (evt) {
                                //alert("hello");
                                pqgrid_W75F3005_2 = $("#pqgrid_W75F3005_2");
                                //ui.rowData.IsUpdate = 1;
                                var obj = pqgrid_W75F3005_2.pqGrid("getEditCell");
                                var $editor = obj.$editor;
                                if ($editor === undefined) {
                                    //alert("hell");
                                    var $tr = $(this).closest("tr"),
                                        rowIndx = pqgrid_W75F3005_2.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                    var rowData = pqgrid_W75F3005_2.pqGrid("getRowData", {rowIndx: rowIndx});
                                    if ($(this).is(":checked") == true) {
                                        rowData["Check"] = 1;
                                    }else{
                                        rowData["Check"] = 0;
                                    }
                                } else {
                                    evt.stopPropagation();
                                    evt.preventDefault();
                                }
                                $("#pqgrid_W75F3005_2").pqGrid("refreshDataAndView")
                                //console.log(ui.rowData.GroupID);
                            });
                    }
                }
            },
            {
                title: '{{Helpers::getRS($g,"Ten_NV")}}',
                minWidth: 250,
                align: "left",
                dataIndx: "EmployeeName",
                isExport: true,
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                render: function (ui) {
                    var row = ui.rowData,
                        disabled = (row['IsProcessedHours'] == 0 && row['IsProcessedAmount'] == 0) ? "" : "disabled";
                    return {
                        //text: '<input type="checkbox"' + (row["Check"] == 1 ? "checked" : "") + '>',
                        cls: "readonly-status"
                    };
                    //return '<input type="checkbox"' + (rowData["Check"] == 1 ? "checked" : "") + '>';
                }
            }
            @foreach($caption2 as $row)
            , {
                title: "{{$row['FieldCaption']}}",
                minWidth: 100,
                align: "center",
                dataType: "string",
                hoursColumn: "{{$row['DateType']}}",
                //format: "{{--{{Helpers::getStringFormat(0)}}--}}",//returnSFormat(0),
                dataIndx: "{{$row['FieldName']}}",
                editor: {select: true},
                editModel: {keyUpDown: true},
                editable: function (ui) {
                    var rowData = ui.rowData
                    return "{{$row["IsEdit"] == 1 }}" && Number(rowData["Check"]) == 1;
                },
                render: function (ui) {
                    var row = ui.rowData,
                        disabled = this.isEditableCell(ui) ? "" : "disabled";
                    return {
                        cls: (disabled ? "readonly-status" : "")
                    };
                },
            }
            @endforeach
        ],
        dataModel: {
            data: {{json_encode($valueGrid2)}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        },
        complete: function (event, ui) {
           // console.log('complete grid');

        },
        cellClick: function (event, ui) {

        },
        cellSave: function (event, ui) {
            //alert("cellsave");
            ui.rowData.IsUpdate = 1;
            $("#pqgrid_W75F3005_2").pqGrid("refreshDataAndView")
        },
        editorBegin: function (event, ui) {
            console.log(ui.column.hoursColumn);
           var soel = $("#pqgrid_W75F3005_2");
            if (ui.column.hoursColumn == "H") {
                var obj = soel.pqGrid("getEditCell");
                var $td = obj.$td; //table cell
                var $cell = obj.$cell; //editor wrapper.
                var $editor = obj.$editor; //editor.
                //console.log($editor);
                $($editor).inputmask({
                    alias: "datetime",
                    mask: "h:s",
                    placeholder: "__:__"
                });
                //event.preventDefault();
                //event.stopPropagation()
            }
        },
        cellBeforeSave: function (event, ui) {
            /*if (invalid(ui.newVal)){
                return true;
            }else{
                alert("ban nhap khong hop le")
                return false;
            }*/
        }
    };
    $("#pqgrid_W75F3005_2").pqGrid(obj1);
    $("#pqgrid_W75F3005_2").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $("#pqgrid_W75F3005_2").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    setTimeout(function () {
        $("#pqgrid_W75F3005_2").pqGrid("refreshDataAndView");
    }, 300)
</script>