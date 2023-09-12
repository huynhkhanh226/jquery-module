
<div class="modal fade modal noneOverflow noUseValidHTML5" id="modalW75F4090" data-keyboard="false"
     data-backdrop="static"
     role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <form class="form-horizontal" id="frmW75F4090" method="post" action="">
                <div class="modal-header">
                    {{Helpers::generateHeading($modalTitle,"W75F4090")}}
                </div>
                <div class="modal-body" style="padding:10px">
                    <div class="row form-group">
                        <div class="col-md-12 col-xs-12">
                            <div id="gridW75F4090"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    var obj = {
        width: '100%',
        numberCell: {show: false},
        height: $("#modalW75F4090").find('.modal-content').height() - 60,
        //resizable: true,
        showTitle: false,
        collapsible: false,
        selectionModel: {type: 'row', mode: 'single'},
        //filterModel: {on: true, mode: "AND", header: true},
        //scrollModel: {autoFit: false},
        scrollModel:{ horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none' },
        rowBorders: true,
        columnBorders: true,
        postRenderInterval: -1,
        freezeCols: 2,
		sortable: false,
        hwrap: false,
        wrap: false
    };
    obj.colModel = [
        {
            title: '',
            minWidth: 20,
            width: 60,
            dataType: "string",
            editor: false,
            hidden: true,
            align: "center",
            sortable: false,
            dataIndx: "DataID"
        },
        {
            title: '{{Helpers::getRS($g,"Du_lieu")}}',
            minWidth: 20,
            width: 330,
            dataType: "string",
            editor: false,
            align: "left",
            sortable: false,
            dataIndx: "Data"
        },
        {
            title: '{{Helpers::getRS($g,"Ngay_cong")}}',
            minWidth: 20,
            sortable: false,
            colModel: [
                @for($i=1; $i<=$days; $i++)
                    {
                        title: '{{$i}}',
                        minWidth: 20,
                        width: 70,
                        dataType: "string",
                        editor: false,
                        align: "center",
                        sortable: false,
                        dataIndx: "{{$i}}"
                    },
                @endfor
            ]
        }
    ];
    obj.dataModel = {
        data: {{json_encode($rs)}},
        location: "local",
        sorting: "local",
        sortDir: "down"
    };
    //obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
    $("#gridW75F4090").pqGrid(obj);
    $("#gridW75F4090").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    //$("#gridShiftList").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    $("#gridW75F4090").pqGrid("refreshDataAndView");

    $(function () {
        setTimeout(function () {
            resizePqGrid();
        }, 300);
    });

</script>

