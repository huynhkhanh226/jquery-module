<section class="content" id="secW27F2240">
    <form id="frmW27F2240" name="frmW27F2240" method="post">
        <div class="row">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-2">
                        <div class="checkbox mgt5">
                            <label>
                                <input type="checkbox" value="1" id="chkPeriod" name="chkPeriod" checked="checked">
                                {{Helpers::getRS($g,"Ky")}}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <select class="form-control disabled" id="slPeriodFrom" name="slPeriodFrom" required>
                            @foreach($period as $row)
                                <option fromMonth="{{$row["TranMonth"]}}" fromYear="{{$row["TranYear"]}}" value="{{$row["TranYear"].$row["TranMonth"]}}" {{$row["TranYear"]==Session::get("W91P0000")['TranYear'] && $row["TranMonth"]==Session::get("W91P0000")['TranMonth']?'selected="selected"':''}}>{{$row["Period"]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select class="form-control" id="slPeriodTo" name="slPeriodTo" required>
                            @foreach($period as $row)
                                <option toMonth="{{$row["TranMonth"]}}" toYear="{{$row["TranYear"]}}" value="{{$row["TranYear"].$row["TranMonth"]}}" {{$row["TranYear"]==Session::get("W91P0000")['TranYear'] && $row["TranMonth"]==Session::get("W91P0000")['TranMonth']?'selected="selected"':''}}>{{$row["Period"]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-3">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Tim_kiem")}}</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="txtStrSearch" name="txtStrSearch" class="form-control">
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-2">
                        <div class="checkbox mgt5">
                            <label>
                                <input type="checkbox" value="0" id="chkDate" name="chkDate">
                                {{Helpers::getRS($g,"Ngay")}}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="txtDateFrom" name="txtDateFrom" data-inputmask="'alias': 'dd/mm/yyyy'" class="form-control date-mark" value="{{date("d/m/Y")}}" disabled required>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="txtDateTo" name="txtDateTo" data-inputmask="'alias': 'dd/mm/yyyy'" class="form-control date-mark" value="{{date("d/m/Y")}}" disabled required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-8">
                        <div class="checkbox mgt5">
                            <label>
                                <input type="checkbox" value="1" id="optIsShowCancelled" name="optIsShowCancelled" class="optType" >
                                {{Helpers::getRS($g,"Hien_thi_phieu_ban_hang_da_huy")}}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-default smallbtn pull-right mgr5" style="padding-top: 4px" onclick="LoadDataW27F2240()"><span
                                    class="digi digi-filter"></span>
                            &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                    </div>
                    <div class="col-md-2">
                        <button id="btnExportExcel" onclick = "W05F1621ExportExcel();" disabled="disabled"  class="btn btn-default smallbtn pull-right" style="padding-top: 4px" onclick="LoadDataW27F2240()"><span
                                    class="fa fa-file-excel-o"></span>
                            &nbsp;{{Helpers::getRS($g,'Xuat_Excel_U')}}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="gridW27F2240"></div>
            </div>
        </div>
    </form>
</section>

<script type="text/javascript">
    var iW27F2240Height = $(".contenttab").height() - 198;
    var iW27F2240Width;
    $("#frmW27F2240").on('submit', function (e) {
        e.preventDefault();


    });

    function LoadDataW27F2240() {
        var isTime = 0;
        if ($("#frmW27F2240").find("#chkPeriod").is(":checked") && $("#frmW27F2240").find("#chkDate").is(":checked"))
            isTime = 3;
        else if ($("#frmW27F2240").find("#chkPeriod").is(":checked") && !$("#frmW27F2240").find("#chkDate").is(":checked"))
            isTime = 1;
        else if (!$("#frmW27F2240").find("#chkPeriod").is(":checked") && $("#frmW27F2240").find("#chkDate").is(":checked"))
            isTime = 2;
        else
            isTime = 4;
        var fromMonth = $('#slPeriodFrom option:selected').attr('frommonth');
        var fromYear = $('#slPeriodFrom option:selected').attr('fromyear')
        var toMonth = $('#slPeriodTo option:selected').attr('tomonth')
        var toYear = $('#slPeriodTo option:selected').attr('toyear')

        $.ajax({
            method: "POST",
            url: '{{Request::url()}}',
            data: $("#frmW27F2240").serialize()+"&isTime=" + isTime+"&fromMonth=" + fromMonth+"&fromYear=" + fromYear+"&toMonth=" + toMonth+"&toYear=" + toYear,
            success: function (data) {
                $("#gridW27F2240").html(data);
                var numrow = $("#pqgridW27F2240").find('.pq-grid-inner').find('.pq-grid-row').length;
                $("#btnExportExcel").prop('disabled', false);
            }
        });
    }
    $(".date-mark").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});

    $("#frmW27F2240").find("#chkPeriod").change(function() {
        $("#frmW27F2240").find("#slPeriodFrom").prop("disabled", !$(this).is(":checked"));
        $("#frmW27F2240").find("#slPeriodTo").prop("disabled", !$(this).is(":checked"));

    });

    $("#frmW27F2240").find("#chkDate").change(function() {
        $("#frmW27F2240").find("#txtDateFrom").prop("disabled", !$(this).is(":checked"));
        $("#frmW27F2240").find("#txtDateTo").prop("disabled", !$(this).is(":checked"));

    });

    $(document).ready(function () {
        iW27F2240Width = $("#secW27F2240").width() - 30;
    });

    var W05F1621ExportExcel=function() {
        //var rows = $("#pqgridW27F2240").pqGrid("option", "dataModel.data").length;
        //if (rows > 0){
            var _title = [];
            var _dataIndx =[];
            var _align = [];
            var _format = [];
            initExportExcell($("#pqgridW27F2240"),_title,_dataIndx,_align, _format);

            $("#pqgridW27F2240").pqGrid( "commit" );
            var _data = JSON.stringify($("#pqgridW27F2240").pqGrid("option", "dataModel.data"));
              // console.log(_align);
            $.ajax({
                method: "POST",
                data: {title: _title, data:_data, dataIndx: _dataIndx, align:_align, format: _format},
                url: "{{url('/Export')}}",
                success: function (data) {
                    if(data==0) {
                        alert_error('{{Helpers::getRS(5,'Loi_xuat_file')}}')
                    }
                    else {
                        var downloadLink = document.createElement("a");
                        downloadLink.download = "SaleVouchersList_" + new Date().getTime()+".xls";
                        downloadLink.innerHTML = "Download Sale Vouchers List";
                        downloadLink.href =data;
                        downloadLink.onclick = destroyClickedElement;
                        downloadLink.style.display = "none";
                        document.body.appendChild(downloadLink);
                        downloadLink.click();
                    }
                }
            });
        //}else{
        //    alert_warning("Please reset filter");
        //}

    };
</script>

