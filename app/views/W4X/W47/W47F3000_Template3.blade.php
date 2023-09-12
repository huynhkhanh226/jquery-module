@if ($isShowPlan==1)
    <div class="checkbox mgt3">
        <label>
            <input type="checkbox" class="chkIsPlanW47F3000"
                   id="chkIsPlanW47F3000{{$itemcode}}" {{$isPlan==1?'checked':''}}> {{Helpers::getRS($g,"Ke_hoach_thanh_toan_gia_dinh")}}
        </label>
    </div>
@endif
<input id="queryString" value="{{$sql}}" type="hidden">
<div id="divContainerW47F3000{{$itemcode}}"></div>

<script>
    $(document).ready(function () {
        if (arrayMasterW47F3000 == null) arrayMasterW47F3000 = JSON.stringify({{json_encode($inputAll)}});

        setTimeout(function(){
            $("#divContainerW47F3000{{$itemcode}}").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#divContainerW47F3000{{$itemcode}}").pqGrid("refreshDataAndView");
        }, 2000);
    });

    //Xóa toàn bộ tab hiện tại và load lại
    $('.tabW47F3000').on('change', '#chkIsPlanW47F3000{{$itemcode}}', function () {
        console.log("change");
        var isPlan = $(this).is(':checked') ? 1 : 0;
        $("#divD47F4030_W47F3000_W47F3000 .cube-loading").removeClass("hide");
        $.ajax({
            method: "POST",
            url: "{{Request::url()}}",
            data: {itemcode: '{{$itemcode}}', array: arrayMasterW47F3000, level: '{{$level}}', parameter: '{{$parameter}}', isPlan: isPlan, isShowPlan: '{{$isShowPlan}}', template: 1, isPaging: "{{$isPaging}}"},
            success: function (data) {
                $("#tabChild_{{$itemcode}}").html(data);
                $("#divD47F4030_W47F3000_W47F3000 .cube-loading").addClass("hide");
            }
        });
    });

    var obj = {
        width: '100%',
        height: $(document).height() - 305,
        freezeCols: "{{$numberOfFixedColumns}}",
        numberCell: {show: false},
        selectionModel: {type: 'row'},
        //selectionModel: { type: null },
        minWidth: 30,
        pasteModel: {on: false},
        pageModel: {type: "local", rPP: 100},
        filterModel: {on: true, mode: "AND", header: true},
        scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
        showTitle: false,
        dataType: "JSON",
        wrap: true,
        hwrap: true,
        collapsible: false,
        postRenderInterval: -1,
        complete: function (event, ui) {
        },
    };

    obj.colModel = [
        {
            title: "",
            minWidth: 80,
            width: 110,
            align: "left",
            dataType: "string",
            editor: false,
            editable: false,
            //dataIndx: "DivisionID",
            hidden: true,
            sortable: false,
            isExport: false
        }

        @foreach($rsCol as $row)
        , {
            title: "{{$row['Caption']}}",
            minWidth: 80,
            width: "{{$row['Length']}}",
            editor: false,
            editable: false,
            @if (intval($row['Decimals']) >=0)
                dataType: "float",
                align: "right",
                format: "{{Helpers::getStringFormat($row['Decimals'])}}",
            @else
                dataType: "string",
                align: "left",
            @endif
            dataIndx: "{{$row['FieldName']}}",
            sortable: false,
            render: function (ui) {
                var rowData = ui.rowData;

                if (rowData[ui.dataIndx + "_Format"] != undefined){
                    var format = JSON.parse(rowData[ui.dataIndx + "_Format"]);
                    var text = "";
                    var val = '';
                    if ("{{intval($row['Decimals'])}}" >=0){
                        val = ui.formatVal;
                    }else{
                        val = rowData["{{$row['FieldName']}}"];
                    }

                    var formatNumber = (ui.column.format != undefined ? getDecimal(ui.column.format) : '');


                    console.log( formatNumber);
                    if (format != null){
                        if (Number(format["IsHyperlink"]) == 0){
                            text = "<p style='"+format["Style"]+"'>"+val+"</p>";
                        }else{
                            var contractNo = rowData["ContractNo"];
                            var cheduleDate  = "{{$row['Caption']}}";
                            var contractID = rowData["ContractID"];
                            var parameter  = rowData["Parameter"];
                            var oAmount   = rowData[ui.dataIndx + "_QD"];
                            text = "<a  class='digi-a' onclick='showW47F3002(\""+ contractNo + "\",\""+cheduleDate+"\",\"" +contractID+ "\",\""+parameter+"\"," +oAmount+ ", " +formatNumber+");' style='"+format["Style"]+"'>"+val+"</a>";
                        }

                    }else{
                        text = "<p>"+val+"</p>";
                    }
                    //console.log(format["Style"]);
                    //console.log(rowData);
                    if (val == null || val == undefined){
                        text = "";
                    }
                    return {
                        text: text
                    }
                }else{
                    var val = '';
                    val = rowData["{{$row['FieldName']}}"];
                    return {
                        text: text
                    }
                }


            },
            @if (intval($row['IsFilter']) == 1)
                    @if ($row['ColumnType'] == 'Dropdown')
                        filter: {
                            type: 'select',
                            condition: 'equal',
                            prepend: {'': '---'},
                            valueIndx: "{{$row['FieldName']}}",
                            labelIndx: "{{$row['FieldName']}}",
                            listeners: ['change']
                        },
                    @elseif ($row['ColumnType'] == 'Textbox')
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                    @else

                    @endif

            @endif

        }
        @endforeach
    ];
    obj.dataModel = {
        data: {{json_encode($rsData)}},
        location: "local",
        sorting: "local",
        sortDir: "down"
    };

    obj.pageModel = {type: 'local', rPP: 100, rPPOptions: [20, 30, 40, 50, 100, 200, 300]};
    $("#divContainerW47F3000{{$itemcode}}").pqGrid(obj);


    var cols = $("#divContainerW47F3000{{$itemcode}}").pqGrid( "getColModel" );
    console.log(cols);
    for (var i=0;i<cols.length; i++){
        if (cols[i].filter != undefined){
            if (cols[i].filter.type == 'select'){
                var column = $("#divContainerW47F3000{{$itemcode}}").pqGrid("getColumn", { dataIndx: cols[i].dataIndx });
                var filter = column.filter;
                filter.cache = null;
                filter.options = $("#divContainerW47F3000{{$itemcode}}").pqGrid("getData", { dataIndx: [cols[i].dataIndx] });
            }
        }

    }


    $("#divContainerW47F3000{{$itemcode}}").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $("#divContainerW47F3000{{$itemcode}}").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    $("#divContainerW47F3000{{$itemcode}}").pqGrid("refreshDataAndView");


    var w47F3000ExportExcel = function () {
        var _title = [];
        var _dataIndx = [];
        var _align = [];
        var _format = [];
        initExportExcell($("#divContainerW47F3000{{$itemcode}}"), _title, _dataIndx, _align, _format);
        var _data = JSON.stringify($("#divContainerW47F3000{{$itemcode}}").pqGrid("option", "dataModel.data"));
        //console.log($("#frmW47F3000").serialize());
        //var data = {title: _title, data: _data, dataIndx: _dataIndx, align: _align, format: _format, queryString: ($(".tabW47F3000 .tab-content").find('div.tab-pane.active #queryString').val()), g: "{{$g}}"};
        var data = {title: _title, data: _data, dataIndx: _dataIndx, align: _align, format: _format};
        /*var items = $("#frmW47F3000").serialize().split("&");
        for (var i=0;i<items.length; i++){
            var keyval = items[i].split("=");
            data[keyval[0]] =  keyval[1];
        }*/
        //console.log(data);

        //$("#divD47F4030_W47F3000_W47F3000 .cube-loading").removeClass("hide");

        $.ajax({
            method: "POST",
            data: data,
            url: "{{url('/Export')}}",
            success: function (data) {
                //$("#divD47F4030_W47F3000_W47F3000 .cube-loading").addClass("hide");
                if (data == 0) {
                    alert_error('{{Helpers::getRS(5,'Loi_xuat_file')}}')
                }
                else {
                    var downloadLink = document.createElement("a");
                    downloadLink.download = "Bao_cao_dong_tien_theo_ngay_" + new Date().getTime() + ".xls";
                    downloadLink.innerHTML = "Download File";
                    downloadLink.href = data;
                    downloadLink.onclick = destroyClickedElement;
                    downloadLink.style.display = "none";
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                }
            }
        });
    };

    //Hiển thị modal Lập giả định - W47F3001
    var showW47F3002 = function (ContractNo, ScheduleDate , ContractID, Parameter, oAmount, format) {
        console.log(format);
        //ahref = JSON.parse(ahref);
        //var cell = $(ahref).parent();
        $("#modalW47F3001").find(".lblContractNo").html(ContractNo);
        $("#modalW47F3001").find(".lblOAmount").html(format2(oAmount, '', format));
        $("#modalW47F3001").find(".lblScheduleDate").html(ScheduleDate);
        $("#modalW47F3001").find("#hdContractID").val(ContractID);
        $("#modalW47F3001").find("#hdParameter").val(Parameter);
        $("#modalW47F3001").find("#slMoneyUnitID").val('{{$unit}}');
        $('#modalW47F3001').modal({
            show: true,
            keyboard: false,
            backdrop: 'static'
        });
    };

</script>
