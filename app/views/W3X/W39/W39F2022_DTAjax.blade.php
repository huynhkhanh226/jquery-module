<?php
if (count($rsDetail) > 0) {
    $AppCriterionSetName = $rsDetail[0]["AppCriterionSetName"];
    $EmpCriterionName = $rsDetail[0]["EmpCriterionName"];
    $ValidDateFrom = $rsDetail[0]["ValidDateFrom"];
    $ValidDateTo = $rsDetail[0]["ValidDateTo"];
    $VoucherDate = $rsDetail[0]["VoucherDate"];
    $EmployeeID = $rsDetail[0]["EmployeeID"];
    $EmployeeName = $rsDetail[0]["EmployeeName"];
    $DepartmentName = $rsDetail[0]["DepartmentName"];
    $TotalResult = number_format($rsDetail[0]["TotalResult"], 2);
} else {
    $AppCriterionSetName = '';
    $EmpCriterionName = '';
    $ValidDateFrom = '';
    $ValidDateTo = '';
    $VoucherDate = '';
    $EmployeeID = '';
    $EmployeeName = '';
    $DepartmentName = '';
    $TotalResult = '';
}


?>


<form class="form-horizontal pdt10" id="frmW39F2022">
    <div class="row form-group">
        <div class="col-md-2 ">
            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Bo_chi_tieu_chung")}}</label>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control"
                   id="txtAppCriterionSetNameW39F2022"
                   value="{{$AppCriterionSetName}}"
                   name="txtAppCriterionSetNameW39F2022" readonly>
        </div>
        <div class="col-md-2 ">
            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Bo_chi_tieu_danh_gia")}}</label>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control"
                   id="txtEmpCriterionNameW39F2022"
                   value="{{$EmpCriterionName}}"
                   name="txtEmpCriterionNameW39F2022" readonly>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2 ">
            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Hieu_luc")}}</label>
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control noUseValidHTML5"
                   id="txtValidDateFromW39F2022"
                   name="txtValidDateFromW39F2022"
                   value="{{$ValidDateFrom}}" readonly>
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control noUseValidHTML5"
                   id="txtValidDateToW39F2022"
                   name="txtValidDateToW39F2022"
                   value="{{$ValidDateTo}}" readonly>
        </div>
        <div class="col-md-2 ">
            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ngay_dang_ky")}}</label>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control"
                   id="txtVoucherDateW39F2022"
                   name="txtVoucherDateW39F2022"
                   value="{{$VoucherDate}}" readonly>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2 ">
            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ma_NV")}}</label>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control"
                   id="txtEmployeeIDW39F2022"
                   value="{{$EmployeeID}}"
                   name="txtEmployeeIDW39F2022" readonly>
        </div>
        <div class="col-md-2 ">
            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Phong_ban")}}</label>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control"
                   id="txtDepartmentNameW39F2022"
                   value="{{$DepartmentName}}"
                   name="txtDepartmentNameW39F2022" readonly>
        </div>

    </div>
    <div class="row form-group">
        <div class="col-md-2 ">
            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ten_NV")}}</label>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control"
                   id="txtEmployeeNameW39F2022"
                   value="{{$EmployeeName}}"
                   name="txtEmployeeNameW39F2022" readonly>
        </div>
        <div class="col-md-2 ">
            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Tong_ket_dat")." (%)"}}</label>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control text-right"
                   id="txtTotalResultW39F2022"
                   value="{{$TotalResult}}"
                   name="txtTotalResultW39F2022" readonly>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-12">
            <div id="gridW39F2022"></div>
        </div>
    </div>
    <div class=" row">
        <div class="col-md-3">
            <label class="lbl-normal pdr0 liketext mgr10">{{Helpers::getRS($g,"Ngay_lap")}}</label>
            <label class="lbl-value pdr0 liketext ">{{$VoucherDate}}</label>
        </div>

        <div class="col-md-4">
            <label class="lbl-normal pdr0 liketext mgr10">{{Helpers::getRS($g,"Nguoi_lap")}}</label>
            <label class="lbl-value pdr0 liketext">{{$EmployeeName}}</label>
        </div>

        @if ($perD39F2022>=2)
            <div class="col-md-5 {{intval($isApproval) == 0 ? "" : "hide"}}">
                <div class="pull-right">
                    <button type="button" id="btnSaveW39F2022" name="btnSaveW39F2022"
                            class="btn btn-default smallbtn"><span
                                class="fa fa-floppy-o mgr5 text-blue"></span> {{Helpers::getRS($g,"Luu")}}
                    </button>
                    <button type="button" id="btnNotSaveW39F2022" name="btnNotSaveW39F2022"
                            class="btn btn-default smallbtn"><span
                                class="fa fa-ban text-red mgr5"></span> {{Helpers::getRS($g,"Khong_luu")}}
                    </button>
                </div>
            </div>
        @endif
    </div>
</form>
<script>
    var isGroupIDChange = 0; //biến phân biệt groupID có thay đổi giá trị hay ko //0 ko thay đổi //1 thay đổi
    var obj = {
        width: '100%',
        //height: $(document).height() - 350,
        height: $(document).height() - 330,
        freezeCols: 5,
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
        },
        complete: function (event, ui) {

        },
        cellSave: function (event, ui) {
            var column = $("#gridW39F2022").pqGrid("getColumn", {dataIndx: ui.dataIndx});
            var rowData = ui.rowData,
                dataIndx = ui.dataIndx,
                rowIndx = ui.rowIndx;
            var space = "&nbsp&nbsp&nbsp&nbsp&nbsp";
            if (column.dataType == "float" || column.dataType == "integer") {
                ui.rowData[ui.dataIndx] = formatNumber(ui.rowData[ui.dataIndx], getDecimal(column.format));
            }

            if(ui.dataIndx == "GroupID"){
                console.log(rowData['GroupID'], rowData['Level']);
                if(rowData['GroupID'] != ""){
                    if(isGroupIDChange == 1){//gía trị GroupID có thay đổi.
                        rowData['AppCriterionGroupID'] = rowData['GroupID'];
                        var i = 0;
                        while(i < Number(rowData['Level'] - 1)){//cộng thêm Space dựa trên level //sô vòng lặp = Level -1;
                            rowData['GroupID'] = space + rowData['GroupID'];
                            i++;
                        }
                    }
                }
            }
            ui.rowData["IsUpdate"] == 1;
        },
        cellBeforeSave: function( event, ui ) {
            var $grid = $("#gridW39F2022");
            var newVal = ui.newVal;
            var rowData = ui.rowData,
                dataIndx = ui.dataIndx,
                rowIndx = ui.rowIndx;
            var dataGrid = $grid.pqGrid("option", "dataModel.data");
            if(dataIndx == "GroupID"){
                if(newVal != rowData['AppCriterionGroupID']){
                    if(newVal != ""){// tránh trường hợp dò trúng các dòng có groupID trống
                        var fillterGroupID = $.grep(dataGrid, function(row){// lọc ra dòng con
                            return row.AppCriterionGroupID == newVal;
                        });
                        console.log(fillterGroupID);
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


                if(newVal != rowData['GroupID']){//có thay đổi
                    isGroupIDChange = 1;
                }else{//không thay đổi
                    isGroupIDChange = 0;
                }
            }
        },
        cellKeyDown: function( event, ui ) {
            var rowData = ui.rowData;
            var rowIndx = ui.rowIndx;
            var dataIndx = ui.dataIndx;
            var $grid = $("#gridW39F2022");
            if(event.keyCode == "46"){//ấn phím delete
                rowData['AppCriterionGroupID'] = rowData['GroupID'];
            }
        }
    };
    obj.colModel = [
        {
            title: "",
            minWidth: 45,
            align: "center",
            dataIndx: "View",
            isExport: false,
            editor: false,
            editable: false,
            sortable: false,
            render: function (ui) {
                var str = "";
                var rowData = ui.rowData;
                var perD39F2022 = Number("{{$perD39F2022}}");
                if (perD39F2022 >= 2 && rowData["IsAddNew"] == 1) {
                    str += "<a title='{{Helpers::getRS($g,"Them_moi1")}}'  class='btnAddNewW39F2022'><i class='glyphicon glyphicon-plus text-blue mgr5'></i></a>";
                    str += "<a title='{{Helpers::getRS($g,"Ke_thua")}}'  class='btnInheritW39F2022'><i class='fa fa-clone text-orange'></i></a>";
                } else {
                }
                if (rowData["IsEdit"] == 1) {
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
                $cell.find(".btnAddNewW39F2022").bind("click", function (evt) {
                    addNewRow(rowIndx);
                });
                $cell.find(".btnInheritW39F2022").bind("click", function (evt) {
                    showFormDialogPost("{{url('/W39F2041/'.$pForm.'/'.$g)}}", 'modalW39F2041', {empCriterionID: row["EmpCriterionID"], rowIndx: rowIndx}, 2)
                    //addNewRow(rowIndx);
                });
                $cell.find(".btnDeleteW39F2000").bind("click", function (evt) {
                    deleteRow(rowIndx);
                });
            },
            hidden: "{{intval($isApproval) == 0 ? false : true}}"
        },


        {
            title: "IsAddNew",
            dataType: "integer",
            dataIndx: "IsAddNew",
            hidden: true
        },
        {
            title: "IsEdit",
            dataType: "integer",
            dataIndx: "IsEdit",
            hidden: true
        },
        {
            title: "AppCriterionGroupID",
            dataType: "string",
            dataIndx: "AppCriterionGroupID",
            hidden: true
        },

        {
            title: "{{Helpers::getRS($g,'Nhom')}}",
            dataType: "string",
            dataIndx: "GroupID",
            width: 250,
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
                    style: rowData['Style']
                };
            },
            hidden: false,
            //required:true
        },
        {
            title: "{{Helpers::getRS($g,'Chi_tieu_danh_gia')}}",
            dataType: "string",
            dataIndx: "ElementName",
            width: 300,
            align: "left",
            editor: {select: true},
            editModel: {keyUpDown: true},
            editable: true,
            sortable: false,
            //format: "#,###.00",
            editable: function (ui) {
                var rowData = ui.rowData;
                if (ui.rowIndx != undefined)
                    return rowData.IsEdit == 1 && rowData.IsUpdate == 1 && $("#slduyet").val() == 0;
                else
                    return false;
            },
            render: function (ui) {
                var rowData = ui.rowData;
                //console.log(rowData);
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
                    return rowData.IsEdit == 1 && rowData.IsUpdate == 1 && $("#slduyet").val() == 0;
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
            width: 120,
            type: 'checkbox',
            dataType: 'string',
            editor: false,
            sortable: false,
            editable: function (ui) {
                return false;
            },
            render: function (ui) {
                var row = ui.rowData,
                    disabled = this.isEditableCell(ui) ? "" : "disabled";
                console.log(row);
                return {
                    cls: (disabled ? "readonly-status" : "")
                };
            }
        },

        {
            title: "{{Helpers::getRS($g,'Trong_so')}}",
            dataType: "float",
            dataIndx: "Rate",
            width: 120,
            align: "center",
            editor: {select: true},
            editModel: {keyUpDown: true},
            sortable: false,
            format: "#,###.00",
            editable: function (ui) {
                var rowData = ui.rowData;
                if (ui.rowIndx != undefined)
                    return (rowData.IsEdit == 0 && rowData.IsUpdate == 1 && $("#slduyet").val() == 0) || (rowData.IsEdit == 1 && rowData.IsUpdate == 1 && $("#slduyet").val() == 0) ? true : false;
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
            title: "{{Helpers::getRS($g,'Ghi_chu')}}",
            dataType: "string",
            dataIndx: "NoteCriterion",
            width: 230,
            align: "left",
            editor: {select: true},
            editModel: {keyUpDown: true},
            sortable: false,
            //format: "#,###.00",
            editable: function (ui) {
                var rowData = ui.rowData;
                if (ui.rowIndx != undefined)
                    return rowData.IsEdit == 1 && rowData.IsUpdate == 1 && $("#slduyet").val() == 0;
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
        }
        @foreach($caption as $row)
        , {
            title: "{{$row['RefCaption']}}",
            width: 150,
            align: "left",
            dataType: "string",
            //format: "{{Helpers::getStringFormat(0)}}",//returnSFormat(0),
            dataIndx: "{{$row['RefID']}}",
            hidden: '{{$row["Disabled"] == 1 ? true:false}}',
            editable: false,
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
        }
        @endforeach
    ];
    obj.dataModel = {
        data: {{json_encode($rsDetail)}},
        location: "local",
        sorting: "local",
        sortDir: "down"
    };
    $("#gridW39F2022").pqGrid(obj);
    $("#gridW39F2022").pqGrid("refreshDataAndView");


    function addNewRow(indx) {
        var $grid = $("#gridW39F2022")
        var colModel = $grid.pqGrid("option", "colModel");
        var askMessage = "{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}";
        var parentRow = $("#gridW39F2022").pqGrid("getRowData", {rowIndx: indx})

        var obj = $grid.pqGrid("option", "dataModel.data");

        if(parentRow['GroupID'] == ""){
            console.log(parentRow['GroupID']);
            //parentRow['isChild'] = 1; //bật ischild = 1 để thỏa điều kiện gỡ rem GroupID
            //$grid.pqGrid("refreshDataAndView");
            for (var i = 0; i < obj.length; i++) {
                for (var j = 0; j < colModel.length; j++) {
                    var isEditCell = $grid.pqGrid( "isEditableCell", { rowIndx: indx, dataIndx: 'GroupID' } )
                    if (isNullOrEmpty(obj[i][colModel[j].dataIndx]) && isEditCell) {
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

        var filter = $.grep(obj,function(row){
            return row["AppCriterionGroupID"] ==  parentRow["AppCriterionGroupID"];
        });


        var idx = $grid.pqGrid("addRow", {
            newRow: {
                IsAddNew: 0,
                isChild: 1,
                ElementName: '',
                Content: '',
                ParentID: Number(parentRow['isChild']) == 1 ? parentRow['AppCriterionGroupID']: parentRow['AppCriterionGroupID'],
                IsDistribute: "1",
                Rate: 0,
                Confim: 0,
                Result: 0,
                NoteCriterion: '',
                IsEdit: 1,
                IsUpdate: 1,
                Level: Number(parentRow['Level']) + 1,
                AppCriterionSetID: parentRow["AppCriterionSetID"],
                AppCriterionGroupID: ''
            }, rowIndx: indx + (filter.length),checkEditable:false
        });
        $("#gridW39F2022").pqGrid("scrollRow", {rowIndx: indx - 1});
        $("#gridW39F2022").pqGrid("refreshDataAndView");
    }


    function deleteRow(indx) {
        ask_delete(function () {
            //find parent
            var parentRow = null;
            for (var i = indx; i >= 0; i--) {
                parentRow = $("#gridW39F2022").pqGrid("getRowData", {rowIndx: i})
                if (parentRow["IsEdit"] == 0) {
                    break;
                }
            }
            //delete row
            $("#gridW39F2022").pqGrid("deleteRow", {rowIndx: indx});
            $("#gridW39F2022").pqGrid("setSelection", {rowIndx: indx - 1});
            //update child in parents
            $("#gridW39F2022").pqGrid("refreshDataAndView");
        });

    }

    $("#btnNotSaveW39F2022").click(function () {
        ask_not_save(function () {
            index = -1; //Phải reset lại biến này thì mới trigger được, biến này nằm ở form W84F2021
            $("#tbListVoucherW84F2020").find(".active").trigger('click');
        })
    });


    $("#btnSaveW39F2022").click(function (e) {
        ask_save(function () {
            var $grid = $("#gridW39F2022");
            var obj = $grid.pqGrid("option", "dataModel.data");
            var colModel = $grid.pqGrid("option", "colModel");
            var askMessage = "{{Helpers::getRS($g,"Ban_phai_nhap_du_lieu")}}";
            for (var i = 0; i < obj.length; i++) {
                for (var j = 0; j < colModel.length; j++) {
                    var isEditCell = $grid.pqGrid("isEditableCell", {rowIndx: i, dataIndx: [colModel[j].dataIndx]})
                    if (colModel[j].required && isNullOrEmpty(obj[i][colModel[j].dataIndx]) && isEditCell) {
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
                        e.stopPropagation();
                        e.preventDefault();
                        return;
                    }

                }
            }


            postMethod("{{url('/W39F2022/'.$pForm.'/'.$g.'/save')}}", function (data) {
                var rs = JSON.parse(data);
                console.log(data);
                switch (rs.status) {
                    case 'ERROR':
                        save_not_ok();
                        break;
                    case 'OKAY':
                        save_ok();
                        break;
                    case 'CHECKSTORE':
                        var $grid = $("#gridW39F2022");
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
                }
            }, {obj: JSON.stringify(obj)})
        });

    });

    $("#btnCollapse").click(function(){
        resizePqGrid();
    });
</script>