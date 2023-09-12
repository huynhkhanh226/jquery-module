<div id="pqgrid_W09F4292" style="margin:auto;"></div>
<script type="text/javascript">

    $(document).ready(function () {
        var iW09F4292Height = $(".contenttab").height() - 255;
        var arrayData =  {{json_encode($rsData)}};
        var groupModel = {
            on: true,
            dataIndx: ['ObjectName'],
            collapsed: [false],
            merge: true,
            showSummary: [true],
            grandSummary: true,
            header: false,
            title: ["{0}","{0}"]
        };
        var obj = {
            width: '100%',
            height: iW09F4292Height,
            showTitle: false,
            selectionModel: {type: 'row', mode: 'single'},
            collapsible: false,
            editable: false,
            sortable: false,
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            groupModel: groupModel
        };
        obj.colModel = [
            {
                title: "{{Helpers::getRS($g,"Khach_hang")}}",
                align: "left",
                dataType: "string",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                minWidth: 200,
                dataIndx: "ObjectName"
            },
            {
                title: "{{Helpers::getRS($g,"Du_an")}}",
                align: "left",
                dataType: "string",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                minWidth: 110,
                dataIndx: "ProjectID"
            },
            {
                title: "{{Helpers::getRS($g,"Ten_du_an")}}",
                align: "left",
                dataType: "string",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                minWidth: 170,
                dataIndx: "ProjectName"
            },
            {
                title: "{{Helpers::getRS($g,"Tong_so_gio")}}",
                align: "right",
                dataType: "float",
                format: returnSFormat(2),
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                minWidth: 170,
                dataIndx: "TotalHours",
                summary: { type: "sum" }
            },
            {
                title: "{{Helpers::getRS($g,"Tong_thanh_tien")}}",
                align: "right",
                dataType: "float",
                format: returnSFormat(2),
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                minWidth: 170,
                dataIndx: "TotalAmount",
                summary: { type: "sum" }
            },
            {
                title: "{{Helpers::getRS($g,"Tong_thanh_tien")." USD"}}",
                align: "right",
                dataType: "float",
                format: returnSFormat(2),
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                minWidth: 170,
                dataIndx: "TotalAmountUSD",
                summary: { type: "sum" }
            }
        ];

        obj.dataModel = {
            data: arrayData,
            location: "local",
            sorting: "local",
            sortDir: "down"
        };

        var $grid = $("#pqgrid_W09F4292").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
    });

</script>