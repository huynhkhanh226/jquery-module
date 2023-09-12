<div id="gridW94F4002">

</div>
<script>
    var obj = {
        width: '100%',
        height: $("#modalW94F4002").find(".modal-content").height() - 133,
        editable: false,
        freezeCols: 2,
        selectionModel: {type: 'cell'},
        minWidth: 30,
        //flexHeight: true,
        //pageModel: {type: "local", rPP: 20},
        filterModel: {on: true, mode: "AND", header: true},
        scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
        showTitle: false,
        dataType: "JSON",
        wrap: false,
        hwrap: false,
        collapsible: false,
        postRenderInterval: -1,
        colModel: [

            @foreach($rsColumns as $row)
            {
                title: function(ui){
                    console.log(ui);
                    var style = "";
                    var str = "{{$row['Caption']}}"
                    var before = "";
                    var after = "";
                    var fontColor = "{{$row['FontColor']}}";
                    var backgroundColor = "{{$row['BackgroundColor']}}";

                    var fontStyle = "{{$row['FontStyle']}}";
                    if (fontColor != '')
                        style+="color:" + fontColor + ";";
                    if (backgroundColor != '')
                        style+="background-color:" + backgroundColor + ";";
                    if (fontStyle != ''){
                        if (fontStyle.indexOf('B') != -1)
                            before += "<B>";
                        if (fontStyle.indexOf('I') != -1)
                            before += "<I>";
                        if (fontStyle.indexOf('U') != -1)
                            before += "<U>";
                        if (fontStyle.indexOf('B') != -1)
                            after += "</B>";
                        if (fontStyle.indexOf('I') != -1)
                            after += "</I>";
                        if (fontStyle.indexOf('U') != -1)
                            after += "</U>";
                    }
                    return "<SPAN class='"+ (backgroundColor == '' ? '' : 'background') +"' style='"+style+"'>" + before + str + after+ "</SPAN>";
                },
                width: {{$row["Width"]}},
                sortable: false,
                @if ($row["DataType"] == "N")
                dataType: "float",
                align: "right",
                format: "{{Helpers::getStringFormat($row['DecimalFormat'])  }}",
                filter: {type: "textbox", condition: "equal", listeners: ['keyup']},
                @elseif ($row["DataType"] == "S")
                dataType: "string",
                align: "left",
                filter: {type: "textbox", condition: "contain", listeners: ['keyup']},
                @else
                dataType: "date",
                align: "center",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']},
                @endif
                dataIndx: "{{$row['FieldName']}}",
                render: function(ui){
                    var rowData = ui.rowData;
                    var style = "";
                    var str = ui.formatVal == null || ui.formatVal == 0? "" : ui.formatVal;
                    var before = "";
                    var after = "";
                    var fontColor = rowData.FontColor+ ";";
                    var backgroundColor = rowData.BackgroundColor+ ";";
                    var fontStyle = rowData.FontStyle;

                    if (fontColor != '')
                        style+="color:" + fontColor;
                    if (backgroundColor != '')
                        style+="background-color:" + backgroundColor;
                    if (fontStyle != ''){
                        if (fontStyle.indexOf('B') != -1)
                            before += "<B>";
                        if (fontStyle.indexOf('I') != -1)
                            before += "<I>";
                        if (fontStyle.indexOf('U') != -1)
                            before += "<U>";
                        if (fontStyle.indexOf('B') != -1)
                            after += "</B>";
                        if (fontStyle.indexOf('I') != -1)
                            after += "</I>";
                        if (fontStyle.indexOf('U') != -1)
                            after += "</U>";
                    }
                    return {
                        text: "<SPAN style='"+style+"'>" + before + str + after+ "</SPAN>",
                        style: style
                    };
                }
            },
            @endforeach
            {
                title: "FontColor",
                minWidth: 230,
                dataType: "string",
                dataIndx: "FontColor",
                hidden: true

            },
            {
                title: "BackgroundColor",
                minWidth: 230,
                dataType: "string",
                dataIndx: "BackgroundColor",
                hidden: true

            },
            {
                title: "FontStyle",
                minWidth: 230,
                dataType: "string",
                dataIndx: "FontStyle",
                hidden: true

            },
        ],
        refresh: function(event, ui){
            //$("#gridW94F4002").find(".pq-grid-title-row").css("background-color", backgroundTitle);
            //$("#gridW94F4002").find(".ui-state-active").css("background-color", backgroundTitle);

        },
        complete: function(event, ui){
            var data = $("#gridW94F4002").pqGrid('option','dataModel.data');
            if (data.length > 0){
                console.log(data[0]);
                $("#lblUnitName").html(data[0].Unit);
            }

        },
        refresh: function(event, ui){

            var els = $(".background");
            console.log(els);
            $(els).closest('th').attr("style", $(els[0]).attr('style'));
        },
        dataModel: {
            data: []
        }
    };

    var $gridW94F4002 = $("#gridW94F4002").pqGrid(obj);
    $gridW94F4002.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $gridW94F4002.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    $gridW94F4002.pqGrid("refreshDataAndView");
    setTimeout(function (){
        var data = {{$rsData}};
        data = reformatData(data, $("#gridW94F4002"));
        $("#gridW94F4002").pqGrid('option', 'dataModel.data', data);
        resizePqGrid();

    }, 300);

    $(".pq-grid-col").click(function(){
        if ($(this).hasClass("ui-state-active")){
            $(this).removeAttr('style');
        }else{

        }
    });
</script>
