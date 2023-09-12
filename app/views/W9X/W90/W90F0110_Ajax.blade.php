<div class="row">
    <div class="col-md-12 col-xs-12">
        <div id="pqgrid_W90F0110" style="margin:auto;"></div>
    </div>
</div>
<script type="text/javascript">
    var iW90F0110Height;

    $(document).ready(function () {
        iW90F0110Height = $(".contenttab").height() - 98;
        var obj = {
            width: '100%',
            height: iW90F0110Height,
            showTitle: false,
            numberCell:false,
            collapsible: false,
            editable: false,
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: false, pace: 'fast', autoFit: true, lastColumn: 'none'}
        };
        obj.colModel = [
            {
                title: "{{Helpers::getRS($g,'Ma_tai_khoan')}}",
                minWidth: 120,
                dataType: "string",
                dataIndx: "AccountID",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                render: function (ui) {
                    var rowData = ui.rowData;
                    return '<a class="text-blue" onclick="showW90F0120(\'' + rowData["AccountID"] + '\',\'' + rowData["DivisionID"] + '\',\'' + rowData["PeriodFrom"] + '\',\'' + rowData["PeriodTo"] + '\')">'+rowData["AccountID"]+'</a>';
                }
            },
            {
                title: "{{Helpers::getRS($g,'Ten_tai_khoan')}}",
                minWidth: 250,
                dataType: "string",
                dataIndx: "AccountName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'So_du_dau_ky')}}",
                minWidth: 130,
                dataType: "float",
                dataIndx: "OpeningBalance",
                align: "right",
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                render: function (ui) {
                    var rowData = ui.rowData;
                    var ext = " N";
                    if (parseFloat(rowData["OpeningBalance"]) < 0)ext = " C";
                    if (rowData["AccountID"]=="")
                        return "<b>"+formatNum(Math.abs(rowData["OpeningBalance"]), '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}')+ext+"</b>";
                    else
                        return formatNum(Math.abs(rowData["OpeningBalance"]), "", '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}',false)+ext;
                }
            },
            {
                title: "{{Helpers::getRS($g,'Phat_sinh_no')}}",
                minWidth: 130,
                dataType: "float",
                dataIndx: "PeriodDebit",
                align: "right",
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                render: function (ui) {
                    var rowData = ui.rowData;
                    if (rowData["AccountID"]=="")
                        return "<b>"+formatNum(rowData["PeriodDebit"], '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}')+"</b>";
                    else
                        return formatNum(rowData["PeriodDebit"], '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}',false);
                }
            },
            {
                title: "{{Helpers::getRS($g,'Phat_sinh_co')}}",
                minWidth: 130,
                dataType: "float",
                dataIndx: "PeriodCredit",
                align: "right",
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                render: function (ui) {
                    var rowData = ui.rowData;
                    if (rowData["AccountID"]=="")
                        return "<b>"+formatNum(rowData["PeriodCredit"], '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}')+"</b>";
                    else
                        return formatNum(rowData["PeriodCredit"], '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}',false);
                }
            },
            {
                title: "{{Helpers::getRS($g,'So_du_cuoi_ky')}}",
                minWidth: 130,
                dataType: "float",
                dataIndx: "ClosingBalance",
                align: "right",
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                render: function (ui) {
                    var rowData = ui.rowData;
                    var ext = " N";
                    if (parseFloat(rowData["ClosingBalance"]) < 0)ext = " C";
                    if (rowData["AccountID"]=="")
                        return "<b>"+formatNum(Math.abs(rowData["ClosingBalance"]), '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}')+ext+"</b>";
                    else
                        return formatNum(Math.abs(rowData["ClosingBalance"]), '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}',false)+ext;
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
            var openingBalance = 0,closingBalance = 0,periodDebit = 0,periodCredit = 0;
            for (var i = 0; i < arrayData.length; i++) {
                var row = arrayData[i];
                openingBalance += parseFloat(row["OpeningBalance"]);
                closingBalance += parseFloat(row["ClosingBalance"]);
                periodDebit += parseFloat(row["PeriodDebit"]);
                periodCredit += parseFloat(row["PeriodCredit"]);
            }
            var summaryData = {AccountID:"", AccountName:"", OpeningBalance:openingBalance, PeriodDebit:periodDebit, PeriodCredit:periodCredit, ClosingBalance:closingBalance};
            return [summaryData];
        }
        var $grid = $("#pqgrid_W90F0110").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
    });

</script>