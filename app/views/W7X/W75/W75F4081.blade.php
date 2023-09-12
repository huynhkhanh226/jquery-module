<style>
    .cls_success {
        padding-top: 20%;
    }
    .modalW75F4081 .modal-open .modal {
        overflow-y: hidden;
    }
</style>
<div class="modal fade modal noneOverflow noUseValidHTML5" id="modalW75F4081" data-keyboard="false"
     data-backdrop="static"
     role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <form class="form-horizontal" id="frmW75F4081" method="post" action="">
                <div class="modal-header">
                    {{Helpers::generateHeading($modalTitle,"W75F4081")}}
                </div>
                <div class="modal-body" style="padding:10px">
                    <div class="row form-group">
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Ngay")}}</label>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2">
                            <div id="DateFromIcon" class="input-group date">
                                <input type="text" class="form-control"
                                       id="txtDateW75F4081"
                                       title="{{Helpers::getRS($g,"Ngay")}}"
                                       name="txtDateW75F4081" value="" required=""><span
                                        class="input-group-addon"><i
                                            class="glyphicon glyphicon-calendar"></i></span>
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
                                       id="lblDateTypeW75F4081"></label>
                            </div>
                            <input type="hidden" id="hdWorkDateTypeIDW75F4081" value=""/>
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
                                       id="lblShiftIDW75F4081"></label>
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
                                       id="lblTimeStartW75F4081"></label>
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
                                       id="lblTimeEndW75F4081"></label>
                            </div>
                        </div>

                    </div>
                    <div class="row form-group">
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Di_treU")}}</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <input type="text" class="form-control text-right noUseValidHTML5 {{$isShowLate == true ? 'hide': ''}}"
                                   id="txtLateMinuteW75F4081"
                                   title=""
                                   maxlength="3"
                                   name="txtLateMinuteW75F4081" value=""
                                    >
                            <select class="form-control text-right noUseValidHTML5 {{$isShowLate == true ? '': 'hide'}}"
                                    id="cbLateMinuteW75F4081" name="cbLateMinuteW75F4081"
                                    placeholder="">
                                    <option value="">--</option>
                                    @for ($i = 0; $i < count($cbAfter); $i++)
                                        <option value="{{$cbAfter[$i]["LateMinute"]}}">{{$cbAfter[$i]["LateMinute"]}}</option>
                                    @endfor
                            </select>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-normal">{{'('.Helpers::getRS($g,"PhutU").')'}}</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Vao")." :"}}</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label id="lblLateTimeInW75F4081" name="lblLateTimeInW75F4081"
                                       class="lbl-value">:</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="checkbox" style="margin-top: -2px">
                                <input type="checkbox" id="chIsApprovedLateW75F4081" name="chIsApprovedLateW75F4081"
                                       disabled="disabled">{{Helpers::getRS($g,"Da_duyet")}}
                            </div>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Ve_somU")}}</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <input type="text" class="form-control text-right noUseValidHTML5 {{$isShowEarly == true ? 'hide': ''}}"
                                   id="txtEarlyMinuteW75F4081"
                                   title=""
                                   maxlength="3"
                                   name="txtEarlyMinuteW75F4081" value=""
                                    >
                            <select class="form-control text-right noUseValidHTML5 {{$isShowEarly == true ? '': 'hide'}}"
                                    id="cbEarlyMinuteW75F4081" name="cbEarlyMinuteW75F4081"
                                    placeholder="">
                                    <option value="">--</option>
                                    @for ($i = 0; $i < count($cbEarly); $i++)
                                        <option value="{{$cbEarly[$i]["EarlyMinute"]}}">{{$cbEarly[$i]["EarlyMinute"]}}</option>
                                    @endfor
                            </select>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-normal">{{'('.Helpers::getRS($g,"PhutU").')'}}</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Ra")." :"}}</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label id="lblEarlyTimeOutW75F4081" name="lblEarlyTimeOutW75F4081"
                                       class="lbl-value">:</label>
                            </div>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="checkbox" style="margin-top: -2px">
                                <input type="checkbox" id="chIsApprovedEarlyW75F4081" name="chIsApprovedEarlyW75F4081"
                                       disabled="disabled">{{Helpers::getRS($g,"Da_duyet")}}
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Ly_do")}}</label>
                            </div>
                        </div>
                        <div class="col-md-11 col-xs-11">
                            <textarea id="txtReasonW75F4081" name="txtReasonW75F4081" title="{{Helpers::getRS($g,"Ly_do")}}" rows="3" style="width:100%"></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12 col-xs-12 ">
                            <button type="button" id="frm_btnAdd"
                                    class="btn btn-default smallbtn pull-left mgr5" title="{{Helpers::getRS($g,"Them_moi1")}}">
                                <span class="glyphicon glyphicon-plus "></span> {{Helpers::getRS($g,"Them_moi1")}}
                            </button>

                            <button type="button" id="frm_btnEdit" title="" class="btn btn-default smallbtn pull-left mgr5 hide">
                                <span class="glyphicon glyphicon-edit mgr5"></span> {{Helpers::getRS($g,"Sua")}}
                            </button>

                            <button type="button" id="frm_btnDelete"
                                    class="btn btn-default smallbtn pull-left confirmation-Delete mgr5 hide">
                                <span class="glyphicon glyphicon-bin text-black mgr5"></span> {{Helpers::getRS($g,"Xoa")}}
                            </button>

                            <button type="button" id="frm_btnNotSave"
                                    class="btn btn-default smallbtn pull-right"
                                    title="{{Helpers::getRS($g,"Khong_luu")}}"
                                    ><span
                                        class="glyphicon glyphicon-floppy-remove  mgr5"></span>{{Helpers::getRS($g,"Khong_luu")}}
                            </button>

                            <button type="button" id="frm_btnSave"
                                    class="btn btn-default smallbtn pull-right mgr5  "
                                    title="{{Helpers::getRS($g,"Luu")}}"
                                    ><span
                                        class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                            </button>

                            <button type="button" id="frm_btnSendmail"
                                    class="btn btn-default smallbtn pull-right mgr5 hide"
                                    title="{{Helpers::getRS($g,"Gui_mail")}}"
                                    ><span
                                        class="fa fa-envelope-o mgr5 text-primary"></span> {{Helpers::getRS($g,"Gui_mail")}}
                            </button>

                        </div>

                    </div>
                    <div class="row form-group">
                        <div class="col-md-12 col-xs-12">
                            <div id="gridShiftList"></div>
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
    var obj = {
        width: '100%',
        numberCell: {show: false},
        height: $("#modalW75F4081").find('.modal-content').height() - 248,
        //resizable: true,
        showTitle: false,
        collapsible: false,
        selectionModel: {type: 'row', mode: 'single'},
        //filterModel: {on: true, mode: "AND", header: true},
        //scrollModel: {autoFit: false},
        scrollModel:{ horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none' },
        rowBorders: true,
        columnBorders: true,
        postRenderInterval: -1,
        //freezeCols: 1,
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
            title: "", editable: false, minWidth: 60, sortable: false, align: "center", render: function (ui) {
            var row = ui.rowData;
            var str = "";

            str += "<a title='{{Helpers::getRS($g,"Sua")}}' id='btnEditW75F4070'><i class='glyphicon glyphicon-edit text-orange' style='padding-right:5px'></i></a> ";

            var lateStatus = row.LateStatus;
            var earlyStatus = row.EarlyStatus;
            //console.log(lateStatus == 1 ||  earlyStatus == 1);
            if (lateStatus == 1 ||  earlyStatus == 1) {
                str += "<a title='{{Helpers::getRS($g,"Xoa")}}' id='btnDeleteW75F4070Disable'><i class='fa fa-trash text-gray' style=';cursor:default'></i></a> ";
            } else {
                str += "<a title='{{Helpers::getRS($g,"Xoa")}}' id='btnDeleteW75F4070'><i class='fa fa-trash' ></i></a> ";
            }
            return str;
        },
            postRender: function (ui) {
                var rowIndx = ui.rowIndx,
                        gridShiftList = this,
                        $cell = gridShiftList.getCell(ui);
                //add button
                $cell.find("a#btnEditW75F4070")
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
                $cell.find("a#btnDeleteW75F4070")
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
            title: '{{Helpers::getRS($g,"Lan")}}',
            minWidth: 20,
            width: 55,
            dataType: "string",
            editor: false,
            align: "center",
            dataIndx: "Times",
            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '{{Helpers::getRS($g,"Ngay")}}',
            minWidth: 20,
            width: 80,
            dataType: "date",
            editor: false,
            align: "center",
            dataIndx: "AttendanceDate",
            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '{{Helpers::getRS($g,"Ca")}}',
            minWidth: 20,
            width: 70,
            dataType: "string",
            editor: false,
            align: "left",
            dataIndx: "ShiftID",
            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '{{Helpers::getRS($g,"Vao")}}',
            minWidth: 20,
            width: 45,
            dataType: "string",
            editor: false,
            align: "center",
            dataIndx: "TimeStart",
            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '{{Helpers::getRS($g,"Ra")}}',
            minWidth: 20,
            width: 45,
            dataType: "string",
            editor: false,
            align: "center",
            dataIndx: "TimeEnd",
            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '{{Helpers::getRS($g,"Di_treU")}}', width: 140, align: "center",
            colModel: [
                {
                    title: '{{Helpers::getRS($g,"PhutU")}}',
                    minWidth: 20,
                    width: 60,
                    dataType: "string",
                    editor: false,
                    align: "right",
                    dataIndx: "LateMinute",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: '{{Helpers::getRS($g,"Vao")}}',
                    minWidth: 20,
                    width: 60,
                    dataType: "string",
                    editor: false,
                    align: "center",
                    dataIndx: "LateTimeIn",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: '{{Helpers::getRS($g,"Trang_thai")}}',
                    minWidth: 20,
                    width: 80,
                    dataType: "string",
                    editor: false,
                    align: "center",
                    dataIndx: "LateStatusName",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
            ]
        },
        {
            title: '{{Helpers::getRS($g,"Ve_somU")}}', width: 140, align: "center",
            colModel: [
                {
                    title: '{{Helpers::getRS($g,"PhutU")}}',
                    minWidth: 20,
                    width: 60,
                    dataType: "string",
                    editor: false,
                    align: "right",
                    dataIndx: "EarlyMinute",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: '{{Helpers::getRS($g,"Ra")}}',
                    minWidth: 20,
                    width: 60,
                    dataType: "string",
                    editor: false,
                    align: "center",
                    dataIndx: "EarLyTimeOut",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: '{{Helpers::getRS($g,"Trang_thai")}}',
                    minWidth: 20,
                    width: 80,
                    dataType: "string",
                    editor: false,
                    align: "center",
                    dataIndx: "EarlyStatusName",
                    filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
            ]
        },
        {
            title: '{{Helpers::getRS($g,"Ly_do")}}',
            minWidth: 110,
            width: 270,
            dataType: "string",
            editor: false,
            align: "left",
            dataIndx: "Reason",
            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '{{Helpers::getRS($g,"Ghi_chu")}}',
            minWidth: 110,
            width: 270,
            dataType: "string",
            editor: false,
            align: "left",
            dataIndx: "Note",
            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
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
            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '',
            minWidth: 20,
            width: 100,
            dataType: "string",
            editor: false,
            align: "left",
            hidden: true,
            dataIndx: "LateStatus",
            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: '',
            minWidth: 20,
            width: 100,
            dataType: "string",
            editor: false,
            align: "left",
            hidden: true,
            dataIndx: "EarlyStatus",
            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
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
        }, 300);

        var tranMonth = {{Session::get("W91P0000")['HRTranMonth']}};
        var tranYear = {{Session::get("W91P0000")['HRTranYear']}};
        var daysInMonth = new Date(tranYear, tranMonth, 0).getDate()
        $('#txtDateW75F4081').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            startDate: '{{date($AttPeriodFrom.'/'.$monthPeriod.'/Y')}}',
            endDate: '{{date($AttPeriodTo.'/'.$tranmonth.'/Y')}}',
        }).on('changeDate', function (ev) {
            setText();
        });

        $("#modalW75F4081").find(".glyphicon-calendar").on('click',function(){
            if ($('#txtDateW75F4081').is(':disabled') == false){
                $('#txtDateW75F4081').datepicker('show');
            }
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
                onRowSelect(rowData, 1);
            });
        });

        $("#frm_btnSendmail").click(function (event) {
            console.log('frm_btnSendmail');
            var rowData = getRowSelection($("#gridShiftList"));
            setMailFormValues(rowData);
        });



        function closePopSendMail(){
            $("#mPopUpSendMail").find("#hdFrom").val('');
            $("#mPopUpSendMail").find("#txtEmailReceivedAddress").val('');
            $("#mPopUpSendMail").find("#txtEmailCCAddress").val('');
            $("#mPopUpSendMail").find("#txtEmailBCCAddress").val('');
            $("#mPopUpSendMail").find("#txtEmailTitle").val('');
            $("#mPopUpSendMail").find("#txtEmailContent").html('');
            CKEDITOR.instances.txtEmailContent.setData('');
            $("#mPopUpSendMail").modal('hide');
        }


        $("#cbLateMinuteW75F4081").change(function () {
            CalLateEarly(1);
        });

        $("#txtLateMinuteW75F4081").change(function () {
            CalLateEarly( 1);
        });

        $("#cbEarlyMinuteW75F4081").change(function () {
           CalLateEarly( 2);
        });

        $("#txtEarlyMinuteW75F4081").change(function () {
            CalLateEarly(2);
        });

        gridShiftList.pqGrid({
            complete: function (event, ui) {
                console.log('complete');
                if ($("#gridShiftList").pqGrid("option", "dataModel.data").length > 0) {
                    $("#gridShiftList").pqGrid("setSelection", {rowIndx: 0});
                    //setMode(1);
                    var rowData = getRowSelection($("#gridShiftList"));
                    onRowSelect(rowData, 1);
                    //setMode(1)
                } else {
                    //$("#frm_btnAdd").trigger('click');
                    setMode(1)
                }
            }
        });

    });

    function setMailFormValues(rowData){
        if (rowData != null){
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
    
    function setText() {
        $('#lblDateTypeW75F4081').html('');
        $('#hdWorkDateTypeIDW75F4081').val('');
        $('#lblShiftIDW75F4081').html('');
        $('#lblTimeStartW75F4081').html('');
        $('#lblTimeEndW75F4081').html('');
        if (task !=''){//truong hop ma them hoac sua thi moi tinh lai
            $.ajax({
                method: "POST",
                url: '{{url("/W75F4081/D75F4081/4/settext")}}',
                data: {wokingDate: EncodeToHtml($("#txtDateW75F4081").val())},
                success: function (data) {
                    //$(".l3loading").addClass('hide');
                    var rs = JSON.parse(data);
                    console.log(rs);
                    var dataRs = rs['data'];
                    switch(rs['status']){
                        case "STOP":
                            alert_warning(dataRs, function () {
                                $("#txtDateW75F4081").val("");
                                $('#lblDateTypeW75F4081').html('');
                                $('#hdWorkDateTypeIDW75F4081').val('');
                                $('#lblShiftIDW75F4081').html('');
                                $('#lblTimeStartW75F4081').html('');
                                $('#lblTimeEndW75F4081').html('');

                                var lateValue = '{{$isShowLate}}' == true ? $("#cbLateMinuteW75F4081").val() : $("#txtLateMinuteW75F4081").val();
                                if (lateValue != ''){
                                    CalLateEarly( 1);
                                }

                                var earlyValue = '{{$isShowEarly}}' == true ? $("#cbEarlyMinuteW75F4081").val() : $("#txtEarlyMinuteW75F4081").val();
                                if (earlyValue != ''){
                                    CalLateEarly( 2);
                                }
                            });
                            break;
                        case "SUCCESS":
                            if (dataRs.ShiftID == ""  && task != ''){
                                alert_warning("{{Helpers::getRS($g,'Ngay_dang_ky_khong_co_ca_Ban_vui_long_chon_ngay_khac')}}",function(){
                                    $("#txtDateW75F4081").val("");
                                    $('#lblDateTypeW75F4081').html('');
                                    $('#hdWorkDateTypeIDW75F4081').val('');
                                    $('#lblShiftIDW75F4081').html('');
                                    $('#lblTimeStartW75F4081').html('');
                                    $('#lblTimeEndW75F4081').html('');

                                    var lateValue = '{{$isShowLate}}' == true ? $("#cbLateMinuteW75F4081").val() : $("#txtLateMinuteW75F4081").val();
                                    if (lateValue != ''){
                                        CalLateEarly( 1);
                                    }

                                    var earlyValue = '{{$isShowEarly}}' == true ? $("#cbEarlyMinuteW75F4081").val() : $("#txtEarlyMinuteW75F4081").val();
                                    if (earlyValue != ''){
                                        CalLateEarly( 2);
                                    }
                                });
                            }else{
                                $('#lblDateTypeW75F4081').html(dataRs.WorkDayTypeName);
                                $('#hdWorkDateTypeIDW75F4081').val(dataRs.WorkDayType);
                                $('#lblShiftIDW75F4081').html(dataRs.ShiftID);
                                $('#lblTimeStartW75F4081').html(dataRs.TimeStart);
                                $('#lblTimeEndW75F4081').html(dataRs.TimeEnd);

                                var lateValue = '{{$isShowLate}}' == true ? $("#cbLateMinuteW75F4081").val() : $("#txtLateMinuteW75F4081").val();
                                if (lateValue != ''){
                                    CalLateEarly( 1);
                                }
                                var earlyValue = '{{$isShowEarly}}' == true ? $("#cbEarlyMinuteW75F4081").val() : $("#txtEarlyMinuteW75F4081").val();
                                if (earlyValue != ''){
                                    CalLateEarly( 2);
                                }
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
        $('#lblDateTypeW75F4081').html('');
        $('#hdWorkDateTypeIDW75F4081').val('');
        $('#lblShiftIDW75F4081').html('');
        $('#lblTimeStartW75F4081').html('');
        $('#lblTimeEndW75F4081').html('');
        //$(".l3loading").removeClass('hide');
        if (task !=''){//truong hop ma them hoac sua thi moi tinh lai
            $.ajax({
                method: "POST",
                url: '{{--{{url("/W75F4081/D75F4081/4/settext")}}--}}',
                data: {wokingDate: EncodeToHtml($("#txtDateW75F4081").val())},
                success: function (data) {
                    //$(".l3loading").addClass('hide');
                    if (data.length > 0) {
                        console.log('settext');

                        if (data[0].ShiftID == ""  && task != ''){
                            alert_warning("{{--{{Helpers::getRS($g,'Ngay_dang_ky_khong_co_ca_Ban_vui_long_chon_ngay_khac')}}--}}",function(){
                                $("#txtDateW75F4081").val("");
                                $('#lblDateTypeW75F4081').html('');
                                $('#hdWorkDateTypeIDW75F4081').val('');
                                $('#lblShiftIDW75F4081').html('');
                                $('#lblTimeStartW75F4081').html('');
                                $('#lblTimeEndW75F4081').html('');

                                var lateValue = '{{--{{$isShowLate}}--}}' == true ? $("#cbLateMinuteW75F4081").val() : $("#txtLateMinuteW75F4081").val();
                                if (lateValue != ''){
                                    CalLateEarly( 1);
                                }

                                var earlyValue = '{{--{{$isShowEarly}}--}}' == true ? $("#cbEarlyMinuteW75F4081").val() : $("#txtEarlyMinuteW75F4081").val();
                                if (earlyValue != ''){
                                    CalLateEarly( 2);
                                }
                            });
                        }else{
                            $('#lblDateTypeW75F4081').html(data[0].WorkDayTypeName);
                            $('#hdWorkDateTypeIDW75F4081').val(data[0].WorkDayType);
                            $('#lblShiftIDW75F4081').html(data[0].ShiftID);
                            $('#lblTimeStartW75F4081').html(data[0].TimeStart);
                            $('#lblTimeEndW75F4081').html(data[0].TimeEnd);

                            var lateValue = '{{--{{$isShowLate}}--}}' == true ? $("#cbLateMinuteW75F4081").val() : $("#txtLateMinuteW75F4081").val();
                            if (lateValue != ''){
                                CalLateEarly( 1);
                            }
                            var earlyValue = '{{--{{$isShowEarly}}--}}' == true ? $("#cbEarlyMinuteW75F4081").val() : $("#txtEarlyMinuteW75F4081").val();
                            if (earlyValue != ''){
                                CalLateEarly( 2);
                            }
                        }
                    }




                }
            });
        }

    }*/
    function resetText() {
        $("#txtDateW75F4081").val("");
        $('#lblDateTypeW75F4081').html("");
        $('#hdWorkDateTypeIDW75F4081').val('');
        $('#lblShiftIDW75F4081').html("");
        $('#lblTimeStartW75F4081').html("");
        $('#lblTimeEndW75F4081').html("");

        $("#txtLateMinuteW75F4081").val("");
        $("#cbLateMinuteW75F4081").val("");
        $("#lblLateTimeInW75F4081").html(":");

        $("#txtEarlyMinuteW75F4081").val("");
        $("#cbEarlyMinuteW75F4081").val("");
        $("#lblEarlyTimeOutW75F4081").html(":");

        $("#txtReasonW75F4081").val("");

        $("#chIsApprovedLateW75F4081").prop("checked", false);
        $("#chIsApprovedEarlyW75F4081").prop("checked", false);

        $("txtDateW75F4081").focus();
    }

    function setMode(mode) {
        //mode = 0 is add
        //mode = 1 view
        //mode = 3 edit
        var bCount = $("#gridShiftList").pqGrid("option", "dataModel.data").length > 0;
        if (mode == 0) {//add
            $('input[name="txtDateW75F4081"]').attr('disabled', false);

            $('input[name="txtLateMinuteW75F4081"]').attr('disabled', false);
            $('input[name="txtEarlyMinuteW75F4081"]').attr('disabled', false);
            $('#cbLateMinuteW75F4081').attr('disabled', false);
            $('#cbEarlyMinuteW75F4081').attr('disabled', false);

            $('textarea[name="txtReasonW75F4081"]').attr('disabled', false);

            $('button[id="frm_btnAdd"]').attr('disabled', true);
            $('button[id="frm_btnSave"]').attr('disabled', false);
            $('button[id="frm_btnNotSave"]').attr('disabled', false);
            $('button[id="frm_btnSendmail"]').attr('disabled', true);
            task = "add";
            $("#gridShiftList").pqGrid("disable");
        }
        if (mode == 1) {//view
            $('input[name="txtDateW75F4081"]').attr('disabled', true);
            $('input[name="txtLateMinuteW75F4081"]').attr('disabled', true);
            $('input[name="txtEarlyMinuteW75F4081"]').attr('disabled', true);
            $('#cbLateMinuteW75F4081').attr('disabled', true);
            $('#cbEarlyMinuteW75F4081').attr('disabled', true);
            $('textarea[name="txtReasonW75F4081"]').attr('disabled', true);

            $('button[id="frm_btnAdd"]').attr('disabled', false);
            $('button[id="frm_btnSave"]').attr('disabled', true);
            $('button[id="frm_btnNotSave"]').attr('disabled', true);
            $('button[id="frm_btnSendmail"]').attr('disabled', false);
            var bTemp = $('button[id="frm_btnSendmail"]').is(':enabled') && bCount;
            $('button[id="frm_btnSendmail"]').attr('disabled', !bTemp);
            task = "";
            $("#gridShiftList").pqGrid("enable");
        }
        if (mode == 2) {//edit
            $('input[name="txtDateW75F4081"]').attr('disabled', true);
            var rowData = getRowSelection($("#gridShiftList"));
            $('input[name="txtLateMinuteW75F4081"]').attr('disabled', rowData.LateStatus == 1);
            $('input[name="txtEarlyMinuteW75F4081"]').attr('disabled', rowData.EarlyStatus == 1);
            $('#cbLateMinuteW75F4081').attr('disabled', rowData.LateStatus == 1);
            $('#cbEarlyMinuteW75F4081').attr('disabled', rowData.EarlyStatus == 1);

            $('textarea[name="txtReasonW75F4081"]').attr('disabled', false);
            $('button[id="frm_btnAdd"]').attr('disabled', true);
            $('button[id="frm_btnSave"]').attr('disabled', false);
            $('button[id="frm_btnNotSave"]').attr('disabled', false);
            $('button[id="frm_btnSendmail"]').attr('disabled', true);
            task = "edit";
            $("#gridShiftList").pqGrid("disable");
        }
    }


    function CalLateEarly(bLast) {
        console.log('CalLateEarly');
        var valFrom;
        var timestart;
        console.log('CalLateEarly');
        if (bLast == 1) { //Đi trễ
            valFrom = '{{$isShowLate}}' == true ?  $("#cbLateMinuteW75F4081").val() :  $("#txtLateMinuteW75F4081").val();
            timestart = $('#lblTimeStartW75F4081').html();
            var vhour = ":";
            if (valFrom != ""){
                var vTime = new Date(2000, 0, 1, timestart.substr(0, 2), timestart.substr(3, 2))
                av = new Date(vTime.getTime() + valFrom * 60000);
                vhour = pad(av.getHours(), 2) + ":" + pad(av.getMinutes(), 2);
            }
            if (timestart == "")
                vhour = ":";
            $('#lblLateTimeInW75F4081').html(vhour);
        }
        else { //Về sớm
            valFrom = '{{$isShowEarly}}' == true ?  $("#cbEarlyMinuteW75F4081").val() : $("#txtEarlyMinuteW75F4081").val();
            timestart = $('#lblTimeEndW75F4081').html();
            var vhour = ":";
            if (valFrom != ""){
                var vTime = new Date(2000, 0, 1, timestart.substr(0, 2), timestart.substr(3, 2))
                av = new Date(vTime.getTime() - valFrom * 60000);
                vhour = pad(av.getHours(), 2) + ":" + pad(av.getMinutes(), 2);
            }

            if (timestart == "")
                vhour = ":";
            $('#lblEarlyTimeOutW75F4081').html(vhour);
        }

    }
    function onRowSelect(rowData, mode) {
        if (rowData == null) {
            $("#modalW75F4081").find("#txtDateW75F4081").datepicker('setDate', '');

            $("#modalW75F4081").find("#txtLateMinuteW75F4081").val('');
            $("#modalW75F4081").find("#txtEarlyMinuteW75F4081").val('');
            $("#modalW75F4081").find("#cbLateMinuteW75F4081").val('');
            $("#modalW75F4081").find("#cbEarlyMinuteW75F4081").val('');

            $("#modalW75F4081").find("#lblLateTimeInW75F4081").html(':');
            $("#modalW75F4081").find("#lblEarlyTimeOutW75F4081").html(':');

            $("#modalW75F4081").find("#txtReasonW75F4081").val('');
            $("#modalW75F4081").find('#chIsApprovedLateW75F4081').prop("checked", false);
            $("#modalW75F4081").find('#chIsApprovedEarlyW75F4081').prop("checked", false);

            $("#modalW75F4081").find("#lblDateTypeW75F4081").html('');
            $("#modalW75F4081").find("#hdWorkDateTypeIDW75F4081").val('');
            $("#modalW75F4081").find("#lblShiftIDW75F4081").html('');
            $("#modalW75F4081").find("#lblTimeStartW75F4081").html('');
            $("#modalW75F4081").find("#lblTimeEndW75F4081").html('');

        } else {
            $("#modalW75F4081").find("#txtDateW75F4081").datepicker('setDate', rowData.AttendanceDate);
            $("#modalW75F4081").find("#txtLateMinuteW75F4081").val(rowData.LateMinute);
            $("#modalW75F4081").find("#txtEarlyMinuteW75F4081").val(rowData.EarlyMinute);
            $("#modalW75F4081").find("#cbLateMinuteW75F4081").val(rowData.LateMinute);
            $("#modalW75F4081").find("#cbEarlyMinuteW75F4081").val(rowData.EarlyMinute);
            $("#modalW75F4081").find("#lblLateTimeInW75F4081").html(rowData.LateTimeIn);
            $("#modalW75F4081").find("#lblEarlyTimeOutW75F4081").html(rowData.EarLyTimeOut);

            $("#modalW75F4081").find("#txtReasonW75F4081").val(rowData.Reason);
            console.log('rowData');
            $("#modalW75F4081").find('#chIsApprovedLateW75F4081').prop("checked", rowData.LateStatus == 1);
            $("#modalW75F4081").find('#chIsApprovedEarlyW75F4081').prop("checked", rowData.EarlyStatus == 1);

            $("#modalW75F4081").find("#lblDateTypeW75F4081").html(rowData.WorkDayTypeName);
            $("#modalW75F4081").find("#hdWorkDateTypeIDW75F4081").val(rowData.WorkDayType);
            $("#modalW75F4081").find("#lblShiftIDW75F4081").html(rowData.ShiftID);
            $("#modalW75F4081").find("#lblTimeStartW75F4081").html(rowData.TimeStart);
            $("#modalW75F4081").find("#lblTimeEndW75F4081").html(rowData.TimeEnd);





        }
        setMode(mode);
    }


    function allowSave() {
        console.log('test');
        var wday = $("#txtDateW75F4081");
        //var latemin = $("#txtLateMinuteW75F4081");
        //var earlymin = $("#txtEarlyMinuteW75F4081");
        
        var latemin =  '{{$isShowLate}}' == true ? $("#cbLateMinuteW75F4081") : $("#txtLateMinuteW75F4081");
        var earlymin = '{{$isShowEarly}}' == true ? $("#cbEarlyMinuteW75F4081") : $("#txtEarlyMinuteW75F4081");
        wday.get(0).setCustomValidity("");
        latemin.get(0).setCustomValidity("");
        earlymin.get(0).setCustomValidity("");



        if (wday.val() == "") {
            wday.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Ngay')}}");
            $("#modalW75F4081").find('#frm_hbtnSave').click();
            wday.focus();
            return;
        }

        if (latemin.val() == '' && earlymin.val() == '') {
            latemin.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Thoi_gian')}}");
            $("#modalW75F4081").find('#frm_hbtnSave').click();
            latemin.focus();
            return;
        }

        if ((latemin.val() != '') && (latemin.val() <= 1 || latemin.val() >240)) {
            latemin.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'So_phut').' [1->240]'}}");
            //latemin.val('');
            $("#modalW75F4081").find('#frm_hbtnSave').click();
            latemin.focus();
            return;
        }

        if ((earlymin.val() != '') && (earlymin.val() <= 1 || earlymin.val() >240)) {
            earlymin.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'So_phut').' [1->240]'}}");
            //earlymin.val('');
            $("#modalW75F4081").find('#frm_hbtnSave').click();
            earlymin.focus();
            return;
        }

        $("#modalW75F4081").find('#frm_hbtnSave').click();

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
    $("#modalW75F4081").on('submit', '#frmW75F4081', function (e) {
        e.preventDefault();
        var link;
        var times = 0;
        var wday = $("#txtDateW75F4081").val();
        //var lateMin = $("#txtLateMinuteW75F4081").val();
        var lateMin = '{{$isShowLate}}' == true ? $("#cbLateMinuteW75F4081").val() : $("#txtLateMinuteW75F4081").val();
        var lateTimeIn = $("#lblLateTimeInW75F4081").html();
        var shiftID = $('#lblShiftIDW75F4081').html();
        //var earlyMin = $('#txtEarlyMinuteW75F4081').val();
        var earlyMin = '{{$isShowEarly}}' == true ? $('#cbEarlyMinuteW75F4081').val() : $('#txtEarlyMinuteW75F4081').val();
        var earlyTimeout = $('#lblEarlyTimeOutW75F4081').html();
        var reason = encodeURIComponent($('#txtReasonW75F4081').val());
        var isApprovedLate = $("#modalW75F4081").find('#chIsApprovedLateW75F4081').is('checked');
        var isApprovedEarly = $("#modalW75F4081").find('#chIsApprovedEarlyW75F4081').is('checked');

        if (task == "add") {
            link = '{{url("/W75F4081/D75F4081/4/save")}}';
            if ($("#gridShiftList").pqGrid("option", "dataModel.data").length > 0) {
                var rowData = $("#gridShiftList").pqGrid("getRowData", {rowIndx: 0});
                times = rowData.Times;
            }

        }

        if (task == "edit") {
            link = '{{url("/W75F4081/D75F4081/4/update")}}';
            if ($("#gridShiftList").pqGrid("option", "dataModel.data").length > 0) {
                var rowData = getRowSelection($("#gridShiftList"));
                times = rowData.Times;
            }
        }
        wday = EncodeToHtml(wday);
        //lateMin = EncodeToHtml(lateMin);
        lateTimeIn = EncodeToHtml(lateTimeIn);
        //earlyMin = EncodeToHtml(earlyMin);
        earlyTimeout = EncodeToHtml(earlyTimeout);

        var urlparam = 'times=' + times + '&wday=' + wday + '&shiftID=' + shiftID;
        urlparam += '&lateMin=' + lateMin + '&lateTimeIn=' + lateTimeIn + '&earlyMin=' + earlyMin + '&earlyTimeout=' + earlyTimeout + '&reason=' + reason;
        urlparam += '&isApprovedLate=' + isApprovedLate + '&isApprovedEarly=' + isApprovedEarly ;
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
                            console.log(data.rowData);
                            var rowData = data.rowData;
                            if (Number(rowData.IsSentMail) == 1){ //Neu co gui mail
                                if (Number(rowData.IsShowMailScreen) == 1){ //Neu hien man hinh sendmail
                                    setMailFormValues(rowData);
                                }else{

                                }
                            }
                            if (task == "add")
                                update4ParamGrid($(document).find("#gridShiftList"), data.rowData, 'add');
                            if (task == "edit")
                                update4ParamGrid($(document).find("#gridShiftList"), data.rowData, 'edit');
                            setMode(1);
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
        var wday = rowData.AttendanceDate;
        var times = rowData.Times;
        var shiftID = $("#lblShiftIDW75F4081").html();
        $(".l3loading").removeClass('hide');
        $.ajax({
            method: "POST",
            url: '{{url("/W75F4081/D75F4081/4/delete")}}',
            data: {times: times, wday: wday, shiftID:shiftID},
            success: function (data) {
                $(".l3loading").addClass('hide');
                if (data == 1) {
                    delete_ok(function(){
                        update4ParamGrid($(document).find("#gridShiftList"), null, 'delete');
                    });
                }
                else {
                    alert_warning("Error occurred while saving data.");
                }
            }
        });
    }

    $('#txtLateMinuteW75F4081, #txtEarlyMinuteW75F4081').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: 0,
        //min:0,
        //max:240,
        autoGroup: true,
        rightAlign: false
    });
</script>

