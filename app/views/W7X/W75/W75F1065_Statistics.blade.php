<div id='gridStatistics'></div>
<script type="text/javascript">
    $(document).ready(function () {
        var data2 = [];

        var obj = {
            width: "100%",
            height: 285,
            //height: '84%',
            editable: false,
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
                    title: "{{Helpers::getRS($g,"Loai_phep")}}",
                    minWidth: 140,
                    dataType: "string",
                    dataIndx: "LeaveTypeName",
                    align: "left",
                    editor: false
                },
                {
                    title: "{{Helpers::getRS($g,"Ngay_phep")}}",
                    minWidth: 110,
                    dataType: "date",
                    dataIndx: "LeaveDate",
                    align: "center",
                    editor: false
                },
                {
                    title: "{{Helpers::getRS($g,"So_luong")}}",
                    minWidth: 80,
                    align: "right",
                    dataIndx: "DetailQty",
                    dataType: "float",
                    format: '{{\Helpers::getStringFormat($decimals)}}',
                    editor: false
                }
            ],
            dataModel: {
                data: data2
            }
        };
        var $gridStatistics = $("#gridStatistics").pqGrid(obj);
        $gridStatistics.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);

        setTimeout(function(){
            $("#gridStatistics").pqGrid("refreshDataAndView");
        }, 300);

    });
</script>																	