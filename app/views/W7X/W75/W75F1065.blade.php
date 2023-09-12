<style>
    .cls_success {
        padding-top: 20%;
    }

    .modalW75F1065 .modal-open .modal {
        overflow-y: hidden;
    }
</style>
<div class="modal fade modal noneOverflow" id="modalW75F1065" data-keyboard="false" data-backdrop="static"
     role="dialog">
    <div class="modal-dialog formduyet">
        <div id="mdW25F3020" class="modal-content">
            <!-- form start -->
            <form class="form-horizontal" id="frmW75F1065" method="post" action="">
                <div class="modal-header">
                    {{Helpers::generateHeading($modalTitle,"W75F1065",true,"closePopW75F1065")}}
                </div>
                <div id="divScrollbarW75F1065">
                    <div class="modal-body" style="padding:10px">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                <div class="row form-group">
                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                        <fieldset>
                                            <legend class="legend"
                                                    style="margin-bottom:10px">{{Helpers::getRS($g,"Thong_tin_dang_ky")}}</legend>
                                            <!-- row 2 -->
                                            <div class="row form-group">
                                                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                                    <div class="liketext">
                                                        <label class="lbl-normal">{{Helpers::getRS($g,"Loai_phep")}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                                    <select class="form-control select2 " id="cboLeaveTypeID"
                                                            name="cboLeaveTypeID" required>
                                                        @foreach($data as $row )
                                                            <option name='LeaveTypeID'
                                                                    LeaveID="{{$row['LeaveID']}}"
                                                                    value="{{$row['LeaveTypeID']}}">{{$row['LeaveTypeName']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                                    <button type="button" id="btnInfoW75F1065" name="btnInfoW75F1065"
                                                            class="btn btn-default smallbtn" disabled><span
                                                                class="fa fa-info mgr5 text-blue"></span> {{Helpers::getRS($g,"Thong_tin_cong_tac")}}
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- row 3 -->
                                            <div class="row form-group">
                                                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                                    <div class="liketext">
                                                        <label class="lbl-normal">{{Helpers::getRS($g,"Nghi_tu")}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                                    <div id="DateFromIcon" class="input-group date">
                                                        <input autocomplete='off' type="text" class="form-control"
                                                               id="txtLeaveDateFromW75F1065"
                                                               name="txtLeaveDateFromW75F1065" value="" required
                                                        ><span
                                                                class="input-group-addon"><i onclick="$('#txtLeaveDateFromW75F1065').datepicker('show')"
                                                                    class="glyphicon glyphicon-calendar"></i></span>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                                @if ($decimals == 1) <!-- Customize cho TSCO -->
                                                    <input autocomplete='off' class="form-control numbersOnly noUseValidHTML5"
                                                           type="number"
                                                           max="90" step="0.5" id="txt1stAbsDayQuan"
                                                           name="txt1stAbsDayQuan" value="" placeholder="{{Helpers::getRS($g,"So_luong")}}" required
                                                           style="text-align: right">
                                                    @else
                                                        <input autocomplete='off' class="form-control numbersOnly noUseValidHTML5"
                                                               type="text"
                                                               id="txt1stAbsDayQuan"
                                                               name="txt1stAbsDayQuan" value="" placeholder="{{Helpers::getRS($g,"So_luong")}}" required
                                                               style="text-align: right">
                                                    @endif
                                                </div>

                                                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">

                                                </div>
                                            </div>
                                            <!-- row 3 -->
                                            <div class="row form-group">
                                                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                                    <div class="liketext">
                                                        <label class="lbl-normal">{{Helpers::getRS($g,"Nghi_den")}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                                    <div id="DateToIcon" class="input-group date">
                                                        <input autocomplete='off' type="text" class="form-control" id="txtLeaveDateTo"
                                                               name="txtLeaveDateTo" value="" required
                                                        ><span
                                                                class="input-group-addon"><i onclick="$('#txtLeaveDateTo').datepicker('show')"
                                                                    class="glyphicon glyphicon-calendar"></i></span>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                                    @if ($decimals == 1)
                                                        <input autocomplete='off' class="form-control numbersOnly noUseValidHTML5"
                                                               type="number"
                                                               max="90" step="0.5" id="txtLastAbsDayQuan"
                                                               name="txtLastAbsDayQuan" value="" placeholder="{{Helpers::getRS($g,"So_luong")}}" required
                                                               style="text-align: right">
                                                    @else
                                                        <input autocomplete='off' class="form-control numbersOnly noUseValidHTML5"
                                                               type="text"
                                                               id="txtLastAbsDayQuan"
                                                               name="txtLastAbsDayQuan" value="" placeholder="{{Helpers::getRS($g,"So_luong")}}" required
                                                               style="text-align: right">
                                                    @endif
                                                </div>

                                                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">

                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                                    <div class="liketext">
                                                        <label class="lbl-normal">{{Helpers::getRS($g,"Tong_SL")}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                                    @if ($decimals == 1)
                                                        <input autocomplete='off' class="form-control" type="text" id="txtQuantity"
                                                               name="txtQuantity" value="" placeholder="" required
                                                               style="text-align: right" readonly>
                                                    @else
                                                        <input autocomplete='off' class="form-control" type="text" id="txtQuantity"
                                                               name="txtQuantity" value="" placeholder="" required
                                                               style="text-align: right" readonly>
                                                    @endif
                                                </div>

                                            </div>
                                            <!-- row 6 -->
                                            <div class="row form-group">
                                                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                                    <div class="liketext">
                                                        <label class="lbl-normal">{{Helpers::getRS($g,"Ly_do")}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                                                    <input autocomplete='off' class="form-control" id="txtReason" name="txtReason"
                                                           type="text"
                                                           placeholder="">
                                                </div>
                                            </div>
                                            <!-- row 7 -->
                                            <div class="row form-group">
                                                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                                    <div class="liketext">
                                                        <label class="lbl-normal">{{Helpers::getRS($g,"Ghi_chu")}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                                                    <!--<input autocomplete='off' class="form-control" id="txtNote" name="txtNote" type="text"
                                                           placeholder=""> -->
                                                    <textarea id="txtNote" name="txtNote" rows="3"
                                                              style="width:100%"></textarea>
                                                </div>
                                            </div>
                                            <!-- row 8 -->
                                            <div class="row">
                                                <div class="col-md-3 col-xs-3">
                                                </div>
                                                <div class="col-md-9 col-xs-9">
                                                    <div class="row form-group">
                                                        <div class="col-md-3 col-xs-3">
                                                            <!-- <button type="button" id="frm_btnAdd" class="btn btn-default pull-left mgr10 " onclick="set_action('add')"><span class="glyphicon glyphicon glyphicon-plus mgr5"></span> Thêm</button> -->
                                                        </div>
                                                        <div class="col-md-9 col-xs-9" style="padding-right:5px">
                                                            <button type="button" id="btnNotSaveW75F1065"
                                                                    class="btn btn-default smallbtn pull-right mgr10 confirmation-notsave"
                                                                    onclick="not_saveW75F1065()"><span
                                                                        class="glyphicon glyphicon-floppy-remove text-red mgr5"></span>{{Helpers::getRS($g,"Khong_luu")}}
                                                            </button>
                                                            <button type="button" id="btnSave"
                                                                    class="btn btn-default smallbtn pull-right mgr10 confirmation-save"
                                                                    onclick="save()"><span
                                                                        class="glyphicon glyphicon-floppy-saved text-blue mgr5"></span>{{Helpers::getRS($g,"Luu")}}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- row 7 footer -->
                                            <div class="row form-group">
                                                <div class="col-md-3 col-xs-3">
                                                </div>
                                                <div class="col-md-9 col-xs-9">
                                                    <div id="success"
                                                         class="alert alert-success alert-dismissable hide">
                                                        <i class="icon fa fa-check"></i> {{Helpers::getRS($g,"Du_lieu_da_luu_thanh_cong")}}
                                                        !.
                                                    </div>
                                                    <div id="alert" class="alert alert-danger alert-dismissable hide">
                                                        <i class="icon fa fa-ban"></i> <span id="err"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                        <fieldset>
                                            <legend class="legend"
                                                    style="margin-bottom:20px">{{Helpers::getRS($g,"Chi_tiet_phep_dang_ky")}}</legend>
                                            @include('W7X.W75.W75F1065_Statistics')
                                        </fieldset>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tabW75F1065_1"
                                                              data-toggle="tab">{{Helpers::getRS($g,"Du_lieu_dang_ky_nghi_phep")}}</a>
                                        </li>
                                        <li><a href="#tabW75F1065_2" data-toggle="tab"
                                               onclick="loadGeneral();">{{Helpers::getRS($g,"Du_lieu_phep_tong_hop")}}</a>
                                        </li>
                                        <li><a href="#tabW75F1065_3" data-toggle="tab"
                                               onclick="loadData();">{{Helpers::getRS($g,"Du_lieu_cham_phep")}}</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tabW75F1065_1">
                                            <div id="tbHistory" class="mgb10"></div>
                                        </div>
                                        <div class="tab-pane active" id="tabW75F1065_2">
                                            <div id="tbGeneral" class="mgb10"></div>
                                        </div>
                                        <div class="tab-pane active" id="tabW75F1065_3">
                                            <div id="tbData" class="mgb10"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <button type="submit" id="frm_hbtnSave" class="hidden"></button>
                        <input type="hidden" id="hdAction" name="hdAction" value=""/>
                        <input type="hidden" id="hdTransID" name="hdTransID" value=""/>
                        <input type="hidden" id="hdpForm" name="hdpForm" value="{{$pForm}}">
                    </div>
                </div>
            </form>
            <!-- /.end form  -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div id="emailPOP"></div>

<script type="text/javascript">
    var actionW75F1065 = "add";
    var TransIDW75F1065 = "";

    $(document).ready(function () {
        $('#txtLeaveDateFromW75F1065').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
            //	defaultViewDate: {day: 01, month: 01,year: 2015, format : "DD-MM-YYYY"}
        }).on('changeDate', function(e) {
            // `e` here contains the extra attributes
            console.log('txtLeaveDateFromW75F1065');
            var txt1stAbsDayQuan = $("#frmW75F1065").find("#txt1stAbsDayQuan");
            var leave_date_from = $("#frmW75F1065").find("#txtLeaveDateFromW75F1065").val();
            var leave_date_to = $("#frmW75F1065").find("#txtLeaveDateTo").val();
            txt1stAbsDayQuan.val((1).toFixed({{$decimals}}));//chuyển qua format số lượng số thập phân hệ thống quy định
            checkQuanW75F1065('txtLeaveDateFromW75F1065', leave_date_from, leave_date_to);
            check('txtLeaveDateFromW75F1065');
        }).on('clearDate', function(e) {
            // `e` here contains the extra attributes
        });

        $('#txtLeaveDateTo').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        }).on('changeDate', function(e) {
            // `e` here contains the extra attributes
            console.log('txtLeaveDateTo');
            var leave_date_from = $("#frmW75F1065").find("#txtLeaveDateFromW75F1065").val();
            var leave_date_to = $("#frmW75F1065").find("#txtLeaveDateTo").val();
            checkQuanW75F1065('txtLeaveDateTo', leave_date_from, leave_date_to);
            check('txtLeaveDateTo');
        }).on('clearDate', function(e) {
            // `e` here contains the extra attributes
        });



        //$("#divScrollbarW75F1065").height($(document).height() - 510);
        $("#divScrollbarW75F1065").height($(document).height() - 80);
        $("#divScrollbarW75F1065").css("overflow-y", "auto");
        $("#divScrollbarW75F1065").css("overflow-x", "hidden");
//        $("#divScrollbarW75F1065").mCustomScrollbar({
//            axis: "y",
//            theme: "3d",
//            scrollButtons: {enable: true},
//            autoExpandScrollbar: true,
//            advanced: {autoExpandHorizontalScroll: true},
//            scrollInertia: 100,
//            //scrollbarPosition:"outside"
//        });




        @if ($decimals == 2)
        console.log("{{$decimals}}");
        $('#txt1stAbsDayQuan').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: {{$decimals}},
            min: 0,
            max: 90,
            autoGroup: true,
            rightAlign: false
        });
        $('#txtLastAbsDayQuan').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: {{$decimals}},
            min: 0,
            max: 90,
            autoGroup: true,
            rightAlign: false
        });
        @endif
    });

    function updateActionW75F1065(mode, linkTransID, TransID) {//update biến action từ view_ajax -> view blade
        actionW75F1065 = mode;
        TransIDW75F1065 = linkTransID;
        var cboLeaveTypeID = $("#frmW75F1065").find("#cboLeaveTypeID");
        if (cboLeaveTypeID.find(":selected").attr("leaveID") == "L090") {//chọn công tác mới mở nút info
            $("#btnInfoW75F1065").prop("disabled", false);
        } else {
            $("#btnInfoW75F1065").prop("disabled", true);
        }
    }

    $(function () {
        $('.toggle').click(function (event) {
            event.preventDefault();
            var target = $(this).attr('href');
            $(target).toggleClass('hidden show');
        });

    });

    //hàm update transID từ màn hình W75F1066
    function updateTransIDfromW75F1066(transID) {
        console.log(transID);
        TransIDW75F1065 = transID;
        //alert(TransIDW75F1065);
    }

    function load_tableW75F1065() {
        //alert('test');
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: 'POST',
            url: '{{url("/W75F1065/view/$pForm/$g/0")}}',
            data: {transID: $("#hdTransID").val()},
            success: function (data) {
                $("#tbHistory").html(data);
                $(".l3loading").addClass('hide');
                setTimeout(function () {
                    $("#gridW75F1065History").pqGrid("option", "width", $("#tbHistory").width());
                    $("#gridW75F1065History").pqGrid("refresh");
                    //alert('test');
                }, 1000);
            }
        });
        //Load table xong moi clear duoc nha
        clear_data();

    }

    function load_tableW75F1065_fromW75F1066() {
        //alert('test');
        $.ajax({
            method: 'POST',
            url: '{{url("/W75F1065/view/$pForm/$g/0")}}',
            data: {transID: $("#hdTransID").val()},
            success: function (data) {
                $("#tbHistory").html(data);
                setTimeout(function () {
                    $("#gridW75F1065History").pqGrid("option", "width", $("#tbHistory").width());
                    $("#gridW75F1065History").pqGrid("refresh");
                    //alert('test');
                }, 1000);
            }
        });
    }

    function loadGeneral() {

        if ($("#tbGeneral").html() == "") {
            $(".l3loading").removeClass('hide');
            $.ajax({
                method: 'POST',
                url: '{{url("/W75F1065/view/$pForm/$g/1")}}',
                success: function (data) {
                    $("#tbGeneral").html(data);
                    $(".l3loading").addClass('hide');
                }
            });
        }

    }

    function loadData() {

        if ($("#tbData").html() == "") {
            $(".l3loading").removeClass('hide');
            $.ajax({
                method: 'POST',
                url: '{{url("/W75F1065/view/$pForm/$g/7")}}',
                success: function (data) {
                    $("#tbData").html(data);
                    $(".l3loading").addClass('hide');
                }
            });
        }

    }

    function set_default(mod) {

    }

    $("#cboLeaveTypeID").change(function () {
        var cboLeaveTypeID = $("#frmW75F1065").find("#cboLeaveTypeID");
        //console.log(cboLeaveTypeID.find(":selected").attr("leaveID"));
        if (cboLeaveTypeID.find(":selected").attr("leaveID") == "L090") {//chọn công tác mới mở nút info
            $("#btnInfoW75F1065").prop("disabled", false);
        } else {
            $("#btnInfoW75F1065").prop("disabled", true);
        }
    });

    $("#btnInfoW75F1065").click(function () {
        if (actionW75F1065 == "add") {
            TransIDW75F1065 = "";
        }
        showFormDialogPost('{{url("/W75F1066/$pForm/$g/")}}', "modalW75F1066",
            {
                action: actionW75F1065,
                LinkTransIDW75F1065: TransIDW75F1065,
            }, 2);
    });

    $("#txt1stAbsDayQuan").change(function () {
        console.log('txt1stAbsDayQuan');
        var leave_date_from = $("#frmW75F1065").find("#txtLeaveDateFromW75F1065").val();
        var txt1stAbsDayQuan = $("#frmW75F1065").find("#txt1stAbsDayQuan");
        $("#frmW75F1065").find("#txt1stAbsDayQuan").val(parseFloat(txt1stAbsDayQuan.val()).toFixed({{$decimals}}));
        var leave_date_to = $("#frmW75F1065").find("#txtLeaveDateTo").val();
        checkQuanW75F1065('txtLeaveDateFromW75F1065', leave_date_from, leave_date_to);
        validQuantity('txtLeaveDateFromW75F1065', txt1stAbsDayQuan.val());


    });

    $("#txtLastAbsDayQuan").change(function () {
        console.log('txtLastAbsDayQuan');
        var txtLastAbsDayQuan = $("#frmW75F1065").find("#txtLastAbsDayQuan");
        $("#frmW75F1065").find("#txtLastAbsDayQuan").val(parseFloat(txtLastAbsDayQuan.val()).toFixed({{$decimals}}));
        validQuantity('txtLeaveDateTo', txtLastAbsDayQuan.val());
    });


    function save() {
        var cboLeaveTypeID = $("#frmW75F1065").find("#cboLeaveTypeID");
        var leave_date_from = $("#frmW75F1065").find("#txtLeaveDateFromW75F1065");
        var leave_date_to = $("#frmW75F1065").find("#txtLeaveDateTo");
        var quantity = $("#frmW75F1065").find("#txtQuantity");

        if (cboLeaveTypeID.val() != null || leave_date_from.val() != "" || leave_date_to.val() != "" || quantity.val() != "") {
            ask_save(set_action, "save", "", set_action, "clear");
        }
    }

    function not_saveW75F1065() {
        ask_not_save(set_action, 'notsave');
    }

    function validQuantity(mode, quantity) {//giới hạn nhập số lượng 0 < quantity < 1;
        var txt1stAbsDayQuan = $("#frmW75F1065").find("#txt1stAbsDayQuan");
        var txtLastAbsDayQuan = $("#frmW75F1065").find("#txtLastAbsDayQuan");
        console.log(mode, quantity);
        if (quantity <= 0 || quantity > 1) {
            if (mode == "txtLeaveDateFromW75F1065") {
                alert_warning("{{Helpers::getRS($g,"Gia_tri_phai_phai_lon_hon_0_va_nho_hon_hoac_bang_1")}}", function () {
                    txt1stAbsDayQuan.val("");
                    txt1stAbsDayQuan.focus();
                });
                return;
            }
            if (mode == "txtLeaveDateTo") {
                alert_warning("{{Helpers::getRS($g,"Gia_tri_phai_phai_lon_hon_0_va_nho_hon_hoac_bang_1")}}", function () {
                    txtLastAbsDayQuan.val("");
                    txtLastAbsDayQuan.focus();
                });
                return;
            }
        }
        check(mode);
    }

    function check(mode) {
        var cboLeaveTypeID = $("#frmW75F1065").find("#cboLeaveTypeID");
        var leave_date_from = $("#frmW75F1065").find("#txtLeaveDateFromW75F1065");
        var leave_date_to = $("#frmW75F1065").find("#txtLeaveDateTo");
        var txt1stAbsDayQuan = $("#frmW75F1065").find("#txt1stAbsDayQuan");
        var txtLastAbsDayQuan = $("#frmW75F1065").find("#txtLastAbsDayQuan");
        //console.log(leave_date_from.val(), leave_date_to.val());
        if (leave_date_from.val() != "" && leave_date_to.val() != "") {
            $.ajax({
                method: 'POST',
                url: '{{url("/W75F1065/view/$pForm/$g/5")}}',
                data: {
                    leavetypeid: cboLeaveTypeID.val(),
                    leavedatefrom: leave_date_from.val(),
                    leavedateto: leave_date_to.val(),
                    txt1stAbsDayQuan: txt1stAbsDayQuan.val(),
                    txtLastAbsDayQuan: txtLastAbsDayQuan.val()
                },
                success: function (res) {
                    //$(".l3loading").addClass('hide');
                    var data = JSON.parse(res);
                    console.log("test");
                    switch (Number(data.Status)){
                        case 1:
                            if (mode == "txtLeaveDateFromW75F1065") {
                                alert_warning(data.Message, function () {
                                    txt1stAbsDayQuan.val("");
                                    txt1stAbsDayQuan.focus();
                                });
                                return;
                            }
                            if (mode == "txtLeaveDateTo") {
                                alert_warning(data.Message, function () {
                                    txtLastAbsDayQuan.val("");
                                    txtLastAbsDayQuan.focus();
                                });
                                return;
                            }
                            break;
                        case 0:
                            $("#txtQuantity").val(format2( data.Quantity, '',{{$decimals}}));
                            postMethod('{{url("/W75F1065/view/$pForm/$g/8")}}', function (res) {
                                var res = JSON.parse(res);
                                switch (res.status) {
                                    case 'OKAY':
                                        var dataSource = reformatData(res.data, $("#gridStatistics"));
                                        $("#gridStatistics").pqGrid("option", "dataModel.data", dataSource);
                                        $("#gridStatistics").pqGrid("refresh");

                                        var summaryData = [{
                                            DetailQty: format2(sumArray(dataSource, 'DetailQty'), '',{{$decimals}})
                                        }];
                                        setTimeout(function () {
                                            $("#gridStatistics").pqGrid({
                                                summaryData: summaryData
                                            });
                                            $("#gridStatistics").pqGrid("refreshDataAndView");
                                        }, 500);
                                        break;
                                    case 'ERROR':
                                        alert_error(data.message);
                                        break;
                                }

                            }, $("#frmW75F1065").serialize() + "&txtQuantity=" + $("#txtQuantity").val() + "&cboLeaveTypeID=" + $("#cboLeaveTypeID").val());
                            break;

                    }

                    {{--if (data != '') {--}}
                        {{--if (isNaN(data)) {--}}
                            {{--if (mode == "txtLeaveDateFromW75F1065") {--}}
                                {{--alert_warning(data, function () {--}}
                                    {{--txt1stAbsDayQuan.val("");--}}
                                    {{--txt1stAbsDayQuan.focus();--}}
                                {{--});--}}
                                {{--return;--}}
                            {{--}--}}
                            {{--if (mode == "txtLeaveDateTo") {--}}
                                {{--alert_warning(data, function () {--}}
                                    {{--txtLastAbsDayQuan.val("");--}}
                                    {{--txtLastAbsDayQuan.focus();--}}
                                {{--});--}}
                                {{--return;--}}
                            {{--}--}}
                        {{--}--}}
                        {{--else {--}}
                            {{--$("#txtQuantity").val(data);--}}
                            {{--postMethod('{{url("/W75F1065/view/$pForm/$g/8")}}', function (res) {--}}
                                {{--var res = JSON.parse(res);--}}
                                {{--console.log("testabc");--}}
                                {{--switch (res.status) {--}}
                                    {{--case 'OKAY':--}}
                                        {{--var dataSource = reformatData(res.data, $("#gridStatistics"));--}}
                                        {{--$("#gridStatistics").pqGrid("option", "dataModel.data", dataSource);--}}
                                        {{--$("#gridStatistics").pqGrid("refresh");--}}

                                        {{--var summaryData = [{--}}
                                            {{--DetailQty: format2(sumArray(dataSource, 'DetailQty'), '',{{$decimals}})--}}
                                        {{--}];--}}
                                        {{--setTimeout(function () {--}}
                                            {{--$("#gridStatistics").pqGrid({--}}
                                                {{--summaryData: summaryData--}}
                                            {{--});--}}
                                            {{--$("#gridStatistics").pqGrid("refreshDataAndView");--}}
                                        {{--}, 500);--}}
                                        {{--break;--}}
                                    {{--case 'ERROR':--}}
                                        {{--alert_error(data.message);--}}
                                        {{--break;--}}
                                {{--}--}}

                            {{--}, $("#frmW75F1065").serialize() + "&txtQuantity=" + $("#txtQuantity").val() + "&cboLeaveTypeID=" + $("#cboLeaveTypeID").val());--}}
                        {{--}--}}
                    {{--}--}}
                    {{--else--}}
                        {{--console.log("Dữ liệu không trả ra gì hết");--}}
                }
            });
        }

    }

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        } else {
            return true;
        }
    }

    $(document).ready(function () {
        set_action("");
        resizeHeight();
        load_tableW75F1065();


        console.log($(window).height());

    });

    function resizeHeight() {
        $("#modalW75F1065").find("#tbHistory").height($("#modalW75F1065").find(".modal-content").height() - $("#modalW75F1065").find("fieldset").height() - 380);
    }

    function set_action(val) {
        $("#frmW75F1065").find(".alert-success").addClass('hide');
        $("#frmW75F1065").find(".err").text("");
        $("#frmW75F1065").find(".alert-danger").addClass('hide');
        $("#hdAction").val(val);
        switch (val) {
            case "add":
                clear_data();
                break;
            case "edit":
                break;
            case "save":
                valid_data_D75F1065();
                break;
            case "notsave":
                //code block
                if (actionW75F1065 != 'edit') {
                    delDataSave1066();
                }
                actionW75F1065 = "add";
                TransIDW75F1065 = "";
                clear_data();
                break;
            default: //TH View
                clear_data();
        }
    }

    function delDataSave1066() {//xóa dữ liệu thông tin công tác
        $.ajax({
            method: 'POST',
            url: '{{url("/W75F1065/view/$pForm/$g/deleteW75F1066")}}',
            data: {TransIDW75F1065: TransIDW75F1065},
            success: function (data) {
            }
        });
    }

    function clear_data() {
        $("#frmW75F1065").find("#cboLeaveTypeID").val("");
        $("#frmW75F1065").find("#txtLeaveDateFromW75F1065").val("");
        $("#frmW75F1065").find("#txtLeaveDateTo").val("");
        $("#frmW75F1065").find("#txtQuantity").val("");
        $("#frmW75F1065").find("#txtReason").val("");
        $("#frmW75F1065").find("#txtNote").val("");
        $("#frmW75F1065").find("#hdTransID").val("");
        $("#frmW75F1065").find("#txt1stAbsDayQuan").val("");
        $("#frmW75F1065").find("#txtLastAbsDayQuan").val("");
        var cboLeaveTypeID = $("#frmW75F1065").find("#cboLeaveTypeID");
        if (cboLeaveTypeID.find(":selected").attr("leaveID") == "L090") {//chọn công tác mới mở nút info
            $("#btnInfoW75F1065").prop("disabled", false);
        } else {
            $("#btnInfoW75F1065").prop("disabled", true);
        }
    }

    function EnableMaster(mode) {
        if (mode == 1) //view
        {
            $("#btnSave").removeAttr('disabled');
            $("#btnNotSaveW75F1065").removeAttr('disabled');
            $("#cboLeaveTypeID").removeAttr('disabled');
            $("#txtQuantity").removeAttr('disabled');
            $("#txtLeaveDateFromW75F1065").removeAttr('disabled');
            $("#txtLeaveDateTo").removeAttr('disabled');
            $("#txtReason").removeAttr('disabled');
            //$("#txtNote").removeAttr('disabled');
            $("#frmW75F1065").find("#txtNote").attr('disabled', false);
            $("#DateFromIcon").removeClass('input-group date_disable');
            $("#DateFromIcon").addClass('input-group date');
            $('.input-group.date').datepicker({
                todayHighlight: true,
                autoclose: true,
                format: "dd/mm/yyyy",
                language: 'vi'
                //	defaultViewDate: {day: 01, month: 01,year: 2015, format : "DD-MM-YYYY"}
            });
            $("#DateToIcon").removeClass('input-group date_disable');
            $("#DateToIcon").addClass('input-group date');
            $('.input-group.date').datepicker({
                todayHighlight: true,
                autoclose: true,
                format: "dd/mm/yyyy",
                language: 'vi'
                //	defaultViewDate: {day: 01, month: 01,year: 2015, format : "DD-MM-YYYY"}
            });
            //$("#gridW75F1065History").pqGrid( {editable:false} );

        }

        if (mode == 0) {
            $("#btnSave").attr('disabled', 'disabled');
            $("#btnNotSaveW75F1065").attr('disabled', 'disabled');
            $("#cboLeaveTypeID").attr('disabled', 'disabled');
            $("#txtQuantity").attr('disabled', 'disabled');
            $("#txtLeaveDateFromW75F1065").attr('disabled', 'disabled');
            $("#txtLeaveDateTo").attr('disabled', 'disabled');
            $("#txtReason").attr('disabled', 'disabled');
            //$("#txtNote").attr('disabled', 'disabled');
            $("#frmW75F1065").find("#txtNote").attr('disabled', true);
            $("#DateFromIcon").removeClass('input-group date');
            $("#DateFromIcon").addClass('input-group date_disable');
            $("#DateToIcon").removeClass('input-group date');
            $("#DateToIcon").addClass('input-group date_disable');
            //$("#gridW75F1065History").pqGrid( {editable:true} );
        }
    }

    function valid_data_D75F1065() {
        var cboLeaveTypeID = $("#frmW75F1065").find("#cboLeaveTypeID");
        if (cboLeaveTypeID.val() == null) {
            cboLeaveTypeID.get(0).setCustomValidity("{{Helpers::getRS($g,"Ban_chua_chon_loai_phep")}}");
            $("#frmW75F1065").find("#frm_hbtnSave").click();
            return false;
        }
        else {
            cboLeaveTypeID.get(0).setCustomValidity("");
        }
        var leave_date_from = $("#frmW75F1065").find("#txtLeaveDateFromW75F1065");
        if (leave_date_from.val() == "") {
            leave_date_from.get(0).setCustomValidity("{{Helpers::getRS($g,"Ban_chua_nhap_ngay_tu")}}");
            $("#frmW75F1065").find("#frm_hbtnSave").click();
            return false;
        }
        else {
            leave_date_from.get(0).setCustomValidity("");

        }


        var leave_date_to = $("#frmW75F1065").find("#txtLeaveDateTo");
        if (leave_date_to.val() == "") {
            leave_date_to.get(0).setCustomValidity("{{Helpers::getRS($g,"Ban_chua_nhap_ngay_den")}}");
            $("#frmW75F1065").find("#frm_hbtnSave").click();
            return false;
        }
        else {
            leave_date_to.get(0).setCustomValidity("");
        }

                {{--var txt1stAbsDayQuan = $("#txt1stAbsDayQuan");--}}
                {{--if(Number(txt1stAbsDayQuan.val()) < 0.5){--}}
                {{--console.log(txt1stAbsDayQuan.val());--}}
                {{--txt1stAbsDayQuan.get(0).setCustomValidity("{{Helpers::getRS($g,"So_luong")}}" + " " + "{{Helpers::getRS($g,"phai_lon_hon")}}" +" "+"hoặc bằng"+ " " + "0.5");--}}
                {{--$("#frmW75F1065").find("#frm_hbtnSave").click();--}}
                {{--return false;--}}
                {{--} else {--}}
                {{--txt1stAbsDayQuan.get(0).setCustomValidity("");--}}
                {{--}--}}

                {{--var txtLastAbsDayQuan = $("#txtLastAbsDayQuan");--}}
                {{--if(Number(txtLastAbsDayQuan.val()) < 0.5){--}}
                {{--console.log(txtLastAbsDayQuan.val());--}}
                {{--txtLastAbsDayQuan.get(0).setCustomValidity("{{Helpers::getRS($g,"So_luong")}}" + " " + "{{Helpers::getRS($g,"phai_lon_hon")}}" +" "+"hoặc bằng"+ " " + "0.5");--}}
                {{--$("#frmW75F1065").find("#frm_hbtnSave").click();--}}
                {{--return false;--}}
                {{--} else {--}}
                {{--txtLastAbsDayQuan.get(0).setCustomValidity("");--}}
                {{--}--}}

        var quantity = $("#frmW75F1065").find("#txtQuantity");
        if (quantity.val() == "") {
            quantity.get(0).setCustomValidity("{{Helpers::getRS($g,"Ban_chua_nhap_so_luong")}}");
            $("#frmW75F1065").find("#frm_hbtnSave").click();
            return false;
        }
        else {
            quantity.get(0).setCustomValidity("");
        }

        if (quantity.val() <= 0) {
            quantity.get(0).setCustomValidity("{{Helpers::getRS($g,"So_luong")}}" + " " + "{{Helpers::getRS($g,"phai_lon_hon")}}" + " " + "0");
            $("#frmW75F1065").find("#frm_hbtnSave").click();
            return false;
        }
        else {
            quantity.get(0).setCustomValidity("");
        }

        if (quantity.val() >= 90) {
            quantity.get(0).setCustomValidity("{{Helpers::getRS($g,"So_luong")}}" + " " + "{{Helpers::getRS($g,"phai_nho_hon")}}" + " " + "91");
            $("#frmW75F1065").find("#frm_hbtnSave").click();
            return false;
        }
        else {
            quantity.get(0).setCustomValidity("");
        }

        if (TransIDW75F1065 == "" && cboLeaveTypeID.find(":selected").attr("leaveID") == "L090") {//chọn Công tác nhưng chưa nhập thông tin công tác
            alert_warning("Bạn chưa nhập thông tin công tác");
            return false;
        }
        console.log(TransIDW75F1065, cboLeaveTypeID.val());
        $("#frmW75F1065").find("#frm_hbtnSave").click();
    }

    var showsendmail = function () {
        $("#emailPOP").find("#mPopUpSendMail").modal('show');
    };

    $("#modalW75F1065").on('submit', '#frmW75F1065', function (e) {
        e.preventDefault();
        var cboLeaveTypeID = $("#frmW75F1065").find("#cboLeaveTypeID");
        var leaveID = cboLeaveTypeID.find(":selected").attr("leaveID");
        $(".l3loading").removeClass('hide');
        //Kiểm tra ngày nhập từ đến có hợp lệ không
        $.ajax({
            method: "POST",
            url: '{{url("/W75F1065/view/$pForm/$g/2")}}',
            data: $("#frmW75F1065").serialize() + '&txtNote=' + encodeURIComponent($("#txtNote").val()) + '&TransIDW75F1065=' + TransIDW75F1065 + '&txtLastAbsDayQuan=' + $("#txtLastAbsDayQuan").val() + '&leaveID=' + leaveID,
            success: function (data) {
                $(".l3loading").addClass('hide');
                var result = $.parseJSON(data);
                console.log(data);
                switch (result.CODE) {
                    case 1:
                        alert_warning(result.message);
                        break;
                    case 2:
                        $("#hdTransID").val(result.transID);
                        if (result.message == "") {
                            save_ok(load_tableW75F1065);
                            actionW75F1065 = "add";
                            TransIDW75F1065 = "";
                        } else {
                            alert_warning(result.message);
                        }
                        break;
                    case 3:
                        $("#hdTransID").val(result.transID);
                        load_tableW75F1065();
                        $("#emailPOP").html(result.rsvalue);
                        showsendmail();
                        $("#mPopUpSendMail").find("#txtEmailReceivedAddress").prop('readonly', true);
                        actionW75F1065 = "add";
                        TransIDW75F1065 = "";
                        break;
                    case 4:
                        $("#hdTransID").val(result.transID);
                        save_ok(load_tableW75F1065);
                        actionW75F1065 = "add";
                        TransIDW75F1065 = "";
                        break;
                }
            }
        });

    });

    function checkQuanW75F1065(mode, leavedatefrom, leavedateto) {// hàm check số lượng của số lượng nghỉ từ và nghỉ đến
        var txt1stAbsDayQuan = $("#frmW75F1065").find("#txt1stAbsDayQuan");
        var txtLastAbsDayQuan = $("#frmW75F1065").find("#txtLastAbsDayQuan");
        if (leavedatefrom != "" && leavedateto != "") {// nếu đã chọn ngày từ và đến thì mới kiểm tra
            if (mode == "txtLeaveDateFromW75F1065") {
                if (leavedatefrom == leavedateto) {
                    txtLastAbsDayQuan.val(txt1stAbsDayQuan.val()).prop('disabled', true);
                } else {
                    txtLastAbsDayQuan.prop('disabled', false);
                }
            }
            if (mode == "txtLeaveDateTo") {
                if (leavedatefrom == leavedateto) {
                    txtLastAbsDayQuan.val(txt1stAbsDayQuan.val()).prop('disabled', true);
                } else {
                    txtLastAbsDayQuan.val((1).toFixed({{$decimals}})).prop('disabled', false);
                }
            }
        }
    }

    function closePopW75F1065() {
        console.log(actionW75F1065);
        TransIDW75F1065 = "";
        if (actionW75F1065 != "edit") {
            delDataSave1066();
        }
        $("#modalW75F1065").modal('hide');
    }

</script>

