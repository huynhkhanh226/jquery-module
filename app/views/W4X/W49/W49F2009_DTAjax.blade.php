@if(count($rs))
    <div class="row ">
        <div class="col-md-11 hdDetail">
            <div class="liketext">
                <label class="text-yellow"><b>{{$rs[0]['DivisionName']}}</b></label>
            </div>
        </div>
        <div class="col-md-1 hdDetail">
            <div class="liketext">
                @if(floatval($rs[0]['CountFileAttachment'])>0)
                    <a class="fa fa-paperclip text-orange" onclick='$("#modalW91F4010").modal("show");'>
                        ({{$rs[0]['CountFileAttachment']}})
                    </a>
                @else
                    <label></label>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-xs-3">
            <div class="radio pdl0mg5">
                <label class="nm">
                    <input type="radio"
                           {{ $rs[0]['IsProject']==0 ? 'checked="checked"' : "" }} disabled="">{{Lang::get("message.Ngoai_DA")}}
                </label>
                <label class="pull-right nm">
                    <input type="radio"
                           {{ $rs[0]['IsProject']==1 ? 'checked="checked"' : "" }} disabled="">{{Lang::get("message.Trong_DA")}}
                </label>
            </div>
        </div>
        <div class="col-md-4 col-xs-4">
            <div class="liketext">
                <label id="txtProjectName"><b>{{ $rs[0]['ProjectName']}}</b></label>
            </div>
        </div>
        <div class="col-md-5">
            <div class="liketext">
                <label class="mgr10" style="width: 60px">{{Helpers::getRS($g,"YCPS")}}</label>
                @if($rs[0]['AriseApprovalType']==1)
                    <label><b>{{Helpers::getRS($g,"Phat_sinh_moi")}}</b></label>
                @elseif($rs[0]['AriseApprovalType']==2)
                    <label><b>{{Helpers::getRS($g,"Phat_sinh_tanggiam")}}</b></label>
                @else
                    <label><b>{{Helpers::getRS($g,"Thay_doi_dieu_khoản_phap_ly_HD_chinh")}}</b></label>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="liketext">
                <label class="mgr10" style="width: 100px">{{Helpers::getRS($g,"Hang_muc")}}</label>
                <label><b>{{$rs[0]['TaskName']}} </b></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="liketext">
                <label class="mgr10" style="width: 100px">{{Helpers::getRS($g,"PP_chon_thau")}}</label>
                @if($rs[0]['IsSelectMethod']==0)
                    <label><b>{{Helpers::getRS($g,"Chi_dinh_thau")}}</b></label>
                @elseif($rs[0]['IsSelectMethod']==1)
                    <label><b>{{Helpers::getRS($g,"Dau_thau")}}</b></label>
                @else
                    <label><b>{{Helpers::getRS($g,"Chao_gia_canh_tranh")}}</b></label>
                @endif
            </div>
        </div>
        <div class="col-md-8">
            <div class="liketext">
                <label class="mgr10" style="width: 80px">{{Helpers::getRS($g,"Dang_PS_HD")}}</label>
                @if($rs[0]['ContractType']==1)
                    <label><b>{{Helpers::getRS($g,"Chi_dinh_nha_thau_phu_cho_nha_thau_chinh")}}</b></label>
                @else
                    <label><b>{{Helpers::getRS($g,"Ky_thoa_thuan_truc_tiep")}}</b></label>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="liketext">
                <label class="mgr10" style="width: 100px">{{Helpers::getRS($g,"Nha_thau_chinh")}}</label>
                <label><b>{{$rs[0]['ObjectName']}} </b></label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="liketext">
                <label class="mgr10">  {{Helpers::getRS($g,"So_HD_chinh")}}</label>
                <label><b>{{$rs[0]['MainContractNo']}} </b></label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="liketext">
                <label class="mgr10">  {{Helpers::getRS($g,"Ngay_ky_HD")}}</label>
                <label><b>{{$rs[0]['SignDate']}} </b></label>
            </div>
        </div>
    </div>
    <fieldset>
        <legend class="legend mgb5">{{Helpers::getRS($g,"Noi_dung_phat_sinh")}}</legend>
        <div class="row">
            <div class="col-md-7">
                <div class="liketext">
                    <label class="mgr10" style="width: 135px">{{Helpers::getRS($g,"Noi_dung_cong_viec")}}</label>
                    <label><b>{{$rs[0]['Notes']}}</b></label>
                </div>
            </div>
            <div class="col-md-5">
                <div class="liketext">
                    <label class="mgr10">{{Helpers::getRS($g,"Ngan_sach_thuc_hien")}} (-VAT)</label>
                    <label style="clear: both;"
                           class="pull-right"><b>{{number_format(floatval($rs[0]['TotalBudgetOAmount']),$rs[0]['OriginalDecimal'])}} <span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="liketext">
                    <label class="mgr10" style="width: 135px">{{Helpers::getRS($g,"Nha_thau_thuc_hien")}}</label>
                    <label><b>{{$rs[0]['ContractorName']}}</b></label>
                </div>
            </div>
            <div class="col-md-5">
                <div class="liketext">
                    <label class="mgr10">{{Helpers::getRS($g,"HD_chinh_da_ky")}} (+VAT)</label>
                    <label style="clear: both;"
                           class="pull-right"><b>{{number_format(floatval($rs[0]['OTotal']),$rs[0]['OriginalDecimal'])}}
                            &nbsp;<span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="liketext">
                    <label class="mgr10" style="width: 135px">{{Helpers::getRS($g,"Dia_chi_tru_so")}}</label>
                    <label><b>{{$rs[0]['ContractorAddress']}}</b></label>
                </div>
            </div>
            <div class="col-md-5">
                <div class="liketext">
                    <label class="mgr10">{{Helpers::getRS($g,"Tong_PS_cac_dot_truoc")}} (+VAT)</label>
                    <label style="clear: both;"
                           class="pull-right"><b>{{number_format(floatval($rs[0]['TotalAccuSubCTOAmt']),$rs[0]['OriginalDecimal'])}}
                            &nbsp;<span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="liketext">
                    <label class="mgr10" style="width: 135px">{{Helpers::getRS($g,"Ma_HD_phu")}}</label>
                    <label><b>{{$rs[0]['ContractNo']}}</b></label>
                </div>
            </div>
            <div class="col-md-5">
                <div class="liketext">
                    <label class="mgr10">{{Helpers::getRS($g,"PS_lan_nay")}} (+VAT)</label>
                    <label style="clear: both;"
                           class="pull-right"><b>{{number_format(floatval($rs[0]['TotalAriseOAmt']),$rs[0]['OriginalDecimal'])}}
                            &nbsp;<span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="liketext">
                    <label class="mgr10" style="width: 135px">{{Helpers::getRS($g,"Dieu_kien_thanh_toan")}}</label>
                    <label><b>{{$rs[0]['ConditionPayment']}}</b></label>
                </div>
            </div>
            <div class="col-md-5">
                <div class="liketext">
                    <label class="mgr10">{{Helpers::getRS($g,"Tong_gia_tri_HD_dieu_chinh")}} (+VAT)</label>
                    <label style="clear: both;"
                           class="pull-right"><b>{{number_format(floatval($rs[0]['TotalOAmount']),$rs[0]['OriginalDecimal'])}}
                            &nbsp;<span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="liketext">
                    <label class="mgr10" style="width: 135px">{{Helpers::getRS($g,"Thoi_gian_thuc_hien")}}</label>
                    <label><b>{{$rs[0]['ValidTime']}}&nbsp;{{Helpers::getRS($g,"Ngay")}}</b></label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="liketext">
                    <label><i class="fa fa-calendar"></i>&nbsp;<b>{{$rs[0]['StartDate']}}</b></label> -
                    <label><b>{{$rs[0]['FinishDate']}}</b></label>
                </div>
            </div>
            <div class="col-md-5">
                <div class="liketext">
                    <label class="mgr10">{{Helpers::getRS($g,"Da_thanh_toan")}} (+VAT)</label>
                    <label style="clear: both;"
                           class="pull-right"><b>{{number_format(floatval($rs[0]['AccuPaymentOAmt']),$rs[0]['OriginalDecimal'])}}
                            &nbsp;<span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="liketext checkbox">
                    <label>
                        <input type="checkbox"
                               {{ $rs[0]['IsExchangeProduct']==1 ? 'checked="checked"' : "" }}  disabled><b>{{Helpers::getRS($g,"Trao_doi_san_pham")}}</b>
                        <b>{{$rs[0]['ProjectExchange']}}</b>
                    </label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="liketext">
                    <label class="mgr10">{{Helpers::getRS($g,"Gia_tri_trao_doi")}}</label>
                    <label><b>{{number_format(floatval($rs[0]['ExchangeOAmount']),$rs[0]['OriginalDecimal'])}}
                            &nbsp;<span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                </div>
            </div>
            <div class="col-md-3 pdl0">
                <div class="liketext pull-right">
                    <label class="mgr10">{{Helpers::getRS($g,"Ti_le_can_tru")}}</label>
                    <label style="clear: both;"><b>{{number_format(floatval($rs[0]['DeductRate']),2)}}%</b></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="liketext">
                    <label class="mgr10">{{Helpers::getRS($g,"Giai_trinh_phat_sinh")}}</label>
                    <label><b>{{$rs[0]['ExplainArise']}}</b></label>
                </div>
            </div>
        </div>
    </fieldset>
    @if(floatval($rs[0]['CountFileAttachment'])>0)
        @extends('W9X.W91.W91F4010')
    @endif
@endif
