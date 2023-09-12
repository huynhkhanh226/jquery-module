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

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "row form-group">
                            <div class = "col-md-2 col-xs-2">
                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"Dien_giai")}}</label>
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
                                        <div id="calenderW092020" class="input-group ">
                                            <input type="text" class="form-control" id="txtProposalDateW38F2041"
                                                   name="txtProposalDateW38F2041" value="{{date('d/m/Y')}}" required>
                                            <span class="input-group-addon"><i onclick="triggerDate()" class="glyphicon glyphicon-calendar"></i></span>
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
                        <div class = "row form-group">
                            <div class = "col-md-2 col-xs-2">
                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"Phong_ban")}}</label>
                            </div>
                            <div class = "col-md-10 col-xs-10">
                                <div class = "row">
                                    <div class = "col-md-5 col-xs-5">
                                        <select id="slDepartmentIDW38F2041" name="slDepartmentIDW38F2041"
                                                class="form-control" required @if ($perW38F2041 <=2)disabled @endif>
                                            @foreach($departments as $rowDepartment)
                                                <option value="{{$rowDepartment['DepartmentID']}}" {{$rowDepartment['DepartmentID'] == $cboDepartmentIDW38F2041 ? "selected": ""}} >{{$rowDepartment['DepartmentName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class = "col-md-7 col-xs-7">
                                        <div class = "row">
                                            <div class = "col-md-4 col-xs-4">
                                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"To_nhom")}}</label>
                                            </div>
                                            <div class = "col-md-8 col-xs-8">
                                                <select id="slTeamIDW38F2041" name="slTeamIDW38F2041"
                                                        class="form-control">
                                                    <option value=""></option>
                                                    @foreach($teams as $row)
                                                        <option value="{{$row['TeamID']}}">{{$row['TeamName']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class = "row form-group">
                            <div class = "col-md-2 col-xs-2">
                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"Linh_vuc_dao_tao")}}</label>
                            </div>
                            <div class = "col-md-10 col-xs-10">
                                <div class = "row">
                                    <div class = "col-md-5 col-xs-5">
                                        <select id="slTrainingFieldIDW38F2041" name="slTrainingFieldIDW38F2041"
                                                class="form-control" required>
                                            <option value=""></option>
                                            @foreach($cbTrainingField as $row)
                                                <option value="{{$row['TrainingFieldID']}}">{{$row['TrainingFieldName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class = "col-md-7 col-xs-7">
                                        <div class = "row">
                                            <div class = "col-md-4 col-xs-4">
                                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"Khoa_dao_tao")}}</label>
                                            </div>
                                            <div class = "col-md-8 col-xs-8">
                                                <select id="slTrainingCourseIDW38F2041" name="slTrainingCourseIDW38F2041"
                                                        class="form-control" required>
                                                    <option value=""></option>
                                                    @foreach($cbTrainingCourses as $row)
                                                        <option value="{{$row['TrainingCourseID']}}">{{$row['TrainingCourseName']}}</option>
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
                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"Doi_tuong_dao_tao")}}</label>
                            </div>
                            <div class = "col-md-10 col-xs-10">
                                <div class = "row">
                                    <div class = "col-md-5 col-xs-5">
                                        <input type="text" class="form-control" id="txtTrainingObjectNameW38F2041" name="txtTrainingObjectNameW38F2041" readonly>
                                    </div>
                                    <div class = "col-md-7 col-xs-7">
                                        <div class = "row">
                                            <div class = "col-md-4 col-xs-4">
                                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"TG_dao_tao")}}</label>
                                            </div>
                                            <div class = "col-md-8 col-xs-8">
                                               <div class ="row">
                                                   <div class="col-md-5 col-xs-5">
                                                       <div id="divDateFromW38F2041" class="input-group date">
                                                           <input type="text" class="form-control" id="txtDateFromW38F2041"
                                                                  name="txtDateFromW38F2041" value="" ><span
                                                                   class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                       </div>
                                                   </div>
                                                   <div class="col-md-2 col-xs-2" style="text-align: center">-
                                                   </div>
                                                   <div class="col-md-5 col-xs-5">
                                                       <div id="divDateToW38F2041" class="input-group date">
                                                           <input type="text" class="form-control" id="txtDateToW38F2041"
                                                                  name="txtDateToW38F2041" value="" ><span
                                                                   class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                       </div>
                                                   </div>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "row form-group">
                            <div class = "col-md-2 col-xs-2">
                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"Nguoi_dao_tao")}}</label>
                            </div>
                            <div class = "col-md-10 col-xs-10">
                                <div class = "row">
                                    <div class = "col-md-5 col-xs-5">
                                        <input type="text" class="form-control" id="txtTrainningEmpNameW38F2041" name="txtTrainningEmpNameW38F2041" readonly>
                                    </div>
                                    <div class = "col-md-7 col-xs-7">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "row form-group">
                            <div class = "col-md-2 col-xs-2">
                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"Noi_dung")}}</label>
                            </div>
                            <div class = "col-md-10 col-xs-10">
                                <input type="text" class="form-control" id="txtContentW38F2041" name="txtContentW38F2041" readonly>
                            </div>
                        </div>
                        <div class = "row form-group">
                            <div class = "col-md-2 col-xs-2">
                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"Muc_dich_dao_tao")}}</label>
                            </div>
                            <div class = "col-md-10 col-xs-10">
                                <input type="text" class="form-control" id="txtTrainingPurposeW38F2041" name="txtTrainingPurposeW38F2041" readonly>
                            </div>
                        </div>
                        <div class = "row form-group">
                            <div class = "col-md-2 col-xs-2">
                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"So_luong_du_kien")}}</label>
                            </div>
                            <div class = "col-md-10 col-xs-10">
                                <div class = "row">
                                    <div class = "col-md-5 col-xs-5">
                                        <div class = "row">
                                            <div class = "col-md-6 col-xs-6">
                                                <input type="text" style="text-align: right" class="form-control" id="txtProNumberW38F2041" name="txtProNumberW38F2041">
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "col-md-7 col-xs-7">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "row form-group">
                            <div class = "col-md-2 col-xs-2">
                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"Tong_chi_phi")}}</label>
                            </div>
                            <div class = "col-md-10 col-xs-10">
                                <div class = "row">
                                    <div class = "col-md-5 col-xs-5">
                                        <div class = "row">
                                            <div class = "col-md-6 col-xs-6">
                                                <input type="text" style="text-align: right" class="form-control" id="txtProCostW38F2041" name="txtProCostW38F2041">
                                            </div>
                                            <div class = "col-md-6 col-xs-6">
                                                <select id="slProCurrencyIDW38F2041" name="slProCurrencyIDW38F2041"
                                                        class="form-control">
                                                    <option value=""></option>
                                                    @foreach($cbCurrency as $row)
                                                        <option operator = "{{$row['Operator']}}" exchangeRate = "{{$row['ExchangeRate']}}" value="{{$row['CurrencyID']}}">{{$row['CurrencyName']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "col-md-7 col-xs-7">
                                        <div class = "row">
                                            <div class = "col-md-4 col-xs-4">
                                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"Ty_gia")}}</label>
                                            </div>
                                            <div class = "col-md-8 col-xs-8">
                                                <div class = "row">
                                                    <div class = "col-md-5 col-xs-5">
                                                        <input type="text" style="text-align: right" class="form-control" id="txtProExchangeRateW38F2041" name="txtProExchangeRateW38F2041" readonly>
                                                    </div>
                                                    <div class = "col-md-5 col-xs-5">
                                                        <input type="text" style="text-align: right" class="form-control" id="txtProCCostW38F2041" name="txtProCCostW38F2041" readonly>
                                                    </div>
                                                    <div class = "col-md-2 col-xs-2">
                                                        <label class="lbl-normal liketext pull-right">VND</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "row form-group">
                            <div class = "col-md-2 col-xs-2">
                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"Ty_le_cty_tai_tro")}}</label>
                            </div>
                            <div class = "col-md-10 col-xs-10">
                                <div class = "row">
                                    <div class = "col-md-5 col-xs-5">
                                        <div class = "row">
                                            <div class = "col-md-6 col-xs-6">
                                                <input type="text" style="text-align: right" class="form-control" id="txtProCompanyRateW38F2041" name="txtProCompanyRateW38F2041">
                                            </div>
                                            <div class = "col-md-6 col-xs-6">
                                                <label class="lbl-normal liketext">%</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "col-md-7 col-xs-7">
                                        <div class = "row">
                                            <div class = "col-md-4 col-xs-4">
                                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"Ty_le_nv_dong")}}</label>
                                            </div>
                                            <div class = "col-md-8 col-xs-8">
                                                <div class = "row">
                                                    <div class = "col-md-5 col-xs-5">
                                                        <input type="text" style="text-align: right" class="form-control" id="txtProEmployeeRateW38F2041" name="txtProEmployeeRateW38F2041">
                                                    </div>
                                                    <div class = "col-md-5 col-xs-5">
                                                        <label class="lbl-normal liketext">%</label>
                                                    </div>
                                                    <div class = "col-md-2 col-xs-2">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "row form-group">
                            <div class = "col-md-2 col-xs-2">
                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"Binh_quan_CP_nguoi")}}</label>
                            </div>
                            <div class = "col-md-10 col-xs-10">
                                <div class = "row">
                                    <div class = "col-md-5 col-xs-5">
                                        <div class = "row">
                                            <div class = "col-md-6 col-xs-6">
                                                <input type="text" style="text-align: right" class="form-control" id="txtProAverageCostsW38F2041" name="txtProAverageCostsW38F2041" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "col-md-7 col-xs-7">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "row form-group">
                            <div class = "col-md-2 col-xs-2">
                                <label class="lbl-normal liketext">{{Helpers::getRS($g,"Ghi_chu")}}</label>
                            </div>
                            <div class = "col-md-10 col-xs-10">
                                <input type="text" class="form-control" id="txtProNoteW38F2041" name="txtProNoteW38F2041">
                            </div>
                        </div>
                        <div class="row" style="padding: 10px 15px" class="pdt5">
                            <div id="gridW38F2041"></div>
                        </div>
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
       /* $("#slDepartmentIDW38F2041").change(function(){
            //alert("anh bao");
            $.ajax({
                method: "POST",
                url: '{{url("/W38F2041/$pForm/$g/reloadteams")}}',
                data: "departmentID=" +  $("#slDepartmentIDW38F2041").val(),
                success: function (data) {
                    $("#slTeamIDW38F2041").html(data);
                }
            });
        });*/

        function defaultValueOnGridW38F2041(){
            //alert("ádsd");
            $grid = $("#gridW38F2041");
            $grid.pqGrid("saveEditCell");
            $grid.pqGrid("quitEditMode");
            var idx = $grid.pqGrid("addRow",
                {rowData: {
                    TrainingFieldName: TrainingFieldNameW38F2041
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
            editable: true,
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
                            defaultValueOnGridW38F2041();
                        }
                    }]
            },
            colModel: [
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
                    title: "{{Helpers::getRS($g,"TG_bat_dau")}}",
                    minWidth: 100,
                    sortable: false,
                    dataType: "date",
                    dataIndx: "DateFrom",
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
                    dataType: "date",
                    dataIndx: "DateTo",
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
                    align: "right",
                    filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Tong_chi_phi")}}",
                    minWidth: 150,
                    dataType: "float",
                    dataIndx: "ProCost",
                    editor: true,
                    align: "right",
                    filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
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
                    filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ty_le_nv_dong")}}",
                    minWidth: 150,
                    dataType: "float",
                    align: "left",
                    dataIndx: "ProEmployeeRate",
                    editor: true,
                    filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Binh_quan_CP_nguoi")}}",
                    minWidth: 150,
                    dataType: "float",
                    align: "left",
                    dataIndx: "ProAverageCosts",
                    editor: true,
                    filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
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
                    $.ajax({
                        method: "POST",
                        url: '{{url("/W38F2041/$pForm/$g/RLTrainingCourses")}}',
                        data: "TrainingFieldID=" +  rowData['TrainingFieldID'],
                        success: function (data) {
                            console.log(data);
                            var clTrainingCourseName = $grid.pqGrid( "getColumn",{ dataIndx: "TrainingCourseName" } );
                            clTrainingCourseName.editor.options = data;
                            $gridW38F2041.pqGrid( "refreshDataAndView");
                        }
                    });
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
                            rowData['FromDate'] = data[0].FromDate;
                            rowData['ToDate'] = data[0].ToDate;
                            rowData['Content'] = data[0].Content;
                            rowData['TrainingPurpose'] = data[0].TrainingPurpose;
                            rowData['TrainningEmpName'] = data[0].TrainningEmpName;
                            $gridW38F2041.pqGrid( "refreshDataAndView");
                        }
                    });
                }
                if(rowData['CurrencyID'] != ""){
                    var clCurrencyName = $gridW38F2041.pqGrid( "getColumn",{ dataIndx: "CurrencyName" } );
                    var dataCurrency = clCurrencyName.editor.options;
                    var filterCurrency = $.grep(dataCurrency, function (d) {
                        return d.CurrencyID == rowData['CurrencyID'];
                    });
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
            }
        };

        var $gridW38F2041 = $("#gridW38F2041").pqGrid(obj);
        $gridW38F2041.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW38F2041.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        setTimeout(function () {
            $gridW38F2041.pqGrid("refreshDataAndView");
        }, 700)


        /*$("#slTrainingFieldIDW38F2041").change(function(){
            //alert("anh bao");
            $.ajax({
                method: "POST",
                url: '{{url("/W38F2041/$pForm/$g/RLTrainingCourses")}}',
                data: "TrainingFieldID=" +  $("#slTrainingFieldIDW38F2041").val(),
                success: function (data) {
                    $("#slTrainingCourseIDW38F2041").html(data);
                    $("#txtTrainingObjectNameW38F2041").val("");
                    $("#txtTrainningEmpNameW38F2041").val("");
                    $("#txtContentW38F2041").val("");
                    $("#txtDateFromW38F2041").val("");
                    $("#txtDateToW38F2041").val("");
                    $("#txtTrainingPurposeW38F2041").val("");
                    $("#txtProNumberW38F2041").val("");
                    $("#txtProCostW38F2041").val("");
                    $("#slProCurrencyIDW38F2041").val("");
                    $("#txtProExchangeRateW38F2041").val("");
                    $("#txtProCCostW38F2041").val("");
                    $("#txtProCompanyRateW38F2041").val("");
                    $("#txtProEmployeeRateW38F2041").val("");
                    $("#txtProAverageCostsW38F2041").val("");
                    $("#txtProNoteW38F2041").val("");
                }
            });
        });*/

       /* $("#slTrainingCourseIDW38F2041").change(function(){
            //alert("anh bao");
            $.ajax({
                method: "POST",
                url: '{{url("/W38F2041/$pForm/$g/RLform")}}',
                data: "TrainingCourseID=" +  $("#slTrainingCourseIDW38F2041").val() + "&TrainingFieldID=" +  $("#slTrainingFieldIDW38F2041").val(),
                success: function (data) {
                    $("#txtTrainingObjectNameW38F2041").val(data[0].TrainingObjectName);
                    $("#txtTrainningEmpNameW38F2041").val(data[0].TrainningEmpName);
                    $("#txtContentW38F2041").val(data[0].Content);
                    $("#txtDateFromW38F2041").val(data[0].FromDate);
                    $("#txtDateToW38F2041").val(data[0].ToDate);
                    $("#txtTrainingPurposeW38F2041").val(data[0].TrainingPurpose);
                    TrainingObjectID = data[0].TrainingObjectID;
                    TrainningEmpID = data[0].TrainningEmpID;
                    $("#txtProNumberW38F2041").val("");
                    $("#txtProCostW38F2041").val("");
                    $("#slProCurrencyIDW38F2041").val("");
                    $("#txtProExchangeRateW38F2041").val("");
                    $("#txtProCCostW38F2041").val("");
                    $("#txtProCompanyRateW38F2041").val("");
                    $("#txtProEmployeeRateW38F2041").val("");
                    $("#txtProAverageCostsW38F2041").val("");
                    $("#txtProNoteW38F2041").val("");
                }
            });
        });

        $("#txtProNumberW38F2041").change(function(){
            if(Number($("#txtProNumberW38F2041").val()) != 0){
                var ProNumber = Number($("#txtProNumberW38F2041").val().replace(/,/g,""));
                var ProEmployeeRate = Number($("#txtProEmployeeRateW38F2041").val().replace(/,/g,""));
                var ProCompanyRate = Number($("#txtProCompanyRateW38F2041").val().replace(/,/g,""));
                var ProCCost = Number($("#txtProCCostW38F2041").val().replace(/,/g,""));
                var ave = format2(Number(calAve(ProCCost, ProCompanyRate, ProNumber)), '',2);
                $("#txtProAverageCostsW38F2041").val(ave);
            }
        });

        $("#txtProNumberW38F2041").keyup(function(){
            if(Number($("#txtProNumberW38F2041").val()) != 0){
                var ProNumber = Number($("#txtProNumberW38F2041").val().replace(/,/g,""));
                var ProEmployeeRate = Number($("#txtProEmployeeRateW38F2041").val().replace(/,/g,""));
                var ProCompanyRate = Number($("#txtProCompanyRateW38F2041").val().replace(/,/g,""));
                var ProCCost = Number($("#txtProCCostW38F2041").val().replace(/,/g,""));
                var ave = format2(Number(calAve(ProCCost, ProCompanyRate, ProNumber)), '',2);
                console.log(ave);
                $("#txtProAverageCostsW38F2041").val(ave);
            }
        });

        $("#slProCurrencyIDW38F2041").change(function(){
            if(Number($("#slProCurrencyIDW38F2041").val()) == 0){
                $("#txtProExchangeRateW38F2041").val(0);
            }else{
                $("#txtProExchangeRateW38F2041").val(Number($("#slProCurrencyIDW38F2041 option:selected").attr('exchangeRate')));
            }
            var ProExchangeRate = $("#txtProExchangeRateW38F2041").val();
            var ProCost = Number($("#txtProCostW38F2041").val().replace(/,/g,""));
            var ProCCost = format2(Number(calRate(ProCost, ProExchangeRate)), '',2);
            $("#txtProCCostW38F2041").val(ProCCost);
            var ProNumber = Number($("#txtProNumberW38F2041").val().replace(/,/g,""));
            var ProEmployeeRate = Number($("#txtProEmployeeRateW38F2041").val().replace(/,/g,""));
            var ProCompanyRate = Number($("#txtProCompanyRateW38F2041").val().replace(/,/g,""));
            var ProCCost = Number($("#txtProCCostW38F2041").val().replace(/,/g,""));
            var ave = format2(calAve(ProCCost, ProCompanyRate, ProNumber), '',2);
            $("#txtProAverageCostsW38F2041").val(ave);
        });

        $("#txtProCostW38F2041").change(function(){
            //$("#txtProExchangeRateW38F2041").val(Number($("#slProCurrencyIDW38F2041 option:selected").attr('exchangeRate')));
            var ProExchangeRate = $("#txtProExchangeRateW38F2041").val();
            var ProCost = Number($("#txtProCostW38F2041").val().replace(/,/g,""));
            var ProCCost = format2(Number(calRate(ProCost, ProExchangeRate)), '',2);
            $("#txtProCCostW38F2041").val(ProCCost);
            var ProNumber = Number($("#txtProNumberW38F2041").val().replace(/,/g,""));
            var ProEmployeeRate = Number($("#txtProEmployeeRateW38F2041").val().replace(/,/g,""));
            var ProCompanyRate = Number($("#txtProCompanyRateW38F2041").val().replace(/,/g,""));
            var ProCCost = Number($("#txtProCCostW38F2041").val().replace(/,/g,""));
            var ave = format2(calAve(ProCCost, ProCompanyRate, ProNumber), '',2);
            $("#txtProAverageCostsW38F2041").val(ave);
        });

        $("#txtProCostW38F2041").keyup(function(){
            //$("#txtProExchangeRateW38F2041").val(Number($("#slProCurrencyIDW38F2041 option:selected").attr('exchangeRate')));
            var ProExchangeRate = $("#txtProExchangeRateW38F2041").val();
            var ProCost = Number($("#txtProCostW38F2041").val().replace(/,/g,""));
            var ProCCost = format2(Number(calRate(ProCost, ProExchangeRate)), '',2);
            $("#txtProCCostW38F2041").val(ProCCost);
            var ProNumber = Number($("#txtProNumberW38F2041").val().replace(/,/g,""));
            var ProEmployeeRate = Number($("#txtProEmployeeRateW38F2041").val().replace(/,/g,""));
            var ProCompanyRate = Number($("#txtProCompanyRateW38F2041").val().replace(/,/g,""));
            var ProCCost = Number($("#txtProCCostW38F2041").val().replace(/,/g,""));
            var ave = format2(calAve(ProCCost, ProCompanyRate, ProNumber), '',2);
            $("#txtProAverageCostsW38F2041").val(ave);
        });

        $("#txtProCompanyRateW38F2041").change(function(){
            var rs = calPercent(Number($("#txtProCompanyRateW38F2041").val().replace(/,/g,"")));
            $("#txtProEmployeeRateW38F2041").val(rs);
            var ProNumber = Number($("#txtProNumberW38F2041").val().replace(/,/g,""));
            var ProEmployeeRate = Number($("#txtProEmployeeRateW38F2041").val().replace(/,/g,""));
            var ProCompanyRate = Number($("#txtProCompanyRateW38F2041").val().replace(/,/g,""));
            var ProCCost = Number($("#txtProCCostW38F2041").val().replace(/,/g,""));
            var ave = format2(calAve(ProCCost, ProCompanyRate, ProNumber), '',2);
            $("#txtProAverageCostsW38F2041").val(ave);
        });

        $("#txtProCompanyRateW38F2041").keyup(function(){
            var rs = calPercent(Number($("#txtProCompanyRateW38F2041").val().replace(/,/g,"")));
            $("#txtProEmployeeRateW38F2041").val(rs);
            var ProNumber = Number($("#txtProNumberW38F2041").val().replace(/,/g,""));
            var ProEmployeeRate = Number($("#txtProEmployeeRateW38F2041").val().replace(/,/g,""));
            var ProCompanyRate = Number($("#txtProCompanyRateW38F2041").val().replace(/,/g,""));
            var ProCCost = Number($("#txtProCCostW38F2041").val().replace(/,/g,""));
            var ave = format2(calAve(ProCCost, ProCompanyRate, ProNumber), '',2);
            $("#txtProAverageCostsW38F2041").val(ave);
        });

        $("#txtProEmployeeRateW38F2041").change(function(){
            var rs = calPercent(Number($("#txtProEmployeeRateW38F2041").val().replace(/,/g,"")));
            $("#txtProCompanyRateW38F2041").val(rs);
            var ProNumber = Number($("#txtProNumberW38F2041").val().replace(/,/g,""));
            var ProEmployeeRate = Number($("#txtProEmployeeRateW38F2041").val().replace(/,/g,""));
            var ProCompanyRate = Number($("#txtProCompanyRateW38F2041").val().replace(/,/g,""));
            var ProCCost = Number($("#txtProCCostW38F2041").val().replace(/,/g,""));
            var ave = format2(calAve(ProCCost, ProCompanyRate, ProNumber), '',2);
            $("#txtProAverageCostsW38F2041").val(ave);
        });

        $("#txtProEmployeeRateW38F2041").keyup(function(){
            var rs = calPercent(Number($("#txtProEmployeeRateW38F2041").val().replace(/,/g,"")));
            $("#txtProCompanyRateW38F2041").val(rs);
            var ProNumber = Number($("#txtProNumberW38F2041").val().replace(/,/g,""));
            var ProEmployeeRate = Number($("#txtProEmployeeRateW38F2041").val().replace(/,/g,""));
            var ProCompanyRate = Number($("#txtProCompanyRateW38F2041").val().replace(/,/g,""));
            var ProCCost = Number($("#txtProCCostW38F2041").val().replace(/,/g,""));
            var ave = format2(calAve(ProCCost, ProCompanyRate, ProNumber), '',2);
            $("#txtProAverageCostsW38F2041").val(ave);
        });
//, #txtProNumberW38F2041, #txtProEmployeeRateW38F2041, #txtProAverageCostsW38F2041
        $('/!*#txtProCostW38F2041, #txtProCompanyRateW38F2041,*!/ #txtProAverageCostsW38F2041, #txtProCCostW38F2041, #txtProEmployeeRateW38F2041').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 2,
            autoGroup: true,
            //prefix: '$', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () {
                self.Value('');
            }
        });*/

        /*$('#txtProNumberW38F2041').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 0,
            autoGroup: true,
            //prefix: '$', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () {
                self.Value('');
            }
        });*/
    });

    $("#btnNotSaveW38F2041").click(function(){
        ask_not_save(function(){
            $("#modalW38F2041").modal('hide');
        });
    });

    function saveData() {
        //alert("da chay vao save");
       /* var txtProposalNameW38F2041 = $("#txtProposalNameW38F2041");
        var slDepartmentIDW38F2041 = $("#slDepartmentIDW38F2041");
        var slTrainingFieldIDW38F2041 = $("#slTrainingFieldIDW38F2041");
        var slTrainingCourseIDW38F2041 = $("#slTrainingCourseIDW38F2041");*/
        var slApprovalFlowIDW38F2041 = $("#slApprovalFlowIDW38F2041");

        /*txtProposalNameW38F2041.get(0).setCustomValidity("");
        slDepartmentIDW38F2041.get(0).setCustomValidity("");
        slTrainingFieldIDW38F2041.get(0).setCustomValidity("");
        slTrainingCourseIDW38F2041.get(0).setCustomValidity("");*/
        slApprovalFlowIDW38F2041.get(0).setCustomValidity("");

        if (slApprovalFlowIDW38F2041.val() == "") {
            //alert("da chay");
            console.log(slApprovalFlowIDW38F2041.val());
            slApprovalFlowIDW38F2041.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Quy_trinh_duyet')}}");
            $("#frmW38F2041").find('#hdBtnSaveW38F2041').click();
            slApprovalFlowIDW38F2041.focus();
            return false;
        }
       /* if (txtProposalNameW38F2041.val() == "") {
            txtProposalNameW38F2041.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Dien_giai')}}");
            $("#frmW38F2041").find('#hdBtnSaveW38F2041').click();
            txtProposalNameW38F2041.focus();
            return false;
        }
        if (slDepartmentIDW38F2041.val() == "") {
            slDepartmentIDW38F2041.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Phong_ban')}}");
            $("#frmW38F2041").find('#hdBtnSaveW38F2041').click();
            slDepartmentIDW38F2041.focus();
            return false;
        }
        if (slTrainingFieldIDW38F2041.val() == "") {
            slTrainingFieldIDW38F2041.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Linh_vuc_dao_tao')}}");
            $("#frmW38F2041").find('#hdBtnSaveW38F2041').click();
            slTrainingFieldIDW38F2041.focus();
            return false;
        }
        if (slTrainingCourseIDW38F2041.val() == "") {
            slTrainingCourseIDW38F2041.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Khoa_dao_tao')}}");
            $("#frmW38F2041").find('#hdBtnSaveW38F2041').click();
            slTrainingCourseIDW38F2041.focus();
            return false;
        }
        console.log($("#cboDepartmentIDW38F2040").val());*/
        $.ajax({
            method: "POST",
            url: '{{url("/W38F2041/$pForm/$g/save")}}',
            data: $("#frmW38F2041").serialize() + "&slApprovalFlowIDW38F2041=" + $("#slApprovalFlowIDW38F2041").val() + "&Task=" +  task + "&ProposalID=" + ProposalID /*+ "&TrainingObjectID=" +  TrainingObjectID + "&TrainningEmpID=" +  TrainningEmpID  + "&DepartmentIDW38F2041=" + $("#cboDepartmentIDW38F2040").val()*/,
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
                        console.log("add");
                        loadNext();
                        update4ParamGrid($grid, data[0], 'add');
                    }
                    if (task == "edit"){
                        update4ParamGrid($grid, data[0], 'edit');
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
        console.log("da chay vao loadNext");
        $('#btnSaveW38F2041').prop('disabled', true);
        @if($task == "add")
        $('#btnNextW38F2041').prop('disabled', false);
        @endif
        $('#btnNotSaveW38F2041').prop('disabled', true);
    }

</script>