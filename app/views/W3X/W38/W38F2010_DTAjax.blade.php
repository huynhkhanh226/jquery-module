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
        <div class="col-md-2 liketext">
            <label class="lbl-normal">{{Helpers::getRS($g,"Ten_de_xuat")}}</label>
        </div>
        <div class="col-md-10 liketext">
            <label><b>{{$rs[0]['ProposalName']}} </b></label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 liketext">
            <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_de_xuat")}}</label>
        </div>
        <div class="col-md-4 liketext">
            <label><b>{{$rs[0]['ProposalDate']}} </b></label>
        </div>
        <div class="col-md-2 liketext">
            <label class="lbl-normal">{{Helpers::getRS($g,"Nguoi_de_xuat")}}</label>
        </div>
        <div class="col-md-4 liketext">
            <label><b>{{$rs[0]['ProposerName']}} </b></label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 liketext">
            <label class="lbl-normal">{{Helpers::getRS($g,"Ke_hoach_tong_the")}}</label>
        </div>
        <div class="col-md-10 liketext">
            <label><b>{{$rs[0]['TransName']}} </b></label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 liketext">
            <label class="lbl-normal">{{Helpers::getRS($g,"Phong_ban")}}</label>
        </div>
        <div class="col-md-4 liketext">
            <label><b>{{$rs[0]['DepartmentName']}} </b></label>
        </div>
        <div class="col-md-2 liketext">
            <label class="lbl-normal">{{Helpers::getRS($g,"To_nhom")}}</label>
        </div>
        <div class="col-md-4 liketext">
            <label><b>{{$rs[0]['TeamName']}} </b></label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 liketext">
            <label class="lbl-normal">{{Helpers::getRS($g,"Linh_vuc_dao_tao")}}</label>
        </div>
        <div class="col-md-4 liketext">
            <label><b>{{$rs[0]['TrainingFieldName']}} </b></label>
        </div>
        <div class="col-md-2 liketext">
            <label class="lbl-normal">{{Helpers::getRS($g,"Khoa_dao_tao")}}</label>
        </div>
        <div class="col-md-4 liketext">
            <label><b>{{$rs[0]['TrainingCourseName']}} </b></label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 liketext">
            <label class="lbl-normal">{{Helpers::getRS($g,"SL_de_xuat")}}</label>
        </div>
        <div class="col-md-2 liketext">
            <label><b>{{number_format($rs[0]['ProNumber'],2)}} </b></label>
        </div>
        <div class="col-md-2 liketext">
            <label class="lbl-normal">{{Helpers::getRS($g,"SL_duyet")}}</label>
            <label class="mgl15"><b>{{number_format($rs[0]['AppNumber'],2)}} </b></label>
        </div>
        <div class="col-md-2 liketext">
            <label class="lbl-normal">{{Helpers::getRS($g,"Tong_so_gio_hoc")}}</label>
        </div>
        <div class="col-md-2 liketext">
            <label><b>{{number_format($rs[0]['TrainingPeriod'],2)}} </b></label>
        </div>
        {{--<div class="col-md-2 liketext">--}}
            {{--<label class="lbl-normal">{{Helpers::getRS($g,"So_thang")}}</label>--}}
            {{--<label class="mgl15"><b>{{number_format($rs[0]['TrainingMonthNum'],2)}} </b></label>--}}
        {{--</div>--}}
    </div>
    <div class="row">
        <div class="col-md-2 liketext">
            <label class="lbl-normal">{{Helpers::getRS($g,"TG_dao_tao")}}</label>
        </div>
        <div class="col-md-4 liketext">
            <label><b>{{$rs[0]['TraniningDate']}} </b></label>
        </div>
        <div class="col-md-2 liketext">
            <label class="lbl-normal">{{Helpers::getRS($g,"Nguoi_dao_tao")}}</label>
        </div>
        <div class="col-md-2 liketext">
            <label><b>{{$rs[0]['TrainningEmpName']}} </b></label>
        </div>
        <div class="col-md-2">
            <div class="checkbox liketext">
                <label>
                    <input type="checkbox" disabled {{$rs[0]['IsInternal']=="1"?"checked":""}}> {{Helpers::getRS($g,"Noi_bo")}}
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 liketext">
            <label class="lbl-normal">{{Helpers::getRS($g,"Noi_dung")}}</label>
        </div>
        <div class="col-md-4 liketext">
            <label><b>{{$rs[0]['Content']}} </b></label>
        </div>
        <div class="col-md-2 liketext">
            <label class="lbl-normal">{{Helpers::getRS($g,"Muc_dich_dao_tao")}}</label>
        </div>
        <div class="col-md-4 liketext">
            <label><b>{{$rs[0]['TrainingPurpose']}} </b></label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 liketext">
            <label class="lbl-normal">{{Helpers::getRS($g,"Dia_diem_dao_tao")}}</label>
        </div>
        <div class="col-md-4 liketext">
            <label><b>{{$rs[0]['Address']}} </b></label>
        </div>
        <div class="col-md-2 liketext">

        </div>
        <div class="col-md-2 liketext">

        </div>
        <div class="col-md-2">
            <div class="checkbox liketext">
                <label>
                    <input type="checkbox" disabled {{$rs[0]['IsAddress']=="1"?"checked":""}}> {{Helpers::getRS($g,"Noi_bo")}}
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 liketext">
            <label class="lbl-normal">{{Helpers::getRS($g,"Chi_phi")}}</label>
        </div>
        <div class="col-md-4 liketext">
            <label><b>{{number_format($rs[0]['ProCost'],$rs[0]['OriginalDecimal'])." ".$rs[0]['ProCurrencyID']}} </b></label>
        </div>
        <div class="col-md-2 liketext">
            <label class="lbl-normal">{{Helpers::getRS($g,"Ty_gia")}}</label>
        </div>
        <div class="col-md-4 liketext">
            <label><b>{{number_format($rs[0]['ProExchangeRate'],$rs[0]['ExchangeRateDecimal'])}}</b></label>
            <label class="mgl15"><b>{{number_format($rs[0]['ProCCost'],Session::get("W91P0000")['D90_ConvertedDecimals'])." ".$rs[0]['CurrencyID']}}</b></label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 liketext">
            <label class="lbl-normal">{{Helpers::getRS($g,"Ghi_chu")}}</label>
        </div>
        <div class="col-md-10 liketext">
            <label><b>{{$rs[0]['ProNote']}} </b></label>
        </div>
    </div>
    <div id="pqgrid_W38F2010"></div>
    <table id="tbl_W38F2010" width="100%">
        <tr>
            <th width="130" align="center">{{Helpers::getRS($g,'Ma_NV')}}</th>
            <th width="200" align="center">{{Helpers::getRS($g,'Ho_va_ten')}}</th>
            <th width="80" align="center">{{Helpers::getRS($g,'Gioi_tinh')}}</th>
            <th width="200" align="center">{{Helpers::getRS($g,'Phong_ban')}}</th>
            <th width="200" align="center">{{Helpers::getRS($g,'To_nhom')}}</th>
            <th width="170" align="center">{{Helpers::getRS($g,'Tham_nien')}}</th>
            <th width="200" align="center">{{Helpers::getRS($g,'Chuc_vu')}}</th>
        </tr>
        @foreach($rsDetail as $row )
            <tr>
                <td>{{$row['EmployeeID']}}</td>
                <td>{{$row['EmployeeName']}}</td>
                <td>{{$row['Sex']}}</td>
                <td>{{$row['DepartmentName']}}</td>
                <td>{{$row['TeamName']}}</td>
                <td>{{$row['Seniority']}}</td>
                <td>{{$row['DutyName']}}</td>
            </tr>
        @endforeach
    </table>
    @define $g=4;
    @define $mod="D38";
    @if(floatval($rs[0]['CountFileAttachment'])>0)
        @extends('W9X.W91.W91F4010')
    @endif
    <script type="text/javascript">
        var iW38F2010Height;

        $(document).ready(function () {
            iW38F2010Height = $(".dtformduyet").height() - 370;

            var newObj1 = { width: $('.dtformduyet').width(), height: iW38F2010Height, showTitle: false, collapsible: false, hwrap: false, editable:false, numberCell: {show: true } };
            change2grid('table#tbl_W38F2010','#pqgrid_W38F2010',newObj1,{0: {"minWidth": 130}, 1: {"minWidth" : 200}, 2: {"minWidth" : 80, "cls":"text-center"}, 3: {"minWidth" : 200}, 4: {"minWidth" : 200}, 5: {"minWidth" : 170}, 6: {"minWidth" : 200}});

        });
    </script>
@endif

