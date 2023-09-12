<div class="modal fade modal noneOverflow" id="modalW09F2020" data-keyboard="false" data-backdrop="static"
     role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <form id="frmW09F2020" name="frmW09F2020" method="post" style="height: 500px;">
                <div class="modal-header">
                    {{Helpers::generateHeading($modalTitle,"W09F2020")}}
                </div>
                <div id="divScrollbarW09F2020">
                    <div class="modal-body" style="padding:10px">
                    <fieldset class="mgt5">
                        <legend class="legend">{{Helpers::getRS($g,"Thong_tin_chung")}}</legend>
                        <div class="row form-group">
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Ma_nhan_vien")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <label>{{isset($employeeInfo[0]['EmployeeID']) ? $employeeInfo[0]['EmployeeID'] : ''}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Phong_ban")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <label>{{isset($employeeInfo[0]['DePartmentName']) ? $employeeInfo[0]['DePartmentName'] : ''}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Chuc_vu")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <label>{{isset($employeeInfo[0]['DutyName']) ? $employeeInfo[0]['DutyName'] : ''}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Ten_nhan_vien")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <label>{{isset($employeeInfo[0]['EmployeeName']) ? $employeeInfo[0]['EmployeeName'] : ''}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_vao_lam")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <label>{{isset($employeeInfo[0]['DateJoined']) ? $employeeInfo[0]['DateJoined'] : ''}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Tham_nien_lam_viec")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <div class="row">
                                            <div class="col-md-3 col-xs-3">
                                                <label>{{isset($employeeInfo[0]['SeniorWorkYear']) ? $employeeInfo[0]['SeniorWorkYear'] : ''}}</label>
                                            </div>
                                            <div class="col-md-3 col-xs-3">
                                                <label class="lbl-normal">{{Helpers::getRS($g,"Nam")}}</label>
                                            </div>
                                            <div class="col-md-3 col-xs-3">
                                                <label>{{isset($employeeInfo[0]['SeniorWorkMonth']) ? $employeeInfo[0]['SeniorWorkMonth'] : ''}}</label>
                                            </div>
                                            <div class="col-md-3 col-xs-3">
                                                <label class="lbl-normal">{{Helpers::getRS($g,"Thang")}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Loai_hop_dong")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <label>{{isset($employeeInfo[0]['WorkFormName']) ? $employeeInfo[0]['WorkFormName'] : ''}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Tham_nien_huong_tro_cap_thoi_viec")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <div class="row">
                                            <div class="col-md-3 col-xs-3">
                                                <label>{{isset($employeeInfo[0]['SeniorityYear']) ? $employeeInfo[0]['SeniorityYear'] : ''}}</label>
                                            </div>
                                            <div class="col-md-3 col-xs-3">
                                                <label class="lbl-normal">{{Helpers::getRS($g,"Nam")}}</label>
                                            </div>
                                            <div class="col-md-3 col-xs-3">
                                                <label style="text-align: right">{{isset($employeeInfo[0]['SeniorityMonth']) ? $employeeInfo[0]['SeniorityMonth'] : ''}}</label>
                                            </div>
                                            <div class="col-md-3 col-xs-3">
                                                <label class="lbl-normal">{{Helpers::getRS($g,"Thang")}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"So_thang_huong_tro_cap")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <label>{{isset($employeeInfo[0]['SeverancePayMonthNum']) ? $employeeInfo[0]['SeverancePayMonthNum'] : ''}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4 col-xs-4">
                                <div class="row">
                                    <div class="col-md-5 col-xs-5">
                                        <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_het_han_hop_dong")}}</label>
                                    </div>
                                    <div class="col-md-7 col-xs-7">
                                        <label>{{isset($employeeInfo[0]['ContractDateEnd']) ? $employeeInfo[0]['ContractDateEnd'] : ''}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="mgt5">
                        <legend class="legend">{{Helpers::getRS($g,"Thong_tin_xin_nghi")}}</legend>
                        <div class="row form-group">
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_du_kien_nghi")}}</label>
                            </div>
                            <div class="col-md-3 col-xs-3">
                                <div id="calenderW092020" class="input-group ">
                                    <input type="text" class="form-control" id="txtDateLeftW092020"
                                           name="txtDateLeftW092020" value="" required>
                                    <span class="input-group-addon"><i onclick="triggerDate()"
                                                                       class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                            <div class="col-md-7 col-xs-7">
                                <div class="row">
                                    <div class="col-md-8 col-xs-8">
                                        <div class="row">
                                            <div class="col-md-5 col-xs-5">
                                                <label class="lbl-normal">{{Helpers::getRS($g,"Ngay_bao_nghi")}}</label>
                                            </div>
                                            <div class="col-md-7 col-xs-7">
                                                <div class="input-group ">
                                                    <input type="text" class="form-control" id="txtNoticeDateW092020"
                                                           name="txtNoticeDateW092020" value="{{date('d/m/Y')}}" required>
                                                    <span class="input-group-addon"><i onclick="triggerDate1()"
                                                                                       class="glyphicon glyphicon-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-4">
                                        <div class="row">
                                            <div class="col-md-7 col-xs-7">
                                                <label class="lbl-normal">{{Helpers::getRS($g,"So_ngay_bao_truoc")}}</label>
                                            </div>
                                            <div class="col-md-5 col-xs-5">
                                                <input type="number" class="form-control" id="txtDateNumberW092020"
                                                       name="txtDateNumberW092020" value="" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Ly_do")}}</label>
                            </div>
                            <div class="col-md-10 col-xs-10">
                                         <textarea class="form-control" id="txtReasonW092020" rows="6"
                                                   name="txtReasonW092020" required></textarea>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2 col-xs-2">
                                <label class="lbl-normal">{{Helpers::getRS($g,"Ghi_chu")}}</label>
                            </div>
                            <div class="col-md-10 col-xs-10">
                                <input type="text" class="form-control" id="txtNotesW092020" name="txtNotesW092020">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 col-xs-12 ">
                                <button type="button" id="frm_btnAdd"
                                        class="btn btn-default smallbtn pull-left mgr5"
                                        title="{{Helpers::getRS($g,"Them_moi1")}}">
                                    <span class="glyphicon glyphicon-plus "></span> {{Helpers::getRS($g,"Them_moi1")}}
                                </button>
                                <button type="button" id="frm_btnNotSave"
                                        class="btn btn-default smallbtn pull-right"
                                        title="{{Helpers::getRS($g,"Khong_luu")}}"
                                ><span
                                            class="glyphicon glyphicon-floppy-remove  mgr5"></span>{{Helpers::getRS($g,"Khong_luu")}}
                                </button>

                                <button type="submit" id="frm_btnSave"
                                        class="btn btn-default smallbtn pull-right mgr5  "
                                        title="{{Helpers::getRS($g,"Luu")}}"
                                ><span
                                            class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                                </button>
                            </div>

                        </div>
                    </fieldset>
                    <fieldset class="mgt5">
                        <legend class="legend">{{Helpers::getRS($g,"Lich_su_dang_ky_nghi_viec")}}</legend>
                        <div class="row form-group">
                            <div class="col-md-12 col-xs-12">
                                <div id="gridW09F2020"></div>
                            </div>
                        </div>
                    </fieldset>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    formStatus = "view";
    $('#txtDateLeftW092020').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: "dd/mm/yyyy",
        language: 'vi'
    });

    $('#txtNoticeDateW092020').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: "dd/mm/yyyy",
        language: 'vi'
    });

    $('#txtDateLeftW092020').change(function () {
        caculateDays();
    });

    $('#txtNoticeDateW092020').change(function () {
        caculateDays();

    });

    function caculateDays(){
        if ($('#txtNoticeDateW092020').val() != "" && $('#txtDateLeftW092020').val() != ""){
            var numDays = daydiff(convertStringToDate($('#txtNoticeDateW092020').val()),convertStringToDate($('#txtDateLeftW092020').val()));
            $('#txtDateNumberW092020').val(Number(numDays));
        }else{
            $('#txtDateNumberW092020').val(Number(0));
        }
    }

    function triggerDate() {
        if ($('#txtDateLeftW092020').is(':disabled') == false) {
            $('#txtDateLeftW092020').datepicker("show");
        }
    }

    function triggerDate1() {
        if ($('#txtNoticeDateW092020').is(':disabled') == false) {
            $('#txtNoticeDateW092020').datepicker("show");
        }
    }

    dataGrid = {{json_encode($valueGrid)}};

    $(document).ready(function () {
        $("#divScrollbarW09F2020").height($(window).height() - 80);

        $("#divScrollbarW09F2020").mCustomScrollbar({
                axis: "y",
                theme: "rounded-dark",
                scrollButtons: {enable: true},
                autoExpandScrollbar: true,
                advanced: {autoExpandHorizontalScroll: true},
                scrollInertia: 100,
                //scrollbarPosition:"outside"
        });
        /*$("#gridW09F2020").pqGrid("showLoading");
        $("#gridW09F2020").pqGrid("option", "dataModel.data", dataGrid);
        $("#gridW09F2020").pqGrid("refreshDataAndView");
        $("#gridW09F2020").pqGrid("hideLoading");
        //loadNormalView(dataGrid);*/
        loadGrid();
        enableControls("view");
    });


    $("#modalW09F2020").on('submit', '#frmW09F2020', function (e) {
        e.preventDefault();
      if(Number($('#txtDateNumberW092020').val()) < 0){
            alert_warning('{{Helpers::getRS($g,"Ngay_du_kien_phai_lon_hon_ngay_bao_nghi")}}');
        }else{
          ////alert("save");
            if (formStatus == "add") {
                console.log(formStatus);
                ask_save(function () {
                    $.ajax({
                        method: "POST",
                        url: '{{url("/W09F2020/$pForm/$g/checkBeforeSave")}}',
                        data: $("#frmW09F2020").serialize(),
                        success: function (data) {
                            var rs = JSON.parse(data);
                            console.log(rs);
                            if(Number(rs['Status']) == 0){//kiểm tra hợp lệ trước khi save
                                saveDataW09F2020();
                            }else{//ko hợp lệ xuất ra Message
                                alert_error(rs['Message']);
                            }
                        }
                    });
                });
            }
            if (formStatus == "edit") {
                ask_save(function () {
                    $.ajax({
                        method: "POST",
                        url: '{{url("/W09F2020/$pForm/$g/edit")}}',
                        data: $("#frmW09F2020").serialize() + '&leaveTransID=' + leaveTransID,
                        success: function (data) {
                            console.log(data);
                            if (data.status == 1) {
                                //console.log("da chay edit");
                                formStatus = "view";
                                enableControls(formStatus);

                                update4ParamGrid($("#gridW09F2020"), data.rowDataSave[0], 'edit');

                                //loadNormalView(data.valueGrid);
                                save_ok(function () {
                                    if(Number(data.sendMail[0].IsSendMail) == 1){
                                        if(Number(data.sendMail[0].IsShowMailScreen) == 1){
                                            sendMail(data.sendMail[0]);
                                        }else{
                                            sendAutoMail(data.sendMail[0]);
                                        }
                                    }
                                });
                            } else {
                                save_not_ok();
                            }
                        }
                    });
                });
            }

        }
    });
    $('#frm_btnAdd').click(function () {
        formStatus = "add";
        /*$('#frm_btnSave').prop('disabled', false);
        $('#frm_btnNotSave').prop('disabled', false);
        $('#frm_btnAdd').prop('disabled', true);
        $("#gridW09F2020").pqGrid("disable");
        $('#txtDateLeftW092020').prop('disabled', false).val("");
        $('#txtNotesW092020').prop('disabled', false).val("");
        $('#txtReasonW092020').prop('disabled', false).val("");
        $('#txtDateNumberW092020').prop('disabled', false).val("");
        $('#txtNoticeDateW092020').prop('disabled', false).val("");*/
        enableControls(formStatus);
        setValues(null);

    });

    $('#frm_btnNotSave').click(function () {
        ask_not_save(function(){
           /* if( formStatus == "add"){
                $('#txtDateLeftW092020').val("");
                $('#txtNotesW092020').val("");
                $('#txtReasonW092020').val("");
                $('#txtDateNumberW092020').val("");
                $('#txtNoticeDateW092020').val("");
            }
            if( formStatus == "edit"){
                $('#txtDateLeftW092020').val(DateLeft);
                $('#txtNotesW092020').val(Notes);
                $('#txtReasonW092020').val(Reason);
                $('#txtDateNumberW092020').val(DateNumber);
                $('#txtNoticeDateW092020').val(NoticeDate);
            }
            $("#gridW09F2020").pqGrid("enable");
            //loadNormalView(dataGrid);*/
           formStatus = "view";
           enableControls(formStatus);
            $grid = $("#gridW09F2020")
            $grid.pqGrid("refreshDataAndView"); //Chay lai event complete
           /*$grid = $("#gridW09F2020");
           var rowData = getRowSelection($grid);
           if (rowData != null){

           }*/
        });
    });

    function saveDataW09F2020() {
        $.ajax({
            method: "POST",
            url: '{{url("/W09F2020/$pForm/$g/save")}}',
            data: $("#frmW09F2020").serialize(),
            success: function (data) {
                //console.log(data.sendMail[0]);
                if (data.status == 1) {
                    formStatus = "view";
                    enableControls(formStatus);
                    update4ParamGrid($("#gridW09F2020"), data.rowDataSave[0], 'add');
                    //loadNormalView(data.valueGrid);
                    save_ok(function () {
                        //console.log(data.sendMail[0].IsSendMail);
                        if(Number(data.sendMail[0].IsSendMail) == 1){
                            if(Number(data.sendMail[0].IsShowMailScreen) == 1){
                                sendMail(data.sendMail[0]);
                            }else{
                                sendAutoMail(data.sendMail[0]);
                            }
                        }
                    });
                } else {
                    save_not_ok();
                }
            }
        });
    }
    
    function loadGrid() {
        var W09F2020_Height = 400;
        var obj1 = {
            width: '100%',
            height: W09F2020_Height,
            showTitle: false,
            collapsible: false,
            editable: true,
            selectionModel: {type: 'row', mode: 'single'},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            rowBorders: true,
            columnBorders: true,
            postRenderInterval: -1,
            dataType: "JSON",
            //freezeCols: 2,
            hwrap: false,
            wrap: true,
            sortable: false,
            //filterModel: {on: true, mode: "AND", header: true},
            //groupModel: groupModel,
            colModel: [
                {
                    title: '',
                    minWidth: 60,
                    align: "left",
                    dataIndx: "",
                    isExport: true,
                    align: "center",
                    editor: false,
                    render: function (ui) {
                        var rowData = ui.rowData;

                        var str = "";
                        if (rowData["ApprovedStatusID"] <= 1) {
                            str += " <a title='{{Helpers::getRS($g,"Sua")}}' id='btnEditW09F2020'><i class='glyphicon glyphicon-edit text-orange no-border' style='color:orange;padding-right:5px'></i></a> ";
                        } else {
                            str += " <a title='{{Helpers::getRS($g,"Sua")}}' id='btnEditW09F2020Disable'><i class='glyphicon glyphicon-edit text-grey no-border' style='color:#ccc;cursor:text;padding-right:5px'></i></a> ";
                        }
                        if (rowData["ApprovedStatusID"] <= 1) {
                            str += " <a title='{{Helpers::getRS($g,"Xoa")}}' id='btnDeleteW09F2020'><i class='fa fa-trash' style='padding-right:5px;font-size: 110%'></i></a>";
                        } else {
                            str += " <a title='{{Helpers::getRS($g,"Xoa")}}' id='btnDeleteW09F2020Disable'><i class='fa fa-trash' style='color:#ccc;cursor:text;padding-right:5px;font-size: 110%'></i></a>";
                        }
                        return str;
                    },
                    postRender: function (ui) {
                        var rowIndx = ui.rowIndx,
                            gridW09F2020 = this,
                            $cell = gridW09F2020.getCell(ui);
                        $cell.find("a#btnEditW09F2020")
                            .unbind("click")
                            .bind("click", function (evt) {
                                //alert("edit");
                                formStatus = "edit";
                                rowIndxEdit = ui.rowIndx;
                                console.log(ui.rowData);

                                leaveTransID = ui.rowData.LeaveTransID;
                                DateLeft = ui.rowData.DateLeft;
                                Notes = ui.rowData.Notes;
                                Reason = ui.rowData.Reason;
                                NoticeDate = ui.rowData.NoticeDate;
                                DateNumber = ui.rowData.DateNumber;

                                enableControls(formStatus);
                            });
                        $cell.find("a#btnCancelW09F2020")
                            .unbind("click")
                            .bind("click", function (evt) {
                                //console.log(ui.rowData);

                            });
                        $cell.find("a#btnDeleteW09F2020")
                            .unbind("click")
                            .bind("click", function (evt) {
                                console.log(ui.rowData);
                                ask_delete(function () {
                                    $.ajax({
                                        method: "POST",
                                        url: '{{url("/W09F2020/$pForm/$g/delete")}}',
                                        data: {
                                            LeaveTransID: ui.rowData.LeaveTransID
                                        },
                                        success: function (data) {
                                            update4ParamGrid($("#gridW09F2020"), '', 'delete');
                                            delete_ok(function () {
                                                //loadNormalView(data);
                                            });
                                        }
                                    });
                                });
                            });
                    }
                },
                {
                    title: '{{Helpers::getRS($g,"Ngay_dang_ky_nghi")}}',
                    minWidth: 200,
                    dataType: "date",
                    dataIndx: "DateLeft",
                    align: "center",
                    editor: false,
                    editable: true,

                },
                {
                    title: '{{Helpers::getRS($g,"NoticeDate")}}',
                    minWidth: 200,
                    dataType: "date",
                    dataIndx: "NoticeDate",
                    align: "center",
                    editor: false,
                    editable: true,
                    hidden: true
                },
                {
                    title: '{{Helpers::getRS($g,"Ly_do")}}',
                    minWidth: 500,
                    dataType: "string",
                    editor: false,
                    editable: true,
                    dataIndx: "Reason"
                },
                {
                    title: '{{Helpers::getRS($g,"Trang_thai")}}',
                    minWidth: 200,
                    dataType: "string",
                    editor: false,
                    editable: true,
                    align: "center",
                    dataIndx: "ApprovedStatus",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        var str = "";
                        str += "<a title='{{Helpers::getRS($g,"Lich_su_duyet")}}' class='btnViewHistoryW09F2020 mgr10 text-blue'>" + rowData["ApprovedStatus"] + "</a>";
                        return str;
                    },
                    postRender: function (ui) {
                        var rowIndx = ui.rowIndx,
                            grid = this,
                            $cell = grid.getCell(ui);
                        var row = ui.rowData;
                        //edit button
                        $cell.find(".btnViewHistoryW09F2020").bind("click", function (evt) {
                            showFormDialogPost('{{url("/W09F3030/$pForm/$g")}}', "modalW09F3030", {transID: row["LeaveTransID"]},2);
                        });
                    }
                }
            ],
            dataModel: {
                data: dataGrid,
                location: "local",
                sorting: "local",
                sortDir: "down"
            },
            complete: function (event, ui) {
                console.log('complete grid');
                $grid = $("#gridW09F2020");
                if(dataGrid.length > 0 && formStatus == "view"){
                    //Lay dong dang select
                    var rowData = null;
                    rowData = getRowSelection($grid);
                    console.log(rowData);
                    //Neu khong co dong select thi lay dong dau tien
                    if (rowData == null){
                        $grid.pqGrid( "setSelection", {rowIndx:0} );
                        rowData = $( "#gridW09F2020" ).pqGrid( "getRowData", {rowIndx: 0});
                    }
                    setValues(rowData);
                }else{
                    setValues(null);
                    $('#frm_btnAdd').trigger('click');
                    ///add new

                }
            },
            rowClick: function (event, ui) {
                //alert("rc");
                console.log(ui.rowData);
                setValues(ui.rowData);
                /*$('#txtDateLeftW092020').val(ui.rowData.DateLeft);
                $('#txtNotesW092020').val(ui.rowData.Notes);
                $('#txtReasonW092020').val(ui.rowData.Reason);
                $('#txtDateNumberW092020').val(ui.rowData.DateNumber);
                $('#txtNoticeDateW092020').val(ui.rowData.NoticeDate);*/
            },
            filter: function (event, ui) {
                console.log(ui)
            }
        };
        var $grid = $("#gridW09F2020").pqGrid(obj1);
        $("#gridW09F2020").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $("#gridW09F2020").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        setTimeout(function () {
            $("#gridW09F2020").pqGrid("refreshDataAndView");
        }, 300)

    }

    /*function loadNormalView(arr) {
        //console.log(arr);
        if (arr.length > 0) {
            $('#frm_btnSave').prop('disabled', true);
            $('#frm_btnNotSave').prop('disabled', true);
            $('#txtDateLeftW092020').prop('disabled', true);
            $('#txtNotesW092020').prop('disabled', true);
            $('#txtReasonW092020').prop('disabled', true);
            $('#txtDateNumberW092020').prop('disabled', true);
            $('#txtNoticeDateW092020').prop('disabled', true);
            $('#frm_btnAdd').prop('disabled', false);
        } else {
            $('#frm_btnSave').prop('disabled', false);
            $('#frm_btnNotSave').prop('disabled', false);
            $('#frm_btnAdd').prop('disabled', true);
            $('#txtDateLeftW092020').prop('disabled', false);
            $('#txtNotesW092020').prop('disabled', false);
            $('#txtReasonW092020').prop('disabled', false);
            $('#txtDateNumberW092020').prop('disabled', false);
            $('#txtNoticeDateW092020').prop('disabled', false);
        }
    }*/

    function sendMail(arr) {
        $.ajax({
            method: "POST",
            url: '{{url("/W09F2020/$pForm/$g/sendMail")}}',
            success: function (data) {
                var rs = JSON.parse(data);
                showEmailPopup(rs.rsvalue, arr);
            }
        });
    }

    function sendAutoMail(arrMail) {
        console.log(arrMail);
        $.ajax({
            method: "POST",
            url: '{{url("/W09F2020/$pForm/$g/sendAutoMail")}}',
            data: {
                arrMail: arrMail
            },
            success: function (data) {
                var rs = JSON.parse(data);
                alert_info("{{Helpers::getRS($g,'Email_da_duoc_gui_toi')}}" + ": <b><i>" + rs.name + "</i></b>");
            }
        });
    }

    function enableControls(formState){
        switch (formState){
            case "add":
            case "edit":
                $('#txtDateLeftW092020').prop('disabled', false);
                $('#txtNotesW092020').prop('disabled', false);
                $('#txtReasonW092020').prop('disabled', false);
                $('#txtDateNumberW092020').prop('disabled', false);
                $('#txtNoticeDateW092020').prop('disabled', false);
                //-------------------------
                $('#frm_btnAdd').prop('disabled', true);
                $('#frm_btnSave').prop('disabled', false);
                $('#frm_btnNotSave').prop('disabled', false);
                $("#gridW09F2020").pqGrid("disable");
                break;
            case 'view':
                $('#txtDateLeftW092020').prop('disabled', true);
                $('#txtNotesW092020').prop('disabled', true);
                $('#txtReasonW092020').prop('disabled', true);
                $('#txtDateNumberW092020').prop('disabled', true);
                $('#txtNoticeDateW092020').prop('disabled', true);

                $('#frm_btnAdd').prop('disabled', false);
                $('#frm_btnSave').prop('disabled', true);
                $('#frm_btnNotSave').prop('disabled', true);
                $("#gridW09F2020").pqGrid("enable");
                break;
        }
    }

    function setValues(rowData){
        if (rowData != null){
            //$('#txtDateLeftW092020').val(rowData.DateLeft);NoticeDate
            $("#txtDateLeftW092020").datepicker('update', rowData.DateLeft);
            $('#txtNotesW092020').val(rowData.Notes);
            $('#txtReasonW092020').val(rowData.Reason);
            $('#txtDateNumberW092020').val(rowData.DateNumber);
            $("#txtNoticeDateW092020").val(rowData.NoticeDate);
        }else{
            $('#txtDateLeftW092020').val('');
            $('#txtNotesW092020').val('');
            $('#txtReasonW092020').val('');
            $('#txtDateNumberW092020').val('');
            $('#txtNoticeDateW092020').val('{{date('d/m/Y')}}');
        }
    }
    /*Set form height for textarea Note*/
  /*  var heightText = parseInt(($("#modalW09F2020").find("div.modal-content").height() - 800));
    $("#txtReasonW092020").css("height", heightText);*/
</script>