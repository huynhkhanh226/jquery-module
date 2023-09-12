<div class="modal fade" id="modalW38F2021" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($titleW38F2021,"W38F2021",true,"")}}
            </div>
            <div class="modal-body" style="padding:10px">
                <form id="frmW38F2021" name="frmW38F2021" method="post">
                    <div class = "row form-group">
                        <div class = "col-xs-6 col-lg-6 col-md-6">
                            <div class = "row">
                                <div class = "col-xs-5 col-lg-5 col-md-5">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Linh_vuc_dao_tao")}}</label>
                                </div>
                                <div class = "col-xs-7 col-lg-7 col-md-7">
                                    <label>{{isset($employeeInfo['TrainingFieldName']) ? $employeeInfo['TrainingFieldName'] : ''}}</label>
                                </div>
                            </div>
                        </div>
                        <div class = "col-xs-6 col-lg-6 col-md-6">
                            <div class = "row">
                                <div class = "col-xs-5 col-lg-5 col-md-5">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Khoa_dao_tao")}}</label>
                                </div>
                                <div class = "col-xs-7 col-lg-7 col-md-7">
                                    <label>{{isset($employeeInfo['TrainingCourseName']) ? $employeeInfo['TrainingCourseName'] : ''}}</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class = "row form-group">
                        <div class = "col-xs-6 col-lg-6 col-md-6">
                            <div class = "row">
                                <div class = "col-xs-5 col-lg-5 col-md-5">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Don_vi_dao_tao")}}</label>
                                </div>
                                <div class = "col-xs-7 col-lg-7 col-md-7">
                                    <label>{{isset($employeeInfo['TrainingDivisionName']) ? $employeeInfo['TrainingDivisionName'] : ''}}</label>
                                </div>
                            </div>
                        </div>
                        <div class = "col-xs-6 col-lg-6 col-md-6">
                            <div class = "row">
                                <div class = "col-xs-5 col-lg-5 col-md-5">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Don_vi_to_chuc")}}</label>
                                </div>
                                <div class = "col-xs-7 col-lg-7 col-md-7">
                                    <label>{{isset($employeeInfo['AssociationSchoolName']) ? $employeeInfo['AssociationSchoolName'] : ''}}</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class = "row form-group">
                        <div class = "col-xs-6 col-lg-6 col-md-6">
                            <div class = "row">
                                <div class = "col-xs-5 col-lg-5 col-md-5">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"So_luong")}}</label>
                                </div>
                                <div class = "col-xs-7 col-lg-7 col-md-7">
                                    <label>{{isset($employeeInfo['PlanNumber']) ? $employeeInfo['PlanNumber'] : ''}}</label>
                                </div>
                            </div>
                        </div>
                        <div class = "col-xs-6 col-lg-6 col-md-6">
                            <div class = "row">
                                <div class = "col-xs-5 col-lg-5 col-md-5">
                                    <label class="lbl-normal">{{Helpers::getRS($g,"Dia_diem")}}</label>
                                </div>
                                <div class = "col-xs-7 col-lg-7 col-md-7">
                                    <label>{{isset($employeeInfo['Address']) ? $employeeInfo['Address'] : ''}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

               {{-- <div class="row  form-group">
                    <div class="col-xs-12 col-lg-12 col-md-12">
                        <button type="button" onclick="exportExcelW38F2040()" class="btn btn-default smallbtn"
                                title="{{Helpers::getRS($g,'Xuat_Excel_U')}}">
                            <span class="fa fa-file-excel-o text-blue"></span> {{Helpers::getRS($g,'Xuat_Excel_U')}}
                        </button>
                    </div>
                </div>--}}

                <div class="row  form-group">
                    <div class="col-xs-6 col-lg-6 col-md-6">
                        <div id="pqgrid_W38F2021"></div>
                    </div>
                    <div class="col-xs-6 col-lg-6 col-md-6">
                        <div id="pqgrid_W38F2021_2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        loadGrid();
        loadGrid2();
    });

    function loadGrid() {
        //console.log(valueGrid);
        $(document).ready(function () {
            var iW38F2021_Height = $(document).height() - 220;

            var objW38F2021 = {
                width: '100%',
                height: iW38F2021_Height,
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
                        title: '{{Helpers::getRS($g,"Ma_NV")}}',
                        minWidth: 100,
                        dataType: "string",
                        dataIndx: "EmployeeID",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ten_NV")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "FullName",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Khoi")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "BlockName",
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
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "EmpGroupName",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Chuc_vu")}}',
                        minWidth: 150,
                        dataType: "string",
                        dataIndx: "DutyName",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ngay_sinh")}}',
                        minWidth: 100,
                        dataType: "date",
                        dataIndx: "Birthdate",
                        editor: false,
                        align: "center",
                        filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ngay_vao_lam")}}',
                        minWidth: 100,
                        dataType: "string",
                        dataIndx: "DateJoined",
                        editor: false,
                        align: "center",
                        filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                    }
                ],
                dataModel: {
                    data: {{json_encode($valueGrid)}},
                    location: "local",
                    sorting: "local",
                    sortDir: "down"
                },
                complete: function (event, ui) {
                    console.log('complete grid');

                },
                rowClick: function (event, ui) {
                }
            };
            //objW38F2021.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
            $("#pqgrid_W38F2021").pqGrid(objW38F2021);
            $("#pqgrid_W38F2021").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#pqgrid_W38F2021").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            setTimeout(function () {
                $("#pqgrid_W38F2021").pqGrid("refreshDataAndView");
            }, 700)
        });
    }

    function loadGrid2() {
        //console.log(valueGrid);
        $(document).ready(function () {
            var iW38F2021_2_Height = $(document).height() - 220;

            var objW38F2021_2 = {
                width: '100%',
                height: iW38F2021_2_Height,
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
                numberCell: {show: false},
                colModel: [
                    {
                        title: '{{Helpers::getRS($g,"Ly_do_dao_tao")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "ProReason",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Vi_tri_sau_dao_tao")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "PositionAfterTraining",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Hinh_thuc_phan_bo_chi_phi")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "TrainingCostName",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Ghi_chu")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "DetailNote",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    },
                    {
                        title: '{{Helpers::getRS($g,"Nguoi_de_xuat_dao_tao")}}',
                        minWidth: 200,
                        dataType: "string",
                        dataIndx: "ProposerName",
                        editor: false,
                        align: "left",
                        filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    }
                ],
                dataModel: {
                    data: {{json_encode($valueGrid)}},
                    location: "local",
                    sorting: "local",
                    sortDir: "down"
                },
                complete: function (event, ui) {
                    console.log('complete grid');

                },
                rowClick: function (event, ui) {
                }
            };
            //objW38F2021_2.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
            $("#pqgrid_W38F2021_2").pqGrid(objW38F2021_2);
            $("#pqgrid_W38F2021_2").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
            $("#pqgrid_W38F2021_2").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
            setTimeout(function () {
                $("#pqgrid_W38F2021_2").pqGrid("refreshDataAndView");
            }, 700)
        });
    }
</script>