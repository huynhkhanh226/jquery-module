<div id="gridShiftList"></div>
<script type="text/javascript">
    var gbRowIndex = 0;
    var gbDataIndx = "";
    var gbInvalid = false;
    var currentDataIndx = "";
    var currentIndx = 0;
    var cboStatus = "{{$cboStatus}}";
    var isHideOT = {{$isHideOT}} == 0 ? true: false;
    var isHideConfirmOT = {{$isHideConfirmOT}} == 0 ? true: false;
    console.log(isHideOT);
    //alert(cboStatus);
    $(document).ready(function () {
        /*$('#txtDateFrom').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#txtDateTo').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#txtDateFrom').prop('disabled', !$(this).is(":checked"));
        $('#txtDateTo').prop('disabled', !$(this).is(":checked"));

        var tranMonth = {{Session::get("W91P0000")['HRTranMonth']}};
        var tranYear = {{Session::get("W91P0000")['HRTranYear']}};
        var daysInMonth = new Date(tranYear, tranMonth, 0).getDate();
        $('#chkIsDate').change(function () {
            $('#txtDateFrom').prop('disabled', !$(this).is(":checked"));
            $('#txtDateTo').prop('disabled', !$(this).is(":checked"));

            if ($(this).is(":checked")) {
                $('#txtDateFrom').datepicker('setDate', "01/" + tranMonth + "/" + tranYear + "");
                $('#txtDateTo').datepicker('setDate', daysInMonth + "/" + tranMonth + "/" + tranYear + "");
            } else {
                $('#txtDateFrom').val("");
                $('#txtDateTo').val("");
            }
        });
        $('#idDateFrom').find(".glyphicon-calendar").on('click', function () {
            if ($('#txtDateFrom').is(':disabled') == false) {
                $('#txtDateFrom').datepicker('show');
            }
        });
        $("#idDateTo").find(".glyphicon-calendar").on('click', function () {
            if ($('#txtDateTo').is(':disabled') == false) {
                $('#txtDateTo').datepicker('show');
            }
        });
        var validate = function (ui) {
            var $inp = ui.$cell.find("input");
            var grid = $("#gridShiftList");
            var valid = grid.pqGrid("isValid", {
                rowIndx: ui.rowIndx,
                dataIndx: ui.dataIndx,
                value: parseInt($inp.val())
            }).valid;
            if (!valid) {
                $(ui.$cell[0]).addClass("pq-cell-red-tr");
                grid.pqGrid("editCell", {rowIndx: ui.rowIndx, dataIndx: ui.dataIndx});
                return false;
            }
            return true;
        }*/

        var obj = {
            width: '100%',
            numberCell: {show: false},
            height: $("#modalW75F4070").find('.modal-content').height() - 135,
            showTitle: false,
            collapsible: false,
            selectionModel: {type: 'cell', mode: 'single'},
            //filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
            rowBorders: true,
            columnBorders: true,
            postRenderInterval: -1,
            freezeCols: 2,
            hwrap: false,
            wrap: true,
            sortable: false,
            toolbar: {
                items: [
                    {
                        type: 'button',
                        label: "Export",
                        icon: 'ui-icon-arrowthickstop-1-s',
                        listener: function () {

                            var cols = this.colModel;
                            for (var i = 0; i < cols.length; i++) {
                                if (cols[i].dataIndx == "ApprovedPre" || cols[i].dataIndx == "ApprovedAfter") {
                                    cols[i].title = "{{Helpers::getRS($g,"Duyet")}}";
                                }
                                if (cols[i].dataIndx == "NotApprovedPre" || cols[i].dataIndx == "NotApprovedAfter") {
                                    cols[i].title = "{{Helpers::getRS($g,"Khong_duyet")}}";
                                }
                                cols[i].align = "center";
                            }

                            //console.log(cols);
                            //var format = $("#export_format").val();
                            var format = 'xls',
                                blob = this.exportData({
                                    //url: "/pro/demos/exportData",
                                    format: format,
                                    render: false
                                });

                            if (typeof blob === "string") {
                                blob = new Blob([blob]);
                            }
                            saveAs(blob, "Duyet_tang_ca." + format);
                            //exportExcel();
                        }
                    }]
            },
            colModel: [
                {
                    title: '{{Helpers::getRS($g,"Thong_tin_nhan_vien")}}',
                    minWidth: 20,
                    width: 35,
                    colModel: [
                        {
                            title: '{{Helpers::getRS($g,"Ma_NV")}}',
                            minWidth: 20,
                            width: 90,
                            dataType: "string",
                            align: "left",
                            dataIndx: "EmployeeID",
                            editor: false,
                            editable: false,
                            sortable: false,
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Ten_NV")}}',
                            minWidth: 20,
                            width: 170,
                            dataType: "string",
                            align: "left",
                            dataIndx: "EmployeeName",
                            editor: false,
                            editable: false,
                            sortable: false,
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        }
                    ]

                },
                {
                    title: '{{Helpers::getRS($g,"Thong_tin_ca")}}',
                    minWidth: 20,
                    width: 80,
                    colModel: [
                        {
                            title: '{{Helpers::getRS($g,"Lan")}}',
                            minWidth: 20,
                            width: 55,
                            dataType: "integer",
                            align: "center",
                            dataIndx: "Times",
                            editor: false,
                            editable: false,
                            sortable: false,
                            hidden: true,
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Ngay")}}',
                            minWidth: 20,
                            width: 80,
                            dataType: "date",
                            align: "center",
                            dataIndx: "AttendanceDate",
                            editor: false,
                            editable: false,
                            sortable: false,
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Ca")}}',
                            minWidth: 20,
                            width: 50,
                            dataType: "string",
                            align: "center",
                            dataIndx: "ShiftID",
                            editor: false,
                            editable: false,
                            sortable: false,
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Vao")}}',
                            minWidth: 20,
                            width: 50,
                            dataType: "string",
                            align: "center",
                            dataIndx: "TimeStart",
                            editor: false,
                            editable: false,
                            sortable: false,
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Ra")}}',
                            minWidth: 20,
                            width: 50,
                            dataType: "string",
                            align: "center",
                            dataIndx: "TimeEnd",
                            editor: false,
                            editable: false,
                            sortable: false,
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                    ]
                },
                {
                    title: '{{Helpers::getRS($g,"Tang_ca_truoc")}}',
                    minWidth: 20,
                    width: 70,
                    colModel: [
                        {
                            title: '{{Helpers::getRS($g,"Dang_ky")}}',
                            minWidth: 20,
                            width: 80,
                            colModel: [
                                {
                                    title: '{{Helpers::getRS($g,"Tu")}}',
                                    minWidth: 20,
                                    width: 45,
                                    dataType: "string",
                                    align: "center",
                                    dataIndx: "OriPreOTFrom",
                                    editor: {select: true},
                                    editModel: {keyUpDown: true},
                                    editable: false,
                                    sortable: false,
                                    render: function (ui) {
                                        var rowData = ui.rowData;
                                        return {
                                            //text: "<label><input type='text' id='Row"+ui.rowIndx+"' /></label>",
                                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                                        };
                                    }
                                },
                                {
                                    title: '{{Helpers::getRS($g,"Den")}}',
                                    minWidth: 20,
                                    width: 45,
                                    dataType: "string",
                                    align: "center",
                                    dataIndx: "OriPreOTTo",
                                    editor: {select: true},
                                    editModel: {keyUpDown: true},
                                    editable: false,
                                    sortable: false,
                                    render: function (ui) {
                                        var rowData = ui.rowData;
                                        return {
                                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                                        };
                                    }
                                },
                                {
                                    title: '{{Helpers::getRS($g,"Gio")}}',
                                    minWidth: 20,
                                    width: 45,
                                    dataType: "float",
                                    align: "center",
                                    dataIndx: "OriPreOTHours",
                                    editor: {select: true},
                                    editModel: {keyUpDown: true},
                                    format: "#,###.00",
                                    editable: false,
                                    sortable: false,
                                    render: function (ui) {
                                        var rowData = ui.rowData;
                                        return {
                                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                                        };
                                    }
                                },
                                {
                                    title: '{{Helpers::getRS($g,"Tang_ca")}}',
                                    minWidth: 20,
                                    width: 80,
                                    dataType: "float",
                                    align: "center",
                                    dataIndx: "OriPreOTHoursSplit",
                                    editor: {select: true},
                                    editModel: {keyUpDown: true},
                                    format: "#,###.00",
                                    editable: false,
                                    sortable: false,
                                    render: function (ui) {
                                        var rowData = ui.rowData;
                                        return {
                                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                                        };
                                    },
                                    hidden: isHideOT
                                },
                                {
                                    title: '{{Helpers::getRS($g,"Tang_phep")}}',
                                    minWidth: 20,
                                    width: 80,
                                    dataType: "float",
                                    align: "center",
                                    dataIndx: "OriPreOTLeave",
                                    editor: {select: true},
                                    editModel: {keyUpDown: true},
                                    format: "#,###.00",
                                    editable: false,
                                    sortable: false,
                                    render: function (ui) {
                                        var rowData = ui.rowData;
                                        return {
                                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                                        };
                                    },
                                    hidden: isHideOT
                                }
                            ]
                        },
                        {
                            title: '{{Helpers::getRS($g,"Duyet")}}',
                            minWidth: 20,
                            width: 80,
                            colModel: [
                                {
                                    title: '{{Helpers::getRS($g,"Tu")}}',
                                    minWidth: 20,
                                    width: 45,
                                    dataType: "string",
                                    align: "center",
                                    dataIndx: "PreOTFrom",
                                    editor: {select: true},
                                    editModel: {keyUpDown: true},
                                    //editable:false,
                                    editable: function (ui) {
                                        var row = ui.rowData
                                        return !isNullOrEmpty(row["OriPreOTFrom"]);
                                    },
                                    sortable: false,
                                    render: function (ui) {
                                        var rowData = ui.rowData;
                                        //console.log(rowData);
                                        return {
                                            //editable:  false,
                                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""

                                        };
                                    }
                                },
                                {
                                    title: '{{Helpers::getRS($g,"Den")}}',
                                    minWidth: 20,
                                    width: 45,
                                    dataType: "string",
                                    align: "center",
                                    dataIndx: "PreOTTo",
                                    editor: {select: true},
                                    editModel: {keyUpDown: true},
                                    //editable:true,
                                    editable: function (ui) {
                                        var row = ui.rowData
                                        return !isNullOrEmpty(row["OriPreOTFrom"]);
                                    },
                                    sortable: false,
                                    render: function (ui) {
                                        var rowData = ui.rowData;
                                        return {
                                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                                        };
                                    }
                                },

                                {
                                    title: '{{Helpers::getRS($g,"Gio")}}',
                                    minWidth: 20,
                                    width: 45,
                                    dataType: "float",
                                    align: "center",
                                    dataIndx: "PreOTHours",
                                    editor: {select: true},
                                    editModel: {keyUpDown: true},
                                    editable: false,
                                    sortable: false,
                                    format: "#,###.00",

                                    render: function (ui) {
                                        var rowData = ui.rowData;
                                        return {
                                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                                        };
                                    }

                                },
                                {
                                    title: '{{Helpers::getRS($g,"Tang_ca")}}',
                                    minWidth: 20,
                                    width: 80,
                                    dataType: "float",
                                    align: "center",
                                    dataIndx: "PreOTHoursSplit",
                                    editor: {select: true},
                                    editModel: {keyUpDown: true},
                                    editable: true,
                                    sortable: false,
                                    format: "#,###.00",
                                    editable: function (ui) {
                                        var row = ui.rowData
                                        return !isNullOrEmpty(row["OriPreOTFrom"]) && (cboStatus == 0 || cboStatus == 1 || cboStatus == 2  ||isHideOT);
                                    },
                                    sortable: false,
                                    render: function (ui) {
                                        var rowData = ui.rowData;
                                        //console.log(rowData);
                                        return {
                                            //editable:  false,
                                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""

                                        };
                                    },
                                    hidden: isHideOT

                                },
                                {
                                    title: '{{Helpers::getRS($g,"Tang_phep")}}',
                                    minWidth: 20,
                                    width: 80,
                                    dataType: "float",
                                    align: "center",
                                    dataIndx: "PreOTLeave",
                                    editor: {select: true},
                                    editModel: {keyUpDown: true},
                                    editable: true,
                                    sortable: false,
                                    format: "#,###.00",

                                    editable: function (ui) {
                                        var row = ui.rowData
                                        return !isNullOrEmpty(row["OriPreOTFrom"]) && (cboStatus == 0 || cboStatus == 1 || cboStatus == 2  || isHideOT);
                                    },
                                    sortable: false,
                                    render: function (ui) {
                                        var rowData = ui.rowData;
                                        //console.log(rowData);
                                        return {
                                            //editable:  false,
                                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""

                                        };
                                    },
                                    hidden: isHideOT

                                },
                                {
                                    title: '<a id="ApprovedPre" onclick="headClick(this)">{{Helpers::getRS($g,"Duyet")}}<a>',
                                    minWidth: 50,
                                    width: 80,
                                    align: "center",
                                    dataType: "integer",
                                    dataIndx: "ApprovedPre",
                                    editor: false,
                                    sortable: false,
                                    //editable: true,
                                    type: 'checkbox',
                                    cb: {
                                        all: false,
                                        header: true,
                                        check: "1",
                                        uncheck: "0"
                                    },

                                    hidden: cboStatus == 3 || cboStatus == 4 || cboStatus == 5 ? true: false,
                                    editable: function (ui) {
                                        var row = ui.rowData
                                        return !isNullOrEmpty(row["OriPreOTFrom"]);
                                    },
                                    render: function (ui) {
                                        var row = ui.rowData,
                                            checked = row["ApprovedPre"] == 1 ? 'checked' : '',
                                            disabled = this.isEditableCell(ui) ? "" : "disabled";
                                        return {
                                            text: "<label><input type='checkbox' " + checked + " /></label>",
                                            //hidden: $("#cbStatusID").val() == 3 || $("#cbStatusID").val() == 4 || $("#cbStatusID").val() == 5 ? true: false,
                                            cls: (disabled ? "readonly-status" : "")
                                        };
                                    },
                                    postRender: function (ui) {
                                        //
                                        if (this.isEditableCell(ui) == true) {
                                            var rowIndx = ui.rowIndx,
                                                grid = this,
                                                $cell = grid.getCell(ui);

                                            $cell.find("label>input[type='checkbox']")
                                                .unbind("click")
                                                .bind("click", function (evt) {
                                                    gridShiftList = $("#gridShiftList")
                                                    var obj = gridShiftList.pqGrid("getEditCell");
                                                    var $editor = obj.$editor;
                                                    ////console.log($editor);
                                                    if ($editor === undefined) {
                                                        var $tr = $(this).closest("tr"),
                                                            rowIndx = gridShiftList.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                                        var rowData = gridShiftList.pqGrid("getRowData", {rowIndx: rowIndx});
                                                        if ($(this).is(":checked") == true) {
                                                            rowData["NotApprovedPre"] = 0;
                                                            updateRelativeCols(rowData, "ApprovedPre", true, rowIndx);
                                                        } else {
                                                            updateRelativeCols(rowData, "ApprovedPre", false, rowIndx);
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
                                    title: '<a id="NotApprovedPre" onclick="headClick(this)">{{Helpers::getRS($g,"Khong_duyet")}}</a>',
                                    minWidth: 80,
                                    width: 90,
                                    align: "center",
                                    dataType: "integer",
                                    dataIndx: "NotApprovedPre",
                                    editor: false,
                                    sortable: false,
                                    //editable: true,
                                    type: 'checkbox',
                                    cb: {
                                        all: false,
                                        header: true,
                                        check: "1",
                                        uncheck: "0"
                                    },
                                    hidden: cboStatus == 3 || cboStatus == 4 || cboStatus == 5 ? true: false,
                                    editable: function (ui) {
                                        var row = ui.rowData
                                        return !isNullOrEmpty(row["OriPreOTFrom"]);
                                    },
                                    render: function (ui) {
                                        //////console.log(cellData = ui.cellData); //get value checkbox
                                        var row = ui.rowData,
                                            checked = row["NotApprovedPre"] == 1 ? 'checked' : '',
                                            disabled = this.isEditableCell(ui) ? "" : "disabled";
                                        return {
                                            text: "<label><input type='checkbox' " + checked + " /></label>",
                                            //hidden: $("#cbStatusID").val() == 3 || $("#cbStatusID").val() == 4 || $("#cbStatusID").val() == 5 ? true: false,
                                            cls: (disabled ? "readonly-status" : "")
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
                                                    gridShiftList = $("#gridShiftList")
                                                    var obj = gridShiftList.pqGrid("getEditCell");
                                                    var $editor = obj.$editor;

                                                    if ($editor === undefined) {
                                                        var $tr = $(this).closest("tr"),
                                                            rowIndx = gridShiftList.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                                        var rowData = gridShiftList.pqGrid("getRowData", {rowIndx: rowIndx});
                                                        if ($(this).is(":checked") == true) {
                                                            rowData["ApprovedPre"] = 0;
                                                        }
                                                        updateRelativeCols(rowData, "ApprovedPre", false, rowIndx);
                                                    } else {
                                                        evt.stopPropagation();
                                                        evt.preventDefault();
                                                    }


                                                });
                                        }

                                    }
                                },
                                {
                                    title: '<a id="PreConfirm" onclick="headClick(this)">{{Helpers::getRS($g,"Xac_nhan")}}<a>',
                                    minWidth: 50,
                                    width: 80,
                                    align: "center",
                                    dataType: "integer",
                                    dataIndx: "PreConfirm",
                                    editor: false,
                                    sortable: false,
                                    //editable: true,
                                    type: 'checkbox',
                                    cb: {
                                        all: false,
                                        header: true,
                                        check: "1",
                                        uncheck: "0"
                                    },
                                    hidden: cboStatus == 0 || cboStatus == 1 || cboStatus == 2 || isHideConfirmOT ? true: false,
                                    editable: function (ui) {
                                        var row = ui.rowData
                                        return !isNullOrEmpty(row["OriPreOTFrom"]) && row["ApprovedPre"] == 1;
                                    },
                                    render: function (ui) {
                                        var row = ui.rowData,
                                            checked = row["PreConfirm"] == 1 ? 'checked' : '',
                                            disabled = this.isEditableCell(ui) ? "" : "disabled";

                                        return {
                                            text: "<label><input type='checkbox' " + checked + " /></label>",
                                            cls: (disabled ? "readonly-status" : "")
                                        };
                                    },
                                    postRender: function (ui) {
                                        //
                                        if (this.isEditableCell(ui) == true) {
                                            var rowIndx = ui.rowIndx,
                                                grid = this,
                                                $cell = grid.getCell(ui);

                                            $cell.find("label>input[type='checkbox']")
                                                .unbind("click")
                                                .bind("click", function (evt) {
                                                    gridShiftList = $("#gridShiftList")
                                                    var obj = gridShiftList.pqGrid("getEditCell");
                                                    var $editor = obj.$editor;
                                                    ////console.log($editor);
                                                    if ($editor === undefined) {
                                                        var $tr = $(this).closest("tr"),
                                                            rowIndx = gridShiftList.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                                        var rowData = gridShiftList.pqGrid("getRowData", {rowIndx: rowIndx});
                                                        if ($(this).is(":checked") == true) {
                                                            rowData["PreNotConfirm"] = 0;
                                                            updateRelativeCols(rowData, "ApprovedPre", true, rowIndx);
                                                        } else {
                                                            updateRelativeCols(rowData, "ApprovedPre", false, rowIndx);
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
                                    title: '<a id="PreNotConfirm" onclick="headClick(this)">{{Helpers::getRS($g,"Khong_xac_nhan")}}</a>',
                                    minWidth: 80,
                                    width:110,
                                    align: "center",
                                    dataType: "integer",
                                    dataIndx: "PreNotConfirm",
                                    editor: false,
                                    sortable: false,
                                    //editable: true,
                                    type: 'checkbox',
                                    cb: {
                                        all: false,
                                        header: true,
                                        check: "1",
                                        uncheck: "0"
                                    },
                                    hidden: cboStatus == 0 || cboStatus == 1 || cboStatus == 2  || isHideConfirmOT? true: false,
                                    editable: function (ui) {
                                        var row = ui.rowData
                                        return !isNullOrEmpty(row["OriPreOTFrom"]) && row["ApprovedPre"] == 1 ;
                                    },
                                    render: function (ui) {
                                        //////console.log(cellData = ui.cellData); //get value checkbox
                                        var row = ui.rowData,
                                            checked = row["PreNotConfirm"] == 1 ? 'checked' : '',
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

                                            $cell.find("label>input[type='checkbox']")
                                                .unbind("click")
                                                .bind("click", function (evt) {
                                                    gridShiftList = $("#gridShiftList")
                                                    var obj = gridShiftList.pqGrid("getEditCell");
                                                    var $editor = obj.$editor;

                                                    if ($editor === undefined) {
                                                        var $tr = $(this).closest("tr"),
                                                            rowIndx = gridShiftList.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                                        var rowData = gridShiftList.pqGrid("getRowData", {rowIndx: rowIndx});
                                                        if ($(this).is(":checked") == true) {
                                                            rowData["PreConfirm"] = 0;
                                                        }
                                                        updateRelativeCols(rowData, "ApprovedPre", false, rowIndx);
                                                    } else {
                                                        evt.stopPropagation();
                                                        evt.preventDefault();
                                                    }


                                                });
                                        }

                                    }
                                }
                            ]
                        }

                    ]
                },
                {
                    title: '{{Helpers::getRS($g,"Tang_ca_sau")}}',
                    minWidth: 20,
                    width: 45,
                    colModel: [
                        {
                            title: '{{Helpers::getRS($g,"Dang_ky")}}',
                            minWidth: 20,
                            width: 80,
                            colModel: [
                                {
                                    title: '{{Helpers::getRS($g,"Tu")}}',
                                    minWidth: 20,
                                    width: 45,
                                    dataType: "string",
                                    align: "center",
                                    dataIndx: "OriAfterOTFrom",
                                    editor: {select: true},
                                    editModel: {keyUpDown: true},
                                    editable: false,
                                    sortable: false,
                                    render: function (ui) {
                                        var rowData = ui.rowData;
                                        return {
                                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                                        };
                                    }
                                },
                                {
                                    title: '{{Helpers::getRS($g,"Den")}}',
                                    minWidth: 20,
                                    width: 45,
                                    dataType: "string",
                                    align: "center",
                                    dataIndx: "OriAfterOTTo",
                                    editor: {select: true},
                                    editModel: {keyUpDown: true},
                                    editable: false,
                                    sortable: false,
                                    render: function (ui) {
                                        var rowData = ui.rowData;
                                        return {
                                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                                        };
                                    }
                                },
                                {
                                    title: '{{Helpers::getRS($g,"Gio")}}',
                                    minWidth: 20,
                                    width: 45,
                                    dataType: "float",
                                    align: "center",
                                    dataIndx: "OriAfterOTHours",
                                    editor: {select: true},
                                    editModel: {keyUpDown: true},
                                    editable: false,
                                    sortable: false,
                                    format: "#,###.00",
                                    render: function (ui) {
                                        var rowData = ui.rowData;
                                        return {
                                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                                        };
                                    }
                                },
                                {
                                    title: '{{Helpers::getRS($g,"Tang_ca")}}',
                                    minWidth: 20,
                                    width: 80,
                                    dataType: "float",
                                    align: "center",
                                    dataIndx: "OriAfterOTHoursSplit",
                                    editor: {select: true},
                                    editModel: {keyUpDown: true},
                                    editable: false,
                                    sortable: false,
                                    format: "#,###.00",
                                    render: function (ui) {
                                        var rowData = ui.rowData;
                                        return {
                                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                                        };
                                    },
                                    hidden: isHideOT
                                },
                                {
                                    title: '{{Helpers::getRS($g,"Tang_phep")}}',
                                    minWidth: 20,
                                    width: 80,
                                    dataType: "float",
                                    align: "center",
                                    dataIndx: "OriAfterOTLeave",
                                    editor: {select: true},
                                    editModel: {keyUpDown: true},
                                    editable: false,
                                    sortable: false,
                                    format: "#,###.00",
                                    render: function (ui) {
                                        var rowData = ui.rowData;
                                        return {
                                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                                        };
                                    },
                                    hidden: isHideOT
                                }
                            ]
                        },
                        {
                            title: '{{Helpers::getRS($g,"Duyet")}}',
                            minWidth: 20,
                            width: 80,
                            colModel: [
                                {
                                    title: '{{Helpers::getRS($g,"Tu")}}',
                                    minWidth: 20,
                                    width: 45,
                                    dataType: "string",
                                    align: "center",
                                    dataIndx: "AfterOTFrom",
                                    editor: {select: true},
                                    editModel: {keyUpDown: true},
                                    //editable:true,
                                    editable: function (ui) {
                                        var row = ui.rowData
                                        return !isNullOrEmpty(row["OriAfterOTFrom"]);
                                    },
                                    sortable: false,
                                    render: function (ui) {
                                        var rowData = ui.rowData;
                                        return {
                                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                                        };
                                    }
                                },
                                {
                                    title: '{{Helpers::getRS($g,"Den")}}',
                                    minWidth: 20,
                                    width: 45,
                                    dataType: "string",
                                    align: "center",
                                    dataIndx: "AfterOTTo",
                                    editor: {select: true},
                                    editModel: {keyUpDown: true},
                                    //editable:true,
                                    sortable: false,
                                    editable: function (ui) {
                                        var row = ui.rowData
                                        return !isNullOrEmpty(row["OriAfterOTFrom"]);
                                    },
                                    render: function (ui) {
                                        var rowData = ui.rowData;
                                        return {
                                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                                        };
                                    }
                                },
                                {
                                    title: '{{Helpers::getRS($g,"Gio")}}',
                                    minWidth: 20,
                                    width: 45,
                                    dataType: "float",
                                    align: "center",
                                    dataIndx: "AfterOTHours",
                                    editor: {select: true},
                                    editModel: {keyUpDown: true},
                                    editable: false,
                                    sortable: false,
                                    format: "#,###.00",

                                    render: function (ui) {
                                        var rowData = ui.rowData;
                                        return {
                                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                                        };
                                    }
                                },
                                {
                                    title: '{{Helpers::getRS($g,"Tang_ca")}}',
                                    minWidth: 20,
                                    width: 80,
                                    dataType: "float",
                                    align: "center",
                                    dataIndx: "AfterOTHoursSplit",
                                    editor: {select: true},
                                    editModel: {keyUpDown: true},
                                    editable: true,
                                    sortable: false,
                                    format: "#,###.00",
                                    editable: function (ui) {
                                        var row = ui.rowData
                                        return !isNullOrEmpty(row["OriAfterOTFrom"]) && (cboStatus == 0 || cboStatus == 1 || cboStatus == 2  || isHideOT);
                                    },
                                    sortable: false,
                                    render: function (ui) {
                                        var rowData = ui.rowData;
                                        return {
                                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                                        };
                                    },
                                    hidden: isHideOT
                                },
                                {
                                    title: '{{Helpers::getRS($g,"Tang_phep")}}',
                                    minWidth: 20,
                                    width: 80,
                                    dataType: "float",
                                    align: "center",
                                    dataIndx: "AfterOTLeave",
                                    editor: {select: true},
                                    editModel: {keyUpDown: true},
                                    editable: true,
                                    sortable: false,
                                    format: "#,###.00",

                                    editable: function (ui) {
                                        var row = ui.rowData
                                        return !isNullOrEmpty(row["OriAfterOTFrom"]) && (cboStatus == 0 || cboStatus == 1 || cboStatus == 2  || isHideOT);
                                    },
                                    sortable: false,
                                    render: function (ui) {
                                        var rowData = ui.rowData;
                                        return {
                                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                                        };
                                    },
                                    hidden: isHideOT
                                },
                                {
                                    title: '<a id="ApprovedAfter" onclick="headClick(this)">{{Helpers::getRS($g,"Duyet")}}<a>',
                                    minWidth: 50,
                                    width: 80,
                                    align: "center",
                                    dataType: "integer",
                                    dataIndx: "ApprovedAfter",
                                    editor: false,
                                    sortable: false,
                                    //editable: true,
                                    type: 'checkbox',
                                    cb: {
                                        all: false,
                                        header: true,
                                        check: "1",
                                        uncheck: "0"
                                    },
                                    hidden: cboStatus == 3 || cboStatus == 4 || cboStatus == 5 ? true: false,
                                    editable: function (ui) {
                                        var row = ui.rowData
                                        return !isNullOrEmpty(row["OriAfterOTFrom"]);
                                    },
                                    render: function (ui) {
                                        var row = ui.rowData,
                                            checked = row["ApprovedAfter"] == 1 ? 'checked' : '',
                                            disabled = this.isEditableCell(ui) ? "" : "disabled";

                                        return {
                                            text: "<label><input type='checkbox' " + checked + " /></label>",
                                            cls: (disabled ? "readonly-status" : "")
                                        };
                                    },
                                    postRender: function (ui) {
                                        //
                                        if (this.isEditableCell(ui) == true) {
                                            var rowIndx = ui.rowIndx,
                                                grid = this,
                                                $cell = grid.getCell(ui);

                                            $cell.find("label>input[type='checkbox']")
                                                .unbind("click")
                                                .bind("click", function (evt) {
                                                    gridShiftList = $("#gridShiftList")
                                                    var obj = gridShiftList.pqGrid("getEditCell");
                                                    var $editor = obj.$editor;
                                                    ////console.log($editor);
                                                    if ($editor === undefined) {
                                                        var $tr = $(this).closest("tr"),
                                                            rowIndx = gridShiftList.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                                        var rowData = gridShiftList.pqGrid("getRowData", {rowIndx: rowIndx});
                                                        if ($(this).is(":checked") == true) {
                                                            rowData["NotApprovedAfter"] = 0;
                                                            updateRelativeCols(rowData, "ApprovedAfter", true, rowIndx);
                                                        } else {
                                                            updateRelativeCols(rowData, "ApprovedAfter", false, rowIndx);
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
                                    title: '<a id="NotApprovedAfter" onclick="headClick(this)">{{Helpers::getRS($g,"Khong_duyet")}}</a>',
                                    minWidth: 80,
                                    width: 90,
                                    align: "center",
                                    dataType: "integer",
                                    dataIndx: "NotApprovedAfter",
                                    editor: false,
                                    sortable: false,
                                    //editable: true,
                                    type: 'checkbox',
                                    cb: {
                                        all: false,
                                        header: true,
                                        check: "1",
                                        uncheck: "0"
                                    },
                                    hidden: cboStatus == 3 || cboStatus == 4 || cboStatus == 5 ? true: false,
                                    editable: function (ui) {
                                        var row = ui.rowData
                                        return !isNullOrEmpty(row["OriAfterOTFrom"]);
                                    },
                                    render: function (ui) {
                                        //////console.log(cellData = ui.cellData); //get value checkbox
                                        var row = ui.rowData,
                                            checked = row["NotApprovedAfter"] == 1 ? 'checked' : '',
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

                                            $cell.find("label>input[type='checkbox']")
                                                .unbind("click")
                                                .bind("click", function (evt) {
                                                    gridShiftList = $("#gridShiftList")
                                                    var obj = gridShiftList.pqGrid("getEditCell");
                                                    var $editor = obj.$editor;

                                                    if ($editor === undefined) {

                                                        var $tr = $(this).closest("tr"),
                                                            rowIndx = gridShiftList.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                                        var rowData = gridShiftList.pqGrid("getRowData", {rowIndx: rowIndx});
                                                        if ($(this).is(":checked") == true) {
                                                            rowData["ApprovedAfter"] = 0;
                                                        }
                                                        updateRelativeCols(rowData, "ApprovedAfter", false, ui.rowIndx);
                                                    } else {
                                                        evt.stopPropagation();
                                                        evt.preventDefault();
                                                    }


                                                });
                                        }

                                    }
                                },
                                {
                                    title: '<a id="AfterConfirm" onclick="headClick(this)">{{Helpers::getRS($g,"Xac_nhan")}}<a>',
                                    minWidth: 50,
                                    width: 80,
                                    align: "center",
                                    dataType: "integer",
                                    dataIndx: "AfterConfirm",
                                    editor: false,
                                    sortable: false,
                                    //editable: true,
                                    type: 'checkbox',
                                    cb: {
                                        all: false,
                                        header: true,
                                        check: "1",
                                        uncheck: "0"
                                    },
                                    hidden: cboStatus == 0 || cboStatus == 1 || cboStatus == 2  || isHideConfirmOT? true: false,
                                    editable: function (ui) {
                                        var row = ui.rowData
                                        return !isNullOrEmpty(row["OriAfterOTFrom"])  && row["ApprovedAfter"] == 1;
                                    },
                                    render: function (ui) {
                                        var row = ui.rowData,
                                            checked = row["AfterConfirm"] == 1 ? 'checked' : '',
                                            disabled = this.isEditableCell(ui) ? "" : "disabled";

                                        return {
                                            text: "<label><input type='checkbox' " + checked + " /></label>",
                                            cls: (disabled ? "readonly-status" : "")
                                        };
                                    },
                                    postRender: function (ui) {
                                        //
                                        if (this.isEditableCell(ui) == true) {
                                            var rowIndx = ui.rowIndx,
                                                grid = this,
                                                $cell = grid.getCell(ui);

                                            $cell.find("label>input[type='checkbox']")
                                                .unbind("click")
                                                .bind("click", function (evt) {
                                                    gridShiftList = $("#gridShiftList")
                                                    var obj = gridShiftList.pqGrid("getEditCell");
                                                    var $editor = obj.$editor;
                                                    ////console.log($editor);
                                                    if ($editor === undefined) {
                                                        var $tr = $(this).closest("tr"),
                                                            rowIndx = gridShiftList.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                                        var rowData = gridShiftList.pqGrid("getRowData", {rowIndx: rowIndx});
                                                        if ($(this).is(":checked") == true) {
                                                            rowData["AfterNotConfirm"] = 0;
                                                            updateRelativeCols(rowData, "ApprovedAfter", true, rowIndx);
                                                        } else {
                                                            updateRelativeCols(rowData, "ApprovedAfter", false, rowIndx);
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
                                    title: '<a id="AfterNotConfirm" onclick="headClick(this)">{{Helpers::getRS($g,"Khong_xac_nhan")}}</a>',
                                    minWidth: 80,
                                    width: 110,
                                    align: "center",
                                    dataType: "integer",
                                    dataIndx: "AfterNotConfirm",
                                    editor: false,
                                    sortable: false,
                                    //editable: true,
                                    type: 'checkbox',
                                    cb: {
                                        all: false,
                                        header: true,
                                        check: "1",
                                        uncheck: "0"
                                    },
                                    hidden: cboStatus == 0 || cboStatus == 1 || cboStatus == 2  || isHideConfirmOT ? true: false,
                                    editable: function (ui) {
                                        var row = ui.rowData
                                        return !isNullOrEmpty(row["OriAfterOTFrom"]) && row["ApprovedAfter"] == 1;
                                    },
                                    render: function (ui) {
                                        //////console.log(cellData = ui.cellData); //get value checkbox
                                        var row = ui.rowData,
                                            checked = row["AfterNotConfirm"] == 1 ? 'checked' : '',
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

                                            $cell.find("label>input[type='checkbox']")
                                                .unbind("click")
                                                .bind("click", function (evt) {
                                                    gridShiftList = $("#gridShiftList")
                                                    var obj = gridShiftList.pqGrid("getEditCell");
                                                    var $editor = obj.$editor;

                                                    if ($editor === undefined) {

                                                        var $tr = $(this).closest("tr"),
                                                            rowIndx = gridShiftList.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                                        var rowData = gridShiftList.pqGrid("getRowData", {rowIndx: rowIndx});
                                                        if ($(this).is(":checked") == true) {
                                                            rowData["AfterConfirm"] = 0;
                                                        }
                                                        updateRelativeCols(rowData, "ApprovedAfter", false, ui.rowIndx);
                                                    } else {
                                                        evt.stopPropagation();
                                                        evt.preventDefault();
                                                    }


                                                });
                                        }

                                    }
                                }
                            ]
                        }

                    ]
                },
                {
                    title: '{{Helpers::getRS($g,"Uu_tien_phep")}}',
                    minWidth: 50,
                    width: 110,
                    align: "center",
                    dataType: "integer",
                    dataIndx: "IsPriorityLeave",
                    editor: false,
                    sortable: false,
                    type: 'checkbox',
                    cb: {
                        all: false,
                        header: true,
                        check: "1",
                        uncheck: "0"
                    },
                    editable: function (ui) {
                        var row = ui.rowData
                        return !isNullOrEmpty(row["OriAfterOTFrom"]);
                    },

                    render: function (ui) {
                        var row = ui.rowData,
                            checked = Number(row["IsPriorityLeave"]) == 1 ? 'checked' : '',
                            disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            text: "<label><input type='checkbox' " + checked + " /></label>",
                            cls: (disabled ? "readonly-status" : "")
                        };
                    },
                    hidden: isHideConfirmOT

                },
                {
                    title: '{{Helpers::getRS($g,"Ly_do")}}',
                    minWidth: 20,
                    width: 240,
                    dataType: "string",
                    align: "left",
                    dataIndx: "Reason",
                    editor: false,
                    editable: false,
                    sortable: false,

                    render: function (ui) {
                        var disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    }
                },
                {
                    title: '{{Helpers::getRS($g,"Ghi_chu")}}',
                    minWidth: 20,
                    width: 240,
                    dataType: "string",
                    editor: true,
                    editable: true,
                    sortable: false,
                    align: "left",
                    dataIndx: "Note",
                    editable: function (ui) {
                        var row = ui.rowData
                        return row["IsUpdate"] == 1;
                    },
                    render: function (ui) {
                        var disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    }
                },
                {
                    title: '{{Helpers::getRS($g,"KQ_thuc_hien")}}',
                    minWidth: 20,
                    width: 240,
                    dataType: "string",
                    editor: true,
                    editable: true,
                    sortable: false,
                    align: "left",
                    dataIndx: "Result",
                    editable: function (ui) {
                        /*var row = ui.rowData
                        return row["IsUpdate"] == 1;*/
                        return false;
                    },
                    render: function (ui) {
                        var disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    }
                },
                {
                    title: '',
                    minWidth: 20,
                    width: 170,
                    dataType: "string",
                    editor: true,
                    editable: true,
                    sortable: false,
                    hidden: true,
                    align: "left",
                    dataIndx: "IsUpdate "
                },
                {
                    title: '',
                    minWidth: 20,
                    width: 170,
                    dataType: "string",
                    editor: true,
                    editable: true,
                    sortable: false,
                    hidden: true,
                    align: "left",
                    dataIndx: "TransID "
                },
                {
                    title: 'IsConfirm',
                    minWidth: 20,
                    width: 170,
                    dataType: "integer",
                    editor: true,
                    editable: true,
                    sortable: false,
                    hidden: true,
                    align: "left",
                    dataIndx: "IsConfirm"
                }

            ],
            create: function (evt, ui) {
                ////console.log(this.widget().pqTooltip());
                this.widget().pqTooltip();
            },
            dataModel: {
                data: {{json_encode($rsData)}},
                location: "local",
                sorting: "local",
                sortDir: "down"
            },
            editModel: {
                saveKey: $.ui.keyCode.ENTER,
                select: true,
                keyUpDown: false,
                cellBorderWidth: 0,
                //onBlur: "save",
                clicksToEdit: 0
            },

            pageModel: {
                type: 'local',
                rPP: 30,
                rPPOptions: [20, 30, 40, 50, 9999]
            },

            editorFocus: function (event, ui) {

                var soel = $("#gridShiftList");
                //console.log('editorBegin');

                if (ui.dataIndx == "PreOTFrom") {
                    var obj = soel.pqGrid("getEditCell");
                    var $td = obj.$td; //table cell
                    var $cell = obj.$cell; //editor wrapper.
                    var $editor = obj.$editor; //editor.

                    $($editor).inputmask({
                        alias: "datetime",
                        mask: "h:s",
                        placeholder: "__:__"
                    });
                }
                if (ui.dataIndx == "PreOTTo") {
                    var obj = soel.pqGrid("getEditCell");
                    var $td = obj.$td; //table cell
                    var $cell = obj.$cell; //editor wrapper.
                    var $editor = obj.$editor; //editor.

                    $($editor).inputmask({
                        alias: "datetime",
                        mask: "h:s",
                        placeholder: "__:__"
                    });
                }

                if (ui.dataIndx == "AfterOTFrom") {
                    var obj = soel.pqGrid("getEditCell");
                    var $td = obj.$td; //table cell
                    var $cell = obj.$cell; //editor wrapper.
                    var $editor = obj.$editor; //editor.

                    $($editor).inputmask({
                        alias: "datetime",
                        mask: "h:s",
                        placeholder: "__:__"
                    });
                }

                if (ui.dataIndx == "AfterOTTo") {
                    var obj = soel.pqGrid("getEditCell");
                    var $td = obj.$td; //table cell
                    var $cell = obj.$cell; //editor wrapper.
                    var $editor = obj.$editor; //editor.

                    $($editor).inputmask({
                        alias: "datetime",
                        mask: "h:s",
                        placeholder: "__:__"
                    });
                }
            },
            change: function (event, ui) {
                //alert('change');
                var soel = $("#gridShiftList");
                var rowData = ui.rowList[0].rowData;
                updateIsUpdate(rowData);
                calHours(rowData, 1);
                calHours(rowData, 0);

                splitPreOTHours(currentDataIndx, ui.rowList[0].rowData);

                setBackColor(soel);
                soel.pqGrid("refreshCell", {rowIndx: gbRowIndex, dataIndx: "ApprovedPre"});
                soel.pqGrid("refreshCell", {rowIndx: gbRowIndex, dataIndx: "NotApprovedPre"});
                soel.pqGrid("refreshCell", {rowIndx: gbRowIndex, dataIndx: "PreOTFrom"});
                soel.pqGrid("refreshCell", {rowIndx: gbRowIndex, dataIndx: "PreOTTo"});
                soel.pqGrid("refreshCell", {rowIndx: gbRowIndex, dataIndx: "PreOTHours"});

                soel.pqGrid("refreshCell", {rowIndx: gbRowIndex, dataIndx: "ApprovedAfter"});
                soel.pqGrid("refreshCell", {rowIndx: gbRowIndex, dataIndx: "NotApprovedAfter"});
                soel.pqGrid("refreshCell", {rowIndx: gbRowIndex, dataIndx: "AfterOTFrom"});
                soel.pqGrid("refreshCell", {rowIndx: gbRowIndex, dataIndx: "AfterOTTo"});
                soel.pqGrid("refreshCell", {rowIndx: gbRowIndex, dataIndx: "AfterOTHours"});

            },
            cellBeforeSave: function (event, ui) {
                console.log('cellBeforeSave');
                var soel = $("#gridShiftList");
                var rowData = ui.rowData,
                    dataIndx = ui.dataIndx,
                    newVal = ui.newVal,
                    oldVal = ui.oldVal,
                    rowIndx = ui.rowIndx;
                gbInvalid = false;
                if (dataIndx == 'PreOTFrom' || dataIndx == 'PreOTTo' || dataIndx == 'AfterOTFrom' || dataIndx == 'AfterOTTo') {
                    //event.preventDefault();
                    rowData[dataIndx] = newVal;
                    $(".l3loading").removeClass('hide');
                    $.ajax({
                        method: "POST",
                        url: '{{url("/W75F4070/$pForm/$g/check")}}',
                        data: {
                            rowData: rowData,
                            field: dataIndx
                        },
                        async: true,
                        success: function (data) {
                            $(".l3loading").addClass('hide');
                            gbInvalid = true;
                            if (data.status == 1) {
                                rowData[dataIndx] = oldVal;
                                var msg = data.message;
                                var wid = msg.length * 8;
                                soel.pqGrid("quitEditMode");
                                soel.pqGrid("editCell", {rowIndx: rowIndx, dataIndx: dataIndx});
                                var obj = soel.pqGrid("getEditCell");
                                var $editor = obj.$editor;
                                $($editor).val(newVal);
                                $($editor).confirmation({
                                    btnOkLabel: '',
                                    btnCancelLabel: '',
                                    popout: true,
                                    placement: "bottom",
                                    singleton: true,
                                    template:
                                    '<div class="popover" style="display: inline-flex;"><div class="arrow"></div>'
                                    + '<div class="popover-content" style="text-align: center;padding:10px;"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i><label class="confirmContent pull-left">'
                                    + msg
                                    + '</label></span></div>'
                                    + '</div>'
                                });
                                $($editor).confirmation('show');
                                return false;
                            } else {
                                gbInvalid = true;
                                soel.pqGrid("quitEditMode");
                                dataChange(soel, rowData); ///Những cột ngày không chạy vô event change nên phải chạy ở đây
                            }
                        }
                    });
                    //return false;
                }
                gbInvalid = true;

            },
            cellKeyDown: function (event, ui) {
                //Delete
                ////console.log('cellKeyDown');
                var soel = $("#gridShiftList");
                gbRowIndex = ui.rowIndx;
                gbDataIndx = ui.dataIndx;
                if (event.keyCode == 46) {//Ch? cho x�a nh?ng cell n�o cho edit th�i
                    if ($(ui.$ele[0]).hasClass('readonly-status') == false) {
                        ui.rowData[ui.dataIndx] = null;
                        updateIsUpdate(ui.rowData);
                        calHours(ui.rowData, 1);
                        calHours(ui.rowData, 0);
                        setBackColor(soel);
                        soel.pqGrid("refreshDataAndView", {rowIndx: ui.rowIndx});
                    }
                }
            },
            cellClick: function (event, ui) {
                //console.log('cellClick');
                var soel = $("#gridShiftList");
                gbRowIndex = ui.rowIndx;
                gbDataIndx = ui.dataIndx;
                currentDataIndx = ui.dataIndx;
                currentIndx = ui.rowIndx;
                var obj = gridShiftList.pqGrid("getEditCell");
                var $editor = obj.$editor;
                /*if ($editor != undefined){
                    event.preventDefault();
                    event.stopPropagation()
                }*/
            },
            complete: function (event, ui) {
                var $grid = $("#gridShiftList");
                var gridData = $grid.pqGrid("option", "dataModel.data");
                var rows = gridData == null ? 0 : gridData.length;
                for (var i = 0; i < rows; i++) {
                    if (!isNullOrEmpty(gridData[i]["OriPreOTFrom"]) && gridData[i]["ApprovedPre"] == 0 && gridData[i]["NotApprovedPre"] == 0) {
                        $grid.pqGrid("addClass", {rowIndx: i, dataIndx: 'OriPreOTFrom', cls: 'digi-text-blue'});
                        $grid.pqGrid("addClass", {rowIndx: i, dataIndx: 'OriPreOTTo', cls: 'digi-text-blue'});
                        $grid.pqGrid("addClass", {rowIndx: i, dataIndx: 'OriPreOTHours', cls: 'digi-text-blue'});

                    }
                    if (!isNullOrEmpty(gridData[i]["OriAfterOTFrom"]) && gridData[i]["ApprovedAfter"] == 0 && gridData[i]["NotApprovedAfter"] == 0) {
                        $grid.pqGrid("addClass", {rowIndx: i, dataIndx: 'OriAfterOTFrom', cls: 'digi-text-blue'});
                        $grid.pqGrid("addClass", {rowIndx: i, dataIndx: 'OriAfterOTTo', cls: 'digi-text-blue'});
                        $grid.pqGrid("addClass", {rowIndx: i, dataIndx: 'OriAfterOTHours', cls: 'digi-text-blue'});
                    }
                }
            },

        };

        function splitPreOTHours(dataIndx, rowData) {
            var $grid = $("#gridShiftList");

            if (dataIndx == "PreOTFrom" || dataIndx == "PreOTTo") {
                rowData["PreOTHoursSplit"] = rowData["PreOTHours"];
                $grid.pqGrid("refreshCell", {rowIndx: currentIndx, dataIndx: "PreOTHoursSplit"});

                if (rowData["PreOTHoursSplit"] > rowData["PreOTHours"]) {
                    rowData["PreOTHoursSplit"] = rowData["PreOTHours"]
                }
                rowData["PreOTLeave"] = rowData["PreOTHours"] - rowData["PreOTHoursSplit"];
                $grid.pqGrid("refreshCell", {rowIndx: currentIndx, dataIndx: "PreOTLeave"});

            } else if (dataIndx == "AfterOTFrom" || dataIndx == "AfterOTTo") {
                rowData["AfterOTHoursSplit"] = rowData["AfterOTHours"];
                $grid.pqGrid("refreshCell", {rowIndx: currentIndx, dataIndx: "AfterOTHoursSplit"});

                if (rowData["AfterOTHoursSplit"] > rowData["AfterOTHours"]) {
                    rowData["AfterOTHoursSplit"] = rowData["AfterOTHours"]
                }
                rowData["AfterOTLeave"] = rowData["AfterOTHours"] - rowData["AfterOTHoursSplit"];
                $grid.pqGrid("refreshCell", {rowIndx: currentIndx, dataIndx: "AfterOTLeave"});
            } else {
                switch (dataIndx) {
                    case "PreOTHoursSplit":
                        //caculate the value of txtPreOTLeave
                        if (rowData["PreOTHoursSplit"] > rowData["PreOTHours"]) {
                            rowData["PreOTHoursSplit"] = rowData["PreOTHours"];
                        }
                        rowData["PreOTLeave"] = rowData["PreOTHours"] - rowData["PreOTHoursSplit"];
                        $grid.pqGrid("refreshCell", {rowIndx: currentIndx, dataIndx: "PreOTLeave"});
                        break;
                    case "PreOTLeave":
                        //caculate the value of txtPreOTHoursSplit
                        if (rowData["PreOTLeave"] > rowData["PreOTHours"]) {
                            rowData["PreOTLeave"] = rowData["PreOTHours"];
                        }
                        rowData["PreOTHoursSplit"] = rowData["PreOTHours"] - rowData["PreOTLeave"];
                        $grid.pqGrid("refreshCell", {rowIndx: currentIndx, dataIndx: "PreOTHoursSplit"});
                        break;
                    case "AfterOTHoursSplit":
                        //caculate the value of txtAfterOTLeave
                        if (rowData["AfterOTHoursSplit"] > rowData["AfterOTHours"]) {
                            rowData["AfterOTHoursSplit"] = rowData["AfterOTHours"];
                        }
                        rowData["AfterOTLeave"] = rowData["AfterOTHours"] - rowData["AfterOTHoursSplit"];
                        $grid.pqGrid("refreshCell", {rowIndx: currentIndx, dataIndx: "AfterOTLeave"});
                        break;
                    case "AfterOTLeave":
                        //caculate the value of txtAfterOTHoursSplit
                        if (rowData["AfterOTLeave"] > rowData["AfterOTHours"]) {
                            rowData["AfterOTLeave"] = rowData["AfterOTHours"];
                        }
                        rowData["AfterOTHoursSplit"] = rowData["AfterOTHours"] - rowData["AfterOTLeave"];
                        $grid.pqGrid("refreshCell", {rowIndx: currentIndx, dataIndx: "AfterOTHoursSplit"});
                        break;
                }
            }


        }

        function dataChange(soel, rowData) {
            updateIsUpdate(rowData);
            calHours(rowData, 1);
            calHours(rowData, 0);
            splitPreOTHours(currentDataIndx, rowData);

            setBackColor(soel);
            soel.pqGrid("refreshCell", {rowIndx: gbRowIndex, dataIndx: "ApprovedPre"});
            soel.pqGrid("refreshCell", {rowIndx: gbRowIndex, dataIndx: "NotApprovedPre"});
            soel.pqGrid("refreshCell", {rowIndx: gbRowIndex, dataIndx: "PreOTFrom"});
            soel.pqGrid("refreshCell", {rowIndx: gbRowIndex, dataIndx: "PreOTTo"});
            soel.pqGrid("refreshCell", {rowIndx: gbRowIndex, dataIndx: "PreOTHours"});

            soel.pqGrid("refreshCell", {rowIndx: gbRowIndex, dataIndx: "ApprovedAfter"});
            soel.pqGrid("refreshCell", {rowIndx: gbRowIndex, dataIndx: "NotApprovedAfter"});
            soel.pqGrid("refreshCell", {rowIndx: gbRowIndex, dataIndx: "AfterOTFrom"});
            soel.pqGrid("refreshCell", {rowIndx: gbRowIndex, dataIndx: "AfterOTTo"});
            soel.pqGrid("refreshCell", {rowIndx: gbRowIndex, dataIndx: "AfterOTHours"});
            soel.pqGrid("refreshCell", {rowIndx: gbRowIndex, dataIndx: "Note"});
        }


        var gridShiftList = $("#gridShiftList").pqGrid(obj);
        $("#gridShiftList").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $("#gridShiftList").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        gridShiftList.pqGrid("refreshDataAndView");

        setTimeout(function () {
            resizePqGrid();
        }, 500);


        function updateIsUpdate(rowData, dataIndx) {
            rowData["IsUpdate"] = 1;
            if (gbDataIndx == "PreConfirm" || gbDataIndx == "PreNotConfirm" || gbDataIndx == "AfterConfirm" || gbDataIndx == "AfterNotConfirm"  ){
                rowData["IsConfirm"] = 1;
            }
        }


    });



    function setBackColor($grid) {
        var obj = $grid.pqGrid("option", "dataModel.data");
        if (obj.length > 0) {
            for (var i = 0; i < obj.length; i++) {
                if (obj[i].IsUpdate == 1) {
                    $grid.pqGrid("addClass", {rowIndx: i, cls: 'edit-status'});
                } else {
                    $grid.pqGrid("removeClass", {rowIndx: i, cls: 'edit-status'});
                }
            }
        }
    }


    function checkHeadClick(obj, key) {
        var rs = $.grep(obj, function (data, index) {
            return data[key] == 1;
        });
        var rs1;
        if (key == "ApprovedPre" || key == "NotApprovedPre") {
            rs1 = $.grep(obj, function (data, index) {
                return isNullOrEmpty(data["OriPreOTFrom"]) == false;
            });
        }
        if (key == "ApprovedAfter" || key == "NotApprovedAfter") {
            rs1 = $.grep(obj, function (data, index) {
                return isNullOrEmpty(data["OriAfterOTFrom"]) == false;
            });
        }

        if (key == "PreConfirm" || key == "PreNotConfirm") {
            rs1 = $.grep(obj, function (data, index) {
                return isNullOrEmpty(data["OriPreOTFrom"]) == false && data["ApprovedPre"] == 1;
            });
        }
        if (key == "AfterConfirm" || key == "AfterNotConfirm") {
            rs1 = $.grep(obj, function (data, index) {
                return isNullOrEmpty(data["OriAfterOTFrom"]) == false && data["ApprovedAfter"] == 1;
            });
        }

        return rs.length >= rs1.length ? true : false;
    }


    function headClick(el) {
        $grid = $("#gridShiftList");
        $grid.pqGrid("quitEditMode");
        //$grid.pqGrid("saveEditCell")
        var obj = $grid.pqGrid("option", "dataModel.data");
        if (obj.length > 0) {
            var key = $(el).attr('id');
            var isHeadClick = checkHeadClick(obj, key); //Kiem tra cột hiện tại có headclick chưa, nếu rồi return true;
            setValueHeadClick($("#gridShiftList"), key, !isHeadClick);
        }

    }

    function setValueHeadClick($grid, currentKey, check) {
        console.log("sdfdsfs");
        var relative = '';
        if (currentKey == "ApprovedPre")
            relative = "NotApprovedPre";
        if (currentKey == "NotApprovedPre")
            relative = "ApprovedPre";
        if (currentKey == "ApprovedAfter")
            relative = "NotApprovedAfter";
        if (currentKey == "NotApprovedAfter")
            relative = "ApprovedAfter";

        if (currentKey == "PreConfirm")
            relative = "PreNotConfirm";
        if (currentKey == "PreNotConfirm")
            relative = "PreConfirm";

        if (currentKey == "AfterConfirm")
            relative = "AfterNotConfirm";
        if (currentKey == "AfterNotConfirm")
            relative = "AfterConfirm";

        var checkNum = (check == true ? 1 : 0);
        var obj = $grid.pqGrid("option", "dataModel.data");
        if (obj.length > 0) {
            for (var i = 0; i < obj.length; i++) {
                if (
                    ((currentKey == "ApprovedPre" || currentKey == "NotApprovedPre") && isNullOrEmpty(obj[i]["OriPreOTFrom"]) == false)
                    ||

                    ((currentKey == "ApprovedAfter" || currentKey == "NotApprovedAfter") && isNullOrEmpty(obj[i]["OriAfterOTFrom"]) == false)

                    ||
                    ((currentKey == "PreConfirm" || currentKey == "PreNotConfirm") && isNullOrEmpty(obj[i]["OriPreOTFrom"]) == false && obj[i]["ApprovedPre"] == 1)
                    ||
                    ((currentKey == "AfterConfirm" || currentKey == "AfterNotConfirm") && isNullOrEmpty(obj[i]["OriAfterOTFrom"]) == false && obj[i]["ApprovedAfter"] == 1)
                ) {
                    //console.log("test" + obj[i]["PreOTFrom"]);
                    obj[i][currentKey] = checkNum;
                    if (checkNum == 1 && obj[i][relative] == 1) {
                        obj[i][relative] = 0;
                    }
                    obj[i]["IsUpdate"] = 1;

                    if (currentKey == "PreConfirm" || currentKey == "PreNotConfirm" || currentKey == "AfterConfirm" || currentKey == "AfterNotConfirm"){
                        obj[i]["IsConfirm"] = 1;
                    }

                    if (currentKey == "ApprovedPre") {
                        updateRelativeCols(obj[i], 'ApprovedPre', check, i);
                    }
                    if (currentKey == "NotApprovedPre" && check) {
                        updateRelativeCols(obj[i], 'ApprovedPre', false, i);
                    }
                    if (currentKey == "ApprovedAfter") {
                        updateRelativeCols(obj[i], 'ApprovedAfter', check, i);
                    }
                    if (currentKey == "NotApprovedAfter" && check) {
                        updateRelativeCols(obj[i], 'ApprovedAfter', false, i);
                    }

                    //----------------------------------------------------------
                    if (currentKey == "PreConfirm") {
                        updateRelativeCols(obj[i], 'ApprovedPre', check, i);
                    }

                    if (currentKey == "PreNotConfirm" && check) {
                        updateRelativeCols(obj[i], 'ApprovedPre', false, i);
                    }

                    if (currentKey == "AfterConfirm") {
                        updateRelativeCols(obj[i], 'ApprovedAfter', check, i);
                    }

                    if (currentKey == "AfterNotConfirm" && check) {
                        updateRelativeCols(obj[i], 'ApprovedAfter', false, i);
                    }
                    calHours(obj[i], 1);
                    calHours(obj[i], 0);

                } else {
                    obj[i][currentKey] = 0;
                    obj[i][relative] = 0;
                }

            }
            $grid.pqGrid("option", "dataModel.data", obj);
            setBackColor($grid);
            $grid.pqGrid("refreshDataAndView");
            console.log(obj);
        }

    }

    function isNull(val) {
        return (val === null || val === "" || val === undefined || (!isNaN(val) && format2(val, '', 0) == format2(0, '', 0))) ? true : false;
    }

    function updateRelativeCols(rowData, field, checked, indx) {
        console.log('updateRelativeCols');
        $grid = $("#gridShiftList");
        console.log(rowData["PreOTHours"]);
        if (field == "ApprovedPre") {
            if (checked) {
                if (isNull(rowData["PreOTFrom"]))
                    rowData["PreOTFrom"] = rowData["OriPreOTFrom"]
                if (isNull(rowData["PreOTTo"]))
                    rowData["PreOTTo"] = rowData["OriPreOTTo"]
                if (isNull(rowData["PreOTHours"])) {
                    rowData["PreOTHours"] = rowData["OriPreOTHours"];
                }

                if (isNull(rowData["PreOTHoursSplit"])) {
                    rowData["PreOTHoursSplit"] = rowData["OriPreOTHoursSplit"];
                }
                if (isNull(rowData["PreOTLeave"])) {
                    rowData["PreOTLeave"] = rowData["OriPreOTLeave"];
                }
            } else {
                rowData["PreOTFrom"] = '';
                rowData["PreOTTo"] = '';
                rowData["PreOTHours"] = null;

                rowData["PreOTHoursSplit"] = null;
                rowData["PreOTLeave"] = null;

            }

        }

        if (field == "ApprovedAfter") {
            if (checked) {
                if (isNull(rowData["AfterOTFrom"]))
                    rowData["AfterOTFrom"] = rowData["OriAfterOTFrom"];
                if (isNull(rowData["AfterOTTo"]))
                    rowData["AfterOTTo"] = rowData["OriAfterOTTo"];
                console.log(rowData["AfterOTHours"]);
                if (isNull(rowData["AfterOTHours"])) {
                    rowData["AfterOTHours"] = rowData["OriAfterOTHours"];
                    console.log(rowData["OriAfterOTHours"]);
                }

                if (isNull(rowData["AfterOTHoursSplit"])) {
                    rowData["AfterOTHoursSplit"] = rowData["OriAfterOTHoursSplit"];
                }
                if (isNull(rowData["AfterOTLeave"])) {
                    rowData["AfterOTLeave"] = rowData["OriAfterOTLeave"];
                }

            } else {
                rowData["AfterOTFrom"] = '';
                rowData["AfterOTTo"] = '';
                rowData["AfterOTHours"] = null;

                rowData["AfterOTHoursSplit"] = null;
                rowData["AfterOTLeave"] = null;
            }
        }
        /*$grid.pqGrid( "updateRow", {
            rowIndx: indx,
            newRow: rowData
        });*/
    }

    function calHours(row, bFirst) {
        var valFrom;
        var valTo;
        var dataIndx = gbDataIndx;
        if (bFirst == 1) {
            valFrom = isNullOrEmpty(row["PreOTFrom"]) ? "" : (row["PreOTFrom"]).replace(/_/g, "0");
            valTo = isNullOrEmpty(row["PreOTTo"]) ? "" : (row["PreOTTo"]).replace(/_/g, "0");
            if (valFrom == '' || valTo == '') {
                //$('#lblFirstHourW75F4071').html("0.00");
                row["PreOTHours"] = null;
                return true;
            }
            var dFrom = new Date(2000, 0, 1, valFrom.substr(0, 2), valFrom.substr(3, 2))
            var dTo = new Date(2000, 0, 1, valTo.substr(0, 2), valTo.substr(3, 2))
            var diff = (dTo - dFrom) / 1000 / 60 / 60;
            console.log('diff before' + diff);
            if (isNaN(diff)) {
                row[dataIndx] = "";
            }
            else {
                if (diff >= 0) {
                    row["PreOTHours"] = diff.toFixed(2);
                }
                else {
                    row["PreOTHours"] = (24 + diff).toFixed(2)
                }
            }
        }
        else {
            valFrom = isNullOrEmpty(row["AfterOTFrom"]) ? "" : (row["AfterOTFrom"]).replace(/_/g, "0");
            valTo = isNullOrEmpty(row["AfterOTTo"]) ? "" : (row["AfterOTTo"]).replace(/_/g, "0");
            if (valFrom == '' || valTo == '') {
                row["AfterOTHours"] = null;
                return true;
            }
            var dFrom = new Date(2000, 0, 1, valFrom.substr(0, 2), valFrom.substr(3, 2))
            var dTo = new Date(2000, 0, 1, valTo.substr(0, 2), valTo.substr(3, 2))
            var diff = (dTo - dFrom) / 1000 / 60 / 60;
            console.log('diff after' + diff);
            if (diff >= 0) {
                row["AfterOTHours"] = diff.toFixed(2);
            }
            else {
                row["AfterOTHours"] = (24 + diff).toFixed(2)
            }
        }

    }
</script>

