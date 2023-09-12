<div class="row">
    <div class="col-md-12 col-xs-12">
        <div id="pqgridW27F2240" style="margin:auto;"></div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var obj = {
            width: '100%',
            height: $("#divD27F2240_W27F2240_W27F2240").height()-88,
            showTitle: false,
            numberCell:false,
            showBottom:false,
            collapsible: false,
            editable: false,
            freezeCols: 2,
            filterModel: {on: true, mode: "AND", header: true},
            pageModel: {type:"local", rPP:10 },
           scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'}
        };
        obj.colModel = [
            {
                title: "{{Helpers::getRS($g,'Trang_thai_PBH')}}",
                minWidth: 170,
                dataType: "string",
                align: "left",
                dataIndx: "VoucherStatus",
                filter: {
                    type: 'select',
                    condition: 'contain',
                    prepend: {'': '---'},
                    valueIndx: "VoucherStatus",
                    labelIndx: "VoucherStatus",
                    listeners: ['change']
                }
                //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}

            },
            {
                title: "{{Helpers::getRS($g,'Trang_thai_duyet')}}",
                minWidth: 140,
                dataType: "string",
                align: "left",
                dataIndx: "ApprovalStatus",
                filter: {
                     type: 'select',
                     condition: 'contain',
                     prepend: {'': '---'},
                     valueIndx: "ApprovalStatus",
                     labelIndx: "ApprovalStatus",
                     listeners: ['change']
                     }

            },
            {
                title: "{{Helpers::getRS($g,'Du_an_BDS')}}",
                minWidth: 170,
                dataType: "string",
                align: "left",
                dataIndx: "PropertyName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ma_BDS')}}",
                minWidth: 170,
                dataType: "string",
                align: "left",
                dataIndx: "OfficeID",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'So_phieu')}}",
                minWidth: 170,
                dataType: "string",
                align: "left",
                dataIndx: "VoucherNo",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ngay_phieu')}}",
                minWidth: 110,
                dataType: "date",
                align: "center",
                dataIndx: "VoucherDate",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,'Nguoi_lap')}}",
                minWidth: 170,
                dataType: "string",
                align: "left",
                dataIndx: "PreparedBy",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ngay_het_han')}}",
                minWidth: 110,
                dataType: "date",
                align: "center",
                dataIndx: "ExpireDate",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,'Ngay_ky_HD')}}",
                minWidth: 110,
                dataType: "date",
                align: "center",
                dataIndx: "ContractSignDate",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,'Ngay_yeu_cau')}}",
                minWidth: 110,
                dataType: "date",
                align: "center",
                dataIndx: "RequiredDate",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,'Hinh_thuc_ban_hang')}}",
                minWidth: 170,
                dataType: "string",
                align: "left",
                dataIndx: "SalesTypeName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Tieu_chuan_ban_giao')}}",
                minWidth: 170,
                dataType: "string",
                align: "left",
                dataIndx: "DeliveryStandardName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Chuong_trinh_ban_hangU')}}",
                minWidth: 230,
                dataType: "string",
                align: "left",
                dataIndx: "SalesPolicyName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Phieu_dat_coc')}}",
                minWidth: 230,
                dataType: "string",
                align: "left",
                dataIndx: "DepositNo",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ma_khach_hang')}}",
                minWidth: 110,
                dataType: "string",
                align: "left",
                dataIndx: "ObjectID",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ten_khach_hang')}}",
                minWidth: 170,
                dataType: "string",
                align: "left",
                dataIndx: "ObjectName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Nguoi_moi_gioi')}}",
                minWidth: 170,
                dataType: "string",
                align: "left",
                dataIndx: "IntermediaryName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ty_le_moi_gioi')}} (%)",
                minWidth: 140,
                dataType: "float",
                align: "right",
                dataIndx: "IntermediaryRate",
                numberFormat: 2,
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                render: function (ui) {
                    var rowData = ui.rowData;
                    return format2(rowData["IntermediaryRate"], '', 2);

                }

            },

            {
                title: "{{Helpers::getRS($g,'Ghi_chu')}}",
                minWidth: 340,
                dataType: "string",
                align: "left",
                dataIndx: "Notes",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "VoucherID",
                minWidth: 80,
                dataType: "string",
                align: "left",
                hidden:true,
                dataIndx: "VoucherID",
                isExport:false
            }
        ];

        var arrayData = {{json_encode($data)}};
        obj.dataModel = {
            data: arrayData,
            location: "local",
            sorting: "local",
            sortDir: "down"
        };

        var $grid = $("#pqgridW27F2240").pqGrid(obj);

        //Get datafilter for CustomerName col
        var column = $grid.pqGrid("getColumn", {dataIndx: "VoucherStatus"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $grid.pqGrid("getData", {dataIndx: ["VoucherStatus"]});

        //Get datafilter for CustomerName col
        var column = $grid.pqGrid("getColumn", {dataIndx: "ApprovalStatus"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $grid.pqGrid("getData", {dataIndx: ["ApprovalStatus"]});

        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
    });

</script>