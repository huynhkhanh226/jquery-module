@if(count($rs))
@extends('layout.component.compare')
@extends('layout.component.editSalaray')
        <!-- Thông tin phiếu -->
<div class="row ">
    <div class="col-md-11 hdDetail">
        <div class="liketext">
            <label class="text-yellow"><b>{{$rs[0]['DivisionName']}} </b></label>
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
<fieldset>
    <legend class="legend mgb5">{{Helpers::getRS($g,"Thong_tin_phieu")}}</legend>
    <div class="row">
        <div class="col-md-4">
            <div class="liketext">
                <label><i class="digi digi-uniE93A mgr5"></i><b>{{$rs[0]['VoucherNo']}} </b></label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="liketext">
                <label class="mgr5" >  {{Helpers::getRS($g,"NVBH")}}</label>
                <label><b>{{$rs[0]['SalesPersonName']}} </b></label>
            </div>

        </div>

        <div class="col-md-4">
            <div class="liketext">
                <label class="mgr5">  {{Helpers::getRS($g,"TPKD")}}</label>
                <label><b>{{$rs[0]['RoomManagerName']}} </b></label>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-10">
            <div class="liketext">
                <label class="mgr5" >  {{Helpers::getRS($g,"KH_Don_vi")}}</label>
                <label> <b><a onclick="ShowInfoCustomer('{{url('/W27F0100/' . $rs[0]['VoucherID'] . "/" .$g ."/" . $rs[0]['ObjectID'] . "/" . $rs[0]['ObjectTypeID'])}}');" style="text-decoration: underline; color: #000">{{$rs[0]['ObjectName']}}</a></b></label>

            </div>
        </div>
        <div class="col-md-2">
            <div class="liketext">
                <button onclick="W27D2245ShowDetail()" class="btn btn-default smallbtn"><i class="fa fa-file-pdf-o mgr5"></i>{{Helpers::getRS($g,'Xem_chi_tiet')}}</button>
            </div>
        </div>

    </div>

    <div class="row">

    </div>
</fieldset>
<!-- Sản phẩm -->
<fieldset>
    <legend class="legend mgb5">{{Helpers::getRS($g,"San_pham")}}</legend>
    <div class="row">
        <div class="col-md-4">
            <div class="liketext">
                <label class="mgr5">  {{Helpers::getRS($g,"Du_an_BDS")}}</label>
                <label><b>{{$rs[0]['PropertyName']}} </b></label>

            </div>
        </div>
        <div class="col-md-4">
            <div class="liketext">
                <label class="mgr5">  {{Helpers::getRS($g,"Ma_BDS")}}</label>
                <label><b>{{$rs[0]['OfficeNo']}} </b></label>
                <b class="clsPending">{{$rs[0]['PropertyTypeName']}}</b>
            </div>
        </div>
        <div class="col-md-3">
            <div class="liketext">
                <label class="mgr5">  {{Helpers::getRS($g,"Tieu_chuan_giao_nha")}}:</label>
                <label><b>{{$rs[0]['DeliveryStandardName']}} </b></label>
            </div>
        </div>
        <div class="col-md-1">
            <div class="liketext">

                <label><i class="digi digi-parkcars mgr5"></i><b>{{intval($rs[0]['Car'])}} </b></label>
            </div>
        </div>
    </div>
    @if($rs[0]['PropertyType']==1)
        <div class="row">
            <div class="col-md-6">
                <div class="liketext">
                    <label class="mgr5">  {{Helpers::getRS($g,"Dien_tich_thong_thuy")}} (1)</label>
                    <label><b>{{number_format($rs[0]['WaterWayArea'], 2,'.', ',')}} m<sup>2</sup></b></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="liketext">
                    <label class="mgr5"> {{ $rs[0]['PropertyType']==1 ?  Helpers::getRS($g,"Dien_tich_tim_tuong") :  Helpers::getRS($g,"Dien_tich_dat")}}</label>
                    <label><b>{{ number_format($rs[0]['WallCenterArea'], 2,'.', ',') }} m<sup>2</sup></b></label>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6">
                <div class="liketext">
                    <label class="mgr5">  {{Helpers::getRS($g,"DG_niem_yet_theo_DT_thong_thuy")}} (2)</label>
                    <label><b>{{number_format(floatval($rs[0]['WaterWayUnitPrice']), 0 ,'.',',')}} {{$rs[0]['CurrencyName']}}/m<sup>2</sup></b></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="liketext">
                    <label class="mgr5">  {{Helpers::getRS($g,"Tri_gia_niem_yet")}}(4) = (1) x (2)</label>
                    <label><b>{{number_format(floatval($rs[0]['TotalOAmount']), 0,'.',',')}}  {{$rs[0]['CurrencyName']}}</b></label>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6">
                <div class="liketext">
                    <label class="mgr5">  {{Helpers::getRS($g,"DG_thuc_ban_theo_DT_thong_thuy")}} (3)</label>
                    <label><b>{{number_format(floatval($rs[0]['RealWWUnitPrice']), 0 ,'.',',')}}  {{$rs[0]['CurrencyName']}}/m<sup>2</sup></b></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="liketext">
                    <label class="mgr5">  {{Helpers::getRS($g,"Tri_gia_thuc_ban")}} (5) = (1) x (3)</label>
                    <label><b>{{number_format(floatval($rs[0]['RealOAmount']),0 ,'.',',')}}  {{$rs[0]['CurrencyName']}}</b>  </label> ({{Helpers::getRS($g,"Chua_bao_gom_2_pham_tram_phi_bao_tri")}})
                </div>
            </div>
        </div>

    @else
        <div class="row" >
            <div class="col-md-6">
                <div class="liketext">
                    <label class="mgr5">  {{Helpers::getRS($g,"Dien_tich_dat")}}</label>
                    <label><b>{{number_format($rs[0]['LandArea'], 2,'.', ',')}} m<sup>2</sup></b></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="liketext">
                    <label class="mgr5"> {{ Helpers::getRS($g,"Dien_tich_san_xay_dung")}} (4)</label>
                    <label><b>{{number_format($rs[0]['BuildArea'], 2,'.', ',')}} m<sup>2</sup></b></label>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6">
                <div class="liketext">
                    <label class="mgr5">  {{Helpers::getRS($g,"Gia_ban_dat")}} (1)</label>
                    <label><b>{{number_format(floatval($rs[0]['LandOAmount']), 0 ,'.',',')}} ({{$rs[0]['CurrencyName']}}, {{Helpers::getRS($g,'gom_VAT')}})</b></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="liketext">
                    <label class="mgr5">  {{Helpers::getRS($g,"Don_gia_xay_dung")}} (5)</label>
                    <label><b>{{number_format(floatval($rs[0]['BuildUnitPrice']), 0,'.',',')}} ({{$rs[0]['CurrencyName']}}, {{Helpers::getRS($g,'gom_VAT')}})</b></label>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6">
                <div class="liketext">
                    <label class="mgr5">  {{Helpers::getRS($g,"Tong_gia_xay_dung")}} (2) = (4) x (5)</label>
                    <label><b>{{number_format(floatval($rs[0]['BuildOAmount']), 0 ,'.',',')}} ({{$rs[0]['CurrencyName']}}, {{Helpers::getRS($g,'gom_VAT')}})</b></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="liketext">
                    <label class="mgr5">  {{Helpers::getRS($g,"Tong_gia_niem_yet")}} (3) = (1) + (2)</label>
                    <label><b>{{number_format(floatval($rs[0]['TotalOAmount']),0 ,'.',',')}} ({{$rs[0]['CurrencyName']}}, {{Helpers::getRS($g,'gom_VAT')}})</b></label>
                </div>
            </div>
        </div>
        <div class="row" >

            <div class="col-md-12">
                <div class="liketext">
                    <label class="mgr5">  {{Helpers::getRS($g,"Tong_gia_thuc_ban")}}</label>
                    <label><b>{{number_format(floatval($rs[0]['RealOAmount']),0 ,'.',',')}}  ({{$rs[0]['CurrencyName']}}, {{Helpers::getRS($g,'gom_VAT')}} {{Helpers::getRS($g,'va_gia_tri_QSDD')}})</b></label>
                </div>
            </div>
        </div>
    @endif
    <div class="row" >
        <div class="col-md-6">
            <div class="liketext">
                <label class="mgr5">  {{Helpers::getRS($g,"Ty_le_giam_gia_them_ngoai_chuong_trinh")}} (a)</label>
                <label><b>{{number_format(floatval($rs[0]['AddRate']), 2 ,'.',',')}}  %</b></label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="liketext">
                <label class="mgr5">  {{Helpers::getRS($g,"Cong_tru_chi_phi_do_thay_doi_lich_thanh_toan")}} (b)</label>
                <label><b>{{number_format(floatval($rs[0]['DiffScheduleRate']),2 ,'.',',')}}  %</b>  </label>
            </div>
        </div>
    </div>
    <div class="row" >
        <div class="col-md-6">
            <div class="liketext text-red">
                <label class="mgr5">  {{Helpers::getRS($g,"Tong_cong_giam_them_ngoai_chuong_trinh")}} (c) = (a) + (b)</label>
                <label><b>{{number_format(floatval($rs[0]['TotalAddRate']), 2 ,'.',',')}}  %</b></label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="liketext">
                <label class="mgr5">  {{Helpers::getRS($g,"_CL_gia_SaleAcc")}}</label>
                <label><b>{{number_format(floatval($rs[0]['DifPercentSaleAcc']),2 ,'.',',')}}  %</b>  </label>
            </div>
        </div>
    </div>
</fieldset>
<!-- đặt cọc & thanh toán -->
<fieldset>
    <legend class="legend mgb5">{{Helpers::getRS($g,"Dat_coc_thanh_toan")}}</legend>
    <div class="row">
        <div class="col-md-3">
            <div class="liketext">
                <label><i class="digi digi-uniE93A mgr5"></i><b>{{$rs[0]['DepositNo']}} </b></label>
            </div>
        </div>
        <div class="col-md-7">
            <div class="liketext">

                <label class="mgr15"><i class="fa fa-dollar mgr5"></i><b>{{number_format(floatval($rs[0]['DepositOAmount']), 0,'.',',')}}  {{$rs[0]['CurrencyName']}}</b></label>
                <label class="mgr15"><i class="fa fa-calendar mgr5"></i><b>{{$rs[0]['DepositDate']}} </b></label>
                <label class="mgr5">  {{Helpers::getRS($g,"Thanh_toan_dot_mot")}}</label>
                <label class="mgr15" ><b>{{number_format(floatval($rs[0]['PaymentPercent1']),2,'.',',')}}%</b></label>
                <label><i class="fa fa-calendar mgr5"></i><b>{{$rs[0]['PaymentDate1']}} </b></label>
            </div>
        </div>


        <div class="col-md-2">
            <div class="liketext">

                <button onclick="ShowCompare()" class="btn btn-default smallbtn">{{Helpers::getRS($g,'So_sanh_LTT')}}</button>
            </div>
        </div>
    </div>

</fieldset>
<!-- lương hiệu quả -->
<fieldset>
    <legend class="legend mgb5">{{Helpers::getRS($g,"Luong_hieu_qua")}}</legend>
    <div class="row">
        <div class="col-md-4">
            <div class="liketext">
                <label class="mgr5">{{Helpers::getRS($g,"Hinh_thuc_BH")}}</label>
                <label ><b>{{$rs[0]['SalesTypeName']}}</b></label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="liketext">
                <label class="mgr5">  {{Helpers::getRS($g,"Cong_tac_vien_cty_moi_gioi")}}</label>
                <label><b>{{$rs[0]['IntermediaryID']}}</b></label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="liketext  pull-right">
                <label class="mgr5">  {{Helpers::getRS($g,"Hoa_hong_CTV_MG")}}</label>
                <label><b>{{number_format($rs[0]['IntermediaryRate'], 2,'.', ',')}}%</b>  </label>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="liketext">
                <label class="mgr5">  {{Helpers::getRS($g,"Luong_hieu_qua_cong_viec")}}</label>

            </div>
        </div>
        <div class="col-md-3">
            <div class="liketext pull-right">
                <label class="text-red lbgray" id="lbEFF">&nbsp;<b>{{number_format(floatval($rs[0]['ESalaryProposalRate']),2,'.',',')}}</b></label><label class="text-red"><b>&nbsp;%</b></label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="liketext">
                <label class="text-red lbgray" id="lbAmo">&nbsp;<b>{{number_format($rs[0]['ESalaryProposalAmount'], 0,'.', ',')}} </b>  </label><label class="text-red"><b>&nbsp;{{$rs[0]['CurrencyName']}}</b></label>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-3">
            <div class="liketext">
                <label>{{Helpers::getRS($g,"Dieu_chinh_luong_HQ_cong_viec")}}</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="liketext pull-right">
                <label class="text-red lbgray" id="txtEFF">&nbsp;<b>{{number_format(floatval($rs[0]['EffectiveSalaryRate']),2,'.',',')}}</b></label><label class="text-red"><b>&nbsp;%</b></label>
            </div>
        </div>
        <div class="col-md-5">
            <div class="liketext">
                <label class="text-red lbgray" id="txtAMO">&nbsp;<b>{{number_format($rs[0]['EffectiveSalaryAmount'], 0,'.', ',')}} </b>  </label><label class="text-red"><b class="mgr15">&nbsp;{{$rs[0]['CurrencyName']}}</b></label>
                <button onclick="ShowEditSalary()" class="btn btn-default smallbtn " {{$rs[0]['IsAdjustEffectiveSalary']==1 ? "" : "disabled"}}><i class="fa fa-edit mgr5"></i>{{Helpers::getRS($g,'Dieu_chinh')}}</button>
            </div>
        </div>

    </div>
    <div class="row" >

    </div>
</fieldset>
<!-- Thông tin chiết khấu khuyến mãi  -->
<fieldset>
    <legend class="legend mgb5">{{Helpers::getRS($g,"Chiet_khau_khuyen_maiU")}}</legend>

    <div class="row">
        <div class="col-md-12">
            <div class="liketext">
                {{$rs[0]['Notes']}}
            </div>
        </div>

    </div>
</fieldset>
<!-- popup thông tin khách hàng -->
<div id="CustomerInfoPop">

</div>

<!-- popup So sánh lịch thanh toán  -->
@section('PCSCContent')
    <div class="row">
        <div class="col-md-3">
            <div class="liketext">
                <label class="mgr5" >  {{ Helpers::getRS($g,"Gia_ban")}}</label>
                <label> <b>{{number_format(floatval($rs[0]['RealOAmount']), 0,'.',',')}}  {{$rs[0]['CurrencyName']}}</b></label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="liketext">
                <label class="mgr5" >  {{ Helpers::getRS($g,"Lai_suat")}}</label>
                <label> <b>{{number_format($rs[0]['InterestRate'], 2,'.', ',')}}%</b></label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="liketext">
                <label class="mgr5" >  {{ Helpers::getRS($g,"Tien_lai_chenh_lech")}} (a) - (b)</label>
                <label> <b class="lcl">{{number_format(0, 0,'.',',')}}</b>  <b>{{$rs[0]['CurrencyName']}}</b></label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="liketext">
                <label class="mgr5" >  % {{ Helpers::getRS($g,"Tang_giam_gia_them")}}</label>
                <label> <b>{{number_format($rs[0]['DiffScheduleRate'], 2,'.', ',')}}%</b></label>
            </div>
        </div>
    </div>

    <div style="border-radius: 4px; border: 1px #ccc solid; margin-bottom: 5px;">
        <div class="row mglr0 bg-gray-active text-white">
            @define $SUMPaymentPercenta=0; $SUMTotalOAmounta=0; $SUMInterestOAmount1a=0; $num=0;
            @foreach($rsDetaila as $row)
                @define $num=$row['Stage'] ; $SUMPaymentPercenta+=$row['PaymentPercent']; $SUMTotalOAmounta+= $row['TotalOAmount'];$SUMInterestOAmount1a+=$row['InterestOAmount'];

            @endforeach

            <div class="col-md-3">
                <div class="liketext">
                    <label> <b>{{Helpers::getRS($g,'Lich_chuan_a')}}</b><i onclick="showTable('divtbla',this);" class="mgl10 fa fa-toggle-down text-orange"></i></label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="liketext">
                    <label> {{Helpers::getRS($g,'So_dot')}} <b class="mgl10">{{$num}}</b></label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="liketext">
                    <label> <i class="fa fa-dollar"></i><b class="mgl10">{{number_format($SUMTotalOAmounta,0, '.', ',')}} {{$rs[0]['CurrencyName']}}</b> </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="liketext">
                    <label> {{Helpers::getRS($g,'Lai')}}<b class="mgl10">{{number_format($SUMInterestOAmount1a,0, '.', ',')}} {{$rs[0]['CurrencyName']}}</b></label>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-12" >
                <div id="divtbla" class="tblStandard">
                    <table id="tbla" cellspacing="5" cellpadding="5" style="border: 1px #111 solid; margin: 5px; width: 100% ;"  >
                        <thead class="bg-gray" >
                        <tr>
                            <th class="text-center no-wrap">{{Helpers::getRS($g,"Dot")}}</th>
                            <th class="text-center no-wrap">{{Helpers::getRS($g,"Ngay_dao_han")}}</th>
                            <th class="text-center no-wrap">{{Helpers::getRS($g,"Ty_le")}}(%)</th>
                            <th class="text-center no-wrap">{{Helpers::getRS($g,"Thanh_tien")}}</th>
                            <th class="text-center no-wrap">{{Helpers::getRS($g,"So_ngay_tinh_lai")}}</th>
                            <th class="text-center no-wrap">{{Helpers::getRS($g,"Lai_nhan_duoc")}}</th>
                            <th class="text-center no-wrap">{{Helpers::getRS($g,"Dien_giai")}}</th>
                        </tr>
                        </thead>
                        <tbody >

                        @foreach($rsDetaila as $row)
                            <tr>
                                <td style="width: 50px;" class="text-center">{{$row['Stage']}}</td>
                                <td style="width: 96px;"  class="text-center">{{$row['ScheduleDate']}}</td>
                                <td  style="width: 62px;"  class="text-right">{{number_format($row['PaymentPercent'], 2, '.', ',').'%'}}</td>
                                <td  style="width: 109px;"  class="text-right">{{number_format($row['TotalOAmount'],0, '.', ',')}}</td>
                                <td style="width: 107px;"  class="text-right">{{$row['InterestDays']}}</td>
                                <td style="width: 98px;"  class="text-right" >{{number_format($row['InterestOAmount'],0, '.', ',')}}</td>
                                <td  >{{$row['Description']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="bg-gray text-bold">
                        <tr>
                            <td colspan="2" class="text-right">
                            </td>
                            <td class="text-right">{{number_format($SUMPaymentPercenta, 2, '.', ',').'%'}}</td>
                            <td class="text-right">{{number_format($SUMTotalOAmounta,0, '.', ',')}}</td>
                            <td></td>
                            <td class="text-right">{{number_format($SUMInterestOAmount1a,0, '.', ',')}}</td>
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>

    </div>
    <div style="border-radius: 4px; border: 1px #ccc solid; margin-bottom: 5px;">
        <div class="row mglr0 bg-gray-active text-white">
            @define $SUMPaymentPercentb=0; $SUMTotalOAmountb=0; $SUMInterestOAmount1b=0; $num=0;
            @foreach($rsDetailb as $row)
                @define $num=$row['Stage'] ; $SUMPaymentPercentb+=$row['PaymentPercent']; $SUMTotalOAmountb+= $row['TotalOAmount'];$SUMInterestOAmount1b+=$row['InterestOAmount'];
            @endforeach
            <div class="col-md-3">
                <div class="liketext">
                    <label> <b>{{Helpers::getRS($g,'Lich_chuan_b')}}</b><i onclick="showTable('divtblb',this);" class="mgl10 fa fa-toggle-down text-orange"></i></label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="liketext">
                    <label> {{Helpers::getRS($g,'So_dot')}} <b class="mgl10">{{$num}}</b></label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="liketext">
                    <label> <i class="fa fa-dollar"></i><b class="mgl10">{{number_format($SUMTotalOAmountb,0, '.', ',')}} {{$rs[0]['CurrencyName']}}</b> </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="liketext">
                    <label> {{Helpers::getRS($g,'Lai')}}<b class="mgl10">{{number_format($SUMInterestOAmount1b,0, '.', ',')}} {{$rs[0]['CurrencyName']}}</b></label>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-12" >
                <div class="tblStandard" id="divtblb">
                    <table id="tbla" cellspacing="5" cellpadding="5" style="border: 1px #111 solid; margin: 5px; width: 100%;"  >
                        <thead class="bg-gray" >
                        <tr>
                            <th class="text-center no-wrap">{{Helpers::getRS($g,"Dot")}}</th>
                            <th class="text-center no-wrap">{{Helpers::getRS($g,"Ngay_dao_han")}}</th>
                            <th class="text-center no-wrap">{{Helpers::getRS($g,"Ty_le")}}(%)</th>
                            <th class="text-center no-wrap">{{Helpers::getRS($g,"Thanh_tien")}}</th>
                            <th class="text-center no-wrap">{{Helpers::getRS($g,"So_ngay_tinh_lai")}}</th>
                            <th class="text-center no-wrap">{{Helpers::getRS($g,"Lai_nhan_duoc")}}</th>
                            <th class="text-center no-wrap">{{Helpers::getRS($g,"Dien_giai")}}</th>
                        </tr>
                        </thead>
                        <tbody >

                        @foreach($rsDetailb as $row)

                            <tr>
                                <td style="width: 50px;" class="text-center">{{$row['Stage']}}</td>
                                <td style="width: 96px;"  class="text-center">{{$row['ScheduleDate']}}</td>
                                <td  style="width: 62px;"  class="text-right">{{number_format($row['PaymentPercent'], 2, '.', ',').'%'}}</td>
                                <td  style="width: 109px;"  class="text-right">{{number_format($row['TotalOAmount'],0, '.', ',')}}</td>
                                <td style="width: 107px;"  class="text-right">{{$row['InterestDays']}}</td>
                                <td style="width: 98px;"  class="text-right" >{{number_format($row['InterestOAmount'],0, '.', ',')}}</td>
                                <td  >{{$row['Description']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="bg-gray text-bold">
                        <tr>
                            <td colspan="2" class="text-right"></td>
                            <td class="text-right">{{number_format($SUMPaymentPercenta, 2, '.', ',').'%'}}</td>
                            <td class="text-right">{{number_format($SUMTotalOAmountb,0, '.', ',')}}</td>
                            <td></td>
                            <td class="text-right">{{number_format($SUMInterestOAmount1b,0, '.', ',')}}</td>
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>

    </div>

    @stop
            <!-- pop up Điều chỉnh lương hiệu quả công việc -->
@section('edlContetn')
    <div class="row">
        <div class="col-md-5">
            <label class="mgl15 nm">
                {{Helpers::getRS($g,"Luong_HQ_cong_viec_de_xuat")}}
            </label>

        </div>
        <div class="col-md-3">
            <div class="liketext">
                <label class="text-red lbgray" id="lbEFF">&nbsp;<b>{{number_format(floatval($rs[0]['ESalaryProposalRate']),2,'.',',')}}</b></label><label class="text-red"><b>&nbsp;&nbsp;%</b></label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="liketext">
                <label class="text-red lbgray" id="lbAmo">&nbsp;<b>{{number_format($rs[0]['ESalaryProposalAmount'], 0,'.', ',')}} </b>  </label><label class="text-red"><b>&nbsp;&nbsp;{{$rs[0]['CurrencyName']}}</b></label>
            </div>
        </div>

    </div>
    <div class="row">
        <form id="frmSaveSalary" method="post">


            <div class="col-md-5">
                <label class="mgl15 nm">
                    {{Helpers::getRS($g,"Luong_HQ_cong_viec_dieu_chinh")}}
                </label>
            </div>
            <div class="col-md-3">
                <input type="number" class=" hdSpin text-right" style="width: 120px;padding-right: 5px;" value="{{number_format(floatval($rs[0]['EffectiveSalaryRate']),2,'.',',')}}" id="eff" name="eff"  min="0.00" oninvalid="this.setCustomValidity('{{Helpers::getRS($g,"Ty_le_khong_hop_le")}}')" max="100" step="0.01"   required />
                <label class="text-red mgt5"><b>&nbsp;%</b></label>
            </div>

            <div class="col-md-4">
                <input type="text" class="hdSpin text-right" style="width: 120px; padding-right: 5px;" value="{{number_format($rs[0]['EffectiveSalaryAmount'], 0,".","")}}" id="amo" name="amo"  oninvalid="this.setCustomValidity('{{Helpers::getRS($g,"Bat_buoc_nhap")}}')"  required /><label class="text-red mgt5"><b>&nbsp;&nbsp;{{$rs[0]['CurrencyName']}}</b></label>
            </div>

            <div class="form-group">
                <div class="col-md-11 mgt10">
                    <button type="submit" id="frm_btnSave" class="btn btn-default smallbtn pull-right  mgr20"><span class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-12 mgt10">
            <div class="alert alert-success alert-dismissable hide">

                <i class="icon fa fa-check"></i>   {{Helpers::getRS($g,"Du_lieu_da_luu_thanh_cong")}}!.
            </div>
            <div class="alert alert-danger alert-dismissable hide">
                <i class="icon fa fa-ban"></i>  <span id="err">{{Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu")}}!</span>
            </div>
        </div>
    </div>
@stop
@define $g=2;
@define $mod="D27";
@if(floatval($rs[0]['CountFileAttachment'])>0)
    @extends('W9X.W91.W91F4010')
@endif
<script type="text/javascript">
    var ShowInfoCustomer=function(url){
        $.ajax({
            method: "GET",
            url: url,
            success: function (data) {
                $("#CustomerInfoPop").html(data);
                $("#CustomerInfoPop").find("#mPopUpCustomer").modal('show');

            }
        });
    };
    var oTable;

    $(document).ready( function () {
        $("#amo").inputmask('999,999,999,999', { numericInput: true });
        $(".lcl").text(format2({{$SUMInterestOAmount1a - $SUMInterestOAmount1b}}),"",0);
    });
    var ShowCompare= function () {
        //
        $("#mPopUpCompareSC").modal('show');
    };
    var ShowEditSalary= function () {
        $("#mPopUpEditSalary").find(".alert-success").addClass('hide');
        $("#mPopUpEditSalary").find(".alert-danger").addClass('hide');
        $("#mPopUpEditSalary").modal('show');
    };
    var arrTable=[];
    var showTable= function (id,el) {
        var index = arrTable.indexOf(id);
        if($(el).hasClass('fa-toggle-down')) {
            if(index==-1) arrTable.push(id);
            $(el).removeClass('fa-toggle-down').addClass('fa-toggle-up');
        }
        else if($(el).hasClass('fa-toggle-up')) {
            arrTable.splice(index, 1);
            $(el).removeClass('fa-toggle-up').addClass('fa-toggle-down');
        }
        if(arrTable.length==1) {

            $("#"+arrTable[0]).addClass('height500');
        }
        if(arrTable.length==2) {
            $.each( arrTable, function( key, value ) {
                $("#" +value).removeClass('height500');
            });

            $("#divtblb").removeClass('height500');
        }
        $("#"+id).toggle();
    };
    $("#mPopUpEditSalary").on('submit','#frmSaveSalary',function (e) {
        e.preventDefault();
        var eff=$("#frmSaveSalary").find("#eff").val();
        var amo=$("#amo").inputmask('unmaskedvalue');
        var voucherRow = getCurrentVoucherID();
        $.ajax({
            method: "POST",
            url: "{{url("W27P2258/update/" . $vou)}}",
            data: {eff: eff, amo:amo, approvalLevel: voucherRow.ApprovalLevel } ,
            success: function (data) {

                if(data=="1") {
                    $("#mPopUpEditSalary").find(".alert-success").removeClass('hide');
                    $("#mPopUpEditSalary").find(".alert-danger").addClass('hide');

                    //  $("#lbEFF b").html(eff + "%");
                    // $("#lbAmo b").html(amo.replace(/\B(?=(\d{3})+\b)/g, ",") + " {{$rs[0]['CurrencyName']}}");
                    $("#txtEFF b").html(eff);
                    $("#txtAMO b").html(amo.replace(/\B(?=(\d{3})+\b)/g, ","));
                }
                else {

                    $("#mPopUpEditSalary").find(".alert-success").addClass('hide');
                    $("#mPopUpEditSalary").find(".alert-danger").removeClass('hide');
                }


            }
        });


    });
    var W27D2245ShowDetail= function () {
        $("#modalW27F2245").find(".l3loading").removeClass('hide');

        showFormDialogPost("{{url("/W27F2245/Report/" . $vou )}}","modalPDFViewer", {ObjectTypeID: '{{$rs[0]['ObjectTypeID']}}', ObjectID: '{{$rs[0]['ObjectID']}}'},2);

        /*$.ajax({
            method: "POST",
            {{--url: "{{url("/W27F2245/Report/" . $vou )}}",--}}
            data: {ObjectTypeID: '{{$rs[0]['ObjectTypeID']}}', ObjectID: '{{$rs[0]['ObjectID']}}'},
            success: function (data) {
                $("#modalW27F2245").find(".l3loading").addClass('hide');
                window.open(data.trim(), "_blank");
            }
        });*/
    };
</script>
@endif
