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
        width: 90px !important;
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
<script>
    var editedGrid = false;
</script>
<div class="modal draggable fade pd0" id="modalW09F2920" data-backdrop="static" role="dialog">
    @if (count($masterW09F2920) > 0)
        @define $employeeID = $masterW09F2920[0]["EmployeeID"]
        @define $employeeName = $masterW09F2920[0]["EmployeeName"]
        @define $departmentID = $masterW09F2920[0]["DepartmentID"]
        @define $departmentName = $masterW09F2920[0]["DepartmentName"]
        @define $dutyID = $masterW09F2920[0]["DutyID"]
        @define $dutyName = $masterW09F2920[0]["DutyName"]
        @define $userID = $masterW09F2920[0]["UserID"]
        @define $directManagerID = $masterW09F2920[0]["DirectManagerID"]
        @define $directManagerName = $masterW09F2920[0]["DirectManagerName"]
    @else
        @define $employeeID = ""
        @define $employeeName = ""
        @define $departmentID = ""
        @define $departmentName = ""
        @define $dutyID = ""
        @define $dutyName = ""
        @define $userID = ""
        @define $directManagerID = ""
        @define $directManagerName = ""
    @endif
    @define $p = Session::get($pForm)
    <script>//////console.log('{{$pForm}}')</script>
    <div id="test" class="modal-dialog formduyet">
        <div class="modal-content">
            <!-- form start -->
            <form class="form-horizontal" id="frmW09F2920">
                <div class="modal-header logodg pdl0">
                    {{Helpers::generateHeading($caption,"W09F2920",true,"",true, $pForm, "W09F2920")}}
                </div>
                <div class="modal-body" style="padding: 10px">
                    <div class="row">
                        <div class="col-md-3 pdr0">
                            <div class="datepicker-week" style="height:160px"></div>
                        </div>
                        <div class="col-md-6 pdr0">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="liketext lbl-normal ">{{Helpers::getRS($g,"Nhan_vien")}}</label>
                                </div>
                                <div class="col-md-9">
                                    <label class="liketext  pdl0 pdr0">{{$employeeID == "" ? "" : $employeeID. " - ".$employeeName}}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="liketext lbl-normal">{{Helpers::getRS($g,"Nguoi_quan_ly_truc_tiep")}}
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <label class="liketext pdr0">{{$directManagerID == "" ? "" : $directManagerID. " - ".$directManagerName}}</label>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="liketext lbl-normal">{{Helpers::getRS($g,"Chuc_vu")}}</label>
                                </div>
                                <div class="col-md-9">
                                    <label class="liketext ">{{$dutyID == "" ? "" : $dutyID. " - ".$dutyName}}</label>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="liketext lbl-normal">{{Helpers::getRS($g,"Tuan_so")}}</label>
                                </div>
                                <div class="col-md-9">
                                    <input class="text-right" name="txtWeekNo" id="txtWeekNo" type="text"
                                           style="width:18%"
                                           disabled/>
                                    <label style="padding-top: 3px;" class="mgl10"><label
                                                id="lblDateFrom">10/10/2016</label> - <label
                                                id="lblDateTo">10/10/2017</label></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 pdl0">
                            <fieldset>
                                <legend class="legend"
                                        style="margin-bottom:10px">{{Helpers::getRS($g,"Ke_thua_thoi_gian_bieu")}}</legend>
                                <div class="row">
                                    <div class="col-md-12 pdl0">
                                        <input class="col-sm-3 pull-right" name="btnInherit" id="btnInherit"
                                               type="button" value="{{Helpers::getRS($g,"Ke_thua")}}"
                                               onclick="getInheritDate()"/>
                                        <input class="col-sm-3 text-right pull-right mgr5" name="txtWeekNoInherit"
                                               style="width:25%"
                                               id="txtWeekNoInherit" type="text"
                                               onkeyup="this.value=this.value.replace(/[^0-9]/g,'');"/>
                                        <label class="col-sm-4 liketext lbl-normal pull-right pdl0">{{Helpers::getRS($g,"Tuan_so")}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right pdt5">
                                        <label id="lblInheritDateFrom">{{$mon == "" ? "": $mon}}</label>
                                        <label id="lblInheritDateTo">{{$sun == "" ? "": $sun}}</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mgt10">
                            <div id="divGridW09F2920"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="padding-right:15px;">
                            @if ($p  >=2)
                                <button type="button" id="btnSaveW09F2920" name="btnSaveW09F2920"
                                        onclick="return allow_save(true);"
                                        class="btn btn-default smallbtn pull-right mgt5 "><span
                                            class="glyphicon glyphicon-floppy-saved mgr5"></span> {{Helpers::getRS($g,"Luu")}}
                                </button>
                            @endif
                            <button type="submit" id="hbtSaveW09F2920" class="hidden"></button>
                        </div>

                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
<div id="divDropDown">
    <div style="position: absolute; z-index: 100000; top: 0; display: none; " id="pgridProjectID">
        <div id="gridProjectID"></div>
    </div>
    <div style="position: absolute; z-index: 200000; top: 0; display: none; " id="pgridWorkID">
        <div id="gridWorkID"></div>
    </div>

</div>

<script type="text/javascript">

    var $dataProjectID;
    var $dataWorkID;



    function getInheritDate() {
        $("#lblInheritDateFrom").html("");
        $("#lblInheritDateTo").html("");
        ////console.log("weekNo" + $("#txtWeekNoInherit").val());
        if (editedGrid) {
            alert_custom(icon_ask, '{{Helpers::getRS($g,"Du_lieu_tren_luoi_se_bi_xoa_Ban_co_muon_thuc_hien_ko")}}', true, true, function () {
                editedGrid = false;
                $(".l3loading").removeClass('hide');
                $.ajax({
                    method: "POST",
                    url: "W09F2920/{{$pForm}}/{{$g}}/getinheritdate",
                    data: {
                        weekno: $("#txtWeekNoInherit").val()
                    },
                    success: function (data) {
                        $(".l3loading").addClass('hide');
                        var result = $.parseJSON(data);
                        $("#lblInheritDateFrom").html(result.mon + " - ");
                        $("#lblInheritDateTo").html(result.sun);
                        //////console.log(result.dsInherit);
                        //setter
                        $("#gridW09F2920").pqGrid("option", "dataModel", {data: result.dsInherit});
                        $("#gridW09F2920").pqGrid("refreshDataAndView");
                        if (result.dsInherit.length == 0) {

                            $gridW09F2920 = $("#gridW09F2920")
                            addNewW09F2920($gridW09F2920);
                        }
                    }
                });
            }, function () {
                //No
            });
        } else {
            $(".l3loading").removeClass('hide');
            $.ajax({
                method: "POST",
                url: "W09F2920/{{$pForm}}/{{$g}}/getinheritdate",
                data: {
                    weekno: $("#txtWeekNoInherit").val()
                },
                success: function (data) {
                    $(".l3loading").addClass('hide');
                    var result = $.parseJSON(data);
                    $("#lblInheritDateFrom").html(result.mon + " - ");
                    $("#lblInheritDateTo").html(result.sun);
                    ////console.log(result.dsInherit);
                    $("#gridW09F2920").pqGrid("option", "dataModel", {data: result.dsInherit});
                    $("#gridW09F2920").pqGrid("refreshDataAndView");
                    if (result.dsInherit.length == 0) {
                        $gridW09F2920 = $("#gridW09F2920")
                        addNewW09F2920($gridW09F2920);
                    }
                }
            });
        }


        return false;
    }

    function loadGridW09F2920() {
        $(".l3loading").removeClass('hide');
        //$("#gridW09F2920").html("");
        //$( "#gridW09F2920" ).pqGrid( "option", "dataModel", { data: []} );
        $.ajax({
            method: "POST",
            url: "W09F2920/{{$pForm}}/{{$g}}/loadgrid",
            data: {
                employeeID: employeeID,
                dateFrom: dateFrom,
                dateTo: dateTo
            },
            success: function (data) {
                $(".l3loading").addClass('hide');
                $("#divGridW09F2920").html(data);
            }
        });
    }

    function reLoadGridW09F2920(dateFrom, dateTo) {
        $(".l3loading").removeClass('hide');
        //$("#gridW09F2920").html("");
        //$( "#gridW09F2920" ).pqGrid( "option", "dataModel", { data: []} );
        $.ajax({
            method: "POST",
            url: "W09F2920/{{$pForm}}/{{$g}}/reloadgrid",
            data: {
                employeeID: '{{$employeeID}}',
                dateFrom: dateFrom,
                dateTo: dateTo
            },
            success: function (data) {
                $(".l3loading").addClass('hide');
                var result = $.parseJSON(data);
                console.log(data);
                $("#gridW09F2920").pqGrid("option", "dataModel", {data: result.dsTimeSheet});
                $("#gridW09F2920").pqGrid("refreshDataAndView");
                $("#btnInherit").prop("disabled", false);
                //$("#btnInherit").show();
                console.log(data);
                if (result.dsTimeSheet.length == 0) {
                    $gridW09F2920 = $("#gridW09F2920")
                    addNewW09F2920($gridW09F2920);
                } else {
                    $("#btnInherit").prop("disabled", true);
                    //$("#btnInherit").hide();
                }
                //setBackgroundColorW09F2920($gridW09F2920);
            }
        });
    }
    var weekDates;
    var weekNum;
    $(document).ready(function () {

        //$(".l3loading").removeClass('hide');
        $("#gridW09F2920").html("");
        $.ajax({
            method: "POST",
            url: "W09F2920/{{$pForm}}/{{$g}}/loadgrid",
            success: function (data) {
                //$(".l3loading").addClass('hide');
                $("#divGridW09F2920").html(data);
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
                    ////console.log("changeDate");
                    var monday = moment(e.date).startOf('isoWeek');
                    ////////console.log(monday);
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

                    //console.log(fromDate);

                    //////console.log("Check WeekNo");
                    if (editedGrid) {
                        alert_custom(icon_ask, "{{Helpers::getRS($g,"Du_lieu_chua_duoc_luu_Ban_co_muon_luu_khong_")}}", true, true, function () {
                            //yes
                            //editedGrid = false;
                            allow_save(false);
                        }, function () {
                            //No
                            var fromDate = weekDates[0].toString("dd/MM/yyyy");
                            var toDate = weekDates[6].toString("dd/MM/yyyy");
                            var weekno = moment(e.date).isoWeeks()
                            $("#lblDateFrom").html(fromDate);
                            $("#lblDateTo").html(toDate);
                            $("#txtWeekNo").val(weekno);
                            reLoadGridW09F2920(fromDate, toDate);
                            editedGrid = false;
                        });
                    } else {
                        var fromDate = weekDates[0].toString("dd/MM/yyyy");
                        var toDate = weekDates[6].toString("dd/MM/yyyy");
                        var weekno = moment(e.date).isoWeeks()
                        $("#lblDateFrom").html(fromDate);
                        $("#lblDateTo").html(toDate);
                        $("#txtWeekNo").val(weekno);
                        reLoadGridW09F2920(fromDate, toDate);
                    }

                }).datepicker("setDate", Date.now());
            }
        });

        setTimeout(function () {
            //setter
            $("#gridW09F2920").pqGrid("option", "width", $("#modalW09F2920").find(".modal-body").width());
            $("#gridW09F2920").pqGrid('refreshDataAndView');
        }, 1000);

        //set height
        $("#modalW09F2920").find(".modal-dialog").height($(document).height() - 100);


    });

    //$('.datepicker-week').datepicker("setDate", new Date());

    // luoi dự án
    var isgrid_project = false;
    $(function () {
        var data = {};
        var obj = {
            width: 550, height: 300,
            numberCell: {resizable: true, title: "#"},
            editable: false,
            collapsible: false,
            showTitle: false,
            resizable: false,
            //filterModel: {on: true, mode: "AND", header: true},
            parentBound: $("#pgridProjectID"),
            funcUpdate: updateRowGridProject,
            selectionModel: {type: 'row', fireSelectChange: true},
            swipeModel: {on: false},
            synElement: {},
            rowSelect: function (event, ui) {
                isgrid_project = true;
            }
        };
        obj.colModel = [
            {
                title: "{{Helpers::getRS(0,'Ma')}}",
                width: 150,
                dataIndx: "ProjectID",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS(0,'Ten')}}",
                width: 350,
                dataIndx: "ProjectName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            }
        ];
        obj.dataModel = {data: data};

        $("#gridProjectID").pqGrid(obj);

    });

    //update khi du an
    function updateRowGridProject(rowdt) {
        //console.log("updateRowGridProject");
        //console.log(rowdt);
        var obj = {
            "ProjectID": rowdt.ProjectID,
            'ProjectName': rowdt.ProjectName
        };
        updateCurrentRow(gbRowidx, obj, "WorkName");
        //var colIndex = $gridW09F2920.pqGrid("getColIndx", {dataIndx: "WorkID"});
        //$("#gridProjectID").pqGrid("setSelection", {rowIndx: gbRowidx, colIndx: colIndex});
        //$("#gridProjectID").pqGrid("editCell", {rowIndx: gbRowidx, dataIndx: "WorkID"});
        $("#divDropDown").css("display", "none");
    }

    // xủ lý cập nhật dòng trên lưới
    function updateCurrentRow(idx, obj, focus) {
        ////////console.log(obj);

        $gridW09F2920.pqGrid("quitEditMode");
        $gridW09F2920.pqGrid("updateRow",
                {rowIndx: idx, row: obj}
        );
        $gridW09F2920.pqGrid('refreshDataAndView');
        $gridW09F2920.pqGrid("scrollColumn", {dataIndx: focus});

        if (focus != "nextrow") {
            ////////////////////console.log("focus" + focus);
            //$gridW09F2920.pqGrid("editCell", {rowIndx: idx, dataIndx: focus});
            var colIndx = $gridW09F2920.pqGrid( "getColIndx", { dataIndx: focus } );
            $gridW09F2920.pqGrid("setSelection", {rowIndx: idx, colIndx: colIndx});
        }
    }

    // luoi cong viec
    var isgrid_work = false;
    $(function () {
        var data = {};
        var obj = {
            width: 550, height: 200,
            numberCell: {resizable: true, title: "#"},
            editable: false,
            collapsible: false,
            showTitle: false,
            //filterModel: {on: true, mode: "AND", header: true},
            resizable: false,
            parentBound: $("#pgridWorkID"),
            funcUpdate: updateRowGridWork,
            synElement: {},
            selectionModel: {type: 'row'},
            rowSelect: function (event, ui) {
                isgrid_work = true;
            }
        };
        obj.colModel = [

            {
                title: "{{Helpers::getRS(0,'Ma')}}",
                width: 150,
                dataIndx: "WorkID",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS(0,'Ten')}}",
                width: 350,
                dataIndx: "WorkName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            }
        ];
        obj.dataModel = {data: data};
        $("#gridWorkID").pqGrid(obj);

    });

    //update khi cong viec dc chon
    function updateRowGridWork(rowdt) {
        var obj = {
            "WorkID": rowdt.WorkID,
            'WorkName': rowdt.WorkName
        };
        updateCurrentRow(gbRowidx, obj, "Mon");
        $("#divDropDown").css("display", "none");
    }

    function allow_save(ask) {
        $gridW09F2920 = $("#gridW09F2920");
        $gridW09F2920.pqGrid("quitEditMode");
        var dataW09F2920 = $gridW09F2920.pqGrid("option", "dataModel.data");
        //////console.log(dataW09F2920);
        for (var iRow = 0; iRow < dataW09F2920.length; iRow++) {
            var a = format2(dataW09F2920[iRow]["Mon"] === undefined ? 0 : dataW09F2920[iRow]["Mon"], "", 2);
            var b = format2(dataW09F2920[iRow]["Tue"] === undefined ? 0 : dataW09F2920[iRow]["Tue"], "", 2);
            var c = format2(dataW09F2920[iRow]["Wed"] === undefined ? 0 : dataW09F2920[iRow]["Wed"], "", 2);
            var d = format2(dataW09F2920[iRow]["Thu"] === undefined ? 0 : dataW09F2920[iRow]["Thu"], "", 2);
            var e = format2(dataW09F2920[iRow]["Fri"] === undefined ? 0 : dataW09F2920[iRow]["Fri"], "", 2);
            var f = format2(dataW09F2920[iRow]["Sat"] === undefined ? 0 : dataW09F2920[iRow]["Sat"], "", 2);
            var j = format2(dataW09F2920[iRow]["Sun"] === undefined ? 0 : dataW09F2920[iRow]["Sun"], "", 2);
            dataW09F2920[iRow]["SumWeek"] = format2(Number(a) + Number(b) + Number(c) + Number(d) + Number(e) + Number(f) + Number(j), "", 2);
        }
        $gridW09F2920.pqGrid("option", "dataModel.data", dataW09F2920);
        $gridW09F2920.pqGrid('refreshDataAndView');
        if (ask) //Ask save
            ask_save(save_callback,"","",function(){
                var fromDate = weekDates[0].toString("dd/MM/yyyy");
                var toDate = weekDates[6].toString("dd/MM/yyyy");
                var weekno = moment(e.date).isoWeeks()
                $("#lblDateFrom").html(fromDate);
                $("#lblDateTo").html(toDate);
                $("#txtWeekNo").val(weekno);
                reLoadGridW09F2920($("#lblDateFrom").html(), $("#lblDateTo").html());
                editedGrid = false;
            },"");
        else
            save_callback();
    }

    function save_callback() {
        $gridW09F2920 = $("#gridW09F2920");
        $gridW09F2920.pqGrid("quitEditMode");
        var dataW09F2920 = $gridW09F2920.pqGrid("option", "dataModel.data");
        //console.log(dataW09F2920);
        //Kiem tra nhap 1 trong 2 cot du an va cong viec
        for (var iRow = 0; iRow < dataW09F2920.length; iRow++) {
            if ((dataW09F2920[iRow]["ProjectName"] == "" || dataW09F2920[iRow]["ProjectName"] === undefined) ) {
                alert_warning("{{Helpers::getRS($g,"Bat_buoc_nhap").' '.Helpers::getRS($g,"Du_an")}}", function () {
                    var colIndex = $gridW09F2920.pqGrid("getColIndx", {dataIndx: "ProjectName"});
                    $gridW09F2920.pqGrid("setSelection", {rowIndx: iRow, colIndx: colIndex});
                    //$gridW09F2920.pqGrid("editCell", {rowIndx: iRow, dataIndx: "ProjectName"});
                });
                return false;
            }
            if ((dataW09F2920[iRow]["WorkName"] == "" || dataW09F2920[iRow]["WorkName"] === undefined)) {
                alert_warning("{{Helpers::getRS($g,"Bat_buoc_nhap").' '.Helpers::getRS($g,"Cong_viec")}}", function () {
                    var colIndex = $gridW09F2920.pqGrid("getColIndx", {dataIndx: "WorkName"});
                    $gridW09F2920.pqGrid("setSelection", {rowIndx: iRow, colIndx: colIndex});
                    //$gridW09F2920.pqGrid("editCell", {rowIndx: iRow, dataIndx: "ProjectName"});
                });
                return false;
            }
        }

        for (var iRow = 0; iRow < dataW09F2920.length; iRow++) {
            var arrFilter = filter(dataW09F2920, {
                ProjectID: dataW09F2920[iRow]["ProjectID"],
                WorkID: dataW09F2920[iRow]["WorkID"]
            })

            console.log(arrFilter);
            if (arrFilter.length >= 2) {
                alert_warning("{{Helpers::getRS($g,"Du_lieu_tren_luoi_bi_trung")." ".Helpers::getRS($g,"Du_an")." ".Helpers::getRS($g,"_va_")." ".Helpers::getRS($g,"Cong_viec")}}", function () {
                    var colIndex = $gridW09F2920.pqGrid("getColIndx", {dataIndx: "ProjectName"});
                    $gridW09F2920.pqGrid("setSelection", {rowIndx: iRow, colIndx: colIndex});
                    //$gridW09F2920.pqGrid("editCell", {rowIndx: iRow, dataIndx: "ProjectName"});
                });
                return false;
            }
        }

        for (var iRow = 0; iRow < dataW09F2920.length; iRow++) {
            var rowData = $("#gridW09F2920").pqGrid("getRowData", {rowIndxPage: iRow});
            if (Number(rowData.SumWeek) <= 0) {
                alert_warning("{{Helpers::getRS($g,"Tong_gio_lam_viec")." ".Helpers::getRS($g,"phai_lon_hon_0")}}", function () {
                    var colIndex = $gridW09F2920.pqGrid("getColIndx", {dataIndx: "Mon"});
                    $gridW09F2920.pqGrid("setSelection", {rowIndx: iRow, colIndx: colIndex});
                    $gridW09F2920.pqGrid("editCell", {rowIndx: iRow, dataIndx: "Mon"});

                });
                return false;
            }
        }
        //Kiem tra khong duoc trung ProjectID va WorkID
        //--------------------------------------------------
        $("#frmW09F2920").find("#hbtSaveW09F2920").click();
    }

    $("#modalW09F2920").on('submit', '#frmW09F2920', function (e) {
        e.preventDefault();
        $(".l3loading").removeClass('hide');
        $gridW09F2920 = $("#gridW09F2920");
        var dataW09F2920 = $gridW09F2920.pqGrid("option", "dataModel.data");
        //Xu ly luu du lieu
        //////console.log("dfsd");
        $.ajax({
            method: "POST",
            url: "W09F2920/{{$pForm}}/{{$g}}/savedata",
            data: {
                employeeID: '{{$employeeID}}',
                dutyID: '{{$dutyID}}',
                dateFrom: $("#frmW09F2920").find("#lblDateFrom").html(),
                dateTo: $("#frmW09F2920").find("#lblDateTo").html(),
                weekNo: $("#txtWeekNo").val(),
                //hostname: location.hostname,
                dataW09F2920: JSON.stringify(dataW09F2920)
            },
            success: function (data) {
                $(".l3loading").addClass('hide');
                if (data == 1) {
                    save_ok();
                    editedGrid = false;
                    console.log("Save");
                    var fromDate = weekDates[0].toString("dd/MM/yyyy");
                    var toDate = weekDates[6].toString("dd/MM/yyyy");
                    var weekno = weekNum;
                    $("#lblDateFrom").html(fromDate);
                    $("#lblDateTo").html(toDate);
                    $("#txtWeekNo").val(weekno);
                    reLoadGridW09F2920($("#lblDateFrom").html(), $("#lblDateTo").html());
                } else {
                    save_not_ok();
                }

            }
        });
    });

    function filter(arr, criteria) {
        return arr.filter(function (obj) {
            return Object.keys(criteria).every(function (c) {
                return obj[c] == criteria[c];
            });
        });
    }

    function filter2(arr, criteria) {
        return arr.filter(function (obj) {
            return Object.keys(criteria).every(function (c) {
                //console.log(obj[c]);
                return criteria[c] == "" ? true : obj[c].toUpperCase().indexOf(criteria[c].toUpperCase()) >= 0;
            });
        });
    }


    $("#txtWeekNoInherit").on("keypress", function (e) {
        /* ENTER PRESSED*/
        if (e.keyCode == 13) {
            $("#btnInherit").trigger("click");
        }
    });

    $.ajax({
        method: "POST",
        //data: {strSearch: ""},
        url: "W09F2920/{{$pForm}}/{{$g}}/loadproject",
        success: function (dataProject) {
            $dataProjectID = dataProject;
        }

    });


    $.ajax({
        method: "POST",
        //data: {strSearch: sTr},
        url: "W09F2920/{{$pForm}} /{{$g}}/loadwork",
        success: function (dataWork) {
            $dataWorkID = dataWork;
        }
    });

</script>

