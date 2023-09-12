<div id="pqGrid_W47F3002"></div>

<script type="text/javascript">
    var obj = {
        showTitle: false,
        numberCell: {show: false},
        pasteModel: {on: false},
        filterModel: {header: true},
        height: $(document).height() - 250,
        scrollModel: {autoFit: true},
        pageModel: {type: "local", rPP: 10},
        selectionModel: {type: 'cell', mode: 'single'},
        resizable: false,
        collapsible: false,
        freezeCols: parseInt('{{$rsCol[0]['FixedColumn']}}'),
        postRenderInterval: -1,
        complete: function (event, ui) {
            $('#chkCheckAllW47F3002').removeAttr('style');
            //$('.btn-toggle').bootstrapToggle();
            //alert('complete');
            $("#chkAllW47F3002").addClass('visibility');
        },
        refresh: function (event, ui) {
                    @foreach($rsCol as $row)
                    @if ($row['FilterCombo'] == 1)
            var column = $("#pqGrid_W47F3002").pqGrid("getColumn", {dataIndx: "{{$row['FieldName']}}"});
            var filter = column.filter;
            filter.cache = null;
            filter.options = $("#pqGrid_W47F3002").pqGrid("getData", {dataIndx: ["{{$row['FieldName']}}"]});
            @endif
            @endforeach
            //alert('refresh');
            $('.btn-toggle').bootstrapToggle();
            //alert("save");
        },
        cellClick: function(event, ui){
            //alert('click');
            //$('.btn-toggle').bootstrapToggle();
        },
        colModel: [
           /* {
                dataIndx: "IsSelect",
                maxWidth: 30,
                minWidth: 30,
                align: "center",
                resizable: false,
                isExport: false,
                type: 'checkBoxSelection',
                cls: 'ui-state-default',
                sortable: false,
                filterModel: {header: true, on: true},
                editor: false,
                dataType: 'bool',
                title: "<input type='checkbox' id='chkCheckAllW47F3002'/>",
                cb: {
                    all: false, //checkbox selection in the header affect current page only.
                    header: true //show checkbox in header
                },
                editable: function (ui) {
                    return Number(ui.rowData["IsDisabled"]) == 1 ? false : true;
                },
                render: function (ui) {
                    var rowData = ui.rowData;
                    return {
                        cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                    };
                },
            },*/
            {
                title: '<input type="checkbox" id="chkAllW47F3002" data-field="IsSelect" onclick="headClickW47F3002(this)" style="color: blue;visibility: unset !important;"/>',
                minWidth: 50,
                width: 80,
                align: "center",
                dataType: "integer",
                dataIndx: "IsSelect",
                editor: false,
                sortable: false,
                type: 'checkbox',
                cb: {
                    all: false,
                    header: true,
                    check: "1",
                    uncheck: "0"
                },
                editable: function (ui) {
                    var rowData = ui.rowData;
                    return Number(rowData["IsDisabled"]) == 1 ? false : true;
                },
                render: function (ui) {
                    //alert('render select');
                    var row = ui.rowData,
                        checked = Number(row["IsSelect"] == 1) ? 'checked' : '',
                        disabled = this.isEditableCell(ui) ? "" : "disabled";
                    return {
                        text: "<label><input type='checkbox' " + checked + " /></label>",
                        cls: (disabled ? "readonly-status" : "")
                    };

                },
                postRender: function (ui) {
                    //
                    if (this.isEditableCell(ui) == true) {
                        var rowIndx = ui.rowIndx,
                            grid = this,
                            $cell = grid.getCell(ui);

                        $cell.find("label>input[type='checkbox']")
                            .unbind("click")
                            .bind("click", function (evt) {
                                //$("#pqGrid_W47F3002").pqGrid("refreshDataAndView");
                            });
                    }

                }
            },
            {
                dataIndx: "IsOff",
                maxWidth: 80,
                minWidth: 80,
                align: "center",
                resizable: false,
                isExport: false,
                sortable: false,
                editor: false,
                dataType: 'string',
                editable: true,
                title: "",
                render: function (ui) {
                    //alert('render isOFF');
                    var rowData = ui.rowData;
                    var id = "isOffW47F3002_Row" + ui.rowIndx;
                    var checked = rowData.IsOff == 0 ? 'checked': '';
                    var str = '<input id="' + id + '" rowIndx = "'+ui.rowIndx+'" class="btn-toggle" type="checkbox" data-toggle="toggle" data-style="ios"  '+checked+'>';
                    return str;
                },
                postRender: function (ui) {
                    //alert('test');
                    $('.btn-toggle').bootstrapToggle();
                    var id = "isOffW47F3002_Row" + ui.rowIndx;
                    var rowData = ui.rowData;
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    console.log($cell);

                    $cell.find('.btn-toggle').change(function (e) {
                        var val = $(this).prop('checked') ? 0 : 1;
                        $cell.find('.btn-toggle').val(val);
                        var data = $("#pqGrid_W47F3002").pqGrid("option", "dataModel.data");
                        data[ui.rowIndx]["IsOff"] = $(this).val().toString();
                        $("#pqGrid_W47F3002").pqGrid("option", "dataModel.data", data);
                        postMethod("{{url('/W47F3002/setisoff')}}", function (data){
                            console.log(JSON.parse(data));
                            var res = JSON.parse(data);
                            if (res.status == "OKAY"){
                                if (res.data[0]["Status"] == 1){
                                    alert_error(res.data[0]["Message"],function(){
                                        $cell.find('.btn-toggle').val(val == 1 ? 0 : 1);
                                        var data = $("#pqGrid_W47F3002").pqGrid("option", "dataModel.data");
                                        data[ui.rowIndx]["IsOff"] = $cell.find('.btn-toggle').val().toString();
                                        $("#pqGrid_W47F3002").pqGrid("option", "dataModel.data", data);
                                        $("#pqGrid_W47F3002").pqGrid("refreshDataAndView");
                                    });

                                }
                            }else{
                                alert_error(res.message);
                            }
                            $("#pqGrid_W47F3002").pqGrid("refreshDataAndView");
                        }, {transID: rowData.TransID, isOff: data[ui.rowIndx]["IsOff"]});
                    });
                }
            }
            @foreach($rsCol as $row)
            @if ($row['Status'] == "H")
            , {
                dataIndx: "{{$row['FieldName']}}",
                editor: false,
                hidden: true,
                isExport: false
            }
            @elseif ($row['DataType'] == "C") //Checkbox
            , {
                title: "{{$row['Caption']}}",
                minWidth: parseInt('{{$row['Length']}}'),
                dataIndx: "{{$row['FieldName']}}",
                align: "center",
                editor: false,
                type: 'checkbox',
                isExport: {{$row['IsExport']}},
                render: function (ui) {
                    var rowData = ui.rowData;
                    return {
                        text: "<label><input type='checkbox' " + (rowData["{{$row['FieldName']}}"] == 1 ? "checked" : "") + " /></label>"
                    };
                }
            }
            @elseif ($row['DataType'] == "D") //Ngày
            , {
                title: "{{$row['Caption']}}",
                minWidth: parseInt('{{$row['Length']}}'),
                dataIndx: "{{$row['FieldName']}}",
                align: "center",
                editor: false,
                isExport: {{$row['IsExport']}},
                dataType: "string",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            }
            @elseif ($row['DataType'] == "N") //Number
            , {
                title: "{{$row['Caption']}}",
                minWidth: parseInt('{{$row['Length']}}'),
                dataIndx: "{{$row['FieldName']}}",
                align: "right",
                editor: false,
                isExport: {{$row['IsExport']}},
                dataType: "float",
                format: returnSFormat('{{$row['Decimals']}}'),
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
            }
            @else
            , {
                title: "{{$row['Caption']}}",
                minWidth: parseInt('{{$row['Length']}}'),
                dataIndx: "{{$row['FieldName']}}",
                editor: false,
                dataType: "string",
                isExport: {{$row['IsExport']}},
                @if ($row['FilterCombo'] == 1)
                filter: {
                    type: 'select',
                    condition: 'equal',
                    prepend: {'': '---'},
                    valueIndx: "{{$row['FieldName']}}",
                    labelIndx: "{{$row['FieldName']}}",
                    listeners: ['change']
                }
                @else
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                @endif
            }
            @endif
            @endforeach
        ],
        dataModel: {
            data: {{$rsData}}
        }
    };
    $("#pqGrid_W47F3002").pqGrid(obj);
    $("#pqGrid_W47F3002").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $("#pqGrid_W47F3002").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);


    $(document).ready(function(){

    });

    function headClickW47F3002(el){
        var $grid = $("#pqGrid_W47F3002");
        var dataField = $(el).attr('data-field');
        var data = $grid.pqGrid("option", "dataModel.data");
        var availableCheck = $.grep(data, function(row){
            return Number(row["IsDisabled"]) == 0;
        });

        var checked = $.grep(data, function(row){
            return Number(row["IsSelect"]) == 1;
        });
        console.log($(el));
        if (availableCheck.length == checked.length){
            //Uncheck all row
            for(var i=0;i<availableCheck.length;i++){
                availableCheck[i]["IsSelect"] = 0;
            }
            setTimeout(function(){
                $("#chkAllW47F3002").prop("checked", false);
            }, 300);

        }else{
            //Check all row
            for(var i=0;i<availableCheck.length;i++){
                availableCheck[i]["IsSelect"] = 1;
            }
            setTimeout(function(){
                $("#chkAllW47F3002").prop("checked", true);
            }, 300);

        }
        $("#pqGrid_W47F3002").pqGrid("refreshDataAndView");
    }

</script>

