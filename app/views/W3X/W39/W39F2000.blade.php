<div class="modal fade" id="modalW39F2000" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($modalTitle,"W39F2000",true,"")}}
            </div>
            <div class="modal-body" style="padding:10px">
                <form id="frmW39F2000" name="frmW39F2000" method="post" class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-3 liketext">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Thoi_gian")}}</label>
                                </div>
                                <div class="col-md-9">
                                    {{ Form::select("slTimeID", $time ,"2",["class" => "form-control liketext", "id" => "slTimeID"])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-3 liketext">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Trang_thai")}}</label>
                                </div>
                                <div class="col-md-9">
                                    {{Form::select("slAppStatusID", $rsStatus ,$isApproval,["class" => "form-control liketext", "id" => "slAppStatusID"])}}
                                </div>
                            </div>
                        </div>
                        <div class="checkbox col-md-2 mgt10">
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Tim_kiem")}}</label>
                                </div>
                                <div class="col-md-9">
                                    {{ Form::select("slSearchFieldID", $rsFilter ,0,["class" => "form-control", "id" => "slSearchFieldID"])}}
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="txtSearchValue" name="txtSearchValue">
                            </div>
                            {{--<div class="col-md-2">--}}
                                {{--<button class="btn btn-default smallbtn" style="padding-top: 4px">--}}
                                    {{--<span class="digi digi-filter"></span> {{Helpers::getRS($g,"Loc")}}--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </form>
                <div class="row form-group">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div id="toolbarW39F2000">
                        </div>
                    </div>
                    <div class="col-md-12 col-xs-12 hide">
                        <a onclick="showFormDialogPost('{{url("/W39F2021/".$pForm."/".$g."/add")}}','modalW39F2021',null,2)"
                           class="btn btn-default smallbtn mgr5" title="{{Helpers::getRS($g,"Them_moi1")}}">
                            <span class="glyphicon glyphicon-plus text-blue"></span> {{Helpers::getRS($g,"Them_moi1")}}
                        </a>
                        <a onclick="exportW39F2000()" class="btn btn-default smallbtn"
                           title="{{Helpers::getRS($g,'Xuat_Excel_U')}}">
                            <span class="fa fa-file-excel-o"></span> {{Helpers::getRS($g,'Xuat_Excel_U')}}
                        </a>
                        <div class="btn-group">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="gridW39F2000"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<script type="text/javascript">
    $(document).ready(function () {
        $("#toolbarW39F2000").digiMenu({
                showText: true,
                buttonList: [
                    {
                        ID: "btnAddW39F2000",
                        icon: "fa fa-plus text-blue",
                        title: "{{Helpers::getRS($g,'Them_moi1')}}",
                        enable: true,
                        hidden: false,
                        type: "button",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            //console.log(ui);
                            ui.$btn.click(function () {
                                showFormDialogPost('{{url("/W39F2021/".$pForm."/".$g."/add")}}', 'modalW39F2021', null, 2)
                            });
                        },
                    }
                    , {
                        ID: "btnExportW39F2000",
                        icon: "fa fa-file-excel-o text-red text-bold",
                        title: "{{Helpers::getRS($g,'Xuat_Excel_U')}}",
                        enable: function () {
                            return true;
                        },
                        hidden: false,
                        type: "button",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            ui.$btn.click(function () {
                                exportW39F2000();
                            });
                        }
                    }

                    , {
                        ID: "txtSearchValue",
                        icon: "fa  fa-search text-yellow",
                        title: "{{Helpers::getRS($g, 'Tim_kiem')}}",
                        enable: true,
                        hidden: function () {
                            return false;
                        },
                        cls: "",
                        type: "button",
                        render: function (ui) {
                        },
                        postRender: function (ui) {
                            ui.$btn.click(function () {
                                loadDataW39F2000();
                                console.log("đã tìm kiếm");
                            });
                        }
                    }
                ]
            }
        );

        $("#slSearchFieldID").on("change", function (e) {
            $("#txtSearchValue").val("");
        })
        setTimeout(function () {
            loadDataW39F2000();
            resizePqGrid();
        }, 600);
    });

    $("#frmW39F2000").on('submit', function (e) {
        e.preventDefault();
        loadDataW39F2000();
    });

    function loadDataW39F2000() {
        $("#gridW39F2000").pqGrid("showLoading");
        $.ajax({
            method: "POST",
            url: '{{url("/W39F2000/$pForm/$g/filter")}}',
            data: $("#frmW39F2000").serialize(),
            success: function (data) {
                var temp = reformatData(data, $("#gridW39F2000"));
                $("#gridW39F2000").pqGrid("option", "dataModel.data", temp);
                $("#gridW39F2000").pqGrid("refreshDataAndView");
                reloadFilter();
            }
        });
    }


    var exportW39F2000 = function () {
        var _title = [];
        var _dataIndx = [];
        var _align = [];
        var _format = [];
        initExportExcell($("#gridW39F2000"), _title, _dataIndx, _align, _format);
        var _data = JSON.stringify($("#gridW39F2000").pqGrid("option", "dataModel.data"));
        var now = new Date();
        var toDay = convertDate(now.toLocaleDateString());
        $.ajax({
            method: "POST",
            data: {title: _title, data: _data, dataIndx: _dataIndx, align: _align, format: _format},
            url: "{{url('/Export')}}",
            success: function (data) {
                if (data == 0) {
                    alert_error('{{Helpers::getRS(5,'Loi_xuat_file')}}')
                }
                else {
                    var downloadLink = document.createElement("a");
                    downloadLink.download = "Recruitment_" + toDay + ".xls";
                    downloadLink.innerHTML = "Recruitment File";
                    downloadLink.href = data;
                    downloadLink.onclick = destroyClickedElement;
                    downloadLink.style.display = "none";
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                }
            }
        });
    };

    function convertDate(day) {
        var arr = day.split("/");
        var rsDay = arr[1] + "_" + arr[0] + "_" + arr[2];
        return rsDay;
    }


    var obj = {
        width: '100%',
        height: $(document).height() - 180,
        //freezeCols: 2,
        numberCell: {show: false},
        selectionModel: {type: 'row', mode: 'single'},
        minWidth: 30,
        pageModel: {type: "local", rPP: 20},
        filterModel: {on: true, mode: "AND", header: true},
        scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
        showTitle: false,
        dataType: "JSON",
        wrap: false,
        hwrap: false,
        collapsible: false,
        postRenderInterval: -1,
        complete: function (event, ui) {

        }
    };
    obj.colModel = [
        {
            title: "",
            maxWidth: 55,
            width: 55,
            align: "center",
            dataIndx: "View",
            isExport: false,
            editor: false,
            render: function (ui) {
                var str = "";
                var rowData = ui.rowData;
                var perW39F2021 = "{{$perW39F2021}}";
                str += "<a title='{{Helpers::getRS($g,"Xem")}}' class='btnViewW39F2000 mgr10'><i class='fa fa-search' style='color:orange'></i></a>";
                if ((Number(rowData["AppStatusID"]) == 0 || Number(rowData["AppStatusID"]) == 4)) {
                    str += "<a title='{{Helpers::getRS($g,"Sua")}}' class='btnEditW39F2000 mgr10'><i class='glyphicon glyphicon-edit' style='color:orange'></i></a>";
                }
                else {
                    str += "<a title='{{Helpers::getRS($g,"Sua")}}' class=' mgr10'><i class='glyphicon glyphicon-edit' style='color:#ccc'></i></a>";
                }
                if ((Number(rowData["AppStatusID"]) == 0 || Number(rowData["AppStatusID"]) == 4)) {
                    str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class='btnDeleteW39F2000'><i class='fa fa-trash' style='color:#333'></i></a>";
                }
                else {
                    str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class=''><i class='fa fa-trash' style='color:#ccc'></i></a>";
                }
                //return str;

                var str = digiContextMenu({
                        showText: true,
                        buttonList: [
                            {
                                ID: "btnViewW39F2000",
                                icon: "fa fa-eye text-green",
                                title: '{{Helpers::getRS($g,"Xem")}}',
                                enable: false,
                                hidden: false,
                                type: "button"

                            }
                            , {
                                ID: "btnEditW39F2000",
                                icon: "glyphicon glyphicon-edit text-yellow",
                                title: '{{Helpers::getRS($g,"Sua")}}',
                                enable: function () {
                                    return (Number(rowData["AppStatusID"]) == 0 || Number(rowData["AppStatusID"]) == 4);
                                },
                                hidden: function () {
                                    return !(Number(rowData["AppStatusID"]) == 0 || Number(rowData["AppStatusID"]) == 4);
                                },
                                type: "button",

                            }
                            , {
                                ID: "btnDeleteW39F2000",
                                icon: "fa fa-trash text-red",
                                title: '{{Helpers::getRS($g,"Xoa")}}',
                                enable: function () {
                                    return (Number(rowData["AppStatusID"]) == 0 || Number(rowData["AppStatusID"]) == 4);
                                },
                                hidden: function () {
                                    return !(Number(rowData["AppStatusID"]) == 0 || Number(rowData["AppStatusID"]) == 4);
                                },
                                type: "button"
                            }
                        ]
                    }
                );
                return str;
            },
            postRender: function (ui) {
                var rowIndx = ui.rowIndx,
                    grid = this,
                    $cell = grid.getCell(ui);
                var row = ui.rowData;
                $cell.find(".btnViewW39F2000").bind("click", function (evt) {
                    showFormDialogPost('{{url("/W39F2021/".$pForm."/".$g)."/view"}}', 'modalW39F2021', {
                        empCriterionID: row.EmpCriterionID,
                        appCriterionSetID: row["AppCriterionSetID"]
                    }, 2);
                });
                $cell.find(".btnEditW39F2000").bind("click", function (evt) {
                    showFormDialogPost('{{url("/W39F2021/".$pForm."/".$g)."/edit"}}', 'modalW39F2021', {
                        empCriterionID: row.EmpCriterionID,
                        appCriterionSetID: row["AppCriterionSetID"]
                    }, 2);
                });
                //edit button
                $cell.find(".btnDeleteW39F2000").bind("click", function (evt) {
                    deleteRowGridW09F2000(row["EmpCriterionID"]);
                });
            }
        },
        {
            title: "{{Helpers::getRS($g,'Cap_nhat_KQ')}}",
            minWidth: 100,
            align: "center",
            dataIndx: "View",
            isExport: false,
            editor: false,
            render: function (ui) {
                var str = "";
                var rowData = ui.rowData;
                var perW39F2021 = "{{$perW39F2021}}";
                if ((Number(rowData["AppStatusID"]) == 2 || Number(rowData["AppStatusID"]) == 5)) {
                    str += "<a title='{{Helpers::getRS($g,"Xac_nhan")}}' class='btnVerifyW39F2000'><i class='fa fa-check-square text-blue mgr10' ></i></a> ";
                }
                else {
                    str += "<a title='{{Helpers::getRS($g,"Xac_nhan")}}'><i class='fa fa-check-square text-gray mgr10' ></i></a> ";
                }

                return str;
            },
            postRender: function (ui) {
                var rowIndx = ui.rowIndx,
                    grid = this,
                    $cell = grid.getCell(ui);
                var row = ui.rowData;
                $cell.find(".btnVerifyW39F2000").bind("click", function (evt) {
                    showFormDialogPost('{{url("/W39F2021/".$pForm."/".$g)."/verify"}}', 'modalW39F2021', {
                        empCriterionID: row.EmpCriterionID,
                        appCriterionSetID: row["AppCriterionSetID"]
                    }, 2);
                });
            }
        }
        , {
            title: "AppStatusID",
            dataType: "string",
            dataIndx: "AppStatusID",
            hidden: true,
            isExport: false
        },
        {
            title: "{{Helpers::getRS($g,'Trang_thai')}}",
            minWidth: 120,
            align: "center",
            dataIndx: "AppStatusName",
            editor: false,
            filter: {
                type: 'select',
                condition: 'equal',
                prepend: {'': '-- {{Helpers::getRS($g,'Chon')}} --'},
                valueIndx: "AppStatusName",
                labelIndx: "AppStatusName",
                listeners: ['change']
            },
            render: function (ui) {
                var rowData = ui.rowData;
                var str = "";
                str += "<a title='{{Helpers::getRS($g,"Lich_su_duyet")}}' class='btnViewHistoryW09F2000 mgr10 text-blue'>" + rowData["AppStatusName"] + "</a>";
                return str;
            },
            postRender: function (ui) {
                var rowIndx = ui.rowIndx,
                    grid = this,
                    $cell = grid.getCell(ui);
                var row = ui.rowData;
                //edit button
                $cell.find(".btnViewHistoryW09F2000").bind("click", function (evt) {
                    showFormDialogPost('{{url("/W09F3030/W39F2000/$g")}}', "modalW09F3030", {
                        transID: row["EmpCriterionID"],
                        appCriterionSetID: row["AppCriterionSetID"]
                    }, 2);
                });
            }
        },
        {
            title: "{{Helpers::getRS($g,'Ma_bo_chi_tieu')}}",
            minWidth: 230,
            dataType: "string",
            editor: false,
            hidden: true,
            dataIndx: "EmpCriterionID",
            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: "{{Helpers::getRS($g,'Bo_chi_tieu_danh_gia')}}",
            minWidth: 230,
            dataType: "string",
            editor: false,
            dataIndx: "Decription",
            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: "{{Helpers::getRS($g,'Ma_NV')}}",
            minWidth: 170,
            dataType: "string",
            editor: false,
            dataIndx: "EmployeeID",
            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: "{{Helpers::getRS($g,'Ten_NV')}}",
            minWidth: 170,
            dataType: "string",
            editor: false,
            dataIndx: "EmployeeName",
            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: "{{Helpers::getRS($g,'Phong_ban')}}",
            minWidth: 170,
            dataType: "string",
            editor: false,
            dataIndx: "DepartmentName",
            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: "{{Helpers::getRS($g,'Ngay_de_xuat')}}",
            minWidth: 110,
            align: "center",
            dataType: "date",
            editor: false,
            dataIndx: "VoucherDate",
            filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
        },
        {
            title: "{{Helpers::getRS($g,'Hieu_luc_tu')}}",
            minWidth: 110,
            align: "center",
            dataType: "date",
            editor: false,
            dataIndx: "ValidDateFrom",
            filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
        },
        {
            title: "{{Helpers::getRS($g,'Hieu_luc_den')}}",
            minWidth: 110,
            align: "center",
            dataType: "date",
            editor: false,
            dataIndx: "ValidDateTo",
            filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
        },
        {
            title: "{{Helpers::getRS($g,'Tong_ket_dat')." (%)"}}",
            minWidth: 140,
            align: 'right',
            dataType: "float",
            editor: false,
            dataIndx: "TotalResult",
            format: "#,###.00",
            filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
        },
        {
            title: "{{Helpers::getRS($g,'Xep_loai_danh_gia')}}",
            minWidth: 170,
            dataType: "string",
            editor: false,
            align: 'center',
            dataIndx: "EvaluationTypeName",
            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        }
    ];
    obj.dataModel = {
        data: {{json_encode([])}},
        location: "local",
        sorting: "local",
        sortDir: "down"
    };
    obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
    var $grid = $("#gridW39F2000").pqGrid(obj);


    var column = $grid.pqGrid("getColumn", {dataIndx: "AppStatusName"});
    var filter = column.filter;
    filter.cache = null;
    filter.options = $grid.pqGrid("getData", {dataIndx: ["AppStatusName"]});


    $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    $grid.pqGrid("refreshDataAndView");

    function reloadFilter() {
        $grid = $("#gridW39F2000");
        var column = $grid.pqGrid("getColumn", {dataIndx: "AppStatusName"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $grid.pqGrid("getData", {dataIndx: ["AppStatusName"]});
        $grid.pqGrid("refreshDataAndView");
        $("#gridW39F2000").pqGrid("hideLoading");
    }

    function deleteRowGridW09F2000(empCriterionID) {
        ask_delete(function () {
            postMethod("{{url("/W39F2000/".$pForm."/".$g)."/delete"}}", function (data) {
                var rs = JSON.parse(data);
                console.log(rs);
                switch (rs.status) {
                    case 'OKAY':
                        delete_ok(function () {
                            update4ParamGrid($("#gridW39F2000"), null, 'delete');
                        });
                        break;
                    case 'CHECKSTORE':
                        alert_warning(rs.message);
                        break;
                    case 'ERROR':
                        alert_error(rs.message);
                        break;
                }
            }, {empCriterionID: empCriterionID});
        });
    }

</script>

