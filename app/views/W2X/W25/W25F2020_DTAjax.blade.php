@if(count($rs))
    <div class="row">
        <div class="col-md-12 hdDetail">
            <div class="liketext">
                <label class="text-yellow"><b>{{$rs[0]['DivisionName']}}</b></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="row liketext">
                <label class="col-md-6">{{Helpers::getRS($g,"Phong_ban")}}</label>
                <label class="col-md-6 pdl0"><b>{{$rs[0]['DepartmentName']}} </b></label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row liketext">
                <label class="col-md-5 pdr0 pdl0">{{Helpers::getRS($g,"To_nhom")}}</label>
                <label class="col-md-7 pdr0 pdl0"><b>{{$rs[0]['TeamName']}} </b></label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row liketext">
                <label class="col-md-5 pdr0 pdl0">{{Helpers::getRS($g,"Vi_tri_tuyen_dung")}}</label>
                <label class="col-md-7 pdr0 pdl0"><b>{{$rs[0]['RecPositionName']}} </b></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="row liketext">
                <label class="col-md-6">{{Helpers::getRS($g,"Ke_hoach_tong_the")}}</label>
                <label class="col-md-6 pdl0"><b>{{$rs[0]['PlanName']}} </b></label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row liketext">
                <label class="col-md-5 pdr0 pdl0">{{Helpers::getRS($g,"Loai_hop_dong")}}</label>
                <label class="col-md-7 pdr0 pdl0"><b>{{$rs[0]['ContractTypeName']}} </b></label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row liketext">
                <label class="col-md-5 pdr0 pdl0"></label>
                <button type="button" id="frm_fileDuyet" class="btn btn-default smallbtn" @if(intval($fileNumber[0]['Count']) == 0) disabled @endif>
                    <span class="glyphicon glyphicon-paperclip"></span> {{Helpers::getRS($g,"Dinh_kem")}}({{intval($fileNumber[0]['Count'])}})
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="row liketext">
                <label class="col-md-6 pdr0">{{Helpers::getRS($g,"Loai_tuyen")}}</label>
                @if ($rs[0]['RecruitmentType']==0)
                    <label class="col-md-6 pdl0"><b>{{Helpers::getRS($g,"Tuyen_moi")}}</b></label>
                @else
                    <label class="col-md-6 pdl0"><b>{{Helpers::getRS($g,"Thay_the")}}</b></label>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="row liketext">
                <label class="col-md-5 pdr0 pdl0">{{Helpers::getRS($g,"Hinh_thuc_lam_viec")}}</label>
                <label class="col-md-7 pdr0 pdl0"><b>{{$rs[0]['WorkingStatusName']}} </b></label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row liketext">
                    <label class="col-md-5 pdr0 pdl0">{{Helpers::getRS($g,"Dia_diem_lam_viec")}}</label>
                    <label class="col-md-7 pdr0 pdl0"><b>{{$rs[0]['WorkingPlace']}} </b></label>
                <!-- label class="col-md-5 pdr0 pdl0">{{Helpers::getRS($g,"Cong_viec")}}</label>
                <label class="col-md-7 pdr0 pdl0"><b>{{$rs[0]['WorkName']}} </b></label -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="row liketext">
                <label class="col-md-6">{{Helpers::getRS($g,"So_luong")}}</label>
                <div class="col-md-6 pdl0 pdr0">
                    <label><b>{{$rs[0]['ProNumber']}}</b></label>
                    (<label><b>{{$rs[0]['MaleQuan']}}</b></label>
                    <label class="hintPass">{{Helpers::getRS($g,"NamU")}}</label>,
                    <label><b>{{$rs[0]['FemaleQuan']}}</b></label>
                    <label class="hintPass">{{Helpers::getRS($g,"Nu_U")}}</label>)
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row liketext">
                <label class="col-md-5 pdr0 pdl0">{{Helpers::getRS($g,"Thoi_gian_DX")}}</label>
                <label class="col-md-7 pdr0 pdl0"><b>{{$rs[0]['DateFrom']}} -> {{$rs[0]['DateTo']}}</b></label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row liketext">
                <label class="col-md-5 pdr0 pdl0">{{Helpers::getRS($g,"PV_du_kien")}}</label>
                <label class="col-md-7 pdr0 pdl0"><b>{{$rs[0]['InterviewDate']}} </b></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="row liketext">
                <label class="col-md-6">{{Helpers::getRS($g,"Muc_luong_du_kien")}}</label>
                <label class="col-md-6 pdl0"><b>{{number_format($rs[0]['SalaryFrom'],0) > 0 ?  number_format($rs[0]['SalaryFrom'],Session::get("W91P0000")['D90_ConvertedDecimals']).' -> '.number_format($rs[0]['SalaryTo'],Session::get("W91P0000")['D90_ConvertedDecimals']).' ('.$rs[0]['CurrencyID'].')' : ''}} </b></label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row liketext">
                <label class="col-md-5 pdr0 pdl0">{{Helpers::getRS($g,"Ngay_nhan_su_can_nguoi")}}</label>
                <label class="col-md-7 pdr0 pdl0"><b>{{$rs[0]['DateJoined']}} </b></label>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row liketext">
                <div class="col-md-2 pdr0" style="width: 16.5%;">
                    <label>{{Helpers::getRS($g,'Ly_do_can_tuyen')}}</label>
                </div>
                <div class="col-md-10 pdl0" style="width: 83.5%;">
                    <label class="pdr0"><b>{{$rs[0]['ReasonRequest']}} </b></label>
                </div>
            </div>
        </div>
    </div>
    <fieldset>
        <legend class="legend">{{Helpers::getRS($g,"Tieu_chuan_can_tuyen")}}</legend>
        <div class="row">
            <div class="col-md-3">
                <div class="row liketext">
                    <div class="col-md-4 pdr0">
                        <label>{{Helpers::getRS($g,'Do_tuoi')}}</label>
                    </div>
                    <div class="col-md-8">
                        <label><b>{{$rs[0]['AgeFrom']}} </b>&nbsp;</label>
                        <label class="lbl-normal">{{Helpers::getRS($g,'den1')}}</label>
                        <label>&nbsp;<b>{{$rs[0]['AgeTo']}} </b></label>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row liketext">
                    <div class="col-md-4 pdr0 pdl0">
                        <label>{{Helpers::getRS($g,'Trinh_do_hoc_van')}}</label>
                    </div>
                    <div class="col-md-8 pdr0 pdl0">
                        <label><b>{{$rs[0]['EducationLevelName']}} </b></label>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row liketext">
                    <div class="col-md-5 pdr0 pdl0">
                        <label>{{Helpers::getRS($g,'Trinh_do_chuyen_mon_U')}}</label>
                    </div>
                    <div class="col-md-7 pdr0 pdl0">
                        <label><b>{{$rs[0]['ProfessionalLevelName']}} </b></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row liketext">
                    <div class="col-md-4 pdr0">
                        <label>{{Helpers::getRS($g,'Trinh_do_tin_hoc')}}</label>
                    </div>
                    <div class="col-md-8 pdl0 pdr0">
                        <label><b>{{$rs[0]['ComputerSkills']}} </b></label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row liketext">
                    <div class="col-md-4 pdr0 pdl0">
                        <label>{{Helpers::getRS($g,'Trinh_do_ngoai_ngu')}}</label>
                    </div>
                    <div class="col-md-8 pdl0 pdr0">
                        <label><b>{{$rs[0]['EnglishLevel']}} </b></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row liketext">
                    <div class="col-md-4 pdr0">
                        <label>{{Helpers::getRS($g,'Ky_nang')}}</label>
                    </div>
                    <div class="col-md-8 pdl0 pdr0">
                        <label><b>{{$rs[0]['Capability']}} </b></label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row liketext">
                    <div class="col-md-4  pdl0 pdr0">
                        <label>{{Helpers::getRS($g,'Ngoai_hinh')}}</label>
                    </div>
                    <div class="col-md-8 pdl0 pdr0">
                        <label><b>{{$rs[0]['Appearence']}} </b></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row liketext">
                    <div class="col-md-4 pdr0">
                        <label>{{Helpers::getRS($g,'Tinh_cach')}}</label>
                    </div>
                    <div class="col-md-8 pdl0 pdr0">
                        <label><b>{{$rs[0]['Personality']}} </b></label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row liketext">
                    <div class="col-md-4 pdl0 pdr0">
                        <label>{{Helpers::getRS($g,'Uu_tien')}}</label>
                    </div>
                    <div class="col-md-8 pdl0 pdr0">
                        <label><b>{{$rs[0]['Priority']}} </b></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-11">
                <div class="row liketext">
                    <div class="col-md-2 pdr0" style="width: 18.3%;">
                        <label>{{Helpers::getRS($g,'Kinh_nghiem')}}</label>
                    </div>
                    <div class="col-md-10 pdl0 pdr0" style="width: 81.7%;">
                        <label><b>{{$rs[0]['Experienced']}} </b></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-11">
                <div class="row liketext">
                    <div class="col-md-2 pdr0" style="width: 18.3%;">
                        <label>{{Helpers::getRS($g,'Yeu_cau_khac')}}</label>
                    </div>
                    <div class="col-md-10 pdl0 pdr0" style="width: 81.7%;">
                        <label><b>{{$rs[0]['OtherRequest']}} </b></label>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset><legend></legend></fieldset>
    <div class="row">
        <div class="col-md-12">
            <div class="row liketext">
                <div class="col-md-2" style="width: 16.9%;">
                    <label>{{Helpers::getRS($g,'Tom_tat_chuc_danh_can_tuyen')}}</label>
                </div>
                <div class="col-md-10 pdl0" style="width: 83.1%;">
                    <label><b><pre class="digi-pre-value">{{$rs[0]['Description']}} </pre></b></label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row liketext">
                <div class="col-md-2" style="width: 16.9%;">
                    <label>{{Helpers::getRS($g,'Ghi_chu')}}</label>
                </div>
                <div class="col-md-10 pdl0" style="width: 83.1%;">
                    <label><b>{{$rs[0]['ProNote']}} </b></label>
                </div>
            </div>
        </div>
    </div>
    <div class="row mgt10">
        <div class="col-md-3">
            <label>{{Helpers::getRS($g,'Ngay_lap')}}</label>
            <label class="lbl-normal mgl5" style="font-style: italic">{{$rs[0]['VoucherDate']}}</label>
        </div>
        <div class="col-md-5">
            <label>{{Helpers::getRS($g,'Nguoi_lap')}}</label>
            <label class="lbl-normal"
                   style="font-style: italic">{{$rs[0]['CreatorName']}}</label>
        </div>

    </div>
@endif
<div id="divHistoryW09F3030"></div>
<script type="text/javascript">
    function showHistoryW25F2020(transID){
        showFormDialogPost('{{url("/W09F3030/D25F2020/$g")}}', "modalW09F3030", {transID: transID},2);
    }
    //nút đính kèm
    $('#frm_fileDuyet').click(function () {
        //alert("anh bao");
        showFormDialogPost('{{url("/W09F4010/D25F2020/$g")}}', "modalW09F4010",
            {
                formCall: "W25F2020",
                keyID: "{{$rs[0]['RecPositionID']}}",
                tableName: 'D09T0211'
            },2);
    });

</script>
