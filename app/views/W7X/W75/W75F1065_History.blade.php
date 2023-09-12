<div id='gridW75F1065History' class="text-purple"></div>
<script type="text/javascript">


    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        function isEditing($grid) {
            var rows = $grid.pqGrid("getRowsByClass", {cls: 'pq-row-edit'});
            if (rows.length > 0) {
                //focus on editor if any
                $grid.find(".pq-editor-focus").focus();
                return true;
            }
            return false;
        }

        function edit_history(rowIndx, $grid) {
            //console.log(rowIndx);
            var cboLeaveTypeID = $("#frmW75F1065").find("#cboLeaveTypeID");
            var leave_date_from = $("#frmW75F1065").find("#txtLeaveDateFromW75F1065");
            var leave_date_to = $("#frmW75F1065").find("#txtLeaveDateTo");
            var quantity = $("#frmW75F1065").find("#txtQuantity");
            var txt1stAbsDayQuan = $("#frmW75F1065").find("#txt1stAbsDayQuan");
            var txtLastAbsDayQuan = $("#frmW75F1065").find("#txtLastAbsDayQuan");

            console.log(cboLeaveTypeID.val(), leave_date_from.val(), leave_date_to.val(), quantity.val(), txt1stAbsDayQuan.val(), txtLastAbsDayQuan.val());

            if (cboLeaveTypeID.val() != null || leave_date_from.val() != "" || leave_date_to.val() != "" || quantity.val() != ""|| txt1stAbsDayQuan.val() != ""|| txtLastAbsDayQuan.val() != "") {
                $("#modalW75F1065").find("#btnSave").trigger("click");
            }
            else {
                var rowData = $grid.pqGrid("getRowData", {rowIndx: rowIndx});
                var leavetypeid = rowData["LeaveTypeID"];
                var subdayfrom = rowData["SubDayFrom"];
                var subdayto = rowData["SubDayTo"];
                var voucherdate = rowData["VoucherDate"];
                var quantity = rowData["Quantity"];
                var leavedatefrom = rowData["LeaveDateFrom"];
                var leavedateto = rowData["LeaveDateTo"];
                var stAbsDayQuan = rowData["1stAbsDayQuan"];
                var LastAbsDayQuan = rowData["LastAbsDayQuan"];
                var reason = rowData["Reason"];
                var note = rowData["Note"];
                var transid = rowData["TransID"];
                console.log(quantity);
                $("#frmW75F1065").find("#txtVoucherDate").text(voucherdate);
                $("#frmW75F1065").find("#hdTransID").val(transid);
                $("#frmW75F1065").find("#cboLeaveTypeID").val(leavetypeid);
                $("#frmW75F1065").find("#cboSubDayFrom").val(subdayfrom);
                $("#frmW75F1065").find("#cboSubDayTo").val(subdayto);
                $("#frmW75F1065").find("#txtQuantity").val(Number(quantity));
                $("#frmW75F1065").find("#txtLeaveDateFromW75F1065").val(leavedatefrom);
                $("#frmW75F1065").find("#txtLeaveDateTo").val(leavedateto);
                $("#frmW75F1065").find("#txt1stAbsDayQuan").val(Number(stAbsDayQuan));
                $("#frmW75F1065").find("#txtLastAbsDayQuan").val(Number(LastAbsDayQuan));
                $("#frmW75F1065").find("#txtReason").val(reason);
                $("#frmW75F1065").find("#txtNote").val(note);
            }
        }

        function delete_callback(arr){
            $(".l3loading").removeClass('hide');
            //console.log("sddfds");
            var $grid = arr[1];
            var rowData = $grid.pqGrid("getRowData", {rowIndx: arr[0]});
            //console.log(rowData);
            var leavetypeid = rowData["LeaveTypeID"];
            //console.log(leavetypeid);
            var subdayfrom = rowData["SubDayFrom"];

            var subdayto = rowData["SubDayTo"];
            var voucherdate = rowData["VoucherDate"];
            var quantity = rowData["Quantity"];
            var leavedatefrom = rowData["LeaveDateFrom"];
            var leavedateto = rowData["LeaveDateTo"];
            var reason = rowData["Reason"];
            var note = rowData["Note"];
            var transid = rowData["TransID"];
            //alert(rowData[5]);
            $.ajax({
                method: 'POST',
                url: '{{url("/W75F1065/view/$pForm/$g/6")}}',
                data: {
                    leavetypeid: leavetypeid,
                    quantity: quantity,
                    leavedatefrom: leavedatefrom,
                    leavedateto: leavedateto,
                    reason: reason,
                    note: note,
                    transid: transid,
                    subdayfrom: subdayfrom,
                    subdayto: subdayto
                },
                //data:{hdCancel},
                success: function (data) {
                    $(".l3loading").addClass('hide');
                    var result = $.parseJSON(data);
                    if (result.bSaveOK) {
                        delete_ok(load_tableW75F1065);
                    }
                }
            });
        }

        function delete_history(rowIndx, $grid) {
            var cboLeaveTypeID = $("#frmW75F1065").find("#cboLeaveTypeID");
            var leave_date_from = $("#frmW75F1065").find("#txtLeaveDateFromW75F1065");
            var leave_date_to = $("#frmW75F1065").find("#txtLeaveDateTo");
            var quantity = $("#frmW75F1065").find("#txtQuantity");

            if (cboLeaveTypeID.val() != null || leave_date_from.val() != "" || leave_date_to.val() != "" || quantity.val() != "") {
                $("#modalW75F1065").find("#btnSave").trigger("click");
            }
            else {
                ask_delete(delete_callback,new Array(rowIndx,$grid));
            }
        }

        function cancel_callback(arr){
            $(".l3loading").removeClass('hide');
            //console.log("sddfds");
            $grid = arr[1];
            var rowData = $grid.pqGrid("getRowData", {rowIndx: arr[0]});
            //console.log(rowData);
            var leavetypeid = rowData["LeaveTypeID"];
            //console.log(leavetypeid);
            var subdayfrom = rowData["SubDayFrom"];

            var subdayto = rowData["SubDayTo"];
            var voucherdate = rowData["VoucherDate"];
            var quantity = rowData["Quantity"];
            var leavedatefrom = rowData["LeaveDateFrom"];
            var leavedateto = rowData["LeaveDateTo"];
            var reason = rowData["Reason"];
            var note = rowData["Note"];
            var transid = rowData["TransID"];
            //alert(rowData[5]);
            $.ajax({
                method: 'POST',
                url: '{{url("/W75F1065/view/$pForm/$g/4")}}',
                data: {
                    leavetypeid: leavetypeid,
                    quantity: quantity,
                    leavedatefrom: leavedatefrom,
                    leavedateto: leavedateto,
                    reason: reason,
                    note: note,
                    transid: transid,
                    subdayfrom: subdayfrom,
                    subdayto: subdayto
                },
                //data:{hdCancel},
                success: function (data) {
                    $(".l3loading").addClass('hide');
                    var result = $.parseJSON(data);
                    switch (result.CODE) {
                        case 2:
                            if (result.message == ""){
                                save_ok(load_tableW75F1065,null,"{{Helpers::getRS($g,"Du_lieu_da_duoc_huy_thanh_cong}}");
                                //alert_custom(icon_success,"{{Helpers::getRS($g,"Du_lieu_da_duoc_huy_thanh_cong}}",true,false,load_tableW75F1065,null,0);

                            }else{
                                alert_warning(result.message);
                            }
                            break;
                        case 3:
                            load_tableW75F1065();
                            //clear_data();
                            //EnableMaster(0);
                            $("#emailPOP").html(result.rsvalue);
                            showsendmail();
                            $("#mPopUpSendMail").find("#txtEmailReceivedAddress").prop('readonly', true);
                            break;
                        case 4:
                            save_ok(load_tableW75F1065,null,"{{Helpers::getRS($g,"Du_lieu_da_duoc_huy_thanh_cong}}");
                            //alert_custom(icon_success,"{{Helpers::getRS($g,"Du_lieu_da_duoc_huy_thanh_cong}}",true,false,load_tableW75F1065,null,0);
                            break;
                    }
                }

            });
        }

        function cancel_history(rowIndx, $grid) {
            var cboLeaveTypeID = $("#frmW75F1065").find("#cboLeaveTypeID");
            var leave_date_from = $("#frmW75F1065").find("#txtLeaveDateFromW75F1065");
            var leave_date_to = $("#frmW75F1065").find("#txtLeaveDateTo");
            var quantity = $("#frmW75F1065").find("#txtQuantity");

            if (cboLeaveTypeID.val() != null || leave_date_from.val() != "" || leave_date_to.val() != "" || quantity.val() != "") {
                $("#modalW75F1065").find("#btnSave").trigger("click");
            }
            else {
                ask_save(cancel_callback,new Array(rowIndx, $grid),"{{Helpers::getRS($g,"Ban_co_muon_huy_phep_khong")}}");
                //alert_custom(icon_ask,"{{Helpers::getRS($g,"Ban_co_muon_huy_phep_khong")}}",true,true,cancel_callback );
            }
        }
        console.log($("#modalW75F1065").find("#tbHistory").height());
        var data = {{$data}};
        var obj = {
            width: '100%',
//            height: $("#modalW75F1065").find(".modal-body").height() - $("#modalW75F1065").find("fieldset").height() - 30 ,
            height: 400,
            editable: false,
            flexheight: false,
            freezeCols: 5,
            minWidth: 30,
            pageModel: {type: "local", rPP: 10},
            selectionModel: {type: 'row', mode: 'single'},
            filterModel: {on: true, mode: "AND", header: true},
            showTitle: false,
            wrap: true,
            hwrap: false,
            collapsible: false,
            postRenderInterval: -1,
            //scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
            colModel: [
                {
                    title: "",
                    minWidth: 1,
                    dataType: "string",
                    dataIndx: "TransID",
                    align: "left",
                    hidden: true
                },
                {
                    title: "",
                    minWidth: 1,
                    dataType: "string",
                    dataIndx: "LeaveTypeID",
                    align: "left",
                    hidden: true
                },
                {
                    title: "",
                    minWidth: 1,
                    dataType: "string",
                    dataIndx: "SubDayFrom",
                    align: "center",
                    hidden: true
                },
                {
                    title: "",
                    minWidth: 1,
                    dataType: "string",
                    dataIndx: "SubDayTo",
                    align: "center",
                    hidden: true
                },
                {
                    title: "",
                    editable: false,
                    minWidth: 75,
                    align: "right",
                    sortable: false,
                    render: function (ui) {
                        var rowData = ui.rowData;
                        var str = "";
                        if (rowData["AppStatusID"] == 0 && rowData["IsCancel"] == 0) {
                            str +=  " <a title='{{Helpers::getRS($g,"Sua")}}' id='btnEditW75F1065'><i class='glyphicon glyphicon-edit text-orange' style='font-size: 115%;padding-right:5px'></i></a> ";
                        }else{
                            str +=  " <a title='{{Helpers::getRS($g,"Sua")}}' id='btnEditW75F1065Disable'><i class='glyphicon glyphicon-edit text-grey' style='color:#ccc;cursor:text;padding-right:5px;font-size: 115%;'></i></a> ";
                        }
                        if (rowData["AppStatusID"] == 2 && rowData["IsCancel"] == 0) {
                            str +=  " <a title='{{Helpers::getRS($g,"Huy")}}' id='btnCancelW75F1065'><i class='glyphicon glyphicon-remove' style='color:red;padding-right:5px;font-size:115%%'></i></a>";
                        }else{
                            str +=  " <a title='{{Helpers::getRS($g,"Huy")}}' id='btnCancelW75F1065Disable'><i class='glyphicon glyphicon-remove' style='color:#ccc;cursor:text; padding-right:5px;font-size:115%%'></i></a>";
                        }
                        if ((rowData["AppStatusID"] == 0 || rowData["AppStatusID"] == 4) && rowData["IsCancel"] == 0) {
                            str +=  " <a title='{{Helpers::getRS($g,"Xoa")}}' id='btnDeleteW75F1065'><i class='fa fa-trash' style='color:#333;font-size: 115%'></i></a>";
                        }else{
                            str +=  " <a title='{{Helpers::getRS($g,"Xoa")}}' id='btnDeleteW75F1065Disable'><i class='fa fa-trash' style='color:#ccc;font-size: 115%'></i></a>";
                        }
                        //str +=  " <a title='{{Helpers::getRS($g,"Huy")}}' id='btnCancelW75F1065'><i class='glyphicon glyphicon-remove' style='color:red;padding-right:5px;font-size:83%'></i></a>";
                        return str;
                    },
                    postRender: function (ui) {
                        var rowIndx = ui.rowIndx,
                            rowData = ui.rowData,
                                gridHistory = this,
                                $cell = gridHistory.getCell(ui);
                        $cell.find("a#btnEditW75F1065")
                                .unbind("click")
                                .bind("click", function (evt) {
                                    //$gridW09F2920 = $("#gridW09F2920")
                                    var grid = $("#gridW75F1065History")
                                    edit_history(rowIndx, grid);
                                    console.log(rowData);
                                    updateActionW75F1065('edit', rowData['LinkTransID'], rowData['LinkTransID']);
                                });
                        $cell.find("a#btnCancelW75F1065")
                                .unbind("click")
                                .bind("click", function (evt) {
                                    //$gridW09F2920 = $("#gridW09F2920")
                                    var grid = $("#gridW75F1065History")
                                    cancel_history(rowIndx, grid);
                                });
                        $cell.find("a#btnDeleteW75F1065")
                                .unbind("click")
                                .bind("click", function (evt) {
                                    //$gridW09F2920 = $("#gridW09F2920")
                                    var grid = $("#gridW75F1065History")
                                    delete_history(rowIndx, $gridW75F1065History);
                                });
                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Phep_huy")}}",
                    editable: false,
                    minWidth: 75,
                    align: "center",
                    sortable: false,
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return '<input type="checkbox" style = "font-size: 115%" disabled ' + (rowData["IsCancel"] == 1 ? "checked" : "") + '>';

                    }
                },
                {
                    title: "{{Helpers::getRS($g,"Ngay_dang_ky")}}",
                    minWidth: 110,
                    dataType: "date",
                    dataIndx: "VoucherDate",
                    align: "center",
                    //cls: "text-red",
                    filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                },
                {
                    title: "{{Helpers::getRS($g,"Loai_phep")}}",
                    minWidth: 200,
                    dataType: "string",
                    dataIndx: "LeaveTypeName",
                    align: "left",
                    filter: {
                        type: 'select',
                        condition: 'equal',
                        prepend: {'': '---'},
                        valueIndx: "LeaveTypeName",
                        labelIndx: "LeaveTypeName",
                        listeners: ['change']
                    },
                    render: function (ui) {
                        var rowData = ui.rowData;
                        var disabled = (rowData['LeaveID'] == 'L090' && Number(rowData['AppStatusID'] == 2)) ? "" : "disabled";
                        if(rowData['LeaveID'] == 'L090' && Number(rowData['AppStatusID'] == 2)){
                            return {
                                text: rowData['LeaveTypeName']+ "<a title='{{Helpers::getRS($g,"Thong_tin_cong_tac")}}' class='fa fa-info pull-right text-blue' id = 'btnViewBusinessW15F2170' style='margin-top:2px; font-size: 115%'></a>",
                                cls: (disabled ? "readonly-status" : "")
                            };
                        }else{
                            return {
                                text: rowData['LeaveTypeName'],
                                cls: (disabled ? "readonly-status" : "")
                            };
                        }

                    },
                    postRender: function (ui) {
                        var grid = this, $cell = grid.getCell(ui);
                        var rowData = ui.rowData;
                        //downLoad
                        if(rowData['LeaveID'] == 'L090' && Number(rowData['AppStatusID'] == 2)){
                            $cell.find("a#btnViewBusinessW15F2170").unbind("click").bind("click", function (evt) {
                                // console.log(ui.rowData.CandidateID);
                                //alert("ab");
                                showFormDialogPost('{{url("/W75F1066/W15F2170/4/")}}', "modalW75F1066",
                                    {
                                        action: "viewApproved",
                                        LinkTransIDW75F1065: rowData['LinkTransID'],
                                        TransID1065to1066: rowData['TransID'],
                                    },2);
                            });
                        }
                    }
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"So_luong")}}",
                    minWidth: 110,
                    dataType: "float",
                    dataIndx: "Quantity",
                    align: "right",
                    //format: '{{\Helpers::getStringFormat($decimals)}}',
                    render: function (ui) {
                        var rowData = ui.rowData;
                        //return parseFloat(Number(rowData["Quantity"]).toFixed({{$decimals}}));
                        return format2(rowData["Quantity"], '', {{$decimals}})
                    },
                    filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Tu_ngay")}}",
                    minWidth: 110,
                    dataType: "date",
                    align: "center",
                    dataIndx: "LeaveDateFrom",
                    filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                },
                {
                    title: "{{Helpers::getRS($g,"Den_ngay")}}",
                    minWidth: 110,
                    dataType: "date",
                    align: "center",
                    dataIndx: "LeaveDateTo",
                    filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ly_do")}}",
                    minWidth: 200,
                    dataType: "string",
                    dataIndx: "Reason",
                    align: "left", filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Trang_thai_duyet")}}",
                    minWidth: 120,
                    dataType: "string",
                    dataIndx: "AppStatusName",
                    align: "center",
                    filter: {
                        type: 'select',
                        condition: 'equal',
                        prepend: {'': '---'},
                        valueIndx: "AppStatusName",
                        labelIndx: "AppStatusName",
                        listeners: ['change']
                    }
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ghi_chu_cua_cap_duyet")}}",
                    minWidth: 200,
                    dataType: "string",
                    dataIndx: "AppNote",
                    align: "left", filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ghi_chu")}}",
                    minWidth: 200,
                    dataType: "string",
                    dataIndx: "Note",
                    align: "left", filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
            ],
            dataModel: {
                data: data
            }/*,
            rowClick: function (event, ui) {
                console.log(ui.rowData);
                var rowIndx = ui.rowIndx,
                    rowData = ui.rowData;
                var grid = $("#gridW75F1065History")
                viewAproved(rowIndx, grid);
            }*/,
            complete:function(){
                var transid = '{{$transID}}';
                var idx;
                if (transid == "")
                    idx = 0;
                else
                    idx=findIndexJson(data,"TransID",transid);
                $("#gridW75F1065History").pqGrid("setSelection", {rowIndx: idx});
            }

        };


        var $gridW75F1065History = $("#gridW75F1065History").pqGrid(obj);
        $("#gridW75F1065History").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $("#gridW75F1065History").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $("#gridW75F1065History").pqGrid("refreshDataAndView");

        var column = $gridW75F1065History.pqGrid("getColumn", { dataIndx: "AppStatusName" });
        var filter = column.filter;
        filter.cache = null;
        filter.options = $gridW75F1065History.pqGrid("getData", { dataIndx: ["AppStatusName"] });

        column = $gridW75F1065History.pqGrid("getColumn", { dataIndx: "LeaveTypeName" });
        filter = column.filter;
        filter.cache = null;
        filter.options = $gridW75F1065History.pqGrid("getData", { dataIndx: ["LeaveTypeName"] });
        $("#gridW75F1065History").pqGrid("refreshDataAndView");

    });

    /*function viewAproved(rowIndx, $grid) {//hàm view để nhập chi phí thực tế

        var rowData = $grid.pqGrid("getRowData", {rowIndx: rowIndx});
        var leavetypeid = rowData["LeaveTypeID"];
        var quantity = rowData["Quantity"]
        var leavedatefrom = rowData["LeaveDateFrom"];
        var leavedateto = rowData["LeaveDateTo"];
        var stAbsDayQuan = rowData["1stAbsDayQuan"];
        var LastAbsDayQuan = rowData["LastAbsDayQuan"];
        var reason = rowData["Reason"];
        var note = rowData["Note"];


        $("#frmW75F1065").find("#cboLeaveTypeID").val(leavetypeid).prop("readonly", true);
        $("#frmW75F1065").find("#txtQuantity").val(quantity).prop("readonly", true);
        $("#frmW75F1065").find("#txtLeaveDateFromW75F1065").val(leavedatefrom).prop("readonly", true);
        $("#frmW75F1065").find("#txtLeaveDateTo").val(leavedateto).prop("readonly", true);
        $("#frmW75F1065").find("#txt1stAbsDayQuan").val(Number(stAbsDayQuan)).prop("readonly", true);
        $("#frmW75F1065").find("#txtLastAbsDayQuan").val(Number(LastAbsDayQuan)).prop("readonly", true);
        $("#frmW75F1065").find("#txtReason").val(reason).prop("readonly", true);
        $("#frmW75F1065").find("#txtNote").val(note).prop("readonly", true);
    }*/
</script>	
