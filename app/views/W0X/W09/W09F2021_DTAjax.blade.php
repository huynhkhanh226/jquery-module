<form class="form-horizontal pdt10" id="frmW09F2021">
    <fieldset class="mgt5">
        <legend class="legend">{{Helpers::getRS($g,"Thong_tin_chung")}}</legend>
        <div class="row form-group">
            <div class="col-md-4 col-xs-4">
                <div class="row">
                    <div class="col-md-5 col-xs-5">
                        <label class="lbl-normal">{{Helpers::getRS($g,"Ma_nhan_vien")}}</label>
                    </div>
                    <div class="col-md-7 col-xs-7">
                        <label>{{isset($rsDetail[0]['EmployeeID']) ? $rsDetail[0]['EmployeeID'] : ''}}</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-4">
                <div class="row">
                    <div class="col-md-5 col-xs-5">
                        <label class="lbl-normal">{{Helpers::getRS($g,"Phong_ban")}}</label>
                    </div>
                    <div class="col-md-7 col-xs-7">
                        <label>{{isset($rsDetail[0]['DePartmentName']) ? $rsDetail[0]['DePartmentName'] : ''}}</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-4">
                <div class="row">
                    <div class="col-md-5 col-xs-5">
                        <label class="lbl-normal">{{Helpers::getRS($g,"Chuc_vu")}}</label>
                    </div>
                    <div class="col-md-7 col-xs-7">
                        <label>{{isset($rsDetail[0]['DutyName']) ? $rsDetail[0]['DutyName'] : ''}}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4 col-xs-4">
                <div class="row">
                    <div class="col-md-5 col-xs-5">
                        <label class="lbl-normal">{{Helpers::getRS($g,"Ten_nhan_vien")}}</label>
                    </div>
                    <div class="col-md-7 col-xs-7">
                        <label>{{isset($rsDetail[0]['EmployeeName']) ? $rsDetail[0]['EmployeeName'] : ''}}</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-4">
                <div class="row">
                    <div class="col-md-5 col-xs-5">
                        <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_vao_lam")}}</label>
                    </div>
                    <div class="col-md-7 col-xs-7">
                        <label>{{isset($rsDetail[0]['DateJoined']) ? $rsDetail[0]['DateJoined'] : ''}}</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-4">
                <div class="row">
                    <div class="col-md-5 col-xs-5">
                        <label class="lbl-normal">{{Helpers::getRS($g,"Tham_nien_lam_viec")}}</label>
                    </div>
                    <div class="col-md-7 col-xs-7">
                        <div class="row">
                            <div class="col-md-3 col-xs-3">
                                <label>{{isset($rsDetail[0]['SeniorWorkYear']) ? $rsDetail[0]['SeniorWorkYear'] : ''}}</label>
                            </div>
                            <div class="col-md-3 col-xs-3">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Nam")}}</label>
                            </div>
                            <div class="col-md-3 col-xs-3">
                                <label>{{isset($rsDetail[0]['SeniorWorkMonth']) ? $rsDetail[0]['SeniorWorkMonth'] : ''}}</label>
                            </div>
                            <div class="col-md-3 col-xs-3">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Thang")}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4 col-xs-4">
                <div class="row">
                    <div class="col-md-5 col-xs-5">
                        <label class="lbl-normal">{{Helpers::getRS($g,"Loai_hop_dong")}}</label>
                    </div>
                    <div class="col-md-7 col-xs-7">
                        <label>{{isset($rsDetail[0]['WorkFormName']) ? $rsDetail[0]['WorkFormName'] : ''}}</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-4">
                <div class="row">
                    <div class="col-md-5 col-xs-5">
                        <label class="lbl-normal">{{Helpers::getRS($g,"Tham_nien_huong_tro_cap_thoi_viec")}}</label>
                    </div>
                    <div class="col-md-7 col-xs-7">
                        <div class="row">
                            <div class="col-md-3 col-xs-3">
                                <label>{{isset($rsDetail[0]['SeniorityYear']) ? $rsDetail[0]['SeniorityYear'] : ''}}</label>
                            </div>
                            <div class="col-md-3 col-xs-3">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Nam")}}</label>
                            </div>
                            <div class="col-md-3 col-xs-3">
                                <label>{{isset($rsDetail[0]['SeniorityMonth']) ? $rsDetail[0]['SeniorityMonth'] : ''}}</label>
                            </div>
                            <div class="col-md-3 col-xs-3">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Thang")}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-4">
                <div class="row">
                    <div class="col-md-5 col-xs-5">
                        <label class="lbl-normal">{{Helpers::getRS($g,"So_thang_huong_tro_cap")}}</label>
                    </div>
                    <div class="col-md-7 col-xs-7">
                        <label>{{isset($rsDetail[0]['SeverancePayMonthNum']) ? $rsDetail[0]['SeverancePayMonthNum'] : ''}}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4 col-xs-4">
                <div class="row">
                    <div class="col-md-5 col-xs-5">
                        <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_het_han_hop_dong")}}</label>
                    </div>
                    <div class="col-md-7 col-xs-7">
                        <label>{{isset($rsDetail[0]['ContractDateEnd']) ? $rsDetail[0]['ContractDateEnd'] : ''}}</label>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="mgt5">
        <legend class="legend">{{Helpers::getRS($g,"Thong_tin_xin_nghi")}}</legend>
        <div class="row form-group">
            <div class="col-md-4 col-xs-4">
                <div class="row">
                    <div class="col-md-5 col-xs-5">
                        <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_du_kien_nghi")}}</label>
                    </div>
                    <div class="col-md-7 col-xs-7">
                        <label>{{isset($rsDetail[0]['DateLeft']) ? $rsDetail[0]['DateLeft'] : ''}}</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-4">
                <div class="row">
                    <div class="col-md-5 col-xs-5">
                        <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_bao_nghi")}}</label>
                    </div>
                    <div class="col-md-7 col-xs-7">
                        <label>{{isset($rsDetail[0]['NoticeDate']) ? $rsDetail[0]['NoticeDate'] : ''}}</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-4">
                <div class="row">
                    <div class="col-md-5 col-xs-5">
                        <label class="lbl-normal">{{Helpers::getRS($g,"So_ngay_bao_truoc")}}</label>
                    </div>
                    <div class="col-md-7 col-xs-7">
                        <label>{{isset($rsDetail[0]['DateNumber']) ? $rsDetail[0]['DateNumber'] : ''}}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4 col-xs-4">
                <div class="row">
                    <div class="col-md-5 col-xs-5">
                        <label class="lbl-normal">{{Helpers::getRS($g,"Ly_do")}}</label>
                    </div>
                    <div class="col-md-7 col-xs-7">
                        <label>{{isset($rsDetail[0]['Reason']) ? $rsDetail[0]['Reason'] : ''}}</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-4 col-xs-4">
                <div class="row">
                    <div class="col-md-5 col-xs-5">
                        <label class="lbl-normal">{{Helpers::getRS($g,"Ghi_chu")}}</label>
                    </div>
                    <div class="col-md-7 col-xs-7">
                        <label>{{isset($rsDetail[0]['Notes']) ? $rsDetail[0]['Notes'] : ''}}</label>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
</form>

<script>
    $(document).ready(function () {

    });

</script>