@if (count($rsMaster) > 0)
    @define $lblEmployeeIDW09F2190 =    $rsMaster[0]["EmployeeID"]
    @define $lblEmployeeNameW09F2190 =    $rsMaster[0]["EmployeeName"]
    @define $lblWorkFormIDW09F2190 =    $rsMaster[0]["WorkFormID"]
    @define $lblWorkFormNameW09F2190 =    $rsMaster[0]["WorkFormName"]
    @define $cboNewWorkFormIDW09F2190 =    $rsMaster[0]["NewWorkFormID"]
    @define $lblMonthDurationW09F2190 =    $rsMaster[0]["MonthDuration"]
    @define $txtNewMonthDurationW09F2190 =    $rsMaster[0]["NewMonthDuration"]
    @define $lblContractDateBeginW09F2190 =    $rsMaster[0]["ContractDateBegin"]
    @define $lblContractDateEndW09F2190 =    $rsMaster[0]["ContractDateEnd"]
    @define $dtpNewContractDateBeginW09F2190 =    $rsMaster[0]["NewContractDateBegin"]
    @define $dtpNewContractDateEndW09F2190 =    $rsMaster[0]["NewContractDateEnd"]
    @define $lblBaseSalary01W09F2190 =    $rsMaster[0]["BaseSalary01"]
    @define $txtNewBaseSalary01W09F2190 =    $rsMaster[0]["NewBaseSalary01"]
    @define $lblBaseSalary02W09F2190 =    $rsMaster[0]["BaseSalary02"]
    @define $txtNewBaseSalary02W09F2190 =    $rsMaster[0]["NewBaseSalary02"]
    @define $lblBaseSalary03W09F2190 =    $rsMaster[0]["BaseSalary03"]
    @define $txtNewBaseSalary03W09F2190 =    $rsMaster[0]["NewBaseSalary03"]
    @define $lblBaseSalary04W09F2190 =    $rsMaster[0]["BaseSalary04"]
    @define $txtNewBaseSalary04W09F2190 =    $rsMaster[0]["NewBaseSalary04"]
    @define $txtNotesW09F2190 =    $rsMaster[0]["Notes"]
    @define $IsPermisionSaveW09F2190 =    $rsMaster[0]["IsPermisionSave"]

@else
    @define $lblEmployeeIDW09F2190 =    ""
    @define $lblEmployeeNameW09F2190 =    ""
    @define $lblWorkFormIDW09F2190 =    ""
    @define $lblWorkFormNameW09F2190 =    ""
    @define $cboNewWorkFormIDW09F2190 =    ""
    @define $lblMonthDurationW09F2190 =    ""
    @define $txtNewMonthDurationW09F2190 =    ""
    @define $lblContractDateBeginW09F2190 =    ""
    @define $lblContractDateEndW09F2190 =    ""
    @define $dtpNewContractDateBeginW09F2190 =    ""
    @define $dtpNewContractDateEndW09F2190 =    ""
    @define $lblBaseSalary01W09F2190 =    ""
    @define $txtNewBaseSalary01W09F2190 =    ""
    @define $lblBaseSalary02W09F2190 =    ""
    @define $txtNewBaseSalary02W09F2190 =    ""
    @define $lblBaseSalary03W09F2190 =    ""
    @define $txtNewBaseSalary03W09F2190 =    ""
    @define $lblBaseSalary04W09F2190 =    ""
    @define $txtNewBaseSalary04W09F2190 =    ""
    @define $txtNotesW09F2190 =    ""
    @define $IsPermisionSaveW09F2190 =    0
@endif
<form class="form-horizontal pdt10" id="frmW09F2190">
    <div class="row form-group">
        <div class="col-md-2 col-xs-2">
            <div class="liketext">
                <label class="lbl-normal">{{Helpers::getRS($g,"Nhan_vien")}}</label>
            </div>

        </div>
        <div class="col-md-5 col-xs-5">
            <div class="liketext">
                <label class="lbl-normal pdr0 "><a
                            onclick="showW09F4444('{{$lblEmployeeIDW09F2190}}')">{{$lblEmployeeNameW09F2190}}</a></label>
            </div>

        </div>
        <div class="col-md-5 col-xs-5">
            <button type="button" id="frm_fileDuyetW09F2190" class="btn btn-default smallbtn pull-right">
                <span class="glyphicon glyphicon-paperclip"></span> {{Helpers::getRS($g,"Dinh_kem")}}
            </button>

        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2 col-xs-2">

        </div>
        <div class="col-md-5 col-xs-5">
            <div class="liketext text-center text-primary">
                <h5 class="lbl-value pd5 bg-gray-light">{{Helpers::getRS($g,"Thong_tin_hien_tai")}}</h5>
            </div>
        </div>
        <div class="col-md-5 col-xs-5">
            <div class="liketext text-center text-primary">
                <h5 class="lbl-value pd5 bg-gray-light">{{Helpers::getRS($g,"Thong_tin_de_xuat")}}</h5>
            </div>
        </div>
    </div>
    <div class="row  form-group">
        <div class="col-md-2 col-xs-2">
            <div class="liketext">
                <b><label class="lbl-normal">{{Helpers::getRS($g,"Loai_HDLD")}}</label></b>
            </div>

        </div>
        <div class="col-md-5 col-xs-5">
            <div class="liketext">
                <label class="lbl-value">{{$lblWorkFormNameW09F2190}}</label>
            </div>
        </div>
        <div class="col-md-5 col-xs-5">
            <select class="form-control noUseValidHTML5 select2" id="cboNewWorkFormIDW09F2190"
                    name="cboNewWorkFormIDW09F2190" required>
                <option value=""></option>
                @foreach($rsWorkForm as $rowWorkForm)
                    <option monthDuration="{{$rowWorkForm["MonthDuration"]}}"
                            value="{{$rowWorkForm["NewWorkFormID"]}}" {{$cboNewWorkFormIDW09F2190 == $rowWorkForm["NewWorkFormID"] ? "selected": ""}}>{{$rowWorkForm["NewWorkFormID"]." -- ".$rowWorkForm["NewWorkFormName"]}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-2 col-xs-2">
            <div class="liketext">
                <b><label class="lbl-normal">{{Helpers::getRS($g,"So_thang")}}</label></b>
            </div>
        </div>
        <div class="col-md-5 col-xs-5">
            <div class="liketext">
                <label class="lbl-value">{{$lblMonthDurationW09F2190}}</label>
            </div>

        </div>
        <div class="col-md-5 col-xs-5">
            <input class="form-control text-right" id="txtNewMonthDurationW09F2190" name="txtNewMonthDurationW09F2190"
                   type="text"
                   placeholder="" value="{{$txtNewMonthDurationW09F2190}}">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-2 col-xs-2">
            <div class="liketext">
                <b><label class="lbl-normal">{{Helpers::getRS($g,"Ngay_bat_dau")}}</label></b>
            </div>
        </div>
        <div class="col-md-5 col-xs-5">
            <div class="liketext">
                <label class="lbl-value">{{$lblContractDateBeginW09F2190}}</label>
            </div>

        </div>
        <div class="col-md-3 col-xs-3">
            <div class="input-group ">
                <input type="text" class="form-control noUseValidHTML5" id="dtpNewContractDateBeginW09F2190"
                       name="dtpNewContractDateBeginW09F2190" value="{{$dtpNewContractDateBeginW09F2190}}"
                       required><span
                        class="input-group-addon"><i id="iconDateFrom"

                                                     class="glyphicon glyphicon-calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-2 col-xs-2">
            <div class="liketext">
                <b><label class="lbl-normal">{{Helpers::getRS($g,"Ngay_ket_thuc")}}</label></b>
            </div>
        </div>
        <div class="col-md-5 col-xs-5">
            <div class="liketext">
                <label class="lbl-value">{{$lblContractDateEndW09F2190}}</label>
            </div>

        </div>
        <div class="col-md-3 col-xs-3">
            <div class="input-group ">
                <input type="text" class="form-control noUseValidHTML5" id="dtpNewContractDateEndW09F2190"
                       name="dtpNewContractDateEndW09F2190" value="{{$dtpNewContractDateEndW09F2190}}"><span
                        class="input-group-addon"><i id="iconDateTo"
                                                     onclick="$('#dtpNewContractDateEndW09F2190').datepicker('show');"
                                                     class="glyphicon glyphicon-calendar"></i></span>
            </div>

        </div>
    </div>

    <div class="optionW09F2190">
        <?php
        $BASE01 = Helpers::arraySearch($rsColumns, "Code", "BASE01");
        ?>
        <div class="row form-group {{$BASE01[0]["Disabled"] == 1 ? 'hide':''}}">
            <div class="col-md-2 col-xs-2">
                <div class="liketext">
                    <label class="lbl-normal ">{{$BASE01[0]["CaptionName"]}}</label>

                </div>
            </div>
            <div class="col-md-5 col-xs-5">
                <div class="liketext">
                    <label id="txtBaseSalary01W09F2190" decimals="{{$BASE01[0]['Decimals']}}"
                           class="lbl-value pull-right">{{$lblBaseSalary01W09F2190}}</label>
                </div>
            </div>
            <div class="col-md-5 col-xs-5">
                <input class="form-control  text-right" id="txtNewBaseSalary01W09F2190"
                       name="txtNewBaseSalary01W09F2190" decimals="{{$BASE01[0]['Decimals']}}"
                       type="text" value="{{$txtNewBaseSalary01W09F2190}}"
                       placeholder="">
            </div>
        </div>
        <?php
        $BASE02 = Helpers::arraySearch($rsColumns, "Code", "BASE02");
        ?>
        <div class="row form-group {{$BASE02[0]["Disabled"] == 1 ? 'hide':''}}">
            <div class="col-md-2 col-xs-2">
                <div class="liketext">
                    <label class="lbl-normal">{{$BASE02[0]["CaptionName"]}}</label>
                </div>
            </div>
            <div class="col-md-5 col-xs-5">

                <div class="liketext">
                    <label id="txtBaseSalary02W09F2190" decimals="{{$BASE02[0]['Decimals']}}"
                           class="lbl-value  pull-right">{{$lblBaseSalary02W09F2190}}</label>
                </div>
            </div>
            <div class="col-md-5 col-xs-5">
                <input class="form-control  text-right" id="txtNewBaseSalary02W09F2190"
                       name="txtNewBaseSalary02W09F2190" decimals="{{$BASE02[0]['Decimals']}}"
                       type="text" value="{{$txtNewBaseSalary02W09F2190}}"
                       placeholder="">
            </div>
        </div>
        <?php
        $BASE03 = Helpers::arraySearch($rsColumns, "Code", "BASE03");
        ?>
        <div class="row form-group {{$BASE03[0]["Disabled"] == 1 ? 'hide':''}}">
            <div class="col-md-2 col-xs-2">
                <div class="liketext">
                    <label class="lbl-normal">{{$BASE03[0]["CaptionName"]}}</label>
                </div>
            </div>
            <div class="col-md-5 col-xs-5">

                <div class="liketext">
                    <label id="txtBaseSalary03W09F2190" decimals="{{$BASE03[0]['Decimals']}}"
                           class="lbl-value  pull-right">{{$lblBaseSalary03W09F2190}}</label>
                </div>
            </div>
            <div class="col-md-5 col-xs-5">
                <input class="form-control  text-right" id="txtNewBaseSalary03W09F2190"
                       name="txtNewBaseSalary03W09F2190" decimals="{{$BASE03[0]['Decimals']}}"
                       type="text" value="{{$txtNewBaseSalary03W09F2190}}"
                       placeholder="">
            </div>
        </div>

        <?php
        $BASE04 = Helpers::arraySearch($rsColumns, "Code", "BASE04");
        ?>
        <div class="row form-group {{$BASE04[0]["Disabled"] == 1 ? 'hide':''}}">
            <div class="col-md-2 col-xs-2">
                <div class="liketext">
                    <label class="lbl-normal">{{$BASE04[0]["CaptionName"]}}</label>
                </div>
            </div>
            <div class="col-md-5 col-xs-5">
                <div class="liketext">
                    <label id="txtBaseSalary04W09F2190" decimals="{{$BASE04[0]['Decimals']}}"
                           class="lbl-value  pull-right">{{$lblBaseSalary04W09F2190}}</label>
                </div>
            </div>
            <div class="col-md-5 col-xs-5">
                <input class="form-control  text-right" id="txtNewBaseSalary04W09F2190"
                       name="txtNewBaseSalary04W09F2190" decimals="{{$BASE04[0]['Decimals']}}"
                       type="text" value="{{$txtNewBaseSalary04W09F2190}}"
                       placeholder="">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2 col-xs-2">
                <div class="liketext">
                    <b><label class="lbl-normal">{{Helpers::getRS($g,"Ly_do")}}</label></b>
                </div>
            </div>

            <div class="col-md-10 col-xs-10">
                <textarea id="txtNotesW09F2190" name="txtNotesW09F2190" rows="2"
                          style="width:100%">{{$txtNotesW09F2190}}</textarea>
            </div>
        </div>
    </div>

    <div class="row mgt10">
        <div class="col-md-12 col-xs-12">
            <div class="pull-right">
                <button type="button" id="btnSaveW09F2190" name="btnSaveW09F2190"
                        {{$IsPermisionSaveW09F2190 == 1 && $perD09F2190>=2 ? "": "disabled"}}
                        onclick="ask_save(function(){saveData()})"
                        class="btn btn-default smallbtn"><span
                            class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                </button>
            </div>
        </div>
    </div>
    <button type="submit" id="hdBtnSaveW09F2190" class="hidden"></button>
</form>
<script>
    //console.log(gblVoucherList);
            @if (count($rsMaster) > 0)
    var oldData = {{json_encode($rsMaster[0])}} //Lưu thông tin object lúc edit
            @else
    var oldData = {}; //Lưu thông tin object lúc edit
    @endif
    $(document).ready(function () {
        //$(".select2").select2();
        setTimeout(function () {
            $('#dtpNewContractDateBeginW09F2190').datepicker({
                todayHighlight: true,
                autoclose: true,
                format: "dd/mm/yyyy",
                language: '{{$locale}}'
            }).on("changeDate", function (e) {
                console.log("from");
                caculateW09F2190(this);
            });

            $('#dtpNewContractDateEndW09F2190').datepicker({
                todayHighlight: true,
                autoclose: true,
                format: "dd/mm/yyyy",
                language: '{{$locale}}'
            }).on("changeDate", function (e) {
                console.log("to");
                caculateW09F2190(this);
            });
        }, 500);

        $("#iconDateFrom").click(function () {
            $('#dtpNewContractDateBeginW09F2190').datepicker('show');
        });

        $("#iconDateTo").click(function () {
            $('#dtpNewContractDateEndW09F2190').datepicker('show');
        });
    });


    //nút đính kèm
    $('#frm_fileDuyetW09F2190').click(function () {
       // var rowVoucher = getCurrentVoucherID(); //Hàm này viết bên Listvoucher.blade.php, để lấy voucherID hiện tại
        //alert($.param(rowVoucher));
        showFormDialogPost('{{url("/W09F4010/D09F2190/$g")}}', "modalW09F4010",
            {
                formCall: "W09F2190",
                keyID: "{{$vou}}",
                tableName: 'D09T2191'
            },2);
    });

    /*   $('#dtpNewContractDateBeginW09F2190').datepicker()
           .on("changeDate", function (e) {
               console.log(e);
               caculateW09F2190(this);
           });*/

    $('#txtNewMonthDurationW09F2190').change(function () {
        caculateW09F2190(this);
    });

    /*$('#dtpNewContractDateBeginW09F2190').change(function () {
        console.log("dtpNewContractDateBeginW09F2190");
        caculateW09F2190(this);
    });

    $('#dtpNewContractDateEndW09F2190').change(function () {
        console.log("dtpNewContractDateEndW09F2190");
        caculateW09F2190(this);
    });*/


    /*$('#dtpNewContractDateEndW09F2190').datepicker()
        .on("changeDate", function (e) {
            caculateW09F2190(this);
        });*/


    function caculateW09F2190(el) {
        console.log(el);
        var $month = $("#txtNewMonthDurationW09F2190");
        var $begin = $('#dtpNewContractDateBeginW09F2190');
        var $end = $('#dtpNewContractDateEndW09F2190');

        var month = $("#txtNewMonthDurationW09F2190").val();
        var begin = convertStringToDate($('#dtpNewContractDateBeginW09F2190').val());
        var end = convertStringToDate($('#dtpNewContractDateEndW09F2190').val());
        var isEmptyMOnth = (month == "" ? true : false);
        switch ($(el).attr("id")) {
            case "txtNewMonthDurationW09F2190":
                if (begin == null && end != null) {
                    begin = convertStringToDate($('#dtpNewContractDateEndW09F2190').val());
                    begin = begin != null ? begin.addMonths(Number(-month)) : null;
                }
                if (begin != null && end == null) {
                    end = convertStringToDate($('#dtpNewContractDateBeginW09F2190').val());
                    end = end != null ? end.addMonths(Number(month)) : null;
                }
                if (begin != null && end != null) {
                    end = convertStringToDate($('#dtpNewContractDateBeginW09F2190').val());
                    end = end != null ? end.addMonths(Number(month)) : null;
                }
                break;
            case "dtpNewContractDateBeginW09F2190":
                if (isEmptyMOnth && end != null) {
                    month = Math.round(daydiff(begin, end) / 30);
                    console.log(month);
                }
                if (!isEmptyMOnth && end == null) {
                    end = convertStringToDate($('#dtpNewContractDateBeginW09F2190').val());
                    end = end != null ? end.addMonths(Number(month)) : null;
                }
                if (!isEmptyMOnth && end != null) {
                    end = convertStringToDate($('#dtpNewContractDateBeginW09F2190').val());
                    end = end != null ? end.addMonths(Number(month)) : null;
                }
                break;
            case "dtpNewContractDateEndW09F2190":
                if (isEmptyMOnth && begin != null) {
                    month = Math.round(daydiff(begin, end) / 30);
                }
                if (!isEmptyMOnth && begin == null) {
                    begin = convertStringToDate($('#dtpNewContractDateEndW09F2190').val());
                    begin = begin != null ? begin.addMonths(Number(-month)) : null;
                }
                if (!isEmptyMOnth && begin != null) {
                    month = Math.round(daydiff(begin, end) / 30);
                }

        }

        $month.val(month);
        //$begin.val(convertDateToString(begin));
        console.log(end);
        $begin.datepicker('update', begin);
        //$end.val(convertDateToString(end));
        $end.datepicker('update', end.addDays(-1));
    }

    $('#txtBaseSalary01W09F2190, #txtNewBaseSalary01W09F2190').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: $('#txtBaseSalary01W09F2190').attr('decimals'),
        autoGroup: true,
        min: 0,
        max: 9999999999,
        //prefix: '$', //No Space, this will truncate the first character
        rightAlign: false,
        oncleared: function () {
            self.Value('');
        }
    });

    $('#txtBaseSalary02W09F2190, #txtNewBaseSalary02W09F2190').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: $('#txtBaseSalary02W09F2190').attr('decimals'),
        autoGroup: true,
        min: 0,
        max: 9999999999,
        //prefix: '$', //No Space, this will truncate the first character
        rightAlign: false,
        oncleared: function () {
            self.Value('');
        }
    });

    $('#txtBaseSalary03W09F2190, #txtNewBaseSalary03W09F2190').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: $('#txtBaseSalary03W09F2190').attr('decimals'),
        autoGroup: true,
        min: 0,
        max: 9999999999,
        //prefix: '$', //No Space, this will truncate the first character
        rightAlign: false,
        oncleared: function () {
            self.Value('');
        }
    });

    $('#txtBaseSalary04W09F2190, #txtNewBaseSalary04W09F2190').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: $('#txtBaseSalary04W09F2190').attr('decimals'),
        autoGroup: true,
        min: 0,
        max: 9999999999,
        //prefix: '$', //No Space, this will truncate the first character
        rightAlign: false,
        oncleared: function () {
            self.Value('');
        }
    });




    $('#txtNewMonthDurationW09F2190').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: 0,
        autoGroup: true,
        min: 0,
        max: 999,
        //prefix: '$', //No Space, this will truncate the first character
        rightAlign: false,
        oncleared: function () {
            //alert("dfs");
            self.Value('');
        },
        oncomplete: function () {
            console.log(self);
        }

    });

    $("#cboNewWorkFormIDW09F2190").change(function () {
        var duration = $('#cboNewWorkFormIDW09F2190 option:selected').attr('monthDuration');
        $("#txtNewMonthDurationW09F2190").val(duration).trigger("change");
        //$("#dtpNewContractDateBeginW09F2190").datepicker('update', '');
        //$end.val(convertDateToString(end));
        //$("#dtpNewContractDateEndW09F2190").datepicker('update', '');
        //$("#txtNewMonthDurationW09F2190").prop("disabled", duration > 0);
    });

    //Function này chưa dùng, viết để đó, nếu có nút không lưu thì dùng nó
    function resetData(data) {
        $("#cboNewWorkFormIDW09F2190").val(data["NewWorkFormID"]);
        $("#txtNewMonthDurationW09F2190").val(data["NewMonthDuration"]);
        $("#dtpNewContractDateBeginW09F2190").val(data["NewContractDateBegin"]);
        $("#dtpNewContractDateEndW09F2190").val(data["NewContractDateEnd"]);
        $("#txtNewBaseSalary01W09F2190").val(data["NewBaseSalary01"]);
        $("#txtNewBaseSalary02W09F2190").val(data["NewBaseSalary02"]);
        $("#txtNewBaseSalary03W09F2190").val(data["NewBaseSalary03"]);
        $("#txtNewBaseSalary04W09F2190").val(data["NewBaseSalary04"]);
    }

    function showW09F4444(empid) {
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "GET",
            url: "{{url("W09F4444/4")}}",
            data: {empid: empid},
            success: function (data) {
                $(".l3loading").addClass('hide');
                $("#myModal05").html(data);
                $("#modalW09F4444").modal("show");
            }
        });
    }


    function saveData() {
        @if ($IsPermisionSaveW09F2190 == 1 && $perD09F2190>=2) //Nếu có quyền mới cho lưu
        var cboNewWorkFormIDW09F2190 = $("#cboNewWorkFormIDW09F2190");
        var dtpNewContractDateBeginW09F2190 = $("#dtpNewContractDateBeginW09F2190");


        cboNewWorkFormIDW09F2190.get(0).setCustomValidity("");
        dtpNewContractDateBeginW09F2190.get(0).setCustomValidity("");

        if (cboNewWorkFormIDW09F2190.val() == "") {
            cboNewWorkFormIDW09F2190.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap_du_lieu')}}");
            $("#frmW09F2190").find('#hdBtnSaveW09F2190').click();
            cboNewWorkFormIDW09F2190.focus();
            return false;
        }

        if (dtpNewContractDateBeginW09F2190.val() == "") {
            dtpNewContractDateBeginW09F2190.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap_du_lieu')}}");
            $("#frmW09F2190").find('#hdBtnSaveW09F2190').click();
            dtpNewContractDateBeginW09F2190.focus();
            return false;
        }

        $("#frmW09F2190").find('#hdBtnSaveW09F2190').click();
        @else
        alert_warning("{{Helpers::getRS($g,"Ban_khong_co_quyen_thuc_hien_chuc_nang_nay")}}");
        @endif
    }

    $("#frmW09F2190").on("submit", function (e) {
        e.preventDefault();
        //alert("dfd");
        var rowVoucher = getCurrentVoucherID(); //Hàm này viết bên Listvoucher.blade.php, để lấy voucherID hiện tại
        //console.log(rowVoucher);
        $.ajax({
            method: "POST",
            url: '{{url("/W09F2190/action/save")}}',
            data: $("#frmW09F2190").serialize() + "&txtNewMonthDurationW09F2190=" + $("#txtNewMonthDurationW09F2190").val() + "&" + $.param(oldData) + "&" + $.param(rowVoucher),
            success: function (data) {
                var rs = JSON.parse(data);
                console.log(rs.status);
                switch (rs.status) {
                    case 'SUCC':
                        save_ok();
                        break;
                    case 'ERROR':
                        alert_error(rs.message);
                        break;
                }
            }
        });


    });

</script>