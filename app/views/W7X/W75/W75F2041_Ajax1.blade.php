<div id="gridW75F2041_1"></div>
<script type="text/javascript">
    //var iW75F2130_Height = $(document).height() - 630;
    var rowIndex = 0;
    var obj = {
        width: '100%',
        height: $(document).height() - 230,
        editable: true,
        freezeCols: 2,
        selectionModel: {type: 'row', mode: 'single'},
        minWidth: 30,
        //pageModel: {type: "local", rPP: 20},
        //filterModel: {on: true, mode: "AND", header: true},
        showTitle: false,
        //dataType: "JSON",
        wrap: false,
        hwrap: false,
        scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
        collapsible: false,
        postRenderInterval: -1,
        oldIndex: -1,
        editModel: {
            saveKey: $.ui.keyCode.ENTER,
            select: true,
            keyUpDown: false,
            cellBorderWidth: 0,
            clicksToEdit: 1
        },
        colModel: [
            /*{
                title: "",
                minWidth: 50,
                align: "center",
                dataIndx: "View",
                isExport: false,
                editor: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    ////console.log(rowData);
                    return '<a id = "btnViewW75F2041" title="{{Helpers::getRS($g,"Xem")}}"><i class="glyphicon glyphicon-search text-yellow" style="font-size: 80%"></i></a>';
                },
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var rowData = ui.rowData;

                    //edit button
                    $cell.find("#btnViewW75F2041").bind("click", function (evt) {
                        //console.log(rowData);
                        //console.log(rowIndx);
                        rowIndex = rowIndx;
                        viewGrid2W75F2041(rowData);
                    });
                }
            },*/
            {
                title: "EmployeeID",
                minWidth: 170,
                dataType: "string",
                dataIndx: "EmployeeID",
                hidden: true,
                isExport: false
            },
            {
                title: "BenefitID",
                minWidth: 170,
                dataType: "string",
                dataIndx: "BenefitID",
                hidden: true,
                isExport: false
            },
            {
                title: "{{Helpers::getRS($g,"Ten_NV")}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "EmployeeName",
                editor: false,
                render: function (ui) {
                    return {
                        cls: "readonly-status"
                    };
                }
                //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Chinh_sach")}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "BenefitName",
                editor: false,
                render: function (ui) {
                    return {
                        cls: "readonly-status"
                    };
                }
                //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Tham_gia")}}",
                minWidth: 120,
                align: "center",
                dataIndx: "Participation",
                editor: false,
                type: 'checkbox',
                cb: {
                    all: false,
                    header: true,
                    check: "1",
                    uncheck: "0"
                },
                editable: true,
                render: function (ui) {
                    var row = ui.rowData,
                        checked = row["Participation"] == 1 ? 'checked' : ''
                    return {
                        text: "<label><input type='checkbox' " + checked + " /></label>",
                    };
                },
                postRender: function (ui) {
                    if (this.isEditableCell(ui) == true) {
                        var rowIndx = ui.rowIndx,
                            grid = this,
                            $cell = grid.getCell(ui);

                        $cell.find("label>input[type='checkbox']")
                            .unbind("click")
                            .bind("click", function (evt) {
                                gridW75F2041_1 = $("#gridW75F2041_1");
                                ui.rowData.IsUpdate = 1;
                                var obj = gridW75F2041_1.pqGrid("getEditCell");
                                var $editor = obj.$editor;
                                ////console.log($editor);
                                if ($editor === undefined) {
                                    var $tr = $(this).closest("tr"),
                                        rowIndx = gridW75F2041_1.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                    var rowData = gridW75F2041_1.pqGrid("getRowData", {rowIndx: rowIndx});
                                    if ($(this).is(":checked") == true) {
                                        rowData["NotParticipation"] = 0;
                                    }
                                    var isCheck = $(this).is(":checked") == true ? 1:0;
                                } else {
                                    evt.stopPropagation();
                                    evt.preventDefault();
                                }
                            });
                    }

                }
            },
            {
                title: "{{Helpers::getRS($g,"Khong_tham_gia")}}",
                minWidth: 120,
                align: "center",
                dataIndx: "NotParticipation",
                editor: false,
                type: 'checkbox',
                cb: {
                    all: false,
                    header: true,
                    check: "1",
                    uncheck: "0"
                },
                editable: true,
                render: function (ui) {
                    var row = ui.rowData,
                        checked = row["NotParticipation"] == 1 ? 'checked' : ''
                    return {
                        text: "<label><input type='checkbox' " + checked + " /></label>",
                    };
                },
                postRender: function (ui) {
                    if (this.isEditableCell(ui) == true) {
                        var rowIndx = ui.rowIndx,
                            grid = this,
                            $cell = grid.getCell(ui);

                        $cell.find("label>input[type='checkbox']")
                            .unbind("click")
                            .bind("click", function (evt) {
                                gridW75F2041_1 = $("#gridW75F2041_1");
                                ui.rowData.IsUpdate = 1;
                                var obj = gridW75F2041_1.pqGrid("getEditCell");
                                var $editor = obj.$editor;
                                ////console.log($editor);
                                if ($editor === undefined) {
                                    var $tr = $(this).closest("tr"),
                                        rowIndx = gridW75F2041_1.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                    var rowData = gridW75F2041_1.pqGrid("getRowData", {rowIndx: rowIndx});
                                    if ($(this).is(":checked") == true) {
                                        rowData["Participation"] = 0;
                                    }
                                } else {
                                    evt.stopPropagation();
                                    evt.preventDefault();
                                }
                            });
                    }

                }
            }

            @foreach($captionGrid1 as $row)
            , {
                title: "{{$row['caption']}}",
                minWidth: 100,
                align: "left",
                dataType: "string",
                //format: "{{--{{Helpers::getStringFormat(0)}}--}}",//returnSFormat(0),
                dataIndx: "{{$row['FieldName']}}",
                editable: true,
                editor: {
                    type: 'select',
                    valueIndx: "{{$row['FieldName']}}",
                    labelIndx: "{{$row['FieldName']}}",
                    mapIndices: {
                        "{{$row['FieldName']}}": "{{$row['FieldName']}}",
                        "{{$row['FieldName']}}": "{{$row['FieldName']}}"
                    },
                    options: {{json_encode($row["data"])}}
                },
                /* editable: function (ui) {
                     var rowData = ui.rowData;
                     return Number(rowData.Checked) == 0 ? true : false;
                 },*/
            }
            @endforeach
        ],
        dataModel: {
            data: {{$valueGrid1}}
        },
        cellSave: function (event, ui) {
            //console.log(ui);
            ui.rowData.IsUpdate = 1;
            //alert(ui.rowData.Participation);
            //$("#gridW75F2041_1").pqGrid("refreshDataAndView");
        },
        complete: function (event, ui) {
            ////console.log('complete grid 1');
            ////console.log(rowIndex);
            if ($("#gridW75F2041_1").pqGrid("option", "dataModel.data").length > 0) {
                //set selectchange
                $("#gridW75F2041_1").pqGrid( "setSelection", {rowIndx:0} );
                //viewGrid2W75F2041(rowData, rowData['Participation']);
            } else {
                $("#gridW75F2041_2").pqGrid("option", "dataModel.data", []);
                $("#gridW75F2041_2").pqGrid("refreshDataAndView");
            }
        },
        rowClick: function (event, ui) {
            var rowData = ui.rowData;
            viewGrid2W75F2041(rowData);
            setTimeout(function () {//set time out để rowClick chạy sau change
                console.log('rowClick');
                viewGrid2W75F2041(rowData);
            },8);
        },
        change: function (event, ui) {
            var rowData = ui.rowList[0].rowData;
            //console.log(ui.rowList[0]);
        },
        selectChange: function (event, ui) {
            ///load
            //console.log(ui);
            var rowIndx = getRowIndx($("#gridW75F2041_1"));
            var rowData = $("#gridW75F2041_1").pqGrid( "getRowData", {rowIndx: rowIndx} );
            //console.log(rowData);
            //viewGrid2W75F2041(rowData);
        }
    };

    var $gridW75F2041_1 = $("#gridW75F2041_1").pqGrid(obj);
    $gridW75F2041_1.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $gridW75F2041_1.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    setTimeout(function () {
        //$gridW75F2041_1.pqGrid("refreshDataAndView");
    }, 700)
    
    function viewGrid2W75F2041(rowData) {
        //console.log(isCheck);
        $.ajax({
            method: "POST",
            url: '{{url("/W75F2041/$pForm/$g/viewGrid2")}}',
            data: "&EmployeeID=" + rowData.EmployeeID + "&BenefitID=" + rowData.BenefitID + "&Participation=" + rowData.Participation + "&mode=" + {{$mode}},
            success: function (data) {
                ////console.log(data);
                $("#tb_gridW75F2041_2").html(data);
                //$("#tb_gridW75F2041_2").removeClass('hide');
            }
        });
    }
</script>