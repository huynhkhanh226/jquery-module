<style>
    .cls_success {
        padding-top: 20%;
    }

    .modalW75F4080 .modal-open .modal {
        overflow-y: hidden;
    }

    [data-notify="progressbar"] {
        margin-bottom: 0px;
        position: absolute;
        bottom: 0px;
        left: 0px;
        width: 100%;
        height: 5px;
        z-index: 900000;
    }

    tr.pq-grid-oddRow > td.pq-state-select,
    tr.pq-grid-oddRow.pq-state-select,
    tr.pq-grid-oddRow > .pq-grid-cell-hover,
    tr.pq-grid-oddRow.pq-grid-row-hover {
        background: none;
    }

</style>
<div class="modal fade modal noneOverflow noUseValidHTML5" id="modalW75F4080" data-keyboard="false"
     data-backdrop="static"
     role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="form-horizontal">
                <div class="modal-header">
                    {{Helpers::generateHeading($modalTitle,"W75F4080")}}
                </div>
                <div class="modal-body" style="padding:10px">
                    <form id="frmW75F4080">
                        <div class="row form-group">
                            <div class="col-md-1 col-xs-1">
                                <div class="checkbox" style="margin-top: -3px">
                                    <label>
                                        <input id="chkIsDate" type="checkbox" autofocus
                                               value="0"> {{Helpers::getRS($g,"Thoi_gian")}}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <div id="idDateFrom" class="input-group date">
                                    <input type="text" class="form-control" id="txtDateFrom"
                                           name="txtDateFrom" value="" required><span
                                            class="input-group-addon"><i
                                                class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <div id="idDateTo" class="input-group date">
                                    <input type="text" class="form-control" id="txtDateTo"
                                           name="txtDateTo" value="" required><span
                                            class="input-group-addon"><i
                                                class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-1">
                                <div class="liketext1">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Nhan_vien")}}</label>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-2">
                                <input type="text" class="form-control"
                                       id="txtEmployeeIDW75F4080"
                                       name="txtEmployeeIDW75F4080" value=""
                                        >
                            </div>
                            <div class="col-md-1 col-xs-1">
                                <div class="liketext1">
                                    <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Trang_thai")}}</label>
                                </div>

                            </div>
                            <div class="col-md-2 col-xs-2">
                                <select class="form-control"
                                        id="cbStatusID" name="cbStatusID"
                                        placeholder="">
                                    @foreach($statusList as $rowStatus)
                                        <option value="{{$rowStatus['ID']}}" {{$rowStatus['ID'] == $isApproval ? 'selected':''}}>{{$rowStatus['Name']}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-1 col-xs-1">
                                <button type="button" id="btnFilterW75F4080" class="btn btn-default smallbtn  pull-right"><span
                                            class="digi digi-filter"></span>
                                    &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                                <input type="submit" class="hide" id="hdBtnFilterW75F4080" name="hdBtnFilterW75F4080"/>
                            </div>
                        </div>

                    </form>
                    <div class="row form-group">
                        <div class="col-md-12 col-xs-12">
                            <div id="gridShiftList"></div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12 col-xs-12 ">
                            <button type="button" id="frm_btnSave"
                                    class="btn btn-default smallbtn pull-right"
                                    title="{{Helpers::getRS($g,"Luu")}}"
                                    ><span
                                        class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="popupMailW75F4080">
    <div class="modal draggable fade" id="mPopUp" data-backdrop="static" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    @define $mPopUpTitle = Helpers::getRS($g,"Thong_baoU")
                    {{Helpers::generateHeading($mPopUpTitle,"W75F4080",false,"closePop")}}
                </div>
                <div class="modal-body" style="background: #fff; float: left; width: 100%; padding-bottom: 5px;">
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var gbAllowSave = true;
    var gbRowIndex = 0;
    var gbDataIndx = "";
    $(document).ready(function () {
        //$('#txtDateFrom').daterangepicker({format: 'DD/MM/YYYY'}).focus();
        $('#txtDateFrom').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#txtDateTo').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#txtDateFrom').prop('disabled', !$(this).is(":checked"));
        $('#txtDateTo').prop('disabled', !$(this).is(":checked"));

        var tranMonth = {{Session::get("W91P0000")['HRTranMonth']}};
        var tranYear = {{Session::get("W91P0000")['HRTranYear']}};
        var daysInMonth = new Date(tranYear, tranMonth, 0).getDate()
        $('#chkIsDate').change(function () {
            $('#txtDateFrom').prop('disabled', !$(this).is(":checked"));
            $('#txtDateTo').prop('disabled', !$(this).is(":checked"));

            if ($(this).is(":checked")) {
                $('#txtDateFrom').datepicker('setDate',"01/"+tranMonth+"/"+tranYear+"");
                $('#txtDateTo').datepicker('setDate',daysInMonth +"/"+tranMonth+"/"+tranYear+"");
            }else{
                $('#txtDateFrom').val("");
                $('#txtDateTo').val("");
            }
        });
        $('#idDateFrom').find(".glyphicon-calendar").on('click',function(){
            if ($('#txtDateFrom').is(':disabled') == false){
                $('#txtDateFrom').datepicker('show');
            }
        });
        $("#idDateTo").find(".glyphicon-calendar").on('click',function(){
            if ($('#txtDateTo').is(':disabled') == false){
                $('#txtDateTo').datepicker('show');
            }
        });
        var validate = function (ui) {
            var $inp = ui.$cell.find("input");
            var grid = $("#gridShiftList");
            var valid = grid.pqGrid("isValid", {
                rowIndx: ui.rowIndx,
                dataIndx: ui.dataIndx,
                value: parseInt($inp.val())
            }).valid;
            if (!valid) {
                $(ui.$cell[0]).addClass("pq-cell-red-tr");
                grid.pqGrid("editCell", {rowIndx: ui.rowIndx, dataIndx: ui.dataIndx});
                return false;
            }
            return true;
        }

        var rsAfter = {{$rsAfter}};
        var rsEarly = {{$rsEarly}};
        var obj = {
            width: '100%',
            numberCell: {show: false},
            height: $("#modalW75F4080").find('.modal-content').height() - 135,
            //resizable: true,
            showTitle: false,
            collapsible: false,
            selectionModel: {type: 'cell', mode: 'single'},
            //filterModel: {on: true, mode: "AND", header: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
            rowBorders: true,
            columnBorders: true,
            postRenderInterval: -1,
            freezeCols: 2,
            hwrap: false,
            wrap: true,
            sortable: false,
            toolbar: {
                        items: [
                       /* {
                            type: 'select',
                            label: 'Format: ',
                            attr: 'id="export_format"',
                            options: [{ xls: 'Excel'}]
                        },*/
                        {
                            type: 'button',
                            label: "Export",
                            icon: 'ui-icon-arrowthickstop-1-s',
                            listener: function () {

                                var cols = this.colModel;
                                for (var i=0;i<cols.length;i++){
                                    if (cols[i].dataIndx == "ApprovedLate" || cols[i].dataIndx == "ApprovedEarly"){
                                        cols[i].title = "{{Helpers::getRS($g,"Duyet")}}";
                                    }
                                    if (cols[i].dataIndx == "NotApprovedLate" || cols[i].dataIndx == "NotApprovedEarly"){
                                        cols[i].title = "{{Helpers::getRS($g,"Khong_duyet")}}";
                                    }
                                    cols[i].align = "center";
                                }

                                //console.log(cols);
                                //var format = $("#export_format").val(),;
                                var format = 'xls',
                                    blob = this.exportData({
                                        //url: "/pro/demos/exportData",
                                        format: format,
                                        render: false
                                    });

                                if(typeof blob === "string"){
                                    blob = new Blob([blob]);
                                }
                                saveAs(blob, "Duyet_di_tre_ve_som."+ format );
                                //exportExcel();
                            }
                        }]
             },
            colModel: [
                {
                    title: '{{Helpers::getRS($g,"Thong_tin_nhan_vien")}}',
                    minWidth: 20,
                    width: 35,
                    exportRenderType:true,
                    colModel: [
                        {
                            title: '{{Helpers::getRS($g,"Ma_NV")}}',
                            minWidth: 20,
                            width: 90,
                            dataType: "string",
                            align: "left",
                            dataIndx: "EmployeeID",
                            editor: false,
                            editable: false,
                            sortable: false,
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Ten_NV")}}',
                            minWidth: 20,
                            width: 210,
                            dataType: "string",
                            align: "left",
                            dataIndx: "EmployeeName",
                            editor: false,
                            editable: false,
                            sortable: false,
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                    ]

                },
                {
                    title: '{{Helpers::getRS($g,"Thong_tin_ca")}}',
                    minWidth: 20,
                    width: 80,
                    colModel: [
                        {
                            title: '{{Helpers::getRS($g,"Lan")}}',
                            minWidth: 20,
                            width: 55,
                            dataType: "integer",
                            align: "center",
                            dataIndx: "Times",
                            editor: false,
                            editable: false,
                            sortable: false,
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Ngay")}}',
                            minWidth: 20,
                            width: 110,
                            dataType: "date",
                            align: "center",
                            dataIndx: "AttendanceDate",
                            editor: false,
                            editable: false,
                            sortable: false,
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Ca")}}',
                            minWidth: 20,
                            width: 50,
                            dataType: "string",
                            align: "center",
                            dataIndx: "ShiftID",
                            editor: false,
                            editable: false,
                            sortable: false,
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Vao")}}',
                            minWidth: 20,
                            width: 50,
                            dataType: "string",
                            align: "center",
                            dataIndx: "TimeStart",
                            editor: false,
                            editable: false,
                            sortable: false,
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Ra")}}',
                            minWidth: 20,
                            width: 50,
                            dataType: "string",
                            align: "center",
                            dataIndx: "TimeEnd",
                            editor: false,
                            editable: false,
                            sortable: false,
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                    ]
                },
                {
                    title: '{{Helpers::getRS($g,"Di_treU")}}',
                    minWidth: 20,
                    width: 70,
                    colModel: [
                        {
                            title: '{{Helpers::getRS($g,"So_phut")}}',
                            minWidth: 20,
                            width: 80,
                            dataType: "integer",
                            align: "right",
                            dataIndx: "LateMinute",
                            exportRender: true,
                            //editor: {select: true},
                            sortable: false,
                            //editModel: {keyUpDown: true},
                            //editable:true,
                            /*render: function (ui) {
                                var rowData = ui.rowData;
                                return {
                                    //cls: (row['LateMinute'] < 1 ||  row['LateMinute'] > 240 ? "pq-cell-red-tr pq-has-tooltip" : "")
                                    cls: this.isEditableCell(ui) == false ? "readonly-status":""
                                };
                            }*/
                             editor: {
                                type: "select",
                                mapIndices: { LateMinute: "LateMinute"},
                                labelIndx: "LateMinute",
                                valueIndx: "LateMinute",
                                prepend: { "": "" },
                                options: rsAfter
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Gio_vao")}}',
                            minWidth: 20,
                            width: 80,
                            dataType: "string",
                            align: "center",
                            dataIndx: "LateTimeIn",
                            editor: false,
                            editable: false,
                            sortable: false,
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '',
                            minWidth: 20,
                            width: 80,
                            dataType: "string",
                            align: "center",
                            dataIndx: "ReLateTimeIn",
                            editor: false,
                            editable: true,
                            sortable: false,
                            hidden:true
                        },
                        {
                            title: '<a id="ApprovedLate" onclick="headClick(this)">{{Helpers::getRS($g,"Duyet")}}</a>',
                            width: 70,
                            align: "center",
                            dataType: "integer",
                            dataIndx: "ApprovedLate",
                            editor: false,
                            sortable: false,
                            //editable: true,
                            type: 'checkbox',
                            cb: {
                                all: false,
                                header: true,
                                check: "1",
                                uncheck: "0"
                            },
                            //editable:true,
                            editable: function (ui) {
                                 var row = ui.rowData
                                 return !isNullOrEmpty( row["LateMinute"]);
                            },
                            /*editable: function (ui) {
                                var rowData = ui.rowData;
                                if (rowData.ApprovedLate == 1 && rowData.IsEditApprovedLate == 0) {
                                    return false;
                                }
                                else {
                                    return true;
                                }
                            },*/
                            render: function (ui) {
                                var row = ui.rowData,
                                        checked = row["ApprovedLate"] == 1 ? 'checked' : '',
                                        disabled = this.isEditableCell(ui) ? "" : "disabled";

                                return {
                                    text: "<label><input type='checkbox' " + checked + " /></label>",
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            },
                            postRender: function (ui) {
                                //
                                if (this.isEditableCell(ui) == true) {
                                    var rowIndx = ui.rowIndx,
                                            grid = this,
                                            $cell = grid.getCell(ui);

                                    $cell.find("label>input[type='checkbox']")
                                            .unbind("click")
                                            .bind("click", function (evt) {
                                                gridShiftList = $("#gridShiftList")
                                                var obj = gridShiftList.pqGrid( "getEditCell" );
                                                var $editor = obj.$editor;
                                                //console.log($editor);
                                                if ($editor === undefined){
                                                    var $tr = $(this).closest("tr"),
                                                            rowIndx = gridShiftList.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                                    var rowData = gridShiftList.pqGrid("getRowData", {rowIndx: rowIndx});
                                                    if ($(this).is(":checked") == true) {
                                                        rowData["NotApprovedLate"] = 0;
                                                    }
                                                }else{
                                                    evt.stopPropagation();
                                                    evt.preventDefault();
                                                }
                                            });
                                }

                            }
                        },
                        {
                            title: '<a id="NotApprovedLate" onclick="headClick(this)">{{Helpers::getRS($g,"Khong_duyet")}}</a>',
                            minWidth: 80,
                            width: 90,
                            align: "center",
                            dataType: "integer",
                            dataIndx: "NotApprovedLate",
                            editor: false,
                            sortable: false,
                            //editable: true,
                            type: 'checkbox',
                            cb: {
                                all: false,
                                header: true,
                                check: "1",
                                uncheck: "0"
                            },
                            //editable:true,
                            editable: function (ui) {
                                 var row = ui.rowData
                                 return !isNullOrEmpty( row["LateMinute"]);
                            },
                            /*editable: function (ui) {
                                var rowData = ui.rowData;
                                if (rowData.ApprovedLate == 1 && rowData.IsEditApprovedLate == 0) {
                                    return false;
                                }
                                else {
                                    return true;
                                }
                            },*/
                            render: function (ui) {
                                ////console.log(cellData = ui.cellData); //get value checkbox
                                var row = ui.rowData,
                                        checked = row["NotApprovedLate"] == 1 ? 'checked' : '',
                                        disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    text: "<label><input type='checkbox' " + checked + " /></label>",
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            },
                            postRender: function (ui) {
                                if (this.isEditableCell(ui) == true) {
                                    var rowIndx = ui.rowIndx,
                                            grid = this,
                                            $cell = grid.getCell(ui);

                                    $cell.find("label>input[type='checkbox']")
                                            .unbind("click")
                                            .bind("click", function (evt) {
                                                gridShiftList = $("#gridShiftList")
                                                var obj = gridShiftList.pqGrid( "getEditCell" );
                                                var $editor = obj.$editor;

                                                if ($editor === undefined){

                                                    var $tr = $(this).closest("tr"),
                                                            rowIndx = gridShiftList.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                                    var rowData = gridShiftList.pqGrid("getRowData", {rowIndx: rowIndx});
                                                    if ($(this).is(":checked") == true) {
                                                        rowData["ApprovedLate"] = 0;
                                                    }
                                                }else{
                                                    evt.stopPropagation();
                                                    evt.preventDefault();
                                                }


                                            });
                                }

                            }
                        }
                    ]
                },
                {
                    title: '{{Helpers::getRS($g,"Ve_somU")}}',
                    minWidth: 20,
                    width: 45,
                    colModel: [
                        {
                            title: '{{Helpers::getRS($g,"So_phut")}}',
                            minWidth: 20,
                            width: 80,
                            dataType: "integer",
                            align: "right",
                            dataIndx: "EarlyMinute",
                            //editor: {select: true},
                            sortable: false,
                            //editModel: {keyUpDown: true},
                            //editable:true,
                            /*render: function (ui) {
                                var rowData = ui.rowData;
                                return {
                                    cls: this.isEditableCell(ui) == false ? "readonly-status":""
                                };
                            }*/
                            editor: {
                                type: "select",
                                mapIndices: { EarlyMinute: "EarlyMinute"},
                                labelIndx: "EarlyMinute",
                                valueIndx: "EarlyMinute",
                                prepend: { "": "" },
                                options: rsEarly
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Gio_ra")}}',
                            minWidth: 20,
                            width: 80,
                            dataType: "string",
                            align: "center",

                            dataIndx: "EarLyTimeOut",
                            editor: false,
                            editable: false,
                            sortable: false,
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '',
                            minWidth: 20,
                            width: 80,
                            dataType: "string",
                            align: "center",
                            dataIndx: "ReEarLyTimeOut",
                            editor: false,
                            editable: true,
                            sortable: false,
                            hidden:true
                        },
                        {
                            title: '<a id="ApprovedEarly" onclick="headClick(this)">{{Helpers::getRS($g,"Duyet")}}</a>',
                            minWidth: 80,
                            width: 70,
                            align: "center",
                            dataType: "integer",
                            dataIndx: "ApprovedEarly",
                            editor: false,
                            //editable: true,
                            type: 'checkbox',
                            cb: {
                                all: false,
                                header: true,
                                check: "1",
                                uncheck: "0"
                            },
                            //editable:true,
                            editable: function (ui) {
                                 var row = ui.rowData
                                 return !isNullOrEmpty( row["EarlyMinute"]);
                            },
                            /*editable: function (ui) {
                                var rowData = ui.rowData;
                                if (rowData.ApprovedEarly == 1 && rowData.IsEditApprovedEarly == 0) {
                                    return false;
                                }
                                else {
                                    return true;
                                }
                            },*/
                            render: function (ui) {

                                var row = ui.rowData,
                                        checked = row["ApprovedEarly"] == 1 ? 'checked' : '',
                                        disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    text: "<label><input type='checkbox' " + checked + " /></label>",
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            },
                            postRender: function (ui) {

                                if (this.isEditableCell(ui) == true) {
                                    var rowIndx = ui.rowIndx,
                                            grid = this,
                                            $cell = grid.getCell(ui);

                                    $cell.find("label>input[type='checkbox']")
                                            .unbind("click")
                                            .bind("click", function (evt) {
                                                gridShiftList = $("#gridShiftList")
                                                var obj = gridShiftList.pqGrid( "getEditCell" );
                                                var $editor = obj.$editor;

                                                if ($editor === undefined){
                                                    var $tr = $(this).closest("tr"),
                                                            rowIndx = gridShiftList.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                                    var rowData = gridShiftList.pqGrid("getRowData", {rowIndx: rowIndx});
                                                    if ($(this).is(":checked") == true) {
                                                        rowData["NotApprovedEarly"] = 0;
                                                    }
                                                }else{
                                                    evt.stopPropagation();
                                                    evt.preventDefault();
                                                }

                                            });
                                }

                            }
                        },
                        {
                            title: '<a id="NotApprovedEarly" onclick="headClick(this)">{{Helpers::getRS($g,"Khong_duyet")}}</a>',
                            minWidth: 80,
                            width: 90,
                            align: "center",
                            dataType: "integer",
                            dataIndx: "NotApprovedEarly",
                            editor: false,
                            sortable: false,
                            //editable: true,
                            type: 'checkbox',
                            cb: {
                                all: false,
                                header: true,
                                check: "1",
                                uncheck: "0"
                            },
                            //editable:true,
                            editable: function (ui) {
                                 var row = ui.rowData
                                 return !isNullOrEmpty( row["EarlyMinute"]);
                            },
                            /*editable: function (ui) {
                                var rowData = ui.rowData;
                                if (rowData.ApprovedEarly == 1 && rowData.IsEditApprovedEarly == 0) {
                                    return false;
                                }
                                else {
                                    return true;
                                }
                            },*/
                            render: function (ui) {
                                ////console.log(cellData = ui.cellData); //get value checkbox
                                var row = ui.rowData,
                                        checked = row["NotApprovedEarly"] == 1 ? 'checked' : '',
                                        disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    text: "<label><input type='checkbox' " + checked + " /></label>",
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            },
                            postRender: function (ui) {

                                if (this.isEditableCell(ui) == true) {
                                    var rowIndx = ui.rowIndx,
                                            grid = this,
                                            $cell = grid.getCell(ui);

                                    $cell.find("label>input[type='checkbox']")
                                            .unbind("click")
                                            .bind("click", function (evt) {
                                                gridShiftList = $("#gridShiftList")
                                                var obj = gridShiftList.pqGrid( "getEditCell" );
                                                var $editor = obj.$editor;

                                                if ($editor === undefined){
                                                    var $tr = $(this).closest("tr"),
                                                            rowIndx = gridShiftList.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                                                    var rowData = gridShiftList.pqGrid("getRowData", {rowIndx: rowIndx});
                                                    if ($(this).is(":checked") == true) {
                                                        rowData["ApprovedEarly"] = 0;
                                                    }
                                                }else{
                                                    evt.stopPropagation();
                                                    evt.preventDefault();
                                                }

                                            });
                                }

                            }
                        }
                    ]
                },
                {
                    title: '{{Helpers::getRS($g,"Ly_do")}}',
                    minWidth: 20,
                    width: 270,
                    dataType: "string",
                    align: "left",
                    dataIndx: "Reason",
                    editor: false,
                    editable: false,
                    sortable: false,
                    render: function (ui) {
                        var disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    }
                },
                {
                    title: '{{Helpers::getRS($g,"Ghi_chu")}}',
                    minWidth: 20,
                    width: 270,
                    dataType: "string",
                    editor: true,
                    editable: true,
                    sortable: false,
                    //draggable: true,
                    align: "left",
                    dataIndx: "Note"
                },
                {
                    title: '',
                    minWidth: 20,
                    width: 170,
                    dataType: "string",
                    editor: true,
                    editable: true,
                    sortable: false,
                    hidden: true,
                    align: "left",
                    dataIndx: "IsUpdate "
                }

            ],
            create: function (evt, ui) {
                //console.log(this.widget().pqTooltip());
                this.widget().pqTooltip();
            },
            dataModel: {
                data: {{json_encode($rsData)}},
                location: "local",
                sorting: "local",
                sortDir: "down"
            },
            editModel: {
                saveKey: $.ui.keyCode.ENTER,
                select: true,
                keyUpDown: false,
                cellBorderWidth: 0,
                //onBlur: "save",
                clicksToEdit: 1
            },

            pageModel: {
                type: 'local',
                rPP: 30,
                rPPOptions: [20, 30, 40, 50]
            },

            editorKeyDown: function (event, ui) {
                var obj = $("#gridShiftList").pqGrid("option", "dataModel.data");
                // key (esc) - back to the first cell
                var soel = $("#gridShiftList");
                if (event.keyCode == 27) {
                }
                if (event.keyCode == 13 || event.keyCode == 9) {

                }
                //key (delete) - to delete cell
                if (event.keyCode == 46) {
                    $(ui.$cell[0]).find("input").val(null);
                }
            },
            change: function (event, ui) {
                var soel = $("#gridShiftList");
                var rowData = ui.rowList[0].rowData;
                console.log(rowData);
                updateIsUpdate(rowData);
                CalLateEarly(rowData,1);
                CalLateEarly(rowData,2);
                setBackColor(soel);
                soel.pqGrid( "refreshCell", { rowIndx: gbRowIndex  , dataIndx: "ApprovedLate" } );
                soel.pqGrid( "refreshCell", { rowIndx: gbRowIndex  , dataIndx: "NotApprovedLate" } );
                soel.pqGrid( "refreshCell", { rowIndx: gbRowIndex  , dataIndx: "ApprovedEarly" } );
                soel.pqGrid( "refreshCell", { rowIndx: gbRowIndex  , dataIndx: "NotApprovedEarly" } );
                soel.pqGrid( "refreshCell", { rowIndx: gbRowIndex  , dataIndx: "LateTimeIn" } );
                soel.pqGrid( "refreshCell", { rowIndx: gbRowIndex  , dataIndx: "EarLyTimeOut" } );
            },
            cellBeforeSave: function( event, ui ) {
                var soel = $("#gridShiftList");
                var dataIndx = ui.dataIndx, newVal = ui.newVal;
                if(dataIndx == 'LateMinute'){
                    //Validattion
                    if (!isNullOrEmpty(newVal) && (newVal <1 || newVal >240)){
                        var msg = '{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,"Gia_tri_tu").' [1->240]'}}';
                        var wid = msg.length * 8;
                        soel.pqGrid("quitEditMode");
                        soel.pqGrid("editCell", {rowIndx: ui.rowIndx, dataIndx: dataIndx});
                        var obj = soel.pqGrid( "getEditCell" );
                        var $editor = obj.$editor;
                        $($editor).val(newVal);
                        $($editor).confirmation({
                            btnOkLabel: '',
                            btnCancelLabel: '',
                            popout: true,
                            placement: "bottom",
                            singleton: true,
                            template:
                            '<div class="popover" style="width: '+wid+'px;display: inline-block;"><div class="arrow"></div>'
                            + '<div class="popover-content" style="text-align: center;padding:10px;width: auto"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i><label class="confirmContent">'
                            + msg
                            + '</label></span></div>'
                            + '</div>'
                        });
                        $($editor).confirmation('show');
                        return false;
                    }
                }

                if(dataIndx == 'EarlyMinute'){
                    //Validattion
                    if (!isNullOrEmpty(newVal) && (newVal <1 || newVal >240)){
                        gbAllowSave = false;
                        var msg = '{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,"Gia_tri_tu").' [1->240]'}}';
                        var wid = msg.length * 8;
                        soel.pqGrid("quitEditMode");
                        soel.pqGrid("editCell", {rowIndx: ui.rowIndx, dataIndx: dataIndx});
                        var obj = soel.pqGrid( "getEditCell" );
                        var $editor = obj.$editor;
                        $($editor).val(newVal);
                        $($editor).confirmation({
                            btnOkLabel: '',
                            btnCancelLabel: '',
                            popout: true,
                            placement: "bottom",
                            singleton: true,
                            template:
                            '<div class="popover" style="width: '+wid+'px;max-width: 600px;"><div class="arrow"></div>'
                            + '<div class="popover-content" style="text-align: center;padding:10px;width: auto"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i><label class="confirmContent">'
                            + msg
                            + '</label></span></div>'
                            + '</div>'
                        });
                        $($editor).confirmation('show');
                        return false;
                    }
                }
            },

            cellKeyDown: function (event, ui) {
                //Delete
                var soel = $("#gridShiftList");
                gbRowIndex = ui.rowIndx;
                gbDataIndx = ui.dataIndx;
                if (event.keyCode == 46) {//Ch? cho x�a nh?ng cell n�o cho edit th�i
                    if ($(ui.$ele[0]).hasClass('readonly-status') == false){
                        //console.log(ui.rowData);
                        ui.rowData[ui.dataIndx] = null;
                        updateIsUpdate(ui.rowData);
                        CalLateEarly(ui.rowData,1);
                        CalLateEarly(ui.rowData,2);
                        setBackColor(soel);
                        soel.pqGrid( "refreshDataAndView", {rowIndx:ui.rowIndx} );
                    }
                }
            },
            cellClick: function( event, ui ) {
                var soel = $("#gridShiftList");
                gbRowIndex = ui.rowIndx;
                gbDataIndx = ui.dataIndx;
            },
            complete: function( event, ui ) {
                var $grid = $("#gridShiftList");
                var gridData = $grid.pqGrid("option", "dataModel.data");
                var rows = gridData == null ? 0 : gridData.length;
                for (var i = 0; i < rows; i++) {
                        if (!isNullOrEmpty(gridData[i]["LateMinute"]) && gridData[i]["ApprovedLate"] == 0 && gridData[i]["NotApprovedLate"] == 0){
                            $grid.pqGrid( "addClass", {rowIndx: i, dataIndx: 'LateMinute', cls: 'digi-text-blue'} );
                            $grid.pqGrid( "addClass", {rowIndx: i, dataIndx: 'LateTimeIn', cls: 'digi-text-blue'} );

                        }
                        if (!isNullOrEmpty(gridData[i]["EarlyMinute"]) && gridData[i]["ApprovedEarly"] == 0 && gridData[i]["NotApprovedEarly"] == 0){
                            $grid.pqGrid( "addClass", {rowIndx: i, dataIndx: 'EarlyMinute', cls: 'digi-text-blue'} );
                            $grid.pqGrid( "addClass", {rowIndx: i, dataIndx: 'EarLyTimeOut', cls: 'digi-text-blue'} );
                        }
                }
            }
        };

        var gridShiftList = $("#gridShiftList").pqGrid(obj);
        $("#gridShiftList").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $("#gridShiftList").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        gridShiftList.pqGrid("refreshDataAndView");

        setTimeout(function () {
            resizePqGrid();
        }, 300);

        $("#frm_btnSave").click(function (event) {
            //alert(gbAllowSave);
            var soel = $("#gridShiftList");
            var obj = soel.pqGrid( "getEditCell" );
            var $editor = obj.$editor;
            if ($editor === undefined){
                ask_save(function () {
                    allowSave();
                });
            }

        });

        $("#btnFilterW75F4080").click(function(){
            var wdayFrom = $("#txtDateFrom");
            var wdayTo = $("#txtDateTo");

            wdayFrom.get(0).setCustomValidity("");
            wdayTo.get(0).setCustomValidity("");

            if (wdayFrom.val() == "") {
                wdayFrom.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Ngay')}}");
                $("#modalW75F4080").find('#hdBtnFilterW75F4080').click();
                wdayFrom.focus();
                return;
            }

            if ( wdayTo.val() == "") {
                wdayTo.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Ngay')}}");
                $("#modalW75F4080").find('#hdBtnFilterW75F4080').click();
                wdayTo.focus();
                return;
            }
            $("#modalW75F4080").find('#hdBtnFilterW75F4080').click();
        });



        function allowSave() {
            //console.log('dfsd');
            var soel = $("#gridShiftList")
            //soel.pqGrid("saveEditCell");
            var dataObj = soel.pqGrid("option", "dataModel.data");
            for (var i =0; i<dataObj.length;i++){
                if (dataObj[i].IsUpdate == 1){
                    if (isNullOrEmpty(dataObj[i].LateMinute) && isNullOrEmpty(dataObj[i].EarlyMinute)){
                        soel.pqGrid("setSelection", {rowIndx: i, colIndx: 'LateMinute'});
                        soel.pqGrid("editCell", {rowIndx: i, dataIndx: 'LateMinute'});
                        var obj = soel.pqGrid( "getEditCell" );
                        var $editor = obj.$editor;
                        var msg = '{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,"So_phut")}}';
                        var wid = msg.length * 9;
                        $($editor).confirmation({
                            btnOkLabel: '',
                            btnCancelLabel: '',
                            popout: true,
                            placement: "bottom",
                            singleton: true,
                            template:
                            '<div class="popover" style="width: '+wid+'px;max-width: 600px;"><div class="arrow"></div>'
                            + '<div class="popover-content" style="text-align: center;padding:10px;width: auto"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i>'
                            + msg
                            + '</span></div>'
                            + '</div>'
                        });
                        $($editor).confirmation('show');
                        return false;
                    }else{
                        if (dataObj[i].LateMinute != null && (dataObj[i].LateMinute <0 || dataObj[i].LateMinute >240)) {
                            soel.pqGrid("setSelection", {rowIndx: i, colIndx: 'LateMinute'});
                            soel.pqGrid("editCell", {rowIndx: i, dataIndx: 'LateMinute'});
                            var obj = soel.pqGrid( "getEditCell" );
                            var $editor = obj.$editor; //editor.
                            var msg = '{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,"Gia_tri_tu").' [1->240]'}}';
                            var wid = msg.length * 8;
                            $($editor).confirmation({
                                btnOkLabel: '',
                                btnCancelLabel: '',
                                popout: true,
                                placement: "bottom",
                                singleton: true,
                                template:
                                '<div class="popover" style="width: '+wid+'px;max-width: 600px;"><div class="arrow"></div>'
                                + '<div class="popover-content" style="text-align: center;padding:10px;width: auto"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i>'
                                + msg
                                + '</span></div>'
                                + '</div>'
                            });
                            $($editor).confirmation('show');
                            return false;
                        }

                        if (dataObj[i].EarlyMinute != null && (dataObj[i].EarlyMinute <0 || dataObj[i].EarlyMinute >240)) {
                            soel.pqGrid("setSelection", {rowIndx: i, colIndx: 'EarlyMinute'});
                            soel.pqGrid("editCell", {rowIndx: i, dataIndx: 'EarlyMinute'});
                            var obj = soel.pqGrid( "getEditCell" );
                            var $editor = obj.$editor; //editor.
                            var msg = '{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,"Gia_tri_tu").' [1->240]'}}';
                            var wid = msg.length * 8;
                            $($editor).confirmation({
                                btnOkLabel: '',
                                btnCancelLabel: '',
                                popout: true,
                                placement: "bottom",
                                singleton: true,
                                template:
                                '<div class="popover" style="width: '+wid+'px;max-width: 600px;"><div class="arrow"></div>'
                                + '<div class="popover-content" style="text-align: center;padding:10px;width: auto"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i>'
                                + msg
                                + '</span></div>'
                                + '</div>'
                            });
                            $($td).confirmation('show');
                            return false;
                        }

                    }
                }
            }



            //Th?c hi?n l?u
            var dataFilter = $.grep(dataObj, function (data) {
                return data.IsUpdate == 1;
            });

            var changes = soel.pqGrid( "getChanges" );
            console.log(changes);
            if (dataFilter.length > 0){
                $(".l3loading").removeClass('hide');
                $.ajax({
                    method: "POST",
                    url: '{{url("/W75F4080/$pForm/$g/save")}}',
                    data: {
                        obj: dataFilter
                    },
                    success: function (data) {
                        $(".l3loading").addClass('hide');
                        console.log(data);
                        console.log(data);
                        var rs = JSON.parse(data);
                        switch (rs.status){
                            case "BACKGROUND": //Gửi mail ngầm
                                save_ok(function(){
                                    alert_info("{{Helpers::getRS($g,'Email_da_duoc_gui_toi')}}" + ": <b><i>" + rs.name + "</i></b>");
                                    //callbackAfterSave(rs.data.TransID);
                                    reloadGridW75F4080();
                                });
                                break;
                            case "SHOWMAIL": //Hiển thị màn hình sendmail
                                save_ok(function(){
                                    showEmailPopup(rs.rsvalue,rs.data);
                                    //callbackAfterSave(rs.data.TransID);
                                    reloadGridW75F4080();
                                });
                                break;
                            case "NOSEND": //Không có gửi mail
                                save_ok(function(){
                                    //callbackAfterSave(rs.data.TransID);
                                    reloadGridW75F4080();
                                });
                                break;
                            case "ERROR": //Lỗi khi run SQL
                                save_not_ok();
                                console.log(rs.message);
                                //alert_error(rs.message);
                                break;
                        }
                        /*if (data.status == 1) {//L?u kh�ng c� l?i
                            if (data.rowData.Status == 1){
                                alert_warning(data.rowData.Message);//D? li?u l?u kh�ng h?p l?
                            }else{
                                setEmailValues("#popupMailW75F4080",data.rowData.EmailSenderAddress, data.rowData.EmailReceivedAddress, data.rowData.Subject, data.rowData.EmailContent, data.rowData.EmailCCAddress,data.rowData.EmailBCCAddress,0 );
                                $("#popupMailW75F4080").find("#mPopUp").find(".modal-body").html("<div class='col-md-12'><h4><i class='fa fa-chevron-circle-down' ></i>{{Helpers::getRS($g,"Phieu_chung_tu_da_duoc_duyet")}}</h4></div><div class='col-md-12 alert-success-approve' style='padding-top:5px;padding-bottom:5px'><button onclick='showEmail(\"#popupMailW75F4080\");'  type='button' class='btn btn-default smallbtn' ><i class='fa fa-envelope'></i>{{Helpers::getRS($g,"Gui_mail")}}</button></div>");
                                $("#popupMailW75F4080").find("#mPopUp").modal('show');
                            }
                        } else {
                            save_not_ok();
                        }*/
                    }
                });
            }else{
                alert_warning('{{Helpers::getRS(4,"Vui_long_chon_du_lieu_tren_luoi")}}');
            }

        }

        function updateIsUpdate(rowData){
            rowData["IsUpdate"] = 1;
        }



        $("#modalW75F4080").on('submit', '#frmW75F4080', function (e) {
            e.preventDefault();
            $("#frm_btnSave").prop("disabled", $("#cbStatusID").val() == "%");
            reloadGridW75F4080();

        });

        $("#btnFilterW75F4080").trigger('click');
    });

    var closePop = function () {
        $("#popupMailW75F4080").find("#mPopUp").modal('hide');
        $("#modalW75F4080").find('#hdBtnFilterW75F4080').click();
    };

    function reloadGridW75F4080() {
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            url: '{{url("/W75F4080/$pForm/$g/list")}}',
            data: $('#frmW75F4080').serialize() ,
            success: function (data) {
                $(".l3loading").addClass('hide');
                $("#gridShiftList").pqGrid("option", "dataModel.data", []);
                $("#gridShiftList").pqGrid("option", "dataModel.data", data);
                $("#gridShiftList").pqGrid("refreshDataAndView");
            }
        });
    }
    
    function checkHeadClick(obj, key){
                    var rs = $.grep(obj, function (data, index) {
                            return data[key] == 1;
                        });
                        var rs1;
                        if (key == "ApprovedLate" || key == "NotApprovedLate"){
                            rs1 = $.grep(obj, function (data, index) {
                                return isNullOrEmpty(data["LateMinute"]) == false;
                            });
                        }
                        if (key == "ApprovedEarly" || key == "NotApprovedEarly"){
                            rs1 = $.grep(obj, function (data, index) {
                                return isNullOrEmpty(data["EarlyMinute"]) == false;
                            });
                        }

                    return rs.length >= rs1.length ? true: false;
                }

    function headClick(el){
        $grid = $("#gridShiftList");
        $grid.pqGrid("quitEditMode");
        //$grid.pqGrid("saveEditCell")
        var obj = $grid.pqGrid("option", "dataModel.data");
        if (obj.length >0){
                var key = $(el).attr('id');
                var isHeadClick = checkHeadClick(obj,key); //Kiem tra cột hiện tại có headclick chưa, nếu rồi return true;
                setValueHeadClick($("#gridShiftList"), key, !isHeadClick);
        }

    }

    function setValueHeadClick($grid, currentKey , check){
        var relative = '';
        if (currentKey == "ApprovedLate")
            relative = "NotApprovedLate";
        if (currentKey == "NotApprovedLate")
            relative = "ApprovedLate";
        if (currentKey == "ApprovedEarly")
            relative = "NotApprovedEarly";
        if (currentKey == "NotApprovedEarly")
            relative = "ApprovedEarly";

        var checkNum = (check == true ? 1:0);
        var obj = $grid.pqGrid("option", "dataModel.data");
        if (obj.length > 0){
            for (var i=0;i<obj.length;i++){
                if (((currentKey == "ApprovedLate" || currentKey=="NotApprovedLate") && isNullOrEmpty(obj[i]["LateMinute"]) == false) || ((currentKey == "ApprovedEarly" || currentKey=="NotApprovedEarly") && isNullOrEmpty(obj[i]["EarlyMinute"]) == false)){
                    obj[i][currentKey] = checkNum;
                    if (checkNum == 1 && obj[i][relative] == 1){
                        obj[i][relative] = 0;
                    }
                    obj[i]["IsUpdate"] = 1;
                    //updateIsUpdate(rowData);
                    CalLateEarly(obj[i],1);
                    CalLateEarly(obj[i],2);
                    //setBackColor(soel);
                    //calHours(obj[i],1);
                    //calHours(obj[i],0);
                }else{
                    obj[i][currentKey] = 0;
                    obj[i][relative] = 0;
                }
            }
            $grid.pqGrid("option", "dataModel.data", obj);
            setBackColor($grid);
            $grid.pqGrid("refreshDataAndView");
            console.log(obj);
        }

    }

    function setBackColor($grid){
        var obj = $grid.pqGrid("option", "dataModel.data");
        if (obj.length > 0) {
            for (var i = 0; i < obj.length; i++) {
                if (obj[i].IsUpdate == 1) {
                    $grid.pqGrid("addClass", {rowIndx: i, cls: 'edit-status'});
                } else {
                    $grid.pqGrid("removeClass", {rowIndx: i, cls: 'edit-status'});
                }
            }
        }
    }

    function CalLateEarly(rowData, bLast) {
        var valFrom;
        var timestart;
        //console.log('test');
        if (bLast == 1) {
            valFrom = rowData.LateMinute;
            timestart = rowData.TimeStart;
            var vhour = ":";
            if (valFrom != null){
                var vTime = new Date(2000, 0, 1, timestart.substr(0, 2), timestart.substr(3, 2))
                av = new Date(vTime.getTime() + valFrom * 60000);
                vhour = pad(av.getHours(), 2) + ":" + pad(av.getMinutes(), 2);
            }
            rowData.ReLateTimeIn = (vhour == ":" ? "":vhour);
            rowData.LateTimeIn = (vhour == ":" ? "":vhour);
        }
        else {
            valFrom = rowData.EarlyMinute;
            timestart = rowData.TimeEnd;
            var vhour = ":";
            if (valFrom != null){
                var vTime = new Date(2000, 0, 1, timestart.substr(0, 2), timestart.substr(3, 2))
                av = new Date(vTime.getTime() - valFrom * 60000);
                vhour = pad(av.getHours(), 2) + ":" + pad(av.getMinutes(), 2);
            }

            rowData.ReEarLyTimeOut = (vhour == ":" ? "":vhour);
            rowData.EarLyTimeOut = (vhour == ":" ? "":vhour);
        }

    }

    var exportExcel = (function () {
        var uri = 'data:application/vnd.ms-excel;base64,',
                template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>', base64 = function (s) {
                    return window.btoa(unescape(encodeURIComponent(s)))
                }, format = function (s, c) {
                    return s.replace(/{(\w+)}/g, function (m, p) {
                        return c[p];
                    })
                };

        var rows = $("#gridShiftList").find("table tr");
        var tab_text = "";
        for (var j = 0; j < rows.length; j++) {
            var row = $(rows[j]);
            tab_text = tab_text + row.html() + "</tr>";
        }
        console.log(tab_text);
        var ctx = {worksheet: 'Data' || 'Worksheet', table: tab_text};
        var today = new Date();
        var datea = today.getFullYear() + '' + (today.getMonth() + 1) + '' + today.getDate() + '' + today.getHours() + '' + today.getMinutes() + '' + today.getSeconds();
        var downloadLink = document.createElement("a");
        downloadLink.download = "Di_tre_ve_som_" + datea + ".xls";
        downloadLink.innerHTML = "Download W47F3010";
        downloadLink.href = uri + base64(format(template, ctx));
        downloadLink.onclick = destroyClickedElement;
        downloadLink.style.display = "none";
        document.body.appendChild(downloadLink);
        downloadLink.click();
    });

</script>

