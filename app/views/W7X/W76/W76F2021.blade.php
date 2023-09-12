<div class="modal fade draggable" id="modalVideoDetail" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width:72%;height:800px">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($caption,"W76F2021", true, "close_w76F2021")}}
            </div>
            @if ($id == -1)
                @define $AlbumID = "-1";
                @define $AlbumNameU = "";
                @define $AlbumDate = date('d/m/Y');
                @define $RemarkU = "";
                @define $Disabled = "";
                @define $FilePath = "";
                @define $Thumbnail = "";
            @else
                @define $AlbumID = $rsAlbum['AlbumID'];
                @define $AlbumNameU = $rsAlbum['AlbumNameU'];
                @define $AlbumDate = $rsAlbum['AlbumDate'];
                @define $RemarkU = $rsAlbum['RemarkU'];
                @define $Disabled = $rsAlbum['Disabled'];
                @define $FilePath = $rsAlbum['FilePath'];
                @define $Thumbnail = $rsAlbum['Thumbnail'];
            @endif
            <div class="modal-body" style="padding:10px">
                <form class="form-horizontal" id="frmW76F2021">
                    <div class="row">
                        <div class="col-md-9 col-xs-9">
                            <div class="row form-group">
                                <div class="col-md-2 col-xs-2">
                                    <div class="liketext">
                                        <label class="lbl-normal ">{{Helpers::getRS($g,"Ten_album")}}</label>
                                    </div>
                                </div>
                                <div class="col-md-7 col-xs-7">
                                    <input class="form-control" type="text" id="txtAlbumNameW76F2021" name="txtAlbumNameW76F2021"
                                           value="{{$AlbumNameU}}" required>
                                </div>
                                <div class="col-md-3 col-xs-3">
                                    <div class="input-group date">
                                        <input type="text" class="form-control" id="txtAlbumDateW76F2021"
                                               name="txtAlbumDateW76F2021" value="{{$AlbumDate}}" required>
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
                                            <input type="text" class="form-control" value="{{$FilePath}}" name="txtFilePathW76F2021" id="txtFilePathW76F2021" ondragstart="return false" draggable="false" required>
                                            @if ($id==-1)
                                                <span class="input-group-btn">
                                            <button type="button" class="btn btn-info btnFolderW76F2021" onclick="showFolder();" style="padding: 2px 12px !important;">
                                                <span class="fa fa-folder-open-o" aria-hidden="true"></span>
                                            </button>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-3">
                                    <div id="idDisableW76F2021" class="checkbox {{$id == -1?"hide":""}}" style="margin-top: -4px;padding-left:21px">
                                        <input type="checkbox" id="chkDisabledW76F2021" name="chkDisabledW76F2021" value="{{$Disabled}}" {{$Disabled == 1 ? 'checked':''}}/>
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
                                <div class="col-md-7 col-xs-7">
                                    <input class="form-control" type="text" id="txtRemarkW76F2021" name="txtRemarkW76F2021" value="{{$RemarkU}}"
                                            >
                                </div>
                                <div class="col-md-3 col-xs-3" style="padding-right: 5px;">
                                    <button type="button" id="btnsaveW76F2021" onclick="save_w76F2021();" class="btn btn-default smallbtn pull-left mgr10 confirmation-save">
                                        <span class="glyphicon glyphicon-floppy-saved mgr5"></span>{{Helpers::getRS($g,"Luu")}}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-3">
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <input id="fileThumbnailW76F2021" type="file" name="fileThumbnailW76F2021" accept="image/*" multiple
                                           style="display: none">
                                    <a>
                                        <div id="files" class="cls_thumbnail pull-right" style="">
                                            <img id="imgThumnailVideoW76F2021" name="imgThumnailVideoW76F2021" src="{{$Thumbnail}}" alt=""
                                                 width="185px" height="100px" class="cls_thumbnail"/>
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
                        <div class="col-md-12 col-xs-12">
                            <button type="button" ID="btnAddvideoW76F2021" class="btn btn-default smallbtn  pull-left" onclick="callShowPopUpW75F2021_AddVideo(-1,'');">
                                <span class="glyphicon glyphicon-plus mgr5"></span>{{Helpers::getRS($g,"Them_video")}}
                            </button>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col-md-12 col-xs-12">
                            <div id="divW76F2021"></div>
                        </div>
                    </div>
                    <input type="hidden" id="hdAlbumIDW76F2021" name="hdAlbumIDW76F2021" value="{{$AlbumID}}"/>
                    <input type="hidden" id="hdThumbnailW76F2021" name="hdThumbnailW76F2021" value="{{$Thumbnail}}"/>
                    <input type="submit" id="btnSubmitW76F2021" class="hidden"/>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="divAddVideoW76F2021"></div>
<section id="secW76F2021_Folder"></section>
<script>
    function close_w76F2021() {
        $("#modalVideoDetail").modal('hide');
    }

    function clear_image() {
        $('#imgThumnailVideoW76F2021').attr('src', "");
        $('#hdThumbnailW76F2021').val("");
    }

    $(document).ready(function () {
        $("#txtFilePathW76F2021").keypress(function (event) {
            if(event.ctrlKey && event.charCode == 99)
                return true;
             event.preventDefault();
        });

        $("#txtFilePathW76F2021").on("contextmenu", function () {
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
                $('#imgThumnailVideoW76F2021').attr('src', event.target.result);
                $('#hdThumbnailW76F2021').val(event.target.result);
            }
        };

        function choosse_w76f2021() {
            $("#fileThumbnailW76F2021").val("");
            $("#fileThumbnailW76F2021").trigger('click');
        }

        $("#files").on("click", function () {
            choosse_w76f2021();
        });

        function blob_to_data_URL(blob, callback) {
            var a = new FileReader();
            a.onload = function (e) {
                callback(e.target.result);
            }
            a.readAsDataURL(blob);
        }

        $('#fileThumbnailW76F2021').on("change", function (e) {
            if (!e.target.files) return;
            var files = e.target.files;
            var file = files[0];
            ImageTools.resize(file, {
                height: 98,
                width: 195
            }, function (blob, didItResize) {
                console.log(blob);
                blob_to_data_URL(blob, function (dataurl_thumbnail) {
                    $('#imgThumnailVideoW76F2021').attr('src', dataurl_thumbnail);
                    $('#hdThumbnailW76F2021').val(dataurl_thumbnail);
                });
            });
        });
        $('.input-group.date').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy"
        });
        if ($("#hdAlbumIDW76F2021").val() == "")
            $("#btnAddvideoW76F2021").hide();

        load_table_w76F2021();
        lock_control_w76F2021();
    });

    function lock_control_w76F2021() {
        if ($("#hdAlbumIDW76F2021").val() == '-1') {
            $("#btnAddvideoW76F2021").hide();
            $("#divW76F2021").hide();
            $("#idDisableW76F2021").hide();
        } else {
            $("#txtAlbumDateW76F2021").attr('disabled', 'disabled');
            $("#txtFilePathW76F2021").attr('disabled', 'disabled');
            $(".btnFolderW76F2021").attr('disabled', 'disabled');
            $("#btnAddvideoW76F2021").show();
            $("#divW76F2021").show();
            $("#idDisableW76F2021").show();
        }
    }

    function save_w76F2021() {
        ask_save(save_w76F2021_callback);
    }

    function save_w76F2021_callback() {
        var txtAlbumNameW76F2021 = $("#frmW76F2021").find("#txtAlbumNameW76F2021");
        if (txtAlbumNameW76F2021.val() == "") {
            txtAlbumNameW76F2021.get(0).setCustomValidity("{{Helpers::getRS($g,"Ban_chua_nhap_ten_album")}}");
            $("#frmW76F2021").find("#btnSubmitW76F2021").click();
            return false;
        }
        else {
            txtAlbumNameW76F2021.get(0).setCustomValidity("");
        }

        var txtAlbumDateW76F2021 = $("#frmW76F2021").find("#txtAlbumDateW76F2021");
        if (txtAlbumDateW76F2021.val() == "") {
            txtAlbumDateW76F2021.get(0).setCustomValidity("{{Helpers::getRS($g,"Ban_chua_nhap_ngay_tao")}}");
            $("#frmW76F2021").find("#btnSubmitW76F2021").click();
            return false;
        }
        else {
            txtAlbumDateW76F2021.get(0).setCustomValidity("");
        }

        var txtFilePathW76F2021 = $("#frmW76F2021").find("#txtFilePathW76F2021");
        if (txtFilePathW76F2021.val() == "") {
            txtFilePathW76F2021.get(0).setCustomValidity("{{Helpers::getRS($g,"Ban_chua_chon_thu_muc")}}");
            $("#frmW76F2021").find("#btnSubmitW76F2021").click();
            return false;
        }
        else {
            txtFilePathW76F2021.get(0).setCustomValidity("");
        }

        $("#modalVideoDetail").find("#btnSubmitW76F2021").click();
    }

    $("#modalVideoDetail").on('submit', '#frmW76F2021', function (e) {
        e.preventDefault();
        $(".l3loading").removeClass('hide');
        var id = $("#hdAlbumIDW76F2021").val() == "" ? -1 : $("#hdAlbumIDW76F2021").val();
        $.ajax({
            method: "POST",
            url: "W76F2021/{{$pFrom}}/{{$g}}/savealbumvideo/" + id,
            data: $("#frmW76F2021").serialize(),
            success: function (data) {
                $(".l3loading").addClass('hide');
                var result = $.parseJSON(data);
                if (result.bSaveOK) {
                    save_ok();
                    $("#hdAlbumIDW76F2021").val(result.albumID);
                    $("#btnAddvideoW76F2021").show();
                    load_album(true);
                    load_table_w76F2021(id);
                    lock_control_w76F2021();
                }
            }
        });

    });

    function load_table_w76F2021() {
        $("#divW76F2021").html("");
        $.ajax({
            method: "POST",
            url: '{{url("/W76F2021/".$pFrom."/".$g."/videolist/".$id)}}',
            success: function (data) {
                $("#divW76F2021").html(data);
            }
        });
    }

    function reload_table_w76F2021(albumID) {
        $("#divW76F2021").html("");
        $.ajax({
            method: "POST",
            url: '{{url("/W76F2021/".$pFrom."/".$g."/videolist/")}}' + '/' + albumID,
            success: function (data) {
                $("#divW76F2021").html(data);
            }
        });
    }

    function callShowPopUpW75F2021_AddVideo(rowIndx, $grid) {
        //$(".l3loading").removeClass('hide');
        var itemid = -1;
        if (rowIndx > -1) {
            var rowData = $grid.pqGrid("getRowData", {rowIndx: rowIndx});
            var itemid = rowData['AlbumItemID'];
        }
        var path = "{{str_replace(".\\",".\\\\", $FilePath)}}";
        if (path == "")
            path = $("#txtFilePathW76F2021").val();
        $.ajax({
            method: "GET",
            url: '{{url("/W76F2021/$pFrom/$g/detailvideo/")}}/' + itemid,
            data: {path: path, id: $("#hdAlbumIDW76F2021").val()},
            success: function (data) {
                $(".l3loading").addClass('hide');
                $("#divAddVideoW76F2021").html(data);
                $("#modalAddVideo").find("#hdFilePathAddVideo").val(path);
                $("#modalAddVideo").find("#hdAlbumIDAddVideo").val($("#hdAlbumIDW76F2021").val());
                $("#modalAddVideo").modal("show");
            }
        });
    }

    function close_add_video() {
        $("#modalAddVideo").off('.confirmation-save');
        $("#modalAddVideo").empty();
        $("#modalAddVideo").modal('hide');
    }

    function showFolder() {
        $.ajax({
            method: "GET",
            url: '{{url("showFolder/0")}}/',
            success: function (data) {
                $("#secW76F2021_Folder").html(data);
                $("#mPopFolderTree").modal("show");
            }
        });
    }

    $(document).on('hidden.bs.modal', ' #mPopFolderTree', function () {
        $("#txtFilePathW76F2021").val($("#hdPathFolderTree").val())
    });

</script>

