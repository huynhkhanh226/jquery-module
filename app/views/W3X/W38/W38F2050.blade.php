<div class="modal fade" id="modalW38F2050" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($titleW38F2050,"W38F2050",true,"")}}
            </div>
            <div class="modal-body" style="padding:10px">
                <form class="form-horizontal" id="frmW38F2050">
                    <div class="row form-group">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-4 liketext">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Cap_duyet")}}</label>
                                </div>
                                <div class="col-md-8 liketext">
                                    <select class="form-control"
                                            id="cbApprovalLevelW38F2050" name="cbApprovalLevelW38F2050"
                                            placeholder="">
                                        @foreach($cbApprovalLevel as $rowStatus)
                                            <option value="{{$rowStatus['ApprovalLevel']}}">{{$rowStatus['ApprovalLevel']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-4 liketext">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Trang_thai")}}</label>
                                </div>
                                <div class="col-md-8 liketext">
                                    <select class="form-control"
                                            id="cbStatusIDW38F2050" name="cbStatusIDW38F2050"
                                            placeholder="">
                                        @foreach($cbstatus as $rowStatus)
                                            <option value="{{$rowStatus['ID']}}">{{$rowStatus['Name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-3 liketext">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Phong_ban")}}</label>
                                </div>
                                <div class="col-md-9 liketext">
                                    <select class="form-control"
                                            id="cbDepartmentIDW38F2050" name="cbDepartmentIDW38F2050"
                                            placeholder="">
                                        @foreach($departments as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-4 liketext">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Nam")}}</label>
                                </div>
                                <div class="col-md-8 liketext">
                                    <select class="form-control"
                                            id="cbYearW38F2050" name="cbYearW38F2050"
                                            placeholder="">
                                        @foreach($cbYear as $row)
                                            <option value="{{$row['YEAR']}}">{{$row['YEARNAME']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-4 liketext">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Don_vi")}}</label>
                                </div>
                                <div class="col-md-8 liketext">
                                    <select class="form-control"
                                            id="cbDivisionIDW38F2050" name="cbDivisionIDW38F2050"
                                            placeholder="">
                                        @foreach($cbDivision as $rowStatus)
                                            <option value="{{$rowStatus['DivisionID']}}">{{$rowStatus['DivisionName']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <button class="btn btn-default smallbtn pull-right" style="padding-top: 4px"><span
                                                class="digi digi-filter text-orange"></span>
                                        &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row  form-group">
                        <div class="col-md-6 col-xs-6">
                            <div id="pqgrid_W38F2050_1"></div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div id="pqgrid_W38F2050_2"></div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12 col-xs-12 ">
                            <button type="button" id="frm_btnSave"
                                    class="btn btn-default smallbtn pull-right"
                                    title="{{Helpers::getRS($g,"Luu")}}"
                                    onclick="ask_save(function(){save()})">
                                <span class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        //mặc định cho combo năm là "tất cả"
        $('#cbYearW38F2050').val('%');

        $('#txtDateFromW38F2050').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });

        $('#txtDateToW38F2050').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });

        loadGrid_1();
        loadGrid_2();
    });
    $("#frmW38F2050").on('submit', function (e) {
        e.preventDefault();
        //alert("da chay fillter");
        filterGrid();
    });

    function filterGrid() {
        $("#pqgrid_W38F2050_1").pqGrid("showLoading");
        $("#pqgrid_W38F2050_2").pqGrid("showLoading");
        $.ajax({
            method: "POST",
            url: '{{url("/W38F2050/$pForm/$g/filter")}}',
            data: $("#frmW38F2050").serialize(),
            success: function (data) {
                console.log(data);
                $("#pqgrid_W38F2050_1").pqGrid("option", "dataModel.data", data['grid1']);
                $("#pqgrid_W38F2050_1").pqGrid("refreshDataAndView");
                $("#pqgrid_W38F2050_1").pqGrid("hideLoading");

                $("#pqgrid_W38F2050_2").pqGrid("option", "dataModel.data", data['grid2']);
                $("#pqgrid_W38F2050_2").pqGrid("refreshDataAndView");
                $("#pqgrid_W38F2050_2").pqGrid("hideLoading");
            }
        });
    }
    
    function viewDetailGrid2(ProposalID) {
        $("#pqgrid_W38F2050_2").pqGrid("showLoading");
        $.ajax({
            method: "POST",
            url: '{{url("/W38F2050/$pForm/$g/viewDetailGrid2")}}',
            data: $("#frmW38F2050").serialize() + "&ProposalID=" + ProposalID,
            success: function (data) {
                console.log(data);
                $("#pqgrid_W38F2050_2").pqGrid("option", "dataModel.data", data);
                $("#pqgrid_W38F2050_2").pqGrid("refreshDataAndView");
                $("#pqgrid_W38F2050_2").pqGrid("hideLoading");
            }
        });
    }
    
    function loadGrid_1() {
        //console.log(valueGrid);
        $(document).ready(function () {
            var iW38F2050_Height = $(document).height() - 230;

            var objW38F2050_1 = {
                width: '100%',
                height: iW38F2050_Height,
                showTitle: false,
                collapsible: false,
                selectionModel: {type: 'row', mode: 'single'},
                scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
                rowBorders: true,
                columnBorders: true,
                postRenderInterval: -1,
                freezeCols: 5,
                hwrap: false,
                wrap: false,
                sortable: false,
                numberCell: {show: false},
                editModel: {
                    saveKey: $.ui.keyCode.ENTER,
                    select: true,
                    keyUpDown: false,
                    cellBorderWidth: 0,
                    clicksToEdit: 1
                },
                colModel: [
                    {
                        title: 'AppStatusID',
                        minWidth: 90,
                        align: "left",
                        dataIndx: "AppStatusID",
                        isExport: false,
                        editor: false,
                        hidden: true
                    },
                    {
                        title: 'ProposalID',
                        minWidth: 90,
                        align: "left",
                        dataIndx: "ProposalID",
                        isExport: false,
                        editor: false,
                        hidden: true
                    },
                    {
                        title: '{{Helpers::getRS($g,"Trang_thai")}}',
                        minWidth: 100,
                        dataType: "string",
                        editor: false,
                        editable: true,
                        align: "center",
                        dataIndx: "AppStatusName",
                        render: function (ui) {
                            var rowData = ui.rowData;
                            var str = "";
                            str += "<a title='{{Helpers::getRS($g,"Lich_su_duyet")}}' class='btnViewHistoryW09F2020 mgr10 text-blue'>" + rowData["AppStatusName"] + "</a>";
                            return str;
                        },
                        postRender: function (ui) {
                            var rowIndx = ui.rowIndx,
                                grid = this,
                                $cell = grid.getCell(ui);
                            var row = ui.rowData;
                            //edit button
                            $cell.find(".btnViewHistoryW09F2020").bind("click", function (evt) {
                                showFormDialogPost('{{url("/W09F3030/$pForm/$g")}}', "modalW09F3030", {transID: row["ProposalID"]},2);
                            });
                        }
                    },
                    {
                        title: '<a id="Approval" onclick="headClick(this)">{{Helpers::getRS($g,"Duyet")}}</a>',
                        width: 70,
                        align: "center",
                        dataType: "integer",
                        dataIndx: "Approval",
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
                        //editable: true,
                        editable: function (ui) {
                            var rowData = ui.rowData;
                            return Number(rowData.Ischeck) == 0 ? true : false;
                        },
                        render: function (ui) {
                            var row = ui.rowData,
                                checked = row["Approval"] == 1 ? 'checked' : '',
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
                                        pqgrid_W38F2050_1 = $("#pqgrid_W38F2050_1");
                                        ui.rowData.IsUpdate = 1;
                                        var obj = pqgrid_W38F2050_1.pqGrid("getEditCell");
                                        var $editor = obj.$editor;
                                        //console.log($editor);
                                        if ($editor === undefined) {
                                            var $tr = $(this).closest("tr"),
                                                rowIndx = pqgrid_W38F2050_1.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                            var rowData = pqgrid_W38F2050_1.pqGrid("getRowData", {rowIndx: rowIndx});
                                            if ($(this).is(":checked") == true) {
                                                rowData["NotApproval"] = 0;
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
                        title: '<a id="NotApproval" onclick="headClick(this)">{{Helpers::getRS($g,"Khong_duyet")}}</a>',
                        width: 100,
                        align: "center",
                        dataType: "integer",
                        dataIndx: "NotApproval",
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
                        //editable: true,
                       editable: function (ui) {
                            var rowData = ui.rowData;
                            return Number(rowData.Ischeck) == 0 ? true : false;
                        },
                        render: function (ui) {
                            var row = ui.rowData,
                                checked = row["NotApproval"] == 1 ? 'checked' : '',
                                disabled = this.isEditableCell(ui)? "" : "disabled";

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
                                        pqgrid_W38F2050_1 = $("#pqgrid_W38F2050_1");
                                        ui.rowData.IsUpdate = 1;
                                        var obj = pqgrid_W38F2050_1.pqGrid("getEditCell");
                                        var $editor = obj.$editor;
                                        //console.log($editor);
                                        if ($editor === undefined) {
                                            var $tr = $(this).closest("tr"),
                                                rowIndx = pqgrid_W38F2050_1.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                            var rowData = pqgrid_W38F2050_1.pqGrid("getRowData", {rowIndx: rowIndx});
                                            if ($(this).is(":checked") == true) {
                                                rowData["Approval"] = 0;
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
                        title: 'IsUpdate',
                        minWidth: 90,
                        align: "left",
                        dataIndx: "IsUpdate",
                        isExport: false,
                        editor: false,
                        hidden: true
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ten_khoa_ke_hoach_DT_nam")}}',
                        minWidth: 400,
                        align: "left",
                        dataType: "string",
                        dataIndx: "ProposalName",
                        isExport: true,
                        editor: false,
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Don_vi")}}',
                        minWidth: 300,
                        dataType: "string",
                        dataIndx: "DivisionName",
                        editor: false,
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Phong_ban")}}',
                        minWidth: 300,
                        dataType: "string",
                        editor: false,
                        dataIndx: "DepartmentName",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Tong_chi_phi_quy_doi")}}',
                        minWidth: 150,
                        editor: false,
                        align : "right",
                        dataIndx: "ProCCost",
                        format: "{{Helpers::getStringFormat(2)}}",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ngay_de_xuat")}}',
                        minWidth: 150,
                        editor: false,
                        align : "center",
                        dataIndx: "ProposalDate",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Nguoi_cap_duyet_truoc")}}',
                        minWidth: 150,
                        editor: false,
                        dataIndx: "PreApproverName",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ghi_chu")}}',
                        minWidth: 250,
                        editor: true,
                        dataIndx: "Notes",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    }
                ],
                dataModel: {
                    data: [],
                    location: "local",
                    sorting: "local",
                    sortDir: "down"
                },
                complete: function (event, ui) {
                    console.log('complete grid');

                },
                rowClick: function (event, ui) {
                    var rowData = ui.rowData;
                    viewDetailGrid2(rowData['ProposalID']);
                }/*,
                cellSave: function (event, ui) {
                    console.log("cellSave");
                    ui.rowData.IsUpdate = 1;
                    var rowData = ui.rowData;
                    //format before saveing
                    console.log(ui);
                    //End format
                    $("#pqgrid_W38F2050_1").pqGrid("refreshDataAndView");
                }*/
            };
            //obj1.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
            $("#pqgrid_W38F2050_1").pqGrid(objW38F2050_1);
            $("#pqgrid_W38F2050_1").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#pqgrid_W38F2050_1").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            setTimeout(function () {
                $("#pqgrid_W38F2050_1").pqGrid("refreshDataAndView");
            }, 700)


        });
    }

    function loadGrid_2() {
        //console.log(valueGrid);
        $(document).ready(function () {
            var iW38F2050_Height_2 = $(document).height() - 230;

            var objW38F2050_2 = {
                width: '100%',
                height: iW38F2050_Height_2,
                showTitle: false,
                collapsible: false,
                selectionModel: {type: 'row', mode: 'single'},
                scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
                rowBorders: true,
                columnBorders: true,
                postRenderInterval: -1,
                //freezeCols: 5,
                hwrap: false,
                wrap: false,
                sortable: false,
                numberCell: {show: false},
                colModel: [
                    {
                        title: 'ProTransID',
                        minWidth: 90,
                        align: "left",
                        dataIndx: "ProTransID",
                        isExport: false,
                        editor: false,
                        hidden: true
                    },
                    {
                        title: 'ProposalID',
                        minWidth: 90,
                        align: "left",
                        dataIndx: "ProposalID",
                        isExport: false,
                        editor: false,
                        hidden: true
                    },
                    {
                        title: '{{Helpers::getRS($g,"Linh_vuc_dao_tao")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "TrainingFieldName",
                        align: "left",
                        editor: false,
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Khoa_dao_tao")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "TrainingCourseName",
                        editor: false,
                        align: "left",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Doi_tuong_dao_tao")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "TrainingObjectName",
                        editor: false,
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"TG_bat_dau")}}',
                        minWidth: 100,
                        dataType: "string",
                        dataIndx: "FromDate",
                        align: "center",
                        editor: false,
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"TG_ket_thuc")}}',
                        minWidth: 100,
                        dataType: "string",
                        dataIndx: "ToDate",
                        align: "center",
                        editor: false,
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Nguoi_dao_tao")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "TrainningEmpName",
                        editor: false,
                        align: "left",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Noi_dung")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "Content",
                        editor: false,
                        align: "left",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Muc_dich_dao_tao")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "TrainingPurpose",
                        editor: false,
                        align: "left",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"So_luong_nv_du_kien")}}',
                        minWidth: 190,
                        dataType: "float",
                        dataIndx: "ProNumber",
                        editor: true,
                        format: "{{Helpers::getStringFormat(0)}}",
                        align: "right",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: "{{Helpers::getRS($g,"Tong_chi_phi_quy_doi")}}",
                        minWidth: 150,
                        dataType: "float",
                        dataIndx: "ProCCost",
                        editor: false,
                        align: "right",
                        format: "{{Helpers::getStringFormat(2)}}",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Loai_tien")}}',
                        minWidth: 170,
                        dataType: "string",
                        dataIndx: "CurrencyName",
                        editor: false,
                        align: "left",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ghi_chu")}}',
                        minWidth: 250,
                        editor: false,
                        dataIndx: "Notes",
                        align: "left",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    }
                ],
                dataModel: {
                    data: [],
                    location: "local",
                    sorting: "local",
                    sortDir: "down"
                },
                complete: function (event, ui) {
                    console.log('complete grid');

                },
                rowClick: function (event, ui) {

                }/*,
                cellSave: function (event, ui) {
                    console.log("cellSave");
                    ui.rowData.IsUpdate = 1;
                    var rowData = ui.rowData;
                    //format before saveing
                    console.log(ui);
                    //End format
                    $("#pqgrid_W38F2050_1").pqGrid("refreshDataAndView");
                }*/
            };
            //obj1.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
            $("#pqgrid_W38F2050_2").pqGrid(objW38F2050_2);
            $("#pqgrid_W38F2050_2").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#pqgrid_W38F2050_2").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            setTimeout(function () {
                $("#pqgrid_W38F2050_2").pqGrid("refreshDataAndView");
            }, 700)


        });
    }
    function checkHeadClick(obj, key) {
        // console.log("Check");
        //Lay ra nhung dong co the headclick va da check
        var rs1 = $.grep(obj, function (data, index) {
            return data[key] == 1;
        });
        return obj.length == rs1.length ? true : false;
    }

    function headClick(el) {
        console.log("da click");
        $grid = $("#pqgrid_W38F2050_1");
        $grid.pqGrid("quitEditMode");
        var obj = $grid.pqGrid("option", "dataModel.data");
        if (obj.length > 0) {
            var key = $(el).attr('id'); //id == Approval || NotApproval
            var isHeadClick = checkHeadClick(obj, key); //Kiem tra cột hiện tại có headclick chưa, nếu rồi return true;
            setValueHeadClick($("#pqgrid_W38F2050_1"), key, !isHeadClick);
        }
    }

    function setValueHeadClick($grid, currentKey, check) {
        var relative = '';
        if (currentKey == "Approval")
            relative = "NotApproval";
        if (currentKey == "NotApproval")
            relative = "Approval";

        var checkNum = (check == true ? 1 : 0);
        var obj = $grid.pqGrid("option", "dataModel.data");
        if (obj.length > 0) {
            for (var i = 0; i < obj.length; i++) {
                if ((currentKey == "Approval" || currentKey == "NotApproval") && Number(obj[i]["Ischeck"]) == 0) {
                    obj[i][currentKey] = checkNum;
                    if (checkNum == 1 && obj[i][relative] == 1) {
                        obj[i][relative] = 0;
                    }
                    obj[i]["IsUpdate"] = 1;
                    //updateIsUpdate(rowData);
                }
            }
            $grid.pqGrid("option", "dataModel.data", obj);
            $grid.pqGrid("refreshDataAndView");
            //console.log(obj);
        }
    }

    function save() {
        var data = $("#pqgrid_W38F2050_1").pqGrid("option", "dataModel.data");
        var dataSender = $.grep(data, function (d) {
            return (Number(d.Approval) == 1 || Number(d.NotApproval) ==1);
        });
        if (dataSender.length > 0) {
            $.ajax({
                method: "POST",
                url: '{{url("/W38F2050/$pForm/$g/save")}}',
                data: {
                    dataSender: dataSender,
                    aprovalLV: $("#cbApprovalLevelW38F2050").val()
                },
                success: function (data) {
                    console.log(data);
                    var rs = JSON.parse(data);
                    console.log(rs);
                    switch (rs.status){
                        case "BACKGROUND": //Gửi mail ngầm
                            //$("#mPopUp").find(".modal-body").html("<div class='col-md-12'><h4>  <i class='fa fa-chevron-circle-down' ></i> {{Helpers::getRS($g,"Du_lieu_da_luu_thanh_cong")}}</h4><div class='col-md-12 alert-success-approve'>{{Helpers::getRS($g,'Mail_da_duoc_gui_toi')}} &nbsp;<b>" + rs.name+ "</b></div>");
                            //$("#mPopUp").modal('show');
                            save_ok(function(){
                                alert_info("{{Helpers::getRS($g,'Email_da_duoc_gui_toi')}}" + ": <b><i>" + rs.name + "</i></b>");
                                filterGrid();
                            });
                            break;
                        case "SHOWMAIL": //Hiển thị màn hình sendmail
                            save_ok(function(){
                                showEmailPopup(rs.rsvalue,rs.data);
                                filterGrid();
                            });
                            break;
                        case "NOSEND": //Không có gửi mail
                            save_ok(function(){
                                filterGrid();
                            });
                            break;
                        case "ERROR": //Lỗi khi run SQL
                            save_not_ok();
                            alert_error(rs.message);
                            break;
                    }
                }
            });
        } else {
            alert_warning("Chưa có cập nhật nào mới");
        }
    }
</script>