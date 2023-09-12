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
        <div class="col-md-4">
            <div class="liketext">
                <label style="width: 100px">{{Helpers::getRS($g,"Bo_phan_YC")}}</label>
                <label><b>{{$rs[0]['DepartmentName']}} </b></label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="liketext">
                <label style="width: 100px">{{Helpers::getRS($g,"Ngay_yeu_cau")}}</label>
                <label><b>{{$rs[0]['PRDate']}} </b></label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="liketext">
                <label style="width: 100px">{{Helpers::getRS($g,"Ngay_su_dung")}}</label>
                <label><b>{{$rs[0]['MExpectDate']}} </b></label>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="liketext">
                <label style="width: 100px">{{Helpers::getRS($g,"So_phieu_YC")}}</label>
                <label><b>{{$rs[0]['PRVoucherNo']}} </b></label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="liketext">
                <label style="width: 100px">{{Helpers::getRS($g,"Trang_thai")}}</label>
                <label><b>{{$rs[0]['StatusVoucher']}} </b></label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="liketext">
                <label style="width: 100px">{{Helpers::getRS($g,"Loai_tien")}}</label>
                <label><b>{{$rs[0]['CurrencyID']}} </b></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="radio pdl0mg5">
                <label class="nm">
                    <input type="radio" {{ $rs[0]['IsProject']==0 ? 'checked="checked"' : "" }}  disabled>
                    @if($rs[0]['IsProject']==0)
                        <b>{{Helpers::getRS($g,"Hoat_dongU")}}</b>

                    @else
                        {{Helpers::getRS($g,"Hoat_dongU")}}
                    @endif

                </label>
                <label class="pull-right nm">
                    <input type="radio" class="mgr10" {{ $rs[0]['IsProject']==1 ? 'checked="checked"' : "" }}
                    disabled>
                    @if($rs[0]['IsProject']==1)
                        <b>{{Helpers::getRS($g,"Du_an")}}</b>

                    @else
                        {{Helpers::getRS($g,"Du_an")}}
                    @endif
                </label>
            </div>
        </div>
        <div class="col-md-9">
            <div class="liketext">
                <label title="{{$rs[0]['ProjectName']}}"><b>{{Str::words($rs[0]['ProjectName'],18)}}</b></label>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-12" style="display: table-row">
            <div class="liketext" style="display: table-cell; width: 135px; vertical-align: top">
                <label>{{Helpers::getRS($g,"Hang_muc_dien_giai")}}</label>
            </div>
            <div class="liketext" style="display: table-cell; ">
                <label> <b>{{$rs[0]['TaskName']}}  </b></label>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="radio liketext">
                <label class="paddingleft0 nm">
                    <input type="checkbox" {{ $rs[0]['IsAppointObject']==1 ? 'checked="checked"' : "" }}  disabled>
                    @if($rs[0]['IsAppointObject']==1)
                        <b>{{Helpers::getRS($g,"Chi_dinh_NCC")}}</b>
                    @else
                        {{Helpers::getRS($g,"Chi_dinh_NCC")}}
                    @endif
                    <label class="nm mgl15"> {{Helpers::getRS($g,"Ly_do")}}</label>
                </label>
            </div>
        </div>
        <div class="col-md-9" style="padding-left: 0px">
            <div class="liketext">
                @if($rs[0]['IsAppointObject']==1)
                    <label style="margin-top:2px"> <b>{{$rs[0]['Reason']}}</b></label>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12 ">
            <div id="pqgrid_W12F3003" style="margin:auto;"></div>
            <table id="tblHHW12F3003">
                <tr>
                    <th>{{Helpers::getRS($g,'STT')}}</th>
                    <th>{{Helpers::getRS($g,'Hang_hoa_Dich_vu')}}</th>
                    <th>{{Helpers::getRS($g,'TSKT')}}</th>
                    <th>{{Helpers::getRS($g,'DVT')}}</th>
                    <th>{{Helpers::getRS($g,'So_luong')}}</th>
                    <th>{{Helpers::getRS($g,'Don_gia')}}</th>
                    <th>{{Helpers::getRS($g,'Thanh_tien')}}</th>
                    <th>{{Helpers::getRS($g,'Nha_cung_cap')}}</th>
                    <th>{{Helpers::getRS($g,'Du_an')}}</th>
                    <th>{{Helpers::getRS($g,'Hang_muc')}}</th>
                    <th>{{Helpers::getRS($g,'Dien_giai')}}</th>
                </tr>
                @foreach($rsDetail as $row )
                    <tr>
                        <td align="center" width="50">{{$row['PROrderNum']}}</td>
                        <td width="170">{{$row['InventoryName']}}</td>
                        <td width="110">{{$row['ParameterTechnical']}}</td>
                        <td align="center" width="80">{{$row['UnitID']}}</td>
                        <td align="right" width="110">{{number_format($row['OriginalQuantity'],Session::get('W91P0000')['D08_QuantityDecimals'])}}</td>
                        <td align="right" width="110">{{number_format($row['UnitPrice'],Session::get('W91P0000')['UnitPriceDecimalPlaces'])}}</td>
                        <td align="right" width="120">{{number_format($row['Amount'],intval($rs[0]['OriginalDecimal']))}}</td>
                        <td width="170">{{$row['ObjectName']}}</td>
                        <td width="170">{{$row['ProjectName']}}</td>
                        <td width="170">{{$row['TaskName']}}</td>
                        <td width="170">{{$row['DetailDesc']}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    @define $g=2;
    @define $mod="D12";
    @if(floatval($rs[0]['CountFileAttachment'])>0)
        @extends('W9X.W91.W91F4010')
    @endif
    <script type="text/javascript">
        $(function () {
            var summaryData = [{0:"", 1:"", 2:"", 3:"", 4:"", 5:"", 6:"{{number_format(Helpers::sumFooter($rsDetail,"Amount"),intval($rs[0]['OriginalDecimal']))}}"}];
            var tbl = $("table#tblHHW12F3003");
            var obj = $.paramquery.tableToArray(tbl);
            obj.colModel[0].minWidth = 50;
            obj.colModel[1].minWidth = 170;
            obj.colModel[2].minWidth = 110;
            obj.colModel[3].minWidth = 80;
            obj.colModel[4].minWidth = 110;
            obj.colModel[5].minWidth = 110;
            obj.colModel[6].minWidth = 120;
            obj.colModel[7].minWidth = 200;
            obj.colModel[8].minWidth = 200;
            obj.colModel[9].minWidth = 200;
            obj.colModel[10].minWidth = 200;
            var newObj = { width: '100%', height: 300, showTitle: false, editable: false, numberCell: false ,collapsible: false, sortable: false};
            newObj.dataModel = { data: obj.data };
            newObj.colModel = obj.colModel;
            newObj.summaryData = summaryData;
            $("#pqgrid_W12F3003").pqGrid(newObj);
            tbl.css("display", "none");
        });
    </script>
@endif

