<section class="content" id="secW38F2040">
    <form id="frmW38F2040" name="frmW38F2040" method="post">
        <div class="row">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-2">
                        <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Ngay")}}</label>
                    </div>
                    <div class="col-md-5">
                        <div id="divDateFromW38F2040" class="input-group date">
                            <input type="text" class="form-control" id="txtDateFromW38F2040"
                                   name="txtDateFromW38F2040" value="{{date('01/m/Y')}}">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div id="divDateToW38F2040" class="input-group date">
                            <input type="text" class="form-control" id="txtDateToW38F2040"
                                   name="txtDateToW38F2040" value="{{date('t/m/Y')}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-4 col-xs-4">
                        <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Phong_ban")}}</label>
                    </div>
                    <div class="col-md-8 col-xs-8">
                        {{ Form::select("cboDepartmentIDW38F2040", $departments ,0,["class" => "col-md-12 form-control", "id" => "cboDepartmentIDW38F2040"])}}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-5 col-xs-5">
                        <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Trang_thai")}}</label>
                    </div>
                    <div class="col-md-7 col-xs-7">
                        {{Form::select("cbAppStatusID", $status ,"All",["class" => "form-control", "id" => "cbAppStatusID"])}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mgt5">
            <div class="col-md-8 col-xs-8">
                <div id="idAddGroup" >
                    <button type="button" {{$perW38F2042 >=2 ?  '': 'disabled'}}
                    onclick="showFormDialogPost('{{asset("W38F2041/$pForm/$g/add")}}','modalW38F2041')"
                            class="btn btn-default smallbtn" title="{{Helpers::getRS($g,"Them_moi1")}}">
                        <span class="glyphicon glyphicon-plus {{$perW38F2042 >=2 ?  'text-blue': 'text-gray'}}"></span> {{Helpers::getRS($g,"Them_moi1")}}
                    </button>

                    <button type="button" onclick="exportExcelW38F2040()" class="btn btn-default smallbtn"
                            title="{{Helpers::getRS($g,'Xuat_Excel_U')}}">
                        <span class="fa fa-file-excel-o text-blue"></span> {{Helpers::getRS($g,'Xuat_Excel_U')}}
                    </button>


                </div>
            </div>
            <div class="col-md-4 col-xs-4">
                <button class="btn btn-default smallbtn pull-right"><span class="digi digi-filter text-blue"></span>
                    &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
            </div>
        </div>
    </form>
    <div class="row" style="padding: 10px 15px" class="pdt5">
        <div id="gridW38F2040"></div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function () {
        //datepicker
        $('#txtDate').daterangepicker({format: 'DD/MM/YYYY'});
        $("i.fa-calendar").click(function () {
            $("#txtDate").click();
        });
        $('#txtDateFromW38F2040').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#txtDateToW38F2040').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });



        //cboDepartmentID
        @if ($perW38F2040 <=2)
        $("#cboDepartmentID").attr("disabled",true);
        $("#cboDepartmentID").val("{{Session::get("W91P0000")['DepartmentID']}}");
        @endif
        //cboPositionID
        $("#cboPositionID").val("%");
    });

    $("#frmW38F2040").on('submit', function (e) {
        e.preventDefault();
        loadDataW38F2040();
    });

    function loadDataW38F2040() {
        $("#gridW38F2040").pqGrid("showLoading");
        $.ajax({
            method: "POST",
            url: '{{url("/W38F2040/view/$pForm/$g/filter")}}',
            data: $("#frmW38F2040").serialize() + "&departmentIDW38F2040=" + $("#cboDepartmentIDW38F2040").val(),
            success: function (data) {
                console.log(data);
                //setter
                //console.log(data);
                $("#gridW38F2040").pqGrid("option", "dataModel.data", data);
                $("#gridW38F2040").pqGrid("refreshDataAndView");
                initFilterCombo();
                $("#gridW38F2040").pqGrid("hideLoading");
            }
        });
    }

    function initFilterCombo(){
        var column = $gridW38F2040.pqGrid("getColumn", {dataIndx: "AppStatusName"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $gridW38F2040.pqGrid("getData", {dataIndx: ["AppStatusName"]});

        $gridW38F2040.pqGrid("refreshDataAndView");
    }

    var obj = {
        width: '100%',
        height: $("#maintabs").height() - 130,
        editable: true,
        freezeCols: 2,
        selectionModel: {type: 'row'},
        minWidth: 30,
        pageModel: {type: "local", rPP: 20},
        filterModel: {on: true, mode: "AND", header: true},
        showTitle: false,
        dataType: "JSON",
        wrap: false,
        hwrap: false,
        collapsible: false,
        postRenderInterval: -1,
        colModel: [
            {
                title: "", editable: false, minWidth: 80, sortable: false, align: "center", isExport: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = "";
                    var perW25F2082 = Number("{{$perW38F2042}}");
                    var appStatusID = rowData["AppStatusID"];
                    str += "<a title='{{Helpers::getRS($g,"Xem")}}' class='btnViewW38F2040 mgr10'><i class='fa fa-eye' style='color:#2779aa'></i></a>";
                    if (perW25F2082 >=2 && appStatusID <=1){
                        str += "<a title='{{Helpers::getRS($g,"Sua")}}' class='btnEditW38F2040 mgr10'><i class='glyphicon glyphicon-edit' style='color:orange'></i></a>";
                    }else{
                        str += "<a title='{{Helpers::getRS($g,"Sua")}}' class='btnEditW38F2040Disabled mgr10'><i class='glyphicon glyphicon-edit' style='color:#ccc'></i></a>";
                    }
                    if (perW25F2082 >=2 && appStatusID <=1){
                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class='btnDeleteW38F2040'><i class='fa fa-trash' style='color:#333'></i></a>";
                    }else{
                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class='btnDeleteW38F2040Disabled'><i class='fa fa-trash' style='color:#ccc'></i></a>";
                    }
                    return str;
                },
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var rowData = ui.rowData;

                    //view button
                    $cell.find(".btnViewW38F2040").bind("click", function (evt) {
                        console.log(rowData);
                        showFormDialogPost('{{url("/W38F2041/$pForm/$g/view")}}', "modalW38F2041", {
                            rData: rowData
                        });
                    });

                    //edit button
                    $cell.find(".btnEditW38F2040").bind("click", function (evt) {
                        console.log(rowData);
                        showFormDialogPost('{{url("/W38F2041/$pForm/$g/edit")}}', "modalW38F2041", {
                            rData: rowData
                        });
                    });
                    $cell.find(".btnDeleteW38F2040").bind("click", function (evt) {
                        console.log(rowData);
                        ask_delete(function () {
                            postMethod('{{url("/W38F2040/view/$pForm/$g/delete")}}', function (data) {
                                //console.log("test");
                                if (JSON.parse(data).status == "SUCCESS") {
                                    delete_ok(function () {
                                        //loadDataW38F2040();
                                        update4ParamGrid($("#gridW38F2040"), "", "delete", initFilterCombo);
                                    });
                                } else {
                                    alert_error(data.message);
                                }
                            }, {transID: rowData["ProposalID"]});
                        });

                    });
                }
            },
            {
                title: "{{Helpers::getRS($g,"Trang_thai")}}",
                minWidth: 110,
                dataType: "string",
                dataIndx: "AppStatusName",
                align: "center",
                editor: false,
                //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                filter: {
                    type: "select",
                    condition: 'equal',
                    prepend: {'': '---'},
                    valueIndx: "AppStatusName",
                    labelIndx: "AppStatusName",
                    listeners: ['change']
                },


                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = "";
                    str += "<a title='{{Helpers::getRS($g,"Lich_su_duyet")}}' class='btnViewHistoryW38F2040 mgr10 text-blue'>" + rowData["AppStatusName"] + "</a>";
                    return str;
                },
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var row = ui.rowData;
                    //edit button
                    $cell.find(".btnViewHistoryW38F2040").bind("click", function (evt) {
                        showFormDialogPost('{{url("/W09F3030/$pForm/$g")}}', "modalW09F3030", {transID: row["ProposalID"]},2);
                    });

                }
            },
            {
                title: "{{Helpers::getRS($g,"Ten_ke_hoach")}}",
                minWidth: 230,
                dataType: "string",
                dataIndx: "ProposalName",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                /*filter: {
                    type: "select",
                    condition: 'equal',
                    prepend: {'': '---'},
                    valueIndx: "PositionName",
                    labelIndx: "PositionName",
                    listeners: ['change']
                }*/
            },
            {
                title: "{{Helpers::getRS($g,"Phong_ban")}}",
                minWidth: 230,
                dataType: "string",
                dataIndx: "DepartmentName",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "ProposalID",
                minWidth: 170,
                dataType: "string",
                dataIndx: "ProposalID",
                hidden: true,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                isExport: false
            },

            {
                title: "AppStatusID",
                minWidth: 170,
                dataType: "string",
                dataIndx: "AppStatusID",
                hidden: true,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                isExport: false
            },
            {
                title: "{{Helpers::getRS($g,"Tong_chi_phi_quy_doi")}}",
                minWidth: 150,
                dataType: "float",
                dataIndx: "ProCCost",
                format: "{{Helpers::getStringFormat(2)}}",
                editor: false,
                align: "right",
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Ngay_de_xuat")}}",
                minWidth: 100,
                dataType: "date",
                dataIndx: "ProposalDate",
                editor: false,
                align: "center",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,"Nguoi_de_xuat")}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "ProposerName",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                /*filter: {
                    type: "select",
                    condition: 'equal',
                    prepend: {'': '---'},
                    valueIndx: "TeamName",
                    labelIndx: "TeamName",
                    listeners: ['change']
                },*/
            },
            {
                title: "DepartmentID",
                minWidth: 230,
                dataType: "string",
                dataIndx: "DepartmentID",
                editor: false,
                hidden: true,
                isExport: false
            },
            {
                title: "TeamID",
                minWidth: 230,
                dataType: "string",
                dataIndx: "TeamID",
                editor: false,
                hidden: true,
                isExport: false
            },
            {
                title: "TrainingFieldID",
                minWidth: 140,
                dataType: "string",
                dataIndx: "TrainingFieldID",
                editor: false,
                align: "left",
                hidden: true,
                isExport: false
            },

            {
                title: "TrainingCourseID",
                minWidth: 140,
                dataType: "string",
                dataIndx: "TrainingCourseID",
                editor: false,
                align: "left",
                hidden: true,
                isExport: false
            },

            {
                title: "{{Helpers::getRS($g,"Nam")}}",
                minWidth: 80,
                dataType: "string",
                dataIndx: "Year",
                editor: false,
                align: "center",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "ProCost",
                minWidth: 100,
                dataType: "float",
                dataIndx: "ProCost",
                editor: false,
                hidden: true,
                isExport: false
            },
            {
                title: "ProCurrencyID",
                minWidth: 100,
                dataType: "string",
                dataIndx: "ProCurrencyID",
                editor: false,
                hidden: true,
                isExport: false
            },
            {
                title: "ProEmployeeRate",
                minWidth: 100,
                dataType: "float",
                dataIndx: "ProEmployeeRate",
                editor: false,
                hidden: true,
                isExport: false
            },
            {
                title: "ProExchangeRate",
                minWidth: 100,
                dataType: "float",
                dataIndx: "ProExchangeRate",
                editor: false,
                hidden: true,
                isExport: false
            },
            {
                title: "ProAverageCosts",
                minWidth: 100,
                dataType: "float",
                dataIndx: "ProAverageCosts",
                editor: false,
                hidden: true,
                isExport: false
            },
            {
                title: "ProEmployeeRate",
                minWidth: 100,
                dataType: "float",
                dataIndx: "ProEmployeeRate",
                editor: false,
                hidden: true,
                isExport: false
            },
            {
                title: "ProCompanyRate",
                minWidth: 100,
                dataType: "float",
                dataIndx: "ProCompanyRate",
                editor: false,
                hidden: true,
                isExport: false
            },
            {
                title: "ApprovalFlowID",
                minWidth: 100,
                dataType: "string",
                dataIndx: "ApprovalFlowID",
                editor: false,
                hidden: true,
                isExport: false
            }
        ],
        dataModel: {
            data: {{json_encode([])}}
        }
    };
    var $gridW38F2040 = $("#gridW38F2040").pqGrid(obj);
    $gridW38F2040.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $gridW38F2040.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    $gridW38F2040.pqGrid("refreshDataAndView");


    var exportExcelW38F2040 = function () {
        var _title = [];
        var _dataIndx = [];
        var _align = [];
        var _format = [];
        initExportExcell($("#gridW38F2040"), _title, _dataIndx, _align, _format);
        var _data = JSON.stringify($("#gridW38F2040").pqGrid("option", "dataModel.data"));

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
                    var d =  new Date();
                    downloadLink.download = "Ke_hoach_dao_tao_tong_the_" + d.getDate() + "" + (Number(d.getMonth()) + 1) + "" + d.getFullYear() + ".xls";
                    downloadLink.innerHTML = "Ke_hoach_dao_tao_tong_the_";
                    downloadLink.href = data;
                    downloadLink.onclick = destroyClickedElement;
                    downloadLink.style.display = "none";
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                }
            }
        });
    };
</script>


