<div class="modal fade pd0" id="modalW84F1200" data-backdrop="static" role="dialog">
    <div class="modal-dialog  modal-md formduyet ">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading($modalTitle,"W84F1200")}}
            </div>
            <div class="modal-body">
                <div class="row" id="W84F1200DT">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="liketext">
                                    <label class="mgr15"><i
                                                class="fa fa-calendar mgr5"></i><b>{{date("d/m/Y")}} </b></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="liketext">
                                    <label class="mgr5">{{Helpers::getRS($g,"Nguoi_lap")}}</label>
                                    <label class="mgr10" id="CreateUserName"></label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="liketext">
                                    <label class="pull-right">{{Helpers::getRS($g,"Quy_trinh_duyet")}}</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="liketext">
                                    <select class="form-control" disabled="true" id="Transaction" required>
                                        <option value=""></option>
                                        @foreach($transaction as $t)
                                            <option value="{{$t['TransactionID']}}">{{$t['TransactionName']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="liketext">
                                    <label>{{Helpers::getRS($g,'Nguoi_uy_quyen')}}</label>
                                </div>
                            </div>
                            <div class="col-md-2 pdr0">
                                <div class="liketext">
                                    <div id="divAuthorizeUser">
                                        <input type="text" class="form-control" id="txtAuthorizeUserID" name="txtAuthorizeUserID" value="" autocomplete="off" required readonly>
                                        <span class="input-group-addon pointer hide" onclick="showListPerson('Authorize','mPopUpListAuthorize')"><i class="glyphicon glyphicon-user_add"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 pdr0">
                                <div class="liketext">
                                    <input type="text" class="form-control" id="txtAuthorizeUserName" name="txtAuthorizeUserName" readonly/>
                                </div>
                            </div>
                            <div class="col-md-2 pdr0">
                                <div class="liketext">
                                    <input type="text" class="form-control" id="txtAuthorizeUserDepartment" name="txtAuthorizeUserDepartment" readonly/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="liketext">
                                    <input type="text" class="form-control" id="txtAuthorizeUserRole" name="txtAuthorizeUserRole" readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="liketext">
                                    <label>{{Helpers::getRS($g,'Nguoi_duoc_uy_quyen')}}</label>
                                </div>
                            </div>
                            <div class="col-md-2 pdr0">
                                <div class="liketext">
                                    <div id="divAuthorizedUser">
                                        <input type="text" class="form-control" id="txtAuthorizedUserID" name="txtAuthorizedUserID" value="" autocomplete="off" required readonly>
                                        <span class="input-group-addon pointer hide" onclick="showListPerson('Authorized','mPopUpListAuthorize')"><i class="glyphicon glyphicon-user_add"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 pdr0">
                                <div class="liketext">
                                    <input type="text" class="form-control" id="txtAuthorizedUserName" name="txtAuthorizedUserName" readonly/>
                                </div>
                            </div>
                            <div class="col-md-2 pdr0">
                                <div class="liketext">
                                    <input type="text" class="form-control" id="txtAuthorizedUserDepartment" name="txtAuthorizedUserDepartment" readonly/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="liketext">
                                    <input type="text" class="form-control" id="txtAuthorizedUserRole" name="txtAuthorizedUserRole" readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="liketext">
                                    <label>{{Helpers::getRS($g,"Hieu_luc")}}</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="liketext">
                                    <div class="row">
                                        <div class="col-md-5" style="padding-right: 7px"><input type="text" class="form-control pull-right"
                                                                     id="fromtime" name="fromtime" readonly/></div>
                                        <div class="col-md-1">-</div>
                                        <div class="col-md-5 pdl0"><input type="text" class="form-control pull-left"
                                                                     id="totime" name="totime" readonly/></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="liketext">
                                    <label id="lblApstatus">{{Helpers::getRS($g,"Trang_thai")}}</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="liketext">
                                    <label id="lb_apstatus"><b></b></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="liketext">
                                    <label>{{Helpers::getRS($g,"Ghi_chu")}}</label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="liketext">
                                    <input type="text" class="form-control" id="txtreason" value="" readonly/>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="frm_btnCancel"
                                        class="btn btn-default smallbtn pull-right confirmation-NotApproval disabled"><span
                                            class="glyphicon glyphicon-floppy-remove mgr5"></span> {{Helpers::getRS($g,"Khong_luu")}}
                                </button>
                                <button type="button" onclick="SaveAuthorize()" id="frm_btnSave"
                                        class="btn btn-default smallbtn pull-right mgr10 disabled"><span
                                            class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                                </button>
                                <button type="button" id="frm_btadd" onclick="addVoucher(this)"
                                        class="btn btn-default smallbtn pull-left mgr10 "><span
                                            class="glyphicon glyphicon-plus mgr5"></span> {{Helpers::getRS($g,"Them_moi1")}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mgt10" id="W84F1200GRD">
                    </div>
                </div>
            </div>

            <div class="l3loading">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- begin danh sach nguoi uy quyen -->
<div class="modal draggable fade" id="mPopUpListAuthorize" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 860px;">
        <div class="modal-content">
            <form class="form-horizontal" id="frmmPopUpListAuthorize" action="">
                <div class="modal-header">
                    {{Helpers::generateHeading(Helpers::getRS($g,'Danh_sach_nguoi_dungU'),"",false,"closePopListAuthorize")}}
                </div>
                <div class="modal-body">

                </div>

            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
    var closePopListAuthorize = function () {
        $("#mPopUpListAuthorize").modal('hide');
    };
</script>
<!-- end danh sach nguoi uy quyen -->

<!-- begin huy uy quyen -->
<div class="modal fade" id="mPopUpCancelAuthorize" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 600px;">
        <div class="modal-content">
            <form class="form-horizontal" id="frmmPopUpListAuthorize" action="">
                <div class="modal-header">
                    {{Helpers::generateHeading(Helpers::getRS($g,'Huy_uy_quyen'),"",false,"closeCancelAuthorize")}}
                </div>
                <div class="modal-body">

                </div>

            </form>
            <div class="l3loading W84F1200loading">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
    var closeCancelAuthorize = function () {
        $("#mPopUpCancelAuthorize").modal('hide');
    };
    var closePopListAuthorize = function () {
        $("#mPopUpListAuthorize").modal('hide');
    };
    var mod = 0;
    var startDate;
    var endDate;
    var oldvouid = -1;
    var numline = 5;
    var addTableW84F1200 = function () {
        $(".modalW84F1200").find(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: {numline: numline},
            success: function (data) {
                $("#W84F1200GRD").html(data);
                $(".modalW84F1200").find(".l3loading").addClass('hide');
            }
        });
    };
    $(document).ready(function () {
        var h = $("#modalW84F1200 .modal-content").height() - 255; // gồm $("#modalW84F1200 .modal-header").height(): 44px và $("#W84F1200DT").height(): 209px
        $("#W84F1200GRD").height(h);
        numline = Math.round(h / 72);
        addTableW84F1200();
    });

    $('.confirmation-NotApproval').confirmation({
        placement: 'left',
        btnOkLabel: '{{Helpers::getRS($g,'Dong_y')}}',
        btnCancelLabel: '{{Helpers::getRS($g,'Huy')}}',
        title: "{{Helpers::getRS($g,"Ban_co_muon_khong_luu_du_lieu_nay_khong")}}",
        onConfirm: function () {
            ShowMaster(oldvouid);
            $("#modalW84F1200 #frm_btadd").removeClass('disabled');
            $("#modalW84F1200 #frm_btnSave").addClass('disabled');
            $("#modalW84F1200 #frm_btnCancel").addClass('disabled');
            $("#divAuthorizeUser").removeClass('input-group');
            $("#divAuthorizedUser").removeClass('input-group');
            $("#divAuthorizeUser>span").addClass('hide');
            $("#divAuthorizedUser>span").addClass('hide');
            $("#lblApstatus").show();
            $("#pqgrid_W84F1200").pqGrid("enable");
        },
        onCancel: function () {
        }
    });
    var ShowMaster = function (vouid) {
        oldvouid = vouid;
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}/1/" + vouid,
            dataType: 'json',
            success: function (data) {
                $("#CreateUserName").val(data.CreateUserName);
                $("#txtAuthorizeUserID").val(data.AuthorizeUserID);
                $("#txtAuthorizeUserName").val(data.AuthorizeUserName);
                $("#txtAuthorizeUserDepartment").val(data.AuthorizeUserDepartment);
                $("#txtAuthorizeUserRole").val(data.AuthorizeUserRole);
                $("#txtAuthorizedUserID").val(data.AuthorizedUserID);
                $("#txtAuthorizedUserName").val(data.AuthorizedUserName);
                $("#txtAuthorizedUserDepartment").val(data.AuthorizedUserDepartment);
                $("#txtAuthorizedUserRole").val(data.AuthorizedUserRole);
                $("#lb_apstatus").html("<b>" + data.VoucherStatus + "</b>");
                $("#txtreason").val(data.NotesU);
                $("#Transaction").val(data.TransactionID);
                $('#fromtime').val(data.ValidTimeFrom);
                $('#totime').val(data.ValidTimeTo);
            }
        });
    };
    var addVoucher = function (el) {
        mod = 0;
        endDate = undefined;

        $(el).addClass('disabled');
        $("#modalW84F1200 #frm_btnSave").removeClass('disabled');
        $("#modalW84F1200 #frm_btnCancel").removeClass('disabled');
        $("#pqgrid_W84F1200").pqGrid("disable");
        @if($pForm=='D84F1200')
        {
            $("#divAuthorizeUser").addClass('input-group');
            $("#divAuthorizeUser>span").removeClass('hide');
        }
        @endif
        {
            $("#divAuthorizedUser").addClass('input-group');
            $("#divAuthorizedUser>span").removeClass('hide');
        }

        $("#lblApstatus").hide();
        $("#Transaction").prop("disabled", false);
        $("#Transaction").val("");
        $("#modalW84F1200 #txtreason").prop("readonly", false);
        $("#lb_apstatus").html("");
        $("#txtreason").val("");
        $('#reservationtime').val("");
        $('#fromtime').val("");
        $('#fromtime').daterangepicker({
                    timePicker: true,
                    singleDatePicker: true,
                    timePickerIncrement: 1,
                    format: 'DD/MM/YYYY HH:mm',
                    language: 'vi',
                    minDate: new Date(),
                    use24hours: true
                },
                function (start) {
                    startDate = start.format('MM/DD/YYYY HH:mm:ss');

                });

        $('#totime').val("");
        $('#totime').daterangepicker({
                    timePicker: true,
                    singleDatePicker: true,
                    timePickerIncrement: 1,
                    format: 'DD/MM/YYYY HH:mm',
                    language: 'vi',
                    minDate: new Date(),
                    use24hours: true,
                    locale: {
                        cancelLabel: '{{Helpers::getRS($g,"Xoa")}}'
                    }
                },
                function (start) {
                    endDate = start.format('MM/DD/YYYY HH:mm:ss');

                });
        $('#totime').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
            endDate = undefined;
        });
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}/0",
            dataType: 'json',
            success: function (data) {
                $("#CreateUserName").val(data.CreateUserName);
                $("#txtAuthorizeUserID").val(data.AuthorizeUserID);
                $("#txtAuthorizeUserName").val(data.AuthorizeUserName);
                $("#txtAuthorizeUserDepartment").val(data.AuthorizeUserDepartment);
                $("#txtAuthorizeUserRole").val(data.AuthorizeUserRole);
                $("#txtAuthorizedUserID").val(data.AuthorizedUserID);
                $("#txtAuthorizedUserName").val(data.AuthorizedUserName);
                $("#txtAuthorizedUserDepartment").val(data.AuthorizedUserDepartment);
                $("#txtAuthorizedUserRole").val(data.AuthorizedUserRole);
            }
        });
    };
    var showListPerson = function (type, modid) {
        $.ajax({
            method: "POST",
            url: "{{url("W84F1200/" . $pForm ."/listperson/")}}/" + type + "/" + mod,
            success: function (data) {
                $("#" + modid + " .modal-body").html(data);
                $("#" + modid).modal('show');
            }
        });
    };

    $("#mPopUpListAuthorize").on('shown.bs.modal', function() {
        setTimeout(function(){
            $("#pqgrid_W84P1201").pqGrid("refreshDataAndView");
        }, 500);
        $("#pqgrid_W84P1201").pqGrid("refreshDataAndView");
    });

    var setTextAuthorize = function (arr, type) {
        if (type == 'Authorize') {
            $("#txtAuthorizeUserID").val(arr["UserID"]);
            $("#txtAuthorizeUserName").val(arr["UserName"]);
            $("#txtAuthorizeUserDepartment").val(arr["UserDepartment"]);
            $("#txtAuthorizeUserRole").val(arr["UserRole"]);
        }
        else {
            $("#txtAuthorizedUserID").val(arr["UserID"]);
            $("#txtAuthorizedUserName").val(arr["UserName"]);
            $("#txtAuthorizedUserDepartment").val(arr["UserDepartment"]);
            $("#txtAuthorizedUserRole").val(arr["UserRole"]);
        }
    };
    var CancelAuthorized = function (mod, vou) {
        //Nếu đang thêm mới thì ko cho hủy
        if ($("#modalW84F1200").find("#frm_btnSave").hasClass("disabled") == false)
            return false;
        $.ajax({
            method: "GET",
            url: "{{url("W84F1200/" . $pForm ."/cancelauthorize/")}}/" + mod + "/" + vou,
            success: function (data) {
                $("#mPopUpCancelAuthorize .modal-body").html(data);
                $("#mPopUpCancelAuthorize").modal('show');
            }
        });
    };
    var showBB = function (msg) {
        alert_warning(msg);
    }
    var SaveAuthorize = function () {
        var tranid = $("#Transaction").val();
        var authorizeid = $("#txtAuthorizeUserID").val();
        var authorizedid = $("#txtAuthorizedUserID").val();
        var tranid = $("#Transaction").val();
        var error = false;

        if (tranid == "") {
            showBB('{{Helpers::getRS($g,"Ban_chua_chon_quy_trinh_duyet")}}');
            return false;
        }

        if ($("#modalW84F1200 #txtAuthorizedUserID").val() == "") {
            showBB('{{Helpers::getRS($g,"Ban_chua_chon_nguoi_duoc_uy_quyen")}}');
            return false;
        }
        if ($("#fromtime").val() == "") {
            showBB('{{Helpers::getRS($g,"Ban_chua_chon_ngay_bat_dau_hieu_luc")}}');
            return false;
        }
        $(".W84F1200loading").removeClass('hide');

        $.ajax({
            method: "POST",
            url: "{{url("W84F1200/" . $pForm ."/saveauthorize/")}}/" + mod,
            data: {
                tranid: tranid,
                authorizeid: authorizeid,
                authorizedid: authorizedid,
                creatorid: '{{Session::get("W91P0000")['Creator']}}',
                startDate: startDate,
                endDate: endDate,
                NotesU: $("#txtreason").val()
            },
            success: function (result) {
                if (result == 1) {
                    save_ok();

                    $("#modalW84F1200 #frm_btadd").removeClass('disabled');
                    $("#modalW84F1200 #frm_btnSave").addClass('disabled');
                    $("#modalW84F1200 #frm_btnCancel").addClass('disabled');
                    $("#pqgrid_W84F1200").pqGrid("enable");
                    $("#divAuthorizeUser").removeClass('input-group');
                    $("#divAuthorizedUser").removeClass('input-group');
                    $("#divAuthorizeUser>span").addClass('hide');
                    $("#divAuthorizedUser>span").addClass('hide');
                    $("#Transaction").prop("disabled", true);
                    $("#modalW84F1200 #txtreason").prop("readonly", true);
                    $("#lblApstatus").show();
                    $(".no-menu-alert").load("{{url("/alert")}}");
                    addTableW84F1200();
                    $(".W84F1200loading").addClass('hide');
                }
                else {
                    $(".W84F1200loading").addClass('hide');
                   // alert(result);
                    alert_error(result);
                }

            }
        });
    }
</script>

