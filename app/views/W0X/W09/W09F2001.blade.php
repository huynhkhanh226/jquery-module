<div class="modal fade" id="modalW09F2001" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($titleW09F2001,"W09F2001",true,"")}}
            </div>
            <div class="modal-body">
                @if ($task == "add")
                    @define  $BlockID = intval($perD09F5650) <=2 ? Session::get("W91P0000")['BlockID'] : $blockList[0]["BlockID"]
                    @define  $DepartmentID = intval($perD09F5650) <=2 ? Session::get("W91P0000")['DepartmentID'] : ''
                    @define  $TeamID = ""
                    @define  $WorkID  = ""
                    @define  $EmployeeID  = ""
                    @define  $EmployeeName  = ""
                    @define  $ContractTypeID  = ""
                    @define  $Seniority  = ""
                    @define  $SalaryProposalID = ""
                    @define  $SalaryProposalName   = ""
                    @define  $ValidDate =  date("d/m/Y")
                    @define  $ReasonName   = ""
                    @define  $ProName   = ""
                    @define  $VoucherDate = date("d/m/Y")
                    @define  $ProposerID = Session::get("W91P0000")['CreatorHR'];
                    @define  $ProposerName = Session::get("W91P0000")['CreatorNameHR'];

                @elseif ($task == "view" || $task == "edit")
                    @define  $BlockID = $rsMasterData[0]["BlockID"]
                    @define  $DepartmentID = $rsMasterData[0]["DepartmentID"]
                    @define  $TeamID = $rsMasterData[0]["TeamID"]
                    @define  $WorkID  = ""
                    @define  $EmployeeID  = ""
                    @define  $EmployeeName  = ""
                    @define  $ContractTypeID  = ""
                    @define  $Seniority  = ""

                    @define  $SalaryProposalID = $rsMasterData[0]["SalaryProposalID"]
                    @define  $SalaryProposalName = $rsMasterData[0]["SalaryProposalName"]
                    @define  $ValidDate =  $rsMasterData[0]["ValidDate"]
                    @define  $ReasonName   = $rsMasterData[0]["ReasonName"]
                    @define  $ProName   = $rsMasterData[0]["ProName"]
                    @define  $VoucherDate = $rsMasterData[0]["VoucherDate"]
                    @define  $ProposerID = $rsMasterData[0]["ProposerID"]
                    @define  $ProposerName = $rsMasterData[0]["ProposerName"]
                @else

                @endif


                <div id="divScrollW09F2001" style="height: 400px;padding: 10px;">
                    <form class="form-horizontal" id="frmW09F2001_Filter">
                        <fieldset>
                            <legend class="legend mgb5">{{Helpers::getRS($g,"Dieu_kien_loc")}}</legend>
                            <div class="row form-group">
                                <div class="col-md-1">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Khoi")}}</label>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control"
                                            id="cboBlockIDW09F2001" name="cboBlockIDW09F2001"
                                            {{intval($perD09F5650) <=2 || $task == "edit" ? "disabled": ""}}
                                            placeholder="">
                                        @foreach($blockList as $rowBlock)
                                            <option value="{{$rowBlock['BlockID']}}" {{$BlockID == $rowBlock['BlockID'] ? 'selected' : ''}}>{{$rowBlock['BlockName']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"To_nhom")}}</label>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control"
                                            id="cboTeamIDW09F2001" name="cboTeamIDW09F2001"
                                            placeholder="">
                                        @foreach($teamList as $rowTeam)
                                            <option value="{{$rowTeam['TeamID']}}" >{{$rowTeam['TeamName']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ma_NV")}}</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="txtEmployeeIDW09F2001"
                                           value=""
                                           name="txtEmployeeIDW09F2001">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-1">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Phong_ban")}}</label>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control"
                                            id="cboDepartmentIDW09F2001" name="cboDepartmentIDW09F2001"
                                            {{intval($perD09F5650) <=2 || $task == "edit" ? "disabled": ""}}
                                            placeholder="">
                                        @foreach($departmentList as $rowDepartment)
                                            <option value="{{$rowDepartment['DepartmentID']}}" {{$DepartmentID == $rowDepartment['DepartmentID'] ? 'selected' : ''}}>{{$rowDepartment['DepartmentName']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Cong_viec")}}</label>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control"
                                            id="cbWorkIDW09F2001" name="cbWorkIDW09F2001"
                                            placeholder="">
                                        @foreach($workList as $rowWork)
                                            <option value="{{$rowWork['WorkID']}}">{{$rowWork['WorkName']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ten_NV")}}</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="txtEmployeeNameW09F2001"
                                           value=""
                                           name="txtEmployeeNameW09F2001">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-1">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Loai_HDLD")}}</label>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control"
                                            id="cboContractTypeIDW09F2001" name="cboContractTypeIDW09F2001"
                                            placeholder="">
                                        @foreach($contractTypeList as $rowContractType)
                                            <option value="{{$rowContractType['ContractTypeID']}}">{{$rowContractType['ContractTypeName']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Tham_nien")}}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <label class="lbl-normal pdr0 liketext">&#x3E;=</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control text-right" id="txtSeniorityW09F2001"
                                                   value="" name="txtSeniorityW09F2001">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="lbl-normal pdr0 liketext">{{"(".Helpers::getRS($g,"Thang").")"}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-default smallbtn pull-right" style="padding-top: 4px"><span
                                                class="digi digi-filter"></span>
                                        &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                                </div>
                            </div>
                        </fieldset>
                        <button type="submit" id="hdBtnSaveW09F2001" class="hidden"></button>
                    </form>
                    <form class="form-horizontal" id="frmW09F2001_Master">
                        <fieldset>
                            <legend class="legend mgb5">{{Helpers::getRS($g,"Thong_tin_chung")}}</legend>
                            <div class="row form-group">
                                <div class="col-md-1">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Dien_giai")}}</label>
                                </div>
                                <div class="col-md-11">
                                    <input type="text" class="form-control" id="txtSalaryProposalNameW09F2001"
                                           value="{{$SalaryProposalName}}"
                                           name="txtSalaryProposalNameW09F2001" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-1">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ngay_hieu_luc")}}</label>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="txtValidDateW09F2001"
                                               name="txtValidDateW09F2001" value="{{$ValidDate}}" required><span
                                                class="input-group-addon"><i
                                                    onclick="showDate()"
                                                    class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-1">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ly_do")}}</label>
                                </div>
                                <div class="col-md-11">
                                    <input type="text" class="form-control" id="txtReasonNameW09F2001"
                                           value="{{$ReasonName}}"
                                           name="txtReasonNameW09F2001">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-1">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ghi_chu")}}</label>
                                </div>
                                <div class="col-md-11">
                                    <input type="text" class="form-control" id="txtProNoteW09F2001"
                                           value="{{$ProName}}"
                                           name="txtProNoteW09F2001">
                                </div>
                            </div>
                        </fieldset>
                        <button type="submit" id="hdBtnSaveW09F2001" class="hidden"></button>
                    </form>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <div id="gridDetailW09F2001"></div>
                        </div>
                    </div>

                    <div class=" row form-group">
                        <div class="col-md-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="chkIsSelectedW09F2022" {{($task == "edit" || $task=="view") ? 'disabled checked' : ''}}
                                           name="chkIsSelectedW09F2022"> {{Helpers::getRS($g,"Chi_hien_thi_du_lieu_da_chon")}}
                                </label>
                            </div>

                        </div>
                        <div class="col-md-1">
                            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ngay_lap")}}</label>
                        </div>
                        <div class="col-md-1">
                            <label class="lbl-value pdr0 liketext">{{$VoucherDate}}</label>
                        </div>
                        <div class="col-md-1">
                            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Nguoi_lap")}}</label>
                        </div>
                        <div class="col-md-1">
                            <label class="lbl-value pdr0 liketext">{{$ProposerName}}</label>
                        </div>
                        @if ($task == "edit" || $task == "add")
                        <div class="col-md-5">
                            <div class="pull-right">
                                <button type="button" id="btnSaveW09F2001" name="btnSaveW09F2001"
                                        class="btn btn-default smallbtn"><span
                                            class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                                </button>
                                <button type="button" id="btnNotSaveW09F2001" name="btnNotSaveW09F2001"
                                        class="btn btn-default smallbtn"><span
                                            class="fa fa-ban text-red mgr5"></span> {{Helpers::getRS($g,"Khong_luu")}}
                                </button>
                            </div>
                        </div>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var dataDetailGrid = [];
    var task = '{{$task}}';
    $(document).ready(function (e) {
        if (task == "add"){
            setTimeout(function(){
                //$("#cboBlockIDW09F2001").trigger("change");
            },300);
        }
        $("#divScrollW09F2001").height($(document).height() - 110);

        $('#txtValidDateW09F2001').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });

        loadDetailGridW09F2001();
        /*$("#divScrollW09F2001").mCustomScrollbar(
            {
                axis: "y",
                theme: "rounded-dark",
                scrollButtons: {enable: true},
                autoExpandScrollbar: true,
                advanced: {autoExpandHorizontalScroll: true},
                scrollInertia: 100,
                //scrollbarPosition:"outside"
            });*/

        $("#cboBlockIDW09F2001").change(function () {
            $(".l3loading").removeClass('hide');
            $.ajax({
                method: "POST",
                url: '{{url("/W09F2001/$pForm/$g/reloaddepartment")}}',
                data: {blockID: $(this).val()},
                success: function (data) {
                    $("#cboDepartmentIDW09F2001").html(data);
                    $("#cboDepartmentIDW09F2001").trigger("change");
                }
            });
        });

        $("#cboDepartmentIDW09F2001").change(function () {
            $.ajax({
                method: "POST",
                url: '{{url("/W09F2001/$pForm/$g/reloadteam")}}',
                data: {departmentID: $(this).val()},
                success: function (data) {
                    $("#cboTeamIDW09F2001").html(data);
                    $(".l3loading").addClass('hide');
                }
            });
        });
        enableControls(task);
    });

    function showDate(){
        if (task == "add" || task == "edit"){
            $('#txtValidDateW09F2001').datepicker('show');
        }

    };

    function loadDetailGridW09F2001() {
        var obj = {
            width: '100%',
            height: $(document).height() - 435,
            freezeCols: 2,
            numberCell: {show: false},
            selectionModel: {type: 'row'},
            //selectionModel: { type: null },
            minWidth: 30,
            pasteModel: {on: false},
            pageModel: {type: "local", rPP: 20},
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
            showTitle: false,
            dataType: "JSON",
            wrap: false,
            hwrap: false,
            collapsible: false,
            postRenderInterval: -1,
            //resizable: false,
            complete: function (event, ui) {
                $("#chkAllW09F2001").show();
            },
            cellSave: function (event, ui) {
                var value = ui.newVal;
                var column = $("#gridDetailW09F2001").pqGrid("getColumn", {dataIndx: ui.dataIndx});
                if (column.dataType == "float" || column.dataType == "integer") {
                    ui.rowData[ui.dataIndx] = formatNumber(ui.rowData[ui.dataIndx], column.decimals);
                }
            }
        };

        obj.colModel = [
            {
                dataIndx: "IsUsed",
                align: "center",
                title: "<label><input id='chkAllW09F2001' type='checkbox' class='visibility' /></label>",
                cb: {header: true, select: true, all: true},
                /*cb: {
                    all: false,
                    header: true,
                    check: "1",
                    uncheck: "0"
                },*/
                type: 'checkbox',
                cls: 'ui-state-default',
                dataType: 'bool',
                editor: false,
                sortable: false,
                //filter: { type: "checkbox", subtype: 'triple', condition: "equal", listeners: ['click'] },
                /*editable: function (ui) {
                    var row = ui.rowData
                    return  "{{--{{$task == "add" ? true : false}}--}}";
                },*/
                editable: true,
                hidden: "{{$task == "add" ? false : true}}",
                render: function (ui) {
                    var row = ui.rowData,
                        disabled = this.isEditableCell(ui) ? "" : "disabled";

                    return {
                        cls: (disabled ? "readonly-status" : "")
                    };
                }
            },

            {
                title: "{{Helpers::getRS($g,'Ma_NV')}}",
                minWidth: 140,
                align: "left",
                dataType: "string",
                editor: false,
                editable: false,
                dataIndx: "EmployeeID",
                hidden: false,
                sortable: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                editable: function (ui) {
                    var row = ui.rowData
                    return false;
                },
                render: function (ui) {
                    var row = ui.rowData,
                        disabled = this.isEditableCell(ui) ? "" : "disabled";

                    return {
                        cls: (disabled ? "readonly-status" : "")
                    };
                }
            },
            {
                title: "{{Helpers::getRS($g,'Ho_va_ten')}}",
                minWidth: 170,
                align: "left",
                dataType: "string",
                editor: false,
                editable: false,
                dataIndx: "EmployeeName",
                hidden: false,
                sortable: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                editable: function (ui) {
                    var row = ui.rowData
                    return false;
                },
                render: function (ui) {
                    var row = ui.rowData,
                        disabled = this.isEditableCell(ui) ? "" : "disabled";

                    return {
                        cls: (disabled ? "readonly-status" : "")
                    };
                }
            },
            {
                title: "{{Helpers::getRS($g,'Khoi')}}",
                minWidth: 170,
                dataType: "string",
                editor: false,
                dataIndx: "BlockName",
                sortable: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                editable: function (ui) {
                    var row = ui.rowData
                    return false;
                },
                render: function (ui) {
                    var row = ui.rowData,
                        disabled = this.isEditableCell(ui) ? "" : "disabled";

                    return {
                        cls: (disabled ? "readonly-status" : "")
                    };
                }
            },
            {
                title: "{{Helpers::getRS($g,'Phong_ban')}}",
                minWidth: 170,
                dataType: "string",
                editor: false,
                dataIndx: "DepartmentName",
                sortable: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                editable: function (ui) {
                    var row = ui.rowData
                    return false;
                },
                render: function (ui) {
                    var row = ui.rowData,
                        disabled = this.isEditableCell(ui) ? "" : "disabled";

                    return {
                        cls: (disabled ? "readonly-status" : "")
                    };
                }
            },
            {
                title: "{{Helpers::getRS($g,'To_nhom')}}",
                minWidth: 170,
                dataType: "string",
                editor: false,
                dataIndx: "TeamName",
                sortable: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                editable: function (ui) {
                    var row = ui.rowData
                    return false;
                },
                render: function (ui) {
                    var row = ui.rowData,
                        disabled = this.isEditableCell(ui) ? "" : "disabled";

                    return {
                        cls: (disabled ? "readonly-status" : "")
                    };
                }
            },
            {
                title: "{{Helpers::getRS($g,'Cong_viec')}}",
                minWidth: 170,
                dataType: "string",
                editor: false,
                dataIndx: "WorkName",
                sortable: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                editable: function (ui) {
                    var row = ui.rowData
                    return false;
                },
                render: function (ui) {
                    var row = ui.rowData,
                        disabled = this.isEditableCell(ui) ? "" : "disabled";

                    return {
                        cls: (disabled ? "readonly-status" : "")
                    };
                }
            },
            {
                title: "{{Helpers::getRS($g,'Loai_HDLD')}}",
                minWidth: 170,
                dataType: "string",
                editor: false,
                dataIndx: "ContractTypeName",
                sortable: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                editable: function (ui) {
                    var row = ui.rowData
                    return false;
                },
                render: function (ui) {
                    var row = ui.rowData,
                        disabled = this.isEditableCell(ui) ? "" : "disabled";

                    return {
                        cls: (disabled ? "readonly-status" : "")
                    };
                }
            },
            {
                title: "{{Helpers::getRS($g,'Ngay_vao_lam')}}",
                minWidth: 110,
                align: "center",
                dataType: "date",
                editor: false,
                dataIndx: "DateJoined",
                sortable: false,
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']},
                editable: function (ui) {
                    var row = ui.rowData
                    return false;
                },
                render: function (ui) {
                    var row = ui.rowData,
                        disabled = this.isEditableCell(ui) ? "" : "disabled";

                    return {
                        cls: (disabled ? "readonly-status" : "")
                    };
                }
            },
            {
                title: "{{Helpers::getRS($g,'Tham_nien')}}",
                minWidth: 110,
                align: "center",
                dataType: "interger",
                editor: false,
                dataIndx: "Seniority",
                sortable: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                editable: function (ui) {
                    var row = ui.rowData
                    return false;
                },
                render: function (ui) {
                    var row = ui.rowData,
                        disabled = this.isEditableCell(ui) ? "" : "disabled";

                    return {
                        cls: (disabled ? "readonly-status" : "")
                    };
                }
            }
            @foreach($rsColumns as $row)
            , {
                title: "{{$row['CaptionName']}}",
                minWidth: 80,
                width: 140,
                dataType: "float",
                align: "right",
                decimals: "{{$row['Decimals']}}",
                format: returnSFormat({{$row['Decimals']}}),
                dataIndx: "{{$row['Field']}}",
                hidden: "{{$row['Disabled'] == 1 ? true: false}}",
                sortable: false,
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                editable: function (ui) {
                    var row = ui.rowData
                    return false;
                },
                render: function (ui) {
                    var row = ui.rowData,
                        disabled = this.isEditableCell(ui) ? "" : "disabled";

                    return {
                        cls: (disabled ? "readonly-status" : "")
                    };
                }
            }
            @endforeach
            , {
                title: "{{Helpers::getRS($g,'Ngay_dieu_chinh_gan_nhat')}}",
                minWidth: 210,
                align: "center",
                dataType: "date",
                hidden: true,
                editor: false,
                dataIndx: "LastAdjustDate",
                sortable: false,
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']},
                editable: function (ui) {
                    var row = ui.rowData
                    return false;
                },
                render: function (ui) {
                    var row = ui.rowData,
                        disabled = this.isEditableCell(ui) ? "" : "disabled";

                    return {
                        cls: (disabled ? "readonly-status" : "")
                    };
                }
            },
            {
                title: "{{Helpers::getRS($g,'Ly_do')}}",
                minWidth: 170,
                editor: false,
                dataType: "string",
                dataIndx: "ReasonName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                sortable: false,
                editable: function (ui) {
                    var row = ui.rowData
                    return false;
                },
                render: function (ui) {
                    var row = ui.rowData,
                        disabled = this.isEditableCell(ui) ? "" : "disabled";

                    return {
                        cls: (disabled ? "readonly-status" : "")
                    };
                }
            },
            {
                title: "{{Helpers::getRS($g,'So_lan_ky_luat')}}",
                minWidth: 110,
                align: "center",
                dataType: "float",
                format: returnSFormat(0),
                editor: false,
                dataIndx: "TimesDiscipline",
                sortable: false,
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                editable: function (ui) {
                    var row = ui.rowData
                    return false;
                },
                render: function (ui) {
                    var row = ui.rowData,
                        disabled = this.isEditableCell(ui) ? "" : "disabled";

                    return {
                        cls: (disabled ? "readonly-status" : "")
                    };
                }
            }
            @foreach($rsColumns as $row)
            , {
                @if ($lang == "84")
                title: "<a onclick='headclickW09F2001(this)' id='{{"New".$row['Field']}}'>{{$row['CaptionName'].' mới'}}</a>",
                @else
                title: "<a onclick='headclickW09F2001(this)' id='{{"New".$row['Field']}}'>{{'New '.$row['CaptionName']}}</a>",
                @endif
                minWidth: 80,
                width: 170,
                dataType: "float",
                align: "right",
                decimals: "{{$row['Decimals']}}",
                format: returnSFormat({{$row['Decimals']}}),
                dataIndx: "{{"New".$row['Field']}}",
                hidden: "{{$row['Disabled'] == 1 ? true: false}}",
                sortable: false,
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                editable: function (ui) {
                    var row = ui.rowData
                    return row["IsUsed"] == 1 && (task == "add" || task == "edit") ? true : false;
                },
                render: function (ui) {
                    var row = ui.rowData,
                        disabled = this.isEditableCell(ui) ? "" : "disabled";

                    return {
                        cls: (disabled ? "readonly-status" : "")
                    };
                }
            }
            @endforeach
        ];
        obj.dataModel = {
            data: {{json_encode($rsDetailData)}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        };
        //obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
        var $grid = $("#gridDetailW09F2001").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
        setTimeout(function () {
            resizePqGrid();
            /*$("#divScrollW09F2001").mCustomScrollbar(
                {
                    axis: "y",
                    theme: "rounded-dark",
                    scrollButtons: {enable: true},
                    autoExpandScrollbar: true,
                    advanced: {autoExpandHorizontalScroll: true},
                    scrollInertia: 100,
                    //scrollbarPosition:"outside"
                });*/
            var data = reformatData($("#gridDetailW09F2001").pqGrid("option", "dataModel.data"),$("#gridDetailW09F2001")) ;
            $("#gridDetailW09F2001").pqGrid("option", "dataModel.data",data);
            $("#gridDetailW09F2001").pqGrid("refreshDataAndView");
        }, 300);
    }

    $("#frmW09F2001_Filter").on('submit', function (e) {
        e.preventDefault();
        reLoadDetailGridW09F2001();
    });

    function reLoadDetailGridW09F2001() {
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            url: '{{url("/W09F2001/$pForm/$g/filter")}}',
            data: $("#frmW09F2001_Filter").serialize() + "&cboBlockIDW09F2001=" + $("#cboBlockIDW09F2001").val() +  "&cboDepartmentIDW09F2001=" + $("#cboDepartmentIDW09F2001").val() + "&salaryProposalID={{$SalaryProposalID}}" + "&proposerID={{$ProposerID}}" + "&voucherDate={{$VoucherDate}}" + "&status={{$task == 'add' ? 0:1}}",
            success: function (data) {
                data = reformatData(data, $("#gridDetailW09F2001"));
                console.log(data);
                dataDetailGrid = data;
                $("#gridDetailW09F2001").pqGrid("option", "dataModel.data", data);
                $("#gridDetailW09F2001").pqGrid("refreshDataAndView");
                $(".l3loading").addClass('hide');
            }
        });
    }

    $("#chkIsSelectedW09F2022").change(function () {
        var isCheck = $("#chkIsSelectedW09F2022").is(":checked");
        resetFilter();
        if (isCheck) {
            $("#gridDetailW09F2001").pqGrid("filter", {
                oper: 'replace',
                data: [
                    {dataIndx: 'IsUsed', condition: 'equal', value: isCheck},
                ]
            });
        }
    });

    function resetFilter() {
        $("#gridDetailW09F2001").pqGrid("reset", {group: true, filter: true});
    }

    function enableControls(task) {
        switch (task) {
            case 'view':
                $("#frmW09F2001_Filter").find("input, select, button").prop("disabled", true);
                $("#frmW09F2001_Master").find("input, select, button").prop("disabled", true);


                {{--@if ($perD09F2000 > 3)
                    $("#btnEditW09F2001").prop("disabled", false);
                @endif--}}
                $("#btnSaveW09F2001").prop("disabled", true);
                $("#btnNotSaveW09F2001").prop("disabled", true);
                break;
            case 'add':
                $("#frmW09F2001_Filter").find("input, select, button").prop("disabled", false);
                $("#frmW09F2001_Master").find("input, select, button").prop("disabled", false);

                @if ($perD09F5650 <=2)
                    $("#frmW09F2001_Filter").find("#cboDepartmentIDW09F2001").prop("disabled", true);
                    $("#frmW09F2001_Filter").find("#cboBlockIDW09F2001").prop("disabled", true);
                @endif

                $("#btnSaveW09F2001").prop("disabled", false);
                $("#btnNotSaveW09F2001").prop("disabled", false);
                break;
            case 'edit':
                $("#frmW09F2001_Filter").find("input, select, button").prop("disabled", true);
                $("#frmW09F2001_Master").find("input, select, button").prop("disabled", false);
                //$("#btnEditW09F2001").prop("disabled", true);
                $("#btnSaveW09F2001").prop("disabled", false);
                $("#btnNotSaveW09F2001").prop("disabled", false);
                break;
        }
        $("#gridDetailW09F2001").pqGrid("refreshDataAndView");
    }

    /*$("#btnEditW09F2001").click(function(){
        task = "edit";
        enableControls(task);
    });*/

    $("#btnNotSaveW09F2001").click(function(){
        ask_not_save(function(){
            $("#modalW09F2001").modal("hide");
        })
    });

    $("#btnSaveW09F2001").click(function () {
        ask_save(function () {
            saveData();
        });
    });

    function headclickW09F2001(el){
        var field = $(el).attr("id");
        var obj = $("#gridDetailW09F2001").pqGrid("option", "dataModel.data");
        var row = getRowSelection($("#gridDetailW09F2001"));
        console.log(row);
        if (row != null){
            for (var i=0;i<obj.length;i++){
                if (obj[i]["IsUsed"] == 1){
                    obj[i][field] = row[field];
                }
            }
            $("#gridDetailW09F2001").pqGrid("refreshDataAndView");
        }else{
            alert_warning("Please select row.");
        }

    }

    function saveData() {
        var txtSalaryProposalNameW09F2001 = $("#txtSalaryProposalNameW09F2001");
        var txtValidDateW09F2001 = $("#txtValidDateW09F2001");


        txtSalaryProposalNameW09F2001.get(0).setCustomValidity("");
        txtValidDateW09F2001.get(0).setCustomValidity("");

        if (txtSalaryProposalNameW09F2001.val() == "") {
            txtSalaryProposalNameW09F2001.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap_du_lieu')}}");
            $("#frmW09F2001_Master").find('#hdBtnSaveW09F2001').click();
            txtSalaryProposalNameW09F2001.focus();
            return false;
        }

        if (txtValidDateW09F2001.val() == "") {
            txtValidDateW09F2001.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap_du_lieu')}}");
            $("#frmW09F2001_Master").find('#hdBtnSaveW09F2001').click();
            txtValidDateW09F2001.focus();
            return false;
        }

        resetFilter(); //KHong dc xoa dong nay
        var obj = $("#gridDetailW09F2001").pqGrid("option", "dataModel.data");
        var filter = $.grep(obj, function (row) {
            return row["IsUsed"] == 1 || row["IsUsed"] == true;
        });

        ////KHong dc xoa dong nay
        var isCheck = $("#chkIsSelectedW09F2022").is(":checked");
        if (isCheck) {
            $("#gridDetailW09F2001").pqGrid("filter", {
                oper: 'replace',
                data: [
                    {dataIndx: 'IsUsed', condition: 'equal', value: 1},
                    {dataIndx: 'IsUsed', condition: 'equal', value: isCheck},
                ]
            });
        }

        ///-----------------------

        if (filter.length == 0) {
            alert_warning("{{Helpers::getRS($g,"Ban_chua_chon_du_lieu_tren_luoi")}}")
            return false;
        }

        $("#frmW09F2001_Master").find('#hdBtnSaveW09F2001').click();
    }

    $("#frmW09F2001_Master").on("submit", function (e) {
        e.preventDefault();
        //Check before saving
        /*var obj = $("#gridDetailW09F2001").pqGrid("option", "dataModel.data");
        var filter = $.grep(obj, function (row) {
            return row["IsUsed"] == 1;
        });*/
        resetFilter(); //KHong dc xoa dong nay
        var obj = $("#gridDetailW09F2001").pqGrid("option", "dataModel.data");
        var filter = $.grep(obj, function (row) {
            return row["IsUsed"] == 1 || row["IsUsed"] == true;
        });

        ////KHong dc xoa dong nay
        var isCheck = $("#chkIsSelectedW09F2022").is(":checked");
        if (isCheck) {
            $("#chkIsSelectedW09F2022").trigger('click');
            $("#chkIsSelectedW09F2022").trigger('click');
        }
        $("#gridDetailW09F2001").pqGrid("refreshDataAndView");
        filter = reformatData(filter, $("#gridDetailW09F2001"));
        console.log(filter);
        var nexAction = "";
        if (task == "add"){
            nexAction = '{{url("/W09F2001/$pForm/$g/save")}}';
        }
        if (task == "edit"){
            nexAction = '{{url("/W09F2001/$pForm/$g/update")}}';
        }

        $.ajax({
            method: "POST",
            url: nexAction,
            data: $("#frmW09F2001_Master").serialize()+"&" + $("#frmW09F2001_Filter").serialize() + "&salaryProposalID={{$SalaryProposalID}}" + "&cboBlockIDW09F2001=" + $("#cboBlockIDW09F2001").val() + "&cboDepartmentIDW09F2001=" + $("#cboDepartmentIDW09F2001").val()+ "&proposerID={{$ProposerID}}" + "&voucherDate={{$VoucherDate}}" + "&obj=" + encodeURI(JSON.stringify(filter)),
            success: function (data) {
                var rs = JSON.parse(data);
                switch (rs.status){
                    case "BACKGROUND": //Gửi mail ngầm
                        save_ok(function(){
                            alert_info("{{Helpers::getRS($g,'Email_da_duoc_gui_toi')}}" + ": <b><i>" + rs.name + "</i></b>");
                            callbackAfterSave(rs.data.TransID);
                        });
                        break;
                    case "SHOWMAIL": //Hiển thị màn hình sendmail
                        save_ok(function(){
                            showEmailPopup(rs.rsvalue,rs.data);
                            callbackAfterSave(rs.data.TransID);
                        });
                        break;
                    case "NOSEND": //Không có gửi mail
                        save_ok(function(){
                            callbackAfterSave(rs.data.TransID);
                        });
                        break;
                    case "ERROR": //Lỗi khi run SQL
                        //save_not_ok();
                        alert_error(rs.message);
                        break;
                }
            }
        });
    });

    function callbackAfterSave(salaryProposalID){
        $grid = $("#gridW09F2000");
        //var data = loadGridW09F2000(salaryProposalID);
        //console.log(data);

        $.ajax({
            method: "POST",
            url: '{{url("/W09F2000/view/$pForm/$g/filter")}}',
            data: $("#frmW09F2000").serialize() + "&salaryProposalID=" + salaryProposalID,
            success: function (data) {
                if (data!= null && data.length > 0){
                    if (task == "add"){
                        update4ParamGrid($grid, data[0], 'add');
                        task = "view";
                        enableControls(task);
                    }

                    if (task == "edit")
                        update4ParamGrid($grid, data[0], 'edit');
                }

                reloadFilter();
            }
        });

    }

</script>