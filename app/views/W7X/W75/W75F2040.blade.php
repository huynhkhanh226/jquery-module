<div class="modal fade modal noneOverflow noUseValidHTML5" id="modalW75F2040" data-keyboard="false"
     data-backdrop="static"
     role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="form-horizontal">
                <div class="modal-header">
                    {{Helpers::generateHeading($modalTitle,"W75F2040")}}
                </div>
                <div class="modal-body" style="padding:10px">
                    <form id="frmW75F2040" name="frmW75F2040" method="post">
                        @if($perW75F2040 == 4)
                        <div class = "row form-group">
                            <div class = "col-xs-4 col-lg-4 col-md-4">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label style = "font-size: 12.6px" class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Khoi")}}</label>
                                    </div>
                                    <div class="col-md-9 liketext">
                                        <select class="form-control"
                                                id="cbBlockIDW75F2040" name="cbBlockIDW75F2040"
                                                placeholder="">
                                            @foreach($block as $row)
                                                <option value="{{$row['BlockID']}}">{{$row['BlockName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-xs-3 col-lg-3 col-md-3">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label style = "font-size: 12.6px" class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"To_nhom")}}</label>
                                    </div>
                                    <div class="col-md-9 liketext">
                                        <select class="form-control"
                                                id="cbTeamIDW75F2040" name="cbTeamIDW75F2040"
                                                placeholder="">
                                            @foreach($team as $row)
                                                <option value="{{$row['TeamID']}}">{{$row['TeamName']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-xs-5 col-lg-5 col-md-5">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label style = "font-size: 12.6px" class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Thoi_gian_dang_ky")}}</label>
                                    </div>
                                    <div class="col-md-9 liketext">
                                        <div class = "row">
                                            <div class="col-md-6">
                                                <div id="divDateFromW75F2040" class="input-group date">
                                                    <input type="text" class="form-control" id="txtValidDateFromW75F2040"
                                                           name="txtValidDateFromW75F2040" value="" ><span
                                                            class="input-group-addon"><i onclick="$('#txtValidDateFromW75F2040').datepicker('show');"
                                                                                         class="glyphicon glyphicon-calendar"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="divDateToW75F2040" class="input-group date">
                                                    <input type="text" class="form-control" id="txtValidDateToW75F2040"
                                                           name="txtValidDateToW75F2040" value="" ><span
                                                            class="input-group-addon"><i  onclick="$('#txtValidDateToW75F2040').datepicker('show');"
                                                                                          class="glyphicon glyphicon-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class = "row form-group">
                            <div class = "col-xs-4 col-lg-4 col-md-4">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label style = "font-size: 12.6px" class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Phong_ban")}}</label>
                                    </div>
                                    <div class="col-md-9 liketext">
                                        <select class="form-control"
                                                id="cbDepartmentIDW75F2040" name="cbDepartmentIDW75F2040"
                                                placeholder="">
                                            @foreach($department as $key=>$value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-xs-3 col-lg-3 col-md-3">
                                <div class="row">
                                    <div class="col-md-3 liketext">
                                        <label style = "font-size: 12.6px" class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ma_NV")}}</label>
                                    </div>
                                    <div class="col-md-9 liketext">
                                        <input type="text" class="form-control" id="txtEmployeeIDW75F2040" name="txtEmployeeIDW75F2040">
                                    </div>
                                </div>
                            </div>
                            <div class = "col-xs-5 col-lg-5 col-md-5">
                                <div class = "row">
                                    <div class = "col-xs-12 col-lg-12 col-md-12 liketext">
                                        <button type="button" id="frm_btnFilterW75F2040"
                                                class="btn btn-default smallbtn pull-right"
                                                title="{{Helpers::getRS($g,"Loc")}}"
                                        ><span
                                                    class="digi digi-filter text-blue  mgr5"></span>{{Helpers::getRS($g,"Loc")}}
                                        </button>

                                        <button type="button" id="frm_btnSignupW75F2040"
                                                class="btn btn-default smallbtn pull-right mgr5"
                                                title="{{Helpers::getRS($g,"Dang_ky")}}"
                                        ><span
                                                    class="fa fa-pencil text-orange mgr5"></span> {{Helpers::getRS($g,"Dang_ky")}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                            @if($perW75F2040 != 4)
                                <div class = "row form-group">
                                    <div class = "col-xs-5 col-lg-5 col-md-5">
                                        <div class="row">
                                            <div class="col-md-3 liketext">
                                                <label style = "font-size: 12.6px" class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Thoi_gian_dang_ky")}}</label>
                                            </div>
                                            <div class="col-md-9 liketext">
                                                <div class = "row">
                                                    <div class="col-md-6">
                                                        <div id="divDateFromW75F2040" class="input-group date">
                                                            <input type="text" class="form-control" id="txtValidDateFromW75F2040"
                                                                   name="txtValidDateFromW75F2040" value="" ><span
                                                                    class="input-group-addon"><i onclick="$('#txtValidDateFromW75F2040').datepicker('show');"
                                                                                                 class="glyphicon glyphicon-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div id="divDateToW75F2040" class="input-group date">
                                                            <input type="text" class="form-control" id="txtValidDateToW75F2040"
                                                                   name="txtValidDateToW75F2040" value="" ><span
                                                                    class="input-group-addon"><i  onclick="$('#txtValidDateToW75F2040').datepicker('show');"
                                                                                                  class="glyphicon glyphicon-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "col-xs-2 col-lg-2 col-md-2">

                                    </div>
                                    <div class = "col-xs-5 col-lg-5 col-md-5">
                                        <div class = "row">
                                            <div class = "col-xs-12 col-lg-12 col-md-12 liketext">
                                                <button type="button" id="frm_btnFilterW75F2040"
                                                        class="btn btn-default smallbtn pull-right"
                                                        title="{{Helpers::getRS($g,"Loc")}}"
                                                ><span
                                                            class="digi digi-filter text-blue  mgr5"></span>{{Helpers::getRS($g,"Loc")}}
                                                </button>

                                                <button type="button" id="frm_btnSignupW75F2040"
                                                        class="btn btn-default smallbtn pull-right mgr5"
                                                        title="{{Helpers::getRS($g,"Dang_ky")}}"
                                                ><span
                                                            class="fa fa-pencil text-orange mgr5"></span> {{Helpers::getRS($g,"Dang_ky")}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class = "row form-group">
                                    <div class = "col-xs-5 col-lg-5 col-md-5">
                                        <label> </label>
                                    </div>
                                </div>
                            @endif
                    </form>
                    <div class = "row form-group">
                        <div class = "col-xs-12 col-lg-12 col-md-12">
                            <div id="gridW75F2040"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#txtValidDateFromW75F2040').val("01/01/{{$tranYear}}");
        $('#txtValidDateToW75F2040').val("31/12/{{$tranYear}}");

        $('#txtValidDateFromW75F2040').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });

        $('#txtValidDateToW75F2040').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
    });

    $("#cbBlockIDW75F2040").change(function () {
        //alert("da change");
        $.ajax({
            method: "POST",
            url: '{{url("/W75F2040/$pForm/$g/BlockIDChange")}}',
            data: '&blockID=' + $("#cbBlockIDW75F2040").val(),
            success: function (data) {
                $('#cbDepartmentIDW75F2040').html(data);
                $("#cbDepartmentIDW75F2040").trigger("change");
            }
        });
    });

    $("#cbDepartmentIDW75F2040").change(function () {
        //alert("da change");
        $.ajax({
            method: "POST",
            url: '{{url("/W75F2040/$pForm/$g/DepartmentIDChange")}}',
            data: '&DepartmentID=' + $("#cbDepartmentIDW75F2040").val(),
            success: function (data) {
                $('#cbTeamIDW75F2040').html(data);
            }
        });
    });

    $("#frm_btnFilterW75F2040").click(function () {
        $("#gridW75F2040").pqGrid("showLoading");
        $.ajax({
            method: "POST",
            url: '{{url("/W75F2040/$pForm/$g/filter")}}',
            data: $("#frmW75F2040").serialize() + "&cbBlockIDW75F2040=" + $("#cbBlockIDW75F2040").val() + "&cbDepartmentIDW75F2040=" + $("#cbDepartmentIDW75F2040").val()+ "&cbTeamIDW75F2040=" + $("#cbTeamIDW75F2040").val()+ "&txtEmployeeIDW75F2040=" + $("#txtEmployeeIDW75F2040").val(),
            success: function (data) {
                console.log(data);
                $("#gridW75F2040").pqGrid("option", "dataModel.data", data);
                $("#gridW75F2040").pqGrid("refreshDataAndView");
                $("#gridW75F2040").pqGrid("hideLoading");
            }
        });
    });

    $("#frm_btnSignupW75F2040").click(function () {
        showFormDialogPost('{{url("/W75F2041/$pForm/$g")}}', "modalW75F2041", {mode: 0},2);
    });

    var obj = {
        width: '100%',
        height: $(document).height() - 230,
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
        scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
        collapsible: false,
        postRenderInterval: -1,
        colModel: [
            {
                title: "", editable: false, minWidth: 10, sortable: false, align: "center", isExport: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = "";
                        str += "<a title='{{Helpers::getRS($g,"Sua")}}' class='btnEditW75F2041 mgr10'><i class='glyphicon glyphicon-edit' style='color:orange'></i></a>";
                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class='btnDeleteW75F2041'><i class='fa fa-trash' style='color:#333'></i></a>";
                    return str;
                    },
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var rowData = ui.rowData;

                    //edit button
                    $cell.find(".btnEditW75F2041").bind("click", function (evt) {
                        console.log(rowData);
                        showFormDialogPost('{{url("/W75F2041/$pForm/$g")}}', "modalW75F2041",
                                    {mode: 1,
                                    EmployeeID: rowData.EmployeeID,
                                    BenefitID: rowData.BenefitID}
                                    ,2);
                    });
                    $cell.find(".btnDeleteW75F2041").bind("click", function (evt) {
                        console.log(rowData);
                        ask_delete(function () {
                            postMethod('{{url("/W75F2040/$pForm/$g/delete")}}', function (data) {
                                //console.log("test");
                                if (JSON.parse(data).status == "SUCCESS") {
                                    delete_ok(function () {
                                        //loadDataW38F2040();
                                        update4ParamGrid($("#gridW75F2040"), "", "delete");
                                    });
                                } else {
                                    alert_error(data.message);
                                }
                            }, {BenefitID: rowData["BenefitID"], EmployeeID: rowData["EmployeeID"]});
                        });

                    });
                }
            },
            {
                title: "EmployeeID",
                minWidth: 170,
                dataType: "string",
                dataIndx: "EmployeeID",
                hidden: true,
                isExport: false
            },
            {
                title: "BenefitID",
                minWidth: 170,
                dataType: "string",
                dataIndx: "BenefitID",
                hidden: true,
                isExport: false
            },
            {
                title: "{{Helpers::getRS($g,"Ten_NV")}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "EmployeeName",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Chinh_sach")}}",
                minWidth: 200,
                dataType: "string",
                dataIndx: "BenefitName",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Tham_gia")}}",
                minWidth: 50,
                align: "center",
                dataIndx: "Participation",
                editor: false,
                type: 'checkbox',
                cb: {
                    all: false,
                    header: true,
                    check: "1",
                    uncheck: "0"
                },
                editable: false,
                render: function (ui) {
                    var row = ui.rowData,
                        checked = row["Participation"] == 1 ? 'checked' : ''
                    return {
                        text: "<label><input type='checkbox' " + checked + " /></label>",
                    };
                }
            },
            {
                title: "{{Helpers::getRS($g,"Doi_tuong")}}",
                minWidth: 240,
                dataType: "string",
                dataIndx: "ObjectName",
                editor: false,
                align: "left",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"So_luong_nguoi_than")}}",
                minWidth: 90,
                dataType: "float",
                dataIndx: "NumRelatives",
                editor: false,
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Chi_phi")}}",
                minWidth: 100,
                dataType: "float",
                dataIndx: "Cost",
                editor: false,
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
            }
        ],
        dataModel: {
            data: {{json_encode([])}}
        }
    };
    var $gridW75F2040 = $("#gridW75F2040").pqGrid(obj);
    $gridW75F2040.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $gridW75F2040.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    setTimeout(function () {
        $gridW75F2040.pqGrid("refreshDataAndView");
    }, 700)

</script>