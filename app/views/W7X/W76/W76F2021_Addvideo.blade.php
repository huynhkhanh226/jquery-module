<div class="modal fade draggable" id="modalAddVideo" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width:700px;height:300px">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading(Helpers::getRS($g,"Them_video"),"W76F2021", true, "close_add_video")}}
            </div>
            @if ($itemid == -1)
                @define $AlbumID = "-1";
                @define $AlbumItemID = "";
                @define $RemarkU = "";
            @else
                @define $AlbumID = $dsData['AlbumID'];
                @define $AlbumItemID = $dsData['AlbumItemID'];
                @define $RemarkU = $dsData['RemarkU'];

            @endif
            <div class="modal-body" style="padding:10px">
                <form class="form-horizontal" id="frmW76F2021AddVideo" name="frmW76F2021AddVideo">
                    <div class="row form-group {{$itemid != -1 ? 'hide': ''}}">
                        <div class="col-md-2 col-xs-2">
                            <div class="liketext">
                                <label class="lbl-normal ">{{Helpers::getRS($g,"Nguon")}}</label>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optLocationPathAddVideo" id="optLocationPathAddVideo0"
                                           value="0">
                                    Youtube
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optLocationPathAddVideo" id="optLocationPathAddVideo1"
                                           value="1" checked>
                                    {{Helpers::getRS($g,"Tap_tin")}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group divYoutube {{$itemid == -1 ? 'hide': ''}}">
                        <div class="col-md-2 col-xs-2">
                            <div class="liketext">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Ten_video")}}</label>
                            </div>
                        </div>
                        <div class="col-md-10 col-xs-10">
                            <input class="form-control" type="text" id="txtRemarkAddVideo" name="txtRemarkAddVideo"
                                   value="{{$RemarkU}}" {{$itemid != -1 ? 'required': ''}}>
                        </div>
                    </div>
                    <div class="row form-group divYoutube {{$itemid == -1 ? 'hide': ''}}">
                        <div class="col-md-2 col-xs-2">
                            <div class="liketext">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Duong_dan")}}</label>
                            </div>
                        </div>
                        <div class="col-md-10 col-xs-10" id="idColChangeAddVideo">
                            <input class="form-control" type="text" id="txtPathYoutube" name="txtPathYoutube"
                                   value="{{isset($dsData['LocationPath'])?$dsData['LocationPath']:""}}" {{$itemid != -1 ? 'required': ''}}>
                        </div>
                    </div>
                    @if ($itemid==-1)
                        <div class="row gridListFiles mgb5">
                            <div class="col-md-12">
                                <div id="pqGrid_W76F2021AddVideo"></div>
                            </div>
                        </div>
                    @endif
                    <div class="row form-group">
                        <div class="col-md-12 col-xs-12" style="padding-right: 3px !important;">
                            <div class="pull-right">
                                <button type="button" id="btnSaveW76F2021"
                                        class="btn btn-default smallbtn pull-left mgr10 confirmation-save">
                                    <span class="glyphicon glyphicon-floppy-saved mgr5"></span>{{Helpers::getRS($g,"Luu")}}
                                </button>
                            </div>
                        </div>
                    </div>
                    <input type="submit" id="btnSubmitAddvideo" class="hide"/>
                    <input type="hidden" id="hdFilePathAddVideo" name="hdFilePathAddVideo" value=""/>
                    <input type="hidden" id="hdAlbumIDAddVideo" name="hdAlbumIDAddVideo" value="{{$AlbumID}}"/>
                    <input type="hidden" id="hdAlbumItemIDAddVideo" name="hdAlbumItemIDAddVideo"
                           value="{{$AlbumItemID}}"/>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#optLocationPathAddVideo0').on("change", function (e) {
            if ($(this).is(":checked")) {
                $(".divYoutube").removeClass("hide");
                $(".gridListFiles").addClass("hide");
                $("#txtRemarkAddVideo").prop('required', true);
                $("#txtPathYoutube").prop('required', true);
            }
        });

        $('#optLocationPathAddVideo1').on("change", function (e) {
            if ($(this).is(":checked")) {
                $(".divYoutube").addClass("hide");
                $(".gridListFiles").removeClass("hide");
                $("#txtRemarkAddVideo").prop('required', false);
                $("#txtPathYoutube").prop('required', false);
            }
        });

        $("#modalAddVideo").on('submit', '#frmW76F2021AddVideo', function (e) {
            e.preventDefault();
            $(".l3loading").removeClass('hide');
            var id = $("#hdAlbumIDAddVideo").val();
            var itemid = $("#hdAlbumItemIDAddVideo").val() == "" ? -1 : $("#hdAlbumItemIDAddVideo").val();
            var mode = ($('#optLocationPathAddVideo1').is(":checked") ? 1 : 0);
            var list = [];
            @if ($itemid==-1)
            if (mode == 1) { //T?p tin
                list=$("#pqGrid_W76F2021AddVideo").pqGrid("selection", {type: 'row', method: 'getSelection'});
            }
            @endif
            $.ajax({
                method: "POST",
                url: "{{url('W76F2021/savevideo/')}}",
                data: {
                    list: list,
                    id: id,
                    itemid: itemid,
                    mode: mode,
                    remark: $("#txtRemarkAddVideo").val(),
                    path: $("#txtPathYoutube").val()
                },
                success: function (data) {
                    $(".l3loading").addClass('hide');
                    if (data == 1) {
                        $("#btnSaveW76F2021").addClass("hide");
                        save_ok();
                        load_album(true);
                        reload_table_w76F2021(id);
                    }else
                    {
                        save_not_ok();
                    }
                }
            });

        });

        $("#modalAddVideo").on('shown.bs.modal', function () {
            @if (isset($rsListVideo))
            var data = {{json_encode($rsListVideo)}};
            var obj = {
                width: 680,
                height: 285,
                showTitle: false,
                wrap: false,
                hwrap: false,
                collapsible: false,
                scrollModel: {lastColumn: 'auto', autoFit: true},
                sortable: false,
                colModel: [
                    {
                        title: "<label><input type='checkbox'/></label>",
                        minWidth: 30,
                        maxWidth: 30,
                        align: "center",
                        type: 'checkbox',
                        cls: 'ui-state-default',
                        dataType: 'bool',
                        resizable: false,
                        sortable: false,
                        cb: { header: true, select: true, all: true},
                        editor: false
                    },
                    {
                        title: "{{Helpers::getRS($g,"Ten_video")}}",
                        minWidth: 170,
                        sortable: false,
                        dataType: "string",
                        dataIndx: "Name",
                        editable: false,
                        align: "left"
                    },
                    {
                        title: "Folder",
                        minWidth: 170,
                        sortable: false,
                        dataType: "string",
                        dataIndx: "FolderName",
                        align: "left",
                        hidden: true
                    }
                ],
                dataModel: {
                    data: data,
                    dataType: "JSON",
                    sorting: "local"
                },
                selectionModel: {type: 'none', cbHeader: true, cbAll: true},
                groupModel: {
                    dataIndx: ["FolderName"],
                    collapsed: [false],
                    title: ["<b style='font-weight:bold;'>{0} ({1} files)</b>", "{0} - {1}"]
                    //dir: ["up"]
                    //,icon: ["circle-plus", "circle-triangle", "triangle"]
                }
            };
            var $gridW76F2021AddVideo = $("#pqGrid_W76F2021AddVideo").pqGrid(obj);
            $gridW76F2021AddVideo.pqGrid("refreshDataAndView");
            @endif
        });

        $(".confirmation-save").on("click", function () {
            @if ($itemid==-1)
                if ($('#optLocationPathAddVideo1').is(":checked")) { //T?p tin
                var arr = $("#pqGrid_W76F2021AddVideo").pqGrid("selection", {type: 'row', method: 'getSelection'});
                if (arr.length < 1)return false;
            }
            @endif
            if ($('#optLocationPathAddVideo0').is(":checked") || $("#hdAlbumItemIDAddVideo").val() != "") {
                var txtremark = $("#frmW76F2021AddVideo").find("#txtRemarkAddVideo");
                if (txtremark.val() == "") {
                    txtremark.get(0).setCustomValidity("{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}");
                    $("#frmW76F2021AddVideo").find("#btnSubmitAddvideo").click();
                    return false;
                }
                else {
                    txtremark.get(0).setCustomValidity("");
                }

                var txtpath = $("#frmW76F2021AddVideo").find("#txtPathYoutube");
                if (txtpath.val() == "") {
                    txtpath.get(0).setCustomValidity("{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}");
                    $("#frmW76F2021AddVideo").find("#btnSubmitAddvideo").click();
                    return false;
                }
                else {
                    txtpath.get(0).setCustomValidity("");
                }
            }
            $("#frmW76F2021AddVideo").find("#btnSubmitAddvideo").click();
        })
    });
</script>

