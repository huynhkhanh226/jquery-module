<section class="content" id="secW25F2080">
    <form id="frmW25F2080" name="frmW25F2080" method="post">
        <div class="row">
            <div class="col-md-1">
                <label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Ngay_lap")}}</label>
            </div>
            <div class="col-md-2 col-xs-2">
                <div id="divDateFromW25F2080" class="input-group date">
                    <input type="text" class="form-control" id="txtDateFromW25F2080"
                           name="txtDateFromW25F2080" value="{{date('01/m/Y')}}" ><span
                            class="input-group-addon"><i id="iconDateFrom" onclick="$('#txtDateFromW25F2080').datepicker('show');"
                                class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>
            <div class="col-md-2 col-xs-2">
                <div id="divDateToW25F2080" class="input-group date">
                    <input type="text" class="form-control" id="txtDateToW25F2080"
                           name="txtDateToW25F2080" value="{{date('t/m/Y')}}" ><span
                            class="input-group-addon"><i  onclick="$('#txtDateToW25F2080').datepicker('show');"
                                class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>
            <div class="col-md-2 col-xs-2">
                <div class="liketext">
                    <b><label class="lbl-normal">{{Helpers::getRS($g,"Phong_ban")}}</label></b>
                </div>

            </div>
            <div class="col-md-5 col-xs-5">
                {{ Form::select("cboDepartmentID", $departments ,0,["class" => "col-md-12 form-control", "id" => "cboDepartmentID"])}}
            </div>

        </div>
        <div class="row">
            <div class="col-md-1 pdr0">
                <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Trang_thai")}}</label>
            </div>
            <div class="col-md-4 col-xs-4">
                {{Form::select("cbAppStatusID", $statuss ,"All",["class" => "form-control liketext", "id" => "cbAppStatusID"])}}
            </div>
            <div class="col-md-2 col-xs-2">
                <div class="liketext">
                    <b><label class="lbl-normal">{{Helpers::getRS($g,"Vi_tri")}}</label></b>
                </div>

            </div>
            <div class="col-md-5 col-xs-5">
                <select id="cboPositionID" name="cboPositionID" class="form-control" style="width: 100%;">
                    <option value="%">{{Helpers::getRS($g,"Tat_ca_Web")}}</option>
                    @foreach($positions as $row)
                        <option value="{{$row['PositionID']}}">{{$row['PositionName']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mgt5">
            <div class="col-md-8 col-xs-8">
                <div id="idAddGroup">
                    <button type="button" {{$perW25F2082 >=2 ?  '': 'disabled'}}
                            onclick="showFormDialogPost('{{asset("W25F2081/$pForm/$g/add")}}','modalW25F2081')"
                            class="btn btn-default smallbtn" title="{{Helpers::getRS($g,"Them_moi1")}}">
                        <span class="glyphicon glyphicon-plus {{$perW25F2082 >=2 ?  'text-blue': 'text-gray'}}"></span> {{Helpers::getRS($g,"Them_moi1")}}
                    </button>

                    <button type="button" onclick="exportExcelW25F2080()" class="btn btn-default smallbtn"
                            title="{{Helpers::getRS($g,'Xuat_Excel_U')}}">
                        <span class="fa fa-file-excel-o text-blue"></span> {{Helpers::getRS($g,'Xuat_Excel_U')}}
                    </button>


                </div>
            </div>
            <div class="col-md-4">
                <button class="btn btn-default smallbtn pull-right"><span class="digi digi-filter text-blue"></span>
                    &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
            </div>
        </div>

    </form>
    <div class="row" style="padding: 10px 15px" class="pdt5">
        <div id="gridW25F2080"></div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function () {
        //datepicker
        $('#txtDate').daterangepicker({format: 'DD/MM/YYYY'});
        $("i.fa-calendar").click(function () {
            $("#txtDate").click();
        });
        $('#txtDateFromW25F2080').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#txtDateToW25F2080').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });



        //cboDepartmentID
        @if ($perW25F2080 <=2)
            $("#cboDepartmentID").attr("disabled",true);
            $("#cboDepartmentID").val("{{Session::get("W91P0000")['DepartmentID']}}");
        @endif
        //cboPositionID
        $("#cboPositionID").val("%");
    });

    $("#frmW25F2080").on('submit', function (e) {
        e.preventDefault();
        loadDataW25F2080();
    });

    function loadDataW25F2080() {
        $.ajax({
            method: "POST",
            url: '{{url("/W25F2080/view/$pForm/$g/filter")}}',
            data: $("#frmW25F2080").serialize() + "&departmentIDW25F2080=" + $("#cboDepartmentID").val(),
            success: function (data) {
                console.log(data);
                //setter
                console.log(data);
                $("#gridW25F2080").pqGrid("option", "dataModel.data", data);
                $("#gridW25F2080").pqGrid("refreshDataAndView");
                initFilterCombo();
            }
        });
    }

    function initFilterCombo(){
        var column = $gridW25F2080.pqGrid("getColumn", {dataIndx: "AppStatusName"});
        var filter = column.filter;
        filter.cache = null;
        filter.options = $gridW25F2080.pqGrid("getData", {dataIndx: ["AppStatusName"]});

        $gridW25F2080.pqGrid("refreshDataAndView");
    }

    var obj = {
        width: '100%',
        height: $("#maintabs").height() - 170,
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
                title: "", editable: false, minWidth: 60, sortable: false, align: "center", isExport: false,
                render: function (ui) {
                    var rowData = ui.rowData;
                    var str = "";
                    var perW25F2082 = Number("{{$perW25F2082}}");
                    var appStatusID = rowData["AppStatusID"];

                    if (perW25F2082 >=2 && appStatusID <=1){
                        str += "<a title='{{Helpers::getRS($g,"Sua")}}' class='btnEditW25F2080 mgr10'><i class='glyphicon glyphicon-edit' style='color:orange'></i></a>";
                    }else{
                        str += "<a title='{{Helpers::getRS($g,"Sua")}}' class='btnEditW25F2080Disabled mgr10'><i class='glyphicon glyphicon-edit' style='color:#ccc'></i></a>";
                    }
                    if (perW25F2082 >=2 && appStatusID <=1){
                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class='btnDeleteW25F2080'><i class='fa fa-trash' style='color:#333'></i></a>";
                    }else{
                        str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class='btnDeleteW25F2080Disabled'><i class='fa fa-trash' style='color:#ccc'></i></a>";
                    }


                    return str;
                },
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var rowData = ui.rowData;

                    //edit button
                    $cell.find(".btnEditW25F2080").bind("click", function (evt) {
                        showFormDialogPost('{{url("/W25F2081/$pForm/$g/edit")}}', "modalW25F2081", {
                            transID: rowData["TransID"],
                            departmentID: rowData["DepartmentID"],
                            year: rowData["Year"]
                        });
                    });
                    $cell.find(".btnDeleteW25F2080").bind("click", function (evt) {
                        ask_delete(function () {
                            postMethod('{{url("/W25F2080/view/$pForm/$g/delete")}}', function (data) {
                                console.log("test");
                                if (JSON.parse(data).status == "SUCCESS") {
                                    delete_ok(function () {
                                        //loadDataW25F2080();
                                        update4ParamGrid($("#gridW25F2080"), "", "delete", initFilterCombo);
                                    });
                                } else {
                                    alert_error(data.message);
                                }

                            }, {transID: rowData["TransID"]});
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
                    str += "<a title='{{Helpers::getRS($g,"Lich_su_duyet")}}' class='btnViewHistoryW25F2080 mgr10 text-blue'>" + rowData["AppStatusName"] + "</a>";
                    return str;
                },
                postRender: function (ui) {
                    var rowIndx = ui.rowIndx,
                        grid = this,
                        $cell = grid.getCell(ui);
                    var row = ui.rowData;
                    //edit button
                    $cell.find(".btnViewHistoryW25F2080").bind("click", function (evt) {
                        showFormDialogPost('{{url("/W09F3030/$pForm/$g")}}', "modalW09F3030", {transID: row["TransID"]},2);
                    });

                }
            },
            {
                title: "TransID",
                minWidth: 170,
                dataType: "string",
                dataIndx: "TransID",
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
                title: "{{Helpers::getRS($g,"Ten_ke_hoach")}}",
                minWidth: 340,
                dataType: "string",
                dataIndx: "PlanName",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Vi_tri_tuyen_dung")}}",
                minWidth: 230,
                dataType: "string",
                dataIndx: "PositionName",
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
                /*filter: {
                    type: "select",
                    condition: 'equal',
                    prepend: {'': '---'},
                    valueIndx: "DepartmentName",
                    labelIndx: "DepartmentName",
                    listeners: ['change']
                }*/

            },
            {
                title: "{{Helpers::getRS($g,"To_nhom")}}",
                minWidth: 230,
                dataType: "string",
                dataIndx: "TeamName",
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
                title: "{{Helpers::getRS($g,"Cong_viec")}}",
                minWidth: 230,
                dataType: "string",
                dataIndx: "WorkName",
                hidden: true,
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                /*filter: {
                    type: "select",
                    condition: 'equal',
                    prepend: {'': '---'},
                    valueIndx: "WorkName",
                    labelIndx: "WorkName",
                    listeners: ['change']
                }*/
            },
            {
                title: "{{Helpers::getRS($g,"Dinh_muc")}}",
                minWidth: 140,
                dataType: "float",
                dataIndx: "NormQuan",
                editor: false,
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"SL_hien_tai")}}",
                minWidth: 140,
                dataType: "float",
                dataIndx: "PresentQuan",
                editor: false,
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
            },

            {
                title: "{{Helpers::getRS($g,"SL_can_tuyen")}}",
                minWidth: 140,
                dataType: "float",
                dataIndx: "Number",
                editor: false,
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Tu_ngay")}}",
                minWidth: 140,
                sortable: false,
                dataType: "date",
                dataIndx: "DateFrom",
                align: "center",
                editor: false,
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,"Den_ngay")}}",
                minWidth: 140,
                sortable: false,
                dataType: "date",
                dataIndx: "DateTo",
                align: "center",
                editor: false,
                filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
            },
            {
                title: "{{Helpers::getRS($g,"Muc_luong_du_kien")}}",
                minWidth: 140,
                dataType: "float",
                dataIndx: "ExpSalary",
                format: "{{Helpers::getStringFormat(Session::get("W91P0000")['D90_ConvertedDecimals'])}}",
                editor: false,
                filter: {type: 'textbox', condition: 'equal', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Ly_do")}}",
                minWidth: 240,
                dataType: "string",
                align: "left",
                dataIndx: "Reason",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            },
            {
                title: "{{Helpers::getRS($g,"Ghi_chu")}}",
                minWidth: 240,
                dataType: "string",
                align: "left",
                dataIndx: "Note",
                editor: false,
                filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
            }
        ],
        dataModel: {
            data: {{json_encode([])}}
        }
    };
    var $gridW25F2080 = $("#gridW25F2080").pqGrid(obj);
    $gridW25F2080.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    $gridW25F2080.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    $gridW25F2080.pqGrid("refreshDataAndView");


    var exportExcelW25F2080 = function () {
        var _title = [];
        var _dataIndx = [];
        var _align = [];
        var _format = [];
        initExportExcell($("#gridW25F2080"), _title, _dataIndx, _align, _format);
        var _data = JSON.stringify($("#gridW25F2080").pqGrid("option", "dataModel.data"));

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
                    downloadLink.download = "Ke_hoach_tuyen_dung_tong_the_" + d.getDate() + "" + d.getMonth() + "" + d.getFullYear() + ".xls";
                    downloadLink.innerHTML = "Ke_hoach_tuyen_dung_tong_the_";
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

