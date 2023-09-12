<div id="gridW75F3801_Course"></div>
<script type="text/javascript">
    var gRowIndxCourse = 0;
    var editMode = false;
    var primary_leftgrid = "";
    $(function () {
        var dataCourse = {{json_encode($dsCourse)}};
        var objCourse = {
            width: $("#divCourse").width(),
            height: $("#modalW75F3801").find(".modal-content").height() - 150,
            editable: false,
            freezeCols: 1,
            title: "<b>{{Helpers::getRS($g,'Khoa_dao_tao')}}</b>",
            minWidth: 30,
            filterModel: {on: true, mode: "AND", header: true},
            selectionModel: {type: 'row'},
            showTitle: true,
            wrap: false,
            hwrap: false,
            collapsible: false,
            postRenderInterval: -1,
            scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
            colModel: [
                {
                    title: "", editable: false, minWidth: 60, sortable: false, align: "center", render: function (ui) {
                    var row = ui.rowData;
                    var str = "";

                    if (row["IsUsed"] == 0) {
                        str += "<a title='{{Helpers::getRS($g,"Sua")}}' id='btnEditW38F3801'><i class='glyphicon glyphicon-edit' style='color:orange;padding-right:5px'></i></a> ";
                    } else {
                        str += "<a title='{{Helpers::getRS($g,"Sua")}}' id='btnEditW38F3801Disable'><i class='glyphicon glyphicon-edit' style='color:#ccc;padding-right:5px;cursor:default'></i></a> ";
                    }
                    if (row["IsUsed"] == 0) {
                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' id='btnDeleteW38F3801'><i class='fa fa-trash' ></i></a> ";
                    } else {
                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' id='btnDeleteW38F3801Disable'><i class='fa fa-trash' style='color:#ccc;cursor:default'></i></a> ";
                    }
                    return str;
                },
                    postRender: function (ui) {
                        //console.log("teest");
                        gRowIndxCourse = ui.rowIndx;
                        var rowIndx = ui.rowIndx,
                                gridW75F3801 = this,
                                $cell = gridW75F3801.getCell(ui);
                        $cell.find("a#btnEditW38F3801")
                                .unbind("click")
                                .bind("click", function (evt) {
                                    var grid = $("#gridW75F3801_Course")
                                    reLoadGridPurpose(rowIndx, grid,true);
                                    editMode = true;
                                    //enableEditGrid(true);
                                });
                        $cell.find("a#btnDeleteW38F3801")
                                .unbind("click")
                                .bind("click", function (evt) {
                                    var grid = $("#gridW75F3801_Course")
                                    deletePurpose(rowIndx, grid);
                                });
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Ma_khoa")}}",
                    minWidth: 50,
                    width: 80,
                    sortable: false,
                    dataType: "string",
                    dataIndx: "TrainingCourseID",
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ten_khoa")}}",
                    minWidth: 110,
                    width: 170,
                    dataType: "string",
                    dataIndx: "TrainingCourseName",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ket_qua")}}",
                    minWidth: 50,
                    width: 110,
                    align:"center",
                    dataType: "string",
                    dataIndx: "ResultName",
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    filter: {
                        type: 'select',
                        condition: 'equal',
                        prepend: {'': '---'},
                        valueIndx: "ResultName",
                        labelIndx: "ResultName",
                        listeners: ['change']
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Trang_thai")}}",
                    minWidth: 50,
                    width: 110,
                    align:"center",
                    dataType: "string",
                    dataIndx: "StatusName",
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    filter: {
                        type: 'select',
                        condition: 'equal',
                        prepend: {'': '---'},
                        valueIndx: "StatusName",
                        labelIndx: "StatusName",
                        listeners: ['change']
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Bat_dau")}}",
                    minWidth: 50,
                    width: 110,
                    dataType: "date",
                    align: "center",
                    dataIndx: "StartTime",
                    filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ket_thuc")}}",
                    minWidth: 50,
                    width: 110,
                    dataType: "date",
                    dataIndx: "EndTime",
                    align: "center",
                    filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                },
                {
                    title: "{{Helpers::getRS($g,"")}}",
                    minWidth: 10,
                    dataType: "string",
                    dataIndx: "VoucherID",
                    hidden: true

                },
                {
                    title: "",
                    minWidth: 10,
                    dataType: "string",
                    dataIndx: "PlanTransID",
                    hidden: true
                },
                {
                    title: "",
                    minWidth: 10,
                    dataType: "string",
                    dataIndx: "TransID",
                    hidden: true
                }

            ],
            dataModel: {
                data: dataCourse

            }/*
             //use refresh event to display jQueryUI buttons and bind events.
             refresh: function ( event, ui) {
             //debugger;
             gbGridW75F3801_Course = $(this);
             if (!gbGridW75F3801_Course) {
             return;
             }
             //edit button
             gbGridW75F3801_Course.find("a#btnEditW38F3801")
             .bind("click", function (evt) {
             if (!editMode) {
             var $tr = $(this).closest("tr");
             gRowIndxCourse = gbGridW75F3801_Course.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
             reLoadGridPurpose(gRowIndxCourse, gbGridW75F3801_Course,true);
             }
             });
             //delete button
             gbGridW75F3801_Course.find("a#btnDeleteW38F3801")
             .bind("click", function (evt) {
             if (!editMode) {
             var $tr = $(this).closest("tr");
             gRowIndxCourse = gbGridW75F3801_Course.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
             deletePurpose(gRowIndxCourse, gbGridW75F3801_Course);
             ////console.log("refresh");
             }

             });
             }*/,
            cellClick: function (event, ui) {
                gRowIndxCourse = ui.rowIndx;
                //console.log("rowSelect :" + gRowIndxCourse);
            },
            rowClick: function (event, ui) {
                if (editMode == false){
                    gRowIndxCourse = ui.rowIndx; //Dung trong truong hop can lay thong tin master de save
                    var rowIndx = ui.rowIndx;
                    var rowData = getRowSelection($("#gridW75F3801_Course"));// $("#gridW75F3801_Course").pqGrid("getRowData", {rowIndx: rowIndx});
                    if (primary_leftgrid == "" || primary_leftgrid != rowData['TrainingPlanID']) { //?ã load luoi phai roi thi khong load lai
                        primary_leftgrid = rowData['TrainingPlanID'];
                        reLoadGridPurpose(rowIndx, $("#gridW75F3801_Course"), false);
                        enableEditGrid(false);
                    }
                    //reLoadGridPurpose(rowIndx, $("#gridW75F3801_Course"), false);
                    //enableEditGrid(false);
                }else{
                    editMode == false;
                }

            },
            complete: function (event, ui){
                loadGridPurpose(0,$("#gridW75F3801_Course"),false);
                $("#gridW75F3801_Course").pqGrid( "setSelection", {rowIndx:0} );
            }


        };
        var $gridW75F3801_Course = $("#gridW75F3801_Course").pqGrid(objCourse);
        $gridW75F3801_Course.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW75F3801_Course.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridW75F3801_Course.pqGrid("refreshDataAndView");
        var column = $gridW75F3801_Course.pqGrid("getColumn", { dataIndx: "ResultName" });
        var filter = column.filter;
        filter.cache = null;
        filter.options = $gridW75F3801_Course.pqGrid("getData", { dataIndx: ["ResultName"] });

        column = $gridW75F3801_Course.pqGrid("getColumn", { dataIndx: "StatusName" });
        filter = column.filter;
        filter.cache = null;
        filter.options = $gridW75F3801_Course.pqGrid("getData", { dataIndx: ["StatusName"] });
        $gridW75F3801_Course.pqGrid("refreshDataAndView");
        //var numrow =gbGridW75F3801_Course.find('.pq-grid-row').length;
        //if (numrow > 0){
        //loadGridPurpose(0,gbGridW75F3801_Course,false);
        //$("#gbGridW75F3801_Course").pqGrid( "setSelection", {rowIndx:0} );
        //}else{

        //}

        //$("#gbGridW75F3801_Course").pqGrid( "setSelection", {rowIndx:0} );

    });

    function callbackNo(rowIndx) {
        loadGridPurpose(rowIndx, $("#gridW75F3801_Course"), false);
        enableEditGrid(false);
    }


    function deletePurpose(rowIndx, $grid) {
        ask_delete(function () {
            var rowData = $grid.pqGrid("getRowData", {rowIndx: rowIndx});
            var voucherID = rowData['VoucherID'];
            var planTransID = rowData['PlanTransID'];
            var transID = rowData['TransID'];
            var trainingCourseID = rowData['TrainingCourseID'];
            $.ajax({
                method: 'POST',
                url: '{{url("/W75F3801/$pForm/$g/delete")}}',
                data: {
                    voucherID: voucherID,
                    planTransID: planTransID,
                    transID: transID,
                    trainingCourseID: trainingCourseID
                },
                success: function (data) {
                    var result = $.parseJSON(data);
                    if (result.bSaveOK) {
                        delete_ok(function(){
                            var $grid = $("#gridW75F3801_Course");
                            $grid.pqGrid("deleteRow", {rowIndx: rowIndx});
                            if (rowIndx > 0){
                                loadGridPurpose(rowIndx - 1, $("#gridW75F3801_Course"), false);
                            }else{
                                $("#gridW75F3801_Purpose").pqGrid("option", "dataModel.data",{});
                            }
                        });

                    } else {
                        //alert_error()
                    }
                }
            });
        });
    }

    function enableEditGrid(bLock) {
        editMode = bLock;
        $("#gridW75F3801_Purpose").pqGrid("option", "editable", bLock);
        $("#gridW75F3801_Purpose").pqGrid("setSelection", {rowIndx: 0, colIndx: 0});
        //$("#gridW75F3801_Purpose").pqGrid("editFirstCellInRow", {rowIndx: 0});
        if (editMode) {
            $("#divControl").children().removeAttr("disabled");
            //$("#gbGridW75F3801_Course").children().attr("disabled","disabled");
            $("#gridW75F3801_Course").pqGrid("disable");
        }
        else {
            $("#divControl").children().attr("disabled", "disabled");
            //$("#gbGridW75F3801_Course").children().removeAttr("disabled");
            $("#gridW75F3801_Course").pqGrid("enable");
        }


        if (bLock)
            $("#btnEditW38F3801").children().attr("disabled", "");
        else
            $("#btnEditW38F3801").children().attr("disabled", "disabled");
    }

    function afterNotSave() {
        reLoadGridPurpose(gRowIndxCourse, $("#gridW75F3801_Course"), false);
    }
</script>
