<div class="row">
    <div class="col-md-12 col-xs-12">
        <div id="pqgrid_W90F1302_1" class="mgb5"></div>
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
            minWidth: 80,
            dataType: "date",
            align: "center",
            dataIndx: "JVDate"
        },
        {
            title: "{{Helpers::getRS($g,'So_chung_tu')}}",
            minWidth: 140,
            dataType: "string",
            dataIndx: "JVNo"
        },
        {
            title: "{{Helpers::getRS($g,'Doi_tuong')}}",
            minWidth: 110,
            dataType: "string",
            dataIndx: "Object"
        },
        {
            title: "{{Helpers::getRS($g,'Dien_giai')}}",
            minWidth: 280,
            dataType: "string",
            dataIndx: "Description"
        },
        {
            title: "{{Helpers::getRS($g,'TK_no')}}",
            minWidth: 60,
            dataType: "string",
            align: "center",
            dataIndx: "DebitAccountID",
            render: function (ui) {
                var rowData = ui.rowData;
                if (rowData["DebitAccountID"] == "")
                    return "";
                else
                    return rowData["DebitAccountID"] + "&nbsp;<span class='fa fa-info-circle text-blue' title='" + rowData["DebitAccountName"] + "'></span>";
            }
        },
        {
            title: "{{Helpers::getRS($g,'TK_co')}}",
            minWidth: 60,
            dataType: "string",
            align: "center",
            dataIndx: "CreditAccountID",
            render: function (ui) {
                var rowData = ui.rowData;
                if (rowData["CreditAccountID"] == "")
                    return "";
                else
                    return rowData["CreditAccountID"] + "&nbsp;<span class='fa fa-info-circle text-blue' title='" + rowData["CreditAccountName"] + "'></span>";
            }
        },
        {
            title: "{{Helpers::getRS($g,'No')}}",
            minWidth: 110,
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
            minWidth: 110,
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
    var arrayData = {{json_encode($rs1)}};
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
        var summaryData1 = {
            JVDate: "",
            JVNo: "",
            Object: "",
            Description: "",
            DebitAccountID: "",
            CreditAccountID: "",
            DebitConvertedAmount: "<b>" + format2(convertDebit, "", '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}') + "</b>",
            CreditConvertedAmount: "<b>" + format2(convertCredit, "", '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}') + "</b>"
        };
        return [summaryData1];
    }

    var $grid = $("#pqgrid_W90F1302_1").pqGrid(obj);
    $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $grid.pqGrid("refreshDataAndView");
</script>