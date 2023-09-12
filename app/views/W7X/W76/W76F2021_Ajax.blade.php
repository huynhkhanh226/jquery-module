<div id='gridW76F2021'></div>
<script>
    function isEditing($grid) {
        var rows = $grid.pqGrid("getRowsByClass", {cls: 'pq-row-edit'});
        if (rows.length > 0) {
            //focus on editor if any
            $grid.find(".pq-editor-focus").focus();
            return true;
        }
        return false;
    }

    $(document).ready(function () {
        var data = {{json_encode($dsVideoList)}};
        var obj = {
            width: '100%',
            height: 360,
            editable: false,
            freezeCols: 1,
            minWidth: 30,
            pageModel: {type: "local", rPP: 10},
            scrollModel: {lastColumn: 'auto', autoFit: true},
            filterModel: {on: true, mode: "AND", header: true},
            showTitle: false,
            wrap: false,
            hwrap: false,
            collapsible: false,
            colModel: [
                {
                    title: "", editable: false, minWidth: 50, maxWidth: 50, sortable: false,
                    render: function (ui) {
                        var rowData = ui.rowData;
                        var str = "";
                        if (rowData["FileType"]==0)
                            str += "&nbsp;<a title='{{Helpers::getRS($g,"Sua")}}' id='btnEditW38F2021'><i class='glyphicon glyphicon-edit' style='color:orange;padding-right:5px'></i></a>";
                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' onclick='deletevideoW75F2021(\""+rowData["AlbumItemID"]+"\")'><i class='fa fa-trash'></i></a>";
                        return str;
                    }
                },
                {
                    title: "",
                    width: 220,
                    dataType: "string",
                    dataIndx: "AlbumItemID",
                    hidden: true,
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ten_video")}}",
                    width: 400,
                    dataType: "string",
                    dataIndx: "RemarkU",
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Nguon")}}",
                    width: 80,
                    dataType: "string",
                    dataIndx: "FileType",
                    align: "center",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                    render: function (ui) {
                        var rowData = ui.rowData;
                        if (rowData["FileType"]==0)
                        return "Youtube";
                            else
                        return "{{Helpers::getRS($g,"Tap_tin")}}";
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Duong_dan")}}",
                    width: 270,
                    dataType: "string",
                    dataIndx: "LocationPath",
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                }
            ],
            dataModel: {
                data: data

            },
            refresh: function () {
                //debugger;
                var $gridW76F2021 = $(this);
                if (!$gridW76F2021) {
                    return;
                }
                //Sua
                $gridW76F2021.find("a#btnEditW38F2021")
                        .unbind("click")
                        .bind("click", function (evt) {
                            if (isEditing($gridW76F2021)) {
                                return false;
                            }
                            var $tr = $(this).closest("tr"),
                                    rowIndx = $gridW76F2021.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                            callShowPopUpW75F2021_AddVideo(rowIndx, $gridW76F2021);
                        });
                $gridW76F2021.find("a#btnDeleteW38F2021")
                        .unbind("click")
                        .bind("click", function (evt) {
                            if (isEditing($gridW76F2021)) {
                                return false;
                            }
                            var $tr = $(this).closest("tr"),
                                    rowIndx = $gridW76F2021.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                            deleteAlbumW75F2021_AddVideo(rowIndx, $gridW76F2021);
                        });
            }
        };
        var $gridW76F2021 = $("#gridW76F2021").pqGrid(obj);
        $gridW76F2021.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW76F2021.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridW76F2021.pqGrid("refreshDataAndView");
    });

    function deletevideoW75F2021(id) {
        ask_delete(function(){
            $(".l3loading").removeClass('hide');
            $.ajax({
                method: "DELETE",
                url: "W76F2021/removevideo/" + id,
                success: function (data) {
                    $(".l3loading").addClass('hide');
                    if (data==1)
                    {
                        update4ParamGrid($("#gridW76F2021"),null,'delete');
                    }else{
                        save_not_ok();
                    }
                }
            });
        });
    }
</script>
