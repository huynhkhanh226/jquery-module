<div id="gridW75F3040"></div>
<script type="text/javascript">
    $(document).ready(function () {
        var obj = {
            width: '100%',
            numberCell: {show: true},
            height: $(document).height() - 160,
            //resizable: true,
            showTitle: false,
            collapsible: false,
            selectionModel: {type: 'row', mode: 'single'},
            filterModel: {on: true, mode: "AND", header: true},
            //scrollModel: {autoFit: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
            rowBorders: true,
            columnBorders: true,
            postRenderInterval: -1,
            freezeCols: 1,
            hwrap: false,
            wrap: false,
            sortable: false,
        };
        obj.colModel = [
            {
                title: '{{Helpers::getRS($g,"Ten_NV")}}',
                //minWidth: 20,
                width: 230,
                dataType: "string",
                editor: false,
                align: "left",
                dataIndx: "EmployeeName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: '{{Helpers::getRS($g,"Chuc_vu")}}',
                //minWidth: 20,
                width: 230,
                dataType: "string",
                editor: false,
                align: "left",
                dataIndx: "DutyName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: '{{Helpers::getRS($g,"Ngay_sinh")}}',
                //minWidth: 20,
                width: 110,
                dataType: "date",
                editor: false,
                align: "center",
                dataIndx: "BirthDate",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: '{{Helpers::getRS($g,"Ngay_vao_lam")}}',
                //minWidth: 20,
                width: 110,
                dataType: "date",
                editor: false,
                align: "center",
                dataIndx: "DateJoined",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            }

            @foreach($columns as $column)
                ,
                {
                    title: '{{$column["IncomeCaption"]}}',
                    width: 110,
                    dataType: "float",
                    editor: false,
                    align: "right",
                    format: "{{Helpers::getStringFormat(2,'','')}}",
                    dataIndx: '{{$column["IncomeField"]}}',
                    filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
                }
            @endforeach

        ];
        obj.dataModel = {
            data: {{json_encode($rsData)}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        };

        obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
        var gridW75F3040 = $("#gridW75F3040").pqGrid(obj);
        gridW75F3040.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        gridW75F3040.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        gridW75F3040.pqGrid("refreshDataAndView");

        setTimeout(function(){
            resizePqGrid();
        }, 300);
        //resizePqGrid();
    });
</script>

