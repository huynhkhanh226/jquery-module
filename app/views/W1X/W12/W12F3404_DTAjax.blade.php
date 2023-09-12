@if(count($rsMaster))
    @define $rs=$rsMaster
    <div class="row form-group">
        <div class="col-md-11 hdDetail">
            <div class="liketext">
                <label class="text-yellow"><b>{{$rsMaster[0]['DivisionName']}}</b></label>
            </div>
        </div>
        <div class="col-md-1 hdDetail">
            <div class="liketext">
                @if(floatval($rsMaster[0]['CountFileAttachment'])>0)
                    <a class="fa fa-paperclip text-orange" onclick='$("#modalW91F4010").modal("show");'>
                        ({{$rsMaster[0]['CountFileAttachment']}})
                    </a>
                @else
                    <label></label>
                @endif
            </div>
        </div>
    </div>
    <!-- Row 1 -->
    <div class="row form-group">
        <div class="col-md-3 col-xs-3">
            <div class="radio pdl0mg5">
                <label class="nm">
                    <input type="radio"
                           {{ $rsMaster[0]['IsProject']==0 ? 'checked="checked"' : "" }} disabled="">{{Lang::get("message.Ngoai_DA")}}
                </label>
                <label class="pull-right nm">
                    <input type="radio"
                           {{ $rsMaster[0]['IsProject']==1 ? 'checked="checked"' : "" }} disabled="">{{Lang::get("message.Trong_DA")}}
                </label>
            </div>
        </div>

        <div class="col-md-2 col-xs-2">
            <div class="liketext">
                <label id="txtProjectName"><b>{{ $rsMaster[0]['ProjectName']}}</b></label>
            </div>
        </div>
        <div class="col-md-4 col-xs-4">
            <div class="row form-group">
                <div class="col-sm-4 col-xs-4">
                    <div class="liketext">
                        <label class="lbl-normal ">{{Lang::get("message.Hang_muc")}}</label>
                    </div>
                </div>
                <div class="col-sm-8 col-xs-8">
                    <div class="liketext">
                        <label id="txtTaskName"><b>{{ $rsMaster[0]['TaskName']}}</b></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-3">
            <div class="liketext pull-right">
                <i class="digi digi-uniE949 mgr5"></i>
                <label id="txtVoucherNo"><b>{{ $rsMaster[0]['VoucherNo']}}</b></label>
            </div>
        </div>
    </div>

    <!-- Row 3 -->
    <div class="row form-group">
        <div class="col-md-2 col-xs-2">
            <div class="liketext">
                <label class="lbl-normal ">{{Lang::get("message.Phuong_phap_chon")}}</label>
            </div>
        </div>
        <div class="col-md-3 col-xs-3">
            <div class="liketext">
                @if ( $rsMaster[0]['IsSelectMethod']==1)
                    <label><b>{{Lang::get("message.Chao_gia_canh_tranh")}}</b></label>
                @endif
                @if ( $rsMaster[0]['IsSelectMethod']==5)
                    <label><b>{{Lang::get("message.Dau_thau")}}</b></label>
                @endif
                @if ( $rsMaster[0]['IsSelectMethod']==4)
                    <label><b>{{Lang::get("message.Chi_dinh_thau")}}</b></label>
                @endif
                @if ( $rsMaster[0]['IsSelectMethod']==6)
                    <label><b>{{Lang::get("message.BPMH_de_xuat")}}</b></label>
                @endif
                @if ( $rsMaster[0]['IsSelectMethod']==2)
                    <label><b>{{Lang::get("message.Theo_don_hang_cu")}}</b></label>
                @endif
                @if ( $rsMaster[0]['IsSelectMethod']==3)
                    <label><b>{{Lang::get("message.Theo_chap_thuan_vat_tu")}}</b></label>
                @endif
            </div>
        </div>
        <div class="col-md-3 col-xs-3">
            <div class="checkbox" style="margin-top:5px !important">
                <label class="nm">
                    <input type="checkbox" id='chkIsAssignSubContractor'
                           {{ $rsMaster[0]['IsAppointSubContractor']==1 ? 'checked="checked"' : "" }}  disabled="true"/>
                    {{Lang::get("message.Chi_dinh_nha_thau_phu")}}
                </label>
            </div>
        </div>
        <div class="col-md-2 col-xs-2">
            <div class="liketext">
                <label class="lbl-normal ">{{Lang::get("message.Ngan_sach")}}</label>
            </div>
        </div>
        <div class="col-md-2 col-xs-2">
            <div class="liketext pull-right">
                <label id="txtTotalBudgetOAmt"><b>{{ number_format($rsMaster[0]['TotalBudgetOAmt'],$rsMaster[0]['OriginalDecimal'])}}
                        &nbsp;<span class="lbl-normal">{{$rsMaster[0]["CurrencyID"]}}</span></b></label>
            </div>
        </div>
    </div>
@endif

<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#rate_W12F3404"><b>{{Lang::get("message.Thong_tin_danh_gia")}}</b></a>
    </li>
    <li><a data-toggle="tab" href="#pack_W12F3404"><b>{{Lang::get("message.Thong_tin_goi_thau")}}</b></a></li>
    <li><a data-toggle="tab" href="#products_W12F3404"><b>{{Lang::get("message.Thong_tin_mua_hang")}}</b></a></li>
</ul>
<div id="divW12F3404">
    <div class="tab-content">
        <div id="rate_W12F3404" class="tab-pane fade in active" style="padding:10px">
            <div id="container003" style="width: 100%;height:auto; overflow:auto">
                <table id="tbl_D12F3404" class="nowrap tbl" cellspacing="0" width="100%" role="grid"
                       style="width: 100%;">
                    <thead id="head_toggle" class="">
                    <tr>
                        <th colspan="{{count($rsCols)* 2 + 3}}" style="text-align: left !important;"><i
                                    class="fa fa-eye"
                                    style="padding-right:5px"></i>
                            {{mb_strtoupper(Lang::get("message.Thong_tin_nha_cung_cap_nha_thau"))}}
                        </th>
                    </tr>
                    </thead>
                    <tbody id="body_toggle" style="display: none;">
                    @foreach($rsSupplier as $row )
                        <tr>
                            <td align="center">{{$row['OrderNo']}}</td>
                            <td align="left" colspan="2">{{$row['Description']}}</td>
                            @foreach($rsCols as $rowcol )
                                <td align="left" colspan="2"><b>{{$row['ObjectID_'.$rowcol['FieldName']]}}</b></td>
                            @endforeach
                        </tr>
                    @endforeach

                    </tbody>
                    <thead class="">
                    <tr>
                        <th colspan="{{count($rsCols)*2 + 6}}"
                            style="text-align: left !important">{{mb_strtoupper(Lang::get("message.Danh_gia_NCC_NT_theo_muc_tieu_gia"))}}
                        </th>
                    </tr>
                    </thead>
                    <thead class="">
                    <tr>
                        <th rowspan="2" style="width:10px">{{Lang::get("message.STT")}}</th>
                        <th rowspan="2" style="width:170px">{{Lang::get("message.Tieu_chi_danh_gia")}}</th>
                        <th rowspan="2" style="width:80px">{{Lang::get("message.Trong_so")}}</th>
                        @foreach($rsCols as $rowcol )
                            <th colspan="2">{{$rowcol["Caption"]}}</th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach($rsCols as $rowcol )
                            <th>{{Lang::get("message.Diem1")}}</th>
                            <th>{{Lang::get("message.Diem_trong_so")}}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @define $sum_row = 0; $sum_rate = 0; $sum_rate_ratio = 0;
                    @foreach($rsRate as $rowrate )
                        @define $sum_row += 1; $sum_rate += $rowrate['Rate'];
                        <tr>
                            <td align="center">{{$rowrate['OrderNo']}}</td>
                            <td align="left">{{$rowrate['NormName']}}</td>
                            <td align="center">{{number_format($rowrate['Rate']*100,0).'%'}}</td>
                            @foreach($rsCols as $rowcol )
                                <td align="right"
                                    style="width:130px">{{number_format($rowrate['Ratio_'.$rowcol['FieldName']],2)}}</td>
                                <td align="right" style="width:130px"
                                    colspan="1">{{number_format($rowrate['RateRatio_'.$rowcol['FieldName']],2)}}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td align="right" colspan="2"><b>{{"(".$sum_row.")"}}</b></td>
                        <td align="center"><b>{{number_format($sum_rate * 100,0).'%'}}</b></td>
                        @foreach($rsCols as $rowcol )
                            <td align="right"></td>
                            <td align="right" colspan="1">
                                <b>{{number_format(Helpers::sumFooter($rsRate,'RateRatio_'.$rowcol['FieldName']),2)}}</b>
                            </td>
                        @endforeach

                    </tr>
                    <!-- Phan danh cho subrate -->
                    <tr>
                        <td align="left" colspan="3">{{Lang::get("message.Chap_thuan_NCC_Nha_thau")}}</td>
                        @define $i= 0;
                        @foreach($rsCols as $rowcol )
                            @foreach($rsSubRate as $rowsubrate )
                                @define $ck =($rowsubrate['ObjectID_'.$rowcol['FieldName']] == "1") ? 'checked' :  '';
                                <td align="center" colspan="{{2}}"><input type='checkbox' {{$ck}} disabled/></td>
                                @define $i+= 1;
                            @endforeach
                        @endforeach
                    </tr>
                    <tr>
                        <td align="left"
                            colspan="3">{{Lang::get("message.Ly_do_chap_thuan_NCC_NT_hoac_luu_y_quan_trong_khac")}}</td>
                        <td align="center" colspan="{{count($rsCols)*2}}}}">{{$rsMaster[0]['Reason']}}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>


        </div>

        <div id="pack_W12F3404" class="tab-pane fade in" style="padding:10px">
            @if(count($rsMaster))
                <div class="row form-group">
                    <div class="col-md-3 col-xs-3">
                        <div class="liketext">
                            <label class="lbl-normal ">{{Lang::get("message.Gia_tri_truoc_thue")}}</label>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-3">
                        <div class="row ">
                            <div class="col-md-4 col-xs-4" style="padding: 0px">
                                <div class="liketext pull-right pdl0 mgr10">
                                    <label id="txtBeforeTaxAmount"><b>{{number_format($rsMaster[0]['BeforeTaxAmount'],$rsMaster[0]['OriginalDecimal'])}}</b></label>
                                </div>
                            </div>
                            <div class="col-md-8 col-xs-8" style="padding: 0px">
                                <div class="liketext pull-left pdl0 mgr10">
                                    {{$rsMaster[0]['CurrencyID']}}
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="row ">
                            <div class="col-md-4 col-xs-4" style="padding: 0px">
                                <div class="liketext">
                                    <label class="lbl-normal ">{{Lang::get("message.Thoi_gian_thuc_hien")}}</label>
                                </div>
                            </div>
                            <div class="col-md-8 col-xs-8" style="padding: 0px">
                                <div class="liketext">
                                    <label id="txtActiveTime"><b>{{ $rsMaster[0]['ActiveTime']}}</b>&nbsp;<i>({{Lang::get("message.Ngay")}}
                                            )</i></label>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <!-- Row 1 -->
                <div class="row form-group">
                    <div class="col-md-3 col-xs-3">
                        <div class="liketext">
                            <label class="lbl-normal ">{{Lang::get("message.Thue_VAT")}} </label>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-3">
                        <div class="row ">
                            <div class="col-md-4 col-xs-4" style="padding: 0px">
                                <div class="liketext pull-right pdl0 mgr10">
                                    <label id="txtVATAmount"><b>{{number_format($rsMaster[0]['VATAmount'],$rsMaster[0]['OriginalDecimal'])}}</b></label>
                                </div>
                            </div>
                            <div class="col-md-8 col-xs-8" style="padding: 0px">
                                <div class="liketext pull-left pdl0 mgr10">
                                    {{$rsMaster[0]['CurrencyID']}}
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="row ">
                            <div class="col-md-4 col-xs-4" style="padding: 0px">
                                <div class="liketext">
                                    <label class="lbl-normal ">{{Lang::get("message.Ngay_bat_dau")}}</label>
                                </div>
                            </div>
                            <div class="col-md-8 col-xs-8" style="padding: 0px">
                                <div class="liketext">
                                    <label id="txtStartDate"><b>{{ $rsMaster[0]['StartDate']}}</b></label>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <!-- Row 2 -->
                <div class="row form-group">
                    <div class="col-md-3 col-xs-3">
                        <div class="liketext">
                            <label class="lbl-normal ">{{Lang::get("message.Tong_cong_gia_tri")}}</label>
                        </div>

                    </div>
                    <div class="col-md-3 col-xs-3">
                        <div class="row ">
                            <div class="col-md-4 col-xs-4" style="padding: 0px">
                                <div class="liketext pull-right pdl0 mgr10">
                                    <label id="txtTotalAmount"><b>{{ number_format($rsMaster[0]['TotalAmount'],$rsMaster[0]['OriginalDecimal'])}}</b></label>
                                </div>
                            </div>
                            <div class="col-md-8 col-xs-8" style="padding: 0px">
                                <div class="liketext pull-left pdl0 mgr10">
                                    {{$rsMaster[0]['CurrencyID']}}
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 col-xs-6">
                        <div class="row ">
                            <div class="col-md-4 col-xs-4" style="padding: 0px">
                                <div class="liketext">
                                    <label class="lbl-normal ">{{Lang::get("message.Ngay_hoan_thanh")}}</label>
                                </div>
                            </div>
                            <div class="col-md-8 col-xs-8" style="padding: 0px">
                                <div class="liketext">
                                    <label id="txtCompleteDate"><b>{{ $rsMaster[0]['CompleteDate']}}</b></label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <fieldset>
                    <legend class="legend"></legend>
                    <!-- Row 3 -->
                    <div class="row form-group">
                        <div class="col-md-3 col-xs-3">
                            <div class="liketext">
                                <label class="lbl-normal ">{{Lang::get("message.Dieu_kien_thanh_toan")}}</label>
                            </div>
                        </div>
                        <div class="col-md-9 col-xs-9 pdl0">
                            <div class="liketext">
                                <label><b>{{ $rsMaster[0]['PaymentCondition']}}</b></label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="legend"></legend>
                    <!-- Row 4 -->
                    <div class="row form-group">
                        <div class="col-md-3 col-xs-3">
                            <div class="liketext">
                                <label class="lbl-normal ">{{Lang::get("message.Du_an_trao_doi_san_pham")}}</label>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-3 pdl0">
                            <div class="liketext">
                                <label id="txtProjectExchange"><b>{{ $rsMaster[0]['ProjectExchange']}}</b></label>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                            <div class="row ">
                                <div class="col-md-4 col-xs-4" style="padding: 0px">
                                    <div class="liketext">
                                        <label class="lbl-normal ">{{Lang::get("message.Gia_tri_trao_doi")}}</label>
                                    </div>
                                </div>
                                <div class="col-md-8 col-xs-8" style="padding: 0px">
                                    <div class="liketext">
                                        <label id="txtExchangeValue"><b>{{number_format($rsMaster[0]['ExchangeValue'],$rsMaster[0]['OriginalDecimal']).' '}}
                                                <span class="lbl-normal">{{$rsMaster[0]["CurrencyID"]}}</span></b></label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row 5 -->
                    <div class="row form-group">
                        <div class="col-md-3 col-xs-3">
                            <div class="liketext">
                                <label class="lbl-normal ">{{Lang::get("message.Chi_tiet_trao_doi")}}</label>
                            </div>
                        </div>
                        <div class="col-md-9 col-xs-9 pdl0">
                            <div class="liketext">
                                <label id="txtNotes"><b>{{ $rsMaster[0]['Notes']}}</b></label>
                            </div>
                        </div>
                    </div>
                </fieldset>
            @endif
        </div>

        <div id="products_W12F3404" class="tab-pane fade " style="padding:10px;width:100%;">
            <div id="container002" style="width: 100%;height:auto; overflow:auto">
                <table id="tbl_D12F3404_1" class="nowrap tbl" cellspacing="5" role="grid"
                       style="width: 100%;">
                    <thead>
                    <tr>
                        <th rowspan="2">{{Lang::get("message.STT")}}</th>
                        <th rowspan="2" style="min-width: 100px">{{Lang::get("message.Du_an")}}</th>
                        <th rowspan="2" style="min-width: 220px">{{Lang::get("message.Hang_muc")}}</th>
                        @if ($rsMaster[0]['IsNotFollowQTY'] == 0)
                            <th rowspan="2" style="min-width: 170px">{{Lang::get("message.Hang_hoa_Dich_vu")}}</th>
                        @endif
                        <th rowspan="2" style="min-width: 80px">{{Lang::get("message.TSKT")}}</th>
                        <th rowspan="2" style="min-width: 60px">{{Lang::get("message.DVT")}}</th>
                        @if ($rsMaster[0]['IsNotFollowQTY'] == 0)
                            <th rowspan="2" style="min-width: 80px">{{Lang::get("message.So_luong")}}</th>
                        @endif
                        @if ($rsMaster[0]['IsNotFollowQTY'] == 1)
                            <th rowspan="2" style="min-width: 110px">{{Lang::get("message.Thanh_tien")}}</th>
                        @endif
                        @foreach($rsCols as $rowcol )
                            <th colspan="4">{{$rowcol["Caption"]}}</th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach($rsCols as $rowcol )
                            @if ($rsMaster[0]['IsNotFollowQTY'] == 0)
                                <th style="min-width: 170px">{{Lang::get("message.Hang_hoa_Dich_vu_chi_tiet")}}</th>
                                <th style="min-width: 80px">{{Lang::get("message.So_luong")}}</th>
                                <th style="min-width: 110px">{{Lang::get("message.Don_gia")}}</th>
                            @endif
                            <th style="min-width: 110px">{{Lang::get("message.Thanh_tien")}}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rsProduct as $rowproduct )
                        <tr>
                            <td align="center">{{$rowproduct['OrderNo']}}</td>
                            <td align="left">{{$rowproduct['ProjectName']}}</td>
                            <td align="left">{{$rowproduct['TaskName']}}</td>
                            @if ($rsMaster[0]['IsNotFollowQTY'] == 0)
                                <td align="left"> {{$rowproduct['InventoryName']}}</td>
                            @endif
                            <td align="left">{{$rowproduct['ParameterTechnical']}}</td>
                            <td align="center">{{$rowproduct['UnitID']}}</td>
                            @if ($rsMaster[0]['IsNotFollowQTY'] == 0)
                                <td align="right">{{number_format($rowproduct['OQuantity'],Session::get("W91P0000")['D07_QuantityDecimals'])}}</td>
                            @endif
                            @if ($rsMaster[0]['IsNotFollowQTY'] == 1)
                                <td align="right">{{number_format($rowproduct['OAmount'],$rsMaster[0]['OriginalDecimal'])}}</td>
                            @endif
                            @foreach($rsCols as $rowcol )
                                @if ($rsMaster[0]['IsNotFollowQTY'] == 0)
                                    <td align="left">{{$rowproduct['DetailInventoryName_'.$rowcol['FieldName']]}}</td>
                                    <td align="right">{{number_format($rowproduct['DetailOQuantity_'.$rowcol['FieldName']],Session::get("W91P0000")['D07_QuantityDecimals'] )}}</td>
                                    <td align="right">{{number_format($rowproduct['UnitPrice_'.$rowcol['FieldName']],$rsMaster[0]['UnitPriceDecimals'])}}</td>
                                @endif
                                <td align="right">{{number_format($rowproduct['DetailOAmount_'.$rowcol['FieldName']],$rsMaster[0]['OriginalDecimal'])}}</td>
                            @endforeach
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            </br>
            <div id="container003" style="width: auto;height:auto; overflow:auto">
                <!-- Do nguon cho luoi chi tiet mat hang -->
                <table id="tbl_D12F3404_2" class="nowrap tbl" width="100%" cellspacing="0" border="1"
                       style="border:1px solid #ADC9ED;">
                    <thead class="">
                    <tr>
                        <th>{{Lang::get("message.STT")}}</th>
                        <th>{{Lang::get("message.Dien_giai")}}</th>
                        @foreach($rsCols as $rowcol )
                            <th>{{$rowcol["Caption"]}}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rsProductDetail as $rowproductdetail )
                        <tr>
                            <td align="center">{{$rowproductdetail['OrderNo']}}</td>
                            <td align="left">{{$rowproductdetail['Description']}}</td>
                            @foreach($rsCols as $rowcol )
                                @if ($rowproductdetail['DataType'] == 'N')
                                    <td align="right">{{number_format($rowproductdetail['ObjectID_'.$rowcol['FieldName']],0)}}</td>
                                @endif
                                @if ($rowproductdetail['DataType'] == 'S')
                                    <td align="left">{{$rowproductdetail['ObjectID_'.$rowcol['FieldName']]}}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@if(floatval($rsMaster[0]['CountFileAttachment'])>0)
    @extends('W9X.W91.W91F4010')
@endif
<script>
    $(document).ready(function () {
        $("#head_toggle").click(function () {
            $("#tbl_D12F3404").find('#body_toggle').toggle();
            if ($("#body_toggle").css("display") == "none") {
                $(".fa-eye").removeAttr("style");
            } else {
                $(".fa-eye").css("display", "none");
            }
        });
    });

</script>
	
	
