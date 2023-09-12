<div class="row">
    <div class="col-md-12 col-xs-12 mgl15">
        <div class="btn-group">
            @if($permission > 1)
                <a onclick="showFormDialog('{{url("/W76F2070")}}','modalW76F2070')"
                   class="btn btn-default smallbtn" title="{{Helpers::getRS($g,"Them_moi1")}}">
                    <span class="glyphicon glyphicon-plus"></span> {{Helpers::getRS($g,"Them_moi1")}}
                </a>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-xs-12 mgt5 mgl15 mgr15">
        <div id="pqgrid_W76F2070"></div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-xs-12 mgl15">
        <div class="checkbox">
            <label>
                <input type="checkbox" id="chkShowDisabledW76F2070" name="chkShowDisabledW76F2070" value="0"/>
                {{Helpers::getRS($g,"Hien_thi_danh_muc_khong_su_dung")}}
            </label>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var iW76F2070Height = tabMainHeight - 85;
        var obj = {
            width: '97%',
            height: iW76F2070Height,
            showTitle: false,
            collapsible: false,
            selectionModel: {type: 'row', mode: 'single'},
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'}
        };
        obj.colModel = [
            {
                title: "", minWidth: 50, align: "center", sortable: false, maxWidth: 50, width: 50,
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = "";
                    @if ($permission > 2)
                        str += "<a title='{{Helpers::getRS($g,"Sua")}}' onclick='showW76F2070(\"" + rowData["DocCategoryID"] + "\")'><i class='glyphicon glyphicon-edit' style='color:orange;padding-right:5px'></i></a>";
                    @endif
                    @if ($permission > 3)
                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' onclick='deleteW76F2070(\"" + rowData["DocCategoryID"] + "\")'><i class='fa fa-trash'></i></a> ";
                    @else
                        str += " <i class='fa fa-lock text-red' style='font-size: 110%;'></i> ";
                    @endif
                    return str;
                }
            },
            {
                title: "{{Helpers::getRS($g,'Nhom_tai_lieu')}}",
                minWidth: 140,
                dataType: "string",
                dataIndx: "DocCategoryID",
                editor:false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ten_nhom')}}",
                minWidth: 300,
                width: 400,
                dataType: "string",
                dataIndx: "DocCategoryName",
                editor:false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"KSD")}}",
                maxWidth: 55,
                dataIndx: "Disabled",
                align: "center",
                sortable: false,
                editor:false,
                type: 'checkbox',
                render: function (ui) {
                    var rowData = ui.rowData;
                    return {
                        text: "<label><input type='checkbox' " + (rowData["Disabled"] == 1 ? "checked" : "") + " /></label>"
                    };
                }
            }
        ];
        var data = {{$rsData}};
        obj.dataModel = {
            data: data,
            location: "local",
            sorting: "local",
            sortDir: "down"
        };
        obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
        obj.create = function (evt, ui) {
            filterDisabled("pqgrid_W76F2070", $("#chkShowDisabledW76F2070").is(":checked") ? "" : 0);
        };
        var $grid = $("#pqgrid_W76F2070").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
    });

    $("#chkShowDisabledW76F2070").on("change", function (e) {
        filterDisabled("pqgrid_W76F2070", $("#chkShowDisabledW76F2070").is(":checked") ? "" : 0);
    });

    var showW76F2070 = function(id){
        showFormDialog('{{url("/W76F2070/")}}/'+id,'modalW76F2070');
    };

    function deleteW76F2070(id){
        ask_delete(function(){
            $.ajax({
                method: "DELETE",
                url: "{{url("W76F2070/")}}/" + id,
                success: function (data) {
                    var obj = $.parseJSON(data);
                    if (obj.code == 1) {
                        update4ParamGrid($(document).find("#pqgrid_W76F2070"),null,'delete');
                        $("#modalW76F2070").modal("hide");
                    }
                    else
                    {
                        alert_error(obj.mess);
                    }
                }
            });
        });
    };

</script>
