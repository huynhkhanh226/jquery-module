<div class="row">
    <div class="col-md-12 col-xs-12">
        <div id="pqgrid_W94F1200" style="margin:auto;"></div>
    </div>
</div>

<script type="text/javascript">
    var iW94F1200Height;

    $(document).ready(function () {
        iW94F1200Height = $(".contenttab").height() - 75;
        var obj = {
            width: '100%',
            height: iW94F1200Height,
            showTitle: false,
            collapsible: false,
            selectionModel: { type: 'row', mode: 'single'},
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel:{ horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none' }
        };
        obj.colModel = [
                @if(Session::get($pForm)>2)
                {
                title: "",
                minWidth: 60,
                width: 60,
                align: "center",
                editor: false,
                dataIndx: "View",
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = '<a title="{{Helpers::getRS($g,"Xem")}}" onclick="showFormDialog(\'{{url("/W94F1200/".$pForm."/edit/")}}/' + rowData["MReportID"] + '\',\'modalW94F1200\')"><i class="glyphicon glyphicon-edit text-yellow" style="padding-right: 5px"></i></a>';
                    @if(Session::get($pForm) >3)
                    str += '<a title="{{Helpers::getRS($g,"Xoa")}}" onclick="DeleteW94F1200(\''+rowData["MReportID"]+'\');"><i class="glyphicon glyphicon-bin text-black"></i></a>';
                    @endif
                    return str;
                }
            },
                @endif
            {
                title: "{{Helpers::getRS($g,'_Ma_bao_cao')}}",
                minWidth: 140,
                dataType: "string",
                editor: false,
                dataIndx: "MReportID",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ten_bao_cao')}}",
                minWidth: 200,
                width: 200,
                dataType: "string",
                editor: false,
                dataIndx: "MReportName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'TT_hien_thi')}}",
                minWidth: 80,
                dataType: "integer",
                dataIndx: "DisplayOrder",
                editor: false,
                align: "center",
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Thiet_bi')}}",
                minWidth: 90,
                dataType: "string",
                dataIndx: "PlatformName",
                editor: false,
                align: "center",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Nhom_bao_cao')}}",
                minWidth: 80,
                dataType: "string",
                dataIndx: "ReportGroupName",
                editor: false,
                align: "center",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Mau_bao_cao')}}",
                minWidth: 200,
                width: 200,
                dataType: "string",
                editor: false,
                dataIndx: "ReportFileName",
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
            filterDisabled("pqgrid_W94F1200",$("#chkShowDisabledW94F1200").is(":checked")?"":0);
        }
        var $grid = $("#pqgrid_W94F1200").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
    });

    function DeleteW94F1200(id)
    {
        ask_delete(ActionDeleteW94F1200,id);
    }

    function ActionDeleteW94F1200(id)
    {
        $.ajax({
            method: "POST",
            url: "{{url("W94F1200/".$pForm."/delete")}}/" + id,
            success: function (data) {
                if (data == 1) {
                    update4ParamGrid($(document).find("#pqgrid_W94F1200"),null,'delete');
                }
                else {
                    alert_warning("{{Helpers::getRS($g,'Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu')}}");
                    $("#frmD94F1200").find("#err").html('{{Helpers::getRS($g,'Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu')}}');
                    $("#frmD94F1200").find(".alert-danger").removeClass('hide');
                }
            }
        });
    }
</script>