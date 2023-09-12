<div id="pqgrid_W09F4291" style="margin:auto;"></div>
<script type="text/javascript">
    var iW09F4291Height;
    var iW09F4291Width;

    $(document).ready(function () {
        iW09F4291Width = '100%';
        iW09F4291Height = $(".contenttab").height() - 95;
        var obj = {
            width: iW09F4291Width,
            height: iW09F4291Height,
            showTitle: false,
            selectionModel: { type: 'row', mode: 'single'},
            collapsible: false,
            editable: false,
            sortable: false,
            freezeCols:{{$rsCol[0]['SplitNo']+1}},
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'}
        };
        obj.colModel = [
            {
                title: "DisplayOrder",
                dataIndx: "DisplayOrder",
                hidden: true,
                isExport: false
            }
            @foreach($rsCol as $row)
                ,{
                title: "{{$row['Caption']}}",
                @if ($row['DataType']=="S")
                align: "left",
                dataType: "string",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                @elseif($row['DataType']=="N")
                align: "right",
                dataType: "float",
                format: returnSFormat({{$row['DataFormat']}}),
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                @else
                align: "center",
                dataType: "date",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']},
                @endif
                minWidth: {{$row['Length']}},
                dataIndx: "{{$row['FieldName']}}"
            }
            @endforeach
        ];
       // var arrayCol =  {{json_encode($rsCol)}};
        //var myObj = {};
        //myObj["first_name"] = "Bob";
       // var json = JSON.stringify(myObj);
        var arrayData =  {{json_encode($rsData)}};
        obj.dataModel = {
            data: arrayData,
            location: "local",
            sorting: "local",
            sortDir: "down"
        };

        var $grid = $("#pqgrid_W09F4291").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
    });

</script>