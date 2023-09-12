<div class="row">
    <div class="col-md-12 col-xs-12">
        <div id="pqgrid_W90F1300_2" style="margin:auto;"></div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var obj = {
            width: '100%',
            height: iW90F1300Height,
            showTitle: false,
            numberCell: false,
            collapsible: false,
            editable: false,
            scrollModel: {horizontal: false, pace: 'fast', autoFit: true, lastColumn: 'none'}
        };
        obj.colModel = [
            {
                title: "Module",
                minWidth: 200,
                align: "center",
                dataType: "string",
                dataIndx: "ModuleName"
            }, {
                title: "{{Helpers::getRS($g,'Tong_so_phieu')}}",
                minWidth: 110,
                dataType: "integer",
                align: "center",
                dataIndx: "SumVoucherID",
                render: function (ui) {
                    var rowData = ui.rowData;
                    if (isNaN(rowData["SumVoucherID"]))
                        return rowData["SumVoucherID"];
                    else
                        return "<a class='text-blue btnListVoucherW90F1300_2'>" + rowData["SumVoucherID"] + "</a>";
                }
            },
            {
                title: "{{Helpers::getRS($g,'No')}}",
                minWidth: 130,
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
                minWidth: 130,
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
            }, {
                title: "",
                minWidth: 110,
                dataType: "integer",
                dataIndx: "Detail",
                align: "center",
                render: function (ui) {
                    var rowData = ui.rowData;
                    if (isNaN(rowData["CreditConvertedAmount"]))
                        return "";
                    else
                        return "<a class='text-blue btnListVoucherW90F1300_2'>{{Helpers::getRS($g,"Liet_ke_cac_phieu")}}</a>";
                }
            }
        ];
        var arrayData = {{json_encode($rs)}};
        obj.dataModel = {
            data: arrayData,
            location: "local",
            sorting: "local",
            sortDir: "down"
        };
        obj.summaryData = calculateSummary();
        function calculateSummary() {
            var convertDebit = 0, convertCredit = 0, sumVoucherID = 0;
            for (var i = 0; i < arrayData.length; i++) {
                var row = arrayData[i];
                convertDebit += parseFloat(row["DebitConvertedAmount"]);
                convertCredit += parseFloat(row["CreditConvertedAmount"]);
                sumVoucherID += parseInt(row["SumVoucherID"]);
            }
            var summaryData = {
                ModuleName: "<b>(" + arrayData.length + ")</b>",
                SumVoucherID: "<b>" + format2(sumVoucherID, "", 0) + "</b>",
                DebitConvertedAmount: "<b>" + format2(convertDebit, "", '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}') + "</b>",
                CreditConvertedAmount: "<b>" + format2(convertCredit, "", '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}') + "</b>",
                Detail: ""
            };
            return [summaryData];
        }

        //use refresh event to display jQueryUI buttons and bind events.
        obj.refresh = function (evt, ui) {
            var gridW90F1300_2 = $("#pqgrid_W90F1300_2");
            if (!gridW90F1300_2) {
                return;
            }
            //delete button
            gridW90F1300_2.find("a.btnListVoucherW90F1300_2")
                    .unbind("click")
                    .bind("click", function (evt) {
                        var $tr = $(this).closest("tr"),
                                rowIndx = gridW90F1300_2.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                        callListVouchers(rowIndx, gridW90F1300_2, 1);
                    });
        };
        var $grid = $("#pqgrid_W90F1300_2").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
    });

</script>