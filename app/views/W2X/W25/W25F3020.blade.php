<div class="modal fade modal noneOverflow" id="modalW25F3020" data-keyboard="false" data-backdrop="static"
     role="dialog">

    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <form id="frmW25F3020" name="frmW25F3020" method="post" style="height: 500px;">
                <div class="modal-header">
                    {{Helpers::generateHeading($modalTitle,"W25F3020")}}

                </div>
                <div class="modal-body" style="padding:10px">
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,'Ngay_lap')}}</label>
                        </div>
                        <div class="col-md-5">
                            <div id="DateFromIcon" class="input-group date">
                                <input type="text" class="form-control" id="voucherFromDate"
                                       name="voucherFromDate" value="" required><span
                                        class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div id="DateToIcon" class="input-group date">
                                <input type="text" class="form-control" id="voucherDateTo"
                                       name="voucherDateTo" value="" required><span
                                        class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row  form-group">
                        <div class="col-md-2">
                            <a onclick="W25F3020ExportExcel()" class="btn btn-default smallbtn"
                               title="{{Helpers::getRS($g,'Xuat_Excel_U')}}">
                                <span class="fa fa-file-excel-o"></span> {{Helpers::getRS($g,'Xuat_Excel_U')}}
                            </a>
                        </div>
                        <div class="col-md-2">

                            <div class="checkbox mgl15 pdl5" style="margin-top: -2px">
                                <input type="checkbox" id="isPedding"
                                       name="isPedding">{{Helpers::getRS($g,'Dang_thuc_hien')}}
                            </div>

                        </div>
                        <div class="col-md-2">
                            <div class="checkbox" style="margin-top: -2px">
                                <input type="checkbox" id="isCancel"
                                       name="isCancel">{{Helpers::getRS($g,'_Dong')}}
                            </div>

                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-default smallbtn pull-right" style="padding-top: 4px"><span
                                        class="digi digi-filter"></span>
                                &nbsp;{{Helpers::getRS($g,"Loc")}}</button>

                            <button type="button" id="frm_btnSendmail"
                                    class="btn btn-default smallbtn pull-right mgr5 "
                                    title="{{Helpers::getRS($g,"Gui_mail")}}"
                            ><span
                                        class="fa fa-envelope-o mgr5 text-primary"></span> {{Helpers::getRS($g,"Gui_mail")}}
                            </button>
                        </div>
                    </div>
                    <div class="row  form-group">
                        <div class="col-md-6">
                            <div id="pqgrid_W25F3020_1" style="margin:auto;height: 300px;"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="pqgrid_W25F3020_2" style="margin:auto;height: 300px;"></div>
                        </div>
                    </div>
                    <div class="row  form-group">
                        <div class="col-md-12">
                            <button type="button" id="btnSave"
                                    class="btn btn-default smallbtn pull-right confirmation-save"
                                    onclick="ask_save(function(){save()})"><span
                                        class="glyphicon glyphicon-floppy-saved mgr5"></span>{{Helpers::getRS($g,"Luu")}}
                            </button>
                        </div>
                    </div>
                </div>

                <div id="divDropDownW05F1602">
                    <div style="position: absolute; z-index: 900000; top: 0; display: none; " id="pgrid_statusID"
                         class="subGrid">
                        <div id="grid_statusID"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('layout.sendmail')
<script type="text/javascript">
    //var today = new Date();
    var data1 = {{$rs1}};
    var data2 = {{$rs2}};
    var tranMonth = {{$tranMonth}};
    var tranYear = {{$tranYear}};
    var statusCombo;
    var checkAproveCV = true;
    var sRowIndx;
    loadDD();
    loadLeftGrid();
    loadRightGrid();
    $(document).ready(function () {
        $('#isPedding').attr('checked', true);

        //gan ngay dau thang va cuoi thang
        // ==========================================================================================================================
        var dayFrom = "01";
        var dayTo = "";
        //alert(tranMonth);
        if(tranMonth == 1 || tranMonth ==3 || tranMonth ==5 || tranMonth ==7 || tranMonth ==8 || tranMonth ==10 || tranMonth ==12){
            dayTo = "31";
        }
        if(tranMonth == 4 || tranMonth ==6 || tranMonth ==9 || tranMonth == 11 ){
            dayTo = "30";
        }if(tranMonth == 2){
            dayTo = kiem_tra_nam_nhuan(tranYear);
        }
        if(Number(tranMonth) < 10) {
            tranMonth = '0'+tranMonth
        }
        var dateFrom = dayFrom + "/" + tranMonth + "/" + tranYear;
        var dateTo = dayTo + "/" + tranMonth + "/" + tranYear;
        $("#voucherFromDate").val(dateFrom);
        $("#voucherDateTo").val(dateTo);
    });

    function kiem_tra_nam_nhuan(nam)
    {
        // nếu năm chia hết cho 100
        // thì kiểm tra nó có chia hết cho 400 hay không
        if (nam % 100 == 0)
        {
            // nêu chia hết cho 400 thì là năm nhuận
            if (nam % 400 == 0){
               return 29;
            }
            else { // ngược lại không phải năm nhuận
                return 28;
            }
        }
        else if (nam % 4 == 0){ // trường hợp chia hết cho 4 thì là năm nhuận
            return 29;
        }
        else { // cuối cùng trường hợp không phải năm nhuận
            return 28;
        }
    }
    //==========================================================================================================================
    $("#voucherFromDate").removeClass('input-group date_disable');
    $("#voucherFromDate").addClass('input-group date');
    $('.input-group.date').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: "dd/mm/yyyy",
        language: 'vi'
        //	defaultViewDate: {day: 01, month: 01,year: 2015, format : "DD-MM-YYYY"}
    });
    $("#voucherDateTo").removeClass('input-group date_disable');
    $("#voucherDateTo").addClass('input-group date');
    $('.input-group.date').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: "dd/mm/yyyy",
        language: 'vi'
        //	defaultViewDate: {day: 01, month: 01,year: 2015, format : "DD-MM-YYYY"}
    });

    $("#frmW25F3020").on('submit', function (e) {
        e.preventDefault();
        loadDD();
        W25F3020Filter();
    });

    function W25F3020Filter() {
        $("#pqgrid_W25F3020_1").pqGrid("showLoading");
        var isPedding = $("#isPedding").is(":checked") ? 1 : 0;
        var isCancel = $("#isCancel").is(":checked") ? 1 : 0;
        $.ajax({
            method: "POST",
            url: '{{url("/W25F3020/$pForm/$g/leftgrid")}}',
            data: $("#frmW25F3020").serialize() + "&isPedding=" + isPedding + "&isCancel=" + isCancel,
            success: function (data) {
                // console.log(data);
                //setter
                $("#pqgrid_W25F3020_1").pqGrid("option", "dataModel.data", data);
                $("#pqgrid_W25F3020_1").pqGrid("refreshDataAndView");
                $("#pqgrid_W25F3020_1").pqGrid("hideLoading");
                //loadData();
                // console.log(keyW25F3020);
            }
        });
    }

    function viewDetail(keyW25F3020, isApproveCV) {
        console.log(isApproveCV);
        $("#pqgrid_W25F3020_2").pqGrid("showLoading");
        var isPedding = $("#isPedding").is(":checked") ? 1 : 0;
        var isCancel = $("#isCancel").is(":checked") ? 1 : 0;
        // console.log(keyW25F3020);
        $.ajax({
            method: "POST",
            url: '{{url("/W25F3020/$pForm/$g/righgrid")}}',
            data: $("#frmW25F3020").serialize() + "&isPedding=" + isPedding + "&isCancel=" + isCancel + "&interviewFileID=" + keyW25F3020,
            success: function (data) {
                // console.log(data);
                //setter
                $("#pqgrid_W25F3020_2").pqGrid("option", "dataModel.data", data);
                if (isApproveCV == 0) {
                    checkAproveCV = true;
                }
                if (isApproveCV == 1) {
                    checkAproveCV = false;
                }
                console.log(checkAproveCV);
                $("#pqgrid_W25F3020_2").pqGrid("refreshDataAndView");
                $("#pqgrid_W25F3020_2").pqGrid("hideLoading");
                //loadData();
            }
        });
    }

    function loadLeftGrid() {
        //ajax1
        $(document).ready(function () {
            var iW25F3020_1Height = $(document).height() - 220;
            setTimeout(function () {
                //$( "#pqgrid_W25F3020_1" ).pqGrid( "option", "height", iW25F2000Height );
               // iW25F2000Height = 700;
            }, 1000);
            var obj1 = {
                width: '100%',
                height: iW25F3020_1Height,
                showTitle: false,
                collapsible: false,
                editable: true,
                hwrap: false,
                wrap: false,
               // postRenderInterval: -1,
                selectionModel: {type: 'row', mode: 'single'},
                filterModel: {on: true, mode: "AND", header: true},
                complete: function (event, ui) {
                    //$( "#pqgrid_W25F3020_1" ).pqGrid( "option", "height", iW25F2000Height );
                },
                colModel: [
                    {
                        title: '{{Helpers::getRS($g,"Lich_PV")}}',
                        minWidth: 200,
                        align: "left",
                        dataIndx: "Description",
                        isExport: false,
                        editor: false,
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},

                    },
                    {
                        title: '{{Helpers::getRS($g,"Duyet_CV_ung_vien")}}',
                        minWidth: 150,
                        dataType: "string",
                        dataIndx: "IsApproveCV",
                        editor: false,
                        align: "center",
                        render: function (ui) {
                            var rowData = ui.rowData;
                            return '<input type="checkbox" disabled ' + (rowData["IsApproveCV"] == 1 ? "checked" : "") + '>';
                        }
                    },
                    {
                        title: '{{Helpers::getRS($g,"Vong_PV")}}',
                        minWidth: 70,
                        dataType: "string",
                        editor: false,
                        dataIndx: "InterviewLevel",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ngay_lap")}}',
                        minWidth: 100,
                        dataType: "date",
                        editor: false,
                        align: "center",
                        dataIndx: "VoucherDate",
                        filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                    },
                    {
                        title:'{{Helpers::getRS($g,"Nguoi_lap")}}',
                        minWidth: 160,
                        editor: false,
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                        dataIndx: "CreatorName"
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ngay_tuyen_(tu)")}}',
                        minWidth: 120,
                        dataType: "date",
                        editor: false,
                        dataIndx: "FromDate",
                        align: "center",
                        filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ngay_tuyen_(den)")}}',
                        minWidth: 120,
                        dataType: "date",
                        editor: false,
                        align: "center",
                        dataIndx: "ToDate",
                        filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Dot")}}',
                        minWidth: 90,
                        dataType: "string",
                        editor: false,
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                        dataIndx: "RecruitPhaseNo"
                    },
                    {
                        title: '{{Helpers::getRS($g,"Dia_diem")}}',
                        minWidth: 160,
                        editor: false,
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                        dataIndx: "InterviewPlace"
                    },
                    {
                        title: '{{Helpers::getRS($g,"Nhom_phong_van")}}',
                        minWidth: 200,
                        editor: false,
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                        dataIndx: "GroupInterviewer"
                    },
                    {
                        title: '{{Helpers::getRS($g,"Trang_thai")}}',
                        minWidth: 100,
                        editor: false,
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                        dataIndx: "StatusName"

                    }
                ],
                dataModel: {
                    data: data1,
                    location: "local",
                    sorting: "local",
                    sortDir: "down"
                },
                complete: function (event, ui) {
                    console.log('complete grid 1');
                    if ($("#pqgrid_W25F3020_1").pqGrid("option", "dataModel.data").length > 0) {
                        sRowIndx = 0;
                        $("#pqgrid_W25F3020_1").pqGrid("setSelection", {rowIndx: 0});
                        var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                        // console.log(rowData.IsApproveCV);
                        viewDetail(rowData.InterviewFileID, rowData.IsApproveCV);
                    } else {
                        $("#pqgrid_W25F3020_2").pqGrid("option", "dataModel.data", []);
                        $("#pqgrid_W25F3020_2").pqGrid("refreshDataAndView");
                    }
                },
                rowClick: function (event, ui) {
                    //console.log(ui.rowData.IsApproveCV);
                    sRowIndx = ui.rowIndx;
                    viewDetail(ui.rowData.InterviewFileID, ui.rowData.IsApproveCV);
                }
            };
            //obj1.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
            $("#pqgrid_W25F3020_1").pqGrid(obj1);
            $("#pqgrid_W25F3020_1").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#pqgrid_W25F3020_1").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            setTimeout(function () {
                $("#pqgrid_W25F3020_1").pqGrid("refreshDataAndView");
            }, 700)


        });

    }

    function loadRightGrid() {
        var iW25F3020_2Height = $(document).height() - 220;
        $.ajax({
            method: "POST",
            url: '{{url("/W25F3020/$pForm/$g/loadDD")}}',
            success: function (data) {
                statusCombo = data;
                var obj2 = {
                    width: '100%',
                    height: iW25F3020_2Height,
                    showTitle: false,
                    collapsible: false,
                    editable: checkAproveCV,
                    postRenderInterval: -1,
                    hwrap: false,
                    wrap: false,
                    selectionModel: {type: 'row', mode: 'single'},
                    filterModel: {on: true, mode: "AND", header: true},
                    editModel: {
                        saveKey: $.ui.keyCode.ENTER,
                        select: true,
                        keyUpDown: false,
                        cellBorderWidth: 0,
                        clicksToEdit: 1
                    },
                    colModel: [
                        {
                            title: "IsEdit",
                            minWidth: 90,
                            align: "left",
                            dataIndx: "IsEdit",
                            isExport: false,
                            editor: false,
                            hidden: true
                        },
                        {
                            title: '{{Helpers::getRS($g,"Ma_ung_vien")}}',
                            minWidth: 90,
                            align: "left",
                            dataIndx: "CandidateID",
                            isExport: true,
                            editor: false,
                            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }

                        },
                        {
                            title:'{{Helpers::getRS($g,"Ten_ung_vien")}}',
                            minWidth: 120,
                            dataType: "string",
                            dataIndx: "CandidateName",
                            editor: false,
                            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Ngay_phong_van")}}',
                            minWidth: 130,
                            dataType: "date",
                            align: "center",
                            editor: false,
                            dataIndx: "IntDate",
                            filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']},
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Gio_phong_van")}}',
                            minWidth: 130,
                            align: "center",
                            dataType: "string",
                            editor: false,
                            dataIndx: "IntTime",
                            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Nguoi_phong_van")}}',
                            minWidth: 160,
                            editor: false,
                            dataIndx: "InterviewerName",
                            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Don_vi")}}',
                            minWidth: 100,
                            dataType: "integer",
                            editor: false,
                            dataIndx: "DivisionName",
                            align: 'left',
                            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Khoi")}}',
                            minWidth: 130,
                            dataType: "string",
                            editor: false,
                            dataIndx: "BlockName",
                            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Phong_ban")}}',
                            minWidth: 90,
                            dataType: "string",
                            editor: false,
                            dataIndx: "DepartmentName",
                            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"To_nhom")}}',
                            minWidth: 90,
                            editor: false,
                            dataIndx: "TeamName",
                            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Vi_tri")}}',
                            minWidth: 200,
                            editor: false,
                            dataIndx: "RecPositionName",
                            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Du_an")}}',
                            minWidth: 200,
                            editor: false,
                            dataIndx: "ProjectName",
                            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Gioi_tinh")}}',
                            minWidth: 80,
                            align: "center",
                            dataIndx: "SexName",
                            isExport: true,
                            editor: false,
                            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }

                        },
                        {
                            title: '{{Helpers::getRS($g,"Ngay_sinh")}}',
                            minWidth: 100,
                            dataType: "date",
                            dataIndx: "BirthDate",
                            editor: false,
                            align: "center",
                            filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']},
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Ngay_nhan_HS")}}',
                            minWidth: 100,
                            dataType: "date",
                            editor: false,
                            align: "center",
                            dataIndx: "ReceivedDate",
                            filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']},
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Nguoi_nhan_HS")}}',
                            minWidth: 130,
                            dataType: "string",
                            editor: false,
                            dataIndx: "ReceiverName",
                            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Noi_nhan_HS")}}',
                            minWidth: 160,
                            editor: false,
                            dataIndx: "ReceivedPlace",
                            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Luong_yeu_cau")}}',
                            minWidth: 100,
                            dataType: "integer",
                            editor: false,
                            dataIndx: "DesiredSalary",
                            align: 'right',
                            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    text: format2(ui.rowData.DesiredSalary, '', 0),
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Loai_tien")}}',
                            minWidth: 90,
                            dataType: "string",
                            editor: false,
                            dataIndx: "CurrencyID",
                            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Nguon_tuyen_dung")}}',
                            minWidth: 130,
                            dataType: "string",
                            editor: false,
                            dataIndx: "RecsourceName",
                            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Nguoi_gioi_thieu")}}',
                            minWidth: 160,
                            editor: false,
                            dataIndx: "SuggesterName",
                            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: "IntStatusID",
                            minWidth: 200,
                            dataIndx: "IntStatusID",
                            hidden: true,
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"Ket_qua_PV")}}',
                            minWidth: 200,
                            dataIndx: "InStatusName",
                            showGrid: true,
                            hidden: false,
                            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                            editor: {
                                type: 'select',
                                valueIndx: "ID",
                                labelIndx: "Name",
                                mapIndices: {"ID": "IntStatusID", "Name": "InStatusName"},
                                options: statusCombo

                            },
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                // console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false;
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }

                        },
                        {
                            title: '{{Helpers::getRS($g,"Danh_gia_ket_qua_PV")}}',
                            minWidth: 200,
                            editor: checkAproveCV,
                            dataIndx: "Result",
                            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        },
                        {
                            title: '{{Helpers::getRS($g,"CV_ung_vien")}}',
                            minWidth: 100,
                            editor: false,
                            dataIndx: "Profile",
                            align: "center",
                            /*render: function (ui) {
                                return "<a class='glyphicon glyphicon-download-alt mgr5' id = 'btnDownload' style='margin-top:2px;color:blue'></a>";
                            },*/
                            postRender: function (ui) {
                                var grid = this, $cell = grid.getCell(ui);

                                //downLoad
                                $cell.find("a#btnDownload").unbind("click").bind("click", function (evt) {
                                    // console.log(ui.rowData.CandidateID);
                                    var candidateID = ui.rowData.CandidateID;
                                    downLoad(candidateID);
                                });
                            },
                            editable: function (ui) {
                                var rowData = getRowSelection($("#pqgrid_W25F3020_1"));
                                //IsApproveCV
                                //console.log(rowData)
                                if (rowData != null) {
                                    return Number(rowData.IsApproveCV) == 1 ? true : false
                                } else {
                                    return false;
                                }
                            },
                            render: function (ui) {
                                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                                return {
                                    text: "<a class='glyphicon glyphicon-download-alt mgr5' id = 'btnDownload' style='margin-top:2px;color:blue; font-size: 70%'></a>",
                                    cls: (disabled ? "readonly-status" : "")
                                };
                            }
                        }
                    ],
                    dataModel: {
                        data: data2,
                        location: "local",
                        sorting: "local",
                        sortDir: "down"
                    },
                    complete: function (event, ui) {
                        console.log('complete grid 2');
                       // console.log(checkAproveCV);
                    },
                    create: function () {

                    },
                    cellSave: function (event, ui) {
                        console.log("cellSave");
                        ui.rowData.IsEdit = 1;
                        $("#pqgrid_W25F3020_2").pqGrid("refreshDataAndView");
                    }
                };
                //obj2.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
                $("#pqgrid_W25F3020_2").pqGrid(obj2);
                $("#pqgrid_W25F3020_2").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
                $("#pqgrid_W25F3020_2").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
                setTimeout(function () {
                    $("#pqgrid_W25F3020_2").pqGrid("refreshDataAndView");
                }, 700)

            }
        });
    }

    function loadDD() {
        $.ajax({
            method: "POST",
            url: '{{url("/W25F3020/$pForm/$g/loadDD")}}',
            // data: "&key1=" + isPedding + "&isCancel="+isCancel + "&interviewFileID="+keyW25F3020,
            success: function (data) {
                console.log("da chay dd");
                ddValue = data;
            }
        });
    }

    function downLoad(candidateID) {
        console.log(candidateID);
        $.ajax({
            method: "POST",
            url: '{{url("/W25F3020/$pForm/$g/download")}}',
            data: "&candidateID=" + candidateID,
            success: function (data) {
                console.log("da chay download");
                console.log(data);
                window.open(data.trim(), "_blank");
            }
        });
    }

    function save() {
        var rowData = $("#pqgrid_W25F3020_1").pqGrid("getRowData", {rowIndxPage: sRowIndx});
        var InterviewFileID = rowData.InterviewFileID;
        var InterviewLevelID = rowData.InterviewLevelID;
        var data = $("#pqgrid_W25F3020_2").pqGrid("option", "dataModel.data");
        var dataSender = $.grep(data, function (d) {
            return d.IsEdit == 1;
        });
        if (dataSender.length > 0) {
            $.ajax({
                method: "POST",
                url: '{{url("/W25F3020/$pForm/$g/checkBeforeSave")}}',
                data: {
                    interviewFileID: InterviewFileID,
                    interviewLevelID: InterviewLevelID
                },
                success: function (data) {
                    console.log(data);
                    if (data.length > 0) {
                        if (data[0].STATUS == "1") {
                            alert_warning(data[0].Message);
                        } else {

                            console.log(dataSender);
                            $.ajax({
                                method: "POST",
                                url: '{{url("/W25F3020/$pForm/$g/save")}}',
                                data: {
                                    dataSender: dataSender
                                },
                                success: function (data) {
                                    console.log(data);
                                    if (data.status == 1) {
                                        save_ok();
                                    } else {
                                        save_not_ok();
                                    }
                                }
                            });
                        }
                    }

                }
            });
        } else {
            alert_warning("Chưa có cập nhật nào mới");
        }

    }

    var W25F3020ExportExcel=function() {
        var _title = [];
        var _dataIndx =[];
        var _align = [];
        var _format = [];
        initExportExcell($("#pqgrid_W25F3020_2"),_title,_dataIndx,_align,_format);
        var _data = JSON.stringify($("#pqgrid_W25F3020_2").pqGrid("option", "dataModel.data"));

        $.ajax({
            method: "POST",
            data: {title: _title, data:_data, dataIndx: _dataIndx, align:_align, format: _format},
            url: "{{url('/Export')}}",
            success: function (data) {
                if(data==0) {
                    alert_error('{{Helpers::getRS(5,'Loi_xuat_file')}}')
                }
                else {
                    var downloadLink = document.createElement("a");
                    downloadLink.download = "Interview Appointment" + new Date().getTime()+".xls";
                    downloadLink.innerHTML = "Interview Appointment";
                    downloadLink.href =data;
                    downloadLink.onclick = destroyClickedElement;
                    downloadLink.style.display = "none";
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                }
            }
        });
    };

    $("#frm_btnSendmail").click(function (event) {
        console.log('frm_btnSendmail');
        $("#mPopUpSendMail").modal('show');
    });
</script>