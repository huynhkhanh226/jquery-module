<div class="row  mgt10">
    <div class="col-md-12 empployee">
        @include('layout.component.employ')
    </div>
</div>
<div class="row mgt10">
    <div class="col-md-12 hdDetail listDuyet" style="height:auto !important;overflow: hidden">
        <div class="row mgt5">
            <div class="col-md-12">
                <label class="lbl-normal" style="width: 130px">{{Helpers::getRS($g,"Ngay_yeu_cau")}}</label>
                <label>{{$rs["TransDate"]}}</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="lbl-normal" style="width: 130px">{{Helpers::getRS($g,"Thong_tin")}}</label>
                <label>{{$rs["PropertyName"]}}</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="lbl-normal" style="width: 130px">{{Helpers::getRS($g,"Gia_tri_hien_tai")}}</label>
                <label>{{$rs["Value"]}}</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="lbl-normal" style="width: 130px">{{Helpers::getRS($g,"Gia_tri_de_xuat")}}</label>
                <label>{{$rs["PropertyValue"]}}</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="lbl-normal" style="width: 130px">{{Helpers::getRS($g,"Ghi_chu")}}</label>
                <label>{{$rs["Notes"]}}</label>
            </div>
        </div>
        @if ($rs["Approved"]==0)
            <div class="row">
                <div class="col-md-12">
                    <button type="button" onclick="appAction('{{$rs["TransID"]}}');"
                            class="btn smallbtn bg-orange pull-right mgb5">
                        <span class="glyphicon glyphicon-ok"></span>&nbsp;{{Helpers::getRS($g,"Phe_duyet")}}
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
<script>
    function appAction(tran) {
        var propertyID = '{{$rs["PropertyID"]}}';
        if (propertyID == "NUMIDCARD"){
            $.ajax({
                method: 'POST',
                url: '{{url("/W09F2510/checkstore/")}}/' + tran,
                data:{propertyID: '{{$rs["PropertyID"]}}', propertyValue: "{{$rs["PropertyValue"]}}"},
                success: function (data) {
                    console.log(data);
                    if (data.length > 0){
                        if (data[0].Status == 0){
                            reCallAction(tran);
                        }else{
                            alert_warning(data[0].Message);
                        }
                    }
                }
            });
        }else{
            reCallAction(tran);
        }


    }
    function reCallAction(tran){
        $.ajax({
            method: 'POST',
            url: '{{url("/W09F2510/approval/")}}/' + tran,
            success: function (data) {
                if (data == "1") {
                    save_ok(refresh);
                }
                else {
                    save_not_ok();
                }
            }
        });
    }
</script>