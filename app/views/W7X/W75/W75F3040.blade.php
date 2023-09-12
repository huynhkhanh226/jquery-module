
<div class="modal fade modal noneOverflow noUseValidHTML5" id="modalW75F3040" data-keyboard="false"
     data-backdrop="static"
     role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="form-horizontal">
                <div class="modal-header">
                    {{Helpers::generateHeading($modalTitle,"W75F3040")}}
                </div>
                <div class="modal-body" style="padding:10px">
                    <form id="frmW75F3040">
                        <div class="row form-group">
                            <div class="col-md-2 col-xs-2">
                                <div class="liketext">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Thang")}}</label>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <select class="form-control noUseValidHTML5 select2 " id="cboPeriodW75F3040"
                                        name="cboPeriodW75F3040" required>
                                    @foreach($months as $rs)
                                        <option value="{{$rs["Period"]}}" >{{$rs["Period"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1 col-xs-1">
                                <div class="liketext">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Phong_ban")}}</label>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-3">
                                <select class="form-control noUseValidHTML5 select2" id="cboDepartmentIDW75F3040"
                                        name="cboDepartmentIDW75F3040" required>
                                    @foreach($departments as $rs)
                                        <option value="{{$rs["DepartmentID"]}}" >{{$rs["DepartmentName"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1 col-xs-1">
                                <div class="liketext">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Mau_bao_cao")}}</label>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-3">
                                <select class="form-control noUseValidHTML5 select2" id="cboReportIDW75F3040"
                                        name="cboReportIDW75F3040" required>
                                    @foreach($reportIDs as $rs)
                                        <option value="{{$rs["ReportCode"]}}" >{{$rs["ReportName"]}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="row form-group">

                            <div class="col-md-2 col-xs-2">
                                <div class="liketext">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Phieu_tinh_luong")}}</label>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <select class="form-control noUseValidHTML5 select2" id="cboSalaryVoucherIDW75F3040"
                                        name="cboSalaryVoucherIDW75F3040" required>
                                    @foreach($vouchers as $rs)
                                        <option value="{{$rs["SalaryVoucherID"]}}" >{{$rs["SalaryVoucherName"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-8 col-xs-8">
                                <button type="button" id="btnFilterW75F3040"
                                        class="btn btn-default smallbtn  pull-right"><span
                                            class="digi digi-filter"></span>
                                    &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                                <input type="submit" class="hide" id="hdBtnFilterW75F3040" name="hdBtnFilterW75F3040"/>
                            </div>
                        </div>
                    </form>
                    <div class="row form-group">
                        <div class="col-md-12 col-xs-12">
                            <div id="divW75F3040">
                                @include('W7X.W75.W75F3040_Ajax')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#btnFilterW75F3040").click(function(){
            reloadGrid();
        });
        $("#cboPeriodW75F3040").select2();
        $("#cboDepartmentIDW75F3040").select2();
        $("#cboReportIDW75F3040").select2();
        $("#cboSalaryVoucherIDW75F3040").select2();

        $("#cboPeriodW75F3040").change(function(){
            var arr = $(this).val().split("/");
            $(".l3loading").removeClass('hide');
            $.ajax({
                method: "POST",
                url: '{{url("/W75F3040/$pForm/$g/loadsalary")}}',
                data: {
                    tranMonth: arr[0],
                    tranYear: arr[1]
                },
                success: function (data) {
                    $("#cboSalaryVoucherIDW75F3040").html(data);
                    $("#cboSalaryVoucherIDW75F3040").select2("destroy");
                    $("#cboSalaryVoucherIDW75F3040").select2();
                    $(".l3loading").addClass('hide');
                }
            });
        });

        function reloadGrid(){
            $(".l3loading").removeClass('hide');
            $.ajax({
                method: "POST",
                url: '{{url("/W75F3040/$pForm/$g/loadgrid")}}',
                data: $("#frmW75F3040").serialize(),
                success: function (data) {
                    if (data != null){
                        $("#divW75F3040").html(data);
                    }else{
                        console.log('nothing reponse data');
                    }
                    $(".l3loading").addClass('hide');
                }
            });
        }
    });

</script>

