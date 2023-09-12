<div class="modal fade noneOverflow" id="modalW39F2030" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading(Helpers::getRS($g,'Danh_gia_chi_tieu'),"W39F2030",true,"")}}
            </div>

            <div class="modal-body" style="padding:10px">

                <form id="frmW39F2030" name="frmW39F2030" method="post">
                    <div class = "row">
                        <div class="col-lg-6 col-xs-6 col-md-6">
                            <div class = "row">
                                <div class="col-md-4 liketext">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Bo_chi_tieu_chung")}}</label>
                                </div>
                                <div class="col-md-8 liketext">
                                    <select class="form-control"
                                            id="cbAppCriterionSetIDW39F2030" name="cbAppCriterionSetIDW39F2030"
                                            placeholder="">
                                        <option value="%"><--Tất cả--></option>
                                        @foreach($cbAppCriterionSet as $row)
                                            <option value="{{$row['AppCriterionSetID']}}">{{$row['AppCriterionSetName']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-6 col-md-6">
                            <div class = "row">
                                <div class="col-md-4 liketext">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ngay_xac_nhan")}}</label>
                                </div>
                                <div class="col-md-8 liketext">
                                    <div class = "row">
                                        <div class="col-md-6">
                                            <div id="divDateFromW39F2030" class="input-group date">
                                                <input type="text" class="form-control" id="txtDateFromW39F2030"
                                                       name="txtDateFromW39F2030" value="{{date('01/m/Y')}}" ><span
                                                        class="input-group-addon"><i id="iconDateFrom" onclick="$('#txtDateFromW39F2030').datepicker('show');"
                                                                                     class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div id="divDateToW39F2030" class="input-group date">
                                                <input type="text" class="form-control" id="txtDateToW39F2030"
                                                       name="txtDateToW39F2030" value="{{date('t/m/Y')}}" ><span
                                                        class="input-group-addon"><i  onclick="$('#txtDateToW39F2030').datepicker('show');"
                                                                                      class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class = "row">
                        <div class="col-lg-6 col-xs-6 col-md-6">
                            <div class = "row">
                                <div class="col-md-4 liketext">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Bo_chi_tieu_danh_gia")}}</label>
                                </div>
                                <div class="col-md-8 liketext">
                                    <select class="form-control"
                                            id="cbEmpCriterionIDW39F2030" name="cbEmpCriterionIDW39F2030"
                                            placeholder="">
                                        <option value="%"><--Tất cả--></option>
                                        @foreach($cbEmpCriterion as $row)
                                            <option value="{{$row['EmpCriterionID']}}">{{$row['EmpCriterionName']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-6 col-md-6">
                            <div class = "row">
                                <div class="col-md-4 liketext">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Trang_thai")}}</label>
                                </div>
                                <div class="col-md-8 liketext">
                                    <select class="form-control"
                                            id="cbStatusIDW39F2030" name="cbStatusIDW39F2030"
                                            placeholder="">
                                        @foreach($cbStatus as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class = "row">
                        <div class="col-lg-6 col-xs-6 col-md-6">
                            <div class = "row">
                                <div class="col-md-4 liketext">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Phong_ban")}}</label>
                                </div>
                                <div class="col-md-8 liketext">
                                    <select class="form-control"
                                            id="cbDepartmentIDW39F2030" name="cbDepartmentIDW39F2030"
                                            placeholder="">
                                        @foreach($department as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-6 col-md-6">
                            <div class = "row">
                                <div class="col-md-4 liketext">
                                    <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Nhan_vien")}}</label>
                                </div>
                                <div class="col-md-8 liketext">
                                    <select class="form-control"
                                            id="cbEmployeeIDW39F2030" name="cbEmployeeIDW39F2030"
                                            placeholder="">
                                        @foreach($cbEmployee as $row)
                                            <option value="{{$row['EmployeeID']}}">{{$row['EmployeeName']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-8 col-xs-8">
                            <div id="idAddGroup" >
                                <button type="button" onclick="exportExcelW39F2030()" class="btn btn-default smallbtn"
                                        title="{{Helpers::getRS($g,'Xuat_Excel_U')}}">
                                    <span class="fa fa-file-excel-o text-blue"></span> {{Helpers::getRS($g,'Xuat_Excel_U')}}
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-4">
                            <button id = "btnFilterW39F2030" type = "button" class="btn btn-default smallbtn pull-right"><span class="digi digi-filter text-blue"></span>
                                &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                        </div>
                    </div>
                </form>
                <div class = "row">
                    <div class = "col-xs-12 col-lg-12 col-md-12">
                        <div id="gridW39F2030"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#txtDateFromW39F2030').val("{{$startDate}}");
        $('#txtDateToW39F2030').val("{{$endDate}}");

        $('#txtDateFromW39F2030').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });

        $('#txtDateToW39F2030').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
    });
    $("#btnFilterW39F2030").click(function () {
        //alert("da click");
        //$("#gridW39F2030").pqGrid("showLoading");
        $.ajax({
            method: "POST",
            url: '{{url("/W39F2030/$pForm/$g/filter")}}',
            data: $("#frmW39F2030").serialize(),
            success: function (data) {
                //console.log(data);
                $("#gridW39F2030").pqGrid("option", "dataModel.data", data);
                $("#gridW39F2030").pqGrid("refreshDataAndView");
                $("#gridW39F2030").pqGrid("hideLoading");
            }
        });
    });

    $("#cbAppCriterionSetIDW39F2030").change(function () {
        //alert("da click");
        //$("#gridW39F2030").pqGrid("showLoading");
        $.ajax({
            method: "POST",
            url: '{{url("/W39F2030/$pForm/$g/reloadEmpCriterion")}}',
            data: "&cbAppCriterionSetIDW39F2030=" +  $("#cbAppCriterionSetIDW39F2030").val(),
            success: function (data) {
                //console.log(data);
                $("#cbEmpCriterionIDW39F2030").html(data);
            }
        });
    });


    $("#cbDepartmentIDW39F2030").change(function () {
        //alert("da click");
        //$("#gridW39F2030").pqGrid("showLoading");
        $.ajax({
            method: "POST",
            url: '{{url("/W39F2030/$pForm/$g/reloadEmployee")}}',
            data: "&cbDepartmentIDW39F2030=" +  $("#cbDepartmentIDW39F2030").val(),
            success: function (data) {
                //console.log(data);
                $("#cbEmployeeIDW39F2030").html(data);
            }
        });
    });

    var objGridW39F2030 = {
        width: '100%',
        height: $(document).height() - 250,
        editable: true,
        freezeCols: 2,
        selectionModel: {type: 'row', mode: 'single'},
        minWidth: 30,
        pageModel: {type: "local", rPP: 20},
        filterModel: {on: true, mode: "AND", header: true},
        showTitle: false,
        dataType: "JSON",
        wrap: false,
        hwrap: false,
        scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
        collapsible: false,
        postRenderInterval: -1,
        colModel: [
            {
                title: "", editable: false, minWidth: 50, sortable: false, align: "center", isExport: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = "";
                    str += "<a title='{{Helpers::getRS($g,"Sua")}}' class='btnEditW39F2030 mgr10'><i class='glyphicon glyphicon-edit text-orange' style='color:orange'></i></a>";
                    str += '<a id = "btnViewW39F2030" class="mgr10" title="{{Helpers::getRS($g,"Xem")}}"><i class="glyphicon glyphicon-search text-blue" style="font-size: 80%"></i></a>';
                    return str;
                },
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var rowData = ui.rowData;

                    //edit button
                    $cell.find(".btnEditW39F2030").bind("click", function (evt) {
                        console.log(rowData);
                        showFormDialogPost('{{url("/W39F2031/$pForm/$g")}}', "modalW39F2031",
                            {EmpCriterionID : rowData.EmpCriterionID, AppCriterionSetID : rowData.AppCriterionSetID, Mode: 1}
                            ,2);
                    });
                    $cell.find("#btnViewW39F2030").bind("click", function (evt) {
                        console.log(rowData);
                        showFormDialogPost('{{url("/W39F2031/$pForm/$g")}}', "modalW39F2031",
                            {EmpCriterionID : rowData.EmpCriterionID, AppCriterionSetID : rowData.AppCriterionSetID, Mode: 0}
                            ,2);
                    });
                }
            },
            {
                title: "IsUpdate",
                minWidth: 170,
                dataType: "string",
                dataIndx: "IsUpdate",
                hidden: true,
                isExport: false
            },
            {
                title: "{{Helpers::getRS($g,"Nhan_vien")}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "EmployeeName",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Phong_ban")}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "DepartmentName",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"To_nhom")}}",
                minWidth: 240,
                dataType: "string",
                dataIndx: "TeamName",
                editor: false,
                align: "left",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Chuc_vu")}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "DutyName",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Bo_chi_tieu_danh_gia")}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "EmpCriterionName",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Trang_thai")}}",
                minWidth: 130,
                dataType: "string",
                dataIndx: "StatusName",
                align: "center",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Ngay_dang_ky")}}",
                minWidth: 100,
                dataType: "date",
                dataIndx: "VourcherDate",
                editor: false,
                align: "center",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,"Hieu_luc_tu")}}",
                minWidth: 100,
                dataType: "date",
                dataIndx: "ValidDateFrom",
                editor: false,
                align: "center",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,"Hieu_luc_den")}}",
                minWidth: 100,
                dataType: "date",
                dataIndx: "ValidDateTo",
                editor: false,
                align: "center",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,"Ket_qua_dat")}}",
                minWidth: 100,
                dataType: "float",
                dataIndx: "Resutl",
                editor: false,
                align: "right",
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
            },
            {
                title: "EvaluationTypeID",
                minWidth: 170,
                dataType: "string",
                dataIndx: "EvaluationTypeID",
                hidden: true,
                isExport: false
            },
            {
                title: "{{Helpers::getRS($g,"Xep_loai_danh_gia")}}",
                minWidth: 130,
                dataType: "string",
                dataIndx: "EvaluationTypeName",
                align: "left",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            }
        ],
        dataModel: {
            data: {{json_encode([])}}
        }
    };
    var $gridW39F2030 = $("#gridW39F2030").pqGrid(objGridW39F2030);
    $gridW39F2030.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $gridW39F2030.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    setTimeout(function () {
        $gridW39F2030.pqGrid("refreshDataAndView");
    }, 700)

    var exportExcelW39F2030 = function () {
        var _title = [];
        var _dataIndx = [];
        var _align = [];
        var _format = [];
        initExportExcell($("#gridW39F2030"), _title, _dataIndx, _align, _format);
        var _data = JSON.stringify($("#gridW39F2030").pqGrid("option", "dataModel.data"));

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
                    downloadLink.download = "Danh_gia_chi_tieu_" + d.getDate() + "" + (Number(d.getMonth()) + 1) + "" + d.getFullYear() + ".xls";
                    downloadLink.innerHTML = "Danh_gia_chi_tieu_";
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
