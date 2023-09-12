<section class="content" id="secW09F4290">
    <div class="modal-body">
        <form class="form-horizontal" id="frmW09F4290" name="frmW09F4290" method="post">
            <div class="row pdl0" style="margin-left: -20px;margin-right: -20px">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="lbl-normal liketext">{{Helpers::getRS($g,"Nhan_vien")}}</label>
                        </div>
                        <div class="col-md-9 pdl0">
                            <select id="slEmployeeID" name="slEmployeeID" class="form-control" required>
                                @foreach($emp as $row)
                                    <option value="{{$row["EmployeeID"]}}" data-name="{{$row["EmployeeName"]}}"
                                            data-depid="{{$row["DepartmentID"]}}"
                                            data-depname="{{$row["DepartmentName"]}}" data-dutyid="{{$row["DutyID"]}}"
                                            data-dutyname="{{$row["DutyName"]}}">{{$row["EmployeeName"]}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 pdl0">
                            <input class="form-control" id="txtDepartmentID" readonly>
                        </div>
                        <div class="col-md-6 pdl0">
                            <input class="form-control" id="txtDutyID" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pdl0" style="margin-left: -20px;margin-right: -20px">
                <div class="col-md-6 pdt5">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="lbl-normal liketext">{{Helpers::getRS($g,"Thang")}}</label>
                        </div>
                        <div class="col-md-4 pdl0">
                            <select id="slMonth" name="slMonth" class="form-control" required>
                                @foreach($mon as $row)
                                    <option value="{{$row["TranYear"].$row["TranMonth"]}}">{{$row["Period"]}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pdt5">
                    <div class="row">
                        <div class="col-md-6">
                             <div class="row">
                                   <div class="col-sm-7 pdl0">
                                       <label class="lbl-normal liketext">{{Helpers::getRS($g,"Ty_gia")}}</label>
                                   </div>
                                   <div class="col-sm-5">
                                       <label class="liketext">{{$exchangeRate}}</label>
                                   </div>
                              </div>
                        </div>
                        <div class="col-md-6">
                            <button type="button" id="btnExcelW09F4290" class="btn btn-default smallbtn pull-right" disabled>
                               <span class="fa fa-file-excel-o"></span>
                               &nbsp;{{Helpers::getRS($g,"Xuat_Excel_U")}}</button>
                            <button type="submit" class="btn btn-default smallbtn pull-right mgr5"><span
                                       class="digi digi-filter"></span>
                               &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
        <section id="divDetailW09F4290" style="margin-left: -5px;margin-right: -5px">
        </section>
    </div>
    <div class="l3-loading hide " style="background-color: #FFffff;">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
</section>
<script type="text/javascript">
    var bchangeW09F4290 = 1;
    $("#frmW09F4290").on('change', '#slEmployeeID', function () {
        $("#frmW09F4290").find('#txtEmployeeName').val($(this).find('option:selected').attr('data-name'));
        $("#frmW09F4290").find('#txtDepartmentID').val($(this).find('option:selected').attr('data-depid') + ' - ' + $(this).find('option:selected').attr('data-depname'));
        $("#frmW09F4290").find('#txtDutyID').val($(this).find('option:selected').attr('data-dutyid') + ' - ' + $(this).find('option:selected').attr('data-dutyname'));
    });

    $("#frmW09F4290").on('change', '#slMonth', function () {
        bchangeW09F4290 = 1;
    });

    $("#frmW09F4290").find('#slEmployeeID').trigger('change');

    $("#frmW09F4290").on('submit', function (e) {
        e.preventDefault();
        if (bchangeW09F4290 == 1)
            $("#secW09F4290 .l3-loading").removeClass("hide");
        else
            $("#pqgrid_W09F4290").pqGrid("showLoading");
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: $("#frmW09F4290").serialize() + "&change=" + bchangeW09F4290,
            success: function (data) {
                if (bchangeW09F4290 == 1)
                    $("#divDetailW09F4290").html(data);
                else {
                    var currentObject = $.parseJSON(data);
                    $("#pqgrid_W09F4290").pqGrid("option", "dataModel", {data: currentObject});
                    $("#pqgrid_W09F4290").pqGrid("hideLoading");
                    $("#pqgrid_W09F4290").pqGrid("refreshDataAndView");
                }
                $("#secW09F4290 .l3-loading").addClass("hide");
                $("#btnExcelW09F4290").removeAttr("disabled");
                bchangeW09F4290 = 0;
            }
        });
    });

    $("#btnExcelW09F4290").on("click", function () {
        W09F4290ExportExcel();
    });

    var W09F4290ExportExcel = function () {
        $('#btnExcelW09F4290').text('Exporting...');
        $('#btnExcelW09F4290').attr('disabled', 'disabled');
        var _title = [];
        var _dataIndx = [];
        var _align = [];
        var _format = [];
        initExportExcell($("#pqgrid_W09F4290"), _title, _dataIndx, _align, _format);

        $("#pqgrid_W09F4290").pqGrid("commit");
        var _data = JSON.stringify($("#pqgrid_W09F4290").pqGrid("option", "dataModel.data"));
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
                    downloadLink.download = "DataW09F4290_" + datea + ".xls";
                    downloadLink.innerHTML = "Download W09F4290";
                    downloadLink.href = data;
                    downloadLink.onclick = destroyClickedElement;
                    downloadLink.style.display = "none";
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                    $('#btnExcelW09F4290').removeAttr('disabled');
                    $('#btnExcelW09F4290').html('<span class="fa fa-file-excel-o"></span> {{Helpers::getRS($g,"Xuat_Excel_U")}}');
                }
            }
        });
    };

    $("#frmW09F4290").find("#slEmployeeID").select2({
        containerCssClass: "required"
    });
</script>

