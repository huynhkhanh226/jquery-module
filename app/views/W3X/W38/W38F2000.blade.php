<div class="modal fade" id="modalW38F2000" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading(Helpers::getRS($g,"Cap_nhat_de_xuat_dao_tao"),"W38F2000",true,"closePop")}}
            </div>
            @if ($probathid != "" && $proposalid != "")
                @if (count($dataMasterW38F2000) > 0)
                    @define $txtProposalName = $dataMasterW38F2000[0]["ProposalName"]
                    @define $txtProNumber = number_format($dataMasterW38F2000[0]["ProNumber"],0)
                    @define $idAppNumber = number_format($dataMasterW38F2000[0]["AppNumber"],0)
                    @define $txtTrainingPeriod = number_format($dataMasterW38F2000[0]["TrainingPeriod"],2)

                    @define $txtTrainningEmpName = $dataMasterW38F2000[0]["TrainningEmpName"]
                    @define $txtContent = $dataMasterW38F2000[0]["Content"]
                    @define $txtTrainingPurpose = $dataMasterW38F2000[0]["TrainingPurpose"]
                    @define $txtProCost =number_format($dataMasterW38F2000[0]["ProCost"],Session::get("W91P0000")['DecimalPlaces'])
                    @define $txtProExchangeRate =number_format($dataMasterW38F2000[0]["ProExchangeRate"],Session::get("W91P0000")['ExchangeRateDecimals'])
                    @define $txtProCCost =number_format($dataMasterW38F2000[0]["ProCCost"],Session::get("W91P0000")['D90_ConvertedDecimals'])
                    @define $txtProNote = $dataMasterW38F2000[0]["ProNote"]
                    @define $txtAddress = $dataMasterW38F2000[0]["Address"]

                    @define $ApprovalFlowID = $dataMasterW38F2000[0]["ApprovalFlowID"]
                    @define $cboProposerID = $dataMasterW38F2000[0]["ProposerID"]
                    @define $TransID = $dataMasterW38F2000[0]["TransID"]
                    @define $cboDepartmentID = $dataMasterW38F2000[0]["DepartmentID"]
                    @define $cboTeamID = $dataMasterW38F2000[0]["TeamID"]
                    @define $cboTrainingFieldID = $dataMasterW38F2000[0]["TrainingFieldID"]
                    @define $cboTrainingCourseID = $dataMasterW38F2000[0]["TrainingCourseID"]
                    @define $cboProCurrencyID = $dataMasterW38F2000[0]["ProCurrencyID"]
                    @define $idProposalDate = $dataMasterW38F2000[0]["ProposalDate"]
                    @define $idFromDate = $dataMasterW38F2000[0]["FromDate"]
                    @define $idToDate = $dataMasterW38F2000[0]["ToDate"]
                    @define $chkIsInternal = $dataMasterW38F2000[0]["IsInternal"]
                    @define $hdProposalIDW38F2000 = $proposalid
                    @define $hdProBatchIDW38F2000 = $probathid
                    @define $hdCreateUserIDW38F2000 = $dataMasterW38F2000[0]["CreateUserID"]
                    @define $hdCreateDateW38F2000 = $dataMasterW38F2000[0]["CreateDate"]

                @endif

            @else
                @define $txtProposalName = ""
                @define $txtProNumber = number_format(0,0)
                @define $idAppNumber = number_format(0,0)
                @define $txtTrainingPeriod = number_format(0,2)
                @define $txtTrainningEmpName = ""
                @define $txtContent = ""
                @define $txtTrainingPurpose = ""
                @define $ApprovalFlowID = ""
                @define $txtProCost = number_format(0,Session::get("W91P0000")['DecimalPlaces'])
                @define $txtProExchangeRate = number_format(0,Session::get("W91P0000")['ExchangeRateDecimals'])
                @define $txtProCCost = number_format(0,Session::get("W91P0000")['D90_ConvertedDecimals'])
                @define $txtProNote = ""
                @define $cboProposerID = $hr_employee_id
                @define $cboDepartmentID = ""
                @define $cboTeamID = ""
                @define $TransID = ""
                @define $txtAddress = ""
                @define $cboTrainingFieldID = ""
                @define $cboTrainingCourseID = ""
                @define $cboProCurrencyID = Session::get("W91P0000")['BaseCurrencyID']
                @define $dt = new DateTime();
                @define $idProposalDate = $dt->format('d/m/Y');;
                @define $idFromDate = ""
                @define $idToDate = ""
                @define $chkIsInternal = 0
                @define $hdProposalIDW38F2000 = ""
                @define $hdProBatchIDW38F2000 = ""
                @define $hdCreateUserIDW38F2000 = "";
                @define $hdCreateDateW38F2000 = "";
            @endif

            <div class="modal-body" style="padding:10px">
                <form class="form-horizontal" id="frmW38F2000">
                    <div id="divScrollbarW38F2000">
                        <!--New Row Bảo bổ sung-->
                        <div class="row form-group">
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Quy_trinh_duyet")}}</label>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <select class="form-control select2" id="cboApprovalFlowIDW38F2000" name="cboApprovalFlowIDW38F2000" required>
                                    <option value=''></option>
                                    @foreach($cbApprovalFlow as $rs)
                                        @if ($ApprovalFlowID == $rs["ApprovalFlowID"] && $proposalid != "")
                                            <option selected value="{{$rs["ApprovalFlowID"]}}">{{$rs["ApprovalFlowName"]}}</option>
                                        @else
                                            <option value="{{$rs['ApprovalFlowID']}}">{{$rs['ApprovalFlowName']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--Row 1-->
                        <div class="row form-group">
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Ten_de_xuat")}}</label>
                            </div>
                            <div class="col-md-10 col-xs-10">
                                <input class="form-control" type="text" id="txtProposalName" name="txtProposalName"
                                       value="{{$txtProposalName}}"
                                       required>
                            </div>
                        </div>
                        <!--Row 2-->
                        <div class="row form-group">
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_de_xuat")}}</label>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <input type="text" class="form-control dateW38F2000" id="idProposalDate"
                                               name="idProposalDate" value="{{$idProposalDate}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Nguoi_de_xuat")}}</label>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <select class="form-control select2" id="cboProposerID" name="cboProposerID">
                                    @foreach($proposals as $rs)
                                        @if ($cboProposerID == $rs["EmployeeID"] && $proposalid != "")
                                            <option selected value="{{$rs["EmployeeID"]}}">{{$rs["EmployeeName"]}}</option>
                                        @else
                                            <option value="{{$rs["EmployeeID"]}}">{{$rs["EmployeeName"]}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--New Row Bảo bổ sung-->
                        <div class="row form-group">
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Ke_hoach_dao_tao_nam")}}</label>
                            </div>
                            <div class="col-md-10 col-xs-10">
                                <select class="form-control select2" id="slTransIDW38F2000" name="slTransIDW38F2000">
                                    <option value=''></option>
                                    @foreach($cbTransID as $rs)
                                        @if ($TransID == $rs["TransID"] && $proposalid != "")
                                            <option selected value="{{$rs["TransID"]}}">{{$rs["ProposalName"]}}</option>
                                        @else
                                            <option value="{{$rs['TransID']}}">{{$rs['ProposalName']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--Row 3-->
                        <div class="row form-group">
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Phong_ban")}}</label>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <select class="form-control select2" id="cboDepartmentID" name="cboDepartmentID" required>
                                    <option value=''></option>
                                    @foreach($department as $key=>$value)
                                        @if ($cboDepartmentID == $key)
                                            <option selected value="{{$key}}">{{$value}}</option>
                                        @else
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"To_nhom")}}</label>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <select class="form-control select2" id="cboTeamID" name="cboTeamID">
                                    <option value=''></option>
                                    @foreach($team as $rs)
                                        @if ($cboTeamID == $rs["TeamID"])
                                            <option selected value="{{$rs["TeamID"]}}">{{$rs["TeamName"]}}</option>
                                        @else
                                            <option value="{{$rs["TeamID"]}}">{{$rs["TeamName"]}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--Row 4-->
                        <div class="row form-group">
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Linh_vuc_dao_tao")}}</label>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                    <!--select class="form-control select2" id="cboTrainingFieldID" name="cboTrainingFieldID">
                                        <option value=''></option>
                                    </select -->

                                <select class="form-control select2" id="cboTrainingFieldID" name="cboTrainingFieldID">
                                    <option value='%'></option>
                                    @foreach($trainfields as $rs)
                                        @if ($cboTrainingFieldID == $rs["TrainingFieldID"])
                                            <option selected
                                                    value="{{$rs["TrainingFieldID"]}}">{{$rs["TrainingFieldName"]}}</option>
                                        @else
                                            <option value="{{$rs["TrainingFieldID"]}}">{{$rs["TrainingFieldName"]}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Khoa_dao_tao")}}</label>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                    <!-- select class="form-control select2" id="cboTrainingCourseID" name="cboTrainingCourseID">
                                        <option selected value=""></option>
                                    </select -->

                                <select class="form-control select2" id="cboTrainingCourseID" name="cboTrainingCourseID" required>
                                    <option selected value=""></option>
                                    @foreach($traincourses as $rs)
                                        @if ($cboTrainingCourseID == $rs["TrainingCourseID"])
                                            <option selected
                                                    value="{{$rs["TrainingCourseID"]}}">{{$rs["TrainingCourseName"]}}</option>
                                        @else
                                            <option value="{{$rs["TrainingCourseID"]}}">{{$rs["TrainingCourseName"]}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--Row 5-->
                        <div class="row form-group">
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"SL_de_xuat")}}</label>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <input class="form-control numbersOnly text-right" type="text" id="txtProNumber"
                                               name="txtProNumber" value="{{$txtProNumber}}">
                                    </div>
                                    <div class="col-md-3 col-xs-3 text-center">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"SL_duyet")}}</label>
                                    </div>
                                    <div class="col-md-4 col-xs-4">
                                        <label id="idAppNumber" class="pull-right">{{$idAppNumber}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Tong_so_gio_hoc")}}</label>
                            </div>
                            <div class="col-md-1 col-xs-1">
                                <input class="form-control numbersOnly text-right" type="text" id="txtTrainingPeriod"
                                       name="txtTrainingPeriod" value="{{$txtTrainingPeriod}}">

                            </div>
                        </div>
                        <!--Row 6-->
                        <div class="row form-group">
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"TG_dao_tao")}}</label>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <input type="text" class="form-control dateW38F2000" id="idFromDate" maxlength="12"
                                               name="idFromDate" value="{{$idFromDate}}">
                                    </div>
                                    <div class="col-md-2 col-xs-2 text-center">
                                        -
                                    </div>
                                    <div class="col-md-5 col-xs-5">
                                        <input type="text" class="form-control dateW38F2000" id="idToDate" maxlength="12"
                                               name="idToDate" value="{{$idToDate}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Nguoi_dao_tao")}}</label>
                            </div>
                            <div class="col-md-3 col-xs-3">
                                <input class="form-control" type="text"
                                       id="txtTrainningEmpName"
                                       name="txtTrainningEmpName" value="{{$txtTrainningEmpName}}" placeholder="">
                            </div>
                            <div class="col-md-1 col-xs-1">
                                <div class="checkbox" style="padding-top:3px">
                                    <label>
                                        <input type="checkbox" id="chkIsInternal" name="chkIsInternal"
                                               value="{{$chkIsInternal}}" {{$chkIsInternal == 1 ? "checked" : ""}}
                                        />{{Helpers::getRS($g,"Noi_bo")}}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!--Row 7-->
                        <div class="row form-group">
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Noi_dung")}}</label>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <input class="form-control" type="text" id="txtContent"
                                       name="txtContent" value="{{$txtContent}}">
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Muc_dich_dao_tao")}}</label>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <input class="form-control" type="text" id="txtTrainingPurpose"
                                       name="txtTrainingPurpose" value="{{$txtTrainingPurpose}}">
                            </div>
                        </div>
                        <!--Row 8-->
                        <div class="row form-group">
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Chi_phi")}}</label>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <input class="form-control text-right" type="text" id="txtProCost"
                                       name="txtProCost" value="{{$txtProCost}}">
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <div id="idCurrencyW38F2000">
                                    <input type="hidden" id="hdOperatorW38F2000" name="hdOperatorW38F2000" value="">
                                    <select class="form-control select2" id="cboProCurrencyID" name="cboProCurrencyID">
                                        @foreach($currencies as $rs)
                                            <option rate="{{number_format($rs["ExchangeRate"], Session::get("W91P0000")['ExchangeRateDecimals'])}}"
                                                    operator="{{$rs["Operator"]}}"
                                                    value="{{$rs["CurrencyID"]}}" {{$cboProCurrencyID==$rs["CurrencyID"]?"selected":""}}>{{$rs["CurrencyID"]}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Ty_gia")}}</label>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-4 col-xs-4">
                                        <input class="form-control text-right" type="text" id="txtProExchangeRate"
                                               name="txtProExchangeRate" value="{{$txtProExchangeRate}}">
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <input class="form-control text-right" type="text" id="txtProCCost"
                                               name="txtProCCost" value="{{$txtProCCost}}">
                                    </div>
                                    <div class="col-md-2 col-xs-2 pdl0">
                                        <label class="" style="margin-top:3px"
                                               id="CurrencyID">{{Session::get("W91P0000")['BaseCurrencyID']}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--New Row Bảo bổ sung-->
                        <div class="row form-group">
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Dia_diem")}}</label>
                            </div>
                            <div class="col-md-10 col-xs-10">
                                <input class="form-control" type="text" id="txtAddress" name="txtAddress"
                                       value="{{$txtAddress}}">
                            </div>
                        </div>
                        <!--Row 9-->
                        <div class="row form-group">
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Ghi_chu")}}</label>
                            </div>
                            <div class="col-md-10 col-xs-10">
                                <input class="form-control" type="text" id="txtProNote" name="txtProNote"
                                       value="{{$txtProNote}}">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6 col-xs-6 cls_update">
                                <a onclick="showW09F5605()"
                                   style="text-decoration: underline;font-style: italic;">{{Helpers::getRS($g,"Cap_nhat_nhan_vien_vao_de_xuat_dao_tao")}}</a>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 col-xs-12">
                                <div id="divEmployeeW38F2000" style="width:100%"></div>
                            </div>
                        </div>
                        <div class="row form-group" style="padding-bottom: 0px;margin-bottom: 0px">
                            <div class="col-md-6 col-xs-6">
                                <button type="button" id="frm_btnedit" onclick="enable_menu('edit')"
                                        class="btn btn-default smallbtn pull-left mgr10 "><span
                                            class="glyphicon glyphicon-edit mgr5"></span> {{Helpers::getRS($g,"Sua")}}
                                </button>
                                <button type="button" id="frm_btnDelete" onclick="delete_proposal();"
                                        class="btn btn-default smallbtn pull-left "><span
                                            class="glyphicon glyphicon-remove mgr5"></span> {{Helpers::getRS($g,"Xoa")}}
                                </button>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <button type="button" id="btnSaveD38F2000" name="btnSaveD38F2000"
                                        onclick="return allow_save();"
                                        class="btn btn-default smallbtn pull-right"><span
                                            class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                                </button>
                                <button type="button" id="btn_fileW38F2000" class="btn btn-default smallbtn pull-right mgr5">
                                    <span class="glyphicon glyphicon-paperclip mgr5"></span> {{Helpers::getRS($g,"Dinh_kem")}}
                                </button>
                            </div>
                        </div>
                        <input type="hidden" id="hdCreateUserIDW38F2000" name="hdCreateUserIDW38F2000"
                               value="{{$hdCreateUserIDW38F2000}}">
                        <input type="hidden" id="hdCreateDateW38F2000" name="hdCreateDateW38F2000"
                               value="{{$hdCreateDateW38F2000}}">
                        <input type="hidden" id="hdProposalIDW38F2000" name="hdProposalIDW38F2000"
                               value="{{$hdProposalIDW38F2000}}">
                        <input type="hidden" id="hdProBatchIDW38F2000" name="hdProBatchIDW38F2000"
                               value="{{$hdProBatchIDW38F2000}}">
                        <input type="hidden" id="hdStatus" name="hdStatus" value="{{$status == ""? 0:$status}}">
                        <input type="hidden" id="hdpForm" name="hdpForm" value="{{Session::get($pForm)}}">

                        <input type="hidden" id="hdSelectedW38F2000" name="hdSelectedW38F2000" value="">

                        <input type="hidden" id="hdExchangeRateDecimals" name="hdExchangeRateDecimals"
                               value="{{Session::get("W91P0000")['ExchangeRateDecimals']}}">
                        <input type="hidden" id="hdDecimalPlaces" name="hdDecimalPlaces"
                               value="{{Session::get("W91P0000")['DecimalPlaces']}}">
                        <input type="hidden" id="hdD90_ConvertedDecimals" name="hdD90_ConvertedDecimals"
                               value="{{Session::get("W91P0000")['D90_ConvertedDecimals']}}">
                        <input type="hidden" id="hdEmployeesCount" name="hdEmployeesCount" value="0"/>
                        <button type="submit" id="frm_hbtnSave" class="hidden"></button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<div>
    @include('W0X.W09.W09F5605')
</div>
<div id="emailPOP">
</div>
<div class="modal draggable fade" id="mPopUpW38F2000" data-backdrop="static" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading(Helpers::getRS($g,"Thong_baoU"),"",false,"closePop")}}
            </div>
            <div class="modal-body pull-left" style="background: #fff; width: 100%; padding-bottom: 5px;">
            </div>
        </div>
    </div>
</div><!-- /.modal -->

<script type="text/javascript">
    var TeamID = "";
    var TrainingCourseID = "";
    var ProposalID = "";
    var sKeyW38F3000 = "";
    var tEmArr = []; //mảng tạm lưu dữ liệu từ màn hình W09F5605

    function updateGridW09F5605(arr){
        tEmArr = arr;
    }

    //nút đính kèm
    $('#btn_fileW38F2000').click(function () {

        var key = $("#hdProposalIDW38F2000").val();
        //alert(key);
        openModelW09F4010(key);

        //alert("anh bao");
    });

    function  openModelW09F4010(keyID) {
        showFormDialogPost('{{url("/W09F4010/$pForm/$g")}}', "modalW09F4010",
            {
                formCall: "W38F2000",
                keyID: keyID,
                tableName: 'D38T2000'
            },2);
    }

    $(document).ready(function () {
        @if($proposalid!="") // s?a
            statusW38F3000 = 2;
            //$("#cboApprovalFlowIDW38F2000").prop('disabled', true);
        @else
            statusW38F3000 = 1;//Th�m m?i
        @endif
        $('.dateW38F2000').datepicker({
            autoclose: true,
            format: "dd/mm/yyyy",
            language: 'vi'
        });

        if ($("#txtProExchangeRate").val() == "" || $("#txtProExchangeRate").val() == 0)
            $("#txtProExchangeRate").val($('#cboProCurrencyID option:selected').attr('rate'));
        if ($("#hdOperatorW38F2000").val() == "")
            $("#hdOperatorW38F2000").val($('#cboProCurrencyID option:selected').attr('operator'));


        $("#divScrollbarW38F2000").height($(document).height() - 90);
        $("#divScrollbarW38F2000").css("overflow-y", "auto");
        $("#divScrollbarW38F2000").css("overflow-x", "hidden");

//        $("#divScrollbarW38F2000").mCustomScrollbar(
//            {
//                axis: "y",
//                theme: "rounded-dark",
//                scrollButtons: {enable: true},
//                autoExpandScrollbar: true,
//                advanced: {autoExpandHorizontalScroll: true},
//                scrollInertia: 100,
//                //scrollbarPosition:"outside"
//            });
    });

    $("#modalW38F2000").on('shown.bs.modal', function () {
        //console.log("da chay show");
        reloadGridD09F5605();
    });

    var showsendmail = function () {
        $("#emailPOP").find("#mPopUpSendMail").modal('show');
    };

    Date.prototype.isValid = function () {
        return this.getTime() === this.getTime();
    };

    $('#txtProCost').on('blur', function () {
        $('#txtProCost').val(format2($('#txtProCost').val().replace(/,/g, ""), '', $("#hdDecimalPlaces").val()));
        cal_ProCCost();
    });

    $('#txtProExchangeRate').on('blur', function () {
        $('#txtProExchangeRate').val(format2($('#txtProExchangeRate').val().replace(/,/g, ""), '', $("#hdExchangeRateDecimals").val()));
        cal_ProCCost();
    });


    $('#txtProCCost').on('blur', function () {
        $('#txtProCCost').val(format2($('#txtProCCost').val().replace(/,/g, ""), '', $("#hdD90_ConvertedDecimals").val()));
        cal_ProCost();
    });

    $('#txtProNumber').on('blur', function () {
        $('#txtProNumber').val(format2($('#txtProNumber').val().replace(/,/g, ""), '', 0));
    });

    $('#txtAppNumber').on('blur', function () {
        $('#txtProCost').val(format2($('#txtAppNumber').val().replace(/,/g, ""), '', 0));
    });

    function cal_ProCCost() {
        var txtProCost = Number($("#txtProCost").val().replace(/,/g, ""))
        var txtProExchangeRate = Number($("#txtProExchangeRate").val().replace(/,/g, ""))

        if ($("#txtProExchangeRate").val() != "") {
            if ($("#hdOperatorW38F2000").val() == 0) {
                $("#txtProCCost").val(format2(txtProCost * txtProExchangeRate, '', $("#hdD90_ConvertedDecimals").val()));
            } else {
                if (txtProExchangeRate > 0) {
                    $("#txtProCCost").val(format2(txtProCost / txtProExchangeRate, '', $("#hdD90_ConvertedDecimals").val()));

                } else {
                    $("#txtProCCost").val(format2(0, '', $("#hdD90_ConvertedDecimals").val()));
                }
            }
        }
    }

    function cal_ProCost() {
        var txtProCCost = Number($("#txtProCCost").val().replace(/,/g, ""))
        var txtProExchangeRate = Number($("#txtProExchangeRate").val().replace(/,/g, ""))

        if ($("#txtProExchangeRate").val() != "") {
            if ($("#hdOperatorW38F2000").val() == 1) {
                $("#txtProCost").val(format2(txtProCCost * txtProExchangeRate, '', $("#hdDecimalPlaces").val()));
            } else {
                if (txtProExchangeRate > 0) {
                    $("#txtProCost").val(format2(txtProCCost / txtProExchangeRate, '', $("#hdDecimalPlaces").val()));

                } else {
                    $("#txtProCost").val(format2(0, '', $("#hdDecimalPlaces").val()));
                }
            }
        }
    }


    $("#frmW38F2000").find("#cboDepartmentID").change(function () {
        //alert("da chay pb");
        $.ajax({
            method: "POST",
            url: '{{url("/W38F2000/".$pForm."/".$g."/combo/team")}}',
            data: {cboDepartmentID: $("#cboDepartmentID").val()},
            success: function (data) {
                $("#cboTeamID").html(data);
                if(TeamID != ""){
                    $("#cboTeamID").val(TeamID);
                }
            }
        });
    });

    $("#frmW38F2000").find("#slTransIDW38F2000").change(function () {
        $.ajax({
            method: "POST",
            url: '{{url("/W38F2000/".$pForm."/".$g."/combo/TransID")}}',
            data: {slTransIDW38F2000: $("#slTransIDW38F2000").val()},
            success: function (data) {
                console.log(data);
                var masterValue = data[0];
                var slTransIDW38F2000 = $('#slTransIDW38F2000').val();
                $("#cboTrainingFieldID").html(data[1]);
                $("#cboTrainingCourseID").html(data[2]);
                console.log(slTransIDW38F2000);
                $("#txtProNumber").val(0);
                $("#idFromDate").datepicker("update", '');
                $("#idToDate").datepicker("update", '');
                $("#txtTrainningEmpName").val('').prop("disabled", false);
                $("#txtAddress").val('');
                $("#txtTrainingPurpose").val('').prop("disabled", false);
                $("#txtContent").val('');
                $("#txtProCost").val(0);
                //("#txtProExchangeRate").val('');
                $("#txtProCCost").val(0);
                $("#cboProCurrencyID").val('VND');

                if(slTransIDW38F2000 == ""){
                    $("#cboDepartmentID").val('').prop("disabled", false);
                    $("#cboDepartmentID").trigger("change");
                    $("#cboTeamID").prop("disabled", false);
                    TeamID = '';
                    //$("#cboTrainingFieldID").val('').prop("disabled", false);
                    //$("#cboTrainingFieldID").trigger("change");
                    //$("#cboTrainingCourseID").prop("disabled", false);
                    TrainingCourseID = '';
                }else{
                    $("#cboDepartmentID").val(masterValue[0].DepartmentID).prop("disabled", true);
                    $("#cboDepartmentID").trigger("change");
                    $("#cboTeamID").prop("disabled", false);
                    TeamID = masterValue[0].TeamID;
                    ProposalID = masterValue[0].ProposalID;
                    //$("#cboTrainingFieldID").val(data[0].TrainingFieldID).prop("disabled", true);
                    //$("#cboTrainingFieldID").val(masterValue[0].TrainingFieldID);
                    //$("#cboTrainingFieldID").trigger("change");
                    //$("#cboTrainingCourseID").prop("disabled", true);
                    //TrainingCourseID = masterValue[0].TrainingCourseID;
                   /* $("#txtProNumber").val(masterValue[0].ProNumber);
                    $("#idFromDate").datepicker("update", masterValue[0].FromDate);
                    $("#idToDate").datepicker("update", masterValue[0].ToDate);
                    $("#txtTrainningEmpName").val(masterValue[0].TrainningEmpName).prop("disabled", true);
                    $("#txtAddress").val(masterValue[0].Address);
                    $("#txtTrainingPurpose").val(masterValue[0].TrainingPurpose).prop("disabled", true);
                    $("#txtContent").val(masterValue[0].Content);
                    $("#txtProCost").val(masterValue[0].ProCost);
                    $("#txtProExchangeRate").val(masterValue[0].ProExchangeRate);
                    $("#txtProCCost").val(masterValue[0].ProCCost);*/
                }
                $("#cboTrainingFieldID").trigger('change');

            }
        });
    });

    $("#frmW38F2000").find("#cboTrainingFieldID").change(function () {
        $("#idFromDate").val("");
        $("#idToDate").val("");
        $("#txtTrainningEmpName").val("");
        $("#txtContent").val("");
        $("#txtTrainingPurpose").val("");
        $("#txtTrainingPeriod").val("");
        $("#txtTrainingMonthNum").val(0);

        $.ajax({
            method: "POST",
            url: '{{url("/W38F2000/".$pForm."/".$g."/combo/trainingcourse")}}',
            data: {
                cboTrainingFieldID: $("#cboTrainingFieldID").val(),
                slTransIDW38F2000: $("#slTransIDW38F2000").val()},
            success: function (data) {
                $("#cboTrainingCourseID").html(data);
                //$("#cboTrainingCourseID").val(TrainingCourseID);
                $("#cboTrainingCourseID").trigger('change');
            }
        });
    });

    $("#frmW38F2000").find("#cboTrainingCourseID").change(function () {
        $.ajax({
            method: "POST",
            url: '{{url("/W38F2000/".$pForm."/".$g."/combo/defaultvalue")}}',
            data: {
                cboTrainingFieldID: $("#cboTrainingFieldID").val(),
                slTransIDW38F2000: $("#slTransIDW38F2000").val(),
                ProposalID: $("#cboTrainingCourseID option:selected").attr('proposalID'),
                cboTrainingCourseID: $("#cboTrainingCourseID").val()
            },
            success: function (data) {
                var result = $.parseJSON(data)
                console.log(result);
                if($('#cboTrainingCourseID').val() == ''){
                    $("#txtTrainningEmpName").prop("disabled", false);
                    $("#txtTrainingPurpose").prop("disabled", false);
                }else{
                    $("#txtTrainningEmpName").prop("disabled", true);
                    $("#txtTrainingPurpose").prop("disabled", true);
                }
                $("#idFromDate").val("");
                $("#idToDate").val("");
                $("#txtTrainningEmpName").val("");
                $("#txtContent").val("");
                $("#txtTrainingPurpose").val("");
                $("#txtTrainingPeriod").val("");
                $("#txtAddress").val("");
                $("#txtTrainingMonthNum").val(0);

                $("#idFromDate").datepicker("update", result[0]["FromDate"]);
                $("#idToDate").datepicker("update", result[0]["ToDate"]);
                $("#txtTrainningEmpName").val(result[0]["TrainningEmpName"]);
                $("#txtContent").val(result[0]["Content"]);
                $("#txtTrainingPurpose").val(result[0]["TrainingPurpose"]);
                $("#txtTrainingPeriod").val(result[0]["TrainingPeriod"]);
                $("#txtAddress").val(result[0]["Address"]);
                var tenp1 = $("#idFromDate").val().split("/");
                var d1 = new Date(tenp1[2], tenp1[1] - 1, tenp1[0]);
                var tenp2 = $("#idToDate").val().split("/");
                var d2 = new Date(tenp2[2], tenp2[1] - 1, tenp2[0]);
                var months = d2.getMonth() - d1.getMonth() + (12 * (d2.getFullYear() - d1.getFullYear()));

                $("#txtTrainingMonthNum").val(months + 1);
            }
        });
    });

    $("#frmW38F2000").find("#chkIsInternal").change(function () {
        if (this.checked) {
            $("#frmW38F2000").find("#chkIsInternal").val(1);
        } else {
            $("#frmW38F2000").find("#chkIsInternal").val(0);
        }
    });

    $("#cboProCurrencyID").change(function () {
        $("#txtProExchangeRate").val($('option:selected', this).attr('rate'));
        $("#hdOperatorW38F2000").val($('option:selected', this).attr('operator'));
        cal_ProCCost();
    });

    //bảo bổ sung
    function closePop() {
        $("#modalW38F2000").modal('hide');
    }

    var closePopW38F2000 = function () {
        //$("#modalW38F2000").modal('hide');
        ReloadData();
        $.ajax({
            method: "POST",
            url: '{{url("/W38F2000/".$pForm."/".$g."/close")}}',
            success: function (data) {
                //console.log("Delete temp table");
            }
        });
    };

    function showW09F5605() {
        $("#hdDepartmentIDW09F5605").val($("#cboDepartmentID").val());
        $("#hdProposalIDW09F5605").val($("#hdProposalIDW38F2000").val());//Them moi thi rong
        $("#hdProBatchIDW09F5605").val($("#hdProBatchIDW38F2000").val());//Them moi thi rong
        $("#hdTrainingCourseIDW09F5605").val($("#cboTrainingCourseID").val());
        $("#hdSelectedW38F2000").val("0");
        $("#cboDepartmentIDW09F5605").val($("#cboDepartmentID").val());

        $.ajax({
            method: "POST",
            url: '{{url("/W09F5605/".$pForm."/".$g."/combo/team")}}',
            data: {cboDepartmentID: $("#cboDepartmentID").val()},
            success: function (data) {
                $("#cboTeamIDW09F5605").html("");
                $("#cboTeamIDW09F5605").html(data);
                $("#cboTeamIDW09F5605").val($("#cboTeamID").val());
            }
        });

        $("#modalW09F5605").modal('show');
        console.log(tEmArr);
        $.ajax({
            method: "POST",
            url: '{{url("/W09F5605/".$pForm."/".$g."")}}',
            data: {
                tEmArr: tEmArr
            },
            success: function (data) {

            }
        });
    }

    function reloadGridD09F5605(reLoad) {
        var rl = typeof reLoad !== 'undefined' ? false : true;
        $.ajax({
            method: "POST",
            url: '{{url("/W38F2000/".$pForm."/".$g."/tdbg")}}',
            data: {
                proposalid: $("#hdProposalIDW38F2000").val(),
                probatchid: $("#hdProBatchIDW38F2000").val(),
                trainingcourseid: $("#cboTrainingCourseID").val()
            },
            success: function (data) {
                $("#divEmployeeW38F2000").html("");
                $("#divEmployeeW38F2000").html(data);
                if (rl) {
                    if ($("#hdProposalIDW38F2000").val() != "") {
                        enable_menu("view");
                    } else {
                        enable_menu("edit");
                    }
                }
            }
        });

    }


    function enable_menu(sMode) {
        switch (sMode) {
            case "view":
                $('#frmW38F2000 input').prop('disabled', true);
                $('#frmW38F2000 select').prop('disabled', true);
                $('#frmW38F2000').find("#frm_btnedit").prop('disabled', !$("#hdpForm").val() > 2);
                $('#frmW38F2000').find("#frm_btnDelete").prop('disabled', !($("#hdpForm").val() > 3));
                if ($("#hdStatus").val() == "1") {
                    $('#frmW38F2000').find("#frm_btnDelete").prop('disabled', true);
                }
                $('#frmW38F2000').find("#btnSaveD38F2000").prop('disabled', true);
                $('#frmW38F2000').find("#btn_fileW38F2000").prop('disabled', false);
                $('#frmW38F2000').find(".cls_update>a").addClass('disabled');
                var colM = $("#tblEmployeeIDW38F2000").pqGrid("option", "colModel");
                colM[0].hidden = true;
                $("#tblEmployeeIDW38F2000").pqGrid("option", "colModel", colM);
                $("#tblEmployeeIDW38F2000").pqGrid("refreshDataAndView");
                break;
            case "edit":
                if ($("#hdProposalIDW38F2000").val() != "") { //Sua
                    //alert(sMode);

                    $('#frmW38F2000').find("#frm_btnDelete").removeClass('hide');
                    $('#frmW38F2000').find("#frm_btnedit").removeClass('hide');
                    if ($("#hdStatus").val() == "0") {
                        $('#frmW38F2000 input').prop('disabled', false);
                        $('#frmW38F2000 select').prop('disabled', false);
                        $('#frmW38F2000').find(".cls_update>a").removeClass('disabled');
                        var colM = $("#tblEmployeeIDW38F2000").pqGrid("option", "colModel");
                        colM[0].hidden = false;
                        $("#tblEmployeeIDW38F2000").pqGrid("option", "colModel", colM);
                    } else {
                        $('#frmW38F2000 input').prop('disabled', true);
                        $('#frmW38F2000 select').prop('disabled', true);
                        $('#frmW38F2000').find("#txtProposalName").prop('disabled', false);
                        $('#frmW38F2000').find(".cls_update>a").addClass('disabled');
                        var colM = $("#tblEmployeeIDW38F2000").pqGrid("option", "colModel");
                        colM[0].hidden = true;
                        $("#tblEmployeeIDW38F2000").pqGrid("option", "colModel", colM);
                    }
                    $('#frmW38F2000').find("#cboApprovalFlowIDW38F2000").prop('disabled', true);
                    var slTransIDW38F2000 = $("#slTransIDW38F2000").val();
                    if(slTransIDW38F2000 != ""){
                        $("#cboDepartmentID").prop('disabled', true);
                        $("#cboTrainingFieldID").prop('disabled', false);
                        $("#cboTeamID").prop('disabled', false);
                        $("#txtTrainningEmpName").prop('disabled', false);
                        $("#txtTrainingPurpose").prop('disabled', false);
                        $("#cboTrainingCourseID").prop('disabled', false);
                    }
                    $("#tblEmployeeIDW38F2000").pqGrid("refreshDataAndView");

                } else {//Them moi
                    $('#frmW38F2000').find("#frm_btnDelete").addClass('hide');
                    $('#frmW38F2000').find("#frm_btnedit").addClass('hide');
                    $('#frmW38F2000 input').prop('disabled', false);
                    $('#frmW38F2000 select').prop('disabled', false);
                    $('#frmW38F2000').find("#btn_fileW38F2000").prop('disabled', true);
                }
                $('#frmW38F2000').find("#frm_btnDelete").prop('disabled', true);
                $('#frmW38F2000').find("#frm_btnedit").prop('disabled', true);
                $('#frmW38F2000').find("#btnSaveD38F2000").prop('disabled', !($("#hdpForm").val() > 2));
                //$('#frmW38F2000').find("#btn_fileW38F2000").prop('disabled', !($("#hdpForm").val() > 2));

                break;
        }
    }

    function allow_save() {
        ask_save(save_callback);
    }

    function save_callback() {
        var txtProposalName = $("#frmW38F2000").find("#txtProposalName");
        if (txtProposalName.val() == "") {
            txtProposalName.get(0).setCustomValidity("{{Helpers::getRS($g,"Ban_chua_nhap_dien_giai")}}");
            $("#frmW38F2000").find("#frm_hbtnSave").click();
            return false;
        }
        else {
            txtProposalName.get(0).setCustomValidity("");
        }

        var cboDepartmentID = $("#frmW38F2000").find("#cboDepartmentID");
        if (cboDepartmentID.val() == "") {
            cboDepartmentID.get(0).setCustomValidity("{{Helpers::getRS($g,"Ban_chua_nhap_phong_ban")}}");
            $("#frmW38F2000").find("#frm_hbtnSave").click();
            return false;
        }
        else {
            cboDepartmentID.get(0).setCustomValidity("");
        }

      /*  var cboTrainingCourseID = $("#frmW38F2000").find("#cboTrainingCourseID");
        if (cboTrainingCourseID.val() == "") {
            cboTrainingCourseID.get(0).setCustomValidity("{{Helpers::getRS($g,"Ban_chua_nhap_khoa_dao_tao")}}");
            $("#frmW38F2000").find("#frm_hbtnSave").click();
            return false;
        }
        else {
            cboTrainingCourseID.get(0).setCustomValidity("");
        }*/

        var txtProNumber = Number($("#frmW38F2000").find("#txtProNumber").val());
        var hdEmployeesCount = Number($("#frmW38F2000").find("#hdEmployeesCount").val());
        if (hdEmployeesCount == 0) {
            alert_warning("{{Helpers::getRS($g,"Ban_chua_chon_nhan_vien")}}");
            return false;
        }

        var tenp1 = $("#idFromDate").val().split("/");
        var d1 = new Date(tenp1[2], tenp1[1], tenp1[0]);
        var tenp2 = $("#idToDate").val().split("/");
        var d2 = new Date(tenp2[2], tenp2[1], tenp2[0]);
        var months = d2.getMonth() - d1.getMonth() + (12 * (d2.getFullYear() - d1.getFullYear())) + 1;

        if (months < 1) {
            alert_warning("{{Helpers::getRS($g,"Thoi_gian_tu_phai_nho_hon_thoi_gian_den")}}", focusToDate);
            return false;
        }

        if ((Number(hdEmployeesCount) != Number(txtProNumber))) {
            alert_custom(icon_ask, "{{Helpers::getRS($g,"So_luong_nhan_vien_khong_phu_hop_voi_so_luong_de_xuat.Ban_co_muon_luu_khong")}}", true, true, yes_callback, no_callback);
        } else {

            $("#frmW38F2000").find("#frm_hbtnSave").click();
        }
    }

    function focusToDate() {
        $("#idToDate").val("");
        $("#idToDate").focus();
    }

    function yes_callback() {
        $("#frmW38F2000").find("#frm_hbtnSave").click();
    }

    function no_callback() {
        return false;
    }

    $("#modalW38F2000").on('submit', '#frmW38F2000', function (e) {
        e.preventDefault();
        $(".l3loading").removeClass('hide');
        var obj = [];
        var obj = $("#tblEmployeeIDW38F2000").pqGrid("option", "dataModel.data");
        var mode = 0;
        if ($("#hdProposalIDW38F2000").val() != "")
            mode = 2;
        var proposalid = $("#hdProposalIDW38F2000").val();
        if (proposalid == "")
            proposalid = -1;
        var probathid = $("#hdProBatchIDW38F2000").val();
        if (probathid == "")
            probathid = -1;
        var status = $("#hdStatus").val();
        $.ajax({
                method: "POST",
                url: '{{"W38F2000/".$pForm."/".$g."/savemaster/"}}' + probathid + "/" + proposalid + "/" + status,
                data: $(this).serialize() + "&cboApprovalFlowIDW38F2000=" + $('#cboApprovalFlowIDW38F2000').val() + "&cboDepartmentID=" + $('#cboDepartmentID').val()+ "&cboTrainingFieldID=" + $('#cboTrainingFieldID').val()+ "&cboTrainingCourseID=" + $('#cboTrainingCourseID').val()
                + "&cboTeamID=" + $('#cboTeamID').val()  + "&txtTrainningEmpName=" + $('#txtTrainningEmpName').val()  + "&txtTrainingPurpose=" + $('#txtTrainingPurpose').val(),
                success: function (data) {
                    $(".l3loading").addClass('hide');
                    if (data == 0) {
                        save_not_ok();
                    }
                    else {
                        console.log("da chay save");
                        $.ajax({
                            method: "POST",
                            url: '{{"W38F2000/".$pForm."/".$g."/savedetail/"}}' + mode,
                            data: {
                                ProposalID: data,
                                obj: obj,
                                TrainingCourseID: $("#cboTrainingCourseID").val(),
                                hdStatus: $("#hdStatus").val()
                            },
                            success: function (data) {
                                var result = $.parseJSON(data);
                                sKeyW38F3000 = result.key;
                                console.log(sKeyW38F3000);
                                switch (result.CODE) {
                                    case 1://Gui mail ngam
                                        if (result.message == "") {
                                            sKeyW38F3000 = result.key;
                                            $("#hdProposalIDW38F2000").val(sKeyW38F3000);
                                            save_ok_custom(save_ok_callback, null, "{{Helpers::getRS($g,"Email_da_duoc_gui_toi").': '}}",result.receivedUserName);
                                        } else {
                                            alert_error(result.message);
                                        }
                                        break;
                                    case 2://Truong hop show mail
                                        $("#emailPOP").html(result.rsvalue);
                                        sKeyW38F3000 = result.key;
                                        $("#hdProposalIDW38F2000").val(sKeyW38F3000);
                                        save_ok(save_ok_callback1);
                                        break;
                                    case 3://luu ma khong gui mail
                                        sKeyW38F3000 = result.key;
                                        save_ok(save_ok_callback);
                                        $("#hdProposalIDW38F2000").val(sKeyW38F3000);
                                        break;
                                }
                                //$('#frmW38F2000').find("#btn_fileW38F2000").prop('disabled', false);
                                //$('#frmW38F2000').find("#frm_hbtnSave").prop('disabled', false);
                                enable_menu("view");
                            }
                        });
                    }
                }
            }
        );
    });

    function save_ok_callback() {
        closePopW38F2000();
    }

    function save_ok_callback1() {
        closePopW38F2000();
        showsendmail();

    }

    function delete_proposal() {
        ask_delete(delete_callback);
    }

    function delete_callback() {
        $.ajax({
            method: "POST",
            url: '{{url("/W38F3000/view/".$pForm."/".$g."/checkstatus/")}}',
            data: {ProposalID: $("#hdProposalIDW38F2000").val(), Mode: 0},
            success: function (data) {
                var result = $.parseJSON(data);
                status = result.CODE;
                switch (result.CODE) {
                    case 1:
                        alert_warning(result.message);
                        break;
                    case 0:
                        update4ParamGrid($(document).find("#pqgrid_W38F3000"), null, 'delete');
                        alert_warning(result.message, closePopW38F2000);
                        break;

                }

            }
        });
    }

    $('#txtProCost, #txtProExchangeRate, #txtProCCost, #txtTrainingPeriod, #txtTrainingMonthNum, #txtProNumber').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: $("#hdDecimalPlaces").val(),
        autoGroup: true,
        //prefix: '$', //No Space, this will truncate the first character
        rightAlign: false,
        oncleared: function () {
            self.Value('');
        }
    });
</script>