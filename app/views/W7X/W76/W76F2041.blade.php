<div class="modal fade draggable" id="modalAudioDetail" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width:75%;">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($caption,"W76F2041", true, "close_W76F2041")}}
            </div>
            <div class="modal-body" style="padding:10px">
                <form class="form-horizontal" id="frmW76F2041">
                    <div class="row">
                        <div class="col-md-9 col-xs-9 pdr0">
                            <div class="row form-group">
                                <div class="col-md-2 col-xs-2">
                                    <div class="liketext">
                                        <label class="lbl-normal ">{{Helpers::getRS($g,"Ten_album")}}</label>
                                    </div>
                                </div>
                                <div class="col-md-7 col-xs-7">
                                    <input class="form-control" type="text" id="txtAlbumNameW76F2041" name="txtAlbumNameW76F2041"
                                           value="{{isset($rsData["AlbumName"])?$rsData["AlbumName"]:""}}" required>
                                </div>
                                <div class="col-md-3 col-xs-3">
                                    <div class="input-group date">
                                        <input type="text" class="form-control" id="txtAlbumDateW76F2041"
                                               name="txtAlbumDateW76F2041" value="{{isset($rsData["AlbumDate"])?$rsData["AlbumDate"]:date('d/m/Y')}}" required>
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 col-xs-2">
                                    <div class="liketext">
                                        <label class="lbl-normal ">{{Helpers::getRS($g,"Thu_muc")}}</label>
                                    </div>
                                </div>
                                <div class="col-md-7 col-xs-7">
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12 input-group" style="padding-left: 15px;padding-right: 15px">
                                            <input type="text" class="form-control" value="{{isset($rsData["FilePath"])?$rsData["FilePath"]:""}}" name="txtFilePathW76F2041" id="txtFilePathW76F2041" ondragstart="return false" draggable="false" required>
                                            @if ($id=="")
                                                <span class="input-group-btn">
                                            <button type="button" class="btn btn-info btnFolderW76F2041" onclick="showFolder();" style="padding: 2px 12px !important;">
                                                <span class="fa fa-folder-open-o" aria-hidden="true"></span>
                                            </button>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>                               
                                <div class="col-md-3 col-xs-3">
                                    <div id="idDisableW76F2041" class="checkbox {{$id == ""?"hide":""}}" style="margin-top: -4px;padding-left:21px">
                                        <input type="checkbox" id="chkDisabledW76F2041" name="chkDisabledW76F2041" {{isset($rsData["Disabled"]) && $rsData["Disabled"] == 1?"checked":""}}/>
                                        {{Helpers::getRS($g,"Khong_su_dung")}}
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 col-xs-2">
                                    <div class="liketext">
                                        <label class="lbl-normal ">{{Helpers::getRS($g,"Ghi_chu")}}</label>
                                    </div>
                                </div>
                                <div class="col-md-10 col-xs-10">
                                    <input class="form-control" type="text" id="txtRemarkW76F2041" name="txtRemarkW76F2041" value="{{isset($rsData["Remark"])?$rsData["Remark"]:""}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-3">
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <input id="fileThumbnailW76F2041" type="file" name="fileThumbnailW76F2041" accept="image/*" multiple class="hide">
                                    <a>
                                        <div id="files" class="cls_thumbnail pull-right" style="">
                                            <img id="imgThumnailAudioW76F2041" name="imgThumnailAudioW76F2041" src="{{isset($rsData["Thumbnail"])?$rsData["Thumbnail"]:""}}" alt=""
                                                 width="185px" height="100px" class="cls_thumbnail" />
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-xs-12 ">
                                    <a title='{{Helpers::getRS($g,"Xoa")}}' id='btnDeleteW75F2021' class="pull-right"><i
                                                class='fa fa-trash' style='padding-right:5px;font-size: 110%' onclick="clear_image();"></i></a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 col-xs-9">
                            <button type="button" ID="btnAddAudioW76F2041" class="btn btn-default smallbtn pull-left" onclick="callW75F2021_AddAudio();">
                                <span class="glyphicon glyphicon-plus mgr5"></span>{{Helpers::getRS($g,"Them_audio")}}
                            </button>
                        </div>
                        <div class="col-md-3 col-xs-3" style="padding-right: 5px;">
                            <div class="pull-right">
                                <button type="submit" id="btnsaveW76F2041" style="margin-left:-20px;margin-top:-1px;padding-top:2px;padding-bottom: 3px;" class="btn btn-default smallbtn pull-left mgr10 confirmation-save">
                                    <span class="glyphicon glyphicon-floppy-saved mgr5"></span>{{Helpers::getRS($g,"Luu")}}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col-md-12 col-xs-12">
                            <div id="divW76F2041"></div>
                        </div>
                    </div>
                    <input type="hidden" id="hdAlbumIDW76F2041" name="hdAlbumIDW76F2041"  value="{{isset($rsData["AlbumID"])?$rsData["AlbumID"]:""}}"/>
                    <input type="hidden" id="hdThumbnailW76F2041" name="hdThumbnailW76F2041"  value="{{isset($rsData["Thumbnail"])?$rsData["Thumbnail"]:""}}"/>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="divAddAudioW76F2041"></div>
<section id="secW76F2041_Folder"></section>
<script>
    function close_W76F2041() {
        $("#modalAudioDetail").modal('hide');
    }

    function clear_image(){
        $('#imgThumnailAudioW76F2041').attr('src', "");
        $('#hdThumbnailW76F2041').val("");
    }

    $(document).ready(function () {
        $("#txtFilePathW76F2041").keypress(function (event) {
            if(event.ctrlKey && event.charCode == 99)
                return true;
            event.preventDefault();
        });

        $("#txtFilePathW76F2041").on("contextmenu", function () {
            return false;
        });
        
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
                $('#imgThumnailAudioW76F2041').attr('src', event.target.result);
                $('#hdThumbnailW76F2041').val(event.target.result);
            }
        };

        function choosse_W76F2041() {
            $("#fileThumbnailW76F2041").val("");
            $("#fileThumbnailW76F2041").trigger('click');
        }

        $("#files").on("click", function () {
            choosse_W76F2041();
        });

        function blob_to_data_URL(blob, callback) {
            var a = new FileReader();
            a.onload = function (e) {
                callback(e.target.result);
            };
            a.readAsDataURL(blob);
        }

        $('#fileThumbnailW76F2041').on("change", function (e) {
            if (!e.target.files) return;
            var files = e.target.files;
            var file = files[0];
            ImageTools.resize(file, {
                height: 98,
                width: 195
            }, function (blob, didItResize) {
                blob_to_data_URL(blob, function (dataurl_thumbnail) {
                    $('#imgThumnailAudioW76F2041').attr('src', dataurl_thumbnail);
                    $('#hdThumbnailW76F2041').val(dataurl_thumbnail);
                });
            });
        });
        $('.input-group.date').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy"
        });
        if ($("#hdAlbumIDW76F2041").val() == "")
            $("#btnAddAudioW76F2041").hide();

        @if ($id!="")
            loadGridW76F2041("{{$id}}");
        @endif
        lock_control_W76F2041();
    });

    function lock_control_W76F2041() {
        if ($("#hdAlbumIDW76F2041").val() == '') {
            $("#btnAddAudioW76F2041").hide();
            $("#divW76F2041").hide();
            $("#idDisableW76F2041").hide();
        } else {
            $("#txtAlbumDateW76F2041").attr('disabled', 'disabled');
            $("#txtFilePathW76F2041").attr('disabled', 'disabled');
            $(".btnFolderW76F2041").attr('disabled', 'disabled');
            $("#btnAddAudioW76F2041").show();
            $("#divW76F2041").show();
            $("#idDisableW76F2041").show();
        }
    }

    $("#modalAudioDetail").on('submit', '#frmW76F2041', function (e) {
        e.preventDefault();
        ask_save(function(){
            $(".l3loading").removeClass('hide');
            var id = $("#hdAlbumIDW76F2041").val();
            $.ajax({
                method: "POST",
                url: "W76F2041/" + id,
                data: $("#frmW76F2041").serialize(),
                success: function (data) {
                    $(".l3loading").addClass('hide');
                    var result = $.parseJSON(data);
                    if (result.bSaveOK) {
                        save_ok();
                        $("#hdAlbumIDW76F2041").val(result.albumID);
                        $("#btnAddAudioW76F2041").show();
                        loadGridW76F2041(result.albumID);
                        lock_control_W76F2041();
                        $("#frmW76F2040").submit();
                    }
                }
            });
        });
    });

    function loadGridW76F2041(id){
        $("#divW76F2041").html("");
        $.ajax({
            method: "GET",
            url: '{{url("/W76F2041/grid/")}}/' + id,
            success: function (data) {
                $("#divW76F2041").html(data);
            }
        });
    }

    function callW75F2021_AddAudio(){       
        var path = $("#txtFilePathW76F2041").val();
        $.ajax({
            method: "GET",
            url: '{{url("/W76F2041/action/")}}',
            data:{path:path,id:$("#hdAlbumIDW76F2041").val()},
            success: function (data) {
                $(".l3loading").addClass('hide');
                $("#divAddAudioW76F2041").html(data);
                $("#modalAddAudio").find("#hdFilePathAddAudio").val($("#txtFilePathW76F2041").val());
                $("#modalAddAudio").find("#hdAlbumIDAddAudio").val($("#hdAlbumIDW76F2041").val());
                $("#modalAddAudio").modal("show");
            }
        });
    }

    function close_add_Audio() {
        $("#modalAddAudio").off('.confirmation-save');
        $("#modalAddAudio").empty();
        $("#modalAddAudio").modal('hide');
    }

    function showFolder() {
        $.ajax({
            method: "GET",
            url: '{{url("showFolder/1")}}/',
            success: function (data) {
                $("#secW76F2041_Folder").html(data);
                $("#mPopFolderTree").modal("show");
            }
        });
    }

    $(document).on('hidden.bs.modal', ' #mPopFolderTree', function () {
        $("#txtFilePathW76F2041").val($("#hdPathFolderTree").val())
    });
</script>

