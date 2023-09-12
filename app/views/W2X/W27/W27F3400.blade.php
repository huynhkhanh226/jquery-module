{{--Test tại 10.0.0.181 pass: 123  DB:V40--}}
<div class="modal fade pd0" id="modalW27F3400" data-backdrop="static" role="dialog" style="position: absolute !important;">
    <div class="modal-dialog  modal-lg formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($modalTitle,"W27F3400", true,"",true,"D27F3400","W27F3400")}}
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="frmW27F3400" name="frmW27F3400" method="post">
                    <div class="row pdt5" style="margin-left: -5px !important;margin-right: -5px !important;">
                        <div class="col-md-6 pdt10">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label class="lbl-normal liketext">{{Helpers::getRS($g,"Don_vi")}}</label>
                                </div>
                                <div class="col-md-9">
                                    <select id="slDivisionID" name="slDivisionID" class="form-control selectpicker required" multiple data-actions-box="true" data-selected-text-format="count > 5"
                                            required>
                                        @foreach($div as $row)
                                            <option title="{{$row["Value"]}}" value="{{$row["Value"]}}">{{$row["Caption"]}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label class="lbl-normal liketext">{{Helpers::getRS($g,"Du_an")}}</label>
                                </div>
                                <div class="col-md-9">
                                    <select id="slPropertyID" name="slPropertyID" class="form-control selectpicker required" multiple data-actions-box="true" data-selected-text-format="count > 5"
                                            required>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label class="lbl-normal liketext">{{Helpers::getRS($g,"Loai_hinh_san_pham")}}</label>
                                </div>
                                <div class="col-md-9">
                                    <select id="slPropertyTypeID" name="slPropertyTypeID" class="form-control selectpicker required" multiple data-actions-box="true"
                                            data-selected-text-format="count > 5" required>
                                        @foreach($proptype as $row)
                                            <option value="{{$row["Value"]}}">{{$row["Caption"]}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pdt10">
                            <div class="form-group">
                                <div class="col-md-2">
                                    <label class="lbl-normal liketext">{{Helpers::getRS($g,"Phan_khu")}}</label>
                                </div>
                                <div class="col-md-10">
                                    <select id="slSubDivision" name="slSubDivision" class="form-control selectpicker required" multiple data-actions-box="true" data-selected-text-format="count > 3">
                                        @foreach($subdiv as $row)
                                            <option value="{{$row["Value"]}}">{{$row["Caption"]}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-2 pdr0">
                                    <label class="lbl-normal liketext">{{Helpers::getRS($g,"Ngay_bao_cao")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group date">
                                        <input type="text" class="form-control" id="txtReportDate" name="txtReportDate" value="{{date("d/m/Y")}}" required>
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label class="lbl-normal liketext">{{Helpers::getRS($g,"Nam_hien_thi")}}</label>
                                </div>
                                <div class="col-md-4">
                                    <select id="slYearShow" name="slYearShow" class="form-control">
                                        @foreach($year as $row)
                                            <option value="{{$row["Value"]}}">{{$row["Caption"]}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="chkIsShowDetail"> {{Helpers::getRS($g,"Hien_thi_chi_tiet")}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" id="btnExcelW27F3400" class="btn btn-default smallbtn pull-right mgl15 hide"><span class="fa fa-file-excel-o"></span>
                                        &nbsp;{{Helpers::getRS($g,"Xuat_Excel_U")}}</button>
                                    <button type="submit" class="btn btn-default smallbtn pull-right"><span class="digi digi-filter"></span>
                                        &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <section id="divDetailW27F3400">
                </section>
            </div>
            <div class="l3loading hide ">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<iframe id="txtArea1" style="display:none"></iframe>
<script type="text/javascript">
    var bchangeW27F3400 = true;
    $(document).ready(function () {
        $('.input-group.date').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: 'vi'
        });

        //Initialize Select2 Elements
        $(".selectpicker").selectpicker("selectAll");

        //Đổ nguồn phụ thuộc cho Dự án
        $('#slDivisionID, #slSubDivision').on('hidden.bs.select', function (e) {
            if (bchangeW27F3400) {
                $.ajax({
                    method: "POST",
                    url: "{{url('W27F3400/loadCombo')}}",
                    data: {div: $('#slDivisionID').val(), subdiv: $('#slSubDivision').val()},
                    success: function (data) {
                        $("#slPropertyID").html(data).selectpicker('refresh');
                    }
                });
            }
            bchangeW27F3400 = false;
        });

        $('#slDivisionID, #slSubDivision').on('changed.bs.select', function (e) {
            bchangeW27F3400 = true;
        });

        $('#slDivisionID').trigger("hidden.bs.select");
    });

    $("#frmW27F3400").on('submit', function (e) {
        e.preventDefault();
        $("#modalW27F3400 .l3loading").removeClass("hide");
        var div = $('#slDivisionID').val();
        var property = $('#slPropertyID').val();
        var subdiv = $('#slSubDivision').val();
        var protype = $('#slPropertyTypeID').val();
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: $("#frmW27F3400").serialize() + "&div=" + div + "&property=" + property + "&subdiv=" + subdiv + "&protype=" + protype,
            success: function (data) {
                //Phải remove nếu ko bị double scroll
                $("#scrollW27F3400").getNiceScroll().remove();
                $("#divDetailW27F3400").html(data);
                $("#modalW27F3400 .l3loading").addClass("hide");
                $("#modalW27F3400 #btnExcelW27F3400").removeClass("hide");
            }
        });
    });

    $(document).on('hide.bs.modal', ' #modalW27F3400', function () {
        //Xóa bảng tạm
        $.ajax({
            method: "DELETE",
            url: "{{Request::url()}}"
        });
        //Phải remove nếu ko vẫn có scrollbar trên homepage
        $("#scrollW27F3400").getNiceScroll().remove();
    });

    $("#btnExcelW27F3400").on("click", function () {
        fnExcelReportW27F3400('#tableW27F3400Main', 'Data');
    });

    var fnExcelReportW27F3400 = (function () {
        var uri = 'data:application/vnd.ms-excel;base64,'
                , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table border="1px">{table}</table></body></html>'
                , base64 = function (s) {
                    return window.btoa(unescape(encodeURIComponent(s)))
                }
                , format = function (s, c) {
                    return s.replace(/{(\w+)}/g, function (m, p) {
                        return c[p];
                    })
                };
        return function (table, name) {
            var tab_text = "";
            var j = 0;
            var tab = document.getElementById('tableW27F3400Main'); // id of table
            for (j = 0; j < tab.rows.length; j++) {
                var row = $(tab.rows[j]);
                if (!row.hasClass("detail-row") || !row.hasClass("hide")) //Chỉ xuất những dòng hiển thị
                    tab_text = tab_text + row.html() + "</tr>";
            }

            var ctx = {worksheet: name || 'Worksheet', table: tab_text};
            var today = new Date();
            var datea = today.getFullYear() + '' + (today.getMonth() + 1) + '' + today.getDate() + '' + today.getHours() + '' + today.getMinutes() + '' + today.getSeconds();
            var downloadLink = document.createElement("a");
            downloadLink.download = "W27F3400_" + datea + ".xls";
            downloadLink.innerHTML = "Download W27F3400";
            downloadLink.href = uri + base64(format(template, ctx));
            downloadLink.onclick = destroyClickedElement;
            downloadLink.style.display = "none";
            document.body.appendChild(downloadLink);
            downloadLink.click();
        }
    })()
</script>

