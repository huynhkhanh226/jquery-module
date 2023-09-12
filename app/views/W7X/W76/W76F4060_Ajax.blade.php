<div id="pqgrid_W76F4060"></div>
<script type="text/javascript">
    $(document).ready(function () {
        var obj = {
            width: '100%',
            @if ($per > 0)
            height: documentHeight - 101,
            @else
            height: documentHeight - 117,
            @endif
            showTitle: false,
            collapsible: false,
           // editable: false,
            selectionModel: { type: 'row', mode: 'single'},
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel:{ horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none' }
        };
        obj.colModel = [
            @if ($per > 0)
            {
                title: "",
                minWidth: 20,
                width: 20,
                align: "center",
                dataIndx: "View",
                editor: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = '<a title="{{Helpers::getRS($g,"Xem")}}" onclick="callW76F4061(\'' + rowData["DocID"] + '\')"><i class="glyphicon glyphicon-edit text-yellow" style="padding-right: 5px"></i></a>';
                    str += '<a title="{{Helpers::getRS($g,"Xoa")}}" onclick="deleteW76F4060(\''+rowData["DocID"]+'\');"><i class="glyphicon glyphicon-bin text-black"></i></a>';
                    return str;
                }
            },
            @endif
            {
                title: "{{Helpers::getRS($g,'Ngay')}}",
                minWidth: 40,
                dataType: "date",
                align: "center",
                editor: false,
                dataIndx: "UploadedDate",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,'Dien_giai')}}",
                minWidth: 200,
                width: 250,
                dataType: "string",
                dataIndx: "DocDesc",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Nhom')}}",
                minWidth: 60,
                width: 80,
                align: "center",
                dataType: "string",
                editor: false,
                dataIndx: "DocCategoryDesc",
                filter: {
                    type: 'select',
                    condition: 'equal',
                    prepend: {'': '-- {{Helpers::getRS($g,'Chon')}} --'},
                    valueIndx: "DocCategoryDesc",
                    labelIndx: "DocCategoryDesc",
                    listeners: ['change']
                }
            },
            {
                title: "{{Helpers::getRS($g,'Nguoi_tao')}}",
                minWidth: 60,
                width: 110,
                dataType: "string",
                editor: false,
                dataIndx: "CreateUserName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ten_tap_tin')}}",
                minWidth: 200,
                width: 220,
                dataType: "string",
                dataIndx: "FileName",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                render: function(ui){
                    var rowData = ui.rowData;
                    return rowData["FileName"] + "&nbsp;&nbsp;<a onclick='GetFileW76F4060(\""+rowData["DocID"]+"\", \""+rowData["FileName"]+"\")' title='Download file' class='text-blue fa fa-download'>&nbsp;"+"</a>";
                }
            },
            {
                title: "{{Helpers::getRS($g,'Loai_tap_tin')}}",
                minWidth: 50,
                width: 50,
                align: "center",
                dataType: "string",
                editor: false,
                dataIndx: "FileType",
                render: function(ui){
                    var rowData = ui.rowData;
                    return "<i class='fa "+rowData["IconClass"]+"'>&nbsp;"+"</i>";
                }
            },
            {
                title: "{{Helpers::getRS($g,'Do_lon')}}",
                minWidth: 50,
                width: 60,
                align: "center",
                dataType: "string",
                editor: false,
                dataIndx: "FileSize",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                render: function (ui) {
                    var rowData = ui.rowData;
                    return formatBytes(rowData["FileSize"],1);
                }
            }

        ];
        obj.dataModel = {
            data: {{json_encode($rsData)}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        };
        obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
        var $grid = $("#pqgrid_W76F4060").pqGrid(obj);
        //Get datafilter for Source col
        $grid.on("pqgridrefresh", function (event, ui) {
            var column = $grid.pqGrid("getColumn", {dataIndx: "DocCategoryDesc"});
            var filter = column.filter;
            filter.cache = null;
            filter.options = $grid.pqGrid("getData", {dataIndx: ["DocCategoryDesc"]});
            //=======================================================
        });
        var column = $grid.pqGrid("getColumn", {dataIndx: "DocCategoryDesc"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $grid.pqGrid("getData", {dataIndx: ["DocCategoryDesc"]});
        //=======================================================
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
    });

</script>