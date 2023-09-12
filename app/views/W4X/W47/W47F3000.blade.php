{{--Test tại DRDL7\SQL2014 pass: 123  DB:FN1--}}
<section class="content" id="secW47F3000">
    <form class="form-horizontal" id="frmW47F3000" name="frmW47F3000" method="post">
        <div class="row" style="margin-left: -5px !important;margin-right: -5px !important;">
            <div class="col-md-6">
                <div class="form-group mgb5">
                    <div class="col-md-3">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Phan_nhom")}}</label>
                    </div>
                    <div class="col-md-9">
                        <select id="slSubDivision" name="slSubDivision"
                                class="form-control selectpicker required" multiple data-actions-box="true"
                                data-live-search="true" data-selected-text-format="count > 5"
                                required>
                            @foreach($subdiv as $row)
                                <option title="{{$row["Value"]}}" divisionids="{{$row["DivisionID"]}}"
                                        value="{{$row["Value"]}}" {{$row["Value"]=='%'?'selected':'disabled'}}>{{$row["Caption"]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mgb5">
                    <div class="col-md-3">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Don_vi_tinh")}}</label>
                    </div>
                    <div class="col-md-4">
                        <select id="slMoneyUnitID" name="slMoneyUnitID" class="form-control" required>
                            @foreach($unit as $row)
                                <option value="{{$row["Value"]}}"
                                        data-widthColumn="{{$row['DateColumnWidth']}}">{{$row["Caption"]}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-5">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="chkIsShowDetail"
                                       checked> {{Helpers::getRS($g,"Hien_thi_chi_tiet")}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mgb5">
                    <div class="col-md-2">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Don_vi")}}</label>
                    </div>
                    <div class="col-md-10">
                        <select id="slDivisionID" name="slDivisionID"
                                class="form-control selectpicker required" multiple data-actions-box="true"
                                data-live-search="true" data-selected-text-format="count > 5"
                                required>
                            @foreach($div as $row)
                                <option title="{{$row["Value"]}}"
                                        value="{{$row["Value"]}}" {{$row["Value"]=='%'?'selected':'disabled'}}>{{$row["Caption"]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mgb5">
                    <div class="col-md-2 pdr0">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Ngay")}}</label>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input class="form-control pull-right" id="txtDate" name="txtDate" type="text"
                                   value="{{date('d/m/Y').' - '.date('d/m/Y', strtotime("+90 days"))}}"
                                   required>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <button type="button" id="btnRefreshW47F3000" data-toggle="tooltip" title="Refresh"
                                class="btn btn-default smallbtn pull-right  text-center"><span
                                    class="fa fa-refresh"></span>
                            &nbsp;
                        </button>
                        <button type="button" id="btnExcelW47F3000" title="{{Helpers::getRS($g,"Xuat_Excel_U")}}"
                                class="btn btn-default smallbtn pull-right  mgr5" disabled><span
                                    class="fa fa-file-excel-o"></span>
                            &nbsp;{{--{{Helpers::getRS($g,"Xuat_Excel_U")}}--}}</button>
                        <button type="submit" id="btnFilterW47F3000" title="{{Helpers::getRS($g,"Loc")}}"
                                class="btn btn-default smallbtn pull-right mgr5"><span
                                    class="digi digi-filter"></span>
                            &nbsp;{{--{{Helpers::getRS($g,"Loc")}}--}}</button>
                        <input type="submit" id="hdFiflterW47F3000" class="hide">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom tabW47F3000 hide">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#divDetailW47F3000" data-toggle="tab" aria-expanded="true"
                                          onclick="refreshScrollbar();">{{Helpers::getRS($g,"Hop_nhat")}}</a>
                    </li>
                </ul>
                <div class="tab-content">
                    @if ($isShowMasterPlan == 1)
                        <div id="divMasterPlan">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="checkbox mgt3">
                                        <label>
                                            <input type="checkbox" class="chkIsMasterPlan"
                                                   id="chkIsMasterPlan"> {{Helpers::getRS($g,"Ke_hoach_thanh_toan_gia_dinh")}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="tab-pane active" id="divDetailW47F3000">

                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
        </div>
    </div>
    <div class="cube-loading hide">
        <div>
            <div class="c1"></div>
            <div class="c2"></div>
            <div class="c3"></div>
            <div class="c4"></div>
        </div>
        <span>Please wait...</span>
    </div>
    <div id="divModalW47F3002"></div>
    @include('W4X.W47.W47F3001')
</section>




<script type="text/javascript">
    var heightW47F3000, arrayMasterW47F3000 = null;
    var subdivList = {{json_encode($subdiv)}}
    $(document).ready(function () {
        heightW47F3000 = $("#divD47F4030_W47F3000_W47F3000").height() - $("#frmW47F3000").height();
        $('#txtDate').daterangepicker({
            format: 'DD/MM/YYYY',
            startDate: '{{date('d/m/Y')}}',
            endDate: '{{date('d/m/Y', strtotime("+90 days"))}}',
            minDate: '{{date('d/m/Y')}}',
            maxDate: '{{date('d/m/Y', strtotime("+90 days"))}}',
            autoApply: true
        });

        //Initialize Select2 Elements
        $(".selectpicker").selectpicker({
            multipleSeparator: ";",
            dropdownAlignRight: true
        });

        //Chặn chỉ cho chọn 1 trong 2 (% hay Đơn vị)
        $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').on('changed.bs.select', function (e) {
            var div = $(this).val();
            if (div != null && div.length == 1 && div[0] == '%') {
                $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').selectpicker('deselectAll');
                $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').selectpicker('val', '%');
                $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').find('[value!="%"]').prop('disabled', 'disabled');
                $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').selectpicker('refresh');
            } else {
                $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').find('[value="%"]').prop('selected', false);
                $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').find('[value!="%"]').prop('disabled', '');
                $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').selectpicker('refresh');
            }
        });

        //Chặn chỉ cho chọn 1 trong 2 (% hay Đơn vị
        $('#divD47F4030_W47F3000_W47F3000').find('#slSubDivision').on('changed.bs.select', function (e) {
            var subdiv = $(this).val();
            if (subdiv != null) {
                if (subdiv[0] == '%') {
                    $('#divD47F4030_W47F3000_W47F3000').find('#slSubDivision').selectpicker('deselectAll');
                    $('#divD47F4030_W47F3000_W47F3000').find('#slSubDivision').selectpicker('val', '%');
                    $('#divD47F4030_W47F3000_W47F3000').find('#slSubDivision').find('[value!="%"]').prop('disabled', 'disabled');
                    $('#divD47F4030_W47F3000_W47F3000').find('#slSubDivision').selectpicker('refresh');
                }else{
                    $('#divD47F4030_W47F3000_W47F3000').find('#slSubDivision').find('[value="%"]').prop('disabled', 'disabled');
                    $('#divD47F4030_W47F3000_W47F3000').find('#slSubDivision').selectpicker('refresh');
                }
            } else {
                $('#divD47F4030_W47F3000_W47F3000').find('#slSubDivision').selectpicker('val', '');
                $('#divD47F4030_W47F3000_W47F3000').find('#slSubDivision').find('[value!="%"]').prop('disabled', '');
                $('#divD47F4030_W47F3000_W47F3000').find('#slSubDivision').find('[value="%"]').prop('disabled', '');
                $('#divD47F4030_W47F3000_W47F3000').find('#slSubDivision').selectpicker('refresh');
            }


            var subdiv = $(this).val();
            if (subdiv != null) {
                if (subdiv[0] == '%') {
                    $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').selectpicker('deselectAll');
                    $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').selectpicker('val', '%');
                    $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').find('[value!="%"]').prop('disabled', 'disabled');
                    $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').selectpicker('refresh');
                } else {
                    div = subdiv.join(";");
                    var divList = "";
                    for (var i = 0; i < subdivList.length; i++) {
                        for (var j = 0; j < subdiv.length; j++) {
                            if (subdiv[j] == subdivList[i]["Value"]) {
                                if (divList == "")
                                    divList = subdivList[i]["DivisionID"];
                                else
                                    divList += ";" + subdivList[i]["DivisionID"];


                            }
                        }
                    }
                    var arrDiv = divList.split(";");
                    if (divList.length > 0 != "") {
                        $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').selectpicker('val', arrDiv);
                        $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').find('[value="%"]').prop('disabled', 'disabled');
                        $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').selectpicker('refresh');
                        //reloadProject($('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').selectpicker('val').join(";"));
                    } else {
                        $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').selectpicker('deselectAll');
                        $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').selectpicker('val', '%');
                        $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').find('[value!="%"]').prop('disabled', 'disabled');
                        $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').selectpicker('refresh');
                    }
                }

            } else { //truong hop bang null
                $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').selectpicker('val', '');
                $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').find('[value!="%"]').prop('disabled', '');
                $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').find('[value="%"]').prop('disabled', '');
                $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').selectpicker('refresh');
            }
        });


    });



    $("#frmW47F3000").on('submit', function (e) {
        e.preventDefault();
        $("#divD47F4030_W47F3000_W47F3000 .cube-loading").removeClass("hide");
        var div = $('#divD47F4030_W47F3000_W47F3000').find('#slDivisionID').val();
        var subdiv = $('#divD47F4030_W47F3000_W47F3000').find('#slSubDivision').val();
        var datef = $('#frmW47F3000').find('#txtDate').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var datet = $('#frmW47F3000').find('#txtDate').data('daterangepicker').endDate.format('YYYY-MM-DD');
        var textunit = $("#frmW47F3000").find("#slMoneyUnitID option:selected").text();
        var widthcol = $("#frmW47F3000").find("#slMoneyUnitID option:selected").attr('data-widthColumn');
        var isPlan = "0";
        if ($("#divMasterPlan").length > 0 && $("#divMasterPlan").is(":visible")) {
            isPlan = ($("#chkIsMasterPlan").is(':checked') == true ? "1" : "0")
        }
        arrayMasterW47F3000 = null;
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: $("#frmW47F3000").serialize() + "&div=" + div + "&datef=" + datef + "&datet=" + datet + '&textunit=' + textunit + '&widthcol=' + widthcol + '&subdiv=' + subdiv + "&isPlan=" + isPlan,
            success: function (data) {
                $("#scrollW47F3000").getNiceScroll().remove();
                //Xóa all tab ngoại trừ tab Hợp nhất
                var anchor = $('.tabW47F3000').find('a.atab-close');
                for (var i = 0; i < anchor.length; i++) {
                    $($(anchor[i]).attr('href')).remove();
                    $(anchor[i]).parent().remove();
                }
                $(".nav-tabs li").children('a').first().click();
                //Get data cho tab Hợp nhất
                $("#divDetailW47F3000").html(data);

                $("#divD47F4030_W47F3000_W47F3000").find(".cube-loading").addClass("hide");
                $("#divD47F4030_W47F3000_W47F3000").find("#btnExcelW47F3000").prop("disabled", "");
                $("#divD47F4030_W47F3000_W47F3000").find(".tabW47F3000").removeClass("hide");
            }
        });
    });

    $("#chkIsMasterPlan").change(function () {
        $("#frmW47F3000").submit();
    });

    $(".tabW47F3000 .nav-tabs").on("click", "button", function (e) {
        var anchor = $(this).siblings('a');
        $(anchor.attr('href')).getNiceScroll().remove();
        $(anchor.attr('href')).remove();
        $(this).parent().remove();
        $(".nav-tabs li").children('a').first().click();
    });

    var addTabW47F3000 = function (itemcode, name, a, template, IsBeginMonth, isPaging) {
        var tb = $('.tabW47F3000').find('#tabChild_' + itemcode);
        $(a).closest(".nav-tabs").getNiceScroll().hide();
        $("#divContainerW47F3000 #scrollW47F3000").getNiceScroll().hide();
        if (tb.length == 0) {//tab not exist
            $("#divD47F4030_W47F3000_W47F3000 .cube-loading").removeClass("hide");
            $('.tabW47F3000').find('.nav-tabs').append('<li class="tab-close"><a class="atab-close tabChild' + itemcode + '" href="#tabChild_' + itemcode + '" data-toggle="tab" aria-expanded="true" onclick="refreshScrollbar()">' + name + '</a> <button class="close" type="button">×</button></li>');
            $('.tabW47F3000').find('.tab-content').append('<div class="tab-pane" id="tabChild_' + itemcode + '"></div>');
            var cell = $(a).parent();
            var level = $(cell).attr("data-level");
            var parameter = $(cell).attr("data-parameter");
            var isShowPlan = $(cell).attr("data-isPlan");
            var isShowButton = $(cell).attr("data-isButtonHistory");
            var isPlan = $(cell).closest(".tab-pane").find('.chkIsPlanW47F3000').is(':checked') ? 1 : 0;
            var isPlan = "0";
            if ($("#divMasterPlan").length > 0 && $("#divMasterPlan").is(":visible")) {
                isPlan = ($("#chkIsMasterPlan").is(':checked') == true ? "1" : "0")
            }
            $('.tabW47F3000').find('a.tabChild' + itemcode).click();
            //alert(isPaging);
            $.ajax({
                method: "POST",
                url: "{{Request::url()}}",
                data: {
                    itemcode: itemcode,
                    array: arrayMasterW47F3000,
                    level: level,
                    template: template,
                    parameter: parameter,
                    isShowPlan: isShowPlan,
                    isPlan: isPlan,
                    isShowButton: isShowButton,
                    IsBeginMonth: IsBeginMonth,
                    isPaging: isPaging
                },
                success: function (data) {
                    //Gán itemcode vào ID của tab để nhận diện
                    $("#tabChild_" + itemcode).html(data);
                    $("#divD47F4030_W47F3000_W47F3000 .cube-loading").addClass("hide");
                    refreshScrollbar();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $("#divD47F4030_W47F3000_W47F3000 .cube-loading").addClass("hide");
                    console.log(jqXHR);
                }
            });
        } else {
            $('.tabW47F3000').find('a.tabChild' + itemcode).click();
        }
    };

    $("#btnExcelW47F3000").on("click", function () {
        fnExcelReportW47F3000();
    });

    var fnExcelReportW47F3000 = (function () {

        /*var today = new Date();
        var datea = today.getFullYear() + '' + (today.getMonth() + 1) + '' + today.getDate() + '' + today.getHours() + '' + today.getMinutes() + '' + today.getSeconds();
        //$(".l3loading").removeClass("hide");
        $(".tabW47F3000 .tab-content").find('div.tab-pane.active #tableW47F3000Main').tableExport({
                type:'excel',
                fileName: "Bao_cao_dong_tien_theo_ngay_" + datea
        });*/

        if ($(".tabW47F3000 .tab-content").find('div.tab-pane.active .pq-grid').length > 0){
            w47F3000ExportExcel();
        }else{
            var uri = 'data:application/vnd.ms-excel;base64,'
                ,
                template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
                , base64 = function (s) {
                    return window.btoa(unescape(encodeURIComponent(s)))
                }
                , format = function (s, c) {
                    return s.replace(/{(\w+)}/g, function (m, p) {
                        return c[p];
                    })
                };

            var rows = $(".tabW47F3000 .tab-content").find('div.tab-pane.active #tableW47F3000Main tr');
            var tab_text = "";
            for (var j = 0; j < rows.length; j++) {
                var row = $(rows[j]);
                if (!row.hasClass("detail-row") || !row.hasClass("hide")) //Chỉ xuất những dòng hiển thị
                    tab_text = tab_text + row.html() + "</tr>";
            }
            var ctx = {worksheet: 'Data' || 'Worksheet', table: tab_text};
            var today = new Date();
            var datea = today.getFullYear() + '' + (today.getMonth() + 1) + '' + today.getDate() + '' + today.getHours() + '' + today.getMinutes() + '' + today.getSeconds();
            var downloadLink = document.createElement("a");
            downloadLink.download = "Bao_cao_dong_tien_theo_ngay_" + datea + ".xls";
            downloadLink.innerHTML = "Download W47F3000";
            downloadLink.href = uri + base64(format(template, ctx));
            downloadLink.onclick = destroyClickedElement;
            downloadLink.style.display = "none";
            document.body.appendChild(downloadLink);
            downloadLink.click();
        }



    });

    $(document).on('hide.bs.modal', ' #divD47F4030_W47F3000_W47F3000', function () {
        $("#scrollW47F3000").getNiceScroll().remove();
    });

    $('.tabW47F3000 a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $("#divContainerW47F3000 .ft_scroller").getNiceScroll().onResize();
        //$("#scrollW47F3000").getNiceScroll().resize();
        console.log(e.target);
    });

    //Refresh Scrollbar khi chuyển tab
    function refreshScrollbar() {
        setTimeout(function () {
            var divs = $("#divD47F4030_W47F3000_W47F3000 .tab-content").find(".ft_container");
            for (var i = 0; i < divs.length; i++) {
                var id = $(divs[i]).attr('id');
                $("#" + id + " #scrollW47F3000").getNiceScroll().resize();
            }
            if ($("#divMasterPlan").length > 0) {
                if ($(".tabW47F3000").find('#divDetailW47F3000').hasClass('active')) {
                    $("#divMasterPlan").removeClass('hide');
                } else {
                    $("#divMasterPlan").addClass('hide');
                }
            }
        }, 500);
    }

    $("#btnRefreshW47F3000").click(function () {
        $(".cube-loading").removeClass('hide');
        $("#divModalW47F3002").html("");
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}" + "/isCollect",
            success: function (data) {
                $(".cube-loading").addClass('hide');
            }
        });
    });

    $("#btnRefreshW47F3000").mouseenter(function () {
        $("#btnRefreshW47F3000").confirmation('destroy');
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}" + "/getDate",
            success: function (data) {
                $("#btnRefreshW47F3000").confirmation({
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
                $("#btnRefreshW47F3000").fadeIn("slow", function () {
                    $("#btnRefreshW47F3000").confirmation('show');
                });


            }
        });
    });

    $("#btnRefreshW47F3000").mouseout(function () {
        //alert('sdfsdf');
        //$(".popover ").css('display', 'none');
        //$("#btnRefreshW47F3000").confirmation('hide');
        //$("#btnRefreshW47F3000").confirmation('destroy');
        $(".popover ").css('display', 'none');

    });

</script>

