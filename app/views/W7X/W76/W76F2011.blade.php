<style>
    .three_dot {
        display: inline-block;
        width: 80px;
        white-space: nowrap;
        overflow: hidden !important;
        text-overflow: ellipsis;
        margin-left: 10px;
    }

    #imageList {
        height: 400px;
        overflow: hidden;
        background: #fdfdfd;
        padding: 0px;
        margin: 20px 0px 0px 0px;
    }
</style>
<div class="modal draggable fade" id="modalPictureDetail" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width:70%">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($caption,"W76F2011", true, "modalPictureDetail")}}
            </div>
            @if ($id == -1)
                @define $AlbumID = "-1";
                @define $AlbumNameU = "";
                @define $AlbumType = "P";
                @define $AlbumDate = date('d/m/Y');
                @define $RemarkU = "";
                @define $Disabled = "";
                @define $CreateUserID = "";
            @else
                @define $AlbumID = $rsEditAlbum[0]['AlbumID'];
                @define $AlbumNameU = $rsEditAlbum[0]['AlbumNameU'];
                @define $AlbumType = $rsEditAlbum[0]['AlbumType'];
                @define $AlbumDate = $rsEditAlbum[0]['AlbumDate'];
                @define $RemarkU = $rsEditAlbum[0]['RemarkU'];
                @define $Disabled = $rsEditAlbum[0]['Disabled'];
                @define $CreateUserID = $rsEditAlbum[0]['CreateUserID'];
            @endif
            <div class="modal-body" style="padding:10px 10px 0px 10px">
                <form class="form-horizontal" id="frmW76F2011">
                    <input type="hidden" value="{{$AlbumID}}" name="AlbumID" id="AlbumID"/>

                    <div class="row">
                        <div class="col-md-2 col-xs-2">
                            <div class="liketext">
                                <label class="lbl-normal ">{{Helpers::getRS($g,"Ten_album")}}</label>
                            </div>
                        </div>
                        <div class="col-md-5 col-xs-5" style="padding-right: 0px">
                            <input class="form-control" type="text" id="txtAlbumName" name="txtAlbumName"
                                   value="{{$AlbumNameU}}"
                                   required>
                        </div>
                        <div class="col-md-3 col-xs-3" style="padding-left: 10px">
                            <div class="input-group date">
                                <input type="text" class="form-control" id="txtAlbumDate"
                                       name="txtAlbumDate" value="{{$AlbumDate}}" required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2">
                            <div class="checkbox {{$id == -1?"hide":""}}" style="margin-top: -4px">
                                <input type="checkbox" id="chkDisabled" name="chkDisabled" value="{{$Disabled}}" {{$Disabled == 1 ? 'checked':''}}/>
                                {{Helpers::getRS($g,"Khong_su_dung")}}
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-2 col-xs-2">
                            <div class="liketext">
                                <label class="lbl-normal ">{{Helpers::getRS($g,"Ghi_chu")}}</label>
                            </div>

                        </div>
                        <div class="col-md-9 col-xs-9">
                            <input class="form-control" type="text" id="txtRemarkU" name="txtRemarkU"
                                   value="{{$RemarkU}}">
                        </div>
                        <div class="col-md-1 col-xs-1 pull-left">
                            <button type="button" id="btnSave" onclick="save();"
                                    style="margin-left:-20px;margin-top:-1px;padding-top:2px;padding-bottom: 3px;"
                                    class="btn btn-default smallbtn pull-left mgr10 confirmation-save">
                                <span class="glyphicon glyphicon-floppy-saved mgr5"></span>{{Helpers::getRS($g,"Luu")}}
                            </button>
                        </div>
                    </div>
                        <div class="row" style="margin-top: 5px">
                            <div class="col-md-2 col-xs-2">
                                <button type="button" ID="btn_add_image" onclick="callShowPopAdd();">
                                    <span class="glyphicon glyphicon-plus mgr5"></span>{{Helpers::getRS($g,"Them_anh")}}
                                </button>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -15px;padding: 10px 15px">
                            <div class="col-md-12 col-xs-12" style="padding:0px;">
                                <div id="imageList" class="content mCustomScrollbar light _mCS_2 mCS-autoHide"
                                     data-mcs-theme="minimal-dark"
                                     style="border: 1px solid #ccc;border-radius:5px;height: 400px;overflow: hidden;">
                                    <div class="l3loadingCus hide">
                                        <i class="fa fa-refresh fa-spin" style="font-size: 150%"></i>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <input type="submit" id="btn_submit" class="hidden"/>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- AddImage popup -->
<div id="add_image" style="display: inline-block;"></div>
<!-- EditCaption popup-->
<div>@include('W7X.W76.W76F2011_EditCaption')</div>

<script type="text/javascript">

    var modalPictureDetail = function () {
        $("#modalPictureDetail").modal('hide');
        //$("#frmW76F2010").find("#btn_submit").click();
        load_album(true);
    };

    var popEditCaption = function () {
        $("#popEditCaption").modal('hide');
    };

    function save() {
        ask_save(save_callback);
    }

    function save_callback(){
        $("#modalPictureDetail").find("#btn_submit").click();
    }

    function remove_image(id) {
        var AlbumID = $("#AlbumID").val();
        var ids = [AlbumID, id];
        ask_delete(remove_image_callback,ids);

    }
    function remove_image_callback(ids){
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            url: "W76F2011/W76F2011/4/removeimage",
            data: {
                AlbumID: ids[0],
                AlbumItemID: ids[1]
            },
            success: function (data) {
                $(".l3loading").addClass('hide');
                var result = $.parseJSON(data);
                if (result.bSaveOK) {
                    save_ok(reload_table);
                }
            }
        });
    }

    function allow_save() {
        var txtAlbumName = $("#modalPictureDetail").find("#txtAlbumName");
        if (txtAlbumName.val() == "") {
            txtAlbumName.get(0).setCustomValidity("{{Helpers::getRS($g,"Ban_chua_nhap_ten_album")}}");
            //$("#popEditAlbum").find("#btn_submit").click();
            return false;
        }
        else {
            txtAlbumName.get(0).setCustomValidity("");
        }

        var txtAlbumDate = $("#modalPictureDetail").find("#txtAlbumDate");
        if (txtAlbumDate.val() == "") {
            txtAlbumDate.get(0).setCustomValidity("{{Helpers::getRS($g,"Ban_chua_nhap_ngay_tao")}}");
            //$("#popEditAlbum").find("#btn_submit").click();
            return false;
        }
        else {
            txtAlbumDate.get(0).setCustomValidity("");
        }

        return true;
        //$("#popEditAlbum").find("#btn_submit").click();
    }

    $("#modalPictureDetail").on('submit', '#frmW76F2011', function (e) {
        e.preventDefault();
        $(".l3loading").removeClass('hide');
        var id = $("#AlbumID").val();
        $.ajax({
            method: "POST",
            url: "W76F2011/W76F2011/4/save/" + id,
            data: $("#frmW76F2011").serialize(),
            success: function (data) {
                $(".l3loading").addClass('hide');
                var result = $.parseJSON(data);
                if (result.bSaveOK) {
                    save_ok();
                    $("#AlbumID").val(result.albumID);
                    $("#btn_add_image").show();
                    $("#imageList").show();
                }
            }
        });

    });
    function update_caption() {

        var albumID = $("#AlbumID").val();
        var imageID = $("#imageID").val();
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            url: "W76F2011/W76F2011/4/updatecaption",
            data: {
                AlbumID: albumID,
                AlbumItemID: imageID,
                Remark: $("#caption").val()
            },
            success: function (data) {
                //$(".l3loading").addClass('hide');
                $(".l3loading").addClass('hide');
                var result = $.parseJSON(data);
                if (result.bSaveOK) {
                    save_ok(refresh_form);
                }
            }
        });
    }

    function refresh_form(){
        reload_table();
        popEditCaption();
    }

    function callShowPopAdd() {
        $(".l3loading").removeClass('hide');
        var id = $("#AlbumID").val();
        $.ajax({
            method: "POST",
            url: "W76F2011/W76F2011/4/addImage",
            success: function (data) {
                $("#add_image").html(data);
                $(".l3loading").addClass('hide');
                $("#popAddImage").modal('show');
            }
        });


    }

    function callShowPopEditCaption(id, msg) {
        $("#caption").val(msg);
        $("#imageID").val(id);
        $("#popEditCaption").modal('show');
    }

    function load_table() {
        $(".l3loadingCus").removeClass('hide');
        $(".l3loadingCus").css("paddingTop", Number($("#imageList").height()/2)-10 );
        $(".l3loadingCus").css("paddingLeft", 430 );
        var id = $("#AlbumID").val();
        if (id != '') {
            $.ajax({
                method: 'POST',
                url: "W76F2011/W76F2011/4/imagelist/" + id,
                success: function (data) {
                    $("#imageList").html(data);
                    $(".l3loadingCus").addClass('hide');
                    $("#modalPictureDetail").find(".mCSB_container").html(data);
                }
            });
        }
    }

    function reload_table() {
        var id = $("#AlbumID").val();
        if (id != '') {
            $.ajax({
                method: 'POST',
                url: "W76F2011/W76F2011/4/imagelist/" + id,
                success: function (data) {
                    //$(".l3loading").addClass('hide');
                    $("#modalPictureDetail").find(".mCSB_container").html(data);
                }
            });
        }

    }

    $(document).ready(function () {
        $('.input-group.date').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy"
        });

        if ($("#AlbumID").val() == '-1') {
            $("#btn_add_image").hide();
            $("#imageList").hide();
        }

        load_table();
        lock_control();

    });

    function lock_control() {
        if ($("#AlbumID").val() == '-1') {
            //$("#btn_add_image").attr('disabled', 'disabled');
            //$("#btn_add_image").attr('display', 'none');
            //$("#imageList").attr('display', 'none');

        } else {
            //$("#btn_add_image").removeAttr('disabled');
            $("#txtAlbumDate").attr('disabled', 'disabled');
            //$("#rdAlbumType_M").attr('disabled', 'disabled');
            //$("#rdAlbumType_V").attr('disabled', 'disabled');
        }
    }

</script>

