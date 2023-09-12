<div id="pqgrid_W76F2050" style="margin:auto;"></div>
<script type="text/javascript">
    var iW76F2050Height;

    $(document).ready(function () {
        iW76F2050Height = $("#divD76F2050_W76F2050_W76F2050").height() - 90;
        var obj = {
            width: '100%',
            height: iW76F2050Height,
            showTitle: false,
            collapsible: false,
            numberCell: {show: false},
            selectionModel: {type: 'row', mode: 'single'},
            filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            postRenderInterval: -1,
            hwrap: false,
            wrap: true

        };


        obj.colModel = [
                @if(Session::get($pForm)>0)
            {
                title: "",
                maxWidth: 55,
                width: 55,
                align: "center",
                editor: false,
                dataIndx: "View",
                render: function (ui) {
                    {{--var rowData = ui.rowData;--}}
                    {{--var str = '<a title="{{Helpers::getRS($g,"Xem")}}" onclick="showFormDialog(\'{{url("/W76F2051/".$pForm."/")}}/' + rowData["FacilityID"] + '\',\'modalW76F2051\')"> <i class="glyphicon glyphicon-edit text-yellow" style="padding-right: 5px"></i></a>';--}}
                    {{--@if(Session::get($pForm) >3)--}}
                        {{--str += '<a title="{{Helpers::getRS($g,"Xoa")}}" onclick="DeleteW76F2050(\'' + rowData["FacilityID"] + '\');"><i class="glyphicon glyphicon-bin text-black"></i></a>';--}}
                    {{--@endif--}}
                        {{--return str;--}}

                    var permission = Number("{{Session::get($pForm)}}");
                    console.log(permission);
                    var str = digiContextMenu({
                            showText: true,
                            buttonList: [
                                {
                                    ID: "btnViewW76F2050",
                                    icon: "fa fa-eye text-green",
                                    title: '{{Helpers::getRS($g,"Xem")}}',
                                    enable: function () {
                                        return permission >= 1;
                                    },
                                    hidden: function () {
                                        return !(permission >= 1);
                                    },
                                    type: "button",
                                },
                                {
                                    ID: "btnEditW76F2050",
                                    icon: "fa fa-edit text-yellow",
                                    title: '{{Helpers::getRS($g,"Sua")}}',
                                    enable: function () {
                                        return permission >= 3;
                                    },
                                    hidden: function () {
                                        return !(permission >= 3);
                                    },
                                    type: "button",
                                }
                                , {
                                    ID: "btnDeleteW76F2050",
                                    icon: "fa fa-trash text-red",
                                    title: '{{Helpers::getRS($g,"Xoa")}}',
                                    enable: function () {
                                        return permission >= 4;
                                    },
                                    hidden: function () {
                                        return !(permission >= 4);
                                    },
                                    type: "button"
                                }
                            ]
                        }
                    );
                    return str;
                }
                , postRender: function (ui) {
                var rowIndx = ui.rowIndx,
                    grid = this,
                    $cell = grid.getCell(ui);
                var rowData = ui.rowData;
                $cell.find(".btnViewW76F2050").bind("click", function (evt) {
                    showFormDialogPost('{{url("/W76F2051/".$pForm."/".$g)}}' + "/view",'modalW76F2051', {id: rowData["FacilityID"]});
                });
                $cell.find(".btnEditW76F2050").bind("click", function (evt) {
                    postMethod("{{url("W76F2050/")}}/" +rowData["FacilityID"] , function(data){
                        if (data == 1) {
                            showFormDialogPost('{{url("/W76F2051/".$pForm."/". $g)}}'   + "/edit",'modalW76F2051', {id: rowData["FacilityID"]});
                        } else {
                            alert_warning(data);
                        }
                    });





                });
                //edit button
                $cell.find(".btnDeleteW76F2050").bind("click", function (evt) {
                    deleteW76F2050('' + rowData["FacilityID"] + '');
                });
            }
            },
                @endif
            {
                title: "{{Helpers::getRS($g,'Phong_hopU')}}",
                minWidth: 140,
                dataType: "string",
                dataIndx: "FacilityNo",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: createGridHeader("{{Helpers::getRS($g,'Ten_phong_hop')}}"),
                minWidth: 20,
                width: 250,
                dataType: "string",
                dataIndx: "FacilityName",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Dia_diem')}}",
                minWidth: 180,
                width: 250,
                dataType: "string",
                dataIndx: "Location",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'So_cho_ngoi')}}",
                minWidth: 60,
                width: 110,
                align: "center",
                dataType: "string",
                dataIndx: "Capacity",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'Ghi_chu')}}",
                minWidth: 180,
                width: 200,
                dataType: "string",
                dataIndx: "Description",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,'KSD')}}",
                minWidth: 60,
                dataType: "string",
                dataIndx: "Disabled",
                align: "center",
                editor: false,
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
            filterDisabled("pqgrid_W76F2050", $("#chkShowDisabledW94F1100").is(":checked") ? "" : 0);
        };
        var $grid = $("#pqgrid_W76F2050").pqGrid(obj);
        $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $grid.pqGrid("refreshDataAndView");
    });

    function refreshPQ() {
        $("#pqgrid_W76F2050").pqGrid("refresh");
    }

    function deleteW76F2050(id) {
        ask_delete(actionDeleteW76F2050, id);
    }

    function actionDeleteW76F2050(id) {
        $.ajax({
            method: "DELETE",
            url: "{{url("W76F2050/")}}/" + id,
            success: function (data) {
                var obj = $.parseJSON(data);
                if (obj.code == 0) {
                    delete_ok(function(){
                        update4ParamGrid($(document).find("#pqgrid_W76F2050"), null, 'delete');
                        $("#modalW76F2051").modal("hide");
                    });

                }
                else {
                    alert_error(obj.mess);
                }
            }
        });
    }
</script>