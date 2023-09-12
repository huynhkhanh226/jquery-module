<div class="modal fade draggable" id="modalW76F2070" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading(Helpers::getRS($g,"Cap_nhat_nhom_tai_lieu"),"W76F2070")}}
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="frmW76F2070">
                    <div class="box-body">
                        <div class="col-sm-12 mgt5">
                            <div class="form-group">
                                <label class="col-sm-3">{{Helpers::getRS(4,"Ma_nhom_tai_lieu")}}</label>
                                <div class="col-sm-6">
                                    <input type="text" id="txtDocCategoryID" name="txtDocCategoryID" class="form-control text-uppercase" value="{{isset($rsData["DocCategoryID"])?$rsData["DocCategoryID"]:""}}"
                                           {{$id!=""?"readonly":""}} required>
                                </div>
                                <div class="col-sm-3">
                                    <div class="checkbox pdt5 {{$id==""?"hide":""}}">
                                        <label>
                                            <input type="checkbox" id="chkDisabled" name="chkDisabled" {{isset($rsData["Disabled"]) && $rsData["Disabled"]==1?"checked":""}}>{{Helpers::getRS($g,"Khong_su_dung")}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">{{Helpers::getRS($g,"Ten_nhom_tai_lieu")}}</label>
                                <div class="col-sm-9">
                                    <input type="text" id="txtDocCategoryName" name="txtDocCategoryName" class="form-control" value="{{isset($rsData["DocCategoryName"])?$rsData["DocCategoryName"]:""}}" required>
                                </div>
                            </div>
                        </div>
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
                            <button type="button" id="frm_btnEdit" class="btn btn-default smallbtn pull-left mgr10 ">
                                <span class="glyphicon glyphicon-edit mgr5"></span> {{Helpers::getRS($g,"Sua")}}
                            </button>
                            @if($permission >3)
                                <button type="button" id="frm_btnDelete" onclick="deleteW76F2070('{{$id}}');"
                                        class="btn btn-default smallbtn pull-left confirmation-Delete">
                                    <span class="glyphicon glyphicon-bin text-black mgr5"></span> {{Helpers::getRS($g,"Xoa")}}
                                </button>
                            @endif
                        @else
                            <button type="button" id="frm_btnNext" onclick="frmW76F2070Reset();"
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
            </div>
            <div class="modal-footer">
                <div class="alert alert-success alert-dismissable hide">
                    <i class="icon fa fa-check"></i> {{Helpers::getRS($g,"Du_lieu_da_duoc_luu_thanh_cong")}}
                </div>
                <div class="alert alert-danger alert-dismissable hide">
                    <i class="icon fa fa-ban"></i> <span id="err">{{Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu")}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#frmW76F2070").on('click', '#frm_btnEdit', function () {
        $("#frmW76F2070").find("#frm_btnCancel").removeAttr("disabled");
        $("#frmW76F2070").find("#frm_btnSave").removeAttr("disabled");
        $("#frmW76F2070").find("#frm_btnEdit").attr("disabled", "disabled");
        $("#frmW76F2070").find("#frm_btnDelete").attr("disabled", "disabled");
    });

    $("#frmW76F2070").on('click', '#frm_btnCancel', function () {
        normalMode();
    });

    function normalMode() {
        $("#frmW76F2070").find("#frm_btnCancel").attr("disabled", "disabled");
        $("#frmW76F2070").find("#frm_btnSave").attr("disabled", "disabled");
        $("#frmW76F2070").find("#frm_btnEdit").removeAttr("disabled");
        $("#frmW76F2070").find("#frm_btnDelete").removeAttr("disabled");
    }

    function frmW76F2070Reset() {
        $('#frmW76F2070')[0].reset();
        $("#frm_btnSave").removeAttr("disabled");
        $("#frm_btnNext").attr("disabled", "disabled");
        $("#txtDocCategoryID").focus();
        $("#modalW76F2070").find(".alert-success").addClass('hide');
        $("#modalW76F2070").find(".alert-danger").addClass('hide');
        $("#frmW76F2070").find(".fa-check").addClass("hide");
    }

    $("#modalW76F2070").on('submit', '#frmW76F2070', function (e) {
        e.preventDefault();
        $("#frmW76F2070").find("#frm_btnSave").attr("disabled", "disabled");
        $("#frmW76F2070").find("#frm_btnCancel").attr("disabled", "disabled");
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: $("#frmW76F2070").serialize(),
            success: function (data) {
                var result = $.parseJSON(data);
                if (result.code == 1) {
                    $("#modalW76F2070").find(".alert-danger").addClass('hide');
                    $("#modalW76F2070").find(".alert-success").removeClass('hide');
                    @if ($id == "")
                        update4ParamGrid($("#pqgrid_W76F2070"), result, "add");
                        $("#frm_btnNext").removeAttr("disabled");
                    @else
                        update4ParamGrid($("#pqgrid_W76F2070"), result, "edit");
                        normalMode();
                    @endif
                } else if (result.code == 0) {
                    $("#modalW76F2070").find(".alert-danger").html(result.mess);
                    $("#modalW76F2070").find(".alert-danger").removeClass('hide');
                    $("#modalW76F2070").find(".alert-success").addClass('hide');
                    $("#frm_btnSave").removeAttr("disabled");
                    $("#frm_btnCancel").removeAttr("disabled");
                    $("#txtDocCategoryID").focus();
                }
            }
        });
    });

    $(function() {
        $("#frmW76F2070").find("#txtDocCategoryID").blur(function () {
            checktxtReportGroupID();
        });
    });

    function checktxtReportGroupID() {
        var str = $("#frmW76F2070").find("#txtDocCategoryID").val();
        var regex = /[^\w]/gi;

        if (regex.test(str) == true) {
            $("#modalW76F2070").find("#err").html('{{Helpers::getRS($g,'Ma_co_ky_tu_khong_hop_le')}}');
            $("#modalW76F2070").find(".alert-danger").removeClass('hide');
            //Set timeout for Firefox and IE
            setTimeout(function () {
                $("#txtDocCategoryID").focus();
            }, 10);
            return false;
        }
        $("#modalW76F2070").find(".alert-danger").addClass('hide');
        return true;
    }

</script>

