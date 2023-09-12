<div id='gridW76F2041'></div>
<script>
    $(document).ready(function () {
        var data = {{json_encode($dsAudio)}};
        var obj = {
            width: '100%',
            height: 360,
            editable: false,
            freezeCols: 1,
            minWidth: 30,
            pageModel: {type: "local", rPP: 20},
            scrollModel: {lastColumn: 'auto', autoFit: true},
            filterModel: {on: true, mode: "AND", header: true},
            selectionModel: {type: 'row', mode: 'single'},
            showTitle: false,
            wrap: false,
            hwrap: false,
            collapsible: false,
            colModel: [
                {
                    title: "", editable: false, minWidth: 50, maxWidth: 50, sortable: false, align:"center",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return "<a title='{{Helpers::getRS(4,"Xoa")}}' onclick='deletevideoW75F2021(\"" + rowData["AlbumItemID"] + "\")'><i class='fa fa-trash'></i></a>";
                    }
                },
                {
                    title: "",
                    minWidth: 220,
                    dataType: "string",
                    dataIndx: "AlbumItemID",
                    hidden: true,
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS(4,"Ten_tap_tin")}}",
                    minWidth: 400,
                    dataType: "string",
                    dataIndx: "RemarkU",
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS(4,"Duong_dan")}}",
                    minWidth: 270,
                    dataType: "string",
                    dataIndx: "LocationPath",
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                }
            ],
            dataModel: {
                data: data

            }
        };
        var $gridW76F2041 = $("#gridW76F2041").pqGrid(obj);
        $gridW76F2041.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW76F2041.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridW76F2041.pqGrid("refreshDataAndView");
    });

    function deletevideoW75F2021(id) {
        ask_delete(function () {
            $("#gridW76F2041").pqGrid("showLoading");
            $.ajax({
                method: "DELETE",
                url: "W76F2041/action/",
                data: {id: id},
                success: function (data) {
                    if (data == 1) {
                        update4ParamGrid($("#gridW76F2041"), null, 'delete');
                    } else {
                        save_not_ok();
                    }
                    $("#gridW76F2041").pqGrid("hideLoading");
                }
            });
        });
    }
</script>
