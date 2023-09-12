<div class="modal fade draggable" id="modalW76F4061" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading(Helpers::getRS($g,"Cap_nhat_tai_lieu"),"W76F4061",true,"closemodalW76F4061")}}
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="frmW76F4061">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 lbl-normal liketext">{{Helpers::getRS(4,"Chon_tap_tin")}}</label>
                            <div class="col-sm-6">
                                <input type="text" id="txtFileNameW76F4061" name="txtFileNameW76F4061" class="form-control" value="{{isset($rsData["FileName"])?$rsData["FileName"]:""}}" required readonly>
                            </div>
                            @if ($id == "")
                            <div class="col-sm-1 pdl0">
                                <button type="button" class="btn btn-default smallbtn" id="btnOpenFileW76F4061"><span class="fa fa-folder-open"></span></button>
                                <input type="file" name="fileW76F4061" id="fileW76F4061" class="hide">
                            </div>
                            @endif
                            <label class="col-sm-1 lbl-normal liketext">{{Helpers::getRS(4,"Do_lon")}}</label>
                            <label class="col-sm-2 liketext" id="lblFileSizeW76F4061"></label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 lbl-normal liketext">{{Helpers::getRS($g,"Dien_giai")}}</label>
                            <div class="col-sm-10">
                                <input type="text" id="txtDocDesc" name="txtDocDesc" class="form-control" value="{{isset($rsData["DocDesc"])?$rsData["DocDesc"]:""}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 lbl-normal liketext">{{Helpers::getRS($g,"Ngay")}}</label>
                            <div class="col-sm-3">
                                <div class="input-group date data_custom-picker">
                                    <input type="text" class="form-control" id="txtUploadedDate" name="txtUploadedDate" value="{{isset($rsData["UploadedDate"])?$rsData["UploadedDate"]:date("d/m/Y")}}">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                            <label class="col-sm-2 lbl-normal liketext">{{Helpers::getRS($g,"So_tham_chieu")}}</label>
                            <div class="col-sm-3">
                                <input type="text" id="txtRefNo" name="txtRefNo" class="form-control" value="{{isset($rsData["RefNo"])?$rsData["RefNo"]:""}}">
                            </div>
                            <div class="col-sm-2">
                                <div class="checkbox pdt5 {{$id==""?"hide":""}}">
                                    <label>
                                        <input type="checkbox" id="chkDisabled"
                                               name="chkDisabled" {{isset($rsData["Disabled"]) && $rsData["Disabled"]==1?"checked":""}}>{{Helpers::getRS($g,"Khong_su_dung")}}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 lbl-normal liketext">{{Helpers::getRS($g,"Nhom_tai_lieu")}}</label>
                            <div class="col-sm-3">
                                <select id="slDocCategoryID" name="slDocCategoryID" class="form-control" required>
                                    @foreach($rsCategory as $row)
                                        <option value="{{$row["DocCatID"]}}" {{isset($rsData["DocCategoryID"]) && $rsData["DocCategoryID"]==$row["DocCatID"]?"selected":""}}>{{$row["DocCategoryName"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 lbl-normal liketext">{{Helpers::getRS($g,"Ghi_chu")}}</label>
                            <div class="col-sm-7">
                                <textarea class="form-control" id="txtNotes" name="txtNotes" style="height: 100px">{{isset($rsData["Notes"])?$rsData["Notes"]:""}}</textarea>
                            </div>
                            <div class="col-md-3 col-xs-3">
                                <input id="fileThumbnailW76F4061" type="file" name="fileThumbnailW76F4061" accept="image/*" multiple class="hide">
                                <a>
                                    <div id="files" class="cls_thumbnail pull-right">
                                        <img id="imgThumnailAudioW76F4061" name="imgThumnailAudioW76F4061" src="{{isset($rsData["Thumbnail"])?$rsData["Thumbnail"]:""}}" alt=""
                                             height="100px" class="cls_thumbnail" style="width: 100%;min-width: 100%;max-width: 100%"/>
                                        <input type="hidden" id="hdThumbnailW76F4061" name="hdThumbnailW76F4061"  value="{{isset($rsData["Thumbnail"])?$rsData["Thumbnail"]:""}}"/>
                                    </div>
                                </a>
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
                            <button type="button" id="frm_btnSave"
                                    class="btn btn-default smallbtn pull-right mgr10" disabled><span
                                        class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                            </button>
                            <button type="button" id="frm_btnEdit" class="btn btn-default smallbtn pull-left mgr10 ">
                                <span class="glyphicon glyphicon-edit mgr5"></span> {{Helpers::getRS($g,"Sua")}}
                            </button>
                            <button type="button" id="frm_btnDelete" onclick="deleteW76F4061();"
                                    class="btn btn-default smallbtn pull-left confirmation-Delete">
                                <span class="glyphicon glyphicon-bin text-black mgr5"></span> {{Helpers::getRS($g,"Xoa")}}
                            </button>
                        @else
                            <button type="button" id="frm_btnNext" onclick="frmW76F4061Reset();"
                                    class="btn btn-default smallbtn pull-right" disabled>
                                <span class="glyphicon glyphicon-more-items mgr5"></span> {{Helpers::getRS($g,"Nhap_tiep")}}
                            </button>
                            <button type="button" id="frm_btnSave"
                                    class="btn btn-default smallbtn pull-right mgr10"><span
                                        class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                            </button>
                        @endif
                        <button type="submit" id="hfrm_btnSave" class="hide"></button>
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
    $('.data_custom-picker').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: "dd/mm/yyyy",
        language: 'vi'
    });
    $("#lblFileSizeW76F4061").text(formatBytes({{isset($rsData["FileSize"])?$rsData["FileSize"]:0}},1));

    $("#frmW76F4061").on('click', '#frm_btnSave', function () {
        frmW76F4061Save();
    });

    $("#frmW76F4061").on('click', '#frm_btnEdit', function () {
        $("#frm_btnCancel").removeAttr("disabled");
        $("#frm_btnSave").removeAttr("disabled");
        $("#frm_btnEdit").attr("disabled", "disabled");
        $("#frm_btnDelete").attr("disabled", "disabled");
    });

    $("#frmW76F4061").on('click', '#frm_btnCancel', function () {
        normalMode();
    });

    function normalMode() {
        $("#frm_btnCancel").attr("disabled", "disabled");
        $("#frm_btnSave").attr("disabled", "disabled");
        $("#frm_btnEdit").removeAttr("disabled");
        $("#frm_btnDelete").removeAttr("disabled");
    }

    function frmW76F4061Reset() {
        $('#frmW76F4061')[0].reset();
        $("#frm_btnSave").removeAttr("disabled");
        $("#frm_btnNext").attr("disabled", "disabled");
        $("#btnOpenFileW76F4061").focus();
        $("#modalW76F4061").find(".alert-success").addClass('hide');
        $("#modalW76F4061").find(".alert-danger").addClass('hide');
    }

    function frmW76F4061Save() {
        if (!$('#frmW76F4061')[0].checkValidity()) {
            $("#frmW76F4061").find("#hfrm_btnSave").click();
            return false;
        }
        var file = $("#frmW76F4061").find("#txtFileName");

        if (file.val() == "") {
            $("#modalW76F4061").find(".alert-danger").html('{{Helpers::getRS($g,'Ban_phai_chon')." ".Helpers::getRS($g,"Tap_tin")}}');
            $("#modalW76F4061").find(".alert-danger").removeClass('hide');
            $("#modalW76F4061").find(".alert-success").addClass('hide');
            $("#btnOpenFileW76F4061").focus();
            return false;
        }
        $("#frmW76F4061").find("#hfrm_btnSave").click();
    }

    $("#modalW76F4061").on('submit', '#frmW76F4061', function (e) {
        e.preventDefault();
        $("#frm_btnSave").attr("disabled", "disabled");
        $("#frm_btnCancel").attr("disabled", "disabled");
        var formData = new FormData($(this)[0]);
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            async: false,
            cache: false,
            contentType: false,
            enctype: 'multipart/form-data',
            processData: false,
            data: formData,
            success: function (data) {
                var result = $.parseJSON(data);
                if (result.code == 1) {
                    $("#modalW76F4061").find(".alert-danger").addClass('hide');
                    $("#modalW76F4061").find(".alert-success").removeClass('hide');
                    @if ($id == "")
                        update4ParamGrid($("#pqgrid_W76F4060"), result, "add");
                        $("#frm_btnNext").removeAttr("disabled");
                    @else
                        update4ParamGrid($("#pqgrid_W76F4060"), result, "edit");
                        normalMode();
                    @endif

                }else if(result.code == 0) {
                    $("#modalW76F4061").find(".alert-danger").html(result.mess);
                    $("#modalW76F4061").find(".alert-danger").removeClass('hide');
                    $("#modalW76F4061").find(".alert-success").addClass('hide');
                    $("#frm_btnSave").removeAttr("disabled");
                    $("#frm_btnCancel").removeAttr("disabled");
                }
            }
        });
    });

    function deleteW76F4061() {
        deleteW76F4060('{{$id}}');
        closemodalW76F4061();
    }

    $("#btnOpenFileW76F4061").on("click", function () {
        $("#modalW76F4061").find(".alert-danger").addClass('hide');
        $("#modalW76F4061").find(".alert-success").addClass('hide');
        $("#fileW76F4061").trigger('click');
    });

    $('#fileW76F4061').on("change", function (e) {
        if ((this.files[0].size/1024/1024) > 5){
            $("#modalW76F4061").find(".alert-danger").html('{{Helpers::getRS($g,'Upload_vuot_qua_dung_luong_cho_phep')." (5MB)"}}');
            $("#modalW76F4061").find(".alert-danger").removeClass('hide');
            $("#modalW76F4061").find(".alert-success").addClass('hide');
            $("#fileW76F4061").replaceWith($("#fileW76F4061").val('').clone(true));
            return;
        }
        if (!e.target.files) return;
        $("#txtFileNameW76F4061").val(e.target.files[0].name);
        $("#lblFileSizeW76F4061").text(formatBytes(e.target.files[0].size,1));
    });

    function closemodalW76F4061() {
        $("#modalW76F4061").modal("hide");
    }

    function clear_image(){
        $('#imgThumnailAudioW76F4061').attr('src', "");
        $('#hdThumbnailW76F4061').val("");
    }

    $(document).ready(function () {
        var holder = document.getElementById('files');
        holder.ondragover = function () {
            this.className = 'hover';
            return false;
        };
        holder.ondrop = function (e) {
            e.preventDefault();
            var file = e.dataTransfer.files[0];
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function (event) {
                $('#imgThumnailAudioW76F4061').attr('src', event.target.result);
                $('#hdThumbnailW76F4061').val(event.target.result);
            }
        };

        function choosse_W76F4061() {
            $("#fileThumbnailW76F4061").val("");
            $("#fileThumbnailW76F4061").trigger('click');
        }

        $("#files").on("click", function () {
            choosse_W76F4061();
        });

        function blob_to_data_URL(blob, callback) {
            var a = new FileReader();
            a.onload = function (e) {
                callback(e.target.result);
            };
            a.readAsDataURL(blob);
        }

        $('#fileThumbnailW76F4061').on("change", function (e) {
            if (!e.target.files) return;
            var files = e.target.files;
            var file = files[0];
            ImageTools.resize(file, {
                height: 98,
                width: 195
            }, function (blob, didItResize) {
                blob_to_data_URL(blob, function (dataurl_thumbnail) {
                    $('#imgThumnailAudioW76F4061').attr('src', dataurl_thumbnail);
                    $('#hdThumbnailW76F4061').val(dataurl_thumbnail);
                });
            });
        });

    });
</script>

