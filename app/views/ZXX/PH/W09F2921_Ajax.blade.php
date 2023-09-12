<div id="gridW09F2921"></div>
<style>
    div.pq-grid tr td.disabled {
        text-shadow: 0 1px 0 #fff;
        background: #e0e0e0;
    }

    tr td.beige {
        background: #e0e0e0;
    }

    .ui-button-text {
        /* padding: .4em 1em .4em 2.1em; */
        padding-left: 5px;
        padding-right: 5px;
    }
</style>
<script type="text/javascript">
    $(function () {
        function filter(arr, criteria) {
            return arr.filter(function (obj) {
                return Object.keys(criteria).every(function (c) {
                    return obj[c] == criteria[c];
                });
            });
        }

        function disableTextRenderer(ui) {
            var //grid = $(this).pqGrid('getInstance').grid,
                    grid = this,
                    rowData = ui.rowData,
                    rowIndx = ui.rowIndx,
                    dataIndx = ui.dataIndx;

            if (grid.isEditableCell({rowIndx: rowIndx, dataIndx: dataIndx}) == false) {
                //if (grid.pqGrid( "isEditableCell", { rowIndx: rowIndx, dataIndx: dataIndx } ) == false) {
                //inject disabled class into read only cells.
                grid.addClass({rowIndx: rowIndx, dataIndx: dataIndx, cls: 'disabled'});
            }
            else {
                grid.removeClass({rowIndx: rowIndx, dataIndx: dataIndx, cls: 'disabled'});
            }
        };

        function isEditing(grid) {
            var rows = grid.getRowsByClass({cls: 'pq-row-edit'});
            if (rows.length > 0) {
                var rowIndx = rows[0].rowIndx;
                grid.goToPage({rowIndx: rowIndx});
                //focus on editor if any
                grid.editFirstCellInRow({rowIndx: rowIndx});
                return true;
            }
            return false;
        }

        var ajaxObj = {
            dataType: "JSON",
            beforeSend: function () {
                //this.showLoading();
            },
            complete: function () {
                //this.hideLoading();
            },
            error: function () {
                //this.rollback();
            }
        };

        //called by delete button.
        function deleteRow(rowIndx, grid) {
            grid.addClass({rowIndx: rowIndx, cls: 'pq-row-delete'});
            ask_delete(function () {
                //get reference to 3rd row on current page.
                //var rowData = $( ".selector" ).pqGrid( "getRowData", {rowIndxPage: 2} );
                //console.log("update");
                var rowData = grid.getRowData({rowIndx: rowIndx});
                $.ajax($.extend({}, ajaxObj, {
                    context: grid,
                    url: "W09F2921/{{$pForm}}/{{$g}}/deleterow",
                    data: rowData,
                    success: function (data) {
                        if (data == "1") {
                            delete_ok();
                            $("#gridW09F2921").pqGrid("deleteRow", {rowIndx: rowIndx});
                            $("#gridW09F2921").pqGrid('refreshDataAndView');
                        } else {
                            alert_error("Delete not okay");
                        }
                    }
                }));
            });
        }

        //called by delete button.
        function approveRow(rowIndx, grid) {
            alert_custom(icon_ask, "{{Helpers::getRS($g,"Ban_co_muon_duyet_khong")}}", true, true, function () {
                var rowData = grid.getRowData({rowIndx: rowIndx});
                $.ajax($.extend({}, ajaxObj, {
                    context: grid,
                    url: "W09F2921/{{$pForm}}/{{$g}}/approverow",
                    data: rowData,
                    success: function (data) {
                        if (data == "1") {
                            //alert_info("Dữ liệu đã duyệt thành công");
                            save_ok();
                            ////console.log("Duyệt");
                            //reloadGridW09F2921();
                            $.ajax({
                                method: "POST",
                                url: "W09F2921/{{$pForm}}/{{$g}}/reloadgrid",
                                data: $("#frmW09F2921").serialize(),
                                success: function (data) {
                                    $(".l3loading").addClass('hide');
                                    //console.log(data);

                                    var result = $.parseJSON(data);
                                    $("#gridW09F2921").pqGrid("option", "dataModel", {data: result.dataW09F2921});
                                    $("#gridW09F2921").pqGrid("refreshDataAndView");
                                }
                            });

                        } else {
                            alert_error("Approve not okay");
                        }
                    }
                }));
            });
        }

        //called by delete button.
        function approvedAll(grid) {
            alert_custom(icon_ask, "{{Helpers::getRS($g,"Ban_co_muon_duyet_khong")}}", true, true, function () {
                var data = grid.pqGrid("option", "dataModel.data");
                //console.log(data);

                $.ajax({
                    method: "POST",
                    url: "W09F2921/{{$pForm}}/{{$g}}/approveall",
                    data: {data: JSON.stringify(data)},
                    success: function (data) {
                        if (data == "1") {
                            //alert_info("Tất cả dữ liệu đã duyệt thành công");
                            save_ok();
                            //console.log("Duyệt");
                            //reloadGridW09F2921();
                            $.ajax({
                                method: "POST",
                                url: "W09F2921/{{$pForm}}/{{$g}}/reloadgrid",
                                data: $("#frmW09F2921").serialize(),
                                success: function (data) {
                                    $(".l3loading").addClass('hide');
                                    //console.log(data);

                                    var result = $.parseJSON(data);
                                    $("#gridW09F2921").pqGrid("option", "dataModel", {data: result.dataW09F2921});
                                    $("#gridW09F2921").pqGrid("refreshDataAndView");
                                }
                            });

                        } else {
                            alert_error("Approve not okay");
                        }
                    }
                });
            });
        }

        function unApproveRow(rowIndx, grid) {
            alert_custom(icon_ask, "{{Helpers::getRS($g,"Ban_co_muon_bo_duyet_khong")}}", true, true, function () {
                var rowData = grid.getRowData({rowIndx: rowIndx});
                $.ajax($.extend({}, ajaxObj, {
                    context: grid,
                    url: "W09F2921/{{$pForm}}/{{$g}}/unapproverow",
                    data: rowData,
                    success: function (data) {
                        if (data == "1") {
                            //alert_info("Dữ liệu đã bỏ duyệt thành công");
                            save_ok();
                            //console.log("Duyệt");
                            //reloadGridW09F2921();
                            $.ajax({
                                method: "POST",
                                url: "W09F2921/{{$pForm}}/{{$g}}/reloadgrid",
                                data: $("#frmW09F2921").serialize(),
                                success: function (data) {
                                    $(".l3loading").addClass('hide');
                                    //console.log(data);

                                    var result = $.parseJSON(data);
                                    $("#gridW09F2921").pqGrid("option", "dataModel", {data: result.dataW09F2921});
                                    $("#gridW09F2921").pqGrid("refreshDataAndView");
                                }
                            });

                        } else {
                            alert_error("Unapprove not okay");
                        }
                    }
                }));
            });
        }

        //called by edit button.
        function editRow(rowIndx, grid, edit) {

            grid.addClass({rowIndx: rowIndx, cls: 'pq-row-edit'});

            if (edit) grid.editFirstCellInRow({rowIndx: rowIndx});

            //change edit button to update button and delete to cancel.
            var $tr = grid.getRow({rowIndx: rowIndx}),
                    $btnSave = $tr.find("a#btnEditW09F2921>i"),
                    $btnCancel = $tr.find("a#btnDeleteW09F2921>i"),
                    $btnApprove = $tr.find("a#btnApproveW09F2921>i");

            $btnSave.removeClass("fa fa-pencil-square-o");
            $btnSave.addClass("fa fa-floppy-o");
            $btnSave.css("font-size", "13px");
            $btnSave.css("color", "#216889");
            $btnSave.css("padding-right", "8px");
            $btnSave.attr("title", "{{Helpers::getRS($g,"Luu")}}");

            $btnCancel.removeClass("fa fa-trash-o");
            $btnCancel.addClass("fa fa-ban");
            $btnCancel.css("font-size", "13px");
            $btnCancel.css("color", "#822a2a");
            $btnCancel.attr("title", "{{Helpers::getRS($g,"Khong_luu")}}");
            $btnApprove.hide();

            $btnSave.unbind("click")
                    .click(function (evt) {
                        //evt.preventDefault();
                        return update(rowIndx, grid);
                    });
            $btnCancel.unbind("click")
                    .click(function (evt) {
                        ////console.log("go here");
                        grid.quitEditMode();
                        grid.removeClass({rowIndx: rowIndx, cls: 'pq-row-edit'})
                        grid.rollback();
                    });
        }

        //called by update button.
        function update(rowIndx, grid) {
            //console.log("update");
            var rowData = grid.getRowData({rowIndx: rowIndx});

            /*          $.ajax({
             method: "POST",
             url: "W09F2921/
            {{$pForm}}/
            {{$g}}/saverow",
             data: rowData,
             success: function (data) {
             if (data == "1"){
             save_ok();
             grid.commit({ type: "update", rows: [rowData] });
             grid.refreshRow({ rowIndx: rowIndx });
             }else{
             save_not_ok();
             }

             }
             });*/

            $.ajax($.extend({}, ajaxObj, {
                context: grid,
                url: "W09F2921/{{$pForm}}/{{$g}}/saverow",
                data: rowData,
                success: function (data) {
                    if (data == "1") {
                        save_ok();
                        grid.commit({type: "update", rows: [rowData]});
                        grid.refreshRow({rowIndx: rowIndx});
                        grid.quitEditMode();
                        grid.removeClass({rowIndx: rowIndx, cls: 'pq-row-edit'});
                        grid.refreshRow({rowIndx: rowIndx});
                    } else {
                        save_not_ok();
                    }
                }
            }));
        }

        var gbDropDownTop = 0;
        var gbDropDownLeft = 0;
        var gbDataIndx = "";
        var gbColIndx = 0;

        var dataW09F2921 = {};
        objW09F2921 = {
            width: $("#modalW09F2921").find(".modal-body").width(),
            height: $(document).height() - 210,
            editable: true,
            dataType: "JSON",
            minWidth: 30,
            freezeCols: 1,
            selectionModel: {type: 'cell'},
            editor: {type: 'textbox', select: true, style: 'outline:none;'},
            scrollModel: {autoFit: true},
            showTitle: false,
            wrap: false,
            hwrap: false,
            collapsible: false,
            postRenderInterval: -1,
            trackModel: {on: true},
            toolbar: {
                items: [
                    {
                        type: 'button',
                        icon: '',
                        label: '{{Helpers::getRS($g,"Xuat_Excel_U")}}',
                        listener: function () {
                            $gridW09F2921 = this;
                            W09F2921ExportExcel();
                        }
                    }
                    @if (Session::get($pForm) >= 3)
                    , {
                        type: 'button',
                        icon: '',
                        label: '{{Helpers::getRS($g,"Duyet_tat_ca")}}',
                        listener: function () {
                            $gridW09F2921 = $("#gridW09F2921");
                            approvedAll($gridW09F2921);
                        }
                    }
                    @endif
        ]
            },
            colModel: [
                {
                    title: "", editable: false, minWidth: 62, sortable: false, isExport: false,
                    render: function (ui) {
                        var str = "";
                        var per = Number("{{Session::get($pForm)}}");
                        var rowData = ui.rowData;
                        //if (per > 2)
                        if (per >= 3 && rowData["IsApproved"] == 0) {
                            str += "<a title='{{Helpers::getRS($g,"Sua")}}' onclick='' id='btnEditW09F2921'><i class='fa fa-pencil-square-o' style='color:orange;padding-right:5px'></i></a>";
                        }else{
                            str += "<a title='{{Helpers::getRS($g,"Sua")}}' onclick='' id='btnEditW09F2921_Disable'><i class='fa fa-pencil-square-o' style='color:#ccc;padding-right:5px;cursor: default'></i></a>";
                        }

                        if (per >= 4) {
                            str += "<a title='{{Helpers::getRS($g,"Xoa")}}'  style='padding-right:5px;' id='btnDeleteW09F2921'><i class='fa fa-trash-o'></i></a> ";
                        }else{
                            str += "<a title='{{Helpers::getRS($g,"Xoa")}}'  style='padding-right:5px;' id='btnDeleteW09F2921_Disable'><i class='fa fa-trash-o' style='color:#ccc;cursor: default'></i></a> ";
                        }
                        if (per >= 3 && Number(rowData["IsApproved"]) == 0) {
                            str += "<a title='{{Helpers::getRS($g,"Duyet")}}' style='color:#215272;' id='btnApproveW09F2921'><i class='fa fa-square-o'></i></a> ";
                        }else if (Number(rowData["IsApproved"]) == 0){
                            str += "<a title='{{Helpers::getRS($g,"Duyet")}}' style='color:#215272;' id='btnApproveW09F2921'><i class='fa fa-square-o' style='color:#ccc;cursor: default'></i></a> ";
                        }

                        if (per >= 3 && Number(rowData["IsApproved"]) == 1) {
                            str += "<a title='{{Helpers::getRS($g,"Bo_duyet")}}' style='color:#215272;' id='btnApproveW09F2921'><i class='fa fa-check-square-o'></i></a> ";
                        }else if (Number(rowData["IsApproved"]) == 1){
                            str += "<a title='{{Helpers::getRS($g,"Bo_duyet")}}' style='color:#215272;' id='btnApproveW09F2921'><i class='fa fa-check-square-o' style='color:#ccc;cursor: default'></i></a> ";
                        }


                        //str += " <i class='fa fa-lock text-red' style='font-size: 110%;'></i> ";
                        return str;
                    },
                    postRender: function (ui) {
                        var rowIndx = ui.rowIndx,
                                $gridW09F2921 = this,
                                $cell = $gridW09F2921.getCell(ui);

                        if ($cell.find("a#btnEditW09F2921>i").attr("class") == "fa fa-pencil-square-o") {
                            $cell.find("a#btnEditW09F2921>i")
                                    .unbind("click")
                                    .bind("click", function (evt) {
                                        if (isEditing($gridW09F2921)) {
                                            return false;
                                        }
                                        editRow(rowIndx, $gridW09F2921, true);
                                    });
                        }

                        if ($cell.find("a#btnDeleteW09F2921>i").attr("class") == "fa fa-trash-o") {
                            $cell.find("a#btnDeleteW09F2921>i")
                                    .bind("click", function (evt) {
                                        deleteRow(rowIndx, $gridW09F2921);
                                    });
                        }

                        if ($cell.find("a#btnApproveW09F2921>i").attr("class") == "fa fa-square-o") {
                            $cell.find("a#btnApproveW09F2921>i")
                                    .bind("click", function (evt) {
                                        approveRow(rowIndx, $gridW09F2921);
                                    });
                        }

                        if ($cell.find("a#btnApproveW09F2921>i").attr("class") == "fa fa-check-square-o") {
                            $cell.find("a#btnApproveW09F2921>i")
                                    .bind("click", function (evt) {
                                        unApproveRow(rowIndx, $gridW09F2921);
                                    });
                        }

                        //if it has edit class, then edit the row.
                        if ($gridW09F2921.hasClass({rowData: ui.rowData, cls: 'pq-row-edit'})) {
                            editRow(rowIndx, $gridW09F2921);
                        }
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Ma")}}",
                    dataIndx: "EmployeeID",
                    minWidth: 140,
                    //editor: {select: true},
                    //showGrid: true,
                    editable: false,
                    render: disableTextRenderer
                },
                {
                    title: "{{Helpers::getRS($g,"Ho_va_ten")}}",
                    dataIndx: "EmployeeName",
                    minWidth: 205,
                    //editor: {select: true},
                    //showGrid: true,
                    editable: false,
                    render: disableTextRenderer
                },
                {
                    title: "{{Helpers::getRS($g,"Ngay_lam_viec")}}",
                    dataIndx: "AttendanceDate",
                    align: "center",
                    minWidth: 110,
                    //editor: {select: true},
                    //showGrid: true,
                    editable: false,
                    render: disableTextRenderer
                },
                {
                    title: "{{Helpers::getRS($g,"Du_an")}}",
                    dataIndx: "ProjectName",
                    minWidth: 170,
                    //editor: {select: true},
                    //showGrid: true,
                    editable: false,
                    render: disableTextRenderer
                },

                {
                    title: "{{Helpers::getRS($g,"Cong_viec")}}",
                    dataIndx: "WorkName",
                    minWidth: 170,
                    editor: {type: 'textbox'},
                    editable: false,
                    //showGrid: true,
                    //hidden: true
                    render: disableTextRenderer
                },
                {
                    title: "{{Helpers::getRS($g,"Ghi_chu")}}",
                    dataIndx: "Note",
                    minWidth: 170,
                    editor: {type: 'textbox'},
                    editable: false,
                    //showGrid: true,
                    //hidden: true
                    render: disableTextRenderer
                },
                {
                    title: "{{Helpers::getRS($g,"So_gio")}}",
                    dataIndx: "NormalHours",
                    dataType: "float",
                    format: "#,##0.00",
                    align: "right",
                    minWidth: 110,
                    editor: {select: true}
                    //showGrid: true,
                    //hidden: true
                },
                {
                    title: "{{Helpers::getRS($g,"Chuc_vu")}}",
                    dataIndx: "DutyID",
                    dataType: "string",
                    //align: "right",
                    minWidth: 170,
                    editor: {select: true},
                    showGrid: true,
                    //hidden: true
                },
                {
                    title: "{{Helpers::getRS($g,"Don_gia")}}",
                    dataIndx: "NNormalHours",
                    format: "#,##0.00",
                    dataType: "float",
                    align: "right",
                    minWidth: 110,
                    editor: {select: true},
                    //editable: false,
                    //showGrid: true,
                    //hidden: true
                    //render: disableTextRenderer
                    //showGrid: true,
                    //hidden: true
                },
                {
                    title: "{{Helpers::getRS($g,"Thanh_tien")}}",
                    dataIndx: "NormalAmount",
                    format: "#,##0.00",
                    dataType: "float",
                    align: "right",
                    minWidth: 110,
                    editor: {select: true},
                    formula: function (ui) {
                        var rd = ui.rowData;
                        var NormalHours = rd.NormalHours == null ? "0" : rd.NormalHours.toString().replace(/,/g, "");
                        var NNormalHours = rd.NNormalHours == null ? "0" : rd.NNormalHours.toString().replace(/,/g, "");
                        //////console.log(mon +  tue + wed + thu + fri + sat + sun);
                        return Number(NormalHours) * Number(NNormalHours);
                    },
                    editable: false,
                    render: disableTextRenderer
                    //showGrid: true,
                    //hidden: true
                },
                {
                    title: "EmployeeID",
                    dataIndx: "EmployeeID",
                    minWidth: 170,
                    //editor: {select: true},
                    //showGrid: true,
                    editable: false,
                    hidden: true,
                    render: disableTextRenderer,
                    isExport: false
                },
                {
                    title: "{{Helpers::getRS($g,"Phong_ban")}}",
                    dataIndx: "DepartmentName",
                    minWidth: 170,
                    //editor: {select: true},
                    //showGrid: true,
                    editable: false,
                    render: disableTextRenderer
                },
                {
                    title: "{{Helpers::getRS($g,"Nguoi_quan_ly_truc_tiep")}}",
                    dataIndx: "DirectManagerName",
                    minWidth: 170,
                    //editor: {select: true},
                    //showGrid: true,
                    editable: false,
                    render: disableTextRenderer
                },
                {
                    title: "IsApproved",
                    dataIndx: "IsApproved",
                    minWidth: 140,
                    //editor: {select: true},
                    //showGrid: true,
                    editable: false,
                    hidden: true,
                    render: disableTextRenderer,
                    isExport: false
                }

            ],
            dataModel: {
                data: dataW09F2921

            },
            editable: function (ui) {
                return this.hasClass({rowIndx: ui.rowIndx, cls: 'pq-row-edit'});
            },
            editModel: {
                saveKey: $.ui.keyCode.ENTER,
                select: true,
                keyUpDown: false,
                cellBorderWidth: 0,
                onBlur: "save",
                clicksToEdit: 1
            },
            cellBeforeSave: function (event, ui) {
                ////console.log("cellBeforeSave");
            },
            editorBegin: function (event, ui) {
                ////console.log("editorBegin");

            },
            editorFocus: function (event, ui) {
                ////console.log("editorFocus");
                gbDropDownTop = Number(ui.$cell.offset().top);
                gbDropDownLeft = Number(ui.$cell.offset().left);
                gbDataIndx = ui.dataIndx;
                ui.colIndx = ui.colIndx;
            },
            cellKeyDown: function (event, ui) {
                /* ////console.log("cellKeyDown");
                 if (event.keyCode == 27) {
                 //console.log("test");
                 var $gridW09F2921 = $("#gridW09F2921");
                 $gridW09F2921.pqGrid("setSelection", {rowIndx: gbRowidx, colIndx: ui.colIndx});
                 }*/

            },
            change: function (event, ui) {
                ////console.log("change");
                $gridW09F2921 = $("#gridW09F2921");
                $gridW09F2921.pqGrid("refreshDataAndView");
            },
            editorKeyUp: function (event, ui) {
                ////console.log("editorKeyUp");
            },

            editorKeyDown: function (event, ui) {
                var $gridW09F2921 = $("#gridW09F2921");
                //console.log("cellEditKeyDown");
                var obj = $("#gridW09F2921").pqGrid("option", "dataModel.data");
                if (event.keyCode == 27) {
                    //console.log("cellEditKeyDown");
                    //$gridW09F2921.pqGrid("refresh");
                    $("#divDropDown").css("display", "none");
                    $gridW09F2921.pqGrid("setSelection", {rowIndx: ui.rowIndx, colIndx: ui.colIndx});
                    event.preventDefault()
                }


                if ((event.keyCode == 13 || event.keyCode == 9) && !ui.column.showGrid) {
                    $gridW09F2921.pqGrid('refreshDataAndView');
                }

                //Truong hop enter va co show grid con
                if (event.keyCode == 13 && ui.column.showGrid) {
                    //event.stopPropagation();
                    //event.preventDefault();
                    //////console.log("Show Grid");
                    $("#divDropDown").css("display", "block");
                    gbRowidx = ui.rowIndx;
                    ////console.log("getPosition");
                    var sTr = $(ui.$cell[0]).find("input,select").val();//ui.$cell[0].textContent;
                    var $td = $gridW09F2921.pqGrid("getCell", {rowIndx: ui.rowIndx, colIndx: ui.colIndx});
                    var top = ui.$cell.offset().top;
                    var left = ui.$cell.offset().left;// parseInt($(ui.$cell[0]).offset().left);
                    if (ui.colIndx == $gridW09F2921.pqGrid("getColIndx", {dataIndx: "DutyID"})) {
                        //$(".l3loading").removeClass('hide');
                        var dataTemp;
                        /*if (sTr != "") {
                            dataTemp = filter($dataDutyID,
                                    {
                                        //ProjectID: sTr,
                                        DutyID: sTr
                                    });
                        } else {
                            dataTemp = $dataDutyID;
                        }

                        var el = $("#gridDutytID");
                        el.pqGrid("option", "height", 200);
                        $gridW09F2921.pqGrid("setSelection", {rowIndx: ui.rowIndx, colIndx: ui.colIndx});
                        $("#pgridDutytID").css({
                            "top": gbDropDownTop + 32,
                            "left": gbDropDownLeft
                        });
                        el.parent().show();
                        el.pqGrid("option", "dataModel", {data: dataTemp});
                        el.pqGrid('refreshDataAndView');
                        el.pqGrid("setSelection", {rowIndx: 0});
                        //console.log("Filter");
                        if (dataTemp.length > 0) {
                            el.pqGrid("setSelection", {rowIndx: 0});
                        } else {
                            //$(ui.$cell[0]).find("input,select").val("");
                            $gridW09F2921.pqGrid("updateRow", {
                                        rowIndx: ui.rowIndx,
                                        newRow: {'DutyID': '', 'NNormalHours': format2(0, "", 2)}
                                    }
                            );
                            $gridW09F2921.pqGrid('refreshDataAndView');
                        }*/
                        $(".l3loading").removeClass('hide');
                        $.ajax({
                            method: "POST",
                            data: {strSearch: sTr},
                            url: "W09F2921/{{$pForm}} /{{$g}}/reloaddutyid",
                            success: function (data) {
                                $(".l3loading").addClass('hide');
                                dataTemp = data;
                                var el = $("#gridDutytID");
                                el.pqGrid("option", "height", 200);
                                $gridW09F2921.pqGrid("setSelection", {rowIndx: ui.rowIndx, colIndx: ui.colIndx});
                                $("#pgridDutytID").css({
                                    "top": gbDropDownTop + 32,
                                    "left": gbDropDownLeft
                                });
                                el.parent().show();
                                el.pqGrid("option", "dataModel", {data: dataTemp});
                                el.pqGrid('refreshDataAndView');
                                el.pqGrid("setSelection", {rowIndx: 0});
                                //console.log(dataTemp);
                                if (dataTemp.length > 0) {
                                    el.pqGrid("setSelection", {rowIndx: 0});
                                } else {
                                    //$(ui.$cell[0]).find("input,select").val("");
                                    $gridW09F2921.pqGrid("updateRow", {
                                                rowIndx: ui.rowIndx,
                                                newRow: {'DutyID': '', 'NNormalHours': format2(0, "", 2)}
                                            }
                                    );
                                    $gridW09F2921.pqGrid('refreshDataAndView');
                                }
                            }
                        });
                        event.stopPropagation();
                        event.preventDefault();
                    }
                }
            },
            cellClick: function (event, ui) {
                /*$("#pgridProjectID").hide();
                 $("#pgridWorkID").hide();
                 //$("#divDropDown").css("display", "none");*/
            },
            quitEditMode: function (event, ui) {
                //updateTotalSO()
                $gridW09F2921 = $("#gridW09F2921");
                $gridW09F2921.pqGrid("refreshDataAndView");
            }

        };
        $gridW09F2921 = $("#gridW09F2921").pqGrid(objW09F2921);
        $gridW09F2921.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW09F2921.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridW09F2921.pqGrid("refreshDataAndView");
    })
    ;

    var W09F2921ExportExcel = function () {
        var _title = [];
        var _dataIndx = [];
        var _align = [];
        var _format = [];

        initExportExcell($("#gridW09F2921"), _title, _dataIndx, _align, _format);
        //console.log(_format);
        $("#gridW09F2921").pqGrid("commit");
        //var array = $("#gridW09F2921").pqGrid("option", "dataModel.data");

        var _data = JSON.stringify($("#gridW09F2921").pqGrid("option", "dataModel.data"));
        /*array.forEach(myFunction);
        array.forEach(myFunction);
        array.forEach(myFunction);
        array.forEach(myFunction);
        array.forEach(myFunction);
        array.forEach(myFunction);
        array.forEach(myFunction);
        array.forEach(myFunction);
        array.forEach(myFunction);
        array.forEach(myFunction);
        _data = escape(JSON.stringify(array));*/
        //console.log(_data);
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            data: {title: _title, data: _data, dataIndx: _dataIndx, align: _align, format: _format},
            url: "{{url('/Export')}}",
            success: function (data) {
                $(".l3loading").addClass('hide');
                if (data == 0) {
                    alert_error('{{Helpers::getRS(5,'Loi_xuat_file')}}')
                }
                else {
                    var downloadLink = document.createElement("a");
                    downloadLink.download = "Duyet_TimeSheet" + new Date().getTime() + ".xls";
                    downloadLink.innerHTML = "Duyệt đăng ký timesheet";
                    downloadLink.href = data;
                    downloadLink.onclick = destroyClickedElement;
                    downloadLink.style.display = "none";
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                }
            }
        });
    };

    function myFunction(item, index, array) {
        array.push(item);
    }
</script>

