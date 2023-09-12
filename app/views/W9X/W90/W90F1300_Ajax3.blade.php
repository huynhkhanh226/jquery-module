<div class="row">
    <div class="col-md-12 col-xs-12">
        <div id="pqgrid_W90F1300_3" style="margin:auto;"></div>
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
                title: "{{Helpers::getRS($g,"Loai_phieu")}}",
                minWidth: 100,
                dataType: "string",
                dataIndx: "VoucherTypeID"
            },
            {
                title: "{{Helpers::getRS($g,"Ten_loai_phieu")}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "VoucherTypeName"
            },
            {
                title: "{{Helpers::getRS($g,'Tong_so_phieu')}}",
                minWidth: 90,
                align: "center",
                dataType: "integer",
                dataIndx: "SumVoucherID",
                render: function (ui) {
                    var rowData = ui.rowData;
                    if (isNaN(rowData["SumVoucherID"]))
                        return rowData["SumVoucherID"];
                    else
                        return "<a class='text-blue btnListVoucherW90F1300_3'>" + rowData["SumVoucherID"] + "</a>";
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
                minWidth: 90,
                dataType: "integer",
                dataIndx: "Detail",
                align: "center",
                render: function (ui) {
                    var rowData = ui.rowData;
                    if (isNaN(rowData["CreditConvertedAmount"]))
                        return "";
                    else
                        return "<a class='text-blue btnListVoucherW90F1300_3'>{{Helpers::getRS($g,"Liet_ke_cac_phieu")}}</a>";
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
                VoucherTypeID: "<div style='width:100%;text-align: center;font-weight: bold'>(" + arrayData.length + ")</div>",
                VoucherTypeName: "",
                SumVoucherID: "<b>" + format2(sumVoucherID, "", 0) + "</b>",
                DebitConvertedAmount: "<b>" + format2(convertDebit, "", '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}') + "</b>",
                CreditConvertedAmount: "<b>" + format2(convertCredit, "", '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}') + "</b>",
                Detail: ""
            };
            return [summaryData];
        }

        //use refresh event to display jQueryUI buttons and bind events.
        obj.refresh = function (evt, ui) {
            var gridW90F1300_3 = $("#pqgrid_W90F1300_3");
            if (!gridW90F1300_3) {
                return;
            }
            //delete button
            gridW90F1300_3.find("a.btnListVoucherW90F1300_3")
                    .unbind("click")
                    .bind("click", function (evt) {
                        var $tr = $(this).closest("tr"),
                                rowIndx = gridW90F1300_3.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                        callListVouchers(rowIndx, gridW90F1300_3, 2);
                    });
        };
        var $grid = $("#pqgrid_W90F1300_3").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
    });

</script>