<div id="pqgrid_W84F1200" style="margin:auto;"></div>
<script type="text/javascript">
    var oldVl = "";
    var GetFilterSelect = function (vl) {
        oldVl = vl;
    };

    $(document).ready(function () {
        var obj = {
            width: $("#W84F1200DT").width() - 33,
            height: $("#modalW84F1200").height()-$("#W84F1200DT").height()-80,
            showTitle: false,
            collapsible: false,
            editable: false,
            funcGetFilterSelect: GetFilterSelect,
            oldSelectFilter: '',
            scrollModel:{ horizontal: false, pace: 'fast', autoFit: true, lastColumn: 'none' },
            filterModel: {on: true, mode: "AND", header: true}
        };
        obj.colModel = [
            {
                title: "",
                minWidth: 40,
                align: "center",
                dataIndx: "Action",
                render: function (ui) {
                    var rowData = ui.rowData;
                    if (rowData["IsCancel"] == 0)
                        return '<a><i class="fa fa-remove text-red" onclick="CancelAuthorized(\'' + rowData["IsCancel"] + '\', \'' + rowData["VoucherID"] + '\')"></i></a>';
                    else
                        return '<a><i class="glyphicon glyphicon-remove" onclick="CancelAuthorized(\'' + rowData["IsCancel"] + '\', \'' + rowData["VoucherID"] + '\')"></i></a>';
                }
            },
            {
                title: "VoucherID",
                minWidth: 60,
                align: "center",
                hidden: true,
                dataIndx: "VoucherID"
            },
            {
                title: "{{Helpers::getRS($g,'Ngay')}}",
                minWidth: 90,
                dataType: "date",
                dataIndx: "CreateDate",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,'Quy_trinh_duyet')}}",
                minWidth: 220,
                dataType: "string",
                dataIndx: "TransactionName",
                filter: {
                    type: 'select',
                    condition: 'equal',
                    prepend: {'': '-- {{Helpers::getRS($g,'Chon')}} --'},
                    valueIndx: "TransactionName",
                    labelIndx: "TransactionName",
                    listeners: ['change']
                }
            },
            {
                title: "{{Helpers::getRS($g,'Nguoi_uy_quyen')}}",
                minWidth: 220,
                dataType: "string",
                dataIndx: "AuthorizeUserName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Nguoi_duoc_uy_quyen')}}",
                minWidth: 220,
                dataType: "string",
                dataIndx: "AuthorizedUserName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Hieu_luc')}}",
                minWidth: 150,
                dataType: "string",
                dataIndx: "ValidTime",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Trang_thai')}}",
                minWidth: 100,
                dataType: "string",
                dataIndx: "VoucherStatus",
                align: 'center',
                filter: {
                    type: 'select',
                    condition: 'equal',
                    prepend: {'': '-- {{Helpers::getRS($g,'Chon')}} --'},
                    valueIndx: "VoucherStatus",
                    labelIndx: "VoucherStatus",
                    listeners: ['change']
                },
                render: function (ui) {
                    var rowData = ui.rowData, dataIndx = ui.dataIndx;
                    rowData.pq_cellcls = rowData.pq_cellcls || {};
                    rowData.pq_cellcls[dataIndx] = rowData["StatusClassName"];
                    return rowData["VoucherStatus"];
                }
            }
        ];
        var tmpJSON = {{json_encode($grid)}};
        obj.dataModel = {data: tmpJSON};
        obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
        obj.create = function (evt, ui) {
            if (tmpJSON.length >0)
            {
                $("#pqgrid_W84F1200").pqGrid("setSelection", {rowIndx: 0});
                ShowMaster(ui.data[0].VoucherID);
            }
        };
        var $grid = $("#pqgrid_W84F1200").pqGrid(obj);

        var column = $grid.pqGrid("getColumn", {dataIndx: "TransactionName"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $grid.pqGrid("getData", {dataIndx: ["TransactionName"]});

        column = $grid.pqGrid("getColumn", {dataIndx: "VoucherStatus"});
        filter = column.filter;
        filter.cache = null;
        filter.options = $grid.pqGrid("getData", {dataIndx: ["VoucherStatus"]});

        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        var $pager = $grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");

        $grid.on("pqgridrefresh", function (event, ui) {
            $("select[name='TransactionName'] option").each(function () {
                if ($(this).text() == oldVl) {
                    $(this).prop('selected', true);
                }
            });
        });
        $grid.on("pqgridrowselect", function (event, ui) {
            ShowMaster(ui.rowData["VoucherID"]);
        });
    });
</script>