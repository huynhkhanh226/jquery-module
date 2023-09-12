<div class="modal fade" id="modalW38F3010" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($titleW38F3010,"W38F3010",true,"")}}
            </div>
            <div class="modal-body" style="padding:10px">
                <form id="frmW38F3010" name="frmW38F3010" method="post">
                    <div class="row form-group">
                        <div class = "col-xs-4 col-lg-4 col-md-4">
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Don_vi")}}</label>
                                </div>
                                <div class="col-xs-8 col-lg-8 col-md-8">
                                    <select class="form-control"
                                            id="cbDivisionIDW38F3010" name="cbDivisionIDW38F3010"
                                            placeholder="">
                                        @foreach($cbDivision as $row)
                                            <option value="{{$row['DivisionID']}}">{{$row['DivisionName']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class = "col-xs-4 col-lg-4 col-md-4">
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Ke_hoach_dao_tao")}}</label>
                                </div>
                                <div class="col-xs-8 col-lg-8 col-md-8">
                                    <select class="form-control"
                                            id="cbTrainingPlanIDW38F3010" name="cbTrainingPlanIDW38F3010"
                                            placeholder="">
                                        @foreach($cbPlanTran as $row)
                                            <option value="{{$row['TrainingPlanID']}}">{{$row['TrainingPlanName']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class = "col-xs-4 col-lg-4 col-md-4">
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Loai_hinh_dao_tao")}}</label>
                                </div>
                                <div class="col-xs-8 col-lg-8 col-md-8">
                                    <select class="form-control"
                                            id="cbTrainningTypeIDW38F3010" name="cbTrainningTypeIDW38F3010"
                                            placeholder="">
                                        @foreach($cbTranType as $row)
                                            <option value="{{$row['TrainningTypeID']}}">{{$row['TrainningTypeName']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class = "col-xs-4 col-lg-4 col-md-4">
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Thang_du_kien")}}</label>
                                </div>
                                <div class="col-xs-8 col-lg-8 col-md-8">
                                    <div class="row">
                                        <div class="col-xs-6 col-lg-6 col-md-6">
                                            <select class="form-control"
                                                    id="txtPeriodFromW38F3010" name="txtPeriodFromW38F3010"
                                                    placeholder="">
                                                @foreach($cbMonthYear as $row)
                                                    <option TempCol = "{{$row['TempCol']}}" value="{{$row['PeriodFrom']}}">{{$row['PeriodFrom']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xs-6 col-lg-6 col-md-6">
                                            <select class="form-control"
                                                    id="txtPeriodToW383010" name="txtPeriodToW383010"
                                                    placeholder="">
                                                @foreach($cbMonthYear as $row)
                                                    <option TempCol = "{{$row['TempCol']}}" value="{{$row['PeriodFrom']}}">{{$row['PeriodFrom']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "col-xs-4 col-lg-4 col-md-4">
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Phong_ban")}}</label>
                                </div>
                                <div class="col-xs-8 col-lg-8 col-md-8">
                                    <select class="form-control"
                                            id="cbDepartmentIDW38F3010" name="cbDepartmentIDW38F3010"
                                            placeholder="">
                                        @foreach($department as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class = "col-xs-4 col-lg-4 col-md-4">
                            <button class="btn btn-default smallbtn pull-right"><span class="digi digi-filter text-blue"></span>
                                &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                        </div>
                    </div>
                </form>
                <div class="row  form-group">
                    <div class="col-md-12 col-xs-12">
                        <div id="pqgrid_W38F3010"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var currentDay = new Date();
    var curYear = currentDay.getFullYear();
    $(document).ready(function () {
        loadGrid();
        $("#txtPeriodFromW38F3010").val("01/" + curYear);
        $("#txtPeriodToW383010").val("12/" + curYear);
    });

    $("#frmW38F3010").on('submit', function (e) {
        e.preventDefault();
        //alert("da chay fillter");
        filterGrid();
    });

    $("#txtPeriodFromW38F3010").change(function () {
        monthChange();
    });

    $("#txtPeriodToW383010").change(function () {
        monthChange();
    });

    function monthChange() {
        $.ajax({
            method: "POST",
            url: '{{url("/W38F3010/$pForm/$g/monthChange")}}',
            data: "&PeriodFrom=" + $("#txtPeriodFromW38F3010").val() + "&PeriodTo=" + $("#txtPeriodToW383010").val(),
            success: function (data) {
                $("#cbTrainingPlanIDW38F3010").html(data);
            }
        });
    }

    function filterGrid() {
        if(Number($("#txtPeriodFromW38F3010 option:selected").attr('TempCol')) > Number($("#txtPeriodToW383010 option:selected").attr('TempCol'))){
            alert_warning("{{Helpers::getRS($g,'Thang_du_kien_tu_phai_nho_hon_thang_du_kien_den')}}");
            return false;
        }
        $("#pqgrid_W38F3010").pqGrid("showLoading");
        $.ajax({
            method: "POST",
            url: '{{url("/W38F3010/$pForm/$g/filter")}}',
            data: $("#frmW38F3010").serialize(),
            success: function (data) {
                // console.log(data);
                $("#pqgrid_W38F3010").pqGrid("option", "dataModel.data", data);
                $("#pqgrid_W38F3010").pqGrid("refreshDataAndView");
                $("#pqgrid_W38F3010").pqGrid("hideLoading");
            }
        });
    }

    function loadGrid() {
        //console.log(valueGrid);
        //alert("anh bao");
        $(document).ready(function () {
            var iW38F3010_Height = $(document).height() - 160;

            var objW38F3010 = {
                width: '100%',
                height: iW38F3010_Height,
                showTitle: false,
                collapsible: false,
                selectionModel: {type: 'row', mode: 'single'},
                scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
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
                        title: '{{Helpers::getRS($g,"Don_vi")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "DivisionName",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Phong_ban")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "DepartmentName",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"To_nhom")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "TeamName",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Nhom_nhan_vien")}}',
                        minWidth: 150,
                        dataType: "string",
                        dataIndx: "EmpGroupName",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: 'TrainingPlanID',
                        minWidth: 100,
                        dataType: "string",
                        dataIndx: "TrainingPlanID",
                        editor: false,
                        align: "center",
                        hidden: true,
                        isExport: false
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ke_hoach_dao_tao")}}',
                        minWidth: 230,
                        dataType: "string",
                        dataIndx: "TrainingPlanName",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Linh_vuc_dao_tao")}}',
                        minWidth: 150,
                        dataType: "string",
                        dataIndx: "TrainingFieldName",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: 'TrainingCourseID',
                        minWidth: 100,
                        dataType: "string",
                        dataIndx: "TrainingCourseID",
                        editor: false,
                        align: "center",
                        hidden: true,
                        isExport: false
                    },
                    {
                        title: '{{Helpers::getRS($g,"Khoa_dao_tao")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "TrainingCourseName",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Don_vi_dao_tao")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "TrainingDivisionName",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Doi_tuong_dao_tao")}}',
                        minWidth: 230,
                        dataType: "string",
                        dataIndx: "TrainingObjectName",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Don_vi_to_chuc")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "AssociationSchoolName",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Muc_dich_dao_tao")}}',
                        minWidth: 230,
                        dataType: "string",
                        dataIndx: "TrainingPurpose",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"So_luong_ke_hoach")}}',
                        minWidth: 130,
                        dataType: "float",
                        dataIndx: "PlanNumber",
                        editor: false,
                        align: "right",
                        filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ngay_du_kien_(tu)")}}',
                        minWidth: 130,
                        dataType: "date",
                        dataIndx: "FromPlanDate",
                        editor: false,
                        align: "center",
                        filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ngay_du_kien_(den)")}}',
                        minWidth: 130,
                        dataType: "date",
                        dataIndx: "ToPlanDate",
                        editor: false,
                        align: "center",
                        filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ghi_chu")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "PlanNote",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ngay_lap")}}',
                        minWidth: 100,
                        dataType: "date",
                        dataIndx: "PlanDate",
                        editor: false,
                        align: "center",
                        filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ngay_duyet")}}',
                        minWidth: 100,
                        dataType: "date",
                        dataIndx: "ApprovedDate",
                        editor: false,
                        align: "center",
                        filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Nguoi_duyet")}}',
                        minWidth: 150,
                        dataType: "string",
                        dataIndx: "ApproverName",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Chi_tiet_NV")}}',
                        minWidth: 100,
                        dataType: "string",
                        editor: false,
                        align: "center",
                        render: function (ui) {
                            var disabled = this.isEditableCell(ui) ? "" : "disabled";
                            return {
                                text: "<a class='fa fa-folder-open text-blue' title='{{Helpers::getRS($g,"Chi_tiet_NV")}}' id = 'btnViewDetailW38F2021' style='margin-top:2px'></a>",
                                cls: (disabled ? "readonly-status" : "")
                            };
                        },
                        postRender: function (ui) {
                            var rowIndx = ui.rowIndx,
                                grid = this,
                                $cell = grid.getCell(ui);
                            var rowData = ui.rowData;
                            $cell.find("#btnViewDetailW38F2021").bind("click", function (evt) {
                                showFormDialogPost('{{url("/W38F2021/".$pForm."/".$g)."/view"}}', 'modalW38F2021',rowData, 2);
                            });
                        }
                    }
                ],
                dataModel: {
                    data: [],
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
                    $("#pqgrid_W38F3010").pqGrid("refreshDataAndView");
                }*/
            };
            objW38F3010.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
            $("#pqgrid_W38F3010").pqGrid(objW38F3010);
            $("#pqgrid_W38F3010").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#pqgrid_W38F3010").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            setTimeout(function () {
                $("#pqgrid_W38F3010").pqGrid("refreshDataAndView");
            }, 700)
        });
    }
</script>