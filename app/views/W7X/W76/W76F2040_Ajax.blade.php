<div id='gridW76F2040'></div>
<script>
    $(document).ready(function () {
        var data = {{$rsData}};
        var obj = {
            width: $("#tbl_content").width(),
            height: 400,
            editable: false,
            freezeCols: 1,
            minWidth: 30,
            pageModel: {type: "local", rPP: 20},
            filterModel: {on: true, mode: "AND", header: true},
            showTitle: false,
            wrap: false,
            hwrap: false,
            collapsible: false,
            scrollModel: {lastColumn: 'auto', autoFit: true},
            selectionModel: {type: 'row', mode: 'single'},
            colModel: [
                {
                    title: "", minWidth: 60, align: "center", sortable: false, render: function (ui) {
                    var rowData = ui.rowData;
                    var str = "";
                    var per = Number("{{Session::get($pFrom)}}");
                    if (per > 2)
                        str += "<a title='{{Helpers::getRS($g,"Sua")}}' onclick='showW76F2040(\""+rowData["AlbumID"]+"\")'><i class='glyphicon glyphicon-edit' style='color:orange;padding-right:5px'></i></a>";
                    if (per > 3)
                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' onclick='deleteW76F2040(\""+rowData["AlbumID"]+"\")'><i class='fa fa-trash'></i></a> ";
                    else
                        str += " <i class='fa fa-lock text-red' style='font-size: 110%;'></i> ";
                    return str;
                }
                },
                {
                    title: "",
                    minWidth: 60,
                    dataType: "string",
                    dataIndx: "AlbumID",
                    align: "left",
                    hidden: true,
                    filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ten_album")}}",
                    minWidth: 420,
                    dataType: "string",
                    dataIndx: "AlbumName",
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"So_luong")}}",
                    minWidth: 80,
                    dataType: "integer",
                    dataIndx: "Quantity",
                    align: "right",
                    filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ngay_tao")}}",
                    minWidth: 100,
                    dataType: "string",
                    align: "center",
                    dataIndx: "AlbumDate",
                    filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                },
                {
                    title: "{{Helpers::getRS($g,"Nguoi_tao")}}",
                    minWidth: 110,
                    dataType: "string",
                    dataIndx: "CreateUserID",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"KSD")}}",
                    editable: false,
                    minWidth: 55,
                    dataIndx: "Disabled",
                    align: "center",
                    sortable: false,
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return '<input type="checkbox" disabled ' + (rowData["Disabled"] == 1 ? "checked" : "") + '>';
                    }
                }
            ],
            dataModel: {
                data: data
            }
        };
        obj.create = function (evt, ui) {
            filterDisabled("gridW76F2040",$("#chkShowDisabledW76F2040").is(":checked")?"":0);
        };
        var $gridW76F2040 = $("#gridW76F2040").pqGrid(obj);
        $gridW76F2040.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW76F2040.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridW76F2040.pqGrid("refreshDataAndView");
    });
</script>
