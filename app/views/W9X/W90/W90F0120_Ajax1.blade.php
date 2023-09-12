<div class="row">
    <div class="col-md-12 col-xs-12">
        <div id="pqgrid_W90F0120_1" style="margin:auto;"></div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var obj = {
            width: '100%',
            height: iW90F0120Height,
            showTitle: false,
            numberCell:false,
            showBottom:false,
            collapsible: false,
            editable: false,
            flexHeight: true,
            scrollModel: {horizontal: false, pace: 'fast', autoFit: true, lastColumn: 'none'}
        };
        obj.colModel = [
            {
                title: "",
                minWidth: 250,
                dataType: "string",
                dataIndx: "Description"
            },
            {
                title: "{{Helpers::getRS($g,'No')}}",
                minWidth: 130,
                dataType: "float",
                dataIndx: "Debit",
                align: "right",
                render: function (ui) {
                    var rowData = ui.rowData;
                    return formatNum(rowData["Debit"], '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}',false);
                }
            },
            {
                title: "{{Helpers::getRS($g,'Co')}}",
                minWidth: 130,
                dataType: "float",
                dataIndx: "Credit",
                align: "right",
                render: function (ui) {
                    var rowData = ui.rowData;
                    return formatNum(rowData["Credit"], '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}',false);
                }
            }
        ];
        obj.dataModel = {
            data: {{json_encode($rs)}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        };

        var $grid = $("#pqgrid_W90F0120_1").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
    });

</script>