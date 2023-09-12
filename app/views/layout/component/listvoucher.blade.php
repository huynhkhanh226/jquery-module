@foreach($detail as $row)
    <div class="leftRowView" id="vid{{$row['VoucherID']}}">
        <input type="hidden" value="{{url("/$cForm/detail/" .$row['VoucherID'] . "/" . $g."/" . $isApproval)}}">
        <input type="hidden" value="{{url("/W84F2021/" .$row['FormID'] . "/" .$row['VoucherID'] . "/" . $g ."/$isApproval/" . $row['ApprovalLevel'])}}">
        <input type="hidden" id="idVoucherW84F2020" value="{{$row['VoucherID']}}">
        <div class="width85pc">
            {{$row['DisplayDesc']}}
        </div>
        <div class="width15pc hide">
            <button onclick='leftshowsendmail("{{addslashes($row['EmailSenderAddress'])}}","{{addslashes($row['EmailReceivedAddress'])}}","{{addslashes($row['Subject'])}}","{{addslashes($row['EmailContent'])}}","{{addslashes($row['EmailCCAddress'])}}","{{addslashes($row['EmailBCCAddress'])}}");'  type='button' class='btn btn-default smallbtn' ><i class='fa fa-envelope'></i></button>
        </div>
    </div>
@endforeach
<script>
    var gblVoucherList = {{json_encode($detail)}};
    //Dung để lấy dòng voucherID hiện tại
    function getCurrentVoucherID(){
        var div = $("#tbListVoucherW84F2020").find("div.active");
        var voucherID = $(div).find("#idVoucherW84F2020").val();
        var rowList = $.grep(gblVoucherList, function (data) {
            return data["VoucherID"] == voucherID;
        });
        var rowVoucher = {};
        if (rowList.length > 0) {
            rowVoucher = rowList[0];
        }
        return rowVoucher;
    }
</script>
