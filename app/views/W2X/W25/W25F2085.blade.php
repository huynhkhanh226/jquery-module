<div class="modal fade" id="modalW25F2085" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($titleW25F2085,"W25F2085",true,"")}}
            </div>
            <form id="frmW25F2085" name="frmW25F2085" class="pd10">
                <div class="row form-group">
                    <div class="col-md-1 col-xs-1">
                        <div class="liketext">
                            <b><label class="lbl-normal">{{Helpers::getRS($g,"Cap_duyet")}}</label></b>
                        </div>

                    </div>
                    <div class="col-md-1 col-xs-1">
                        <select id="cboLevelIDW25F2085" name="cboLevelIDW25F2085" class="form-control" style="width: 100%;">
                            @foreach($levels as $rowLevel)
                                <option value="{{$rowLevel['ApprovalLevel']}}">{{$rowLevel['ApprovalLevel']}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-1">
                        <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Trang_thai")}}</label>
                    </div>
                    <div class="col-md-3">
                        {{Form::select("cbAppStatusIDW25F2085", $statusList ,"All",["class" => "form-control", "id" => "cbAppStatusIDW25F2085"])}}
                    </div>

                    <div class="col-md-2 col-xs-2">
                        <div class="liketext">
                            <b><label class="lbl-normal">{{Helpers::getRS($g,"Phong_ban")}}</label></b>
                        </div>

                    </div>
                    <div class="col-md-4 col-xs-4">
                        {{ Form::select("cboDepartmentIDW25F2085", $departments ,0,["class" => "form-control", "id" => "cboDepartmentIDW25F2085"])}}
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-1 col-xs-1">
                        <div class="liketext">
                            <b><label class="lbl-normal">{{Helpers::getRS($g,"Nam")}}</label></b>
                        </div>

                    </div>
                    <div class="col-md-1 col-xs-1">
                        <select id="cboYearIDW25F2085" name="cboYearIDW25F2085" class="form-control" style="width: 100%;">
                            @foreach($years as $rowYear)
                                <option value="{{$rowYear['YEAR']}}">{{$rowYear['YEAR']}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-1 col-xs-1">
                        <div class="liketext">
                            <b><label class="lbl-normal">{{Helpers::getRS($g,"Vi_tri")}}</label></b>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-3">
                        <select id="cboPositionIDW25F2085" name="cboPositionIDW25F2085" class="form-control" style="width: 100%;">
                            <option value="%">{{Helpers::getRS($g,"Tat_ca_Web")}}</option>
                            @foreach($positions as $row)
                                <option value="{{$row['PositionID']}}">{{$row['PositionName']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-default smallbtn pull-right"><span class="digi digi-filter text-blue"></span>
                            &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                    </div>
                </div>

            </form>
            <div class="row mgt10">
                <div class="col-md-12 col-xs-12">
                    <div id="gridW25F2085" class="mgl10 mgr10"></div>
                </div>

            </div>
            <div class="row mgt10">
                <div class="col-md-12 col-xs-12">
                    <button type="button" id="btnSaveW25F2081" name="btnSaveW25F2081"  {{$perD25F2085 < 2 ? "disabled": ""}}
                            onclick="ask_save(function(){saveData()})"
                            class="btn btn-default smallbtn pull-right mgr10"><span
                                class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function (e) {
        @if ($perD25F2080 <= 2)
                $("#cboDepartmentIDW25F2085").prop("disabled", true);
                $("#cboDepartmentIDW25F2085").val("{{Session::get("W91P0000")['DepartmentID']}}");
        @endif

        var obj = {
            //width: '100%',
            height: $(document).height() - 210,
            //height: 400,
            editable: true,
            freezeCols: 8,
            selectionModel: {type: 'cell'},
            minWidth: 30,
            //pageModel: {type: "local", rPP: 20},
            filterModel: {on: true, mode: "AND", header: false},
            showTitle: false,
            dataType: "JSON",
            wrap: false,
            hwrap: false,
            collapsible: false,
            postRenderInterval: -1,
            numberCell: {show: false},
            colModel: [
                {
                    title: "IsUpdate",
                    minWidth: 170,
                    dataType: "string",
                    dataIndx: "IsUpdate",
                    hidden: true,
                    editable: true
                },
                {
                    title: "IsDifferent",
                    minWidth: 170,
                    dataType: "string",
                    dataIndx: "IsDifferent",
                    hidden: true
                },
                {
                    title: "TransID",
                    minWidth: 170,
                    dataType: "string",
                    dataIndx: "TransID",
                    hidden: true
                },
                {
                    title: "AppStatusID",
                    minWidth: 170,
                    dataType: "string",
                    dataIndx: "AppStatusID",
                    hidden: true
                },

                {
                    title: "{{Helpers::getRS($g,"Cap_duyet")}}",
                    minWidth: 90,
                    dataType: "integer",
                    dataIndx: "ApprovalLevel",
                    align: "center",
                    editable: false,
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return {
                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                        };
                    }
                },

                {
                    title: "{{Helpers::getRS($g,"Trang_thai")}}",
                    minWidth: 90,
                    dataType: "string",
                    dataIndx: "AppStatusName",
                    align: "center",
                    editable: false,
                    render: function (ui) {
                        var rowData = ui.rowData;
                        var rowData = ui.rowData;
                        var str = "";
                        str += "<a title='{{Helpers::getRS($g,"Lich_su_duyet")}}' class='btnViewHistoryW25F2085 mgr10 text-blue'>" + rowData["AppStatusName"] + "</a>";
                        return {
                            text: str,
                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                        };
                    },

                    postRender: function (ui) {
                        var rowIndx = ui.rowIndx,
                            grid = this,
                            $cell = grid.getCell(ui);
                        var row = ui.rowData;
                        //edit button
                        $cell.find(".btnViewHistoryW25F2085").bind("click", function (evt) {
                            showFormDialogPost('{{url("/W09F3030/$pForm/$g")}}', "modalW09F3030", {transID: row["TransID"]},2);
                        });

                    }
                },
                {
                    title: '<a id="IsApproval" onclick="headClick(this)">{{Helpers::getRS($g,"Duyet")}}<a>',

                    minWidth: 50,
                    width: 70,
                    align: "center",
                    dataType: "integer",
                    dataIndx: "IsApproval",
                    editor: true,
                    sortable: false,
                    type: 'checkbox',
                    cb: {
                        all: false,
                        header: true,
                        check: 1,
                        uncheck: 0
                    },
                    //editable: true,
                    editable: function (ui) {
                        var rowData = ui.rowData
                        return $("#cbAppStatusIDW25F2085").val() == 2 || $("#cbAppStatusIDW25F2085").val() == 4? false:true;
                    },
                    render: function (ui) {
                        var row = ui.rowData,
                            checked = row["IsApproval"] == 1 ? 'checked' : '',
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
                                    $gridW25F2085 = $("#gridW25F2085")
                                    var obj = $gridW25F2085.pqGrid("getEditCell");
                                    var $editor = obj.$editor;

                                    if ($editor === undefined) {
                                        var $tr = $(this).closest("tr"),
                                            rowIndx = $gridW25F2085.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                        var rowData = $gridW25F2085.pqGrid("getRowData", {rowIndx: rowIndx});
                                        //reset ApprovalNumber khi check duyệt hoặc không duyệt
                                        //rowData["ApprovalNumber"] = null;
                                        if ($(this).is(":checked") == true) {
                                            rowData["IsUpdate"] = 1;
                                            rowData["NotApproval"] = 0;
                                            rowData["ApprovalNumber"] = rowData["Number"];
                                            //updateRelativeCols(rowData, "ApprovedPre", true, rowIndx);
                                        } else {
                                            rowData["ApprovalNumber"] = 0;
                                            //updateRelativeCols(rowData, "ApprovedPre", false, rowIndx);
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
                    minWidth: 80,
                    width: 90,
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
                        check: 1,
                        uncheck: 0
                    },
                    //editable:true,

                    editable: function (ui) {
                        var rowData = ui.rowData
                        return $("#cbAppStatusIDW25F2085").val() == 2 || $("#cbAppStatusIDW25F2085").val() == 4? false:true;
                    },
                    render: function (ui) {
                        //////console.log(cellData = ui.cellData); //get value checkbox
                        var row = ui.rowData,
                            checked = row["NotApproval"] == 1 ? 'checked' : '',
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
                                    $gridW25F2085 = $("#gridW25F2085")
                                    var obj = $gridW25F2085.pqGrid("getEditCell");
                                    var $editor = obj.$editor;

                                    if ($editor === undefined) {
                                        var $tr = $(this).closest("tr"),
                                            rowIndx = $gridW25F2085.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                        var rowData = $gridW25F2085.pqGrid("getRowData", {rowIndx: rowIndx});
                                        //rowData["ApprovalNumber"] = null;
                                        rowData["IsUpdate"] = 1;
                                        if ($(this).is(":checked") == true) {
                                            rowData["IsApproval"] = 0;
                                            rowData["ApprovalNumber"] = 0;
                                        }
                                        //updateRelativeCols(rowData, "ApprovedPre", false, rowIndx);
                                    } else {
                                        evt.stopPropagation();
                                        evt.preventDefault();
                                    }


                                });
                        }

                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Ten_ke_hoach")}}",
                    minWidth: 340,
                    dataType: "string",
                    dataIndx: "PlanName",
                    editable: false,
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return {
                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                        };
                    },
                },
                {
                    title: "{{Helpers::getRS($g,"Vi_tri_tuyen_dung")}}",
                    minWidth: 230,
                    dataType: "string",
                    dataIndx: "PositionName",
                    editable: false,
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return {
                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                        };
                    },

                },
                {
                    title: "{{Helpers::getRS($g,"Phong_ban")}}",
                    minWidth: 230,
                    dataType: "string",
                    dataIndx: "DepartmentName",
                    editable: false,
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return {
                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                        };
                    },
                },

                {
                    title: "{{Helpers::getRS($g,"To_nhom")}}",
                    minWidth: 230,
                    dataType: "string",
                    dataIndx: "TeamName",
                    editable: false,
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return {
                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                        };
                    },
                },

                {
                    title: "{{Helpers::getRS($g,"Cong_viec")}}",
                    minWidth: 230,
                    dataType: "string",
                    dataIndx: "WorkName",
                    editable: false,
                    hidden: true,
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return {
                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                        };
                    },

                },

                {
                    title: "{{Helpers::getRS($g,"Dinh_muc")}}",
                    minWidth: 140,
                    dataType: "float",
                    dataIndx: "NumQuan",
                    editable: false,
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return {
                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                        };
                    },
                },

                {
                    title: "{{Helpers::getRS($g,"SL_hien_tai")}}",
                    minWidth: 140,
                    dataType: "float",
                    dataIndx: "PresentID",
                    editable: false,
                    format: "{{Helpers::getStringFormat(0)}}",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return {
                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                        };
                    },
                },

                {
                    title: "{{Helpers::getRS($g,"SL_can_tuyen")}}",
                    minWidth: 140,
                    dataType: "float",
                    dataIndx: "Number",
                    editable: false,
                    format: "{{Helpers::getStringFormat(0)}}",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return {
                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                        };
                    },
                },

                {
                    title: "{{Helpers::getRS($g,"SL_duyet_cap_truoc")}}",
                    minWidth: 140,
                    dataType: "float",
                    dataIndx: "PreApprovalQty",
                    format: "{{Helpers::getStringFormat(0)}}",
                    editable: false,
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return {
                            cls: rowData["IsDifferent"] == 1 ? "bg-yellow" : "readonly-status"
                        };
                    },
                },

                {
                    title: "{{Helpers::getRS($g,"Nguoi_duyet_cap_truoc")}}",
                    minWidth: 230,
                    dataType: "string",
                    dataIndx: "PreApprover",
                    editable: false,
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return {
                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                        };
                    },
                },

                {
                    title: "{{Helpers::getRS($g,"SL_duyet")}}",
                    minWidth: 140,
                    dataType: "float",
                    dataIndx: "ApprovalNumber",
                    format: "{{Helpers::getStringFormat(0)}}",
                    required: true,
                    editable: function (ui) {
                        var rowData = ui.rowData;
                        return $("#cbAppStatusIDW25F2085").val() != 2 && rowData["IsApproval"] == 1 ? true: false;
                    },
                    render: function (ui) {
                        var rowData = ui.rowData;
                        console.log(ui.rowData);
                        //alert("render");
                        return {
                            required: this.isEditableCell(ui)?  true: false,
                            cls: this.isEditableCell(ui) == false ? "readonly-status" : "gridColRequire"
                        };
                    },
                },
                {
                    title: "{{Helpers::getRS($g,"Ly_do")}}",
                    minWidth: 340,
                    dataType: "string",
                    dataIndx: "Reason",
                    editable: false,
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return {
                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                        };
                    },
                },
                {
                    title: "{{Helpers::getRS($g,"Ghi_chu")}}",
                    minWidth: 340,
                    dataType: "string",
                    align: "left",
                    dataIndx: "Note",
                    editable: function (ui) {
                        var rowData = ui.rowData
                        return $("#cbAppStatusIDW25F2085").val() == 2 ? false:true;
                    },
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return {
                            cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                        };
                    },

                }
            ],
            dataModel: {
                data: {{json_encode([])}}
            },
            cellSave: function( event, ui ) {
                //$grid = $("#gridW25F2085");
                var rowData = ui.rowData;
                rowData["IsUpdate"] = 1;
                if(ui.dataIndx == 'ApprovalNumber'){
                    rowData["ApprovalNumber"] = formatNumber(rowData["ApprovalNumber"], 0);
                }
                //$("#gridW25F2085").pqGrid("refreshCell", {rowIndx: ui.rowIndx, dataIndx: "IsUpdate"});
            }
        };
        var $gridW25F2085 = $("#gridW25F2085").pqGrid(obj);
        $gridW25F2085.pqGrid("refreshDataAndView");
        setTimeout(function(){
            $gridW25F2085.pqGrid("refreshDataAndView");
        },300);
    });

 /*   function closePopW25F2085(){
        $("#modalW25F2085").modal("hide");
    }*/

    $("#frmW25F2085").on('submit', function (e) {
        e.preventDefault();
        loadDataW25F2085();
    });

    function loadDataW25F2085() {
        $.ajax({
            method: "POST",
            url: '{{url("/W25F2085/$pForm/$g/filter")}}',
            data: $("#frmW25F2085").serialize(),
            success: function (data) {
                console.log(data);
                $("#gridW25F2085").pqGrid("option", "dataModel.data", data);
                $("#gridW25F2085").pqGrid("refreshDataAndView");
            }
        });
    }


    function saveData() {

        var askMessage = "{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}";
        $grid = $("#gridW25F2085");
        $grid.pqGrid("saveEditCell");
        $grid.pqGrid("quitEditMode");
        var obj = $grid.pqGrid("option", "dataModel.data");
        var colModel = $grid.pqGrid("option", "colModel");

        var senderObj = $.grep(obj, function(data){
            return data["NotApproval"] == 1 || data["IsApproval"] == 1;
        });

        if (senderObj.length == 0) {
            alert_warning("{{Helpers::getRS($g,"Ban_chua_chon_du_lieu_tren_luoi")}}", function () {
                /*var idx = $grid.pqGrid("addRow",
                    {rowData: {}}
                );
                //alert(idx);
                $grid.pqGrid("setSelection", {rowIndx: idx, colIndx: 1});*/
            })
            return;
        }

        for (var i = 0; i < senderObj.length; i++) {
            for (var j = 0; j < colModel.length; j++) {
                if (colModel[j].required && isNullOrEmpty(senderObj[i][colModel[j].dataIndx]) && senderObj[i]["IsApproval"] == 1) {
                    $grid.pqGrid("setSelection", {
                        rowIndx: i,
                        colIndx: j
                    });
                    $grid.pqGrid("editCell", {rowIndx: i, dataIndx: colModel[j].dataIndx});
                    var cell = $grid.pqGrid("getEditCell");
                    var $editor = cell.$editor;
                    $($editor).confirmation({
                        btnOkLabel: '',
                        btnCancelLabel: '',
                        popout: true,
                        placement: "bottom",
                        singleton: true,
                        template:
                        '<div class="popover" style="display: inline-flex;"><div class="arrow"></div>'
                        + '<div class="popover-content" style="text-align: center;padding:10px;"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i><label class="confirmContent pull-left">'
                        + askMessage
                        + '</label></span></div>'
                        + '</div>'
                    });
                    $($editor).confirmation('show');
                    e.stopPropagation();
                    e.preventDefault();
                    return;
                }
            }
        }

        console.log(senderObj);
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            url: '{{url("/W25F2085/$pForm/$g/save")}}',
            data: {
                data: senderObj
            },
            success: function (data) {
                $(".l3loading").addClass("hide");
                var rs = JSON.parse(data);
                console.log(rs);
                switch (rs.status) {
                    case "BACKGROUND": //Gửi mail ngầm BACKGROUND
                        save_ok(function () {
                            alert_info("{{Helpers::getRS($g,'Email_da_duoc_gui_toi')}}" + ": <b><i>" + rs.name + "</i></b>");
                            callbackAfterSaveW25F2085();
                        });
                        break;
                    case "SHOWMAIL": //Hiển thị màn hình sendmail
                        save_ok(function () {
                            showEmailPopup(rs.rsvalue,rs.data);
                            callbackAfterSaveW25F2085();
                        });
                        break;
                    case "NOSEND": //Không có gửi mail
                        save_ok(function () {
                            callbackAfterSaveW25F2085();
                        });
                        break;
                    case "ERROR": //Lỗi khi run SQL
                        save_not_ok();
                        //alert_error(rs.message);
                        break;
                }
            }
        });
    }

    function callbackAfterSaveW25F2085(transID){
        //Load lai luoi
        loadDataW25F2085();
        //Load lại alert
        $(".no-menu-alert").load("{{url("/alert")}}");
        //Xoa bang tam
        $.ajax({
            method: "POST",
            url: '{{url("/W25F2085/$pForm/$g/deletetmp")}}',
            data: $("#frmW25F2085").serialize(),
            success: function (data) {
                console.log(data);
            }
        });
    }


    function checkHeadClick(obj, key) {
        var rs = $.grep(obj, function (data, index) {
            return data[key] == 1;
        });
        return rs.length == obj.length ? true : false;
    }


    function headClick(el) {
        if ($("#cbAppStatusIDW25F2085").val() == 1){
            $grid = $("#gridW25F2085");
            var column = $grid.pqGrid( "getColumn",{ dataIndx: "IsApproval" } );
            console.log(column);
            $grid.pqGrid("quitEditMode");
            //$grid.pqGrid("saveEditCell")
            var obj = $grid.pqGrid("option", "dataModel.data");
            if (obj.length > 0) {
                var key = $(el).attr('id');
                var isHeadClick = checkHeadClick(obj, key); //Kiem tra cột hiện tại có headclick chưa, nếu rồi return true;
                setValueHeadClick($grid, key, !isHeadClick);
            }
        }

    }

    function setValueHeadClick($grid, currentKey, check) {
        var relative = '';
        if (currentKey == "IsApproval")
            relative = "NotApproval";
        if (currentKey == "NotApproval")
            relative = "IsApproval";

        var checkNum = (check == true ? 1 : 0);
        var obj = $grid.pqGrid("option", "dataModel.data");
        if (obj.length > 0) {
            for (var i = 0; i < obj.length; i++) {
                obj[i][currentKey] = checkNum;
                if (checkNum == 1 && obj[i][relative] == 1) {
                    obj[i][relative] = 0;
                }
                if (currentKey == "IsApproval") {
                    updateRelativeCols(obj[i], 'IsApproval', checkNum, i);
                }
                if (currentKey == "NotApproval" && check) {
                    updateRelativeCols(obj[i], 'NotApproval', checkNum, i);
                }
            }
            $grid.pqGrid("option", "dataModel.data", obj);
            $grid.pqGrid("refreshDataAndView");
        }

    }

    function isNull(val) {
        return (val === null || val === "" || val === undefined || (!isNaN(val) && format2(val, '', 0) == format2(0, '', 0))) ? true : false;
    }

    function updateRelativeCols(rowData, field, checked, indx) {
        console.log('updateRelativeCols');
        $grid = $("#gridW25F2085");
        if (field == "IsApproval") {
            if (checked == 1) {
                if (isNull(rowData["ApprovalNumber"]))
                    rowData["ApprovalNumber"] = rowData["Number"];
            } else {
                rowData["ApprovalNumber"] = 0;
            }
        }

        if (field == "NotApproval") {
            rowData["ApprovalNumber"] = 0;
        }

    }

</script>