<div class="modal draggable fade" id="popAddImage" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width:70%;height:800px">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading(Helpers::getRS($g,"Them_anh"),"W76F2011", true, "popAddImage")}}
            </div>

            <div class="modal-body" style="padding:10px">
                <form id="frmW76F2011_AddImage">
                    <input id="fileupload" type="file" name="fileupload[]" accept="image/*" multiple max-uploads=6
                           style="display: none">
                    <!-- The container for the uploaded files -->
                    <div id="files" class="files upload-container upload-bg"
                         style="overflow-y: auto;overflow-x: hidden;padding-right: 5px"></div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-12 col-xs-12 ">
                            <div class="progress"
                                 style="border-radius: 3px; border:1px solid #c9cccf;margin-bottom:0px">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0"
                                     aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-action" style="margin-top: 0px;">
                        <div class="col-md-10 col-xs-10 ">
                            <button type="button" ID="btnAdd" onclick="choosse();" class="pull-left mgr10">
                                <span class="glyphicon glyphicon-folder-open mgr10"></span>
                                <labe>{{Helpers::getRS($g,"Chon_anh")}}...</labe>
                            </button>
                            <label class="cls-note mgr5">{{Helpers::getRS($g,"Tong_dung_luong_hien_tai")}}: </label><label class="cls-note" style="color:red" id="curr-total">0</label><label class="cls-note"> MB</label>
                            <label class="cls-note" style="color: blue;">({{Helpers::getRS($g,"Cho_phep_upload_toi_da_50MB")}})</label>
                        </div>

                        <div class="col-md-2 col-xs-2 ">
                            <button type="button" ID="btn_Agree" class="pull-right" onclick="Agree()">
                                <span class="glyphicon glyphicon-ok mgr5"></span>
                                <labe>{{Helpers::getRS($g,"Dong_y")}}</labe>
                            </button>
                        </div>

                    </div>

                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-12">
                            <div id="message" class="alert alert-success alert-dismissable hide ">
                                <i class="icon fa fa-check"></i> Dữ liệu đã lưu thành công!
                            </div>
                            <div class="alert alert-danger alert-dismissable hide">
                                <i class="icon fa fa-ban"></i> <span id="err">{{Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu")}}
                                    !</span>
                            </div>
                            <div class="cls_size alert alert-danger alert-dismissable hide">
                                <i class="icon fa fa-ban"></i> <span id="err">{{Helpers::getRS($g,"Upload_vuot_qua_dung_luong_cho_phep")}}
                                    !</span>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" value="" name="filedata" id="filedata"/>
                    <input type="hidden" value="" name="filethumbnail" id="filethumbnail"/>
                    <input type="hidden" value="" name="remark" id="remark"/>
                    <input type="submit" id="btnSaveImage" class="hidden"/>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    var popAddImage = function () {
        $("#popAddImage").modal('hide');
        $("#add_image").html('');

    };
    function Agree() {
        if ($('#files').html() == "") {
            alert_warning("{{Helpers::getRS($g,"Ban_chua_chon_anh_upload")}}");
        }
        else {
            var size = 0;
            var bEnableSave = true;
            $("#files").find(".cls-size").each(function () {
                size += Number($(this).html());
                if (format2(size / 1024,"",2) >50) {
                    //$("#popAddImage").find(".cls_size").removeClass('hide');
                    bEnableSave = false;
                    $(".cls_size").removeClass("hide");
                }else{
                    $(".cls_size").addClass("hide");
                }
            });
            if (bEnableSave)
                $("#frmW76F2011_AddImage").find("#btnSaveImage").click();
        }
    }

    function dataURLtoBlob(dataurl) {
        var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
                bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new Blob([u8arr], {type: mime});
    }

    //**blob to dataURL**
    function blobToDataURL(blob, callback) {
        var a = new FileReader();
        a.onload = function (e) {
            callback(e.target.result);
        }
        a.readAsDataURL(blob);
    }
    $(document).ready(function () {
        $("#popAddImage").find("#files").height($("#modalPictureDetail").find(".modal-content").height() - 65);


    });

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
            reader.onload = function (event) {
                //$('#image_droped').attr('src', event.target.result);
            };
            //reader.readAsDataURL(file);
        };
        $(".progress").hide();
    });
    var index = 0;
    $('#fileupload').on("change", function (e) {
        if (!e.target.files) return;
        //var str = "";
        var files = e.target.files;
        var curr = 0;
        var i = 0;
        addImage(curr, this, curr);
    });

    function addImage(curr, files, curr) {
        $("#files").removeClass("upload-bg");
        $(".row-action").hide();
        var file = files.files[curr];
        ImageTools.resize(file, {}, function (blob, didItResize) {
            blobToDataURL(blob, function (dataurl) {
                datafile[index] = dataurl;
                ImageTools.resize(file, {
                    width: 160, // maximum width
                }, function (blob, didItResize) {
                    blobToDataURL(blob, function (dataurl_thumbnail) {
                        thumnail[index] = dataurl_thumbnail;
                        remark[index] = "";
                        max_size += Math.ceil(Number(file.size / 1024))
                        var str = "";
                        str += '<div class="row" id="imageRow' + index + '" style="margin-top: 6px;vertical-align: middle">';
                        str += '<div class="col-sm-2 pdr0sss">';
                        str += '<img src="' + dataurl_thumbnail + '" width="120px" height="80px" style="border-radius:3px" />';
                        str += '</div>';
                        str += '<div class="col-sm-10 pdf0">';
                        str += '<div class="row">';
                        str += '<div class="col-sm-12">';
                        str += '<input type = "text" id="' + index + '"  index="' + index + '" onblur="update(this);"   value="" style="width:100%" placeholder="Mô tả" />';
                        str += '</div>';
                        str += '</div>';
                        str += '<div class="row" style="margin-top: 5px">';
                        str += '<div class="col-sm-8">';
                        str += "{{Helpers::getRS($g,"Ten_File")}} : <b>" + file.name + "</b>";
                        str += '</div>';
                        str += '<div class="col-sm-3">';
                        str += "{{Helpers::getRS($g,"Kich_co")}} : <b class='cls-size'>" + Math.ceil(Number(file.size / 1024)) + "</b><b> KB</b>";
                        str += '</div>';
                        str += '<div class="col-sm-1 pdr0 full-right">';
                        str += '<a class="full-right" title="Xóa ảnh"><i class="glyphicon  glyphicon-remove mgr5 text-red" onclick="removeImage(' + index + ',this)"></i></a>';
                        str += '</div>';
                        str += '</div>';
                        str += '</div>';
                        str += '</div>';
                        $("#files").append(str);
                        if (curr == Number(files.files.length - 1)) {
                            $(".row-action").show();
                            index = index + 1;
                            cal_size();
                        } else {
                            curr = curr + 1;
                            index = index + 1;
                            addImage(curr, files, curr);
                        }
                    });
                });

            });
        });
    }

    function cal_size(){
        var size = 0;
        $("#files").find(".cls-size").each(function () {
            size += Number($(this).html());
            $("#curr-total").html(format2(size/1024,"",2));
        });
        if ($("#files").html() == "")
            $("#curr-total").html(format2(0,"",2));
    }

    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drop(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));
    }

    var datafile = [];
    var thumnail = [];
    var remark = [];

    var max_size = 0;
    var content = "";

    function update(el) {
        remark[$(el).attr("index")] = $(el).val();
        $("#remark").val(remark);

    }
    function removeImage(index, el) {
        datafile[index] = "";
        thumnail[index] = "";
        remark[index] = "";
        $(el).parent().parent().parent().parent().parent().remove();
        cal_size();
        if ($("#files").html() == "")
            $("#files").addClass("upload-bg");

    }

    var duration = 0;
    $("#popAddImage").on('submit', '#frmW76F2011_AddImage', function (e) {
        e.preventDefault();
        var id = $("#AlbumID").val();
        var pos = 0;
        var percent = 0;
        $(".progress-bar").attr("aria-valuemax", datafile.length)
        var icount = 0;
        for (var i = 0; i < datafile.length; i++) {
            if (datafile[i] != "")
                icount = icount + 1;
        }
        duration = Math.round(100 / icount);
        $(".row-action").hide();
        $(".progress").show();
        $(".glyphicon-remove").hide();

        upload_image(pos, id, duration)
    });

    function upload_image(pos, id, percent) {
        if (datafile[pos] != "") {
            if (pos < datafile.length) {
                $.ajax({
                    method: "POST",
                    url: "W76F2011/W76F2011/4/saveimage/" + id,
                    data: {filedata: datafile[pos], filethumbnail: thumnail[pos], remark: remark[pos]},
                    success: function (data) {
                        var result = $.parseJSON(data);
                        if (result.bSaveOK) {
                            $('.progress-bar').css('width', percent + '%');
                            $(".progress-bar").attr("aria-valuenow", percent);
                            $(".progress-bar").html(percent + "%");
                            $("#imageRow" + pos).remove();
                            datafile[pos] = "";
                            thumnail[pos] = "";
                            remark[pos] = "";
                            if (pos == (datafile.length - 1)) {
                                reload_table();
                                setTimeout(function () {
                                    datafile.length = 0;
                                    thumnail.length = 0;
                                    remark.length = 0;
                                    index = 0;
                                    $("#files").html("");
                                    $(".progress-bar").attr("aria-valuenow", 0);
                                    $("#files").addClass("upload-bg");
                                    $(".row-action").show();
                                    $(".progress").hide();
                                    $(".glyphicon-remove").show();
                                    $('.progress-bar').css('width', 0 + '%');
                                    cal_size();
                                }, 1000);

                            } else {
                                pos = pos + 1;
                                if (pos == (datafile.length - 1))
                                    percent = percent + (100 - percent);
                                else
                                    percent = percent + duration;
                                upload_image(pos, id, percent);
                            }
                        }
                    }
                });
            }
        } else {
            if (pos < datafile.length -1) {
                pos = pos + 1;
                upload_image(pos, id, percent);
            }else{
                setTimeout(function () {
                    datafile.length = 0;
                    thumnail.length = 0;
                    remark.length = 0;
                    index = 0;
                    $("#files").html("");
                    $(".progress-bar").attr("aria-valuenow", 0);
                    $("#files").addClass("upload-bg");
                    $(".row-action").show();
                    $(".progress").hide();
                    $(".glyphicon-remove").show();
                    $('.progress-bar').css('width', 0 + '%');
                    cal_size();
                }, 1000);
            }

        }


    }

    function choosse() {
        $("#fileupload").val("");
        $("#fileupload").trigger('click');
    }

    $("#files").on("click", function () {
        if ($("#files").html() == "")
            choosse();
    });
</script>