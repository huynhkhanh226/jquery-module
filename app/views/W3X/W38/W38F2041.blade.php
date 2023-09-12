<div class="modal fade" id="modalW38F2041" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($titleW38F2041,"W38F2041",true,"")}}
            </div>
            @if ($task == "edit" || $task == "view")
                @define $cboDepartmentIDW38F2041 = $departmentID
                @define $rsData =  $rsData
            @else
                @if ($perW38F2041 <=2)
                    @define $cboDepartmentIDW38F2041 = Session::get("W91P0000")['DepartmentID']
                @else
                    @define $cboDepartmentIDW38F2041 = $departments[0]["DepartmentID"]
                @endif
                @define $rsData =  []
            @endif
            <div class="modal-body" style="padding:10px">
                <form class="form-horizontal" id="frmW38F2041">
                    <fieldset>
                        <div class = "row form-group">
                            <div class = "col-md-2 col-xs-2">
                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"Quy_trinh_duyet")}}</label>
                            </div>
                            <div class = "col-md-10 col-xs-10">
                                <div class = "row">
                                    <div class = "col-md-5 col-xs-5">
                                        <select id="slApprovalFlowIDW38F2041" name="slApprovalFlowIDW38F2041"
                                                class="form-control" required>
                                            <option value=""></option>
                                            @foreach($cbApprovalFlowID as $row)
                                                <option value="{{$row['ApprovalFlowID']}}">{{$row['ApprovalFlowName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class = "col-md-7 col-xs-7">
                                        <div class = "row">
                                            <div class = "col-md-4 col-xs-4">
                                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"Phong_ban")}}</label>
                                            </div>
                                            <div class = "col-md-8 col-xs-8">
                                                <select id="slDepartmentIDW38F2041" name="slDepartmentIDW38F2041"
                                                        class="form-control" required @if ($perW38F2041 <=2)disabled @endif>
                                                    @foreach($departments as $rowDepartment)
                                                        <option value="{{$rowDepartment['DepartmentID']}}" {{$rowDepartment['DepartmentID'] == $cboDepartmentIDW38F2041 ? "selected": ""}} >{{$rowDepartment['DepartmentName']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "row form-group">
                            <div class = "col-md-2 col-xs-2">
                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"Ten_khoa_ke_hoach_DT_nam")}}</label>
                            </div>
                            <div class = "col-md-10 col-xs-10">
                                <input type="text" class="form-control" id="txtProposalNameW38F2041" name="txtProposalNameW38F2041" required>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class = "row form-group">
                            <div class = "col-md-2 col-xs-2">
                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"Ngay_de_xuat")}}</label>
                            </div>
                            <div class = "col-md-10 col-xs-10">
                                <div class = "row">
                                    <div class = "col-md-5 col-xs-5">
                                        <div class = "row">
                                            <div class = "col-md-7 col-xs-7">
                                                <div id="calenderW092020" class="input-group ">
                                                    <input type="text" class="form-control" id="txtProposalDateW38F2041"
                                                           name="txtProposalDateW38F2041" value="{{date('d/m/Y')}}" required>
                                                </div>
                                            </div>
                                            <div class = "col-md-5 col-xs-5">
                                                <div class = "row">
                                                    <div class = "col-md-4 col-xs-4">
                                                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Nam")}}</label>
                                                    </div>
                                                    <div class = "col-md-8 col-xs-8">
                                                        <input value = "" type="text" class="form-control" id="txtYearW38F2041" name="txtYearW38F2041" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "col-md-7 col-xs-7">
                                        <div class = "row">
                                            <div class = "col-md-4 col-xs-4">
                                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"Nguoi_de_xuat")}}</label>
                                            </div>
                                            <div class = "col-md-8 col-xs-8">
                                                <input value = "{{$creatorName}}" type="text" class="form-control" id="slProposerIDW38F2041" name="slProposerIDW38F2041" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row" style="padding: 10px 15px" class="pdt5">
                            <div id="gridW38F2041"></div>
                        </div>
                        @if($task == "edit" || $task == "add")
                        <div class = "row form-group">
                            <div class="col-md-12 col-xs-12">
                                <div class="pull-right">
                                    <button type="button" id="btnSaveW38F2041" name="btnSaveW38F2041"
                                            onclick="ask_save(function(){saveData()})"
                                            class="btn btn-default smallbtn"><span
                                                class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                                    </button>
                                    @if ($task == "add")
                                    <button type="button" id="btnNextW38F2041" name="btnNextW38F2041"
                                            class="btn btn-default smallbtn"><span
                                                class="fa fa-arrow-right text-blue mgr5"></span> {{Helpers::getRS($g,"Nhap_tiep")}}
                                    </button>
                                    @endif
                                    <button type="button" id="btnNotSaveW38F2041" name="btnNotSaveW38F2041"
                                            class="btn btn-default smallbtn"><span
                                                class="fa fa-ban text-red"></span> {{Helpers::getRS($g,"Khong_luu")}}
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                    </fieldset>
                    <button type="submit" id="hdBtnSaveW38F2041" class="hidden"></button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var TrainingObjectID = "";
    var TrainningEmpID = "";
    var ProposalID = "";
    var task = "{{$task}}";
    var formValue = [];
    var TrainingFieldNameW38F2041 = "";

    $('#txtProposalDateW38F2041').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: "dd/mm/yyyy",
        language: 'vi'
    });

    $(document).ready(function (e) {
        loadForm();
        @if($task == "edit")
            formValue = {{json_encode($rowDT)}};
            console.log(formValue);
        $("#slApprovalFlowIDW38F2041").val(formValue.ApprovalFlowID).prop('disabled', true);
        $("#txtProposalNameW38F2041").val(formValue.ProposalName);
        $("#txtProposalDateW38F2041").val(formValue.ProposalDate);
        $("#slProposerIDW38F2041").val(formValue.ProposerName);
        $("#slDepartmentIDW38F2041").val(formValue.DepartmentID);
        $("#slTeamIDW38F2041").val(formValue.TeamID);
        $("#txtYearW38F2041").val(formValue.Year);
        $("#slTrainingFieldIDW38F2041").val(formValue.TrainingFieldID);
        $("#slTrainingCourseIDW38F2041").val(formValue.TrainingCourseID);
        $("#txtTrainingObjectNameW38F2041").val(formValue.TrainingObjectName);
        $("#txtDateFromW38F2041").val(formValue.DateFrom);
        $("#txtDateToW38F2041").val(formValue.DateTo);
        $("#txtTrainningEmpNameW38F2041").val(formValue.TrainningEmpName);
        $("#txtContentW38F2041").val(formValue.Content);
        $("#txtTrainingPurposeW38F2041").val(formValue.TrainingPurpose);
        $("#txtProNumberW38F2041").val(formValue.ProNumber);
        $("#txtProCostW38F2041").val(Number(formValue.ProCost));
        $("#slProCurrencyIDW38F2041").val(formValue.ProCurrencyID);
        $("#txtProExchangeRateW38F2041").val(Number(formValue.ProExchangeRate));
        $("#txtProCCostW38F2041").val(Number(formValue.ProCCost));
        $("#txtProCompanyRateW38F2041").val(Number(formValue.ProCompanyRate));
        $("#txtProEmployeeRateW38F2041").val(Number(formValue.ProEmployeeRate));
        $("#txtProAverageCostsW38F2041").val(Number(formValue.ProAverageCosts));
        $("#txtProNoteW38F2041").val(formValue.ProNote);
        TrainingObjectID = formValue.TrainingObjectID;
        TrainningEmpID = formValue.TrainningEmpID;
        ProposalID = formValue.ProposalID;
        @endif

        @if($task == "view")
        formValue = {{json_encode($rowDT)}};
        console.log(formValue);
        $("#slApprovalFlowIDW38F2041").val(formValue.ApprovalFlowID).prop('disabled', true);
        $("#txtProposalNameW38F2041").val(formValue.ProposalName).prop('disabled', true);
        $("#txtProposalDateW38F2041").val(formValue.ProposalDate).prop('disabled', true);
        $("#slProposerIDW38F2041").val(formValue.ProposerName).prop('disabled', true);
        $("#slDepartmentIDW38F2041").val(formValue.DepartmentID).prop('disabled', true);
        $("#txtYearW38F2041").val('').prop('disabled', true);


        $("#slTeamIDW38F2041").val(formValue.TeamID);
        $("#txtYearW38F2041").val(formValue.Year);
        $("#slTrainingFieldIDW38F2041").val(formValue.TrainingFieldID);
        $("#slTrainingCourseIDW38F2041").val(formValue.TrainingCourseID);
        $("#txtTrainingObjectNameW38F2041").val(formValue.TrainingObjectName);
        $("#txtDateFromW38F2041").val(formValue.DateFrom);
        $("#txtDateToW38F2041").val(formValue.DateTo);
        $("#txtTrainningEmpNameW38F2041").val(formValue.TrainningEmpName);
        $("#txtContentW38F2041").val(formValue.Content);
        $("#txtTrainingPurposeW38F2041").val(formValue.TrainingPurpose);
        $("#txtProNumberW38F2041").val(formValue.ProNumber);
        $("#txtProCostW38F2041").val(Number(formValue.ProCost));
        $("#slProCurrencyIDW38F2041").val(formValue.ProCurrencyID);
        $("#txtProExchangeRateW38F2041").val(Number(formValue.ProExchangeRate));
        $("#txtProCCostW38F2041").val(Number(formValue.ProCCost));
        $("#txtProCompanyRateW38F2041").val(Number(formValue.ProCompanyRate));
        $("#txtProEmployeeRateW38F2041").val(Number(formValue.ProEmployeeRate));
        $("#txtProAverageCostsW38F2041").val(Number(formValue.ProAverageCosts));
        $("#txtProNoteW38F2041").val(formValue.ProNote);
        TrainingObjectID = formValue.TrainingObjectID;
        TrainningEmpID = formValue.TrainningEmpID;
        ProposalID = formValue.ProposalID;
        @endif

        $("#txtDateFromW38F2041").prop('readonly', true);
        $("#txtDateToW38F2041").prop('readonly', true);

        function defaultValueOnGridW38F2041(){
            //alert("ádsd");
            $grid = $("#gridW38F2041");
            $grid.pqGrid("saveEditCell");
            $grid.pqGrid("quitEditMode");
            var idx = $grid.pqGrid("addRow",
                {rowData: {
                    //TrainingFieldName: '',
                   //TrainingCourseName: ''
                    CurrencyID: ''
                }}
            );
            var rowData = $grid.pqGrid( "getRowData", {rowIndx: idx} );
            $grid.pqGrid("refreshDataAndView");
            $grid.pqGrid("setSelection", {rowIndx: idx, colIndx: 1});
        }

        $('#btnNextW38F2041').click(function () {
            //alert("hello");
            clearForm();
            loadForm();
        });

        var obj = {
            width: '100%',
            height: $(document).height() - 280,
            @if($task == "view")
                editable: false,
            @else
                editable: true,
            @endif
            //freezeCols: 2,
            selectionModel: {type: 'row'},
            minWidth: 30,
            //pageModel: {type: "local", rPP: 20},
            filterModel: {on: true, mode: "AND", header: false},
            showTitle: false,
            dataType: "JSON",
            wrap: false,
            hwrap: false,
            collapsible: false,
            postRenderInterval: -1,
            editModel: {
                saveKey: $.ui.keyCode.ENTER,
                select: true,
                keyUpDown: false,
                cellBorderWidth: 0,
                clicksToEdit: 1
            },
            @if($task == "edit" || $task == "add")//chỉ hiện thị khi add hoặc edit
            toolbar: {
                items: [
                    {
                        type: 'button',
                        label: "{{Helpers::getRS($g,"Them_moi1")}}",
                        icon: 'ui-icon-plus',
                        listener: function () {
                            //RelativesID = RelativesID + 1; //tăng tự động RelativesID
                            //modeEditGrid2 = 0; //thêm mới
                            $grid = $("#gridW38F2041");
                            $grid.pqGrid("saveEditCell");
                            $grid.pqGrid("quitEditMode");
                            reloadTranningCourseCombo('%');
                            defaultValueOnGridW38F2041();
                        }
                    }]
            },
            @endif
            summaryData : [
                {
                    TrainingFieldName: '{{Helpers::getRS($g,"Tong_cong")}}',
                    TrainingCourseName: '',
                    TrainingObjectName: '',
                    FromDate: '',
                    ToDate: '',
                    TrainningEmpName: '',
                    Content: '',
                    TrainingPurpose: '',
                    ProNumber: format2('{{Helpers::sumFooter(json_decode($valueGrid), "ProNumber",true)}}', '', 0),
                    ProCost:  format2('{{Helpers::sumFooter(json_decode($valueGrid), "ProCost", true)}}', '', 2),
                    CurrencyName:'',
                    ProExchangeRate:'',
                    ProCCost: format2('{{Helpers::sumFooter(json_decode($valueGrid), "ProCCost",true)}}', '', 2),
                    ProCompanyRate:'',
                    ProEmployeeRate:'',
                    ProAverageCosts: format2('{{Helpers::sumFooter(json_decode($valueGrid), "ProAverageCosts",true)}}', '', 2),
                    ProNote:''
                },
            ],
            colModel: [
                @if($task == "edit" || $task == "add")//chỉ hiện thị khi add hoặc edit
                {
                    title: "",
                    editable: false,
                    minWidth: 30,
                    maxWidth: 30,
                    dataIndx: "Action",
                    sortable: false,
                    align: "center",
                    render: function (ui) {
                        return "<a class='glyphicon glyphicon-remove mgr5' title='{{Helpers::getRS($g,"Xoa")}}' style='margin-top:2px;color:red'></a>";
                    },
                    postRender: function (ui) {
                        var grid = this,$cell = grid.getCell(ui);

                        //edit button
                        $cell.find("a.glyphicon-remove").bind("click", function (evt) {
                            update4ParamGrid($("#gridW38F2041"), null, 'delete');
                        });
                    }
                },
                @endif
                {
                    title: "{{Helpers::getRS($g,"Linh_vuc_dao_tao")}}",
                    minWidth: 200,
                    dataType: "string",
                    dataIndx: "TrainingFieldName",
                    editor: true,
                    align: "left",
                    editor: {
                        type: 'select',
                        valueIndx: "TrainingFieldID",
                        labelIndx: "TrainingFieldName",
                        mapIndices: {"TrainingFieldID": "TrainingFieldID", "TrainingFieldName": "TrainingFieldName"},
                        options: {{json_encode($cbTrainingField)}}
                    }
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "TrainingFieldID",
                    minWidth: 100,
                    dataType: "string",
                    dataIndx: "TrainingFieldID",
                    editor: false,
                    hidden: true,
                    isExport: false
                },
                {
                    title: "{{Helpers::getRS($g,"Khoa_dao_tao")}}",
                    minWidth: 200,
                    dataType: "string",
                    dataIndx: "TrainingCourseName",
                    required: true,
                    editor: true,
                    align: "left",
                    editor: {
                        type: 'select',
                        valueIndx: "TrainingCourseID",
                        labelIndx: "TrainingCourseName",
                        mapIndices: {"TrainingCourseID": "TrainingCourseID", "TrainingCourseName": "TrainingCourseName"},
                        options: {{json_encode($cbTrainingCourses)}}
                    }
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "TrainingCourseID",
                    minWidth: 100,
                    dataType: "string",
                    dataIndx: "TrainingCourseID",
                    editor: false,
                    hidden: true,
                    isExport: false
                },
                {
                    title: "{{Helpers::getRS($g,"Doi_tuong_dao_tao")}}",
                    minWidth: 200,
                    dataType: "string",
                    dataIndx: "TrainingObjectName",
                    editor: false,
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                    render: function (ui) {
                        return {
                            cls: "readonly-status"
                        };
                    }
                },
                {
                    title: "TrainingObjectID",
                    minWidth: 150,
                    dataType: "string",
                    dataIndx: "TrainingObjectID",
                    editor: false,
                    hidden: true,
                    isExport: false
                },
                {
                    title: "{{Helpers::getRS($g,"TG_bat_dau")}}",
                    minWidth: 100,
                    sortable: false,
                    dataType: "string",
                    dataIndx: "FromDate",
                    align: "center",
                    editor: false,
                    filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']},
                    render: function (ui) {
                        return {
                            cls: "readonly-status"
                        };
                    }
                },

                {
                    title: "{{Helpers::getRS($g,"TG_ket_thuc")}}",
                    minWidth: 100,
                    sortable: false,
                    dataType: "string",
                    dataIndx: "ToDate",
                    align: "center",
                    editor: false,
                    filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']},
                    render: function (ui) {
                        return {
                            cls: "readonly-status"
                        };
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Nguoi_dao_tao")}}",
                    minWidth: 200,
                    dataType: "string",
                    dataIndx: "TrainningEmpName",
                    editor: false,
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                    render: function (ui) {
                        return {
                            cls: "readonly-status"
                        };
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Noi_dung")}}",
                    minWidth: 200,
                    dataType: "string",
                    dataIndx: "Content",
                    editor: false,
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                    render: function (ui) {
                        return {
                            cls: "readonly-status"
                        };
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Muc_dich_dao_tao")}}",
                    minWidth: 200,
                    dataType: "string",
                    dataIndx: "TrainingPurpose",
                    editor: false,
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                    render: function (ui) {
                        return {
                            cls: "readonly-status"
                        };
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"So_luong_nv_du_kien")}}",
                    minWidth: 190,
                    dataType: "float",
                    dataIndx: "ProNumber",
                    editor: true,
                    format: "{{Helpers::getStringFormat(0)}}",
                    align: "right",
                    //filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Tong_chi_phi")}}",
                    minWidth: 150,
                    dataType: "float",
                    dataIndx: "ProCost",
                    editor: true,
                    align: "right",
                    format: "{{Helpers::getStringFormat(2)}}",
                    //filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Loai_tien")}}",
                    minWidth: 170,
                    dataType: "string",
                    dataIndx: "CurrencyName",
                    editor: true,
                    align: "left",
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                    editor: {
                        type: 'select',
                        valueIndx: "CurrencyID",
                        labelIndx: "CurrencyName",
                        mapIndices: {"ExchangeRate": "ExchangeRate", "CurrencyID": "CurrencyID", "CurrencyName": "CurrencyName"},
                        options: {{json_encode($cbCurrency)}}
                    }
                },
                {
                    title: "CurrencyID",
                    minWidth: 100,
                    dataType: "string",
                    dataIndx: "CurrencyID",
                    editor: false,
                    hidden: true,
                    isExport: false
                },
                {
                    title: "ExchangeRate",
                    minWidth: 100,
                    dataType: "string",
                    dataIndx: "ExchangeRate",
                    editor: false,
                    hidden: true,
                    isExport: false
                },
                {
                    title: "{{Helpers::getRS($g,"Ty_gia")}}",
                    minWidth: 150,
                    dataType: "float",
                    dataIndx: "ProExchangeRate",
                    editor: false,
                    align: "right",
                    format: "{{Helpers::getStringFormat(2)}}",
                    filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
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
                    filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                    render: function (ui) {
                        return {
                            cls: "readonly-status"
                        };
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Ty_le_cty_tai_tro")}}",
                    minWidth: 150,
                    dataType: "float",
                    dataIndx: "ProCompanyRate",
                    editor: true,
                    align: "right",
                    format: "{{Helpers::getStringFormat(2)}}",
                    //filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ty_le_nv_dong")}}",
                    minWidth: 150,
                    dataType: "float",
                    align: "right",
                    dataIndx: "ProEmployeeRate",
                    editor: true,
                    format: "{{Helpers::getStringFormat(2)}}",
                    //filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Binh_quan_CP_nguoi")}}",
                    minWidth: 150,
                    dataType: "float",
                    align: "right",
                    dataIndx: "ProAverageCosts",
                    editor: false,
                    format: "{{Helpers::getStringFormat(2)}}",
                    render: function (ui) {
                        return {
                            cls: "readonly-status"
                        };
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Ghi_chu")}}",
                    minWidth: 200,
                    dataType: "string",
                    align: "left",
                    dataIndx: "ProNote",
                    editor: true,
                    //filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
                },
                {
                    title: "ApprovalFlowID",
                    minWidth: 100,
                    dataType: "string",
                    dataIndx: "ApprovalFlowID",
                    editor: false,
                    hidden: true,
                    isExport: false
                }
            ],
            dataModel: {
                data: {{$valueGrid}}
            },
            cellSave: function( event, ui ) {
                var $gridW38F2041 = $("#gridW38F2041");
                //var newVal = ui.newVal;
                var rowData = ui.rowData,
                    dataIndx = ui.dataIndx,
                    ExchangeRate = 0,
                    ProCompanyRate = 0,
                    ProCost = 0,
                    Operator = 0;
                    rowIndx = ui.rowIndx;
                if(dataIndx == 'TrainingFieldName'){
                    TrainingFieldNameW38F2041 = rowData['TrainingFieldName'];
                    reloadTranningCourseCombo(rowData['TrainingFieldID']);
                }
                if(dataIndx == 'TrainingCourseName'){
                    //TrainingFieldNameW38F2041 = rowData['TrainingFieldName'];
                    $.ajax({
                        method: "POST",
                        url: '{{url("/W38F2041/$pForm/$g/RLform")}}',
                        data: "TrainingCourseID=" +  rowData['TrainingCourseID'] + "&TrainingFieldID=" +   rowData['TrainingFieldID'],
                        success: function (data) {
                            console.log(data);
                            rowData['TrainingObjectName'] = data[0].TrainingObjectName;
                            rowData['TrainingObjectID'] = data[0].TrainingObjectID;
                            rowData['FromDate'] = data[0].FromDate;
                            rowData['ToDate'] = data[0].ToDate;
                            rowData['Content'] = data[0].Content;
                            rowData['TrainingPurpose'] = data[0].TrainingPurpose;
                            rowData['TrainningEmpName'] = data[0].TrainningEmpName;
                            $gridW38F2041.pqGrid( "refreshDataAndView");
                        }
                    });
                }
                if(dataIndx == 'CurrencyID' && rowData['CurrencyID'] != ""){
                    var clCurrencyName = $gridW38F2041.pqGrid( "getColumn",{ dataIndx: "CurrencyName" } );
                    var dataCurrency = clCurrencyName.editor.options;
                    var filterCurrency = $.grep(dataCurrency, function (d) {
                        return d.CurrencyID == rowData['CurrencyID'];
                    });
                    console.log(filterCurrency);
                    ExchangeRate = Number(filterCurrency[0].ExchangeRate);
                    Operator = Number(filterCurrency[0].Operator);
                    //console.log(filterCurrency);
                }

                if(dataIndx == 'CurrencyName'){
                    var clCurrencyName = $gridW38F2041.pqGrid( "getColumn",{ dataIndx: "CurrencyName" } );
                    var dataCurrency = clCurrencyName.editor.options;
                    var filterCurrency = $.grep(dataCurrency, function (d) {
                        return d.CurrencyID == rowData['CurrencyID'];
                    });
                    ExchangeRate = Number(filterCurrency[0].ExchangeRate);
                    Operator = Number(filterCurrency[0].Operator);
                    //console.log(Operator);
                    rowData['ProExchangeRate'] = format2(ExchangeRate,'',2);
                    if(rowData['ProCost'] == undefined){
                        rowData['ProCost'] = 0;
                    }
                    console.log(rowData);
                    ProCost = Number(rowData['ProCost']);
                    var ProCCost = format2(Number(calRate(ProCost, ExchangeRate, Operator)), '',2);
                    rowData['ProCCost'] = ProCCost;
                    $gridW38F2041.pqGrid( "refreshDataAndView");
                }

                if(dataIndx == 'ProNumber'){
                    if(Number(rowData['ProNumber']) != 0){
                        var ProNumber = Number(rowData['ProNumber']);
                        var ProCompanyRate = Number(rowData['ProCompanyRate']);
                        var ProCCost = Number(rowData['ProCCost']);
                        rowData['ProAverageCosts'] = format2(Number(calAve(ProCCost, ProCompanyRate, ProNumber)), '',2);
                        //defaultValueSumW38F2041();
                        $gridW38F2041.pqGrid( "refreshDataAndView");
                    }
                }

                if(dataIndx == 'ProCost'){
                    ProCost = Number(rowData['ProCost']);
                    var ProCCost = format2(Number(calRate(ProCost, ExchangeRate, Operator)), '',2);
                    rowData['ProCCost'] = ProCCost;
                    var ProNumber = Number(rowData['ProNumber']);
                    var ProCompanyRate = Number(rowData['ProCompanyRate']);
                    rowData['ProAverageCosts'] = format2(Number(calAve(ProCCost, ProCompanyRate, ProNumber)), '',2);
                    //defaultValueSumW38F2041();
                    $gridW38F2041.pqGrid( "refreshDataAndView");
                }

                if(dataIndx == 'ProCompanyRate'){
                    rowData['ProEmployeeRate'] = calPercent(Number(rowData['ProCompanyRate']));
                    rowData['ProCompanyRate'] = format2(rowData['ProCompanyRate'], '',2);
                    var ProNumber = Number(rowData['ProNumber']);
                    var ProCompanyRate = Number(rowData['ProCompanyRate']);
                    var ProCCost = Number(rowData['ProCCost']);
                    rowData['ProAverageCosts'] = format2(Number(calAve(ProCCost, ProCompanyRate, ProNumber)), '',2);
                    $gridW38F2041.pqGrid( "refreshDataAndView");
                }

                if(dataIndx == 'ProEmployeeRate'){
                    rowData['ProCompanyRate'] = calPercent(Number(rowData['ProEmployeeRate']));
                    rowData['ProEmployeeRate'] = format2(rowData['ProEmployeeRate'], '',2);
                    var ProNumber = Number(rowData['ProNumber']);
                    var ProCompanyRate = Number(rowData['ProCompanyRate']);
                    var ProCCost = Number(rowData['ProCCost']);
                    rowData['ProAverageCosts'] = format2(Number(calAve(ProCCost, ProCompanyRate, ProNumber)), '',2);
                    $gridW38F2041.pqGrid( "refreshDataAndView");
                }

                defaultValueSumW38F2041();

                var data = $gridW38F2041.pqGrid("option", "dataModel.data");
                $gridW38F2041.pqGrid("option", "dataModel.data", reformatData(data,$gridW38F2041));
            },
            cellBeforeSave: function( event, ui ) {

            },
            complete: function (event, ui) {
                //defaultValueSumW38F2041();
                //console.log("complete");
            },

        };

        var $gridW38F2041 = $("#gridW38F2041").pqGrid(obj);
        $gridW38F2041.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW38F2041.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        setTimeout(function () {
            $gridW38F2041.pqGrid("refreshDataAndView");
        }, 700)

    });

    $("#btnNotSaveW38F2041").click(function(){
        ask_not_save(function(){
            $("#modalW38F2041").modal('hide');
        });
    });

    function saveData() {
        //alert("da chay vao save");
        var slApprovalFlowIDW38F2041 = $("#slApprovalFlowIDW38F2041");
        var txtYearW38F2041 = $("#txtYearW38F2041");
        var txtProposalNameW38F2041 = $("#txtProposalNameW38F2041");

        slApprovalFlowIDW38F2041.get(0).setCustomValidity("");
        txtYearW38F2041.get(0).setCustomValidity("");
        txtProposalNameW38F2041.get(0).setCustomValidity("");

        if (slApprovalFlowIDW38F2041.val() == "") {
            //alert("da chay");
            console.log(slApprovalFlowIDW38F2041.val());
            slApprovalFlowIDW38F2041.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Quy_trinh_duyet')}}");
            $("#frmW38F2041").find('#hdBtnSaveW38F2041').click();
            slApprovalFlowIDW38F2041.focus();
            return false;
        }

        if (txtProposalNameW38F2041.val() == "") {
            //alert("da chay");
            //console.log(txtYearW38F2041.val());
            txtProposalNameW38F2041.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Quy_trinh_duyet')}}");
            $("#frmW38F2041").find('#hdBtnSaveW38F2041').click();
            txtProposalNameW38F2041.focus();
            return false;
        }

        if (txtYearW38F2041.val() == "") {
            //alert("da chay");
            //console.log(txtYearW38F2041.val());
            txtYearW38F2041.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Quy_trinh_duyet')}}");
            $("#frmW38F2041").find('#hdBtnSaveW38F2041').click();
            txtYearW38F2041.focus();
            return false;
        }

        //kiểm tra lưới có DL hay chưa
        var dataGridW38F2041 = $("#gridW38F2041").pqGrid("option", "dataModel.data");
        if(dataGridW38F2041.length == 0){
            alert_warning('Dữ liệu trên lưới chưa được nhập');
            return false;
        }

        var $grid = $("#gridW38F2041");
        var obj = $grid.pqGrid("option", "dataModel.data");
        var colModel = $grid.pqGrid("option", "colModel");
        var askMessage = "{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}";
        for (var i = 0; i < obj.length; i++) {
            for (var j = 0; j < colModel.length; j++) {
                var isEditCell = $grid.pqGrid("isEditableCell", {rowIndx: i, dataIndx: [colModel[j].dataIndx]})
                if (colModel[j].required && isNullOrEmpty(obj[i][colModel[j].dataIndx]) && isEditCell) {
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

        var dataGrid = $("#gridW38F2041").pqGrid("option", "dataModel.data");
        dataGrid = reformatData(dataGrid, $("#gridW38F2041"));


        console.log(dataGrid);
        $.ajax({
            method: "POST",
            url: '{{url("/W38F2041/$pForm/$g/save")}}',
            data: {
                slApprovalFlowIDW38F2041: $("#slApprovalFlowIDW38F2041").val(),
                txtProposalNameW38F2041: $("#txtProposalNameW38F2041").val(),
                txtProposalDateW38F2041: $("#txtProposalDateW38F2041").val(),
                slProposerIDW38F2041: $("#slProposerIDW38F2041").val(),
                txtYearW38F2041: $("#txtYearW38F2041").val(),
                slDepartmentIDW38F2041: $("#slDepartmentIDW38F2041").val(),
                task: task,
                ProposalID: ProposalID,
                dataGrid: JSON.stringify(dataGrid),
            },
            success: function (data) {
                var rs = JSON.parse(data);
                console.log(rs);
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
                        //alert(ProposalID);
                        save_ok(function(){
                            callbackAfterSave(rs.data.TransID);
                        });
                        break;
                    case "ERROR": //Lỗi khi run SQL
                        save_not_ok();
                        alert_error(rs.message);
                        break;
                }
            }
        });
    }

    function callbackAfterSave(transID){
        //alert(transID);
        $grid = $("#gridW38F2041");

        $.ajax({
            method: "POST",
            url: '{{url("/W38F2040/view/$pForm/$g/filter")}}',
            data: $("#frmW38F2040").serialize() + "&transID=" +transID + "&departmentIDW38F2040=" + $("#cboDepartmentIDW38F2040").val(),
            success: function (data) {
                console.log(data)
                var task="{{$task}}";
                if (data!= null && data.length > 0){
                    if (task == "add"){
                        loadNext();
                        //update4ParamGrid($grid, data[0], 'add');
                    }
                    if (task == "edit"){
                        //update4ParamGrid($grid, data[0], 'edit');
                    }
                    $grid.pqGrid("refreshDataAndView");
                }

            }
        });
    }

    function calRate(ProCost, ProExchangeRate, Operator) {
        if (Number(Operator) == 0){//Nhân tỷ giá
            return ProCost * ProExchangeRate;
        }else{ //Chia tỷ giá
            if (format2(ProExchangeRate, '',0) == 0){
                return 0;
            }else{
                return ProCost / ProExchangeRate;
            }

        }

    }

    function reloadTranningCourseCombo(TranFieldID){
        var $gridW38F2041 = $("#gridW38F2041");
        $.ajax({
            method: "POST",
            url: '{{url("/W38F2041/$pForm/$g/RLTrainingCourses")}}',
            data: "TrainingFieldID=" +  TranFieldID,
            success: function (data) {
                console.log(data);
                var clTrainingCourseName = $grid.pqGrid( "getColumn",{ dataIndx: "TrainingCourseName" } );
                clTrainingCourseName.editor.options = data;
                $gridW38F2041.pqGrid( "refreshDataAndView");
            }
        });
    }

    function calPercent(a) {
        return format2(100 - a, '',2);
    }
    
    function calAve(ProCCost, ProCompanyRate, ProNumber) {
        return (ProCCost * (ProCompanyRate/100))/ProNumber;
    }
    function triggerDate() {
        $('#txtProposalDateW38F2041').datepicker("show");
    }

    function clearForm(){
        $('#frmW38F2041')[0].reset();
        $("#gridW38F2041").pqGrid("option", "dataModel.data", []);
        $("#gridW38F2041").pqGrid( "refreshDataAndView");
        $("#slDepartmentIDW38F2041").trigger("change");
        $("#slTrainingFieldIDW38F2041").trigger("change");
        $("#txtProposalDateW38F2041").val("{{date('d/m/Y')}}");
        $("#txtProposalNameW38F2041").focus();
    }

    function loadForm() {
        $('#btnSaveW38F2041').prop('disabled', false);
        @if($task == "add")
        $('#btnNextW38F2041').prop('disabled', true);
        @endif
        $('#btnNotSaveW38F2041').prop('disabled', false);
    }
    
    function loadNext(){
        $('#btnSaveW38F2041').prop('disabled', true);
        @if($task == "add")
        $('#btnNextW38F2041').prop('disabled', false);
        @endif
        $('#btnNotSaveW38F2041').prop('disabled', true);
    }

    function defaultValueSumW38F2041(){
        $grid = $("#gridW38F2041");
        var data = $grid.pqGrid("option", "dataModel.data");
        $grid.pqGrid({
            summaryData : [
                {
                    TrainingFieldName: '{{Helpers::getRS($g,"Tong_cong")}}',
                    TrainingCourseName: '',
                    TrainingObjectName: '',
                    FromDate: '',
                    ToDate: '',
                    TrainningEmpName: '',
                    Content: '',
                    TrainingPurpose: '',
                    ProNumber: format2(sumArray(data, 'ProNumber'),'',0),
                    ProCost: format2(sumArray(data, 'ProCost'),'',2),//  calSumFooter('ProCost'),
                    CurrencyName:'',
                    ProExchangeRate:'',
                    ProCCost: format2(sumArray(data, 'ProCCost'),'',2),
                    ProCompanyRate:'',
                    ProEmployeeRate:'',
                    ProAverageCosts: format2(sumArray(data, 'ProAverageCosts'),'',2),
                    ProNote:''
                },
            ]
        });
        $grid.pqGrid("refreshDataAndView");
    }

</script>