<div class="modal fade" id="modalW09F2150" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($titleW09F2150,"W09F2150",true,"")}}
            </div>

            <div class="modal-body" style="padding:10px">
                <form class="form-horizontal" id="frmW09F2150">
                    <div class="row form-group">
                        <div class="col-md-1">
                            <div class="liketext">
                                <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Ngay_lap")}}</label>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2">
                            <div id="divDateFromW25F2080" class="input-group date">
                                <input type="text" class="form-control" id="txtDateFromW09F2150"
                                       name="txtDateFromW09F2150" value="{{date('01/m/Y')}}" ><span
                                        class="input-group-addon"><i id="iconDateFrom" onclick="$('#txtDateFromW09F2150').datepicker('show');"
                                                                     class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2">
                            <div id="divDateToW25F2080" class="input-group date">
                                <input type="text" class="form-control" id="txtDateToW09F2150"
                                       name="txtDateToW09F2150" value="{{date('t/m/Y')}}" ><span
                                        class="input-group-addon"><i  onclick="$('#txtDateToW09F2150').datepicker('show');"
                                                                      class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <label class="lbl-normal pdr0">{{Helpers::getRS($g,"Trang_thai")}}</label>
                        </div>
                        <div class="col-md-3">
                                {{Form::select("cbAppStatusID", $statuss ,"All",["class" => "form-control", "id" => "cbAppStatusID"])}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-xs-8">
                            <div id="idAddGroup" class="">
                                <button type="button" onclick="showFormDialogPost('{{asset("W09F2151/$pForm/$g/add")}}','modalW09F2151', '', null)"
                                        class="btn btn-default smallbtn" title="{{Helpers::getRS($g,"Them_moi1")}}">
                                    <span class="glyphicon glyphicon-plus text-blue"></span> {{Helpers::getRS($g,"Them_moi1")}}
                                </button>

                                <button  type="button"  onclick="exportExcelW09F2150()" class="btn btn-default smallbtn"
                                         title="{{Helpers::getRS($g,'Xuat_Excel_U')}}">
                                    <span class="fa fa-file-excel-o text-blue"></span> {{Helpers::getRS($g,'Xuat_Excel_U')}}
                                </button>


                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnFilterW09F2150" class="btn btn-default smallbtn pull-right"><span class="digi digi-filter text-blue"></span>
                                &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                        </div>
                    </div>
                    <button type="submit" id="hdBtnSubmitW09F2150" class="hidden"></button>
                </form>
                <div class="row mgt10">
                    <div class="col-md-12">
                        <div id="gridW09F2150"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div id="divModalW25F2151"></div>
<div id="secDetailE09F0000">   </div>
<script type="text/javascript">
    $(document).ready(function (e) {
        setTimeout(function () {
            $gridW09F2150.pqGrid("refreshDataAndView");
        }, 300)

        $('#txtDateFromW09F2150').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#txtDateToW09F2150').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
    });

    $("#btnFilterW09F2150").click(function(){
        var txtDateFromW09F2150 = $("#txtDateFromW09F2150");
        var txtDateToW09F2150 = $("#txtDateToW09F2150");


        if (txtDateFromW09F2150.val() == "" && txtDateToW09F2150.val() != "") {
            alert_warning("{{Helpers::getRS($g,'Ban_chua_nhap_ngay_tu')}}", function(){
                txtDateFromW09F2150.focus();
            })
            return;
        }

        if (txtDateFromW09F2150.val() != "" && txtDateToW09F2150.val() == "") {
            alert_warning("{{Helpers::getRS($g,'Ban_chua_nhap_ngay_den')}}", function(){
                txtDateToW09F2150.focus();
            })
            return;
        }

        $("#frmW09F2150").find('#hdBtnSubmitW09F2150').click();
    });

    $("#frmW09F2150").on('submit', function (e) {
        e.preventDefault();
        loadDataW09F2150();
    });

    function loadDataW09F2150() {
        $.ajax({
            method: "POST",
            url: '{{url("/W09F2150/$pForm/$g/filter")}}',
            data: $("#frmW09F2150").serialize(),
            success: function (data) {
                console.log(data);
                //setter
                console.log(data);
                $gridW09F2150.pqGrid("option", "dataModel.data", data);
                $gridW09F2150.pqGrid("refreshDataAndView");
                initFilterCombo();
            }
        });
    }

    function initFilterCombo(){
        /*var $gridW09F2150 = $("#gridW09F2150");
        var column = $gridW09F2150.pqGrid("getColumn", {dataIndx: "DepartmentName"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $gridW09F2150.pqGrid("getData", {dataIndx: ["DepartmentName"]});

        var column = $gridW09F2150.pqGrid("getColumn", {dataIndx: "NewDeparmentName"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $gridW09F2150.pqGrid("getData", {dataIndx: ["NewDeparmentName"]});

        var column = $gridW09F2150.pqGrid("getColumn", {dataIndx: "TeamName"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $gridW09F2150.pqGrid("getData", {dataIndx: ["TeamName"]});

        var column = $gridW09F2150.pqGrid("getColumn", {dataIndx: "NewTeamName"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $gridW09F2150.pqGrid("getData", {dataIndx: ["NewTeamName"]});

        var column = $gridW09F2150.pqGrid("getColumn", {dataIndx: "WorkName"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $gridW09F2150.pqGrid("getData", {dataIndx: ["WorkName"]});

        var column = $gridW09F2150.pqGrid("getColumn", {dataIndx: "NewWorkName"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $gridW09F2150.pqGrid("getData", {dataIndx: ["NewWorkName"]});

        var column = $gridW09F2150.pqGrid("getColumn", {dataIndx: "NewApproval"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $gridW09F2150.pqGrid("getData", {dataIndx: ["NewApproval"]});*/

       /* var column = $gridW09F2150.pqGrid("getColumn", {dataIndx: "StatusName"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $gridW09F2150.pqGrid("getData", {dataIndx: ["StatusName"]});
*/

        setTimeout(function(){
            //alert("dfdsfd");
            $gridW09F2150.pqGrid("refreshDataAndView");
        }, 500);
    }

    var obj = {
        width: '100%',
        height: $(document).height() - 145,
        editable: false,
        freezeCols: 1,
        selectionModel: {type: 'row'},
        minWidth: 30,
        pageModel: {type: "local", rPP: 20},
        filterModel: {on: true, mode: "AND", header: true},
        showTitle: false,
        dataType: "JSON",
        //scrollModel: {horizontal: false, pace: 'fast', autoFit: true, lastColumn: 'none'},
        wrap: true,
        hwrap: false,
        collapsible: false,
        postRenderInterval: -1,
        colModel: [
            {
                title: "", editable: false, minWidth: 70, sortable: false, align: "center", isExport: false,
                render: function (ui) {
                    var str = "";
                    var rowData = ui.rowData;
                    if (rowData["AppStatusID"] <= 1){
                        str += "<a title='{{Helpers::getRS($g,"Sua")."/".Helpers::getRS($g,"Xoa")}}' class='btnEditW09F2150 mgr10'><i class='glyphicon glyphicon-edit' style='color:orange'></i></a>";
                        str += "<a title='{{Helpers::getRS($g,"Sua")."/".Helpers::getRS($g,"Xoa")}}' class='btnDeleteW09F2150'><i class='fa fa-trash' style='color:#333'></i></a>";
                    }else{
                        str += "<a title='{{Helpers::getRS($g,"Sua")."/".Helpers::getRS($g,"Xoa")}}' class=' mgr10'><i class='glyphicon glyphicon-edit' style='color:#ccc'></i></a>";
                        str += "<a title='{{Helpers::getRS($g,"Sua")."/".Helpers::getRS($g,"Xoa")}}' class=''><i class='fa fa-trash' style='color:#ccc'></i></a>";
                    }

                    return str;
                },
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var rowData = ui.rowData;
                    //edit button
                    $cell.find(".btnEditW09F2150").bind("click", function (evt) {
                        var employeeID = rowData["EmployeeID"];
                        var proTransID = rowData["ProTransID"];
                        showFormDialogPost('{{url("/W09F2151/$pForm/$g/edit")}}', "modalW09F2151", {employeeID: employeeID, proTransID:proTransID},2);
                    });
                    $cell.find(".btnDeleteW09F2150").bind("click", function (evt) {
                        ask_delete(function(){
                            postMethod('{{url("/W09F2150/$pForm/$g/delete")}}', function(data){
                                if (data == 1){
                                    delete_ok();
                                    update4ParamGrid($("#gridW09F2150"), '', 'delete');
                                }else{
                                    console.log("Erors:");
                                }
                            }, {proTransID: rowData["ProTransID"]});
                        });

                    });
                }
            },

            {
                title: "ProTransID",
                minWidth: 240,
                dataType: "string",
                align: "center",
                hidden: true,
                dataIndx: "ProTransID",
                isExport: false
            },

            {
                title: "EmployeeID",
                minWidth: 240,
                dataType: "string",
                align: "center",
                hidden: true,
                dataIndx: "EmployeeID",
                isExport: false
            },

            {
                title: "AppStatusID",
                minWidth: 240,
                dataType: "string",
                align: "center",
                hidden: true,
                dataIndx: "AppStatusID",
                isExport: false
            },
            {
                title: "{{Helpers::getRS($g,"Nhan_vien")}}",
                minWidth: 170,
                dataType: "string",
                align: "left",
                dataIndx: "EmployeeName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = "";
                    str += "<a title='{{Helpers::getRS($g,"Nhan_vien")}}' class='btnViewEmployeeID mgr10 text-blue'>"+rowData["EmployeeName"]+"</a>";
                    return str;
                },
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var row = ui.rowData;
                    //edit button
                    $cell.find(".btnViewEmployeeID").bind("click", function (evt) {
                        showW09F4444W15(row["EmployeeID"]);
                    });

                }
            },
            {
                title: "{{Helpers::getRS($g,"Ngay_hieu_luc")}}",
                minWidth: 110,
                sortable: false,
                dataType: "date",
                dataIndx: "ValidDate",
                align: "center",
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,"Phong_ban")}}",
                minWidth: 170,
                dataType: "string",
                align: "left",
                dataIndx: "DepartmentName",
                /*filter: {
                    type: "select",
                    condition: 'equal',
                    prepend: {'': '---'},
                    valueIndx: "DepartmentName",
                    labelIndx: "DepartmentName",
                    listeners: ['change']
                },*/
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Phong_ban_moi")}}",
                minWidth: 170,
                dataType: "string",
                align: "left",
                dataIndx: "NewDepartmentName",
                /*filter: {
                    type: "select",
                    condition: 'equal',
                    prepend: {'': '---'},
                    valueIndx: "NewDeparmentName",
                    labelIndx: "NewDeparmentName",
                    listeners: ['change']
                },*/
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"To_nhom")}}",
                minWidth: 170,
                dataType: "string",
                align: "left",
                dataIndx: "TeamName",
                /*filter: {
                    type: "select",
                    condition: 'equal',
                    prepend: {'': '---'},
                    valueIndx: "TeamName",
                    labelIndx: "TeamName",
                    listeners: ['change']
                },*/
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"To_nhom_moi")}}",
                minWidth: 170,
                dataType: "string",
                align: "left",
                dataIndx: "NewTeamName",
                /*filter: {
                    type: "select",
                    condition: 'equal',
                    prepend: {'': '---'},
                    valueIndx: "NewTeamName",
                    labelIndx: "NewTeamName",
                    listeners: ['change']
                },*/
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Nguoi_QLTT")}}",
                minWidth: 170,
                dataType: "string",
                align: "left",
                dataIndx: "DirectManagerName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
            },
            {
                title: "{{Helpers::getRS($g,"Nguoi_QLTT_moi")}}",
                minWidth: 170,
                dataType: "string",
                align: "left",
                dataIndx: "NewDirectManagerName",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']},
            },
            {
                title: "{{Helpers::getRS($g,"Cong_viec")}}",
                minWidth: 170,
                dataType: "string",
                align: "left",
                dataIndx: "WorkName",
                /*filter: {
                    type: "select",
                    condition: 'equal',
                    prepend: {'': '---'},
                    valueIndx: "WorkName",
                    labelIndx: "WorkName",
                    listeners: ['change']
                },
            },*/
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Cong_viec_moi")}}",
                minWidth: 170,
                dataType: "string",
                align: "left",
                dataIndx: "NewWorkName",
                /*filter: {
                    type: "select",
                    condition: 'equal',
                    prepend: {'': '---'},
                    valueIndx: "NewWorkName",
                    labelIndx: "NewWorkName",
                    listeners: ['change']
                },*/
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: '{{Helpers::getRS($g,"Dieu_chinh_luong")}}',
                minWidth: 150,
                dataType: "string",
                dataIndx: "IsSalaryAdjustment",
                editor: false,
                align: "center",

                render: function (ui) {
                    var rowData = ui.rowData;
                    return '<input type="checkbox" disabled ' + (rowData["IsSalaryAdjustment"] == 1 ? "checked" : "") + '>';
                }
            }
            @foreach($rsColumns as $row)
            , {
                title: "{{$row['CaptionName']}}",
                minWidth: 80,
                width: 140,
                dataType: "float",
                align: "right",
                format: returnSFormat({{$row['Decimals']}}),
                dataIndx: "{{$row['Field']}}",
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
            }
            @endforeach
            @foreach($rsColumns as $row)
            , {
                @if ($lang == "84")
                title: "{{$row['CaptionName'].' mới'}}",
                @else
                title: "{{'New '.$row['CaptionName']}}",
                @endif
                minWidth: 80,
                width: 170,
                dataType: "float",
                align: "right",
                format: returnSFormat({{$row['Decimals']}}),
                dataIndx: "{{"New".$row['Field']}}",
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
            }
            @endforeach
            ,
            {
                title: "{{Helpers::getRS($g,"Trang_thai")}}",
                minWidth: 170,
                dataType: "string",
                align: "center",
                dataIndx: "AppStatusName",
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']},
                /*filter: {
                    type: "select",
                    condition: 'equal',
                    prepend: {'': '---'},
                    valueIndx: "NewApprovalStatusName",
                    labelIndx: "NewApprovalStatusName",
                    listeners: ['change']
                },*/
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = "";
                    str += "<a title='{{Helpers::getRS($g,"Lich_su_duyet")}}' class='btnViewHistoryW09F2150 mgr10 text-blue'>"+rowData["AppStatusName"]+"</a>";
                    return str;
                },
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var row = ui.rowData;
                    //edit button
                    $cell.find(".btnViewHistoryW09F2150").bind("click", function (evt) {
                        showFormDialogPost('{{url("/W09F3030/$pForm/$g")}}', "modalW09F3030", {transID: row["ProTransID"]},2);
                    });

                }
            },
            {
                title: "{{Helpers::getRS($g,"Ly_do")}}",
                minWidth: 340,
                dataType: "string",
                align: "left",
                dataIndx: "Reason",
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            }

        ],
        dataModel: {
            data: {{json_encode([])}}
        }
    };
    var $gridW09F2150 = $("#gridW09F2150").pqGrid(obj);
    $gridW09F2150.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $gridW09F2150.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    $gridW09F2150.pqGrid("refreshDataAndView");

    var exportExcelW09F2150=function() {
        var _title = [];
        var _dataIndx =[];
        var _align = [];
        var _format = [];
        initExportExcell($("#gridW09F2150"),_title,_dataIndx,_align,_format);
        var _data = JSON.stringify($("#gridW09F2150").pqGrid("option", "dataModel.data"));

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
                    downloadLink.download = "De_xuat_chuyen_lao_dong_" + new Date().getTime()+".xls";
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

    function showW09F4444W15(empid){
        $(".l3loading").removeClass('hide');
        showFormDialogPost("{{url("W09F4444/4")}}", "modalW09F4444", {empid:empid}, null);
    }
</script>