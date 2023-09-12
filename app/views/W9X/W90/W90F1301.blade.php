<div class="modal fade pd0" id="modalW90F1301" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading(Helpers::getRS($g,"Liet_ke_cac_chung_tu"),"W90F1301")}}
            </div>
            <div class="modal-body">
                <div id="pqgrid_W90F1301" class="mgt5"></div>
            </div>
        </div>
    </div>
    <!-- /.end form  -->
</div>
<section id="secW90F1302"></section>
<script>
    $("#modalW90F1301").on('shown.bs.modal', function () {
        var obj = {
            width: '100%',
            height: documentHeight - 70,
            showTitle: false,
            collapsible: false,
            editable: false,
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: false, pace: 'fast', autoFit: true, lastColumn: 'none'}
        };
        obj.colModel = [
            {
                title: "{{Helpers::getRS($g,'Ngay_phieu')}}",
                width: 80,
                dataType: "date",
                align: "center",
                dataIndx: "VoucherDate",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,"So_phieu")}}",
                width: 140,
                dataType: "string",
                dataIndx: "VoucherID",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Nguoi_lap')}}",
                width: 170,
                dataType: "string",
                align: "center",
                dataIndx: "EmployeeName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Dien_giai_phieu')}}",
                width: 300,
                dataType: "string",
                dataIndx: "Notes",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "Module",
                width: 140,
                dataType: "string",
                align: "center",
                dataIndx: "ModuleName",
                filter: {
                    type: 'select',
                    condition: 'equal',
                    prepend: {'': '-- {{Helpers::getRS($g,'Chon')}} --'},
                    valueIndx: "ModuleName",
                    labelIndx: "ModuleName",
                    listeners: ['change']
                }
            },
            {
                title: "ModuleID",
                hidden: true,
                dataType: "string",
                dataIndx: "ModuleID",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'No')}}",
                width: 130,
                dataType: "float",
                dataIndx: "DebitConvertedAmount",
                align: "right",
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
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
                width: 130,
                dataType: "float",
                dataIndx: "CreditConvertedAmount",
                align: "right",
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                render: function (ui) {
                    var rowData = ui.rowData;
                    if (isNaN(rowData["CreditConvertedAmount"]))
                        return rowData["CreditConvertedAmount"];
                    else
                        return formatNum(rowData["CreditConvertedAmount"], '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}', false);
                }
            },
            {
                title: "",
                width: 110,
                dataType: "integer",
                dataIndx: "Detail",
                align: "center",
                render: function (ui) {
                    var rowData = ui.rowData;
                    if (isNaN(rowData["CreditConvertedAmount"]))
                        return "";
                    else
                        return "<a class='text-blue btnDetailVoucher'>{{Helpers::getRS($g,"Xem_chi_tiet")}}</a>";
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
            var convertDebit = 0, convertCredit = 0;
            for (var i = 0; i < arrayData.length; i++) {
                var row = arrayData[i];
                convertDebit += parseFloat(row["DebitConvertedAmount"]);
                convertCredit += parseFloat(row["CreditConvertedAmount"]);
            }
            var summaryData = {
                VoucherDate: "",
                VoucherID: "<div style='width:100%;text-align: center;font-weight: bold'>(" + arrayData.length + ")</div>",
                DebitConvertedAmount: "<b>" + format2(convertDebit, "", '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}') + "</b>",
                CreditConvertedAmount: "<b>" + format2(convertCredit, "", '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}') + "</b>",
                Detail: ""
            };
            return [summaryData];
        }

        //use refresh event to display jQueryUI buttons and bind events.
        obj.refresh = function () {
            var pqgrid_W90F1301 = $("#pqgrid_W90F1301");
            if (!pqgrid_W90F1301) {
                return;
            }
            //delete button
            pqgrid_W90F1301.find("a.btnDetailVoucher")
                    .unbind("click")
                    .bind("click", function (evt) {
                        var $tr = $(this).closest("tr"),
                                rowIndx = pqgrid_W90F1301.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                        callW90F1302(rowIndx, pqgrid_W90F1301);
                    });
        };
        var $grid = $("#pqgrid_W90F1301").pqGrid(obj);
        var column = $grid.pqGrid("getColumn", {dataIndx: "ModuleName"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $grid.pqGrid("getData", {dataIndx: ["ModuleName"]});
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
    });

    function callW90F1302(rIndx, $grid) {
        var rowData = $grid.pqGrid("getRowData", {rowIndx: rIndx});
        $.ajax({
            method: "POST",
            url: '{{url("W90F1302")}}',
            data: {row: rowData, div: '{{$div}}'},
            success: function (data) {
                $("#secW90F1302").html(data);
                $("#modalW90F1302").modal("show");
            }
        });
    }
</script>


