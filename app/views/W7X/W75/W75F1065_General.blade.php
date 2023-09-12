<div id='gridW75F1065Data1'></div>
<script type="text/javascript">
    $(document).ready(function () {
        var data1 = {{$data1}};
        var obj = {
            width: $("#gridW75F1065History").width(),
            //height: $("#modalW75F1065").find("#tbHistory").height() - 85,
            height: 400,
            editable: false,
            //freezeCols: 1,
            //title: "{{Helpers::getRS($g,'Du_lieu_tong_hop')}}",
            minWidth: 30,
            pageModel: {type: "local", rPP: 10},
            showBottom: false,
            //selectionModel: { type: 'cell', mode: 'single' },
            showTitle: false,
            wrap: true,
            hwrap: true,
            collapsible: false,
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            colModel: [
                {
                    title: "{{Helpers::getRS($g,"Loai_phep")}}",
                    minWidth: 140,
                    dataType: "string",
                    dataIndx: "LeaveTypeName",
                    align: "left"
                },
                {
                    title: "{{Helpers::getRS($g,"So_luong_duoc_cap")}}", minWidth: 80, align: "right",
                    dataIndx: "Quantity",
                    format: '{{\Helpers::getStringFormat($decimals)}}'
                    /*render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["Quantity"], '', {{$decimals}});
                    }*/
                },
                {
                    title: "{{Helpers::getRS($g,"So_luong_da_nghi_den").' '.$tranmonth.'/'.$tranyear}}",
                    minWidth: 80,
                    align: "right",
                    dataIndx: "UsedLeaveQuan",
                    format: '{{\Helpers::getStringFormat($decimals)}}'
                    /*render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["UsedLeaveQuan"], '', {{$decimals}});
                    }*/
                },
                {
                    title: "{{Helpers::getRS($g,"So_luong_ton_den").' '.$tranmonth.'/'.$tranyear}}",
                    minWidth: 80,
                    align: "right",
                    dataIndx: "ToPeriodLB",
                    format: '{{\Helpers::getStringFormat($decimals)}}'
                    /*render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["ToPeriodLB"], '', {{$decimals}});
                    }*/
                },
                {
                    title: "{{Helpers::getRS($g,"So_luong_ton_den_cuoi_nam")}}", minWidth: 80, align: "right",
                    dataIndx: "ClosingLB",
                    format: '{{\Helpers::getStringFormat($decimals)}}',
                    /*render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["ClosingLB"], '', {{$decimals}});
                    }*/
                }
            ],
            dataModel: {
                data: data1
            }
        };
        var $gridW75F1065Data1 = $("#gridW75F1065Data1").pqGrid(obj);
        $gridW75F1065Data1.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW75F1065Data1.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridW75F1065Data1.pqGrid("refreshDataAndView");

    });
</script>																	