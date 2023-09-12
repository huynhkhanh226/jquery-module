<div class="modal fade" id="modalW25F2081" data-backdrop="static" role="dialog">
    <div class="modal-dialog formduyet">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($titleW25F2081,"W25F2081",true,"")}}
            </div>
            @if ($task == "edit" || $task == "view")
                @define $txtYearW25F2081 = $year
                @define $cboDepartmentIDW25F2081 = $departmentID
                @define $rsData =  $rsData
            @else
                @define $txtYearW25F2081 = ""
                @if ($perW25F2080 <=2)
                    @define $cboDepartmentIDW25F2081 = Session::get("W91P0000")['DepartmentID']
                @else
                    @define $cboDepartmentIDW25F2081 = $departments[0]["DepartmentID"]
                @endif
                @define $rsData =  []
            @endif

            <div class="modal-body" style="padding:10px">
                <form class="form-horizontal" id="frmW25F2081">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="liketext">
                                <b><label class="lbl-normal pdr0 ">{{Helpers::getRS($g,"Nam")}}</label></b>
                            </div>

                        </div>
                        <div class="col-md-1">
                            <input type="text" class="form-control text-right noUseValidHTML5" placeholder="____" id="txtYearW25F2081" name="txtYearW25F2081" value="{{$txtYearW25F2081}}" maxlength="4"  required>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <div class="liketext">
                                <b><label class="lbl-normal">{{Helpers::getRS($g,"Phong_ban")}}</label></b>
                            </div>

                        </div>
                        <div class="col-md-4 col-xs-4">
                            <select id="cboDepartmentIDW25F2081" name="cboDepartmentIDW25F2081" class="form-control noUseValidHTML5"  required>
                                @foreach($departments as $rowDepartment)
                                    <option value="{{$rowDepartment['DepartmentID']}}" {{$rowDepartment['DepartmentID'] == $cboDepartmentIDW25F2081 ? "selected": ""}} >{{$rowDepartment['DepartmentName']}}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>
                    <button type="submit" id="hdBtnSaveW25F2081" class="hidden"></button>
                </form>
                <div class="row mgt5">
                    <div class="col-md-12">
                        <div id="gridW25F2081"></div>
                    </div>
                </div>
                <div class="row mgt10">

                    <div class="col-md-12 col-xs-12">
                        <div class="pull-right">
                            <button type="button" id="btnSaveW25F2081" name="btnSaveW25F2081"
                                    class="btn btn-default smallbtn"><span
                                        class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                            </button>
                            @if ($task == "add")
                                <button type="button" id="btnNextW25F2081" name="btnNextW25F2081"
                                        class="btn btn-default smallbtn"><span
                                            class="fa fa-arrow-right text-blue mgr5"></span> {{Helpers::getRS($g,"Nhap_tiep")}}
                                </button>
                            @endif
                            <button type="button" id="btnNotSaveW25F2081" name="btnNotSaveW25F2081"
                                    class="btn btn-default smallbtn"><span
                                        class="fa fa-ban text-red"></span> {{Helpers::getRS($g,"Khong_luu")}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var fixData = {{json_encode($fixData)}};
    var task = "{{$task}}";
    var firstLoad = true;
    $(document).ready(function (e) {

        $("#cboDepartmentIDW25F2081").change(function(){
            loadTeams($("#cboDepartmentIDW25F2081").val());
        });
        function loadTeams(departmentID){
            $.ajax({
                method: "POST",
                url: '{{url("/W25F2081/$pForm/$g/reloadteams")}}',
                data: "departmentID=" + departmentID,
                success: function (data) {
                    console.log(data);
                    $grid = $("#gridW25F2081");
                    //getter
                    var colM = $grid.pqGrid( "option", "colModel" );
                    var colIndx = $grid.pqGrid( "getColIndx", { dataIndx: "TeamName" } );

                    //get nested colModel of 1st column if any.
                    var colModel = colM[colIndx].colModel;



                    var column = $grid.pqGrid( "getColumn",{ dataIndx: "TeamName" } );
                    //console.log(column);
                    column.editor.options = data;
                    //$grid.pqGrid( "option", "editor", data );
                    $grid.pqGrid( "option", "dataModel.data", []);
                    $grid.pqGrid( "refreshDataAndView");
                }
            });
        }



        var newDate = null;
        var dateEditor = function(ui){
            var $inp = ui.$cell.find("input"),
                grid = this;
            //initialize the editor
            $inp.datepicker({
                changeMonth: true,
                changeYear: true,
                autoclose: true,
                format: "dd/mm/yyyy",
                language: 'vi',
                todayHighlight: true,
                showOnFocus: true,
                toggleActive: true,
                allowDeselection: false,
                defaultViewDate : '',
                isDateGrid: true
            }).on('changeDate', function (d) {
                var da = (new Date(d.date)).toString('dd/MM/yyyy');
                //alert(da);
                newDate = da;
            });
        }

        var getCustomData = function (ui){
            return newDate;
        }

        var objW25F2081 = {
            width: '100%',
            height: $(document).height() - 155,
            showTitle: false,
            collapsible: false,
            editable: true,
            postRenderInterval: -1,
            numberCell: {resizable: true, title: "#"},
            freezeCols: 1,
            dataType: "JSON",
            //selectionModel: {type: 'row', mode: 'single'},
            //filterModel: {on: true, mode: "AND", header: false},
            showTitle: false,
            showTop:true,
            showBottom: false,
            sortable: false,
            hwrap: false,
            wrap: false,
            editModel: {
                saveKey: $.ui.keyCode.ENTER,
                select: true,
                keyUpDown: false,
                cellBorderWidth: 0,
                clicksToEdit: 1
            },
            @if ($task == "add")
            toolbar: {
                items: [
                    {
                        type: 'button',
                        label: "{{Helpers::getRS($g,"Them_moi1")}}",
                        icon: 'ui-icon-plus',
                        listener: function () {
                            $grid = $("#gridW25F2081");
                            $grid.pqGrid("saveEditCell");
                            $grid.pqGrid("quitEditMode");
                            defaultValueOnGrid();

                        }
                    }]
            },
            @endif
            colModel: [
                {
                    title: "TeamID",
                    minWidth: 170,
                    dataType: "string",
                    dataIndx: "TeamID",
                    hidden: true
                },
                {
                    title: "{{Helpers::getRS($g,"Dien_giai")}}",
                    minWidth: 230,
                    dataType: "string",
                    dataIndx: "Description",
                    //required: true,
                    editable: true,
                    editor: true,
                    hidden: true
                },
                {
                    title: "{{Helpers::getRS($g,"Vi_tri_tuyen_dung")}}",
                    minWidth: 230,
                    dataType: "string",
                    required: true,
                    dataIndx: "PositionName",
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    editor: {
                        type: 'select',
                        valueIndx: "PositionID",
                        labelIndx: "PositionName",
                        mapIndices: {"PositionID": "PositionID", "PositionName": "PositionName"},
                        options: {{json_encode($positions)}}

                    },
                    editable: true
                    /*editable: function (ui) {
                        return true
                    },
                    required: true,
                    render: function (ui) {
                        return {
                            cls: 'gridColRequire'
                        };
                    },*/
                    //render: function (ui) {
                    /*var disabled = this.isEditableCell(ui) ? "" : "disabled";
                    return {
                        cls: (disabled ? "readonly-status" : "")
                    };*/
                    //}
                },
                {
                    title: "{{Helpers::getRS($g,"To_nhom")}}",
                    minWidth: 230,
                    dataType: "string",
                    dataIndx: "TeamName",
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    editor: {
                        type: 'select',
                        valueIndx: "TeamID",
                        labelIndx: "TeamName",
                        mapIndices: {"TeamID": "TeamID", "TeamName": "TeamName"},
                        options: {{json_encode($teams)}}

                    },
                    editable: true
                    /*editable: function (ui) {
                        return true
                    },
                    render: function (ui) {
                        /!*var disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };*!/
                    }*/
                },
                {
                    title: "PositionID",
                    minWidth: 230,
                    dataType: "string",
                    dataIndx: "PositionID",
                    hidden: true

                },
                {
                    title: "WorkID",
                    minWidth: 170,
                    dataType: "string",
                    dataIndx: "WorkID",
                    hidden: true
                },
                {
                    title: "{{Helpers::getRS($g,"Cong_viec")}}",
                    minWidth: 230,
                    dataType: "string",
                    dataIndx: "WorkName",
                    hidden: true,
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                    editor: {
                        type: 'select',
                        valueIndx: "WorkID",
                        labelIndx: "WorkName",
                        mapIndices: {"WorkID": "WorkID", "WorkName": "WorkName"},
                        options: {{json_encode($works)}}

                    },
                    editable: true
                    /* editable: function (ui) {
                         return true
                     },
                     render: function (ui) {
                         /!*var disabled = this.isEditableCell(ui) ? "" : "disabled";
                         return {
                             cls: (disabled ? "readonly-status" : "")
                         };*!/
                     }*/
                },
                {
                    title: "{{Helpers::getRS($g,"Dinh_muc")}}",
                    minWidth: 140,
                    dataType: "integer",
                    dataIndx: "NormQuan",
                    editable: false,
                    render: function (ui) {
                        var disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    }
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },

                {
                    title: "{{Helpers::getRS($g,"SL_hien_tai")}}",
                    minWidth: 140,
                    dataType: "integer",
                    dataIndx: "PresentQuan",
                    editable: false,
                    render: function (ui) {
                        var disabled = this.isEditableCell(ui) ? "" : "disabled";
                        return {
                            cls: (disabled ? "readonly-status" : "")
                        };
                    }
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },

                {
                    title: "{{Helpers::getRS($g,"SL_can_tuyen")}}",
                    minWidth: 140,
                    dataType: "integer",
                    dataIndx: "Number",
                    required: true,
                    editable: true,
                    editor: true
                    /*render: function (ui) {
                        return {
                            cls: 'gridColRequire'
                        };
                    },*/
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },

                {
                    title: "{{Helpers::getRS($g,"Tu_ngay")}}",
                    minWidth: 110,
                    sortable: false,
                    dataType: "date",
                    dataIndx: "DateFrom",
                    align: "center",
                    //filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                    editor: {
                        //type: dateEditor
                        type: 'textbox',
                        init: dateEditor,
                        getData: getCustomData,
                    },
                    required: true,
                    //editor: true,
                    //editable: true
                    /*render: function (ui) {
                        return {
                            cls: 'gridColRequire'
                        };
                    },*/
                },

                {
                    title: "{{Helpers::getRS($g,"Den_ngay")}}",
                    minWidth: 110,
                    sortable: false,
                    dataType: "date",
                    dataIndx: "DateTo",
                    align: "center",
                    //filter: {type: "textbox", condition: "equal", init: pqDatePicker, listeners: ['change']}
                    editor: {
                        //type: dateEditor
                        type: 'textbox',
                        init: dateEditor,
                        getData: getCustomData,
                    },
                    required: true,
                    //editable: true,
                    //editor: true
                    /*render: function (ui) {
                        return {
                            cls: 'gridColRequire'
                        };
                    },*/
                },

                {
                    title: "{{Helpers::getRS($g,"Muc_luong_du_kien")}}",
                    minWidth: 140,
                    dataType: "float",
                    dataIndx: "ExpSalary",
                    format: "{{Helpers::getStringFormat(2)}}",
                    editable: true,
                    editor: true
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ly_do")}}",
                    minWidth: 270,
                    dataType: "string",
                    align: "center",
                    dataIndx: "Reason",
                    editable: true,
                    editor: true
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                },
                {
                    title: "{{Helpers::getRS($g,"Ghi_chu")}}",
                    minWidth: 270,
                    dataType: "string",
                    align: "center",
                    dataIndx: "Note",
                    editable: true,
                    editor: true
                    //filter: {type: 'textbox', condition: 'contain', listeners: ['keyup']}
                }
            ],
            dataModel: {
                data: {{json_encode($rsData)}},
                location: "local",
                sorting: "local",
                sortDir: "down"
            },
            complete: function (event, ui) {
                console.log('complete');
            },
            cellKeyDown: function (event, ui) {
                $grid = $("#gridW25F2081");
                var editable = $grid.pqGrid("option", "editable");
                if (editable) {
                    // insert key
                    if (event.keyCode == 45) { // insert key event
                        if (task != "edit"){
                            event.stopPropagation();
                            event.preventDefault();
                            $grid.pqGrid("saveEditCell");//Có ý nghĩa là phải lưu cell hiện tại trước đã rồi mới thêm dòng mới
                            $grid.pqGrid("quitEditMode");
                            defaultValueOnGrid();
                            //event.stopPropagation();
                            //event.preventDefault();
                        }

                    }
                    //delete row ctrl + delete
                    if (event.keyCode == 46 && event.ctrlKey) {
                        if (task != "edit"){
                            event.stopPropagation();
                            event.preventDefault();
                            var numrow = $grid.pqGrid("option", "dataModel.data").length;
                            var rowIndx = ui.rowIndx;
                            $grid.pqGrid("deleteRow", {rowIndx: rowIndx});
                            //Bình thường grid sẽ xóa dòng hiện tại, và di chuyển trỏ xuống dòng dưới.
                            //Đoạn code này xử lý nếu xóa dòng hiện tại, mà ở dưới không có dòng để focus thì nó focus dòng ỏ kế trên
                            if (rowIndx > 0) {
                                if (rowIndx < numrow - 1) {
                                    $grid.pqGrid("setSelection", {
                                        rowIndx: rowIndx,
                                        colIndx: ui.colIndx
                                    });
                                } else {
                                    $grid.pqGrid("setSelection", {
                                        rowIndx: rowIndx - 1,
                                        colIndx: ui.colIndx
                                    });
                                }

                            }
                        }


                    }
                    //delete
                    if (event.keyCode == 46 && (ui.column.editable === undefined || ui.column.editable)) {
                        event.stopPropagation();
                        event.preventDefault();
                        var rowData = ui.rowData;
                        $grid = $("#gridW25F2081");
                        switch (ui.dataIndx){
                            case "TeamName":
                                rowData["TeamID"] = '';
                                rowData["TeamName"] = '';
                                $grid.pqGrid("refreshCell", {rowIndx: ui.rowIndx, dataIndx: "TeamID"});
                                $grid.pqGrid("refreshCell", {rowIndx: ui.rowIndx, dataIndx: "TeamName"});
                                break;
                            case "PositionName":
                                rowData["PositionID"] = '';
                                rowData["PositionName"] = '';
                                $grid.pqGrid("refreshCell", {rowIndx: ui.rowIndx, dataIndx: "PositionID"});
                                $grid.pqGrid("refreshCell", {rowIndx: ui.rowIndx, dataIndx: "PositionName"});
                                break;
                            case "WorkName":
                                rowData["WorkID"] = '';
                                rowData["WorkName"] = '';
                                $grid.pqGrid("refreshCell", {rowIndx: ui.rowIndx, dataIndx: "WorkID"});
                                $grid.pqGrid("refreshCell", {rowIndx: ui.rowIndx, dataIndx: "WorkName"});
                                break;
                        }
                        resetDefaultValue(rowData);
                    }
                }
            },
            editorKeyDown: function (event, ui) {

                $grid = $("#gridW25F2081");
                //delete
                if (event.keyCode == 46) {
                    event.stopPropagation();
                    event.preventDefault();
                    $(ui.$cell[0]).find("input").val(null);//Đây là delete giá trị tạm thời nên không tính lại value
                }

                //delete row ctrl + delete
                if (event.keyCode == 46 && event.ctrlKey) {
                    if (task != "edit"){
                        event.stopPropagation();
                        event.preventDefault();
                        var numrow = $grid.pqGrid("option", "dataModel.data").length;
                        var rowIndx = ui.rowIndx;
                        $grid.pqGrid("deleteRow", {rowIndx: rowIndx});

                        //Bình thường grid sẽ xóa dòng hiện tại, và di chuyển trỏ xuống dòng dưới.
                        //Đoạn code này xử lý nếu xóa dòng hiện tại, mà ở dưới không có dòng để focus thì nó focus dòng ỏ kế trên
                        if (rowIndx > 0) {
                            if (rowIndx < numrow - 1) {
                                $grid.pqGrid("setSelection", {
                                    rowIndx: rowIndx,
                                    colIndx: ui.colIndx
                                });
                            } else {
                                $grid.pqGrid("setSelection", {
                                    rowIndx: rowIndx - 1,
                                    colIndx: ui.colIndx
                                });
                            }

                        }
                    }


                }
                // insert key
                if (event.keyCode == 45) { // insert key event
                    if (task != "edit"){
                        event.stopPropagation();
                        event.preventDefault();
                        $("#gridW25F2081").pqGrid("saveEditCell");//Có ý nghĩa là phải lưu cell hiện tại trước đã rồi mới thêm dòng mới
                        $("#gridW25F2081").pqGrid("quitEditMode");
                        defaultValueOnGrid();
                        //event.stopPropagation();
                        //event.preventDefault();
                    }

                }
            },
            cellClick: function (event, ui) {
                $("#gridW25F2081").pqGrid("saveEditCell");//Có ý nghĩa là phải lưu cell hiện tại trước đã rồi mới thêm dòng mới
                $("#gridW25F2081").pqGrid("quitEditMode");
            },
            cellSave: function (event, ui) {
                console.log("cellSave");
                var rowData = ui.rowData;
                switch (ui.dataIndx){
                    case "ExpSalary":
                        ui.rowData[ui.dataIndx] = formatNumber(ui.rowData[ui.dataIndx], '{{Session::get("W91P0000")['D90_ConvertedDecimals']}}')
                        break;
                    case "DepartmentName":
                    case "TeamName":
                    case "PositionName":
                    case "WorkName":
                        /*var rowList = $.grep(fixData, function(data, i){
                            return data["DepartmentID"] == $("#cboDepartmentIDW25F2081").val() && data["TeamID"] == rowData["TeamID"] && data["WorkID"] == rowData["WorkID"] && data["DutyID"] == rowData["PositionID"] ;
                        });
                        if (rowList.length > 0){
                            rowData["NormQuan"] = rowList[0]["NormQuan"];
                            rowData["PresentQuan"] = rowList[0]["PresentQuan"];

                        }else{
                            rowData["NormQuan"] = null;
                            rowData["PresentQuan"] = null;
                        }
                        $grid.pqGrid("refreshDataAndView");*/
                        resetDefaultValue(rowData);
                        break;
                    default:
                        break;
                }
            },
            cellBeforeSave: function (event, ui) {
                var $editor = obj.$editor;
                var rowData = ui.rowData,
                    dataIndx = ui.dataIndx,
                    newVal = ui.newVal,
                    oldVal = ui.oldVal,
                    rowIndx = ui.rowIndx,
                    gbDataIndx = ui.dataIndx;

                /*var rowData = ui.rowData;
                $grid = $("#gridW25F2081");
                switch (dataIndx){
                    case "TeamName":
                        if (newVal == ""){
                            rowData["TeamID"] = '';
                            rowData["TeamName"] = '';
                            $grid.pqGrid("refreshCell", {rowIndx: ui.rowIndx, dataIndx: "TeamID"});
                            $grid.pqGrid("refreshCell", {rowIndx: ui.rowIndx, dataIndx: "TeamName"});
                        }

                        break;
                    case "PositionName":
                        if (newVal == ""){
                            rowData["PositionID"] = '';
                            rowData["PositionName"] = '';
                            $grid.pqGrid("refreshCell", {rowIndx: ui.rowIndx, dataIndx: "PositionID"});
                            $grid.pqGrid("refreshCell", {rowIndx: ui.rowIndx, dataIndx: "PositionName"});
                        }

                        break;
                    case "WorkName":
                        if (newVal == ""){
                            rowData["WorkID"] = '';
                            rowData["WorkName"] = '';
                            $grid.pqGrid("refreshCell", {rowIndx: ui.rowIndx, dataIndx: "WorkID"});
                            $grid.pqGrid("refreshCell", {rowIndx: ui.rowIndx, dataIndx: "WorkName"});
                        }

                        break;
                }*/

            },
        };

        objW25F2081.pageModel = {type: 'local', rPP: 20, rPPOptions: [20, 30, 40, 50]};
        $("#gridW25F2081").pqGrid(objW25F2081);
        //$("#gridW25F2081").pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
        //$("#gridW25F2081").find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
        enableAllControls(true);

        setTimeout(function(){
            $("#gridW25F2081").pqGrid("refreshDataAndView");
        }, 500);
    });

    $('#btnSaveW25F2081').click(function () {
        $('#btnSaveW25F2081').prop('disabled', true);
        ask_save(function(){saveData()}, '', '', function () {
            //alert("da vao");
            $('#btnSaveW25F2081').prop('disabled', false);
        });
    });

    function saveData(){
        var txtYearW25F2081 = $("#txtYearW25F2081");
        var cboDepartmentIDW25F2081  = $("#cboDepartmentIDW25F2081");

        txtYearW25F2081.get(0).setCustomValidity("");
        cboDepartmentIDW25F2081.get(0).setCustomValidity("");

        if (txtYearW25F2081.val() == "") {
            $('#btnSaveW25F2081').prop('disabled', false);
            txtYearW25F2081.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Nam')}}");
            $("#frmW25F2081").find('#hdBtnSaveW25F2081').click();
            txtYearW25F2081.focus();
            return false;
        }

        console.log(txtYearW25F2081.val().replace(/_/g, '').length < 4);
        if (txtYearW25F2081.val().replace(/_/g, '').length < 4) {
            $('#btnSaveW25F2081').prop('disabled', false);
            txtYearW25F2081.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap_it_nhat_bon_ki_tu')}}");
            $("#frmW25F2081").find('#hdBtnSaveW25F2081').click();
            txtYearW25F2081.focus();
            return false;
        }

        if (cboDepartmentIDW25F2081.val() == "") {
            $('#btnSaveW25F2081').prop('disabled', false);
            cboDepartmentIDW25F2081.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap').' '.Helpers::getRS($g,'Phong_ban')}}");
            $("#frmW25F2081").find('#hdBtnSaveW25F2081').click();
            cboDepartmentIDW25F2081.focus();
            return false;
        }

        var askMessage = "{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}";
        $grid = $("#gridW25F2081");
        $grid.pqGrid("saveEditCell");
        $grid.pqGrid("quitEditMode");
        var obj = $grid.pqGrid("option", "dataModel.data");
        var colModel = $grid.pqGrid("option", "colModel" );

        if (obj.length == 0){
            alert_warning("{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu_tren_luoi")}}",function(){
                defaultValueOnGrid();
            })

            return;
        }
        console.log("dfsdfs");
        for (var i=0;i<obj.length;i++){
            for (var j=0;j<colModel.length;j++){
                if (colModel[j].required && isNullOrEmpty(obj[i][colModel[j].dataIndx])){
                    $grid.pqGrid("setSelection", {
                        rowIndx: i,
                        colIndx: j
                    });
                    $grid.pqGrid( "editCell", { rowIndx: i, dataIndx: colModel[j].dataIndx } );
                    var cell = $grid.pqGrid( "getEditCell" );
                    var $editor = cell.$editor;
                    $($editor).confirmation({
                        btnOkLabel: '',
                        btnCancelLabel: '',
                        popout: true,
                        placement: "bottom",
                        singleton: true,
                        template:
                        '<div class="popover" style="display: inline-flex;"><div class="arrow"></div>'
                        + '<div class="popover-content" style="text-align: center;padding:10px;"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i><label class="confirmContent pull-left">'
                        + askMessage
                        + '</label></span></div>'
                        + '</div>'
                    });
                    $($editor).confirmation('show');
                    //e.stopPropagation();
                    //e.preventDefault();
                    $('#btnSaveW25F2081').prop('disabled', false);
                    return;
                }
            }
        }

        console.log(obj);
        var task = "";
        @if ($task == "edit")
            task = "update";
        @else
            task = "save";
        @endif
        //alert('{{url("/W25F2081/$pForm/$g/")}}' + "/" + task);
        $.ajax({
            method: "POST",
            url: '{{url("/W25F2081/$pForm/$g/")}}' + "/" + task,
            data: {year: $("#txtYearW25F2081").val(), departmentID: $("#cboDepartmentIDW25F2081").val(), data: obj, transID: '{{isset($transID) ? $transID: ""}}' },
            success: function (data) {
                var rs = JSON.parse(data);
                console.log(rs);
                switch (rs.status){
                    case "BACKGROUND": //Gửi mail ngầm
                        //$("#mPopUp").find(".modal-body").html("<div class='col-md-12'><h4>  <i class='fa fa-chevron-circle-down' ></i> {{Helpers::getRS($g,"Du_lieu_da_luu_thanh_cong")}}</h4><div class='col-md-12 alert-success-approve'>{{Helpers::getRS($g,'Mail_da_duoc_gui_toi')}} &nbsp;<b>" + rs.name+ "</b></div>");
                        //$("#mPopUp").modal('show');
                        save_ok(function(){
                            alert_info("{{Helpers::getRS($g,'Email_da_duoc_gui_toi')}}" + ": <b><i>" + rs.name + "</i></b>");
                            callbackAfterSave(rs.data.TransID);
                        });
                        break;
                    case "SHOWMAIL": //Hiển thị màn hình sendmail
                        save_ok(function(){
                            showEmailPopup(rs.rsvalue,rs.data);
                            callbackAfterSave(rs.data.TransID);
                        });
                        break;
                    case "NOSEND": //Không có gửi mail
                        save_ok(function(){
                            callbackAfterSave(rs.data.TransID);
                        });
                        break;
                    case "ERROR": //Lỗi khi run SQL
                        //save_not_ok();
                        alert_error(rs.message);
                        break;
                }
            }
        });
    }

    function callbackAfterSave(transID){
        //alert(transID);
        $grid = $("#gridW25F2080");
        enableAllControls(false);

        $.ajax({
            method: "POST",
            url: '{{url("/W25F2080/view/$pForm/$g/filter")}}',
            data: $("#frmW25F2080").serialize() + "&transID=" +transID ,
            success: function (data) {
                console.log(data)
                var task="{{$task}}";
                if (data!= null && data.length > 0){
                    if (task == "add")
                        update4ParamGrid($grid, data[0], 'add');
                    if (task == "edit")
                        update4ParamGrid($grid, data[0], 'edit');
                }

            }
        });
        $.ajax({
            method: "POST",
            url: '{{url("/W25F2081/$pForm/$g/deletetemp")}}',
            success: function (data) {
                console.log(data);
            }
        });
    }



    $('#txtYearW25F2081').inputmask("9999");

    $("#btnNextW25F2081").click(function(){
        clearForm();
        enableAllControls(true);
        $("#cboDepartmentIDW25F2081").val("{{$cboDepartmentIDW25F2081}}").trigger("change");

    });
    $("#btnNotSaveW25F2081").click(function(){
        ask_not_save(function(){
            clearForm();
            resetFormValues();
        });
    });

    function clearForm(){
        $('#frmW25F2081')[0].reset();
        $grid = $("#gridW25F2081");
        $("#txtYearW25F2081").val("");
        $("#cboDepartmentIDW25F2081").val("");
        $grid.pqGrid( "option", "dataModel.data", []);
        $grid.pqGrid( "refreshDataAndView");
        $("#txtYearW25F2081").focus();
    }

    function resetFormValues(){
        $("#txtYearW25F2081").val("{{$txtYearW25F2081}}");
        $("#cboDepartmentIDW25F2081").val("{{$cboDepartmentIDW25F2081}}");
        $grid.pqGrid( "option", "dataModel.data", {{json_encode($rsData)}});
        $grid.pqGrid( "refreshDataAndView");
    }

    function resetDefaultValue(rowData){
        $grid = $("#gridW25F2081");
        var rowList = $.grep(fixData, function(data, i){
            return data["DepartmentID"] == $("#cboDepartmentIDW25F2081").val() && data["TeamID"] == rowData["TeamID"] && data["WorkID"] == rowData["WorkID"] && data["DutyID"] == rowData["PositionID"] ;
        });
        if (rowList.length > 0){
            rowData["NormQuan"] = rowList[0]["NormQuan"];
            rowData["PresentQuan"] = rowList[0]["PresentQuan"];

        }else{
            rowData["NormQuan"] = null;
            rowData["PresentQuan"] = null;
        }
        $grid.pqGrid("refreshDataAndView");
    }
    function defaultValueOnGrid(){
        $grid = $("#gridW25F2081");
        $grid.pqGrid("saveEditCell");
        $grid.pqGrid("quitEditMode");
        var rowList = $.grep(fixData, function(data, i){
            return data["DepartmentID"] == $("#cboDepartmentIDW25F2081").val() && data["TeamID"] == "" && data["DutyID"] == "" && data["WorkID"] == "" ;
        });
        if (rowList.length > 0){
            var NormQuan = rowList[0]["NormQuan"];
            var PresentQuan = rowList[0]["PresentQuan"];

        }else{
            var NormQuan = null;
            var PresentQuan = null;
        }
        var idx = $grid.pqGrid("addRow",
            {rowData: {
                /*DateFrom: null,
                DateTo: null,
                Description: "",
                ExpSalary: 0,
                NormQuan: NormQuan,
                Note: "",
                Number: 0,
                PositionID: "",
                PositionName: "",
                PresentQuan: PresentQuan,
                TeamID: "",
                TeamName: "",
                WorkID: "",
                WorkName: ""*/
            }}
        );
        var rowData = $grid.pqGrid( "getRowData", {rowIndx: idx} );
        rowData["NormQuan"] = NormQuan;
        rowData["PresentQuan"] = PresentQuan;
        $grid.pqGrid("refreshDataAndView");
        $grid.pqGrid("setSelection", {rowIndx: idx, colIndx: 1});
    }

    function enableControls(action){
        //Enable Next control
        var perW25F2082= {{$perW25F2082}};
        if (task == "add"){
            $("#btnSaveW25F2081").prop("disabled", action == false );
            $("#btnNotSaveW25F2081").prop("disabled", action == false);
            $("#btnNextW25F2081").prop("disabled",action == true);
        }

        $("#btnSaveW25F2081").prop("disabled",  !($("#btnSaveW25F2081").is(":enabled") && perW25F2082 >=2));
        $("#btnNotSaveW25F2081").prop("disabled", !($("#btnNotSaveW25F2081").is(":enabled") && perW25F2082 >=2));
        $("#btnNextW25F2081").prop("disabled",!($("#btnNextW25F2081").is(":enabled") && perW25F2082 >=2));
    }

    function enableAllControls(blnAction){
        var perW25F2082= {{$perW25F2082}};
        switch ('{{$task}}'){
            case "view":
                $("#btnSaveW25F2081").prop("disabled", true);
                $("#btnNotSaveW25F2081").prop("disabled", true);
                $("#btnNextW25F2081").prop("disabled",true);

                $("#txtYearW25F2081").prop("disabled",true);
                $("#cboDepartmentIDW25F2081").prop("disabled",true);
                $grid = $("#gridW25F2081");
                $grid.pqGrid( "option", "editable", false );
                //alert("$task");
                break;
            case "add":
                //Theo action trước
                $("#btnSaveW25F2081").prop("disabled", !blnAction);
                $("#btnNotSaveW25F2081").prop("disabled", !blnAction);
                $("#btnNextW25F2081").prop("disabled",blnAction);
                @if ($perW25F2080 <=2)
                $("#cboDepartmentIDW25F2081").prop("disabled",true);
            @endif
                //Theo phan quyền
                //$("#btnSaveW25F2081").prop("disabled",  !($("#btnSaveW25F2081").is(":enabled") && perW25F2082 >=2));
                //$("#btnNotSaveW25F2081").prop("disabled", !($("#btnNotSaveW25F2081").is(":enabled") && perW25F2082 >=2));
                //$("#btnNextW25F2081").prop("disabled",!($("#btnNextW25F2081").is(":enabled") && perW25F2082 >=2));
                break;
            case "edit":
                $("#txtYearW25F2081").prop("disabled",true);
                $("#cboDepartmentIDW25F2081").prop("disabled",true);

                //$("#btnSaveW25F2081").prop("disabled",  !(perW25F2082 >=2));
                //$("#btnNotSaveW25F2081").prop("disabled", !(perW25F2082 >=2));
                break;
        }
    }

</script>