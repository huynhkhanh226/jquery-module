<div class="row">
    <div class="col-md-12 col-xs-12">
        <div id="pqgrid_W90F1300_1" style="margin:auto;"></div>
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
            //showBottom: false,
            editable: false,
            scrollModel: {horizontal: false, pace: 'fast', autoFit: true, lastColumn: 'none'}
        };
        obj.colModel = [
            {
                title: "{{Helpers::getRS($g,'Ngay')}}",
                minWidth: 80,
                dataType: "date",
                align: "center",
                dataIndx: "VoucherDate"
            }, {
                title: "{{Helpers::getRS($g,'Tong_so_phieu')}}",
                minWidth: 70,
                dataType: "integer",
                dataIndx: "SumVoucherID",
                align: "center",
                render: function (ui) {
                    var rowData = ui.rowData;
                    if (isNaN(rowData["SumVoucherID"]))
                        return rowData["SumVoucherID"];
                    else
                        return "<a class='text-blue btnListVoucherW90F1300_1'>" + rowData["SumVoucherID"] + "</a>";
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
                minWidth: 100,
                dataType: "integer",
                dataIndx: "Detail",
                align: "center",
                render: function (ui) {
                    var rowData = ui.rowData;
                    if (isNaN(rowData["CreditConvertedAmount"]))
                        return "";
                    else
                        return "<a class='text-blue btnListVoucherW90F1300_1'>{{Helpers::getRS($g,"Liet_ke_cac_phieu")}}</a>";
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
                VoucherDate: "<b>(" + arrayData.length + ")</b>",
                SumVoucherID: "<b>" + format2(sumVoucherID, "", 0) + "</b>",
                DebitConvertedAmount: "<b>" + format2(convertDebit, "", '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}') + "</b>",
                CreditConvertedAmount: "<b>" + format2(convertCredit, "", '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}') + "</b>",
                Detail: ""
            };
            return [summaryData];
        }
        //use refresh event to display jQueryUI buttons and bind events.
        obj.refresh = function (evt, ui) {
            var gridW90F1300_1 = $("#pqgrid_W90F1300_1");
            if (!gridW90F1300_1) {
                return;
            }
            $("#pqgrid_W90F1300_1").find(".pq-grid-footer").hide();
            //delete button
            gridW90F1300_1.find("a.btnListVoucherW90F1300_1")
                    .unbind("click")
                    .bind("click", function (evt) {
                        var $tr = $(this).closest("tr"),
                                rowIndx = gridW90F1300_1.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                        callListVouchers(rowIndx, gridW90F1300_1, 0);
                    });
        };

        var $grid = $("#pqgrid_W90F1300_1").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
    });

</script>