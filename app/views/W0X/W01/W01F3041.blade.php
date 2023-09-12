<div class="modal fade pd0" id="modalW01F3041" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 80%">
        <div class="modal-content">
            <div class="modal-header">
                {{Helpers::generateHeading($modalTitle,"W01F3041",true,"")}}
            </div>
            <div class="modal-body">
                <div id="detailW01F3041" class="pd10"></div>
            </div>
            <div class="l3loading hide">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
    </div>
</div>
<?php
    $arr = count(array_filter($rsCol,function($row){
        return $row["IsFix"] == 1;
    }));
?>
<script type="text/javascript">
    $(document).ready(function () {
        var obj = {
            width: "100%",
            height: $(document).height() - 250,
            editable: false,
            freezeCols: {{$arr}},
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
            filterModel: {on: true, mode: "AND", header: true},
            toolbar: {
                items: [
                    {
                        type: 'button',
                        label: "Export",
                        icon: 'ui-icon-arrowthickstop-1-s',
                        listener: function () {
                            exportExcelW01F3041();
                        }
                    }]
            },
            colModel: [
                @foreach($rsCol as $col)
                {
                    title: "{{$col['Caption']}}",
                    minWidth: 10,
                    width: Number('{{$col['Length']}}'),
                    @if ($col['DataType'] == "N")
                    dataType: "float",
                    format: "{{\Helpers::getStringFormat($col['NumberFormat'])}}",
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
                    dataIndx: "{{$col['FieldName']}}"
//                    render: function(ui){
//                        var rowData = ui.rowData;
//                        console.log(ui);
//                        return {
//                            style: rowData["Format"],
//                            text: ui.formatVal
//                        };
//                    }
                },
                @endforeach
            ]


        };
        $("#detailW01F3041").pqGrid(obj);
        $("#detailW01F3041").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $("#detailW01F3041").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $("#detailW01F3041").pqGrid("refreshDataAndView");

        setTimeout(function(){
            $("#detailW01F3041").pqGrid("refreshDataAndView");
        }, 300);

        var exportExcelW01F3041 = function () {
            var _title = [];
            var _dataIndx = [];
            var _align = [];
            var _format = [];
            initExportExcell($("#detailW01F3041"), _title, _dataIndx, _align, _format);
            var _data = JSON.stringify($("#detailW01F3041").pqGrid("option", "dataModel.data"));

            $.ajax({
                method: "POST",
                data: {title: _title, data: _data, dataIndx: _dataIndx, align: _align, format: _format},
                url: "{{url('/Export')}}",
                success: function (data) {
                    if (data == 0) {
                        alert_error('{{Helpers::getRS(5,'Loi_xuat_file')}}')
                    }
                    else {
                        var downloadLink = document.createElement("a");
                        var d =  new Date();
                        downloadLink.download = "Tinh_hinh_thu_chi_du_an" + d.getDate() + "" + (Number(d.getMonth()) + 1) + "" + d.getFullYear() + ".xls";
                        downloadLink.innerHTML = "Tinh_hinh_thu_chi_du_an";
                        downloadLink.href = data;
                        downloadLink.onclick = destroyClickedElement;
                        downloadLink.style.display = "none";
                        document.body.appendChild(downloadLink);
                        downloadLink.click();
                    }
                }
            });
        };

    });

</script>

