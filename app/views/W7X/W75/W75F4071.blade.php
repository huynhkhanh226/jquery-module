<style>
    .cls_success {
        padding-top: 20%;
    }

    .modalW75F4071 .modal-open .modal {
        overflow-y: hidden;
    }
</style>
<div class="modal fade modal noneOverflow noUseValidHTML5" id="modalW75F4071" data-keyboard="false"
     data-backdrop="static"
     role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <form class="form-horizontal" id="frmW75F4071" method="post" action="">
                <div class="modal-header">
                    {{Helpers::generateHeading($modalTitle,"W75F4071")}}
                </div>
                <div id="divScrollbarW75F4071">
                    <div class="modal-body" style="padding:10px">
                    <div class="row form-group {{$isHideConfirmOT ? 'hide':''}}">
                        <div class="col-md-2">
                            <div class="radio pdt5">
                                <label>
                                    <input name="optIsOT" id="optIsOTCompany" value="1" checked type="radio">
                                    {{Helpers::getRS($g,"Tang_ca_tai_cong_ty")}}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="radio pdt5">
                                <label>
                                    <input name="optIsOT" id="optIsNotOTCompany" value="0" type="radio">
                                    {{Helpers::getRS($g,"Tang_ca_ngoai_cong_ty")}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12 col-xs-12">
                            <div class="liketext">
                                <label class="lbl-value legend"
                                       style="border-bottom: 1px solid #e5e5e5;width: 100%">{{Helpers::getRS($g,"Thong_tin_chung")}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Ngay")}}</label>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2">
                            <div id="idDateFromIcon" class="input-group date classDateW75F4071">
                                <input type="text" class="form-control"
                                       id="txtDateW75F4071"
                                       name="txtDateW75F4071" value="" required=""><span
                                        class="input-group-addon">
                                    <i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>

                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Loai_ngay")}}
                                    :</label>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2">
                            <div class="liketext">
                                <label class=" lbl-value"
                                       id="lblDateTypeW75F4071"></label>
                            </div>
                            <input type="hidden" id="hdWorkDateTypeIDW75F4071" value=""/>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Ca")}}
                                    :</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-value "
                                       id="lblShiftIDW75F4071"></label>
                            </div>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Vao")}}
                                    :</label>

                            </div>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-value "
                                       id="lblInW75F4071"></label>
                            </div>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Ra")}}
                                    :</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-value "
                                       id="lblOutW75F4071"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row hide">
                        <div class="col-md-6 col-xs-6">
                            <div class="liketext">
                                <label id="tdLabelFirstW75F4071" class="lbl-value legend"
                                       style="border-bottom: 1px solid #e5e5e5;width: 100%">{{Helpers::getRS($g,"Tang_ca_dau_gio")}}</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="liketext">
                                <label id="tdLabelLastW75F4071" class="lbl-value legend"
                                       style="border-bottom: 1px solid #e5e5e5;width: 100%">{{Helpers::getRS($g,"Tang_ca_cuoi_gio")}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-1 col-xs-1 pdr0">
                            <div class="liketext">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Tang_ca_truoc")}}</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="input-group bootstrap-timepicker">
                                <input type="text" class="form-control text-center noUseValidHTML5"
                                       id="txtFirstFromW75F4071"
                                       placeholder="__:__"
                                       name="txtFirstFromW75F4071" value=""
                                >
                            </div>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="input-group bootstrap-timepicker">
                                <input type="text" class="form-control text-center noUseValidHTML5"
                                       id="txtFirstToW75F4071"
                                       placeholder="__:__"
                                       name="txtFirstToW75F4071" value=""
                                >
                            </div>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Gio")}}:</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-value"
                                       id="lblFirstHourW75F4071"></label>

                            </div>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="checkbox" style="margin-top: -2px">
                                <input type="checkbox" id="chIsPreOT" name="chIsPreOT"
                                       disabled="disabled">{{Helpers::getRS($g,"Da_duyet")}}
                            </div>
                        </div>
                        <div id="tdLastW75F4071">
                            <div class="col-md-1 col-xs-1 pdr0">
                                <div class="liketext">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Tang_ca_sau")}}</label>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-1">
                                <div class="input-group bootstrap-timepicker">
                                    <input type="text" class="form-control text-center noUseValidHTML5"
                                           id="txtLastFromW75F4071"
                                           placeholder="__:__"
                                           name="txtLastFromW75F4071" value=""
                                    >
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-1">
                                <div class="input-group bootstrap-timepicker">
                                    <input type="text" class="form-control text-center noUseValidHTML5"
                                           id="txtLastToW75F4071"
                                           placeholder="__:__"
                                           name="txtLastToW75F4071" value=""
                                    >
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-1">
                                <div class="liketext">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Gio")}}:</label>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-1">
                                <div class="liketext">
                                    <label class="lbl-value "
                                           id="lblLastHourW75F4071"></label>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-1">
                                <div class="checkbox" style="margin-top: -2px">
                                    <input type="checkbox" id="chIsAfterOT" name="chIsAfterOT"
                                           disabled="disabled">{{Helpers::getRS($g,"Da_duyet")}}
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- Bổ sung dòng mới -->
                    <fieldset class="{{$isHideOT ? 'hide':''}}">
                        <legend class="legend">{{Helpers::getRS($g,"Tach_gio_tang_ca")}}</legend>
                        <div class="row form-group">
                            <div class="col-md-1 col-xs-1 pdr0">
                                <div class="liketext">
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-1 pdr0">
                                <div class="liketext">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Tang_ca")}}</label>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-1">
                                <div class="input-group bootstrap-timepicker">
                                    <input type="text" class="form-control text-center noUseValidHTML5"
                                           id="txtPreOTHoursSplit"
                                           placeholder=""
                                           name="txtPreOTHoursSplit" value=""
                                    >
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-1">
                                <div class="liketext">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Tang_phep")}}</label>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-1">
                                <div class="input-group bootstrap-timepicker">
                                    <input type="text" class="form-control text-center noUseValidHTML5"
                                           id="txtPreOTLeave"
                                           placeholder=""
                                           name="txtPreOTLeave" value=""
                                    >
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-1">

                            </div>
                            <div id="tdLastW75F4071">
                                <div class="col-md-1 col-xs-1 pdr0">

                                </div>
                                <div class="col-md-1 col-xs-1 pdr0">
                                    <div class="liketext">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Tang_ca")}}</label>
                                    </div>
                                </div>
                                <div class="col-md-1 col-xs-1">
                                    <div class="input-group bootstrap-timepicker">
                                        <input type="text" class="form-control text-center noUseValidHTML5"
                                               id="txtAfterOTHoursSplit"
                                               placeholder=""
                                               name="txtAfterOTHoursSplit" value=""
                                        >
                                    </div>
                                </div>
                                <div class="col-md-1 col-xs-1 pdr0">
                                    <div class="liketext">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Tang_phep")}}</label>
                                    </div>
                                </div>
                                <div class="col-md-1 col-xs-1">
                                    <div class="input-group bootstrap-timepicker">
                                        <input type="text" class="form-control text-center noUseValidHTML5"
                                               id="txtAfterOTLeave"
                                               placeholder=""
                                               name="txtAfterOTLeave" value=""
                                        >
                                    </div>
                                </div>
                                <div class="col-md-1 col-xs-1">
                                    <div class="checkbox" style="margin-top: -2px">
                                        <input type="checkbox" id="chkIsPriorityLeave" name="chkIsPriorityLeave"
                                               disabled="disabled">{{Helpers::getRS($g,"Uu_tien_phep")}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <!-- End-->
                    <div class="row form-group">
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Ly_do")}}</label>
                            </div>
                        </div>
                        <div class="col-md-11 col-xs-11">
                            <textarea id="txtReasonW75F4071" name="txtReasonW75F4071" rows="2"
                                      style="width:100%"></textarea>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-normal">{{Helpers::getRS($g,"KQ_thuc_hien")}}</label>
                            </div>
                        </div>
                        <div class="col-md-11 col-xs-11">
                            <!-- input type="text" class="form-control noUseValidHTML5"
                                   id="txtResultW75F4071"
                                   placeholder=""
                                   name="txtResultW75F4071" value="" -->
                            <textarea id="txtResultW75F4071" name="txtResultW75F4071" rows="2"
                                      style="width:100%"></textarea>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12 col-xs-12 ">
                            <button type="button" id="frm_btnAdd"
                                    class="btn btn-default smallbtn pull-left mgr5"
                                    title="{{Helpers::getRS($g,"Them_moi1")}}">
                                <span class="glyphicon glyphicon-plus text-blue"></span> {{Helpers::getRS($g,"Them_moi1")}}
                            </button>

                            <button type="button" id="frm_btnEdit" title=""
                                    class="btn btn-default smallbtn pull-left mgr5 hide">
                                <span class="glyphicon glyphicon-edit mgr5 text-orange"></span> {{Helpers::getRS($g,"Sua")}}
                            </button>

                            <button type="button" id="frm_btnDelete"
                                    class="btn btn-default smallbtn pull-left confirmation-Delete mgr5 hide">
                                <span class="glyphicon glyphicon-bin text-red mgr5"></span> {{Helpers::getRS($g,"Xoa")}}
                            </button>

                            <button type="button" id="frm_btnNotSave"
                                    class="btn btn-default smallbtn pull-right"
                                    title="{{Helpers::getRS($g,"Khong_luu")}}"
                            ><span
                                        class="glyphicon glyphicon-floppy-remove text-red  mgr5"></span>{{Helpers::getRS($g,"Khong_luu")}}
                            </button>

                            <button type="button" id="frm_btnSave"
                                    class="btn btn-default smallbtn pull-right mgr5  "
                                    title="{{Helpers::getRS($g,"Luu")}}"
                            ><span
                                        class="glyphicon glyphicon-floppy-saved mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                            </button>

                            <button type="button" id="frm_btnSendmail"
                                    class="btn btn-default smallbtn pull-right mgr5 hide"
                                    title="{{Helpers::getRS($g,"Gui_mail")}}"
                            ><span
                                        class="fa fa-envelope-o mgr5 text-primary"></span> {{Helpers::getRS($g,"Gui_mail")}}
                            </button>

                        </div>

                    </div>
                    <div class="row form-group mgt10">
                        <div class="col-md-12 col-xs-12">
                            <div id="gridShiftList"></div>
                        </div>
                    </div>
                </div>
                </div>
                <button type="submit" id="frm_hbtnSave" class="hidden"></button>
            </form>
        </div>
    </div>
</div>
@include('layout.sendmail')
<script type="text/javascript">
    var height = 320;//270
    @if ($isHideOT == false)
        height = 390;//340
    @endif
     @if ($isHideConfirmOT == false)
        height = 423;//373
     @endif
     $(document).ready(function () {
         //$("#divScrollbarW75F4071").height($(document).height() - 510);
         $("#divScrollbarW75F4071").height($(window).height() - 80);
         $("#divScrollbarW75F4071").mCustomScrollbar({
             axis: "y",
             theme: "rounded-dark",
             scrollButtons: {enable: true},
             autoExpandScrollbar: true,
             advanced: {autoExpandHorizontalScroll: true},
             scrollInertia: 100,
             //scrollbarPosition:"outside"
         });
     });
    var obj = {
            width: '100%',
            numberCell: {show: false},
            //height: $("#modalW75F4071").find('.modal-content').height() - height,
            height: 400,
            //resizable: true,
            showTitle: false,
            collapsible: false,
            selectionModel: {type: 'row', mode: 'single'},
            //filterModel: {on: true, mode: "AND", header: true},
            //scrollModel: {autoFit: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
            rowBorders: true,
            columnBorders: true,
            postRenderInterval: -1,
            freezeCols: 2,
            hwrap: false,
            wrap: true,
            sortable: false,
            rowClick: function (event, ui) {
                if ($("#frm_btnSave").is(':enabled') == false) {
                    var rowData = getRowSelection($("#gridShiftList"));
                    onRowSelect(rowData, 1);
                    //setMode(1);
                }
            }

        };
    obj.colModel = [
        {
            title: "", editable: false, minWidth: 80, sortable: false, align: "center", render: function (ui) {
            var row = ui.rowData;
            var str = "";

            //PreOTStatus = 0 //chua duyet
            //PreOTStatus = 1 //da duyet
            //PreOTStatus = 2 //tu choi
            var pretatus = row.PreOTStatus;
            var afterstatus = row.AfterOTStatus;
            var isOTCompany = row.IsOTCompany;
            str += "<a title='{{Helpers::getRS($g,"Sua")}}' id='btnEditW75F4071'><i class='glyphicon glyphicon-edit text-orange' style='font-size: 115%;padding-right:5px'></i></a> ";

            if (Number(pretatus) == 0 && Number(afterstatus) == 0) {
                str += "<a title='{{Helpers::getRS($g,"Xoa")}}' id='btnDeleteW75F4071'><i class='fa fa-trash' style='font-size: 115%' ></i></a> ";
            } else {
                str += "<a title='{{Helpers::getRS($g,"Xoa")}}' id='btnDeleteW75F4071Disable'><i class='fa fa-trash text-gray' style='font-size: 115%;cursor:default'></i></a> ";
            }

            return str;
        },
            postRender: function (ui) {
                var rowIndx = ui.rowIndx,
                    gridShiftList = this,
                    $cell = gridShiftList.getCell(ui);
                //add button
                $cell.find("a#btnEditW75F4071")
                    .unbind("click")
                    .bind("click", function (evt) {
                        gridShiftList = $("#gridShiftList")
                        var $tr = $(this).closest("tr"),
                            rowIndx = gridShiftList.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                        var rowData = gridShiftList.pqGrid("getRowData", {rowIndx: rowIndx});

                        var rowData = getRowSelection($("#gridShiftList"));
                        onRowSelect(rowData, 2);
                        //setMode(2);
                    });
                $cell.find("a#btnDeleteW75F4071")
                    .unbind("click")
                    .bind("click", function (evt) {
                        gridShiftList = $("#gridShiftList")
                        var $tr = $(this).closest("tr"),
                            rowIndx = gridShiftList.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                        var rowData = gridShiftList.pqGrid("getRowData", {rowIndx: rowIndx});
                        ask_delete(callbackDeleteData);
                    });
            }
        },
        {
            title: '{{Helpers::getRS($g,"Xac_nhan")}}', editable: false, minWidth: 80, sortable: false, align: "center", hidden: "{{$isHideConfirmOT ? true: false}}",  render: function (ui) {
            var row = ui.rowData;
            var str = "";

            //PreOTStatus = 0 //chua duyet
            //PreOTStatus = 1 //da duyet
            //PreOTStatus = 2 //tu choi
            var pretatus = row.PreOTStatus;
            var afterstatus = row.AfterOTStatus;
            var isOTCompany = row.IsOTCompany;
            @if ($isHideConfirmOT == false)
            if ((Number(pretatus) == 1 || Number(afterstatus) == 1) && Number(isOTCompany) == 0) {
                str += "<a title='{{Helpers::getRS($g,"Xac_nhan")}}' id='btnVerifyW75F4071'><i style='font-size: 115%' class='fa fa-check-square text-blue mgr10' ></i></a> ";
            } else {
                str += "<a title='{{Helpers::getRS($g,"Xac_nhan")}}' id='btnVerifyW75F4071Disable'><i class='fa fa-check-square text-gray mgr10' style='font-size: 115%;cursor:default'></i></a> ";
            }
            @endif
            return str;
        },
            postRender: function (ui) {
                var rowIndx = ui.rowIndx,
                    gridShiftList = this,
                    $cell = gridShiftList.getCell(ui);
                //add button
                $cell.find("a#btnVerifyW75F4071")
                    .unbind("click")
                    .bind("click", function (evt) {
                        gridShiftList = $("#gridShiftList")
                        var $tr = $(this).closest("tr"),
                            rowIndx = gridShiftList.pqGrid("getRowIndx", {$tr: $tr}).rowIndx;
                        var rowData = gridShiftList.pqGrid("getRowData", {rowIndx: rowIndx});

                        var rowData = getRowSelection($("#gridShiftList"));
                        onRowSelect(rowData, 2, true);
                        $("#txtResultW75F4071").attr('disabled', false);
                        //setMode(2);
                    });
            }
        },
        {
            title: '{{Helpers::getRS($g,"Lan")}}',
            //minWidth: 20,
            width: 55,
            dataType: "string",
            editor: false,
            align: "center",
            dataIndx: "Times",
            hidden: true
            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '{{Helpers::getRS($g,"Ngay")}}',
            //minWidth: 20,
            width: 110,
            dataType: "date",
            editor: false,
            align: "center",
            dataIndx: "AttendanceDate",
            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '{{Helpers::getRS($g,"Ca")}}',
            //minWidth: 20,
            width: 70,
            dataType: "string",
            editor: false,
            align: "left",
            dataIndx: "ShiftID",
            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '{{Helpers::getRS($g,"Vao")}}',
            //minWidth: 20,
            width: 45,
            dataType: "string",
            editor: false,
            align: "center",
            dataIndx: "TimeStart",
            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '{{Helpers::getRS($g,"Ra")}}',
            //minWidth: 20,
            width: 45,
            dataType: "string",
            editor: false,
            align: "center",
            dataIndx: "TimeEnd",
            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '{{Helpers::getRS($g,"Tang_ca_truoc")}}', width: 140, align: "center",
            colModel: [
                {
                    title: '{{Helpers::getRS($g,"Dang_ky")}}',
                    colModel: [
                        {
                            title: '{{Helpers::getRS($g,"Tu")}}',
                            //minWidth: 20,
                            width: 45,
                            dataType: "string",
                            editor: false,
                            align: "center",
                            dataIndx: "OriPreOTFrom",
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                        {
                            title: '{{Helpers::getRS($g,"Den")}}',
                            //minWidth: 20,
                            width: 45,
                            dataType: "string",
                            editor: false,
                            align: "center",
                            dataIndx: "OriPreOTTo",
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                        {
                            title: '{{Helpers::getRS($g,"Gio")}}',
                            //minWidth: 20,
                            width: 45,
                            dataType: "string",
                            editor: false,
                            align: "right",
                            dataIndx: "OriPreOTHours",
                            format: '##,###.00',
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                        {
                            title: '{{Helpers::getRS($g,"Tang_ca")}}',
                            //minWidth: 20,
                            width: 80,
                            dataType: "float",
                            editor: false,
                            align: "right",
                            dataIndx: "OriPreOTHoursSplit",
                            format: '##,###.00',
                            hidden: '{{$isHideOT}}'
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                        {
                            title: '{{Helpers::getRS($g,"Tang_phep")}}',
                            //minWidth: 20,
                            width: 80,
                            dataType: "string",
                            editor: false,
                            align: "right",
                            dataIndx: "OriPreOTLeave",
                            format: '##,###.00',
                            hidden: '{{$isHideOT}}'
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                        {
                            title: '{{Helpers::getRS($g,"Trang_thai")}}',
                            //minWidth: 20,
                            width: 110,
                            dataType: "string",
                            editor: false,
                            align: "center",
                            //hidden:true,
                            dataIndx: "PreOTStatusName",
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                    ]
                },
                {
                    title: '{{Helpers::getRS($g,"Da_duyet")}}',
                    colModel: [
                        {
                            title: '{{Helpers::getRS($g,"Tu")}}',
                            //minWidth: 20,
                            width: 45,
                            dataType: "string",
                            editor: false,
                            align: "center",
                            dataIndx: "PreOTFrom",
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                        {
                            title: '{{Helpers::getRS($g,"Den")}}',
                            //minWidth: 20,
                            width: 45,
                            dataType: "string",
                            editor: false,
                            align: "center",
                            dataIndx: "PreOTTo",
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                        {
                            title: '{{Helpers::getRS($g,"Gio")}}',
                            //minWidth: 20,
                            width: 45,
                            dataType: "string",
                            editor: false,
                            align: "right",
                            dataIndx: "PreOTHours",
                            format: '##,###.00',
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                        {
                            title: '{{Helpers::getRS($g,"Tang_ca")}}',
                            //minWidth: 20,
                            width: 80,
                            dataType: "float",
                            editor: false,
                            align: "right",
                            dataIndx: "PreOTHoursSplit",
                            format: '##,###.00',
                            hidden: '{{$isHideOT}}'
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                        {
                            title: '{{Helpers::getRS($g,"Tang_phep")}}',
                            //minWidth: 20,
                            width: 80,
                            dataType: "float",
                            editor: false,
                            align: "right",
                            dataIndx: "PreOTLeave",
                            format: '##,###.00',
                            hidden: '{{$isHideOT}}'
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                    ]
                }
            ]
        },
        {
            title: '{{Helpers::getRS($g,"Tang_ca_sau")}}', width: 140, align: "center",
            colModel: [
                {
                    title: '{{Helpers::getRS($g,"Dang_ky")}}',
                    colModel: [
                        {
                            title: '{{Helpers::getRS($g,"Tu")}}',
                            // minWidth: 20,
                            width: 45,
                            dataType: "string",
                            editor: false,
                            align: "center",
                            dataIndx: "OriAfterOTFrom",
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                        {
                            title: '{{Helpers::getRS($g,"Den")}}',
                            //minWidth: 20,
                            width: 45,
                            dataType: "string",
                            editor: false,
                            align: "center",
                            dataIndx: "OriAfterOTTo",
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                        {
                            title: '{{Helpers::getRS($g,"Gio")}}',
                            //minWidth: 20,
                            width: 45,
                            dataType: "string",
                            editor: false,
                            align: "right",
                            dataIndx: "OriAfterOTHours",
                            format: '##,###.00',
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                        {
                            title: '{{Helpers::getRS($g,"Tang_ca")}}',
                            //minWidth: 20,
                            width: 80,
                            dataType: "float",
                            editor: false,
                            align: "right",
                            dataIndx: "OriAfterOTHoursSplit",
                            format: '##,###.00',
                            hidden: '{{$isHideOT}}'
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                        {
                            title: '{{Helpers::getRS($g,"Tang_phep")}}',
                            //minWidth: 20,
                            width: 80,
                            dataType: "string",
                            editor: false,
                            align: "right",
                            dataIndx: "OriAfterOTLeave",
                            format: '##,###.00',
                            hidden: '{{$isHideOT}}'
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                        {
                            title: '{{Helpers::getRS($g,"Trang_thai")}}',
                            //minWidth: 20,
                            width: 110,
                            dataType: "string",
                            editor: false,
                            align: "center",
                            //hidden: true,
                            dataIndx: "AfterOTStatusName",
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                    ]
                },
                {
                    title: '{{Helpers::getRS($g,"Da_duyet")}}',
                    colModel: [
                        {
                            title: '{{Helpers::getRS($g,"Tu")}}',
                            //minWidth: 20,
                            width: 45,
                            dataType: "string",
                            editor: false,
                            align: "center",
                            dataIndx: "AfterOTFrom",
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                        {
                            title: '{{Helpers::getRS($g,"Den")}}',
                            //minWidth: 20,
                            width: 45,
                            dataType: "string",
                            editor: false,
                            align: "center",
                            dataIndx: "AfterOTTo",
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                        {
                            title: '{{Helpers::getRS($g,"Gio")}}',
                            //minWidth: 20,
                            width: 45,
                            dataType: "string",
                            editor: false,
                            align: "right",
                            dataIndx: "AfterOTHours",
                            format: '##,###.00',
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                        {
                            title: '{{Helpers::getRS($g,"Tang_ca")}}',
                            //minWidth: 20,
                            width: 80,
                            dataType: "float",
                            editor: false,
                            align: "right",
                            dataIndx: "AfterOTHoursSplit",
                            format: '##,###.00',
                            hidden: '{{$isHideOT}}'
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                        {
                            title: '{{Helpers::getRS($g,"Tang_phep")}}',
                            //minWidth: 20,
                            width: 80,
                            dataType: "float",
                            editor: false,
                            align: "right",
                            dataIndx: "AfterOTLeave",
                            format: '##,###.00',
                            hidden: '{{$isHideOT}}'
                            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                        },
                    ]
                },

            ]
        },
        {
            title: '{{Helpers::getRS($g,"Uu_tien_phep")}}',
            minWidth: 50,
            width: 110,
            align: "center",
            dataType: "integer",
            dataIndx: "IsPriorityLeave",
            editor: false,
            sortable: false,
            type: 'checkbox',
            cb: {
                all: false,
                header: true,
                check: 1,
                uncheck: 0
            },
            editable: false,
            render: function (ui) {
                var row = ui.rowData,
                    checked = Number(row["IsPriorityLeave"]) == 1 ? 'checked' : ''
                return {
                    text: "<label><input type='checkbox' " + checked + " /></label>"
                };
            },
            hidden: '{{$isHideOT}}'

        },
        {
            title: '{{Helpers::getRS($g,"Ly_do")}}',
            //minWidth: 110,
            width: 270,
            dataType: "string",
            editor: false,
            align: "left",
            dataIndx: "Reason",
            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '{{Helpers::getRS($g,"KQ_thuc_hien")}}',
            //minWidth: 110,
            width: 270,
            dataType: "string",
            editor: false,
            align: "left",
            dataIndx: "ResultU",
            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '{{Helpers::getRS($g,"Ghi_chu")}}',
            //minWidth: 110,
            width: 270,
            dataType: "string",
            editor: false,
            align: "left",
            dataIndx: "Note",
            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '',
            minWidth: 20,
            width: 100,
            dataType: "string",
            editor: false,
            align: "left",
            hidden: true,
            dataIndx: "MaxTime",
            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '',
            minWidth: 20,
            width: 100,
            dataType: "string",
            editor: false,
            align: "left",
            hidden: true,
            dataIndx: "PreOTStatus",
            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '',
            minWidth: 20,
            width: 100,
            dataType: "string",
            editor: false,
            align: "left",
            hidden: true,
            dataIndx: "AfterOTStatus",
            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '',
            minWidth: 20,
            width: 100,
            dataType: "string",
            editor: false,
            align: "left",
            hidden: true,
            dataIndx: "TransID",
            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '',
            minWidth: 20,
            width: 100,
            dataType: "string",
            editor: false,
            align: "left",
            hidden: true,
            dataIndx: "EmailReceivedAddress",
            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '',
            minWidth: 20,
            width: 100,
            dataType: "string",
            editor: false,
            align: "left",
            hidden: true,
            dataIndx: "Subject",
            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '',
            minWidth: 20,
            width: 100,
            dataType: "string",
            editor: false,
            align: "left",
            hidden: true,
            dataIndx: "EmailContent",
            //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
    ];
    obj.dataModel = {
        data: {{json_encode($shiftList)}},
        location: "local",
        sorting: "local",
        sortDir: "down"
    };
    obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
    var gridShiftList = $("#gridShiftList").pqGrid(obj);
    $("#gridShiftList").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $("#gridShiftList").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    gridShiftList.pqGrid("refreshDataAndView");
    var task = '{{$task}}';
    $(function () {
        setTimeout(function () {
            resizePqGrid();
        }, 500);

        var tranMonth = {{Session::get("W91P0000")['HRTranMonth']}};
        var tranYear = {{Session::get("W91P0000")['HRTranYear']}};
        var daysInMonth = new Date(tranYear, tranMonth, 0).getDate()
        $('#txtDateW75F4071').datepicker({
            todayHighlight: true,
            autoclose: true,
            startDate: '{{date($AttPeriodFrom.'/'.$monthPeriod.'/Y')}}',
            endDate: '{{date($AttPeriodTo.'/'.$tranmonth.'/Y')}}',
            format: "dd/mm/yyyy",
        }).on('changeDate', function (ev) {
            setText();
        });

        $("#modalW75F4071").find(".glyphicon-calendar").on('click', function () {
            if ($('#txtDateW75F4071').is(':disabled') == false) {
                $('#txtDateW75F4071').datepicker('show');
            }
        });

        $('input[name="txtFirstFromW75F4071"]').inputmask({
            alias: "datetime",
            mask: "h:s",
            placeholder: "__:__"
        });

        $('input[name="txtFirstToW75F4071"]').inputmask({
            alias: "datetime",
            mask: "h:s",
            placeholder: "__:__"
        });

        $('input[name="txtLastFromW75F4071"]').inputmask({
            alias: "datetime",
            mask: "h:s",
            placeholder: "__:__"
        });

        $('input[name="txtLastToW75F4071"]').inputmask({
            alias: "datetime",
            mask: "h:s",
            placeholder: "__:__"
        });
        $("#frm_btnAdd").click(function () {
            setMode(0);
            resetText();
        });

        $("#frm_btnSave").click(function (event) {
            ask_save(function () {
                allowSave();
            }, '', '', function () {
                /*var rowData = getRowSelection($("#gridShiftList"));
                 onRowSelect(rowData,1);*/
            }, '');


        });
        $("#frm_btnNotSave").click(function (event) {
            ask_not_save(function () {

                var rowData = getRowSelection($("#gridShiftList"));
                console.log(rowData);
                if (rowData != null) {
                    //alert("sdfdsfsfs");
                    onRowSelect(rowData, 1);
                } else {
                    resetText();
                }

            });
        });


        $("#frm_btnSendmail").click(function (event) {
            console.log('frm_btnSendmail');
            var rowData = getRowSelection($("#gridShiftList"));
            setMailFormValues(rowData);

        });



        $("#txtFirstFromW75F4071").blur(function () {
            $(this).val($(this).val().replace(/_/g, "0"));
            calHours('txtFirstFromW75F4071', 1, this);
        });
        $("#txtFirstToW75F4071").blur(function () {
            $(this).val($(this).val().replace(/_/g, "0"));
            calHours('txtFirstToW75F4071', 1, this);
        });
        $("#txtLastFromW75F4071").blur(function () {
            //alert("AAAAAAAAAAA");
            $(this).val($(this).val().replace(/_/g, "0"));
            calHours('txtLastFromW75F4071', 0, this);
        });
        $("#txtLastToW75F4071").blur(function () {
            $(this).val($(this).val().replace(/_/g, "0"));
            calHours('txtLastToW75F4071', 0, this);
        });

        gridShiftList.pqGrid({
            complete: function (event, ui) {
                console.log('complete');
                if (task == ""){ //Chi chay o truong hop xem
                    if ($("#gridShiftList").pqGrid("option", "dataModel.data").length > 0) {
                        var rowIndx = getRowIndx($("#gridShiftList"));
                        $("#gridShiftList").pqGrid("setSelection", {rowIndx: rowIndx});
                        var rowData = getRowSelection($("#gridShiftList"));
                        onRowSelect(rowData, 1);
                        //setMode(1)
                    } else {
                        //$("#frm_btnAdd").trigger('click');
                        //setMode(1)
                        onRowSelect(null, 1);
                    }
                }

            }
        });


    });

    function setMailFormValues(rowData){
        if (rowData != null) {
            $("#mPopUpSendMail").find("#hdFrom").val(rowData.EmailSenderAddress);
            $("#mPopUpSendMail").find("#txtEmailReceivedAddress").val(rowData.EmailReceivedAddress);
            $("#mPopUpSendMail").find("#txtEmailCCAddress").val(rowData.EmailCCAddress);
            $("#mPopUpSendMail").find("#txtEmailBCCAddress").val(rowData.EmailBCCAddress);
            $("#mPopUpSendMail").find("#txtEmailTitle").val(rowData.Subject);
            $("#mPopUpSendMail").find("#txtEmailContent").html(rowData.EmailContent);
            CKEDITOR.instances.txtEmailContent.setData(rowData.EmailContent);
            $("#mPopUpSendMail").modal('show');
        }
    }

    function closePopSendMail() {
        $("#mPopUpSendMail").find("#hdFrom").val('');
        $("#mPopUpSendMail").find("#txtEmailReceivedAddress").val('');
        $("#mPopUpSendMail").find("#txtEmailCCAddress").val('');
        $("#mPopUpSendMail").find("#txtEmailBCCAddress").val('');
        $("#mPopUpSendMail").find("#txtEmailTitle").val('');
        $("#mPopUpSendMail").find("#txtEmailContent").html('');
        CKEDITOR.instances.txtEmailContent.setData('');
        $("#mPopUpSendMail").modal('hide');
    }

    function setText() {
        $('#lblDateTypeW75F4071').html('');
        $('#hdWorkDateTypeIDW75F4071').val('');
        $('#lblShiftIDW75F4071').html('');
        $('#lblInW75F4071').html('');
        $('#lblOutW75F4071').html('');
        //$(".l3loading").removeClass('hide');
        if (task != '') {
            $.ajax({
                method: "POST",
                url: '{{url("/W75F4071/D75F4071/4/settext")}}',
                data: {wokingDate: EncodeToHtml($("#txtDateW75F4071").val())},
                success: function (data) {
                    var rs = JSON.parse(data);
                    console.log(rs);
                    var dataRs = rs['data'];
                    switch(rs['status']){
                        case "STOP":
                            alert_warning(dataRs, function () {
                                $("#txtDateW75F4071").val("");
                                $('#lblDateTypeW75F4071').html('');
                                $('#hdWorkDateTypeIDW75F4071').html('');
                                $('#lblShiftIDW75F4071').html('');
                                $('#lblInW75F4071').html('');
                                $('#lblOutW75F4071').html('');
                            });
                            break;
                        case "SUCCESS":
                            if (dataRs.ShiftID == "" && task != '') {
                                alert_warning("{{Helpers::getRS($g,'Ngay_dang_ky_khong_co_ca_Ban_vui_long_chon_ngay_khac')}}", function () {
                                    $("#txtDateW75F4071").val("");
                                    $('#lblDateTypeW75F4071').html('');
                                    $('#hdWorkDateTypeIDW75F4071').html('');
                                    $('#lblShiftIDW75F4071').html('');
                                    $('#lblInW75F4071').html('');
                                    $('#lblOutW75F4071').html('');
                                });
                            } else {
                                $('#lblDateTypeW75F4071').html(dataRs.WorkDayTypeName);
                                $('#hdWorkDateTypeIDW75F4071').html(dataRs.WorkDayType);
                                $('#lblShiftIDW75F4071').html(dataRs.ShiftID);
                                $('#lblInW75F4071').html(dataRs.TimeStart);
                                $('#lblOutW75F4071').html(dataRs.TimeEnd);
                            }
                            break;
                        case "FAILED":
                            alert_error(dataRs);
                            break;
                    }
                }
            });
        }
    }
    
    /*function setText() {
        $('#lblDateTypeW75F4071').html('');
        $('#hdWorkDateTypeIDW75F4071').val('');
        $('#lblShiftIDW75F4071').html('');
        $('#lblInW75F4071').html('');
        $('#lblOutW75F4071').html('');
        //$(".l3loading").removeClass('hide');
        if (task != '') {
            $.ajax({
                method: "POST",
                url: '{{--{{url("/W75F4071/D75F4071/4/settext")}}--}}',
                data: {wokingDate: EncodeToHtml($("#txtDateW75F4071").val())},
                success: function (data) {
                    //$(".l3Floading").addClass('hide');
                    if (data.length > 0) {
                        if (data[0].ShiftID == "" && task != '') {
                            alert_warning("{{--{{Helpers::getRS($g,'Ngay_dang_ky_khong_co_ca_Ban_vui_long_chon_ngay_khac')}}--}}", function () {
                                $("#txtDateW75F4071").val("");
                                $('#lblDateTypeW75F4071').html('');
                                $('#hdWorkDateTypeIDW75F4071').html('');
                                $('#lblShiftIDW75F4071').html('');
                                $('#lblInW75F4071').html('');
                                $('#lblOutW75F4071').html('');
                            });
                        } else {
                            $('#lblDateTypeW75F4071').html(data[0].WorkDayTypeName);
                            $('#hdWorkDateTypeIDW75F4071').html(data[0].WorkDayType);
                            $('#lblShiftIDW75F4071').html(data[0].ShiftID);
                            $('#lblInW75F4071').html(data[0].TimeStart);
                            $('#lblOutW75F4071').html(data[0].TimeEnd);
                        }

                    }

                }
            });
        }
    }*/

    function resetText() {
        //alert_warning('Date is not valid!');
        $("#txtDateW75F4071").val("");
        $('#lblDateTypeW75F4071').html("");
        $('#hdWorkDateTypeIDW75F4071').val("");

        $('#lblShiftIDW75F4071').html("");
        $('#lblInW75F4071').html("");
        $('#lblOutW75F4071').html("");
        $("#txtFirstFromW75F4071").val("");
        $("#txtFirstToW75F4071").val("");
        $("#txtLastFromW75F4071").val("");
        $("#txtLastToW75F4071").val("");
        $('#lblFirstHourW75F4071').html("0.00");
        $('#lblLastHourW75F4071').html("0.00");

        $("#txtPreOTHoursSplit").val("")
        $("#txtPreOTLeave").val("")
        $("#txtAfterOTHoursSplit").val("")
        $("#txtAfterOTLeave").val("")
        $("#chkIsPriorityLeave").prop("checked", false);

        $("#txtReasonW75F4071").val("");
        $("#txtResultW75F4071").val("");
        $("#chIsPreOT").prop("checked", false);
        $("#chIsAfterOT").prop("checked", false);
        $("#optIsOTCompany").prop("checked", true);

        $("txtDateW75F4071").focus();
    }

    function setMode(mode, isVerify) {
        if (isVerify == undefined || isVerify == "" || isVerify == null) {
            isVerify = false;
        }

        //mode = 0 is add
        //mode = 1 view
        //mode = 2 edit
        var bCount = $("#gridShiftList").pqGrid("option", "dataModel.data").length > 0;
        if (mode == 0) {//add
            $('input[name="txtDateW75F4071"]').attr('disabled', false);
            $('input[name="txtFirstFromW75F4071"]').attr('disabled', false);
            $('input[name="txtFirstToW75F4071"]').attr('disabled', false);
            $('input[name="txtLastFromW75F4071"]').attr('disabled', false);
            $('input[name="txtLastToW75F4071"]').attr('disabled', false);
            $('textarea[name="txtReasonW75F4071"]').attr('disabled', false);
            $("#txtResultW75F4071").attr('disabled', true);

            $("#txtPreOTHoursSplit").prop('disabled', false);
            $("#txtPreOTLeave").prop('disabled', false);
            $("#txtAfterOTHoursSplit").prop('disabled', false);
            $("#txtAfterOTLeave").prop('disabled', false);
            $("#chkIsPriorityLeave").prop('disabled', false);
            $("#optIsOTCompany").prop('disabled', false);
            $("#optIsNotOTCompany").prop('disabled', false);


            $('button[id="frm_btnAdd"]').attr('disabled', true);
            $('button[id="frm_btnSave"]').attr('disabled', false);
            $('button[id="frm_btnNotSave"]').attr('disabled', false);
            $('button[id="frm_btnSendmail"]').attr('disabled', true);
            task = "add";
            $("#gridShiftList").pqGrid("disable");
            $('#idDateFromIcon').removeClass('classDateW75F4071Disabled');
            $('#idDateFromIcon').removeClass('classDateW75F4071');
            $('#idDateFromIcon').addClass('classDateW75F4071');
        }
        if (mode == 1) {//view
            $('input[name="txtDateW75F4071"]').attr('disabled', true);
            $('input[name="txtFirstFromW75F4071"]').attr('disabled', true);
            $('input[name="txtFirstToW75F4071"]').attr('disabled', true);
            $('input[name="txtLastFromW75F4071"]').attr('disabled', true);
            $('input[name="txtLastToW75F4071"]').attr('disabled', true);
            $('textarea[name="txtReasonW75F4071"]').attr('disabled', true);
            $("#txtResultW75F4071").attr('disabled', true);

            $("#txtPreOTHoursSplit").prop('disabled', true);
            $("#txtPreOTLeave").prop('disabled', true);
            $("#txtAfterOTHoursSplit").prop('disabled', true);
            $("#txtAfterOTLeave").prop('disabled', true);
            $("#chkIsPriorityLeave").prop('disabled', true);
            $("#optIsOTCompany").prop('disabled', true);
            $("#optIsNotOTCompany").prop('disabled', true);

            $('button[id="frm_btnAdd"]').attr('disabled', false);
            $('button[id="frm_btnSave"]').attr('disabled', true);
            $('button[id="frm_btnNotSave"]').attr('disabled', true);
            $('button[id="frm_btnSendmail"]').attr('disabled', false);
            var bTemp = $('button[id="frm_btnSendmail"]').is(':enabled') && bCount;
            $('button[id="frm_btnSendmail"]').attr('disabled', !bTemp);
            task = "";
            $("#gridShiftList").pqGrid("enable");
            $('#idDateFromIcon').removeClass('classDateW75F4071Disabled');
            $('#idDateFromIcon').removeClass('classDateW75F4071');
            $('#idDateFromIcon').addClass('classDateW75F4071Disabled');

        }
        if (mode == 2) {//edit
            $('input[name="txtDateW75F4071"]').attr('disabled', true);
            var rowData = getRowSelection($("#gridShiftList"));
            //alert(isVerify);
            $('input[name="txtFirstFromW75F4071"]').attr('disabled', rowData.PreOTStatus == 1 || rowData.PreOTStatus == 2);
            $('input[name="txtFirstToW75F4071"]').attr('disabled', rowData.PreOTStatus == 1 || rowData.PreOTStatus == 2);
            $('input[name="txtLastFromW75F4071"]').attr('disabled', rowData.AfterOTStatus == 1 || rowData.AfterOTStatus == 2);
            $('input[name="txtLastToW75F4071"]').attr('disabled', rowData.AfterOTStatus == 1 || rowData.AfterOTStatus == 2);

            $("#txtPreOTHoursSplit").prop('disabled', rowData.PreOTStatus == 1 || rowData.PreOTStatus == 2);
            $("#txtPreOTLeave").prop('disabled', rowData.PreOTStatus == 1 || rowData.PreOTStatus == 2);
            $("#txtAfterOTHoursSplit").prop('disabled', rowData.AfterOTStatus == 1 || rowData.AfterOTStatus == 2);
            $("#txtAfterOTLeave").prop('disabled', rowData.AfterOTStatus == 1 || rowData.AfterOTStatus == 2);

            task = "edit";
            if (isVerify) { //Neu la xac nhan thi phai bo rem ra
                $('input[name="txtFirstFromW75F4071"]').attr('disabled', !(rowData.PreOTStatus == 1 && rowData.IsPreConfirm == 0));
                $('input[name="txtFirstToW75F4071"]').attr('disabled', !(rowData.PreOTStatus == 1 && rowData.IsPreConfirm == 0));
                $("#txtPreOTHoursSplit").prop('disabled', !(rowData.PreOTStatus == 1 && rowData.IsPreConfirm == 0));
                $("#txtPreOTLeave").prop('disabled', !(rowData.PreOTStatus == 1 && rowData.IsPreConfirm == 0));

                $('input[name="txtLastFromW75F4071"]').attr('disabled', !(rowData.AfterOTStatus == 1 && rowData.IsAfterConfirm == 0));
                $('input[name="txtLastToW75F4071"]').attr('disabled', !(rowData.AfterOTStatus == 1 && rowData.IsAfterConfirm == 0));
                $("#txtAfterOTHoursSplit").prop('disabled', !(rowData.AfterOTStatus == 1 && rowData.IsAfterConfirm == 0));
                $("#txtAfterOTLeave").prop('disabled', !(rowData.AfterOTStatus == 1 && rowData.IsAfterConfirm == 0));
                task = "verify";
            }

            $("#optIsOTCompany").prop('disabled', !(rowData.PreOTStatus == 0 && rowData.IsPreConfirm == 0 && rowData.AfterOTStatus == 0 && rowData.IsAffterConfirm == 0));
            $("#optIsNotOTCompany").prop('disabled', !(rowData.PreOTStatus == 0 && rowData.IsPreConfirm == 0 && rowData.AfterOTStatus == 0 && rowData.IsAffterConfirm == 0));

            $("#chkIsPriorityLeave").prop('disabled', rowData.PreOTStatus == 1 || rowData.PreOTStatus == 2 || rowData.AfterOTStatus == 1 || rowData.AfterOTStatus == 2);
            $('textarea[name="txtReasonW75F4071"]').attr('disabled', false);
            $('button[id="frm_btnAdd"]').attr('disabled', true);
            $('button[id="frm_btnSave"]').attr('disabled', false);
            $('button[id="frm_btnNotSave"]').attr('disabled', false);
            $('button[id="frm_btnSendmail"]').attr('disabled', true);

            $("#gridShiftList").pqGrid("disable");
            $('#idDateFromIcon').removeClass('classDateW75F4071Disabled');
            $('#idDateFromIcon').removeClass('classDateW75F4071');
            $('#idDateFromIcon').addClass('classDateW75F4071');
        }
    }

    function calHours(id, bFirst, el) {
        var valFrom;
        var valTo;
        if (bFirst == 1) {
            valFrom = $("#txtFirstFromW75F4071").val().replace(/_/g, "0");
            valTo = $("#txtFirstToW75F4071").val().replace(/_/g, "0");
            if (valFrom == '' || valTo == '') {
                $('#lblFirstHourW75F4071').html("0.00");
                return true;
            }
            var dFrom = new Date(2000, 0, 1, valFrom.substr(0, 2), valFrom.substr(3, 2));
            var dTo = new Date(2000, 0, 1, valTo.substr(0, 2), valTo.substr(3, 2));
            //var dFrom = new Date("2014-1-1 " + valTo);
            //var dTo = new Date("2014-1-1 " + valFrom);
            var diff = (dTo - dFrom) / 1000 / 60 / 60;
            if (isNaN(diff)) {
                $("#" + id).val("");
            }
            else {
                if (diff >= 0) {
                    $('#lblFirstHourW75F4071').html(diff.toFixed(2));
                }
                else {
                    $('#lblFirstHourW75F4071').html((24 + diff).toFixed(2));
                }
            }
        }
        else {
            valFrom = $("#txtLastFromW75F4071").val().replace(/_/g, "0");
            valTo = $("#txtLastToW75F4071").val().replace(/_/g, "0");
            if (valFrom == '' || valTo == '') {
                $('#lblLastHourW75F4071').html("0.00");
                return true;
            }
            console.log(valFrom, valTo);
            var dFrom = new Date(2000, 0, 1, valFrom.substr(0, 2), valFrom.substr(3, 2))
            var dTo = new Date(2000, 0, 1, valTo.substr(0, 2), valTo.substr(3, 2))
            var diff = (dTo - dFrom) / 1000 / 60 / 60;
            if (diff >= 0) {
                $('#lblLastHourW75F4071').html(diff.toFixed(2));
            }
            else {
                $('#lblLastHourW75F4071').html((24 + diff).toFixed(2));
            }
        }

        splitPreOTHours(el);

    }

    //mode = 0 is add
    //mode = 1 view
    //mode = 2 edit
    function onRowSelect(rowData, mode, isVerify) {
        if (isVerify == undefined || isVerify == "" || isVerify == null) {
            isVerify = false;
        }
        console.log(isVerify);
        if (rowData == null) {
            $("#modalW75F4071").find("#txtDateW75F4071").datepicker('setDate', '');

            $('#lblDateTypeW75F4071').html('');
            $('#hdWorkDateTypeIDW75F4071').val('');
            $('#lblShiftIDW75F4071').html('');
            $('#lblInW75F4071').html('');
            $('#lblOutW75F4071').html('');

            $("#modalW75F4071").find("#txtFirstFromW75F4071").val('');
            $("#modalW75F4071").find("#txtFirstToW75F4071").val('');
            $("#modalW75F4071").find("#txtLastFromW75F4071").val('');
            $("#modalW75F4071").find("#txtLastToW75F4071").val('');
            $("#modalW75F4071").find('#lblFirstHourW75F4071').html('');
            $("#modalW75F4071").find('#lblLastHourW75F4071').html('');

            $("#modalW75F4071").find('#txtPreOTHoursSplit').val("");
            $("#modalW75F4071").find('#txtPreOTLeave').val("");
            $("#modalW75F4071").find('#txtAfterOTHoursSplit').val("");
            $("#modalW75F4071").find('#txtAfterOTLeave').val("");
            $("#modalW75F4071").find('#chkIsPriorityLeave').prop("checked", false);
            $("#modalW75F4071").find('#optIsOTCompany').prop("checked", true);
            $("#modalW75F4071").find('#optIsNotOTCompany').prop("checked", false);


            $("#modalW75F4071").find("#txtReasonW75F4071").val('');
            $("#modalW75F4071").find("#txtResultW75F4071").val('');
            $("#modalW75F4071").find('#chIsPreOT').prop("checked", false);
            $("#modalW75F4071").find('#chIsAfterOT').prop("checked", false);
            $("#modalW75F4071").find('#lblShiftIDW75F4071').html('');
            $("#modalW75F4071").find('#lblInW75F4071').html('');
            $("#modalW75F4071").find('#lblOutW75F4071').html('');
        } else {
            $("#modalW75F4071").find("#txtDateW75F4071").datepicker('setDate', rowData.AttendanceDate);

            $('#lblDateTypeW75F4071').html(rowData.WorkDayTypeName);
            $('#hdWorkDateTypeIDW75F4071').val(rowData.WorkDayType);
            $('#lblShiftIDW75F4071').html(rowData.ShiftID);
            $('#lblInW75F4071').html(rowData.TimeStart);
            $('#lblOutW75F4071').html(rowData.TimeEnd);

            $("#modalW75F4071").find("#txtFirstFromW75F4071").val(rowData.OriPreOTFrom);
            $("#modalW75F4071").find("#txtFirstToW75F4071").val(rowData.OriPreOTTo);
            $("#modalW75F4071").find("#txtLastFromW75F4071").val(rowData.OriAfterOTFrom);
            $("#modalW75F4071").find("#txtLastToW75F4071").val(rowData.OriAfterOTTo);
            $("#modalW75F4071").find('#lblFirstHourW75F4071').html(format2(rowData.OriPreOTHours, '', 2));
            $("#modalW75F4071").find('#lblLastHourW75F4071').html(format2(rowData.OriAfterOTHours, '', 2));

            $("#modalW75F4071").find('#txtPreOTHoursSplit').val(formatNumber(rowData.OriPreOTHoursSplit, 2));
            $("#modalW75F4071").find('#txtPreOTLeave').val(formatNumber(rowData.OriPreOTLeave, 2));
            $("#modalW75F4071").find('#txtAfterOTHoursSplit').val(formatNumber(rowData.OriAfterOTHoursSplit, 2));
            $("#modalW75F4071").find('#txtAfterOTLeave').val(formatNumber(rowData.OriAfterOTLeave, 2));
            $("#modalW75F4071").find('#chkIsPriorityLeave').prop("checked", rowData.IsPriorityLeave == 1);
            $("#modalW75F4071").find('#optIsOTCompany').prop("checked", rowData.IsOTCompany == 1);
            $("#modalW75F4071").find('#optIsNotOTCompany').prop("checked", rowData.IsOTCompany == 0);

            $("#txtPreOTHoursSplit").prop('disabled', false);
            $("#txtPreOTLeave").prop('disabled', false);
            $("#txtAfterOTHoursSplit").prop('disabled', false);
            $("#txtAfterOTLeave").prop('disabled', false);
            $("#chkIsPriorityLeave").prop('disabled', false);

            $("#modalW75F4071").find("#txtReasonW75F4071").val(rowData.Reason);
            $("#modalW75F4071").find("#txtResultW75F4071").val(rowData.ResultU);
            $("#modalW75F4071").find('#chIsPreOT').prop("checked", rowData.PreOTStatus == 1);
            $("#modalW75F4071").find('#chIsAfterOT').prop("checked", rowData.AfterOTStatus == 1);
        }

        setMode(mode, isVerify);

    }

    function allowSave() {
        var wday = $("#txtDateW75F4071");
        var preOTFrom = $("#txtFirstFromW75F4071");
        var preOTTo = $("#txtFirstToW75F4071");
        var lastOTFrom = $("#txtLastFromW75F4071");
        var lastOTTo = $("#txtLastToW75F4071");
        wday.get(0).setCustomValidity("");
        preOTFrom.get(0).setCustomValidity("");
        preOTTo.get(0).setCustomValidity("");
        lastOTFrom.get(0).setCustomValidity("");
        lastOTTo.get(0).setCustomValidity("");

        if (wday.val() == "") {
            wday.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Ngay')}}");
            wday.focus();
            $("#modalW75F4071").find('#frm_hbtnSave').click();
            return;
        }

        if (preOTFrom.val() == '' && preOTTo.val() != '') {
            if (preOTFrom.val() == "") {
                preOTFrom.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Thoi_gian_tu')}}");
                preOTFrom.focus();
                $("#modalW75F4071").find('#frm_hbtnSave').click();
                return;
            }
        }
        else if (preOTFrom.val() != '' && preOTTo.val() == '') {
            if (preOTTo.val() == "") {
                preOTTo.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Thoi_gian_den')}}");
                preOTTo.focus();
                $("#modalW75F4071").find('#frm_hbtnSave').click();
                return;
            }
        }

        if (lastOTFrom.val() == '' && lastOTTo.val() != '') {
            if (lastOTFrom.val() == "") {
                lastOTFrom.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Thoi_gian_tu')}}");
                lastOTFrom.focus();
                $("#modalW75F4071").find('#frm_hbtnSave').click();
                return;
            }
        }
        else if (lastOTFrom.val() != '' && lastOTTo.val() == '') {
            if (lastOTTo.val() == "") {
                lastOTTo.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Thoi_gian_den')}}");
                lastOTTo.focus();
                $("#modalW75F4071").find('#frm_hbtnSave').click();
                return;
            }
        }

        if (preOTFrom.val() == '' && preOTTo.val() == '' && lastOTFrom.val() == '' && lastOTTo.val() == '') {
            if (preOTFrom.val() == "") {
                preOTFrom.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Thoi_gian')}}");
                preOTFrom.focus();
                $("#modalW75F4071").find('#frm_hbtnSave').click();
                return;
            }
        }
        if (preOTFrom.val() != '' && preOTFrom.val().substr(3, 4) != "00" && preOTFrom.val().substr(3, 4) != "30" && preOTFrom.val().substr(3, 4) != "15" && preOTFrom.val().substr(3, 4) != "45") {
            preOTFrom.get(0).setCustomValidity("{{Helpers::getRS($g,'So_phut_phai_la')}}" + " 0, 15, 30 " + "{{Helpers::getRS($g,'hoac')}}" + " 45");
            preOTFrom.focus();
            $("#modalW75F4071").find('#frm_hbtnSave').click();
            return;
        }

        if (preOTTo.val() != '' && preOTTo.val().substr(3, 4) != "00" && preOTTo.val().substr(3, 4) != "30" && preOTTo.val().substr(3, 4) != "15" && preOTTo.val().substr(3, 4) != "45") {
            preOTTo.get(0).setCustomValidity("{{Helpers::getRS($g,'So_phut_phai_la')}}" + " 0, 15, 30 " + "{{Helpers::getRS($g,'hoac')}}" + " 45");
            preOTTo.focus();
            $("#modalW75F4071").find('#frm_hbtnSave').click();
            return;
        }

        if (lastOTFrom.val() != '' && lastOTFrom.val().substr(3, 4) != "00" && lastOTFrom.val().substr(3, 4) != "30" && lastOTFrom.val().substr(3, 4) != "15" && lastOTFrom.val().substr(3, 4) != "45") {
            lastOTFrom.get(0).setCustomValidity("{{Helpers::getRS($g,'So_phut_phai_la')}}" + " 0, 15, 30 " + "{{Helpers::getRS($g,'hoac')}}" + " 45");
            lastOTFrom.focus();
            $("#modalW75F4071").find('#frm_hbtnSave').click();
            return;
        }

        if (lastOTTo.val() != '' && lastOTTo.val().substr(3, 4) != "00" && lastOTTo.val().substr(3, 4) != "30" && lastOTTo.val().substr(3, 4) != "15" && lastOTTo.val().substr(3, 4) != "45") {
            lastOTTo.get(0).setCustomValidity("{{Helpers::getRS($g,'So_phut_phai_la')}}" + " 0, 15, 30 " + "{{Helpers::getRS($g,'hoac')}}" + " 45");
            lastOTTo.focus();
            $("#modalW75F4071").find('#frm_hbtnSave').click();
            return;
        }

        $("#modalW75F4071").find('#frm_hbtnSave').click();

    }

    function EncodeToHtml(str) {
        if (str == undefined)
            return "";
        var enstring = str;
        enstring = enstring.replace(/[/]/g, "%2F");
        enstring = enstring.replace(/[&]/g, "%26");
        enstring = enstring.replace(/[,]/g, "%2C");
        enstring = enstring.replace(/\\/g, "%5C");
        enstring = enstring.replace(/[.]/g, "%2E");
        enstring = enstring.replace(/[ ]/g, "%20");
        enstring = enstring.replace(/[@]/g, "%40");
        enstring = enstring.replace(/[<]/g, "%3C");
        enstring = enstring.replace(/[>]/g, "%3E");
        enstring = enstring.replace(/[=]/g, "%3D");
        // enstring = enstring.replace(/["]/g,"%22");
        return enstring;
    }

    $("#modalW75F4071").on('submit', '#frmW75F4071', function (e) {
        e.preventDefault();
        var link;
        var transid = '';
        var times = 0;
        var mode = 0;
        var wday = $("#txtDateW75F4071").val();
        var preOTFrom = $("#txtFirstFromW75F4071").val().replace(/_/g, "0");
        var preOTTo = $("#txtFirstToW75F4071").val().replace(/_/g, "0");
        var lastOTFrom = $("#txtLastFromW75F4071").val().replace(/_/g, "0");
        var lastOTTo = $("#txtLastToW75F4071").val().replace(/_/g, "0");
        var shift = $('#lblShiftIDW75F4071').html();
        var prehour = $('#lblFirstHourW75F4071').html();
        var afterhour = $('#lblLastHourW75F4071').html();

        var preOTHoursSplit = $("#txtPreOTHoursSplit").val();
        var preOTLeave = $("#txtPreOTLeave").val();
        var afterOTHoursSplit = $("#txtAfterOTHoursSplit").val();
        var afterOTLeave = $("#txtAfterOTLeave").val();
        var isPriorityLeave = $("#chkIsPriorityLeave").is(":checked") ? 1 : 0;

        var reason = encodeURIComponent($('#txtReasonW75F4071').val());
        var result = encodeURIComponent($('#txtResultW75F4071').val());


        if (task == "add") {
            link = '{{url("/W75F4071/D75F4071/4/save")}}';
            transid = '';
            if ($("#gridShiftList").pqGrid("option", "dataModel.data").length > 0) {
                var rowData = $("#gridShiftList").pqGrid("getRowData", {rowIndx: 0});
                times = rowData.Times;
            }
            var mode = 0;
        }

        if (task == "edit" || task == "verify") {
            link = '{{url("/W75F4071/D75F4071/4/update")}}';
            if (task == "verify") {
                mode = 2;
            } else {
                var mode = 1;
            }
            if ($("#gridShiftList").pqGrid("option", "dataModel.data").length > 0) {
                var rowData = getRowSelection($("#gridShiftList"));
                transid = rowData.TransID;
                times = rowData.Times;
            }
        }

        wday = EncodeToHtml(wday);
        preOTFrom = EncodeToHtml(preOTFrom);
        preOTTo = EncodeToHtml(preOTTo);
        lastOTFrom = EncodeToHtml(lastOTFrom);
        lastOTTo = EncodeToHtml(lastOTTo);

        //alert(formatNumber($("#txtPreOTHoursSplit").val(),2));
        var preOTHoursSplit = formatNumber($("#txtPreOTHoursSplit").val(), 2);
        var preOTLeave = formatNumber($("#txtPreOTLeave").val(), 2);
        var afterOTHoursSplit = formatNumber($("#txtAfterOTHoursSplit").val(), 2);
        var afterOTLeave = formatNumber($("#txtAfterOTLeave").val(), 2);
        var isPriorityLeave = $("#chkIsPriorityLeave").is(":checked") ? 1 : 0;
        var optIsOTCompany = $("#optIsOTCompany").is(":checked") ? 1 : 0;
        //var optIsNotOTCompany = $("#optIsNotOTCompany").is(":checked") ? 1 : 0;


        var urlparam = 'transid=' + transid + '&time=' + times + '&attdate=' + wday + '&shift=' + shift;
        urlparam += '&preOTFrom=' + preOTFrom + '&preOTTo=' + preOTTo + '&preOTHour=' + prehour + '&afterOTFrom=' + lastOTFrom + '&afterOTTo=' + lastOTTo;
        urlparam += '&afterOTHour=' + afterhour + '&reason=' + reason + '&result=' + result;


        urlparam += '&preOTHoursSplit=' + preOTHoursSplit + '&preOTLeave=' + preOTLeave;
        urlparam += '&afterOTHoursSplit=' + afterOTHoursSplit + '&afterOTLeave=' + afterOTLeave;
        urlparam += '&isPriorityLeave=' + isPriorityLeave;
        urlparam += '&optIsOTCompany=' + optIsOTCompany;
        urlparam += '&mode=' + mode;
        //call page to view report
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            url: link,
            data: urlparam,
            success: function (data) {
                $(".l3loading").addClass('hide');
                console.log(data);
                switch (data.status) {
                    case 0:
                        alert_warning(data.message);
                        break;
                    case 1:
                        save_ok(function () {
                            var rowData = data.rowData;
                            if (Number(rowData.IsSentMail) == 1){ //Neu co gui mail
                                if (Number(rowData.IsShowMailScreen) == 1){ //Neu hien man hinh sendmail
                                    setMailFormValues(rowData);
                                }else{

                                }
                            }

                            if (task == "add") {
                                setMode(1);
                                update4ParamGrid($(document).find("#gridShiftList"), data.rowData, 'add');
                            }

                            if (task == "edit" || task == "verify"){
                                setMode(1);
                                update4ParamGrid($(document).find("#gridShiftList"), data.rowData, 'edit');
                            }

                        });
                        break;
                    case 2:
                        save_not_ok();
                        break;
                }
            }
        });

    });


    function callbackDeleteData() {
        var rowData = getRowSelection($("#gridShiftList"));
        var transid = rowData.TransID;
        var attendanceDate = EncodeToHtml(rowData.AttendanceDate);
        $.ajax({
            method: "POST",
            url: '{{url("/W75F4071/D75F4071/4/delete")}}',
            data: {transid: transid, attendanceDate: attendanceDate},
            success: function (data) {
                switch (data.status) {
                    case 0:
                        alert_warning(data.message);
                        break;
                    case 1:
                        delete_ok(function () {
                            update4ParamGrid($(document).find("#gridShiftList"), null, 'delete');
                            setMode(1);
                        });
                        break;
                    case 2:
                        alert_warning("Error occurred while saving data : " + data.message);
                        break
                }
            }
        });
    }

    $('#txtPreOTHoursSplit, #txtPreOTLeave, #txtAfterOTHoursSplit  , #txtAfterOTLeave').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: 2,
        min: 0,
        max: 100,
        autoGroup: true,
        rightAlign: false,
        oncleared: function () {
            //self.Value('');
        }
    });

    $("#txtPreOTHoursSplit").blur(function () {
        splitPreOTHours(this);
    });

    $("#txtPreOTLeave").blur(function () {
        splitPreOTHours(this);
    });

    $("#txtAfterOTHoursSplit").blur(function () {
        splitPreOTHours(this);
    });

    $("#txtAfterOTLeave").blur(function () {
        splitPreOTHours(this);
    });

    function splitPreOTHours(e) {
        //alert("sdfsf");
        //alert(e.name);
        var lblFirstHourW75F4071 = formatNumber($("#lblFirstHourW75F4071").html(), 2);
        var lblLastHourW75F4071 = formatNumber($("#lblLastHourW75F4071").html(), 2);

        if (e.name == "txtFirstFromW75F4071" || e.name == "txtFirstToW75F4071") {
            $("#txtPreOTHoursSplit").val(lblFirstHourW75F4071);
            $("#txtPreOTHoursSplit").trigger("blur");
        }

        if (e.name == "txtLastFromW75F4071" || e.name == "txtLastToW75F4071") {
            $("#txtAfterOTHoursSplit").val(lblLastHourW75F4071);
            $("#txtAfterOTHoursSplit").trigger("blur");
        }

        var txtPreOTHoursSplit = formatNumber($("#txtPreOTHoursSplit").val(), 2);
        var txtPreOTLeave = formatNumber($("#txtPreOTLeave").val(), 2);

        var txtAfterOTHoursSplit = formatNumber($("#txtAfterOTHoursSplit").val(), 2);
        var txtAfterOTLeave = formatNumber($("#txtAfterOTLeave").val(), 2);


        switch (e.name) {
            case "txtPreOTHoursSplit":
                //caculate the value of txtPreOTLeave
                if (txtPreOTHoursSplit > lblFirstHourW75F4071) {
                    $("#txtPreOTHoursSplit").val(lblFirstHourW75F4071);
                }
                $("#txtPreOTLeave").val(lblFirstHourW75F4071 - txtPreOTHoursSplit);

                break;
            case "txtPreOTLeave":
                //caculate the value of txtPreOTHoursSplit
                if (txtPreOTLeave > lblFirstHourW75F4071) {
                    $("#txtPreOTLeave").val(lblFirstHourW75F4071);
                }
                $("#txtPreOTHoursSplit").val(lblFirstHourW75F4071 - txtPreOTLeave);
                break;
            case "txtAfterOTHoursSplit":
                //caculate the value of txtAfterOTLeave
                if (txtAfterOTHoursSplit > lblLastHourW75F4071) {
                    $("#txtAfterOTHoursSplit").val(lblLastHourW75F4071);
                }
                $("#txtAfterOTLeave").val(lblLastHourW75F4071 - txtAfterOTHoursSplit);
                break;
            case "txtAfterOTLeave":
                //caculate the value of txtAfterOTHoursSplit
                if (txtAfterOTLeave > lblLastHourW75F4071) {
                    $("#txtAfterOTLeave").val(lblLastHourW75F4071);
                }
                $("#txtAfterOTHoursSplit").val(lblLastHourW75F4071 - txtAfterOTLeave);
                break;
        }
    }


</script>

