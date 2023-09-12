<style>

</style>
<div class="modal fade" id="modalW09F1101" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($titleW09F1101,"W09F1101",true,"funcLoseModalW09F1101")}}
            </div>
            <div class="modal-body">
                <?php
                if ($Action == 'view' || $Action == 'edit') {
                    $DutyID = $Group_DutyName['DutyID'];
                    $DutyDisplayOrder = $Group_DutyName['DutyDisplayOrder'];
                    $DutyName = $Group_DutyName['DutyName'];
                    $DutyName01 = $Group_DutyName['DutyName01'];
                    $Disabled = $Group_DutyName['Disabled'];
                    $IsManager = $Group_DutyName['IsManager'];
                    \Debugbar::info($Group_DutyName);
                    $IsMaxDutyManager = $Group_DutyName['IsMaxDutyManager'];
                    \Debugbar::info('$IsMaxDutyManager', $IsMaxDutyManager);
                    $CheckIsMaxDutyManager = $CheckIsMaxDutyManager;
                    $Description = $Group_DutyName['Description'];
                    $OrgChartID = $Group_DutyName['OrgChartID'];
                    $DutyManagerID = $Group_DutyName['DutyManagerID'];
                    \Debugbar::info('vinh test duty', $DutyManagerID);
                    $DutyGroupID = $Group_DutyName['DutyGroupID'];
                    $SexName = $Group_Recruitment['Sex'];
                    $FromAge = $Group_Recruitment['FromAge'];
                    $ToAge = $Group_Recruitment['ToAge'];
                    $FromWeight = $Group_Recruitment['FromWeight'];
                    $ToWeight = $Group_Recruitment['ToWeight'];
                    $FromHeight = $Group_Recruitment['FromHeight'];
                    $ToHeight = $Group_Recruitment['ToHeight'];
                    $Health = $Group_Recruitment['Health'];
                    $Appearance = $Group_Recruitment['Appearance'];
                    $MaritalStatus = $Group_Recruitment['MaritalStatusID'];
                    $Population = $Group_Recruitment['PopulationID'];
                    $Religion = $Group_Recruitment['ReligionID'];
                    $Nationlity = $Group_Recruitment['NationalityID'];
                    $EducationLevel = $Group_Recruitment['EducationLevelID'];
                    $ProfessionalLevel = $Group_Recruitment['ProfessionalLevelID'];
                    $LanguageLevel = $Group_Recruitment['LanguageLevelID'];
                    $ComputingLevel = $Group_Recruitment['ComputingLevelID'];
                    $OtherTransaction = $Group_Recruitment['Experience'];
                    $Experience = $Group_Recruitment['Experience'];
                    $SalaryFrom = $Group_Recruitment['SalaryFrom'];
                    $SalaryTo = $Group_Recruitment['SalaryTo'];
                    $Currency = $Group_Recruitment['CurrencyID'];
                    $OtherRequirement = $Group_Recruitment['OtherRequirement'];
                    $JobDescription = $Group_Recruitment['JobDescription'];
                    $Note = $Group_Recruitment['Note'];
                    $Coefficient1 = $Group_Coefficient['Coefficient01'];
                    $Coefficient2 = $Group_Coefficient['Coefficient02'];
                    $Coefficient3 = $Group_Coefficient['Coefficient03'];
                    $Coefficient4 = $Group_Coefficient['Coefficient04'];
                    $Coefficient5 = $Group_Coefficient['Coefficient05'];
                    $Coefficient6 = $Group_Coefficient['Coefficient06'];
                    $Coefficient7 = $Group_Coefficient['Coefficient07'];
                    $Coefficient8 = $Group_Coefficient['Coefficient08'];
                    $Coefficient9 = $Group_Coefficient['Coefficient09'];
                    $Coefficient10 = $Group_Coefficient['Coefficient10'];
                    $Coefficient11 = $Group_Coefficient['Coefficient11'];
                    $Coefficient12 = $Group_Coefficient['Coefficient12'];
                    $Coefficient13 = $Group_Coefficient['Coefficient13'];
                    $Coefficient14 = $Group_Coefficient['Coefficient14'];
                    $Coefficient15 = $Group_Coefficient['Coefficient15'];
                    $Coefficient16 = $Group_Coefficient['Coefficient16'];
                    $Coefficient17 = $Group_Coefficient['Coefficient17'];
                    $Coefficient18 = $Group_Coefficient['Coefficient18'];
                    $Coefficient19 = $Group_Coefficient['Coefficient19'];
                    $Coefficient20 = $Group_Coefficient['Coefficient20'];
                    $Coefficient21 = $Group_Coefficient['Coefficient21'];
                    $Coefficient22 = $Group_Coefficient['Coefficient22'];
                    $Coefficient23 = $Group_Coefficient['Coefficient23'];
                    $Coefficient24 = $Group_Coefficient['Coefficient24'];
                    $Coefficient25 = $Group_Coefficient['Coefficient25'];
                    $Coefficient26 = $Group_Coefficient['Coefficient26'];
                    $Coefficient27 = $Group_Coefficient['Coefficient27'];
                    $Coefficient28 = $Group_Coefficient['Coefficient28'];
                    $Coefficient29 = $Group_Coefficient['Coefficient29'];
                    $Coefficient30 = $Group_Coefficient['Coefficient30'];


                } else if ($Action == 'add') {
                    $DutyID = '';
                    $DutyDisplayOrder = '';
                    $DutyName = '';
                    $DutyName01 = '';
                    $Disabled = 0;
                    $IsManager = 0;
                    $CheckIsMaxDutyManager = $CheckIsMaxDutyManager;
                    $IsMaxDutyManager = 0;
                    $Description = '';
                    $OrgChartID = '';
                    $DutyManagerID = '';
                    $DutyGroupID = '';

                    $SexName = '';
                    $FromAge = '';
                    $ToAge = '';
                    $FromWeight = '';
                    $ToWeight = '';
                    $FromHeight = '';
                    $ToHeight = '';
                    $Health = '';
                    $Appearance = '';
                    $MaritalStatus = '';
                    $Population = '';
                    $Religion = '';
                    $Nationlity = '';
                    $EducationLevel = '';
                    $ProfessionalLevel = '';
                    $LanguageLevel = '';
                    $ComputingLevel = '';
                    $OtherTransaction = '';
                    $Experience = '';
                    $SalaryFrom = '';
                    $SalaryTo = '';
                    $Currency = '';
                    $OtherRequirement = '';
                    $JobDescription = '';
                    $Note = '';
                    $Coefficient1 = '';
                    $Coefficient2 = '';
                    $Coefficient3 = '';
                    $Coefficient4 = '';
                    $Coefficient5 = '';
                    $Coefficient6 = '';
                    $Coefficient7 = '';
                    $Coefficient8 = '';
                    $Coefficient9 = '';
                    $Coefficient10 = '';
                    $Coefficient11 = '';
                    $Coefficient12 = '';
                    $Coefficient13 = '';
                    $Coefficient14 = '';
                    $Coefficient15 = '';
                    $Coefficient16 = '';
                    $Coefficient17 = '';
                    $Coefficient18 = '';
                    $Coefficient19 = '';
                    $Coefficient20 = '';
                    $Coefficient21 = '';
                    $Coefficient22 = '';
                    $Coefficient23 = '';
                    $Coefficient24 = '';
                    $Coefficient25 = '';
                    $Coefficient26 = '';
                    $Coefficient27 = '';
                    $Coefficient28 = '';
                    $Coefficient29 = '';
                    $Coefficient30 = '';
                }




                ?>
                <div id="divContentW09F1101" class="">
                    <form id="FrmW09F1101" name="FrmW09F1101">
                        <div class="panel-group" id="accordion1" style = 'margin-bottom: 5px;'>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapseInfo">
                                            {{Helpers::getRS($g,'Thong_tin_chuc_danh_cong_viec')}}</a>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseInfo" class="panel-collapse collapse in pd10">
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">
                                            {{Helpers::getRS($g,'Ma_chuc_danh_cong_viec')}}
                                        </label>
                                        <div class="col-sm-4">
                                            <input style="text-transform: uppercase;" required id='txtDutyIDW09F1101'
                                                   name="txtDutyIDW09F1101" value="{{$DutyID}}" class="form-control">
                                            <span id="errorDuty1IDW09F1101"
                                                  class="hide text-red">{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}</span>
                                            <span id="errorDuty2IDW09F1101"
                                                  class="hide text-red">{{Helpers::getRS($g,"Ma_co_ky_tu_khong_hop_le")}}</span>

                                        </div>
                                        <label class="control-label col-sm-2">
                                            {{Helpers::getRS($g,'Thu_tu_hien_thi')}}
                                        </label>
                                        <div class="col-sm-4">
                                            <div class='row '>
                                                <div class="col-sm-5">
                                                    <input name='txtDutyDisplayOrderW09F1101'
                                                           id='txtDutyDisplayOrderW09F1101'
                                                           value="{{$DutyDisplayOrder}}" class="form-control">
                                                </div>
                                                <div class="col-sm-2">
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="checkbox" style="margin:0;">
                                                        <label> <input type="checkbox" value="1"
                                                                       id="txtDisabledW09F1101"
                                                                       {{$Disabled==1?'checked':''}}  name="txtDisabledW09F1101"> {{Helpers::getRS($g,'Khong_su_dung')}}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">
                                            {{Helpers::getRS($g,'Ten_tieng_Viet')}}
                                        </label>
                                        <div class="col-sm-4">
                                            <input required id='txtDutyNameW09F1101' value="{{$DutyName}}"
                                                   name='txtDutyNameW09F1101' class="form-control">
                                            <span id="errorDutyNameW09F1101"
                                                  class="hide text-red">{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}</span>

                                        </div>
                                        <label class="control-label col-sm-2">
                                            {{Helpers::getRS($g,'Ten_tieng_Anh')}}
                                        </label>
                                        <div class="col-sm-4">
                                            <input id='txtDutyName01W09F1101' name='txtDutyName01W09F1101'
                                                   value="{{$DutyName01}}" class="form-control">

                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">
                                            {{Helpers::getRS($g,'Co_cau_to_chuc')}}
                                        </label>
                                        <div class="col-sm-4">
                                            <div id="cboOrgChartW09F1101" style="height: 26px"></div>
                                        </div>
                                        <label class="control-label col-sm-2">
                                            {{Helpers::getRS($g,'Chuc_danh_quan_ly')}}
                                        </label>
                                        <div class="col-sm-4">
                                            <select class = 'form-control select2' style='width: 100%;' id="cboDutyManagerW09F1101"
                                                    name="cboDutyManagerW09F1101">
                                                <option value=""></option>

                                                @foreach($cbo_DutyManagername as $item)
                                                    <option {{$item['DutyManagerID']==$DutyManagerID?'selected':''}} value="{{$item['DutyManagerID']}}">{{$item['DutyManagerName']}}</option>
                                                @endforeach
                                            </select>
                                            <span id="errorDutyManagerW09F1101"
                                                  class="hide text-red">{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}</span>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">
                                            {{Helpers::getRS($g,'Nhom_chuc_danh_cong_viec')}}
                                        </label>
                                        <div class="col-sm-4">
                                            <select class = 'form-control select2 normal' style='width: 100%;' id="cboDutyGroupW09F1101"
                                                    name="cboDutyGroupW09F1101">
                                                <option value=""></option>

                                                @foreach($cbo_DutyGroupName as $item)
                                                    <option {{$item['DutyGroupID']==$DutyGroupID?'selected':''}} value="{{$item['DutyGroupID']}}">{{$item['DutyGroupName']}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="row ">
                                                <div class="col-sm-3">
                                                    <div class="radio" style="margin:0;">
                                                        <label><input id="txtIsManagerW09F1101"
                                                                      {{$IsManager==0?'checked':''}} type="radio"
                                                                      name="txtIsManagerW09F1101"
                                                                      value="0">{{Helpers::getRS($g,'Nhan_vien')}}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="radio" style="margin:0;">
                                                        <label> <input id="txtIsManagerW09F1101"
                                                                       {{$IsManager==1?'checked':''}} type="radio"
                                                                       name="txtIsManagerW09F1101"
                                                                       value="1">{{Helpers::getRS($g,'Quan_ly')}}
                                                        </label>
                                                    </div>
                                                </div>
                                                @if($Action!='add')
                                                    <div class="col-sm-5 {{!isset($CheckIsMaxDutyManager) || ($CheckIsMaxDutyManager == 1 && $IsMaxDutyManager ==1)?'':'hide'}} ">
                                                        <div class="checkbox" style="margin:0;">
                                                            <label> <input type="checkbox" id="txtIsMaxDutyManagerW09F1101"
                                                                           name="txtIsMaxDutyManagerW09F1101"
                                                                           {{$IsMaxDutyManager==1?'checked':''}} value="1"> {{Helpers::getRS($g,'Chuc_danh_quan_ly_cao_nhat')}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @elseif($Action=='add')

                                                    <div class="col-sm-5 {{!isset($CheckIsMaxDutyManager)?'':'hide'}} ">
                                                        <div class="checkbox" style="margin:0;">
                                                            <label> <input type="checkbox" id="txtIsMaxDutyManagerW09F1101"
                                                                           name="txtIsMaxDutyManagerW09F1101"
                                                                           value="1"> {{Helpers::getRS($g,'Chuc_danh_quan_ly_cao_nhat')}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="control-label col-sm-2">{{Helpers::getRS($g,'Dien_giai')}}</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" rows="5" id="txtDescriptionW09F1101"
                                                      name="txtDescriptionW09F1101">{{$Description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                            {{Helpers::getRS($g,'Thong_tin_tuyen_dung')}}</a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse in pd10">
                                    <div class="row form-group">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="nav-tabs-custom">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#tab_2_1" data-toggle="tab">{{Helpers::getRS($g,'Yeu_cau_chung')}}</a></li>
                                                    <li><a href="#tab_2_2" data-toggle="tab">{{Helpers::getRS($g,"Yeu_cau_cong_viec")}}</a></li>
                                                    <li><a href="#tab_2_3" data-toggle="tab">{{Helpers::getRS($g,"Mo_ta_cong_viec")}}</a></li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab_2_1">
                                                        <div class="row form-group " style="height:0px;">
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Gioi_tinh')}}
                                                            </label>
                                                            <div class='col-sm-4'>
                                                                <div class="row form-group">

                                                                    <div class="col-sm-3 pdr0">
                                                                        <select id="txtSexNameW09F1101"
                                                                                name='txtSexNameW09F1101'
                                                                                class="form-control">
                                                                            @foreach($cbGender as $item)
                                                                                <option {{$item['Sex']==$SexName?'selected':''}} value="{{$item['Sex']}}">{{$item['SexName']}}</option>
                                                                            @endforeach

                                                                        </select>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class='col-sm-2'>

                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="row form-group">
                                                                    <label style="" class="control-label col-sm-3">
                                                                        {{Helpers::getRS($g,'Tuoi')}}
                                                                    </label>
                                                                    <div class="col-sm-3 pdr0">
                                                                        <input id='txtFromAgeW09F1101' name='txtFromAgeW09F1101'
                                                                               value="{{$FromAge}}"
                                                                               class="form-control">
                                                                    </div>
                                                                    <div class="col-sm-1">-</div>

                                                                    <div class="col-sm-3 pdl0">
                                                                        <input id='txtToAgeW09F1101' name='txtToAgeW09F1101'
                                                                               value="{{$ToAge}}"
                                                                               class="form-control">

                                                                    </div>
                                                                    <label class="control-label col-sm-2">
                                                                        {{Helpers::getRS($g,'(tuoi)')}}
                                                                    </label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row form-group" style="height:0px;">
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Chieu_cao')}}
                                                            </label>
                                                            <div class='col-sm-4'>
                                                                <div class="row form-group">

                                                                    <div class="col-sm-3 pdr0">
                                                                        <input id="txtFromHeightW09F1101" name="txtFromHeightW09F1101"
                                                                               value="{{$FromHeight}}"
                                                                               class="form-control">
                                                                    </div>
                                                                    <div class="col-sm-1">-</div>

                                                                    <div class="col-sm-3 pdl0">
                                                                        <input id="txtToHeightW09F1101" name="txtToHeightW09F1101"
                                                                               value="{{$ToHeight}}"
                                                                               class="form-control">

                                                                    </div>
                                                                    <label class="control-label col-sm-2">
                                                                        (mét)
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class='col-sm-2'>

                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="row form-group">
                                                                    <label style='' class="control-label col-sm-3">
                                                                        {{Helpers::getRS($g,'Can_nang')}}
                                                                    </label>
                                                                    <div class="col-sm-3 pdr0">
                                                                        <input id='txtFromWeightW09F1101' name='txtFromWeightW09F1101'
                                                                               value="{{$FromWeight}}"
                                                                               class="form-control">
                                                                    </div>
                                                                    <div class="col-sm-1">-</div>

                                                                    <div class="col-sm-3 pdl0">
                                                                        <input id='txtToWeightW09F1101' name='txtToWeightW09F1101'
                                                                               value="{{$ToWeight}}"
                                                                               class="form-control">

                                                                    </div>
                                                                    <label class="control-label col-sm-2">
                                                                        (kg)
                                                                    </label>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="row form-group">
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Suc_khoe')}}
                                                            </label>
                                                            <div class="col-sm-4">
                                                                <input id="txtHealthW09F1101" name="txtHealthW09F1101"
                                                                       value="{{$Health}}"
                                                                       class="form-control">

                                                            </div>
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Ngoai_hinh')}}
                                                            </label>
                                                            <div class="col-sm-4">
                                                                <input id="txtAppearanceW09F1101" name="txtAppearanceW09F1101"
                                                                       value="{{$Appearance}}"
                                                                       class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="row form-group">
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Tinh_trang_hon_nhan')}}
                                                            </label>
                                                            <div class="col-sm-4">
                                                                <select id="cboMaritalStatusW09F1101" name="cboMaritalStatusW09F1101"
                                                                        class="form-control">
                                                                    <option value=""></option>

                                                                    @foreach( $cbo_MaritalStatus as $item)
                                                                        <option {{$item['MaritalStatusID']==$MaritalStatus?'selected':''}} value="{{$item['MaritalStatusID']}}">{{$item['MaritalStatusName']}}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Ho_khau')}}
                                                            </label>
                                                            <div class="col-sm-4">
                                                                <select id="cboPopulationW09F1101" name="cboPopulationW09F1101"
                                                                        class="form-control select2 normal">
                                                                    <option value=""></option>
                                                                    @foreach($cbo_Population as $item)
                                                                        <option {{$item['Code']==$Population?'selected':''}} value="{{$item['Code']}}">{{$item['Name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row form-group">
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Ton_giao')}}
                                                            </label>
                                                            <div class="col-sm-4">
                                                                <select id='cboReligionW09F1101' name='cboReligionW09F1101'
                                                                        class="form-control select2 normal">
                                                                    <option value=""></option>
                                                                    @foreach($cbo_Religion as $item)
                                                                        <option {{$item['ReligionID']==$Religion?'selected':''}} value="{{$item['ReligionID']}}">{{$item['ReligionName']}}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Quoc_tich')}}
                                                            </label>
                                                            <div class="col-sm-4">
                                                                <select id="cboNationalityW09F1101" name='cboNationalityW09F1101'
                                                                        class="form-control select2 normal">
                                                                    <option value=""></option>

                                                                    @foreach($cbo_Nationality  as $item)
                                                                        <option {{$item['NationalityID']==$Nationlity?'selected':''}} value="{{$item['NationalityID']}}">{{$item['NationalityName']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab_2_2">
                                                        <div class="row form-group">
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Trinh_do_van_hoaU')}}
                                                            </label>
                                                            <div class="col-sm-4">
                                                                <select id="txtEducationLevelW09F1101"
                                                                        name='txtEducationLevelW09F1101'
                                                                        class="form-control select2 normal">
                                                                    <option value=""></option>

                                                                    @foreach($cbEducation  as $item)
                                                                        <option {{$item['EducationLevelID']==$EducationLevel?'selected':''}} value="{{$item['EducationLevelID']}}">{{$item['EducationLevelName']}}</option>
                                                                    @endforeach
                                                                </select>


                                                            </div>
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Trinh_do_chuyen_mon_U')}}
                                                            </label>
                                                            <div class="col-sm-4">
                                                                <select id="txtProfessionalLevelW09F1101"
                                                                        name='txtProfessionalLevelW09F1101'
                                                                        class="form-control select2 normal">
                                                                    <option value=""></option>

                                                                    @foreach($cbProfess  as $item)
                                                                        <option {{$item['ProfessionalLevelID']==$ProfessionalLevel?'selected':''}} value="{{$item['ProfessionalLevelID']}}">{{$item['ProfessionalLevelName']}}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Trinh_do_ngoai_ngu')}}
                                                            </label>
                                                            <div class="col-sm-4">
                                                                <select id="txtLanguageLevelW09F1101"
                                                                        name='txtLanguageLevelW09F1101'
                                                                        class="form-control select2 normal">
                                                                    <option value=""></option>

                                                                    @foreach($cbForeignLang  as $item)
                                                                        <option {{$item['LanguageLevelID']==$LanguageLevel?'selected':''}} value="{{$item['LanguageLevelID']}}">{{$item['LanguageLevelName']}}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Trinh_do_tin_hoc')}}
                                                            </label>
                                                            <div class="col-sm-4">
                                                                <select id="txtComputingLevelW09F1101"
                                                                        name='txtComputingLevelW09F1101'
                                                                        class="form-control select2 normal">
                                                                    <option value=""></option>

                                                                    @foreach($cbComputerLvl  as $item)
                                                                        <option {{$item['ComputingLevelID']==$ComputingLevel?'selected':''}} value="{{$item['ComputingLevelID']}}">{{$item['ComputingLevelName']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        {{--<div class="row form-group">--}}
                                                            {{--<label class="control-label col-sm-2">--}}
                                                                {{--{{Helpers::getRS($g,'Nghiep_vu_khac')}}--}}
                                                            {{--</label>--}}
                                                            {{--<div class="col-sm-10">--}}
                                                                {{--<input value="{{$OtherTransaction}}" id="txtOtherTransactionW09F1101"--}}
                                                                       {{--name="txtOtherTransactionW09F1101"--}}
                                                                       {{--class="form-control">--}}

                                                            {{--</div>--}}
                                                        {{--</div>--}}

                                                        <div class="row form-group">
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Kinh_nghiem')}}
                                                            </label>
                                                            <div class="col-sm-4">
                                                                <input value="{{$Experience}}" id="txtExperienceW09F1101"
                                                                       name="txtExperienceW09F1101"
                                                                       class="form-control">

                                                            </div>
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Muc_luong')}}
                                                            </label>
                                                            <div class="col-sm-4">
                                                                <div class="row form-group">

                                                                    <div class="col-sm-4">
                                                                        <input value="{{$SalaryFrom}}" id="txtSalaryFromW09F1101"
                                                                               name="txtSalaryFromW09F1101"
                                                                               class="form-control">
                                                                    </div>
                                                                    <div style='text-align: center'
                                                                         class="col-sm-1">-
                                                                    </div>

                                                                    <div class="col-sm-4">
                                                                        <input value="{{$SalaryTo}}" id='txtSalaryToW09F1101'
                                                                               name='txtSalaryToW09F1101'
                                                                               class="form-control">

                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <select id="cboCurrencyW09F1101" name='cboCurrencyW09F1101'
                                                                                class="form-control select2 normal">
                                                                            <option value=""></option>

                                                                            @foreach($cbo_Currency as $item)
                                                                                <option {{$item['CurrencyID']==$Currency?'selected':''}} value="{{$item['CurrencyID']}}">{{$item['CurrencyID']}}</option>
                                                                            @endforeach

                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>


                                                        <div class="row form-group">
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Yeu_cau_khac')}}
                                                            </label>
                                                            <div class="col-sm-10">
                                                <textarea id="txtOtherRequirementW09F1101"
                                                          name="txtOtherRequirementW09F1101"
                                                          class="form-control" rows="5"
                                                          id="comment">{{$OtherRequirement}}</textarea>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab_2_3">
                                                        <div class="row form-group">
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Mo_ta')}}
                                                            </label>
                                                            <div class="col-sm-10">
                                                <textarea id='txtJobDescriptionW09F1101'
                                                          name='txtJobDescriptionW09F1101' class="form-control"
                                                          rows="5" id="comment">{{$JobDescription}}</textarea>

                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label class="control-label col-sm-2">
                                                                {{Helpers::getRS($g,'Ghi_chu')}}
                                                            </label>
                                                            <div class="col-sm-10">
                                                <textarea id="txtNoteW09F1101" name="txtNoteW09F1101"
                                                          class="form-control" rows="5"
                                                          id="comment">{{$Note}}</textarea>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a onclick="loadGrid()" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                            {{Helpers::getRS($g,'Bo_chi_tieu')}}</a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse">
                                    <div class="row form-group">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="nav-tabs-custom">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#tab_3_1" data-toggle="tab">{{Helpers::getRS($g,"Tuyen_dung")}}</a></li>
                                                    <li><a href="#tab_3_2" data-toggle="tab">{{Helpers::getRS($g,"Danh_gia_nhan_vien_sau_thoi_gian_thu_viec")}}</a></li>
                                                    <li><a href="#tab_3_3" data-toggle="tab">{{Helpers::getRS($g,"Danh_gia_nhan_vien_tai_ky_HDLD")}}</a></li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab_3_1">
                                                        <div class="row form-group">
                                                            <div class='col-sm-12'>
                                                                <div id="gridW09F1101">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab_3_2">
                                                        <div class="row form-group">
                                                            <div class='col-sm-12'>
                                                                <div id="gridW09F1101_2">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab_3_3">
                                                        <div class="row form-group">
                                                            <div class='col-sm-12'>
                                                                <div id="gridW09F1101_3">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                            {{Helpers::getRS($g,'Thong_tin_he_so')}}</a>
                                    </h4>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <script>
                                            var count_all = 0;
                                            var count_disabled = 0;
                                            var count_enabled = 0;
                                        </script>
                                        <?php  $count_e = 0; ?>
                                        @foreach($Coefficient as $item)
                                            <script>
                                                count_all += 1;
                                            </script>
                                            @if($item['Disabled']==0)
                                                <?php
                                                $count_e += 1
                                                ?>
                                                <div class="col-sm-4  mgb5">
                                                    <div class="row">
                                                        <label class="col-sm-6">
                                                            {{$item['ShortU']}}
                                                        </label>
                                                        <div class="col-sm-6">

                                                            <input class="CoefficientW09F1101 form-control" style="width:100%;"
                                                                   round_number="{{$item['Decimals']}}"
                                                                   id="txtCoefficient{{$count_e}}W09F1101"
                                                                   name="txtCoefficient{{$count_e}}W09F1101"
                                                            >

                                                        </div>
                                                    </div>
                                                </div>
                                            @else

                                                <script>
                                                    count_disabled += 1;

                                                </script>



                                            @endif




                                        @endforeach
                                        <script>
                                            if (count_all == count_disabled) {
                                                $('#Coef_tab').addClass('disabled');

                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($Action!='view')
                            <div class="row form-group">
                                <div class="col-sm-12">
                                    <div class="pull-right">
                                        <button type="submit" id="BtnSubmitW09F1101" class="hide"></button>
                                        <button id='BtnSaveW09F1101' type="button" class="btn btn-default  smallbtn ">
                                            <span class="glyphicon glyphicon-floppy-saved mgr5 text-blue"></span>{{Helpers::getRS($g,'Luu')}}
                                        </button>

                                        @if($Action!='edit')
                                            <button disabled id='BtnNextW09F1101' type="button"
                                                    class="btn btn-default smallbtn "><span
                                                        class="fa fa-arrow-right text-blue mgr5"></span>{{Helpers::getRS($g,'Nhap_tiep')}}
                                            </button>
                                        @endif

                                        <button id='BtnSaveCloseW09F1101' type="button"
                                                class="btn btn-default smallbtn "><span
                                                    class="fa fa-ban text-red mgr5"></span>{{Helpers::getRS($g,'Luu_va_dong')}}
                                        </button>
                                        @if($Action=='edit')
                                            <button id='BtnNotSaveW09F1101' type="button"
                                                    class="btn btn-default smallbtn "><span
                                                        class="glyphicon glyphicon-floppy-remove text-red mgr5"></span>{{Helpers::getRS($g,'Khong_luu')}}
                                            </button>
                                        @endif


                                    </div>
                                </div>
                            </div>
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var action = '{{$Action}}';
    var btnClick = 0;
    var arrow1, arrow2, arrow3 = 0;
    var permission = '{{$permission}}';
    var dataCombo = {{json_encode($cbo_OrgChart)}};
    var $IsMaxDutyManager = '{{$IsMaxDutyManager}}';

    if (action == 'add') {
        $('#cboDutyManagerW09F1101').select2({
            containerCssClass: "required"
        });
    }

    $("#txtIsMaxDutyManagerW09F1101").click(function () {
        if($("#txtIsMaxDutyManagerW09F1101").is(":checked") == 0){
            $IsMaxDutyManager = 0;
            $("#FrmW09F1101").find("#cboDutyManagerW09F1101").select2({
                containerCssClass : "required"
            });
        }else{
            $IsMaxDutyManager = 1;
            $("#FrmW09F1101").find("#cboDutyManagerW09F1101").select2({
                containerCssClass : ""
            });
        }
    });

    $("#FrmW09F1101").find(".select2.required").select2({
        containerCssClass : "required"
    });

    $("#FrmW09F1101").find(".select2.normal").select2();

    $('#cboOrgChartW09F1101').dxDropDownBox()
        .dxDropDownBoxTreeLoad({
            sValueMember: "OrgChartID",
            sDisplayMember: "OrgName",
            dataSource: dataCombo
        })
        .dxDropDownBoxTreeTemplateSingleSelect("OrgChartParentID");

    $('#cboOrgChartW09F1101').dxDropDownBoxTreeSelectValue('{{$OrgChartID}}');

    $("#txtIsMaxDutyManagerW09F1101").click(function () {
        $("#FrmW09F1101").find(".select2.required").select2({
            containerCssClass : "required"
        });
    });

    if (action == 'edit') {
        //console.log($IsMaxDutyManager);
        if(Number($IsMaxDutyManager) == 0){
            $('#cboDutyManagerW09F1101').select2({
                containerCssClass : "required"
            });
        }
        $('#BtnNotSaveW09F1101').click(function () {
            var $Group_Recruitment = {{json_encode($Group_Recruitment)}};
            var $Group_DutyName ={{json_encode($Group_DutyName)}};
            $("#gridW09F1101").pqGrid("option", "dataModel.data",  {{$Group_Evaluation}});
            $("#gridW09F1101").pqGrid("refreshDataAndView");
            $("#gridW09F1101_2").pqGrid("option", "dataModel.data",  {{$Tab_Grid2}});
            $("#gridW09F1101_2").pqGrid("refreshDataAndView");
            $("#gridW09F1101_3").pqGrid("option", "dataModel.data",  {{$Tab_Grid3}});
            $("#gridW09F1101_3").pqGrid("refreshDataAndView");
            $('#txtSexNameW09F1101').val('{{$SexName}}');
            $('#txtFromHeightW09F1101').val('{{$FromHeight}}');
            $('#txtToHeightW09F1101').val('{{$ToHeight}}');
            $('#txtFromWeightW09F1101').val('{{$FromWeight}}');
            $('#txtToWeightW09F1101').val('{{$ToWeight}}');
            $('#txtHealthW09F1101').val('{{$Health}}');
            $('#txtAppearanceW09F1101').val('{{$Appearance}}');
            $('#cboMaritalStatusW09F1101').val('{{$MaritalStatus}}');
            $('#cboPopulationW09F1101').val('{{$Population}}');
            $('#cboReligionW09F1101').val('{{$Religion}}');
            $('#cboNationalityW09F1101').val('{{$Nationlity}}');
            $('#txtEducationLevelW09F1101').val('{{$EducationLevel}}');
            $('#txtProfessionalLevelW09F1101').val('{{$ProfessionalLevel}}');
            $('#txtLanguageLevelW09F1101').val('{{$LanguageLevel}}');
            $('#txtComputingLevelW09F1101').val('{{$ComputingLevel}}');
            $('#txtOtherTransactionW09F1101').val('{{$OtherTransaction}}');
            $('#txtExperienceW09F1101').val('{{$Experience}}');
            $('#txtSalaryFromW09F1101').val('{{$SalaryFrom}}');
            $('#txtSalaryToW09F1101').val('{{$SalaryTo}}');
            $('#cboCurrencyW09F1101').val('{{$Currency}}');
            $('#cboOrgChartW09F1101').dxDropDownBoxTreeSelectValue('{{$OrgChartID}}');
            $('#cboDutyManagerW09F1101').val('{{$DutyManagerID}}');
            $('#txtFromAgeW09F1101').val('{{$FromAge}}');
            $('#txtToAgeW09F1101').val('{{$ToAge}}');
            $('#txtDescriptionW09F1101').val($Group_DutyName.Description);
            $('#txtDutyDisplayOrderW09F1101').val('{{$DutyDisplayOrder}}');
            $('[name="txtIsManagerW09F1101"]').val(["{{$IsManager}}"]);
            $('[name="txtIsMaxDutyManagerW09F1101"]').val(["{{$IsMaxDutyManager}}"]);
            $('#txtDutyNameW09F1101').val('{{$DutyName}}');
            $('#txtDutyName01W09F1101').val('{{$DutyName01}}');
            $('#cboDutyGroupW09F1101').val('{{$DutyGroupID}}');
            $('#txtJobDescriptionW09F1101').val($Group_Recruitment.JobDescription);
            $('#txtOtherRequirementW09F1101').val($Group_Recruitment.OtherRequirement);
            $('#txtNoteW09F1101').val($Group_Recruitment.Note);
            $('[name="txtDisabledW09F1101"]').val(["{{$Disabled}}"]);

            $('#txtCoefficient1W09F1101').val(format2({{intval($Coefficient1)}}, '', $('#Coefficient1').attr('round_number')));
            $('#txtCoefficient2W09F1101').val(format2({{ intval($Coefficient2)}}, '', $('#Coefficient2').attr('round_number')));
            $('#txtCoefficient3W09F1101').val(format2({{ intval($Coefficient3)}}, '', $('#Coefficient3').attr('round_number')));
            $('#txtCoefficient4W09F1101').val(format2({{ intval($Coefficient4)}}, '', $('#Coefficient4').attr('round_number')));
            $('#txtCoefficient5W09F1101').val(format2({{ intval($Coefficient5)}}, '', $('#Coefficient5').attr('round_number')));
            $('#txtCoefficient6W09F1101').val(format2({{ intval($Coefficient6)}}, '', $('#Coefficient6').attr('round_number')));
            $('#txtCoefficient7W09F1101').val(format2({{ intval($Coefficient7)}}, '', $('#Coefficient7').attr('round_number')));
            $('#txtCoefficient8W09F1101').val(format2({{ intval($Coefficient8)}}, '', $('#Coefficient8').attr('round_number')));
            $('#txtCoefficient9W09F1101').val(format2({{ intval($Coefficient9)}}, '', $('#Coefficient9').attr('round_number')));
            $('#txtCoefficient10W09F1101').val(format2({{ intval($Coefficient10)}}, '', $('#Coefficient10').attr('round_number')));
            $('#txtCoefficient11W09F1101').val(format2({{ intval($Coefficient11)}}, '', $('#Coefficient11').attr('round_number')));
            $('#txtCoefficient12W09F1101').val(format2({{ intval($Coefficient12)}}, '', $('#Coefficient12').attr('round_number')));
            $('#txtCoefficient13W09F1101').val(format2({{ intval($Coefficient13)}}, '', $('#Coefficient13').attr('round_number')));
            $('#txtCoefficient14W09F1101').val(format2({{ intval($Coefficient14)}}, '', $('#Coefficient14').attr('round_number')));
            $('#txtCoefficient15W09F1101').val(format2({{ intval($Coefficient15)}}, '', $('#Coefficient15').attr('round_number')));
            $('#txtCoefficient16W09F1101').val(format2({{ intval($Coefficient16)}}, '', $('#Coefficient16').attr('round_number')));
            $('#txtCoefficient17W09F1101').val(format2({{ intval($Coefficient17)}}, '', $('#Coefficient17').attr('round_number')));
            $('#txtCoefficient18W09F1101').val(format2({{ intval($Coefficient18)}}, '', $('#Coefficient18').attr('round_number')));
            $('#txtCoefficient19W09F1101').val(format2({{ intval($Coefficient19)}}, '', $('#Coefficient19').attr('round_number')));
            $('#txtCoefficient20W09F1101').val(format2({{ intval($Coefficient20)}}, '', $('#Coefficient20').attr('round_number')));
            $('#txtCoefficient21W09F1101').val(format2({{ intval($Coefficient21)}}, '', $('#Coefficient21').attr('round_number')));
            $('#txtCoefficient22W09F1101').val(format2({{ intval($Coefficient22)}}, '', $('#Coefficient22').attr('round_number')));
            $('#txtCoefficient23W09F1101').val(format2({{ intval($Coefficient23)}}, '', $('#Coefficient23').attr('round_number')));
            $('#txtCoefficient24W09F1101').val(format2({{ intval($Coefficient24)}}, '', $('#Coefficient24').attr('round_number')));
            $('#txtCoefficient25W09F1101').val(format2({{ intval($Coefficient25)}}, '', $('#Coefficient25').attr('round_number')));
            $('#txtCoefficient26W09F1101').val(format2({{ intval($Coefficient26)}}, '', $('#Coefficient26').attr('round_number')));
            $('#txtCoefficient27W09F1101').val(format2({{ intval($Coefficient27)}}, '', $('#Coefficient27').attr('round_number')));
            $('#txtCoefficient28W09F1101').val(format2({{ intval($Coefficient28)}}, '', $('#Coefficient28').attr('round_number')));
            $('#txtCoefficient29W09F1101').val(format2({{ intval($Coefficient29)}}, '', $('#Coefficient29').attr('round_number')));
            $('#txtCoefficient30W09F1101').val(format2({{ intval($Coefficient30)}}, '', $('#Coefficient30').attr('round_number')));

            $(this).prop('disabled', true);
        })
    }


    function toggle_control(mode,toggle_OnOFF) {

        $('#txtSexNameW09F1101').prop('disabled', toggle_OnOFF);
        $('#txtFromAgeW09F1101').prop('readonly', toggle_OnOFF);
        $('#txtFromHeightW09F1101').prop('readonly', toggle_OnOFF);
        $('#txtToHeightW09F1101').prop('readonly', toggle_OnOFF);
        $('#txtFromWeightW09F1101').prop('readonly', toggle_OnOFF);
        $('#txtToAgeW09F1101').prop('readonly', toggle_OnOFF);
        $('#txtHealthW09F1101').prop('readonly', toggle_OnOFF);
        $('#txtToWeightW09F1101').prop('readonly', toggle_OnOFF);
        $('#txtAppearanceW09F1101').prop('readonly', toggle_OnOFF);
        $('#cboReligionW09F1101').prop('readonly', toggle_OnOFF);
        $('#cboPopulationW09F1101').prop('disabled', toggle_OnOFF);
        $('#cboMaritalStatusW09F1101').prop('disabled', toggle_OnOFF);
        $('#cboNationalityW09F1101').prop('disabled', toggle_OnOFF);
        $('#txtDescriptionW09F1101').prop('readonly', toggle_OnOFF);
        $('#txtEducationLevelW09F1101').prop('disabled', toggle_OnOFF);
        $('#txtProfessionalLevelW09F1101').prop('disabled', toggle_OnOFF);
        $('#txtLanguageLevelW09F1101').prop('disabled', toggle_OnOFF);
        $('#txtComputingLevelW09F1101').prop('disabled', toggle_OnOFF);
        $('#txtOtherTransactionW09F1101').prop('readonly', toggle_OnOFF);
        $('#txtExperienceW09F1101').prop('readonly', toggle_OnOFF);
        $('#txtSalaryFromW09F1101').prop('readonly', toggle_OnOFF);
        $('#txtSalaryToW09F1101').prop('readonly', toggle_OnOFF);
        $('#cboCurrencyW09F1101').prop('disabled', toggle_OnOFF);
        $('#txtOtherRequirementW09F1101').prop('readonly', toggle_OnOFF);
        $('#txtJobDescriptionW09F1101').prop('readonly', toggle_OnOFF);
        $('#txtNoteW09F1101').prop('readonly', toggle_OnOFF);
        $('#cboReligionW09F1101').prop('disabled', toggle_OnOFF);
        $('.CoefficientW09F1101').prop('disabled', toggle_OnOFF);
        $('#txtDutyNameW09F1101').prop('readonly', toggle_OnOFF);
        $('#txtDutyDisplayOrderW09F1101').prop('readonly', toggle_OnOFF);
        $('#txtDisabledW09F1101').prop('readonly', toggle_OnOFF);
        $('#txtDutyNameW09F1101').prop('readonly', toggle_OnOFF);
        $('#txtDutyName01W09F1101').prop('readonly', toggle_OnOFF);
        $('#cboOrgChartW09F1101').dxDropDownBoxTreeDisable(toggle_OnOFF);//disable
        $('#cboDutyManagerW09F1101').prop('disabled', toggle_OnOFF);
        if(toggle_OnOFF == true){
            console.log('sdsd');
            $('#cboDutyManagerW09F1101').parent().find('.select2-selection--single').css('background-color', '#eee');
        }
        $('#cboDutyGroupW09F1101').prop('disabled', toggle_OnOFF);
        $("input[name='txtIsManagerW09F1101'][value='0']").prop('disabled', toggle_OnOFF);
        $("input[name='txtIsManagerW09F1101'][value='1']").prop('disabled', toggle_OnOFF);

        if(mode==1){
            if (action == 'view') {
                $('#txtIsMaxDutyManagerW09F1101').prop('disabled', true);
            }
            else {
                if ('{{$IsManager}}' == 0) {
                    $('#txtIsMaxDutyManagerW09F1101').prop('disabled', true);

                }
                else {
                    $('#txtIsMaxDutyManagerW09F1101').prop('disabled', false);

                }

            }
        }
        else{
            $('#txtIsMaxDutyManagerW09F1101').prop('disabled', toggle_OnOFF);

        }

        $('#txtDutyIDW09F1101').prop('disabled', toggle_OnOFF);
        $('#txtDisabledW09F1101').prop('disabled', toggle_OnOFF);
        $('#cboOrgChartW09F1101').prop('selected', toggle_OnOFF);
        $('#cboDutyManagerW09F1101').prop('selected', toggle_OnOFF);
        $('#cboDutyGroupW09F1101').prop('selected', toggle_OnOFF);
        $('#cboReligionW09F1101').prop('selected', toggle_OnOFF);
        $('#cboPopulationW09F1101').prop('selected', toggle_OnOFF);
        $('#cboMaritalStatusW09F1101').prop('selected', toggle_OnOFF);
        $('#cboNationalityW09F1101').prop('selected', toggle_OnOFF);
        $('#cboCurrencyW09F1101').prop('selected', toggle_OnOFF);


    }

    $('#BtnSaveW09F1101').click(function () {
        $('#errorDuty1IDW09F1101').addClass('hide');
        $('#errorDuty2IDW09F1101').addClass('hide');
        $('#errorDutyNameW09F1101').addClass('hide');
        $('#errorDutyManagerW09F1101').addClass('hide');

        ask_save(function () {

            if (checkRequireW09F1101() == false) {
                //$("#modalW09F1101").find("#divContentW09F1101").scrollTop(0);

            }
            else {
                //$("#modalW09F1101").find("#divContentW09F1101").scrollTop(0);
                $('#BtnSubmitW09F1101').click();

            }


        });


    })

    $('#BtnNextW09F1101').click(function () {
        //$("#modalW09F1101").find("#divContentW09F1101").scrollTop(0);
        $(this).prop('disabled', true);
        toggle_control(2,false);
        $('#BtnSaveW09F1101').prop('disabled', false);
        $('#BtnSaveCloseW09F1101').prop('disabled', false);
        $('#BtnNotSaveW09F1101').prop('disabled', false);
        $('#txtSexNameW09F1101').val('');
        $('#txtFromAgeW09F1101').val('');
        $('#txtFromHeightW09F1101').val('');
        $('#txtToHeightW09F1101').val('');
        $('#txtFromWeightW09F1101').val('');
        $('#txtToAgeW09F1101').val('');
        $('#txtHealthW09F1101').val('');
        $('#txtToWeightW09F1101').val('');
        $('#txtAppearanceW09F1101').val('');
        $('#txtOtherTransactionW09F1101').val('');
        $('#txtExperienceW09F1101').val('');
        $('#txtSalaryFromW09F1101').val('');
        $('#txtSalaryToW09F1101').val('');
        $('#txtOtherRequirementW09F1101').val('');
        $('#txtJobDescriptionW09F1101').val('');
        $('#txtNoteW09F1101').val('');
        $('.CoefficientW09F1101').val('');
        $('#txtDutyNameW09F1101').val('');
        $('#txtDutyDisplayOrderW09F1101').val('');
        $('#txtDisabledW09F1101').val('');
        $('#txtDescriptionW09F1101').val('');
        $('#txtDutyNameW09F1101').val('');
        $('#txtDutyName01W09F1101').val('');
        $('#cboOrgChartW09F1101').dxDropDownBoxTreeSelectValue('');
        setSelect2Value($("#cboDutyManagerW09F1101"),'');
        setSelect2Value($("#cboDutyGroupW09F1101"),'');
        setSelect2Value($("#cboReligionW09F1101"),'');
        setSelect2Value($("#cboPopulationW09F1101"),'');
        setSelect2Value($("#cboNationalityW09F1101"),'');
        setSelect2Value($("#cboCurrencyW09F1101"),'');
        setSelect2Value($("#txtEducationLevelW09F1101"),'');
        setSelect2Value($("#txtProfessionalLevelW09F1101"),'');
        setSelect2Value($("#txtLanguageLevelW09F1101"),'');
        setSelect2Value($("#txtComputingLevelW09F1101"),'');
        $('input:radio[name=txtIsManagerW09F1101][value="0"]').click();
        $('#txtIsMaxDutyManagerW09F1101').prop('checked', false);
        $('#txtDutyIDW09F1101').val('');
        $('#txtDisabledW09F1101').prop('checked', false);
        $('#cboOrgChartW09F1101').dxDropDownBoxTreeSelectValue('');
        $('#cboMaritalStatusW09F1101').val('');
        //grid 1
        $("#gridW09F1101").pqGrid("option", "dataModel.data", []);
        var colM = $('#gridW09F1101').pqGrid("option", "colModel");
        var colIndx = $('#gridW09F1101').pqGrid("getColIndx", {dataIndx: "View"});
        var colModel = colM[colIndx];
        colModel.hidden = false;
        $('#gridW09F1101').pqGrid("option", "colModel", colM);
        $("#gridW09F1101").pqGrid("option", "editable", true);
        $("#gridW09F1101").pqGrid("option", "showToolbar", true);
        $("#gridW09F1101").pqGrid('refreshDataAndView');

        //grid 2
        $("#gridW09F1101_2").pqGrid("option", "dataModel.data", []);
        var colM2 = $('#gridW09F1101_2').pqGrid("option", "colModel");
        var colIndx2 = $('#gridW09F1101_2').pqGrid("getColIndx", {dataIndx: "View"});
        var colModel2 = colM2[colIndx2];
        colModel2.hidden = false;
        $('#gridW09F1101_2').pqGrid("option", "colModel", colM2);
        $("#gridW09F1101_2").pqGrid("option", "editable", true);
        $("#gridW09F1101_2").pqGrid("option", "showToolbar", true);
        $("#gridW09F1101_2").pqGrid('refreshDataAndView');

        //grid 3
        $("#gridW09F1101_3").pqGrid("option", "dataModel.data", []);
        var colM3 = $('#gridW09F1101_3').pqGrid("option", "colModel");
        var colIndx3 = $('#gridW09F1101_3').pqGrid("getColIndx", {dataIndx: "View"});
        var colModel3 = colM3[colIndx3];
        colModel3.hidden = false;
        $('#gridW09F1101_3').pqGrid("option", "colModel", colM3);
        $("#gridW09F1101_3").pqGrid("option", "editable", true);
        $("#gridW09F1101_3").pqGrid("option", "showToolbar", true);
        $("#gridW09F1101_3").pqGrid('refreshDataAndView');
    })
    $('#BtnSaveCloseW09F1101').click(function () {
        btnClick = 3;
        $('#BtnSubmitW09F1101').click();


    })
    $('#FrmW09F1101').on('submit', function (e) {
        e.preventDefault();
        var gridW09F1101_data = $("#gridW09F1101").pqGrid("option", "dataModel.data")
        var gridW09F1101_data2 = $("#gridW09F1101_2").pqGrid("option", "dataModel.data")
        var gridW09F1101_data3 = $("#gridW09F1101_3").pqGrid("option", "dataModel.data")

        if (action == 'edit') {
            url = "{{url("/W09F1101/".$pForm."/$g/update")}}";
        }
        else {
            url = "{{url("/W09F1101/".$pForm."/$g/save")}}";

        }
        $.ajax({
            method: "POST",
            data: $('#FrmW09F1101').serialize() + "&GridW09F1101=" + JSON.stringify(gridW09F1101_data)
            + "&GridW09F1101_2=" + JSON.stringify(gridW09F1101_data2)
            + "&GridW09F1101_3=" + JSON.stringify(gridW09F1101_data3)
            + "&cboOrgChartW09F1101=" + $('#cboOrgChartW09F1101').dxDropDownBoxTreeGetValue(),
            url: url,
            success: function (data) {
                var currentObject = $.parseJSON(data);
                if (currentObject.status == 'SUCCESS') {
                    save_ok(function () {
                        $('#BtnSaveW09F1101').prop('disabled', true);
                        $('#BtnNextW09F1101').prop('disabled', false);
                        $('#BtnSaveCloseW09F1101').prop('disabled', true);
                        $('#BtnNotSaveW09F1101').prop('disabled', true);
                        //grid 1
                        var colM = $('#gridW09F1101').pqGrid("option", "colModel");
                        var colIndx = $('#gridW09F1101').pqGrid("getColIndx", {dataIndx: "View"});
                        var colModel = colM[colIndx];
                        colModel.hidden = true;
                        $("#gridW09F1101").pqGrid("option", "showToolbar", false);
                        $('#gridW09F1101').pqGrid("option", "colModel", colM);
                        $("#gridW09F1101").pqGrid("option", "editable", false);
                        $("#gridW09F1101").pqGrid('refreshDataAndView');

                        //grid 2
                        var colM2 = $('#gridW09F1101_2').pqGrid("option", "colModel");
                        var colIndx2 = $('#gridW09F1101_2').pqGrid("getColIndx", {dataIndx: "View"});
                        var colModel2 = colM2[colIndx2];
                        colModel2.hidden = true;
                        $("#gridW09F1101_2").pqGrid("option", "showToolbar", false);
                        $('#gridW09F1101_2').pqGrid("option", "colModel", colM2);
                        $("#gridW09F1101_2").pqGrid("option", "editable", false);
                        $("#gridW09F1101_2").pqGrid('refreshDataAndView');

                        //grid 3
                        var colM3 = $('#gridW09F1101_3').pqGrid("option", "colModel");
                        var colIndx3 = $('#gridW09F1101_3').pqGrid("getColIndx", {dataIndx: "View"});
                        var colModel3 = colM3[colIndx3];
                        colModel3.hidden = true;
                        $("#gridW09F1101_3").pqGrid("option", "showToolbar", false);
                        $('#gridW09F1101_3').pqGrid("option", "colModel", colM3);
                        $("#gridW09F1101_3").pqGrid("option", "editable", false);
                        $("#gridW09F1101_3").pqGrid('refreshDataAndView');

                        toggle_control(2,true);
                        if(action=='edit'){
                            $('#BtnNotSaveW09F1101').prop('disabled', true);
                        }
                        if (btnClick == 3) {
                            $('#modalW09F1101').modal('hide');
                        }
                    });


                }
                else
                    alert_error(currentObject.message);
            }
        });

    })

    // dont allow DutyID and DutyName NULL, DutyID cant have special character
    function checkRequireW09F1101(el) {
        console.log(el);
        //console.log($('#errorDutyManagerW09F1101').val());
        if (el != undefined) {
            if (el.selector == '#txtDutyIDW09F1101') {
                $("#errorDuty1IDW09F1101").addClass('hide');
                $("#errorDuty2IDW09F1101").addClass('hide');
                if (el.val() == '') {
                    $("#errorDuty1IDW09F1101").removeClass('hide');
                    el.focus();
                }
                else if (checkID(el) == false) {
                    $("#errorDuty2IDW09F1101").removeClass('hide');
                    el.focus();
                }
            }
            else if (el.selector != '#txtDutyIDW09F1101') {
                $("#errorDutyNameW09F1101").addClass('hide');
                if (el.val() == '') {
                    $("#errorDutyNameW09F1101").removeClass('hide');
                    el.focus();
                }
            }
        }
        else {
            $("#errorDuty1IDW09F1101").addClass('hide');
            $("#errorDuty2IDW09F1101").addClass('hide');
            $("#errorDutyNameW09F1101").addClass('hide');
            $("#errorDutyManagerW09F1101").addClass('hide');

            if ($('#txtDutyIDW09F1101').val() == '') {
                $("#errorDuty1IDW09F1101").removeClass('hide');

                $('#txtDutyIDW09F1101').focus();
                return false;

            }
            else if (checkID($('#txtDutyIDW09F1101')) == false) {
                $("#errorDuty2IDW09F1101").removeClass('hide');
                $('#txtDutyIDW09F1101').focus();
                return false;
            }
            else if ($('#txtDutyNameW09F1101').val() == '') {
                $("#errorDutyNameW09F1101").removeClass('hide');
                $('#txtDutyNameW09F1101').focus();
                return false;
            }
            else if (($('#cboDutyManagerW09F1101').val() == '' && Number($IsMaxDutyManager) == 0) || action =="add") {
                $("#errorDutyManagerW09F1101").removeClass('hide');
                $('#cboDutyManagerW09F1101').focus();
                return false;
            }
            return true

        }

    }

    $(document).ready(function () {
        $("input[name='txtIsManagerW09F1101'][value='0']").click(function () {
            $('#txtIsMaxDutyManagerW09F1101').prop('disabled', true);
            $('#txtIsMaxDutyManagerW09F1101').prop('checked', false);

        })

        $("input[name='txtIsManagerW09F1101'][value='1']").click(function () {
            $('#txtIsMaxDutyManagerW09F1101').prop('disabled', false);
        })

        $('#txtDutyIDW09F1101').keyup(function () {
            checkRequireW09F1101($('#txtDutyIDW09F1101'));

        });

        $('#txtDutyNameW09F1101').keyup(function () {
            checkRequireW09F1101($('#txtDutyNameW09F1101'));
        });


        $('#modalW09F1101 :input').keypress(function () {
            $('#BtnNotSaveW09F1101').prop('disabled', false);

        })
        $('#modalW09F1101 select, :radio, :checkbox').click(function () {
            $('#BtnNotSaveW09F1101').prop('disabled', false);
        })
        // format the data base on dynamic column store procedure
        var input1 = $('.CoefficientW09F1101');
        $.each(input1, function (key, item) {
            $(item).inputmask("numeric", {
                radixPoint: ".",
                groupSeparator: ",",
                digits: $(item).attr('round_number'),
                min: 0,
                autoGroup: true,
                rightAlign: true
            });
        });
        //-- limit the input base on dynamic column store procedure
        if (action != 'add') {
            $('#txtCoefficient1W09F1101').val(format2('{{ $Coefficient1}}', '', $('#txtCoefficient1W09F1101').attr('round_number')));
            $('#txtCoefficient2W09F1101').val(format2('{{ $Coefficient2}}', '', $('#txtCoefficient2W09F1101').attr('round_number')));
            $('#txtCoefficient3W09F1101').val(format2('{{ $Coefficient3}}', '', $('#txtCoefficient3W09F1101').attr('round_number')));
            $('#txtCoefficient4W09F1101').val(format2('{{ $Coefficient4}}', '', $('#txtCoefficient4W09F1101').attr('round_number')));
            $('#txtCoefficient5W09F1101').val(format2('{{ $Coefficient5}}', '', $('#txtCoefficient5W09F1101').attr('round_number')));
            $('#txtCoefficient6W09F1101').val(format2('{{ $Coefficient6}}', '', $('#txtCoefficient6W09F1101').attr('round_number')));
            $('#txtCoefficient7W09F1101').val(format2('{{ $Coefficient7}}', '', $('#txtCoefficient7W09F1101').attr('round_number')));
            $('#txtCoefficient8W09F1101').val(format2('{{ $Coefficient8}}', '', $('#txtCoefficient8W09F1101').attr('round_number')));
            $('#txtCoefficient9W09F1101').val(format2('{{ $Coefficient9}}', '', $('#txtCoefficient9W09F1101').attr('round_number')));
            $('#txtCoefficient10W09F1101').val(format2('{{ $Coefficient10}}', '', $('#txtCoefficient10W09F1101').attr('round_number')));
            $('#txtCoefficient11W09F1101').val(format2('{{ $Coefficient11}}', '', $('#txtCoefficient11W09F1101').attr('round_number')));
            $('#txtCoefficient12W09F1101').val(format2('{{ $Coefficient12}}', '', $('#txtCoefficient12W09F1101').attr('round_number')));
            $('#txtCoefficient13W09F1101').val(format2('{{ $Coefficient13}}', '', $('#txtCoefficient13W09F1101').attr('round_number')));
            $('#txtCoefficient14W09F1101').val(format2('{{ $Coefficient14}}', '', $('#txtCoefficient14W09F1101').attr('round_number')));
            $('#txtCoefficient15W09F1101').val(format2('{{ $Coefficient15}}', '', $('#txtCoefficient15W09F1101').attr('round_number')));
            $('#txtCoefficient16W09F1101').val(format2('{{ $Coefficient16}}', '', $('#txtCoefficient16W09F1101').attr('round_number')));
            $('#txtCoefficient17W09F1101').val(format2('{{ $Coefficient17}}', '', $('#txtCoefficient17W09F1101').attr('round_number')));
            $('#txtCoefficient18W09F1101').val(format2('{{ $Coefficient18}}', '', $('#txtCoefficient18W09F1101').attr('round_number')));
            $('#txtCoefficient19W09F1101').val(format2('{{ $Coefficient19}}', '', $('#txtCoefficient19W09F1101').attr('round_number')));
            $('#txtCoefficient20W09F1101').val(format2('{{ $Coefficient20}}', '', $('#txtCoefficient20W09F1101').attr('round_number')));
            $('#txtCoefficient21W09F1101').val(format2('{{ $Coefficient21}}', '', $('#txtCoefficient21W09F1101').attr('round_number')));
            $('#txtCoefficient22W09F1101').val(format2('{{ $Coefficient22}}', '', $('#txtCoefficient22W09F1101').attr('round_number')));
            $('#txtCoefficient23W09F1101').val(format2('{{ $Coefficient23}}', '', $('#txtCoefficient23W09F1101').attr('round_number')));
            $('#txtCoefficient24W09F1101').val(format2('{{ $Coefficient24}}', '', $('#txtCoefficient24W09F1101').attr('round_number')));
            $('#txtCoefficient25W09F1101').val(format2('{{ $Coefficient25}}', '', $('#txtCoefficient25W09F1101').attr('round_number')));
            $('#txtCoefficient26W09F1101').val(format2('{{ $Coefficient26}}', '', $('#txtCoefficient26W09F1101').attr('round_number')));
            $('#txtCoefficient27W09F1101').val(format2('{{ $Coefficient27}}', '', $('#txtCoefficient27W09F1101').attr('round_number')));
            $('#txtCoefficient28W09F1101').val(format2('{{ $Coefficient28}}', '', $('#txtCoefficient28W09F1101').attr('round_number')));
            $('#txtCoefficient29W09F1101').val(format2('{{ $Coefficient29}}', '', $('#txtCoefficient29W09F1101').attr('round_number')));
            $('#txtCoefficient30W09F1101').val(format2('{{ $Coefficient30}}', '', $('#txtCoefficient30W09F1101').attr('round_number')));


        }

        $('#txtDutyDisplayOrderW09F1101').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 0,
            min: 0,
            autoGroup: true,
            rightAlign: true
        });

        $('#txtFromAgeW09F1101, #txtToAgeW09F1101').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 0,
            min: 0,
            max: 150,
            autoGroup: true,
            rightAlign: true
        });
        $('#txtSalaryFromW09F1101, #txtSalaryToW09F1101, #txtFromWeightW09F1101, #txtToWeightW09F1101, #txtFromHeightW09F1101, #txtToHeightW09F1101').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 2,
            min: 0,
            autoGroup: true,
            rightAlign: true
        });
        loadGridW09F1101();
        loadGridW09F1101_2();
        loadGridW09F1101_3();
        enableControls('{{$Action}}')
        $.AdminLTE.boxWidget.activate();
        $('#BtnArrow_2_W09F1101').click();
        $('#BtnArrow_3_W09F1101').click();


        var height = $(window).height() - 80;
        $("#modalW09F1101").find("#divContentW09F1101").height(height);
        $("#modalW09F1101").find("#divContentW09F1101").css('overflow-y', 'auto');
        $("#modalW09F1101").find("#divContentW09F1101").css('overflow-x', 'hidden');


        //$("#modalW09F1101").find("#divContentW09F1101").css('overflow', 'auto');


    });

    function enableControls(task) {
        switch (task) {
            case 'edit':
                toggle_control(1,false);
                $('#txtDutyIDW09F1101').prop('readonly', true);
                $("#gridW09F1101").pqGrid("option", "showToolbar", true);
                $("#gridW09F1101_2").pqGrid("option", "showToolbar", true);
                $("#gridW09F1101_3").pqGrid("option", "showToolbar", true);
                break;
            case 'add':
                toggle_control(1,false);
                $("#gridW09F1101").pqGrid("option", "showToolbar", true);
                $("#gridW09F1101_2").pqGrid("option", "showToolbar", true);
                $("#gridW09F1101_3").pqGrid("option", "showToolbar", true);
                break;
            case 'view':
                toggle_control(1,true);
                $("#gridW09F1101").pqGrid("option", "showToolbar", false);
                $("#gridW09F1101_2").pqGrid("option", "showToolbar", false);
                $("#gridW09F1101_3").pqGrid("option", "showToolbar", false);
                break;


        }
    }

    function loadGridW09F1101() {
        var obj2 = {
            width: '100%',
            flexHeight: true,
            selectionModel: {type: 'row', mode: 'single'},
            minWidth: 30,
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'auto'},
            showTitle: false,
            dataType: "JSON",
            wrap: false,
            hwrap: false,
            collapsible: false,
            postRenderInterval: -1,
            toolbar: {
                items: [
                    {
                        type: 'button',
                        label: '{{Helpers::getRS($g,'Them')}}',
                        icon: 'ui-icon-plus',
                        listener: function (ui) {
                            $('#BtnNotSaveW09F1101').prop('disabled', false);
                            var grid_lenght = $("#gridW09F1101").pqGrid('option', "dataModel.data").length;
                            $("#gridW09F1101").pqGrid('addRow', {
                                newRow: {OrderNo: grid_lenght + 1},
                                rowIndx: grid_lenght + 1
                            });


                        }
                    },

                ]
            },
            editable: function (ui) {
                if ('{{$Action}}' != 'view') {
                    return true;
                }
                else {
                    return false;
                }
            },
            pageModel: {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]},
            numberCell: {show: false},
        };
        obj2.colModel = [
            {

                title: "{{Helpers::getRS($g,'Xu_ly')}}",
                align: "center",
                dataIndx: "View",
                isExport: false,
                editor: false,
                editable: false,
                sortable: false,
                maxWidth: 100,
                minWidth: 50,
                Width: 50,
                @if($Action!='view')
                hidden: false,
                @else
                hidden: true,
                @endif
                render: function (ui) {
                    var str = "";
                    var rowData = ui.rowData;
                    if (permission > 3) {
                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class='btnDeleteW09F1101'><i class='fa fa-trash' style='color:#333'></i></a>";
                    }
                    return str;
                }
                ,
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var rowData = ui.rowData;

                    $cell.find(".btnEditW09F1100").bind("click", function (evt) {
                        showFormDialogPost('{{url("/W09F1101/$pForm/$g")}}', "modalW09F1101",
                            {
                                action: 'edit',
                                DutyID: rowData['DutyID']
                            }, null);
                    });
                    $cell.find(" .btnDeleteW09F1101").bind("click", function (ui) {
                        var count = 0;
                        $('#BtnNotSaveW09F1101').prop('disabled', false);
                        $("#gridW09F1101").pqGrid("deleteRow", {rowIndx: rowIndx});

                        var gridW09F110_data = $("#gridW09F1101").pqGrid("option", "dataModel.data");
                        for (i = 0; i < gridW09F110_data.length; i++) {
                            count += 1;
                            gridW09F110_data[i].OrderNo = count;
                        }
                        $("#gridW09F1101").pqGrid("option", "dataModel.data", gridW09F110_data);
                        $("#gridW09F1101").pqGrid('refreshDataAndView');
                    });
                },
            },
            {
                title: "{{Helpers::getRS($g,'STT')}}",
                dataType: "string",
                dataIndx: "OrderNo",
                align: 'center',
                maxWidth: 150,
                minWidth: 50,
                Width: 100,
                align: "center",
                editable: true,
                editor: false,
                hidden: false,
            },
            {
                title: "{{Helpers::getRS($g,'Ma')}}",
                dataType: "string",
                dataIndx: "EvaluationElementID",
                minWidth: 50,
                width: 200,
                maxWidth: 300,
                align: "left",
                editable: true,
                hidden: false,
                editor: {
                    options: {{$cbo_Evaluation}},
                    type: "select",
                    valueIndx: "EvaluationElementID",
                    labelIndx: "EvaluationElementName",
                    init: function (ui) {
                        ui.$cell.find("select").pqSelect({
                            singlePlaceholder: 'Chọn'
                        });
                        ui.$cell.find("select").change(function (evt) {
                            var rowdata = ui.rowData;
                            var rowIndx = ui.rowIndx;
                            var dataIndx = ui.dataIndx;
                            var ID = $(this).val();

                            $('#BtnNotSaveW09F1101').prop('disabled', false);
                            if (ID != '') {
                                var EvaluationElementID = $('#gridW09F1101').pqGrid("getColumn", {dataIndx: "EvaluationElementID"});
                                var dataCombo = EvaluationElementID.editor.options;
                                console.log(dataCombo);
                                var rowEvaluation = $.grep(dataCombo, function (d) {
                                    return d.EvaluationElementID == ID;
                                });
                                rowdata['EvaluationElementName'] = rowEvaluation[0]['EvaluationElementName'];
                                $('#gridW09F1101').pqGrid("refreshDataAndView");
                            }
                            else {
                                rowdata['EvaluationElementName'] = "";
                                $('#gridW09F1101').pqGrid("refreshDataAndView");
                            }
                        });
                    }
                },
            },
            {
                title: "{{Helpers::getRS($g,'Dien_giai')}}",
                dataType: "string",
                dataIndx: "EvaluationElementName",
                minWidth: 100,
                editable: false,
                editor: false,
                width: 350,
                maxWidth: 400,
                align: "left",
                hidden: false,
            },
            {
                title: "{{Helpers::getRS($g,'Ghi_chu')}}",
                dataType: "string",
                dataIndx: "Note",
                minWidth: 50,
                width: 500,
                maxWidth: 500,
                align: "left",
                hidden: false,
                editable: true,
            },
        ];
        obj2.dataModel = {
            data: {{$Group_Evaluation}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        };
        $("#gridW09F1101").pqGrid(obj2);
        setTimeout(function () {
            $("#gridW09F1101").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#gridW09F1101").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            $("#gridW09F1101").pqGrid("refreshDataAndView");
        }, 300)
    }

    function loadGridW09F1101_2() {
        var obj2 = {
            width: '100%',
            flexHeight: true,
            selectionModel: {type: 'row', mode: 'single'},
            minWidth: 30,
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'auto'},
            showTitle: false,
            dataType: "JSON",
            wrap: false,
            hwrap: false,
            collapsible: false,
            postRenderInterval: -1,
            toolbar: {
                items: [
                    {
                        type: 'button',
                        label: '{{Helpers::getRS($g,'Them')}}',
                        icon: 'ui-icon-plus',
                        listener: function (ui) {
                            $('#BtnNotSaveW09F1101').prop('disabled', false);
                            var grid_lenght = $("#gridW09F1101_2").pqGrid('option', "dataModel.data").length;
                            $("#gridW09F1101_2").pqGrid('addRow', {
                                newRow: {OrderNo: grid_lenght + 1},
                                rowIndx: grid_lenght + 1
                            });


                        }
                    },

                ]
            },
            editable: function (ui) {
                if ('{{$Action}}' != 'view') {
                    return true;
                }
                else {
                    return false;
                }
            },
            pageModel: {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]},
            numberCell: {show: false},
        };
        obj2.colModel = [
            {

                title: "{{Helpers::getRS($g,'Xu_ly')}}",
                align: "center",
                dataIndx: "View",
                isExport: false,
                editor: false,
                editable: false,
                sortable: false,
                maxWidth: 100,
                minWidth: 50,
                Width: 50,
                @if($Action!='view')
                hidden: false,
                @else
                hidden: true,
                @endif
                render: function (ui) {
                    var str = "";
                    var rowData = ui.rowData;
                    if (permission > 3) {
                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class='btnDeleteW09F1101'><i class='fa fa-trash' style='color:#333'></i></a>";
                    }
                    return str;
                }
                ,
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var rowData = ui.rowData;

                    $cell.find(".btnEditW09F1100").bind("click", function (evt) {
                        showFormDialogPost('{{url("/W09F1101/$pForm/$g")}}', "modalW09F1101",
                            {
                                action: 'edit',
                                DutyID: rowData['DutyID']
                            }, null);
                    });
                    $cell.find(" .btnDeleteW09F1101").bind("click", function (ui) {
                        var count = 0;
                        $('#BtnNotSaveW09F1101').prop('disabled', false);
                        $("#gridW09F1101_2").pqGrid("deleteRow", {rowIndx: rowIndx});

                        var gridW09F110_data = $("#gridW09F1101_2").pqGrid("option", "dataModel.data");
                        for (i = 0; i < gridW09F110_data.length; i++) {
                            count += 1;
                            gridW09F110_data[i].OrderNo = count;
                        }
                        $("#gridW09F1101_2").pqGrid("option", "dataModel.data", gridW09F110_data);
                        $("#gridW09F1101_2").pqGrid('refreshDataAndView');
                    });
                },
            },
            {
                title: "{{Helpers::getRS($g,'STT')}}",
                dataType: "string",
                dataIndx: "OrderNo",
                align: 'center',
                maxWidth: 150,
                minWidth: 50,
                Width: 100,
                align: "center",
                editable: true,
                editor: false,
                hidden: false,
            },
            {
                title: "{{Helpers::getRS($g,'Ma')}}",
                dataType: "string",
                dataIndx: "EvaluationElementID",
                minWidth: 50,
                width: 200,
                maxWidth: 300,
                align: "left",
                editable: true,
                hidden: false,
                editor: {
                    options: {{$cbo_Evaluation}},
                    type: "select",
                    valueIndx: "EvaluationElementID",
                    labelIndx: "EvaluationElementName",
                    init: function (ui) {
                        ui.$cell.find("select").pqSelect({
                            singlePlaceholder: 'Chọn'
                        });
                        ui.$cell.find("select").change(function (evt) {
                            var rowdata = ui.rowData;
                            var rowIndx = ui.rowIndx;
                            var dataIndx = ui.dataIndx;
                            var ID = $(this).val();

                            $('#BtnNotSaveW09F1101').prop('disabled', false);
                            if (ID != '') {
                                var EvaluationElementID = $('#gridW09F1101_2').pqGrid("getColumn", {dataIndx: "EvaluationElementID"});
                                var dataCombo = EvaluationElementID.editor.options;
                                console.log(dataCombo);
                                var rowEvaluation = $.grep(dataCombo, function (d) {
                                    return d.EvaluationElementID == ID;
                                });
                                rowdata['EvaluationElementName'] = rowEvaluation[0]['EvaluationElementName'];
                                $('#gridW09F1101_2').pqGrid("refreshDataAndView");
                            }
                            else {
                                rowdata['EvaluationElementName'] = "";
                                $('#gridW09F1101_2').pqGrid("refreshDataAndView");
                            }
                        });
                    }
                },
            },
            {
                title: "{{Helpers::getRS($g,'Dien_giai')}}",
                dataType: "string",
                dataIndx: "EvaluationElementName",
                minWidth: 100,
                editable: false,
                editor: false,
                width: 350,
                maxWidth: 400,
                align: "left",
                hidden: false,
            },
            {
                title: "{{Helpers::getRS($g,'Ghi_chu')}}",
                dataType: "string",
                dataIndx: "Note",
                minWidth: 50,
                width: 500,
                maxWidth: 500,
                align: "left",
                hidden: false,
                editable: true,
            },
        ];
        obj2.dataModel = {
            data: {{$Tab_Grid2}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        };
        $("#gridW09F1101_2").pqGrid(obj2);
        setTimeout(function () {
            $("#gridW09F1101_2").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#gridW09F1101_2").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            $("#gridW09F1101_2").pqGrid("refreshDataAndView");
        }, 300)
    }

    function loadGridW09F1101_3() {
        var obj2 = {
            width: '100%',
            flexHeight: true,
            selectionModel: {type: 'row', mode: 'single'},
            minWidth: 30,
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'auto'},
            showTitle: false,
            dataType: "JSON",
            wrap: false,
            hwrap: false,
            collapsible: false,
            postRenderInterval: -1,
            toolbar: {
                items: [
                    {
                        type: 'button',
                        label: '{{Helpers::getRS($g,'Them')}}',
                        icon: 'ui-icon-plus',
                        listener: function (ui) {
                            $('#BtnNotSaveW09F1101').prop('disabled', false);
                            var grid_lenght = $("#gridW09F1101_3").pqGrid('option', "dataModel.data").length;
                            $("#gridW09F1101_3").pqGrid('addRow', {
                                newRow: {OrderNo: grid_lenght + 1},
                                rowIndx: grid_lenght + 1
                            });


                        }
                    },

                ]
            },
            editable: function (ui) {
                if ('{{$Action}}' != 'view') {
                    return true;
                }
                else {
                    return false;
                }
            },
            pageModel: {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]},
            numberCell: {show: false},
        };
        obj2.colModel = [
            {

                title: "{{Helpers::getRS($g,'Xu_ly')}}",
                align: "center",
                dataIndx: "View",
                isExport: false,
                editor: false,
                editable: false,
                sortable: false,
                maxWidth: 100,
                minWidth: 50,
                Width: 50,
                @if($Action!='view')
                hidden: false,
                @else
                hidden: true,
                @endif
                render: function (ui) {
                    var str = "";
                    var rowData = ui.rowData;
                    if (permission > 3) {
                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class='btnDeleteW09F1101'><i class='fa fa-trash' style='color:#333'></i></a>";
                    }
                    return str;
                }
                ,
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var rowData = ui.rowData;

                    $cell.find(".btnEditW09F1100").bind("click", function (evt) {
                        showFormDialogPost('{{url("/W09F1101/$pForm/$g")}}', "modalW09F1101",
                            {
                                action: 'edit',
                                DutyID: rowData['DutyID']
                            }, null);
                    });
                    $cell.find(" .btnDeleteW09F1101").bind("click", function (ui) {
                        var count = 0;
                        $('#BtnNotSaveW09F1101').prop('disabled', false);
                        $("#gridW09F1101_3").pqGrid("deleteRow", {rowIndx: rowIndx});

                        var gridW09F110_data = $("#gridW09F1101_3").pqGrid("option", "dataModel.data");
                        for (i = 0; i < gridW09F110_data.length; i++) {
                            count += 1;
                            gridW09F110_data[i].OrderNo = count;
                        }
                        $("#gridW09F1101_3").pqGrid("option", "dataModel.data", gridW09F110_data);
                        $("#gridW09F1101_3").pqGrid('refreshDataAndView');
                    });
                },
            },
            {
                title: "{{Helpers::getRS($g,'STT')}}",
                dataType: "string",
                dataIndx: "OrderNo",
                align: 'center',
                maxWidth: 150,
                minWidth: 50,
                Width: 100,
                align: "center",
                editable: true,
                editor: false,
                hidden: false,
            },
            {
                title: "{{Helpers::getRS($g,'Ma')}}",
                dataType: "string",
                dataIndx: "EvaluationElementID",
                minWidth: 50,
                width: 200,
                maxWidth: 300,
                align: "left",
                editable: true,
                hidden: false,
                editor: {
                    options: {{$cbo_Evaluation}},
                    type: "select",
                    valueIndx: "EvaluationElementID",
                    labelIndx: "EvaluationElementName",
                    init: function (ui) {
                        ui.$cell.find("select").pqSelect({
                            singlePlaceholder: 'Chọn'
                        });
                        ui.$cell.find("select").change(function (evt) {
                            var rowdata = ui.rowData;
                            var rowIndx = ui.rowIndx;
                            var dataIndx = ui.dataIndx;
                            var ID = $(this).val();

                            $('#BtnNotSaveW09F1101').prop('disabled', false);
                            if (ID != '') {
                                var EvaluationElementID = $('#gridW09F1101_3').pqGrid("getColumn", {dataIndx: "EvaluationElementID"});
                                var dataCombo = EvaluationElementID.editor.options;
                                console.log(dataCombo);
                                var rowEvaluation = $.grep(dataCombo, function (d) {
                                    return d.EvaluationElementID == ID;
                                });
                                rowdata['EvaluationElementName'] = rowEvaluation[0]['EvaluationElementName'];
                                $('#gridW09F1101_3').pqGrid("refreshDataAndView");
                            }
                            else {
                                rowdata['EvaluationElementName'] = "";
                                $('#gridW09F1101_3').pqGrid("refreshDataAndView");
                            }
                        });
                    }
                },
            },
            {
                title: "{{Helpers::getRS($g,'Dien_giai')}}",
                dataType: "string",
                dataIndx: "EvaluationElementName",
                minWidth: 100,
                editable: false,
                editor: false,
                width: 350,
                maxWidth: 400,
                align: "left",
                hidden: false,
            },
            {
                title: "{{Helpers::getRS($g,'Ghi_chu')}}",
                dataType: "string",
                dataIndx: "Note",
                minWidth: 50,
                width: 500,
                maxWidth: 500,
                align: "left",
                hidden: false,
                editable: true,
            },
        ];
        obj2.dataModel = {
            data: {{$Tab_Grid3}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        };
        $("#gridW09F1101_3").pqGrid(obj2);
        setTimeout(function () {
            $("#gridW09F1101_3").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#gridW09F1101_3").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            $("#gridW09F1101_3").pqGrid("refreshDataAndView");
        }, 300)
    }

    // reload 1st Grid W09F1100, set selection 1st row and append data to the form
    $('#modalW09F1101').on('hidden.bs.modal', function (ui) {
        $.ajax({
            method: "POST",
            data: '',
            url: "{{url("/W09F1100/".$pForm."/$g/reloadGrid")}}",
            success: function (data) {
                $("#gridW09F1100").pqGrid("option", "dataModel.data", data);
                $("#gridW09F1100").pqGrid("refreshDataAndView");
                disableViewW09F1100();
                var data = $("#gridW09F1100").pqGrid('option', "dataModel.data");
                if (data.length > 0) {
                    $("#gridW09F1100").pqGrid("setSelection", {rowIndx: 0});
                    append_data(data[0].DutyID, data[0].DutyName);
                    Duty_id = data[0].DutyID;
                    Duty_name = data[0].DutyName;
                }


            }
        });

    })

    // Show alert if call from W09F1100 by EDIT
    function funcLoseModalW09F1101() {
        if ('{{$Action}}' == 'edit' && !$('#BtnSaveW09F1101').prop('disabled')) {
            alert_custom(icon_ask, "{{Helpers::getRS($g, 'Ban_co_muon_dong_khong')}}", true, true, function () {
                $('#modalW09F1101').modal('hide');
            });

        }
        else {
            $('#modalW09F1101').modal('hide');


        }
    }

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {//refresh luoi khi chon dung tab
        var target = $(e.target).closest(".nav-tabs-custom").find(".tab-content");
        var target = $(target).find("div.active");
        var id = $(target).attr("id");
        console.log(id);

        switch (id) {
            case "tab_3_1":
                $("#gridW09F1101").pqGrid("refreshDataAndView");
                break;
            case "tab_3_2":
                $("#gridW09F1101_2").pqGrid("refreshDataAndView");
                break;
            case "tab_3_3":
                $("#gridW09F1101_3").pqGrid("refreshDataAndView");
                break;
        }
        //$(gridID).pqGrid("refreshDataAndView");
    });

    function loadGrid() {
        //console.log('sdsdsd');
        setTimeout(function () {
            $("#gridW09F1101").pqGrid("refreshDataAndView");
            $("#gridW09F1101_2").pqGrid("refreshDataAndView");
            $("#gridW09F1101_3").pqGrid("refreshDataAndView");
        }, 300)
    }
    
</script>
