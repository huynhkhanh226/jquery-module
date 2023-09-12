<div id="gridW94F4001">

</div>
<script>
    $(function () {
        var data = [];
        var groupModel = {
            on: true,
            dataIndx: ['RegionName','CustomerName'],
            collapsed: [false, false],
            merge: true,
            showSummary: [true, true],
            grandSummary: true,
            title: [
                "{0} ({1})",
                "{0}"
            ]
        };
        var obj = {
            width: '100%',
            height: $(document).height() - 170,
            editable: false,
            //freezeCols: 1,
            minWidth: 30,
            pageModel: {type: "local", rPP: 20},
            filterModel: {on: true, mode: "AND", header: true},
            selectionModel: {type: 'cell', mode: 'single'},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            showTitle: false,
            dataType: "JSON",
            wrap: true,
            hwrap: false,
            collapsible: false,
            showTop: true,
            showToolbar:true,
            showHeader: true,
            postRenderInterval: -1,
            groupModel: groupModel,
            colModel: [
                {
                    title: "{{Helpers::getRS($g,"TinhThanh")}}",
                    minWidth: 140,
                    sortable: false,
                    dataType: "string",
                    dataIndx: "RegionName",
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ten_khach_hang")}}",
                    minWidth: 170,
                    sortable: false,
                    dataType: "string",
                    dataIndx: "CustomerName",
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ten_hang")}}",
                    minWidth: 170,
                    sortable: false,
                    dataType: "string",
                    dataIndx: "InventoryName",
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"DVT")}}",
                    minWidth: 50,
                    sortable: false,
                    dataType: "string",
                    dataIndx: "UnitName",
                    align: "center",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"So_luong")}}",
                    minWidth: 80,
                    sortable: false,
                    colModel: [
                        {
                            title: "{{Helpers::getRS($g,"SL_ban_")}}",
                            minWidth: 110,
                            sortable: false,
                            dataType: "float",
                            dataIndx: "SalesQuantity",
                            format: "{{Helpers::getStringFormat(Session::get("W91P0000")['D08_QuantityDecimals'])}}",
                            align: "right",
                            summary: { type: "sum" },
                            filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
                        },
                        {
                            title: "{{Helpers::getRS($g,"SL_khuyen_mai")}}",
                            minWidth: 110,
                            sortable: false,
                            dataType: "float",
                            dataIndx: "PromotionQuantity",
                            format: "{{Helpers::getStringFormat(Session::get("W91P0000")['D08_QuantityDecimals'])}}",
                            align: "right",
                            summary: { type: "sum" },
                            filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
                        },
                        {
                            title: "{{Helpers::getRS($g,"SL_tra_lai")}}",
                            minWidth: 110,
                            sortable: false,
                            dataType: "float",
                            dataIndx: "ReturnQuantity",
                            format: "{{Helpers::getStringFormat(Session::get("W91P0000")['D08_QuantityDecimals'])}}",
                            align: "right",
                            summary: { type: "sum" },
                            filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
                        },
                    ]
                },
                {
                    title: "{{Helpers::getRS($g,"Tien_hang")}}",
                    minWidth: 170,
                    sortable: false,
                    colModel: [
                        {
                            title: "{{Helpers::getRS($g,"Tien_ban_hang")}}",
                            minWidth: 140,
                            sortable: false,
                            dataType: "float",
                            dataIndx: "SalesAmount",
                            format: "{{Helpers::getStringFormat(Session::get("W91P0000")['D90_ConvertedDecimals'])}}",
                            align: "right",
                            summary: { type: "sum" },
                            filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
                        },
                        {
                            title: "{{Helpers::getRS($g,"Tien_hang_tra_lai")}}",
                            minWidth: 140,
                            sortable: false,
                            dataType: "float",
                            dataIndx: "ReturnAmount",
                            format: "{{Helpers::getStringFormat(Session::get("W91P0000")['D90_ConvertedDecimals'])}}",
                            align: "right",
                            summary: { type: "sum" },
                            filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
                        },
                        {
                            title: "{{Helpers::getRS($g,"Doanh_so")}}",
                            minWidth: 140,
                            sortable: false,
                            dataType: "float",
                            dataIndx: "Revenue",
                            format: "{{Helpers::getStringFormat(Session::get("W91P0000")['D90_ConvertedDecimals'])}}",
                            align: "right",
                            summary: { type: "sum" },
                            filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
                        }
                    ]
                },



            ],
            complete: function(event, ui){
                //resizePqGrid();
                $(".pq-grid-title-row").css("background-color", "#a7cf8b !important");
            },
            refresh: function(event, ui){
                $(".pq-grid-title-row").css("background-color", "#a7cf8b !important");
            },
            dataModel: { data: data }
        };
        $("#gridW94F4001").pqGrid(obj);
        $("#gridW94F4001").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $("#gridW94F4001").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $("#gridW94F4001").pqGrid("refreshDataAndView");
    });
    setTimeout(function(){
        resizePqGrid();
        $("#gridW94F4001").find(".pq-group-menu").addClass("hide");
        setTimeout(function(){
            resizePqGrid();
            $("#gridW94F4001").find(".pq-group-menu").addClass("hide");
        }, 1000);
    }, 300);
</script>
<style>
    #gridW94F4001 .pq-summary-row .pq-grid-cell{
        font-weight: bold;
    }
    #gridW94F4001 .pq-grid-title-row th{
        border-color:  #ededed !important;
    }
</style>
