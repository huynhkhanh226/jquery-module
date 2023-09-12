<div id="pqgrid_W01F3050" style="margin:auto;"></div>
<div id="pqgrid_W01F3050Detail" class="mgt5 hide" style="margin:auto;"></div>
<script type="text/javascript">
    var iW01F3050Height;
    $(document).ready(function () {
        iW01F3050HeightFull = $(".contenttab").height() - 90;
        iW01F3050Height = ($(".contenttab").height() - 95) / 2;
        var obj = {
            width: '100%',
            height: iW01F3050HeightFull,
            showTitle: true,
            showHeader: true,
            showTop:true,
            showBottom : true,
            collapsible: { collapsed : false },
            //numberCell: true,
            editable: false,
            sortable: false,
            //freezeCols: 1,
            //hwrap:false,

            selectionModel: {type: 'row', mode: 'single'},
            wrap: false,
            scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
            filterModel: {on: true, mode: "AND", header: true},

        };
        @define $caption = "FieldCaption".$lang
        obj.colModel = [
                @foreach($colList as $col)
                    @if($col['FieldName'] != 'OrderNo')
                        {
                            title: "{{$col[$caption]}}",
                            minWidth: 90,
                            width: {{$col['Width']}},
                            dataIndx: "{{$col['FieldName']}}",
                            hidden: "{{$col['IsHide'] == 1 ? true:false}}",


                            @if ($col['DataType'] == 'N')
                                format: "{{\Helpers::getStringFormat($col['DataFormat'])}}",
                                //summaryOptionsType: "sum",
                            @endif
                            @if ($col['DataType'] == 'N')
                                dataType: "float",
                                shortType: "N",
                                align:"right",
                                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                            @endif
                            @if ($col['DataType'] == 'D')
                                dataType: "date",
                                shortType: "D",
                                align:"center",
                                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']},
                            @endif
                            @if ($col['DataType'] == 'S')
                                dataType: "string",
                                shortType: "S",
                                align:"left",
                                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                            @endif


                        },
                    @endif
                @endforeach
        ];

        var arrayData =  {{json_encode($dataList)}};
        obj.dataModel = {
            data: arrayData,
            location: "local",
            sorting: "local",
            sortDir: "down"
        };

        obj.summaryData = sumFooter('{{json_encode($dataList)}}','{{json_encode($colList)}}', false);

        obj.complete = function( event, ui ) {
            $.contextMenu({
                selector: "#pqgrid_W01F3050",
                callback: function(key, options) {
                    switch (key){
                        case 'menuCash':

                                if ($("#pqgrid_W01F3050Detail").hasClass('hide')){
                                    $("#pqgrid_W01F3050Detail").removeClass('hide');
                                    $( "#pqgrid_W01F3050" ).pqGrid( "option", "height", iW01F3050Height );
                                }else{
                                    $("#pqgrid_W01F3050Detail").addClass('hide')
                                    $( "#pqgrid_W01F3050" ).pqGrid( "option", "height", iW01F3050HeightFull );
                                }


                            $("#pqgrid_W01F3050Detail").pqGrid("refreshDataAndView");
                            $("#pqgrid_W01F3050").pqGrid("refreshDataAndView");
                            $("#pqgrid_W01F3050Detail").pqGrid("refreshDataAndView");
                            $("#pqgrid_W01F3050").pqGrid("refreshDataAndView");

                    }
                },
                items: {
                    "menuCash": {name: "{{Helpers::getRS($g,"Thuyet_minh_tien_luu_thong")}}", icon: "fa-money"},
                }
            });

        };

        obj.filter = function( event, ui ) {
            $("#pqgrid_W01F3050").pqGrid({
                summaryData : sumFooter('#pqgrid_W01F3050','{{json_encode($colList)}}',true)
            });
        }



        $("#pqgrid_W01F3050").pqGrid(obj);
        $("#pqgrid_W01F3050").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $("#pqgrid_W01F3050").pqGrid("refreshDataAndView");
        /*setTimeout(function(){
            $("#pqgrid_W01F3050").pqGrid("refreshDataAndView");
        },200);*/



        //-------------------------------------------------
        var obj1 = {
            width: '100%',
            height: iW01F3050Height,
            showTitle: true,
            showTop:true,
            collapsible: { collapsed : false },
            numberCell: false,
            showBottom:true,
            editable: false,
            sortable: false,
            //freezeCols: 1,
            //hwrap:false,
            selectionModel: {type: 'row', mode: 'single'},
            wrap: false,
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            //filterModel: {on: true, mode: "AND", header: true},
        };
        @define $caption = "FieldCaption".$lang
        obj1.colModel = [
                @foreach($colList1 as $col1)
                    @if($col1['FieldName'] != 'OrderNo')
                        {

                            title: "{{$col1[$caption]}}",
                            minWidth: 80,
                            width: {{$col['Width']}},

                            @if ($col1['DataType'] == 'N')
                                format: "{{\Helpers::getStringFormat($col1['DataFormat'])}}",
                            @endif
                            @if ($col1['DataType'] == 'N')
                                dataType: "float",
                                align:"right",
                                summary: { type: "sum" },
                                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},

                            @endif
                            @if ($col1['DataType'] == 'D')
                                dataType: "date",
                                align:"center",
                                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']},
                            @endif
                            @if ($col1['DataType'] == 'S')
                                dataType: "string",
                                align:"left",
                                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                            @endif

                            dataIndx: "{{$col1['FieldName']}}",
                            decimal: "{{$col1['DataFormat']}}",
                            hidden: "{{$col1['IsHide'] == 1 ? true:false}}",
                            render: function (ui) {
                                var row = ui.rowData;
                                var style = row['Style'];
                                var format = row.Style;
                                var arr = format.split(",");
                                var str = '';
                                //console.log(ui.column.dataType);
                                if (ui.column.dataType == 'float'){
                                    str = format2(row[ui.dataIndx],'',ui.column.decimal);
                                }
                                else{
                                    str = row[ui.dataIndx];
                                }
                                for(var i=0;i<arr.length;i++){
                                    if (i == 0){
                                        console.log(arr[i].substring(0,2));
                                    }

                                    if (arr[i].substring(0,2) == 'B'){
                                        str = "<b>" + str + "</b>";
                                    }

                                    if (arr[i].substring(0,2) == 'I'){
                                        str = "<i>" + str + "</i>";
                                    }

                                    if (arr[i].substring(0,2) == 'F_'){
                                        console.log(arr[i].substring(2,arr[i].length));
                                        str = "<span style='color: "+arr[i].substring(2,arr[i].length)+"'>" + str + "</span>";
                                    }

                                }
                                return {
                                    text: str,
                                    //style: "color:blue",
                                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                                };
                            },
                        },
                    @endif
                 @endforeach
        ];

        obj1.complete = function( event, ui ) {
            /*//console.log('complete 2');
            $grid = $("#pqgrid_W01F3050Detail");
            var objTemp = $grid.pqGrid("option", "dataModel.data");
            if (objTemp.length > 0) {
                for (var i = 0; i < objTemp.length; i++) {
                    var format = objTemp[i].Style;
                    var arr = format.split(",");
                    //console.log(format);
                    for(var i=0;i<arr.length;i++){
                        //console.log('for');
                        switch (arr[i].substring(0,1)){
                            case 'B'://In đậm
                                //console.log('B');
                                break;
                            case 'I'://In nghiêng
                                break;
                            default:
                                break;
                        }
                    }

                    $grid.pqGrid( "attr",
                            {rowIndx: i, dataIndx: 'Description', attr: { style: 'color:red' } }
                    );


                }
            }*/
        };



        var arrayData1 =  {{json_encode($dataList1)}};
        obj1.dataModel = {
            data: arrayData1,
            location: "local",
            sorting: "local",
            sortDir: "down"
        };


        $("#pqgrid_W01F3050Detail").pqGrid(obj1);
        $("#pqgrid_W01F3050Detail").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $("#pqgrid_W01F3050Detail").pqGrid("refreshDataAndView");
    });

    function showDetailW01F3050(){
        $.ajax({
            method: "POST",
            url: '{{url("/W01F3050/$pForm/$g/action/detail")}}',
            data: $('#frmW01F3050').serialize() + '&isViewMoreDivOut='+isViewMoreDivOut+'&isOnlyViewDivOut='+isOnlyViewDivOut ,
            success: function (data) {
                $(".l3loading").addClass('hide');
                $(".gridMasterW01F2050").html(data);
            }
        });
    }
</script>