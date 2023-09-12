<div id="gridW17f4030"></div>
<script>
    var id="{{$userID}}";
    var isPerson = "{{$isPerson}}";
    console.log(isPerson);
    var groupModel = {
        on:  "{{$isPerson == 1 ? false : true}}",
        collapsed: [false, false],
        dataIndx: ['ManagerName','GroupSalesName', 'SalesPersonID'],

        merge: true,
        showSummary: [false, true],
        grandSummary: true,
        header: true,
        fixCols:true,
        headerMenu: true,
        dir: [ "up", "down", "up" ],
        title: [
            "{0} ({1})",
            "{0} - {1}"
        ]
    };


    var agg = pq.aggregate;
    var format = function (val, format) {
        return pq.formatNumber(val, "#");
    };
    agg.sumRow = function (arr, col) {
        return  arr.length;
    }
    agg.sumCutom = function (arr, col) {
        return format(agg.sum(arr, col));
    }

    var obj = {
        width: "100%",
        height: $("#divD17F4030_W17F4030_W17F4030").height() - 90,
        editable: false,
        //freezeCols: 1,
        minWidth: 30,
        showTitle: false,
        showHeader: true,
        showToolbar: true,
        showTop: true,
        showBottom: true,
        wrap: true,
        hwrap: true,
        scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none', flexContent: false},

        collapsible: false,
        groupModel: groupModel,
        summaryOptions: {number: "sum, sumRow"},

        refresh: function(event, ui){
            $(".pq-group-placeholder").html("{{Helpers::getRS($g, 'Keo_mot_cot_vao_day_de_nhom_cot_do')}}");
            $(".pq-summary-row").addClass('text-bold');
        },
        cellClick: function(event,ui){
            var colIndx=ui.colIndx;
            var rowData=ui.rowData;
            console.log(colIndx);
            console.log(rowData);
        },


        dataModel: {
            data: {{json_encode($rsData)}},
            location: "local",
            sorting: "local",
/*
            sortDir: "down",
*/
            sortIndx: ["OrderNum"],
            sortDir: ["up", "down", "up"]
        },
        postRenderInterval: -1,
        selectionModel: {type: 'row', mode: 'single'},
        scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
        pageModel: {type: "local", rPP: 10},
        filterModel: {on: true, mode: "AND", header: true},
        toolbar: {
            items: [
                {
                    type: 'button',
                    icon: 'ui-icon-arrowthickstop-1-s',
                    label: '{{Helpers::getRS($g,'Xuat_Excel_U')}}',
                    cls: 'pull-right',
                    listener: function () {
                        var blob = $("#gridW17f4030").pqGrid("exportData", {format: 'xls', sheetName: "Data"});
                        if (typeof blob === "string") {
                            blob = new Blob([blob]);
                        }
                        saveAs(blob, "Bao_cao_tiep_can_cong_ty.xls");
                    }
                }]
        },
        colModel: [
            {
                title: "",
                minWidth: 50,
                dataType: "string",
                dataIndx: "detail",
                align: "center",
                editor: false,
                isExport: false,

                render: function (ui) {
                    var rowData = ui.rowData;
                    if (rowData.IsShowLink == 1) {
                        return "<a id='showDetailW17F4030' class='fa fa-search text-yellow'></a>";
                    } else {
                        return '';
                    }

                },

                postRender: function (ui) {
                    if (this.isEditableCell(ui) == true) {
                        var rowIndx = ui.rowIndx,
                            grid = this,
                            $cell = grid.getCell(ui);
                        $cell.find("#showDetailW17F4030")
                            .unbind("click")
                            .bind("click", function (evt) {
                                $gridW17f4030 = $("#gridW17f4030")
                                var $tr = $(this).closest("tr"),
                                    rowIndx = $gridW17f4030.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                var row_Data = ui.rowData;
                                console.log(row_Data);

                                var SalesPersonCode = row_Data.SalesPersonCode;
                                var CompanyCode = row_Data.CompanyCode;

/*
                                alert(isPerson);
*/
                                showFormDialogPost('{{url("/W17F4030/view/$pForm/$g/detail")}}', "modalW17F4030", {
                                    isPerson: isPerson,
                                    CompanyCode: CompanyCode,
                                    SalesPersonCode: SalesPersonCode,
                                }, 8);


                            });
                    }

                },
            },
            {
                title: "Người quản lý",
                minWidth: 170,
                dataType: "string",
                dataIndx: "ManagerName",
                align: "center",
                editor: false,
                isExport: true,
                hidden: "{{$isPerson == 1 ? true : false}}",
                cls:'text-bold',
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}


            },
            {
                title: "Nhóm nhân viên",
                minWidth: 170,
                dataType: "string",
                dataIndx: "GroupSalesName",
                align: "center",
                editor: false,
                isExport: true,
                hidden: "{{$isPerson == 1 ? true : false}}",
                cls:'text-bold',
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}


            },


                @foreach($rsColumns as $col)
            {
                title: "{{$col['Caption']}}",
                minWidth: 50,
                width: Number('{{$col['Length']}}'),
                @if ($col['DataType'] == "N")
                dataType: "float",
                format: "{{\Helpers::getStringFormat($col['DataFormat'])}}",
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                algin: "right",
                  /*  @if ($col['ControlFormat'] == "SumFooter")
                    summary: {type: "sumRow"},
                    @endif*/
                @endif
                @if ($col['DataType'] == "S")
                dataType: "string",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                algin: "left",
                    @if ($col['ControlFormat'] == "SumFooter")
                    //summary: {type: "sumRow"},
                    @endif
                @endif
                 @if ($col['DataType'] == "D")
                dataType: "date",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']},
                algin: "center",
                @endif
                editor: false,
                editable: false,
                dataIndx: "{{$col['FieldName']}}",
                hidden: '{{$col['IsHide'] == 1 ? true: false}}',
                isExport: '{{$col['IsHide'] == 1 ? false: true}}',
                @if ($col['FieldName'] == 'IsShowLink')
                isExport: false,
                @endif

                render: function(ui){
                    var rowData = ui.rowData;
                    console.log(rowData);

                    if (rowData.Style == "B"){
                        return "<strong>"+rowData[ui.dataIndx]+"</strong>";
                    }else{
                        return rowData[ui.dataIndx];
                    }
                   if(rowData.OrderNum=="0"||rowData.OrderNum==null)
                    {
                        return '';

                    }
                }
            },
            @endforeach
        ]
    };
    $("#gridW17f4030").pqGrid(obj);
    $("#gridW17f4030").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $("#gridW17f4030").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);

    $("#gridW17f4030").pqGrid("refreshDataAndView");
    $( "#gridW17f4030" ).pqGrid( "option", "pageModel.rPP", 100 );

    setTimeout(function () {
        $("#gridW17f4030").pqGrid("refreshDataAndView");
        ///$(".pq-group-placeholder").html("{{Helpers::getRS($g, 'Keo_mot_cot_vao_day_de_nhom_cot_do')}}");
    }, 300);

</script>