<div class="modal fade" id="modalW09F2151" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 80%">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($titleW09F2151,"W09F2151",true,"")}}
            </div>
                @define $defaultEmployeeID = ""
                @if ($task == "add" || $task == "edit")
                    @if (count($rsMaster) > 0)
                        @define $txtValidDateW09F2151 = $rsMaster[0]["ValidDate"]
                        @define $txtReasonW09F2151 = $rsMaster[0]["Reason"]

                        @define $txtDepartmentNameW25F2151 = $rsMaster[0]["DepartmentName"]
                        @define $txtTeamNameW25F2151 = $rsMaster[0]["TeamName"]
                        @define $txtDirectManagerNameW25F2151 = $rsMaster[0]["DirectManagerName"]
                        @define $txtWorkNameW25F2151 = $rsMaster[0]["WorkName"]

                        @define $txtDepartmentIDW25F2151 = $rsMaster[0]["DepartmentID"]
                        @define $txtTeamIDW25F2151 = $rsMaster[0]["TeamID"]
                        @define $txtDirectManagerIDW25F2151 = $rsMaster[0]["DirectManagerID"]
                        @define $txtWorkIDW25F2151 = $rsMaster[0]["WorkID"]

                        @define $chkIsSalaryAdjustmentW25F2151 = $rsMaster[0]["IsSalaryAdjustment"]
                        @define $txtBaseSalary01W25F2151 = $rsMaster[0]["BaseSalary01"]
                        @define $txtBaseSalary02W25F2151 = $rsMaster[0]["BaseSalary02"]
                        @define $txtBaseSalary03W25F2151 = $rsMaster[0]["BaseSalary03"]
                        @define $txtBaseSalary04W25F2151 = $rsMaster[0]["BaseSalary04"]

                        @define $cboNewDepartmentIDW25F2151 =  $rsMaster[0]["NewDepartmentID"]
                        @define $cboNewTeamIDW25F2151 = $rsMaster[0]["NewTeamID"]
                        @define $cboNewDirectManagerIDW25F2151 = $rsMaster[0]["NewDirectManagerID"]
                        @define $cboNewWorkIDW25F2151 = $rsMaster[0]["NewWorkID"]
                        @define $txtNewBaseSalary01W25F2151 = $rsMaster[0]["NewBaseSalary01"]
                        @define $txtNewBaseSalary02W25F2151 = $rsMaster[0]["NewBaseSalary02"]
                        @define $txtNewBaseSalary03W25F2151 = $rsMaster[0]["NewBaseSalary03"]
                        @define $txtNewBaseSalary04W25F2151 = $rsMaster[0]["NewBaseSalary04"]
                    @else
                        @define $txtValidDateW09F2151 = ""
                        @define $txtReasonW09F2151 = ""


                        @define $txtDepartmentNameW25F2151 = ""
                        @define $txtTeamNameW25F2151  = ""
                        @define $txtDirectManagerNameW25F2151  = ""
                        @define $txtWorkNameW25F2151 = ""
                        @define $txtDepartmentIDW25F2151 = ""
                        @define $txtTeamIDW25F2151 = ""
                        @define $txtDirectManagerIDW25F2151 = ""
                        @define $txtWorkIDW25F2151 = ""


                        @define $chkIsSalaryAdjustmentW25F2151 = 0
                        @define $txtBaseSalary01W25F2151 = 0
                        @define $txtBaseSalary02W25F2151 = 0
                        @define $txtBaseSalary03W25F2151 = 0
                        @define $txtBaseSalary04W25F2151 = 0

                        @define $cboNewDepartmentIDW25F2151 =  ""
                        @define $cboNewTeamIDW25F2151 = ""
                        @define $cboNewDirectManagerIDW25F2151 = ""
                        @define $cboNewWorkIDW25F2151 = ""
                        @define $txtNewBaseSalary01W25F2151 = 0
                        @define $txtNewBaseSalary02W25F2151 = 0
                        @define $txtNewBaseSalary03W25F2151 = 0
                        @define $txtNewBaseSalary04W25F2151 = 0
                    @endif
                @endif




            <div class="modal-body" style="padding:10px">
                <form class="form-horizontal" id="frmW09F2151">
                    <div class="row form-group">
                        <div class="col-md-2 col-xs-2">
                            <label class="lbl-normal">{{Helpers::getRS($g,"Nhan_vien")}}</label>
                        </div>
                        <div class="col-md-3 col-xs-3">
                            <select class="form-control select2" id="cboEmployeeIDW25F2151" {{$perD09F5650 <=2 || $task == "edit" ? "disabled": ""}}
                                    name="cboEmployeeIDW25F2151" required>
                                @foreach($employees as $rowEmployee)
                                    <option value="{{$rowEmployee["EmployeeID"]}}" {{$rowEmployee["EmployeeID"] == $employeeID ? "selected":""}}>{{$rowEmployee["EmployeeID"]." -- ".$rowEmployee["EmployeeName"]}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 col-xs-2">
                            <div class="liketext">
                                <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Ngay_hieu_luc")}}</label>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2">
                            <div class="input-group date">
                                <input type="text" class="form-control" id="txtValidDateW09F2151"
                                       name="txtValidDateW09F2151" value="{{$txtValidDateW09F2151}}" required><span
                                        class="input-group-addon"><i id="iconDateFrom"
                                                                     onclick="$('#txtValidDateW09F2151').datepicker('show');"
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

                            <textarea id="txtReasonW09F2151" name="txtReasonW09F2151" rows="2"
                                      style="width:100%" value="" required>{{$txtReasonW09F2151}}</textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2 col-xs-2">

                        </div>
                        <div class="col-md-5 col-xs-5">
                            <div class="liketext text-center text-primary">
                                <h4 class="lbl-normal">{{Helpers::getRS($g,"Thong_tin_hien_tai")}}</h4>
                            </div>
                        </div>
                        <div class="col-md-5 col-xs-5">
                            <div class="liketext text-center text-primary">
                                <h4 class="lbl-normal">{{Helpers::getRS($g,"Thong_tin_de_xuat")}}</h4>
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
                            <input class="form-control hide" id="txtDepartmentIDW25F2151" name="txtDepartmentIDW25F2151"
                                   type="text" value="{{$txtDepartmentIDW25F2151}}"
                                   placeholder="" disabled="disabled">
                            <input class="form-control" id="txtDepartmentNameW25F2151" name="txtDepartmentNameW25F2151"
                                   type="text" value="{{$txtDepartmentNameW25F2151}}"
                                   placeholder="" disabled="disabled">
                        </div>
                        <div class="col-md-5 col-xs-5">
                            <select class="form-control select2" id="cboNewDepartmentIDW25F2151"
                                    name="cboNewDepartmentIDW25F2151" required>
                                <option value=""></option>
                                @foreach($departments as $rs)
                                    <option value="{{$rs["DepartmentID"]}}" {{$cboNewDepartmentIDW25F2151 == $rs["DepartmentID"] ? "selected": ""}}>{{$rs["DepartmentID"]." -- ".$rs["DepartmentName"]}}</option>
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
                            <input class="form-control hide" id="txtTeamIDW25F2151" name="txtTeamIDW25F2151" type="text"
                                   placeholder="" value="{{$txtTeamIDW25F2151}}"  disabled="disabled">
                            <input class="form-control" id="txtTeamNameW25F2151" name="txtTeamNameW25F2151" type="text"
                                   placeholder="" value="{{$txtTeamNameW25F2151}}"  disabled="disabled">
                        </div>
                        <div class="col-md-5 col-xs-5">
                            <select class="form-control select2" id="cboNewTeamIDW25F2151"
                                    name="cboNewTeamIDW25F2151" >
                                <option value=""></option>
                                @foreach($teams as $rs)
                                    <option value="{{$rs["TeamID"]}}" {{$cboNewTeamIDW25F2151 == $rs["TeamID"] ? "selected": ""}}>{{$rs["TeamID"]." -- ".$rs["TeamName"]}}</option>
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
                            <input class="form-control hide" id="txtDirectManagerIDW25F2151"
                                   name="txtDirectManagerIDW25F2151" type="text"
                                   placeholder="" value="{{$txtDirectManagerIDW25F2151}}" disabled="disabled">
                            <input class="form-control" id="txtDirectManagerNameW25F2151"
                                   name="txtDirectManagerNameW25F2151" type="text"
                                   placeholder="" value="{{$txtDirectManagerNameW25F2151}}" disabled="disabled">
                        </div>
                        <div class="col-md-5 col-xs-5">
                            <select class="form-control select2" id="cboNewDirectManagerIDW25F2151"
                                    name="cboNewDirectManagerIDW25F2151" >
                                <option value=""></option>
                                @foreach($directManagers as $rs)
                                    <option DepartmentID="{{$rs["DepartmentID"]}}"
                                            value="{{$rs["DirectManagerID"]}}"  {{$cboNewDirectManagerIDW25F2151 == $rs["DirectManagerID"] ? "selected": ""}}>{{"".$rs["DirectManagerID"]." -- ".$rs["DirectManagerName"]}}</option>
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
                            <input class="form-control hide" id="txtWorkIDW25F2151" name="txtWorkIDW25F2151" type="text"
                                   placeholder="" value="{{$txtWorkIDW25F2151}}"  disabled="disabled">
                            <input class="form-control" id="txtWorkNameW25F2151" name="txtWorkNameW25F2151" type="text"
                                   placeholder="" value="{{$txtWorkNameW25F2151}}"  disabled="disabled">
                        </div>
                        <div class="col-md-5 col-xs-5">
                            <select class="form-control select2" id="cboNewWorkIDW25F2151"
                                    name="cboNewWorkIDW25F2151" >
                                <option value=""></option>
                                @foreach($works as $rs)
                                    <option value="{{$rs["WorkID"]}}"   {{$cboNewWorkIDW25F2151 == $rs["WorkID"] ? "selected": ""}}>{{$rs["WorkID"]." -- ".$rs["WorkName"]}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="checkbox mgl15">
                            <label>
                                <input type="checkbox" name="chkIsSalaryAdjustmentW25F2151"
                                       id="chkIsSalaryAdjustmentW25F2151" {{$chkIsSalaryAdjustmentW25F2151 == 1 ? "checked": ""}} > {{Helpers::getRS($g,"Dieu_chinh_luong")}}
                            </label>
                        </div>
                    </div>
                    <div class="optionW25F2151" style="display:  {{$chkIsSalaryAdjustmentW25F2151 == 1 ? 'block': 'none'  }} ">
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
                                <input class="form-control text-right" id="txtBaseSalary01W25F2151"
                                       name="txtBaseSalary01W25F2151" decimals="{{$BASE01[0]['Decimals']}}" type="text"
                                       placeholder="" value="{{$txtBaseSalary01W25F2151}}" disabled="disabled">
                            </div>
                            <div class="col-md-5 col-xs-5">
                                <input class="form-control  text-right" id="txtNewBaseSalary01W25F2151"
                                       name="txtNewBaseSalary01W25F2151" decimals="{{$BASE01[0]['Decimals']}}"
                                       type="text" value="{{$txtNewBaseSalary01W25F2151}}"
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
                                <input class="form-control  text-right" id="txtBaseSalary02W25F2151"
                                       name="txtBaseSalary02W25F2151" decimals="{{$BASE02[0]['Decimals']}}" type="text"
                                       placeholder="" value="{{$txtBaseSalary02W25F2151}}" disabled="disabled">
                            </div>
                            <div class="col-md-5 col-xs-5">
                                <input class="form-control  text-right" id="txtNewBaseSalary02W25F2151"
                                       name="txtNewBaseSalary02W25F2151" decimals="{{$BASE02[0]['Decimals']}}"
                                       type="text" value="{{$txtNewBaseSalary02W25F2151}}"
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
                                <input class="form-control  text-right" id="txtBaseSalary03W25F2151"
                                       name="txtBaseSalary03W25F2151" decimals="{{$BASE03[0]['Decimals']}}" type="text"
                                       placeholder="" value="{{$txtBaseSalary03W25F2151}}" disabled="disabled">
                            </div>
                            <div class="col-md-5 col-xs-5">
                                <input class="form-control  text-right" id="txtNewBaseSalary03W25F2151"
                                       name="txtNewBaseSalary03W25F2151" decimals="{{$BASE03[0]['Decimals']}}"
                                       type="text" value="{{$txtNewBaseSalary03W25F2151}}"
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
                                <input class="form-control  text-right" id="txtBaseSalary04W25F2151"
                                       name="txtBaseSalary04W25F2151" decimals="{{$BASE04[0]['Decimals']}}" type="text"
                                       placeholder="" value="{{$txtBaseSalary04W25F2151}}" disabled="disabled">
                            </div>
                            <div class="col-md-5 col-xs-5">
                                <input class="form-control  text-right" id="txtNewBaseSalary04W25F2151"
                                       name="txtNewBaseSalary04W25F2151" decimals="{{$BASE04[0]['Decimals']}}"
                                       type="text" value="{{$txtNewBaseSalary04W25F2151}}"
                                       placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row mgt10">
                        <div class="col-md-12 col-xs-12">
                            <div class="pull-right">
                                <button type="button" id="btnSaveW25F2151" name="btnSaveW25F2151"
                                        onclick="ask_save(function(){saveData()})"
                                        class="btn btn-default smallbtn"><span
                                            class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                                </button>
                                @if ($task == "add")
                                    <button type="button" id="btnNextW25F2151" name="btnNextW25F2151"
                                            class="btn btn-default smallbtn"><span
                                                class="fa fa-arrow-right text-blue mgr5"></span> {{Helpers::getRS($g,"Nhap_tiep")}}
                                    </button>
                                @endif
                                <button type="button" id="btnNotSaveW25F2151" name="btnNotSaveW25F2151"
                                        class="btn btn-default smallbtn"><span
                                            class="fa fa-ban text-red"></span> {{Helpers::getRS($g,"Khong_luu")}}
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="hdBtnSaveW25F2151" class="hidden"></button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var task = "{{$task}}";
    var directManagers = {{json_encode($directManagers)}};
    @if (count($rsMaster) > 0)
        var oldData = {{json_encode($rsMaster[0])}} //Lưu thông tin object lúc edit
    @else
        var oldData = {}; //Lưu thông tin object lúc edit
    @endif

    console.log(oldData);
    $(document).ready(function (e) {
        $('#txtValidDateW09F2151').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });

      /*  if (task == "add"){
            $("#cboEmployeeIDW25F2151").prop("disabled", {{$perD09F5650 <=2 }});
        }
        if (task == "edit") {
            $("#cboEmployeeIDW25F2151").prop("disabled", true);
        }*/
        enableControls(true);

        $("#cboEmployeeIDW25F2151").change(function () {
            var mode = task == "edit" ? 1 : 0;
            $.ajax({
                method: "POST",
                url: '{{url("/W09F2151/$pForm/$g/loadmaster")}}',
                data: $("#frmW09F2151").serialize() + "&mode="+ mode + "&employeeID="+$("#cboEmployeeIDW25F2151").val() + "&proTransID=" + "{{$proTransID}}",
                success: function (data) {
                    console.log(data);
                    $("#txtDepartmentIDW25F2151").val(data.DepartmentID);
                    if (data.length > 0) {
                        oldData = data[0];
                        setFormValues(data[0]);
                        console.log(oldData);
                    } else {
                        oldData = {};
                        setFormValues(null);
                    }
                }
            });
        });

        $("#cboNewDepartmentIDW25F2151").change(function () {
            $.ajax({
                method: "POST",
                url: '{{url("/W09F2151/$pForm/$g/loadteams")}}',
                data: {departmentID: $(this).val()},
                success: function (data) {
                    $("#cboNewTeamIDW25F2151").html(data);
                }
            });
            var departmentID = $(this).val();
            var directList = $.grep(directManagers, function (data) {
                return data.DepartmentID == departmentID;
            });
            if (directList.length > 0) {
                var directItem = directList[0]["DirectManagerID"]
                $("#cboNewDirectManagerIDW25F2151").val(directItem);
            }
        });

        $('#txtBaseSalary01W25F2151, #txtNewBaseSalary01W25F2151').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: $('#txtBaseSalary01W25F2151').attr('decimals'),
            autoGroup: true,
            //prefix: '$', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () {
                self.Value('');
            }
        });

        $('#txtBaseSalary02W25F2151, #txtNewBaseSalary02W25F2151').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: $('#txtBaseSalary02W25F2151').attr('decimals'),
            autoGroup: true,
            //prefix: '$', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () {
                self.Value('');
            }
        });

        $('#txtBaseSalary03W25F2151, #txtNewBaseSalary03W25F2151').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: $('#txtBaseSalary03W25F2151').attr('decimals'),
            autoGroup: true,
            //prefix: '$', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () {
                self.Value('');
            }
        });

        $('#txtBaseSalary04W25F2151, #txtNewBaseSalary04W25F2151').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: $('#txtBaseSalary04W25F2151').attr('decimals'),
            autoGroup: true,
            //prefix: '$', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () {
                self.Value('');
            }
        });
    });

    function setFormValues(data) {
        console.log(data);
        if (data != null) {
            $("#txtReasonW09F2151").val(data.Reason);
            $("#txtDepartmentNameW25F2151").val(data.DepartmentName);
            $("#txtTeamNameW25F2151").val(data.TeamName);
            $("#txtDirectManagerNameW25F2151").val(data.DirectManagerName);
            $("#txtWorkNameW25F2151").val(data.WorkName);

            //$("#txtDepartmentIDW25F2151").attr("txtDepartmentIDW25F2151",data.DepartmentID);
            //$("#txtTeamIDW25F2151").attr(data.TeamID);
            //$("#txtDirectManagerIDW25F2151").attr(data.DirectManagerID);
            //$("#txtWorkIDW25F2151").attr(data.WorkID);

            $("#chkIsSalaryAdjustmentW25F2151").val(data.IsSalaryAdjustment);

            $("#txtBaseSalary01W25F2151").val(data.BaseSalary01);
            $("#txtBaseSalary02W25F2151").val(data.BaseSalary02);
            $("#txtBaseSalary03W25F2151").val(data.BaseSalary03);
            $("#txtBaseSalary04W25F2151").val(data.BaseSalary04);

            $("#cboNewDepartmentIDW25F2151").val(data.NewDepartmentID);
            $("#cb0NewTeamIDW25F2151").val(data.NewTeamID);
            $("#cboNewDirectManagerIDW25F2151").val(data.DirectManagerID);
            $("#cboNewWorkIDW25F2151").val(data.NewWorkID);
            $("#txtNewBaseSalary01W25F2151").val(data.NewBaseSalary01);
            $("#txtNewBaseSalary02W25F2151").val(data.NewBaseSalary02);
            $("#txtNewBaseSalary03W25F2151").val(data.NewBaseSalary03);
            $("#txtNewBaseSalary04W25F2151").val(data.NewBaseSalary04);
            //$("#txtValidDateW09F2151").val(data.ValidDate);
            $("#txtValidDateW09F2151").datepicker('update', data.ValidDate);
        } else {
            $("#txtValidDateW09F2151").val("");
            $("#txtReasonW09F2151").val("");

            $("#txtDepartmentNameW25F2151").val("");
            $("#txtTeamNameW25F2151").val("");
            $("#txtDirectManagerNameW25F2151").val("");
            $("#txtWorkNameW25F2151").val("");
            $("#chkIsSalaryAdjustmentW25F2151").val(0);

            $("#txtBaseSalary01W25F2151").val("");
            $("#txtBaseSalary02W25F2151").val("");
            $("#txtBaseSalary03W25F2151").val("");
            $("#txtBaseSalary04W25F2151").val("");

            $("#txtNewDepartmentIDW25F2151").val("");
            $("#txtNewTeamIDW25F2151").val("");
            $("#txtNewDirectManagerIDW25F2151").val("");
            $("#txtNewWorkIDW25F2151").val("");
            $("#txtNewBaseSalary01W25F2151").val("");
            $("#txtNewBaseSalary02W25F2151").val("");
            $("#txtNewBaseSalary03W25F2151").val("");
            $("#txtNewBaseSalary04W25F2151").val("");

        }
    }

    $("#chkIsSalaryAdjustmentW25F2151").click(function () {
        //console.log($(this).is(":checked"));
        if ($(this).is(":checked")) {
            $(".optionW25F2151").css("display", "block")
        } else {
            $(".optionW25F2151").css("display", "none");
        }

    });


    function saveData() {
        var cboEmployeeIDW25F2151 = $("#cboEmployeeIDW25F2151");
        var txtReasonW09F2151 = $("#txtReasonW09F2151");
        var txtDepartmentIDW25F2151 = $("#txtDepartmentIDW25F2151");
        var txtValidDateW09F2151 = $("#txtValidDateW09F2151");

        txtReasonW09F2151.get(0).setCustomValidity("");
        txtDepartmentIDW25F2151.get(0).setCustomValidity("");
        txtValidDateW09F2151.get(0).setCustomValidity("");
        console.log("save");

        if (cboEmployeeIDW25F2151.val() == "") {
            cboEmployeeIDW25F2151.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap_du_lieu')}}");
            $("#frmW09F2151").find('#hdBtnSaveW25F2151').click();
            cboEmployeeIDW25F2151.focus();
            return false;
        }

        if (txtValidDateW09F2151.val() == "") {
            txtValidDateW09F2151.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap_du_lieu')}}");
            $("#frmW09F2151").find('#hdBtnSaveW25F2151').click();
            txtValidDateW09F2151.focus();
            return false;
        }

        if (txtReasonW09F2151.val() == "") {
            txtReasonW09F2151.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap_du_lieu')}}");
            $("#frmW09F2151").find('#hdBtnSaveW25F2151').click();
            txtReasonW09F2151.focus();
            return false;
        }

        if (txtDepartmentIDW25F2151.val() == "") {
            txtDepartmentIDW25F2151.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap_du_lieu')}}");
            $("#frmW09F2151").find('#hdBtnSaveW25F2151').click();
            txtDepartmentIDW25F2151.focus();
            return false;
        }
        $("#frmW09F2151").find('#hdBtnSaveW25F2151').click();
    }

    $("#frmW09F2151").on("submit", function (e) {
        e.preventDefault();
        //Check before saving
        console.log($('#chkIsSalaryAdjustmentW25F2151').is(":checked"));
        var chkIsSalaryAdjustmentW25F2151 = 0
        if($('#chkIsSalaryAdjustmentW25F2151').is(":checked")){
            chkIsSalaryAdjustmentW25F2151 = 1;
        }
        var mode = task == "edit" ? 1 : 0;
        $.ajax({
            method: "POST",
            url: '{{url("/W09F2151/$pForm/$g/checkstore")}}',
            data: $("#frmW09F2151").serialize() + "&employeeID="+$("#cboEmployeeIDW25F2151").val() + "&proTransID=" + "{{$proTransID}}" + "&mode=" + mode + "&chkIsSalaryAdjustmentW25F2151=" + chkIsSalaryAdjustmentW25F2151,
            success: function (data) {
                console.log(data);
                if (data.length > 0) {
                    if (Number(data[0].Status) == 1) {
                        alert_warning(data[0].Message);
                    } else {
                        if (task == "edit") {
                            action = "update";
                        }
                        else {
                            action = "save";
                        }
                        //console.log($('#chkIsSalaryAdjustmentW25F2151').val());
                        console.log($("#frmW09F2151").serialize() + "&proTransID=" + "{{$proTransID}}" + "&cboEmployeeIDW25F2151=" + $("#cboEmployeeIDW25F2151").val() + "&" + $.param(oldData));
                        $.ajax({
                            method: "POST",
                            url: '{{url("/W09F2151/$pForm/$g/")}}' + "/" + action,
                            data: $("#frmW09F2151").serialize() + "&proTransID=" + "{{$proTransID}}" + "&employeeID=" + $("#cboEmployeeIDW25F2151").val() + "&" + $.param(oldData) + "&mode="+mode+ "&chkIsSalaryAdjustmentW25F2151=" + chkIsSalaryAdjustmentW25F2151,
                            success: function (data) {
                                var rs = JSON.parse(data);
                                console.log(rs.status);
                                switch (rs.status){
                                    case "BACKGROUND": //Gửi mail ngầm
                                        save_ok(function(){
                                            alert_info("{{Helpers::getRS($g,'Email_da_duoc_gui_toi')}}" + ": <b><i>" + rs.name + "</i></b>");
                                            callbackAfterSave(rs.data.ProTransID);
                                        });
                                        break;
                                    case "SHOWMAIL": //Hiển thị màn hình sendmail
                                        save_ok(function(){
                                            showEmailPopup(rs.rsvalue,rs.data);
                                            callbackAfterSave(rs.data.ProTransID);
                                        });
                                        break;
                                    case "NOSEND": //Không có gửi mail
                                        save_ok(function(){
                                            callbackAfterSave(rs.data.ProTransID);
                                        });
                                        break;
                                    case "ERROR": //Lỗi khi run SQL
                                        save_not_ok();
                                        //alert_error(rs.message);
                                        break;
                                }
                                //deleteTableTemp();
                            }
                        });
                    }
                }

            }
        });


    });

    function callbackAfterSave(ProTransID){
        enableControls(false)
        $(".no-menu-alert").load("{{url("/alert")}}");
        loadDataW09F2150();
        setFormValues(oldData);
        /*var $grid  = $("#gridW09F2150")
        $("#btnSaveW25F2081").attr("disabled", true);
        $("#btnNotSaveW25F2081").attr("disabled", true);

        $.ajax({
            method: "POST",
            url: '{{url("/W09F2150/$pForm/$g/filter")}}',
            data: $("#frmW09F2150").serialize() & "&proTransID=" + ProTransID ,
            success: function (data) {
                console.log(data)
                if (data!= null && data.length > 0){
                    if (task == "add")
                        update4ParamGrid($grid, data[0], 'add');
                    if (task == "edit")
                        update4ParamGrid($grid, data[0], 'edit');
                }
            }
        });*/

    }

    function deleteTableTemp(){
        $.ajax({
            method: "POST",
            url: '{{url("/W09F2151/$pForm/$g/deletetable")}}',
            success: function (data) {
                console.log(data);

            }
        });
    }

    function clearFormW25F2081(){
        $("#frmW09F2151").find("input, select textarea").val("");
        $("#cboEmployeeIDW25F2151").val("{{$employeeID}}").trigger("change");
    }

    $("#btnNextW25F2151").click(function(){
        clearFormW25F2081();
        enableControls(true);

    });
    $("#btnNotSaveW25F2151").click(function(){
        ask_not_save(function(){
            clearFormW25F2081();
            //enableControls(false);
        });
    });

    function enableControls(action){
        if (task == "add"){
            $("#btnSaveW25F2151").prop("disabled", action == false);
            $("#btnNotSaveW25F2151").prop("disabled", action == false);
            $("#btnNextW25F2151").prop("disabled",action == true);
        }
    }


</script>