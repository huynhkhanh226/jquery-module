<div class="modal fade modal" id="modalW25F2010" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <form class="form-horizontal" id="frmW25F2010" method="post" action="">
                <div class="modal-header">
                    {{Helpers::generateHeading($modalTitle,"W25F2010",true,"closePopW25F2010")}}
                </div>
                @if ($perW25F2010 <=2)
                    @define $cboDepartmentIDW25F2010 = Session::get("W91P0000")['DepartmentID']
                @else
                    @define $cboDepartmentIDW25F2010 = $department[0]["DepartmentID"]
                @endif
                <div class="modal-body">
                    <div class="box-body">
                        <div id="divScrollbarW25F2010" class="pdr15">
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'Ke_hoach_tong_the')}}</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select id="slPlanTransID" name="slPlanTransID"
                                                    class="form-control select2">
                                                <option value="chooseAgain"></option>
                                                @foreach($planTrans as $row)
                                                    @define $po = isset($rData['PlanTransID']) ? $rData['PlanTransID'] :''
                                                    @if ($po==$row['PlanTransID'])
                                                        <option value="{{$row['PlanTransID']}}"
                                                                selected>{{$row['PlanTransName']}}</option>
                                                    @else
                                                        <option value="{{$row['PlanTransID']}}">{{$row['PlanTransName']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <input type="hidden" value="view" id="FormMode">
                                    <input type="hidden" value="{{isset($rData['TransID']) ? $rData['TransID'] : ''}}"
                                           name="hdTransID">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'Phong_ban')}}</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select id="slDepartmentID" name="slDepartmentID"
                                                    class="form-control select2" required
                                                    @if ($perW25F2010 <=2) disabled @endif>
                                                @foreach($department as $rowDepartment)
                                                    <option value="{{$rowDepartment['DepartmentID']}}" {{$rowDepartment['DepartmentID'] == $cboDepartmentIDW25F2010 ? "selected": ""}} >{{$rowDepartment['DepartmentName']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'Vi_tri_tuyen_dung')}}</label>
                                        </div>
                                        <div class="col-md-7">
                                            <select id="slRecpositionID" name="slRecpositionID"
                                                    class="form-control select2" required>
                                                <option value=""></option>
                                                @foreach($positionid as $row)
                                                    @define $po = isset($rData['RecPositionID']) ? $rData['RecPositionID'] : ''
                                                    @if ($po==$row['PositionID'])
                                                        <option value="{{$row['PositionID']}}"
                                                                selected>{{$row['PositionName']}}</option>
                                                    @else
                                                        <option value="{{$row['PositionID']}}">{{$row['PositionName']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'To_nhom')}}</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select id="slTeamID" name="slTeamID" class="form-control select2">
                                                @foreach($teams as $row)
                                                    <option value="{{$row['TeamID']}}">{{$row['TeamName']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'Hinh_thuc_LV')}}</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select id="slWorkingStatusID" name="slWorkingStatusID"
                                                    class="form-control select2">
                                                <option value=""></option>
                                                @foreach($workingstatus as $row)
                                                    @define $wo = isset($rData['WorkingStatusID']) ? $rData['WorkingStatusID'] : ''
                                                    @if ($wo==$row['WorkingStatusID'])
                                                        <option value="{{$row['WorkingStatusID']}}"
                                                                selected>{{$row['WorkingStatusName']}}</option>
                                                    @else
                                                        <option value="{{$row['WorkingStatusID']}}">{{$row['WorkingStatusName']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div id="buttonFileW25F2010" class="col-md-12">
                                            <button type="button" id="btnFileW25F2010"
                                                    class="btn btn-default smallbtn pull-right"
                                                    @if(intval($fileNumber[0]['Count']) == 0) disabled @endif>
                                                <span class="glyphicon glyphicon-paperclip"></span> {{Helpers::getRS($g,"Dinh_kem")}}
                                                ({{intval($fileNumber[0]['Count'])}})
                                            </button>
                                        </div>
                                    </div>

                                <!--div class="row">
                                        <div class="col-md-5">
                                            <label class="lbl-normal">{{Helpers::getRS($g,'Cong_viec')}}</label>
                                        </div>
                                        <div class="col-md-7">
                                            <select id="slWorkID" name="slWorkID" class="form-control select2">
                                                <option value=""></option>
                                                @foreach($workid as $row)
                                    @define $wo = isset($rData['WorkID']) ? $rData['WorkID'] : ''
                                                    @if ($wo==$row['WorkID'])
                                        <option value="{{$row['WorkID']}}"
                                                                selected>{{$row['WorkName']}}</option>
                                                    @else
                                        <option value="{{$row['WorkID']}}">{{$row['WorkName']}}</option>
                                                    @endif
                                @endforeach
                                        </select>
                                    </div>
                                </div -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,'Loai_tuyen')}}</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="radio col-md-6 pdt5">
                                                <label>
                                                    <input name="optRecruitmentType" id="optRecruitmentType0" value="0"
                                                           type="radio" {{isset($rData['RecruitmentType'])?($rData["RecruitmentType"]==0?"checked":""):"checked"}}>
                                                    {{Helpers::getRS($g,'Tuyen_moi')}}
                                                </label>
                                            </div>
                                            <div class="radio col-md-6 pdt5">
                                                <label>
                                                    <input name="optRecruitmentType" id="optRecruitmentType1" value="1"
                                                           type="radio" {{isset($rData['RecruitmentType'])?($rData["RecruitmentType"]==1?"checked":""):""}}>
                                                    {{Helpers::getRS($g,'Thay_the')}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,'Loai_hop_dong')}}</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select id="slContractTypeID" name="slContractTypeID"
                                                    class="form-control liketext">
                                                <option value=""></option>
                                                @foreach($contractType as $row)
                                                    @define $wo = isset($rData['ContractTypeID']) ? $rData['ContractTypeID'] : ''
                                                    @if ($wo==$row['ContractTypeID'])
                                                        <option value="{{$row['ContractTypeID']}}"
                                                                selected>{{$row['ContractTypeName']}}</option>
                                                    @else
                                                        <option value="{{$row['ContractTypeID']}}">{{$row['ContractTypeName']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,'Dia_diem_lam_viec')}}</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" class="liketext form-control" id="txtWorkingPlace"
                                                   value="{{isset($rData['WorkPlace']) ? $rData['WorkPlace'] : ''}}"
                                                   name="txtWorkingPlace">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,'So_luong')}}</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" id="txtProNumber" name="txtProNumber" min="0"
                                                   value="{{isset($rData['ProNumber']) ? $rData['ProNumber'] : ''}}"
                                                   class="col-md-2 pdl0 pdr0 text-right"
                                                   onkeypress="return inputNumber(event);" required>
                                            <label class="liketext lbl-normal col-md-3 pdl5 pdr0">{{Helpers::getRS($g,'Gioi_tinh')}}</label>
                                            <input type="number" class="col-md-2 pdl0 pdr0 text-right" id="txtMaleQuan"
                                                   min="0"
                                                   value="{{isset($rData['MaleQuan']) ? $rData['MaleQuan'] : ''}}"
                                                   name="txtMaleQuan" onkeypress="return inputNumber(event);">
                                            <label class="liketext col-md-2 pdl0 pdr0 "
                                                   style="font-style: italic;"><span
                                                        class="digi digi-men mgl5 "></span></label>
                                            <input type="number" class="col-md-2 pdl0 pdr0 text-right"
                                                   id="txtFemaleQuan"
                                                   min="0"
                                                   value="{{isset($rData['FemaleQuan']) ? $rData['FemaleQuan'] : ''}}"
                                                   name="txtFemaleQuan" onkeypress="return inputNumber(event);">
                                            <label class="liketext col-md-1 pdl0 pdr0 "
                                                   style="font-style: italic;"><span
                                                        class="digi digi-woman mgl5 "></span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,'Thoi_gian_DX')}}</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <input class="form-control pull-right active" id="txtDate" type="text"
                                                       name="txtDate"
                                                       value="{{isset($rData['DateFrom']) ? $rData['DateFrom'].' - '.$rData['DateTo'] : ''}}"
                                                       readonly="true"
                                                       required>
                                                <div class="input-group-addon dateClass">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,'PV_du_kien')}}</label>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="input-group date">
                                                <input type="text" class="form-control" id="txtInterviewDate"
                                                       value="{{isset($rData['InterviewDate']) ? $rData['InterviewDate'] : ''}}"
                                                       name="txtInterviewDate" value="">
                                                <span class="input-group-addon"><i
                                                            class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,'Muc_luong_du_kien')}}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <input style="margin-left: 2px" type="number"
                                                           class="form-control pd0"
                                                           id="txtSalaryFrom"
                                                           value="{{isset($rData['SalaryFrom']) ? $rData['SalaryFrom'] : ''}}"
                                                           name="txtSalaryFrom">
                                                </div>
                                                <div class="col-md-1">
                                                    <label class="liketext lbl-normal">-</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="number" class="form-control pd0"
                                                           id="txtSalaryTo"
                                                           value="{{isset($rData['SalaryTo']) ? $rData['SalaryTo'] : ''}}"
                                                           name="txtSalaryTo">
                                                </div>
                                                <div class="col-md-5">
                                                    <select id="slCurrencyID" name="slCurrencyID"
                                                            class="col-md-12 form-control">
                                                        <option value=""></option>
                                                        @foreach($currency as $row)
                                                            @define $wo = isset($rData['CurrencyID']) ? $rData['CurrencyID'] : ''
                                                            @if ($wo==$row['CurrencyID'])
                                                                <option value="{{$row['CurrencyID']}}"
                                                                        selected>{{$row['CurrencyName']}}</option>
                                                            @else
                                                                <option value="{{$row['CurrencyID']}}">{{$row['CurrencyName']}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,'ngay_nhan_su_can')}}</label>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="input-group date">
                                                <input type="text" class="form-control" id="txtDateJoined"
                                                       value="{{isset($rData['DateJoined']) ? $rData['DateJoined'] : ''}}"
                                                       name="txtDateJoined" value="">
                                                <span class="input-group-addon"><i
                                                            class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-2" style="width: 11.1111%;">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,'Ly_do_can_tuyen')}}</label>
                                        </div>
                                        <div class="col-md-10" style="width: 88.8889%;">
                                            <input type="text" class="form-control" id="txtReasonRequest"
                                                   value="{{isset($rData['ReasonRequest']) ? $rData['ReasonRequest'] : ''}}"
                                                   name="txtReasonRequest" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <fieldset>
                                <legend class="legend">{{Helpers::getRS($g,"Tieu_chuan_can_tuyen")}}</legend>
                                <div style="padding-left: 3.15% !important;">
                                    <div class="row">
                                        <div class="col-md-1 pdl0 pdr0">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,'Do_tuoi')}}</label>
                                        </div>
                                        <div class="col-md-11">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <input type="number" class="form-control text-right pd0"
                                                                   id="txtAgeFrom" min="0"
                                                                   value="{{isset($rData['AgeFrom']) ? $rData['AgeFrom'] : ''}}"
                                                                   name="txtAgeFrom"
                                                                   onkeypress="return inputNumber(event);">
                                                        </div>
                                                        <div class="col-md-2 mgt0 ">
                                                            <label class="liketext lbl-normal ">-</label>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="number" class="form-control text-right pd0"
                                                                   id="txtAgeTo" min="0"
                                                                   value="{{isset($rData['AgeTo']) ? $rData['AgeTo'] : ''}}"
                                                                   name="txtAgeTo"
                                                                   onkeypress="return inputNumber(event);">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,'Trinh_do_hoc_van')}}</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="slEducationLevelID" name="slEducationLevelID"
                                                                    class="col-md-12 form-control">
                                                                <option value=""></option>
                                                                @foreach($education as $row)
                                                                    @define $ed = isset($rData['EducationLevelID']) ? $rData['EducationLevelID'] : ''
                                                                    @if ($ed==$row['EducationLevelID'])
                                                                        <option value="{{$row['EducationLevelID']}}"
                                                                                selected>{{$row['EducationLevelName']}}</option>
                                                                    @else
                                                                        <option value="{{$row['EducationLevelID']}}">{{$row['EducationLevelName']}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,'Trinh_do_chuyen_mon_U')}}</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select id="slProfessionalLesvelID"
                                                                    name="slProfessionalLevelID"
                                                                    class="col-md-12 form-control">
                                                                <option value=""></option>
                                                                @foreach($prolevel as $row)
                                                                    @define $pro = isset($rData['ProfessionalLevelID'])
                                                                    ? $rData['ProfessionalLevelID'] : ''
                                                                    <option value="{{$row['ProfessionalLevelID']}}" {{$pro==$row['ProfessionalLevelID']?"selected":""}}>{{$row['ProfessionalLevelName']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1 pdl0 pdr0">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,'Trinh_do_tin_hoc')}}</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" id="txtComputerSkills"
                                                   value="{{isset($rData['ComputerSkills']) ? $rData['ComputerSkills'] : ''}}"
                                                   name="txtComputerSkills">
                                        </div>
                                        <div class="col-md-2 pdl0 pdr0">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,'Trinh_do_ngoai_ngu')}}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="txtEnglishLevel"
                                                   value="{{isset($rData['EnglishLevel']) ? $rData['EnglishLevel'] : ''}}"
                                                   name="txtEnglishLevel">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1 pdl0 pdr0">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,'Ky_nang')}}</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" id="txtCapability"
                                                   value="{{isset($rData['Capability']) ? $rData['Capability'] : ''}}"
                                                   name="txtCapability">
                                        </div>
                                        <div class="col-md-2 pdl0 pdr0">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,'Ngoai_hinh')}}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="txtAppearence"
                                                   value="{{isset($rData['Appearence']) ? $rData['Appearence'] : ''}}"
                                                   name="txtAppearence">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1 pdl0 pdr0">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,'Tinh_cach')}}</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" id="txtPersonality"
                                                   value="{{isset($rData['Personality']) ? $rData['Personality'] : ''}}"
                                                   name="txtPersonality">
                                        </div>
                                        <div class="col-md-2 pdl0 pdr0">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,'Uu_tien')}}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="txtPriority" name="txtPriority"
                                                   value="{{isset($rData['Priority']) ? $rData['Priority'] : ''}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1 pdl0 pdr0">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,'Kinh_nghiem')}}</label>
                                        </div>
                                        <div class="col-md-11">
                                            <input type="text" class="form-control" id="txtExperienced"
                                                   value="{{isset($rData['Experienced']) ? $rData['Experienced'] : ''}}"
                                                   name="txtExperienced">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-1 pdl0 pdr0">
                                            <label class="liketext lbl-normal">{{Helpers::getRS($g,'Yeu_cau_khac')}}</label>
                                        </div>
                                        <div class="col-md-11">
                                            <textarea class="form-control" cols="2" rows="4" id="txtOtherRequest"
                                                      name="txtOtherRequest">{{isset($rData['OtherRequest']) ? $rData['OtherRequest'] : ''}}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </fieldset>
                            <div class="row">
                                <div class="col-md-2" style="width: 11.1111%;">
                                    <label class="liketext lbl-normal">{{Helpers::getRS($g,'Tom_tat_chuc_danh_can_tuyen')}}</label>
                                </div>
                                <div class="col-md-10" style="width: 88.8889%;">
                                    <textarea class="form-control" id="txtDescription" cols="2" rows="4"
                                              name="txtDescription">{{isset($rData['Description']) ? $rData['Description'] : ''}}</textarea>
                                </div>
                            </div>
                            <div class="row mgt5">
                                <div class="col-md-2" style="width: 11.1111%;">
                                    <label class="liketext lbl-normal">{{Helpers::getRS($g,'Ghi_chu')}}</label>
                                </div>
                                <div class="col-md-10" style="width: 88.8889%;">
                                    <textarea class="form-control" id="txtProNote" rows="12"
                                              name="txtProNote">{{isset($rData['ProNote']) ? $rData['ProNote'] : ''}}</textarea>
                                </div>
                            </div>
                            <div class="row mgt10">
                                <div class="col-md-2">
                                    <label class="lbl-normal">{{Helpers::getRS($g,'Ngay_lap')}}</label>
                                    <label class="mgl5">{{isset($rData['VoucherDate']) ? $rData['VoucherDate'] : date('d/m/Y')}}</label>
                                </div>
                                <div class="col-md-5">
                                    <label class="lbl-normal">{{Helpers::getRS($g,'Nguoi_lap')}}</label>
                                    <label class="">{{isset($rData['CreatorName']) ? $rData['CreatorName'] : Session::get("W91P0000")['CreatorNameHR']}}</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="box-footer" style="padding-right: 15px">
                    <button type="button" id="frm_btnCancel" class="btn btn-default smallbtn pull-right">
                        <span class="glyphicon glyphicon-floppy-remove mgr5"></span> {{Helpers::getRS($g,"Khong_luu")}}
                    </button>
                    <button type="submit" id="frm_btnSave"
                            class="btn btn-default smallbtn pull-right mgr10"><span
                                class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                    </button>
                    @if ($statusid == 0)
                        <div class="checkbox pull-right mgr10">
                            <label hidden>
                                <input type="checkbox" id="chkStatusVoucher"
                                       name="chkStatusVoucher" {{isset($rData['StatusVoucher'])?($rData["StatusVoucher"]==0?"checked":""):""}}> {{Helpers::getRS($g,"Hoan_tat_de_xuat")}}
                            </label>
                        </div>
                    @else
                    <!-- label class="pull-right mgr10 liketext">{{$rData["ApprovedStatusName"]}}</label -->
                    @endif
                    @if ($action=="view" && $statusid<=1)
                        @if(Session::get($pForm)>2)
                            <button type="button" id="frm_btnedit" class="btn btn-default smallbtn pull-left mgr10 ">
                                <span class="glyphicon glyphicon-edit mgr5"></span> {{Helpers::getRS($g,"Sua")}}
                            </button>
                            @if(Session::get($pForm) >3)
                                <button type="button" id="frm_btnDelete" class="btn btn-default smallbtn pull-left ">
                                    <span class="glyphicon glyphicon-remove mgr5"></span> {{Helpers::getRS($g,"Xoa")}}
                                </button>
                            @endif
                        @endif
                    @endif
                </div>
                <div class="modal-footer">
                    <div class="alert alert-success alert-dismissable hide">
                        <i class="icon fa fa-check"></i> {{Helpers::getRS($g,"Du_lieu_da_luu_thanh_cong")}}!
                    </div>
                    <div class="alert alert-danger alert-dismissable hide">
                        <i class="icon fa fa-ban"></i> <span id="err">{{Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu")}}
                            !</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="newmailPOP">

</div>
<script>
    var currentObject;
    var plansID = "";
    @if (isset($rData))
        currentObject ={{json_encode($rData)}};
    @endif
    //console.log(currentObject.PlanTransID);
    $('#txtDate').daterangepicker({format: 'DD/MM/YYYY'});
    //$('.dateClass').daterangepicker({format: 'DD/MM/YYYY',orientation:'left'});

    $(".dateClass").on("click", function () {
        $('#txtDate').trigger('click');
    });


    $('.input-group.date').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: "dd/mm/yyyy",
        language: 'vi'
    });

    //nút đính kèm
    $("#btnFileW25F2010").click(function () {
        //alert("anh bao");
        loadW09F4010();
    });

    function loadW09F4010() {
        showFormDialogPost('{{url("/W09F4010/$pForm/$g")}}', "modalW09F4010",
            {
                formCall: "W25F2010",
                keyID: $("#slRecpositionID").val(),
                tableName: 'D09T0211'
            }, 2);
    }

    function ask_delete_callback() {
        $.ajax({
            method: "POST",
            url: "{{url("W25F2010/".$pForm."/action/delete")}}",
            data: {trans: '{{isset($rData) ? $rData['TransID']:""}}'},
            success: function (data) {
                if (data == 1) {
                    update4ParamGrid($(document).find("#pqgrid_W25F2000"), null, 'delete');
                    $("#modalW25F2010").modal('hide');
                }
                else {
                    $("#frmW25F2010").find("#err").html('{{Helpers::getRS($g,'Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu')}}');
                    $("#frmW25F2010").find(".alert-danger").removeClass('hide');
                }
            }
        });
    }

    function ask_save_callback() {
        NormalMode();
        @if($action=="view")  // n?u là edit
        setFormValue();
        @endif
    }

    function pro_number_focus() {
        $("#txtProNumber").focus();
        return;
    }

    function age_from_focus() {
        $("#txtAgeFrom").focus();
        return;
    }

    function sal_from_focus() {
        $("#txtSalaryFrom").focus();
        return;
    }

    $(document).ready(function () {
        $("#divScrollbarW25F2010").height($(document).height() - 130);



        setTimeout(function(){
            $("#divScrollbarW25F2010").css('overflow-y', 'auto');
            /*$("#divScrollbarW25F2010").mCustomScrollbar(
                {
                    axis: "y",
                    scrollButtons: {enable: true},
                    theme: "minimal-dark",
                    scrollbarPosition: "outside",
                    scrollInertia: 50
                });
*/
        }, 500);
        //$().val();
        @if($action !="add")
        NormalMode();
        @endif
        $("#slDepartmentID").val('{{$departmentID}}');
        @if($action=="view") // sửa
        statusW25F2000 = 2;
        //alert(currentObject.PlanTransID);
        plansID = currentObject.PlanTransID;
        $("#slPlanTransID").prop('disabled', true);
        if (currentObject.PlanTransID != "chooseAgain" && currentObject.PlanTransID != "") {
            $("#slRecpositionID").attr('disabled', true);
            $("#slTeamID").attr('disabled', true);
            $("#slWorkID").attr('disabled', true);
            $("#slDepartmentID").attr('disabled', true);
            $("#slDepartmentID").val(currentObject.DepartmentID);
        }
        if (currentObject.PlanTransID == "chooseAgain" || currentObject.PlanTransID == "") {
            $("#slRecpositionID").attr('disabled', false);
            $("#slTeamID").attr('disabled', false);
            $("#slWorkID").attr('disabled', false);
            $("#slDepartmentID").attr('disabled', false);
            $("#slDepartmentID").val(currentObject.DepartmentID);
        }
        @else
            statusW25F2000 = 1;//Thêm mới
        @endif
        //=======================================================
        $("#frmW25F2010").find("#slPlanTransID").change(function () {
            console.log($("#slPlanTransID").val());
            if ($("#slPlanTransID").val() == "chooseAgain" || $("#slPlanTransID").val() == "") {
                //$("#slRecpositionID").attr('disabled',false);
                $("#slTeamID").attr('disabled', false);
                $("#slWorkID").attr('disabled', false);
                $("#slDepartmentID").attr('disabled', false);
                $("#slTeamID").val("");
                $("#slRecpositionID").val("");
                $("#slRecpositionID").trigger('change');
                $("#slWorkingStatusID").val("");
                $("#slWorkID").val("");
                $("#txtProNumber").val("");
                $("#txtMaleQuan").val("");
                $("#txtFemaleQuan").val("");
                $("#txtDate").val("");
                $("#txtDateJoined").val("");
                $("#txtReasonRequest").val("");
                $("#txtAgeFrom").val("");
                $("#txtAgeTo").val("");
                $("#slEducationLevelID").val("");
                $("#slProfessionalLevelID").val("");
                $("#txtComputerSkills").val("");
                $("#txtEnglishLevel").val("");
                $("#txtCapability").val("");
                $("#txtAppearence").val("");
                $("#txtPersonality").val("");
                $("#txtPriority").val("");
                $("#txtExperienced").val("");
                $("#txtOtherRequest").val("");
                $("#txtDescription").html("");
                $("#txtProNote").val("");
                $("#txtSalaryFrom").val("");
                $("#txtSalaryTo").val("");
                $("#txtDescription").val("");
                $("#slCurrencyID").val("");
            }
            if ($("#slPlanTransID").val() != "chooseAgain" && $("#slPlanTransID").val() != "") {
                $.ajax({
                    method: "POST",
                    url: '{{url("/W25F2010/".$pForm."/action/2")}}',
                    data: {
                        plan: $("#slPlanTransID").val()
                    },
                    success: function (data) {
                        $("#slRecpositionID").html(data.recPos);
                    }
                });
            }
        });
        //=======================================================
        $("#frmW25F2010").find("#slRecpositionID").change(function () {
            //console.log("da chay pos");
            $.ajax({
                method: "POST",
                url: '{{url("/W25F2010/".$pForm."/action/1")}}',
                data: {
                    recPos: $("#slRecpositionID").val(),
                    plan: $("#slPlanTransID").val()
                },
                success: function (data) {
                    console.log(data);
                    var arr = data[0];
                    if (arr.length == 0) {
                        $("#txtAgeFrom").val("");
                        $("#txtAgeTo").val("");
                        $("#slEducationLevelID").val("");
                        $("#slProfessionalLesvelID").val("");
                        $("#txtComputerSkills").val("");
                        $("#txtEnglishLevel").val("");
                        $("#txtAppearence").val("");
                        $("#txtOtherRequest").val("");
                        $("#txtSalaryFrom").val("");
                        $("#txtSalaryTo").val("");
                        $("#txtProNote").val("");
                        $("#txtExperienced").val("");
                        $("#txtDescription").val("");
                        $("#txtCapability").val("");
                        $("#txtPersonality").val("");
                        $("#txtPriority").val("");
                    }
                    if (arr.length != 0) {
                        $("#txtAgeFrom").val(arr[0].AgeFrom);
                        $("#txtAgeTo").val(arr[0].AgeTo);
                        $("#slEducationLevelID").val(arr[0].EducationLevelID);
                        $("#slProfessionalLesvelID").val(arr[0].ProfessionalLevelID);
                        $("#txtComputerSkills").val(arr[0].ComputerSkills);
                        $("#txtEnglishLevel").val(arr[0].EnglishLevel);
                        $("#txtAppearence").val(arr[0].Appearence);
                        $("#txtOtherRequest").val(arr[0].OtherRequest);
                        $("#txtSalaryFrom").val(Number(arr[0].SalaryFrom));
                        $("#txtSalaryTo").val(Number(arr[0].SalaryTo));
                        $("#txtProNote").val(arr[0].ProNote);
                        $("#txtExperienced").val(arr[0].Experienced);
                        $("#txtDescription").val(arr[0].Description);
                        $("#slCurrencyID").val(arr[0].CurrencyID);
                        $("#txtCapability").val(arr[0].Capability);
                        $("#txtPersonality").val(arr[0].Personality);
                        $("#txtPriority").val(arr[0].Priority);
                    }
                    if (data.formValue.length > 0) {
                        console.log(data);
                        var value = data.formValue;
                        plansID = data.plansID;
                        console.log(value, data.plansID);
                        $("#slDepartmentID").val(value[0].DepartmentID).attr('disabled', true);
                        //$("#slDepartmentID").trigger('change');
                        /*$("#slRecpositionID").val(value[0].RecPositionID).attr('disabled',false);
                        $("#slRecpositionID").trigger('change');*/
                        $("#slTeamID").val(value[0].TeamID).attr('disabled', true);
                        $("#slWorkID").val(value[0].WorkID).attr('disabled', true);
                        $('#txtDate').data('daterangepicker').setStartDate(value[0].DateFrom);
                        $('#txtDate').data('daterangepicker').setEndDate(value[0].DateTo);
                        $('#txtProNumber').val(value[0].ProNumber);
                    }
                    $("#buttonFileW25F2010").html(data[1]);
                }
            });
        });
        //=======================================================
        $("#frmW25F2010").find("#slDepartmentID").change(function () {
            $.ajax({
                method: "POST",
                url: '{{url("/W25F2010/".$pForm."/action/0")}}',
                data: {dep: $("#slDepartmentID").val()},
                success: function (data) {
                    //console.log(data);
                    $("#slTeamID").html(data.teams);
                    $("#slTeamID").val('{{isset($rData['TeamID']) ? $rData['TeamID'] : ''}}');
                    //console.log($("#slTeamID").val('{{isset($rData['TeamID']) ? $rData['TeamID'] : ''}}'));
                    $("#slPlanTransID").html(data.plans);
                    $("#slPlanTransID").val(plansID);
                }
            });
        });
        $("#slDepartmentID").val($("#slDepartmentID").val()).trigger('change');
        //=======================================================
        $("#frmW25F2010").on('click', '#frm_btnedit', function () {
            ActionMode();
        });

        $("#frmW25F2010").on('click', '#frm_btnDelete', function () {
            ask_delete(ask_delete_callback);
        });
        //=======================================================
        $("#frmW25F2010").on('click', '#frm_btnCancel', function () {
            ask_not_save(ask_save_callback);
        });

        $("#modalW25F2010").on('submit', '#frmW25F2010', function (e) {
            e.preventDefault();
            var qmale = 0;
            if ($("#txtMaleQuan").val() != "")
                qmale = Number($("#txtMaleQuan").val());
            var qfemale = 0;
            if ($("#txtFemaleQuan").val() != "")
                qfemale = Number($("#txtFemaleQuan").val());
            var pro = Number($("#txtProNumber").val());
            if (pro < (qmale + qfemale) || pro == 0) {
                alert_warning("{{Helpers::getRS($g,"So_luong_khong_hop_le")}}", pro_number_focus());
                return false;
            }
            //Kiểm tra tuổi từ đến
            var agef = parseInt($("#txtAgeFrom").val());
            var aget = parseInt($("#txtAgeTo").val());
            if (agef > aget) {
                alert_warning("{{Helpers::getRS($g,"Do_tuoi_khong_hop_le")}}", age_from_focus());
                return false;
            }

            //Kiểm tra mức lương
            var salF = Number($("#txtSalaryFrom").val());
            var salT = Number($("#txtSalaryTo").val());
            if (salF > salT) {
                alert_warning("{{Helpers::getRS($g,"Muc_luong_khong_hop_le")}}", sal_from_focus());
                return false;
            }
            //====Save data==========================================================
            $("#frmW25F2010").find("#frm_btnCancel").prop('disabled', true);
            $("#frmW25F2010").find("#frm_btnSave").prop('disabled', true);
            var datef = $('#txtDate').data('daterangepicker').startDate.format('MM/DD/YYYY');
            var datet = $('#txtDate').data('daterangepicker').endDate.format('MM/DD/YYYY');
            //console.log(datef, datet);
            $.ajax({
                method: "POST",
                url: "{{url("W25F2010/".$pForm."/action/$action")}}",
                data: $("#frmW25F2010").serialize() + '&optRecruitmentType=' + $("#optRecruitmentType1").is(":checked") + "&datefrom=" + datef + "&dateto=" + datet + "&slDepartmentID="
                + $("#slDepartmentID").val() + "&slTeamID=" + $("#slTeamID").val() + "&slRecpositionID=" + $("#slRecpositionID").val() + "&slWorkID=" + $("#slWorkID").val() + "&slPlanTransID=" + $("#slPlanTransID").val(),
                success: function (data) {
                    result = $.parseJSON(data);
                    console.log(data);
                    if (result.rs == 0) {
                        save_not_ok(function () {
                        }, '', '{{Helpers::getRS($g,'Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu')}}');
                    }
                    else {
                        save_ok(function () {
                            sKeyW25F2000 = result.key;
                            //$("#frmW25F2010").find(".alert-success").removeClass('hide');
                            //$("#frmW25F2010").find(".alert-danger").addClass('hide');
                            if (result.rs == 2) {
                                $("#newmailPOP").html(result.rsvalue);
                                showsendmail();
                            }
                            @if($action=="view") // sửa
                            //$("#frmW25F2010").find(".alert-success").removeClass('hide');
                            currentObject = result;
                            setFormValue();
                            @endif
                            NormalMode();
                        });

                    }
                }
            });
        });
    });

    function setFormValue() {
        console.log(currentObject);
        $("input[name=optRecruitmentType][value=" + currentObject.RecruitmentType + "]").checked = true;
        $("#slDepartmentID").val(currentObject.DepartmentID);
        $("#slTeamID").val(currentObject.TeamID);
        $("#slRecpositionID").val(currentObject.RecPositionID);
        $("#slWorkingStatusID").val(currentObject.WorkingStatusID);
        $("#slWorkID").val(currentObject.WorkID);
        $("#txtProNumber").val(currentObject.ProNumber);
        $("#txtMaleQuan").val(currentObject.MaleQuan);
        $("#txtFemaleQuan").val(currentObject.FemaleQuan);
        $("#txtDate").val(currentObject.DateFrom + " - " + currentObject.DateTo);
        $("#txtDateJoined").val(currentObject.DateJoined);
        $("#txtReasonRequest").val(currentObject.ReasonRequest);
        $("#txtAgeFrom").val(currentObject.AgeFrom);
        $("#txtAgeTo").val(currentObject.AgeTo);
        $("#slEducationLevelID").val(currentObject.EducationLevelID);
        $("#slProfessionalLevelID").val(currentObject.ProfessionalLevelID);
        $("#txtComputerSkills").val(currentObject.ComputerSkills);
        $("#txtEnglishLevel").val(currentObject.EnglishLevel);
        $("#txtCapability").val(currentObject.Capability);
        $("#txtAppearence").val(currentObject.Appearence);
        $("#txtPersonality").val(currentObject.Personality);
        $("#txtPriority").val(currentObject.Priority);
        $("#txtExperienced").val(currentObject.Experienced);
        $("#txtOtherRequest").val(currentObject.OtherRequest);
        $("#txtDescription").html(currentObject.Description);
        $("#txtProNote").val(currentObject.ProNote);
        $("#txtSalaryFrom").val(Number(currentObject.SalaryFrom));
        $("#txtSalaryTo").val(Number(currentObject.SalaryTo));
    }

    function ActionMode() {
        $("#frmW25F2010").find("#frm_btnedit").prop('disabled', true);
        @if(Session::get($pForm)>3)
        $("#frmW25F2010").find("#frm_btnDelete").prop('disabled', true);
        @endif
        $("#frmW25F2010").find("#frm_btnCancel").prop('disabled', false);
        $("#frmW25F2010").find("#frm_btnSave").prop('disabled', false);
        $("#frmW25F2010").find(".alert-success").addClass('hide');
        $("#frmW25F2010").find(".alert-success").addClass('hide');
    }

    function NormalMode() {
        $("#frmW25F2010").find("#frm_btnedit").prop('disabled', false);
        @if(Session::get($pForm)>3)
        $("#frmW25F2010").find("#frm_btnDelete").prop('disabled', false);
        @endif
        $("#frmW25F2010").find("#frm_btnCancel").prop('disabled', true);
        $("#frmW25F2010").find("#frm_btnSave").prop('disabled', true);
    }

    var showsendmail = function () {
        $("#newmailPOP").find("#mPopUpSendMail").modal('show');
    };

    function closePopW25F2010() {
        $("#modalW25F2010").modal("hide");
        ReloadDataW25F2000();
    }

    /*Set form height for textarea Note*/
    //var heightText = parseInt(($("#modalW25F2010").find("div.modal-content").height() - 600));
    //$("#txtProNote").css("height", heightText);
</script>
