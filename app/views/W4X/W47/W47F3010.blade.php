{{--Test tại DRDL7\SQL2014 pass: 123  DB:FN1--}}

<section class="content" id="secW47F3010">
    <form class="form-horizontal" id="frmW47F3010" name="frmW47F3010" method="post">
        <div class="row" style="margin-left: -5px !important;margin-right: -5px !important;">
            <div class="col-md-4 ">
                <div class="form-group mgb5">
                    <div class="col-md-4">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Phan_nhom")}}</label>
                    </div>
                    <div class="col-md-8">
                        <select id="slSubDivision" name="slSubDivision" class="form-control selectpicker required" multiple data-actions-box="true" data-live-search="true"  data-selected-text-format="count > 5"
                                required>
                            @foreach($subdiv as $row)
                                <option title="{{$row["Value"]}}" divisionids="{{$row["DivisionID"]}}" value="{{$row["Value"]}}" {{$row["Value"]=='%'?'selected':'disabled'}}>{{$row["Caption"]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="form-group mgb5">
                    <div class="col-md-4">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Don_vi")}}</label>
                    </div>
                    <div class="col-md-8">

                        <select id="slDivisionID" name="slDivisionID" class="form-control selectpicker required" multiple data-actions-box="true" data-selected-text-format="count > 5"
                                required>
                            @foreach($div as $row)
                                <option title="{{$row["Value"]}}" value="{{$row["Value"]}}" {{$row["Value"]=='%'?'selected':'disabled'}}>{{$row["Caption"]}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="form-group mgb5">
                    <div class="col-md-4">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Du_an")}}</label>
                    </div>
                    <div class="col-md-8">
                        <select id="slProjectID" name="slProjectID" class="form-control selectpicker required" multiple data-actions-box="true"  data-selected-text-format="count > 5"
                                required>
                            {{$project}}
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="" style="margin-left: -5px !important;margin-right: -5px !important;">
            <div class="col-md-4">
                <div class="form-group">
                    <div class="col-md-4">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Ky_bao_cao")}}</label>
                    </div>
                    <div class="col-md-8">
                        <select id="slReportPeriod" name="slReportPeriod" class="form-control" required>
                            {{$period}}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="col-md-4">
                        <label class="lbl-normal liketext">{{Helpers::getRS($g,"Don_vi_tinh")}}</label>
                    </div>
                    <div class="col-md-8">
                        <select id="slMoneyUnitID" name="slMoneyUnitID" class="form-control" required>
                            @foreach($unit as $row)
                                <option value="{{$row["Value"]}}" data-widthColumn="{{$row['DateColumnWidth']}}">{{$row["Caption"]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="col-md-5 pdr0">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="chkIsShowDetail"> {{Helpers::getRS($g,"Hien_thi_chi_tiet")}}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <button type="button" id="btnAttW47F3010" title="{{Helpers::getRS($g,"Xem_dinh_kem")}}" class="btn btn-default smallbtn pull-right mgl10" disabled><span class="fa fa-paperclip"></span>
                            &nbsp;</button>
                        <button type="button" id="btnExcelW47F3010" title="{{Helpers::getRS($g,"Xuat_Excel_U")}}" class="btn btn-default smallbtn pull-right mgl10" disabled><span class="fa fa-file-excel-o"></span>
                            &nbsp;</button>
                        <button type="submit" title="{{Helpers::getRS($g,"Loc")}}" class="btn btn-default smallbtn pull-right"><span class="digi digi-filter"></span>
                            &nbsp;</button>
                    </div>
                </div>


            </div>
        </div>
        <div class="" style="margin-left: -5px !important;margin-right: -5px !important;">
            <div class="col-md-12">
                <div class="btn-group pull-right btnGReportYear hide" style="z-index: 50">
                    <button type="button" class="btn btn-default smallbtn btnPreReportYear" disabled>
                        <span class="fa fa-angle-left"></span>
                        <span class="sr-only"></span>
                    </button>
                    <button type="button" class="btn btn-default smallbtn btnReportYear" disabled>&nbsp;</button>
                    <button type="button" class="btn btn-default smallbtn btnNextReportYear" disabled>
                        <span class="fa fa-angle-right"></span>
                        <span class="sr-only"></span>
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom tabW47F3010 hide" style="margin-top: -30px">
                <ul class="nav nav-tabs">
                    <li class="active"><a class="tab-main-3010" href="#divDetailW47F3010" data-toggle="tab" aria-expanded="true">{{Helpers::getRS($g,"Hop_nhat")}}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="divDetailW47F3010">
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
</section>








{{--<div class="modal fade pd0" id="secW47F3010" data-backdrop="static" role="dialog" style="position: absolute !important;">
    <div class="modal-dialog  modal-lg formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($modalTitle,"W47F3010", true,"",true,$pForm,"W47F3010")}}
            </div>
            <div class="modal-body">

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>--}}

<script type="text/javascript">
    var heightW47F3010, arrayMasterW47F3010 = null, yearW47F3010 = 2017;
    var subdivList = {{json_encode($subdiv)}}
    $(document).ready(function () {
        heightW47F3010 = $("#divD47F4020_W47F3010_W47F3010").height() - $("#frmW47F3010").height() + 85;
        $("#secW47F3010").find(".selectpicker").selectpicker({
            multipleSeparator: ";",
            dropdownAlignRight: true
        });
    });

    $('#secW47F3010').find('#slDivisionID').on('changed.bs.select', function (e) {
            //alert('dfds');
            var div = $(this).val();
            if (div != null) {//truong hop select %
                if (div[0] == '%'){
                    $('#secW47F3010').find('#slDivisionID').selectpicker('deselectAll');
                    $('#secW47F3010').find('#slDivisionID').selectpicker('val', '%');
                    $('#secW47F3010').find('#slDivisionID').find('[value!="%"]').prop('disabled', 'disabled');
                    $('#secW47F3010').find('#slDivisionID').selectpicker('refresh');
                }else{
                    $('#secW47F3010').find('#slDivisionID').find('[value="%"]').prop('disabled', 'disabled');
                    $('#secW47F3010').find('#slDivisionID').selectpicker('refresh');
                }
            } else { //truong hop bang null
                //$('#secW47F3010').find('#slDivisionID').find('[value="%"]').prop('selected', false);
                $('#secW47F3010').find('#slDivisionID').find('[value!="%"]').prop('disabled', '');
                $('#secW47F3010').find('#slDivisionID').find('[value="%"]').prop('disabled', '');
                $('#secW47F3010').find('#slDivisionID').selectpicker('refresh');
            }
            var div = $(this).val();
            if (div != null){
                div = div.join(";");
                console.log(div);
            }
            $.ajax({
                method: "GET",
                url: "{{url('W47F3010/loadProject')}}",
                data:{div: div},
                success: function (data) {
                    $('#secW47F3010').find('#slProjectID').html(data).selectpicker('refresh');
                    $('#secW47F3010').find('#slProjectID').trigger('change');
                }
            });
    });

    $('#secW47F3010').find('#slSubDivision').on('changed.bs.select', function (e) {
        //alert('dfds');
        var subdiv = $(this).val();
        if (subdiv != null) {//truong hop select %
            if (subdiv[0] == '%'){
                $('#secW47F3010').find('#slSubDivision').selectpicker('deselectAll');
                $('#secW47F3010').find('#slSubDivision').selectpicker('val', '%');
                $('#secW47F3010').find('#slSubDivision').find('[value!="%"]').prop('disabled', 'disabled');
                $('#secW47F3010').find('#slSubDivision').selectpicker('refresh');
            }else{
                $('#secW47F3010').find('#slSubDivision').find('[value="%"]').prop('disabled', 'disabled');
                $('#secW47F3010').find('#slSubDivision').selectpicker('refresh');
            }
        } else { //truong hop bang null
            $('#secW47F3010').find('#slSubDivision').find('[value!="%"]').prop('disabled', '');
            $('#secW47F3010').find('#slSubDivision').find('[value="%"]').prop('disabled', '');
            $('#secW47F3010').find('#slSubDivision').selectpicker('refresh');
        }
        var subdiv = $(this).val();
        if (subdiv != null){
            if (subdiv[0] == '%'){
                $('#secW47F3010').find('#slDivisionID').selectpicker('deselectAll');
                $('#secW47F3010').find('#slDivisionID').selectpicker('val', '%');
                $('#secW47F3010').find('#slDivisionID').find('[value!="%"]').prop('disabled', 'disabled');
                $('#secW47F3010').find('#slDivisionID').selectpicker('refresh');
                reloadProject("%");
            }else{
                div = subdiv.join(";");
                var divList = "";
                for (var i=0;i<subdivList.length;i++){
                    for (var j=0;j<subdiv.length;j++){
                        if (subdiv[j] == subdivList[i]["Value"]){
                            if (divList == "")
                                divList = subdivList[i]["DivisionID"];
                            else
                                divList += ";"+subdivList[i]["DivisionID"];


                        }
                    }
                }
                var arrDiv = divList.split(";");
                if (divList.length >0 != ""){
                    $('#secW47F3010').find('#slDivisionID').selectpicker('val', arrDiv);
                    $('#secW47F3010').find('#slDivisionID').find('[value="%"]').prop('disabled', 'disabled');
                    $('#secW47F3010').find('#slDivisionID').selectpicker('refresh');
                    reloadProject($('#secW47F3010').find('#slDivisionID').selectpicker('val').join(";"));
                }else{
                    $('#secW47F3010').find('#slDivisionID').selectpicker('deselectAll');
                    $('#secW47F3010').find('#slDivisionID').selectpicker('val', '%');
                    $('#secW47F3010').find('#slDivisionID').find('[value!="%"]').prop('disabled', 'disabled');
                    $('#secW47F3010').find('#slDivisionID').selectpicker('refresh');
                    reloadProject("%");
                }
            }

        }else { //truong hop bang null
            $('#secW47F3010').find('#slDivisionID').selectpicker('val', '');
            $('#secW47F3010').find('#slDivisionID').find('[value!="%"]').prop('disabled', '');
            $('#secW47F3010').find('#slDivisionID').find('[value="%"]').prop('disabled', '');
            $('#secW47F3010').find('#slDivisionID').selectpicker('refresh');
            reloadProject("");
        }
    });

    function reloadProject(div){
        $.ajax({
            method: "GET",
            url: "{{url('W47F3010/loadProject')}}",
            data:{div: div},
            success: function (data) {
                $('#secW47F3010').find('#slProjectID').html(data).selectpicker('refresh');
                $('#secW47F3010').find('#slProjectID').trigger('change');
            }
        });
    }

    $(".tabW47F3010 .nav-tabs").on("click", "button", function (e) {
        var anchor = $(this).siblings('a');
        $(anchor.attr('href')).getNiceScroll().remove();
        $(anchor.attr('href')).off();
        $(anchor.attr('href')).children().off();
        $(anchor.attr('href')).remove();
        $(this).parent().remove();
        $(".nav-tabs li").children('a').first().click();
    });

    $('#secW47F3010').on('change', '#slReportPeriod', function (e) {
        var year = parseInt($(this).val().substr(0, 4));
        $('#secW47F3010 .btnReportYear').html(year);
    });
    //Hiển thị năm trước đó
    $('#secW47F3010').on('click', '.btnPreReportYear', function (e) {
        var year = parseInt($('#secW47F3010 .btnReportYear').text());
        $('#secW47F3010 .btnReportYear').html(year - 1);
        if (year == yearW47F3010)
            $("#secW47F3010").find(".btnPreReportYear").prop("disabled", "disabled");
        $("#secW47F3010").find(".btnNextReportYear").prop("disabled", "");
        hideColYear(year, -1);
    });

    $('#secW47F3010').on('click', '.btnNextReportYear', function (e) {
        var year = parseInt($('#secW47F3010 .btnReportYear').text());
        $('#secW47F3010 .btnReportYear').html(year + 1);
        if (year == yearW47F3010)
            $("#secW47F3010").find(".btnNextReportYear").prop("disabled", "disabled");
        $("#secW47F3010").find(".btnPreReportYear").prop("disabled", "");
        hideColYear(year, 1);
    });

    var hideColYear = function (year, oper) {
        var anchor = $('.tabW47F3010').find('a.atab-close, a.tab-main-3010');
        for (var i = 0; i < anchor.length; i++) {
            var div = $(anchor[i]).attr('href');
            setTimeout(hideColW47F3010, 1, div, year, oper);
        }
    };

    //Hiển thị các cột của kỳ hiện tại hoặc năm báo cáo đang xét
    var hideColW47F3010 = function (div, year, oper) {
        if (year != yearW47F3010)
            $(div).find('th[data-year="' + year + '"], td[data-year="' + year + '"]').addClass('hide');
        $(div).find('th[data-year="' + (year + oper) + '"], td[data-year="' + (year + oper) + '"]').removeClass('hide');
//        $("#scrollW47F3010").getNiceScroll().resize();
        $(".maintable3010").getNiceScroll().onResize();
    };

    $("#frmW47F3010").on('submit', function (e) {
        e.preventDefault();
        console.log($('#secW47F3010').find('#slSubDivision').selectpicker('val'));


        $("#secW47F3010 .cube-loading").removeClass("hide");
        var textunit = $("#frmW47F3010").find("#slMoneyUnitID option:selected").text();
        var project = $("#frmW47F3010").find("#slProjectID").val();
        var widthcol = $("#frmW47F3010").find("#slMoneyUnitID option:selected").attr('data-widthColumn');
        arrayMasterW47F3010 = null;
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: $("#frmW47F3010").serialize() + '&textunit=' + textunit + '&widthcol=' + widthcol + '&project=' + project + "&div="+$('#secW47F3010').find('#slDivisionID').selectpicker('val').join(";") + "&subdiv="+$('#secW47F3010').find('#slSubDivision').selectpicker('val').join(";"),
            success: function (data) {
                $(".maintable3010").getNiceScroll().remove();
                //Xóa all tab
                var anchor = $('.tabW47F3010').find('a.atab-close');
                for (var i = 0; i < anchor.length; i++) {
                    var div = $(anchor[i]).attr('href');
                    $(div).off();
                    $(div).children().off();
                    $(div).remove();
                    $(anchor[i]).parent().remove();
                }
                $(document).find("#modalW91F4010").remove();
                $(".nav-tabs li").children('a').first().click();
                //Get data
                $("#divDetailW47F3010").html(data);
                $("#secW47F3010").find(".cube-loading").addClass("hide");
                $("#secW47F3010").find("#btnExcelW47F3010").prop("disabled", "");
                $("#secW47F3010").find("#btnAttW47F3010").prop("disabled", "");
                $("#secW47F3010").find(".btnPreReportYear").prop("disabled", "");
                $("#secW47F3010").find(".btnNextReportYear").prop("disabled", "");
                $("#secW47F3010").find(".btnGReportYear").removeClass("hide");
                $("#secW47F3010").find(".tabW47F3010").removeClass("hide");
                $("#modalW91F4010").appendTo("body");
            }
        });
    });

    //Thêm tab mới theo itemcode
    var addTabW47F3010 = function (itemcode, parameter , name, a) {
        var tb = $('.tabW47F3010').find('#tabChild_' + itemcode);
        if (tb.length == 0) {//tab not exist
            $("#secW47F3010 .cube-loading").removeClass("hide");
            $('.tabW47F3010').find('.nav-tabs').append('<li class="tab-close"><a class="tab-main-3010 atab-close tabChild' + itemcode + '" href="#tabChild_' + itemcode + '" data-toggle="tab" aria-expanded="true">' + name + '</a> <button class="close" type="button">×</button></li>');
            $('.tabW47F3010').find('.tab-content').append('<div class="tab-pane" id="tabChild_' + itemcode + '"></div>');
            var year = parseInt($('#secW47F3010 .btnReportYear').text());
            $('.tabW47F3010').find('a.tabChild' + itemcode).click();
            $.ajax({
                method: "POST",
                url: "{{Request::url()}}",
                data: {itemcode: itemcode, parameter: parameter, array: arrayMasterW47F3010, year: year},
                success: function (data) {
                    $("#tabChild_" + itemcode).html(data);
                    $("#secW47F3010 .cube-loading").addClass("hide");
                    $(".maintable3010").getNiceScroll().onResize();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $("#secW47F3010 .cube-loading").addClass("hide");
                    console.log(jqXHR);
                }
            });
        } else {
            $('.tabW47F3010').find('a.tabChild' + itemcode).click();
            $(".maintable3010").getNiceScroll().onResize();
        }
    };

    $("#btnAttW47F3010").on("click", function () {
        $('#modalW91F4010').modal('show');
    });

    $("#btnExcelW47F3010").on("click", function () {
        fnExcelReportW47F3010();
    });

    var fnExcelReportW47F3010 = (function () {

/*        var today = new Date();
        var datea = today.getFullYear() + '' + (today.getMonth() + 1) + '' + today.getDate() + '' + today.getHours() + '' + today.getMinutes() + '' + today.getSeconds();
        var fileName = "Bao_cao_dong_tien_thang_" + datea;


        $(".tabW47F3010 .tab-content").find('div.tab-pane.active #tableW47F3010Main').tableExport({
            type:'excel',
            fileName: fileName
        });*/
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

        var rows = $(".tabW47F3010 .tab-content").find('div.tab-pane.active #tableW47F3010Main tr');
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
        downloadLink.download = "Bao_cao_dong_tien_thang_" + datea + ".xls";
        downloadLink.innerHTML = "Download W47F3010";
        downloadLink.href = uri + base64(format(template, ctx));
        downloadLink.onclick = destroyClickedElement;
        downloadLink.style.display = "none";
        document.body.appendChild(downloadLink);
        downloadLink.click();
    });

    //Remove all nicescroll
    $('#secW47F3010').on('hide.bs.modal', function () {
        $("#scrollW47F3010").getNiceScroll().remove();
        $("#modalW91F4010").remove();
    });

    //Fix lỗi các nicescroll chồng lên nhau
    $('#secW47F3010').on('shown.bs.tab', '.tab-main-3010', function (e) {
        $(".maintable3010").getNiceScroll().onResize();
    });
</script>
<style>
    .nicescroll-cursors{
        z-index: 99999 !important;
    }
</style>

