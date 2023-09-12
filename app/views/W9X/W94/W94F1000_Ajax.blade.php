<div class="row">
    <div class="col-md-12 col-xs-12">
        <div id="pqgrid_W94F1000" style="margin:auto;"></div>
    </div>
</div>
<script type="text/javascript">
    var iW94F1000Height;

    $(document).ready(function () {
        iW94F1000Height = $(".contenttab").height() - 75;
        var obj = {
            width: '100%',
            height: iW94F1000Height,
            showTitle: false,
            collapsible: false,
            selectionModel: {type: 'row', mode: 'single'},
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: false, pace: 'fast', autoFit: true, lastColumn: 'none'}
        };
        obj.colModel = [
                @if(Session::get($pForm)>2)
            {
                title: "",
                maxWidth: 55,
                width: 55,
                align: "center",
                dataIndx: "View",
                editor: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = '<a title="{{Helpers::getRS($g,"Xem")}}" onclick="showFormDialog(\'{{url("/W94F1000/".$pForm."/edit/")}}/' + rowData["ReportGroupID"] + '\',\'modalW94F1000\')"><i class="glyphicon glyphicon-edit text-yellow" style="padding-right: 5px"></i></a>';
                    @if(Session::get($pForm) >3)
                            str += '<a title="{{Helpers::getRS($g,"Xoa")}}" onclick="DeleteW94F1000(\'' + rowData["ReportGroupID"] + '\');"><i class="glyphicon glyphicon-bin text-black"></i></a>';
                    @endif
                            return str;
                }
            },
                @endif
            {
                title: "{{Helpers::getRS($g,'Ma_nhom')}}",
                minWidth: 180,
                dataType: "string",
                editor: false,
                dataIndx: "ReportGroupID",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },

            {
                title: "{{Helpers::getRS($g,'Ten_nhom')}}",
                minWidth: 250,
                width: 300,
                dataType: "string",
                editor: false,
                dataIndx: "ReportGroupName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Thu_tu_hien_thi')}}",
                minWidth: 100,
                align: "center",
                dataType: "string",
                editor: false,
                dataIndx: "DisplayOrder",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },

            {
                title: "{{Helpers::getRS($g,'Nhom_truy_cap_DL')}}",
                minWidth: 200,
                dataType: "string",
                editor: false,
                dataIndx: "DAGroupName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },

            {
                title: "{{Helpers::getRS($g,'KSD')}}",
                minWidth: 60,
                dataType: "string",
                editor: false,
                dataIndx: "Disabled",
                align: "center",
                render: function (ui) {
                    var rowData = ui.rowData;
                    return '<input type="checkbox" disabled ' + (rowData["Disabled"] == 1 ? "checked" : "") + '>';
                }
            }

        ];
        obj.dataModel = {
            data: {{json_encode($rsData)}},
            location: "local",
            sorting: "local",
            sortDir: "down"
        };
        obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
        obj.create = function (evt, ui) {
            filterDisabled("pqgrid_W94F1000", $("#chkShowDisabledW94F1100").is(":checked") ? "" : 0);
        };
        var $grid = $("#pqgrid_W94F1000").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
    });

    function DeleteW94F1000(id) {
        ask_delete(ActionDeleteW94F1000, id);
    }

    function ActionDeleteW94F1000(id) {
        $.ajax({
            method: "POST",
            url: "{{url("W94F1000/".$pForm."/delete")}}/" + id,
            success: function (data) {
                if (data == 1) {
                    update4ParamGrid($(document).find("#pqgrid_W94F1000"), null, 'delete');
                }
                else if (data == 2) {
                    alert_warning("{{Helpers::getRS($g,'Ma_nay_da_duoc_su_dung_Ban_khong_the_xoa')}}");
                }
                else {
                    alert_warning("{{Helpers::getRS($g,'Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu')}}");
                }
            }
        });
    }
</script>