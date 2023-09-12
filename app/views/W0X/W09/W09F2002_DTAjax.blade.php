<form class="form-horizontal pdt10" id="frmW09F2002">
    <fieldset class="mgt5">
        <legend class="legend">{{Helpers::getRS($g,"Thong_tin_nhan_vien")}}</legend>
        <div class="row form-group">
            <div class="col-md-3 col-xs-3">
                <label class="lbl-normal">{{Helpers::getRS($g,"Ma_nhan_vien")}}</label>
            </div>
            <div class="col-md-9 col-xs-9">
                <div class="row">
                    <div class="col-md-4 col-xs-4">
                        <label>{{isset($rsDetail[0]['EmployeeID']) ? $rsDetail[0]['EmployeeID'] : ''}}</label>
                    </div>
                    <div class="col-md-8 col-xs-8">
                        <div class="row">
                            <div class="col-md-5 col-xs-5">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Ten_nhan_vien")}}</label>
                            </div>
                            <div class="col-md-7 col-xs-7">
                                <label>{{isset($rsDetail[0]['EmployeeName']) ? $rsDetail[0]['EmployeeName'] : ''}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-3 col-xs-3">
                <label class="lbl-normal">{{Helpers::getRS($g,"Khoi")}}</label>
            </div>
            <div class="col-md-9 col-xs-9">
                <div class="row">
                    <div class="col-md-4 col-xs-4">
                        <label>{{isset($rsDetail[0]['BlockName']) ? $rsDetail[0]['BlockName'] : ''}}</label>
                    </div>
                    <div class="col-md-8 col-xs-8">
                        <div class="row">
                            <div class="col-md-5 col-xs-5">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Phong_ban")}}</label>
                            </div>
                            <div class="col-md-7 col-xs-7">
                                <label>{{isset($rsDetail[0]['DepartmentName']) ? $rsDetail[0]['DepartmentName'] : ''}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-3 col-xs-3">
                <label class="lbl-normal">{{Helpers::getRS($g,"To_nhom")}}</label>
            </div>
            <div class="col-md-9 col-xs-9">
                <div class="row">
                    <div class="col-md-4 col-xs-4">
                        <label>{{isset($rsDetail[0]['TeamName']) ? $rsDetail[0]['TeamName'] : ''}}</label>
                    </div>
                    <div class="col-md-8 col-xs-8">
                        <div class="row">
                            <div class="col-md-5 col-xs-5">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Cong_viec")}}</label>
                            </div>
                            <div class="col-md-7 col-xs-7">
                                <label>{{isset($rsDetail[0]['WorkName']) ? $rsDetail[0]['WorkName'] : ''}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-3 col-xs-3">
                <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_vao_lam")}}</label>
            </div>
            <div class="col-md-9 col-xs-9">
                <div class="row">
                    <div class="col-md-4 col-xs-4">
                        <label>{{isset($rsDetail[0]['Datejoined']) ? $rsDetail[0]['Datejoined'] : ''}}</label>
                    </div>
                    <div class="col-md-8 col-xs-8">
                        <div class="row">
                            <div class="col-md-5 col-xs-5">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Tham_nien_lam_viec")}}</label>
                            </div>
                            <div class="col-md-7 col-xs-7">
                                <div class="row">
                                    <div class="col-md-1 col-xs-1">
                                        <label>{{isset($rsDetail[0]['SeniorWorkYear']) ? $rsDetail[0]['SeniorWorkYear'] : ''}}</label>
                                    </div>
                                    <div class="col-md-4 col-xs-4">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Nam")}}</label>
                                    </div>
                                    <div class="col-md-1 col-xs-1">
                                        <label>{{isset($rsDetail[0]['SeniorWorkMonth']) ? $rsDetail[0]['SeniorWorkMonth'] : ''}}</label>
                                    </div>
                                    <div class="col-md-4 col-xs-4">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Thang")}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-3 col-xs-3 @if(intval($captionBase01[0]['Disabled']) == 1) hidden @endif">
                <label class="lbl-normal">{{isset($captionBase01[0]['ShortU']) ? $captionBase01[0]['ShortU'] : ''}}</label>
            </div>
            <div class="col-md-9 col-xs-9 @if(intval($captionBase01[0]['Disabled']) == 1) hidden @endif">
                <div class="row">
                    <div class="col-md-4 col-xs-4">
                        <label>{{isset($rsDetail[0]['BaseSalary01']) ? $rsDetail[0]['BaseSalary01'] : ''}}</label>
                    </div>
                    <div class="col-md-8 col-xs-8 @if(intval($captionBase02[0]['Disabled']) == 1) hidden @endif">
                        <div class="row">
                            <div class="col-md-5 col-xs-5">
                                <label class="lbl-normal">{{isset($captionBase02[0]['ShortU']) ? $captionBase02[0]['ShortU'] : ''}}</label>
                            </div>
                            <div class="col-md-7 col-xs-7">
                                <label>{{isset($rsDetail[0]['BaseSalary02']) ? $rsDetail[0]['BaseSalary02'] : ''}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-3 col-xs-3 @if(intval($captionBase03[0]['Disabled']) == 1) hidden @endif">
                <label class="lbl-normal">{{isset($captionBase03[0]['ShortU']) ? $captionBase03[0]['ShortU'] : ''}}</label>
            </div>
            <div class="col-md-9 col-xs-9 @if(intval($captionBase03[0]['Disabled']) == 1) hidden @endif">
                <div class="row">
                    <div class="col-md-4 col-xs-4">
                        <label>{{isset($rsDetail[0]['BaseSalary03']) ? $rsDetail[0]['BaseSalary03'] : ''}}</label>
                    </div>
                    <div class="col-md-8 col-xs-8" @if(intval($captionBase04[0]['Disabled']) == 1) hidden @endif>
                        <div class="row">
                            <div class="col-md-5 col-xs-5">
                                <label class="lbl-normal">{{isset($captionBase04[0]['ShortU']) ? $captionBase04[0]['ShortU'] : ''}}</label>
                            </div>
                            <div class="col-md-7 col-xs-7">
                                <label>{{isset($rsDetail[0]['BaseSalary04']) ? $rsDetail[0]['BaseSalary04'] : ''}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-3 col-xs-3">
                <label class="lbl-normal">{{Helpers::getRS($g,"So_lan_ky_luat")}}</label>
            </div>
            <div class="col-md-9 col-xs-9">
                <div class="row">
                    <div class="col-md-4 col-xs-4">
                        <label>{{isset($rsDetail[0]['TimesDiscipline']) ? $rsDetail[0]['TimesDiscipline'] : ''}}</label>
                    </div>
                    <!-- div class="col-md-8 col-xs-8">
                        <div class="row">
                            <div class="col-md-5 col-xs-5">
                                <label class="lbl-normal">{{Helpers::getRS($g,"So_lan_ky_luat")}}</label>
                            </div>
                            <div class="col-md-7 col-xs-7">
                                <label>{{isset($rsDetail[0]['LastAdjustDate']) ? $rsDetail[0]['LastAdjustDate'] : ''}}</label>
                            </div>
                        </div>
                    </div -->
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-3 col-xs-3">
                <label class="lbl-normal">{{Helpers::getRS($g,"Ly_do")}}</label>
            </div>
            <div class="col-md-9 col-xs-9">
                <label>{{isset($rsDetail[0]['ReasonName']) ? $rsDetail[0]['ReasonName'] : ''}}</label>
            </div>
        </div>
    </fieldset>
    <fieldset class="mgt5">
        <legend class="legend">{{Helpers::getRS($g,"Thong_tin_de_xuat")}}</legend>
        <div class="row form-group">
            <div class="col-md-3 col-xs-3 @if(intval($captionBase01[0]['Disabled']) == 1) hidden @endif">
                <label class="lbl-normal">{{isset($captionBase01[0]['ShortU']) ? $captionBase01[0]['ShortU'] : ''}}</label>
            </div>
            <div class="col-md-9 col-xs-9 @if(intval($captionBase01[0]['Disabled']) == 1) hidden @endif">
                <div class="row">
                    <div class="col-md-4 col-xs-4">
                        <label>{{isset($rsDetail[0]['ProBaseSalary01']) ? $rsDetail[0]['ProBaseSalary01'] : ''}}</label>
                    </div>
                    <div class="col-md-8 col-xs-8 @if(intval($captionBase02[0]['Disabled']) == 1) hidden @endif">
                        <div class="row">
                            <div class="col-md-5 col-xs-5">
                                <label class="lbl-normal">{{isset($captionBase02[0]['ShortU']) ? $captionBase02[0]['ShortU'] : ''}}</label>
                            </div>
                            <div class="col-md-7 col-xs-7">
                                <label>{{isset($rsDetail[0]['ProBaseSalary02']) ? $rsDetail[0]['ProBaseSalary02'] : ''}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-3 col-xs-3 @if(intval($captionBase03[0]['Disabled']) == 1) hidden @endif">
                <label class="lbl-normal">{{isset($captionBase03[0]['ShortU']) ? $captionBase03[0]['ShortU'] : ''}}</label>
            </div>
            <div class="col-md-9 col-xs-9 @if(intval($captionBase03[0]['Disabled']) == 1) hidden @endif">
                <div class="row">
                    <div class="col-md-4 col-xs-4">
                        <label>{{isset($rsDetail[0]['ProBaseSalary03']) ? $rsDetail[0]['ProBaseSalary03'] : ''}}</label>
                    </div>
                    <div class="col-md-8 col-xs-8 @if(intval($captionBase04[0]['Disabled']) == 1) hidden @endif">
                        <div class="row">
                            <div class="col-md-5 col-xs-5">
                                <label class="lbl-normal">{{isset($captionBase04[0]['ShortU']) ? $captionBase04[0]['ShortU'] : ''}}</label>
                            </div>
                            <div class="col-md-7 col-xs-7">
                                <label>{{isset($rsDetail[0]['ProBaseSalary04']) ? $rsDetail[0]['ProBaseSalary04'] : ''}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-3 col-xs-3">
                <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_hieu_luc")}}</label>
            </div>
            <div class="col-md-9 col-xs-9">
                <div class="row">
                    <div class="col-md-4 col-xs-4">
                        <label>{{isset($rsDetail[0]['ProValidDate']) ? $rsDetail[0]['ProValidDate'] : ''}}</label>
                    </div>
                    <div class="col-md-8 col-xs-8">
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-3 col-xs-3">
                <label class="lbl-normal">{{Helpers::getRS($g,"Ly_do")}}</label>
            </div>
            <div class="col-md-9 col-xs-9">
                <label>{{isset($rsDetail[0]['ProReasonName']) ? $rsDetail[0]['ProReasonName'] : ''}}</label>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-3 col-xs-3">
                <label class="lbl-normal">{{Helpers::getRS($g,"Ghi_chu")}}</label>
            </div>
            <div class="col-md-9 col-xs-9">
                <label>{{isset($rsDetail[0]['ProNotes']) ? $rsDetail[0]['ProNotes'] : ''}}</label>
            </div>
        </div>
    </fieldset>
    <fieldset class="mgt5">
        <legend class="legend">{{Helpers::getRS($g,"Thong_tin_duyet")}}</legend>
        <div class="row form-group">
            <div class="col-md-3 col-xs-3 @if(intval($captionBase01[0]['Disabled']) == 1) hidden @endif">
                <label class="lbl-normal">{{isset($captionBase01[0]['ShortU']) ? $captionBase01[0]['ShortU'] : ''}}</label>
            </div>
            <div class="col-md-9 col-xs-9 @if(intval($captionBase01[0]['Disabled']) == 1) hidden @endif">
                <div class="row">
                    <div class="col-md-4 col-xs-4">
                        <input type="text" value = "{{isset($rsDetail[0]['AppBaseSalary01']) ? $rsDetail[0]['AppBaseSalary01'] : ''}}" class="form-control" id="txtAppBaseSalary01W09F2002" name="txtAppBaseSalary01W09F2002">
                    </div>
                    <div class="col-md-8 col-xs-8 @if(intval($captionBase02[0]['Disabled']) == 1) hidden @endif">
                        <div class="row">
                            <div class="col-md-5 col-xs-5">
                                <label class="lbl-normal">{{isset($captionBase02[0]['ShortU']) ? $captionBase02[0]['ShortU'] : ''}}</label>
                            </div>
                            <div class="col-md-7 col-xs-7">
                                <input type="text" value = "{{isset($rsDetail[0]['AppBaseSalary02']) ? $rsDetail[0]['AppBaseSalary02'] : ''}}" class="form-control" id="txtAppBaseSalary02W09F2002" name="txtAppBaseSalary02W09F2002">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-3 col-xs-3 @if(intval($captionBase03[0]['Disabled']) == 1) hidden @endif">
                <label class="lbl-normal">{{isset($captionBase03[0]['ShortU']) ? $captionBase03[0]['ShortU'] : ''}}</label>
            </div>
            <div class="col-md-9 col-xs-9 @if(intval($captionBase03[0]['Disabled']) == 1) hidden @endif">
                <div class="row">
                    <div class="col-md-4 col-xs-4">
                        <input type="text" value = "{{isset($rsDetail[0]['AppBaseSalary03']) ? $rsDetail[0]['AppBaseSalary03'] : ''}}" class="form-control" id="txtAppBaseSalary03W09F2002" name="txtAppBaseSalary03W09F2002">
                    </div>
                    <div class="col-md-8 col-xs-8 @if(intval($captionBase04[0]['Disabled']) == 1) hidden @endif">
                        <div class="row">
                            <div class="col-md-5 col-xs-5">
                                <label class="lbl-normal">{{isset($captionBase04[0]['ShortU']) ? $captionBase04[0]['ShortU'] : ''}}</label>
                            </div>
                            <div class="col-md-7 col-xs-7">
                                <input type="text" value = "{{isset($rsDetail[0]['AppBaseSalary04']) ? $rsDetail[0]['AppBaseSalary04'] : ''}}" class="form-control" id="txtAppBaseSalary04W09F2002" name="txtAppBaseSalary04W09F2002">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-3 col-xs-3">
                <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_hieu_luc")}}</label>
            </div>
            <div class="col-md-9 col-xs-9">
                <div class="row">
                    <div class="col-md-4 col-xs-4">
                        <div id="divDateToW38F2050" class="input-group">
                            <input type="text" class="form-control" id="txtAppValidDateW09F2002"
                                   name="txtAppValidDateW09F2002" value="{{isset($rsDetail[0]['AppValidDate']) ? $rsDetail[0]['AppValidDate'] : ''}}" ><span
                                    class="input-group-addon"><i  onclick="triggerDate();"
                                                                  class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-8">
                    </div>
                </div>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-3 col-xs-3">

            </div>
            <div class="col-md-9 col-xs-9">
                <div class="row">
                    <div class="col-md-5 col-xs-5">
                        <div class="row">
                            <div class="col-md-5 col-xs-5">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_lap")}}</label>
                            </div>
                            <div class="col-md-7 col-xs-7">
                                <label>{{isset($rsDetail[0]['VoucherDate']) ? $rsDetail[0]['VoucherDate'] : ''}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-xs-5">
                        <div class="row">
                            <div class="col-md-5 col-xs-5">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Nguoi_lap")}}</label>
                            </div>
                            <div class="col-md-7 col-xs-7">
                                <label>{{isset($rsDetail[0]['ProposerName']) ? $rsDetail[0]['ProposerName'] : ''}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-2">
                        <button type="button" id="frm_btnSaveW092002"
                                class="btn btn-default smallbtn pull-right"
                                title="{{Helpers::getRS($g,"Luu")}}"
                                onclick="ask_save(function(){save()})">
                            <span class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
</form>
<script type="text/javascript">
    var SalaryProposalID = "{{$vou}}";
    var EmployeeID = "{{$rsDetail[0]['EmployeeID']}}";
    var isApproval = "{{$isApproval}}";
    if($('#slduyet').val() != 0){
        //alert("da chay");
        //$('#frm_btnSaveW092002').addClass('hide');
        $('#frm_btnSaveW092002').remove();
        $('#txtAppBaseSalary01W09F2002').prop('disabled', true);
        $('#txtAppBaseSalary02W09F2002').prop('disabled', true);
        $('#txtAppBaseSalary03W09F2002').prop('disabled', true);
        $('#txtAppBaseSalary04W09F2002').prop('disabled', true);
        $('#txtAppValidDateW09F2002').prop('disabled', true);
        $('#txtNotesW09F2002').prop('disabled', true);
    }

    function triggerDate() {
        if ($('#txtAppValidDateW09F2002').is(':disabled') == false) {
            $('#txtAppValidDateW09F2002').datepicker("show");
        }
    }

    $('#txtAppBaseSalary01W09F2002').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: {{intval($captionBase01[0]['Decimals'])}},
        autoGroup: true,
        //prefix: '$', //No Space, this will truncate the first character
        rightAlign: false,
        oncleared: function () {
            self.Value('');
        }
    });

    $('#txtAppBaseSalary02W09F2002').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: {{intval($captionBase02[0]['Decimals'])}},
        autoGroup: true,
        //prefix: '$', //No Space, this will truncate the first character
        rightAlign: false,
        oncleared: function () {
            self.Value('');
        }
    });

    $('#txtAppBaseSalary03W09F2002').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: {{intval($captionBase03[0]['Decimals'])}},
        autoGroup: true,
        //prefix: '$', //No Space, this will truncate the first character
        rightAlign: false,
        oncleared: function () {
            self.Value('');
        }
    });

    $('#txtAppBaseSalary04W09F2002').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: {{intval($captionBase04[0]['Decimals'])}},
        autoGroup: true,
        //prefix: '$', //No Space, this will truncate the first character
        rightAlign: false,
        oncleared: function () {
            self.Value('');
        }
    });

    $('#txtAppValidDateW09F2002').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: "dd/mm/yyyy",
        language: '{{Session::get("locate")}}'
    });

    function save() {
        $.ajax({
            method: "POST",
            url: '{{url("/W09F2002/action/save")}}',
            data: $("#frmW09F2002").serialize() + "&SalaryProposalID=" + SalaryProposalID + "&EmployeeID=" + EmployeeID + "&isApproval=" + isApproval,
            success: function (data) {
                console.log(data);
                if (data.status == 0) {
                    save_ok(function () {
                    });
                } else {
                    save_not_ok();
                }
            }
        });
    }
</script>