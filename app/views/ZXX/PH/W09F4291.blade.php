<section class="content" id="secW09F4291">
    <form class="form-horizontal" id="frmW09F4291" name="frmW09F4291" method="post">
        <div class="row">
            <div class="col-md-2">
                <div class="radio pdt5">
                    <label>
                        <input name="optEmpWorkMode" id="optEmpWorkMode0" value="0" checked type="radio">
                        {{Helpers::getRS($g,"Theo_nhan_vien_U")}}
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="radio pdt5">
                    <label>
                        <input name="optMonthWeekMode" id="optMonthWeekMode0" value="0" checked type="radio">
                        {{Helpers::getRS($g,"Theo_thang")}}
                    </label>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-sm-2 pdl0">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Du_an")}}</label>
                    </div>
                    <div class="col-sm-4">
                        <select id="slProjectID" name="slProjectID" class="form-control" required>
                            @foreach($pro as $row)
                                <option value="{{$row['ProjectID']}}" data-name="{{$row['ProjectName']}}"
                                        data-comid="{{$row['CompanyID']}}"
                                        data-comname="{{$row['CompanyName']}}">{{$row['ProjectID']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 pdl0">
                        <input type="text" class="form-control" id="txtProjectName" readonly>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                   <div class="col-sm-7">
                       <label class="lbl-normal liketext">{{Helpers::getRS($g,"Ty_gia")}}</label>
                   </div>
                   <div class="col-sm-5">
                       <label class="liketext">{{$exchangeRate}}</label>
                   </div>
               </div>
            </div>

        </div>
        <div class="row pdt5">
            <div class="col-md-2">
                <div class="radio pdt5">
                    <label>
                        <input name="optEmpWorkMode" id="optEmpWorkMode1" value="1" type="radio">
                        {{Helpers::getRS($g,"Theo_cong_viec")}}
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="radio pdt5">
                    <label>
                        <input name="optMonthWeekMode" id="optMonthWeekMode1" value="1" type="radio">
                        {{Helpers::getRS($g,"Theo_tuan")}}
                    </label>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-sm-2 pdl0">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Cong_ty")}}</label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtCompanyID" readonly>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <button type="button" id="btnExcelW09F4291" class="btn btn-default smallbtn pull-right" disabled>
                    <span class="fa fa-file-excel-o"></span>
                    &nbsp;{{Helpers::getRS($g,"Xuat_Excel_U")}}</button>
                <button type="submit" class="btn btn-default smallbtn pull-right mgr5"><span
                            class="digi digi-filter"></span>
                    &nbsp;{{Helpers::getRS($g,"Loc")}}</button>

            </div>
        </div>
        <div class="l3-loading hide" style="background-color: #FFffff">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
    </form>
    <section id="divDetailW09F4291" style="margin-left: 0px;margin-right: 0px;margin-top: 10px">
    </section>
</section>
<script type="text/javascript">
    var bchangeW09F4291 = 1;
    $("#frmW09F4291").on('change', '#slProjectID', function () {
        bchangeW09F4291=1;
        $("#frmW09F4291").find('#txtProjectName').val($(this).find('option:selected').attr('data-name'));
        $("#frmW09F4291").find('#txtCompanyID').val($(this).find('option:selected').attr('data-comid') + ' - ' + $(this).find('option:selected').attr('data-comname'));
    });

    $("#frmW09F4291").find('#slProjectID').trigger('change');

    $("#frmW09F4291").on('change', 'input:radio[name="optMonthWeekMode"]', function () {
        bchangeW09F4291 = 1;
    });

    $("#frmW09F4291").on('submit', function (e) {
        e.preventDefault();
        if (bchangeW09F4291 == 1)
            $("#secW09F4291 .l3-loading").removeClass("hide");
        else
            $("#pqgrid_W09F4291").pqGrid("showLoading");
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: $("#frmW09F4291").serialize() + "&change=" + bchangeW09F4291,
            success: function (data) {
                if (bchangeW09F4291 == 1)
                    $("#divDetailW09F4291").html(data);
                else {
                    var currentObject = $.parseJSON(data);
                    console.log(currentObject);
                    $("#pqgrid_W09F4291").pqGrid("option", "dataModel", {data: currentObject});
                    $("#pqgrid_W09F4291").pqGrid("hideLoading");
                    $("#pqgrid_W09F4291").pqGrid("refreshDataAndView");
                }
                $("#secW09F4291 .l3-loading").addClass("hide");
                $("#btnExcelW09F4291").removeAttr("disabled");
                bchangeW09F4291 = 0;
            }
        });
    });

    $("#btnExcelW09F4291").on("click", function () {
        W09F4291ExportExcel();
    });

    var W09F4291ExportExcel = function () {
        $('#btnExcelW09F4291').text('Exporting...');
        $('#btnExcelW09F4291').attr('disabled','disabled');
        var _title = [];
        var _dataIndx = [];
        var _align = [];
        var _format = [];
        initExportExcell($("#pqgrid_W09F4291"), _title, _dataIndx, _align, _format);

        $("#pqgrid_W09F4291").pqGrid("commit");
        var _data = JSON.stringify($("#pqgrid_W09F4291").pqGrid("option", "dataModel.data"));
        $.ajax({
            method: "POST",
            data: {title: _title, data: _data, dataIndx: _dataIndx, align: _align, format: _format},
            url: "{{url('/Export')}}",
            success: function (data) {
                if (data == 0) {
                    alert_error('{{Helpers::getRS(5,'Loi_xuat_file')}}')
                }
                else {
                    var today = new Date();
                    var datea = today.getFullYear() + '' + (today.getMonth() + 1) + '' + today.getDate() + '' + today.getHours() + '' + today.getMinutes() + '' + today.getSeconds();
                    var downloadLink = document.createElement("a");
                    downloadLink.download = "DataW09F4291_" + datea + ".xls";
                    downloadLink.innerHTML = "Download W09F4291";
                    downloadLink.href = data;
                    downloadLink.onclick = destroyClickedElement;
                    downloadLink.style.display = "none";
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                    $('#btnExcelW09F4291').removeAttr('disabled');
                    $('#btnExcelW09F4291').html('<span class="fa fa-file-excel-o"></span> {{Helpers::getRS($g,"Xuat_Excel_U")}}');
                }
            }
        });
    };

    $("#frmW09F4291").find("#slProjectID").select2({
        containerCssClass : "required"
    });
</script>

