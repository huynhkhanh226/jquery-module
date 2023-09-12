<div class="row">
    <div class="col-md-12 col-xs-12">
        <div id="pqgrid_W90F1302_2" class="mgb5"></div>
    </div>
</div>
<script type="text/javascript">
    var obj = {
        width: '100%',
        height: documentHeight - 245,
        showTitle: false,
        numberCell: false,
        collapsible: false,
        editable: false,
        scrollModel: {horizontal: false, pace: 'fast', autoFit: true, lastColumn: 'none'}
    };
    obj.colModel = [
        {
            title: "{{Helpers::getRS($g,'Ngay_chung_tu')}}",
            width: 80,
            minWidth: 60,
            dataType: "date",
            align: "center",
            dataIndx: "JVDate"
        },
        {
            title: "{{Helpers::getRS($g,'So_chung_tu')}}",
            width: 140,
            minWidth: 100,
            dataType: "string",
            dataIndx: "JVNo"
        },
        {
            title: "{{Helpers::getRS($g,'Tai_khoan')}}",
            width: 70,
            dataType: "string",
            align: "center",
            dataIndx: "AccountID",
            render: function (ui) {
                var rowData = ui.rowData;
                if (rowData["AccountID"] == "")
                    return "";
                else
                    return rowData["AccountID"] + "&nbsp;<span class='fa fa-info-circle text-blue' title='" + rowData["AccountName"] + "'></span>";
            }
        },
        {
            title: "{{Helpers::getRS($g,'Tai_khoan_doi_ung')}}",
            width: 80,
            dataType: "string",
            align: "center",
            dataIndx: "CorAccountID",
            render: function (ui) {
                var rowData = ui.rowData;
                if (rowData["CorAccountID"] == "")
                    return "";
                else
                    return rowData["CorAccountID"] + "&nbsp;<span class='fa fa-info-circle text-blue' title='" + rowData["CorAccountName"] + "'></span>";
            }
        },
        {
            title: "{{Helpers::getRS($g,'Dien_giai')}}",
            width: 350,
            minWidth: 270,
            dataType: "string",
            dataIndx: "Description"
        },
        {
            title: "{{Helpers::getRS($g,'No')}}",
            width: 100,
            dataType: "float",
            dataIndx: "DebitConvertedAmount",
            align: "right",
            render: function (ui) {
                var rowData = ui.rowData;
                if (isNaN(rowData["DebitConvertedAmount"]))
                    return rowData["DebitConvertedAmount"];
                else
                    return formatNum(rowData["DebitConvertedAmount"], '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}', false);
            }
        },
        {
            title: "{{Helpers::getRS($g,'Co')}}",
            width: 100,
            dataType: "float",
            dataIndx: "CreditConvertedAmount",
            align: "right",
            render: function (ui) {
                var rowData = ui.rowData;
                if (isNaN(rowData["CreditConvertedAmount"]))
                    return rowData["CreditConvertedAmount"];
                else
                    return formatNum(rowData["CreditConvertedAmount"], '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}', false);
            }
        }
    ];
    var arrayData = {{json_encode($rs2)}};
    obj.dataModel = {
        data: arrayData,
        location: "local",
        sorting: "local",
        sortDir: "down"
    };
    obj.summaryData = calculateSummary();
    function calculateSummary() {
        var convertDebit = 0, convertCredit = 0;
        for (var i = 0; i < arrayData.length; i++) {
            var row = arrayData[i];
            convertDebit += parseFloat(row["DebitConvertedAmount"]);
            convertCredit += parseFloat(row["CreditConvertedAmount"]);
        }
        var summaryData2 = {
            JVDate: "",
            JVNo: "",
            AccountID: "",
            CorAccountID: "",
            Description: "",
            DebitConvertedAmount: "<b>" + format2(convertDebit, "", '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}') + "</b>",
            CreditConvertedAmount: "<b>" + format2(convertCredit, "", '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}') + "</b>"
        };
        return [summaryData2];
    }

    var $grid = $("#pqgrid_W90F1302_2").pqGrid(obj);
    $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $grid.pqGrid("refreshDataAndView");
</script>