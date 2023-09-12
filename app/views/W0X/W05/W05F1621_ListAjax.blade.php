
        <table id="tblW05F1621" >
            <thead class="l3_thead_blue">
            <tr class="thpd5">
                <th width="10px"></th>
                <th width="105px" class="text-center">{{Helpers::getRS($g,'Ngay_don_hang')}}</th>
                <th width="120px">{{Helpers::getRS($g,'So_don_hang')}}</th>
                <th width="200px">{{Helpers::getRS($g,'Ten_khach_hang')}}</th>
                <th width="200px">{{Helpers::getRS($g,'Loai_tien')}}</th>
                <th width="200px">{{Helpers::getRS($g,'Tong_tien')}}</th>
                <th width="200px">{{Helpers::getRS($g,'Trang_thai')}}</th>
                <th >{{Helpers::getRS($g,'Ghi_chu')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($listOrder as $row )
                <tr>
                    <td align="center">
                        <a title="{{Helpers::getRS($g,"Xem")}}"  onclick="showFormDialog('{{url("W05F1602/view/$pForm/3/" . $row['QuotationID'])}}','modalW05F1602DT')">
                            <i class="glyphicon glyphicon-search text-yellow"></i>
                        </a>
                    </td>
                    <td>{{date('d/m/Y',strtotime($row['VoucherDate']))}}</td>
                    <td>{{$row['VoucherNum']}}</td>
                    <td>{{$row['ObjectName']}} </td>
                    <td align="center">{{$row['CurrencyID']}}</td>
                    <td align="right">{{$row['TotalAmount']}}</td>
                    <td>{{$row['StatusName']}}</td>
                    <td>{{$row['Description']}}</td>
                </tr>
            @endforeach
            </tbody>

        </table>

