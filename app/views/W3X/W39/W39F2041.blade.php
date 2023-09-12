<div class="modal fade" id="modalW39F2041" data-backdrop="static" role="dialog">
    <div class="modal-dialog" style="width: 90%">
        <div class="modal-content">
            <div class="modal-header logodg pdl0">
                {{Helpers::generateHeading($modalTitle,"W39F2041",true,"")}}
            </div>
            <div class="modal-body" style="padding:10px">
                <form id="frmW39F2041">


                    <div class="row form-group">
                        <div class="col-md-2 ">
                            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Bo_chi_tieu_chung")}}</label>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control select2 noUseValidHTML5"
                                    id="cboAppCriterionSetIDW39F2041"
                                    name="cboAppCriterionSetIDW39F2041"
                                    value="" required>
                                @foreach($appCriterionSetList as $rowAppCriterion)
                                    <option value="{{$rowAppCriterion['AppCriterionSetID']}}">{{$rowAppCriterion['AppCriterionSetName']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 ">
                            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Ngay_dang_ky")}}</label>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group date">
                                <input type="text" class="form-control noUseValidHTML5"
                                       id="txtDateFromW39F2041"
                                       name="txtDateFromW39F2041"
                                       value="{{Helpers::beginDateOfPeriod()}}">
                                <span class="input-group-addon">
                                    <i id="iconDateFrom"
                                       onclick="$('#txtDateFromW39F2041').datepicker('show');"
                                       class="glyphicon glyphicon-calendar">
                                    </i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group date">
                                <input type="text" class="form-control noUseValidHTML5"
                                       id="txtDateToW39F2041"
                                       name="txtDateToW39F2041"
                                       value="{{Helpers::endDateOfPeriod()}}">
                                <span class="input-group-addon">
                                    <i id="iconDateFrom"
                                       onclick="$('#txtDateToW39F2041').datepicker('show');"
                                       class="glyphicon glyphicon-calendar">
                                    </i>
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="row form-group">
                        <div class="col-md-2 ">
                            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Bo_chi_tieu_danh_gia")}}</label>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control select2 noUseValidHTML5"
                                    id="cboEmpCriterionIDW39F2041"
                                    name="cboEmpCriterionIDW39F2041"
                                    value="" required>
                                @foreach($empCriterionList as $rowEmpCriterion)
                                    <option value="{{$rowEmpCriterion['EmpCriterionID']}}">{{$rowEmpCriterion['EmpCriterionName']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 ">
                            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Loai_chi_tieu")}}</label>
                        </div>
                        <div class="col-md-2 ">
                            <div class="checkbox" style="margin-top: 3px;margin-left:20px">
                                <input type="checkbox" id="chkIsRegisterW39F2041" name="chkIsRegisterW39F2041"
                                       value="1">{{Helpers::getRS($g,"Nhan_vien_dang_ky")}}
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="checkbox" style="margin-top: 3px;margin-left:20px">
                                <input type="checkbox" id="chkIsDistributeW39F2041" name="chkIsDistributeW39F2041"
                                       value="1">{{Helpers::getRS($g,"Duoc_phan_bo")}}
                            </div>
                        </div>
                    </div>


                    <div class="row form-group">
                        <div class="col-md-2 ">
                            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Phong_ban")}}</label>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control select2 noUseValidHTML5"
                                    id="cboDepartmentIDW39F2041"
                                    name="cboDepartmentIDW39F2041"
                                    value="">
                                @foreach($departmentList as $rowDepartment)
                                    <option value="{{$rowDepartment['DepartmentID']}}">{{$rowDepartment['DepartmentName']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 ">
                            <label class="lbl-normal pdr0 liketext">{{Helpers::getRS($g,"Nhan_vien")}}</label>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control select2 noUseValidHTML5"
                                    id="cboEmployeeIDW39F2041"
                                    name="cboEmployeeIDW39F2041"
                                    value="">
                                @foreach($employeeList as $rowEmployee)
                                    <option value="{{$rowEmployee['EmployeeID']}}">{{$rowEmployee['EmployeeName']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <button class="btn btn-default smallbtn pull-right" style="padding-top: 4px"><span
                                        class="digi digi-filter"></span>
                                &nbsp;{{Helpers::getRS($g,"Loc")}}</button>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <div id="gridW39F2041"></div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12">
                            <button type="button" id="btnChooseW39F2041" class="btn btn-default smallbtn pull-right"
                                    style="padding-top: 4px"><span
                                        class="fa fa-check-circle"></span>
                                &nbsp;{{Helpers::getRS($g,"Chon")}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#txtDateFromW39F2041').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        $('#txtDateToW39F2041').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            language: '{{Session::get("locate")}}'
        });
        setTimeout(function () {
            resizePqGrid();
        }, 300);

    });

    $("#cboAppCriterionSetIDW39F2041").change(function () {
        $(".l3loading").removeClass('hide');
        postMethod("{{url('W39F2041/'.$pForm.'/'.$g.'/reloadEmpCriterion')}}", function (data) {
            $(".l3loading").addClass('hide');
            $("#cboEmpCriterionIDW39F2041").html(data);
        }, {appCriterionSetID: $(this).val()})
    });
    $("#cboDepartmentIDW39F2041").change(function () {
        $(".l3loading").removeClass('hide');
        postMethod("{{url('W39F2041/'.$pForm.'/'.$g.'/reloadEmployee')}}", function (data) {
            $(".l3loading").addClass('hide');
            $("#cboEmployeeIDW39F2041").html(data);
        }, {departmentID: $(this).val()})
    });

    $("#frmW39F2041").submit(function (event) {
        event.preventDefault();
        postMethod("{{url('W39F2041/'.$pForm.'/'.$g.'/filter')}}", function (data) {
            $("#gridW39F2041").pqGrid("option", "dataModel.data", data);
            $("#gridW39F2041").pqGrid("refreshDataAndView");
        }, $(this).serialize())
    });

    //---------------------------------------------------------------------------------------

    var obj = {
        width: '100%',
        height: $(document).height() - 330,
        numberCell: {show: true},
        //height: 300,
        freezeCols: 1,
        selectionModel: {type: 'row', mode: 'single'},
        minWidth: 30,
        scrollModel: {horizontal: true, pace: 'fast', autoFit: true, lastColumn: 'none'},
        showTitle: false,
        dataType: "JSON",
        wrap: false,
        hwrap: false,
        collapsible: false,
        postRenderInterval: -1,
        editable: true,
        complete: function (event, ui) {
        }
    };
    obj.colModel = [
        {
            dataIndx: "IsCheck",
            align: "center",
            title: "<label><input id='chkAllW09F2001' type='checkbox' class='visibility' /></label>",
            cb: {header: true, select: true, all: true},
            /*cb: {
                all: false,
                header: true,
                check: "1",
                uncheck: "0"
            },*/
            type: 'checkbox',
            cls: 'ui-state-default',
            dataType: 'bool',
            editor: false,
            sortable: false,
            //filter: { type: "checkbox", subtype: 'triple', condition: "equal", listeners: ['click'] },
            /*editable: function (ui) {
                var row = ui.rowData
                return  "{{--{{$task == "add" ? true : false}}--}}";
                },*/
            editable: true,
            render: function (ui) {
                var row = ui.rowData,
                    disabled = this.isEditableCell(ui) ? "" : "disabled";

                return {
                    cls: (disabled ? "readonly-status" : "")
                };
            }
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
                return false;
            },
            render: function (ui) {
                var rowData = ui.rowData;
                return {
                    cls: this.isEditableCell(ui) == false ? "readonly-status" : "",
                    style: rowData['Style']
                };
            },
            hidden: false
        },
        {
            title: "{{Helpers::getRS($g,'Chi_tieu_danh_gia')}}",
            dataType: "string",
            dataIndx: "ElementName",
            width: 330,
            align: "left",
            editor: {select: true},
            editModel: {keyUpDown: true},
            editable: true,
            sortable: false,
            //format: "#,###.00",
            editable: function (ui) {
                var rowData = ui.rowData;
                if (ui.rowIndx != undefined)
                    return rowData.IsEdit == 1;
                else
                    return false;
            },
            render: function (ui) {
                var rowData = ui.rowData;
                return {
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
            width: 400,
            align: "left",
            editor: {select: true},
            editModel: {keyUpDown: true},
            editable: true,
            sortable: false,
            //format: "#,###.00",
            editable: function (ui) {
                var rowData = ui.rowData;
                if (ui.rowIndx != undefined)
                    return rowData.IsEdit == 1;
                else
                    return false;
            },
            render: function (ui) {
                var rowData = ui.rowData;
                return {
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
        }
    ];
    obj.dataModel = {
        data: [],
        location: "local",
        sorting: "local",
        sortDir: "down"
    };
    $("#gridW39F2041").pqGrid(obj);
    $("#gridW39F2041").pqGrid("refreshDataAndView");


    $("#btnChooseW39F2041").click(function (e) {
        console.log("dfsf");
        var data = $("#gridW39F2041").pqGrid("option", "dataModel.data");
        var filter = $.grep(data, function (row) {
            return row["IsCheck"] == 1 || row["IsCheck"] == true;
        })
        //console.log(filter);
        if (filter.length == 0) {
            alert_warning("{{Helpers::getRS($g, 'Ban_chua_chon_du_lieu_tren_luoi')}}");
        } else {
            $("#modalW39F2041").modal('hide');
            addNewMultiRow(filter);

        }
    });


    function addNewMultiRow(rowDataList) {
        //console.log("hjhdffdjfhj");
        var indx = Number("{{$rowIndx}}");
        var parentRow = $("#gridW39F2022").pqGrid("getRowData", {rowIndx: indx})
        var items = [];
        for (var i = 0; i < rowDataList.length; i++) {
            rowDataList[i]["AppCriterionGroupID"] = '';
            rowDataList[i]["IsAddNew"] = 0;
            rowDataList[i]["IsEdit"] = 1;
            rowDataList[i]["IsUpdate"] = 1;
            rowDataList[i]["isChild"] = 1;
            rowDataList[i]["IsDistribute"] = "1";
            rowDataList[i]["GroupID"] = '';
            rowDataList[i]["Level"] = Number(parentRow["Level"]) + 1;
            rowDataList[i]["ParentID"] = parentRow["AppCriterionGroupID"];
            var obj = $("#gridW39F2022").pqGrid("option", "dataModel.data");
            var filter = $.grep(obj,function(row){
                return row["AppCriterionGroupID"] ==  parentRow["AppCriterionGroupID"];
            });
            var item = {
                newRow: rowDataList[i], rowIndx: indx + filter.length , checkEditable:false
            };

            //console.log(items);
           /* var item = {
                newRow: {
                    IsAddNew: 0,
                    ElementName: '',
                    Content: '',
                    IsDistribute: 0,
                    Rate: 0,
                    Confim: 0,
                    Result: 0,
                    NoteCriterion: '',
                    IsEdit: 1,
                    AppCriterionGroupID: parentRow["AppCriterionGroupID"]
                }, rowIndx: indx + (currentChild + 1 + i)
            };*/
            items.push(item);
        }
        //console.log(items);
        $("#gridW39F2022").pqGrid("addRow", {rowList: items});
        $("#gridW39F2022").pqGrid("scrollRow", {rowIndx: indx - 1});
        setTimeout(function(){
            $("#gridW39F2022").pqGrid("refreshDataAndView");
        }, 2000);
    }
</script>


