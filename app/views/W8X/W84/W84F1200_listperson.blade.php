<div class="row mgt5">
    <div class="col-md-12">
        <div id="pqgrid_W84P1201" style="margin:auto;"></div>
    </div>
    <div class="col-md-12 mgt10 mgb5">
        <button type="button" onclick="closePopListAuthorize()" class="btn btn-default smallbtn pull-right "><span
                    class="glyphicon glyphicon-remove mgr5"></span> {{Helpers::getRS($g,"DongU1")}}</button>
        <button type="button" id="btnChoose" class="btn btn-default smallbtn pull-right mgr10 disabled "><span
                    class="glyphicon glyphicon-ok mgr5"></span> {{Helpers::getRS($g,"Chon")}}</button>
    </div>
</div>

<script type="text/javascript">
    var oldVl = "";
    var indexRW84F1201 = -1;
    var GetFilterSelect = function (vl) {
        oldVl = vl;
    };

    $("#btnCloseFormW84P1201").on("click", function () {
        closePopListAuthorize();
    });

    $("#btnChoose").click(function () {
        var rowData = $("#pqgrid_W84P1201").pqGrid("getRowData", {rowIndx: indexRW84F1201});
        setTextAuthorize(rowData, '{{$type}}');
        closePopListAuthorize();
    });


    $(document).ready(function () {
        var tmpJSON1 = {{json_encode($listperson)}};
        var obj = {
            height: 480,
            showTitle: false,
            collapsible: false,
            editable: false,
            funcGetFilterSelect: GetFilterSelect,
            oldSelectFilter: '',
            pagerOneRow: true,
            scrollModel: {horizontal: false},
            flexWidth: true,
            filterModel: {on: true, mode: "AND", header: true},
            selectionModel: {type: 'row', mode: 'single'},
            selectChange: function (event, ui) {
                $("#btnChoose").removeClass('disabled');
                var a = this.selection({type: 'row', method: 'getSelection'});
                indexRW84F1201 = a[0].rowIndx;
            },
            rowDblClick: function (event) {
                $("#btnChoose").trigger('click');
            }
        };
        obj.colModel = [
            {
                title: "{{Helpers::getRS($g,'Ma_nguoi_dung')}}",
                minWidth: 150,
                dataType: "string",
                dataIndx: "UserID",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ten_nguoi_dung')}}",
                minWidth: 220,
                dataType: "string",
                dataIndx: "UserName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Phong_ban')}}",
                minWidth: 220,
                dataType: "string",
                dataIndx: "UserDepartment",
                filter: {
                    type: 'select',
                    condition: 'equal',
                    prepend: {'': '-- {{Helpers::getRS($g,'Chon')}} --'},
                    valueIndx: "UserDepartment",
                    labelIndx: "UserDepartment",
                    listeners: ['change']
                }
            },
            {
                title: "{{Helpers::getRS($g,'Chuc_vu')}}",
                minWidth: 200,
                width: 200,
                dataType: "string",
                dataIndx: "UserRole",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            }
        ];
        obj.dataModel = {data: tmpJSON1};
        obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 50]};
        var $grid = $("#pqgrid_W84P1201").pqGrid(obj);

        var column = $grid.pqGrid("getColumn", {dataIndx: "UserDepartment"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $grid.pqGrid("getData", {dataIndx: ["UserDepartment"]});

        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);

        $("#pqgrid_W84P1201").on("pqGrid:refresh", function (event, ui) {
            $("select[name='TransactionName'] option").each(function () {
                if ($(this).text() == oldVl) {
                    $(this).prop('selected', true);
                }
            });
        });
    });
</script>