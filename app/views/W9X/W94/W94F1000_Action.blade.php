<div class="modal draggable fade modal" id="modalW94F1000" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="frmD94F1000" method="post" action="">
                <div class="modal-header">
                    {{Helpers::generateHeading(Helpers::getRS($g,'Cap_nhat_danh_muc_nhom_bao_cao_quan_tri'),"W94F1000")}}
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- column -->
                        <div class="col-md-12">
                            <!-- form start -->
                            <input type="hidden" value="{{$action}}" id="FormMode">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-left lbl-normal">{{Helpers::getRS($g,'Ma_nhom')}}</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control text-uppercase" name="txtReportGroupID"
                                               id="txtReportGroupID"
                                               value="{{ isset($row['ReportGroupID']) ? $row['ReportGroupID'] : '' }}"
                                               placeholder="" {{$action=='edit' ? 'disabled' : ''}} required>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id='chDisable' {{isset($row['Disabled']) && $row['Disabled']==1 ? "checked" : ""}} disabled>{{Helpers::getRS($g,'Khong_su_dung')}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-left lbl-normal">{{Helpers::getRS($g,'Ten_nhom')}}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="txtReportGroupName"
                                               name="txtReportGroupName"
                                               value="{{isset($row['ReportGroupName']) ? $row['ReportGroupName'] : ""}}"
                                               placeholder="" {{$cls}} required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-left lbl-normal">{{Helpers::getRS($g,'Nhom_truy_cap_DL')}}</label>
                                    <div class="col-sm-9">
                                        {{Form::select("slDAGroupID",$rsDAGroup,(isset($row['DAGroupID']) ? $row['DAGroupID'] : ""),["class" => "form-control", "id" => "slDAGroupID", ""])}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-left lbl-normal">{{Helpers::getRS($g,'Thu_tu_hien_thi')}}</label>

                                    <div class="col-sm-3 text-right">
                                        <input type="number" min="0" class="form-control" id="txtDisplayOrder"
                                               value="{{isset($row['DisplayOrder']) ? $row['DisplayOrder'] : ''}}"
                                               name="txtDisplayOrder" placeholder="" {{$cls}} required
                                                >
                                    </div>
                                    <div style="display: none">
                                        <label class="col-sm-3 control-label text-left lbl-normal">{{Helpers::getRS($g,'icon_hien_thi')}}
                                        </label>

                                        <div class="col-sm-3">
                                            <textarea class="form-control" rows="1" id="txtDisplayIcon"
                                                      name="txtDisplayIcon"
                                                      placeholder="" {{$cls}}>{{isset($row['DisplayIcon']) ? $row['DisplayIcon'] : ''}}</textarea>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                @if($action=="edit")
                                    <button type="button" id="frm_btnCancel"
                                            class="btn btn-default smallbtn pull-right {{$cls}}">
                                        <span class="glyphicon glyphicon-floppy-remove mgr5"></span> {{Helpers::getRS($g,"Khong_luu")}}
                                    </button>
                                    <button type="submit" id="frm_btnSave"
                                            class="btn btn-default smallbtn pull-right mgr10 {{$cls}}"><span
                                                class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                                    </button>
                                    <button type="button" id="frm_btnedit" class="btn btn-default smallbtn pull-left mgr10 ">
                                        <span class="glyphicon glyphicon-edit mgr5"></span> {{Helpers::getRS($g,"Sua")}}
                                    </button>
                                    @if(Session::get($pForm) >3)
                                        <button type="button" id="frm_btnDelete"
                                                class="btn btn-default smallbtn pull-left confirmation-Delete">
                                            <span class="glyphicon glyphicon-bin text-black mgr5"></span> {{Helpers::getRS($g,"Xoa")}}
                                        </button>
                                    @endif
                                @else
                                    <button type="button" id="frm_btnNext" onclick="frmD94F1000Reset();"
                                            class="btn btn-default smallbtn pull-right {{$cls}} disabled">
                                        <span class="glyphicon glyphicon-more-items mgr5"></span> {{Helpers::getRS($g,"Nhap_tiep")}}
                                    </button>
                                    <button type="button" id="frm_btnSave" onclick="frmSave();"
                                            class="btn btn-default smallbtn pull-right mgr10 {{$cls}}"><span
                                                class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                                    </button>
                                    <button type="submit" id="hfrm_btnSave" class="hide">
                                    </button>
                                @endif
                            </div>

                        </div>
                        <!--/.col -->
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="alert alert-success alert-dismissable hide">
                        <i class="icon fa fa-check"></i> {{Helpers::getRS($g,"Du_lieu_da_duoc_luu_thanh_cong")}}
                    </div>
                    <div class="alert alert-danger alert-dismissable hide">
                        <i class="icon fa fa-ban"></i> <span id="err">{{Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu")}}
                            !</span>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->

    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    var currentObject;
    var disabled;
    function frmD94F1000Reset() {
        $('#frmD94F1000')[0].reset();
        $("#frm_btnSave").removeClass('disabled');
        $("#frm_btnNext").addClass('disabled');
        $("#txtReportGroupID").focus();
        $("#frmD94F1000").find(".alert-success").addClass('hide');
        $("#frmD94F1000").find(".alert-danger").addClass('hide');
    }

    function frmSave() {
        if (checktxtReportGroupID()) {
            $('#hfrm_btnSave').click();
        }
    }

    $('.confirmation-Delete').confirmation({
        placement: 'right',
        title: "{{Helpers::getRS($g,"Ban_co_muon_xoa_du_lieu_nay_khong")}}",
        onConfirm: function () {
            $.ajax({
                method: "POST",
                url: "{{url("W94F1000/".$pForm."/delete")}}/" + $("#txtReportGroupID").val(),
                success: function (data) {
                    if (data == 1) {
                        $("#modalW94F1000").modal('hide');
                        update4ParamGrid($(document).find("#pqgrid_W94F1000"), null, 'delete');
                    }
                    else if (data == 2) {
                        $("#frmD94F1000").find("#err").html('{{Helpers::getRS($g,'Ma_nay_da_duoc_su_dung_Ban_khong_the_xoa')}}');
                        $("#frmD94F1000").find(".alert-danger").removeClass('hide');
                    }
                    else {
                        $("#frmD94F1000").find("#err").html('{{Helpers::getRS($g,'Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu')}}');
                        $("#frmD94F1000").find(".alert-danger").removeClass('hide');
                    }
                }
            });
        },
        onCancel: function () {
        }
    });

    $(document).ready(function () {
        $("#hdSaveOKW94F1000").val(0);
        currentObject = {{json_encode($row)}};
        if (currentObject.Disabled == "0") {
            disabled = "";
        } else {
            disabled = "checked";
        }

        $("#frmD94F1000").on('click', '#frm_btnedit', function () {
            ActionMode();
        });

        $("#frmD94F1000").on('click', '#frm_btnCancel', function () {
            @if($action=="edit")  // nếu là edit
            NormalMode();
            setFormValue();
            @endif
        });

        $("#frmD94F1000").on('click', ".close", function () {
            NormalMode();
        });

        $("#modalW94F1000").on('submit', '#frmD94F1000', function (e) {
            {{--console.log("{{$action}}");--}}
            e.preventDefault();
            $.ajax({
                method: "POST",
                url: "{{url("W94F1000/".$pForm."/$action/" . (isset($row['ReportGroupID']) ? $row['ReportGroupID'] : ''))}}",
                data: $("#frmD94F1000").serialize() + '&chDisable=' + $("#chDisable").is(":checked")+"&sDAGroupName="+$("#slDAGroupID option:selected").text(),
                success: function (data) {
                    @if($action=="edit") // chỉnh
                        $("#frmD94F1000").find(".alert-success").removeClass('hide');
                        $("#hdSaveOKW94F1000").val(1);
                        currentObject = $.parseJSON(data);
                        NormalMode();
                        setFormValue();
                        update4ParamGrid($(document).find("#pqgrid_W94F1000"), currentObject, 'edit');


                    @else  //  thêm mới

                        if (data != -1 && data != 0) {
                            $("#frm_btnSave").addClass('disabled');
                            $("#frm_btnNext").removeClass('disabled');
                            $("#frmD94F1000").find(".alert-success").removeClass('hide');
                            $("#frmD94F1000").find(".alert-danger").addClass('hide');
                            currentObject = $.parseJSON(data);
                            update4ParamGrid($(document).find("#pqgrid_W94F1000"), currentObject, 'add');
                        }
                        else {
                            if (data == -1) {
                                $("#frmD94F1000").find("#err").html('{{Helpers::getRS($g,'Ma_nay_da_ton_tai')}}');
                                $("#txtReportGroupID").focus();
                            }
                            if (data == 0) $("#frmD94F1000").find("#err").html('{{Helpers::getRS($g,'Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu')}}')
                            $("#frmD94F1000").find(".alert-success").addClass('hide');
                            $("#frmD94F1000").find(".alert-danger").removeClass('hide');
                        }
                    @endif
                }
            });
        });

        $("#frmD94F1000").find("#txtReportGroupID").blur(function () {
            checktxtReportGroupID();
        });

    });

    function checktxtReportGroupID() {
        var str = $("#frmD94F1000").find("#txtReportGroupID").val();
        var regex = /[^\w]/gi;

        if (regex.test(str) == true) {
            $("#frmD94F1000").find("#err").html('{{Helpers::getRS($g,'Ma_co_ky_tu_khong_hop_le')}}');
            $("#frmD94F1000").find(".alert-danger").removeClass('hide');
            //Set timeout for Firefox and IE
            setTimeout(function () {
                $("#txtReportGroupID").focus();
            }, 10);
            return false;
        }
        $("#frmD94F1000").find(".alert-danger").addClass('hide');
        return true;
    }

    function setFormValue() {
        if (currentObject.Disabled == 0)
            $("#frmD94F1000").find("#chDisable").prop('checked', false);
        else
            $("#frmD94F1000").find("#chDisable").prop('checked', true);
        $("#frmD94F1000").find("#txtReportGroupName").val(currentObject.ReportGroupName);
        $("#frmD94F1000").find("#txtDisplayOrder").val(currentObject.DisplayOrder);
    }

    function ActionMode() {
        $("#frmD94F1000").find("#frm_btnedit").addClass('disabled');
        @if(Session::get($pForm)>3)
        $("#frmD94F1000").find("#frm_btnDelete").addClass('disabled');
        @endif
        $("#frmD94F1000").find("#frm_btnCancel").removeClass('disabled');
        $("#frmD94F1000").find("#frm_btnSave").removeClass('disabled');

        $("#frmD94F1000").find("#chDisable").removeAttr('disabled');
        $("#frmD94F1000").find("#txtReportGroupName").removeAttr('disabled');
        $("#frmD94F1000").find("#txtDisplayOrder").removeAttr('disabled');
        $("#frmD94F1000").find(".alert-success").addClass('hide');
        $("#frmD94F1000").find("#txtDisplayIcon").removeAttr('disabled');
        $("#frmD94F1000").find(".alert-success").addClass('hide');
    }

    function NormalMode() {
        $("#frmD94F1000").find("#frm_btnedit").removeClass('disabled');
        @if(Session::get($pForm)>3)
        $("#frmD94F1000").find("#frm_btnDelete").removeClass('disabled');
        @endif
        $("#frmD94F1000").find("#frm_btnCancel").addClass('disabled');
        $("#frmD94F1000").find("#frm_btnSave").addClass('disabled');
        $("#frmD94F1000").find("#chDisable").attr('disabled', 'disabled');
        $("#frmD94F1000").find("#txtReportGroupName").attr('disabled', 'disabled');
        $("#frmD94F1000").find("#txtDisplayOrder").attr('disabled', 'disabled');
        $("#frmD94F1000").find("#txtDisplayIcon").removeAttr('disabled', 'disabled');
    }
</script>
