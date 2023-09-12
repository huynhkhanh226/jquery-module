@if (count($rsMaster) > 0)
    @define $txtEmployeeID = $rsMaster[0]["EmployeeID"]
    @define $txtEmployeeText = $rsMaster[0]["EmployeeName"]
    @define $txtValidDateW09F2052 = $rsMaster[0]["ValidDate"]
    @define $txtReasonW09F2052 = $rsMaster[0]["Reason"]

    @define $txtDepartmentNameW09F2052 = $rsMaster[0]["DepartmentName"]
    @define $txtTeamNameW09F2052 = $rsMaster[0]["TeamName"]
    @define $txtDirectManagerNameW09F2052 = $rsMaster[0]["DirectManagerName"]
    @define $txtWorkNameW09F2052 = $rsMaster[0]["WorkName"]

    @define $txtDepartmentIDW09F2052 = $rsMaster[0]["DepartmentID"]
    @define $txtTeamIDW09F2052 = $rsMaster[0]["TeamID"]
    @define $txtDirectManagerIDW09F2052 = $rsMaster[0]["DirectManagerID"]
    @define $txtWorkIDW09F2052 = $rsMaster[0]["WorkID"]

    @define $chkIsSalaryAdjustmentW09F2052 = $rsMaster[0]["IsSalaryAdjustment"]
    @define $txtBaseSalary01W09F2052 = $rsMaster[0]["BaseSalary01"]
    @define $txtBaseSalary02W09F2052 = $rsMaster[0]["BaseSalary02"]
    @define $txtBaseSalary03W09F2052 = $rsMaster[0]["BaseSalary03"]
    @define $txtBaseSalary04W09F2052 = $rsMaster[0]["BaseSalary04"]

    @define $cboNewDepartmentIDW09F2052 =  $rsMaster[0]["NewDepartmentID"]
    @define $cboNewTeamIDW09F2052 = $rsMaster[0]["NewTeamID"]
    @define $cboNewDirectManagerIDW09F2052 = $rsMaster[0]["NewDirectManagerID"]
    @define $cboNewWorkIDW09F2052 = $rsMaster[0]["NewWorkID"]
    @define $txtNewBaseSalary01W09F2052 = $rsMaster[0]["NewBaseSalary01"]
    @define $txtNewBaseSalary02W09F2052 = $rsMaster[0]["NewBaseSalary02"]
    @define $txtNewBaseSalary03W09F2052 = $rsMaster[0]["NewBaseSalary03"]
    @define $txtNewBaseSalary04W09F2052 = $rsMaster[0]["NewBaseSalary04"]
    @define $IsPermisionSave = $rsMaster[0]["IsPermisionSave"]

@else
    @define $txtEmployeeID = ""
    @define $txtEmployeeText = ""
    @define $txtValidDateW09F2052 = ""
    @define $txtReasonW09F2052 = ""


    @define $txtDepartmentNameW09F2052 = ""
    @define $txtTeamNameW09F2052  = ""
    @define $txtDirectManagerNameW09F2052  = ""
    @define $txtWorkNameW09F2052 = ""
    @define $txtDepartmentIDW09F2052 = ""
    @define $txtTeamIDW09F2052 = ""
    @define $txtDirectManagerIDW09F2052 = ""
    @define $txtWorkIDW09F2052 = ""


    @define $chkIsSalaryAdjustmentW09F2052 = 0
    @define $txtBaseSalary01W09F2052 = 0
    @define $txtBaseSalary02W09F2052 = 0
    @define $txtBaseSalary03W09F2052 = 0
    @define $txtBaseSalary04W09F2052 = 0

    @define $cboNewDepartmentIDW09F2052 =  ""
    @define $cboNewTeamIDW09F2052 = ""
    @define $cboNewDirectManagerIDW09F2052 = ""
    @define $cboNewWorkIDW09F2052 = ""
    @define $txtNewBaseSalary01W09F2052 = 0
    @define $txtNewBaseSalary02W09F2052 = 0
    @define $txtNewBaseSalary03W09F2052 = 0
    @define $txtNewBaseSalary04W09F2052 = 0

    @define $IsPermisionSave = 1
@endif
<form class="form-horizontal pdt10" id="frmW09F2152">
    <div class="row form-group">
        <div class="col-md-2 col-xs-2">
            <div class="liketext">
                <label class="lbl-normal">{{Helpers::getRS($g,"Nhan_vien")}}</label>
            </div>

        </div>
        <div class="col-md-5 col-xs-5">
            <div class="liketext">
                <label class="lbl-normal pdr0 "><a onclick="showW09F4444('{{$txtEmployeeID}}')">{{$txtEmployeeText}}</a></label>
            </div>

        </div>
        <div class="col-md-2 col-xs-2">
            <div class="liketext">
                <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Ngay_hieu_luc")}}</label>
            </div>
        </div>
        <div class="col-md-3 col-xs-3">
            <div class="input-group date">
                <input type="text" class="form-control noUseValidHTML5" id="txtValidDateW09F2052"
                       name="txtValidDateW09F2052" value="{{$txtValidDateW09F2052}}" required><span
                        class="input-group-addon"><i id="iconDateFrom"
                                                     onclick="$('#txtValidDateW09F2052').datepicker('show');"
                                                     class="glyphicon glyphicon-calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-2 col-xs-2">
            <div class="liketext">
                <label class="lbl-normal">{{Helpers::getRS($g,"Ly_do")}}</label>
            </div>
        </div>
        <div class="col-md-10 col-xs-10">
            <div class="liketext">
                <label class="lbl-value">{{$txtReasonW09F2052}}</label>
            </div>
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
                <b><label class="lbl-normal">{{Helpers::getRS($g,"Phong_ban")}}</label></b>
            </div>

        </div>
        <div class="col-md-5 col-xs-5">
            <div class="liketext">
                <label class="lbl-value">{{$txtDepartmentNameW09F2052}}</label>
            </div>
        </div>
        <div class="col-md-5 col-xs-5">
            <select class="form-control noUseValidHTML5 select2" id="cboNewDepartmentIDW09F2052"
                    name="cboNewDepartmentIDW09F2052" required>
                <option value=""></option>
                @foreach($departments as $rs)
                    <option value="{{$rs["DepartmentID"]}}" {{$cboNewDepartmentIDW09F2052 == $rs["DepartmentID"] ? "selected": ""}}>{{$rs["DepartmentID"]." -- ".$rs["DepartmentName"]}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-2 col-xs-2">
            <div class="liketext">
                <b><label class="lbl-normal">{{Helpers::getRS($g,"To_nhom")}}</label></b>
            </div>
        </div>
        <div class="col-md-5 col-xs-5">
            <div class="liketext">
                <label class="lbl-value">{{$txtTeamNameW09F2052}}</label>
            </div>

        </div>
        <div class="col-md-5 col-xs-5">
            <select class="form-control noUseValidHTML5 select2" id="cboNewTeamIDW09F2052"
                    name="cboNewTeamIDW09F2052">
                <option value=""></option>
                @foreach($teams as $rs)
                    <option value="{{$rs["TeamID"]}}" {{$cboNewTeamIDW09F2052 == $rs["TeamID"] ? "selected": ""}}>{{$rs["TeamID"]." -- ".$rs["TeamName"]}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-2 col-xs-2">
            <div class="liketext">
                <b><label class="lbl-normal">{{Helpers::getRS($g,"Nguoi_QLTT")}}</label></b>
            </div>
        </div>
        <div class="col-md-5 col-xs-5">
            <div class="liketext">
                <label class="lbl-value">{{$txtDirectManagerNameW09F2052}}</label>
            </div>

        </div>
        <div class="col-md-5 col-xs-5">
            <select class="form-control noUseValidHTML5 select2" id="cboNewDirectManagerIDW09F2052"
                    name="cboNewDirectManagerIDW09F2052">
                <option value=""></option>
                @foreach($directManagers as $rs)
                    <option
                            value="{{$rs["DirectManagerID"]}}" {{$cboNewDirectManagerIDW09F2052 == $rs["DirectManagerID"] ? "selected": ""}}>{{$rs["DirectManagerName"] == "" ? $rs["DirectManagerID"]:  $rs["DirectManagerID"]." -- ".$rs["DirectManagerName"]}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-2 col-xs-2">
            <div class="liketext">
                <b><label class="lbl-normal">{{Helpers::getRS($g,"Cong_viec")}}</label></b>
            </div>
        </div>
        <div class="col-md-5 col-xs-5">
            <div class="liketext">
                <label class="lbl-value">{{$txtWorkNameW09F2052}}</label>
            </div>

        </div>
        <div class="col-md-5 col-xs-5">
            <select class="form-control noUseValidHTML5 select2" id="cboNewWorkIDW09F2052"
                    name="cboNewWorkIDW09F2052">
                <option value=""></option>
                @foreach($works as $rs)
                    <option value="{{$rs["WorkID"]}}" {{$cboNewWorkIDW09F2052 == $rs["WorkID"] ? "selected": ""}}>{{$rs["WorkID"]." -- ".$rs["WorkName"]}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="checkbox mgl15">
            <label>
                <input type="checkbox" name="chkIsSalaryAdjustmentW09F2052"
                       id="chkIsSalaryAdjustmentW09F2052"
                       value="1" {{$chkIsSalaryAdjustmentW09F2052 == 1 ? "checked": ""}} > {{Helpers::getRS($g,"Dieu_chinh_luong")}}
            </label>
        </div>
    </div>
    <div class="optionW09F2052" style="display: {{$chkIsSalaryAdjustmentW09F2052 == 1 ? "block" : "none"}}">
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
                    <label id="txtBaseSalary01W09F2052" decimals="{{$BASE01[0]['Decimals']}}"
                           class="lbl-value pull-right">{{$txtBaseSalary01W09F2052}}</label>
                </div>
            </div>
            <div class="col-md-5 col-xs-5">
                <input class="form-control  text-right" id="txtNewBaseSalary01W09F2052"
                       name="txtNewBaseSalary01W09F2052" decimals="{{$BASE01[0]['Decimals']}}"
                       type="text" value="{{$txtNewBaseSalary01W09F2052}}"
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
                    <label id="txtBaseSalary02W09F2052" decimals="{{$BASE02[0]['Decimals']}}"
                           class="lbl-value  pull-right">{{$txtBaseSalary02W09F2052}}</label>
                </div>
            </div>
            <div class="col-md-5 col-xs-5">
                <input class="form-control  text-right" id="txtNewBaseSalary02W09F2052"
                       name="txtNewBaseSalary02W09F2052" decimals="{{$BASE02[0]['Decimals']}}"
                       type="text" value="{{$txtNewBaseSalary02W09F2052}}"
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
                    <label id="txtBaseSalary03W09F2052" decimals="{{$BASE03[0]['Decimals']}}"
                           class="lbl-value  pull-right">{{$txtBaseSalary03W09F2052}}</label>
                </div>
            </div>
            <div class="col-md-5 col-xs-5">
                <input class="form-control  text-right" id="txtNewBaseSalary03W09F2052"
                       name="txtNewBaseSalary03W09F2052" decimals="{{$BASE03[0]['Decimals']}}"
                       type="text" value="{{$txtNewBaseSalary03W09F2052}}"
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
                    <label id="txtBaseSalary04W09F2052" decimals="{{$BASE04[0]['Decimals']}}"
                           class="lbl-value  pull-right">{{$txtBaseSalary04W09F2052}}</label>
                </div>
            </div>
            <div class="col-md-5 col-xs-5">
                <input class="form-control  text-right" id="txtNewBaseSalary04W09F2052"
                       name="txtNewBaseSalary04W09F2052" decimals="{{$BASE04[0]['Decimals']}}"
                       type="text" value="{{$txtNewBaseSalary04W09F2052}}"
                       placeholder="">
            </div>
        </div>

    </div>

    <div class="row mgt10">
        <div class="col-md-12 col-xs-12">
            <div class="pull-right">
                <button type="button" id="btnSaveW09F2052" name="btnSaveW09F2052" {{$IsPermisionSave == 1 ? "": "disabled"}}
                        onclick="ask_save(function(){saveData()})"
                        class="btn btn-default smallbtn"><span
                            class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                </button>
            </div>
        </div>
    </div>
    <button type="submit" id="hdBtnSaveW09F2052" class="hidden"></button>
</form>
<script>
    @if (count($rsMaster) > 0)
        var oldData = {{json_encode($rsMaster[0])}} //Lưu thông tin object lúc edit
    @else
        var oldData = {}; //Lưu thông tin object lúc edit
    @endif
    var directManagers = {{json_encode($directManagers)}};
    $(document).ready(function () {
        //$(".select2").select2();
    });

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

    $("#chkIsSalaryAdjustmentW09F2052").click(function () {
        if ($(this).is(":checked")) {
            $(".optionW09F2052").css("display", "block")
        } else {
            $(".optionW09F2052").css("display", "none");
            $("#txtNewBaseSalary01W09F2052").val(0);
            $("#txtNewBaseSalary02W09F2052").val(0);
            $("#txtNewBaseSalary03W09F2052").val(0);
            $("#txtNewBaseSalary04W09F2052").val(0);
        }

    });


    $('#txtValidDateW09F2052').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: "dd/mm/yyyy",
        language: '{{Session::get("locate")}}'
    });

    $("#cboNewDepartmentIDW09F2052").change(function () {
        $.ajax({
            method: "POST",
            url: '{{url("/W09F2152/action/loadteams")}}',
            data: {departmentID: $(this).val()},
            success: function (data) {
                $("#cboNewTeamIDW09F2052").html(data);
            }
        });
        var departmentID = $(this).val();
        var directList = $.grep(directManagers, function (data) {
            return data.DepartmentID == departmentID;
        });

        if (directList.length > 0) {
            var directItem = directList[0]["DirectManagerID"]
            $("#cboNewDirectManagerIDW09F2052").val(directItem);
        }
    });

    $('#txtBaseSalary01W09F2052, #txtNewBaseSalary01W09F2052').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: $('#txtBaseSalary01W09F2052').attr('decimals'),
        autoGroup: true,
        //prefix: '$', //No Space, this will truncate the first character
        rightAlign: false,
        oncleared: function () {
            self.Value('');
        }
    });

    $('#txtBaseSalary02W09F2052, #txtNewBaseSalary02W09F2052').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: $('#txtBaseSalary02W09F2052').attr('decimals'),
        autoGroup: true,
        //prefix: '$', //No Space, this will truncate the first character
        rightAlign: false,
        oncleared: function () {
            self.Value('');
        }
    });

    $('#txtBaseSalary03W09F2052, #txtNewBaseSalary03W09F2052').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: $('#txtBaseSalary03W09F2052').attr('decimals'),
        autoGroup: true,
        //prefix: '$', //No Space, this will truncate the first character
        rightAlign: false,
        oncleared: function () {
            self.Value('');
        }
    });

    $('#txtBaseSalary04W09F2052, #txtNewBaseSalary04W09F2052').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: $('#txtBaseSalary04W09F2052').attr('decimals'),
        autoGroup: true,
        //prefix: '$', //No Space, this will truncate the first character
        rightAlign: false,
        oncleared: function () {
            self.Value('');
        }
    });

    function saveData() {
        var cboNewDepartmentIDW09F2052 = $("#cboNewDepartmentIDW09F2052");
        var txtValidDateW09F2052 = $("#txtValidDateW09F2052");

        cboNewDepartmentIDW09F2052.get(0).setCustomValidity("");
        txtValidDateW09F2052.get(0).setCustomValidity("");
        console.log("save");

        if (txtValidDateW09F2052.val() == "") {
            txtValidDateW09F2052.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap_du_lieu')}}");
            $("#frmW09F2152").find('#hdBtnSaveW09F2052').click();
            txtValidDateW09F2052.focus();
            return false;
        }

        if (cboNewDepartmentIDW09F2052.val() == "") {
            cboNewDepartmentIDW09F2052.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap_du_lieu')}}");
            $("#frmW09F2152").find('#hdBtnSaveW09F2052').click();
            cboNewDepartmentIDW09F2052.focus();
            return false;
        }
        $("#frmW09F2152").find('#hdBtnSaveW09F2052').click();
    }

    $("#frmW09F2152").on("submit", function (e) {
        e.preventDefault();
        var div = $("#tbListVoucherW84F2020").find("div.active");
        var voucherID = $(div).find("#idVoucherW84F2020").val();
        var rowList = $.grep(gblVoucherList, function(data){
            return data["VoucherID"] == voucherID;
        });
        var rowVoucher = {};
        if (rowList.length > 0){
            rowVoucher = rowList[0];
        }
        console.log(rowVoucher);
        $.ajax({
            method: "POST",
            url: '{{url("/W09F2152/action/save")}}',
            data: $("#frmW09F2152").serialize() + "&" + $.param(oldData) + "&" + $.param(rowVoucher),
            success: function (data) {
                var rs = JSON.parse(data);
                console.log(rs.status);
                switch (rs.status){
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