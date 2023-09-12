<div class="modal fade draggable" id="modalW17F1011" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width:96%;">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading(Helpers::getRS($g,"Cap_nhat_cong_ty"),"W17F1011")}}
            </div>
            <?php

            ?>
            <?php
            if (isset($task)) {
                switch ($task) {
                    case 'add':
                        \Debugbar::info("No data.");
                        $txtCompanyIDW17F1011 = $dsKey["ID"];
                        $statusKey = intval($dsKey["Status"]);
                        $txtCompanyNameW17F1011 = '';
                        $optIsPersonW17F1011 = 0;

                        $dtpFindDateW17F1011 = date('d/m/Y');
                        $txtCompanyShortW17F1011 = '';
                        $chkDisabledW17F1011 = 0;
                        $cboCompanyKindIDW17F1011 = '';
                        $cboCompanyStatusW17F1011 = '';
                        $cboCaseSourceIDW17F1011 = '';
                        $cboCompanyGroupIDW17F1011 = '';
                        $cboGroupSalesIDW17F1011 = '';
                        $cboSalePersonIDW17F1011 = Auth::user()->user()->UserID;
                        $cboIndustryGroupIDW17F1011 = '';
                        $txtNotesW17F1011 = '';
                        $txtAddressIDW17F1011 = '';
                        $txtAddressLine1W17F1011 = '';
                        $txtTelNoW17F1011 = '';
                        $txtContactIDW17F1011 = '';
                        $txtFullNameW17F1011 = '';
                        $cboVocativeIDW17F1011 = '';
                        $txtMobileNoW17F1011 = '';
                        $cboContactPositionIDW17F1011 = '';
                        $chkisNewFindW17F101 = ($formCall == 'W17F1010' ? 0 : 1);
                        $cboProvinceIDW17F1011 = '';
                        $cboDistrictIDW17F1011 = '';
                        $cboWardIDW17F1011 = '';
                        $txtQuarterW17F1011 = '';
                        break;
                    case 'edit':
                    case 'view':
                        if (isset($rsData)) {
                            \Debugbar::info($rsData);
                            \Debugbar::info("got data");
                            $txtCompanyIDW17F1011 = $rsData["CompanyID"];
                            $txtCompanyNameW17F1011 = $rsData["CompanyName"];
                            $optIsPersonW17F1011 = $rsData["IsPerson"];
                            $dtpFindDateW17F1011 = $rsData["FindDate"];
                            $txtCompanyShortW17F1011 = $rsData["CompanyShort"];
                            $chkDisabledW17F1011 = $rsData["Disabled"];
                            $cboCompanyKindIDW17F1011 = $rsData["CompanyKindID"];
                            $cboCompanyStatusW17F1011 = $rsData["CompanyStatus"];
                            $cboCaseSourceIDW17F1011 = $rsData["CaseSourceID"];
                            $cboCompanyGroupIDW17F1011 = $rsData["CompanyGroupID"];
                            $cboGroupSalesIDW17F1011 = $rsData["GroupSalesID"];
                            $cboSalePersonIDW17F1011 = $rsData["SalesPersonID"];
                            $cboIndustryGroupIDW17F1011 = $rsData["IndustryGroupID"];
                            $txtNotesW17F1011 = $rsData["Notes"];
                            $txtAddressIDW17F1011 = $rsData["AddressID"];
                            $txtAddressLine1W17F1011 = $rsData["AddressLine1"];
                            $txtTelNoW17F1011 = $rsData["TelNo"];
                            $txtContactIDW17F1011 = $rsData["ContactID"];
                            $txtFullNameW17F1011 = $rsData["FullName"];
                            $cboVocativeIDW17F1011 = $rsData["VocativeID"];
                            $txtMobileNoW17F1011 = $rsData["MobileNo"];
                            $cboContactPositionIDW17F1011 = $rsData["ContactPositionID"];
                            $chkisNewFindW17F101 = $rsData["IsNewFind"];
                            $cboProvinceIDW17F1011 = $rsData["ProvinceID"];
                            $cboDistrictIDW17F1011 = $rsData["DistrictID"];
                            $cboWardIDW17F1011 = $rsData["WardID"];
                            $txtQuarterW17F1011 = $rsData["Quarter"];
                            \Debugbar::info($cboCompanyStatusW17F1011);
                        }else {
                            \Debugbar::info("No data.");
                            $txtCompanyIDW17F1011 = '';
                            $txtCompanyNameW17F1011 = '';
                            $optIsPersonW17F1011 = 0;
                            $dtpFindDateW17F1011 = date('d/m/Y');
                            $txtCompanyShortW17F1011 = '';
                            $chkDisabledW17F1011 = 0;
                            $cboCompanyKindIDW17F1011 = '';

                            $cboCompanyStatusW17F1011 = '';
                            $cboCaseSourceIDW17F1011 = '';
                            $cboCompanyGroupIDW17F1011 = '';
                            $cboGroupSalesIDW17F1011 = '';
                            $cboSalePersonIDW17F1011 = '';
                            $cboIndustryGroupIDW17F1011 = '';
                            $txtNotesW17F1011 = '';
                            $txtAddressIDW17F1011 = '';
                            $txtAddressLine1W17F1011 = '';
                            $txtTelNoW17F1011 = '';
                            $txtContactIDW17F1011 = '';
                            $txtFullNameW17F1011 = '';
                            $cboVocativeIDW17F1011 = '';
                            $txtMobileNoW17F1011 = '';
                            $cboContactPositionIDW17F1011 = '';
                            $cboProvinceIDW17F1011 = '';
                            $cboDistrictIDW17F1011 = '';
                            $cboWardIDW17F1011 = '';
                            $txtQuarterW17F1011 = '';
                        }
                        break;
                }

            }
            \Debugbar::info($cboCompanyStatusW17F1011);
            ?>


            <div id="divScrollbarW17F1011" class="modal-body">
                <div>
                    <form class="form-horizontal" id="frmW17F1011" name="frmW17F1011">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-md-2">
                                    <label class="liketext lbl-normal">{{Helpers::getRS($g,"Ma_khach_hang")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-5">
                                            <input type="text" id="txtCompanyIDW17F1011" name="txtCompanyIDW17F1011"
                                                   class="form-control " value="{{$txtCompanyIDW17F1011}}"
                                                   required disabled="disabled">
                                        </div>
                                        <div class="col-md-1 pdr0">
                                            <button type="button" id="btnCreateKeyW17F1011"
                                                    class="btn btn-default smallbtn pull-right"><span
                                                        class="fa fa-key"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label class="liketext lbl-normal">{{Helpers::getRS($g,"Ngay_lap")}}</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group date">
                                        <input type="text" class="form-control" id="dtpFindDateW17F1011"
                                               name="dtpFindDateW17F1011"
                                               value="{{$dtpFindDateW17F1011}}">
                                        <span class="input-group-addon"><i onclick="triggerDateW17F1011()"
                                                                           class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                                @if ($task != 'add')
                                    <div class="checkbox col-md-1" style="padding-top: 4px;">
                                        <label>
                                            <input type="checkbox" id="chkDisabledW17F1011" name="chkDisabledW17F1011"
                                                    {{$chkDisabledW17F1011 == 1? 'checked': '' }} > {{Helpers::getRS($g,"KSD")}}
                                        </label>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="col-md-2">
                                    <label class="liketext lbl-normal">{{Helpers::getRS($g,"Ten_khach_hang")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" id="txtCompanyNameW17F1011" name="txtCompanyNameW17F1011"
                                           class="form-control " value="{{$txtCompanyNameW17F1011}}" autofocus
                                           required>
                                </div>
                                <div class="col-md-2">
                                    <label class="liketext lbl-normal">{{Helpers::getRS($g,"Ten_tat")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" id="txtCompanyShortW17F1011" name="txtCompanyShortW17F1011"
                                           class="form-control " value="{{$txtCompanyShortW17F1011}}"
                                    >
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-md-12">
                                    <div class="checkbox pull-right mgr15">
                                        <label>
                                            <input type="checkbox" id="chkisNewFindW17F1011"
                                                   name="chkisNewFindW17F1011"
                                                   disabled
                                                   {{$chkisNewFindW17F101 == 1 ? 'checked': ''}} value={{$chkisNewFindW17F101}}> {{Helpers::getRS($g,"Luot_tim_kiem_moi")}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <fieldset>
                                <legend class="legend">{{Helpers::getRS($g,"Thong_tin_cong_ty")}}</legend>
                                <div class="form-group">
                                    <div class="col-md-2">
                                        <label class="liketext lbl-normal">{{Helpers::getRS($g,"Phan_loai")}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="cboCompanyKindIDW17F1011" name="cboCompanyKindIDW17F1011"
                                                class="form-control"
                                                required>
                                            @foreach($dsCompanyKind as $rowDsCompanyKind)
                                                <option value="{{$rowDsCompanyKind['CompanyKindID']}}" {{$cboCompanyKindIDW17F1011 == $rowDsCompanyKind['CompanyKindID'] ? 'selected' : ''}}>{{$rowDsCompanyKind['CompanyKindName']}}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="liketext lbl-normal">{{Helpers::getRS($g,"Nhom_kinh_doanh")}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="cboGroupSalesIDW17F1011" name="cboGroupSalesIDW17F1011"
                                                class="form-control select2"
                                                style="width: 100%" required>
                                            @foreach($dsGroupSales as $rowDsGroupSales)
                                                <option value="{{$rowDsGroupSales['GroupSalesID']}}" {{$cboGroupSalesIDW17F1011 == $rowDsGroupSales['GroupSalesID'] ? 'selected' : ''}}>{{$rowDsGroupSales['GroupSalesName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-2">
                                        <label class="liketext lbl-normal">{{Helpers::getRS($g,"Trang_thai")}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="cboCompanyStatusW17F1011" name="cboCompanyStatusW17F1011"
                                                class="form-control" required>
                                            @foreach($dsCompanyStatus as $rowDsCompanyStatus)
                                                <option value="{{$rowDsCompanyStatus['ItemID']}}" {{$cboCompanyStatusW17F1011 == $rowDsCompanyStatus['ItemID'] ? 'selected' : ''}}>{{$rowDsCompanyStatus['Description']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="liketext lbl-normal">{{Helpers::getRS($g,"Nhan_vien")}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="cboSalePersonIDW17F1011" name="cboSalePersonIDW17F1011"
                                                class="form-control"
                                                required>
                                            @foreach($dsSalesPerson as $rowDsSalesPerson)
                                                <option value="{{$rowDsSalesPerson['SalesPersonID']}}" {{$cboSalePersonIDW17F1011 == $rowDsSalesPerson['SalesPersonID'] ? 'selected' : ''}}>{{$rowDsSalesPerson['SalesPersonName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-2">
                                        <label class="liketext lbl-normal">{{Helpers::getRS($g,"Nguon_goc")}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="cboCaseSourceIDW17F1011" name="cboCaseSourceIDW17F1011"
                                                class="form-control" required>
                                            @foreach($dsCaseSource as $rowDsCaseSource)
                                                <option value="{{$rowDsCaseSource['CaseSourceID']}}" {{$cboCaseSourceIDW17F1011 == $rowDsCaseSource['CaseSourceID'] ? 'selected' : ''}}>{{$rowDsCaseSource['CaseSourceName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="liketext lbl-normal">{{Helpers::getRS($g,"Phong_ban")}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="cboIndustryGroupIDW17F1011" name="cboIndustryGroupIDW17F1011"
                                                class="form-control" required>
                                            @foreach($dsLeadIndustryGroup as $rowDsLeadIndustryGroup)
                                                <option value="{{$rowDsLeadIndustryGroup['LeadIndustryGroupID']}}" {{$cboIndustryGroupIDW17F1011 == $rowDsLeadIndustryGroup['LeadIndustryGroupID'] ? 'selected' : ''}}>{{$rowDsLeadIndustryGroup['LeadIndustryGroupName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{--$dsCompanyStatus $dsCaseSource $dsCompanyGroup
                                            $dsGroupSales $dsSalesPerson $dsLeadIndustryGroup $dsVocative $dsContactPosition--}}
                                <div class="form-group">
                                    <div class="col-md-2">
                                        <label class="liketext lbl-normal">{{Helpers::getRS($g,"Nhom_khach_hang")}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="cboCompanyGroupIDW17F1011" name="cboCompanyGroupIDW17F1011"
                                                class="form-control"
                                                required>
                                            @foreach($dsCompanyGroup as $rowDsCompanyGroup)
                                                <option value="{{$rowDsCompanyGroup['CompanyGroupID']}}" {{$cboCompanyGroupIDW17F1011 == $rowDsCompanyGroup['CompanyGroupID'] ? 'selected' : ''}}>{{$rowDsCompanyGroup['CompanyGroupName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="liketext lbl-normal">{{Helpers::getRS($g,"Ghi_chu")}}</label>
                                    </div>
                                    <div class="col-md-4">
                        <textarea class="form-control" id="txtNotesW17F1011" rows="4"
                                  name="txtNotesW17F1011">{{$txtNotesW17F1011}}</textarea>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend class="legend">{{Helpers::getRS($g,"Dia_chi")}}</legend>
                                <div class="form-group">
                                    <div class="col-md-2">
                                        <label class="liketext lbl-normal">{{Helpers::getRS($g,"TinhThanh_pho")}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="cboProvinceIDW17F1011" name="cboProvinceIDW17F1011"
                                                class="form-control"
                                                required>
                                            @foreach($dsProvinces as $rowDsProvinces)
                                                <option value="{{$rowDsProvinces['ProvinceID']}}" {{$cboProvinceIDW17F1011 == $rowDsProvinces['ProvinceID'] ? 'selected' : ''}}>{{$rowDsProvinces['ProviceName']}}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="liketext lbl-normal">{{Helpers::getRS($g,"QuanHuyen")}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="cboDistrictIDW17F1011" name="cboDistrictIDW17F1011"
                                                class="form-control"
                                                style="width: 100%" required>
                                            @foreach($dsDistricts as $rowDsDistricts)
                                                <option value="{{$rowDsDistricts['DistrictID']}}" {{$cboDistrictIDW17F1011 == $rowDsDistricts['DistrictID'] ? 'selected' : ''}}>{{$rowDsDistricts['DistrictName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-2">
                                        <label class="liketext lbl-normal">{{Helpers::getRS($g,"XaPhuong")}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="cboWardIDW17F1011" name="cboWardIDW17F1011"
                                                class="form-control"
                                                required>
                                            @foreach($dsWards as $rowDsWards)
                                                <option value="{{$rowDsWards['WardID']}}" {{$cboWardIDW17F1011 == $rowDsWards['WardID'] ? 'selected' : ''}}>{{$rowDsWards['WardName']}}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="liketext lbl-normal">{{Helpers::getRS($g,"ApKhu_pho")}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="txtQuarterW17F1011" name="txtQuarterW17F1011"
                                               class="form-control " value="{{$txtQuarterW17F1011}}"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-2">
                                        <label class="liketext lbl-normal">{{Helpers::getRS($g,"Dien_thoai")}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="txtTelNoW17F1011" name="txtTelNoW17F1011" maxlength="16"
                                               class="form-control " value="{{$txtTelNoW17F1011}}" required
                                        >
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend class="legend">{{Helpers::getRS($g,"Nguoi_lien_he")}}</legend>


                                <div class="form-group">
                                    <div class="col-md-2">
                                        <label class="liketext lbl-normal">{{Helpers::getRS($g,"Ho_va_ten")}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="txtFullNameW17F1011" name="txtFullNameW17F1011"
                                               class="form-control " value="{{$txtFullNameW17F1011}}"
                                        >
                                    </div>
                                    <div class="col-md-2">
                                        <label class="liketext lbl-normal">{{Helpers::getRS($g,"Xung_ho")}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="cboVocativeIDW17F1011" name="cboVocativeIDW17F1011"
                                                class="form-control">
                                            <option value=""></option>
                                            @foreach($dsVocative as $rowDsVocative)
                                                <option value="{{$rowDsVocative['ID']}}" {{$cboVocativeIDW17F1011 == $rowDsVocative['ID'] ? 'selected' : ''}}>{{$rowDsVocative['Name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-2">
                                        <label class="liketext lbl-normal">Mobile</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="txtMobileNoW17F1011" name="txtMobileNoW17F1011"
                                               class="form-control " value="{{$txtMobileNoW17F1011}}" maxlength="16"
                                        >
                                    </div>
                                    <div class="col-md-2">
                                        <label class="liketext lbl-normal">{{Helpers::getRS($g,"Chuc_vu")}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="cboContactPositionIDW17F1011" name="cboContactPositionIDW17F1011"
                                                class="form-control">
                                            @foreach($dsContactPosition as $rowDsContactPosition)
                                                <option value="{{$rowDsContactPosition['ContactPositionID']}}" {{$cboContactPositionIDW17F1011 == $rowDsContactPosition['ContactPositionID'] ? 'selected': ''}}>{{$rowDsContactPosition['ContactPositionName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class=" {{$task == "view" ? "" : "box-footer"}}">

                            @if ($task == 'add')
                                <button type="button" id="btnNextW17F1011"
                                        class="btn btn-default smallbtn pull-right">
                                    <span class="glyphicon glyphicon-more-items mgr5"></span> {{Helpers::getRS($g,"Nhap_tiep")}}
                                </button>
                                <button type="button" id="btnSaveW17F1011"
                                        class="btn btn-default smallbtn pull-right mgr10"><span
                                            class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                                </button>
                            @endif
                            @if ($task == 'edit')
                                <button type="button" id="btnCancelW17F1011"
                                        class="btn btn-default smallbtn pull-right">
                                    <span class="glyphicon glyphicon-floppy-remove mgr5"></span> {{Helpers::getRS($g,"Khong_luu")}}
                                </button>
                                <button type="button" id="btnSaveW17F1011"
                                        class="btn btn-default smallbtn pull-right mgr10"><span
                                            class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                                </button>
                            @endif

                            {{--<button type="button" id="btnViewMoreW17F1011"--}}
                                    {{--class="btn btn-default smallbtn pull-right mgr10 hide" data-toggle="collapse"--}}
                                    {{--data-target="#divMoreW17F1011"><span--}}
                                        {{--class="fa fa-chevron-down  mgr5"></span>Thiết lập thông tin đặc thù--}}

                            {{--</button>--}}
                            <button id="btnSubmitW17F1011" class="hide">
                            </button>
                        </div>
                    </form>

                    <div>
                        <fieldset class="flw100pc">
                            <form class="form-horizontal pd10" id="frmCriterialW17F1011"
                                  name="frmCriterialW17F1011">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <legend class="legend">{{Helpers::getRS($g,"Chi_tieu_theo_nhom_Cong_ty")}}</legend>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div id="gridW17F1011"></div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        {{--<button type="button" id="btnNotSave2W17F1011"--}}
                                                {{--class="btn btn-default smallbtn pull-right"><span--}}
                                                    {{--class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Khong_luu")}}--}}
                                        {{--</button>--}}
                                        {{--<button type="button" id="btnSave2W17F1011"--}}
                                                {{--class="btn btn-default smallbtn pull-right mgr10 hide"><span--}}
                                                    {{--class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}--}}
                                        {{--</button>--}}
                                    </div>

                                </div>
                            </form>
                        </fieldset>
                    </div>

                    <div>
                        <fieldset class="flw100pc">
                            {{--<legend class="legend">{{Helpers::getRS($g,"Thong_tin_bo_sung")}}</legend>--}}
                            <form class="form-horizontal pd10" id="frmExtraW17F1011" name="frmExtraW17F1011">
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <legend class="legend">{{Helpers::getRS($g,"Thong_tin_bo_sung")}}</legend>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <div id="grid2W17F1011"></div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        {{--<button type="button" id="btnNotSave3W17F1011"--}}
                                                {{--class="btn btn-default smallbtn pull-right"><span--}}
                                                    {{--class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Khong_luu")}}--}}
                                        {{--</button>--}}
                                        {{--<button type="button" id="btnSave3W17F1011"--}}
                                                {{--class="btn btn-default smallbtn pull-right mgr10 hide"><span--}}
                                                    {{--class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}--}}
                                        {{--</button>--}}
                                    </div>

                                </div>
                            </form>
                        </fieldset>
                    </div>

                    {{--<div id="divMoreW17F1011" class="collapse">--}}
                        {{----}}
                    {{--</div>--}}
                    <div class="modal-footer">
                        <div class="alert alert-success alert-dismissable hide">
                            <i class="icon fa fa-check"></i> {{Helpers::getRS($g,"Du_lieu_da_duoc_luu_thanh_cong")}}
                        </div>
                        <div class="alert alert-danger alert-dismissable hide">
                            <i class="icon fa fa-ban"></i> <span
                                    id="err">{{Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu")}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var taskW17F1011 = "{{$task}}";
    //alert(taskW17F1011);
    var rowDataW17F1011 = {};
    var itemsCombo = {{json_encode($valuesComboVL)}};
    var tempValueGrid1 = {{json_encode($dsCriterial)}};
    var tempValueGrid2 = {{json_encode($Extrainformation)}};

    /////
    var listDistricts = {{ json_encode($dsDistricts)  }};
    var listWards = {{ json_encode($dsWards) }};

    var suggestCustomers = {{ json_encode($suggestCustomers) }};

    if (taskW17F1011 != 'add') {
        rowDataW17F1011 = JSON.parse('{{json_encode(isset($rsData) ? $rsData : [])}}');
    }

    $(document).ready(function () {

        $('#txtCompanyNameW17F1011').autoComplete({
            source: function(term, response) {
                term = term.toLowerCase();
                var choices = suggestCustomers;
                var matches = [];
                for (i=0; i<choices.length; i++)
                    if (~choices[i].CompanyName.toLowerCase().indexOf(term)) matches.push(choices[i].CompanyName);
                response(matches);
            }
        });

        $("#divScrollbarW17F1011").height($(document).height() - 140);
        $("#divScrollbarW17F1011").css('overflow-y', 'auto');
        $("#divScrollbarW17F1011").css('overflow-x', 'hidden');
        /*$("#divScrollbarW17F1011").mCustomScrollbar(
            {
                axis: "y",
                theme: "3d-thick",
                scrollButtons: {enable: true},
                autoExpandScrollbar: true,
                advanced: {autoExpandHorizontalScroll: true},
                scrollInertia: 100,
                //scrollbarPosition:"outside"
            });*/


        //$('#test').bootstrapToggle('on');
        $('#dtpFindDateW17F1011').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        /*$('#txtTelNoW17F1011, #txtMobileNoW17F1011').inputmask("numeric", {
            radixPoint: "",
            groupSeparator: "",
            digits: 0,
            autoGroup: false,
            //prefix: '$', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () {
                self.Value('');
            }
        });*/
        $("#cboGroupSalesIDW17F1011").select2({
            containerCssClass: "required"
        });
        $("#cboCompanyGroupIDW17F1011").select2({
            containerCssClass: "required"
        });
        $("#cboSalePersonIDW17F1011").select2({
            containerCssClass: "required"
        });
        $("#cboCompanyKindIDW17F1011").select2({
            containerCssClass: "required"
        });
        $("#cboCompanyStatusW17F1011,#cboCaseSourceIDW17F1011,#cboIndustryGroupIDW17F1011").select2({
            containerCssClass: "required"
        });
        $("#cboProvinceIDW17F1011, #cboDistrictIDW17F1011, #cboWardIDW17F1011").select2({
            containerCssClass: "required"
        });

        setEnableControl(taskW17F1011);

        $('#cboProvinceIDW17F1011').on('change', function() {
            var provinceID = $(this).val();
            var districts = $.grep(listDistricts, function(dis) {
                return dis.ItemParent == provinceID;
            });
            var options = '';
            $.each(districts, function(i, dis) {
                options += '<option value="'+ dis.DistrictID +'">'+ dis.DistrictName +'</option>';
            });
            $('#cboDistrictIDW17F1011').html(options);
            $('#cboDistrictIDW17F1011').trigger('change');
        });

        $('#cboDistrictIDW17F1011').on('change', function() {
            var districtID = $(this).val();
            var wards = $.grep(listWards, function(ward) {
                return ward.ItemParent == districtID;
            });
            var options = '';
            $.each(wards, function(i, ward) {
                options += '<option value="'+ ward.WardID +'">'+ ward.WardName +'</option>';
            });
            $('#cboWardIDW17F1011').html(options);
        });
    });

    //$("chkIsNewFindW17F1011").click(func);

    function triggerDateW17F1011() {
        if (taskW17F1011 != 'view') {
            $('#dtpFindDateW17F1011').datepicker('show');
        }
    }

    function resetValue(rsData) {
        $("#txtCompanyIDW17F1011").val(rsData["CompanyID"]);
        $("#txtCompanyNameW17F1011").val(rsData["CompanyName"]);
        //alert(Number(rsData["IsPerson"]));
        if (Number(rsData["IsPerson"]) == 0) {
            $("#optIsOrganizeW17F1011").prop('checked', true);


        } else {
            $("#optIsPersonW17F1011").prop('checked', true);
        }
        $("#dtpFindDateW17F1011").val(rsData["FindDate"]);
        $("#txtCompanyShortW17F1011").val(rsData["CompanyShort"]);
        $("#chkDisabledW17F1011").val(rsData["Disabled"]);
        $("#cboCompanyKindIDW17F1011").val(rsData["CompanyKindID"]);
        $("#cboCompanyStatusW17F1011").val(rsData["CompanyStatus"]);
        $("#cboCaseSourceIDW17F1011").val(rsData["CaseSourceID"]);
        $("#cboCompanyGroupIDW17F1011").val(rsData["CompanyGroupID"]);
        $("#cboGroupSalesIDW17F1011").val(rsData["GroupSalesID"]);
        $("#cboSalePersonIDW17F1011").val(rsData["SalesPersonID"]);
        $("#cboIndustryGroupIDW17F1011").val(rsData["IndustryGroupID"]);
        $("#txtAddressIDW17F1011").val(rsData["AddressID"]);
        $("#txtAddressLine1W17F1011").val(rsData["AddressLine1"]);
        $("#txtTelNoW17F1011").val(rsData["TelNo"]);
        $("#txtContactIDW17F1011").val(rsData["ContactID"]);
        $("#txtFullNameW17F1011").val(rsData["FullName"]);
        $("#cboVocativeIDW17F1011").val(rsData["VocativeID"]);
        $("#txtMobileNoW17F1011").val(rsData["MobileNo"]);
        $("#cboContactPositionIDW17F1011").val(rsData["ContactPositionID"]);
        $("#txtNotesW17F1011").val(rsData["Notes"]);
        $("#chkDisabledW17F1011").prop("checked", rsData["Disabled"]);

        $("#cboProvinceIDW17F1011").val(rsData["ProvinceID"]);
        $("#cboDistrictIDW17F1011").val(rsData["DistrictID"]);
        $("#cboWardIDW17F1011").val(rsData["WardID"]);
        $("#txtQuarterW17F1011").val(rsData["Quarter"]);
    }

    function setEnableControl(task) {
        switch (task) {
            case 'add':
                $("#txtCompanyIDW17F1011").prop('disabled', false);
                if ('{{isset($statusKey) ? $statusKey : 1}}' == 1) {
                    $("#txtCompanyIDW17F1011").prop('disabled', true);
                }
                $("#btnCreateKeyW17F1011").prop("disabled", false);
                $("#txtCompanyNameW17F1011").prop('disabled', false);
                $("#optIsPersonW17F1011").prop('disabled', false);
                $("#optIsOrganizeW17F1011").prop('disabled', false);
                $("#dtpFindDateW17F1011").prop('disabled', false);
                $("#txtCompanyShortW17F1011").prop('disabled', false);
                $("#chkDisabledW17F1011").prop('disabled', false);
                $("#cboCompanyKindIDW17F1011").prop('disabled', false);
                $("#cboCompanyStatusW17F1011").prop('disabled', false);
                $("#cboCaseSourceIDW17F1011").prop('disabled', false);
                $("#cboCompanyGroupIDW17F1011").prop('disabled', false);
                $("#cboGroupSalesIDW17F1011").prop('disabled', false);
                $("#cboSalePersonIDW17F1011").prop('disabled', false);
                $("#cboIndustryGroupIDW17F1011").prop('disabled', false);
                $("#txtAddressIDW17F1011").prop('disabled', false);
                $("#txtAddressLine1W17F1011").prop('disabled', false);
                $("#txtTelNoW17F1011").prop('disabled', false);
                $("#txtContactIDW17F1011").prop('disabled', false);
                $("#txtFullNameW17F1011").prop('disabled', false);
                $("#cboVocativeIDW17F1011").prop('disabled', true);
                $("#txtMobileNoW17F1011").prop('disabled', true);
                $("#cboContactPositionIDW17F1011").prop('disabled', true);

                $("#cboProvinceIDW17F1011").prop('disabled', false);
                $("#cboDistrictIDW17F1011").prop('disabled', false);
                $("#cboWardIDW17F1011").prop('disabled', false);
                $("#txtQuarterW17F1011").prop('disabled', false);

                $("#txtNotesW17F1011").prop('disabled', false);
                $("#btnCancelW17F1011").prop('disabled', false);
                $("#btnSaveW17F1011").prop('disabled', false);
                $("#btnNextW17F1011").prop('disabled', true);
                $("#txtCompanyNameW17F1011").focus();

                $("#btnSave2W17F1011").removeClass("hide");
                $("#btnNotSave2W17F1011").removeClass("hide");
                $("#btnSave3W17F1011").removeClass("hide");
                $("#btnNotSave3W17F1011").removeClass("hide");
                console.log($("#btnSave2W17F1011"));
                break;
            case 'view':
                $("#txtCompanyIDW17F1011").prop('disabled', true);
                $("#btnCreateKeyW17F1011").prop("disabled", true);
                $("#txtCompanyNameW17F1011").prop('disabled', true);
                $("#optIsPersonW17F1011").prop('disabled', true);
                $("#optIsOrganizeW17F1011").prop('disabled', true);
                $("#dtpFindDateW17F1011").prop('disabled', true);
                $("#txtCompanyShortW17F1011").prop('disabled', true);
                $("#chkDisabledW17F1011").prop('disabled', true);
                $("#cboCompanyKindIDW17F1011").prop('disabled', true);
                $("#cboCompanyStatusW17F1011").prop('disabled', true);
                $("#cboCaseSourceIDW17F1011").prop('disabled', true);
                $("#cboCompanyGroupIDW17F1011").prop('disabled', true);
                $("#cboGroupSalesIDW17F1011").prop('disabled', true);
                $("#cboSalePersonIDW17F1011").prop('disabled', true);
                $("#cboIndustryGroupIDW17F1011").prop('disabled', true);
                $("#txtAddressIDW17F1011").prop('disabled', true);
                $("#txtAddressLine1W17F1011").prop('disabled', true);
                $("#txtTelNoW17F1011").prop('disabled', true);
                $("#txtContactIDW17F1011").prop('disabled', true);
                $("#txtFullNameW17F1011").prop('disabled', true);
                $("#cboVocativeIDW17F1011").prop('disabled', true);
                $("#txtMobileNoW17F1011").prop('disabled', true);
                $("#cboContactPositionIDW17F1011").prop('disabled', true);

                $("#cboProvinceIDW17F1011").prop('disabled', true);
                $("#cboDistrictIDW17F1011").prop('disabled', true);
                $("#cboWardIDW17F1011").prop('disabled', true);
                $("#txtQuarterW17F1011").prop('disabled', true);

                $("#txtNotesW17F1011").prop('disabled', true);
                $("#btnCancelW17F1011").prop('disabled', true);
                $("#btnSaveW17F1011").prop('disabled', true);
                $("#chkDisabledW17F1011").prop('disabled', true);
                $("#btnNextW17F1011").prop('disabled', false);
                //$("#btnSave3W17F1011").prop('disabled', true);
                //$("#btnSave2W17F1011").prop('disabled', true);
                //$("#btnNotSave2W17F1011").prop('disabled', true);
                //$("#btnNotSave3W17F1011").prop('disabled', true);
                $("#btnViewMoreW17F1011").removeClass("hide");
                $("#btnSave2W17F1011").addClass("hide");
                $("#btnNotSave2W17F1011").addClass("hide");
                $("#btnSave3W17F1011").addClass("hide");
                $("#btnNotSave3W17F1011").addClass("hide");
                break;
            case 'edit':
                $("#txtCompanyIDW17F1011").prop('disabled', true);
                $("#btnCreateKeyW17F1011").prop("disabled", true);
                $("#txtCompanyNameW17F1011").prop('disabled', false);
                $("#optIsPersonW17F1011").prop('disabled', false);
                $("#optIsOrganizeW17F1011").prop('disabled', false);
                $("#dtpFindDateW17F1011").prop('disabled', false);
                $("#txtCompanyShortW17F1011").prop('disabled', false);
                $("#chkDisabledW17F1011").prop('disabled', false);
                $("#cboCompanyKindIDW17F1011").prop('disabled', false);
                $("#cboCompanyStatusW17F1011").prop('disabled', false);
                $("#cboCaseSourceIDW17F1011").prop('disabled', false);
                $("#cboCompanyGroupIDW17F1011").prop('disabled', false);
                $("#cboGroupSalesIDW17F1011").prop('disabled', false);
                $("#cboSalePersonIDW17F1011").prop('disabled', false);
                $("#cboIndustryGroupIDW17F1011").prop('disabled', false);
                $("#txtAddressIDW17F1011").prop('disabled', false);


                $("#txtAddressLine1W17F1011").prop('disabled', false);
                $("#txtTelNoW17F1011").prop('disabled', false);
                $("#txtContactIDW17F1011").prop('disabled', false);


                $("#txtFullNameW17F1011").prop('disabled', false);
                $("#cboVocativeIDW17F1011").prop('disabled', $("#txtFullNameW17F1011").val() == "");
                $("#txtMobileNoW17F1011").prop('disabled', $("#txtFullNameW17F1011").val() == "");
                $("#cboContactPositionIDW17F1011").prop('disabled', $("#txtFullNameW17F1011").val() == "");

                $("#cboProvinceIDW17F1011").prop('disabled', false);
                $("#cboDistrictIDW17F1011").prop('disabled', false);
                $("#cboWardIDW17F1011").prop('disabled', false);
                $("#txtQuarterW17F1011").prop('disabled', false);

                $("#txtNotesW17F1011").prop('disabled', false);
                $("#btnCancelW17F1011").prop('disabled', false);
                $("#btnSaveW17F1011").prop('disabled', false);
                $("#chkDisabledW17F1011").prop('disabled', false);
                $("#txtCompanyNameW17F1011").focus();
                $("#btnViewMoreW17F1011").removeClass("hide");

                break;
            default:
                break;
        }
    }


    /* $("#txtAddressLine1W17F1011").keyup(function () {
         var val = $(this).val();
         $("#txtTelNoW17F1011").prop("disabled", val == '');
     });*/
    $("#txtFullNameW17F1011").keyup(function () {
        var val = $(this).val();
        $("#cboVocativeIDW17F1011").prop("disabled", val == '');
        $("#txtMobileNoW17F1011").prop("disabled", val == '');
        $("#cboContactPositionIDW17F1011").prop("disabled", val == '');
    });

    $("#btnCreateKeyW17F1011").click(function () {
        if (taskW17F1011 == 'add') {
            postMethod('{{url("/W17F1011/".$pForm."/$g/getkey")}}', function (data) {
                if (data != null) {
                    $("#txtCompanyIDW17F1011").prop('disabled', data.Status == 1);
                    $("#txtCompanyIDW17F1011").val(data.ID);
                } else {
                    console.log("No return data.");
                }

            }, {});
        }

    });

    function checkSaveGrid(e) {

        var $grid = $("#gridW17F1011");
        var arrayGrid1 = $grid.pqGrid("option", "dataModel.data");
        $grid.pqGrid("reset", {group: true, filter: true});
        var obj = $grid.pqGrid("option", "dataModel.data");
        var colModel = $grid.pqGrid("option", "colModel");
        var askMessage = "{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}";
        if (arrayGrid1.length > 0) {
            for (var i = 0; i < obj.length; i++) {
                if (obj[i].IsObligated == 1) {
                    for (var j = 0; j < colModel.length; j++) {
                        var isEditCell = $grid.pqGrid("isEditableCell", {
                            rowIndx: i,
                            dataIndx: [colModel[j].dataIndx]
                        })
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
                            return false;
                        }

                    }
                }
            }
        }

        //grid2W17F1011..
        var $grid2 = $("#grid2W17F1011");
        $("#grid2W17F1011").pqGrid("reset", {group: true, filter: true});
        var arrayGrid2 = $grid2.pqGrid("option", "dataModel.data");
        var obj = $grid2.pqGrid("option", "dataModel.data");
        var colModel = $grid2.pqGrid("option", "colModel");
        var askMessage = "{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}";
        if (arrayGrid2.length > 0) {
            for (var i = 0; i < obj.length; i++) {
                for (var j = 0; j < colModel.length; j++) {
                    var isEditCell = $grid2.pqGrid("isEditableCell", {
                        rowIndx: i,
                        dataIndx: [colModel[j].dataIndx]
                    })
                    if (colModel[j].required && isNullOrEmpty(obj[i][colModel[j].dataIndx]) && isEditCell) {
                        $grid2.pqGrid("setSelection", {
                            rowIndx: i,
                            colIndx: j
                        });
                        $grid2.pqGrid("editCell", {rowIndx: i, dataIndx: colModel[j].dataIndx});
                        var cell = $grid2.pqGrid("getEditCell");
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
                        return false;
                    }

                }
            }
        }

        return true;
    }

    function saveGrid() {

        //gridW17F1011..
        // $("#gridW17F1011").pqGrid("saveEditCell");
        // $("#gridW17F1011").pqGrid("quitEditMode");
        var $grid = $("#gridW17F1011");
        var arrayGrid1 = $grid.pqGrid("option", "dataModel.data");
        $grid.pqGrid("reset", {group: true, filter: true});
        var obj = $grid.pqGrid("option", "dataModel.data");
        var colModel = $grid.pqGrid("option", "colModel");
        var askMessage = "{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}";
        if (arrayGrid1.length > 0) {
            $.ajax({
                method: "POST",
                url: "{{url("/W17F1011/".$pForm."/$g/save2")}}",
                data: {
                    arrayGrid1: JSON.stringify(arrayGrid1),
                    companyIDW17F1011: $("#txtCompanyIDW17F1011").val(),
                    //isNew:
                },
                success: function (data) {

                    var rs = JSON.parse(data);
                    switch (rs.status) {
                        case "SUCCESS":
                            break;
                        case "ERROR":
                            save_not_ok(null, null,rs.message);
                            break;
                    }
                }
            });
        }

        //grid2W17F1011..
        var $grid2 = $("#grid2W17F1011");
        $("#grid2W17F1011").pqGrid("reset", {group: true, filter: true});
        var arrayGrid2 = $grid2.pqGrid("option", "dataModel.data");
        var obj = $grid2.pqGrid("option", "dataModel.data");
        var colModel = $grid2.pqGrid("option", "colModel");
        var askMessage = "{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}";
        if (arrayGrid2.length > 0) {
            $.ajax({
                method: "POST",
                url: "{{url("/W17F1011/".$pForm."/$g/save3")}}",
                data: {
                    arrayGrid2: JSON.stringify(arrayGrid2),
                    companyIDW17F1011: $("#txtCompanyIDW17F1011").val(),
                    //isNew:
                },
                success: function (data) {
                    var rs = JSON.parse(data);
                    switch (rs.status) {
                        case "ERROR":
                            save_not_ok(null, null,rs.message);
                            break;
                    }
                }
            });
        }
    }

    $("#btnSave2W17F1011").click(function (e) {
        ask_save(function (e) {

            $("#gridW17F1011").pqGrid("saveEditCell");
            $("#gridW17F1011").pqGrid("quitEditMode");
            var $grid = $("#gridW17F1011");
            var arrayGrid1 = $grid.pqGrid("option", "dataModel.data");
            $.ajax({
                method: "POST",
                url: "{{url("/W17F1011/".$pForm."/$g/save2")}}",
                data: {
                    arrayGrid1: JSON.stringify(arrayGrid1),
                    companyIDW17F1011: $("#txtCompanyIDW17F1011").val(),
                    //isNew:
                },
                success: function (data) {

                    var rs = JSON.parse(data);
                    switch (rs.status) {
                        case "SUCCESS":
                            save_ok(function () {
                                tempValueGrid1 = arrayGrid1;
                            });
                            break;
                        case "ERROR":
                            save_not_ok(rs.message);
                            break;
                    }
                }
            });
        });
    });

    $("#btnNotSave2W17F1011").click(function (e) {
        ask_not_save(function () {

            var $grid = $("#gridW17F1011");
            $grid.pqGrid("option", "dataModel.data", clone(tempValueGrid1));
            $grid.pqGrid("refreshDataAndView");
        });
    });

    $("#btnNotSave3W17F1011").click(function (e) {
        ask_not_save(function () {
            //console.log(tempValueGrid2);
            var $grid = $("#grid2W17F1011");
            //console.log(clone(tempValueGrid2));
            $("#grid2W17F1011").pqGrid("option", "dataModel.data", clone(tempValueGrid2));
            $("#grid2W17F1011").pqGrid("refreshDataAndView");
        });
    });

    $("#btnSave3W17F1011").click(function (e) {
        e.preventDefault();
        ask_save(function (e) {
            var $grid = $("#grid2W17F1011");
            $("#grid2W17F1011").pqGrid("reset", {group: true, filter: true});
            var arrayGrid2 = $grid.pqGrid("option", "dataModel.data");
            var obj = $grid.pqGrid("option", "dataModel.data");
            var colModel = $grid.pqGrid("option", "colModel");
            var askMessage = "{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}";
            for (var i = 0; i < obj.length; i++) {
                for (var j = 0; j < colModel.length; j++) {
                    var isEditCell = $grid.pqGrid("isEditableCell", {
                        rowIndx: i,
                        dataIndx: [colModel[j].dataIndx]
                    })
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
            if (arrayGrid2.length > 0) {
                $.ajax({
                    method: "POST",
                    url: "{{url("/W17F1011/".$pForm."/$g/save3")}}",
                    data: {
                        arrayGrid2: JSON.stringify(arrayGrid2),
                        companyIDW17F1011: $("#txtCompanyIDW17F1011").val(),
                        //isNew:
                    },
                    success: function (data) {
                        save_ok(function () {
                            tempValueGrid2 = arrayGrid2;
                        });

                    }
                });
            } else {

                alert_warning('{{Helpers::getRS(4,"Vui_long_nhap_du_lieu_vao_luoi")}}');
            }

        });
    });

    $("#btnSaveW17F1011").click(function (e) {
        ask_save(function () {
            if (checkSaveGrid(e)) {
                $("#btnSubmitW17F1011").click();
            }
        });
    });


    $("#frmW17F1011").submit(function (e) {
        e.preventDefault();
        var url = '';
        var addressIDW17F1011 = "";
        var contactIDW17F1011 = "";

        if (taskW17F1011 == "view" || taskW17F1011 == "edit") {
            url = '{{url("/W17F1011/".$pForm."/$g/update")}}';
            addressIDW17F1011 = "{{isset($rsData) ? $rsData['AddressID'] : ''}}";
            contactIDW17F1011 = "{{isset($rsData) ? $rsData['ContactID'] : ''}}";
        } else {
            url = '{{url("/W17F1011/".$pForm."/$g/save")}}';

        }

        var provinceNameW17F1011 = $('#cboProvinceIDW17F1011 option:selected').text().trim();
        var districtNameW17F1011 = $('#cboDistrictIDW17F1011 option:selected').text().trim();
        var wardNameW17F1011 = $('#cboWardIDW17F1011 option:selected').text().trim();

        saveGrid();

        postMethod(url, function (data) {

            var rs = JSON.parse(data);
            console.log(rs.data);
            switch (rs.status) {
                case 'OKAY':
                    save_ok(function () {
                        $("#txtCompanyIDW17F1011").val(rs.companyID);
                        updateGridW14F1010($("#txtCompanyIDW17F1011").val());
                        localStorage.setItem('companyIDW17F1011', $("#txtCompanyIDW17F1011").val());
                        $("#btnViewMoreW17F1011").removeClass("hide");
                        //set lai database cho 2 luoi

                        // $("#gridW17F1011").pqGrid("option", "dataModel.data", rs.data[0]);
                        // $("#grid2W17F1011").pqGrid("option", "dataModel.data", rs.data[1]);
                        // $("#gridW17F1011").pqGrid("refreshDataAndView");
                        // $("#grid2W17F1011").pqGrid("refreshDataAndView");
                        setEnableControl(taskW17F1011);
                    });
                    break;
                case 'ERROR':
                    alert_warning(rs.message);
                    break;
                case 'EXIST':
                    alert_warning(rs.message);
                    break;
                case 'EXIST2':
                    alert_warning(rs.message);
            }

        }, $(this).serialize() + "&chkisNewFindW17F1011=" + {{$chkisNewFindW17F101}} +"&txtCompanyIDW17F1011=" + $("#txtCompanyIDW17F1011").val() + "&addressIDW17F1011=" + addressIDW17F1011 + "&contactIDW17F1011=" + contactIDW17F1011 + "&cboCompanyGroupIDW17F1011=" + $("#cboCompanyGroupIDW17F1011").val()
                    + "&provinceNameW17F1011=" + provinceNameW17F1011
                    + '&districtNameW17F1011=' + districtNameW17F1011
                    + '&wardNameW17F1011='     + wardNameW17F1011)


    });

    function updateGridW14F1010(companyID) {
        postMethod("{{url('/W17F1010/'.$pForm.'/'.$g.'/filter')}}", function (data) {
            var $grid = $("#gridW17F1010");
            if (data.dsData != null && data.dsData.length > 0) {
                if (taskW17F1011 == "add") {
                    update4ParamGrid($grid, data.dsData[0], 'add');
                    rowDataW17F1011 = data.dsData[0];
                }

                if (taskW17F1011 == "edit")
                    update4ParamGrid($grid, data.dsData[0], 'edit');
            }
            //taskW17F1011 = "view";
            setEnableControl(taskW17F1011);
        }, $("#frmW17F1010").serialize() + "&companyIDW17F1010=" + companyID);
    }

    $("#btnNextW17F1011").click(function () {
        $('#frmW17F1011')[0].reset();
        taskW17F1011 = 'add';
        setEnableControl(taskW17F1011);
        $("#btnViewMoreW17F1011").addClass("hide");
        $("#btnCreateKeyW17F1011").trigger('click');
        /*resetValue("");*/


        $("#cboCompanyStatusW17F1011").val("");
        $("#cboCaseSourceIDW17F1011").val("");
        $("#cboCompanyGroupIDW17F1011").val("");
        $("#cboGroupSalesIDW17F1011").val("");
        $("#cboSalePersonIDW17F1011").val("");
        $("#cboIndustryGroupIDW17F1011").val("");
        $("#txtAddressLine1W17F1011").val("");

        $("#cboGroupSalesIDW17F1011").select2({
            containerCssClass: "required"
        });
        $("#cboCompanyGroupIDW17F1011").select2({
            containerCssClass: "required"
        });
        $("#cboSalePersonIDW17F1011").select2({
            containerCssClass: "required"
        });
        $("#cboCompanyKindIDW17F1011").select2({
            containerCssClass: "required"
        });
        $("#cboCompanyStatusW17F1011,#cboCaseSourceIDW17F1011,#cboIndustryGroupIDW17F1011").select2({
            //containerCssClass: "required"
        });

    });

    $("#btnCancelW17F1011").click(function () {
        ask_not_save(function () {
            resetValue(rowDataW17F1011);
        })
    });

    $(function () {
        var newDate = null;
        var dateEditor = function (ui) {

            var $inp = ui.$cell.find("input"),
                grid = this;
            //initialize the editor
            $inp.datepicker({
                changeMonth: true,
                changeYear: true,
                autoclose: true,
                format: "dd/mm/yyyy",
                language: 'vi',
                todayHighlight: true,
                showOnFocus: true,
                toggleActive: true,
                allowDeselection: false,
                defaultViewDate: '',
                isDateGrid: true
            }).on('changeDate', function (d) {
                var da = (new Date(d.date)).toString('dd/MM/yyyy');
                newDate = da;
            });
        }

        var data = null;


        // var data = $("#gridW17F1011").pqGrid( "option", "dataModel.data");

        //var itemlist = ;


        var _rowData = [];
        var obj1 = {
            width: "100%",
            flexHeight: true,
            resizable: true,
            title: "",
            showBottom: false,
            showTitle: false,
            showHeader: true,
            showToolbarType: false,
            showTop: false,
            collapsible: false,
            dataType: "JSON",
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            dataModel: {
                data: {{json_encode($dsCriterial)}},
                location: "local",
                sorting: "local",
                sortDir: "down"
            },
            editModel: {
                saveKey: $.ui.keyCode.ENTER,
                select: true,
                keyUpDown: false,
                cellBorderWidth: 0,
                //onBlur: "save",
                clicksToEdit: 2
            },

            postRenderInterval: -1,
            selectionModel: {type: 'cell'},
            historyModel: {checkEditable: false},
            pasteModel: {on: false},
            complete: function (event, ui) {
                if (taskW17F1011 == 'view') {
                    //$("#gridW17F1011").pqGrid('disable');
                    //$("#grid2W17F1011").pqGrid('disable');
                }
            },

            cellSave: function (event, ui) {
                var $grid = $("#gridW17F1011");
                //var newVal = ui.newVal;

                var rowData = ui.rowData,
                    dataIndx = ui.dataIndx,
                    rowIndx = ui.rowIndx;
                if (ui.column.dataType == 'float') {
                    //alert(formatNumber( ui.rowData[ui.dataIndx], getDecimal( (ui.rowData[ui.dataIndx]).toString())));
                    ui.rowData[ui.dataIndx] = formatNumber(ui.rowData[ui.dataIndx], getDecimal(ui.column.format));
                    $("#gridW17F1011").pqGrid("refreshCell", {rowIndx: rowIndx, dataIndx: ui.dataIndx});

                }
                // if (ui.dataIndx == "ValueID" && ui.newVal.ValueID !== ui.oldVal.ValueID) {
                //     this.updateRow({
                //         rowIndx: ui.rowIndx,
                //         row: {'ValueID': rowData['ValueID'], 'ValueName': rowData['ValueName']}
                //     });
                // }

                if (ui.dataIndx == "ValueID" && ui.newVal.ValueID !== ui.oldVal.ValueID) {
                    this.updateRow({
                        rowIndx: ui.rowIndx,
                        row: {'ValueID': _rowData['ValueID']}
                    });
                    _rowData = [];
                }
            },

            editorKeyDown: function (event, ui) {
                var rowIndx = ui.rowIndx;
                var dataIndx = ui.dataIndx;
                var rowData = ui.rowData;
                //delete
                if (event.keyCode == 46) {
                    event.stopPropagation();
                    event.preventDefault();
                    $(ui.$cell[0]).find("input").val('');//Đây là delete giá trị tạm thời nên không tính lại value
                    $(ui.$cell[0]).find("select").val('');

                }
            },
            cellKeyDown: function (event, ui) {
                var rowIndx = ui.rowIndx;
                var dataIndx = ui.dataIndx;
                var rowData = ui.rowData;
                //delete
                if (event.keyCode == 46) {
                    event.stopPropagation();
                    event.preventDefault();
                    var isEditableCell = $("#gridW17F1011").pqGrid("isEditableCell", {
                        rowIndx: rowIndx,
                        dataIndx: dataIndx
                    });
                    if (this.isEditableCell(ui)) {
                        rowData[dataIndx] = "";
                        $("#gridW17F1011").pqGrid("refreshDataAndView");
                    }
                }
            },
            selectChange: function (event, ui) {
                $(".datepicker").css("display", 'none');
            },

            cellBeforeSave: function (event, ui) {
                console.log(ui);
                var newVal = ui.newVal;
                var dataIndx = ui.dataIndx;
                if (dataIndx == "ValueID" && ui.column.dataType == 'date') {
                    return isDate(newVal);
                }


            }
            ,selectChange: function( event, ui ) {
                var colIndx = ui.selection._areas[0].firstC;
                var rowIndx = ui.selection._areas[0].firstR;
                var rowData =  $( "#gridW17F1011" ).pqGrid( "getRowData", {rowIndxPage: rowIndx} );
                var column = ui.selection.that.colModel[colIndx];
                if (typeof column != 'undefined')
                    var dataIndx = column.dataIndx;

                $("#gridW17F1011").pqGrid("saveEditCell");
                $("#gridW17F1011").pqGrid("quitEditMode");
                if (dataIndx == "ValueID") {
                    switch (rowData["ControlType"]) {
                        case "T": //Text
                            if (rowData["DataType"] == "S") { //Cho phep nhap chuoi
                                var colModel = $("#gridW17F1011").pqGrid("option", "colModel");
                                colModel[colIndx]["dataType"] = "string";
                                colModel[colIndx]["editor"] = true;
                                colModel[colIndx]["format"] = null;
                                $("#gridW17F1011").pqGrid({colModel: colModel});
                            } else { //Cho phep nhap so
                                var colModel = $("#gridW17F1011").pqGrid("option", "colModel");
                                colModel[colIndx]["dataType"] = "float";
                                colModel[colIndx]["editor"] = true;
                                colModel[colIndx]["format"] = "#,###.00";
                                $("#gridW17F1011").pqGrid({colModel: colModel});
                            }
                            break;
                        case 'D': //Date
                            var colModel = $("#gridW17F1011").pqGrid("option", "colModel");
                            colModel[colIndx]["dataType"] = "date";
                            colModel[colIndx]["format"] = null;
                            colModel[colIndx]["editor"] = {
                                type: 'textbox',
                                init: dateEditor
                            };
                            $("#gridW17F1011").pqGrid({colModel: colModel});
                            break;
                        case 'C': //dropdown
                            var colModel = $("#gridW17F1011").pqGrid("option", "colModel");
                            colModel[colIndx]["dataType"] = "string";
                            colModel[colIndx]["align"] = "left";
                            colModel[colIndx]["format"] = null;
                            colModel[colIndx]["editor"] = {
                                type: "select",
                                // prepend: {"": ""},
                                valueIndx: "Description",
                                labelIndx: "ValueID",
                                mapIndices: {"Description": "Description", "ValueID": "ValueID"},
                                init: function (ui) {
                                    var oldValues = rowData[dataIndx].split(';');
                                    ui.$cell.find("select").attr('multiple', 'multiple');
                                    ui.$cell.find('select').val(oldValues);

                                    ui.$cell.find("select").pqSelect({
                                        multiplePlaceholder: '{{ Helpers::getRS($g, 'Chon_nhieu_gia_tri') }}',
                                    });
                                    _rowData['ValueID'] = [];
                                    if (oldValues != null) {
                                        _rowData['ValueID'] = oldValues.join(';');
                                    } else {
                                        _rowData['ValueID'] = '';
                                    }
                                    ui.$cell.find("select").change(function(evt){
                                        var items = $(this).children(':selected');
                                        var valNames = [];
                                        $.each(items, function(i, val) {
                                            valNames.push($(val).text());
                                        });
                                        var values = $(this).val();
                                        _rowData['ValueID'] = [];
                                        if (values != null) {
                                            _rowData['ValueID'] = values.join(';');
                                            _rowData['ValueName'] = valNames.join(';');
                                        } else {
                                            _rowData['ValueID'] = '';
                                            _rowData['ValueName'] = '';
                                        }
                                    });
                                },
                                options: function () {
                                    var dataFilter = $.grep(itemsCombo, function (row) {
                                        return row.NormID == rowData.NormID;
                                    });
                                    return dataFilter;
                                }
                            };
                            $("#gridW17F1011").pqGrid({colModel: colModel});
                            break;
                    }

                }
            }
//            ,cellClick: function (event, ui) {
//                $("#gridW17F1011").pqGrid("saveEditCell");
//                $("#gridW17F1011").pqGrid("quitEditMode");
//
//
//                var rowData = ui.rowData;
//                var rowIndx = ui.rowIndx;
//                var dataIndx = ui.dataIndx;
//                var colIndx = ui.colIndx;
//                console.log(ui);
//
//                if (dataIndx == "ValueID") {
//                    switch (rowData["ControlType"]) {
//                        case "T": //Text
//                            if (rowData["DataType"] == "S") { //Cho phep nhap chuoi
//                                var colModel = $("#gridW17F1011").pqGrid("option", "colModel");
//                                colModel[colIndx]["dataType"] = "string";
//                                colModel[colIndx]["editor"] = true;
//                                colModel[colIndx]["format"] = null;
//                                $("#gridW17F1011").pqGrid({colModel: colModel});
//                            } else { //Cho phep nhap so
//                                var colModel = $("#gridW17F1011").pqGrid("option", "colModel");
//                                colModel[colIndx]["dataType"] = "float";
//                                colModel[colIndx]["editor"] = true;
//                                colModel[colIndx]["format"] = "#,###.00";
//                                $("#gridW17F1011").pqGrid({colModel: colModel});
//                            }
//                            break;
//                        case 'D': //Date
//                            var colModel = $("#gridW17F1011").pqGrid("option", "colModel");
//                            colModel[colIndx]["dataType"] = "date";
//                            colModel[colIndx]["format"] = null;
//                            colModel[colIndx]["editor"] = {
//                                type: 'textbox',
//                                init: dateEditor
//                            };
//                            $("#gridW17F1011").pqGrid({colModel: colModel});
//                            break;
//                        case 'C': //dropdown
//                            var colModel = $("#gridW17F1011").pqGrid("option", "colModel");
//                            colModel[colIndx]["dataType"] = "string";
//                            colModel[colIndx]["align"] = "left";
//                            colModel[colIndx]["format"] = null;
//                            colModel[colIndx]["editor"] = {
//                                type: "select",
//                                prepend: {"": ""},
//                                valueIndx: "Description",
//                                labelIndx: "ValueID",
//                                mapIndices: {"Description": "Description", "ValueID": "ValueID"},
//                                options: function () {
//                                    var dataFilter = $.grep(itemsCombo, function (row) {
//                                        return row.NormID == rowData.NormID;
//                                    });
//                                    return dataFilter;
//                                }
//                            };
//                            $("#gridW17F1011").pqGrid({colModel: colModel});
//                            break;
//                    }
//
//                }
//            },
            ,colModel: [
                {
                    title: "{{Helpers::getRS($g,'Chi_tieu')}}",
                    minWidth: 340,
                    dataType: "string",
                    editor: true,
                    editable: false,
                    dataIndx: "NormName",
                    render: function (ui) {
                        var row = ui.rowData,
                            checked = row["NotApproval"] == 1 ? 'checked' : '',
                            disabled = this.isEditableCell(ui) ? "" : "disabled";

                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    },

                },
                {
                    title: "{{Helpers::getRS($g,'Noi_dung')}}",
                    minWidth: 250,
                    width: 300,
                    dataType: "string",
                    editor: true,
                    required: true,
                    editable: function () {
                        var task = '{{$task}}';
                        return task == 'view' ? false : true;
                    },
                    dataIndx: "ValueID",
                    align: "left",
                    render: function (ui) {
                        var row = ui.rowData,
                            disabled = this.isEditableCell(ui) ? "" : "disabled";
                            var str = '';
                            str += row['ValueID'];
                            if (row['ControlType'] == 'C')
                                str += '<i class="fa fa-caret-down pull-right" aria-hidden="true"></i>';
                        return {
                            cls: (disabled ? "readonly-status" : ""),
                            text: str
                        };
                    },

                },
                {{--{--}}
                    {{--title: "{{Helpers::getRS($g,'Dien_giai')}}",--}}
                    {{--minWidth: 250,--}}
                    {{--width: 300,--}}
                    {{--dataType: "string",--}}
                    {{--editor: false,--}}
                    {{--editable: false,--}}
                    {{--dataIndx: "Description",--}}
                    {{--align: "left",--}}
                    {{--hidden: false,--}}
                    {{--render: function (ui) {--}}
                        {{--var row = ui.rowData,--}}
                            {{--checked = row["NotApproval"] == 1 ? 'checked' : '',--}}
                            {{--disabled = this.isEditableCell(ui) ? "" : "disabled";--}}

                        {{--return {--}}
                            {{--cls: (disabled ? "readonly-status" : "")--}}
                        {{--};--}}
                    {{--},--}}
                {{--},--}}
                {
                    title: "{{Helpers::getRS($g,'Ghi_chu')}}",
                    minWidth: 100,
                    width: 300,
                    align: "left",
                    dataType: "string",
                    editor: true,
                    editable: function () {
                        var task = '{{$task}}';
                        return task == 'view' ? false : true;
                    },
                    render: function (ui) {
                        var row = ui.rowData,
                            disabled = this.isEditableCell(ui) ? "" : "disabled";

                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    },
                    dataIndx: "Note",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },

                {
                    title: "",
                    minWidth: 100,
                    align: "center",
                    dataType: "string",
                    editor: true,
                    editable: true,
                    dataIndx: "CompanyTypeID",
                    hidden: true
                },
                {
                    title: "",
                    minWidth: 100,
                    align: "center",
                    dataType: "string",
                    editor: true,
                    editable: false,
                    dataIndx: "CompanyID",
                    hidden: true
                },
                {
                    title: "",
                    minWidth: 100,
                    align: "center",
                    dataType: "string",
                    editor: true,
                    editable: false,
                    dataIndx: "ControlType",
                    hidden: true
                },
                {
                    title: "",
                    minWidth: 100,
                    align: "center",
                    dataType: "string",
                    editor: true,
                    editable: false,
                    dataIndx: "DataType",
                    hidden: true
                },
                {
                    title: "",
                    minWidth: 100,
                    align: "center",
                    dataType: "string",
                    editor: true,
                    editable: false,
                    dataIndx: "NormID",
                    hidden: true
                },


            ]
        };

        $("#gridW17F1011").pqGrid(obj1);
        setTimeout(function () {
            $("#gridW17F1011").pqGrid("refreshDataAndView");
        }, 300);

    });

    function defaultValueOnGridW17F1011() {

        var $grid = $("#grid2W17F1011");
        $grid.pqGrid("saveEditCell");
        $grid.pqGrid("quitEditMode");
        var idx = $grid.pqGrid("addRow",
            {
                rowData: {
                    //TrainingFieldName: '',
                    //TrainingCourseName: ''
                }
            }
        );
        var rowData = $grid.pqGrid("getRowData", {rowIndx: idx});
        $grid.pqGrid("refreshDataAndView");
        $grid.pqGrid("setSelection", {rowIndx: idx, colIndx: 1});
    }

    $(function () {

        var obj2 = {
            width: "100%",
            height: 300,
            resizable: true,
            title: "",
            showBottom: false,
            showTitle: false,
            showHeader: true,
            showToolbar: {{$task == 'view' ? 'false' : 'true'}},
            collapsible: false,
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            editModel: {
                saveKey: $.ui.keyCode.ENTER,
                select: true,
                keyUpDown: false,
                cellBorderWidth: 0,
                clicksToEdit: 1
            },
            dataModel: {
                data:{{json_encode($Extrainformation)}},
                location: "local",
                sorting: "local",
                sortDir: "down"
            },
            postRenderInterval: -1,
            selectionModel: {type: 'cell', mode: 'single'},
            //filterModel: {on: true, mode: "AND", header: true},
            toolbar: {
                items: [
                    {
                        type: 'button',
                        icon: 'ui-icon-plus',
                        label: '{{Helpers::getRS($g,'Them_moi1')}}',
                        listener: function () {
                            defaultValueOnGridW17F1011();
                        }
                    }
                ]
            },
            cellClick: function (event, ui) {
                /*console.log("editorBegin");
                var rowData = ui.rowData;
                var rowIndx = ui.rowIndx;
                var dataIndx = ui.dataIndx;
                var colIndx = ui.colIndx;
                var $grid = $("#grid2W17F1011");

                if (dataIndx == "ValueName") {
                    var clValueName = $grid.pqGrid("getColumn", {dataIndx: "ValueName"});
                    var arrValueName = {{json_encode($comboValueID)}};
                            var dataFilter = $.grep(arrValueName, function (row) {
                                return row.NormID == rowData['NormID'];
                            });
                            clValueName.editor.options = dataFilter;
                        }*/
            },
            editorKeyDown: function (event, ui) {
                //delete
                if (event.keyCode == 46) {
                    event.stopPropagation();
                    event.preventDefault();
                    $(ui.$cell[0]).find("input").val('');//Đây là delete giá trị tạm thời nên không tính lại value
                    $(ui.$cell[0]).find("select").val('');
                }
                //delete row
                if (event.keyCode == 46 && event.ctrlKey) {
                    event.stopPropagation();
                    event.preventDefault();
                    var numrow = $("#grid2W17F1011").pqGrid("option", "dataModel.data").length;
                    var rowIndx = ui.rowIndx;
                    $("#grid2W17F1011").pqGrid("deleteRow", {rowIndx: rowIndx});
                    if (rowIndx == numrow - 1) {
                        $("#grid2W17F1011").pqGrid("setSelection", {
                            rowIndx: rowIndx - 1,
                            colIndx: ui.colIndx
                        });
                    }
                }
            },

            cellSave: function (event, ui) {
                var $grid = $("#grid2W17F1011");
                var rowData = ui.rowData,
                    dataIndx = ui.dataIndx,
                    rowIndx = ui.rowIndx;
                /*if (dataIndx == "NormName") {
                    rowData['ValueID'] = "";
                    rowData['ValueName'] = "";
                    $grid.pqGrid("refreshDataAndView");
                }*/
                if (ui.dataIndx == "NormName" && ui.newVal.NormID !== ui.oldVal.NormID) {
                    //reset the region cell whenever country cell is modified.
                    this.updateRow({
                        rowIndx: ui.rowIndx,
                        row: {'ValueID': '', 'ValueName': ''}
                    });
                }
            },
            colModel: [
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
                        var grid = this, $cell = grid.getCell(ui);

                        //edit button
                        $cell.find("a.glyphicon-remove").bind("click", function (evt) {
                            update4ParamGrid($("#grid2W17F1011"), null, 'delete');
                        });
                    }
                },
                {
                    title: "",
                    minWidth: 100,
                    align: "center",
                    dataType: "string",
                    editor: true,
                    editable: true,
                    dataIndx: "NormID",
                    hidden: true
                },
                {
                    title: "{{Helpers::getRS($g,'Ma_loai_thong_tin')}}",
                    minWidth: 180,
                    dataType: "string",
                    editor: true,
                    editable: function () {
                        var task = '{{$task}}';
                        return task == 'view' ? false : true;
                    },
                    render: function (ui) {
                        var row = ui.rowData,
                            disabled = this.isEditableCell(ui) ? "" : "disabled";

                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    },
                    required: true,
                    dataIndx: "NormName",
                    editor: {
                        type: 'select',
                        prepend: {"": ""},
                        valueIndx: "NormID",
                        labelIndx: "NormName",
                        mapIndices: {"NormName": "NormName", "NormID": "NormID"},
                        options: {{json_encode($comboNormID)}}
                    }

                },
                {
                    title: "",
                    minWidth: 100,
                    align: "center",
                    dataType: "string",
                    editor: true,
                    editable: true,
                    dataIndx: "ValueID",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                    hidden: true
                },
                {
                    title: "{{Helpers::getRS($g,'Ma_thong_tin')}}",
                    minWidth: 250,
                    width: 300,
                    dataType: "string",
                    editable: function () {
                        var task = '{{$task}}';
                        return task == 'view' ? false : true;
                    },
                    render: function (ui) {
                        var row = ui.rowData,
                            disabled = this.isEditableCell(ui) ? "" : "disabled";

                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    },
                    dataIndx: "ValueName",
                    editor: {
                        type: 'select',
                        prepend: {"": ""},
                        valueIndx: "ValueID",
                        labelIndx: "ValueName",
                        mapIndices: {"ValueName": "ValueName", "ValueID": "ValueID"},
                        options: function (ui) {
                            var normID = ui.rowData.NormID;
                            var arrValueName = {{json_encode($comboValueID)}};
                            var dataFilter = $.grep(arrValueName, function (row) {
                                return row.NormID == normID;
                            });
                            return dataFilter;
                        }
                    }
                },
                {
                    title: "{{Helpers::getRS($g,'Ghi_chu')}}",
                    minWidth: 100,
                    width: 340,
                    align: "left",
                    dataType: "string",
                    editor: true,
                    editable: function () {
                        var task = '{{$task}}';
                        return task == 'view' ? false : true;
                    },
                    render: function (ui) {
                        var row = ui.rowData,
                            disabled = this.isEditableCell(ui) ? "" : "disabled";

                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    },
                    dataIndx: "Note"
                },
                {
                    title: "",
                    minWidth: 100,
                    align: "center",
                    dataType: "string",
                    editor: true,
                    editable: true,
                    dataIndx: "CompanyTypeID",
                    hidden: true
                },
                {
                    title: "",
                    minWidth: 100,
                    align: "center",
                    dataType: "string",
                    editor: true,
                    editable: true,
                    dataIndx: "CompanyID",
                    hidden: true
                }
            ]
        };
        $("#grid2W17F1011").pqGrid(obj2);
        setTimeout(function () {
            $("#grid2W17F1011").pqGrid("refreshDataAndView");
        }, 300);

    });

    $("#btnViewMoreW17F1011").click(function () {

        setTimeout(function () {
            $("#grid2W17F1011").pqGrid("refreshDataAndView");
            $("#gridW17F1011").pqGrid("refreshDataAndView");
            console.log("start");
            setEnableControl(taskW17F1011);
            console.log("end");
        }, 500);
        $("#divScrollbarW17F1011").css('overflow', 'auto');

    });


    var isDate = function(d) {
        console.log("isDate");
        if (d == "" || d == undefined)
            return false;
        var arr = d.split("/");
        var n = new Date(Number(arr[2]), Number(arr[1]) - 1, Number(arr[0]));
        return (n !== "Invalid Date" && !isNaN(n) ) ? true : false;
    }
</script>

