<div class="modal fade draggable" id="modalAddAudio" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width:700px;height:300px">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading(Helpers::getRS(4,"Them_audio"),"W76F2041", true, "close_add_Audio")}}
            </div>
            <div class="modal-body" style="padding:10px">
                <form class="form-horizontal" id="frmW76F2041AddAudio" name="frmW76F2041AddAudio">
                    <div class="row gridListFiles mgb5">
                        <div class="col-md-12">
                            <div id="pqGrid_W76F2041AddAudio"></div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12 col-xs-12" style="padding-right: 3px !important;">
                            <div class="pull-right">
                                <button type="button" id="btnSaveW76F2041"
                                        class="btn btn-default smallbtn pull-left mgr10 confirmation-save">
                                    <span class="glyphicon glyphicon-floppy-saved mgr5"></span>{{Helpers::getRS(4,"Luu")}}
                                </button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="hdFilePathAddAudio" name="hdFilePathAddAudio" value=""/>
                    <input type="hidden" id="hdAlbumIDAddAudio" name="hdAlbumIDAddAudio"
                           value="{{$id}}"/>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $("#modalAddAudio").on('shown.bs.modal', function () {
        var data = {{json_encode($rsListAudio)}};
        var obj = {
            width: 680,
            height: 285,
            showTitle: false,
            wrap: false,
            hwrap: false,
            collapsible: false,
            sortable: false,
            scrollModel: {lastColumn: 'auto', autoFit: true},
            colModel: [
                {
                    title: "<label><input type='checkbox'/></label>",
                    dataIndx: "IsSelect",
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
                    title: "{{Helpers::getRS(4,"Ten_Audio")}}",
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
                    editable: false,
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
            }
        };
        var $gridW76F2041AddAudio = $("#pqGrid_W76F2041AddAudio").pqGrid(obj);
        $gridW76F2041AddAudio.pqGrid("refreshDataAndView");
    });

    $(".confirmation-save").on("click", function () {
        var data = $("#pqGrid_W76F2041AddAudio").pqGrid("option", "dataModel.data");
        var bcheck = false;var list = [];
        for (var i = 0, len = data.length; i < len; i++) {
            var rowData = data[i];
            if (rowData.IsSelect) {
                bcheck = true;
                list.push(rowData);
            }
        }
        if (bcheck){
            $.ajax({
                method: "POST",
                url: "{{Request::url()}}",
                data: {
                    list: list,
                    id: "{{$id}}",
                    thumb: $("#hdThumbnailW76F2041").val()
                },
                success: function (data) {
                  //  $(".l3loading").addClass('hide');
                    if (data == 1) {
                        $("#btnSaveW76F2041").addClass("hide");
                        save_ok();
                        loadGridW76F2041("{{$id}}");
                    } else {
                        save_not_ok();
                    }
                }
            });
        }
    });
</script>

