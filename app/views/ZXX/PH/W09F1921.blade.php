<div class="modal fade draggable" id="modalW09F1921" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($caption,"W09F1921")}}
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="frmW09F1921">
                    <div class="box-body">
                        <input type="hidden" name="hdID" value="{{$id}}">
                        <fieldset>
                            <legend class="legend">{{Helpers::getRS($g,"Thong_tin_nhan_vien")}}</legend>
                            <div class="col-sm-12 mgt5">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <label class="col-sm-4 liketext lbl-normal">{{Helpers::getRS(4,"Ma_nhan_vien")}}</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="txtEmployeeID" name="txtEmployeeID" tabindex="1"
                                                       class="form-control text-uppercase" {{$id!=""?"readonly":""}} required>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="col-sm-1 liketext lbl-normal">{{Helpers::getRS(4,"Gioi_tinh")}}</label>
                                    <div class="col-sm-1">
                                        <div class="radio pdt5">
                                            <label>
                                                <input name="optSex" id="optSex0" value="0" checked
                                                       type="radio" tabindex="2">
                                                {{Helpers::getRS($g,"NamU")}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="radio pdt5">
                                            <label>
                                                <input name="optSex" id="optSex1" value="1"
                                                       type="radio" tabindex="3">
                                                {{Helpers::getRS($g,"Nu_U")}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-3 pdl0">
                                                <label class="liketext lbl-normal">{{Helpers::getRS(4,"Phong_ban")}}</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select id="slDepartmentID" name="slDepartmentID" class="form-control select2 required" style="width: 100%"  tabindex="11" required>
                                                    <option>&nbsp;</option>
                                                    @foreach($depart as $row)
                                                        <option value="{{$row['DepartmentID']}}">{{$row['DepartmentName']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <label class="col-sm-4 liketext lbl-normal">{{Helpers::getRS(4,"Ho_va_ten")}}</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="txtLastName" name="txtLastName" class="form-control" tabindex="4" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 pdl0">
                                        <input type="text" id="txtMiddleName" name="txtMiddleName" class="form-control"  tabindex="5" >
                                    </div>
                                    <div class="col-sm-2 pdl0">
                                        <input type="text" id="txtFirstName" name="txtFirstName" class="form-control"  tabindex="6" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-3 pdl0">
                                                <label class="liketext lbl-normal">{{Helpers::getRS(4,"Chuc_vu")}}</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select id="slDutyID" name="slDutyID" class="form-control select2 required" style="width: 100%"  tabindex="12" required>
                                                    <option>&nbsp;</option>
                                                    @foreach($duty as $row)
                                                        <option value="{{$row['DutyID']}}">{{$row['DutyName']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <label class="col-sm-4 liketext lbl-normal">{{Helpers::getRS(4,"Ngay_sinh")}}</label>
                                            <div class="col-sm-8">
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" id="txtBirthDate" name="txtBirthDate" tabindex="7" required>
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <label class="col-sm-4 liketext lbl-normal">{{Helpers::getRS(4,"Ngay_vao_lam")}}</label>
                                            <div class="col-sm-8">
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" id="txtDateJoined" name="txtDateJoined"  tabindex="8" required>
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-3 pdl0">
                                                <label class="liketext lbl-normal">{{Helpers::getRS(4,"Cong_viec")}}</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select id="slWorkID" name="slWorkID" class="form-control select2 normal" style="width: 100%"  tabindex="13">
                                                    <option value="">&nbsp;</option>
                                                    @foreach($work as $row)
                                                        <option value="{{$row['WorkID']}}">{{$row['WorkName']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <label class="col-sm-4 liketext lbl-normal">{{Helpers::getRS(4,"Quoc_tich")}}</label>
                                            <div class="col-sm-8">
                                                <select id="slCountryID" name="slCountryID" class="form-control select2 required" style="width: 100%"  tabindex="9" required>
                                                    @foreach($country as $row)
                                                        <option value="{{$row['CountryID']}}" {{$row['CountryID']=="VIE"?"selected":""}}>{{$row['CountryName']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-3 pdr0 pdl0">
                                                <label class="liketext lbl-normal">{{Helpers::getRS(4,"Nguoi_QLTT")}}</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select id="slDirectManagerID" name="slDirectManagerID" class="form-control select2 normal" style="width: 100%"  tabindex="14">
                                                    <option>&nbsp;</option>
                                                    @foreach($dirManager as $row)
                                                        <option value="{{$row['DirectManagerID']}}">{{$row['DirectManagerName']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <label class="col-sm-4 liketext lbl-normal">{{Helpers::getRS(4,"Mobile")}}</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="txtPager" name="txtPager"  tabindex="10"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-4 pdr0">
                                                <label class="liketext lbl-normal">{{Helpers::getRS(4,"So_noi_bo")}}</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" id="txtCompanyTelephone" name="txtCompanyTelephone"  tabindex="11"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    @if($id!="")
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="checkbox col-sm-6">
                                                <label>
                                                    <input type="checkbox" id="chkDisabled" name="chkDisabled"  tabindex="15"> {{Helpers::getRS($g,"Da_nghi_viec_ngay")}}
                                                </label>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" id="txtDateLeft" name="txtDateLeft" tabindex="16">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </fieldset>
                        @if($id!="")
                        <fieldset>
                            <legend class="legend">Self Service</legend>
                            <div class="col-sm-12 mgt5">
                                <div class="col-sm-4 pdl0">
                                    <div class="row">
                                        <label class="col-sm-4 liketext lbl-normal">{{Helpers::getRS(4,"Nguoi_dung")}}</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="txtUserID" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        @endif
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        @if($id!="")
                            <button type="button" id="frm_btnCancel"
                                    class="btn btn-default smallbtn pull-right" disabled>
                                <span class="glyphicon glyphicon-floppy-remove mgr5"></span> {{Helpers::getRS($g,"Khong_luu")}}
                            </button>
                            <button id="frm_btnSave"
                                    class="btn btn-default smallbtn pull-right mgr10" disabled><span
                                        class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                            </button>
                            @if($permission >2)
                            <button type="button" id="frm_btnEdit" class="btn btn-default smallbtn pull-left mgr10 ">
                                <span class="glyphicon glyphicon-edit mgr5"></span> {{Helpers::getRS($g,"Sua")}}
                            </button>
                            @endif
                            @if($permission >3)
                                <button type="button" id="frm_btnDelete" onclick="deleteW09F1921('{{$id}}');"
                                        class="btn btn-default smallbtn pull-left confirmation-Delete">
                                    <span class="glyphicon glyphicon-bin text-black mgr5"></span> {{Helpers::getRS($g,"Xoa")}}
                                </button>
                            @endif
                        @else
                            <button type="button" id="frm_btnNext" onclick="frmW09F1921Reset();"
                                    class="btn btn-default smallbtn pull-right" disabled>
                                <span class="glyphicon glyphicon-more-items mgr5"></span> {{Helpers::getRS($g,"Nhap_tiep")}}
                            </button>
                            <button id="frm_btnSave"
                                    class="btn btn-default smallbtn pull-right mgr10"><span
                                        class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                            </button>
                        @endif
                    </div>
                    <!-- /.box-footer -->
                </form>
                <div id="divPassW09F1921"></div>
            </div>
            <div class="modal-footer">
                <div class="alert alert-success alert-dismissable hide">
                    <i class="icon fa fa-check"></i> {{Helpers::getRS($g,"Du_lieu_da_duoc_luu_thanh_cong")}}
                </div>
                <div class="alert alert-danger alert-dismissable hide">
                    <i class="icon fa fa-ban"></i> <span
                            id="err">{{Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu")}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#frmW09F1921").on('click', '#frm_btnEdit', function () {
        $("#frmW09F1921").find("#frm_btnCancel").removeAttr("disabled");
        $("#frmW09F1921").find("#frm_btnSave").removeAttr("disabled");
        $("#frmW09F1921").find("#frm_btnEdit").attr("disabled", "disabled");
        $("#frmW09F1921").find("#frm_btnDelete").attr("disabled", "disabled");
        $("#modalW09F1921").find(".alert-success").addClass('hide');
        $("#modalW09F1921").find(".alert-danger").addClass('hide');
    });

    $("#frmW09F1921").on('click', '#frm_btnCancel', function () {
        normalMode();
    });

    function normalMode() {
        $("#frmW09F1921").find("#frm_btnCancel").attr("disabled", "disabled");
        $("#frmW09F1921").find("#frm_btnSave").attr("disabled", "disabled");
        $("#frmW09F1921").find("#frm_btnEdit").removeAttr("disabled");
        $("#frmW09F1921").find("#frm_btnDelete").removeAttr("disabled");
        @if ($id != '')
            var arr = getRowSelection($("#pqgrid_W09F1920"));
            $("#frmW09F1921").find("#txtEmployeeID").val(arr.EmployeeID);
            $("#frmW09F1921").find("#txtLastName").val(arr.LastName);
            $("#frmW09F1921").find("#txtMiddleName").val(arr.MiddleName);
            $("#frmW09F1921").find("#txtFirstName").val(arr.FirstName);
            $("#frmW09F1921").find("#txtBirthDate").val(arr.BirthDate);
            $("#frmW09F1921").find("#txtDateJoined").val(arr.DateJoined);
            $("#frmW09F1921").find("#txtPager").val(arr.Pager);
            $("#frmW09F1921").find("#txtUserID").val(arr.UserID);
            $("#frmW09F1921").find("#txtDateLeft").val(arr.DateLeft);
            $("#frmW09F1921").find("#txtCompanyTelephone").val(arr.CompanyTelephone);
            $("#frmW09F1921").find("#slCountryID").select2("val",arr.CountryID);
            $("#frmW09F1921").find("#slDepartmentID").select2("val",arr.DepartmentID);
            $("#frmW09F1921").find("#slDutyID").select2("val",arr.DutyID);
            $("#frmW09F1921").find("#slWorkID").select2("val",arr.WorkID);
            $("#frmW09F1921").find("#slDirectManagerID").select2("val",arr.DirectManagerID);
            if (arr.Sex==0)
                $("#frmW09F1921").find('#optSex0').prop('checked',true);
            else
                $("#frmW09F1921").find('#optSex1').prop('checked',true);
            if (arr.Disabled==1)
                $("#frmW09F1921").find('#chkDisabled').prop('checked',true);
        @endif
    }

    function frmW09F1921Reset() {
        $('#frmW09F1921')[0].reset();
        $("#frmW09F1921").find("#slCountryID").select2("val",'');
        $("#frmW09F1921").find("#slDepartmentID").select2("val",'');
        $("#frmW09F1921").find("#slDutyID").select2("val",'');
        $("#frmW09F1921").find("#slWorkID").select2("val",'');
        $("#frmW09F1921").find("#slDirectManagerID").select2("val",'');
        $("#frm_btnSave").removeAttr("disabled");
        $("#frm_btnNext").attr("disabled", "disabled");
        $("#txtEmployeeID").focus();
        $("#modalW09F1921").find(".alert-success").addClass('hide');
        $("#modalW09F1921").find(".alert-danger").addClass('hide');
        $("#frmW09F1921").find(".fa-check").addClass("hide");
    }

    $("#modalW09F1921").on('submit', '#frmW09F1921', function (e) {
        e.preventDefault();
        $("#frmW09F1921").find("#frm_btnSave").attr("disabled", "disabled");
        $("#frmW09F1921").find("#frm_btnCancel").attr("disabled", "disabled");
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: $("#frmW09F1921").serialize(),
            success: function (data) {
                var result = $.parseJSON(data);
                console.log(result);
                if (result.code == 1) {
                    $("#modalW09F1921").find(".alert-danger").addClass('hide');
                    $("#modalW09F1921").find(".alert-success").removeClass('hide');
                    @if ($id == "")
                        update4ParamGrid($("#pqgrid_W09F1920"), result, "add");
                    $("#frm_btnNext").removeAttr("disabled");
                    @else
                        update4ParamGrid($("#pqgrid_W09F1920"), result, "edit");
                    normalMode();
                    @endif
                } else if (result.code == 0) {
                    $("#modalW09F1921").find(".alert-danger").html(result.mess);
                    $("#modalW09F1921").find(".alert-danger").removeClass('hide');
                    $("#modalW09F1921").find(".alert-success").addClass('hide');
                    $("#frm_btnSave").removeAttr("disabled");
                    $("#frm_btnCancel").removeAttr("disabled");
                    $("#txtEmployeeID").focus();
                }
            }
        });
    });

    $(document).ready(function () {
        @if ($id != '')
        var arr = getRowSelection($("#pqgrid_W09F1920"));
        $("#frmW09F1921").find("#txtEmployeeID").val(arr.EmployeeID);
        $("#frmW09F1921").find("#txtLastName").val(arr.LastName);
        $("#frmW09F1921").find("#txtMiddleName").val(arr.MiddleName);
        $("#frmW09F1921").find("#txtFirstName").val(arr.FirstName);
        $("#frmW09F1921").find("#txtBirthDate").val(arr.BirthDate);
        $("#frmW09F1921").find("#txtDateJoined").val(arr.DateJoined);
        $("#frmW09F1921").find("#txtPager").val(arr.Pager);
        $("#frmW09F1921").find("#txtUserID").val(arr.UserID);
        $("#frmW09F1921").find("#txtDateLeft").val(arr.DateLeft);
        $("#frmW09F1921").find("#txtCompanyTelephone").val(arr.CompanyTelephone);
        $("#frmW09F1921").find("#slCountryID").val(arr.CountryID);
        $("#frmW09F1921").find("#slDepartmentID").val(arr.DepartmentID);
        $("#frmW09F1921").find("#slDutyID").val(arr.DutyID);
        $("#frmW09F1921").find("#slWorkID").val(arr.WorkID);
        $("#frmW09F1921").find("#slDirectManagerID").val(arr.DirectManagerID);
        if (arr.Sex==0)
            $("#frmW09F1921").find('#optSex0').prop('checked',true);
        else
            $("#frmW09F1921").find('#optSex1').prop('checked',true);
        if (arr.Disabled==1)
            $("#frmW09F1921").find('#chkDisabled').prop('checked',true);
        @endif

        $("#frmW09F1921").find("#txtEmployeeID").blur(function () {
            checktxtEmployeeID();
        });

        $("#frmW09F1921").find(".select2.required").select2({
            containerCssClass : "required"
        });

        $("#frmW09F1921").find(".select2.normal").select2();

        $('.input-group.date').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: 'vi',
            enableOnReadonly: false
        });

        setTimeout(function () {
            $("#frmW09F1921").find("#txtEmployeeID").focus();
        }, 500);

        $("#frmW09F1921").find('#chkDisabled').change(function() {
            if($(this).is(":checked")) {
                $("#frmW09F1921").find("#txtDateLeft").removeAttr('disabled');
                $("#frmW09F1921").find("#txtDateLeft").prop('required',true);
            }else{
                $("#frmW09F1921").find("#txtDateLeft").attr('disabled','disabled');
                $("#frmW09F1921").find("#txtDateLeft").prop('required',false);
            }
        });
        $("#frmW09F1921").find('#chkDisabled').trigger('change');
    });

    function checktxtEmployeeID() {
        var str = $("#frmW09F1921").find("#txtEmployeeID").val();
        var regex = /[^\w]/gi;

        if (regex.test(str) == true) {
            $("#modalW09F1921").find("#err").html('{{Helpers::getRS($g,'Ma_co_ky_tu_khong_hop_le')}}');
            $("#modalW09F1921").find(".alert-danger").removeClass('hide');
            //Set timeout for Firefox and IE
            setTimeout(function () {
                $("#modalW09F1921").find("#txtEmployeeID").focus();
            }, 10);
            return false;
        }
        $("#modalW09F1921").find(".alert-danger").addClass('hide');
        return true;
    }

    $('#btnChangePassW09F1921').on('click', function () {
        $.ajax({
            method: "GET",
            url: "{{asset("W00F0253/changepass/$id")}}",
            success: function (data) {
             $('#divPassW09F1921').html(data);
                $('#modalW00F0253').modal('show');
            }
        });
    });
</script>

