@if(count($rs))
    <div class="row">
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
    <div class="row masterW49F2222">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                    <div class="liketext">
                        <label class="mgr10">{{Helpers::getRS($g,"Du_an")}}</label>
                    </div>
                </div>
                <div class="col-md-6 pdl0">
                    <div class="liketext">
                        <label><b>{{$rs[0]['StrProjectName']}}</b></label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="liketext">
                        <label class="col-md-8 text-right">{{Helpers::getRS($g,"So_CCTT")}}</label>
                        <label class="col-md-4"><b>{{$rs[0]['CPCNo']}}</b></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="liketext">
                        <label class="mgr10">{{Helpers::getRS($g,"So_hop_dong")}}</label>
                    </div>
                </div>
                <div class="col-md-6 pdl0">
                    <div class="liketext">
                        <label><b>{{$rs[0]['ContractNo']}}</b></label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="liketext">
                        <label class="col-md-8 text-right">{{Helpers::getRS($g,"Ngay_den_han")}}</label>
                        <label class="col-md-4"><b>{{$rs[0]['DueDate']}}</b></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="liketext">
                        <label class="mgr10">{{Helpers::getRS($g,"Chu_dau_tu")}}</label>
                    </div>
                </div>
                <div class="col-md-6 pdl0">
                    <div class="liketext">
                        <label><b>{{$rs[0]['DivisionName']}}</b></label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="liketext">
                        <label class="col-md-8 text-right">{{Helpers::getRS($g,"Ngay_phat_hanh")}}</label>
                        <label class="col-md-4"><b>{{$rs[0]['CPCDate']}}</b></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="liketext">
                        <label class="mgr10">{{Helpers::getRS($g,"Nha_thau")}}</label>
                    </div>
                </div>
                <div class="col-md-6 pdl0">
                    <div class="liketext">
                        <label><b>{{$rs[0]['ObjectName']}}</b></label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="liketext">
                        <label class="col-md-8 text-right">{{Helpers::getRS($g,"Ngay_gui_DN_TT")}}</label>
                        <label class="col-md-4"><b>{{$rs[0]['RequestDate']}}</b></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="liketext">
                        <label class="mgr10">{{Helpers::getRS($g,"Goi_thau")}}</label>
                    </div>
                </div>
                <div class="col-md-6 pdl0">
                    <div class="liketext">
                        <label><b>{{$rs[0]['ContractDesc']}}</b></label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="liketext">
                        <label class="col-md-8 text-right">{{Helpers::getRS($g,"Ngay_het_han_BLTH_HD")}}</label>
                        <label class="col-md-4"><b></b></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="liketext">
                        <label class="mgr10">{{Helpers::getRS($g,"Chung_nhan_cho")}}</label>
                    </div>
                </div>
                <div class="col-md-6 pdl0">
                    <div class="liketext">
                        <label><b>{{$rs[0]['CPCTypeID']}}</b></label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="liketext">
                        <label class="col-md-8 text-right">{{Helpers::getRS($g,"Ngay_het_han_BLTU")}}</label>
                        <label class="col-md-4"><b></b></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="liketext">
                        <label class="mgr10">{{Helpers::getRS($g,"Ghi_chu")}}</label>
                    </div>
                </div>
                <div class="col-md-10 pdl0">
                    <div class="liketext">
                        <label><b>{{$rs[0]['Notes']}}</b></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tabW49F2222_1"
                                          data-toggle="tab">{{Helpers::getRS($g,"Thong_tin_chi_tiet_chung_chi_thanh_toan")}}</a>
                    </li>
                    <li><a href="#tabW49F2222_2"
                           data-toggle="tab">{{Helpers::getRS($g,"Thong_tin_danh_sach_chung_chi_thanh_toan")}}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabW49F2222_1"
                         style="overflow-y: auto;overflow-x: hidden;height: 100%">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="lbl-normal col-md-8 text-right">{{Helpers::getRS($g,"Tong_gia_tri_hop_dong")}}
                                    &nbsp;(-VAT)</label>
                                <label class="col-md-4 text-right"><b>{{number_format($rs[0]['ContractOAmount'],$rs[0]['OriginalDecimal']).' '}}
                                        <span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 bg">
                                <label class="lbl-normal col-md-8 text-right">{{Helpers::getRS($g,"Tong_gia_tri_phat_sinh")}}
                                    &nbsp;(-VAT)</label>
                                <label class="col-md-4 text-right"><b>{{number_format($rs[0]['SubContractOAmount'],$rs[0]['OriginalDecimal']).' '}}
                                        <span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="lbl-normal col-md-8 text-right">{{Helpers::getRS($g,"Thue_GTGT")}}</label>
                                <label class="col-md-4 text-right"><b>{{number_format($rs[0]['ContractVATOAmount'],$rs[0]['OriginalDecimal']).' '}}
                                        <span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 bg-info">
                                <label class="col-md-8 text-right">{{Helpers::getRS($g,"Tong_gia_tri_hop_dong")}}&nbsp;(+VAT)</label>
                                <label class="col-md-4 text-right"><b>{{number_format($rs[0]['TotalContractOAmount'],$rs[0]['OriginalDecimal']).' '}}
                                        <span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="col-md-8 text-right lbl-normal">{{Helpers::getRS($g,"Tong_gia_tri_khoi_luong_thuc_hien_duoc_chung_nhan")}}
                                    (-VAT)</label>
                                <label class="col-md-4 text-right"><b>{{number_format($rs[0]['WorkDoneOAmt'],$rs[0]['OriginalDecimal']).' '}}
                                        <span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 bg">
                                <label class="col-md-8 text-right lbl-normal">{{Helpers::getRS($g,"TGT_vat_tu_den_cong_truong")}}
                                    (-VAT)</label>
                                <label class="col-md-4 text-right"><b>{{number_format($rs[0]['UnfixedGoodOAmt'],$rs[0]['OriginalDecimal']).' '}}
                                        <span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 bg-info">
                                <label class="col-md-8 text-right">{{Helpers::getRS($g,"TGT_thuc_hien_duoc_chung_nhan")}}
                                    (-VAT)</label>
                                <label class="col-md-4 text-right"><b>{{number_format($rs[0]['TotalWorkDoneOAmt'],$rs[0]['OriginalDecimal']).' '}}
                                        <span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="col-md-8 text-right lbl-normal">{{Helpers::getRS($g,"TGT_thuc_hien_duoc_chung_nhan_thanh_toan")}}
                                    (-VAT)</label>
                                <label class="col-md-4 text-right"><b>{{number_format($rs[0]['WorkDonePayOAmt'],$rs[0]['OriginalDecimal']).' '}}
                                        <span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 bg">
                                <label class="col-md-8 text-right lbl-normal">{{Helpers::getRS($g,"Gia_tri_tam_ung")}}</label>
                                <label class="col-md-4 text-right"><b>{{number_format($rs[0]['AdvanceOAmt'],$rs[0]['OriginalDecimal']).' '}}
                                        <span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="col-md-8 text-right lbl-normal">{{Helpers::getRS($g,"Khau_tru_tam_ung")}}</label>
                                <label class="col-md-4 text-right"><b>{{number_format($rs[0]['RePaymentOAmt'],$rs[0]['OriginalDecimal']).' '}}
                                        <span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 bg">
                                <label class="col-md-8 text-right lbl-normal">{{Helpers::getRS($g,"Gia_tri_giu_lai")}}</label>
                                <label class="col-md-4 text-right"><b>{{number_format($rs[0]['RetentionOAmt'],$rs[0]['OriginalDecimal']).' '}}
                                        <span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="col-md-8 text-right lbl-normal">{{Helpers::getRS($g,"Cac_khoan_tru_khac")}}</label>
                                <label class="col-md-4 text-right"><b>{{number_format($rs[0]['LessONCR'],$rs[0]['OriginalDecimal']).' '}}
                                        <span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 bg-info">
                                <label class="col-md-8 text-right">{{Helpers::getRS($g,"Tong_gia_tri_thanh_toan_den_hien_tai")}}</label>
                                <label class="col-md-4 text-right"><b>{{number_format($rs[0]['TotalOAmtToDate'],$rs[0]['OriginalDecimal']).' '}}
                                        <span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="col-md-8 text-right lbl-normal">{{Helpers::getRS($g,"Tong_gia_tri_chung_nhan_cac_dot_truoc")}}</label>
                                <label class="col-md-4 text-right"><b>{{number_format($rs[0]['AccuOAmount'],$rs[0]['OriginalDecimal']).' '}}
                                        <span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 bg-info">
                                <label class="col-md-8 text-right">{{Helpers::getRS($g,"Gia_tri_thanh_toan_dot_nay")}}
                                    &nbsp;(-VAT)</label>
                                <label class="col-md-4 text-right"><b>{{number_format($rs[0]['OAmount'],$rs[0]['OriginalDecimal']).' '}}
                                        <span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="col-md-8 text-right lbl-normal">{{Helpers::getRS($g,"Thue_VAT")}}</label>
                                <label class="col-md-4 text-right"><b>{{number_format($rs[0]['VATOAmount'],$rs[0]['OriginalDecimal']).' '}}
                                        <span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                            </div>
                        </div>
                        <div class="row bg-info">
                            <div class="col-md-12">
                                <label class="col-md-8 text-right">{{Helpers::getRS($g,"Tong_gia_tri_thanh_toan_dot_nay")}}
                                    (+VAT)</label>
                                <label class="col-md-4 text-right"><b>{{number_format($rs[0]['TotalOAmount'],$rs[0]['OriginalDecimal']).' '}}
                                        <span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                            </div>
                        </div>
                        <div class="row bg-light-blue-active">
                            <div class="col-md-12">
                                <label class="col-md-3 text-right lbl-normal"
                                       style="text-decoration: underline">{{Helpers::getRS($g,"Bang_chu")}}</label>
                                <label class="col-md-9 text-right"><b>{{ucfirst(Helpers::convert_number_to_words($rs[0]['TotalOAmount'])).' đồng'}}</b></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="col-md-8 text-right lbl-normal">{{Helpers::getRS($g,"Gia_tri_con_lai_phai_chung_nhan")}}
                                    (-VAT)</label>
                                <label class="col-md-4 text-right"><b>{{number_format($rs[0]['RemainOAmount'],$rs[0]['OriginalDecimal']).' '}}
                                        <span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 bg">
                                <label class="col-md-8 text-right lbl-normal">{{Helpers::getRS($g,"Gia_tri_tien_giu_lai_toi_da")}}</label>
                                <label class="col-md-4 text-right"><b>{{number_format($rs[0]['MaxRetainOAmount'],$rs[0]['OriginalDecimal']).' '}}
                                        <span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="col-md-8 text-right lbl-normal">{{Helpers::getRS($g,"Tong_gia_tri_tien_da_giu_lai_den_hien_tai")}}</label>
                                <label class="col-md-4 text-right"><b>{{number_format($rs[0]['TotalAccuRetentionOAmt'],$rs[0]['OriginalDecimal']).' '}}
                                        <span class="lbl-normal">{{$rs[0]["CurrencyID"]}}</span></b></label>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tabW49F2222_2">
                        <div id="pqgrid_W49F2222"></div>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
        </div>
    </div>
    {{--<div id="pqgrid_W49F2222"></div>--}}
    @if(floatval($rs[0]['CountFileAttachment'])>0)
        @extends('W9X.W91.W91F4010')
    @endif
    <script type="text/javascript">
        $('#tabW49F2222_1').height($('#modalW84F2020').height() - $('.masterW49F2222').height() - 240);
        $("#tabW49F2222_1").mCustomScrollbar(
                {
                    axis: "y",
                    theme: "rounded-dots",
                    autoExpandScrollbar: true,
                    advanced: {autoExpandHorizontalScroll: true},
                    scrollInertia: 10
                });


        var iW84F2020Height;
        $(document).ready(function () {
            iW84F2020Height = $(".nav-tabs-custom").height() - 55;
            var obj = {
                width: '100%',
                height: iW84F2020Height,
                showTitle: false,
                collapsible: false,
                height2Rows: true,
                numberCell: {show: false},
                editable: false,
                scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'true'}
            };
            obj.colModel = [
                {
                    title: "{{Helpers::getRS($g,'Dot_TT')}}",
                    minWidth: 70,
                    dataType: "integer",
                    align: "center",
                    dataIndx: "Stage"
                },
                {
                    title: "{{Helpers::getRS($g,'Loai_CCTT')}}",
                    minWidth: 140,
                    dataType: "string",
                    dataIndx: "CPCTypeID"
                },
                {
                    title: "{{Helpers::getRS($g,'Ty_le')}}",
                    minWidth: 60,
                    dataType: "string",
                    dataIndx: "Percentage",
                    align: "right",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["Percentage"],"",2) + '%';
                    }
                },
                {
                    title: "{{Helpers::getRS($g,'So_tien')}} ({{Helpers::getRS($g,'chua_VAT')}})",
                    minWidth: 150,
                    dataType: "string",
                    align: "right",
                    dataIndx: "SOAmount",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["SOAmount"],"", {{intval($rs[0]['OriginalDecimal'])}});
                    }
                },
                {
                    title: "{{Helpers::getRS($g,'Ghi_chu')}}",
                    minWidth: 200,
                    dataType: "string",
                    dataIndx: "DetailDescription"
                },
                {
                    title: "{{Helpers::getRS($g,'So_CCTT')}}",
                    minWidth: 140,
                    dataType: "string",
                    dataIndx: "CPCNo"
                },
                {
                    title: "{{Helpers::getRS($g,'Ngay_CCTT')}}",
                    minWidth: 90,
                    dataType: "date",
                    dataIndx: "CPCDate",
                    align: "center",
                },
                {
                    title: "{{Helpers::getRS($g,'Ngay_yeu_cau')}}",
                    minWidth: 90,
                    dataType: "date",
                    dataIndx: "RequestDate",
                    align: "center",
                },
                {
                    title: "{{Helpers::getRS($g,'Ngay_den_han')}}",
                    minWidth: 90,
                    dataType: "date",
                    dataIndx: "DueDate",
                    align: "center",
                },
                {
                    title: "MCPC No",
                    minWidth: 140,
                    dataType: "string",
                    dataIndx: "MCPCNo"
                },
                {
                    title: "{{Helpers::getRS($g,'Ghi_chu')}}",
                    minWidth: 200,
                    dataType: "string",
                    dataIndx: "Notes"
                },
                {
                    title: "{{Helpers::getRS($g,'Tam_ung')}}",
                    minWidth: 150,
                    dataType: "string",
                    align: "right",
                    dataIndx: "AdvanceOAmt",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["AdvanceOAmt"], "",{{intval($rs[0]['OriginalDecimal'])}});
                    }
                },
                {
                    title: "{{Helpers::getRS($g,'GT_KL_thuc_hien_duoc_chung_nhan')}}",
                    minWidth: 150,
                    align: "right",
                    dataType: "string",
                    dataIndx: "WorkDoneOAmt",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["WorkDoneOAmt"],"", {{intval($rs[0]['OriginalDecimal'])}});
                    }
                },
                {
                    title: "{{Helpers::getRS($g,'GT_vat_tu_den_cong_truong')}}",
                    minWidth: 150,
                    align: "right",
                    dataType: "string",
                    dataIndx: "UnfixedGoodOAmt",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["UnfixedGoodOAmt"], "",{{intval($rs[0]['OriginalDecimal'])}});
                    }
                },
                {
                    title: "{{Helpers::getRS($g,'GT_thuc_hien_duoc_chung_nhan')}}",
                    minWidth: 150,
                    align: "right",
                    dataType: "string",
                    dataIndx: "TotalWorkDoneOAmt",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["TotalWorkDoneOAmt"], "",{{intval($rs[0]['OriginalDecimal'])}});
                    }
                },
                {
                    title: "{{Helpers::getRS($g,'GT_thuc_hien_duoc_chung_nhan_thanh_toan')}}",
                    minWidth: 170,
                    align: "right",
                    dataType: "string",
                    dataIndx: "WorkDonePayOAmt",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["WorkDonePayOAmt"],"", {{intval($rs[0]['OriginalDecimal'])}});
                    }
                },
                {
                    title: "{{Helpers::getRS($g,'Khau_tru_tam_ung')}}",
                    minWidth: 150,
                    align: "right",
                    dataType: "string",
                    dataIndx: "RePaymentOAmt",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["RePaymentOAmt"],"", {{intval($rs[0]['OriginalDecimal'])}});
                    }
                },
                {
                    title: "{{Helpers::getRS($g,'Giu_lai')}}",
                    minWidth: 150,
                    align: "right",
                    dataType: "string",
                    dataIndx: "RetentionOAmt",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["RetentionOAmt"],"", {{intval($rs[0]['OriginalDecimal'])}});
                    }
                },
                {
                    title: "{{Helpers::getRS($g,'Tru_khac')}}",
                    minWidth: 150,
                    align: "right",
                    dataType: "string",
                    dataIndx: "LessONCR",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["LessONCR"], "",{{intval($rs[0]['OriginalDecimal'])}});
                    }
                },
                {
                    title: "{{Helpers::getRS($g,'Thanh_tien')}}",
                    minWidth: 150,
                    align: "right",
                    dataType: "string",
                    dataIndx: "OAmount",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["OAmount"], "",{{intval($rs[0]['OriginalDecimal'])}});
                    }
                },
                {
                    title: "{{Helpers::getRS($g,'Tien_thue')}}",
                    minWidth: 150,
                    align: "right",
                    dataType: "string",
                    dataIndx: "VATOAmount",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["VATOAmount"], "",{{intval($rs[0]['OriginalDecimal'])}});
                    }
                },
                {
                    title: "{{Helpers::getRS($g,'Tong_thanh_tien')}}",
                    minWidth: 150,
                    align: "right",
                    dataType: "string",
                    dataIndx: "TotalOAmount",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["TotalOAmount"],"", {{intval($rs[0]['OriginalDecimal'])}});
                    }
                },
                {
                    title: "{{Helpers::getRS($g,'Thanh_tien_xuat_HD')}}",
                    minWidth: 150,
                    align: "right",
                    dataType: "string",
                    dataIndx: "CPCInvoiceOAmt",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["CPCInvoiceOAmt"], {{intval($rs[0]['OriginalDecimal'])}});
                    }
                },
                {
                    title: "{{Helpers::getRS($g,'Tien_thue_xuat_HD')}}",
                    minWidth: 150,
                    align: "right",
                    dataType: "string",
                    dataIndx: "CPCVATInvOAmt",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["CPCVATInvOAmt"], "",{{intval($rs[0]['OriginalDecimal'])}});
                    }
                },
                {
                    title: "{{Helpers::getRS($g,'Tong_tien_xuat_HD')}}",
                    minWidth: 150,
                    align: "right",
                    dataType: "string",
                    dataIndx: "TotalCPCInvOAmt",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["TotalCPCInvOAmt"], "",{{intval($rs[0]['OriginalDecimal'])}});
                    }
                },
                {
                    title: "{{Helpers::getRS($g,'GT_chua_phat_hanh')}}",
                    minWidth: 150,
                    align: "right",
                    dataType: "string",
                    dataIndx: "UnReleasedOAmount",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["UnReleasedOAmount"], "",{{intval($rs[0]['OriginalDecimal'])}});
                    }
                }
            ];
            obj.dataModel = {
                data: {{json_encode($connection->select("EXEC D49P2300 '".Session::get("W91P0000")['DivisionID']."', '".Auth::user()->user()->UserID."', 'WEB', ".Session::get("W91P0000")['TranMonth'] . ",". Session::get("W91P0000")['TranYear'] .", '".Session::get('Lang')."', 0, '', '', '', '',0 , '".$rs[0]['VoucherID']."'"))}},
                location: "local",
                sorting: "local",
                sortDir: "down"
            };
            var $grid = $("#pqgrid_W49F2222").pqGrid(obj);
            $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $grid.pqGrid("refreshDataAndView");
        });

        $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
            $("#pqgrid_W49F2222").pqGrid("refreshDataAndView");
        })
    </script>
@endif
