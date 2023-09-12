<div class="modal fade modal noneOverflow noUseValidHTML5" id="modalW75F2130" data-keyboard="false"
     data-backdrop="static"
     role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="form-horizontal">
                <div class="modal-header">
                    {{Helpers::generateHeading($modalTitle,"W75F2130")}}
                </div>
                <div class="modal-body" style="padding:10px">
                    <form id="frmW75F2130" name="frmW75F2130" method="post">
                        <div class="row form-group">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ngay")}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group" style="margin-top: 6px">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="col-md-12 active " id="txtDate" type="text" name="txtDate"
                                                   readonly="true" value="{{date('01/m/Y').' - '.date('t/m/Y')}}"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Khoi")}}</label>
                                    </div>
                                    <div class="col-md-9 liketext">
                                        <select class="form-control"
                                                id="cbBlockIDW75F2130" name="cbBlockIDW75F2130"
                                                placeholder="">
                                            @foreach($block as $row)
                                                <option value="{{$row['BlockID']}}">{{$row['BlockName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"To_nhom")}}</label>
                                    </div>
                                    <div class="col-md-9 liketext">
                                        <select class="form-control"
                                                id="cbTeamIDW75F2130" name="cbTeamIDW75F2130"
                                                placeholder="">
                                            @foreach($team as $row)
                                                <option value="{{$row['TeamID']}}">{{$row['TeamName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Trang_thai")}}</label>
                                    </div>
                                    <div class="col-md-9 liketext">
                                        <select class="form-control"
                                                id="cbStatusIDW75F2130" name="cbStatusIDW75F2130"
                                                placeholder="">
                                            @foreach($statusList as $rowStatus)
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
                                                id="cbDepartmentIDW75F2130" name="cbDepartmentIDW75F2130"
                                                placeholder="">
                                            @foreach($department as $key=>$value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Nhan_vien")}}</label>
                                    </div>
                                    <div class="col-md-9 liketext">
                                        <select class="form-control"
                                                id="cbEmployeeW75F2130" name="cbEmployeeW75F2130"
                                                placeholder="">
                                            @foreach($employee as $row)
                                                <option value="{{$row['EmployeeID']}}">{{$row['EmployeeName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 col-xs-12 ">
                                <button class="btn btn-default smallbtn pull-right" style="padding-top: 4px"><span
                                            class="digi digi-filter"></span>
                                    &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                            </div>
                        </div>
                        <div class="row  form-group">
                            <div class="col-md-12 col-xs-12">
                                <div id="pqgrid_W75F2130"></div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 col-xs-12 ">
                                <button type="button" id="frm_btnSave"
                                        class="btn btn-default smallbtn pull-right"
                                        title="{{Helpers::getRS($g,"Luu")}}"
                                        onclick="ask_save(function(){save()})">
                                    <span class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#txtDate').daterangepicker({format: 'DD/MM/YYYY'});
        $('#cbBlockIDW75F2130').val("%");
        $('#cbEmployeeW75F2130').val("%");
        $('#cbStatusIDW75F2130').val("0");
    });
    var valueGrid = {{$valueGrid}};
    loadGrid();

    $("#cbBlockIDW75F2130").change(function () {
        //alert("hello");
        $.ajax({
            method: "POST",
            url: '{{url("/W75F2130/$pForm/$g/blockChange")}}',
            data: '&teamID=' + $("#cbTeamIDW75F2130").val() + '&departmentID=' + $("#cbDepartmentIDW75F2130").val() + '&blockID=' + $("#cbBlockIDW75F2130").val(),
            success: function (data) {
                //console.log(data);
                $("#cbDepartmentIDW75F2130").html(data.dep);
                $("#cbDepartmentIDW75F2130").val('%');
                $("#cbDepartmentIDW75F2130").trigger("change");
                $("#cbEmployeeW75F2130").html(data.employee);
                $("#cbEmployeeW75F2130").val('%');
            }
        });
    });

    $("#cbDepartmentIDW75F2130").change(function () {
        //alert("hello");
        $.ajax({
            method: "POST",
            url: '{{url("/W75F2130/$pForm/$g/departmentChange")}}',
            data: '&teamID=' + $("#cbTeamIDW75F2130").val() + '&departmentID=' + $("#cbDepartmentIDW75F2130").val() + '&blockID=' + $("#cbBlockIDW75F2130").val(),
            success: function (data) {
                //console.log(data);
                $("#cbTeamIDW75F2130").html(data.team);
                $("#cbTeamIDW75F2130").val('%');
                $("#cbTeamIDW75F2130").trigger("change");
                $("#cbEmployeeW75F2130").html(data.employee);
                $("#cbEmployeeW75F2130").val('%');
            }
        });
    });

    $("#cbTeamIDW75F2130").change(function () {
        //alert("hello");
        $.ajax({
            method: "POST",
            url: '{{url("/W75F2130/$pForm/$g/teamChange")}}',
            data: '&teamID=' + $("#cbTeamIDW75F2130").val() + '&departmentID=' + $("#cbDepartmentIDW75F2130").val() + '&blockID=' + $("#cbBlockIDW75F2130").val(),
            success: function (data) {
                console.log(data);
                $("#cbEmployeeW75F2130").html(data);
                $("#cbEmployeeW75F2130").val('%');
            }
        });
    });

    function loadGrid() {
        //console.log(valueGrid);
        $(document).ready(function () {
            var iW75F2130_Height = $(document).height() - 280;

            var obj1 = {
                width: '100%',
                height: iW75F2130_Height,
                showTitle: false,
                collapsible: false,
                selectionModel: {type: 'row', mode: 'single'},
                scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
                rowBorders: true,
                columnBorders: true,
                postRenderInterval: -1,
                freezeCols: 2,
                hwrap: false,
                wrap: false,
                sortable: false,
                editModel: {
                    saveKey: $.ui.keyCode.ENTER,
                    select: true,
                    keyUpDown: false,
                    cellBorderWidth: 0,
                    clicksToEdit: 1
                },
                toolbar: {
                    items: [
                        /*{
                            type: 'select',
                            label: 'Format: ',
                            attr: 'id="export_format"',
                            options: [{ xls: 'Excel'}]
                        },*/
                        {
                            type: 'button',
                            label: "Export",
                            icon: 'ui-icon-arrowthickstop-1-s',
                            listener: function () {
                                var format = 'xls',
                                    blob = this.exportData({
                                        //url: "/pro/demos/exportData",
                                        format: format,
                                        render: false
                                    });

                                if (typeof blob === "string") {
                                    blob = new Blob([blob]);
                                }
                                saveAs(blob, "Duyet_de_xuat_tuyen_dung." + format);
                                //exportExcel();
                            }
                        }]
                },
                colModel: [
                    {
                        title: '<a id="Approved" onclick="headClick(this)">{{Helpers::getRS($g,"Duyet")}}</a>',
                        width: 70,
                        align: "center",
                        dataType: "integer",
                        dataIndx: "Approved",
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
                            return Number(rowData.Checked) == 0 ? true : false;
                        },
                        render: function (ui) {
                            var row = ui.rowData,
                                checked = row["Approved"] == 1 ? 'checked' : '',
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
                                        pqgrid_W75F2130 = $("#pqgrid_W75F2130");
                                        ui.rowData.IsUpdate = 1;
                                        var obj = pqgrid_W75F2130.pqGrid("getEditCell");
                                        var $editor = obj.$editor;
                                        //console.log($editor);
                                        if ($editor === undefined) {
                                            var $tr = $(this).closest("tr"),
                                                rowIndx = pqgrid_W75F2130.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                            var rowData = pqgrid_W75F2130.pqGrid("getRowData", {rowIndx: rowIndx});
                                            if ($(this).is(":checked") == true) {
                                                rowData["NotApproved"] = 0;
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
                        title: '<a id="NotApproved" onclick="headClick(this)">{{Helpers::getRS($g,"Khong_duyet")}}</a>',
                        width: 100,
                        align: "center",
                        dataType: "integer",
                        dataIndx: "NotApproved",
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
                            return Number(rowData.Checked) == 0 ? true : false;
                        },
                        render: function (ui) {
                            var row = ui.rowData,
                                checked = row["NotApproved"] == 1 ? 'checked' : '',
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
                                        pqgrid_W75F2130 = $("#pqgrid_W75F2130");
                                        ui.rowData.IsUpdate = 1;
                                        var obj = pqgrid_W75F2130.pqGrid("getEditCell");
                                        var $editor = obj.$editor;
                                        //console.log($editor);
                                        if ($editor === undefined) {
                                            var $tr = $(this).closest("tr"),
                                                rowIndx = pqgrid_W75F2130.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                            var rowData = pqgrid_W75F2130.pqGrid("getRowData", {rowIndx: rowIndx});
                                            if ($(this).is(":checked") == true) {
                                                rowData["Approved"] = 0;
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
                        title: '{{Helpers::getRS($g,"Ma_NV")}}',
                        minWidth: 120,
                        align: "left",
                        dataIndx: "EmployeeID",
                        isExport: true,
                        editor: false,
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ho_va_ten")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "EmployeeName",
                        editor: false,
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Don_vi")}}',
                        minWidth: 130,
                        dataType: "string",
                        editor: false,
                        dataIndx: "DivisionName",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Khoi")}}',
                        minWidth: 150,
                        dataType: "string",
                        editor: false,
                        dataIndx: "BlockName",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Phong_ban")}}',
                        minWidth: 160,
                        editor: false,
                        dataIndx: "DepartmentName",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"To_nhom")}}',
                        minWidth: 200,
                        editor: false,
                        dataIndx: "TeamName",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Chuc_vu")}}',
                        minWidth: 160,
                        editor: false,
                        dataIndx: "DutyName",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Cong_viec")}}',
                        minWidth: 160,
                        align: "center",
                        dataIndx: "WorkName",
                        isExport: true,
                        editor: false,
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Gioi_tinh")}}',
                        minWidth: 100,
                        dataType: "string",
                        dataIndx: "SexName",
                        editor: false,
                        align: "center",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }

                    },
                    {
                        title: '{{Helpers::getRS($g,"Ngay_sinh")}}',
                        minWidth: 100,
                        dataType: "string",
                        dataIndx: "Birthdate",
                        editor: false,
                        align: "center",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }

                    },
                    {
                        title: '{{Helpers::getRS($g,"Ma_nguoi_duyet")}}',
                        minWidth: 160,
                        dataType: "string",
                        dataIndx: "ApproverID",
                        editor: false,
                        align: "left",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }

                    },
                    {
                        title: '{{Helpers::getRS($g,"Nguoi_duyet")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "ApproverName",
                        editor: false,
                        align: "left",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }

                    },
                    {
                        title: '{{Helpers::getRS($g,"Ngay_duyet")}}',
                        minWidth: 100,
                        dataType: "string",
                        dataIndx: "AppDate",
                        editor: false,
                        align: "center",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }

                    },
                    {
                        title: '{{Helpers::getRS($g,"Noi_dung")}}',
                        minWidth: 160,
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
                        title: '{{Helpers::getRS($g,"Cap_khen_thuong")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "DisRewardLevelName",
                        editor: false,
                        align: "left",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }

                    },
                    {
                        title: '{{Helpers::getRS($g,"Hinh_thuc_khen_thuong")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "DisRewardFormName",
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
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "Notice",
                        editor: false,
                        align: "left",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }

                    }@foreach($caption as $row)
                    , {
                        title: "{{$row['CaptionName']}}",
                        minWidth: 100,
                        align: "right",
                        dataType: "float",
                        //format: "{{--{{Helpers::getStringFormat(0)}}--}}",//returnSFormat(0),
                        dataIndx: "{{$row['CD']}}",
                        hidden: '{{$row["DISABLED"] == 1 ? true:false}}',
                        format: returnSFormat({{$row['Decimals']}}),
                        dynamicColumn: true,
                        decimals: "{{$row['Decimals']}}",
                        editable: function (ui) {
                            var rowData = ui.rowData;
                            return Number(rowData.Checked) == 0 ? true : false;
                        },
                        render: function (ui) {
                            //console.log(ui.rowData);
                            var rowData = ui.rowData;
                            var num = rowData["{{$row['CD']}}"].toString().replace(/,/g, "");
                            var disabled = this.isEditableCell(ui) ? "" : "disabled";
                            return {
                                //text: format2(num, '',{{$row['Decimals']}}),
                                cls: (disabled ? "readonly-status" : "")
                            };
                        }
                    }
                    @endforeach

                ],
                dataModel: {
                    data: valueGrid,
                    location: "local",
                    sorting: "local",
                    sortDir: "down"
                },
                complete: function (event, ui) {
                    console.log('complete grid');

                },
                rowClick: function (event, ui) {

                },
                cellSave: function (event, ui) {
                    console.log("cellSave");
                    ui.rowData.IsUpdate = 1;
                    var rowData = ui.rowData;
                    //format before saveing
                    console.log(ui);
                    if (ui.column.dynamicColumn == true){
                        rowData[ui.dataIndx] = format2(rowData[ui.dataIndx], '', ui.column.decimals);
                    }
                    //End format
                    $("#pqgrid_W75F2130").pqGrid("refreshDataAndView");
                }
            };
            //obj1.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
            $("#pqgrid_W75F2130").pqGrid(obj1);
            $("#pqgrid_W75F2130").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#pqgrid_W75F2130").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            setTimeout(function () {
                $("#pqgrid_W75F2130").pqGrid("refreshDataAndView");
            }, 700)


        });
    }

    $("#frmW75F2130").on('submit', function (e) {
        e.preventDefault();
        //alert("da chay fillter");
        filterGrid();
    });

    function filterGrid() {
        //$("#pqgrid_W75F2130").pqGrid("showLoading");
        var datef = $('#txtDate').data('daterangepicker').startDate.format('DD/MM/YYYY');
        var datet = $('#txtDate').data('daterangepicker').endDate.format('DD/MM/YYYY');
        $.ajax({
            method: "POST",
            url: '{{url("/W75F2130/$pForm/$g/filter")}}',
            data: $("#frmW75F2130").serialize() + '&datefrom=' + datef + '&dateto=' + datet,
            success: function (data) {
                // console.log(data);
                $("#pqgrid_W75F2130").pqGrid("option", "dataModel.data", data);
                $("#pqgrid_W75F2130").pqGrid("refreshDataAndView");
                $("#pqgrid_W75F2130").pqGrid("hideLoading");
            }
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
        $grid = $("#pqgrid_W75F2130");
        $grid.pqGrid("quitEditMode");
        var obj = $grid.pqGrid("option", "dataModel.data");
        if (obj.length > 0) {
            var key = $(el).attr('id'); //id == Approved || NotApproved
            var isHeadClick = checkHeadClick(obj, key); //Kiem tra cột hiện tại có headclick chưa, nếu rồi return true;
            setValueHeadClick($("#pqgrid_W75F2130"), key, !isHeadClick);
        }
    }

    function setValueHeadClick($grid, currentKey, check) {
        var relative = '';
        if (currentKey == "Approved")
            relative = "NotApproved";
        if (currentKey == "NotApproved")
            relative = "Approved";

        var checkNum = (check == true ? 1 : 0);
        var obj = $grid.pqGrid("option", "dataModel.data");
        if (obj.length > 0) {
            for (var i = 0; i < obj.length; i++) {
                if ((currentKey == "Approved" || currentKey == "NotApproved") && Number(obj[i]["Checked"]) == 0) {
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
        var data = $("#pqgrid_W75F2130").pqGrid("option", "dataModel.data");
        var dataSender = $.grep(data, function (d) {
            return ((Number(d.IsUpdate) == 1 && Number(d.Approved) == 1) || (Number(d.IsUpdate) == 1 && Number(d.NotApproved) ==1));
        });
        if (dataSender.length > 0) {
            $.ajax({
                method: "POST",
                url: '{{url("/W75F2130/$pForm/$g/save")}}',
                data: {
                    dataSender: dataSender
                },
                success: function (data) {
                    console.log(data);
                    if (data.status == 1) {
                        filterGrid();
                        save_ok(function () {
                        });
                    } else {
                        save_not_ok();
                    }
                }
            });
        } else {
            alert_warning("Chưa có cập nhật nào mới");
        }
    }
</script>