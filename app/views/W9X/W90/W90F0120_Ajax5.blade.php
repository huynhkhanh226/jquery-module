<div class="row">
    <div class="col-md-12 col-xs-12">
        <div id="pqgrid_W90F0120_5" style="margin:auto;"></div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var obj = {
            width: '100%',
            height: iW90F0120Height,
            showTitle: false,
            numberCell:false,
            //showBottom:false,
            collapsible: false,
            editable: false,
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: false, pace: 'fast', autoFit: true, lastColumn: 'none'}
        };
        obj.colModel = [
            {
                title: "{{Helpers::getRS($g,'Ngay')}}",
                minWidth: 70,
                dataType: "string",
                dataIndx: "VoucherDate",
                align: "center",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'So_phieu')}}",
                minWidth: 120,
                dataType: "string",
                dataIndx: "VoucherID",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Dien_giai')}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "Description",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'TK_doi_ung')}}",
                minWidth: 70,
                dataType: "string",
                dataIndx: "CorAccountID",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'No')}}",
                minWidth: 130,
                dataType: "float",
                dataIndx: "DebitCAmount",
                align: "right",
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                render: function (ui) {
                    var rowData = ui.rowData;
                    if (isNaN(rowData["DebitCAmount"]))
                        return rowData["DebitCAmount"];
                    else
                        return formatNum(rowData["DebitCAmount"], '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}',false);
                }
            },
            {
                title: "{{Helpers::getRS($g,'Co')}}",
                minWidth: 130,
                dataType: "float",
                dataIndx: "CreditCAmount",
                align: "right",
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                render: function (ui) {
                    var rowData = ui.rowData;
                    if (isNaN(rowData["CreditCAmount"]))
                        return rowData["CreditCAmount"];
                    else
                        return formatNum(rowData["CreditCAmount"], '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}',false);
                }
            }
        ];
        var arrayData =  {{json_encode($rs)}};
        obj.dataModel = {
            data: arrayData,
            location: "local",
            sorting: "local",
            sortDir: "down"
        };
        obj.summaryData = calculateSummary();

        function calculateSummary() {
            var periodDebit = 0,periodCredit = 0;
            for (var i = 0; i < arrayData.length; i++) {
                var row = arrayData[i];
                periodDebit += parseFloat(row["DebitCAmount"]);
                periodCredit += parseFloat(row["CreditCAmount"]);
            }
            var summaryData = {VoucherDate:"", VoucherID:"", Description:"", CorAccountID:"", DebitCAmount:"<b>"+format2(periodDebit, "", '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}')+"</b>", CreditCAmount:"<b>"+format2(periodCredit, "", '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}')+"</b>"};
            return [summaryData];
        }

        var $grid = $("#pqgrid_W90F0120_5").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
    });

</script>