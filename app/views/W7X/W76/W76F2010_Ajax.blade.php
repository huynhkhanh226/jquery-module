<div id='gridW76F2010'></div>
<script>
    //to check whether any row is currently being edited.
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
        function pqDatePicker(ui) {
            var $this = $(this);
            $this
                    .css({zIndex: 3, position: "relative"})
                    .datepicker({
                        format: 'dd/mm/yyyy',
                        autoclose: true,
                        onClose: function (evt, ui) {
                            $(this).close();
                        }
                    });

        }

        var data = {{$data}};
        var obj = {
            width: '100%',
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
            selectionModel: {type: 'row', mode: 'single'},
            scrollModel: {lastColumn: 'auto', autoFit: true},
            postRenderInterval: -1,
            colModel: [
                {
                    title: "", editable: false, minWidth: 60, align: "center", sortable: false,
                    render: function (ui) {
                        var str = "";
                        var per = Number("{{Session::get($pFrom)}}");
                        if (per > 2)
                            str += "<a title='{{Helpers::getRS($g,"Sua")}}' id='btnEditW38F2010'><i class='glyphicon glyphicon-edit' style='color:orange;padding-right:5px'></i></a>";
                        if (per > 3)
                            str += "<a title='{{Helpers::getRS($g,"Xoa")}}' id='btnDeleteW38F2010'><i class='fa fa-trash'></i></a> ";
                        else
                            str += " <i class='fa fa-lock text-red' style='font-size: 110%;'></i> ";
                        return str;
                    },
                    postRender: function (ui) {
                        var rowIndx = ui.rowIndx,
                                grid = this,
                                $cell = grid.getCell(ui);
                        //edit button
                        $cell.find("a#btnEditW38F2010").unbind("click").bind("click", function (evt) {
                            callShowPopUpW76F2010(rowIndx, $gridW76F2010);
                        });
                        $cell.find("a#btnDeleteW38F2010").unbind("click").bind("click", function (evt) {
                            deleteAlbumW76F2010(rowIndx, $gridW76F2010);
                        });
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
                    minWidth: 400,
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
                    align: "center",
                    sortable: false,
                    dataIndx: "Disabled",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return '<input type="checkbox" disabled ' + (rowData["Disabled"] == 1 ? "checked" : "") + '>';
                    }
                }
            ],
            dataModel: {
                data: data

            },
            create: function (evt, ui) {
                filterDisabled("gridW76F2010", $("#chkShowDisabledW76F2010").is(":checked") ? "" : 0);
            }
        };
        var $gridW76F2010 = $("#gridW76F2010").pqGrid(obj);
        $gridW76F2010.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW76F2010.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridW76F2010.pqGrid("refreshDataAndView");
    });
</script>
