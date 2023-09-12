<div class="row">
    <div class="col-md-12">

        <div id="gridListApproval">

        </div>
    </div>
</div>
<div class="mgt10 mgb5">

</div>
<script type="text/javascript">
    var grid;
    var enable = $("#slduyet").val() != 2;
    $(function () {
        if (enable){
            $("#btnSaveW15F2170").removeAttr("disabled").removeClass("hide");
        }else{
            $("#btnSaveW15F2170").attr("disabled","disabled");
        }
        console.log('format: {{Session::get("W91P0000")['D07_QuantityDecimals']}}');
        var dataListAproval = {{json_encode($rs)}};
        console.log($(window).height());
        /* var editable = true;
         if ($("#slduyet").val() != 0 && $("#slduyet").val() != 5) {
         editable = false;
         }*/
        var objListAproval = {
            height: 400,
            width: "100%", //$(".listDuyetW15").width(),
            //scrollModel: {autoFit: false, horizontal: true},
            //numberCell: { show: false },
            //bootstrap: { on : true },
            collapsible: false,
            showTitle: false,
            showBottom: false,
            wrap: true,
            freezeCols: 3,
            postRenderInterval: -1,
            //flexWidth: true,
            //resizable: true,
            //freezeCols:{ left:3, right:1 },
            //trackModel: { on: true }, //to turn on the track changes.
            selectionModel: { type: 'cell', mode: 'single' },
            //rowHeight: 100,
            scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none', },
            //rowHeight: 300,
            colModel: [
                {
                    title: "TransID",
                    align: "center",
                    dataType: "string",
                    editable: false,
                    dataIndx: "TransID",
                    hidden: true
                },{
                    title: "LeaveTypeID",
                    align: "center",
                    dataType: "string",
                    editable: false,
                    dataIndx: "LeaveTypeID",
                    hidden: true
                },
                {
                    title: '{{$statusApproval != "2" ? '<a id="Approval" onclick="headClick(this)">'.Helpers::getRS($g,"Duyet").'</a>': Helpers::getRS($g,"Duyet") }}',
                    dataIndx: "Approval",
                    minWidth: 90,
                    width: 90,
                    dataType:"float",
                    sortable: false,
                    align: "center",
                    type: 'checkbox',
                    cb: {
                        all: false,
                        header: true,
                        check: 1,
                        uncheck: 0
                    },
                    render: function (ui) {
                        //console.log(cellData = ui.cellData); //get value checkbox
                        var row = ui.rowData,
                                checked = Number(row["Approval"]) === 1 ? 'checked' : '',
                                disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            text: "<label><input type='checkbox' " + checked + " /></label>",
                            style: (disabled ? "background:lightgray" : "")
                        };
                    },
                    postRender: function (ui) {
                        console.log("postRender");
                        if (this.isEditableCell(ui) == true){
                            var rowIndx = ui.rowIndx,
                                    grid = this,
                                    $cell = grid.getCell(ui);

                            $cell.find("label>input[type='checkbox']")
                                    .unbind("click")
                                    .bind("click", function (evt) {
                                        $gridListApproval = $("#gridListApproval")
                                        var $tr = $(this).closest("tr"),
                                                rowIndx = $gridListApproval.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                        var rowData = $gridListApproval.pqGrid("getRowData", {rowIndx: rowIndx});
                                        if ($(this).is(":checked") == true){
                                            rowData["NotApproval"] = 0;
                                        }
                                    });
                        }

                    },
                    editor: false,
                    editable: function (ui) {
                        return $("#slduyet").val() != 2;
                    }
                },
                {
                    title: '{{$statusApproval != "2" ? '<a id="NotApproval" onclick="headClick(this)">'.Helpers::getRS($g,"Khong_duyet").'</a>': Helpers::getRS($g,"Khong_duyet") }}',
                    dataIndx: "NotApproval",
                    width: 90,
                    minWidth: 90,
                    dataType:"float",
                    sortable: false,
                    align: "center",
                    type: 'checkbox',
                    cb: {
                        all: false,
                        header: true,
                        check: 1,
                        uncheck: 0
                    },
                    render: function (ui) {
                        var row = ui.rowData,
                                checked = Number(row["NotApproval"]) === 1 ? 'checked' : '',
                                disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            text: "<label><input type='checkbox' " + checked + " /></label>",
                            style: (disabled ? "background:lightgray" : "")
                        };
                    },
                    postRender: function (ui) {
                        if (this.isEditableCell(ui) == true){
                            var rowIndx = ui.rowIndx,
                                    grid = this,
                                    $cell = grid.getCell(ui);
                            $cell.find("label>input[type='checkbox']")
                                    .unbind("click")
                                    .bind("click", function (evt) {
                                        $gridListApproval = $("#gridListApproval")
                                        var $tr = $(this).closest("tr"),
                                                rowIndx = $gridListApproval.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                        var rowData = $gridListApproval.pqGrid("getRowData", {rowIndx: rowIndx});
                                        if ($(this).is(":checked") == true){
                                            rowData["Approval"] = 0;
                                        }
                                    });
                        }

                    },
                    editor: false,
                    editable: function (ui) {
                        return $("#slduyet").val() != 2;
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Nghi_tu")}}",
                    minWidth: 80,
                    width: 80,
                    align: "center",
                    dataType: "string",
                    editable: false,
                    dataIndx: "LeaveDateFrom",
                    render: function (ui) {
                        var disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            style: (disabled ? "background:lightgray" : "")
                        };
                    },
                },
                {
                    title: "{{Helpers::getRS($g,"Nghi_den")}}",
                    minWidth: 80,
                    width: 80,
                    align: "center",
                    dataType: "string",
                    editable: false,
                    dataIndx: "LeaveDateTo",
                    render: function (ui) {
                        var disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            style: (disabled ? "background:lightgray" : "")
                        };
                    },
                },
                {
                    title: "{{Helpers::getRS($g,"So_luong")}}",
                    minWidth: 80,
                    width: 80,
                    dataType: "float",
                    dataIndx: "Quantity",
                    editable: false,
                    align: "right",
                    format: '{{\Helpers::getStringFormat($decimals)}}',
                    render: function (ui) {
                        var rowData = ui.rowData;
                        var disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            //text: format2(rowData["Quantity"], '', {{$decimals}}),
                            style: (disabled ? "background:lightgray" : "")
                        }
                    },
                },
                {
                    title: "",
                    align: "center",
                    dataType: "string",
                    editable: false,
                    dataIndx: "LeaveTypeID",
                    hidden: true
                },
                {
                    title: "{{Helpers::getRS($g,"Loai_phep")}}",
                    minWidth: 170,
                    Width: 230,
                    align: "left",
                    dataType: "string",
                    editable: false,
                    dataIndx: "LeaveTypeName",
                    render: function (ui) {
                        var disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            style: (disabled ? "background:lightgray" : "")
                        };
                    },
                },
                {
                    title: "{{Helpers::getRS($g,"Ly_do_nghi_phep")}}",
                    minWidth: 170,
                    width: 400,
                    align: "left",
                    dataType: "string",
                    editable: false,
                    dataIndx: "Reason",
                    render: function (ui) {
                        var disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            style: (disabled ? "background:lightgray" : "")
                        };
                    },
                },
                {
                    title: "{{Helpers::getRS($g,"Ghi_chu")}}",
                    minWidth: 170,
                    width: 400,
                    maxWidth: 400,
                    align: "left",
                    dataType: "string",
                    editable: false,
                    dataIndx: "Note",
                    render: function (ui) {
                        var disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            style: (disabled ? "background:lightgray" : "")
                        };
                    },
                },
                {
                    title: "{{Helpers::getRS($g,"Ghi_chu_cap_duyet")}}",
                    minWidth: 170,
                    width: 400,
                    maxWidth: 400,
                    align: "left",
                    dataType: "string",
                    editable: $("#slduyet").val() != 2,
                    dataIndx: "NoteApp",
                    editor: {type: 'textbox'},
                    render: function (ui) {
                        //console.log(cellData = ui.cellData); //get value checkbox
                        var row = ui.rowData,
                                disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            style: (disabled ? "background:lightgray" : "")
                        };
                    },
                    editable: function (ui) {
                        return $("#slduyet").val() != 2;
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Thong_tin_cong_tac")}}",
                    minWidth: 100,
                    dataType: "string",
                    dataIndx: "BusinessInfomation",
                    align: "center",
                    editor: false,
                    render: function (ui) {
                        var rowData = ui.rowData;
                        var disabled = (rowData['LeaveID'] == 'L090') ? "" : "disabled";
                        return {
                            text: "<a class='fa fa-info text-blue' id = 'btnViewBusinessW15F2170' style='margin-top:2px; font-size: 115%'></a>",
                            cls: (disabled ? "readonly-status" : "")
                        };
                    },
                    postRender: function (ui) {
                        var grid = this, $cell = grid.getCell(ui);
                        var rowData = ui.rowData;
                        //downLoad
                        if(rowData['LeaveID'] == 'L090'){
                            $cell.find("a#btnViewBusinessW15F2170").unbind("click").bind("click", function (evt) {
                                // console.log(ui.rowData.CandidateID);
                                //alert("ab");
                                showFormDialogPost('{{url("/W75F1066/W15F2170/4/")}}', "modalW75F1066",
                                    {
                                         action: "approved",
                                         LinkTransIDW75F1065: rowData['LinkTransID'],
                                         TransID1065to1066: rowData['TransID'],
                                    },2);
                            });
                        }
                    }
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                }
            ],
            dataModel: {
                data: dataListAproval
            },
            editModel: {
                saveKey: $.ui.keyCode.ENTER,
                select: true,
                keyUpDown: false,
                cellBorderWidth: 0,
                onBlur: "save",
                clicksToEdit: 1
            },
            editorKeyDown: function (event, ui) {
                var obj = $("#gridListApproval").pqGrid("option", "dataModel.data");
                // key (esc) - back to the first cell
                var soel = $("#gridListApproval");
                if (event.keyCode == 27) {
                    soel.pqGrid("setSelection", {rowIndx: ui.rowIndx, colIndx: ui.colIndx});
                    event.stopPropagation();
                    event.preventDefault();
                }
                if (event.keyCode == 13 || event.keyCode == 9) {
                    console.log('test');
                    if (ui.dataIndx == "NoteApp") {
                        soel.pqGrid("saveEditCell");
                        soel.pqGrid("quitEditMode");
                        if (ui.rowIndx < obj.length-1)
                            soel.pqGrid("setSelection", {rowIndx: ui.rowIndx + 1, colIndx: ui.colIndx});
                        else
                            soel.pqGrid("setSelection", {rowIndx: 0, colIndx: ui.colIndx});
                    }
                    event.stopPropagation();
                    event.preventDefault();
                }

                //key (delete) - to delete cell
                if (event.keyCode == 46) {
                    $(ui.$cell[0]).find("input").val('');
                }
            }
            /*cellKeyDown: function (event, ui) {
                console.log("cellKeyDown");
                var obj = $("#gridListApproval").pqGrid("option", "dataModel.data");
                var soel = $("#gridListApproval");
                if (event.keyCode == 13 || event.keyCode == 9) {
                    console.log('test');
                    if (ui.dataIndx == "Approval") {
                        var colIndx = soel.pqGrid( "getColIndx", { dataIndx: "NotApproval" } );
                        soel.pqGrid("setSelection", {rowIndx: ui.rowIndx, colIndx: colIndx});
                    }
                    if (ui.dataIndx == "NotApproval") {
                        var colIndx = soel.pqGrid( "getColIndx", { dataIndx: "NoteApp" } );
                        soel.pqGrid("setSelection", {rowIndx: ui.rowIndx, colIndx: colIndx});
                    }
                    event.stopPropagation();
                    event.preventDefault();
                }
            },*/
        };
        grid = $("#gridListApproval").pqGrid(objListAproval);

        setTimeout(function(){
            grid.pqGrid( {rowHeight: 300} );
        }, 1000);

        //setBackgroundColor();



    });

    function setNextFocus(grid){
        var colModel = grid.option( "colModel" );
        for (var i =0; i<colModel.length;i++){
            console.log(colModel[i].editable);
        }
    }

/*    function allApproval(el){
        var obj = $("#gridListApproval").pqGrid("option", "dataModel.data");
        if ($(el).is(":checked")){
            for (var i = 0; i < obj.length; i++){
                obj[i]["NotApproval"] = "0";
                console.log(obj[i]["NotApproval"]);
            }
        }
        console.log(obj);
        $("#gridListApproval").pqGrid("option", "dataModel.data",obj);
        //$("#gridListApproval").pqGrid("refreshDataAndView");
    }
    function allNotApproval(el){
        var obj = $("#gridListApproval").pqGrid("option", "dataModel.data");
        if ($(el).is(":checked")){
            for (var i = 0; i < obj.length; i++){
                obj[i]["Approval"] = "0";
            }
        }
        console.log(obj);
        $("#gridListApproval").pqGrid("option", "dataModel.data",obj);
        //$("#gridListApproval").pqGrid("refreshDataAndView");
    }*/

    function checkHeadClick(obj, key){
        var rs = $.grep(obj, function (data, index) {
                return data[key] == 1;
            });
        return rs.length == obj.length ? true: false;
    }

    function headClick(el){
        if (enable){
            $grid = $("#gridListApproval");
                    $grid.pqGrid("quitEditMode");
                    var obj = $grid.pqGrid("option", "dataModel.data");
                    if (obj.length >0){
                        var key = $(el).attr('id');
                        var isHeadClick = checkHeadClick(obj,key); //Kiem tra cột hiện tại có headclick chưa, nếu rồi return true;
                        setValueHeadClick($("#gridListApproval"), key, !isHeadClick);
                    }

        }
    }

    function setValueHeadClick($grid, currentKey , check){
        var relative = 'NotApproval';
        if (currentKey == "Approval")
            relative = "NotApproval";
        if (currentKey == "NotApproval")
            relative = "Approval";
        var checkNum = (check == true ? 1:0); //checkNum == 1 có nghĩa là đang cần thực hiện headclick
        var obj = $grid.pqGrid("option", "dataModel.data");
        if (obj.length > 0){
            for (var i=0;i<obj.length;i++){
                obj[i][currentKey] = checkNum;
                if (checkNum == 1 && obj[i][relative] == 1){
                    obj[i][relative] = 0;
                }
                //obj[i]["IsUpdate"] = 1;
            }
            $grid.pqGrid("option", "dataModel.data", obj);
            $grid.pqGrid("refreshDataAndView");
        }

    }

</script>