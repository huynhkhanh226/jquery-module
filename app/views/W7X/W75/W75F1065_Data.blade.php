<div id='gridW75F1065Data2'></div>
<script type="text/javascript">
    $(document).ready(function () {
        var data2 = {{ $data2}};

        var iWidth = $("#gridW75F1065History").width();
        var obj = {
            width: iWidth,
            height: 400,
            //height: '84%',
            editable: false,
            //freezeCols: 1,
            //title: "{{Helpers::getRS($g,'Du_lieu_tong_hop')}}",
            minWidth: 300,
            //pageModel: {type: "local", rPP: 10},
            showBottom: true,
            //selectionModel: { type: 'cell', mode: 'single' },
            scrollModel: {horizontal: false, pace: 'fast', autoFit: true, lastColumn: 'none'},
            showTitle: false,
            wrap: true,
            hwrap: true,
            collapsible: false,
            colModel: [
                {
                    title: "{{Helpers::getRS($g,"Ngay_phep")}}",
                    minWidth: iWidth*0.1,
                    dataType: "date",
                    dataIndx: "LeaveDate",
                    align: "center"
                },
                {
                    title: "{{Helpers::getRS($g,"Loai_phep")}}",
                    minWidth: iWidth*0.76,
                    dataType: "string",
                    dataIndx: "LeaveTypeName",
                    align: "left"
                },
                {
                    title: "{{Helpers::getRS($g,"So_luong")}}",
                    minWidth: iWidth*0.1,
                    align: "right",
                    dataIndx: "Quantity",
                    dataType: "float",
                    format: '{{\Helpers::getStringFormat($decimals)}}'
                    /*render: function (ui) {
                        var rowData = ui.rowData;
                        return format2(rowData["Quantity"], '', {{$decimals}});
                    }*/
                }
            ],
            dataModel: {
                data: data2
            }
        };
        var $gridW75F1065Data2 = $("#gridW75F1065Data2").pqGrid(obj);
        $gridW75F1065Data2.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        //$gridW75F1065Data2.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);


         var summaryData = [{
               Quantity:  format2({{$sumQuantity}}, '',2)
           }];

        setTimeout(function () {
           $("#gridW75F1065Data2").pqGrid({
               summaryData: summaryData
           });
           $("#gridW75F1065Data2").pqGrid("refreshDataAndView");
        }, 500);
    });
</script>																	