
<div id="pqgrid_historyW09F2510" class="mgt5"></div>
<script type="text/javascript">
    var iW09F2510Height;
    var iW09F2510Width;
    $(document).ready(function () {
        iW09F2510Width = $(".pdl25percent").width()+27;
        iW09F2510Height = $("#modalW09F2510").height() - 410;
        var obj = {
            width: iW09F2510Width,
            height: iW09F2510Height,
            showTitle: false,
            collapsible: false,
            editable: false,
            scrollModel:{ horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none' }
//            filterModel: {on: true, mode: "AND", header: true}
        };
        obj.colModel = [
            {
                title: "{{Helpers::getRS($g,'Ngay')}}",
                minWidth: 80,
                dataType: "string",
                align: "center",
                dataIndx: "TransDate"
            },
            {
                title: "{{Helpers::getRS($g,'Thong_tin')}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "PropertyName"
            },
            {
                title: "{{Helpers::getRS($g,'Gia_tri_de_xuat')}}",
                minWidth: 260,
                dataType: "string",
                dataIndx: "PropertyValue"
            },
            {
                title: "{{Helpers::getRS($g,'Ghi_chu')}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "Notes"
            },
            {
                title: "{{Helpers::getRS($g,'Da_duyet')}}",
                minWidth: 70,
                //dataType: "bool",
                dataIndx: "Approved",
                align: "center",
                render: function (ui) {
                    var rowData = ui.rowData;
                    return '<input type="checkbox" disabled ' + (rowData["Approved"] == 1?"checked":"") + '>';
                }
            }
        ];
        obj.dataModel = {
            data: {{json_encode($data)}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        };
        obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
        var $grid = $("#pqgrid_historyW09F2510").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
    });

    function resizePqGridW09F2510() {
        var width = $("#pqgrid_historyW09F2510").pqGrid("option", "width");
        $("#pqgrid_historyW09F2510").pqGrid({width: $(".pdl25percent").width()+25});
        $("#pqgrid_historyW09F2510").pqGrid("refresh");
    }
</script>
