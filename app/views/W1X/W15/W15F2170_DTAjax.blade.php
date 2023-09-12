<div class="nav-tabs-custom mgt10" style="margin-bottom: 0px;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tabW15F2170_1"
                              onclick='setTimeout(function(){$("#pgrid_tabW15F2170_1_").pqGrid("refresh")},100)'
                              data-toggle="tab">{{Helpers::getRS($g,"Tong_hop")}}</a>
        </li>
        <li><a href="#tabW15F2170_2" onclick='setTimeout(function(){$("#pgrid_tabW15F2170_2_").pqGrid("refresh")},100)'
               data-toggle="tab">{{Helpers::getRS($g,"Chi_tiet")}}</a></li>
        <li><a href="#tabW15F2170_3" onclick='setTimeout(function(){$("#pgrid_tabW15F2170_3_").pqGrid("refresh")},100)'
               data-toggle="tab">{{Helpers::getRS($g,"Chi_tiet_nghi_phep")}}</a></li>
    </ul>
    @define $lqty=0;
    <div class="tab-content pdl0 pdr0">
        <div class="tab-pane active" id="tabW15F2170_1">
            <div id="pgrid_tabW15F2170_1_"></div>
        </div>
        <div class="tab-pane " id="tabW15F2170_2">
            <div id="pgrid_tabW15F2170_2_"></div>
        </div>
        <div class="tab-pane" id="tabW15F2170_3">
            <div id="ctabW15F2170_3">
                <div id="pgrid_tabW15F2170_3_"></div>
            </div>
        </div>
    </div>
    <!-- /.tab-content -->
</div>
<script type="text/javascript">
    $(function () {


//Load pgrid_tabW15F2170_1_
        var obj = {
            width: '100%',
            height: 259,
            showTitle: false,
            collapsible: false,
            selectionModel: {type: 'row', mode: 'single'},
            scrollModel: {horizontal: false, pace: 'fast', autoFit: true, lastColumn: 'none'},
            showSummary: [true, true],
        };
        obj.colModel = [
            {
                title: "{{Helpers::getRS($g,'Loai_phep')}}",
                minWidth: 110,
                width: 170,
                dataType: "string",
                editor: false,
                dataIndx: "LeaveTypeName",
            },

            {
                title: "{{Helpers::getRS($g,'So_luong_duoc_cap')}}",
                minWidth: 80,
                width: 80,
                dataType: "float",
                editor: false,
                dataIndx: "Quantity",
                align: "right",
                format: '{{\Helpers::getStringFormat($decimals)}}',
            },
            {
                title: "{{Helpers::getRS($g,'So_luong_da_nghi_den').' '.$tranmonth.'/'.$tranyear}}",
                minWidth: 80,
                width: 80,
                dataType: "float",
                editor: false,
                dataIndx: "UsedLeaveQuan",
                align: "right",
                format: '{{\Helpers::getStringFormat($decimals)}}',
            },

            {
                title: "{{Helpers::getRS($g,'So_luong_ton_den')." " .' '.$tranmonth.'/'.$tranyear}}",
                minWidth: 80,
                width: 80,
                dataType: "float",
                editor: false,
                dataIndx: "ToPeriodLB",
                align: "right",
                format: '{{\Helpers::getStringFormat($decimals)}}',
            },

            {
                title: "{{Helpers::getRS($g,'So_luong_ton_den_cuoi_nam')}}",
                minWidth: 80,
                width: 80,
                dataType: "float",
                editor: false,
                dataIndx: "Disabled",
                align: "right",
                dataIndx: "ClosingLB",
                format: '{{\Helpers::getStringFormat($decimals)}}',
            }

        ];
        obj.dataModel = {
            data: {{json_encode($rs1)}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        };
        //obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
        $("#pgrid_tabW15F2170_1_").pqGrid(obj);
        //$grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        //$grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $("#pgrid_tabW15F2170_1_").pqGrid({
            summaryData : [
                {
                    Quantity:'{{\Helpers::sumFooter($rs1, 'Quantity')}}',
                    UsedLeaveQuan:'{{\Helpers::sumFooter($rs1, 'UsedLeaveQuan')}}',
                    ToPeriodLB:'{{\Helpers::sumFooter($rs1, 'ToPeriodLB')}}',
                    ClosingLB:'{{\Helpers::sumFooter($rs1, 'ClosingLB')}}',
                },

            ]
        });
    });
    $("#pgrid_tabW15F2170_1_").pqGrid("refreshDataAndView");

    //Load pgrid_tabW15F2170_2_
    var obj = {
        width: '100%',
        height: 259,
        title: "{{'<b>'.Helpers::getRS($g,'Du_lieu_cap_phep').'</b>'}}",
        showTitle: true,
        collapsible: false,
        selectionModel: {type: 'row', mode: 'single'},
        scrollModel: {horizontal: false, pace: 'fast', autoFit: true, lastColumn: 'none'}
    };
    obj.colModel = [
        {
            title: "{{Helpers::getRS($g,'Loai_phep')}}",
            minWidth: 110,
            width: 170,
            dataType: "string",
            editor: false,
            dataIndx: "LeaveTypeName",
        },

        {
            title: "{{Helpers::getRS($g,'So_luong')}}",
            minWidth: 80,
            width: 80,
            dataType: "float",
            editor: false,
            dataIndx: "Quantity",
            align: "right",
            format: '{{\Helpers::getStringFormat($decimals)}}',
        },
        {
            title: "{{Helpers::getRS($g,'So_luong_con_lai') }}",
            minWidth: 80,
            width: 80,
            dataType: "float",
            editor: false,
            dataIndx: "RemainQuantity",
            align: "right",
            format: '{{\Helpers::getStringFormat($decimals)}}',
        },

        {
            title: "{{Helpers::getRS($g,'Ngay_hieu_luc')}}",
            minWidth: 80,
            width: 80,
            dataType: "date",
            editor: false,
            dataIndx: "ValidDateFrom",
            align: "center",
        },

        {
            title: "{{Helpers::getRS($g,'Ngay_het_hieu_luc')}}",
            minWidth: 80,
            width: 80,
            dataType: "date",
            editor: false,
            dataIndx: "Disabled",
            align: "center",
            dataIndx: "ValidDateTo"

        }

    ];
    obj.dataModel = {
        data: {{json_encode($rs2)}},
        location: "local",
        sorting: "local",
        sortDir: "down"
    };
    //obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
    $("#pgrid_tabW15F2170_2_").pqGrid(obj);
    //$grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    //$grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    $("#pgrid_tabW15F2170_2_").pqGrid({
        summaryData : [
            {
                Quantity:'{{\Helpers::sumFooter($rs2, 'Quantity')}}',
                RemainQuantity:'{{\Helpers::sumFooter($rs2, 'RemainQuantity')}}',
            },

        ]
    });
    $("#pgrid_tabW15F2170_2_").pqGrid("refreshDataAndView");

    //Load pgrid_tabW15F2170_3_
    var obj = {
        width: '100%',
        height: 259,
        showTitle: false,
        collapsible: false,
        selectionModel: {type: 'row', mode: 'single'},
        scrollModel: {horizontal: false, pace: 'fast', autoFit: true, lastColumn: 'none'}
    };
    obj.colModel = [
        {
            title: "{{Helpers::getRS($g,'Ngay_nghi_phep')}}",
            minWidth: 50,
            width: 80,
            dataType: "date",
            editor: false,
            align: "center",
            dataIndx: "LeaveDate",
        },

        {
            title: "{{Helpers::getRS($g,'Loai_phep')}}",
            minWidth: 80,
            width: 450,
            dataType: "string",
            editor: false,
            dataIndx: "LeaveTypeName",
            align: "left",
        },
        {
            title: "{{Helpers::getRS($g,'So_luong') }}",
            minWidth: 50,
            width: 80,
            dataType: "float",
            editor: false,
            dataIndx: "Quantity",
            align: "right",
            format: '{{\Helpers::getStringFormat($decimals)}}',
        },


    ];
    obj.dataModel = {
        data: {{json_encode($rs3)}},
        location: "local",
        sorting: "local",
        sortDir: "down"
    };
    //obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
    $("#pgrid_tabW15F2170_3_").pqGrid(obj);
    //$grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    //$grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    $("#pgrid_tabW15F2170_3_").pqGrid({
        summaryData : [
            {
                Quantity:'{{\Helpers::sumFooter($rs3, 'Quantity')}}',
            },

        ]
    });
    $("#pgrid_tabW15F2170_3_").pqGrid("refreshDataAndView");

    $(document).on('shown.bs.tab', function (e) {
        $("#pgrid_tabW15F2170_1_").pqGrid("refreshDataAndView");
         $("#pgrid_tabW15F2170_2_").pqGrid("refreshDataAndView");
         $("#pgrid_tabW15F2170_3_").pqGrid("refreshDataAndView");
    })

</script>

