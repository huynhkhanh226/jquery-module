<div class="modal fade modal noneOverflow noUseValidHTML5" id="modalW75F2100" data-keyboard="false"
     data-backdrop="static"
     role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="form-horizontal">
                <div class="modal-header">
                    {{Helpers::generateHeading($modalTitle,"W75F2100")}}
                </div>
                <div class="modal-body" style="padding:10px">
                    <form id="frmW75F2100" name="frmW75F2100" method="post">
                        <div class="row form-group">
                            <div class="col-md-5">
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
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Phong_ban")}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-control"
                                                id="cbDepartmentID" name="cbDepartmentID"
                                                placeholder="">
                                            @foreach($department as $key=>$value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="checkbox col-md-1 mgt10">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Trang_thai")}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-control"
                                                id="cbStatusID" name="cbStatusID"
                                                placeholder="">
                                            @foreach($statusList as $rowStatus)
                                                <option value="{{$rowStatus['ID']}}">{{$rowStatus['Name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Vi_tri")}}</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-control"
                                                id="cbRecPositionID" name="cbRecPositionID"
                                                placeholder="">
                                            @foreach($posList as $rowPos)
                                                <option value="{{$rowPos['RecPositionID']}}">{{$rowPos['RecPositionName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-default smallbtn pull-right" style="padding-top: 4px"><span
                                            class="digi digi-filter"></span>
                                    &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                            </div>
                        </div>

                        <div class="row  form-group">
                            <div class="col-md-12">
                                <div id="pqgrid_W75F2100" style="margin:auto;height: 300px;"></div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6 col-xs-6 ">
                                <button type="button" id="frm_btnUpdaSalaryObject" disabled="disabled"
                                        class="btn btn-default smallbtn pull-left"
                                        title="{{Helpers::getRS($g,"Cap_nhat_thong_so_luong_theo_doi_tuong_tinh_luong")}}"
                                        >
                                    <span class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Cap_nhat_thong_so_luong_theo_doi_tuong_tinh_luong")}}
                                </button>
                            </div>

                            <div class="col-md-6 col-xs-6 ">
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
        $('#cbStatusID').val("0");
    });
    var valueGrid = {{$valueGrid}};
    var valueCaption = {{json_encode($caption)}};
    //console.log(valueCaption);
    loadGrid();


    function loadGrid() {
        ////console.log(valueGrid);
        $(document).ready(function () {
            var iW25F3020_1Height = $(document).height() - 220;

            var obj1 = {
                width: '100%',
                height: iW25F3020_1Height,
                showTitle: false,
                collapsible: false,
                selectionModel: {type: 'cell', mode: 'single'},
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
                    clicksToEdit: 2
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
                        editable: function (ui) {
                            var row = ui.rowData
                            //return (row.ischeck == 0 && row.TransferedD09 == 0) ? true : false; //Chi duoc edit khi cho duyet & tranfer
                            return (Number(row.ischeck) == 0 && Number(row.TransferedD09) == 0) ? true : false; //Chi duoc edit khi cho duyet & tranfer
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
                                        pqgrid_W75F2100 = $("#pqgrid_W75F2100");
                                        ui.rowData.IsUpdate = 1;
                                        var obj = pqgrid_W75F2100.pqGrid("getEditCell");
                                        var $editor = obj.$editor;
                                        ////console.log($editor);
                                        if ($editor === undefined) {
                                            var $tr = $(this).closest("tr"),
                                                rowIndx = pqgrid_W75F2100.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                            var rowData = pqgrid_W75F2100.pqGrid("getRowData", {rowIndx: rowIndx});
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
                        editable: function (ui) {
                            var row = ui.rowData;
                            //console.log(row);
                            //return (row.ischeck == 0 && row.TransferedD09 == 0) ? true : false; //Chi duoc edit khi cho duyet & tranfer
                            return (Number(row.ischeck) == 0 && Number(row.TransferedD09) == 0) ? true : false; //Chi duoc edit khi cho duyet & tranfer
                        },
                        render: function (ui) {
                            var row = ui.rowData,
                                checked = row["NotApproved"] == 1 ? 'checked' : '',
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
                                        pqgrid_W75F2100 = $("#pqgrid_W75F2100");
                                        ui.rowData.IsUpdate = 1;
                                        var obj = pqgrid_W75F2100.pqGrid("getEditCell");
                                        var $editor = obj.$editor;
                                        ////console.log($editor);
                                        if ($editor === undefined) {
                                            var $tr = $(this).closest("tr"),
                                                rowIndx = pqgrid_W75F2100.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                            var rowData = pqgrid_W75F2100.pqGrid("getRowData", {rowIndx: rowIndx});
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
                        title: '{{Helpers::getRS($g,"Ma_ung_vien")}}',
                        minWidth: 90,
                        align: "left",
                        dataIndx: "CandidateID",
                        isExport: true,
                        editor: false,
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ten_ung_vien")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "CandidateName",
                        editor: false,
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Khoi")}}',
                        minWidth: 130,
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
                        minWidth: 150,
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
                        title: '{{Helpers::getRS($g,"To_nhom")}}',
                        minWidth: 90,
                        editor: false,
                        dataIndx: "TeamName",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Vi_tri")}}',
                        minWidth: 200,
                        editor: false,
                        dataIndx: "RecPositionName",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Cong_viec")}}',
                        minWidth: 160,
                        editor: false,
                        dataIndx: "WorkName",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Gioi_tinh")}}',
                        minWidth: 80,
                        align: "center",
                        dataIndx: "SexName",
                        isExport: true,
                        editor: false,
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
                        title: '{{Helpers::getRS($g,"Dia_chi")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "ContactAddress",
                        editor: false,
                        align: "left",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }

                    },
                    {
                        title: '{{Helpers::getRS($g,"Dien_thoai")}}',
                        minWidth: 100,
                        dataType: "string",
                        dataIndx: "Telephone",
                        editor: false,
                        align: "center",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }

                    },
                    {
                        title: '{{Helpers::getRS($g,"Email")}}',
                        minWidth: 160,
                        dataType: "string",
                        dataIndx: "Email",
                        editor: false,
                        align: "left",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }

                    },
                    {
                        title: '{{Helpers::getRS($g,"Hinh_thuc_lam_viec")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "WorkingStatusName",
                        editor: false,
                        align: "left",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }

                    },
                    {
                        title: '{{Helpers::getRS($g,"Dia_diem")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "WorkingPlace",
                        editor: false,
                        align: "left",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }

                    }
                    @foreach($caption as $row)
                    , {
                        title: "{{$row['CaptionName']}}",
                        minWidth: 150,
                        align: "right",
                        dataType: "float",
                        //format: "{{Helpers::getStringFormat(0)}}",//returnSFormat(0),
                        dataIndx: "{{$row['CaptionField']}}",
                        hidden: '{{$row["Disabled"] == 1 ? true:false}}',
                        editable: function (ui) {
                            var row = ui.rowData
                            return (Number(row.ischeck) == 0 && Number(row.TransferedD09) == 0) ? true : false; //Chi duoc edit khi cho duyet & tranfer//ischeck = 1 khi da duyet hoac tu choi, TransferedD09 =0 thi cho edit
                        },
                        render: function (ui) {
                            //console.log(ui.rowData);
                            var rowData = ui.rowData;
                            var num = rowData["{{$row['CaptionField']}}"].toString().replace(/,/g, "");
                            var disabled = this.isEditableCell(ui) ? "" : "disabled";
                            //console.log(num);
                            return {
                                text: format2(num, '', 0),
                                cls: (disabled ? "readonly-status" : "")
                            };
                        }
                    }
                    @endforeach
                    ,
                    {
                        title: '{{Helpers::getRS($g,"Nguoi_duyet")}}',
                        minWidth: 160,
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
                        align: "left",
                        render: function (ui) {
                            return {
                                cls: "readonly-status"
                            };
                        }

                    },
                    {
                        title: "{{Helpers::getRS($g,"Dinh_kem")}}",
                        minWidth: 100,
                        dataType: "string",
                        dataIndx: "Attachment",
                        align: "center",
                        editor: false,
                        render: function (ui) {
                            var rowData = ui.rowData;
                            var disabled = (Number(rowData['Attachment']) != 0) ? "" : "disabled";
                            return {
                                text: "<a class='glyphicon glyphicon-paperclip' id = 'btnAttachmentW75F2100' style='margin-top:2px;color:orange; font-size: 80%'>(" + rowData['Attachment'] +")</a>",
                                cls: (disabled ? "readonly-status" : "")
                            };
                        },
                        postRender: function (ui) {
                            var grid = this, $cell = grid.getCell(ui);
                            var rowData = ui.rowData;
                            //downLoad
                            if(Number(rowData['Attachment']) != 0){
                                $cell.find("a#btnAttachmentW75F2100").unbind("click").bind("click", function (evt) {
                                    // console.log(ui.rowData.CandidateID);
                                    //alert("ab");
                                    showFormDialogPost('{{url("/W09F4010/D25F2020/$g")}}', "modalW09F4010",
                                        {
                                            formCall: "W75F2100",
                                            keyID: rowData['CandidateID'],
                                            tableName: 'D25T2011'
                                        },2);
                                });
                            }
                        }
                        //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: 'SalaryObjectID',
                        minWidth: 100,
                        dataType: "string",
                        dataIndx: "SalaryObjectID",
                        editor: false,
                        align: "left",
                        hidden: true

                    }

                ],
                dataModel: {
                    data: valueGrid,
                    location: "local",
                    sorting: "local",
                    sortDir: "down"
                },
                complete: function (event, ui) {
                    //console.log('complete grid');

                },
                rowClick: function (event, ui) {

                },
                cellSave: function (event, ui) {
                    //console.log("cellSave");
                    ui.rowData.IsUpdate = 1;
                    $("#pqgrid_W75F2100").pqGrid("refreshDataAndView");
                    //Enabled button duoi theo tai lieu Incident 106515
                    $("#frm_btnUpdaSalaryObject").removeAttr('disabled');
                }
            };
            obj1.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
            $("#pqgrid_W75F2100").pqGrid(obj1);
            $("#pqgrid_W75F2100").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#pqgrid_W75F2100").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            setTimeout(function () {
                $("#pqgrid_W75F2100").pqGrid("refreshDataAndView");
            }, 700)


        });
    }

    $("#frmW75F2100").on('submit', function (e) {
        e.preventDefault();
        ////console.log("da chay fillter");
        filterGrid();
    });

    function filterGrid() {
        $("#pqgrid_W75F2100").pqGrid("showLoading");
        var datef = $('#txtDate').data('daterangepicker').startDate.format('DD/MM/YYYY');
        var datet = $('#txtDate').data('daterangepicker').endDate.format('DD/MM/YYYY');
        $.ajax({
            method: "POST",
            url: '{{url("/W75F2100/$pForm/$g/filter")}}',
            data: $("#frmW75F2100").serialize() + '&datefrom=' + datef + '&dateto=' + datet,
            success: function (data) {
                // //console.log(data);
                $("#pqgrid_W75F2100").pqGrid("option", "dataModel.data", data);
                $("#pqgrid_W75F2100").pqGrid("refreshDataAndView");
                $("#pqgrid_W75F2100").pqGrid("hideLoading");
            }
        });
    }


    function checkHeadClick(obj, key) {
        // //console.log("Check");
        //Lay ra nhung dong co the headclick
        var rs1 = $.grep(obj, function (data, index) {
            return (data["TransferedD09"] == 0 && Number(data["ischeck"]) == 0);
        });

        //Lay ra nhung dong co the headclick va da check
        var rs2 = $.grep(obj, function (data, index) {
            return (data["TransferedD09"] == 0 && Number(data["ischeck"]) == 0) && data[key] == 1;
        });

        return rs1.length == rs2.length ? true : false;
    }

    function headClick(el) {
        if ($("#cbStatusID").val() == 0 || $("#cbStatusID").val() == "%"){
            $grid = $("#pqgrid_W75F2100");
            $grid.pqGrid("quitEditMode");
            var obj = $grid.pqGrid("option", "dataModel.data");
            if (obj.length > 0) {
                var key = $(el).attr('id'); //id == Approved || NotApproved
                var isHeadClick = checkHeadClick(obj, key); //Kiem tra cột hiện tại có headclick chưa, nếu rồi return true;
                setValueHeadClick($("#pqgrid_W75F2100"), key, !isHeadClick);
            }
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
                if (  (currentKey == "Approved" || currentKey == "NotApproved") && Number(obj[i]["ischeck"]) == 0 && obj[i]["TransferedD09"] == 0) {
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
            ////console.log(obj);
        }
    }

    function save() {
        var data = $("#pqgrid_W75F2100").pqGrid("option", "dataModel.data");
        var dataSender = $.grep(data, function (d) {
            return d.IsUpdate == 1;
        });
        if (dataSender.length > 0) {
            $.ajax({
                method: "POST",
                url: '{{url("/W75F2100/$pForm/$g/save")}}',
                data: {
                    dataSender: dataSender
                },
                success: function (data) {
                    //console.log(data);
                    if (data.status == 1) {
                        save_ok(function () {
                            filterGrid();
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

    $("#frm_btnUpdaSalaryObject").click(function(){
        $grid = $("#pqgrid_W75F2100");
        var data = $grid.pqGrid("option", "dataModel.data");
        data = $.grep(data,function(row){
            return row["IsUpdate"] == 1 && row["SalaryObjectID"] != "";
        });
        if (data.length > 0){
            continueConfirm(0, data);
        }
    });

    function continueConfirm(i, data){
        if (data[i]["SalaryObjectID"] == "" || data[i]["SalaryObjectID"] == null){
            alert_custom(icon_warning, "{{Helpers::getRS($g, 'Ma_ung_vien')}}"+ " " + data[i]["CandidateID"] + " " + "{{Helpers::getRS($g, 'chua_co_doi_tuong_tinh_tuong_Ban_co_muon_bo_qua_va_cap_nhat_tiep_khong')}}", true, true, function(){
                //callback Yes
                if (i < data.length - 1){
                    continueConfirm(i + 1, data);
                }else{
                    //save data after confirmed
                    updateSalaryObject(data);
                }
            }, function(){
                //callback No
                //not to do nothing
            });
        }else{
            updateSalaryObject(data);
        }

    }

    function updateSalaryObject(data){
        $grid = $("#pqgrid_W75F2100");
        $(".l3loading").removeClass("hide");
        postMethod('{{url("/W75F2100/$pForm/$g/updatesalaryobject")}}', function(res){
            $(".l3loading").addClass("hide");
            var data = JSON.parse(res);
            var origin = $grid.pqGrid("option", "dataModel.data");
            //console.log(data);
            for (var i=0;i<data.length; i++){
                for (var j=0;j<origin.length; j++){
                    if (data[i]["CandidateID"] == origin[j]["CandidateID"]){

                        var obj = data[i];
                        obj = JSON.parse(JSON.stringify(obj))
                        $grid.pqGrid("updateRow", {rowIndx: j, newRow:obj , checkEditable: false});
                        $grid.pqGrid("refreshDataAndView");
                    }
                }
            }

            var origin = $grid.pqGrid("option", "dataModel.data");
            console.log(origin);
            /*
            for (var j=0;j<origin.length; j++){
                origin[j]["IsUpdate"] = 0;
            }
            $grid.pqGrid("option", "dataModel.data",origin);
            var origin = $grid.pqGrid("option", "dataModel.data");
            console.log(origin);*/
            save_ok();
        }, {data: JSON.stringify(reformatData(data,$("#pqgrid_W75F2100")))})
    }
</script>