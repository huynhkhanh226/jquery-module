<section class="content" id="secW09F2000">
    <div class="row form-group">
        <div class="col-md-12 col-xs-12">
            <form class="form-horizontal" id="frmW09F2000" method="post">
                <div class="row">
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-3 liketext">
                                <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Thoi_gian")}}</label>
                            </div>
                            <div class="col-md-9">
                                {{ Form::select("slTimeID", $timeList ,"0",["class" => "form-control liketext", "id" => "slTimeID"])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-3 liketext">
                                <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Trang_thai")}}</label>
                            </div>
                            <div class="col-md-9">
                                {{Form::select("slAppStatusID", $statusList ,"All",["class" => "form-control liketext", "id" => "slAppStatusID"])}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Tim_kiem")}}</label>
                            </div>
                            <div class="col-md-9">
                                {{ Form::select("slSearchFieldID", $searchList ,0,["class" => "form-control", "id" => "slSearchFieldID"])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="txtSearchValue" name="txtSearchValue">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-default smallbtn" style="padding-top: 4px"><span
                                    class="digi digi-filter"></span>
                            &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                    </div>
                </div>
                <div class="row mgt5">
                    <div class="col-md-12 col-xs-12">
                        @if($perD09F2000 >1)
                            <a onclick="showFormDialog('{{url("/W09F2001/".$pForm."/".$g)."/add"}}','modalW09F2001')"
                               class="btn btn-default smallbtn mgr5" title="{{Helpers::getRS($g,"Them_moi1")}}">
                                <span class="glyphicon glyphicon-plus"></span> {{Helpers::getRS($g,"Them_moi1")}}
                            </a>
                        @endif

                        <a onclick="w09F2000ExportExcel()" class="btn btn-default smallbtn"
                           title="{{Helpers::getRS($g,'Xuat_Excel_U')}}">
                            <span class="fa fa-file-excel-o"></span> {{Helpers::getRS($g,'Xuat_Excel_U')}}
                        </a>
                        <div class="btn-group">

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="gridW09F2000"></div>
        </div>
    </div>
</section>


<script type="text/javascript">
    $(document).ready(function () {
        $("#slSearchFieldID").on("change", function (e) {
            $("#txtSearchValue").val("");
        })
    });


    $("#frmW09F2000").on('submit', function (e) {
        e.preventDefault();
        loadGridW09F2000();
    });

    function loadGridW09F2000(salaryProposalID) {
        var salaryProposalID = typeof salaryProposalID !== 'undefined' ? salaryProposalID : '';

        $.ajax({
            method: "POST",
            url: '{{url("/W09F2000/view/$pForm/$g/filter")}}',
            data: $("#frmW09F2000").serialize() + "&salaryProposalID=" + salaryProposalID,
            success: function (data) {
                data = reformatData(data, $("#gridDetailW09F2000"));
                if (salaryProposalID != '') {
                    return data;
                } else {

                    $("#gridW09F2000").pqGrid("option", "dataModel.data", data);
                    $("#gridW09F2000").pqGrid("refreshDataAndView");
                }
                reloadFilter();
            }
        });
    }

    function deleteRowGridW09F2000(salaryProposalID) {
        ask_delete(function () {
            $.ajax({
                method: "POST",
                url: '{{url("/W09F2000/view/$pForm/$g/deleterow")}}',
                data: {salaryProposalID: salaryProposalID},
                success: function (data) {
                    if (data == 1) {
                        delete_ok();
                        update4ParamGrid($("#gridW09F2000"), '', 'delete');
                        reloadFilter();
                    } else {
                        alert_error("{{Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")}}");
                    }

                }

            });
        });

    }

    var obj = {
        width: '100%',
        height: $(".contenttab").height() - 130,
        freezeCols: 2,
        selectionModel: {type: 'row'},
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
            minWidth: 80,
            align: "center",
            dataIndx: "View",
            isExport: false,
            editor: false,
            render: function (ui) {
                var str = "";
                var rowData = ui.rowData;
                @if ($perD09F2000 >=1)
                    str += "<a title='{{Helpers::getRS($g,"Xem")}}' class='btnViewW09F2000 mgr10'><i class='fa fa-eye' style='color:orange'></i></a>";
                @else
                    str += "<a title='{{Helpers::getRS($g,"Xem")}}' class=' mgr10'><i class='fa fa-eye' style='color:#ccc'></i></a>";
                @endif
                if (Number(rowData["AppStatusID"]) == 0) {
                    @if ($perD09F2000 >=3)
                        str += "<a title='{{Helpers::getRS($g,"Sua")}}' class='btnEditW09F2000 mgr10'><i class='glyphicon glyphicon-edit' style='color:orange'></i></a>";
                    @else
                        str += "<a title='{{Helpers::getRS($g,"Sua")}}' class=' mgr10'><i class='glyphicon glyphicon-edit' style='color:#ccc'></i></a>";
                    @endif
                    @if ($perD09F2000 >=4)
                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class='btnDeleteW09F2000'><i class='fa fa-trash' style='color:#333'></i></a>";
                    @else
                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class=''><i class='fa fa-trash' style='color:#ccc'></i></a>";
                    @endif

                } else {
                    str += "<a title='{{Helpers::getRS($g,"Sua")}}' class=' mgr10'><i class='glyphicon glyphicon-edit' style='color:#ccc'></i></a>";
                    str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class=''><i class='fa fa-trash' style='color:#ccc'></i></a>";
                }
                return str;
            },
            postRender: function (ui) {
                var rowIndx = ui.rowIndx,
                    grid = this,
                    $cell = grid.getCell(ui);
                var row = ui.rowData;
                $cell.find(".btnViewW09F2000").bind("click", function (evt) {
                    showFormDialogPost('{{url("/W09F2001/".$pForm."/".$g)."/view"}}', 'modalW09F2001', {salaryProposalID: row.SalaryProposalID}, 2);
                });
                $cell.find(".btnEditW09F2000").bind("click", function (evt) {
                    showFormDialogPost('{{url("/W09F2001/".$pForm."/".$g)."/edit"}}', 'modalW09F2001', {salaryProposalID: row.SalaryProposalID}, 2);
                });
                //edit button
                $cell.find(".btnDeleteW09F2000").bind("click", function (evt) {
                    deleteRowGridW09F2000(row["SalaryProposalID"]);
                });


            }
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
                    showFormDialogPost('{{url("/W09F3030/$pForm/$g")}}', "modalW09F3030", {transID: row["SalaryProposalID"]}, 2);
                });

            }
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
            title: "{{Helpers::getRS($g,'To_nhom')}}",
            minWidth: 170,
            dataType: "string",
            editor: false,
            dataIndx: "TeamName",
            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: "{{Helpers::getRS($g,'Ly_do')}}",
            minWidth: 170,
            editor: false,
            dataType: "string",
            dataIndx: "ReasonName",
            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },
        {
            title: "{{Helpers::getRS($g,'Dien_giai')}}",
            minWidth: 270,
            align: 'left',
            dataType: "string",
            editor: false,
            dataIndx: "SalaryProposalName",
            filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
        },


        {
            title: "{{Helpers::getRS($g,'SL_de_xuat')}}",
            minWidth: 80,
            align: 'right',
            dataType: "float",
            editor: false,
            dataIndx: "ProNumber",
            format: "{{Helpers::getStringFormat(0)}}",
            filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},

        },
        {
            title: "{{Helpers::getRS($g,'SL_duyet')}}",
            minWidth: 80,
            align: 'right',
            dataType: "float",
            editor: false,
            dataIndx: "AppNumber",
            format: "{{Helpers::getStringFormat(0)}}",
            filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},

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
            title: "{{Helpers::getRS($g,'Ngay_duyet')}}",
            minWidth: 110,
            align: "center",
            dataType: "date",
            editor: false,
            dataIndx: "ApprovedDate",
            filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
        },
        {
            title: "{{Helpers::getRS($g,'Ngay_hieu_luc_U')}}",
            minWidth: 110,
            align: "center",
            dataType: "date",
            editor: false,
            dataIndx: "ValidDate",
            filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
        },

        {
            title: "SalaryProposalID",
            dataType: "string",
            dataIndx: "SalaryProposalID",
            hidden: true,
            isExport: false
        },

        {
            title: "AppStatusID",
            dataType: "string",
            dataIndx: "AppStatusID",
            hidden: true,
            isExport: false
        }
    ];
    obj.dataModel = {
        data: {{json_encode($rsData)}},
        location: "local",
        sorting: "local",
        sortDir: "down"
    };
    obj.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
    var $grid = $("#gridW09F2000").pqGrid(obj);


    var column = $grid.pqGrid("getColumn", {dataIndx: "AppStatusName"});
    var filter = column.filter;
    filter.cache = null;
    filter.options = $grid.pqGrid("getData", {dataIndx: ["AppStatusName"]});


    $grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    $grid.pqGrid("refreshDataAndView");


    function reloadFilter() {
        var column = $grid.pqGrid("getColumn", {dataIndx: "AppStatusName"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $grid.pqGrid("getData", {dataIndx: ["AppStatusName"]});
        $grid.pqGrid("refreshDataAndView");
    }


    var w09F2000ExportExcel = function () {
        var _title = [];
        var _dataIndx = [];
        var _align = [];
        var _format = [];
        initExportExcell($("#gridW09F2000"), _title, _dataIndx, _align, _format);
        var _data = JSON.stringify($("#gridW09F2000").pqGrid("option", "dataModel.data"));
        var now = new Date();
        var toDay = createNameString(now.toLocaleDateString());
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

    function createNameString(day) {
        var arr = day.split("/");
        var rsDay = arr[1] + "_" + arr[0] + "_" + arr[2];
        return rsDay;
    }
</script>




