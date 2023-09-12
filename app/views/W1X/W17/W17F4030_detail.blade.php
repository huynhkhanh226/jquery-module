


<div class="modal draggable fade" id="modalW17F4030"  data-backdrop="static"  role="dialog">
    <div class="modal-dialog" style="width: 95%">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading(Helpers::getRS($g,"Chi_tiet"),"W17F4030")}}
            </div>
            <div class="modal-body">
                <div id="detailW17f4030"></div>

            </div>
        </div>

    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    var obj = {
        width: "100%",
        height: $(document).height() - 150,
        editable: false,
        //freezeCols: 1,
        numberCell: {show: false},
        minWidth: 150,
        showTitle: false,
        wrap: true,
        hwrap: true,
        collapsible:false,
        dataModel: {
            data: {{json_encode($rsData)}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        },

        postRenderInterval: -1,
        selectionModel: {type: 'row', mode: 'single'},
        scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},

        //filterModel: {on: true, mode: "AND", header: true},
        colModel: [
                @foreach($rsColumns as $col)
            {
                title: "{{$col['Caption']}}",
                minWidth: 10,
                width: Number('{{$col['Length']}}'),
                @if ($col['DataType'] == "N")
                    dataType: "float",
                    format: "{{\Helpers::getStringFormat($col['DataFormat'])}}",
                    filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                    algin: "right",
                @endif
                @if ($col['DataType'] == "S")
                    algin: "left",
                    dataType: "string",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},

                @endif
                @if ($col['DataType'] == "D")
                    dataType: "date",
                    filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']},
                    algin: "center",
                @endif
                editor: false,
                editable: false,
                dataIndx: "{{$col['FieldName']}}",
                @if ($col['ControlType'] == "CheckBox")
                align: "center",
                render: function(ui){
                    var rowData = ui.rowData;
                    return "<input type='checkbox' disabled='disabled' " + (rowData[ui.dataIndx] == 1 ? 'checked' : '') + "/>"
                },
                @endif

            },
            @endforeach
        ]


    };
    $("#detailW17f4030").pqGrid(obj);
    $("#detailW17f4030").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $("#detailW17f4030").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    $("#detailW17f4030").pqGrid("refreshDataAndView");

    setTimeout(function(){
        $("#detailW17f4030").pqGrid("refreshDataAndView");
    }, 300);

</script>
