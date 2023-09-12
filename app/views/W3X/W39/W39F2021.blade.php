<div class="modal fade" id="modalW39F2021" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 90%">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($modalTitle,"W39F2021",true,"")}}
            </div>

            <?php
                if ($task == "add"){
                    $Decription = '';
                    $AppCriterionSetID = '';
                    $ApprovalFlowID = '';
                    $ValidDateFrom = Helpers::beginDateOfPeriod();
                    $ValidDateTo = Helpers::endDateOfPeriod();
                    $VoucherDate = date('d/m/Y');
                    $EmployeeID = Helpers::getW91P0000('CreatorHR');
                    $EmployeeName = Helpers::getW91P0000('CreatorNameHR');
                    $DepartmentName = Helpers::getW91P0000('DepartmentName');
                    $TotalResult = number_format(0,2);
                    \Debugbar::info(Helpers::getDaysInCurrentMonth());
                }else{
                    if (count($rsData) > 0){
                        $Decription = $rsData[0]["Decription"];
                        $AppCriterionSetID = $rsData[0]["AppCriterionSetID"];
                        $ApprovalFlowID = $rsData[0]["ApprovalFlowID"];
                        $ValidDateFrom = $rsData[0]["ValidDateFrom"];
                        $ValidDateTo = $rsData[0]["ValidDateTo"];
                        $VoucherDate = $rsData[0]["VoucherDate"];
                        $EmployeeID = $rsData[0]["EmployeeID"];
                        $EmployeeName = $rsData[0]["EmployeeName"];
                        $DepartmentName = $rsData[0]["DepartmentName"];
                        $TotalResult = number_format($rsData[0]["TotalResult"],2);
                    }else{
                        $Decription = '';
                        $AppCriterionSetID = '';
                        $ApprovalFlowID = '';
                        $ValidDateFrom = '';
                        $ValidDateTo = '';
                        $VoucherDate = '';
                        $EmployeeID = '';
                        $EmployeeName = '';
                        $DepartmentName = '';
                        $TotalResult = '';
                    }

                }


            ?>

            <div class="modal-body" style="padding:10px">

                <form id="frmW39F2021"  class="form-group">
                    <div class="row">
                        <div class="col-md-2 ">
                            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ten_bo_chi_tieu_danh_gia")}}</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control noUseValidHTML5"
                                   id="txtDecriptionW39F2021"
                                   value="{{$Decription}}"
                                   name="txtDecriptionW39F2021" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 ">
                            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Bo_chi_tieu_chung")}}</label>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control select2 noUseValidHTML5"
                                    id="cboAppCriterionSetIDW39F2021"
                                    name="cboAppCriterionSetIDW39F2021"
                                    value="" required>
                                <option value=""></option>
                                @foreach($appCriterionSetList as $rowCriterion)
                                    <option value="{{$rowCriterion['AppCriterionSetID']}}" {{$AppCriterionSetID == $rowCriterion['AppCriterionSetID'] ? 'selected' : ''}}>{{$rowCriterion['AppCriterionSetName']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 ">
                            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Hieu_luc")}}</label>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group date">
                                <input type="text" class="form-control noUseValidHTML5"
                                       id="txtValidDateFromW39F2021"
                                       name="txtValidDateFromW39F2021"
                                       value="{{$ValidDateFrom}}" required>
                                <span class="input-group-addon">
                                    <i id="iconDateFrom"
                                       onclick="$('#txtValidDateFromW39F2021').datepicker('show');"
                                       class="glyphicon glyphicon-calendar">
                                    </i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group date">
                                <input type="text" class="form-control noUseValidHTML5"
                                       id="txtValidDateToW39F2021"
                                       name="txtValidDateToW39F2021"
                                       value="{{$ValidDateTo}}" required>
                                <span class="input-group-addon">
                                    <i id="iconDateFrom"
                                       onclick="$('#txtValidDateToW39F2021').datepicker('show');"
                                       class="glyphicon glyphicon-calendar">
                                    </i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 ">
                            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Quy_trinh_duyet")}}</label>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control select2 noUseValidHTML5"
                                    id="cboApprovalFlowIDW39F2021"
                                    name="cboApprovalFlowIDW39F2021"
                                    value="" required>
                                @foreach($approvalFlowList as $rowFlow)
                                    <option value="{{$rowFlow['ApprovalFlowID']}}" {{$ApprovalFlowID == $rowFlow['ApprovalFlowID'] ? 'selected' : '' }}>{{$rowFlow['ApprovalFlowName']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 ">
                            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ngay_dang_ky")}}</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control"
                                   id="txtVoucherDateW39F2021"
                                   name="txtVoucherDateW39F2021"
                                   value="{{$VoucherDate}}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 ">
                            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ma_NV")}}</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control"
                                   id="txtEmployeeIDW39F2021"
                                   value="{{$EmployeeID}}"
                                   name="txtEmployeeIDW39F2021" readonly>
                        </div>
                        <div class="col-md-2 ">
                            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Phong_ban")}}</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control"
                                   id="txtDepartmentNameW39F2021"
                                   value="{{$DepartmentName}}"
                                   name="txtDepartmentNameW39F2021" readonly>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-2 ">
                            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ten_NV")}}</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control"
                                   id="txtEmployeeNameW39F2021"
                                   value="{{$EmployeeName}}"
                                   name="txtEmployeeNameW39F2021" readonly>
                        </div>
                        <div class="col-md-2 ">
                            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Tong_ket_dat")." (%)"}}</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control"
                                   id="txtTotalResultW39F2021"
                                   value="{{$TotalResult}}"
                                   name="txtTotalResultW39F2021" readonly>
                        </div>
                    </div>
                    <input type="submit" class="hide" id="hdBtnSaveW39F2021">
                </form>
                <div class="row form-group">
                    <div class="col-md-12">
                        <div id="gridW39F2021"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-right">
                            <button type="button" id="btnSaveW39F2021" name="btnSaveW09F2001"
                                    class="btn btn-default smallbtn"><span
                                        class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                            </button>
                            <button type="button" id="btnNotSaveW39F2021" name="btnNotSaveW09F2001"
                                    class="btn btn-default smallbtn"><span
                                        class="fa fa-ban text-red mgr5"></span> {{Helpers::getRS($g,"Khong_luu")}}
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</section>
<script type="text/javascript">
    var task = '{{$task}}';
    var isGroupIDChange = 0; //biến phân biệt groupID có thay đổi giá trị hay ko //0 ko thay đổi //1 thay đổi
    var isConfirmChange = 0; //biến phân biệt confirm có thay đổi giá trị hay ko //0 ko thay đổi //1 thay đổi
    var tGroupID = ""; //biến tạm  GroupID.
    $(document).ready(function () {
        $('.modal-dialog').draggable();
        setTimeout(function () {
            //resizePqGrid();
            var data = $("#gridW39F2021").pqGrid("option", "dataModel.data");
            var temp = reformatData(data,$("#gridW39F2021"));
            $("#gridW39F2021").pqGrid("option", "dataModel.data", temp);
            $("#gridW39F2021").pqGrid("refreshDataAndView");
        }, 500);
        enableControls(task);
    });
    $('#txtValidDateFromW39F2021').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: "dd/mm/yyyy",
        language: '{{Session::get("locate")}}'
    });
    $('#txtValidDateToW39F2021').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: "dd/mm/yyyy",
        language: '{{Session::get("locate")}}'
    });

    function checkIsParent(AppCriterionGroupID){//kiểm tra có phải là cấp cha hay ko
        var $grid = $("#gridW39F2021");
        var dataGrid = $grid.pqGrid("option", "dataModel.data");
        if(AppCriterionGroupID != ""){
            var dataFilter = $.grep(dataGrid, function (row) {
                return row.ParentID == AppCriterionGroupID;
            });
            console.log(dataFilter.length);
            if(dataFilter.length > 0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

    var obj = {
        width: '100%',
        //height: $(document).height() - 350,
        height: $(document).height() - 320,
        freezeCols: 4,
        selectionModel: {type: 'cell', mode: 'single'},
        minWidth: 30,
        //pageModel: {type: "local", rPP: 20},
        //filterModel: {on: true, mode: "AND", header: true},
        scrollModel: {horizontal: true, pace: 'fast', autoFit: false, lastColumn: 'none'},
        showTitle: false,
        dataType: "JSON",
        wrap: false,
        hwrap: false,
        collapsible: false,
        postRenderInterval: -1,
        editable: true,
        rowClick: function (event, ui) {
            console.log(ui.rowData);
            var rowData = ui.rowData;
            tGroupID = rowData['AppCriterionGroupID'];// cập nhật lại tGroupID khi click dòng cho việc thay đổi giá trị các dòng con
        },
        complete: function (event, ui) {
        
        },
        cellBeforeSave: function( event, ui ) {
            var $grid = $("#gridW39F2021");
            var newVal = ui.newVal;
            var rowData = ui.rowData,
                dataIndx = ui.dataIndx,
                rowIndx = ui.rowIndx;

            var colIndxConfirm = $grid.pqGrid( "getColIndx", { dataIndx: "Confim" } );
            var columnRate = $grid.pqGrid( "getColumn",{ dataIndx: "Rate" } );
            var columnConfirm = $grid.pqGrid( "getColumn",{ dataIndx: "Confim" } );
            var msgGroupID = "Đã tồn tại cấp con, bạn phải nhập dữ liệu";
            var msgConfirm = columnConfirm.title + " {{Helpers::getRS($g, 'phai_nho_hon_hoac_bang')}} " + "100";
            //alert(rowIndx);
            //console.log(tGroupID);
            var dataGrid = $grid.pqGrid("option", "dataModel.data");
           // console.log(dataGrid);

            if(dataIndx == "GroupID"){//đánh dấu groupID có thay đổi giá trị hay ko
               // console.log(newVal);
                //console.log(rowData['AppCriterionGroupID']);
                //kiểm tra nhập trùng GroupID
                if(newVal != rowData['AppCriterionGroupID']){
                    if(newVal != ""){// tránh trường hợp dò trúng các dòng có groupID trống
                        var fillterGroupID = $.grep(dataGrid, function(row){// lọc ra dòng con
                            return row.AppCriterionGroupID == newVal;
                        });
                        //console.log(fillterGroupID);
                        if(fillterGroupID.length > 0){
                            $grid.pqGrid("quitEditMode");
                            $grid.pqGrid("editCell", {rowIndx: rowIndx, dataIndx: dataIndx});
                            var obj = $grid.pqGrid("getEditCell");
                            var $editor = obj.$editor;
                            $($editor).val(newVal);
                            $($editor).confirmation({
                                btnOkLabel: '',
                                btnCancelLabel: '',
                                popout: true,
                                placement: "bottom",
                                singleton: true,
                                template:
                                '<div class="popover" style="display: inline-flex;"><div class="arrow"></div>'
                                + '<div class="popover-content" style="text-align: center;padding:10px;"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i><label class="confirmContent pull-left">'
                                + "Tên nhóm đã tồn tại"
                                + '</label></span></div>'
                                + '</div>'
                            });
                            $($editor).confirmation('show');
                            return false;
                        }
                    }
                }

                if(newVal == ""){
                    var AppGroupID = rowData['GroupID'] == "" ? rowData['GroupID']:tGroupID;// để tránh đụng tới cấp cha có tGroup = ''
                    console.log(AppGroupID);
                    if(checkIsParent(AppGroupID)){
                        $grid.pqGrid("quitEditMode");
                        $grid.pqGrid("editCell", {rowIndx: rowIndx, dataIndx: dataIndx});
                        var obj = $grid.pqGrid("getEditCell");
                        var $editor = obj.$editor;
                        $($editor).val(newVal);
                        $($editor).confirmation({
                            btnOkLabel: '',
                            btnCancelLabel: '',
                            popout: true,
                            placement: "bottom",
                            singleton: true,
                            template:
                            '<div class="popover" style="display: inline-flex;"><div class="arrow"></div>'
                            + '<div class="popover-content" style="text-align: center;padding:10px;"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i><label class="confirmContent pull-left">'
                            + msgGroupID
                            + '</label></span></div>'
                            + '</div>'
                        });
                        $($editor).confirmation('show');
                        return false;
                    }
                }

                if(newVal != rowData['GroupID']){//có thay đổi
                    isGroupIDChange = 1;
                    if(rowData['GroupID'] != ""){
                        var arrGroupID = $.grep(dataGrid, function(row){// lọc ra dòng con
                            return row.ParentID == tGroupID;
                        });
                        console.log(arrGroupID);
                        for(var i = 0; i < arrGroupID.length; i++){// gán lại parentID cho các dòng con
                            arrGroupID[i]['ParentID'] = newVal;
                        }
                        $grid.pqGrid("refreshDataAndView");
                    }
                }else{//không thay đổi
                    isGroupIDChange = 0;
                }
               // alert(isGroupIDChange);
            }
            //console.log("test");
            if (!isNullOrEmpty(rowData.Rate) && !isNullOrEmpty(rowData.Confim) && ui.dataIndx == "Confim") {
                if (Number(newVal) < 0){
                    $grid.pqGrid("quitEditMode");
                    $grid.pqGrid("editCell", {rowIndx: rowIndx, dataIndx: dataIndx});
                    var obj = $grid.pqGrid("getEditCell");
                    var $editor = obj.$editor;
                    $($editor).val(newVal);
                    $($editor).confirmation({
                        btnOkLabel: '',
                        btnCancelLabel: '',
                        popout: true,
                        placement: "bottom",
                        singleton: true,
                        template:
                        '<div class="popover" style="display: inline-flex;"><div class="arrow"></div>'
                        + '<div class="popover-content" style="text-align: center;padding:10px;"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i><label class="confirmContent pull-left">'
                        + "{{Helpers::getRS($g,"Xac_nhan")}}" + " " + "{{Helpers::getRS($g,"phai_lon_hon")}}" + " " + "0"
                        + '</label></span></div>'
                        + '</div>'
                    });
                    $($editor).confirmation('show');
                    //event.stopPropagation();
                    //event.preventDefault();
                    return false;
                }

                if (100 < Number(newVal)){
                    $grid.pqGrid("quitEditMode");
                    $grid.pqGrid("editCell", {rowIndx: rowIndx, dataIndx: dataIndx});
                    var obj = $grid.pqGrid("getEditCell");
                    var $editor = obj.$editor;
                    $($editor).val(newVal);
                    $($editor).confirmation({
                        btnOkLabel: '',
                        btnCancelLabel: '',
                        popout: true,
                        placement: "bottom",
                        singleton: true,
                        template:
                        '<div class="popover" style="display: inline-flex;"><div class="arrow"></div>'
                        + '<div class="popover-content" style="text-align: center;padding:10px;"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i><label class="confirmContent pull-left">'
                        + msgConfirm
                        + '</label></span></div>'
                        + '</div>'
                    });
                    $($editor).confirmation('show');
                    //event.stopPropagation();
                    //event.preventDefault();
                    return false;
                }

            }
            if(dataIndx == "Confim"){
                if(newVal != rowData['Confim']){//có thay đổi
                    isConfirmChange = 1;
                }else{//không thay đổi
                    isConfirmChange = 0;
                }
            }
        },
        editorFocus: function( event, ui ) {
           /* var rowData = ui.rowData;
            if(ui.dataIndx == "GroupID"){
                rowData['GroupID'] = tGroupID;
            }*/
        },
        cellSave: function (event, ui) {
            console.log("save");
            var $grid = $("#gridW39F2021");
            var space = "&nbsp&nbsp&nbsp&nbsp&nbsp";
            var rowData = ui.rowData,
                dataIndx = ui.dataIndx,
                rowIndx = ui.rowIndx;
            var column = $("#gridW39F2021").pqGrid("getColumn", {dataIndx: ui.dataIndx});
            if (column.dataType == "float" || column.dataType == "integer") {
                ui.rowData[ui.dataIndx] = formatNumber(ui.rowData[ui.dataIndx], getDecimal(column.format));
            }

            //ui.rowData["IsUpdate"] == 1;
            if(ui.dataIndx == "GroupID"){

                console.log(rowData['GroupID']);
                if(rowData['GroupID'] != ""){
                    if(isGroupIDChange == 1){//gía trị GroupID có thay đổi.
                        rowData['AppCriterionGroupID'] = rowData['GroupID'];
                        tGroupID = rowData['GroupID'];//gán giá trị cho tGroupID để sử dụng cho cellBeforeSave
                        var i = 0;
                        while(i < Number(rowData['Level'] - 1)){//cộng thêm Space dựa trên level //sô vòng lặp = Level -1;
                            rowData['GroupID'] = space + rowData['GroupID'];
                            i++;
                        }
                    }
                }
            }
           /* if(rowData.Result == null){
                rowData.Result = 0;
            }*/
           if (task == 'verify'){
               var data =  $("#gridW39F2021").pqGrid('option', 'dataModel.data');
               //console.log(isConfirmChange);
               if(isConfirmChange == 1){
                    updateParentData(ui.rowData, data);
               }
           }

            //End format
            //$("#gridW39F2021").pqGrid("refreshDataAndView");
        },
        cellKeyDown: function( event, ui ) {
            var rowData = ui.rowData;
            var rowIndx = ui.rowIndx;
            var dataIndx = ui.dataIndx;
            var $grid = $("#gridW39F2021");
            var msgGroupID = "Đã tồn tại cấp con, bạn phải nhập dữ liệu";
            if(event.keyCode == "46"){//ấn phím delete
                //alert("hello");
                if(checkIsParent(rowData['AppCriterionGroupID'])){
                    $grid.pqGrid("quitEditMode");
                    $grid.pqGrid("editCell", {rowIndx: rowIndx, dataIndx: dataIndx});
                    var obj = $grid.pqGrid("getEditCell");
                    var $editor = obj.$editor;
                    $($editor).confirmation({
                        btnOkLabel: '',
                        btnCancelLabel: '',
                        popout: true,
                        placement: "bottom",
                        singleton: true,
                        template:
                        '<div class="popover" style="display: inline-flex;"><div class="arrow"></div>'
                        + '<div class="popover-content" style="text-align: center;padding:10px;"><span class="notify-grid"><i class="fa fa-exclamation-triangle text-orange pdr5" style="float:left"></i><label class="confirmContent pull-left">'
                        + msgGroupID
                        + '</label></span></div>'
                        + '</div>'
                    });
                    $($editor).confirmation('show');
                    return false;
                }else{
                    rowData['AppCriterionGroupID'] = rowData['GroupID'];
                }
            }
        }
    };
    obj.colModel = [
        {
            title: "",
            minWidth: 50,
            align: "center",
            dataIndx: "View",
            isExport: false,
            editor: false,
            editable: false,
            sortable: false,
            render: function (ui) {
                var str = "";
                var rowData = ui.rowData;
                var perW39F2021 = Number("{{$perW39F2021}}");
                if (rowData["IsAddNew"] == 1) {
                    str += "<a title='{{Helpers::getRS($g,"Them_moi1")}}'  class='btnAddNewW39F2021'><i class='glyphicon glyphicon-plus text-blue' style='color:orange'></i></a>";
                } else {

                }
                if (str != "" && rowData["IsEdit"] == 1){
                    str += "<span class='mgl5'></span>";
                }
                if (rowData["IsEdit"] == 1 && (task == "add" || task == 'edit') ) {
                    str += "<a title='{{Helpers::getRS($g,"Them_moi1")}}'  class='btnAddNewW39F2021 mgr5'><i class='glyphicon glyphicon-plus text-blue' style='color:orange'></i></a>";
                    str += "<a title='{{Helpers::getRS($g,"Xoa")}}' class='btnDeleteW39F2000'><i class='fa fa-trash text-black' ></i></a>";
                } else {

                }
                return {
                    text: str,
                    cls: this.isEditableCell(ui) == false ? "readonly-status" : ""
                };
            },
            postRender: function (ui) {
                var rowIndx = ui.rowIndx,
                    grid = this,
                    $cell = grid.getCell(ui);
                var row = ui.rowData;
                $cell.find(".btnAddNewW39F2021").bind("click", function (evt) {
                    addNewRow(rowIndx);
                });
                $cell.find(".btnDeleteW39F2000").bind("click", function (evt) {
                    var $grid = $("#gridW39F2021");
                    var dataGrid = $grid.pqGrid("option", "dataModel.data");
                    deleteRow(rowIndx, dataGrid, row['AppCriterionGroupID']);
                });
            },
            hidden: task == "verify" || task == "view" ? true:false
        },


        {
            title: "IsAddNew",
            dataType: "integer",
            dataIndx: "IsAddNew",
            hidden: true
        },
        {
            title: "AppCriterionGroupID",
            dataType: "string",
            dataIndx: "AppCriterionGroupID",
            hidden: true
        },
        {
            title: "IsEdit",
            dataType: "integer",
            dataIndx: "IsEdit",
            hidden: true
        },
        {
            title: "{{Helpers::getRS($g,'Nhom')}}",
            dataType: "string",
            dataIndx: "GroupID",
            width: 200,
            align: "left",
            editor: {select: true},
            editModel: {keyUpDown: true},
            sortable: false,
            //format: "#,###.00",
            editable: function (ui) {
                var rowData = ui.rowData;
                return Number(rowData['isChild']) == 1? true: false;
            },
            render: function (ui) {
                var rowData = ui.rowData;
                return {
                    cls: this.isEditableCell(ui) == false ? "readonly-status" : "",
                    style: rowData['Style'],
                };
            },
            hidden: false,
            required: true
        },
        {
            title: "{{Helpers::getRS($g,'Cap_cha')}}",
            dataType: "string",
            dataIndx: "ParentID",
            width: 110,
            align: "left",
            editor: {select: true},
            editModel: {keyUpDown: true},
            sortable: false,
            //format: "#,###.00",
            editable: function (ui) {
                //var rowData = ui.rowData;
                return false;
            },
            render: function (ui) {
                var rowData = ui.rowData;
                return {
                    cls: this.isEditableCell(ui) == false ? "readonly-status" : "",
                    style: rowData['Style']
                };
            },
            hidden: true
            //hidden: task == "verify" || task == "view" ? true:false
        },
        {
            title: "{{Helpers::getRS($g,'Chi_tieu_danh_gia')}}",
            dataType: "string",
            dataIndx: "ElementName",
            width: 270,
            align: "left",
            editor: {select: true},
            editModel: {keyUpDown: true},
            editable: true,
            sortable: false,
            //format: "#,###.00",
            editable: function (ui) {
                var rowData = ui.rowData;
                    if (ui.rowIndx != undefined)
                    return rowData.IsEdit == 1 && rowData.IsUpdate == 1 && task != 'verify' && (task == 'add' || task == "edit")? true : false;
                else
                    return false;
            },
            render: function (ui) {
                var rowData = ui.rowData;
                var str = '';
                var cls = rowData.IsEdit == 0 && rowData.IsUpdate == 0 ? 'text-bold':'';
                var val = rowData[ui.dataIndx] != undefined ? rowData[ui.dataIndx]: '';
                str = "<span class='"+cls +"'>"+ val  +"</span>";
                return {
                    text: str,
                    cls: this.isEditableCell(ui) == false ? "readonly-status" : "gridColRequire",
                    style: rowData['Style']
                };
            },

            hidden: false,
            required: true
        },
        {
            title: "{{Helpers::getRS($g,'Dien_giai')}}",
            dataType: "string",
            dataIndx: "Content",
            width: 230,
            align: "left",
            editor: {select: true},
            editModel: {keyUpDown: true},
            editable: true,
            sortable: false,
            //format: "#,###.00",
            editable: function (ui) {
                var rowData = ui.rowData;
                if (ui.rowIndx != undefined)
                    return rowData.IsEdit == 1 && rowData.IsUpdate == 1 && task != 'verify' && task != 'view' ? true : false;
                else
                    return false;
            },
            render: function (ui) {
                var rowData = ui.rowData;
                var str = '';
                var cls = rowData.IsEdit == 0 && rowData.IsUpdate == 0 ? 'text-bold':'';
                var val = rowData[ui.dataIndx] != undefined ? rowData[ui.dataIndx]: '';
                str = "<span class='"+cls +"'>"+ val  +"</span>";
                return {
                    text: str,
                    cls: this.isEditableCell(ui) == false ? "readonly-status" : "",
                    style: rowData['Style']
                };
            },
            hidden: false
        },

        {
            title: "{{Helpers::getRS($g,'QL_phan_bo')}}",
            cb: {
                all: false,
                header: true,
                check: "1",
                uncheck: "0"
            },
            dataIndx: "IsDistribute",
            align: "center",
            width: 90,
            type: 'checkbox',
            dataType: 'integer',
            editor: false,
            sortable: false,
            editable: function (ui) {
                return false;
            },
            render: function (ui) {
                var row = ui.rowData,
                    disabled = this.isEditableCell(ui) ? "" : "disabled";

                return {
                    cls: (disabled ? "readonly-status" : "")
                };
            }
        },

        {
            title: "{{Helpers::getRS($g,'Trong_so')." (%)"}}",
            dataType: "float",
            dataIndx: "Rate",
            width: 90,
            align: "center",
            editor: {select: true},
            editModel: {keyUpDown: true},
            sortable: false,
            format: "#,###.00",
            editable: function (ui) {
                var rowData = ui.rowData;
                if (ui.rowIndx != undefined)
                    return ((rowData.IsEdit == 0 && rowData.IsUpdate == 1) || (rowData.IsEdit == 1 && rowData.IsUpdate == 1)) && (task == 'add' || task == 'edit') ? true : false;
                else
                    return false;
            },
            render: function (ui) {
                var rowData = ui.rowData;
                var str = '';
                var cls = rowData.IsEdit == 0 && rowData.IsUpdate == 0 ? 'text-bold':'';
                var val = rowData[ui.dataIndx] != undefined ? rowData[ui.dataIndx]: '';
                str = "<span class='"+cls +"'>"+ format2(val, '',2)  +"</span>";
                return {
                    text: str,
                    cls: this.isEditableCell(ui) == false ? "readonly-status" : "",
                    style: rowData['Style']
                };
            },
            hidden: false
        },

        {
            title: "{{Helpers::getRS($g,'Cap_nhat')." (%)"}}",
            dataType: "float",
            dataIndx: "Confim",
            width: 110,
            align: "center",
            editor: {select: true},
            editModel: {keyUpDown: true},
            format: "#,###.00",
            sortable: false,
            editable: function (ui) {
                var rowData = ui.rowData;
                //console.log(ui);
                if (ui.rowIndx != undefined)
                    return rowData.IsEdit == 1 && rowData.IsUpdate == 1 && task == 'verify' ? true : false;
                else
                    return false;

            },
            render: function (ui) {
                var rowData = ui.rowData;
                var str = '';
                var cls = rowData.IsEdit == 0 && rowData.IsUpdate == 0 ? 'text-bold':'';
                var val = rowData[ui.dataIndx] != undefined ? rowData[ui.dataIndx]: '';
                str = "<span class='"+cls +"'>"+ format2(val, '',2)  +"</span>";
                return {
                    text: str,
                    cls: this.isEditableCell(ui) == false ? "readonly-status" : "gridColRequire",
                    style: rowData['Style']
                };
            },
            hidden: false
        },
        {
            title: "{{Helpers::getRS($g,'Xac_nhan')." (%)"}}",
            dataType: "float",
            dataIndx: "Result",
            width: 100,
            align: "center",
            editor: {select: true},
            editModel: {keyUpDown: true},
            sortable: false,
            format: "#,###.00",
            editable: function (ui) {
                /*var rowData = ui.rowData;
                if (ui.rowIndx != undefined)
                    return rowData.IsEdit == 1 && rowData.IsUpdate == 1 && task == 'verify' ? true : false;
                else
                    return false;*/
                return false;
            },
            render: function (ui) {
                var rowData = ui.rowData;
                var str = '';
                var cls = rowData.IsEdit == 0 && rowData.IsUpdate == 0 ? 'text-bold':'';
                var val = rowData[ui.dataIndx] != undefined ? rowData[ui.dataIndx]: '';
                str = "<span class='"+cls +"'>"+ format2(val, '',2)  +"</span>";
                return {
                    text: str,
                    cls: this.isEditableCell(ui) == false ? "readonly-status" : "",
                    style: rowData['Style']
                };
            },
            hidden: false
        },
        {
            title: "{{Helpers::getRS($g,'Ghi_chu')}}",
            dataType: "string",
            dataIndx: "NoteCriterion",
            width: 270,
            align: "left",
            editor: {select: true},
            editModel: {keyUpDown: true},
            sortable: false,
            //format: "#,###.00",
            editable: true,
            /*editable: function (ui) {
                var rowData = ui.rowData;
                if (ui.rowIndx != undefined)
                    return rowData.IsEdit == 1 && rowData.IsUpdate == 1 && task != 'verify' && task != 'view' ? true : false;
                else
                    return false;

            },*/
            render: function (ui) {
                var rowData = ui.rowData;
                var str = '';
                var cls = rowData.IsEdit == 0 && rowData.IsUpdate == 0 ? 'text-bold':'';
                var val = rowData[ui.dataIndx] != undefined ? rowData[ui.dataIndx]: '';
                str = "<span class='"+cls +"'>"+ val  +"</span>";
                return {
                    text: str,
                    cls: this.isEditableCell(ui) == false ? "readonly-status" : "",
                    style: rowData['Style']
                };
            },
            hidden: false
        }
        @foreach($caption as $row)
        , {
            title: "{{$row['RefCaption']}}",
            minWidth: 150,
            align: "left",
            dataType: "string",
            //format: "{{Helpers::getStringFormat(0)}}",//returnSFormat(0),
            dataIndx: "{{$row['RefID']}}",
            hidden: '{{$row["Disabled"] == 1 ? true:false}}',
            /*editable: function (ui) {
                var rowData = ui.rowData;
                //console.log(rowData);
                return rowData.IsEdit == 1 && rowData.IsUpdate == 1 && task != 'verify' && task != 'view' ? true : false;

            },*/
            editable: true,
            render: function (ui) {
                var rowData = ui.rowData;
                var str = '';
                var cls = rowData.IsEdit == 0 && rowData.IsUpdate == 0 ? 'text-bold':'';
                var val = rowData[ui.dataIndx] != undefined ? rowData[ui.dataIndx]: '';
                str = "<span class='"+cls +"'>"+ val  +"</span>";
                return {
                    text: str,
                    cls: this.isEditableCell(ui) == false ? "readonly-status" : "",
                    style: rowData['Style']
                };
            }

            /*editable: function (ui) {
                var row = ui.rowData,
                return (Number(row.ischeck) == 0 && Number(row.TransferedD09) == 0) ? true : false; //Chi duoc edit khi cho duyet & tranfer//ischeck = 1 khi da duyet hoac tu choi, TransferedD09 =0 thi cho edit
            },
            render: function (ui) {
                //console.log(ui.rowData);
                var rowData = ui.rowData;
                var num = rowData[""].toString().replace(/,/g, "");
                var disabled = this.isEditableCell(ui) ? "" : "disabled";
                //console.log(num);
                return {
                    text: format2(num, '', 0),
                    cls: (disabled ? "readonly-status" : "")
                };
            }*/
        }
        @endforeach
    ];
    obj.dataModel = {
        data: {{json_encode($rsData)}},
        location: "local",
        sorting: "local",
        sortDir: "down"
    };
    var $grid = $("#gridW39F2021").pqGrid(obj);

    //$grid.pqGrid("option", $.paramquery.pqGrid.regional['{{Session::get("locate")}}']);
    //$grid.find(".pq-pager").pqPager("option", $.paramquery.pqPager.regional['{{Session::get("locate")}}']);
    $grid.pqGrid("refreshDataAndView");


    $("#cboAppCriterionSetIDW39F2021").change(function () {
        var val = $(this).val();
        $("#gridW39F2021").pqGrid('showLoading');
        postMethod("{{url("/W39F2021/".$pForm."/".$g."/loadgrid")}}", function (data) {
            $("#gridW39F2021").pqGrid('hideLoading');
            $("#gridW39F2021").pqGrid("option", "dataModel.data", data);
            $("#gridW39F2021").pqGrid("refreshDataAndView");
        }, {appCriterionSetID: val})
    });

    function enableControls(task) {
        switch (task) {
            case 'view': //test ok
                $("#frmW39F2021").find("input, select, button").prop("disabled", true);
                $("#btnSaveW39F2021").remove();
                $("#btnNotSaveW39F2021").remove();
                break;
            case 'add':
                $("#frmW39F2021").find("input, select, button").prop("disabled", false);
                break;
            case 'edit':
                //$("#frmW39F2021").find("input, select, button").prop("disabled", true);
                $("#cboAppCriterionSetIDW39F2021").prop("disabled", true);
                $("#txtDecriptionW39F2021").prop("disabled", false);
                $("#cboApprovalFlowIDW39F2021").prop("disabled", false);
                $("#txtValidDateFromW39F2021").prop("disabled", false);
                $("#txtValidDateToW39F2021").prop("disabled", false);
                break;
            case 'verify':
                $("#frmW39F2021").find("input, select, button").prop("disabled", true);
                break;
        }
        $("#gridDetailW09F2001").pqGrid("refreshDataAndView");
    }

    function addNewRow(indx) {
        console.log("add new row");
        var $grid = $("#gridW39F2021");
        var colModel = $grid.pqGrid("option", "colModel");
        var askMessage = "{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}";


        var parentRow = $grid.pqGrid("getRowData", {rowIndx: indx});
        var obj = $grid.pqGrid("option", "dataModel.data");
        console.log(parentRow['GroupID']);
        if(parentRow['GroupID'] == ""){
            //console.log("da chay");
            parentRow['isChild'] = 1; //bật ischild = 1 để thỏa điều kiện gỡ rem GroupID
            $grid.pqGrid("refreshDataAndView");
            for (var i = 0; i < obj.length; i++) {
                for (var j = 0; j < colModel.length; j++) {
                    var isEditCell = $grid.pqGrid( "isEditableCell", { rowIndx: indx, dataIndx: 'GroupID' } )
                    if (colModel[j].required && isNullOrEmpty(obj[i][colModel[j].dataIndx]) && isEditCell) {
                        $grid.pqGrid("setSelection", {
                            rowIndx: indx,
                            colIndx: j
                        });
                        $grid.pqGrid("editCell", {rowIndx: indx, dataIndx: 'GroupID'});
                        var cell = $grid.pqGrid("getEditCell");
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
                        return;
                    }
                }
            }
        }
        console.log(parentRow);


        var filter = $.grep(obj,function(row){
            return row["AppCriterionGroupID"] ==  parentRow["AppCriterionGroupID"];
        });

        var idx = $grid.pqGrid("addRow", {
            newRow: {
                IsAddNew: 0,
                isChild: 1, //1 là con; 0 ko phải con
                ElementName: '',
                Content: '',
                ParentID: Number(parentRow['isChild']) == 1 ? parentRow['AppCriterionGroupID']: parentRow['AppCriterionGroupID'],
                IsDistribute: 0,
                Rate: 0,
                Confim: 0,
                Result: 0,
                NoteCriterion: '',
                IsEdit: 1,
                IsUpdate: 1,
                Level: Number(parentRow['Level']) + 1,
                AppCriterionGroupID: ''
            }, rowIndx: indx + (filter.length),checkEditable:false
        });
        $("#gridW39F2021").pqGrid("scrollRow", {rowIndx: indx - 1});
        $("#gridW39F2021").pqGrid("refreshDataAndView");
    }

    function deleteRow(indx, dataGrid,AppCriterionGroupID) {
        ask_delete(function () {
            var $grid = $("#gridW39F2021");
            delRow(indx, dataGrid,AppCriterionGroupID);
        });

    }

    function delRow(indx, dataGrid, AppCriterionGroupID){//Hàm đệ quy xóa dòng
        console.log("delete");
        var $grid = $("#gridW39F2021");
        //$grid.pqGrid("showLoading");
        var rowData = $grid.pqGrid("getRowData", {rowIndx: indx});
        if(rowData['GroupID'] == "" || rowData['AppCriterionGroupID'] == ""){//nếu groupID trống thì xóa luôn không cần chạy tiếp
            $grid.pqGrid("deleteRow", {rowIndx: indx});
            $grid.pqGrid("refreshDataAndView");
            return;
        }
        var childGroup = $.grep(dataGrid, function (row) {//lọc ra dòng con
            return row.ParentID == AppCriterionGroupID;
        });

        if(childGroup.length > 0){
            for(var i = 0; i < childGroup.length;  i++){
                delRow(indx + 1, dataGrid, childGroup[i]['AppCriterionGroupID']);
            }
        }
        //delete row
        $grid.pqGrid("deleteRow", {rowIndx: indx});
        //$grid.pqGrid("setSelection", {rowIndx: indx - 1});
        $grid.pqGrid("refreshDataAndView");
        //$grid.pqGrid("hideLoading");
    }

    $("#btnNotSaveW39F2021").click(function(){
        ask_not_save(function(){
            $("#modalW39F2021").modal('hide');
        })
    });

    $("#btnSaveW39F2021").click(function(e){
        ask_save(function(){
            //console.log("ask_save");
            var txtDecriptionW39F2021 = $("#txtDecriptionW39F2021");
            var cboAppCriterionSetIDW39F2021 = $("#cboAppCriterionSetIDW39F2021");
            var txtValidDateFromW39F2021 = $("#txtValidDateFromW39F2021");
            var txtValidDateToW39F2021 = $("#txtValidDateToW39F2021");
            var cboApprovalFlowIDW39F2021 = $("#cboApprovalFlowIDW39F2021");


            txtDecriptionW39F2021.get(0).setCustomValidity("");
            cboAppCriterionSetIDW39F2021.get(0).setCustomValidity("");
            txtValidDateFromW39F2021.get(0).setCustomValidity("");
            txtValidDateToW39F2021.get(0).setCustomValidity("");
            cboApprovalFlowIDW39F2021.get(0).setCustomValidity("");

            if (txtDecriptionW39F2021.val() == "") {

                txtDecriptionW39F2021.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap_du_lieu')}}");
                $('#hdBtnSaveW39F2021').trigger('click');
                return false;
            }

            if (cboAppCriterionSetIDW39F2021.val() == "") {
                cboAppCriterionSetIDW39F2021.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap_du_lieu')}}");
                $('#hdBtnSaveW39F2021').trigger('click');
                return false;
            }

            if (txtValidDateFromW39F2021.val() == "") {
                txtValidDateFromW39F2021.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap_du_lieu')}}");
                $('#hdBtnSaveW39F2021').trigger('click');
                return false;
            }

            if (txtValidDateToW39F2021.val() == "") {
                txtValidDateToW39F2021.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap_du_lieu')}}");
                $('#hdBtnSaveW39F2021').trigger('click');
                return false;
            }

            if (cboApprovalFlowIDW39F2021.val() == "") {
                cboApprovalFlowIDW39F2021.get(0).setCustomValidity("{{Helpers::getRS($g,'Ban_phai_nhap_du_lieu')}}");
                $('#hdBtnSaveW39F2021').trigger('click');
                return false;
            }

            var begin = convertStringToDate(txtValidDateFromW39F2021.val());
            var end = convertStringToDate(txtValidDateToW39F2021.val());

            if (daydiff(begin,end) <=0) {
                txtValidDateToW39F2021.val('');
                txtValidDateToW39F2021.get(0).setCustomValidity("{{Helpers::getRS($g,'Ngay_tu_phai_nho_hon_ngay_den')}}");
                $('#hdBtnSaveW39F2021').trigger('click');
                return false;
            }

            var $grid = $("#gridW39F2021");
            var obj = $grid.pqGrid("option", "dataModel.data");

            var filter = $.grep(obj,function(row){
                return row["IsEdit"] == 1 && row["IsUpdate"] == 1;
            });
            if (filter.length == 0){
                alert_warning("{{Helpers::getRS($g, 'Ban_phai_nhap_du_lieu_tren_luoi')}}");
                return false;
            }

            var colModel = $grid.pqGrid("option", "colModel");
            var askMessage = "{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}";
            for (var i = 0; i < obj.length; i++) {
                for (var j = 0; j < colModel.length; j++) {
                    var isEditCell = $grid.pqGrid( "isEditableCell", { rowIndx: i, dataIndx: [colModel[j].dataIndx] } )
                    if (colModel[j].required && isNullOrEmpty(obj[i][colModel[j].dataIndx]) && isEditCell && colModel[j].dataIndx == "ElementName") {
                        $grid.pqGrid("setSelection", {
                            rowIndx: i,
                            colIndx: j
                        });
                        $grid.pqGrid("editCell", {rowIndx: i, dataIndx: colModel[j].dataIndx});
                        var cell = $grid.pqGrid("getEditCell");
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
                        return;
                    }
                }
            }
            $("#frmW39F2021").submit();
        })
    });


    $("#frmW39F2021").on("submit", function (e) {
        e.preventDefault();
        //alert("subit");
        var obj =  $("#gridW39F2021").pqGrid("option", "dataModel.data");
        obj = reformatData(obj,$("#gridW39F2021"));
        console.log(obj);
        var nexAction = '';
        if (task == "add"){
            nexAction = '{{url("/W39F2021/$pForm/$g/save")}}';
        }
        if (task == "edit"){
            nexAction = '{{url("/W39F2021/$pForm/$g/update")}}';
        }
        if (task == "verify"){
            nexAction = '{{url("/W39F2021/$pForm/$g/updateverify")}}';
        }
        $.ajax({
            method: "POST",
            url: nexAction,
            data: $("#frmW39F2021").serialize() + "&txtEmployeeIDW39F2021=" + $("#txtEmployeeIDW39F2021").val() + "&txtVoucherDateW39F2021=" + $("#txtVoucherDateW39F2021").val()  + "&txtDepartmentNameW39F2021="+ $("#txtDepartmentNameW39F2021").val()+ "&cboAppCriterionSetIDW39F2021="+ $("#cboAppCriterionSetIDW39F2021").val() + "&obj=" + encodeURIComponent(JSON.stringify(obj)),
            success: function (data) {
                var rs = JSON.parse(data);
                console.log(data);
                switch (rs.status){
                    case "BACKGROUND": //Gửi mail ngầm
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
                    case "CHECKSTORE": //Lỗi khi run SQL
                        //alert_error(rs.data.Message);
                        var $grid = $("#gridW39F2021");
                        var row = rs.data.OrderNo;
                        var col = $grid.pqGrid( "getColIndx", { dataIndx: rs.data.FieldName} );
                        $grid.pqGrid("setSelection", {
                            rowIndx: row,
                            colIndx: col
                        });
                        $grid.pqGrid("editCell", {rowIndx: row, dataIndx: rs.data.FieldName});
                        var cell = $grid.pqGrid("getEditCell");
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
                            + rs.data.Message
                            + '</label></span></div>'
                            + '</div>'
                        });
                        $($editor).confirmation('show');
                        e.stopPropagation();
                        e.preventDefault();
                        break;
                    case "ERROR": //Lỗi khi run SQL
                        save_not_ok();
                        console.log(rs.message);
                        //alert_error(rs.message);
                        break;
                }
            }
        });
    });

    function callbackAfterSave(key){
        //alert(transID);
        $grid = $("#gridW39F2000");
        $.ajax({
            method: "POST",
            url: '{{url("/W39F2000/$pForm/$g/filter")}}',
            data: $("#frmW39F2000").serialize() + "&key=" +key ,
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
        task = "view";
        enableControls(task);
    }

    /*function updateParentData(data){
        for (var i=0;i<data.length; i++){
            if (data[i].IsEdit == 0 &&  data[i].IsUpdate == 0 && data[i].ParentID != ""){
                var parentID = data[i]["AppCriterionGroupID"];
                var filter = $.grep(data, function(row){
                    return row.ParentID == parentID;
                });
                data[i]["Confim"] = sumArray(filter, "Confim");
            }
        }

        for (var i=0;i<data.length; i++){
            if (data[i].IsEdit == 0 &&  data[i].IsUpdate == 0 && data[i].ParentID == ""){
                var parentID = data[i]["AppCriterionGroupID"];
                var filter = $.grep(data, function(row){
                    return row.ParentID == parentID;
                });
                data[i]["Confim"] = sumArray(filter, "Confim");
            }
        }
        $("#gridW39F2021").pqGrid("refreshDataAndView");
    }*/

    function updateParentData(rowData, data){
        //console.log(rowData);
        var rate = Number(rowData.Rate);
        var confim = Number(rowData.Confim);
        var parentID = rowData.ParentID;
        if (parentID != ''){
            var parentRow = $.grep(data, function(row){// lọc ra dòng cha
                return row.AppCriterionGroupID == parentID;
            });
            var childList = $.grep(data, function(row){// lọc ra list dòng con
                return row.ParentID == parentID;
            });
            console.log(childList);

            if (parentRow.length > 0){
                if(rowData.IsEdit == 1 && rowData.IsUpdate == 1){//cấp con nhỏ nhất
                    rowData.calParentID = (rate * confim)/100;//lấy Trọng Số nhân Xác Nhận rồi gán vô trường tạm
                }else{//cấp cha
                    for(var i = 0; i < childList.length; i++){//duyệt lại các dòng con xem dòng nào là cấp con nhỏ nhất
                        if(childList[i]['IsEdit'] == 1 && childList[i]['IsUpdate'] == 1){// là cấp con nhỏ nhất
                            childList[i]['calParentID'] = (childList[i]['Rate'] * childList[i]['Confim'])/100;
                        }else{//ko phải cấp con nhỏ nhất
                            childList[i]['calParentID'] = childList[i]["Confim"];
                        }
                    }
                }
                parentRow[0]["Confim"] = sumArray(childList, "calParentID");//sum trường tạm rồi gán vô trường confirm của cha
                updateParentData(parentRow[0], data);
            }else{
                $("#gridW39F2021").pqGrid("refreshDataAndView");
            }
        }else{
            $("#gridW39F2021").pqGrid("refreshDataAndView");
        }
    }
</script>

