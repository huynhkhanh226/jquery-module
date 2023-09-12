<style>
    .datepicker-week thead tbody tr td {
        line-height: 0.6 !important;
    }

    .datepicker-week table tbody tr td {
        line-height: 0.6 !important;
    }

    .datepicker-week table tfoot tr td {
        line-height: 0.6 !important;
    }

    .datepicker-week .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        line-height: 0.6 !important;
    }

    .datepicker-week .datepicker table tr td, .datepicker table tr th {
        height: 10px !important;
        /*width: 90px !important;*/
        font-size: 14px;
    }

    .datepicker-week .datepicker table {
        width: 100% !important;
    }

    .datepicker-week {
        border: 2px double #ccc;
        border-radius: 5px;
    }
</style>
<?php
$lang = Session::get("locate");
?>
<div class="modal fade pd0" id="modalW76F2110" data-backdrop="static" role="dialog" style="position: absolute">
    <div id="test" class="modal-dialog modal-lg" style="width: 95%;">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($caption,"W76F2110", true, "")}}

            </div>
            <div class="modal-body">
                <form class="form-horizontal form-group" id="frmW76F2110" name="frmW76F2110" method="post">
                    <div class="row mgt5">
                        <div class="col-md-3 pdr0">
                            <div class="datepicker-week" style="height:160px"></div>
                        </div>
                        <div class="col-md-9">
                            <div class="row form-group">
                                <div class="col-md-2">
                                    <label class="liketext lbl-normal ">{{Helpers::getRS($g,"Nhan_vien")}}</label>
                                </div>
                                <div class="col-md-6">
                                    <select id="cbEmployeeW76F2110" name="cbEmployeeW76F2110"
                                            class="form-control select2 required" data-actions-box="true"
                                            data-live-search="true" required>
                                        @foreach($assigneeList as $rowAssginee)
                                            <option title="{{$rowAssginee['Assignee']}}" manager-id="{{$rowAssginee['ManagerID']}}"
                                                    value="{{$rowAssginee['Assignee']}}" {{$userID == $rowAssginee['Assignee'] ? 'selected': ''}} >{{"(".$rowAssginee['Assignee']. ") ".$rowAssginee['AssigneeName']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 hide">
                                    <input type="text" class="form-control" id="cbEmployeeNameW76F2110"
                                           value=""
                                           readonly
                                           name="cbEmployeeNameW76F2110">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="liketext lbl-normal ">{{Helpers::getRS($g,"Tuan_so")}}</label>
                                </div>
                                <div class="col-md-1">
                                    <input class="form-control text-right" name="txtWeekNumW76F2110"
                                           id="txtWeekNumW76F2110" type="text"
                                           readonly
                                    />
                                </div>
                                <div class="col-md-4">
                                    <label style="padding-top: 3px;" class="mgl10"><label
                                                id="lblDateFromW76F2110">10/10/2016</label> - <label
                                                id="lblDateToW76F2110">10/10/2017</label></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12" id="divW76F2110">
                        <div id="gridW76F2110" class="mgb5"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>

<script type="text/javascript">
    var assigneeList_value = $("#cbEmployeeW76F2110").val();
    var assigneeList_temp ={{json_encode($assigneeList)}};
    var dsTimeSheet = {};
    var cbEmChange = 0; //bien phan biet thay doi gia tri cb Employee.
    var test = "{{$userID}}";


    initGridW76F2110();
    $("#cbEmployeeW76F2110").select2({
        language: "vi"

    });
    /* $("#cbEmployeeW76F2110").change(function () {

         $("#gridW76F2110").pqGrid("refreshDataAndView");
         //alert(cbEmployeeW76F2110.val());
     });*/

    $(document).ready(function () {
        //Set up default cho text nhan vien
        /* setTimeout(function (e) {
             $('#cbEmployeeW76F2110').trigger('change');
         }, 300);*/

        $('#cbEmployeeW76F2110').on('change', function (e) {
            var $grid = $("#gridW76F2110");
            var rowData = $('#cbEmployeeW76F2110').select2('data')[0];
            $("#cbEmployeeNameW76F2110").val(rowData["text"]);
//            var cbEmployeeW76F2110 = $("#cbEmployeeW76F2110");
//            var clAction = $grid.pqGrid("getColumn", {dataIndx: "action"});
//            if (cbEmployeeW76F2110.val() == assigneeList_value) {//truong hop gia tri bang userID
//                cbEmChange = 1;
//                clAction.hidden = false;
//            } else {
//                cbEmChange = 0;
//                clAction.hidden = true;
//            }
//            clAction.minWidth = 90;
//            $("#gridW76F2110").pqGrid("refreshDataAndView");
            reLoadGridW76F2110();
        });

        var $weekPicker = $('.datepicker-week');
        $weekPicker.datepicker({
            calendarWeeks: true,
            //maxViewMode: 0,
            weekStart: 1,
            language: '{{$lang}}'
            //setDate: new Date()
        }).on('changeDate', function (e) {
            if ($weekPicker.data('updating') === true) {
                return;
            }
            $weekPicker.data('updating', true);
            var monday = moment(e.date).startOf('isoWeek');
            weekDates = [];
            weekDates = [
                monday.clone().toDate(),
                monday.clone().add(1, "days").toDate(),
                monday.clone().add(2, "days").toDate(),
                monday.clone().add(3, "days").toDate(),
                monday.clone().add(4, "days").toDate(),
                monday.clone().add(5, "days").toDate(),
                monday.clone().add(6, "days").toDate()

            ];
            weekNum = moment(e.date).isoWeeks();
            $(this).datepicker('clearDate').datepicker('setDates', weekDates);
            $weekPicker.data('updating', false);
            var assignee = $("#cbEmployeeW76F2110").val();
            var fromDate = weekDates[0].toString("dd/MM/yyyy");
            var toDate = weekDates[6].toString("dd/MM/yyyy");
            var weekno = moment(e.date).isoWeeks()
            $("#lblDateFromW76F2110").html(fromDate);
            $("#lblDateToW76F2110").html(toDate);
            $("#txtWeekNumW76F2110").val(weekno);


            reLoadGridW76F2110();
        }).datepicker("setDate", Date.now());
        setTimeout(function () {
            resizePqGrid();
        }, 300);
    });


    function reLoadGridW76F2110() {
        //$(".l3loading").removeClass('hide');

        var assignee = $("#cbEmployeeW76F2110").val();
        var dateFrom = $("#lblDateFromW76F2110").html();
        var dateTo = $("#lblDateToW76F2110").html();
        var weekNum = $("#txtWeekNumW76F2110").val();


        $("#gridW76F2110").pqGrid("showLoading");
        $.ajax({
            method: "POST",
            url: "W76F2110/{{$pForm}}/{{$g}}/reloadgrid",
            data: {
                assignee: assignee,
                weekNum: weekNum,
                dateFrom: dateFrom,
                dateTo: dateTo
            },
            success: function (data) {
                //$(".l3loading").addClass('hide');
                $("#gridW76F2110").pqGrid("hideLoading");
                $("#gridW76F2110").pqGrid("option", "dataModel.data", data);
                $("#gridW76F2110").pqGrid("refreshDataAndView");
                if (data.length == 0) {
                    $gridW76F2110 = $("#gridW76F2110")
                    addNewW76F2110($gridW76F2110);
                } else {
                }
            }
        });
    }

    function addNewW76F2110(rowData) {
        /*var rowIndex = $gridW76F2110.pqGrid("addRow",
            {
                rowData: {
                    TaskID: "",
                    IsHyperlink: "",
                    Date: null,
                    Day: "",
                    Location: "",
                    D17CompanyName: "",
                    TaskTypeName: "",
                    Results: "",
                    ActEvaluation: ""

                }
            }
        );
        var colIndx = $gridW76F2110.pqGrid("getColIndx", {dataIndx: "Day"});
        $gridW76F2110.pqGrid("setSelection", {
            rowIndx: rowIndex,
            colIndx: colIndx
        });*/
        //alert("Show form");
        showFormDialogPost("{{url('/W76F2111/'.$pForm.'/'.$g.'/add')}}", "modalW76F2111", {
            data: JSON.stringify(rowData),
            dateFrom: rowData.ExecuteFrom,
            dateTo: rowData.ExecuteTo,
            numWeek: $("#txtWeekNumW76F2110").val()
        }, 2)
    }


    function initGridW76F2110() {
        obj = {
            width: "100%",
            //height: $(document).height() - 300,
            height: $(window).height() - 350,
            editable: true,
            dataType: "JSON",
            //numberCell: { resizable: true, title: "#", align: "center" },
            minWidth: 30,
            selectionModel: {type: 'row'},
            //scrollModel: {autoFit: true},
            scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
            showTitle: false,
            wrap: true,
            hwrap: true,
            collapsible: false,
            postRenderInterval: -1,

            colModel: [
                // if(assigneeList_temp!=assigneeList_value){
                {
                    title: "",
                    editable: false,
                    width: 90,
                    maxWidth: 90,
                    dataIndx: "action",
                    align: "center",
                    sortable: false,
                    hidden: false,
                    render: function (ui) {
                        var rowData = ui.rowData;
                        console.log('vinh', rowData['CompleteStatus']);
                        var str = "";
                        var perD76F2110 = Number('{{$perD76F2110}}');
                        //rowData['CompleteStatus']!= 10

                        var assignee = $("#cbEmployeeW76F2110").val();
                        var userID = '{{$userID}}';
                        var managerID = $('#cbEmployeeW76F2110 option:selected').attr('manager-id');
                        console.log(managerID)
                        if (userID == assignee) {
                            if (perD76F2110 >= 2)
                                str += "<a title='{{Helpers::getRS($g,"Them")}}' id='btnAddW76F2110'><i class='glyphicon glyphicon-plus text-primary pdr5'></i></a>";
                            else
                                str += "<a title='{{Helpers::getRS($g,"Them")}}'><i class='glyphicon glyphicon-plus text-gray pdr5'></i></a>";
                            if (perD76F2110 >= 1 && rowData["CompleteStatus"] != 10)
                                str += '<a  title="{{Helpers::getRS($g,"Xem")}}" id = "btnViewW76F2110"><i class="glyphicon glyphicon-search text-yellow pdr5" style="font-size: 95%"></i></a>';
                            else
                                str += '<a  disabled title="{{Helpers::getRS($g,"Xem")}}"><i class="glyphicon glyphicon-search  text-gray pdr5" style="font-size: 95%"></i></a>';
                            if (perD76F2110 >= 3 && rowData["CompleteStatus"] == 0)
                                str += "<a title='{{Helpers::getRS($g,"Sua")}}' id='btnEditW76F2110'><i class='fa fa-edit text-yellow pdr5'></i></a>";
                            else
                                str += "<a disabled title='{{Helpers::getRS($g,"Sua")}}'><i class='fa fa-edit text-gray  pdr5'></i></a>";
                            if (perD76F2110 >= 4 && (rowData["CompleteStatus"] == 0 || rowData["CompleteStatus"] == 1))
                                str += "<a title='{{Helpers::getRS($g,"Xoa")}}' id='btnDeleteW76F2110'><i class='fa fa-trash text-red'></i></a> ";
                            else
                                str += "<a  disabled title='{{Helpers::getRS($g,"Xoa")}}'><i  class='fa fa-trash text-gray '></i></a> ";
                        }
                        if (userID != assignee && managerID.indexOf(userID) >= 0) {
                            str += "<a title='{{Helpers::getRS($g,"Them")}}'><i class='glyphicon glyphicon-plus text-gray pdr5'></i></a>";
                            if (perD76F2110 >= 1 && rowData["CompleteStatus"] != 10)
                                str += '<a  title="{{Helpers::getRS($g,"Xem")}}" id = "btnViewW76F2110"><i class="glyphicon glyphicon-search text-yellow pdr5" style="font-size: 95%"></i></a>';
                            else
                                str += '<a  disabled title="{{Helpers::getRS($g,"Xem")}}"><i class="glyphicon glyphicon-search  text-gray pdr5" style="font-size: 95%"></i></a>';
                            str += "<a disabled title='{{Helpers::getRS($g,"Sua")}}'><i class='fa fa-edit text-gray  pdr5'></i></a>";
                            str += "<a  disabled title='{{Helpers::getRS($g,"Xoa")}}'><i  class='fa fa-trash text-gray '></i></a> ";
                        }
                        if (userID != assignee && managerID.indexOf(userID) == -1) {
                            str += "<a title='{{Helpers::getRS($g,"Them")}}'><i class='glyphicon glyphicon-plus text-gray pdr5'></i></a>";
                            str += '<a  disabled title="{{Helpers::getRS($g,"Xem")}}"><i class="glyphicon glyphicon-search  text-gray pdr5" style="font-size: 95%"></i></a>';
                            str += "<a disabled title='{{Helpers::getRS($g,"Sua")}}'><i class='fa fa-edit text-gray  pdr5'></i></a>";
                            str += "<a  disabled title='{{Helpers::getRS($g,"Xoa")}}'><i  class='fa fa-trash text-gray '></i></a> ";
                        }
                        return str;

                    },
                    postRender: function (ui) {
                        var rowData = ui.rowData;
                        var rowIndx = ui.rowIndx,
                            $gridW76F2110 = this,
                            $cell = $gridW76F2110.getCell(ui);

                        $cell.find("a#btnAddW76F2110")
                            .unbind("click")
                            .bind("click", function (evt) {
                                $gridW76F2110 = $("#gridW76F2110")
                                addNewW76F2110(rowData);
                            });

                        //add button
                        $cell.find("a#btnDeleteW76F2110")
                            .unbind("click")
                            .bind("click", function (evt) {
                                $gridW76F2110 = $("#gridW76F2110")
                                deleteW76F2110(rowData);
                            });

                        $cell.find("a#btnViewW76F2110")
                            .unbind("click")
                            .bind("click", function (evt) {
                                $gridW76F2110 = $("#gridW76F2110")
                                showFormDialogPost("{{url('/W76F2111/'.$pForm.'/'.$g.'/view')}}", "modalW76F2111", {
                                    data: JSON.stringify(rowData),
                                    dateFrom: rowData.ExecuteFrom,
                                    dateTo: rowData.ExecuteTo,
                                    weekNum: $("#txtWeekNumW76F2110").val()
                                }, 2)
                            });
                        $cell.find("a#btnEditW76F2110")
                            .unbind("click")
                            .bind("click", function (evt) {
                                $gridW76F2110 = $("#gridW76F2110")
                                postMethod("{{url('/W76F2111/'.$pForm.'/'.$g.'/checkstore')}}", function (res) {
                                    res = JSON.parse(res);
                                    switch (res.status) {
                                        case 'CHECKSTORE':
                                            alert_error(res.message);
                                            break;
                                        case 'ERROR':
                                            alert_error(res.message);
                                            break;
                                        case 'OKAY':
                                            showFormDialogPost("{{url('/W76F2111/'.$pForm.'/'.$g.'/edit')}}", "modalW76F2111", {
                                                data: JSON.stringify(rowData),
                                                dateFrom: rowData.ExecuteFrom,
                                                dateTo: rowData.ExecuteTo,
                                                weekNum: $("#txtWeekNumW76F2110").val()
                                            }, 2)
                                            break;
                                    }
                                }, {
                                    assignee: rowData.Assignee,
                                    TaskID: rowData.TaskID,
                                    dateFrom: rowData.ExecuteFrom,
                                    dateTo: rowData.ExecuteTo,
                                    weekNum: $("#txtWeekNumW76F2110").val()
                                });

                            });
                    }
                },

                // }

                {
                    title: "TaskID",
                    dataIndx: "TaskID",
                    hidden: true,
                    minWidth: 140,
                    editor: {select: true},
                    showGrid: true,
                    editable: false,
                }
                , {
                    title: "IsHyperlink",
                    dataIndx: "IsHyperlink",
                    hidden: true,
                    minWidth: 140,
                    editor: {select: true},
                    showGrid: true,
                    editable: false,
                }
                , {
                    title: "Date",
                    dataIndx: "Date",
                    hidden: true,
                    minWidth: 140,
                    editor: {select: true},
                    showGrid: true,
                    editable: false,
                }
                , {
                    title: "{{Helpers::getRS($g, 'Thu')}}",
                    dataIndx: "Day",
                    minWidth: 140,
                    editor: {select: true},
                    showGrid: true,
                    editable: false

                }
                , {
                    title: "{{Helpers::getRS($g, 'Dia_diem')}}",
                    dataIndx: "Location",
                    minWidth: 140,
                    editor: {select: true},
                    showGrid: true,
                    editable: false

                }

                , {
                    title: "{{Helpers::getRS($g, 'Cong_viec')}}",
                    dataIndx: "TaskTypeName",
                    minWidth: 140,
                    editor: {select: true},
                    showGrid: true,
                    editable: false

                }
                , {
                    title: "{{Helpers::getRS($g, 'Ket_qua')}}",
                    dataIndx: "Results",
                    minWidth: 140,
                    editor: {select: true},
                    showGrid: true,
                    editable: false
                }
                , {
                    title: "{{Helpers::getRS($g, "To_chuc").'/'.Helpers::getRS($g, "Ca_nhan")}}",
                    dataIndx: "D17CompanyName",
                    minWidth: 140,
                    editor: {select: true},
                    showGrid: true,
                    editable: false

                }
                , {
                    title: "{{Helpers::getRS($g, 'Danh_gia')}}",
                    dataIndx: "ActEvaluation",
                    minWidth: 140,
                    editor: {select: true},
                    showGrid: true,
                    editable: false
                }
                , {
                    title: "{{Helpers::getRS($g, 'Luot_tim_kiem_moi')}}",
                    dataIndx: "IsNewFind",
                    minWidth: 10,
                    width: 80,
                    editor: {select: true},
                    showGrid: true,
                    editable: false,
                    align: "center",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        return "<input type='checkbox' disabled='disabled' " + (rowData[ui.dataIndx] == 1 ? 'checked' : '') + "/>"
                    }
                }
                , {
                    title: "{{Helpers::getRS($g, 'Trang_thai')}}",
                    dataIndx: "StatusName",
                    minWidth: 10,
                    width: 110,
                    editor: {select: true},
                    showGrid: true,
                    editable: false,
                    align: "center"

                }
                , {
                    title: "{{Helpers::getRS($g, 'Dinh_kem')}}",
                    dataIndx: "IsAttached",
                    minWidth: 10,
                    width: 80,
                    editor: {select: true},
                    showGrid: true,
                    editable: false,
                    align: "center",
                    render: function (ui) {
                        var rowData = ui.rowData;
                        //return "<a taskID='"+rowData.TaskID+"' style='color: #3c8dbc !important' onclick='showAttachment(this)'>("+ rowData[ui.dataIndx] + ")</a>";
                        @if (intval($perD76F2110) >= 1)
                        if (isNullOrEmpty(rowData[ui.dataIndx]) || Number(rowData[ui.dataIndx]) == 0) {
                            return "";
                        } else {
                            return "<a taskID='" + rowData.TaskID + "' style='color: #3c8dbc !important' onclick='showAttachment(this)'><span class='fa fa-paperclip mgr5 '></span>(" + rowData[ui.dataIndx] + ")</a>";
                        }
                        @else
                            return "";
                        @endif

                    }
                }
            ],
            dataModel: {
                data: dsTimeSheet

            },
            editModel: {
                saveKey: $.ui.keyCode.ENTER,
                select: true,
                keyUpDown: false,
                cellBorderWidth: 0,
                onBlur: "save",
                clicksToEdit: 2
            }
        };
        $gridW76F2110 = $("#gridW76F2110").pqGrid(obj);
        $gridW76F2110.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        $gridW76F2110.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        $gridW76F2110.pqGrid("refreshDataAndView");
    }


    function showAttachment(el) {
        showFormDialogPost('{{url("/W09F4010/$pForm/$g")}}', "modalW09F4010",
            {
                formCall: "W76F2111",
                keyID: $(el).attr('taskID'),
                tableName: 'D76T2050',
                useParentPermission: 1
            }, 6, null, null, function () {
                reLoadGridW76F2110();
            });
    }

    function deleteW76F2110(rowData) {

        ask_delete(function () {
            postMethod("W76F2110/{{$pForm}}/{{$g}}/delete", function (res) {

                res = JSON.parse(res);
                switch (res.status) {
                    case 'CHECKSTORE':
                        alert_error(res.message);
                        break;
                    case 'ERROR':
                        alert_error(res.message);
                        break;
                    case 'OKAY':
                        delete_ok(function () {
                            reLoadGridW76F2110();
                        });
                }
            }, {
                assignee: rowData.Assignee,
                TaskID: rowData.TaskID,
                dateFrom: rowData.ExecuteFrom,
                dateTo: rowData.ExecuteTo,
                weekNum: $("#txtWeekNumW76F2110").val()
            });
        });


    }

</script>


