{{--Test tại 10.0.0.181 pass: 123  DB:V40--}}
<section class="content" id="secW01F3040">
    <form class="form-horizontal" id="frmW01F3040" name="frmW01F3040" method="post">
        <div class="row" style="margin-left: -5px !important;margin-right: -5px !important;">
            <div class="col-md-6">
                <div class="form-group mgb5">
                    <div class="col-md-3">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Don_vi")}}</label>
                    </div>
                    <div class="col-md-9">
                        <select id="cboDivisionIDW01F3040" name="cboDivisionIDW01F3040" class="form-control selectpicker required "   multiple data-actions-box="true"  data-live-search="true" data-selected-text-format="count > 5"  required>
                            @foreach($div as $row)
                                <option title="{{$row["Value"]}}" value="{{$row["Value"]}}">{{$row["Caption"]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mgb5">
                    <div class="col-md-3">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Du_an")}}</label>
                    </div>
                    <div class="col-md-9">
                        <select id="cboPropertyIDW01F3040" name="cboPropertyIDW01F3040" class="form-control selectpicker required "  multiple data-actions-box="true" data-live-search="true" data-selected-text-format="count > 5"
                                required>
                        </select>
                    </div>
                </div>
                <div class="form-group mgb5">
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkIsReceiveW01F3040" name="chkIsReceiveW01F3040" value="1" checked> {{Helpers::getRS($g,"ThuU")}}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkIsPaymentW01F3040" name="chkIsPaymentW01F3040" value="1" checked> {{Helpers::getRS($g,"Chi")}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="form-group mgb5">
                    <div class="col-md-3">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Phan_khu")}}</label>
                    </div>
                    <div class="col-md-9">
                        <select id="cboSubDivisionIDW01F3040" name="cboSubDivisionIDW01F3040" class="form-control selectpicker"  multiple data-actions-box="true"   data-live-search="true"  data-live-search="true" data-selected-text-format="count > 3">
                            @foreach($subdiv as $row)
                                <option title="{{$row["Value"]}}" value="{{$row["Value"]}}">{{$row["Caption"]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mgb5">
                    <div class="col-md-3 pdr0">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Ngay_bao_cao")}}</label>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group date">
                            <input type="text" class="form-control" id="txtReportDateW01F3040" name="txtReportDateW01F3040" value="{{date("d/m/Y")}}" required>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Nam_hien_thi")}}</label>
                    </div>
                    <div class="col-md-2">
                        <select id="cboYearShowW01F3040" name="cboYearShowW01F3040" class="form-control">
                            @foreach($year as $row)
                                <option value="{{$row["Value"]}}">{{$row["Caption"]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mgb5">
                    <div class="col-md-4">
                        <div class="checkbox">
                            <label class="">
                                <input  type="checkbox" id="chkIsShowDetailW01F3040" name="chkIsShowDetailW01F3040"> {{Helpers::getRS($g,"Hien_thi_chi_tiet")}}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <button type="button" id="btnRefreshW01F3040" data-toggle="tooltip" title="" class="btn btn-default smallbtn pull-right text-center"><span class="fa fa-refresh"></span>
                            &nbsp;</button>
                        <button type="button" id="btnExcelW01F3040" class="btn btn-default smallbtn pull-right mgr5 hide"><span class="fa fa-file-excel-o"></span>
                            &nbsp;{{Helpers::getRS($g,"Xuat_Excel_U")}}</button>
                        <button id="btnFilterW01F3040" type="button" class="btn btn-default smallbtn pull-right mgr5"><span class="digi digi-filter"></span>
                            &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                        <input type="submit" class="hide" id="btnFilterW01F3040Hidden" />
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" id="hdBtnSubmitW01F3040" class="hidden"></button>
    </form>
    <section id="divDetailW01F3040">
    </section>
</section>

<iframe id="txtArea1" style="display:none"></iframe>
<script type="text/javascript">
    var bchangeW01F3040 = true;
    $(document).ready(function () {
        $('.input-group.date').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });

        //Initialize Select2 Elements
        $("#cboDivisionIDW01F3040").selectpicker();
        $("#cboSubDivisionIDW01F3040").selectpicker();
        $("#cboPropertyIDW01F3040").selectpicker();

    });

    $("#btnFilterW01F3040").click(function(event){
        validationForm($("#frmW01F3040"), function(){
            if (!$("#chkIsReceiveW01F3040").is(":checked") && !$("#chkIsPaymentW01F3040").is(":checked")){
                alert_warning("{{Helpers::getRS($g, 'Vui_long_chon_it_nhat_mot_checkbox')}}", function(){
                    $("#chkIsReceiveW01F3040").focus();
                });
                return false;
            }
            $("#frmW01F3040").find('#btnFilterW01F3040Hidden').click();
        });

        //$("#frmW01F3040").find('#btnFilterW01F3040Hidden').click();

    });

    //Đổ nguồn phụ thuộc cho Dự án
    $('#cboDivisionIDW01F3040').on('changed.bs.select', function (e) {
        $.ajax({
            method: "POST",
            url: "{{url('W01F3040/view/'.$pForm.'/'.$g.'/loadCombo')}}",
            data: {div: $('#cboDivisionIDW01F3040').val(), subdiv: $('#cboSubDivisionIDW01F3040').val()},
            success: function (data) {
                $("#cboPropertyIDW01F3040").html(data).selectpicker('refresh');
            }
        });
    });

    $('#cboSubDivisionIDW01F3040').on('changed.bs.select', function (e) {
        $.ajax({
            method: "POST",
            url: "{{url('W01F3040/view/'.$pForm.'/'.$g.'/loadCombo')}}",
            data: {div: $('#cboDivisionIDW01F3040').val(), subdiv: $('#cboSubDivisionIDW01F3040').val()},
            success: function (data) {
                $("#cboPropertyIDW01F3040").html(data).selectpicker('refresh');
            }
        });
    });

    $("#frmW01F3040").on('submit', function (e) {
        e.preventDefault();
        $(".l3loading").removeClass("hide");
        var div = $('#cboDivisionIDW01F3040').val();
        var subdiv = $('#cboSubDivisionIDW01F3040').val();
        var property = $('#cboPropertyIDW01F3040').val();
        var isReceive = $("#chkIsReceiveW01F3040").is(':checked') ? 1 : 0;
        var isPayment = $("#chkIsPaymentW01F3040").is(':checked') ? 1 : 0;
        var isShowDetail = $("#chkIsShowDetailW01F3040").is(':checked') ? 1 : 0;


        $.ajax({
            method: "POST",
            url: "{{url('W01F3040/view/'.$pForm.'/'.$g.'/filter')}}",
            data: $("#frmW01F3040").serialize() + "&div=" + div + "&property=" + property + "&subdiv=" + subdiv + "&isReceive=" + isReceive + "&isPayment=" + isPayment + "&isShowDetail=" + isShowDetail,
            success: function (data) {
                //Phải remove nếu ko bị double scroll
                $("#scrollW01F3040").getNiceScroll().remove();
                $("#divDetailW01F3040").html(data);
                $(".l3loading").addClass("hide");
                $("#btnExcelW01F3040").removeClass("hide");
            }
        });
    });


    $("#btnExcelW01F3040").on("click", function () {
        fnExcelReportW01F3040('#tableW01F3040Main', 'Data');
    });

    var fnExcelReportW01F3040 = (function () {
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
            var tab = document.getElementById('tableW01F3040Main'); // id of table
            for (j = 0; j < tab.rows.length; j++) {
                var row = $(tab.rows[j]);
                if (!row.hasClass("detail-row") || !row.hasClass("hide")) //Chỉ xuất những dòng hiển thị
                    tab_text = tab_text + row.html() + "</tr>";
            }

            var ctx = {worksheet: name || 'Worksheet', table: tab_text};
            var today = new Date();
            var datea = today.getFullYear() + '' + (today.getMonth() + 1) + '' + today.getDate() + '' + today.getHours() + '' + today.getMinutes() + '' + today.getSeconds();
            var downloadLink = document.createElement("a");
            downloadLink.download = "W01F3040_" + datea + ".xls";
            downloadLink.innerHTML = "Download W01F3040";
            downloadLink.href = uri + base64(format(template, ctx));
            downloadLink.onclick = destroyClickedElement;
            downloadLink.style.display = "none";
            document.body.appendChild(downloadLink);
            downloadLink.click();
        }
    })()


    $("#btnRefreshW01F3040").click(function(){
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            url: "{{url('W01F3040/view/'.$pForm.'/'.$g.'/collect')}}",
            success: function (data) {
                $(".l3loading").addClass('hide');
            }
        });
    });

    $("#btnRefreshW01F3040").mouseenter(function(){
        $("#btnRefreshW01F3040").confirmation('destroy');
        $.ajax({
            method: "POST",
            url: "{{url('W01F3040/view/'.$pForm.'/'.$g.'/getdate')}}",
            success: function (data) {
                $("#btnRefreshW01F3040").confirmation({
                    btnOkLabel: '',
                    btnCancelLabel: '',
                    popout: true,
                    placement: "bottom",
                    singleton: true,
                    template:
                    '<div class="popover" style="display: inline-flex;width: 400px"><div class="arrow"></div>'
                    + '<div class="popover-content" style="text-align: left;padding:10px;"><span class=""><label class="lbl-normal confirmContent pull-left">'
                    + data
                    + '</label></span></div>'
                    + '</div>'
                });
                $("#btnRefreshW01F3040").fadeIn( "slow", function() {
                    $("#btnRefreshW01F3040").confirmation('show');
                });


            }
        });
    });

    $("#btnRefreshW01F3040").mouseout(function(){
        //alert('sdfsdf');
        $(".popover ").css('display', 'none');
        //$("#btnRefreshW01F3040").confirmation('hide');
        //$("#btnRefreshW01F3040").confirmation('destroy');

    });


    $(".sidebar-toggle").click(function(){
        //$("#btnFilterW01F3040").click();
    });
</script>
<style>
    .nicescroll-cursors{
        z-index: 99999 !important;
    }
</style>

