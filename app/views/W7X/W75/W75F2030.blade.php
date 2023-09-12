<div class="modal fade modal noneOverflow noUseValidHTML5" id="modalW75F2030" data-keyboard="false"
     data-backdrop="static"
     role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="form-horizontal">
                <div class="modal-header">
                    {{Helpers::generateHeading($modalTitle,"W75F2030")}}
                </div>
                <div class="modal-body" style="padding:10px">
                    <form id="frmW75F2030" name="frmW75F2030" method="post">
                        <div class = "row form-group">
                            <div class = "col-lg-5 col-xs-5 col-md-5">
                                <div class = "row">
                                    <div class="col-lg-3 col-xs-3 col-md-3">
                                            <label class = "liketext">{{Helpers::getRS($g,"Trang_thai")}}</label>
                                    </div>
                                    <div class = "col-lg-9 col-xs-9 col-md-9">
                                        <div class = "row">
                                            <div class="col-lg-6 col-xs-6 col-md-6">
                                                <div class="radio pdt5">
                                                    <label>
                                                        <input name="optIsOT" id="optIsOTCompany" value="1" checked type="radio">
                                                        {{Helpers::getRS($g,"Da_tach")}}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-xs-6 col-md-6">
                                                <div class="radio pdt5">
                                                    <label>
                                                        <input name="optIsOT" id="optIsNotOTCompany" value="0" type="radio">
                                                        {{Helpers::getRS($g,"Chua_tach")}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row form-group">
                        <div class="col-lg-3 col-xs-3 col-md-3">
                            <div id="pqgrid_W75F2030_1"></div>
                        </div>
                        <div class="col-lg-9 col-xs-9 col-md-9">
                            <div id="pqgrid_W75F2030_2"></div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-12 col-xs-12 col-md-12">
                            <button type="button" id="frm_btnSaveW75F2030"
                                    class="btn btn-default smallbtn pull-right"
                                    title="{{Helpers::getRS($g,"Luu")}}">
                                <span class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var err = 0; //biến nhận biết lỗi
    $(document).ready(function () {
        loadGrid1();
        loadGrid2();
    });

    $('#frm_btnSaveW75F2030').click(function () {
        if(err == 0){
            ask_save(function(){save()})
        }
    });

    function save() {
        var data = $("#pqgrid_W75F2030_2").pqGrid("option", "dataModel.data");
        var dataSender = $.grep(data, function (d) {
            return Number(d.IsUpdate) == 1;
        });
        if (dataSender.length > 0) {
            $.ajax({
                method: "POST",
                url: '{{url("/W75F2030/$pForm/$g/save")}}',
                data: {
                    dataSender: JSON.stringify(dataSender),
                },
                success: function (data) {
                    console.log(data);
                   /* if (data.status == 1) {
                        save_ok(function () {
                        });
                    } else {
                        save_not_ok();
                    }*/
                }
            });
        } else {
            alert_warning("Chưa có cập nhật nào mới");
        }
    }

    function loadGrid1() {
        //console.log(valueGrid);
        var iW75F2030_Height = $(document).height() - 200;
        var objW75F2030 = {
            width: '100%',
            height: iW75F2030_Height,
            showTitle: false,
            collapsible: false,
            selectionModel: {type: 'row', mode: 'single'},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            rowBorders: true,
            columnBorders: true,
            postRenderInterval: -1,
            //freezeCols: 4,
            hwrap: false,
            wrap: false,
            sortable: false,
            filterModel: {on: true, mode: "AND", header: true},
            colModel: [
                {
                    title: 'EmployeeID',
                    minWidth: 100,
                    dataType: "string",
                    dataIndx: "EmployeeID",
                    editor: false,
                    align: "center",
                    hidden: true,
                    isExport: false
                },
                {
                    title: '{{Helpers::getRS($g,"Nhan_vien")}}',
                    minWidth: 200,
                    dataType: "string",
                    dataIndx: "EmployeeName",
                    editor: false,
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                }
            ],
            dataModel: {
                data: {{$valueGrid1}},
                location: "local",
                sorting: "local",
                sortDir: "down"
            },
            complete: function (event, ui) {
                console.log('complete grid');

            },
            rowClick: function (event, ui) {

            }/*,
            cellSave: function (event, ui) {
                console.log("cellSave");
                ui.rowData.IsUpdate = 1;
                var rowData = ui.rowData;
                //format before saveing
                console.log(ui);
                //End format
                $("#pqgrid_W75F2030").pqGrid("refreshDataAndView");
            }*/
        };
        //objW75F2030.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
        $("#pqgrid_W75F2030_1").pqGrid(objW75F2030);
        $("#pqgrid_W75F2030_1").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $("#pqgrid_W75F2030_1").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        setTimeout(function () {
            $("#pqgrid_W75F2030_1").pqGrid("refreshDataAndView");
        }, 700)
    }

    function loadGrid2() {
        //console.log(valueGrid);
        var iW75F2030_2_Height = $(document).height() - 200;
        var objW75F2030_2 = {
            width: '100%',
            height: iW75F2030_2_Height,
            showTitle: false,
            collapsible: false,
            selectionModel: {type: 'row', mode: 'single'},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            rowBorders: true,
            columnBorders: true,
            postRenderInterval: -1,
            //freezeCols: 4,
            hwrap: false,
            wrap: false,
            sortable: false,
            editModel: {
                saveKey: $.ui.keyCode.ENTER,
                select: true,
                keyUpDown: false,
                cellBorderWidth: 0,
                clicksToEdit: 1
            },
            filterModel: {on: true, mode: "AND", header: true},
            colModel: [
                {
                    title: '{{Helpers::getRS($g,"Ngay_cong")}}',
                    minWidth: 100,
                    dataType: "string",
                    dataIndx: "Attendancedate",
                    editor: false,
                    align: "center",
                    filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']},
                    render: function (ui) {
                        return {
                            cls: "readonly-status"
                        };
                    }
                },
                {
                    title: 'AttendancedateType',
                    minWidth: 100,
                    dataType: "string",
                    dataIndx: "AttendancedateType",
                    editor: false,
                    align: "center",
                    hidden: true,
                    isExport: false
                },
                {
                    title: '{{Helpers::getRS($g,"Loai_ngay")}}',
                    minWidth: 200,
                    dataType: "string",
                    dataIndx: "AttendancedateTypeName",
                    editor: false,
                    align: "left",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                    render: function (ui) {
                        return {
                            cls: "readonly-status"
                        };
                    }
                }
                @foreach($captionGrid2 as $row)
                , {
                    title: "{{$row['FieldName']}}",
                    minWidth: 100,
                    align: "right",
                    dataType: "float",
                    dataIndx: "{{$row['FieldCaption']}}",
                    format: returnSFormat({{$row['Format']}}),
                    editable: false,
                   /* editable: function (ui) {
                        var rowData = ui.rowData;
                        return Number(rowData.IsEdit) == 0 ? true : false;
                    },*/
                    render: function (ui) {
                        var rowData = ui.rowData;
                        var disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    }
                }
                @endforeach
                ,{
                    title: '{{Helpers::getRS($g,"Tong")}}',
                    minWidth: 100,
                    dataType: "float",
                    dataIndx: "OTHourt",
                    editor: false,
                    align: "right",
                    render: function (ui) {
                        return {
                            cls: "readonly-status"
                        };
                    }
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: 'IsEdit',
                    minWidth: 100,
                    dataType: "string",
                    dataIndx: "IsEdit",
                    editor: false,
                    align: "center",
                    hidden: true,
                    isExport: false
                },
                {
                    title: '{{Helpers::getRS($g,"Tang_ca")}}',
                    minWidth: 100,
                    dataType: "float",
                    dataIndx: "OTHoursSplit",
                    editor: true,
                    align: "right",
                    editable: function (ui) {
                        var rowData = ui.rowData;
                        return Number(rowData.IsEdit) == 0 ? true : false;
                    },
                    render: function (ui) {
                        var rowData = ui.rowData;
                        var disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    }
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: '{{Helpers::getRS($g,"Tang_phep")}}',
                    minWidth: 100,
                    dataType: "float",
                    dataIndx: "OTLeaveSplit",
                    editor: true,
                    align: "right",
                    editable: function (ui) {
                        var rowData = ui.rowData;
                        return Number(rowData.IsEdit) == 0 ? true : false;
                    },
                    render: function (ui) {
                        var rowData = ui.rowData;
                        var disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    }
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                }
            ],
            dataModel: {
                data:  {{$valueGrid2}},
                location: "local",
                sorting: "local",
                sortDir: "down"
            },
            complete: function (event, ui) {
                console.log('complete grid');

            },
            rowClick: function (event, ui) {

            },
            cellBeforeSave: function( event, ui ) {
                var $pqgrid_W75F2030_2 = $("#pqgrid_W75F2030_2");
                var newVal = ui.newVal;
                var rowData = ui.rowData,
                    dataIndx = ui.dataIndx,
                    rowIndx = ui.rowIndx;
                if(dataIndx == 'OTHoursSplit'){
                    console.log(rowData['OTHoursSplit'], rowData['OTHourt']);
                    if(Number(newVal) > Number(rowData['OTHourt'])){
                        err = 1;
                        //alert('test');
                        var msg = "{{Helpers::getRS($g,"Gia_tri_nhap_phai_nho_hon_tong")}}";
                        $pqgrid_W75F2030_2.pqGrid("quitEditMode");
                        $pqgrid_W75F2030_2.pqGrid("editCell", {rowIndx: rowIndx, dataIndx: dataIndx});
                        var obj = $pqgrid_W75F2030_2.pqGrid("getEditCell");
                        var $editor = obj.$editor;
                        $($editor).val(newVal);
                        $($editor).confirmation({
                            btnOkLabel: '',
                            btnCancelLabel: '',
                            popout: true,
                            placement: "bottom",
                            singleton: true,
                            template:
                            '<div class="popover" style="display: inline-flex;"><div class="arrow"></div>'
                            + '<div class="popover-content" style="text-align: center;padding:10px;"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i><label class="confirmContent pull-left">'
                            + msg
                            + '</label></span></div>'
                            + '</div>'
                        });
                        $($editor).confirmation('show');
                        return false;
                    }else{
                        err = 0;
                        rowData['OTLeaveSplit'] = Number(rowData['OTHourt']) - newVal;
                        rowData['OTLeaveSplit'] = format2(rowData['OTLeaveSplit'], '',2);
                    }
                }
                if(dataIndx == 'OTLeaveSplit'){
                    if(Number(newVal) > Number(rowData['OTHourt'])){
                        err = 1;
                        var msg = "{{Helpers::getRS($g,"Gia_tri_nhap_phai_nho_hon_tong")}}";
                        $pqgrid_W75F2030_2.pqGrid("quitEditMode");
                        $pqgrid_W75F2030_2.pqGrid("editCell", {rowIndx: rowIndx, dataIndx: dataIndx});
                        var obj = $pqgrid_W75F2030_2.pqGrid("getEditCell");
                        var $editor = obj.$editor;
                        $($editor).val(newVal);
                        $($editor).confirmation({
                            btnOkLabel: '',
                            btnCancelLabel: '',
                            popout: true,
                            placement: "bottom",
                            singleton: true,
                            template:
                            '<div class="popover" style="display: inline-flex;"><div class="arrow"></div>'
                            + '<div class="popover-content" style="text-align: center;padding:10px;"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i><label class="confirmContent pull-left">'
                            + msg
                            + '</label></span></div>'
                            + '</div>'
                        });
                        $($editor).confirmation('show');
                        return false;
                    }else{
                        err = 0;
                        rowData['OTHoursSplit'] = Number(rowData['OTHourt']) - newVal;
                        rowData['OTHoursSplit'] = format2(rowData['OTHoursSplit'], '',2);
                    }
                }
                $pqgrid_W75F2030_2.pqGrid("refreshDataAndView");
            },
            cellSave: function (event, ui) {
                ui.rowData.IsUpdate = 1;
                var rowData = ui.rowData;
                rowData['OTHoursSplit'] = format2(rowData['OTHoursSplit'], '',2);
                rowData['OTLeaveSplit'] = format2(rowData['OTLeaveSplit'], '',2);
                //End format
                $("#pqgrid_W75F2030").pqGrid("refreshDataAndView");
            }
        };
        //objW75F2030_2.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
        $("#pqgrid_W75F2030_2").pqGrid(objW75F2030_2);
        $("#pqgrid_W75F2030_2").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $("#pqgrid_W75F2030_2").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        //$("#pqgrid_W75F2030_2").pqGrid( { stripeRows : false } );
        setTimeout(function () {
            $("#pqgrid_W75F2030_2").pqGrid("refreshDataAndView");
        }, 700)
    }
</script>