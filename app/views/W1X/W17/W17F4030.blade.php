<?php
if (isset($task)) {
    switch ($task) {
        case '':
            $txtDateFromW17F4030 = date("d/m/Y", strtotime('monday this week'));
            $txtDateToW17F4030 = date("d/m/Y", strtotime('sunday this week'));
            break;

    }
}


?>
<div class="pd10">
    <form id="frmW17F4030">
        <div class="row form-group">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3">
                        <label class="liketext lbl-normal">{{Helpers::getRS($g,"Thoi_gian")}}</label>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control" id="txtDateFromW17F4030" name="txtDateFromW17F4030"
                                   value="{{$txtDateFromW17F4030}}" required>
                            <span class="input-group-addon"><i onclick="$('#txtDateFromW17F4030').datepicker('show')"
                                                               class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control" id="txtDateToW17F4030" name="txtDateToW17F4030"
                                   value="{{$txtDateToW17F4030}}" required>
                            <span class="input-group-addon"><i onclick="$('#txtDateToW17F4030').datepicker('show')"
                                                               class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-4">
                        <label class="liketext lbl-normal">{{Helpers::getRS($g,"Loai_bao_cao")}}</label>
                    </div>
                    <div class="col-md-4">
                        <div class="radio mgt5">
                            <label>
                                <input name="optIsPersonW17F4030" id="IsPerson1W17F4030" value="1" checked type="radio">
                                {{Helpers::getRS($g,"Ca_nhan")}}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="radio mgt5">
                            <label>
                                <input name="optIsPersonW17F4030" id="IsPerson0W17F4030" value="0"  type="radio">
                                {{Helpers::getRS($g,"To_chuc")}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-6">
                <div class="row mgb5">
                    <div class="col-md-3">
                        <label class="liketext lbl-normal">{{Helpers::getRS($g,"Nhan_vien")}}</label>
                    </div>
                    <div class="col-md-8">
                        <select id="cboStrSalesPersonCode" name="cboStrSalesPersonCode" class="form-control  selectpicker"  multiple data-actions-box="true"  data-live-search="true" data-selected-text-format="count > 5" data-max-options="10">
                            @foreach($employees as $row)
                                <option title="{{$row["Assignee"]}}" value="{{$row['Assignee']}}">{{$row['AssigneeName']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-5 divHiddenWithIsPersion hide">
                <div class="row mgb5">
                    <div class="col-md-3">
                        <label class="liketext lbl-normal">{{Helpers::getRS($g,"Cong_ty")}}</label>
                    </div>
                    <div class="col-md-8">
                        <select id="cboStrCompanyCode" name="cboStrCompanyCode" class="form-control  selectpicker"  multiple data-actions-box="true"  data-live-search="true"  data-selected-text-format="count > 5"  data-max-options="10">
                            @foreach($companies as $row)
                                <option title="{{$row["D17CompanyID"]}}" value="{{$row['D17CompanyID']}}">{{$row['D17CompanyName']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <button type="button" id="btnFilterW17F4030" class="btn btn-default smallbtn" style="padding: 5px 12px !important;"><span
                            class="fa fa-search text-yellow"></span>
                </button>

                <button id="submitW17F4030" class="hide"></button>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-12">
                <div id="divW17f4030"></div>
            </div>
        </div>
    </form>
</div>

<script>

    $(document).ready(function () {
        $("#cboStrCompanyCode").selectpicker();

        $("#cboStrSalesPersonCode").selectpicker();

        $("#cboStrCompanyCode").selectpicker("hideSelectAll");
        $("#cboStrSalesPersonCode").selectpicker("hideSelectAll");

        $('#txtDateFromW17F4030').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#txtDateToW17F4030').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });


        setTimeout(function () {
            $("#gridW17f4030").pqGrid('refreshDataAndView');
        }, 300);

        $("#IsPerson1W17F4030").change(function(){
            console.log($("#optIsPersonW17F4030").is(":checked"));
            var isPersion = $("input[name='optIsPersonW17F4030']:checked").val()
            if (isPersion == 1){
                $(".divHiddenWithIsPersion").addClass('hide');
                $("#cboStrCompanyCode").selectpicker("deselectAll");
            }else{
                $(".divHiddenWithIsPersion").removeClass('hide');
            }
        });
        $("#IsPerson0W17F4030").change(function(){
            console.log($("#optIsPersonW17F4030").is(":checked"));
            var isPersion = $("input[name='optIsPersonW17F4030']:checked").val()
            if (isPersion == 1){
                $(".divHiddenWithIsPersion").addClass('hide');
                $("#cboStrCompanyCode").selectpicker("deselectAll");
            }else{
                $(".divHiddenWithIsPersion").removeClass('hide');
            }
        });
    });


    $("#btnFilterW17F4030").click(function (e) {
        e.preventDefault();
        validationElements($("#frmW17F4030"), function () {
            //alert('dsfsd');
            $("#submitW17F4030").click();
        })
    })

    $("#frmW17F4030").on("submit", function(e) {
        e.preventDefault();
        var txtradio = $('input[name=RadioW17F4030]:checked').val();
        var cboStrSalesPersonCode = $('#cboStrSalesPersonCode').val();
        var cboStrCompanyCode = $('#cboStrCompanyCode').val();
        $.ajax({
                method: "POST",
                url: '{{url("/W17F4030/view/$pForm/$g/filter")}}',
                /*data: {
                    isPerson: txtradio,
                    DateFromW17F4030: $("#DateFromW17F4030").val(),
                    DateToW17F4030: $("#DateToW17F4030").val()
                },*/
                data: $("#frmW17F4030").serialize()  + "&strSalesPersonCode=" + encryptData(cboStrSalesPersonCode) + "&strCompanyCode=" + encryptData(cboStrCompanyCode) ,
                success: function (response) {
                    $("#divW17f4030").html(response);
                }
            }
        );
    });

    var exportW17F4030 = function () {

        var _title = [];
        var _dataIndx = [];
        var _align = [];
        var _format = [];
        initExportExcell($("#gridW17f4030"), _title, _dataIndx, _align, _format);

        $("#gridW17f4030").pqGrid("commit");
        var _data = JSON.stringify($("#gridW17f4030").pqGrid("option", "dataModel.data"));
        console.log($("#gridW17f4030").pqGrid("option", "dataModel.data"));
        $.ajax({
            method: "POST",
            data: {title: _title, data: _data, dataIndx: _dataIndx, align: _align, format: _format},
            url: "{{url('/Export')}}",
            success: function (data) {
                if (data == 0) {
                    alert_error('{{Helpers::getRS(5,'Loi_xuat_file')}}')
                }
                else {
                    var downloadLink = document.createElement("a");
                    downloadLink.download = "Report" + new Date().getTime() + ".xls";
                    downloadLink.innerHTML = "Report";
                    downloadLink.href = data;
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


    function triggerDateW17F4030() {
        $('#DateStartW17F1011').datepicker('show');
    }
</script>