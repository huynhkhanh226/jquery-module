<div class="modal fade pd0" id="modalW47F3001" data-backdrop="static" role="dialog"
     style="position: absolute !important;">
    <div class="modal-dialog" style="width: 500px">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($title3001,"W47F3001",false,"closePopW47F3001")}}
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label class="control-label lbl-normal">{{Helpers::getRS($g,"Hop_dong")}}</label>
                        </div>
                        <div class="col-md-8">
                            <label class="control-label lblContractNo"></label>
                        </div>
                    </div>
                    <div class="row  form-group">
                        <div class="col-md-4">
                            <label class="control-label lbl-normal">{{Helpers::getRS($g,"So_tien")}}</label>
                        </div>
                        <div class="col-md-8">
                            <label class="control-label lblOAmount"></label>
                        </div>
                    </div>
                    <div class="row  form-group">
                        <div class="col-md-4">
                            <label class="control-label lbl-normal">{{Helpers::getRS($g,"Ngay_thanh_toan_chinh")}}</label>
                        </div>
                        <div class="col-md-5">
                            <label class="control-label lblScheduleDate"></label>
                        </div>
                        <div class="col-md-3">
                            <input id="isOffW47F3001" type="checkbox" data-toggle="toggle" data-style="ios">
                        </div>

                    </div>
                    <div class="row mgt5">
                        <div class="col-md-12">
                            <div id="pqGrid_W47F3001"></div>
                        </div>
                        <input type="hidden" id="hdContractID" value="">
                        <input type="hidden" id="hdParameter" value="">
                    </div>
                    <div class="box-footer">
                        <button id="frm_btnSave" type="button"
                                class="btn btn-default smallbtn pull-right"><span
                                    class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var newDate = null;
        $('#isOffW47F3001').bootstrapToggle();

        $('#isOffW47F3001').change(function () {
            $(this).val($(this).prop('checked') ? 0 : 1);
        })

        var dateEditor = function (ui) {
            var $inp = ui.$cell.find("input");
            //initialize the editor
            $inp.datepicker({
                changeMonth: true,
                changeYear: true,
                autoclose: true,
                format: "dd/mm/yyyy",
                language: '{{$lang}}',
                todayHighlight: true,
                showOnFocus: true,
                toggleActive: true,
                allowDeselection: false,
                defaultViewDate: '',
                isDateGrid: true,
                startDate: '{{date('d/m/Y')}}'
            }).on('changeDate', function (d) {
                newDate = (new Date(d.date)).toString('dd/MM/yyyy');
            });
        };

        var getCustomData = function (ui) {
            return newDate;
        };

        var addRowW47F3001 = function () {
            /*var amount = l3Number($("#modalW47F3001").find(".lblOAmount").html());
            var date = $("#modalW47F3001").find(".lblScheduleDate").text();
            var idx = $("#pqGrid_W47F3001").pqGrid("addRow", {newRow: {PlanDate:date, 'OAmount':amount-totalW473001}});
            $("#pqGrid_W47F3001").pqGrid("setSelection", {rowIndx: idx, colIndx: 0});
            $("#pqGrid_W47F3001").pqGrid("refreshDataAndView");
            updateTotalW473001();*/
            var amount = l3Number($("#modalW47F3001").find(".lblOAmount").html().replace(/,/g, ""));
            var date = $("#modalW47F3001").find(".lblScheduleDate").text();
            console.log((amount - totalW473001));
            if ((amount - totalW473001) > 0) {
                var idx = $("#pqGrid_W47F3001").pqGrid("addRow", {
                    newRow: {
                        PlanDate: date,
                        'OAmount': amount - totalW473001
                    }
                });
                $("#pqGrid_W47F3001").pqGrid("setSelection", {rowIndx: idx, colIndx: 0});

            }
            updateTotalW473001();
        };

        /*var autoAddRowW47F3001 = function () {
           var amount = l3Number($("#modalW47F3001").find(".lblOAmount").html());
           var date = $("#modalW47F3001").find(".lblScheduleDate").text();
           console.log((amount-totalW473001));
           if ((amount-totalW473001) >0 ){
               var idx = $("#pqGrid_W47F3001").pqGrid("addRow", {newRow: {PlanDate:date, 'OAmount':amount-totalW473001}});
               $("#pqGrid_W47F3001").pqGrid("setSelection", {rowIndx: idx, colIndx: 0});
               updateTotalW473001();
           }

       };*/

        var dsW47F3001 = $.parseJSON('{{json_encode(["PlanDate"=>'', 'OAmount'=>'0'])}}');
        var objPurpose = {
                width: '100%',
                height: 280,
                editable: true,
                freezeCols: 1,
                showTitle: true,
                title: '{{Helpers::getRS($g,"Ke_hoach_thanh_toan_gia_dinh")}}',
                minWidth: 30,
                selectionModel: {type: 'cell'},
                editor: {type: 'textbox', select: true, style: 'outline:none;'},
                trackModel: {on: true},
                wrap: false,
                hwrap: false,
                collapsible: false,
                scrollModel: {autoFit: true},
                dataType: "JSON",
                toolbar: {
                    cls: 'pq-toolbar-crud',
                    items: [
                        {
                            type: 'button',
                            label: '<div class="fa fa-plus" title="">&nbsp;</div>',
                            listener: function () {
                                $("#pqGrid_W47F3001").pqGrid("saveEditCell");
                                $("#pqGrid_W47F3001").pqGrid("quitEditMode");
                                addRowW47F3001();
                            }
                        },
                        {
                            type: function () {
                                return "<label>{{Helpers::getRS($g,"Don_vi_tinh").': VND'}}</label>";
                            }
                        }
                    ]
                },
                colModel: [
                    {
                        title: "{{Helpers::getRS($g,"Ngay")}}",
                        width: "140",
                        dataType: "date",
                        dataIndx: "PlanDate",
                        align: "center",
                        required: true,
                        editor: {
                            type: 'textbox',
                            init: dateEditor,
                            getData: getCustomData
                        },
                        render: function (ui) {
                            return {
                                cls: 'gridColRequire'
                            };
                        }
                    },
                    {
                        title: "{{Helpers::getRS($g,"So_tien")}}",
                        minWidth: 230,
                        required: true,
                        dataType: "float",
                        dataIndx: "OAmount",
                        align: 'right',
                        editor: {type: 'textbox'},
                        format: "{{Helpers::getStringFormat(Session::get("W91P0000")['D90_ConvertedDecimals'])}}",
                        render: function (ui) {
                            return {
                                cls: 'gridColRequire'
                            };
                        }
                    }
                ],
                dataModel: {
                    data: dsW47F3001
                }
                ,
                editModel: {
                    saveKey: $.ui.keyCode.ENTER,
                    keyUpDown: false,
                    cellBorderWidth: 0,
                    clicksToEdit: 2
                }
                ,
                cellClick: function (event, ui) {
                    $("#pqGrid_W47F3001").pqGrid("saveEditCell");
                    $("#pqGrid_W47F3001").pqGrid("quitEditMode");
                }
                ,
                cellKeyDown: function (event, ui) {
                    if ($("#pqGrid_W47F3001").pqGrid("option", "editable") == true) {
                        var obj = $("#pqGrid_W47F3001").pqGrid("option", "dataModel.data");
                        // key (esc) - back to the first cell
                        var $gridW473001 = $("#pqGrid_W47F3001");
                        // key (ctrl + delete) - to delete a row
                        if (event.keyCode == 46 && event.ctrlKey) {
                            event.stopPropagation();
                            event.preventDefault();
                            var numrow = $gridW473001.pqGrid("option", "dataModel.data").length;
                            var rowIndx = ui.rowIndx;
                            $gridW473001.pqGrid("deleteRow", {rowIndx: rowIndx});
                            updateTotalW473001();
                            if (rowIndx == 0) {
                                if (numrow >= 2) {
                                    $gridW473001.pqGrid("setSelection", {
                                        rowIndx: rowIndx,
                                        colIndx: 0
                                    });
                                } else {
                                    addRowW47F3001();
                                }
                            }
                            if (rowIndx > 0) {
                                if (rowIndx < numrow - 1) {
                                    $gridW473001.pqGrid("setSelection", {
                                        rowIndx: rowIndx,
                                        colIndx: ui.colIndx
                                    });
                                } else {
                                    $gridW473001.pqGrid("setSelection", {
                                        rowIndx: rowIndx - 1,
                                        colIndx: ui.colIndx
                                    });
                                }
                            }
                        }
                        // key (insert) - to insert a row
                        if (event.keyCode == 45) {
                            event.stopPropagation();
                            event.preventDefault();
                            addRowW47F3001();
                            $gridW473001.pqGrid("quitEditMode");
                        }
                    }
                }
                ,
                editorKeyDown: function (event, ui) {
                    var obj = $("#pqGrid_W47F3001").pqGrid("getEditCell");
                    var $editor = ui.$editor;
                    // key (esc) - back to the first cell
                    var $gridW473001 = $("#pqGrid_W47F3001");
                    //ESC
                    if (event.keyCode == 27) {
                        $(".l3DateGrid").hide();
                    }
                    //key (delete) - to delete cell
                    if (event.keyCode == 46) {
                        $editor.val("");
                    }
                    // key (ctrl + delete) - to delete a row
                    if (event.keyCode == 46 && event.ctrlKey) {
                        event.stopPropagation();
                        event.preventDefault();
                        $(".l3DateGrid").hide();
                        var numrow = $gridW473001.pqGrid("option", "dataModel.data").length;
                        var rowIndx = ui.rowIndx;
                        $gridW473001.pqGrid("deleteRow", {rowIndx: rowIndx});
                        updateTotalW473001();
                        if (rowIndx == 0) {
                            if (numrow >= 2) {
                                $gridW473001.pqGrid("setSelection", {
                                    rowIndx: rowIndx,
                                    colIndx: 0
                                });
                            } else {
                                addRowW47F3001();
                            }
                        }

                        if (rowIndx > 0) {
                            if (rowIndx < numrow - 1) {
                                $gridW473001.pqGrid("setSelection", {
                                    rowIndx: rowIndx,
                                    colIndx: ui.colIndx
                                });
                            } else {
                                $gridW473001.pqGrid("setSelection", {
                                    rowIndx: rowIndx - 1,
                                    colIndx: ui.colIndx
                                });
                            }

                        }

                    }

                    // key (insert) - to insert a row
                    if (event.keyCode == 45) {
                        event.stopPropagation();
                        event.preventDefault();
                        $(".l3DateGrid").hide();
                        addRowW47F3001();
                        $gridW473001.pqGrid("quitEditMode");
                    }
                }
                ,
                cellBeforeSave: function (event, ui) {
                    var obj = $("#pqGrid_W47F3001").pqGrid("getEditCell");
                    var $editor = obj.$editor;
                    //Kiem tra rong
                    if (ui.column.required && isNullOrEmpty(ui.newVal)) {
                        event.stopPropagation();
                        event.preventDefault();
                        if (isNullOrEmpty(ui.newVal)) {
                            $($editor).confirmation({
                                btnOkLabel: '',
                                btnCancelLabel: '',
                                popout: true,
                                placement: "bottom",
                                singleton: true,
                                template: '<div class="popover" style="display: inline-flex;"><div class="arrow"></div>'
                                + '<div class="popover-content" style="text-align: center;padding:10px;"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i><label class="confirmContent pull-left">'
                                + "{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}"
                                + '</label></span></div>'
                                + '</div>'
                            });
                            $($editor).confirmation('show');
                        }
                        return false;
                    }
                }
                ,
                cellSave: function (event, ui) {
                    //Khanh add
                    console.log('cellSave');
                    $("#modalW47F3001").find('#frm_btnSave').prop('disabled', '');
                    //$("#modalW47F3001").find('#frm_btnSave').removeAttr('disabled');
                    updateTotalW473001();
                    addRowW47F3001();
                    //updateTotalW473001();
                },
                refresh: function (event, ui) {
                    //updateTotalW473001();
                }
            }
        ;
        var pqGrid_W47F3001 = $("#pqGrid_W47F3001").pqGrid(objPurpose);
        pqGrid_W47F3001.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        pqGrid_W47F3001.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        pqGrid_W47F3001.pqGrid("refreshDataAndView");
    });

    $("#modalW47F3001").on('shown.bs.modal', function () {
        $("#pqGrid_W47F3001").pqGrid("option", "dataModel.data", []);
        $("#pqGrid_W47F3001").pqGrid("refreshDataAndView");

        loadGridW47F3001();


    });

    var totalW473001 = 0;
    var updateTotalW473001 = function () {
        console.log("test");
        var grid3001 = $("#pqGrid_W47F3001");
        grid3001.find(".pq-grid-summary>table>tbody>tr>td").addClass("text-right");
        var OAmount = 0;
        var gridData = grid3001.pqGrid("option", "dataModel.data");
        console.log(gridData);
        var rows = gridData == null ? 0 : gridData.length;
        for (i = 0; i < rows; i++) {
            var rowData = grid3001.pqGrid("getRowData", {rowIndx: i});
            OAmount += correctNumber(undefinedToZero(rowData.OAmount));
        }
        summaryData = [{
            PlanDate: footerTotalFormat(rows, 'center'),
            OAmount: OAmount
        }];
        totalW473001 = OAmount;
        $("#pqGrid_W47F3001").pqGrid({summaryData: summaryData}).pqGrid('refreshDataAndView');
    };


    function loadGridW47F3001() {
        var data3001 = JSON.stringify($("#pqGrid_W47F3001").pqGrid("option", "dataModel.data"));
        var id = $("#modalW47F3001").find("#hdContractID").val();
        var param = $("#modalW47F3001").find("#hdParameter").val();
        var unit = $("#modalW47F3001").find("#slMoneyUnitID").val();
        var amount = $("#modalW47F3001").find(".lblOAmount").html();
        var date = $("#modalW47F3001").find(".lblScheduleDate").html();
        $.ajax({
            method: "POST",
            url: "{{url('W47F3001/load')}}",
            data: {
                data: data3001,
                id: id,
                amount: amount,
                date: date,
                array: arrayMasterW47F3000,
                param: param,
                unit: unit,
                cAmount: l3Number($("#modalW47F3001").find(".lblOAmount").html().replace(/,/g, ""))
            },
            success: function (data) {
                if (data.length == 0){
                    $('#isOffW47F3001').bootstrapToggle('on')
                    $('#isOffW47F3001').val(0);
                }else{
                    $('#isOffW47F3001').bootstrapToggle(data[0]["IsOff"]==0 ? 'on' : 'off');
                    $('#isOffW47F3001').val(data[0]["IsOff"]);
                }
                var data = reformatData(data, $("#pqGrid_W47F3001"));
                $("#pqGrid_W47F3001").pqGrid("option", "dataModel.data", data);
                $("#pqGrid_W47F3001").pqGrid("refreshDataAndView");
                updateTotalW473001();
            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        });
    }

    $("#modalW47F3001").find('#frm_btnSave').on('click', function () {
        $("#modalW47F3001").find('#frm_btnSave').prop('disabled', 'disabled');
        if (allowSaveW47F3001()) {
            var data3001 = JSON.stringify($("#pqGrid_W47F3001").pqGrid("option", "dataModel.data"));
            var id = $("#modalW47F3001").find("#hdContractID").val();
            var param = $("#modalW47F3001").find("#hdParameter").val();
            var unit = $("#modalW47F3001").find("#slMoneyUnitID").val();
            var amount = $("#modalW47F3001").find(".lblOAmount").html();
            var date = $("#modalW47F3001").find(".lblScheduleDate").html();
            var isOff = $("#isOffW47F3001").val();
            $.ajax({
                method: "POST",
                url: "{{url('W47F3001/save')}}",
                data: {
                    data: data3001,
                    id: id,
                    amount: amount,
                    date: date,
                    array: arrayMasterW47F3000,
                    param: param,
                    unit: unit,
                    cAmount: l3Number($("#modalW47F3001").find(".lblOAmount").html().replace(/,/g, "")),
                    isOff: isOff
                },
                success: function (data) {
                    $("#modalW47F3001").find('#frm_btnSave').prop('disabled', '');
                    var currentObject = $.parseJSON(data);
                    if (currentObject.Status == "1")
                        alert_error(currentObject.Message);
                    else
                        alert_info(currentObject.Message);
                },
                error: function (jqXHR, textStatus, errorThrown) {

                }
            });
        } else {
            $("#modalW47F3001").find('#frm_btnSave').prop('disabled', '');
        }
    });

    function allowSaveW47F3001() {
        $grid = $("#pqGrid_W47F3001");
        $grid.pqGrid("saveEditCell");
        $grid.pqGrid("quitEditMode");
        var dataObj = $("#pqGrid_W47F3001").pqGrid("option", "dataModel.data");
        for (var i = 0; i < dataObj.length; i++) {
            var colModel = $grid.pqGrid("option", "colModel");
            for (var j = 0; j < colModel.length; j++) {
                if (colModel[j].required && isNullOrEmpty(dataObj[i][colModel[j].dataIndx])) {
                    $grid.pqGrid("setSelection", {rowIndx: i, colIndx: colModel[j].dataIndx});
                    $grid.pqGrid("editCell", {rowIndx: i, dataIndx: colModel[j].dataIndx});
                    var obj = $grid.pqGrid("getEditCell");
                    var $editor = obj.$editor;
                    var msg = '{{Helpers::getRS($g,'Ban_phai_nhap')}}' + ' ' + colModel[j].title;
                    var wid = msg.length * 9;
                    $($editor).confirmation({
                        btnOkLabel: '',
                        btnCancelLabel: '',
                        popout: true,
                        placement: "top",
                        singleton: true,
                        template: '<div class="popover" style="width: ' + wid + 'px;max-width: 600px;"><div class="arrow"></div>'
                        + '<div class="popover-content" style="text-align: center;padding:10px;width: auto"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i>'
                        + msg
                        + '</span></div>'
                        + '</div>'
                    });
                    $($editor).confirmation('show');
                    return false;
                }
            }
            //Kiem tra khong cho trung ngay
            var rs = $.grep(dataObj, function (data, index) {
                return data["PlanDate"] == dataObj[i]["PlanDate"];
            });
            console.log(rs);
            if (rs.length > 1) {
                $grid.pqGrid("setSelection", {rowIndx: i, colIndx: "PlanDate"});
                $grid.pqGrid("editCell", {rowIndx: i, dataIndx: "PlanDate"});
                var obj = $grid.pqGrid("getEditCell");
                var $editor = obj.$editor;
                var msg = '{{Helpers::getRS($g,'Ngay_thanh_toan_bi_trung')}}';
                var wid = msg.length * 9;
                $($editor).confirmation({
                    btnOkLabel: '',
                    btnCancelLabel: '',
                    popout: true,
                    placement: "top",
                    singleton: true,
                    template: '<div class="popover" style="width: ' + wid + 'px;max-width: 600px;"><div class="arrow"></div>'
                    + '<div class="popover-content" style="text-align: center;padding:10px;width: auto"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i>'
                    + msg
                    + '</span></div>'
                    + '</div>'
                });
                $($editor).confirmation('show');
                return false;
            }
        }


        return true;
    }

    var closePopW47F3001 = function () {
        $("#modalW47F3001").modal('hide');
        $('#modalW47F3001').children().off();
    };
</script>

