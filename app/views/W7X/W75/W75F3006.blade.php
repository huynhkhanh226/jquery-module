<div class="modal draggable fade modal" id="modalW75F3006" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 800px">
        <div class="modal-content">
            <!-- form start -->
            <form class="form-horizontal" id="frmW75F3006" method="post" action="">
                <div class="modal-header">
                    {{Helpers::generateHeading($modalTitle,"W75F3006")}}
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col-md-12 col-xs-12">
                            <div id="pqgrid_W75F3006"></div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12 col-xs-12 ">
                            <button type="button" id="frm_btnSave"
                                    class="btn btn-default smallbtn pull-right mgb5"
                                    title="OK"
                                    onclick="ask_save(function(){save()})">
                                <span class="glyphicon glyphicon-ok text-blue"></span> OK
                            </button>
                            <button onclick="checkAll()" type="button" id="frm_btnSendmail"
                                    class="btn btn-default smallbtn pull-left mgr5 "
                                    title="{{Helpers::getRS($g,"Chon_tat_ca")}}">
                                <spans
                                        class="glyphicon glyphicon-check mgr5 text-orange"></spans> {{Helpers::getRS($g,"Chon_tat_ca")}}
                            </button>
                            <button onclick="unCheckAll()" type="button" id="frm_btnSendmail"
                                    class="btn btn-default smallbtn pull-left mgr5 "
                                    title="{{Helpers::getRS($g,"Bo_chon_tat_ca")}}"><span
                                        class="glyphicon glyphicon-unchecked mgr5 text-orange"></span> {{Helpers::getRS($g,"Bo_chon_tat_ca")}}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    var valueGrid = {{json_encode($valueGrid)}};
    //loadGrid();
    $(document).ready(function () {
        loadGrid();
    });

    function loadGrid() {
        //console.log(valueGrid);
        $(document).ready(function () {
            var iW75F3006_Height = $(document).height() - 600;

            var obj1 = {
                width: '100%',
                height: 612,
                showTitle: false,
                collapsible: false,
                selectionModel: {type: 'row', mode: 'single'},
                scrollModel: {horizontal: true, vertical: false, pace: 'fast', autoFit: true, lastColumn: 'none'},
                rowBorders: true,
                columnBorders: true,
                postRenderInterval: -1,
                freezeCols: 2,
                hwrap: false,
                wrap: false,
                sortable: false,
                numberCell: {show: false},
                /*editModel: {
                    saveKey: $.ui.keyCode.ENTER,
                    select: true,
                    keyUpDown: false,
                    cellBorderWidth: 0,
                    clicksToEdit: 1
                },*/
                colModel: [
                    {
                        title: 'IsUpdate',
                        minWidth: 90,
                        align: "left",
                        dataIndx: "IsUpdate",
                        isExport: false,
                        editor: false,
                        hidden: true
                    },
                    {
                        title: '',
                        minWidth: 50,
                        align: "center",
                        dataIndx: "Disabled",
                        isExport: true,
                        editor: false,
                        editable: true,
                        render: function (ui) {
                            var rowData = ui.rowData;
                            if (Number(rowData["FontStyle"]) == 0){
                                return '<input type="checkbox"' + (rowData["Disabled"] == 1 ? "checked" : "") + '>';
                            }else{
                                return '';
                            }

                            /*if (Number(rowData["GroupID"]) == 2) {
                                return '<input type="checkbox"' + (rowData["Disabled"] == 1 ? "checked" : "") + 'disabled>';
                            }else{
                                return '<input type="checkbox"' + (rowData["Disabled"] == 1 ? "checked" : "") + '>';
                            }*/
                        },
                        postRender: function (ui) {
                            if (this.isEditableCell(ui) == true) {
                                var rowIndx = ui.rowIndx,
                                    grid = this,
                                    $cell = grid.getCell(ui);

                                $cell.find("input[type='checkbox']")
                                    .unbind("click")
                                    .bind("click", function (evt) {
                                        //alert("hello");
                                        pqgrid_W75F3006 = $("#pqgrid_W75F3006");
                                        ui.rowData.IsUpdate = 1;
                                        var obj = pqgrid_W75F3006.pqGrid("getEditCell");
                                        var $editor = obj.$editor;
                                        if ($editor === undefined) {
                                            //alert("hell");
                                            var $tr = $(this).closest("tr"),
                                                rowIndx = pqgrid_W75F3006.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                            var rowData = pqgrid_W75F3006.pqGrid("getRowData", {rowIndx: rowIndx});
                                            if ($(this).is(":checked") == true) {
                                                rowData["Disabled"] = 1;
                                            }else{
                                                rowData["Disabled"] = 0;
                                            }
                                        } else {
                                            evt.stopPropagation();
                                            evt.preventDefault();
                                        }
                                        console.log(ui.rowData.GroupID);
                                    });
                            }
                        }

                    },
                    {
                        title: '{{Helpers::getRS($g,"Chon_tieu_chi_thong_ke")}}',
                        minWidth: 600,
                        align: "left",
                        dataIndx: "CriteriaName",
                        isExport: true,
                        editor: false,
                        render: function (ui) {
                            var rowData = ui.rowData;
                            if (Number(rowData["FontStyle"]) == 1) {
                                return '<label><strong>' + rowData["CriteriaName"] + '</strong></label>';
                            } else {
                                return '<label>' + rowData["CriteriaName"] + '</label>';
                            }
                        }
                    }
                ],
                dataModel: {
                    data: valueGrid,
                    location: "local",
                    sorting: "local",
                    sortDir: "down"
                },
                complete: function (event, ui) {
                    console.log('complete grid');

                },
                rowClick: function (event, ui) {

                },
                cellSave: function (event, ui) {
                    /* console.log("cellSave");
                     ui.rowData.IsUpdate = 1;
                     var rowData = ui.rowData;
                     //format before saveing
                     console.log(ui);
                     if (ui.column.dynamicColumn == true){
                         rowData[ui.dataIndx] = format2(rowData[ui.dataIndx], '', ui.column.decimals);
                     }
                     //End format
                     $("#pqgrid_W75F3005").pqGrid("refreshDataAndView");*/
                }
            };
            //obj1.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
            $("#pqgrid_W75F3006").pqGrid(obj1);
            $("#pqgrid_W75F3006").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#pqgrid_W75F3006").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            setTimeout(function () {
                $("#pqgrid_W75F3006").pqGrid("refreshDataAndView");
            }, 300)
        });
    }

    function checkAll() {
        //console.log("da click");
        $grid = $("#pqgrid_W75F3006");
        //$grid.pqGrid("quitEditMode");
        var obj = $grid.pqGrid("option", "dataModel.data");
        if (obj.length > 0) {
            for (var i = 0; i < obj.length; i++) {
                obj[i]["Disabled"] = 1;
                obj[i]["IsUpdate"] = 1;
            }
            $grid.pqGrid("option", "dataModel.data", obj);
            $grid.pqGrid("refreshDataAndView");
        }
    }

    function unCheckAll() {
        //console.log("da click");
        $grid = $("#pqgrid_W75F3006");
        //$grid.pqGrid("quitEditMode");
        var obj = $grid.pqGrid("option", "dataModel.data");
        if (obj.length > 0) {
            for (var i = 0; i < obj.length; i++) {
                console.log(Number(obj[i]["GroupID"]));
                if(Number(obj[i]["GroupID"]) != 2 && Number(obj[i]["GroupID"]) != 3 && Number(obj[i]["GroupID"]) != 4){
                    obj[i]["Disabled"] = 0;
                    obj[i]["IsUpdate"] = 1;
                }
            }
            $grid.pqGrid("option", "dataModel.data", obj);
            $grid.pqGrid("refreshDataAndView");
        }
    }

    function save() {
        var data = $("#pqgrid_W75F3006").pqGrid("option", "dataModel.data");
        var dataSender = $.grep(data, function (d) {
            return d.IsUpdate == 1;
        });
        if (dataSender.length > 0) {
            $.ajax({
                method: "POST",
                url: '{{url("/W75F3006/$pForm/$g/save")}}',
                data: {
                    dataSender: dataSender
                },
                success: function (data) {
                    //console.log(data);
                   if (data.status == 1) {
                        save_ok(function () {
                            filterGridW75F3005();
                        });
                    } else {
                        save_not_ok();
                    }
                }
            });
        } else {
            alert_warning("Chưa có cập nhật nào mới");
        }
    }
</script>